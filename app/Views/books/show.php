<?php
// app/Views/books/show.php
?>

<div class="container">
    <h2>Detail Buku</h2>
    <?php if (!empty($book)): ?>
        <p><strong>ID:</strong> <?= htmlspecialchars($book['id']) ?></p>
        <p><strong>Judul:</strong> <?= htmlspecialchars($book['title']) ?></p>
        <p><strong>Penulis:</strong> <?= htmlspecialchars($book['author']) ?></p>
        <p><strong>Tahun:</strong> <?= htmlspecialchars($book['year']) ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($book['status']) ?></p>
        <a href="?page=books&action=edit&id=<?= $book['id'] ?>"><button>Edit</button></a>
    <?php else: ?>
        <p class="alert">Data buku tidak ditemukan.</p>
    <?php endif; ?>
</div>