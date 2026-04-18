<?php
// Mulai session untuk mengecek apakah user sudah login
session_start();
// Jika sudah login, redirect langsung ke dashboard
if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
    header("location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Tugas Terpadu</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="header-logo">
                <i class="fas fa-check-double logo-icon"></i>
                <div class="logo-text">
                    <h1>SIMUT</h1>
                    <p>Sistem Tugas Anda</p>
                </div>
            </div>
            <button class="header-menu" id="menuButton" onclick="toggleMenu()" title="Main Menu">
                <i class="fas fa-bars"></i>
            </button>
            <nav class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="#" onclick="showPage('pageAwal')"><i class="fas fa-home"></i> Beranda</a></li>
                    <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Masuk</a></li>
                    <li><a href="#" onclick="showPage('pageDaftar')"><i class="fas fa-user-plus"></i> Daftar</a></li>
                    <li><a href="#" onclick="showPage('pageTentang')"><i class="fas fa-info-circle"></i> Tentang</a></li>
                </ul>
            </nav>
        </header>

        <main id="mainContent">
            <section id="pageAwal" class="page-content active-page">
                <div class="hero-section">
                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/productivity-illustration-download-in-svg-png-gif-file-formats--task-time-management-schedule-efficient-checklist-calendar-clock-planning-business-concept-at-it-office-pack-illustrations-3306912.png?f=webp" alt="Produktivitas">
                    <h2>Kerja Cerdas, Hasil Maksimal</h2>
                    <p>Kelola setiap detik waktu Anda untuk pencapaian terbaik.</p>
                    <div class="action-buttons">
                        <button class="btn-primary" onclick="showPage('pageDaftar')">Daftar Sekarang</button>
                        <button class="btn-secondary" onclick="location.href='login.php'">Saya Sudah Punya Akun</button>
                    </div>
                </div>
            </section>



            <section id="pageDaftar" class="page-content">
                <div class="auth-card">
                    <h2><i class="fas fa-user-plus"></i> Bergabung Sekarang</h2>
                    <p>Buat akun untuk memulai pengelolaan tugas Anda.</p>
                    
                    <form id="formDaftar" action="register.php" method="POST">
                        <div class="input-group">
                            <i class="fas fa-id-card"></i>
                            <input type="text" name="panggilan" placeholder="Nama Panggilan" required>
                        </div>
                        <div class="input-group">
                            <i class="fas fa-user"></i>
                            <input type="text" name="username" placeholder="Nama Pengguna" required>
                        </div>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" placeholder="Kata Sandi (pokok ada wes)">
                        </div>
                        <button type="submit" name="register" class="btn-full btn-primary">Daftar</button>
                    </form>
                    
                    <p class="auth-footer">Sudah punya akun? <a href="#" onclick="showPage('pageLogin')">Masuk</a></p>
                </div>
            </section>
            
            <section id="pageTentang" class="page-content">
                 <div class="auth-card">
                    <h2><i class="fas fa-info-circle"></i> Tentang Aplikasi</h2>
                    <p>Aplikasi ini dirancang untuk membantu Anda memanajemen tugas harian dengan lebih terorganisir.</p>
                    <p>Fitur Utama:</p>
                    <ul class="task-list">
                        <li><i class="fas fa-list-ol"></i> Pencatatan Tugas Mudah</li>
                        <li><i class="fas fa-thermometer-half"></i> Prioritas Tugas</li>
                        <li><i class="fas fa-history"></i> Lacak Riwayat Tugas</li>
                    </ul>
                    <button class="btn-primary btn-full" onclick="showPage('pageAwal')">Kembali</button>
                 </div>
            </section>

        </main>
        
        <footer>
            <p>&copy; 2023 Sistem Manajemen Tugas. All rights reserved.</p>
        </footer>
    </div>
    
    <script src="assets/js/script.js"></script>
    <?php if(isset($_GET['status']) && $_GET['status'] == 'gagal_daftar'): ?>
        <script>alert('Pendaftaran gagal. Username sudah digunakan!'); showPage('pageDaftar');</script>
    <?php elseif(isset($_GET['status']) && $_GET['status'] == 'sukses_daftar'): ?>
        <script>alert('Pendaftaran berhasil! Silakan masuk.'); showPage('pageLogin');</script>
    <?php elseif(isset($_GET['status']) && $_GET['status'] == 'gagal_login'): ?>
        <script>alert('Masuk gagal. Username atau password salah!'); showPage('pageLogin');</script>
    <?php endif; ?>
</body>
</html>