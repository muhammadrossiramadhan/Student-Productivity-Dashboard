<?php
session_start();
include "services/database.php";

// Keamanan: Cek apakah user sudah login
if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
    header("location: index.php");
    exit;
}

$panggilan = $_SESSION['panggilan'];
$user_id = $_SESSION['user_id'];

// Logika Menampilkan Tugas yang Belum Selesai (Dashboard)
$sql_tugas = "SELECT * FROM tasks WHERE user_id = '$user_id' AND status = 'Belum Selesai' ORDER BY created_at DESC";
$result_tugas = $db->query($sql_tugas);
$jumlah_tugas_belum = $result_tugas->num_rows;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIMUT</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Tambahkan CSS spesifik dashboard di sini atau di style.css */
        .dashboard-container { padding: 20px; }
        .greeting-card, .task-summary { background-color: #f4f4f4; padding: 20px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #ddd;}
        .greeting-card h2 { margin-bottom: 5px; color: #2ecc71; }
        .greeting-card p { font-size: 14px; color: #666; }
        .summary-stats { display: flex; gap: 20px; margin-top: 15px;}
        .stat-item { text-align: center; flex: 1; padding: 10px; border-radius: 5px; background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05);}
        .stat-value { font-size: 24px; font-weight: bold; color: #2ecc71; }
        .stat-label { font-size: 12px; color: #7f8c8d; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
        .logout-btn { background-color: #e74c3c; color: white; border: none; padding: 5px 10px; border-radius: 4px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container dashboard-container">
        
        <header class="page-header">
            <h3>SIMUT - Tugas Anda</h3>
            <button class="header-menu logout-btn" onclick="location.href='logout.php'">Keluar</button>
        </header>
        
        <section class="greeting-card">
            <h2>Hallo, <?= htmlspecialchars($panggilan) ?>!</h2>
            <p>Selamat datang di dashboard tugas Anda.</p>
            
            <div class="summary-stats">
                <div class="stat-item">
                    <div class="stat-value"><?= $jumlah_tugas_belum ?></div>
                    <div class="stat-label">Tugas Belum Selesai</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">0</div>
                    <div class="stat-label">Tugas Selesai</div>
                </div>
            </div>
            
            <div class="action-buttons" style="margin-top: 15px;">
                <button class="btn-primary" onclick="alert('Fitur tambah tugas belum terintegrasi database dalam perbaikan ini.')">
                    <i class="fas fa-plus"></i> Tambah Tugas
                </button>
                <button class="btn-secondary" onclick="alert('Fitur riwayat belum terintegrasi database dalam perbaikan ini.')">
                    <i class="fas fa-history"></i> Lihat Riwayat
                </button>
            </div>
        </section>

        <section class="tasks-container">
            <h3>Daftar Tugas Belum Selesai</h3>
            <div class="task-list">
                <?php if ($result_tugas->num_rows > 0): ?>
                    <?php while ($row = $result_tugas->fetch_assoc()): ?>
                        <div class="task-card">
                            <div class="task-card-header">
                                <h3><?= htmlspecialchars($row['nama_tugas']) ?></h3>
                                <span class="priority priority-<?= htmlspecialchars($row['prioritas']) ?>">
                                    <?= htmlspecialchars($row['prioritas']) ?>
                                </span>
                            </div>
                            <div class="task-card-body">
                                <p><i class="fas fa-align-left"></i> <?= htmlspecialchars($row['deskripsi']) ?></p>
                                <p><i class="far fa-calendar-alt"></i>Deadline: <?= htmlspecialchars($row['deadline']) ?> pukul <?= htmlspecialchars($row['waktu']) ?></p>
                            </div>
                            <div class="task-card-footer">
                                <p><i class="far fa-calendar-plus"></i> Dibuat: <?= htmlspecialchars($row['created_at']) ?></p>
                                <div class="task-actions">
                                    <button class="btn-sm-success"><i class="fas fa-check"></i> Selesai</button>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="task-card">
                        <div class="task-card-body">
                           <p>Belum ada tugas.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        
    </div>
</body>
</html>