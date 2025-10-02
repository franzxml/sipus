<?php
// app/Abstracts/BaseModel.php

namespace App\Abstracts;

use App\Config\Database;
use PDO;

abstract class BaseModel
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // Method abstrak CRUD dasar
    abstract public function create(array $data): bool;
    abstract public function read(int $id): ?array;
    abstract public function update(int $id, array $data): bool;
    abstract public function delete(int $id): bool;

    // Method umum untuk semua model
    protected function fetchAll(string $table): array
    {
        $stmt = $this->db->query("SELECT * FROM {$table}");
        return $stmt->fetchAll();
    }
}