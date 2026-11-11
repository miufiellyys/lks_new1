<?php
require_once __DIR__ . "/../../middleware/auth.php";
requireAuth();
http_response_code(403);

$pageTitle = "Akses Ditolak";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?> - Sistem Informasi Koperasi Sekolah</title>
  <link rel="stylesheet" href="../../styles/base.css">
</head>

<body class="center-page">
  <div class="card text-center auth-card">
    <h1 class="big-code">403</h1>
    <h2>Akses Ditolak</h2>
    <p class="text-muted">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
    <br>
    <a href="../products/index.php" class="btn btn-primary btn-block">Kembali ke Beranda</a>
  </div>
</body>

</html>