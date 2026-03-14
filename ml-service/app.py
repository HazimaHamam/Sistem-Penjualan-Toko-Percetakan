from flask import Flask, request, jsonify
import joblib
import os
import numpy as np
import pandas as pd
from sklearn.ensemble import RandomForestRegressor
from sklearn.metrics import mean_absolute_percentage_error
from sqlalchemy import create_engine
from datetime import datetime
from scipy.stats import norm
last_trained_at = None

# =========================
# KONFIGURASI DATABASE
# =========================
DB_HOST = "mysql"  
DB_USER = "laravel"
DB_PASS = "laravel"
DB_NAME = "penjualan_db"

engine = create_engine(
    f"mysql+pymysql://{DB_USER}:{DB_PASS}@{DB_HOST}/{DB_NAME}"
)
app = Flask(__name__)

# =========================
# LOAD MODEL
# =========================
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
MODEL_PATH = os.path.join(BASE_DIR, 'model.pkl')

try:
    model = joblib.load(MODEL_PATH)
    print("✅ Model berhasil dimuat")
except Exception as e:
    model = None
    print(f"❌ Gagal load model: {e}")

# =========================
# ENDPOINT PREDIKSI
# =========================
@app.route('/predict', methods=['POST'])
def predict():

    # ===============================
    # CEK MODEL
    # ===============================
    if model is None:
        return jsonify({
            'status': 'error',
            'message': 'Model belum dimuat'
        }), 500

    # ===============================
    # VALIDASI JSON
    # ===============================
    if not request.is_json:
        return jsonify({
            'status': 'error',
            'message': 'Request harus dalam format JSON'
        }), 400

    data = request.get_json()

    required_fields = ['bulan', 'tahun', 'lag_1', 'lag_2', 'lag_3']
    if not all(field in data for field in required_fields):
        return jsonify({
            'status': 'error',
            'message': 'Format JSON salah. Wajib: bulan, tahun, lag_1, lag_2, lag_3'
        }), 400

    # ===============================
    # CAST & VALIDASI DATA
    # ===============================
    try:
        bulan  = int(data['bulan'])
        tahun  = int(data['tahun'])
        lag_1  = float(data['lag_1'])
        lag_2  = float(data['lag_2'])
        lag_3  = float(data['lag_3'])
    except (ValueError, TypeError):
        return jsonify({
            'status': 'error',
            'message': 'Semua input harus berupa angka'
        }), 400

    if bulan < 1 or bulan > 12:
        return jsonify({
            'status': 'error',
            'message': 'bulan harus antara 1 sampai 12'
        }), 400

    if lag_1 < 0 or lag_2 < 0 or lag_3 < 0:
        return jsonify({
            'status': 'error',
            'message': 'lag tidak boleh negatif'
        }), 400

    # ===============================
    # PREDIKSI + CONFIDENCE INTERVAL
    # ===============================
    try:
        # 🔥 HARUS SAMA DENGAN TRAINING
        fitur = np.array([[bulan, tahun, lag_1, lag_2, lag_3]], dtype=float)

        # Prediksi utama
        mean_pred = model.predict(fitur)[0]

        # Jika RandomForest → bisa hitung CI
        if hasattr(model, "estimators_"):
            all_predictions = np.array([
                tree.predict(fitur)[0]
                for tree in model.estimators_
            ])

            std_pred = np.std(all_predictions)
            margin_error = 1.96 * std_pred

            lower_bound = mean_pred - margin_error
            upper_bound = mean_pred + margin_error
        else:
            lower_bound = mean_pred
            upper_bound = mean_pred

        return jsonify({
            'status': 'success',
            'prediksi_penjualan': round(float(mean_pred), 2),
            'confidence_interval': {
                'level': '95%',
                'lower': round(float(lower_bound), 2),
                'upper': round(float(upper_bound), 2)
            }
        }), 200

    except Exception as e:
        return jsonify({
            'status': 'error',
            'message': 'Gagal melakukan prediksi',
            'detail': str(e)
        }), 500    
@app.route('/model-info', methods=['GET'])
def model_info():
    global model, last_trained_at

    if model is None:
        return jsonify({
            'status': 'error',
            'message': 'Model belum dimuat'
        }), 500

    try:
        BASE_DIR = os.path.dirname(os.path.abspath(__file__))
        MAPE_PATH = os.path.join(BASE_DIR, 'mape.pkl')

        if not os.path.exists(MAPE_PATH):
            return jsonify({
                'status': 'error',
                'message': 'File mape.pkl belum tersedia'
            }), 400

        mape = joblib.load(MAPE_PATH)
        akurasi = round(max(0, (1 - mape) * 100), 2)

        return jsonify({
            'status': 'success',
            'model': 'Random Forest Regressor',
            'metrik': 'MAPE',
            'akurasi': akurasi,
            'last_trained_at': last_trained_at
        }), 200

    except Exception as e:
        return jsonify({
            'status': 'error',
            'message': str(e)
        }), 500


