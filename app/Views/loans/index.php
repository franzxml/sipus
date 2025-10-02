<?php
// app/Views/loans/index.php
?>

<div class="container">
    <h2>Daftar Peminjaman</h2>
    <a href="?page=loans&action=create"><button>Tambah Peminjaman</button></a>
    <table>
        <tr>
            <th>ID</th>
            <th>ID Buku</th>
            <th>ID Anggota</th>
            <th>Status</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Aksi</th>
        </tr>
        <?php if (!empty($loans)): ?>
            <?php foreach ($loans as $l): ?>
                <tr>
                    <td><?= htmlspecialchars($l['id']) ?></td>
                    <td><?= htmlspecialchars($l['book_id']) ?></td>
                    <td><?= htmlspecialchars($l['member_id']) ?></td>
                    <td><?= htmlspecialchars($l['status']) ?></td>
                    <td><?= htmlspecialchars($l['loan_date']) ?></td>
                    <td><?= htmlspecialchars($l['return_date']) ?></td>
                    <td>
                        <a href="?page=loans&action=return&id=<?= $l['id'] ?>">Kembalikan</a> |
                        <a href="?page=loans&action=delete&id=<?= $l['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">Belum ada data peminjaman.</td></tr>
        <?php endif; ?>
    </table>
</div>