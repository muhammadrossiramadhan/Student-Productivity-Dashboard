<?php
require_once 'app/models/UserModel.php';
require_once 'app/config/database.php';

class AuthController
{
    private $db;
    private $userModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    public function login()
    {
        // Jika sudah login, ke dashboard
        if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
            header("location: index.php?action=dashboard");
            exit;
        }
        require_once 'app/views/auth/login.php';
    }

    public function register()
    {
        // Jika sudah login, ke dashboard
        if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
            header("location: index.php?action=dashboard");
            exit;
        }
        require_once 'app/views/auth/register.php';
    }

    public function processLogin()
    {
        if (isset($_POST["login"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $user = $this->userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user["password"])) {
                // Set session login
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['panggilan'] = $user['panggilan'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_login'] = true;

                header("location: index.php?action=dashboard");
                exit;
            } else {
                header("location: index.php?status=gagal_login");
                exit;
            }
        }
    }

    public function processRegister()
    {
        if (isset($_POST["register"])) {
            $panggilan = $_POST["panggilan"];
            $username = $_POST["username"];
            $password = $_POST["password"];

            if ($this->userModel->createUser($panggilan, $username, $password)) {
                header("location: index.php?status=sukses_daftar");
            } else {
                header("location: index.php?status=gagal_daftar");
            }
            exit;
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("location: index.php");
        exit;
    }
}
?>