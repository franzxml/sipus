<?php
// public/index.php

// Aktifkan session untuk autentikasi user
session_start();

// Error reporting sederhana (hindari menampilkan detail sensitif di production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Autoload file composer atau manual
require_once __DIR__ . '/../config/autoload.php';

use App\Controllers\BookController;
use App\Controllers\MemberController;
use App\Controllers\LoanController;
use App\Controllers\AuthController;

// Routing sangat sederhana berbasis query string
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'index';

try {
    switch ($page) {
        case 'books':
            $controller = new BookController();
            break;
        case 'members':
            $controller = new MemberController();
            break;
        case 'loans':
            $controller = new LoanController();
            break;
        case 'auth':
            $controller = new AuthController();
            break;
        default:
            echo "<h1>Selamat Datang di SiPus</h1>";
            echo "<p>Sistem Informasi Perpustakaan sederhana berbasis PHP OOP.</p>";
            exit;
    }

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        throw new Exception("Aksi tidak ditemukan: $action");
    }
} catch (Exception $e) {
    echo "<h3>Terjadi Kesalahan</h3>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}