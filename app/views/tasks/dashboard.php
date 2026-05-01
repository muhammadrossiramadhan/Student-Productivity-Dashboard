<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Student.io</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-brand">Student Productivity Dashboard</div>
        <div class="nav-right">
            <div class="nav-user">Halo, <?= htmlspecialchars($_SESSION['username'] ?? 'Student') ?>!</div>
            <a href="index.php?url=auth/logout" class="btn btn-logout">Logout</a>
        </div>
    </nav>

    <div class="container">
        
        <!-- Toolbar & Search -->
        <div class="toolbar">
            <form method="GET" action="index.php" class="search-form">
                <input type="hidden" name="url" value="task/index">
                <input type="text" name="search" placeholder="🔍 Cari tugas atau deskripsi..." value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
                <?php if(!empty($search)): ?>
                    <a href="index.php?url=task/index" class="btn btn-secondary">Reset</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Main Grid Layout -->
        <div class="form-row">
            
            <!-- Kolom Kiri -->
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                
                <!-- Form Buat Tugas -->
                <div class="task-card" style="border-color: rgba(56,189,248,.4);">
                    <h3 style="margin-bottom: 1rem; color: var(--primary);">Buat Tugas Baru</h3>
                    <form action="index.php?url=task/store" method="POST">
                        <div class="form-group">
                            <label>Nama Tugas</label>
                            <input type="text" name="nama_tugas" required placeholder="Contoh: Makalah Basis Data">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" rows="2" placeholder="Catatan tambahan..."></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Deadline</label>
                                <input type="date" name="deadline" required>
                            </div>
                            <div class="form-group">
                                <label>Waktu</label>
                                <input type="time" name="waktu" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Prioritas</label>
                            <select name="prioritas">
                                <option value="Tinggi">Tinggi</option>
                                <option value="Sedang" selected>Sedang</option>
                                <option value="Rendah">Rendah</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Simpan Tugas</button>
                    </form>
                </div>

                <!-- Daftar Tugas Aktif -->
                <div>
                    <h3 style="margin-bottom: 1rem;">Tugas Aktif</h3>
                    <div class="task-list">
                        <?php if (empty($activeTasks)): ?>
                            <div class="empty-state">
                                <div class="empty-icon">🎉</div>
                                <p>Yeay! Tidak ada tugas yang tertunda.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($activeTasks as $row): 
                                $isOverdue = $row['status_waktu'] === 'Terlambat';
                                $badgeClass = $isOverdue ? 'badge-overdue' : 'prioritas-' . strtolower($row['prioritas']);
                            ?>
                                <div class="task-card <?= $isOverdue ? 'task-overdue' : '' ?>">
                                    <div style="display: flex; justify-content: space-between; align-items: start;">
                                        <div class="task-title"><?= htmlspecialchars($row['nama_tugas']) ?></div>
                                        <span class="badge <?= $badgeClass ?>"><?= $row['status_waktu'] ?></span>
                                    </div>
                                    <div class="task-desc"><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></div>
                                    <div class="task-meta">
                                        <span>⏰ <?= date('d M Y', strtotime($row['deadline'])) ?> | <?= $row['waktu'] ?></span>
                                    </div>
                                    <div class="task-actions" style="margin-top: 0.5rem;">
                                        <form method="POST" action="index.php?url=task/done/<?= $row['id'] ?>" style="display:inline;">
                                            <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                                        </form>
                                        <form method="POST" action="index.php?url=task/delete/<?= $row['id'] ?>" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus tugas ini?');">
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                
                <div class="task-card">
                    <h3 style="margin-bottom: 1rem; font-size: 1rem;">Grafik Skor Konsistensi</h3>
                    <canvas id="performaChart"></canvas>
                </div>

                <div>
                    <h3 style="margin-bottom: 1rem;">Riwayat Terakhir</h3>
                    <div class="task-list">
                        <?php foreach ($historyTasks as $h): ?>
                            <div class="task-card task-done">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div class="task-title" style="margin: 0; font-size: 0.95rem;"><?= htmlspecialchars($h['nama_tugas']) ?></div>
                                    <span class="badge <?= ($h['poin_konsistensi'] == 10) ? 'badge-done' : 'badge-overdue' ?>">
                                        <?= ($h['poin_konsistensi'] == 10) ? '+10 Poin' : '+2 Poin (Telat)' ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    backgroundColor: 'rgba(56, 189, 248, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                scales: { y: { beginAtZero: true } },
                plugins: { legend: { labels: { color: '#e2e8f0' } } },
                color: '#94a3b8'
            }
        });
    });
    </script>
</body>
</html>