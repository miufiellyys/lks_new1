<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/product-validations.php";

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();

        $request = getProductRequest($_POST);
        $errors = validateProduct($request);

        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $request;
            header('Location: ../../pages/products/create.php');
            exit;
        }

        $query = "INSERT INTO products (product_code, product_name, category, unit, price, stock, entry_date, description) 
                  VALUES (:product_code, :product_name, :category, :unit, :price, :stock, :entry_date, :description)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'product_code' => $request['product_code'],
            'product_name' => $request['product_name'],
            'category' => $request['category'],
            'unit' => $request['unit'],
            'price' => $request['price'],
            'stock' => $request['stock'],
            'entry_date' => $request['entry_date'],
            'description' => $request['description']
        ]);

        $pdo->commit();
        $_SESSION['success'] = "Produk berhasil ditambahkan";
        header('Location: ../../pages/products/index.php');
        exit;
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw $e;
    }
}