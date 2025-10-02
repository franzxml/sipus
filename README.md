---
title: SiPus
emoji: 📚
colorFrom: indigo
colorTo: purple
sdk: docker
app_file: Dockerfile
pinned: false
---
# SiPus - Sistem Informasi Perpustakaan

SiPus adalah aplikasi perpustakaan sederhana berbasis PHP OOP dengan pola MVC. Proyek ini dibuat untuk praktikum PBO dan mengimplementasikan 20 konsep OOP.

## Fitur
- CRUD Buku
- CRUD Anggota
- CRUD Peminjaman
- Autentikasi sederhana
- Logging aktivitas
- Serialization objek

## Teknologi
- PHP 8+
- MySQL/MariaDB
- Composer Autoload

## Instalasi
1. Clone repositori
2. Jalankan `composer dump-autoload`
3. Buat database `sipus`
4. Sesuaikan konfigurasi di `config/database.php`
5. Akses melalui `http://localhost/sipus/public`

## Deskripsi Singkat (≤350 huruf)
SiPus adalah Sistem Informasi Perpustakaan berbasis PHP dengan arsitektur MVC sederhana. Proyek ini untuk praktikum PBO, mencakup 20 konsep OOP, dengan fitur CRUD buku, anggota, peminjaman, logging, dan autentikasi admin.