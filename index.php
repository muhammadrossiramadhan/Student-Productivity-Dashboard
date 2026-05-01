<?php
session_start();

require_once 'app/controllers/HomeController.php';
require_once 'app/controllers/AuthController.php';
require_once 'app/controllers/DashboardController.php';
require_once 'app/controllers/TaskController.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        $homeController = new HomeController();
        $homeController->index();
        break;
    case 'login':
        $authController = new AuthController();
        $authController->login();
        break;
    case 'register':
        $authController = new AuthController();
        $authController->register();
        break;
    case 'process_login':
        $authController = new AuthController();
        $authController->processLogin();
        break;
    case 'process_register':
        $authController = new AuthController();
        $authController->processRegister();
        break;
    case 'dashboard':
        $dashboardController = new DashboardController();
        $dashboardController->index();
        break;
    case 'add_task':
        $taskController = new TaskController();
        $taskController->add();
        break;
    case 'edit_task':
        $taskController = new TaskController();
        $taskController->update();
        break;
    case 'delete_task':
        $taskController = new TaskController();
        $taskController->delete();
        break;
    case 'logout':
        $authController = new AuthController();
        $authController->logout();
        break;
    default:
        $homeController = new HomeController();
        $homeController->index();
        break;
}
?>