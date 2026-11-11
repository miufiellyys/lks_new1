<?php
require_once __DIR__ . "/../config/database.php";

function getProducts()
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM products ORDER BY product_id DESC");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getProduct($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = :id");
    $stmt->execute(['id' => $id]);
    $product = $stmt->fetch();

    if (!$product) {
        header("Location: ../../pages/products/index.php");
        exit;
    }

    return $product;
}

function isProductCodeTaken($code, $ignoreId = 0)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(product_id) FROM products WHERE product_code = :code AND product_id != :id");
    $stmt->execute([
        'code' => $code,
        'id' => (int) $ignoreId
    ]);
    return $stmt->fetchColumn() > 0;
}