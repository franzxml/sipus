<?php
// app/Controllers/AuthController.php

namespace App\Controllers;

use App\Models\Admin;
use App\Models\Member;
use App\Models\ActivityLogger;

class AuthController
{
    public function index(): void
    {
        echo "<h2>Login</h2>";
        echo "<form method='post' action='?page=auth&action=login'>";
        echo "<input type='text' name='username' placeholder='Username' required><br><br>";
        echo "<input type='password' name='password' placeholder='Password' required><br><br>";
        echo "<select name='role'>
                <option value='admin'>Admin</option>
                <option value='member'>Member</option>
              </select><br><br>";
        echo "<button type='submit'>Login</button>";
        echo "</form>";
    }

    public function login(): void
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'member';

        if ($role === 'admin') {
            $user = new Admin($username, $password);
        } else {
            $user = new Member($username, $password, uniqid('MEM')); // ID dummy
        }

        if ($user->login($username, $password)) {
            $_SESSION['user'] = $user;
            ActivityLogger::info("{$user->getUsername()} berhasil login sebagai {$user->getRole()}");
            echo "<p>Login berhasil sebagai {$user->getRole()}!</p>";
        } else {
            ActivityLogger::warning("Gagal login untuk {$username}");
            echo "<p class='alert'>Login gagal. Periksa username atau password.</p>";
        }
    }

    public function logout(): void
    {
        if (isset($_SESSION['user'])) {
            $username = $_SESSION['user']->getUsername();
            unset($_SESSION['user']);
            ActivityLogger::info("{$username} telah logout");
            echo "<p>Anda telah logout.</p>";
        }
    }
}