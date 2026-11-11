<?php
session_start();
require_once __DIR__ . "/../../repositories/products_repository.php";

$products = getProducts();

$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? null;
unset($_SESSION['errors'], $_SESSION['success']);

$pageTitle = "Data Produk";
$pageSubtitle = "Kelola daftar produk koperasi sekolah";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Sistem Informasi Koperasi Sekolah</title>
    <link rel="stylesheet" href="../../styles/products/index.css">
</head>

<body>
    <div class="layout">
        <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

        <main class="main">
            <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

            <div class="content">
                <?php if ($success): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                <?php endif; ?>

                <div class="toolbar mb-3">
                    <a href="create.php" class="btn btn-primary">Tambah Produk</a>
                </div>

                <div class="table-wrap card">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Tgl Masuk</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($products)): ?>
                                <tr>
                                    <td colspan="10" class="text-center text-muted">Data produk belum tersedia</td>
                                </tr>
                            <?php endif; ?>

                            <?php foreach ($products as $i => $p): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= htmlspecialchars($p['product_code']) ?></td>
                                    <td><?= htmlspecialchars($p['product_name']) ?></td>
                                    <td><?= htmlspecialchars($p['category']) ?></td>
                                    <td><?= htmlspecialchars($p['unit']) ?></td>
                                    <td class="num">Rp <?= number_format((float) $p['price'], 0, ',', '.') ?></td>
                                    <td class="num"><?= (int) $p['stock'] ?></td>
                                    <td><?= htmlspecialchars($p['entry_date']) ?></td>
                                    <td><?= htmlspecialchars($p['description'] ?? '') ?></td>
                                    <td class="actions">
                                        <a href="edit.php?id=<?= (int) $p['product_id'] ?>"
                                            class="btn btn-outline btn-sm">Edit</a>
                                        <a href="../../actions/products/destroy.php?id=<?= (int) $p['product_id'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>