@app.route('/retrain', methods=['POST'])
def retrain():
    global model

    try:
        # ===============================
        # AMBIL DATA BULANAN (AMAN TIME SERIES)
        # ===============================
        df = pd.read_sql("""
            SELECT 
                YEAR(tanggal)  AS tahun,
                MONTH(tanggal) AS bulan,
                SUM(jumlah)    AS total
            FROM penjualans
            WHERE status = 'Selesai'
            GROUP BY YEAR(tanggal), MONTH(tanggal)
            ORDER BY tahun, bulan
        """, engine)

        # ===============================
        # VALIDASI DATA
        # ===============================
        if len(df) < 6:
            return jsonify({
                "status": "error",
                "message": "Data belum cukup untuk retrain (minimal 6 bulan)",
                "jumlah_data": int(len(df))
            }), 400

        # ===============================
        # FEATURE ENGINEERING
        # ===============================
        df['lag_1'] = df['total'].shift(1)
        df['lag_2'] = df['total'].shift(2)
        df['lag_3'] = df['total'].shift(3)

        df.dropna(inplace=True)

        X = df[['bulan', 'tahun', 'lag_1', 'lag_2', 'lag_3']]
        y = df['total']

        # ===============================
        # INIT / RETRAIN MODEL
        # ===============================
        model = RandomForestRegressor(
            n_estimators=300,
            max_depth=8,
            random_state=42,
            n_jobs=-1
        )

        model.fit(X, y)

        # ===============================
        # SIMPAN MODEL
        # ===============================
        joblib.dump(model, MODEL_PATH)

        last_trained_at = datetime.now().strftime("%Y-%m-%d %H:%M:%S")

        return jsonify({
            "status": "success",
            "message": "Model berhasil diretrain",
            "jumlah_data": int(len(df)),
            "last_trained_at": last_trained_at
        }), 200

    except Exception as e:
        return jsonify({
            "status": "error",
            "message": str(e)
        }), 500
# AKURASI PER PRODUK (AMAN & MASUK AKAL)
# =========================
@app.route('/model-accuracy', methods=['POST'])
def model_accuracy():
    if model is None:
        return jsonify({
            'status': 'error',
            'message': 'Model belum dimuat'
        }), 500

    data = request.get_json()
    if not data or 'data' not in data:
        return jsonify({
            'status': 'error',
            'message': 'Data kosong'
        }), 400

    df = pd.DataFrame(data['data'])

    hasil = []

    for produk, group in df.groupby('produk'):
        group = group.sort_values('bulan')

        # -------------------------
        # FEATURE ENGINEERING
        # -------------------------
        group['lag_1'] = group['penjualan'].shift(1)
        group['lag_2'] = group['penjualan'].shift(2)
        group.dropna(inplace=True)

        # Minimal data
        if len(group) < 5:
            continue

        # Abaikan penjualan kecil / nol (MAPE tidak stabil)
        group = group[group['penjualan'] >= 5]

        if len(group) < 3:
            continue

        X = group[['bulan', 'lag_1', 'lag_2']]
        y = group['penjualan']

        # -------------------------
        # PREDIKSI
        # -------------------------
        pred = model.predict(X)

        # -------------------------
        # HITUNG MAPE (DIBATASI)
        # -------------------------
        mape = mean_absolute_percentage_error(y, pred) * 100

        # Batasi MAPE maksimum 100%
        mape = min(mape, 100)

        # Akurasi dalam range wajar
        akurasi = round(max(0, 100 - mape), 2)

        hasil.append({
            'produk': produk,
            'akurasi': akurasi,
            'jumlah_data': int(len(group))
        })

    return jsonify({
        'status': 'success',
        'akurasi_per_produk': hasil
    })
# =========================
# ACTUAL VS PREDICTION
# =========================
@app.route('/actual-vs-prediction', methods=['POST'])
def actual_vs_prediction():
    if model is None:
        return jsonify({
            'status': 'error',
            'message': 'Model belum dimuat'
        }), 500

    payload = request.get_json()
    if not payload or 'data' not in payload:
        return jsonify({
            'status': 'error',
            'message': 'Data kosong'
        }), 400

    df = pd.DataFrame(payload['data'])

    # Validasi kolom wajib
    required_cols = {'produk', 'bulan', 'penjualan'}
    if not required_cols.issubset(df.columns):
        return jsonify({
            'status': 'error',
            'message': 'Kolom wajib: produk, bulan, penjualan'
        }), 400

    hasil = {}

    for produk, group in df.groupby('produk'):
        group = group.sort_values('bulan').reset_index(drop=True)

        # Feature engineering
        group['lag_1'] = group['penjualan'].shift(1)
        group['lag_2'] = group['penjualan'].shift(2)
        group.dropna(inplace=True)

        if len(group) < 3:
            continue

        X = group[['bulan', 'lag_1', 'lag_2']]
        y_actual = group['penjualan'].values.tolist()
        y_pred = model.predict(X)

        hasil[produk] = {
            'bulan': group['bulan'].astype(int).tolist(),
            'actual': [round(float(v), 2) for v in y_actual],
            'prediction': [round(float(v), 2) for v in y_pred]
        }

    return jsonify({
        'status': 'success',
        'data': hasil
    })


# =========================
# RUN SERVER
# =========================
if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
