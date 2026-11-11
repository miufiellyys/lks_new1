<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);

$pageTitle = "Tambah Supplier";
$pageSubtitle = "Lengkapi data supplier baru";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Sistem Informasi Koperasi Sekolah</title>
    <link rel="stylesheet" href="../../styles/suppliers/create.css">
</head>

<body>
    <div class="layout">
        <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

        <main class="main">
            <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

            <div class="content">
                <form action="../../actions/suppliers/store.php" method="POST" class="card">
                    <div class="form-group">
                        <label for="supplier_name">Nama Supplier</label>
                        <input type="text" id="supplier_name" name="supplier_name"
                            value="<?= htmlspecialchars($old['supplier_name'] ?? '') ?>"
                            placeholder="Contoh: PT Sumber Makmur" required>
                        <?php if (isset($errors['supplier_name'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['supplier_name']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="contact_person">Kontak Person</label>
                        <input type="text" id="contact_person" name="contact_person"
                            value="<?= htmlspecialchars($old['contact_person'] ?? '') ?>"
                            placeholder="Nama penanggung jawab" required>
                        <?php if (isset($errors['contact_person'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['contact_person']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($old['phone'] ?? '') ?>"
                            placeholder="08xxxxxxxxxx" required>
                        <?php if (isset($errors['phone'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['phone']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea id="address" name="address" rows="3" placeholder="Alamat lengkap supplier"
                            required><?= htmlspecialchars($old['address'] ?? '') ?></textarea>
                        <?php if (isset($errors['address'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['address']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-actions">
                        <a href="index.php" class="btn btn-outline">Batal</a>
                        <button type="submit" name="store" class="btn btn-primary">Simpan Supplier</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>