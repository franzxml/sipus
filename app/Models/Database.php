<?php
// app/Models/Database.php

namespace App\Models;

use App\Config\Database as ConfigDatabase;
use PDO;

// Wrapper tambahan agar model bisa menggunakan dependency injection lebih fleksibel
class Database
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = ConfigDatabase::getConnection();
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}