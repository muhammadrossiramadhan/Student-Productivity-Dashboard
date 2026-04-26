<?php
require_once __DIR__ . '/Database.php';

/**
 * Model.php — Base class untuk semua Model
 * 
 * Semua model (TaskModel, UserModel) akan extends class ini.
 * Otomatis dapat $this->db tanpa perlu konek ulang.
 * 
 * Ini contoh INHERITANCE di OOP PHP!
 */
abstract class Model {
    protected PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getPdo();
    }
}
