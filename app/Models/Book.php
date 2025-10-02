<?php
// app/Models/Book.php

namespace App\Models;

use App\Abstracts\BaseModel;
use App\Traits\Searchable;
use PDO;

class Book extends BaseModel
{
    use Searchable;

    private string $title;
    private string $author;
    private int $year;

    public const STATUS_AVAILABLE = 'available';
    public const STATUS_BORROWED = 'borrowed';

    public function __construct(string $title = '', string $author = '', int $year = 0)
    {
        parent::__construct();
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }

    // Getter & Setter
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): void { $this->title = $title; }

    public function getAuthor(): string { return $this->author; }
    public function setAuthor(string $author): void { $this->author = $author; }

    public function getYear(): int { return $this->year; }
    public function setYear(int $year): void { $this->year = $year; }

    // Implementasi BaseModel CRUD
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("INSERT INTO books (title, author, year, status) VALUES (:title, :author, :year, :status)");
        return $stmt->execute([
            ':title' => $data['title'],
            ':author' => $data['author'],
            ':year' => $data['year'],
            ':status' => self::STATUS_AVAILABLE
        ]);
    }

    public function read(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("UPDATE books SET title=:title, author=:author, year=:year WHERE id=:id");
        return $stmt->execute([
            ':title' => $data['title'],
            ':author' => $data['author'],
            ':year' => $data['year'],
            ':id' => $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id=:id");
        return $stmt->execute([':id' => $id]);
    }

    // Magic method __toString()
    public function __toString(): string
    {
        return "{$this->title} oleh {$this->author} ({$this->year})";
    }
}