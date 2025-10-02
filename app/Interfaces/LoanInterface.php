<?php
// app/Interfaces/LoanInterface.php

namespace App\Interfaces;

interface LoanInterface
{
    // Membuat transaksi peminjaman buku
    public function borrowBook(int $bookId, int $memberId): bool;

    // Mengembalikan buku
    public function returnBook(int $loanId): bool;

    // Mendapatkan daftar semua peminjaman
    public function listLoans(): array;
}