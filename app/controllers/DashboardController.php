<?php
require_once 'app/models/TaskModel.php';
require_once 'app/config/database.php';

class DashboardController
{
    private $db;
    private $taskModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->taskModel = new TaskModel($this->db);
    }

    public function index()
    {
        // Harus login untuk akses dashboard
        if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
            header("location: index.php?action=login");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $tasks = $this->taskModel->getTasksByUserId($user_id);

        // Data yang akan dikirim ke view
        $data = [
            'panggilan' => $_SESSION['panggilan'] ?? 'User',
            'tasks' => $tasks
        ];

        require_once 'app/views/dashboard/index.php';
    }
}
?>