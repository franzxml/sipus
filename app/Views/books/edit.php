<?php
// app/Views/books/edit.php
?>

<div class="container">
    <h2>Edit Buku</h2>
    <?php if (!empty($book)): ?>
        <form method="post" action="?page=books&action=edit&id=<?= htmlspecialchars($book['id']) ?>">
            <label>Judul:</label><br>
            <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required><br><br>

            <label>Penulis:</label><br>
            <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required><br><br>

            <label>Tahun:</label><br>
            <input type="number" name="year" value="<?= htmlspecialchars($book['year']) ?>" required><br><br>

            <button type="submit">Update</button>
        </form>
    <?php else: ?>
        <p class="alert">Data buku tidak ditemukan.</p>
    <?php endif; ?>
</div>