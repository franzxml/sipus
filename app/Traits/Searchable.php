<?php
// app/Traits/Searchable.php

namespace App\Traits;

trait Searchable
{
    // Fungsi pencarian sederhana pada array data
    public function search(array $data, string $keyword, string $field): array
    {
        $results = [];
        foreach ($data as $item) {
            if (isset($item[$field]) && stripos($item[$field], $keyword) !== false) {
                $results[] = $item;
            }
        }
        return $results;
    }
}