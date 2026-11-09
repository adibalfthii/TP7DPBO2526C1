<?php
$pemesananObj = new Pemesanan();
$kosObj = new Kos();
$penyewaObj = new Penyewa();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $pemesananObj->create($_POST['id_kos'], $_POST['id_penyewa'], $_POST['tanggal_pesan']);
    } elseif (isset($_POST['edit'])) {
        $pemesananObj->update($_POST['id_pemesanan'], $_POST['id_kos'], $_POST['id_penyewa'], $_POST['tanggal_pesan']);
    }
    echo "<script>window.location.href='index.php?page=pemesanan';</script>";
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $pemesananObj->delete($_GET['id']);
    echo "<script>window.location.href='index.php?page=pemesanan';</script>";
}

$editData = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $editData = $pemesananObj->readById($_GET['id']);
}
?>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <?= $editData ? 'Edit Transaksi' : 'Tambah Transaksi Baru' ?>
            </div>
            <div class="card-body">
                <form method="POST">
                    <?php if($editData): ?>
                        <input type="hidden" name="id_pemesanan" value="<?= $editData['id_pemesanan'] ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label>Pilih Kos</label>
                        <select name="id_kos" class="form-control" required>
                            <option value="">-- Pilih Kos --</option>
                            <?php foreach($kosObj->readAll() as $k): ?>
                                <option value="<?= $k['id_kos'] ?>" <?= ($editData && $editData['id_kos'] == $k['id_kos']) ? 'selected' : '' ?>>
                                    <?= $k['nama_kos'] ?> (Rp <?= number_format($k['harga'], 0, ',', '.') ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Pilih Penyewa</label>
                        <select name="id_penyewa" class="form-control" required>
                            <option value="">-- Pilih Penyewa --</option>
                            <?php foreach($penyewaObj->readAll() as $p): ?>
                                <option value="<?= $p['id_penyewa'] ?>" <?= ($editData && $editData['id_penyewa'] == $p['id_penyewa']) ? 'selected' : '' ?>>
                                    <?= $p['nama_penyewa'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Masuk Kos</label>
                        <input type="date" name="tanggal_pesan" class="form-control" value="<?= $editData ? $editData['tanggal_pesan'] : '' ?>" required>
                    </div>
                    
                    <?php if($editData): ?>
                        <button type="submit" name="edit" class="btn btn-warning">Update Transaksi</button>
                        <a href="index.php?page=pemesanan" class="btn btn-secondary">Batal</a>
                    <?php else: ?>
                        <button type="submit" name="add" class="btn btn-info text-white">Simpan Transaksi</button>
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
                            <th>ID Transaksi</th>
                            <th>Nama Kos</th>
                            <th>Nama Penyewa</th>
                            <th>Tgl Masuk</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pemesananObj->readAll() as $row): ?>
                        <tr>
                            <td><?= $row['id_pemesanan'] ?></td>
                            <td><?= $row['nama_kos'] ?></td>
                            <td><?= $row['nama_penyewa'] ?></td>
                            <td><?= date('d-M-Y', strtotime($row['tanggal_pesan'])) ?></td>
                            <td>
                                <a href="index.php?page=pemesanan&action=edit&id=<?= $row['id_pemesanan'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="index.php?page=pemesanan&action=delete&id=<?= $row['id_pemesanan'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus transaksi ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>