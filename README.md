**Tugas Praktikum 7 DPBO 2026 - Kelas C1**

Nama: Muh. Adib Al-Fathi NIM: 2500418 Kelas: C1
**Tema Aplikasi:** Sistem Manajemen Kos-kosan (Boarding House System)

Janji

Saya Muh. Adib Al-Fathi dengan NIM 2500418 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## 1. Deskripsi Tema Website
Aplikasi ini merupakan **Sistem Manajemen Kos UPI**, yaitu platform berbasis web Native PHP yang dirancang untuk mengelola operasional sewa kos-kosan di sekitar area Universitas Pendidikan Indonesia (UPI). Sistem ini memfasilitasi pendataan properti kos, data penyewa (mahasiswa), serta pencatatan transaksi pemesanan kamar kos. 

Pengembangan aplikasi ini mengerapkan paradigma **Object-Oriented Programming (OOP)** murni di sisi backend, koneksi database berbasis **PDO (PHP Data Objects)** dengan *Prepared Statements*, serta antarmuka GUI yang modular menggunakan *framework* Bootstrap 5.

## 2. Struktur Database & Relasi Tabel
Sistem menggunakan database MySQL bernama `db_kos_upi` yang terdiri dari **3 entitas (tabel)** yang saling berhubungan:
### A. Tabel `kos` (Master Data Kos)
Menyimpan informasi detail mengenai properti kos.
* `id_kos` (INT, Primary Key, Auto Increment): ID unik data kos.
* `nama_kos` (VARCHAR 100): Nama rumah kos.
* `alamat` (TEXT): Alamat lengkap lokasi kos.
* `harga` (INT): Biaya sewa per bulan (dalam Rupiah).

### B. Tabel `penyewa` (Master Data Penyewa)
Menyimpan informasi identitas penyewa/mahasiswa.
* `id_penyewa` (INT, Primary Key, Auto Increment): ID unik penyewa.
* `nama_penyewa` (VARCHAR 100): Nama lengkap penyewa.
* `kontak` (VARCHAR 15): Nomor HP/WhatsApp penyewa.

### C. Tabel `pemesanan` (Tabel Transaksi / Relasional)
Menghubungkan data kos dan penyewa sebagai bukti transaksi sewa kamar.
* `id_pemesanan` (INT, Primary Key, Auto Increment): ID unik transaksi.
* `id_kos` (INT, Foreign Key): Merujuk ke `kos(id_kos)` dengan relasi `ON DELETE CASCADE`.
* `id_penyewa` (INT, Foreign Key): Merujuk ke `penyewa(id_penyewa)` dengan relasi `ON DELETE CASCADE`.
* `tanggal_pesan` (DATE): Tanggal mulai masuk/pemesanan kos.

## 3. Struktur Folder & Arsitektur Kode
Project disusun menggunakan struktur direktori yang teratur untuk menerapkan prinsip pemisahan tanggung jawab (*Single Responsibility Principle*) dan reusabilitas kode:

```text
TP7DPBO2526C1_Adib/
├── class/
│   ├── Kos.php          # Class pengelola data kos (CRUD)
│   ├── Penyewa.php      # Class pengelola data penyewa (CRUD)
│   └── Pemesanan.php    # Class pengelola transaksi pemesanan (JOIN & CRUD)
├── config/
│   └── database.php     # Class koneksi PDO database
├── database/
│   └── db_kos_upi.sql   # File struktur & data awal database
├── style/
│   └── style.css        # File custom styling (opsional)
├── view/
│   ├── header.php       # Komponen navbar & kerangka atas HTML
│   ├── footer.php       # Komponen footer & skrip Bootstrap HTML
│   ├── kos.php          # Tampilan GUI form & tabel data kos
│   ├── penyewa.php      # Tampilan GUI form & tabel data penyewa
│   └── pemesanan.php    # Tampilan GUI form & tabel transaksi pemesanan
├── index.php            # Entry point utama & router aplikasi
└── README.md            # Dokumentasi project
```

**4. Penjelasan Penerapan OOP & Flow Program**

**A. Database Layer (config/database.php)**
Koneksi database dibungkus di dalam kelas Database. Kelas ini menggunakan driver PDO (PHP Data Objects) yang bertindak sebagai database abstraction layer. PDO dikonfigurasi dengan PDO::ERRMODE_EXCEPTION untuk mempermudah penanganan error saat proses query.

**B. Business Logic & Data Access Layer (class/)**
Seluruh kelas pada folder class/ bertindak sebagai subclass yang mewarisi (extends) kelas Database:
1. Kelas Kos: Mengatur metode create(), readAll(), readById(), update(), dan delete() untuk tabel kos.
2. Kelas Penyewa: Mengatur metode CRUD untuk tabel penyewa.
3. Kelas Pemesanan: Mengatur metode CRUD transaksi. Khusus fungsi readAll(), kelas ini mengeksekusi query SQL JOIN antara tabel pemesanan, kos, dan penyewa untuk menyajikan data terintegrasi ke layar.

Keamanan Query (Prepared Statements): Sesuai aturan modul, seluruh metode CRUD di dalam kelas tidak mengksekusi query mentah langsung (mysqli_query / $db->query). Semua query di-bind menggunakan $this->conn->prepare() dan $stmt->bindParam() untuk mencegah celah keamanan SQL Injection.

**C. Presentation & Routing Layer (view/ & index.php)**
- index.php (Router): Mengatur HTTP Request-Response Cycle. Saat pengguna mengakses web, index.php membaca parameter URL ?page=. Sesuai nilainya (kos, penyewa, atau pemesanan), router akan memanggil komponen tampilan (view) yang relevan.

- view/ (Modular GUI): Elemen HTML dibuat modular. header.php dan footer.php dipanggil di setiap halaman agar struktur tampilan konsisten tanpa penulisan kode berulang (Don't Repeat Yourself / DRY).

**5. Dokumentasi Pengujian Fitur**
<img width="959" height="272" alt="ss4" src="https://github.com/user-attachments/assets/43c97c90-5a9d-4a0a-81b3-942bf818b53d" />
<img width="959" height="395" alt="ss1" src="https://github.com/user-attachments/assets/70938746-7c70-437c-8984-9f2f01f836f6" />
<img width="937" height="311" alt="ss2" src="https://github.com/user-attachments/assets/2a29fb84-683c-430d-85f6-a259bf13bbbe" />
<img width="959" height="353" alt="ss3" src="https://github.com/user-attachments/assets/5189abb9-baae-46ee-a170-6fa417a525cb" />



