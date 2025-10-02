<?php
// app/Models/Member.php

namespace App\Models;

class Member extends User
{
    private string $memberId;
    private array $borrowedBooks = [];

    public function __construct(string $username, string $password, string $memberId)
    {
        parent::__construct($username, $password, 'member');
        $this->memberId = $memberId;
    }

    // Getter & Setter memberId
    public function getMemberId(): string
    {
        return $this->memberId;
    }

    public function setMemberId(string $memberId): void
    {
        $this->memberId = $memberId;
    }

    // Tambah buku ke daftar pinjaman
    public function borrowBook(string $bookTitle): void
    {
        $this->borrowedBooks[] = $bookTitle;
    }

    // Kembalikan daftar buku yang dipinjam
    public function getBorrowedBooks(): array
    {
        return $this->borrowedBooks;
    }

    // Override __toString()
    public function __toString(): string
    {
        return "Member: {$this->getUsername()}, ID: {$this->memberId}, Buku dipinjam: " . implode(", ", $this->borrowedBooks);
    }
}