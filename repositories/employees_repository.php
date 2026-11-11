<?php
require_once __DIR__ . "/../config/database.php";

function getEmployees()
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM employees ORDER BY employee_id DESC");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getEmployee($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM employees WHERE employee_id = :id");
    $stmt->execute(['id' => $id]);
    $employee = $stmt->fetch();

    if (!$employee) {
        header("Location: ../../pages/employees/index.php");
        exit;
    }

    return $employee;
}

function isNipTaken($nip, $ignoreId = 0)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(employee_id) FROM employees WHERE nip = :nip AND employee_id != :id");
    $stmt->execute([
        'nip' => $nip,
        'id' => (int) $ignoreId
    ]);
    return $stmt->fetchColumn() > 0;
}