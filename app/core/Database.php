<?php
/**
 * Database.php — Singleton PDO Connection
 * 
 * Singleton artinya: koneksi DB hanya dibuat SEKALI,
 * tidak peduli berapa kali class ini dipanggil.
 * Hemat resource!
 */
class Database {
    private static ?Database $instance = null;
    private PDO $pdo;

    // private __construct → tidak bisa dipanggil dengan "new Database()"
    // harus lewat Database::getInstance()
    private function __construct() {
        $host   = 'localhost';
        $dbname = 'app_tugas_db';
        $user   = 'root';
        $pass   = ''; // 1. Coba pakai password kosong dulu (Default XAMPP Windows/Linux)

        try {
            $this->pdo = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );

            // Sinkronkan waktu MySQL ke WIB (+07:00) agar fungsi NOW() akurat
            $this->pdo->exec("SET time_zone = '+07:00'");
        } catch (PDOException $e) {
            // 2. Jika ditolak (error), otomatis coba pakai password 'root' (MAMP/Mac)
            try {
                $this->pdo = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                    $user,
                    'root',
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
                $this->pdo->exec("SET time_zone = '+07:00'");
            } catch (PDOException $e2) {
                // 3. Jika dua-duanya tetap gagal, baru tampilkan pesan error
                die("❌ Koneksi database gagal. Pastikan database '$dbname' sudah dibuat di phpMyAdmin dan XAMPP berjalan.<br>Error: " . $e2->getMessage());
            }
        }
    }

    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getPdo(): PDO {
        return $this->pdo;
    }
}
