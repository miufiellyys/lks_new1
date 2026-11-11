<?php
session_start();
require_once __DIR__ . "/../../repositories/products_repository.php";

$product = getProduct($_GET['id'] ?? 0);

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);

$data = $old ?: $product;

$pageTitle = "Edit Produk";
$pageSubtitle = "Ubah data produk koperasi";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Sistem Informasi Koperasi Sekolah</title>
    <link rel="stylesheet" href="../../styles/products/edit.css">
</head>

<body>
    <div class="layout">
        <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

        <main class="main">
            <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

            <div class="content">
                <form action="../../actions/products/update.php" method="POST" class="card">
                    <input type="hidden" name="id" value="<?= (int) $product['product_id'] ?>">

                    <div class="form-group">
                        <label for="product_code">Kode Produk</label>
                        <input type="text" id="product_code" name="product_code"
                            value="<?= htmlspecialchars($data['product_code'] ?? '') ?>" required>
                        <?php if (isset($errors['product_code'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['product_code']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="product_name">Nama Produk</label>
                        <input type="text" id="product_name" name="product_name"
                            value="<?= htmlspecialchars($data['product_name'] ?? '') ?>" required>
                        <?php if (isset($errors['product_name'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['product_name']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select id="category" name="category" required>
                            <option value="Food" <?= ($data['category'] ?? '') === 'Food' ? 'selected' : '' ?>>Food
                            </option>
                            <option value="Drink" <?= ($data['category'] ?? '') === 'Drink' ? 'selected' : '' ?>>Drink
                            </option>
                            <option value="Stationery" <?= ($data['category'] ?? '') === 'Stationery' ? 'selected' : '' ?>>
                                Stationery</option>
                            <option value="Uniform" <?= ($data['category'] ?? '') === 'Uniform' ? 'selected' : '' ?>>
                                Uniform</option>
                        </select>
                        <?php if (isset($errors['category'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['category']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Satuan (Unit)</label>
                        <div class="radio-group">
                            <label class="radio-item">
                                <input type="radio" name="unit" value="Pcs" <?= ($data['unit'] ?? '') === 'Pcs' ? 'checked' : '' ?>>
                                <span>Pcs</span>
                            </label>
                            <label class="radio-item">
                                <input type="radio" name="unit" value="Pack" <?= ($data['unit'] ?? '') === 'Pack' ? 'checked' : '' ?>>
                                <span>Pack</span>
                            </label>
                            <label class="radio-item">
                                <input type="radio" name="unit" value="Bottle" <?= ($data['unit'] ?? '') === 'Bottle' ? 'checked' : '' ?>>
                                <span>Bottle</span>
                            </label>
                        </div>
                        <?php if (isset($errors['unit'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['unit']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="price">Harga (Rp)</label>
                        <input type="number" id="price" name="price" step="0.01"
                            value="<?= htmlspecialchars($data['price'] ?? '') ?>" required>
                        <?php if (isset($errors['price'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['price']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <input type="number" id="stock" name="stock"
                            value="<?= htmlspecialchars($data['stock'] ?? '') ?>" required>
                        <?php if (isset($errors['stock'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['stock']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="entry_date">Tanggal Masuk</label>
                        <input type="date" id="entry_date" name="entry_date"
                            value="<?= htmlspecialchars($data['entry_date'] ?? '') ?>" required>
                        <?php if (isset($errors['entry_date'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['entry_date']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi (opsional)</label>
                        <textarea id="description" name="description"
                            rows="3"><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
                        <?php if (isset($errors['description'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['description']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-actions">
                        <a href="index.php" class="btn btn-outline">Batal</a>
                        <button type="submit" name="update" class="btn btn-primary">Perbarui Produk</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>