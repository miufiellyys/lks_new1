<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/supplier-validations.php";

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();

        $request = getSupplierRequest($_POST);
        $errors = validateSupplier($request, $request['id']);

        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $request;
            header('Location: ../../pages/suppliers/edit.php?id=' . urlencode($request['id']));
            exit;
        }

        $query = "UPDATE suppliers SET 
                    supplier_name  = :supplier_name,
                    contact_person = :contact_person,
                    phone          = :phone,
                    address        = :address
                  WHERE supplier_id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'supplier_name' => $request['supplier_name'],
            'contact_person' => $request['contact_person'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'id' => $request['id']
        ]);

        $pdo->commit();
        $_SESSION['success'] = "Data supplier berhasil diperbarui";
        header('Location: ../../pages/suppliers/index.php');
        exit;
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw $e;
    }
}