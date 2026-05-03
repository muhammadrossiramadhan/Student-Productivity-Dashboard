<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Student Productivity</title>
    <!-- Menggunakan CSS Dashboard khusus (UI Yoshua) -->
    <link rel="stylesheet" href="<?= BASE_PATH ?>/public/assets/css/dashboard.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <!-- Cek dan Tampilkan Flash Notification -->
    <?php if (isset($_SESSION['flash_success'])): ?>
        <div id="toastNotif" class="toast-notif">
            ✅ <?= $_SESSION['flash_success'] ?>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <div class="dashboard-container">
        
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="user-profile">
                <div class="avatar"><i class="fas fa-user"></i></div>
                <span class="user-name"><?= htmlspecialchars($_SESSION['panggilan'] ?? $_SESSION['username']) ?></span>
            </div>

            <nav class="menu">
                <a href="<?= BASE_PATH ?>/index.php?url=task/index" class="menu-item active"><i class="fas fa-home"></i> Beranda</a>
            </nav>

            <div class="bottom-menu">
                <a href="<?= BASE_PATH ?>/index.php?url=auth/logout" class="menu-item text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </aside>

        <!-- Area Konten Utama -->
        <main class="main-content">
            <header class="top-header">
                <h1><i class="fas fa-home"></i> BERANDA </h1>
                
                <!-- Fitur Pencarian MVC Terintegrasi -->
                <form method="GET" action="<?= BASE_PATH ?>/index.php" class="search-form">
                    <input type="hidden" name="url" value="task/index">
                    <input type="text" name="search" class="search-input" placeholder="🔍 Cari tugas atau deskripsi..." value="<?= htmlspecialchars($search ?? '') ?>">
                    <button type="submit" class="btn-primary">Cari</button>
                </form>

                <!-- Tombol Tambah Tugas -->
                <button class="btn-primary" onclick="openAddModal()"><i class="fas fa-plus"></i> Tambah Tugas</button>
            </header>

            <!-- Section Daftar Tugas -->
            <section class="content-section">
                <h2>TUGAS AKTIF</h2>
                <div class="card-grid">
                    <?php if (!empty($activeTasks)): ?>
                        <?php foreach ($activeTasks as $task): ?>
                            <!-- Tugas Card MVC x UI Yoshua -->
                            <div class="card" onclick='openEditModal(<?= json_encode($task, JSON_HEX_APOS | JSON_HEX_QUOT) ?>, "<?= BASE_PATH ?>")'>
                                <div class="card-info">
                                    <div>
                                        <h3><?= htmlspecialchars($task['nama_tugas']) ?></h3>
                                        <p><i class="fas fa-clock"></i> <?= date('d M Y', strtotime($task['deadline'])) ?>, Pukul <?= $task['waktu'] ?></p>
                                        
                                        <!-- Logika Label Waktu & Prioritas -->
                                        <?php $isOverdue = ($task['status_waktu'] === 'Terlambat'); ?>
                                        <span class="priority-badge <?= $isOverdue ? 'tinggi' : strtolower($task['prioritas']) ?>">
                                            <?= $isOverdue ? 'Terlambat' : htmlspecialchars($task['prioritas']) ?>
                                        </span>
                                    </div>
                                </div>
                                <!-- Aksi Selesai & Hapus -->
                                <div class="card-actions">
                                    <form method="POST" action="<?= BASE_PATH ?>/index.php?url=task/done/<?= $task['id'] ?>" onclick="event.stopPropagation();">
                                        <button type="submit" class="btn-success"><i class="fas fa-check"></i> Selesai</button>
                                    </form>
                                    <form method="POST" action="<?= BASE_PATH ?>/index.php?url=task/delete/<?= $task['id'] ?>" onclick="event.stopPropagation();" onsubmit="return confirm('Apakah kamu yakin ingin menghapus tugas ini?');">
                                        <button type="submit" class="btn-danger-sm"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: var(--text-muted);"><i class="fas fa-glass-cheers"></i> Yeay! Belum Ada Tugas.</p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Pemisahan Area Riwayat & Grafik Performa MVC -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 48px;">
                <section class="content-section">
                    <h2>RIWAYAT TERAKHIR</h2>
                    <div class="card-grid" style="grid-template-columns: 1fr;">
                        <?php if(!empty($historyTasks)): ?>
                            <?php foreach ($historyTasks as $h): ?>
                                <div class="card" style="cursor: default;">
                                    <div class="card-info" style="display: flex; justify-content: space-between; align-items: center;">
                                        <h3 style="margin:0; font-size: 0.95rem; text-decoration: line-through; color: var(--text-muted);"><?= htmlspecialchars($h['nama_tugas']) ?></h3>
                                        <span class="priority-badge rendah">+<?= $h['poin_konsistensi'] ?> Poin</span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p style="color: var(--text-muted);">Belum ada riwayat tugas selesai.</p>
                        <?php endif; ?>
                    </div>
                </section>

                <section class="content-section">
                    <h2>GRAFIK KONSISTENSI</h2>
                    <div class="card" style="cursor: default;">
                        <canvas id="performaChart"></canvas>
                    </div>
                </section>
            </div>

        </main>
    </div>

    <!-- Modal Tambah Tugas MVC -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddModal()" title="Tutup">&times;</span>
            <h2>Tambah Tugas Baru</h2>
            <form action="<?= BASE_PATH ?>/index.php?url=task/store" method="POST">
                <div class="input-group">
                    <label for="judul">Nama Tugas</label>
                    <input type="text" id="judul" name="nama_tugas" required placeholder="Contoh: Makalah Basis Data">
                </div>
                <div class="input-row">
                    <div class="input-group">
                        <label for="deadline">Tanggal Deadline</label>
                        <input type="date" id="deadline" name="deadline" required>
                    </div>
                    <div class="input-group">
                        <label for="waktu">Waktu</label>
                        <input type="time" id="waktu" name="waktu" required>
                    </div>
                </div>
                <div class="input-group">
                    <label for="prioritas">Prioritas</label>
                    <select id="prioritas" name="prioritas">
                        <option value="Tinggi">Tinggi</option>
                        <option value="Sedang" selected>Sedang</option>
                        <option value="Rendah">Rendah</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="deskripsi">Deskripsi Singkat</label>
                    <textarea id="deskripsi" name="deskripsi" rows="2" placeholder="Catatan opsional..."></textarea>
                </div>
                <button type="submit" class="btn-primary" style="width: 100%; margin-top: 10px;">Simpan Tugas</button>
            </form>
        </div>
    </div>

    <!-- Modal Detail & Edit Tugas MVC -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()" title="Tutup">&times;</span>
            <h2>Detail Tugas</h2>
            <form id="editTaskForm" action="" method="POST">
                <input type="hidden" id="edit_task_id" name="task_id">
                <div class="input-group">
                    <label>Nama Tugas</label>
                    <input type="text" id="edit_judul" name="nama_tugas" required>
                </div>
                <div class="input-row">
                    <div class="input-group">
                        <label>Tanggal Deadline</label>
                        <input type="date" id="edit_deadline" name="deadline" required>
                    </div>
                    <div class="input-group">
                        <label>Waktu</label>
                        <input type="time" id="edit_waktu" name="waktu" required>
                    </div>
                </div>
                <div class="input-group">
                    <label>Prioritas</label>
                    <select id="edit_prioritas" name="prioritas">
                        <option value="Tinggi">Tinggi</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Rendah">Rendah</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Deskripsi Singkat</label>
                    <textarea id="edit_deskripsi" name="deskripsi" rows="2"></textarea>
                </div>
                <button type="submit" class="btn-primary" style="width: 100%; margin-top: 10px;">Update Tugas</button>
            </form>
        </div>
    </div>

    <!-- Load File JS Dashboard khusus Yoshua -->
    <script src="<?= BASE_PATH ?>/public/assets/js/dashboard.js"></script>
    
    <!-- Inisialisasi Chart.js -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('performaChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($chartData['labels']) ?>,
                datasets: [{
                    label: 'Skor Konsistensi',
                    data: <?= json_encode($chartData['data']) ?>,
                    borderColor: '#38bdf8',
                    backgroundColor: 'rgba(41, 121, 255, 0.2)',
                    fill: false,
                    tension: 0.4
                }]
            },
            options: {
                scales: { y: { beginAtZero: true } },
                plugins: { legend: { labels: { color: '#e2e8f0' } } },
                color: '#94a3b8'
            }
        });

        // Logika animasi memunculkan dan menghilangkan Toast Notification
        const toast = document.getElementById('toastNotif');
        if (toast) {
            setTimeout(() => toast.classList.add('show'), 100); // Muncul perlahan setelah dimuat
            setTimeout(() => {
                toast.classList.remove('show'); // Hilang perlahan
                setTimeout(() => toast.remove(), 300); // Hapus dari sistem (DOM)
            }, 3000); // Tampil selama 3 detik
        }
    });
    </script>
</body>
</html>