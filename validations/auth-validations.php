<?php
require_once __DIR__ . "/../repositories/users_repository.php";

function getRegisterRequest($request)
{
    return [
        'name' => trim(htmlspecialchars($request['name'] ?? '')),
        'email' => trim(htmlspecialchars($request['email'] ?? '')),
        'password' => $request['password'] ?? '',
        'password_confirmation' => $request['password_confirmation'] ?? '',
    ];
}

function validateRegister($request)
{
    $errors = [];

    if ($request['name'] === '') {
        $errors['name'] = "Nama wajib diisi";
    } elseif (mb_strlen($request['name']) > 100) {
        $errors['name'] = "Nama maksimal 100 karakter";
    }

    if ($request['email'] === '') {
        $errors['email'] = "Email wajib diisi";
    } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid";
    } elseif (isEmailTaken($request['email'])) {
        $errors['email'] = "Email sudah terdaftar";
    }

    if ($request['password'] === '') {
        $errors['password'] = "Kata sandi wajib diisi";
    } elseif (mb_strlen($request['password']) < 8) {
        $errors['password'] = "Kata sandi minimal 8 karakter";
    }

    if ($request['password_confirmation'] !== $request['password']) {
        $errors['password_confirmation'] = "Konfirmasi kata sandi tidak cocok";
    }

    return $errors;
}

function getLoginRequest($request)
{
    return [
        'email' => trim(htmlspecialchars($request['email'] ?? '')),
        'password' => $request['password'] ?? ''
    ];
}

function validateLogin($request)
{
    $errors = [];

    if ($request['email'] === '') {
        $errors['email'] = "Email wajib diisi";
    }

    if ($request['password'] === '') {
        $errors['password'] = "Kata sandi wajib diisi";
    }

    return $errors;
}