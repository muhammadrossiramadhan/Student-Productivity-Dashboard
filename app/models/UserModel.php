<?php
class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getUserByUsername($username) {
        $username = $this->conn->real_escape_string($username);
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return false;
    }

    public function createUser($panggilan, $username, $password) {
        $panggilan = $this->conn->real_escape_string($panggilan);
        $username = $this->conn->real_escape_string($username);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (panggilan, username, password) VALUES ('$panggilan', '$username', '$hashed_password')";
        
        try {
            if ($this->conn->query($sql)) {
                return true;
            }
        } catch (mysqli_sql_exception $e) {
            return false;
        }
        return false;
    }
}
?>
