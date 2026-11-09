<?php
require "fungsi.php";
periksaLogin();
require "koneksi.php";

$id = (int) ($_GET['id'] ?? 0); // id dari URL, dipaksa jadi angka

// Ambil data lama untuk mengisi form
$stmt = $koneksi->prepare("SELECT * FROM mobil017 WHERE no_id = ?");
$stmt->bind_param("i", $id); // i = integer
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

// Id tidak ada di database: kembali ke daftar
if (!$data) {
    $_SESSION['pesan'] = "Data tidak ditemukan.";
    header("Location: dashboard.php");
    exit;
}

$judul   = "Edit Data Kendaraan";
$aksi    = "edit.php?id=" . $id;
$nomor   = $data['nomor_kendaraan'];
$jenis   = $data['jenis_kendaraan'];
$pemilik = $data['pemilik'];
$tahun   = $data['tahun_pembuatan'];
$error   = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nomor   = trim($_POST['nomor_kendaraan']);
    $jenis   = $_POST['jenis_kendaraan'];
    $pemilik = trim($_POST['pemilik']);
    $tahun   = trim($_POST['tahun_pembuatan']);

    if ($nomor === "" || $pemilik === "") {
        $error = "Nomor kendaraan dan pemilik wajib diisi.";
    } elseif (!in_array($jenis, ['Sedan', 'Pickup', 'Truk', 'Bemo'])) {
        $error = "Jenis kendaraan tidak valid.";
    } elseif (!ctype_digit($tahun) || strlen($tahun) !== 4) {
        $error = "Tahun harus 4 digit angka.";
    } else {
        // UPDATE hanya baris dengan no_id ini (WHERE penting!)
        $stmt = $koneksi->prepare(
            "UPDATE mobil017
             SET nomor_kendaraan = ?, jenis_kendaraan = ?, pemilik = ?, tahun_pembuatan = ?
             WHERE no_id = ?"
        );
        $stmt->bind_param("ssssi", $nomor, $jenis, $pemilik, $tahun, $id);
        $stmt->execute();

        $_SESSION['pesan'] = "Data berhasil diperbarui.";
        header("Location: dashboard.php");
        exit;
    }
}

require "form_mobil.php";
