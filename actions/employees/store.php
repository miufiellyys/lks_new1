<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/employee-validations.php";

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();

        $request = getEmployeeRequest($_POST);
        $errors = validateEmployee($request);

        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $request;
            header('Location: ../../pages/employees/create.php');
            exit;
        }

        $query = "INSERT INTO employees (nip, name, position, phone, address) 
                  VALUES (:nip, :name, :position, :phone, :address)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'nip' => $request['nip'],
            'name' => $request['name'],
            'position' => $request['position'],
            'phone' => $request['phone'],
            'address' => $request['address']
        ]);

        $pdo->commit();
        $_SESSION['success'] = "Data pegawai berhasil ditambahkan";
        header('Location: ../../pages/employees/index.php');
        exit;
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw $e;
    }
}