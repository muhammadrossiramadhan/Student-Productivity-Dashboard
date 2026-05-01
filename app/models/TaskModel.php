<?php
class TaskModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getTasksByUserId($user_id) {
        $user_id = (int)$user_id;
        $sql = "SELECT * FROM tasks WHERE user_id = $user_id ORDER BY deadline ASC";
        $result = $this->conn->query($sql);
        
        $tasks = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tasks[] = $row;
            }
        }
        return $tasks;
    }

    public function getTaskById($task_id, $user_id) {
        $task_id = (int)$task_id;
        $user_id = (int)$user_id;
        $sql = "SELECT * FROM tasks WHERE id = $task_id AND user_id = $user_id LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function addTask($user_id, $judul, $deadline, $deskripsi, $prioritas) {
        $user_id = (int)$user_id;
        $judul = $this->conn->real_escape_string($judul);
        $deadline = $this->conn->real_escape_string($deadline);
        $deskripsi = $this->conn->real_escape_string($deskripsi);
        $prioritas = $this->conn->real_escape_string($prioritas);

        $sql = "INSERT INTO tasks (user_id, judul, deadline, deskripsi, prioritas) VALUES ($user_id, '$judul', '$deadline', '$deskripsi', '$prioritas')";
        
        return $this->conn->query($sql);
    }

    public function updateTask($task_id, $user_id, $judul, $deadline, $deskripsi, $prioritas) {
        $task_id = (int)$task_id;
        $user_id = (int)$user_id;
        $judul = $this->conn->real_escape_string($judul);
        $deadline = $this->conn->real_escape_string($deadline);
        $deskripsi = $this->conn->real_escape_string($deskripsi);
        $prioritas = $this->conn->real_escape_string($prioritas);

        $sql = "UPDATE tasks SET judul='$judul', deadline='$deadline', deskripsi='$deskripsi', prioritas='$prioritas' WHERE id=$task_id AND user_id=$user_id";
        
        return $this->conn->query($sql);
    }

    public function deleteTask($task_id, $user_id) {
        $task_id = (int)$task_id;
        $user_id = (int)$user_id;
        $sql = "DELETE FROM tasks WHERE id=$task_id AND user_id=$user_id";
        
        return $this->conn->query($sql);
    }
}
?>
