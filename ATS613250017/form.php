<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit;
}
include "koneksi.php";

// Ada ?id= di URL berarti EDIT, kalau tidak ada berarti TAMBAH
$id   = (int) ($_GET['id'] ?? 0);
$edit = $id > 0;

$nomor = $jenis = $pemilik = $tahun = $error = '';

// Mode edit: ambil data lama untuk mengisi form
if ($edit) {
    $stmt = $koneksi->prepare("SELECT * FROM mobil017 WHERE no_id = ?");
    $stmt->bind_param("i", $id); // i = integer
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();

    if (!$data) { // id tidak ada di database
        $_SESSION['pesan'] = 'Data tidak ditemukan.';
        header('Location: dashboard.php');
        exit;
    }

    $nomor   = $data['nomor_kendaraan'];
    $jenis   = $data['jenis_kendaraan'];
    $pemilik = $data['pemilik'];
    $tahun   = $data['tahun_pembuatan'];
}

// Kode ini jalan hanya saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor   = trim($_POST['nomor_kendaraan']);
    $jenis   = $_POST['jenis_kendaraan'];
    $pemilik = trim($_POST['pemilik']);
    $tahun   = trim($_POST['tahun_pembuatan']);

    // Validasi sederhana
    if ($nomor === '' || $pemilik === '') {
        $error = 'Nomor kendaraan dan pemilik wajib diisi.';
    } elseif (!in_array($jenis, ['Sedan', 'Pickup', 'Truk', 'Bemo'])) {
        $error = 'Jenis kendaraan tidak valid.';
    } elseif (!ctype_digit($tahun) || strlen($tahun) !== 4) {
        $error = 'Tahun harus 4 digit angka.';
    } else {
        if ($edit) {
            // UPDATE hanya baris dengan no_id ini (WHERE penting!)
            $stmt = $koneksi->prepare(
                "UPDATE mobil017
                 SET nomor_kendaraan = ?, jenis_kendaraan = ?, pemilik = ?, tahun_pembuatan = ?
                 WHERE no_id = ?"
            );
            $stmt->bind_param("ssssi", $nomor, $jenis, $pemilik, $tahun, $id);
            $_SESSION['pesan'] = 'Data berhasil diperbarui.';
        } else {
            // INSERT data baru (no_id otomatis dari auto increment)
            $stmt = $koneksi->prepare(
                "INSERT INTO mobil017 (nomor_kendaraan, jenis_kendaraan, pemilik, tahun_pembuatan)
                 VALUES (?, ?, ?, ?)"
            );
            $stmt->bind_param("ssss", $nomor, $jenis, $pemilik, $tahun);
            $_SESSION['pesan'] = 'Data berhasil ditambahkan.';
        }
        $stmt->execute();

        header('Location: dashboard.php');
        exit;
    }
}

$judul = $edit ? 'Edit Data Kendaraan' : 'Tambah Data Kendaraan';
$aksi  = $edit ? 'form.php?id=' . $id : 'form.php';

require "header.php";
?>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <h1 class="h4 mb-3 text-primary"><?= $judul ?></h1>

        <?php if ($error !== ''): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="<?= $aksi ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nomor Kendaraan</label>
                        <input type="text" name="nomor_kendaraan" class="form-control"
                               maxlength="12" value="<?= htmlspecialchars($nomor) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Kendaraan</label>
                        <select name="jenis_kendaraan" class="form-select" required>
                            <option value="">Pilih jenis</option>
                            <?php foreach (['Sedan', 'Pickup', 'Truk', 'Bemo'] as $j): ?>
                                <option value="<?= $j ?>" <?= $jenis === $j ? 'selected' : '' ?>>
                                    <?= $j ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pemilik</label>
                        <input type="text" name="pemilik" class="form-control"
                               maxlength="50" value="<?= htmlspecialchars($pemilik) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Tahun Pembuatan</label>
                        <input type="text" name="tahun_pembuatan" class="form-control"
                               maxlength="4" value="<?= htmlspecialchars($tahun) ?>" required>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="dashboard.php" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>