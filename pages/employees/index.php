<?php
session_start();
require_once __DIR__ . "/../../repositories/employees_repository.php";

$employees = getEmployees();

$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? null;
unset($_SESSION['errors'], $_SESSION['success']);

$pageTitle = "Data Pegawai";
$pageSubtitle = "Kelola daftar pengelola dan pegawai koperasi";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Sistem Informasi Koperasi Sekolah</title>
    <link rel="stylesheet" href="../../styles/employees/index.css">
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
                    <a href="create.php" class="btn btn-primary">Tambah Pegawai</a>
                </div>

                <div class="table-wrap card">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Jabatan</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($employees)): ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Data pegawai belum tersedia</td>
                                </tr>
                            <?php endif; ?>

                            <?php foreach ($employees as $i => $e): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= htmlspecialchars($e['nip']) ?></td>
                                    <td><?= htmlspecialchars($e['name']) ?></td>
                                    <td><?= htmlspecialchars($e['position']) ?></td>
                                    <td><?= htmlspecialchars($e['phone']) ?></td>
                                    <td><?= htmlspecialchars($e['address']) ?></td>
                                    <td class="actions">
                                        <a href="edit.php?id=<?= (int) $e['employee_id'] ?>"
                                            class="btn btn-outline btn-sm">Edit</a>
                                        <a href="../../actions/employees/destroy.php?id=<?= (int) $e['employee_id'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus pegawai ini?')">Hapus</a>
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