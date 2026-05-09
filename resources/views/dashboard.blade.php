<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Student Productivity</title>
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* CSS Darurat untuk mengamankan responsivitas saat dosen menekan Ctrl+Shift+C */
        .mobile-menu-btn { display: none; }
        .logo-wrapper { margin-bottom: 32px; } /* Dipindah dari inline-style HTML ke sini untuk desktop */
        .mobile-menu-item { display: none; }
        .mobile-header-statistik { display: none; }
        .mobile-swipe-hint { display: none; } /* Sembunyikan hint swipe di Desktop */
        
        @media (max-width: 768px) {
            .dashboard-container { 
                flex-direction: column !important; 
                justify-content: flex-start !important; 
                height: auto !important; 
            }
            .sidebar { 
                width: 100% !important; height: auto !important; min-height: 0 !important; flex: none !important; position: static !important;
                display: flex; flex-direction: column; justify-content: flex-start !important; gap: 0 !important;
                padding: 10px 15px; border-bottom: 1px solid rgba(255,255,255,0.1);
            }
            .sidebar-brand { display: flex; justify-content: space-between; align-items: center; width: 100%; }
            .logo-wrapper { margin-bottom: 0 !important; }
            
            .mobile-menu-btn { display: block; background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; }
            
            .sidebar-menu-collapse { display: none; flex-direction: column; width: 100%; margin-top: 10px; gap: 5px; }
            .sidebar-menu-collapse.show { display: flex; }

            .user-profile { margin-bottom: 0; padding: 5px 0 10px 0; border: none; border-bottom: 1px solid rgba(255,255,255,0.1); }
            .menu { display: flex; flex-direction: column; gap: 5px; margin-bottom: 0; }
            .menu-item { padding: 8px 10px !important; text-align: left; width: 100%; }
            .bottom-menu { position: static !important; margin-top: 0; }
            
            .main-content { padding: 15px !important; width: 100% !important; margin: 0 !important; flex: 1 !important; }
            .top-header { flex-direction: column; align-items: stretch; gap: 15px; height: auto !important; margin-top: 0 !important; }
            .top-header h1 { margin: 0 !important; font-size: 1.3rem !important; }
            .search-form { width: 100%; }
            .search-input { width: 100%; box-sizing: border-box; }
            
            .card-grid { grid-template-columns: 1fr !important; }
            .dashboard-widgets { display: flex; flex-direction: column; gap: 20px; }
            .input-row { display: flex; flex-direction: column; gap: 10px; }
            
            .modal-content { width: 95% !important; margin: 10% auto !important; padding: 20px !important; }
            
            /* Tab System ala Aplikasi Native untuk Mobile */
            .mobile-menu-item { display: block; width: 100%; }
            .chart-section { display: none !important; } /* Sembunyikan grafik by default (Beranda) */
            
            main.show-statistik .content-section:not(.chart-section) { display: none !important; }
            main.show-statistik .top-header:not(.mobile-header-statistik) { display: none !important; }
            
            main.show-statistik .chart-section { display: block !important; }
            main.show-statistik .mobile-header-statistik { display: flex !important; }
            
            /* Perbaikan UI Grafik agar bisa digeser di mode Statistik Mobile */
            .chart-wrapper { width: 100%; overflow-x: auto; overflow-y: hidden; }
            .chart-inner { min-width: 500px; height: 250px; position: relative; }
            
            .mobile-swipe-hint {
                display: block;
                font-size: 0.75rem;
                color: #94a3b8; /* Warna teks abu-abu redup */
                text-align: center;
                margin-bottom: 10px;
                font-style: italic;
            }
        }
    </style>
