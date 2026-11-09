CREATE TABLE kos (
    id_kos INT AUTO_INCREMENT PRIMARY KEY,
    nama_kos VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    harga INT NOT NULL
);

CREATE TABLE penyewa (
    id_penyewa INT AUTO_INCREMENT PRIMARY KEY,
    nama_penyewa VARCHAR(100) NOT NULL,
    kontak VARCHAR(15) NOT NULL
);

CREATE TABLE pemesanan (
    id_pemesanan INT AUTO_INCREMENT PRIMARY KEY,
    id_kos INT,
    id_penyewa INT,
    tanggal_pesan DATE NOT NULL,
    FOREIGN KEY (id_kos) REFERENCES kos(id_kos) ON DELETE CASCADE,
    FOREIGN KEY (id_penyewa) REFERENCES penyewa(id_penyewa) ON DELETE CASCADE
);