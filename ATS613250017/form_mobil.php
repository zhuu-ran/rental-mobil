<?php require "header.php"; ?>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <h1 class="h4 mb-3"><?= aman($judul) ?></h1>

        <?php if ($error !== ''): ?>
            <div class="alert alert-danger"><?= aman($error) ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body p-4">
                <form action="<?= aman($aksi) ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nomor Kendaraan</label>
                        <input type="text" name="nomor_kendaraan" class="form-control"
                               maxlength="12" value="<?= aman($nomor) ?>" required>
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
                               maxlength="50" value="<?= aman($pemilik) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Tahun Pembuatan</label>
                        <input type="text" name="tahun_pembuatan" class="form-control"
                               maxlength="4" value="<?= aman($tahun) ?>" required>
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
