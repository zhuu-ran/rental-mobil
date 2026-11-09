<?php
session_start();

// Sudah login: langsung ke dashboard
if (isset($_SESSION['id'])) {
    header('Location: dashboard.php');
    exit;
}

// Ambil pesan error (kalau ada) lalu hapus agar tampil sekali
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Rental Mobil</title>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow-sm" style="width: 380px;">
        <div class="card-body p-4">
            <h1 class="h4 text-center mb-4">Login Rental Mobil</h1>

            <?php if ($error !== ''): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <!-- Data dikirim ke validasi.php lewat POST -->
            <form method="post" action="validasi.php">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>
        </div>
    </div>
</main>
</body>
</html>
