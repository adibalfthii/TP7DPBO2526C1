<?php
require_once __DIR__ . '/../config/database.php';

class Kos extends Database {
    
    // Read: Mengambil semua data kos
    public function readAll() {
        $sql = "SELECT * FROM kos ORDER BY id_kos DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read by ID: Mengambil 1 data kos berdasarkan ID
    public function readById($id) {
        $sql = "SELECT * FROM kos WHERE id_kos = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create: Menambah data kos baru
    public function create($nama, $alamat, $harga) {
        $sql = "INSERT INTO kos (nama_kos, alamat, harga) VALUES (:nama, :alamat, :harga)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':harga', $harga, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Update: Mengubah data kos
    public function update($id, $nama, $alamat, $harga) {
        $sql = "UPDATE kos SET nama_kos = :nama, alamat = :alamat, harga = :harga WHERE id_kos = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':harga', $harga, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Delete: Menghapus data kos
    public function delete($id) {
        $sql = "DELETE FROM kos WHERE id_kos = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>