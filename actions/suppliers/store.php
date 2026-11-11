<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/supplier-validations.php";

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();

        $request = getSupplierRequest($_POST);
        $errors = validateSupplier($request);

        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $request;
            header('Location: ../../pages/suppliers/create.php');
            exit;
        }

        $query = "INSERT INTO suppliers (supplier_name, contact_person, phone, address) 
                  VALUES (:supplier_name, :contact_person, :phone, :address)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'supplier_name' => $request['supplier_name'],
            'contact_person' => $request['contact_person'],
            'phone' => $request['phone'],
            'address' => $request['address']
        ]);

        $pdo->commit();
        $_SESSION['success'] = "Supplier berhasil ditambahkan";
        header('Location: ../../pages/suppliers/index.php');
        exit;
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw $e;
    }
}