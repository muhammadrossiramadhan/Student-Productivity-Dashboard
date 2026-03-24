<?php
session_start();
// Menggunakan variabel koneksi $db sesuai referensi register.php 
// atau ganti menjadi $coon sesuai file koneksi.php Anda
include "services/database.php"; 

if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
    header("location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// --- LOGIKA CRUD (POST) ---
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

    // 3. HAPUS TUGAS (Delete - Referensi delete.php)
    if (isset($_POST['hapus_tugas'])) {
        $id_tgs = $_POST['id_tugas'];
        $db->query("DELETE FROM tasks WHERE id = '$id_tgs' AND user_id = '$user_id'");
    }
    header("Location: dashboard.php");
    exit;
}

// --- LOGIKA SEARCH ---
$cari = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : "";

// --- QUERY TUGAS AKTIF & LOGIKA TERLAMBAT ---
$sql_aktif = "SELECT *, 
             (CASE WHEN CONCAT(deadline, ' ', waktu) < NOW() THEN 'Terlambat' ELSE 'Mendatang' END) as status_waktu 
             FROM tasks 
             WHERE user_id = '$user_id' AND status = 'Belum Selesai' 
             AND (nama_tugas LIKE '%$cari%' OR deskripsi LIKE '%$cari%')
             ORDER BY deadline ASC, waktu ASC";
$res_aktif = $db->query($sql_aktif);

// --- QUERY RIWAYAT ---
$res_riwayat = $db->query("SELECT * FROM tasks WHERE user_id='$user_id' AND status='Selesai' ORDER BY selesai_at DESC LIMIT 5");

// --- DATA GRAFIK SKOR KONSISTENSI (7 Hari Terakhir) ---
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
    <title>SIMUT - Dashboard Komplit</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; }
        .bg-danger { background: #e74c3c; color: white; }
        .bg-info { background: #3498db; color: white; }
        .bg-success { background: #2ecc71; color: white; }
        .task-card { background: white; color: #333; padding: 15px; border-radius: 10px; margin-bottom: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: left; }
        .desc-box { font-size: 0.85rem; color: #555; margin: 8px 0; padding-left: 10px; border-left: 3px solid #eee; }
        .riwayat-card { opacity: 0.7; border-left: 5px solid #2ecc71; }
        .search-input { width: 100%; padding: 10px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.3); background: rgba(255,255,255,0.1); color: white; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container" style="width: 500px; min-height: 100vh; padding: 20px;">
        <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="margin: 0;">Halo, <?= htmlspecialchars($username) ?>!</h2>
            <button onclick="location.href='logout.php'" style="width: auto; padding: 5px 15px; background: #666;">Logout</button>
        </header>

        <form method="GET">
            <input type="text" name="search" class="search-input" placeholder="🔍 Cari tugas..." value="<?= htmlspecialchars($cari) ?>">
        </form>

        <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 10px; margin-bottom: 25px;">
            <form method="POST">
                <input type="text" name="nama_tugas" placeholder="Judul Tugas" required>
                <textarea name="deskripsi" placeholder="Deskripsi..." style="width:100%; height:50px; margin-bottom:10px; border-radius:5px; padding:10px;"></textarea>
                <div style="display: flex; gap: 10px;">
                    <input type="date" name="deadline" required>
                    <input type="time" name="waktu" required>
                </div>
                <select name="prioritas" style="width:100%; padding:10px; margin-bottom:10px; border-radius:5px;">
                    <option value="Tinggi">Tinggi</option>
                    <option value="Sedang" selected>Sedang</option>
                    <option value="Rendah">Rendah</option>
                </select>
                <button type="submit" name="tambah_tugas">Simpan Tugas</button>
            </form>
        </div>

        <h3>🚀 Tugas Aktif</h3>
        <?php while($row = $res_aktif->fetch_assoc()): ?>
            <div class="task-card">
                <div style="display: flex; justify-content: space-between;">
                    <strong><?= htmlspecialchars($row['nama_tugas']) ?></strong>
                    <span class="badge <?= $row['status_waktu'] == 'Terlambat' ? 'bg-danger' : 'bg-info' ?>">
                        <?= $row['status_waktu'] ?>
                    </span>
                </div>
                <div class="desc-box"><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></div>
                <small style="color: <?= $row['status_waktu'] == 'Terlambat' ? '#e74c3c' : '#888' ?>;">
                    ⏰ Deadline: <?= $row['deadline'] ?> | <?= $row['waktu'] ?>
                </small>
                <div style="display: flex; gap: 5px; margin-top: 10px;">
                    <form method="POST" style="flex: 1;"><input type="hidden" name="id_tugas" value="<?= $row['id'] ?>"><button type="submit" name="set_selesai" class="bg-success">Selesai</button></form>
                    <form method="POST" onsubmit="return confirm('Hapus?')"><input type="hidden" name="id_tugas" value="<?= $row['id'] ?>"><button type="submit" name="hapus_tugas" class="bg-danger">Hapus</button></form>
                </div>
            </div>
        <?php endwhile; ?>

        <div style="margin-top: 30px; background: white; padding: 20px; border-radius: 12px;">
            <h3 style="color: #333; margin: 0; font-size: 14px;">Grafik Skor Konsistensi</h3>
            <canvas id="performaChart"></canvas>
        </div>

        <h3 style="margin-top: 30px;">✅ Riwayat Terakhir</h3>
        <?php while($h = $res_riwayat->fetch_assoc()): ?>
            <div class="task-card riwayat-card">
                <div style="display: flex; justify-content: space-between;">
                    <span style="text-decoration: line-through;"><?= htmlspecialchars($h['nama_tugas']) ?></span>
                    <span class="badge <?= ($h['poin_konsistensi'] == 10) ? 'bg-success' : 'bg-danger' ?>">
                        <?= ($h['poin_konsistensi'] == 10) ? '+10' : '+2 (Telat)' ?>
                    </span>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <script>
    const ctx = document.getElementById('performaChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Skor Konsistensi',
                data: <?= json_encode($data_poin) ?>,
                borderColor: '#4facfe',
                backgroundColor: 'rgba(79, 172, 254, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });
    </script>
</body>
</html>