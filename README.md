📊 Sistem Penjualan Toko Percetakan

Sistem informasi penjualan berbasis Laravel yang digunakan untuk mengelola transaksi penjualan pada toko percetakan serta dilengkapi dengan fitur analisis dan prediksi penjualan menggunakan Machine Learning.

Aplikasi ini membantu pemilik toko dalam:

Mengelola data produk

Mengelola transaksi penjualan

Melihat laporan penjualan

Menganalisis performa penjualan

Memprediksi penjualan di masa mendatang

Project ini dibuat sebagai projek skripsi / portfolio pengembangan sistem informasi berbasis web.

🧩 Fitur Utama
🏪 Manajemen Penjualan

Input data transaksi penjualan

Edit dan hapus data penjualan

Status transaksi (Pending / Selesai)

📦 Manajemen Produk

Menampilkan daftar produk

Mengelola informasi produk percetakan

📈 Dashboard Statistik

Menampilkan informasi seperti:

Total transaksi

Total pendapatan

Pendapatan hari ini

Produk terjual

Jumlah pelanggan aktif

📊 Laporan Penjualan

Filter berdasarkan:

tanggal

produk

status

Export laporan ke Excel

🤖 Prediksi Penjualan

Menggunakan Machine Learning untuk memprediksi penjualan bulan berikutnya berdasarkan data historis.

Fitur:

Prediksi jumlah penjualan

Perbandingan data aktual vs prediksi

Analisis tren penjualan

📉 Visualisasi Data

Menampilkan grafik seperti:

Grafik penjualan bulanan

Grafik actual vs prediction

Statistik penjualan

🛠 Teknologi yang Digunakan
Backend

Laravel (PHP Framework)

MySQL Database

REST API

Machine Learning Service

Python

Flask API

Random Forest Model

Frontend

Blade Template

Bootstrap / AdminLTE

Chart.js

Tools

Git

GitHub

Docker (optional)

🗂 Struktur Project

Contoh struktur utama repository:

Sistem-Penjualan-Toko-Percetakan
│
├── backend-laravel
│   ├── app
│   ├── database
│   ├── resources
│   ├── routes
│   └── public
│
├── ml-service
│   ├── model
│   ├── api
│   └── training
│
├── docker
├── README.md
└── .gitignore
⚙️ Cara Menjalankan Project
1️⃣ Clone Repository
git clone https://github.com/HazimaHamam/Sistem-Penjualan-Toko-Percetakan.git

Masuk ke folder project

cd Sistem-Penjualan-Toko-Percetakan
2️⃣ Install Dependency Laravel
composer install
3️⃣ Buat File Environment
cp .env.example .env

Lalu konfigurasi database di file .env

Contoh:

DB_DATABASE=penjualan
DB_USERNAME=root
DB_PASSWORD=
4️⃣ Generate App Key
php artisan key:generate
5️⃣ Migrasi Database
php artisan migrate
6️⃣ Jalankan Server Laravel
php artisan serve

Akses aplikasi di:

http://127.0.0.1:8000
📊 Contoh Tampilan Sistem

Fitur utama sistem:

Dashboard Admin

Manajemen Penjualan

Laporan Penjualan

Grafik Analisis Penjualan

Prediksi Penjualan

(Tambahkan screenshot aplikasi di sini jika ada)

🎯 Tujuan Pengembangan

Tujuan dari sistem ini adalah:

Membantu digitalisasi proses penjualan toko percetakan

Memberikan analisis data penjualan

Menggunakan Machine Learning untuk membantu pengambilan keputusan bisnis

👨‍💻 Pengembang

Nama: Atsila Hazima Hamam
Project: Sistem Penjualan Toko Percetakan
Keperluan: Skripsi / Portfolio Project

GitHub:
https://github.com/HazimaHamam

📜 Lisensi

Project ini dibuat untuk keperluan pembelajaran, penelitian, dan portfolio.
