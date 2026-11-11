<?php
session_start();
require_once __DIR__ . "/../../repositories/users_repository.php";

$users = getUsers();

$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? null;
unset($_SESSION['errors'], $_SESSION['success']);

$pageTitle = "Data Pengguna";
$pageSubtitle = "Kelola akun pengguna dan hak akses aplikasi";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Sistem Informasi Koperasi Sekolah</title>
    <link rel="stylesheet" href="../../styles/users/index.css">
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
                    <a href="create.php" class="btn btn-primary">Tambah User</a>
                </div>

                <div class="table-wrap card">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Tgl Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($users)): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Data pengguna belum tersedia</td>
                                </tr>
                            <?php endif; ?>

                            <?php foreach ($users as $i => $u): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= htmlspecialchars($u['name']) ?></td>
                                    <td><?= htmlspecialchars($u['email']) ?></td>
                                    <td><span class="badge"><?= htmlspecialchars($u['role']) ?></span></td>
                                    <td><?= htmlspecialchars($u['created_at']) ?></td>
                                    <td class="actions">
                                        <a href="edit.php?id=<?= (int) $u['id'] ?>" class="btn btn-outline btn-sm">Edit</a>
                                        <a href="../../actions/users/destroy.php?id=<?= (int) $u['id'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus pengguna ini?')">Hapus</a>
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