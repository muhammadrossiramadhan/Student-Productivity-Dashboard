<?php
/**
 * Router.php — Menentukan Controller & Method mana yang dipanggil
 * 
 * URL Pattern: ?url=controller/method/param
 * 
 * Contoh:
 *   ?url=auth/login       → AuthController::login()
 *   ?url=task/index       → TaskController::index()
 *   ?url=task/delete/5    → TaskController::delete(5)
 */
class Router {

    public static function dispatch(string $url): void {
        $url   = trim($url, '/');
        $parts = explode('/', $url);

        // Jika URL kosong (misal: ?url=), kita arahkan ke halaman default 'home/index'
        // untuk menghindari error.
        if (empty($parts[0])) {
            $parts = ['home', 'index'];
        }
 
        // Bagian 0: nama controller
        $controllerName = ucfirst(strtolower($parts[0])) . 'Controller';
 
        // Bagian 1: nama method (default: index)
        $method = $parts[1] ?? 'index';

        // Bagian 2: parameter opsional (misal: ID)
        $param = $parts[2] ?? null;

        // Cari file controller
        $controllerFile = __DIR__ . '/../../app/controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            die("❌ Controller tidak ditemukan: <strong>$controllerName</strong><br>File: $controllerFile");
        }

        require_once $controllerFile;

        // Buat instance controller
        $controller = new $controllerName();

        // Cek apakah method ada
        if (!method_exists($controller, $method)) {
            die("❌ Method <strong>$method()</strong> tidak ada di <strong>$controllerName</strong>");
        }

        // Panggil method dengan atau tanpa parameter
        if ($param !== null) {
            $controller->$method($param);
        } else {
            $controller->$method();
        }
    }
}
