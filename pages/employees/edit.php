<?php
session_start();
require_once __DIR__ . "/../../repositories/employees_repository.php";

$employee = getEmployee($_GET['id'] ?? 0);

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);

$data = $old ?: $employee;

$pageTitle = "Edit Pegawai";
$pageSubtitle = "Ubah data pegawai";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Sistem Informasi Koperasi Sekolah</title>
    <link rel="stylesheet" href="../../styles/employees/edit.css">
</head>

<body>
    <div class="layout">
        <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

        <main class="main">
            <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

            <div class="content">
                <form action="../../actions/employees/update.php" method="POST" class="card">
                    <input type="hidden" name="id" value="<?= (int) $employee['employee_id'] ?>">

                    <div class="form-group">
                        <label for="nip">NIP / ID Pegawai</label>
                        <input type="text" id="nip" name="nip" value="<?= htmlspecialchars($data['nip'] ?? '') ?>"
                            required>
                        <?php if (isset($errors['nip'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['nip']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="name">Nama Pegawai</label>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($data['name'] ?? '') ?>"
                            required>
                        <?php if (isset($errors['name'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['name']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="position">Jabatan</label>
                        <input type="text" id="position" name="position"
                            value="<?= htmlspecialchars($data['position'] ?? '') ?>" required>
                        <?php if (isset($errors['position'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['position']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($data['phone'] ?? '') ?>"
                            required>
                        <?php if (isset($errors['phone'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['phone']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea id="address" name="address" rows="3"
                            required><?= htmlspecialchars($data['address'] ?? '') ?></textarea>
                        <?php if (isset($errors['address'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['address']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-actions">
                        <a href="index.php" class="btn btn-outline">Batal</a>
                        <button type="submit" name="update" class="btn btn-primary">Perbarui Pegawai</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>