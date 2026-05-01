<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';

/**
 * AuthController.php — Handle Login & Register
 */
class AuthController extends Controller {
    private UserModel $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // ── GET: Tampilkan form login ──────────────────────────────
    public function login(): void {
        // Kalau sudah login, langsung ke dashboard
        if (isset($_SESSION['user_id'])) {
            $this->redirect('index.php?url=task/index');
        }
        $this->view('auth/login');
    }

    // ── POST: Proses login ─────────────────────────────────────
    public function doLogin(): void {
        if ($this->method() !== 'POST') {
            $this->redirect('index.php?url=auth/login');
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $this->view('auth/login', ['error' => 'Username dan password wajib diisi!']);
            return;
        }

        $user = $this->userModel->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['panggilan'] = $user['panggilan'] ?? $user['username'];

            $this->redirect('index.php?url=task/index');
        } else {
            $this->view('auth/login', ['error' => 'Username atau password salah!']);
        }
    }

    // ── GET: Tampilkan form register ───────────────────────────
    public function register(): void {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('index.php?url=task/index');
        }
        $this->view('auth/register');
    }

    // ── POST: Proses register ──────────────────────────────────
    public function doRegister(): void {
        if ($this->method() !== 'POST') {
            $this->redirect('index.php?url=auth/register');
        }

        $username  = trim($_POST['username']  ?? '');
        $password  = $_POST['password']       ?? '';
        $panggilan = trim($_POST['panggilan'] ?? '');

        // Validasi sederhana
        if (empty($username) || empty($password)) {
            $this->view('auth/register', ['error' => 'Username dan password wajib diisi!']);
            return;
        }

        if (strlen($password) < 6) {
            $this->view('auth/register', ['error' => 'Password minimal 6 karakter!']);
            return;
        }

        if ($this->userModel->usernameExists($username)) {
            $this->view('auth/register', ['error' => 'Username sudah dipakai!']);
            return;
        }

        $this->userModel->create($username, $password, $panggilan ?: $username);
        $this->redirect('index.php?url=auth/login');
    }

    // ── Logout ─────────────────────────────────────────────────
    public function logout(): void {
        session_destroy();
        $this->redirect('index.php?url=auth/login');
    }
}
