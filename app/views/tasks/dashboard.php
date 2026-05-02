<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Student Productivity</title>
    <link rel="stylesheet" href="<?= BASE_PATH ?>/public/assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Gaya untuk Toast Notification */
        .toast-notif {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #10b981; /* Hijau Sukses */
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            z-index: 9999;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .toast-notif.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-brand">Student Productivity Dashboard</div>
        <div class="nav-right">
            <div class="nav-user">Halo, <?= htmlspecialchars($_SESSION['username'] ?? 'Student') ?>!</div>
            <a href="<?= BASE_PATH ?>/index.php?url=auth/logout" class="btn btn-logout">Logout</a>
        </div>
    </nav>

    <!-- Cek dan Tampilkan Flash Notification -->
    <?php if (isset($_SESSION['flash_success'])): ?>
        <div id="toastNotif" class="toast-notif">
            ✅ <?= $_SESSION['flash_success'] ?>
        </div>
        <!-- Langsung hapus session agar tidak muncul terus saat di-refresh -->
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <div class="container">
        
        <!-- Toolbar & Search -->
        <div class="toolbar">
            <form method="GET" action="<?= BASE_PATH ?>/index.php" class="search-form">
                <input type="hidden" name="url" value="task/index">
                <input type="text" name="search" placeholder="🔍 Cari tugas atau deskripsi..." value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
                <?php if(!empty($search)): ?>
                    <a href="<?= BASE_PATH ?>/index.php?url=task/index" class="btn btn-secondary">Reset</a>
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
                    <form action="<?= BASE_PATH ?>/index.php?url=task/store" method="POST">
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
                                        <button type="button" class="btn btn-primary btn-sm" onclick="openEditModal('<?= $row['id'] ?>', '<?= htmlspecialchars(addslashes($row['nama_tugas'])) ?>', '<?= htmlspecialchars(addslashes($row['deskripsi'])) ?>', '<?= $row['deadline'] ?>', '<?= $row['waktu'] ?>', '<?= $row['prioritas'] ?>')">Edit</button>
                                        <form method="POST" action="<?= BASE_PATH ?>/index.php?url=task/done/<?= $row['id'] ?>" style="display:inline;">
                                            <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                                        </form>
                                        <form method="POST" action="<?= BASE_PATH ?>/index.php?url=task/delete/<?= $row['id'] ?>" style="display:inline;" onsubmit="return confirm('Apakah kamu yakin ingin menghapus tugas ini? Data yang sudah dihapus tidak dapat dikembalikan.');">
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
                                    <span class="badge <?= ($h['poin_konsistensi'] >= 5) ? 'badge-done' : 'badge-overdue' ?>">
                                        +<?= $h['poin_konsistensi'] ?> Poin
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT TUGAS (POP-UP) -->
    <div id="editTaskModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.8); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
        <div class="task-card" style="width: 90%; max-width: 500px; background: #1e293b; border: 1px solid rgba(56,189,248,.4); box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h3 style="margin: 0; color: var(--primary);">Edit Tugas</h3>
                <button type="button" onclick="closeEditModal()" style="background: none; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer;">&times;</button>
            </div>
            
            <form id="editTaskForm" action="" method="POST">
                <input type="hidden" name="task_id" id="edit_task_id">
                
                <div class="form-group">
                    <label>Nama Tugas</label>
                    <input type="text" name="nama_tugas" id="edit_nama_tugas" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" id="edit_deskripsi" rows="2"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Deadline</label>
                        <input type="date" name="deadline" id="edit_deadline" required>
                    </div>
                    <div class="form-group">
                        <label>Waktu</label>
                        <input type="time" name="waktu" id="edit_waktu" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Prioritas</label>
                    <select name="prioritas" id="edit_prioritas">
                        <option value="Tinggi">Tinggi</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Rendah">Rendah</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block" style="margin-top: 1rem;">Simpan Perubahan</button>
            </form>
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

    // Logika Pop-up Edit
    function openEditModal(id, nama, desk, deadline, waktu, prioritas) {
        document.getElementById('edit_task_id').value = id;
        
        const form = document.getElementById('editTaskForm');
        form.action = `<?= BASE_PATH ?>/index.php?url=task/update/${id}`;

        document.getElementById('edit_nama_tugas').value = nama;
        document.getElementById('edit_deskripsi').value = desk;
        document.getElementById('edit_deadline').value = deadline;
        document.getElementById('edit_waktu').value = waktu;
        document.getElementById('edit_prioritas').value = prioritas;
        
        document.getElementById('editTaskModal').style.display = 'flex';
    }
    function closeEditModal() {
        document.getElementById('editTaskModal').style.display = 'none';
    }
    </script>
</body>
</html>