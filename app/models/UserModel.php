<?php
require_once __DIR__ . '/../core/Model.php';

/**
 * UserModel.php — Logika database untuk tabel `users`
 * 
 * Struktur tabel users (dari app_tugas_db.sql):
 *   id, username, password, panggilan, created_at
 * 
 * Class ini EXTENDS Model → otomatis dapat $this->db (koneksi PDO)
 * Ini INHERITANCE!
 */
class UserModel extends Model {

    /**
     * Cari user berdasarkan username
     * Dipakai saat login
     */
    public function findByUsername(string $username): array|false {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE username = ? LIMIT 1"
        );
        $stmt->execute([$username]);
        return $stmt->fetch(); // false jika tidak ditemukan
    }

    /**
     * Cek apakah username sudah ada
     * Dipakai saat register
     */
    public function usernameExists(string $username): bool {
        $stmt = $this->db->prepare(
            "SELECT id FROM users WHERE username = ? LIMIT 1"
        );
        $stmt->execute([$username]);
        return $stmt->fetch() !== false;
    }

    /**
     * Buat user baru (register)
     */
    public function create(string $username, string $password, string $panggilan): bool {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $stmt   = $this->db->prepare(
            "INSERT INTO users (username, password, panggilan) VALUES (?, ?, ?)"
        );
        return $stmt->execute([$username, $hashed, $panggilan]);
    }
}
