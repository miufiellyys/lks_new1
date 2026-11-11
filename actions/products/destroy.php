<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $pdo->beginTransaction();

        $query = "DELETE FROM products WHERE product_id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $_GET['id']]);

        $pdo->commit();
        $_SESSION['success'] = "Produk berhasil dihapus";
        header('Location: ../../pages/products/index.php');
        exit;
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw $e;
    }
}