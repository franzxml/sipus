<?php
// app/Models/Admin.php

namespace App\Models;

class Admin extends User
{
    public function __construct(string $username, string $password)
    {
        parent::__construct($username, $password, 'admin');
    }

    // Override method getRole()
    public function getRole(): string
    {
        return strtoupper(parent::getRole()); // ADMIN
    }

    // Method khusus admin
    public function manageSystem(): string
    {
        return "{$this->getUsername()} memiliki akses penuh untuk mengelola sistem.";
    }
}