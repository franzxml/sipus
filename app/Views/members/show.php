<?php
// app/Views/members/show.php
?>

<div class="container">
    <h2>Detail Anggota</h2>
    <?php if (!empty($member)): ?>
        <p><strong>Username:</strong> <?= htmlspecialchars($member->getUsername()) ?></p>
        <p><strong>ID Anggota:</strong> <?= htmlspecialchars($member->getMemberId()) ?></p>
        <p><strong>Buku Dipinjam:</strong> <?= implode(", ", $member->getBorrowedBooks()) ?></p>
        <a href="?page=members&action=index"><button>Kembali</button></a>
    <?php else: ?>
        <p class="alert">Data anggota tidak ditemukan.</p>
    <?php endif; ?>
</div>