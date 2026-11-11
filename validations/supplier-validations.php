<?php
require_once __DIR__ . "/../repositories/suppliers_repository.php";

function getSupplierRequest($request)
{
    return [
        'id' => trim(htmlspecialchars($request['id'] ?? '')),
        'supplier_name' => trim(htmlspecialchars($request['supplier_name'] ?? '')),
        'contact_person' => trim(htmlspecialchars($request['contact_person'] ?? '')),
        'phone' => trim(htmlspecialchars($request['phone'] ?? '')),
        'address' => trim(htmlspecialchars($request['address'] ?? '')),
    ];
}

function validateSupplier($request, $ignoreId = 0)
{
    $errors = [];

    if ($request['supplier_name'] === '') {
        $errors['supplier_name'] = "Nama supplier wajib diisi";
    } elseif (mb_strlen($request['supplier_name']) > 150) {
        $errors['supplier_name'] = "Nama supplier maksimal 150 karakter";
    }

    if ($request['contact_person'] === '') {
        $errors['contact_person'] = "Nama kontak person wajib diisi";
    }

    if ($request['phone'] === '') {
        $errors['phone'] = "Nomor telepon wajib diisi";
    } elseif (isSupplierPhoneTaken($request['phone'], $ignoreId)) {
        $errors['phone'] = "Nomor telepon sudah terdaftar";
    }

    if ($request['address'] === '') {
        $errors['address'] = "Alamat supplier wajib diisi";
    }

    return $errors;
}