<?php
session_start();
require_once __DIR__ . "/../../repositories/suppliers_repository.php";

$supplier = getSupplier($_GET['id'] ?? 0);

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);

$data = $old ?: $supplier;

$pageTitle = "Edit Supplier";
$pageSubtitle = "Ubah data supplier";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Sistem Informasi Koperasi Sekolah</title>
    <link rel="stylesheet" href="../../styles/suppliers/edit.css">
</head>

<body>
    <div class="layout">
        <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

        <main class="main">
            <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

            <div class="content">
                <form action="../../actions/suppliers/update.php" method="POST" class="card">
                    <input type="hidden" name="id" value="<?= (int) $supplier['supplier_id'] ?>">

                    <div class="form-group">
                        <label for="supplier_name">Nama Supplier</label>
                        <input type="text" id="supplier_name" name="supplier_name"
                            value="<?= htmlspecialchars($data['supplier_name'] ?? '') ?>" required>
                        <?php if (isset($errors['supplier_name'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['supplier_name']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="contact_person">Kontak Person</label>
                        <input type="text" id="contact_person" name="contact_person"
                            value="<?= htmlspecialchars($data['contact_person'] ?? '') ?>" required>
                        <?php if (isset($errors['contact_person'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['contact_person']) ?></p>
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
                        <button type="submit" name="update" class="btn btn-primary">Perbarui Supplier</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>