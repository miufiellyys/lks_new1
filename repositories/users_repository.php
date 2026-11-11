<?php
require_once __DIR__ . "/../config/database.php";

function getUsers()
{
    global $pdo;
    $query = "SELECT id, name, email, role, created_at FROM users ORDER BY id DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getUser($id)
{
    global $pdo;
    $query = "SELECT id, name, email, role, created_at FROM users WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => (int)$id]);
    $user = $stmt->fetch();

    if (!$user) {
        header("Location: ../../pages/users/index.php");
        exit;
    }

    return $user;
}

function isEmailTaken($email, $ignoreId = 0)
{
    global $pdo;
    $query = "SELECT COUNT(id) FROM users WHERE email = :email AND id != :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'email' => $email,
        'id' => (int)$ignoreId
    ]);
    return $stmt->fetchColumn() > 0;
}

function getUserByEmail($email)
{
    global $pdo;
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['email' => $email]);
    return $stmt->fetch();
}