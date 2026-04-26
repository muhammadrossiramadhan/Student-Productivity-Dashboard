<?php
require_once __DIR__ . '/../models/TaskModel.php';

class TaskController extends Controller {
    private TaskModel $taskModel;

    public function __construct() {
        $this->taskModel = new TaskModel();
    }

    // Menampilkan Dashboard Utama
    public function index() {
        $this->requireLogin();
        $user_id = $_SESSION['user_id'];
        $search = $_GET['search'] ?? '';

        $activeTasks = $this->taskModel->getActiveTasks($user_id, $search);
        $historyTasks = $this->taskModel->getHistoryTasks($user_id, 5);
        $chartData = $this->taskModel->getChartData($user_id);

        $this->view('tasks/dashboard', [
            'activeTasks' => $activeTasks,
            'historyTasks' => $historyTasks,
            'chartData' => $chartData,
            'search' => $search
        ]);
    }

    // Memproses Tambah Tugas
    public function store() {
        $this->requireLogin();
        if ($this->method() === 'POST') {
            $this->taskModel->addTask($_SESSION['user_id'], $_POST['nama_tugas'], $_POST['deskripsi'], $_POST['deadline'], $_POST['waktu'], $_POST['prioritas']);
        }
        $this->redirect('/index.php?url=task/index');
    }

    // Memproses Tugas Selesai
    public function done($id) {
        $this->requireLogin();
        if ($this->method() === 'POST' && $id) $this->taskModel->markAsDone($id, $_SESSION['user_id']);
        $this->redirect('/index.php?url=task/index');
    }

    // Memproses Hapus Tugas
    public function delete($id) {
        $this->requireLogin();
        if ($this->method() === 'POST' && $id) $this->taskModel->deleteTask($id, $_SESSION['user_id']);
        $this->redirect('/index.php?url=task/index');
    }
}