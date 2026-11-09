<?php
$kosObj = new Kos();

// Logika untuk mengeksekusi Tambah & Edit Data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $kosObj->create($_POST['nama_kos'], $_POST['alamat'], $_POST['harga']);
    } elseif (isset($_POST['edit'])) {
        $kosObj->update($_POST['id_kos'], $_POST['nama_kos'], $_POST['alamat'], $_POST['harga']);
    }
    // Refresh halaman setelah submit agar datanya ter-update di tabel
    echo "<script>window.location.href='index.php?page=kos';</script>";
}

// Logika untuk mengeksekusi Hapus Data
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $kosObj->delete($_GET['id']);
    echo "<script>window.location.href='index.php?page=kos';</script>";
}

// Ambil data jika tombol edit ditekan
$editData = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $editData = $kosObj->readById($_GET['id']);
}
?>

<div class="row">
    <!-- Kolom Form (Kiri) -->
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <?= $editData ? 'Edit Data Kos' : 'Tambah Kos Baru' ?>
            </div>
            <div class="card-body">
                <form method="POST">
                    <?php if($editData): ?>
                        <input type="hidden" name="id_kos" value="<?= $editData['id_kos'] ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label>Nama Kos</label>
                        <input type="text" name="nama_kos" class="form-control" value="<?= $editData ? $editData['nama_kos'] : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" required><?= $editData ? $editData['alamat'] : '' ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Harga per Bulan (Rp)</label>
                        <input type="number" name="harga" class="form-control" value="<?= $editData ? $editData['harga'] : '' ?>" required>
                    </div>
                    
                    <?php if($editData): ?>
                        <button type="submit" name="edit" class="btn btn-warning">Update Data</button>
                        <a href="index.php?page=kos" class="btn btn-secondary">Batal</a>
                    <?php else: ?>
                        <button type="submit" name="add" class="btn btn-primary">Simpan Data</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Kolom Tabel (Kanan) -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Kos</th>
                            <th>Alamat</th>
                            <th>Harga</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($kosObj->readAll() as $row): ?>
                        <tr>
                            <td><?= $row['id_kos'] ?></td>
                            <td><?= $row['nama_kos'] ?></td>
                            <td><?= $row['alamat'] ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td>
                                <a href="index.php?page=kos&action=edit&id=<?= $row['id_kos'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="index.php?page=kos&action=delete&id=<?= $row['id_kos'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus kos ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>