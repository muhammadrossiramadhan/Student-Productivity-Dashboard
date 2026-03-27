<?php
include "services/database.php"; 

// Bypass login untuk Rossi
$user_id = 1; 
$username = "Rossi";

// --- LOGIKA CRUD ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tambah_tugas'])) {
        $nama = mysqli_real_escape_string($db, $_POST['nama_tugas']);
        $desk = mysqli_real_escape_string($db, $_POST['deskripsi']);
        $dead = $_POST['deadline'];
        $waktu = $_POST['waktu'];
        $prio = $_POST['prioritas'];

        $db->query("INSERT INTO tasks (user_id, nama_tugas, deskripsi, deadline, waktu, prioritas, status) 
                    VALUES ('$user_id', '$nama', '$desk', '$dead', '$waktu', '$prio', 'Belum Selesai')");
    }

    if (isset($_POST['set_selesai'])) {
        $id_tgs = $_POST['id_tugas'];
        // Logika scoring dipisah ke branch features-ross/consistency-scoring-logic
        // Untuk sementara, update status saja agar murni CRUD
        $db->query("UPDATE tasks SET status='Selesai', selesai_at=NOW() WHERE id='$id_tgs' AND user_id='$user_id'");
    }

    if (isset($_POST['hapus_tugas'])) {
        $id_tgs = $_POST['id_tugas'];
        $db->query("DELETE FROM tasks WHERE id = '$id_tgs' AND user_id = '$user_id'");
    }
    header("Location: dashboard.php");
    exit;
}

$cari = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : "";
$res_aktif = $db->query("SELECT *, (CASE WHEN CONCAT(deadline, ' ', waktu) < NOW() THEN 'Terlambat' ELSE 'Mendatang' END) as status_waktu 
                         FROM tasks WHERE user_id = '$user_id' AND status = 'Belum Selesai' 
                         AND (nama_tugas LIKE '%$cari%' OR deskripsi LIKE '%$cari%') ORDER BY deadline ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMUT - Task Manager</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="header-logo">
                <i class="fas fa-check-circle logo-icon"></i>
                <div class="logo-text">
                    <h1>SIMUT</h1>
                    <p>Task Management</p>
                </div>
            </div>
            <button class="header-menu" onclick="toggleMenu()"><i class="fas fa-bars"></i></button>
            <nav class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="dashboard.php"><i class="fas fa-home"></i> Beranda</a></li>
                    <li><a href="index.php"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <div class="greeting-card">
                <h2>Halo, <?= $username ?>!</h2>
                <p>Kelola tugasmu dengan efisien hari ini.</p>
            </div>

            <section class="auth-card">
                <h3><i class="fas fa-plus-square"></i> Tugas Baru</h3>
                <form method="POST">
                    <div class="input-group">
                        <i class="fas fa-tag"></i>
                        <input type="text" name="nama_tugas" placeholder="Apa yang ingin dikerjakan?" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-align-left" style="top: 25px;"></i>
                        <textarea name="deskripsi" placeholder="Detail tugas..."></textarea>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <div class="input-group" style="flex: 1;">
                            <i class="fas fa-calendar-alt"></i>
                            <input type="date" name="deadline" required>
                        </div>
                        <div class="input-group" style="flex: 1;">
                            <i class="fas fa-clock"></i>
                            <input type="time" name="waktu" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-layer-group"></i>
                        <select name="prioritas">
                            <option value="Tinggi">Prioritas Tinggi</option>
                            <option value="Sedang" selected>Prioritas Sedang</option>
                            <option value="Rendah">Prioritas Rendah</option>
                        </select>
                    </div>
                    <button type="submit" name="tambah_tugas" class="btn-primary">Simpan Tugas</button>
                </form>
            </section>

            <hr style="border: 0; border-top: 1px solid #eee; margin: 25px 0;">

            <form method="GET" class="input-group" style="margin-bottom: 20px;">
                <i class="fas fa-search"></i>
                <input type="text" name="search" placeholder="Cari tugas..." value="<?= htmlspecialchars($cari) ?>">
            </form>