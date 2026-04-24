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

    // 3. HAPUS TUGAS (Delete)
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

// --- DATA GRAFIK SKOR KONSISTENSI ---
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
    <title>Dashboard Produktivitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .border-left-primary { border-left: 5px solid #4facfe !important; }
        .border-left-success { border-left: 5px solid #2ecc71 !important; }
        .desc-box { background: #f8f9fa; padding: 10px; border-radius: 8px; font-size: 0.9rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">🎓 Student Dashboard</a>
        <div class="d-flex align-items-center">
            <span class="text-white me-3 d-none d-md-block">Halo, <?= htmlspecialchars($username) ?>!</span>
            <button onclick="location.href='logout.php'" class="btn btn-light btn-sm fw-bold text-primary">Logout</button>
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <form method="GET" class="mb-3">
                <div class="input-group shadow-sm">
                    <input type="text" name="search" class="form-control" placeholder="🔍 Cari tugas..." value="<?= htmlspecialchars($cari) ?>">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>

            <div class="card mb-4">
                <div class="card-header bg-white fw-bold py-3">📝 Tambah Tugas Baru</div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" name="nama_tugas" class="form-control" placeholder="Judul Tugas" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="deskripsi" class="form-control" placeholder="Deskripsi detail..." rows="2"></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label small text-muted">Deadline</label>
                                <input type="date" name="deadline" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Waktu</label>
                                <input type="time" name="waktu" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <select name="prioritas" class="form-select">
                                <option value="Tinggi">🔥 Prioritas Tinggi</option>
                                <option value="Sedang" selected>⚡ Prioritas Sedang</option>
                                <option value="Rendah">☕ Prioritas Rendah</option>
                            </select>
                        </div>
                        <button type="submit" name="tambah_tugas" class="btn btn-primary w-100 fw-bold">Simpan Tugas</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">📈 Performa Konsistensi </h6>
                    <canvas id="performaChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <h5 class="fw-bold mb-3 text-secondary">🚀 Tugas Aktif</h5>
            <div class="row">
                <?php while($row = $res_aktif->fetch_assoc()): ?>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 border-left-primary">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between mb-2">
                                    <h6 class="fw-bold text-dark mb-0"><?= htmlspecialchars($row['nama_tugas']) ?></h6>
                                    <span class="badge <?= $row['status_waktu'] == 'Terlambat' ? 'bg-danger' : 'bg-info' ?>">
                                        <?= $row['status_waktu'] ?>
                                    </span>
                                </div>
                                <div class="desc-box mb-3 flex-grow-1 text-muted">
                                    <?= nl2br(htmlspecialchars($row['deskripsi'])) ?>
                                </div>
                                <div class="small fw-bold mb-3" style="color: <?= $row['status_waktu'] == 'Terlambat' ? '#e74c3c' : '#7f8c8d' ?>;">
                                    ⏰ <?= $row['deadline'] ?> pukul <?= $row['waktu'] ?>
                                </div>
                                <div class="d-flex gap-2 mt-auto">
                                    <form method="POST" class="flex-grow-1">
                                        <input type="hidden" name="id_tugas" value="<?= $row['id'] ?>">
                                        <button type="submit" name="set_selesai" class="btn btn-success btn-sm w-100 fw-bold">✓ Selesai</button>
                                    </form>
                                    <form method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                                        <input type="hidden" name="id_tugas" value="<?= $row['id'] ?>">
                                        <button type="submit" name="hapus_tugas" class="btn btn-outline-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php if($res_aktif->num_rows == 0): ?>
                    <div class="col-12"><div class="alert alert-light text-center border">Hore! Tidak ada tugas aktif saat ini. 🎉</div></div>
                <?php endif; ?>
            </div>

            <h5 class="fw-bold mt-4 mb-3 text-secondary">✅ Riwayat Terakhir</h5>
            <div class="list-group shadow-sm mb-4">
                <?php while($h = $res_riwayat->fetch_assoc()): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center border-left-success">
                        <span class="text-decoration-line-through text-muted"><?= htmlspecialchars($h['nama_tugas']) ?></span>
                        <span class="badge <?= ($h['poin_konsistensi'] == 10) ? 'bg-success' : 'bg-warning text-dark' ?> rounded-pill">
                            <?= ($h['poin_konsistensi'] == 10) ? '+10 Poin' : '+2 Poin (Telat)' ?>
                        </span>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<script>
const ctx = document.getElementById('performaChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            label: 'Skor',
            data: <?= json_encode($data_poin) ?>,
            borderColor: '#4facfe',
            backgroundColor: 'rgba(79, 172, 254, 0.2)',
            fill: true,
            tension: 0.4
        }]
    },
    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>