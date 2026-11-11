<?php
session_start();
require_once __DIR__ . "/../../repositories/users_repository.php";

$user = getUser($_GET['id'] ?? 0);

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);

$data = $old ?: $user;

$pageTitle = "Edit Pengguna";
$pageSubtitle = "Ubah data akun pengguna";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Sistem Informasi Koperasi Sekolah</title>
    <link rel="stylesheet" href="../../styles/users/edit.css">
</head>

<body>
    <div class="layout">
        <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

        <main class="main">
            <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

            <div class="content">
                <form action="../../actions/users/update.php" method="POST" class="card">
                    <input type="hidden" name="id" value="<?= (int) $user['id'] ?>">

                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($data['name'] ?? '') ?>"
                            required>
                        <?php if (isset($errors['name'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['name']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" id="email" name="email"
                            value="<?= htmlspecialchars($data['email'] ?? '') ?>" required>
                        <?php if (isset($errors['email'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['email']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="password">Kata Sandi Baru (Opsional)</label>
                        <input type="password" id="password" name="password"
                            placeholder="Kosongkan jika tidak ingin mengubah kata sandi">
                        <?php if (isset($errors['password'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['password']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="role">Role / Peran</label>
                        <select id="role" name="role" required>
                            <option value="member" <?= ($data['role'] ?? '') === 'member' ? 'selected' : '' ?>>Member
                            </option>
                            <option value="admin" <?= ($data['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                        <?php if (isset($errors['role'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['role']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-actions">
                        <a href="index.php" class="btn btn-outline">Batal</a>
                        <button type="submit" name="update" class="btn btn-primary">Perbarui User</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>