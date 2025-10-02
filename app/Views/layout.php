<?php
// app/Views/layout.php
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiPus - Sistem Informasi Perpustakaan</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js" defer></script>
</head>
<body>
    <header>
        <h1>SiPus</h1>
        <nav>
            <a href="?page=books&action=index">Buku</a>
            <a href="?page=members&action=index">Anggota</a>
            <a href="?page=loans&action=index">Peminjaman</a>
            <a href="?page=auth&action=index">Login</a>
        </nav>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> SiPus - Sistem Informasi Perpustakaan</p>
    </footer>
</body>
</html>
