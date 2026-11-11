<?php
require_once __DIR__ . "/../config/database.php";

function getSuppliers()
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM suppliers ORDER BY supplier_id DESC");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getSupplier($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM suppliers WHERE supplier_id = :id");
    $stmt->execute(['id' => $id]);
    $supplier = $stmt->fetch();

    if (!$supplier) {
        header("Location: ../../pages/suppliers/index.php");
        exit;
    }

    return $supplier;
}

function isSupplierPhoneTaken($phone, $ignoreId = 0)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(supplier_id) FROM suppliers WHERE phone = :phone AND supplier_id != :id");
    $stmt->execute([
        'phone' => $phone,
        'id' => (int) $ignoreId
    ]);
    return $stmt->fetchColumn() > 0;
}