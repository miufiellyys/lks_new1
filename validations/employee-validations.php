<?php
require_once __DIR__ . "/../repositories/employees_repository.php";

function getEmployeeRequest($request)
{
    return [
        'id' => trim(htmlspecialchars($request['id'] ?? '')),
        'nip' => trim(htmlspecialchars($request['nip'] ?? '')),
        'name' => trim(htmlspecialchars($request['name'] ?? '')),
        'position' => trim(htmlspecialchars($request['position'] ?? '')),
        'phone' => trim(htmlspecialchars($request['phone'] ?? '')),
        'address' => trim(htmlspecialchars($request['address'] ?? '')),
    ];
}

function validateEmployee($request, $ignoreId = 0)
{
    $errors = [];

    if ($request['nip'] === '') {
        $errors['nip'] = "NIP pegawai wajib diisi";
    } elseif (mb_strlen($request['nip']) > 30) {
        $errors['nip'] = "NIP maksimal 30 karakter";
    } elseif (isNipTaken($request['nip'], $ignoreId)) {
        $errors['nip'] = "NIP sudah terdaftar";
    }

    if ($request['name'] === '') {
        $errors['name'] = "Nama pegawai wajib diisi";
    } elseif (mb_strlen($request['name']) > 150) {
        $errors['name'] = "Nama pegawai maksimal 150 karakter";
    }

    if ($request['position'] === '') {
        $errors['position'] = "Jabatan wajib diisi";
    }

    if ($request['phone'] === '') {
        $errors['phone'] = "Nomor telepon wajib diisi";
    }

    if ($request['address'] === '') {
        $errors['address'] = "Alamat wajib diisi";
    }

    return $errors;
}