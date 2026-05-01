<?php
class Database {
    private $hostname = "localhost";
    private $username_db = "root";
    private $password_db = "";
    private $database_name = "app_tugas_db";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->hostname, $this->username_db, $this->password_db, $this->database_name);
            if ($this->conn->connect_error) {
                die("Gagal terhubung ke database: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die("Error koneksi: " . $e->getMessage());
        }
        return $this->conn;
    }
}
?>
