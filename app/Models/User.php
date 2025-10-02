<?php
// app/Models/User.php

namespace App\Models;

use App\Interfaces\UserInterface;

class User implements UserInterface
{
    // Scope: properti private dan protected
    protected string $username;
    private string $password;
    protected string $role;

    public function __construct(string $username, string $password, string $role = 'member')
    {
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->role = $role;
    }

    // Encapsulation: getter dan setter
    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    // Implementasi interface UserInterface
    public function getRole(): string
    {
        return $this->role;
    }

    public function login(string $username, string $password): bool
    {
        return ($this->username === $username && password_verify($password, $this->password));
    }

    public function logout(): void
    {
        // Hapus session untuk logout
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }

    // Magic Method __toString
    public function __toString(): string
    {
        return "User: {$this->username}, Role: {$this->role}";
    }
}