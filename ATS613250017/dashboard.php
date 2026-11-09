<?php
require "fungsi.php";
periksaLogin();
require "koneksi.php";

// Pesan sukses/gagal dari tambah/edit/hapus, tampil sekali
$pesan = $_SESSION['pesan'] ?? '';
unset($_SESSION['pesan']);

// Ambil semua data mobil, yang terbaru di atas
$hasil = $koneksi->query("SELECT * FROM mobil017 ORDER BY no_id DESC");

require "header.php";
?>

<div class="alert alert-info">
    Login sebagai <strong><?= aman($_SESSION['nama']) ?></strong>
    (<?= aman($_SESSION['email']) ?>), ID: <?= aman($_SESSION['id']) ?>
</div>

<?php if ($pesan !== ''): ?>
    <div class="alert alert-success"><?= aman($pesan) ?></div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Data Kendaraan</h1>
    <a href="tambah.php" class="btn btn-primary">+ Tambah Data</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>Nomor Kendaraan</th>
                    <th>Jenis</th>
                    <th>Pemilik</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php while ($data = $hasil->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= aman($data['nomor_kendaraan']) ?></td>
                        <td><?= aman($data['jenis_kendaraan']) ?></td>
                        <td><?= aman($data['pemilik']) ?></td>
                        <td><?= aman($data['tahun_pembuatan']) ?></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="edit.php?id=<?= $data['no_id'] ?>"
                                   class="btn btn-outline-primary btn-sm">Edit</a>
                                <!-- Hapus lewat POST, ada konfirmasi dulu -->
                                <form action="hapus.php" method="post" class="m-0"
                                      onsubmit="return confirm('Hapus data ini?');">
                                    <input type="hidden" name="id" value="<?= $data['no_id'] ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>

                <?php if ($hasil->num_rows === 0): ?>
                    <tr><td colspan="6" class="text-center py-4 text-secondary">Belum ada data.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require "footer.php"; ?>
