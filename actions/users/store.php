<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/user-validations.php";

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();

        $request = getUserRequest($_POST);
        $errors = validateUser($request);

        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            unset($request['password']);
            $_SESSION['old'] = $request;
            header('Location: ../../pages/users/create.php');
            exit;
        }

        $query = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => password_hash($request['password'], PASSWORD_BCRYPT),
            'role' => $request['role']
        ]);

        $pdo->commit();
        $_SESSION['success'] = "Pengguna baru berhasil ditambahkan";
        header('Location: ../../pages/users/index.php');
        exit;
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw $e;
    }
}