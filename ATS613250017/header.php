<?php
require_once "fungsi.php";
periksaLogin(); // semua halaman yang memakai header wajib login
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental Mobil</title>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">Rental Mobil</a>
        <div class="d-flex align-items-center gap-3">
            <a href="dashboard.php" class="text-white text-decoration-none">Home</a>
            <a href="tambah.php" class="text-white text-decoration-none">Tambah</a>
            <span class="text-white"><?= aman($_SESSION['nama']) ?></span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>
<main class="container py-4">
