<?php
require_once 'app/models/TaskModel.php';
require_once 'app/config/database.php';

class TaskController
{
    private $db;
    private $taskModel;

    public function __construct()
    {
        // Cek login
        if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
            header("location: index.php?action=login");
            exit;
        }

        $database = new Database();
        $this->db = $database->getConnection();
        $this->taskModel = new TaskModel($this->db);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user_id'];
            $judul = $_POST['judul'];
            $deadline = $_POST['deadline'];
            $deskripsi = $_POST['deskripsi'];
            $prioritas = $_POST['prioritas'];

            $this->taskModel->addTask($user_id, $judul, $deadline, $deskripsi, $prioritas);
        }
        header("location: index.php?action=dashboard");
        exit;
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user_id'];
            $task_id = $_POST['task_id'];
            $judul = $_POST['judul'];
            $deadline = $_POST['deadline'];
            $deskripsi = $_POST['deskripsi'];
            $prioritas = $_POST['prioritas'];

            $this->taskModel->updateTask($task_id, $user_id, $judul, $deadline, $deskripsi, $prioritas);
        }
        header("location: index.php?action=dashboard");
        exit;
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $task_id = $_GET['id'];
            $user_id = $_SESSION['user_id'];
            $this->taskModel->deleteTask($task_id, $user_id);
        }
        header("location: index.php?action=dashboard");
        exit;
    }
}
?>