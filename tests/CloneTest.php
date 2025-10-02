<?php
// tests/CloneTest.php

use App\Models\Book;

require_once __DIR__ . '/../config/autoload.php';

echo "<h2>Clone Test - Book Object</h2>";

$book1 = new Book("Pemrograman PHP", "Budi", 2023);
$book2 = clone $book1;

// Ubah judul pada hasil clone
$book2->setTitle("Pemrograman OOP dengan PHP");

echo "<p>Objek Asli: " . $book1 . "</p>";
echo "<p>Objek Clone: " . $book2 . "</p>";