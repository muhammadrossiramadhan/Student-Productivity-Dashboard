<?php
/**
 * index.php — Entry Point Utama
 * 
 * SEMUA request masuk lewat file ini.
 * File ini yang memuat semua core class dan memanggil Router.
 * 
 * URL Pattern: ?url=controller/method/param
 * Contoh:
 *   ?url=auth/login          → AuthController::login()
 *   ?url=task/index          → TaskController::index()
 *   ?url=task/delete/5       → TaskController::delete("5")
 */

session_start();

// Set zona waktu ke Waktu Indonesia Barat (WIB)
date_default_timezone_set('Asia/Jakarta');

// ── Load semua core class ─────────────────────────────────────
require_once __DIR__ . '/app/core/Database.php';
require_once __DIR__ . '/app/core/Model.php';
require_once __DIR__ . '/app/core/Controller.php';
require_once __DIR__ . '/app/core/Router.php';

// ── Definisikan Base Path untuk URL portabel ──────────────────
$script_name = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
$base_path = ($script_name === '/') ? '' : $script_name;
define('BASE_PATH', $base_path);

// ── Ambil URL dari query string ───────────────────────────────
// Default: tampilkan halaman landing page (home)
$url = $_GET['url'] ?? 'home/index';

// ── Dispatch ke controller yang tepat ─────────────────────────
Router::dispatch($url);
