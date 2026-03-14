import pandas as pd
import numpy as np
import joblib
from datetime import datetime
from sqlalchemy import create_engine
from sklearn.ensemble import RandomForestRegressor
from sklearn.linear_model import LinearRegression
from sklearn.metrics import (
    mean_absolute_error,
    mean_absolute_percentage_error,
    r2_score,
    mean_squared_error
)
from sklearn.model_selection import TimeSeriesSplit
import os
import warnings

warnings.filterwarnings("ignore")

# =====================================================
# CONFIG DATABASE
# =====================================================
DB_HOST = os.getenv("DB_HOST", "mysql")
DB_USER = os.getenv("DB_USER", "laravel")
DB_PASS = os.getenv("DB_PASS", "laravel")
DB_NAME = os.getenv("DB_NAME", "penjualan_db")

DATABASE_URL = f"mysql+pymysql://{DB_USER}:{DB_PASS}@{DB_HOST}/{DB_NAME}"
engine = create_engine(DATABASE_URL)


# =====================================================
# LOAD DATA
# =====================================================
def load_data(produk=None):
    """
    Load aggregated monthly sales from database.
    """

    query = """
        SELECT 
            YEAR(tanggal) AS tahun,
            MONTH(tanggal) AS bulan,
            SUM(jumlah) AS total
        FROM penjualans
        WHERE status = 'Selesai'
    """

    if produk:
        query += f" AND produk = '{produk}' "

    query += """
        GROUP BY YEAR(tanggal), MONTH(tanggal)
        ORDER BY tahun, bulan
    """

    df = pd.read_sql(query, engine)

    if df.empty:
        raise Exception("Data kosong. Tidak bisa melakukan training.")

    return df


# =====================================================
# FEATURE ENGINEERING (NO DATA LEAKAGE)
# =====================================================
def create_features(df):
    """
    Create lag, rolling, and seasonal features.
    """

    df = df.sort_values(["tahun", "bulan"]).reset_index(drop=True)

    # Lag features
    df["lag_1"] = df["total"].shift(1)
    df["lag_2"] = df["total"].shift(2)
    df["lag_3"] = df["total"].shift(3)

    # Rolling mean (anti leakage)
    df["rolling_mean_3"] = df["total"].rolling(3).mean().shift(1)

    # Seasonal encoding (cyclical month)
    df["bulan_sin"] = np.sin(2 * np.pi * df["bulan"] / 12)
    df["bulan_cos"] = np.cos(2 * np.pi * df["bulan"] / 12)

    df.dropna(inplace=True)

    feature_cols = [
        "bulan",
        "tahun",
        "lag_1",
        "lag_2",
        "lag_3",
        "rolling_mean_3",
        "bulan_sin",
        "bulan_cos"
    ]

    X = df[feature_cols]
    y = df["total"]

    return X, y


# =====================================================
# BASELINE MODEL (NAIVE FORECAST)
# =====================================================
def evaluate_baseline(y):
    """
    Naive forecast: y(t) = y(t-1)
    """

    baseline_pred = y.shift(1).dropna()
    baseline_true = y.iloc[1:]

    mape = mean_absolute_percentage_error(baseline_true, baseline_pred)

    return mape


# =====================================================
# TIME SERIES CROSS VALIDATION
# =====================================================
def evaluate_model(model, X, y):
    """
    Evaluate model using TimeSeriesSplit.
    """

    n_splits = min(5, len(X) - 1)

    if n_splits < 2:
        raise Exception("Data terlalu sedikit untuk cross validation.")

    tscv = TimeSeriesSplit(n_splits=n_splits)

    mae_list, mape_list, rmse_list, r2_list = [], [], [], []

    for train_idx, test_idx in tscv.split(X):

        X_train, X_test = X.iloc[train_idx], X.iloc[test_idx]
        y_train, y_test = y.iloc[train_idx], y.iloc[test_idx]

        model.fit(X_train, y_train)
        pred = model.predict(X_test)

        mae_list.append(mean_absolute_error(y_test, pred))
        mape_list.append(mean_absolute_percentage_error(y_test, pred))
        rmse_list.append(np.sqrt(mean_squared_error(y_test, pred)))
        r2_list.append(r2_score(y_test, pred))

    return {
        "mae": float(np.mean(mae_list)),
        "mape": float(np.mean(mape_list)),
        "rmse": float(np.mean(rmse_list)),
        "r2": float(np.mean(r2_list))
    }


# =====================================================
# TRAINING PIPELINE
# =====================================================
def train_pipeline(produk=None):

    print("\n=== LOAD DATA ===")
    df = load_data(produk)

    if len(df) < 12:
        raise Exception("Minimal 12 bulan data diperlukan.")

    print(f"Jumlah data: {len(df)} bulan")

    X, y = create_features(df)

    # -------------------------
    # BASELINE
    # -------------------------
    print("\n=== BASELINE MODEL ===")
    baseline_mape = evaluate_baseline(y)
    print(f"Baseline MAPE: {baseline_mape:.4f}")

    # -------------------------
    # MODEL 1: RANDOM FOREST
    # -------------------------
    rf = RandomForestRegressor(
        n_estimators=300,
        max_depth=8,
        random_state=42,
        n_jobs=-1
    )

    rf_metrics = evaluate_model(rf, X, y)

    # -------------------------
    # MODEL 2: LINEAR REGRESSION
    # -------------------------
    lr = LinearRegression()
    lr_metrics = evaluate_model(lr, X, y)

    print("\n=== HASIL CROSS VALIDATION ===")
    print("Random Forest :", rf_metrics)
    print("Linear Regres :", lr_metrics)

    # -------------------------
    # PILIH MODEL TERBAIK (MAPE TERKECIL)
    # -------------------------
    if rf_metrics["mape"] < lr_metrics["mape"]:
        best_model = rf
        best_name = "RandomForest"
        best_metrics = rf_metrics
    else:
        best_model = lr
        best_name = "LinearRegression"
        best_metrics = lr_metrics

    print("\n=== MODEL TERBAIK ===")
    print("Nama Model :", best_name)
    print("MAPE       :", round(best_metrics["mape"], 4))
    print("R2         :", round(best_metrics["r2"], 4))

    # -------------------------
    # TRAIN FINAL MODEL
    # -------------------------
    best_model.fit(X, y)

    # -------------------------
    # SAVE MODEL & METADATA
    # -------------------------
    joblib.dump(best_model, "model.pkl")
    joblib.dump(best_metrics, "metrics.pkl")
    joblib.dump(best_name, "model_name.pkl")
    joblib.dump(baseline_mape, "baseline_mape.pkl")
    joblib.dump(datetime.now().strftime("%Y-%m-%d %H:%M:%S"), "last_trained.pkl")

    print("\nTraining selesai.")
    print("Model berhasil disimpan.\n")


# =====================================================
# RUN
# =====================================================
if __name__ == "__main__":
    train_pipeline()
