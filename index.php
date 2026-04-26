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

// ── Load semua core class ─────────────────────────────────────
require_once __DIR__ . '/app/core/Database.php';
require_once __DIR__ . '/app/core/Model.php';
require_once __DIR__ . '/app/core/Controller.php';
require_once __DIR__ . '/app/core/Router.php';

// ── Ambil URL dari query string ───────────────────────────────
// Default: tampilkan halaman landing page (home)
$url = $_GET['url'] ?? 'home/index';

// ── Dispatch ke controller yang tepat ─────────────────────────
Router::dispatch($url);
