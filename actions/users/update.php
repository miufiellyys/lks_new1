<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/user-validations.php";

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();

        $request = getUserRequest($_POST);
        $errors = validateUser($request, $request['id'], true);

        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            unset($request['password']);
            $_SESSION['old'] = $request;
            header('Location: ../../pages/users/edit.php?id=' . urlencode($request['id']));
            exit;
        }

        if ($request['password'] !== '') {
            $query = "UPDATE users SET name = :name, email = :email, password = :password, role = :role WHERE id = :id";
            $params = [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => password_hash($request['password'], PASSWORD_BCRYPT),
                'role' => $request['role'],
                'id' => $request['id']
            ];
        } else {
            $query = "UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id";
            $params = [
                'name' => $request['name'],
                'email' => $request['email'],
                'role' => $request['role'],
                'id' => $request['id']
            ];
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute($params);

        $pdo->commit();
        $_SESSION['success'] = "Data pengguna berhasil diperbarui";
        header('Location: ../../pages/users/index.php');
        exit;
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw $e;
    }
}