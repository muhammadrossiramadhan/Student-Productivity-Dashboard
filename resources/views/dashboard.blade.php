<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - STUDENT.IO</title>
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Memutihkan icon kalender dan jam bawaan browser untuk dark mode */
        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    {{-- navbar mobile --}}
    <div class="mobile-top-nav">
        <div class="logo">
            <a href="{{ url('/') }}" style="text-decoration: none; color: inherit;">
                <i class="fas fa-graduation-cap"></i> STUDENT.IO
            </a>
        </div>
        <div class="hamburger" id="hamburgerMenu">
            <i class="fas fa-bars"></i>
        </div>
    </div>

    <aside class="sidebar" id="sidebar">

        {{-- logo --}}
        <div class="sidebar-logo" style="margin-bottom: 30px;">
            <a href="{{ url('/') }}" style="color: white; font-size: 1.4rem; font-weight: 800; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-graduation-cap"></i> STUDENT.IO
            </a>
        </div>

        {{-- info user --}}
        <div class="user-profile">
            <span class="user-name">Hi, {{ auth()->user()->panggilan ?? auth()->user()->username }}</span>
        </div>

        <nav class="menu">
            <a href="#" class="menu-item active" data-tab="beranda">
                <i class="fas fa-home"></i> Beranda
            </a>
            <a href="#" class="menu-item" data-tab="tugas">
                <i class="fas fa-tasks"></i> Tugas
            </a>
            <a href="#" class="menu-item" data-tab="riwayat">
                <i class="fas fa-history"></i> Riwayat
            </a>
        </nav>

        <div class="bottom-menu">
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="menu-item text-danger" style="background: none; border: none; width: 100%; text-align: left; cursor: pointer;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>

    </aside>

    <main class="main-content">
        <header class="top-header" id="top-header">
            <h1 id="page-title"><i class="fas fa-home"></i> BERANDA</h1>

            {{-- form pencarian tugas --}}
            <form method="GET" action="{{ url('/dashboard') }}" class="search-form" id="search-form">
                <input type="text" name="search" class="search-input" maxlength="100" placeholder="Cari Tugas" value="{{ request('search') }}">
                <button type="submit" class="btn-primary">Cari</button>
            </form>

            <button class="btn-primary" id="btnAddModal">
                <i class="fas fa-plus"></i> Tambah Tugas
            </button>
        </header>

        {{-- tugas aktif --}}
        <section class="content-section" id="section-tugas">
            <h2>TUGAS AKTIF</h2>
            <div class="card-grid">
                @forelse ($activeTasks as $task)
                    <div class="card task-card" data-task='@json($task)' data-url="{{ url('/tasks') }}">
                        <div class="card-info">
                            <h3>{{ $task->nama_tugas }}</h3>
                            <p><i class="fas fa-clock"></i> {{ date('d M Y', strtotime($task->deadline)) }}, Pukul {{ $task->waktu }}</p>

                            @php $terlambat = ($task->status_waktu === 'Terlambat'); @endphp

                            <span class="priority-badge {{ $terlambat ? 'tinggi' : strtolower($task->prioritas) }}">
                                {{ $terlambat ? 'Terlambat' : $task->prioritas }}
                            </span>
                        </div>

                        <div class="card-actions">
                            <form method="POST" action="{{ url('/tasks/' . $task->id . '/done') }}" onclick="event.stopPropagation();">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-success"><i class="fas fa-check"></i> Selesai</button>
                            </form>

                            <form method="POST" action="{{ url('/tasks/' . $task->id) }}" onclick="event.stopPropagation();" onsubmit="return confirm('Hapus tugas ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger-sm"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p style="color: var(--text-muted);">Belum Ada Tugas.</p>
                @endforelse
            </div>
        </section>

        {{-- riwayat & grafik --}}
        <div class="bottom-grid" id="section-riwayat">

            {{-- riwayat tugas selesai --}}
            <section class="content-section">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <h2 style="margin-bottom: 0;">RIWAYAT TERAKHIR</h2>

                    @if ($historyTasks->count() > 0)
                        <form method="POST" action="{{ url('/tasks/clear-history') }}" onsubmit="return confirm('Yakin mau hapus semua riwayat?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger-sm" style="padding: 6px 12px; font-size: 0.75rem;">
                                <i class="fas fa-trash-alt"></i> Bersihkan
                            </button>
                        </form>
                    @endif
                </div>

                <div class="card-grid" style="grid-template-columns: 1fr;">
                    @forelse ($historyTasks as $h)
                        <div class="card" style="cursor: default;">
                            <div class="card-info" style="display: flex; justify-content: space-between; align-items: center;">
                                <h3 style="margin: 0; font-size: 0.95rem; text-decoration: line-through; color: var(--text-muted);">{{ $h->nama_tugas }}</h3>
                                <span class="priority-badge rendah">+{{ $h->poin_konsistensi }} Poin</span>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </section>

            {{-- grafik konsistensi 7 hari --}}
            <section class="content-section">
                <h2>GRAFIK KONSISTENSI</h2>
                <div class="card" style="cursor: default;">
                    <canvas id="performaChart"></canvas>
                </div>
            </section>

        </div>
    </main>
</div>

{{-- modal tambah tugas --}}
<div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close" id="btnCloseAddModal" title="Tutup">&times;</span>
        <h2>Tambah Tugas Baru</h2>
        <form action="{{ url('/tasks') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="judul">Nama Tugas</label>
                <input type="text" id="judul" name="nama_tugas" maxlength="100" required placeholder="Judul Tugas">
            </div>
            <div class="input-group">
                <label for="deadline">Tanggal & Waktu Deadline</label>
                <div class="input-row">
                    <input type="date" id="deadline" name="deadline" required>
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
                <label for="deskripsi">Deskripsi (Opsional)</label>
                <textarea id="deskripsi" name="deskripsi" rows="2" maxlength="300" placeholder="Deskripsi Tugas"></textarea>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; margin-top: 10px;">Simpan</button>
        </form>
    </div>
</div>

{{-- modal edit tugas --}}
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" id="btnCloseEditModal" title="Tutup">&times;</span>
        <h2>Detail Tugas</h2>
        <form id="editTaskForm" action="" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_task_id" name="task_id">
            <div class="input-group">
                <label>Nama Tugas</label>
                <input type="text" id="edit_judul" name="nama_tugas" maxlength="100" required>
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
                <label>Deskripsi</label>
                <textarea id="edit_deskripsi" name="deskripsi" rows="2" maxlength="300"></textarea>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; margin-top: 10px;">Update</button>
        </form>
    </div>
</div>

<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        {{-- grafik konsistensi 7 hari --}}
        var ctx = document.getElementById('performaChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartData['labels']),
                datasets: [{
                    label: 'SKOR',
                    data: @json($chartData['data']),
                    borderColor: '#38bdf8',
                    backgroundColor: 'rgba(41, 121, 255, 0.2)',
                    fill: false,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false,
                scales: {
                    y: { 
                        beginAtZero: true, 
                        ticks: { 
                            color: '#94a3b8',
                            stepSize: 1,
                            precision: 0
                        } 
                    },
                    x: { 
                        ticks: { display: false },
                        grid: { display: false }
                    }
                },
                plugins: {
                    legend: { labels: { color: '#e2e8f0' } }
                }
            }
        });
    });
</script>
</body>
</html>