</head>
<body>

    @if (session('success'))
        <div id="toastNotif" class="toast-notif">
            {{ session('success') }}
        </div>
    @endif

    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-brand">
                <!-- Logo Branding (Klik untuk ke Landing Page) -->
                <div class="logo-wrapper">
                    <a href="{{ url('/') }}" style="color: var(--primary); font-size: 1.5rem; font-weight: 800; text-decoration: none; letter-spacing: 1px; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-graduation-cap"></i> Student.io
                    </a>
                </div>
                <button id="mobile-menu-btn" class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div id="sidebar-menu-collapse" class="sidebar-menu-collapse">
                <div class="user-profile">
                    <div class="avatar"><i class="fas fa-user"></i></div>
                    <span class="user-name">{{ auth()->user()->panggilan ?? auth()->user()->username }}</span>
                </div>

                <nav class="menu">
                    <a href="{{ url('/dashboard') }}" id="menu-beranda" class="menu-item active" onclick="if(window.innerWidth <= 768) { switchMobileView('beranda'); return false; }"><i class="fas fa-home"></i> Beranda</a>
                    <a href="#" id="menu-statistik" class="menu-item mobile-menu-item" onclick="switchMobileView('statistik'); return false;"><i class="fas fa-chart-line"></i> Statistik</a>
                </nav>

                <div class="bottom-menu">
                    <form method="POST" action="{{ url('/logout') }}">
                        @csrf
                        <button type="submit" class="menu-item text-danger" style="background:none; border:none; width:100%; text-align:left; cursor:pointer;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <header class="top-header">
                <h1><i class="fas fa-home"></i> BERANDA </h1>
                
                <form method="GET" action="{{ url('/dashboard') }}" class="search-form">
                    <input type="text" name="search" class="search-input" placeholder="Cari tugas atau deskripsi..." value="{{ request('search') }}">
                    <button type="submit" class="btn-primary">Cari</button>
                </form>

                <button class="btn-primary" onclick="openAddModal()"><i class="fas fa-plus"></i> Tambah Tugas</button>
            </header>

            <!-- Header khusus untuk mode Statistik di Mobile -->
            <header class="top-header mobile-header-statistik" style="margin-top: 0 !important; margin-bottom: 20px;">
                <h1><i class="fas fa-chart-line"></i> STATISTIK KONSISTENSI </h1>
            </header>

            <section class="content-section">
                <h2>TUGAS AKTIF</h2>
                <div class="card-grid">
                    @forelse ($activeTasks as $task)
                        <div class="card" onclick='openEditModal(@json($task), "{{ url('/tasks') }}")'>
                            <div class="card-info">
                                <div>
                                    <h3>{{ $task->nama_tugas }}</h3>
                                    <p><i class="fas fa-clock"></i> {{ date('d M Y', strtotime($task->deadline)) }}, Pukul {{ $task->waktu }}</p>
                                    
                                    @php $isOverdue = ($task->status_waktu === 'Terlambat'); @endphp
                                    <span class="priority-badge {{ $isOverdue ? 'tinggi' : strtolower($task->prioritas) }}">
                                        {{ $isOverdue ? 'Terlambat' : $task->prioritas }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-actions">
                                <form method="POST" action="{{ url('/tasks/'.$task->id.'/done') }}" onclick="event.stopPropagation();">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-success"><i class="fas fa-check"></i> Selesai</button>
                                </form>
                                <form method="POST" action="{{ url('/tasks/'.$task->id) }}" onclick="event.stopPropagation();" onsubmit="return confirm('Apakah kamu yakin ingin menghapus tugas ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger-sm"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p style="color: var(--text-muted);"><i class="fas fa-glass-cheers"></i> Yeay! Belum Ada Tugas.</p>
                    @endforelse
                </div>
            </section>

            <div class="dashboard-widgets">
                <section class="content-section">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                        <h2 style="margin-bottom: 0;">RIWAYAT TERAKHIR</h2>
                        @if($historyTasks->count() > 0)
                        <form method="POST" action="{{ url('/tasks/clear-history') }}" onsubmit="return confirm('Yakin ingin menghapus semua riwayat tugas?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger-sm" style="padding: 6px 12px; font-size: 0.75rem;"><i class="fas fa-trash-alt"></i> Bersihkan</button>
                        </form>
                        @endif
                    </div>
                    <div class="card-grid" style="grid-template-columns: 1fr;">
                        @forelse ($historyTasks as $h)
                            <div class="card" style="cursor: default;">
                                <div class="card-info" style="display: flex; justify-content: space-between; align-items: center;">
                                    <h3 style="margin:0; font-size: 0.95rem; text-decoration: line-through; color: var(--text-muted);">{{ $h->nama_tugas }}</h3>
                                    <span class="priority-badge rendah">+{{ $h->poin_konsistensi }} Poin</span>
                                </div>
                            </div>
                        @empty
                            <p style="color: var(--text-muted);">Belum ada riwayat tugas selesai.</p>
                        @endforelse
                    </div>
                </section>

                <section class="content-section chart-section">
                    <h2>GRAFIK KONSISTENSI</h2>
                    <div class="card" style="cursor: default;">
                        <p class="mobile-swipe-hint"><i class="fas fa-arrows-alt-h"></i> Geser untuk melihat</p>
                        <div class="chart-wrapper">
                            <div class="chart-inner">
                                <canvas id="performaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddModal()" title="Tutup">&times;</span>
            <h2>Tambah Tugas Baru</h2>
            <form action="{{ url('/tasks') }}" method="POST">
                @csrf
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

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()" title="Tutup">&times;</span>
            <h2>Detail Tugas</h2>
            <form id="editTaskForm" action="" method="POST">
                @csrf
                @method('PUT')
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

    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('performaChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartData['labels']),
                datasets: [
                    {
                        label: 'Total Skor Harian',
                        data: @json($chartData['total']),
                        borderColor: '#38bdf8', // Biru
                        backgroundColor: 'rgba(56, 189, 248, 0.2)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Rata-rata Skor per Tugas',
                        data: @json($chartData['average']),
                        borderColor: '#facc15', // Kuning
                        fill: false,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true, ticks: { color: '#94a3b8' } }, x: { ticks: { color: '#94a3b8' } } },
                plugins: { legend: { labels: { color: '#e2e8f0' } } }
            }
        });

        const toast = document.getElementById('toastNotif');
        if (toast) {
            setTimeout(() => toast.classList.add('show'), 100);
            setTimeout(() => toast.classList.remove('show'), 3000);
        }
        
        // Hamburger Menu Toggle
        const menuBtn = document.getElementById('mobile-menu-btn');
        const sidebarCollapse = document.getElementById('sidebar-menu-collapse');
        if (menuBtn && sidebarCollapse) {
            menuBtn.addEventListener('click', function() {
                sidebarCollapse.classList.toggle('show');
            });
        }
        
        // Fungsi Pindah "Halaman" Tab untuk Mobile
        window.switchMobileView = function(view) {
            const mainContent = document.querySelector('.main-content');
            const menuBeranda = document.getElementById('menu-beranda');
            const menuStatistik = document.getElementById('menu-statistik');
            
            if(view === 'statistik') {
                mainContent.classList.add('show-statistik');
                menuBeranda.classList.remove('active');
                menuStatistik.classList.add('active');
            } else {
                mainContent.classList.remove('show-statistik');
                menuStatistik.classList.remove('active');
                menuBeranda.classList.add('active');
            }
            
            // Otomatis menutup hamburger menu setelah menu dipilih
            if(sidebarCollapse && sidebarCollapse.classList.contains('show')) {
                sidebarCollapse.classList.remove('show');
            }
        };
    });
    </script>
</body>
</html>