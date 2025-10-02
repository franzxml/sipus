<?php
// app/Interfaces/UserInterface.php

namespace App\Interfaces;

interface UserInterface
{
    // Mendapatkan peran user (Admin / Member)
    public function getRole(): string;

    // Login user
    public function login(string $username, string $password): bool;

    // Logout user
    public function logout(): void;
}