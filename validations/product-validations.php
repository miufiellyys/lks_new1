<?php
require_once __DIR__ . "/../repositories/products_repository.php";

function getProductRequest($request)
{
    return [
        'id' => trim(htmlspecialchars($request['id'] ?? '')),
        'product_code' => trim(htmlspecialchars($request['product_code'] ?? '')),
        'product_name' => trim(htmlspecialchars($request['product_name'] ?? '')),
        'category' => trim(htmlspecialchars($request['category'] ?? '')),
        'unit' => trim(htmlspecialchars($request['unit'] ?? '')),
        'price' => trim(htmlspecialchars($request['price'] ?? '')),
        'stock' => trim(htmlspecialchars($request['stock'] ?? '')),
        'entry_date' => trim(htmlspecialchars($request['entry_date'] ?? '')),
        'description' => trim(htmlspecialchars($request['description'] ?? '')),
    ];
}

function validateProduct($request, $ignoreId = 0)
{
    $errors = [];

    if ($request['product_code'] === '') {
        $errors['product_code'] = "Kode produk wajib diisi";
    } elseif (mb_strlen($request['product_code']) > 20) {
        $errors['product_code'] = "Kode produk maksimal 20 karakter";
    } elseif (isProductCodeTaken($request['product_code'], $ignoreId)) {
        $errors['product_code'] = "Kode produk sudah digunakan";
    }

    if ($request['product_name'] === '') {
        $errors['product_name'] = "Nama produk wajib diisi";
    } elseif (mb_strlen($request['product_name']) > 150) {
        $errors['product_name'] = "Nama produk maksimal 150 karakter";
    }

    if ($request['category'] === '') {
        $errors['category'] = "Kategori wajib dipilih";
    }

    if ($request['unit'] === '') {
        $errors['unit'] = "Satuan unit wajib dipilih";
    }

    if ($request['price'] === '' || !is_numeric($request['price']) || $request['price'] < 0) {
        $errors['price'] = "Harga produk tidak valid";
    }

    if ($request['stock'] === '' || !filter_var($request['stock'], FILTER_VALIDATE_INT) || $request['stock'] < 0) {
        $errors['stock'] = "Jumlah stok harus berupa angka minimal 0";
    }

    if ($request['entry_date'] === '') {
        $errors['entry_date'] = "Tanggal masuk wajib diisi";
    }

    return $errors;
}