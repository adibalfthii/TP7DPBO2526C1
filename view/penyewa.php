<?php
$penyewaObj = new Penyewa();

// Logika Tambah & Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $penyewaObj->create($_POST['nama_penyewa'], $_POST['kontak']);
    } elseif (isset($_POST['edit'])) {
        $penyewaObj->update($_POST['id_penyewa'], $_POST['nama_penyewa'], $_POST['kontak']);
    }
    echo "<script>window.location.href='index.php?page=penyewa';</script>";
}

// Logika Hapus
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $penyewaObj->delete($_GET['id']);
    echo "<script>window.location.href='index.php?page=penyewa';</script>";
}

// Ambil data untuk form Edit
$editData = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $editData = $penyewaObj->readById($_GET['id']);
}
?>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <?= $editData ? 'Edit Data Penyewa' : 'Tambah Penyewa Baru' ?>
            </div>
            <div class="card-body">
                <form method="POST">
                    <?php if($editData): ?>
                        <input type="hidden" name="id_penyewa" value="<?= $editData['id_penyewa'] ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label>Nama Penyewa</label>
                        <input type="text" name="nama_penyewa" class="form-control" value="<?= $editData ? $editData['nama_penyewa'] : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Kontak (No HP)</label>
                        <input type="text" name="kontak" class="form-control" value="<?= $editData ? $editData['kontak'] : '' ?>" required>
                    </div>
                    
                    <?php if($editData): ?>
                        <button type="submit" name="edit" class="btn btn-warning">Update Data</button>
                        <a href="index.php?page=penyewa" class="btn btn-secondary">Batal</a>
                    <?php else: ?>
                        <button type="submit" name="add" class="btn btn-success">Simpan Data</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Penyewa</th>
                            <th>Kontak</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($penyewaObj->readAll() as $row): ?>
                        <tr>
                            <td><?= $row['id_penyewa'] ?></td>
                            <td><?= $row['nama_penyewa'] ?></td>
                            <td><?= $row['kontak'] ?></td>
                            <td>
                                <a href="index.php?page=penyewa&action=edit&id=<?= $row['id_penyewa'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="index.php?page=penyewa&action=delete&id=<?= $row['id_penyewa'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>