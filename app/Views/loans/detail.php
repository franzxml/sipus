<?php
// app/Views/loans/detail.php
?>

<div class="container">
    <h2>Detail Peminjaman</h2>
    <?php if (!empty($loan)): ?>
        <p><strong>ID Peminjaman:</strong> <?= htmlspecialchars($loan['id']) ?></p>
        <p><strong>ID Buku:</strong> <?= htmlspecialchars($loan['book_id']) ?></p>
        <p><strong>ID Anggota:</strong> <?= htmlspecialchars($loan['member_id']) ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($loan['status']) ?></p>
        <p><strong>Tanggal Pinjam:</strong> <?= htmlspecialchars($loan['loan_date']) ?></p>
        <p><strong>Tanggal Kembali:</strong> <?= htmlspecialchars($loan['return_date']) ?></p>
        <a href="?page=loans&action=index"><button>Kembali</button></a>
    <?php else: ?>
        <p class="alert">Data peminjaman tidak ditemukan.</p>
    <?php endif; ?>
</div>