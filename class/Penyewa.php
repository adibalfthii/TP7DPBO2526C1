<?php
require_once __DIR__ . '/../config/database.php';

class Penyewa extends Database {

    // Read: Mengambil semua data penyewa
    public function readAll() {
        $sql = "SELECT * FROM penyewa ORDER BY id_penyewa DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read by ID
    public function readById($id) {
        $sql = "SELECT * FROM penyewa WHERE id_penyewa = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create: Menambah penyewa
    public function create($nama, $kontak) {
        $sql = "INSERT INTO penyewa (nama_penyewa, kontak) VALUES (:nama, :kontak)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':kontak', $kontak);
        return $stmt->execute();
    }

    // Update: Mengubah data penyewa
    public function update($id, $nama, $kontak) {
        $sql = "UPDATE penyewa SET nama_penyewa = :nama, kontak = :kontak WHERE id_penyewa = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':kontak', $kontak);
        return $stmt->execute();
    }

    // Delete: Menghapus penyewa
    public function delete($id) {
        $sql = "DELETE FROM penyewa WHERE id_penyewa = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>