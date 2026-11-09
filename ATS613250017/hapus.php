<?php
require "fungsi.php";
periksaLogin();
require "koneksi.php";

// Hapus hanya boleh lewat tombol Hapus (POST)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = (int) $_POST['id'];

    // DELETE hanya baris dengan no_id ini
    $stmt = $koneksi->prepare("DELETE FROM mobil017 WHERE no_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // affected_rows = jumlah baris yang benar-benar terhapus
    $_SESSION['pesan'] = $stmt->affected_rows > 0
        ? "Data berhasil dihapus."
        : "Data tidak ditemukan.";
}

header("Location: dashboard.php");
exit;
