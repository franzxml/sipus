<?php
// app/Views/members/create.php
?>

<div class="container">
    <h2>Tambah Anggota</h2>
    <form method="post" action="?page=members&action=create">
        <label>Username:</label><br>
        <input type="text" name="username" placeholder="Username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" placeholder="Password" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</div>