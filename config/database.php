<?php
// config/database.php

namespace App\Config;

use PDO;
use PDOException;

final class Database
{
    private static ?PDO $connection = null;

    // Gunakan static method agar bisa dipanggil tanpa membuat objek
    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            try {
                $host = 'localhost';
                $db   = 'sipus';
                $user = 'root';
                $pass = '';
                $charset = 'utf8mb4';

                $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                self::$connection = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                die('Koneksi database gagal: ' . $e->getMessage());
            }
        }
        return self::$connection;
    }
}