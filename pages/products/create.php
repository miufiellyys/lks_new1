<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);

$pageTitle = "Tambah Produk";
$pageSubtitle = "Lengkapi data produk baru";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Sistem Informasi Koperasi Sekolah</title>
    <link rel="stylesheet" href="../../styles/products/create.css">
</head>

<body>
    <div class="layout">
        <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

        <main class="main">
            <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

            <div class="content">
                <form action="../../actions/products/store.php" method="POST" class="card">
                    <div class="form-group">
                        <label for="product_code">Kode Produk</label>
                        <input type="text" id="product_code" name="product_code"
                            value="<?= htmlspecialchars($old['product_code'] ?? '') ?>" placeholder="Contoh: PRD-001"
                            required>
                        <?php if (isset($errors['product_code'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['product_code']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="product_name">Nama Produk</label>
                        <input type="text" id="product_name" name="product_name"
                            value="<?= htmlspecialchars($old['product_name'] ?? '') ?>"
                            placeholder="Masukkan nama produk" required>
                        <?php if (isset($errors['product_name'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['product_name']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select id="category" name="category" required>
                            <option value="" disabled <?= empty($old['category']) ? 'selected' : '' ?>>-- Pilih Kategori
                                --</option>
                            <option value="Food" <?= ($old['category'] ?? '') === 'Food' ? 'selected' : '' ?>>Food</option>
                            <option value="Drink" <?= ($old['category'] ?? '') === 'Drink' ? 'selected' : '' ?>>Drink
                            </option>
                            <option value="Stationery" <?= ($old['category'] ?? '') === 'Stationery' ? 'selected' : '' ?>>
                                Stationery</option>
                            <option value="Uniform" <?= ($old['category'] ?? '') === 'Uniform' ? 'selected' : '' ?>>Uniform
                            </option>
                        </select>
                        <?php if (isset($errors['category'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['category']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Satuan (Unit)</label>
                        <div class="radio-group">
                            <label class="radio-item">
                                <input type="radio" name="unit" value="Pcs" <?= ($old['unit'] ?? 'Pcs') === 'Pcs' ? 'checked' : '' ?>>
                                <span>Pcs</span>
                            </label>
                            <label class="radio-item">
                                <input type="radio" name="unit" value="Pack" <?= ($old['unit'] ?? '') === 'Pack' ? 'checked' : '' ?>>
                                <span>Pack</span>
                            </label>
                            <label class="radio-item">
                                <input type="radio" name="unit" value="Bottle" <?= ($old['unit'] ?? '') === 'Bottle' ? 'checked' : '' ?>>
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
                            value="<?= htmlspecialchars($old['price'] ?? '') ?>" placeholder="Masukkan harga" required>
                        <?php if (isset($errors['price'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['price']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <input type="number" id="stock" name="stock"
                            value="<?= htmlspecialchars($old['stock'] ?? '') ?>" placeholder="Masukkan jumlah stok"
                            required>
                        <?php if (isset($errors['stock'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['stock']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="entry_date">Tanggal Masuk</label>
                        <input type="date" id="entry_date" name="entry_date"
                            value="<?= htmlspecialchars($old['entry_date'] ?? date('Y-m-d')) ?>" required>
                        <?php if (isset($errors['entry_date'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['entry_date']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi (opsional)</label>
                        <textarea id="description" name="description" rows="3"
                            placeholder="Masukkan deskripsi singkat produk"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
                        <?php if (isset($errors['description'])): ?>
                            <p class="error-text"><?= htmlspecialchars($errors['description']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-actions">
                        <a href="index.php" class="btn btn-outline">Batal</a>
                        <button type="submit" name="store" class="btn btn-primary">Simpan Produk</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>