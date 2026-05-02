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
            $this->redirect('task/index');
        }
        $this->view('auth/login');
    }

    // ── POST: Proses login ─────────────────────────────────────
    public function doLogin(): void {
        if ($this->method() !== 'POST') {
            $this->redirect('auth/login');
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

            $this->redirect('task/index');
        } else {
            $this->view('auth/login', ['error' => 'Username atau password salah!']);
        }
    }

    // ── GET: Tampilkan form register ───────────────────────────
    public function register(): void {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('task/index');
        }
        $this->view('auth/register');
    }

    // ── POST: Proses register ──────────────────────────────────
    public function doRegister(): void {
        if ($this->method() !== 'POST') {
            $this->redirect('auth/register');
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

        // 1. Simpan data user baru ke database
        $this->userModel->create($username, $password, $panggilan ?: $username);

        // 2. Ambil data user yang baru saja dibuat
        $user = $this->userModel->findByUsername($username);

        // 3. Set session (Otomatis Login)
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['username']  = $user['username'];
        $_SESSION['panggilan'] = $user['panggilan'] ?? $user['username'];

        // 4. Arahkan langsung ke dashboard
        $this->redirect('task/index');
    }

    // ── Logout ─────────────────────────────────────────────────
    public function logout(): void {
        // 1. Kosongkan semua variabel session
        $_SESSION = [];

        // 2. Hapus cookie session dari browser pengguna
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // 3. Hancurkan session di sisi server
        session_destroy();
        $this->redirect('auth/login');
    }

    // ── Lupa Password (Sederhana) ──────────────────────────────
    public function forgotPassword(): void {
        // Untuk sementara, arahkan ke halaman informasi sederhana
        $this->view('auth/forgot_password');
    }
}
