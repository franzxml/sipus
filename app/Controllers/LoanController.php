<?php
// app/Controllers/LoanController.php

namespace App\Controllers;

use App\Models\Loan;
use App\Models\ActivityLogger;
use Exception;

class LoanController
{
    private Loan $loan;

    public function __construct()
    {
        $this->loan = new Loan();
    }

    public function index(): void
    {
        $loans = $this->loan->listLoans();
        echo "<h2>Daftar Peminjaman</h2>";
        echo "<a href='?page=loans&action=create'><button>Tambah Peminjaman</button></a>";
        echo "<table><tr><th>ID</th><th>ID Buku</th><th>ID Anggota</th><th>Status</th><th>Tanggal Pinjam</th><th>Tanggal Kembali</th><th>Aksi</th></tr>";
        foreach ($loans as $l) {
            echo "<tr>";
            echo "<td>{$l['id']}</td>";
            echo "<td>{$l['book_id']}</td>";
            echo "<td>{$l['member_id']}</td>";
            echo "<td>{$l['status']}</td>";
            echo "<td>{$l['loan_date']}</td>";
            echo "<td>{$l['return_date']}</td>";
            echo "<td>
                        <a href='?page=loans&action=return&id={$l['id']}'>Kembalikan</a> |
                        <a href='?page=loans&action=delete&id={$l['id']}' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
                    </td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookId = (int)$_POST['book_id'];
            $memberId = (int)$_POST['member_id'];
            try {
                if ($this->loan->borrowBook($bookId, $memberId)) {
                    ActivityLogger::info("Peminjaman baru: Buku {$bookId} oleh Member {$memberId}");
                    echo "<p class='success'>Peminjaman berhasil ditambahkan.</p>";
                }
            } catch (Exception $e) {
                ActivityLogger::error("Gagal membuat peminjaman: " . $e->getMessage());
                echo "<p class='alert'>Terjadi kesalahan saat membuat peminjaman.</p>";
            }
        }

        echo "<h2>Tambah Peminjaman</h2>";
        echo "<form method='post'>
                <input type='number' name='book_id' placeholder='ID Buku' required><br><br>
                <input type='number' name='member_id' placeholder='ID Anggota' required><br><br>
                <button type='submit'>Simpan</button>
              </form>";
    }

    public function return(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        try {
            if ($this->loan->returnBook($id)) {
                ActivityLogger::info("Peminjaman ID {$id} dikembalikan");
                echo "<p class='success'>Buku berhasil dikembalikan.</p>";
            }
        } catch (Exception $e) {
            ActivityLogger::error("Gagal mengembalikan peminjaman ID {$id}");
            echo "<p class='alert'>Terjadi kesalahan saat mengembalikan buku.</p>";
        }
    }

    public function delete(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        try {
            if ($this->loan->delete($id)) {
                ActivityLogger::warning("Peminjaman ID {$id} dihapus");
                echo "<p class='success'>Peminjaman berhasil dihapus.</p>";
            }
        } catch (Exception $e) {
            ActivityLogger::error("Gagal menghapus peminjaman ID {$id}");
            echo "<p class='alert'>Terjadi kesalahan saat menghapus peminjaman.</p>";
        }
    }
}