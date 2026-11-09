<?php
require "fungsi.php";
periksaLogin();
require "koneksi.php";

$judul = "Tambah Data Kendaraan";
$aksi  = "tambah.php";
$nomor = $jenis = $pemilik = $tahun = $error = "";

// Kode ini jalan hanya saat form disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nomor   = trim($_POST['nomor_kendaraan']);
    $jenis   = $_POST['jenis_kendaraan'];
    $pemilik = trim($_POST['pemilik']);
    $tahun   = trim($_POST['tahun_pembuatan']);

    // Validasi sederhana
    if ($nomor === "" || $pemilik === "") {
        $error = "Nomor kendaraan dan pemilik wajib diisi.";
    } elseif (!in_array($jenis, ['Sedan', 'Pickup', 'Truk', 'Bemo'])) {
        $error = "Jenis kendaraan tidak valid.";
    } elseif (!ctype_digit($tahun) || strlen($tahun) !== 4) {
        $error = "Tahun harus 4 digit angka.";
    } else {
        // INSERT dengan prepared statement (tanda ? diisi bind_param)
        $stmt = $koneksi->prepare(
            "INSERT INTO mobil017 (nomor_kendaraan, jenis_kendaraan, pemilik, tahun_pembuatan)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $nomor, $jenis, $pemilik, $tahun);
        $stmt->execute();

        $_SESSION['pesan'] = "Data berhasil ditambahkan.";
        header("Location: dashboard.php");
        exit;
    }
}

require "form_mobil.php";
