<?php
// app/Views/members/index.php
?>

<div class="container">
    <h2>Daftar Anggota</h2>
    <a href="?page=members&action=create"><button>Tambah Anggota</button></a>
    <table>
        <tr>
            <th>Username</th>
            <th>ID Anggota</th>
            <th>Buku Dipinjam</th>
            <th>Aksi</th>
        </tr>
        <?php if (!empty($members)): ?>
            <?php foreach ($members as $m): ?>
                <tr>
                    <td><?= htmlspecialchars($m->getUsername()) ?></td>
                    <td><?= htmlspecialchars($m->getMemberId()) ?></td>
                    <td><?= implode(", ", $m->getBorrowedBooks()) ?></td>
                    <td>
                        <a href="?page=members&action=show&id=<?= $m->getMemberId() ?>">Detail</a> |
                        <a href="?page=members&action=delete&id=<?= $m->getMemberId() ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">Belum ada data anggota.</td></tr>
        <?php endif; ?>
    </table>
</div>