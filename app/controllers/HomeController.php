<?php
class HomeController
{
    public function index()
    {
        // Cek jika user sudah login, arahkan ke dashboard
        if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
            header("location: index.php?action=dashboard");
            exit;
        }

        // Load view home
        require_once 'app/views/home.php';
    }
}
?>