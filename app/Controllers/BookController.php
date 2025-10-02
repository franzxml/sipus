<?php
// app/Controllers/BookController.php

namespace App\Controllers;

use App\Models\Book;
use App\Models\ActivityLogger;

class BookController
{
    private Book $book;

    public function __construct()
    {
        $this->book = new Book();
    }

    public function index(): void
    {
        $books = $this->book->fetchAll('books');
        echo "<h2>Daftar Buku</h2>";
        echo "<a href='?page=books&action=create'><button>Tambah Buku</button></a>";
        echo "<table><tr><th>ID</th><th>Judul</th><th>Penulis</th><th>Tahun</th><th>Status</th><th>Aksi</th></tr>";
        foreach ($books as $b) {
            echo "<tr>";
            echo "<td>{$b['id']}</td>";
            echo "<td>{$b['title']}</td>";
            echo "<td>{$b['author']}</td>";
            echo "<td>{$b['year']}</td>";
            echo "<td>{$b['status']}</td>";
            echo "<td>
                        <a href='?page=books&action=edit&id={$b['id']}'>Edit</a> |
                        <a href='?page=books&action=delete&id={$b['id']}' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
                    </td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'],
                'author' => $_POST['author'],
                'year' => (int)$_POST['year']
            ];
            if ($this->book->create($data)) {
                ActivityLogger::info("Buku baru ditambahkan: {$data['title']}");
                echo "<p class='success'>Buku berhasil ditambahkan.</p>";
            }
        }
        echo "<h2>Tambah Buku</h2>";
        echo "<form method='post'>
                <input type='text' name='title' placeholder='Judul' required><br><br>
                <input type='text' name='author' placeholder='Penulis' required><br><br>
                <input type='number' name='year' placeholder='Tahun' required><br><br>
                <button type='submit'>Simpan</button>
              </form>";
    }

    public function edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $book = $this->book->read($id);
        if (!$book) {
            echo "<p class='alert'>Buku tidak ditemukan.</p>";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'],
                'author' => $_POST['author'],
                'year' => (int)$_POST['year']
            ];
            if ($this->book->update($id, $data)) {
                ActivityLogger::info("Buku ID {$id} diperbarui");
                echo "<p class='success'>Buku berhasil diperbarui.</p>";
            }
        }

        echo "<h2>Edit Buku</h2>";
        echo "<form method='post'>
                <input type='text' name='title' value='" . htmlspecialchars($book['title']) . "' required><br><br>
                <input type='text' name='author' value='" . htmlspecialchars($book['author']) . "' required><br><br>
                <input type='number' name='year' value='" . htmlspecialchars($book['year']) . "' required><br><br>
                <button type='submit'>Update</button>
              </form>";
    }

    public function delete(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($this->book->delete($id)) {
            ActivityLogger::warning("Buku ID {$id} dihapus");
            echo "<p class='success'>Buku berhasil dihapus.</p>";
        } else {
            echo "<p class='alert'>Gagal menghapus buku.</p>";
        }
    }
}