<?php
// app/Models/Loan.php

namespace App\Models;

use App\Abstracts\BaseModel;
use App\Interfaces\LoanInterface;
use PDO;
use Exception;

class Loan extends BaseModel implements LoanInterface
{
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("INSERT INTO loans (book_id, member_id, loan_date, status) VALUES (:book_id, :member_id, :loan_date, :status)");
        return $stmt->execute([
            ':book_id' => $data['book_id'],
            ':member_id' => $data['member_id'],
            ':loan_date' => date('Y-m-d H:i:s'),
            ':status' => 'borrowed'
        ]);
    }

    public function read(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM loans WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("UPDATE loans SET status=:status, return_date=:return_date WHERE id=:id");
        return $stmt->execute([
            ':status' => $data['status'],
            ':return_date' => $data['return_date'] ?? null,
            ':id' => $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM loans WHERE id=:id");
        return $stmt->execute([':id' => $id]);
    }

    // Implementasi LoanInterface
    public function borrowBook(int $bookId, int $memberId): bool
    {
        try {
            return $this->create([
                'book_id' => $bookId,
                'member_id' => $memberId
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function returnBook(int $loanId): bool
    {
        try {
            return $this->update($loanId, [
                'status' => 'returned',
                'return_date' => date('Y-m-d H:i:s')
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function listLoans(): array
    {
        $stmt = $this->db->query("SELECT * FROM loans");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}