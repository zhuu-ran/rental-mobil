<?php
session_start();
include "koneksi.php";

$email    = $_POST['email'] ?? '';
$password = md5($_POST['password'] ?? ''); // password di database disimpan dalam md5

// Cocokkan email + password, dan akun harus aktif (aktive = 1)
$stmt = $koneksi->prepare(
    "SELECT id, email, nama FROM member_017
     WHERE email = ? AND password = ? AND aktive = '1'"
);
$stmt->bind_param("ss", $email, $password); // "ss" = dua string
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc(); // false kalau tidak ada yang cocok

if ($user) {
    session_regenerate_id(true); // ganti ID session demi keamanan
    // Simpan id, email, dan nama di session
    $_SESSION['id']    = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['nama']  = $user['nama'];
    header('Location: dashboard.php');
} else {
    $_SESSION['login_error'] = 'Email/password salah atau akun tidak aktif.';
    header('Location: index.php');
}
exit;
