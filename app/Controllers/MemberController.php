<?php
// app/Controllers/MemberController.php

namespace App\Controllers;

use App\Models\Member;
use App\Models\ActivityLogger;

class MemberController
{
    private Member $member;

    public function __construct()
    {
        // Dummy object untuk operasi dasar
        $this->member = new Member("dummy", "password", "MEM001");
    }

    public function index(): void
    {
        echo "<h2>Daftar Anggota</h2>";
        echo "<a href='?page=members&action=create'><button>Tambah Anggota</button></a>";

        // Contoh penggunaan serialize untuk data anggota
        $serializedFile = __DIR__ . '/../../storage/serialized/members.txt';
        if (file_exists($serializedFile)) {
            $members = unserialize(file_get_contents($serializedFile));
        } else {
            $members = [];
        }

        echo "<table><tr><th>Username</th><th>ID Anggota</th><th>Buku Dipinjam</th><th>Aksi</th></tr>";
        foreach ($members as $m) {
            echo "<tr>";
            echo "<td>{$m->getUsername()}</td>";
            echo "<td>{$m->getMemberId()}</td>";
            echo "<td>" . implode(", ", $m->getBorrowedBooks()) . "</td>";
            echo "<td><a href='?page=members&action=delete&id={$m->getMemberId()}'>Hapus</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public function create(): void
    {
        $serializedFile = __DIR__ . '/../../storage/serialized/members.txt';
        $members = file_exists($serializedFile) ? unserialize(file_get_contents($serializedFile)) : [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $memberId = uniqid('MEM');

            $newMember = new Member($username, $password, $memberId);
            $members[] = $newMember;

            file_put_contents($serializedFile, serialize($members));
            ActivityLogger::info("Anggota baru ditambahkan: {$username}");

            echo "<p class='success'>Anggota berhasil ditambahkan.</p>";
        }

        echo "<h2>Tambah Anggota</h2>";
        echo "<form method='post'>
                <input type='text' name='username' placeholder='Username' required><br><br>
                <input type='password' name='password' placeholder='Password' required><br><br>
                <button type='submit'>Simpan</button>
              </form>";
    }

    public function delete(): void
    {
        $serializedFile = __DIR__ . '/../../storage/serialized/members.txt';
        if (!file_exists($serializedFile)) return;

        $members = unserialize(file_get_contents($serializedFile));
        $id = $_GET['id'] ?? '';

        foreach ($members as $index => $m) {
            if ($m->getMemberId() === $id) {
                unset($members[$index]);
                ActivityLogger::warning("Anggota dengan ID {$id} dihapus");
                break;
            }
        }

        file_put_contents($serializedFile, serialize($members));
        echo "<p class='success'>Anggota berhasil dihapus.</p>";
    }
}