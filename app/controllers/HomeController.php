<?php
require_once __DIR__ . '/../core/Controller.php';

class HomeController extends Controller {
    
    public function index() {
        // Memanggil file view di app/views/home/index.php
        $this->view('home/index');
    }
}