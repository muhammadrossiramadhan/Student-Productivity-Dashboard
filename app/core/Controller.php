<?php
/**
 * Controller.php — Base class untuk semua Controller
 * 
 * Semua controller (AuthController, TaskController) extends class ini.
 * Menyediakan method view() dan redirect() yang bisa dipakai di mana saja.
 */
abstract class Controller {

    /**
     * Render sebuah view dengan data yang dikirim
     * 
     * Contoh: $this->view('tasks/dashboard', ['tasks' => $tasks])
     * → file: app/views/tasks/dashboard.php
     * → variabel $tasks tersedia di dalam view
     */
    protected function view(string $path, array $data = []): void {
        // extract() ubah array ke variabel
        // ['tasks' => [...]] → $tasks = [...]
        extract($data);
        $fullPath = __DIR__ . '/../../app/views/' . $path . '.php';

        if (!file_exists($fullPath)) {
            die("❌ View tidak ditemukan: <code>$fullPath</code>");
        }
        require $fullPath;
    }

    /**
     * Redirect ke URL lain
     * @param string $path Path relatif di dalam aplikasi, cth: 'task/index'
     */
    protected function redirect(string $path): void {
        $url = BASE_PATH . '/index.php?url=' . $path;
        header("Location: " . $url);
        exit;
    }

    /**
     * Cek apakah user sudah login
     * Jika belum → redirect ke halaman login
     */
    protected function requireLogin(): void {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
        }
    }

    /**
     * Ambil method HTTP yang sedang dipakai (GET / POST)
     */
    protected function method(): string {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }
}
