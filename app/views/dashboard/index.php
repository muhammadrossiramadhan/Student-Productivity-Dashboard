<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Produktivitas</title>
    <!-- Menghubungkan ke file CSS yang terpisah -->
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <!-- Menggunakan Font Awesome untuk Ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="dashboard-container">

        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="user-profile">
                <div class="avatar"></div>
                <span class="user-name"><?php echo htmlspecialchars($data['panggilan']); ?></span>
            </div>

            <nav class="menu">
                <a href="#" class="menu-item active"><i class="fas fa-home"></i> Beranda</a>
            </nav>

            <div class="bottom-menu">
                <a href="#" class="menu-item"><i class="fas fa-question-circle"></i> Help</a>
                <a href="index.php?action=logout" class="menu-item text-danger"><i class="fas fa-sign-out-alt"></i>
                    Logout</a>
            </div>
        </aside>

        <!-- Area Konten Utama -->
        <main class="main-content">
            <header class="top-header">
                <h1><i class="fas fa-home"></i> BERANDA </h1>
                <!-- Tombol Tambah Tugas -->
                <button class="btn-primary" onclick="openAddModal()"><i class="fas fa-plus"></i> Tambah Tugas</button>
            </header>

            <section class="content-section">
                <h2>TUGAS</h2>
                <div class="card-grid">
                    <?php if (!empty($data['tasks'])): ?>
                        <?php foreach ($data['tasks'] as $task): ?>
                            <!-- Tugas -->
                            <div class="card"
                                onclick='openEditModal(<?php echo json_encode($task, JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'>
                                <div class="card-info">
                                    <span class="status-dot <?php echo strtolower($task['prioritas']); ?>"></span>
                                    <div>
                                        <h3><?php echo htmlspecialchars($task['judul']); ?></h3>
                                        <p>Deadline : <?php echo date('d M Y, H:i', strtotime($task['deadline'])); ?></p>
                                        <span
                                            class="priority-badge <?php echo strtolower($task['prioritas']); ?>"><?php echo htmlspecialchars($task['prioritas']); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: var(--text-muted);">Belum Ada Tugas.</p>
                    <?php endif; ?>
                </div>
            </section>
        </main>
    </div>

    <!-- Tambah Tugas -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddModal()">&times;</span>
            <h2>Tambah Tugas Baru</h2>
            <form action="index.php?action=add_task" method="POST">
                <div class="input-group">
                    <label for="judul">Judul Tugas</label>
                    <input type="text" id="judul" name="judul" required>
                </div>
                <div class="input-group">
                    <label for="deadline">Deadline</label>
                    <input type="datetime-local" id="deadline" name="deadline" required>
                </div>
                <div class="input-group">
                    <label for="prioritas">Prioritas</label>
                    <select id="prioritas" name="prioritas">
                        <option value="Tinggi">Tinggi</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Rendah">Rendah</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3"></textarea>
                </div>
                <button type="submit" class="btn-primary" style="width: 100%;">Simpan Tugas</button>
            </form>
        </div>
    </div>

    <!-- Detail Tugas -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Detail Tugas</h2>
            <form action="index.php?action=edit_task" method="POST">
                <input type="hidden" id="edit_task_id" name="task_id">
                <div class="input-group">
                    <label for="edit_judul">Judul Tugas</label>
                    <input type="text" id="edit_judul" name="judul" required>
                </div>
                <div class="input-group">
                    <label for="edit_deadline">Deadline</label>
                    <input type="datetime-local" id="edit_deadline" name="deadline" required>
                </div>
                <div class="input-group">
                    <label for="edit_prioritas">Prioritas</label>
                    <select id="edit_prioritas" name="prioritas">
                        <option value="Tinggi">Tinggi</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Rendah">Rendah</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="edit_deskripsi">Deskripsi</label>
                    <textarea id="edit_deskripsi" name="deskripsi" rows="3"></textarea>
                </div>
                <div class="modal-actions">
                    <button type="submit" class="btn-primary">Update Tugas</button>
                    <a href="#" id="delete_link" class="btn-danger"
                        onclick="return confirm('Yakin ingin menghapus tugas ini?')">Hapus</a>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/dashboard.js"></script>
</body>

</html>