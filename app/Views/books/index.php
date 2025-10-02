<?php
// app/Views/books/index.php
?>

<div class="container">
    <h2>Daftar Buku</h2>
    <a href="?page=books&action=create"><button>Tambah Buku</button></a>
    <table>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $b): ?>
                <tr>
                    <td><?= htmlspecialchars($b['id']) ?></td>
                    <td><?= htmlspecialchars($b['title']) ?></td>
                    <td><?= htmlspecialchars($b['author']) ?></td>
                    <td><?= htmlspecialchars($b['year']) ?></td>
                    <td><?= htmlspecialchars($b['status']) ?></td>
                    <td>
                        <a href="?page=books&action=edit&id=<?= $b['id'] ?>">Edit</a> |
                        <a href="?page=books&action=delete&id=<?= $b['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">Belum ada data buku.</td></tr>
        <?php endif; ?>
    </table>
</div>