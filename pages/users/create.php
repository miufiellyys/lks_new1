<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);

$pageTitle = "Tambah Pengguna";
$pageSubtitle = "Lengkapi data akun baru";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Sistem Informasi Koperasi Sekolah</title>
    <link rel="stylesheet" href="../../styles/users/create.css">
</head>

<body>
    <div class="layout">
        <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

        <main class="main">
            <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

            <div class="content">
                <form action="../../actions/users/store.php" method="POST" class="card">
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>"
                            placeholder="Masukkan nama lengkap" required>
                        <?php if (isset($errors['name'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['name']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                            placeholder="nama@email.com" required>
                        <?php if (isset($errors['email'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['email']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required>
                        <?php if (isset($errors['password'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['password']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="role">Role / Peran</label>
                        <select id="role" name="role" required>
                            <option value="member" <?= ($old['role'] ?? 'member') === 'member' ? 'selected' : '' ?>>Member
                            </option>
                            <option value="admin" <?= ($old['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                        <?php if (isset($errors['role'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['role']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-actions">
                        <a href="index.php" class="btn btn-outline">Batal</a>
                        <button type="submit" name="store" class="btn btn-primary">Simpan User</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>