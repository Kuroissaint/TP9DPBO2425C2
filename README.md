# TP9DPBO2425

## Janji

Saya Nafis Asyakir Anjar dengan NIM 2407915 mengerjakan Tugas Praktikum 9 pada Mata Kuliah Desain dan Pemrograman Berorientasi Objek (DPBO) untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Struktur Folder

Berikut adalah struktur direktori dari implementasi arsitektur MVP pada proyek ini:

```text
mvp/
├── models/                     # Layer Model (Akses Database & Objek Data)
│   ├── DB.php                  # Konfigurasi koneksi PDO Database
│   ├── KontrakModel.php        # Interface untuk Model Pembalap
│   ├── KontrakModelSirkuit.php # Interface untuk Model Sirkuit
│   ├── Pembalap.php            # Class Object (POJO) Pembalap
│   ├── Sirkuit.php             # Class Object (POJO) Sirkuit
│   ├── TabelPembalap.php       # Implementasi Query CRUD Pembalap
│   └── TabelSirkuit.php        # Implementasi Query CRUD Sirkuit
├── presenters/                 # Layer Presenter (Penghubung Model & View)
│   ├── KontrakPresenter.php        # Interface Presenter Pembalap
│   ├── KontrakPresenterSirkuit.php # Interface Presenter Sirkuit
│   ├── PresenterPembalap.php       # Logic menangani data Pembalap
│   └── PresenterSirkuit.php        # Logic menangani data Sirkuit
├── template/                   # File HTML Murni (Skin)
│   ├── form_sirkuit.html       # Template Form Tambah/Edit Sirkuit
│   ├── form.html               # Template Form Tambah/Edit Pembalap
│   ├── skin_sirkuit.html       # Template Tabel List Sirkuit
│   └── skin.html               # Template Tabel List Pembalap
├── views/                      # Layer View (Output Generator)
│   ├── KontrakView.php         # Interface View Pembalap
│   ├── KontrakViewSirkuit.php  # Interface View Sirkuit
│   ├── ViewPembalap.php        # Logic merender HTML Pembalap
│   └── ViewSirkuit.php         # Logic merender HTML Sirkuit
├── index.php                   # Main Entry Point & Routing
└── mvp_db.sql                  # File Query Database MySQL
```

## 🗄️ Desain Program

<img width="398" height="250" alt="image" src="https://github.com/user-attachments/assets/7a9e537f-8339-4e04-b387-9fcb2b415e15" />

---

### 📄 Tabel: pembalap

Menyimpan data statistik dan informasi pembalap F1.

| Atribut | Tipe Data | Keterangan |
|--------|-----------|------------|
| id | INT | Primary Key, Auto Increment |
| nama | VARCHAR(255) | Nama Lengkap Pembalap |
| tim | VARCHAR(255) | Nama Tim (Constructor) |
| negara | VARCHAR(255) | Asal Negara |
| poinMusim | INT | Total Poin Musim Ini |
| jumlahMenang | INT | Total Kemenangan (Podium 1) |

---





### 📄 Tabel: sirkuit

Menyimpan data informasi lintasan balap.

| Atribut | Tipe Data | Keterangan |
|--------|-----------|------------|
| id | INT | Primary Key, Auto Increment |
| nama | VARCHAR(255) | Nama Resmi Sirkuit |
| negara | VARCHAR(255) | Lokasi Negara Sirkuit |
| panjang_km | FLOAT | Panjang Lintasan (KM) |
| jumlah_lap | INT | Jumlah Putaran Balapan |

---

## 🚀 Fitur Yang Tersedia

- **CRUD Pembalap** → melihat, menambah, mengedit, menghapus data Pembalap  
- **CRUD Sirkuit** → melihat, menambah, mengedit, menghapus data Sirkuit  
- **Navigasi Modul** → berpindah antara menu Pembalap & Sirkuit  

---

## 🔄 Alur Program (Arsitektur MVP)

1. User mengakses `index.php` dengan parameter `nav`
   - `?nav=sirkuit` → memanggil `PresenterSirkuit`
   - default → memanggil `PresenterPembalap`
2. Presenter meminta data ke Model (TabelPembalap/TabelSirkuit)
3. Model melakukan query ke database dan mengembalikan objek data
4. Presenter meneruskan data ke View
5. View membaca template HTML dan mengisi data ke dalamnya
6. Output HTML ditampilkan ke browser user

---

### 📌 Data Manipulation (POST)

- User submit form → data dikirim ke `index.php`
- Presenter validasi data → Model lakukan `INSERT / UPDATE / DELETE`
- Setelah sukses → dilakukan redirect ke halaman utama

---

## 📸 Dokumentasi

https://github.com/user-attachments/assets/77dc40dd-26a9-45ad-bf09-aded90b61bba

---

