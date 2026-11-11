<?php
$title = "Beranda - Sistem Informasi Koperasi Sekolah";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
    <?php require_once __DIR__ . "/components/landing/header.php" ?>

    <section class="hero">
        <h1>Sistem Informasi Koperasi Sekolah</h1>
        <p>Platform terpadu untuk pencatatan produk, pengelolaan pegawai, dan manajemen pemasok secara real-time.</p>
        <div class="hero-cta">
            <a href="pages/auth/login.php" class="btn btn-primary">Masuk ke Akun</a>
            <a href="pages/products/index.php" class="btn btn-outline">Lihat Daftar</a>
        </div>
    </section>

    <section class="features-wrapper">
        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">📦</div>
                <h3>Manajemen Produk</h3>
                <p>Admin dapat menambah, mengubah, dan mengelola detail produk koperasi.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <h3>Manajemen Pegawai</h3>
                <p>Admin dapat menambah, mengubah, dan mengelola detail pegawai.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🚛</div>
                <h3>Manajemen Pemasok</h3>
                <p>Admin dapat menambah, mengubah, dan mengelola detail pemasok.</p>
            </div>
        </div>
    </section>
    
    <?php require_once __DIR__ . "/components/landing/footer.php" ?>
</body>
</html>