<?php
session_start();
require_once __DIR__ . "/../../repositories/suppliers_repository.php";

$suppliers = getSuppliers();

$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? null;
unset($_SESSION['errors'], $_SESSION['success']);

$pageTitle = "Data Supplier";
$pageSubtitle = "Kelola daftar pemasok barang koperasi";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Sistem Informasi Koperasi Sekolah</title>
    <link rel="stylesheet" href="../../styles/suppliers/index.css">
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
                    <a href="create.php" class="btn btn-primary">Tambah Supplier</a>
                </div>

                <div class="table-wrap card">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Supplier</th>
                                <th>Kontak Person</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($suppliers)): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Data supplier belum tersedia</td>
                                </tr>
                            <?php endif; ?>

                            <?php foreach ($suppliers as $i => $s): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= htmlspecialchars($s['supplier_name']) ?></td>
                                    <td><?= htmlspecialchars($s['contact_person']) ?></td>
                                    <td><?= htmlspecialchars($s['phone']) ?></td>
                                    <td><?= htmlspecialchars($s['address']) ?></td>
                                    <td class="actions">
                                        <a href="edit.php?id=<?= (int) $s['supplier_id'] ?>"
                                            class="btn btn-outline btn-sm">Edit</a>
                                        <a href="../../actions/suppliers/destroy.php?id=<?= (int) $s['supplier_id'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus supplier ini?')">Hapus</a>
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