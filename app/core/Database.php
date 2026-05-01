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
        $pass   = '';

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
        } catch (PDOException $e) {
            // Di production: jangan tampilkan error ke user!
            die(json_encode(['error' => 'Koneksi database gagal: ' . $e->getMessage()]));
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
