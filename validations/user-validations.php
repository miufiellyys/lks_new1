<?php
require_once __DIR__ . "/../repositories/users_repository.php";

function getUserRequest($request)
{
    return [
        'id' => trim(htmlspecialchars($request['id'] ?? '')),
        'name' => trim(htmlspecialchars($request['name'] ?? '')),
        'email' => trim(htmlspecialchars($request['email'] ?? '')),
        'password' => $request['password'] ?? '',
        'role' => trim(htmlspecialchars($request['role'] ?? 'member')),
    ];
}

function validateUser($request, $ignoreId = 0, $isUpdate = false)
{
    $errors = [];

    if ($request['name'] === '') {
        $errors['name'] = "Nama pengguna wajib diisi";
    } elseif (mb_strlen($request['name']) > 100) {
        $errors['name'] = "Nama maksimal 100 karakter";
    }

    if ($request['email'] === '') {
        $errors['email'] = "Email wajib diisi";
    } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid";
    } elseif (isEmailTaken($request['email'], $ignoreId)) {
        $errors['email'] = "Email sudah terdaftar";
    }

    if (!$isUpdate) {
        if ($request['password'] === '') {
            $errors['password'] = "Kata sandi wajib diisi";
        } elseif (mb_strlen($request['password']) < 8) {
            $errors['password'] = "Kata sandi minimal 8 karakter";
        }
    } else {
        if ($request['password'] !== '' && mb_strlen($request['password']) < 8) {
            $errors['password'] = "Kata sandi minimal 8 karakter";
        }
    }

    if (!in_array($request['role'], ['admin', 'member'])) {
        $errors['role'] = "Role pengguna tidak valid";
    }

    return $errors;
}