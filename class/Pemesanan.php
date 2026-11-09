<?php
require_once __DIR__ . '/../config/database.php';

class Pemesanan extends Database {

    // Read: Mengambil semua transaksi pemesanan gabung dengan tabel kos & penyewa (JOIN)
    public function readAll() {
        $sql = "SELECT p.id_pemesanan, p.tanggal_pesan, k.nama_kos, k.harga, py.nama_penyewa, py.kontak 
                FROM pemesanan p
                JOIN kos k ON p.id_kos = k.id_kos
                JOIN penyewa py ON p.id_penyewa = py.id_penyewa
                ORDER BY p.id_pemesanan DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read by ID
    public function readById($id) {
        $sql = "SELECT * FROM pemesanan WHERE id_pemesanan = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create: Membuat transaksi pemesanan kos
    public function create($id_kos, $id_penyewa, $tanggal) {
        $sql = "INSERT INTO pemesanan (id_kos, id_penyewa, tanggal_pesan) VALUES (:id_kos, :id_penyewa, :tanggal)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_kos', $id_kos, PDO::PARAM_INT);
        $stmt->bindParam(':id_penyewa', $id_penyewa, PDO::PARAM_INT);
        $stmt->bindParam(':tanggal', $tanggal);
        return $stmt->execute();
    }

    // Update
    public function update($id, $id_kos, $id_penyewa, $tanggal) {
        $sql = "UPDATE pemesanan SET id_kos = :id_kos, id_penyewa = :id_penyewa, tanggal_pesan = :tanggal WHERE id_pemesanan = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':id_kos', $id_kos, PDO::PARAM_INT);
        $stmt->bindParam(':id_penyewa', $id_penyewa, PDO::PARAM_INT);
        $stmt->bindParam(':tanggal', $tanggal);
        return $stmt->execute();
    }

    // Delete
    public function delete($id) {
        $sql = "DELETE FROM pemesanan WHERE id_pemesanan = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>