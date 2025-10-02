<?php
// tests/ReflectionTest.php

use App\Models\Book;

require_once __DIR__ . '/../config/autoload.php';

echo "<h2>Reflection Test - Book Class</h2>";

$reflection = new ReflectionClass(Book::class);

echo "<p>Nama Class: " . $reflection->getName() . "</p>";
echo "<p>Properti:</p><ul>";
foreach ($reflection->getProperties() as $prop) {
    echo "<li>" . $prop->getName() . "</li>";
}
echo "</ul>";

echo "<p>Method:</p><ul>";
foreach ($reflection->getMethods() as $method) {
    echo "<li>" . $method->getName() . "</li>";
}
echo "</ul>";