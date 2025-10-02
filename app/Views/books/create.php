<?php
// app/Views/books/create.php
?>

<div class="container">
    <h2>Tambah Buku</h2>
    <form method="post" action="?page=books&action=create">
        <label>Judul:</label><br>
        <input type="text" name="title" placeholder="Judul Buku" required><br><br>

        <label>Penulis:</label><br>
        <input type="text" name="author" placeholder="Nama Penulis" required><br><br>

        <label>Tahun:</label><br>
        <input type="number" name="year" placeholder="Tahun Terbit" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</div>