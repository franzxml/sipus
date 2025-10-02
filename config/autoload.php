<?php
// config/autoload.php

// Composer Autoload jika tersedia
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

// Autoload sederhana dengan PSR-4 manual
spl_autoload_register(function ($class) {
    // Namespace utama proyek
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';

    // cek apakah class menggunakan prefix
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Ambil nama class relatif
    $relative_class = substr($class, $len);

    // Ganti backslash dengan slash untuk path
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Jika file ada, require
    if (file_exists($file)) {
        require $file;
    }
});