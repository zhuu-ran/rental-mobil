<?php
// Aktifkan session (kalau belum aktif)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kalau belum login, kembali ke halaman login
function periksaLogin() {
    if (!isset($_SESSION['id'])) {
        $_SESSION['login_error'] = 'Silakan login terlebih dahulu.';
        header('Location: index.php');
        exit;
    }
}

// Mengubah simbol HTML jadi teks biasa (aman dari script berbahaya)
function aman($teks) {
    return htmlspecialchars((string) $teks, ENT_QUOTES, 'UTF-8');
}
