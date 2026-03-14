import pandas as pd
from sqlalchemy import create_engine

# =========================
# KONFIGURASI DATABASE
# =========================
DB_HOST = "mysql"      
DB_USER = "laravel"
DB_PASS = "laravel"
DB_NAME = "penjualan_db"

# =========================
# CONNECT DATABASE
# =========================
engine = create_engine(
    f"mysql+pymysql://{DB_USER}:{DB_PASS}@{DB_HOST}/{DB_NAME}"
)

# =========================
# QUERY DATA BULANAN
# =========================
query = """
SELECT 
    YEAR(tanggal) as tahun,
    MONTH(tanggal) as bulan,
    SUM(total) as total
FROM penjualans
WHERE status = 'Selesai'
GROUP BY YEAR(tanggal), MONTH(tanggal)
ORDER BY tahun, bulan
"""

try:
    df = pd.read_sql(query, engine)
    df.to_csv("monthly_sales.csv", index=False)

    print("Data berhasil diexport ke monthly_sales.csv")
    print(df.head())

except Exception as e:
    print("Terjadi kesalahan:")
    print(e)
