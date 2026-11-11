<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);

$pageTitle = "Daftar Akun Baru";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Sistem Informasi Koperasi Sekolah</title>
    <link rel="stylesheet" href="../../styles/base.css">
    <link rel="stylesheet" href="../../styles/auth/register.css">
</head>

<body class="center-page">
    <div class="card auth-card">
        <h2 class="text-center">Daftar Akun</h2>
        <p class="text-muted text-center mb-4">Sistem Informasi Koperasi Sekolah</p>

        <form action="../../actions/auth/register.php" method="POST">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" required>
                <?php if (isset($errors['name'])): ?>
                    <p class="error-text"><?= htmlspecialchars($errors['name']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                    required>
                <?php if (isset($errors['email'])): ?>
                    <p class="error-text"><?= htmlspecialchars($errors['email']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" required>
                <?php if (isset($errors['password'])): ?>
                    <p class="error-text"><?= htmlspecialchars($errors['password']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                <?php if (isset($errors['password_confirmation'])): ?>
                    <p class="error-text"><?= htmlspecialchars($errors['password_confirmation']) ?></p>
                <?php endif; ?>
            </div>

            <button type="submit" name="register" class="btn btn-primary btn-block">Daftar</button>
        </form>

        <p class="text-center text-muted auth-footer">
            Sudah punya akun? <a href="login.php">Masuk disini</a>
        </p>
    </div>
</body>

</html>