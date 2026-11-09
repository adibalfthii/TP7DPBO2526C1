<?php
// Memanggil semua class
require_once 'class/Kos.php';
require_once 'class/Penyewa.php';
require_once 'class/Pemesanan.php';

// Memanggil Header HTML
include 'view/header.php';

// Routing sederhana untuk menentukan halaman apa yang dibuka
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

if ($page == 'home') {
    echo "<div class='alert alert-info'><h2>Selamat Datang di Sistem Manajemen Kos UPI</h2>";
    echo "<p>Silakan gunakan menu di atas untuk mengelola data Kos, Penyewa, dan Pemesanan (CRUD).</p></div>";
} elseif ($page == 'kos') {
    include 'view/kos.php';
} elseif ($page == 'penyewa') {
    include 'view/penyewa.php';
} elseif ($page == 'pemesanan') {
    include 'view/pemesanan.php';
} else {
    echo "<div class='alert alert-danger'>Halaman tidak ditemukan!</div>";
}

// Memanggil Footer HTML
include 'view/footer.php';
?>