<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/employee-validations.php";

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();

        $request = getEmployeeRequest($_POST);
        $errors = validateEmployee($request, $request['id']);

        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $request;
            header('Location: ../../pages/employees/edit.php?id=' . urlencode($request['id']));
            exit;
        }

        $query = "UPDATE employees SET 
                    nip      = :nip,
                    name     = :name,
                    position = :position,
                    phone    = :phone,
                    address  = :address
                  WHERE employee_id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'nip' => $request['nip'],
            'name' => $request['name'],
            'position' => $request['position'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'id' => $request['id']
        ]);

        $pdo->commit();
        $_SESSION['success'] = "Data pegawai berhasil diperbarui";
        header('Location: ../../pages/employees/index.php');
        exit;
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw $e;
    }
}