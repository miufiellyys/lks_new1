<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
$success = $_SESSION['success'] ?? null;
unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['success']);

$pageTitle = "Login Pengguna";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Sistem Informasi Koperasi Sekolah</title>
    <link rel="stylesheet" href="../../styles/base.css">
    <link rel="stylesheet" href="../../styles/auth/login.css">
</head>

<body class="center-page">
    <div class="card auth-card">
        <h2 class="text-center" style="margin-bottom: 8px;">Masuk Akun</h2>
        <p class="text-muted text-center mb-4">Sistem Informasi Koperasi Sekolah</p>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <?php if (isset($errors['login'])): ?>
            <div class="alert alert-error"><?= htmlspecialchars($errors['login']) ?></div>
        <?php endif; ?>

        <form action="../../actions/auth/login.php" method="POST">
            <div class="form-group" style="margin-bottom: 16px;">
                <label for="email" style="display: block; margin-bottom: 6px; font-weight: 600;">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                    placeholder="nama@email.com"
                    style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: 6px;" required>
                <?php if (isset($errors['email'])): ?>
                    <p class="error-text" style="color: var(--red); font-size: 13px; margin-top: 4px;">
                        <?= htmlspecialchars($errors['email']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group" style="margin-bottom: 24px;">
                <label for="password" style="display: block; margin-bottom: 6px; font-weight: 600;">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi"
                    style="width: 100%; padding: 10px; border: 1px solid var(--line); border-radius: 6px;" required>
                <?php if (isset($errors['password'])): ?>
                    <p class="error-text" style="color: var(--red); font-size: 13px; margin-top: 4px;">
                        <?= htmlspecialchars($errors['password']) ?></p>
                <?php endif; ?>
            </div>

            <button type="submit" name="login" class="btn btn-primary btn-block">Masuk</button>
        </form>

        <p class="text-center text-muted" style="margin-top: 20px; font-size: 14px;">
            Belum punya akun? <a href="register.php" style="color: var(--primary-color); font-weight: 600;">Daftar
                disini</a>
        </p>
    </div>
</body>

</html>