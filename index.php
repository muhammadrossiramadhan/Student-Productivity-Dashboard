<?php
// Menggunakan koneksi database
include "services/database.php"; 

// Bypass login untuk keperluan development (Rossi)
$user_id = 1; 
$username = "Rossi";

// --- LOGIKA CRUD (TUGAS) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. TAMBAH TUGAS (Create)
    if (isset($_POST['tambah_tugas'])) {
        $nama = mysqli_real_escape_string($db, $_POST['nama_tugas']);
        $desk = mysqli_real_escape_string($db, $_POST['deskripsi']);
        $dead = $_POST['deadline'];
        $waktu = $_POST['waktu'];
        $prio = $_POST['prioritas'];

        $db->query("INSERT INTO tasks (user_id, nama_tugas, deskripsi, deadline, waktu, prioritas, status) 
                    VALUES ('$user_id', '$nama', '$desk', '$dead', '$waktu', '$prio', 'Belum Selesai')");
    }

    // 2. SELESAIKAN TUGAS & HITUNG POIN (Update)
    if (isset($_POST['set_selesai'])) {
        $id_tgs = $_POST['id_tugas'];
        $cek = $db->query("SELECT deadline, waktu FROM tasks WHERE id = '$id_tgs'")->fetch_assoc();
        
        $tenggat = $cek['deadline'] . ' ' . $cek['waktu'];
        $skrg = date('Y-m-d H:i:s');
        
        // Logika Poin: Tepat waktu = 10, Terlambat = 2
        $poin = (strtotime($skrg) <= strtotime($tenggat)) ? 10 : 2;

        $db->query("UPDATE tasks SET status='Selesai', selesai_at='$skrg', poin_konsistensi='$poin' 
                    WHERE id='$id_tgs' AND user_id='$user_id'");
    }

    // 3. HAPUS TUGAS (Delete)
    if (isset($_POST['hapus_tugas'])) {
        $id_tgs = $_POST['id_tugas'];
        $db->query("DELETE FROM tasks WHERE id = '$id_tgs' AND user_id = '$user_id'");
    }

    // Refresh halaman agar input tidak terkirim ulang saat F5
    header("Location: dashboard.php");
    exit;
}

// --- PENGAMBILAN DATA ---
$cari = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : "";

// Query Tugas Aktif
$sql_aktif = "SELECT *, 
             (CASE WHEN CONCAT(deadline, ' ', waktu) < NOW() THEN 'Terlambat' ELSE 'Mendatang' END) as status_waktu 
             FROM tasks 
             WHERE user_id = '$user_id' AND status = 'Belum Selesai' 
             AND (nama_tugas LIKE '%$cari%' OR deskripsi LIKE '%$cari%')
             ORDER BY deadline ASC, waktu ASC";
$res_aktif = $db->query($sql_aktif);

// Query Riwayat
$res_riwayat = $db->query("SELECT * FROM tasks WHERE user_id='$user_id' AND status='Selesai' ORDER BY selesai_at DESC LIMIT 3");

// Data Grafik 7 Hari
$labels = []; $data_poin = [];
for ($i = 6; $i >= 0; $i--) {
    $tgl = date('Y-m-d', strtotime("-$i days"));
    $labels[] = date('d M', strtotime($tgl));
    $res = $db->query("SELECT SUM(poin_konsistensi) as total FROM tasks WHERE user_id='$user_id' AND DATE(selesai_at)='$tgl'");
    $row = $res->fetch_assoc();
    $data_poin[] = $row['total'] ?? 0;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMUT - Dashboard Rossi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <header>
            <div class="header-logo">
                <i class="fas fa-check-double logo-icon"></i>
                <div class="logo-text">
                    <h1>SIMUT</h1>
                    <p>Dashboard Produktivitas</p>
                </div>
            </div>
            <button class="header-menu" onclick="toggleMenu()"><i class="fas fa-bars"></i></button>
            <nav class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="#"><i class="fas fa-user-circle"></i> Profil</a></li>
                    <li><a href="index.php"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <div class="greeting-card">
                <h2>Halo, <?= htmlspecialchars($username) ?>!</h2>
                <p>Kamu punya <strong><?= $res_aktif->num_rows ?></strong> tugas yang perlu diselesaikan.</p>
            </div>

            <form method="GET" class="input-group" style="margin-bottom: 20px;">
                <i class="fas fa-search"></i>
                <input type="text" name="search" placeholder="Cari tugas Anda..." value="<?= htmlspecialchars($cari) ?>">
            </form>

            <div class="auth-card">
                <h3><i class="fas fa-plus-circle"></i> Tambah Tugas Baru</h3>
                <form method="POST">
                    <div class="input-group">
                        <i class="fas fa-edit"></i>
                        <input type="text" name="nama_tugas" placeholder="Nama Tugas" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-align-left" style="top: 25px;"></i>
                        <textarea name="deskripsi" placeholder="Deskripsi singkat..."></textarea>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <div class="input-group" style="flex: 1;">
                            <i class="fas fa-calendar-day"></i>
                            <input type="date" name="deadline" required>
                        </div>
                        <div class="input-group" style="flex: 1;">
                            <i class="fas fa-clock"></i>
                            <input type="time" name="waktu" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-flag"></i>
                        <select name="prioritas">
                            <option value="Tinggi">Tinggi</option>
                            <option value="Sedang" selected>Sedang</option>
                            <option value="Rendah">Rendah</option>
                        </select>
                    </div>
                    <button type="submit" name="tambah_tugas" class="btn-primary">Simpan ke Daftar</button>
                </form>
            </div>

            <hr style="border: 0; border-top: 1px solid #eee; margin: 30px 0;">

            <h3><i class="fas fa-fire"></i> Tugas Aktif</h3>
            <div class="task-list">
                <?php while($row = $res_aktif->fetch_assoc()): ?>
                    <div class="task-card">
                        <div class="task-card-header">
                            <h3><?= htmlspecialchars($row['nama_tugas']) ?></h3>
                            <span class="priority priority-<?= $row['prioritas'] ?>"><?= $row['prioritas'] ?></span>
                        </div>
                        <div class="task-card-body">
                            <p style="color: #555;"><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></p>
                            <p><i class="fas fa-hourglass-half"></i> Deadline: <?= $row['deadline'] ?> | <?= $row['waktu'] ?></p>
                            <p>
                                <span class="badge <?= $row['status_waktu'] == 'Terlambat' ? 'priority-Tinggi' : 'priority-Sedang' ?>" style="font-size: 11px; padding: 2px 8px;">
                                    <?= $row['status_waktu'] ?>
                                </span>
                            </p>
                        </div>
                        <div class="task-card-footer">
                            <form method="POST" style="flex: 1;">
                                <input type="hidden" name="id_tugas" value="<?= $row['id'] ?>">
                                <button type="submit" name="set_selesai" class="btn-sm-success">
                                    <i class="fas fa-check-circle"></i> Selesai
                                </button>
                            </form>
                            <form method="POST" onsubmit="return confirm('Hapus tugas ini?')">
                                <input type="hidden" name="id_tugas" value="<?= $row['id'] ?>">
                                <button type="submit" name="hapus_tugas" style="background:none; border:none; color:#e74c3c; cursor:pointer; padding: 5px;">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="auth-card" style="margin-top: 30px; background: #fafafa;">
                <h3 style="font-size: 14px; margin-bottom: 10px;"><i class="fas fa-chart-area"></i> Statistik Skor 7 Hari</h3>
                <canvas id="performaChart" height="180"></canvas>
            </div>

            <h3 style="margin-top: 30px;"><i class="fas fa-history"></i> Baru Saja Selesai</h3>
            <?php while($h = $res_riwayat->fetch_assoc()): ?>
                <div class="task-card" style="opacity: 0.8; border-left: 4px solid #2ecc71; margin-bottom: 10px; padding: 10px 15px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 13px; font-weight: 500;"><?= htmlspecialchars($h['nama_tugas']) ?></span>
                        <span class="priority <?= $h['poin_konsistensi'] == 10 ? 'priority-Rendah' : 'priority-Tinggi' ?>" style="font-size: 10px;">
                            +<?= $h['poin_konsistensi'] ?> Poin
                        </span>
                    </div>
                </div>
            <?php endwhile; ?>

        </main>
        
        <footer>
            <p>&copy; 2026 Sistem Manajemen Tugas (SIMUT) &bull; Rossi</p>
        </footer>
    </div>
    
    <script src="script.js"></script>
    <script>
        // Inisialisasi Chart.js
        const ctx = document.getElementById('performaChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($labels) ?>,
                datasets: [{
                    label: 'Skor Konsistensi',
                    data: <?= json_encode($data_poin) ?>,
                    borderColor: '#4facfe',
                    backgroundColor: 'rgba(79, 172, 254, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 3
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 5 } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</body>
</html>