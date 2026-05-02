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
            $_SESSION['flash_success'] = "Tugas baru berhasil ditambahkan!";
        }
        $this->redirect('task/index');
    }

    // Memproses Edit Tugas
    public function edit() {
        $this->requireLogin();
        if ($this->method() === 'POST') {
            $this->taskModel->updateTask($_POST['task_id'], $_SESSION['user_id'], $_POST['nama_tugas'], $_POST['deskripsi'], $_POST['deadline'], $_POST['waktu'], $_POST['prioritas']);
            $_SESSION['flash_success'] = "Tugas berhasil diperbarui!";
        }
        $this->redirect('task/index');
    }

    // Memproses Tugas Selesai
    public function done($id) {
        $this->requireLogin();
        if ($this->method() === 'POST' && $id) {
            $this->taskModel->markAsDone($id, $_SESSION['user_id']);
            $_SESSION['flash_success'] = "Mantap! Tugas diselesaikan dan poin ditambahkan.";
        }
        $this->redirect('task/index');
    }

    // Memproses Hapus Tugas
    public function delete($id) {
        $this->requireLogin();
        if ($this->method() === 'POST' && $id) {
            $this->taskModel->deleteTask($id, $_SESSION['user_id']);
            $_SESSION['flash_success'] = "Tugas telah dihapus.";
        }
        $this->redirect('task/index');
    }
}