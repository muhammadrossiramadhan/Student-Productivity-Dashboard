<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENT.IO</title>
    {{-- font dan icon --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
</head>

<body>

    {{-- hero section dan navigation --}}
    <div class="hero-section">

        {{-- navigasi atas --}}
        <nav class="top-nav">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i> STUDENT.IO
            </div>

            <div class="nav-links" id="navLinks">
                <a href="#apa-itu" class="btn-info">Apa itu STUDENT.IO?</a>
                <a href="#kenapa-harus" class="btn-info">Kenapa Harus STUDENT.IO?</a>
                <a href="#fitur" class="btn-info">Fitur</a>
                <a href="#ulasan" class="btn-info">Ulasan</a>

                <div class="nav-auth">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-info">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-info btn-buat">Masuk</a>
                    @endauth
                </div>
            </div>

            {{-- hamburger icon (mobile/tablet) --}}
            <div class="hamburger" id="hamburgerMenu">
                <i class="fas fa-bars"></i>
            </div>
        </nav>

        {{-- konten hero --}}
        <main class="hero-content">
            <h1>SATU TEMPAT UNTUK SEMUA<br>TUGAS DAN PRODUKTIVITASMU</h1>
            <p>Kelola daftar tugas harianmu dan pantau grafik konsistensi belajarmu setiap hari!</p>

            @auth
                <a href="{{ route('dashboard') }}" class="btn-buat">Ke Dashboard</a>
            @else
                <a href="{{ route('register') }}" class="btn-buat">Mulai Sekarang</a>
            @endauth
        </main>
    </div>


    {{-- section apa itu --}}
    <section id="apa-itu" class="student-section">
        <div class="student-text">
            <h2>APA ITU STUDENT.IO?</h2>
            <p>
                STUDENT.IO adalah platform manajemen tugas minimalis yang dirancang khusus
                untuk pelajar dan mahasiswa. Kami menyediakan kemudahan pencatatan daftar
                tugas dan pelacakan riwayat produktivitas dalam satu ruang kerja
                <i>dark-mode</i> yang terpusat, cepat, dan bebas distraksi.
            </p>
        </div>

        <div class="student-image">
            <img src="{{ asset('assets/img/Landing Page 03.png') }}" alt="Student.IO">
        </div>
    </section>


    {{-- section kenapa harus --}}
    <section id="kenapa-harus" class="student-section alt-bg">
        <div class="student-image">
            <img src="{{ asset('assets/img/Landing Page 02.png') }}" alt="Student.IO">
        </div>

        <div class="student-text">
            <h2>KENAPA HARUS STUDENT.IO?</h2>
            <p>
                Dibangun untuk menunjang fokus eksekusimu. Dengan desain antarmuka berbasis tab yang bersih,
                pengelolaan tugas yang praktis dengan tingkat prioritas, dan fitur penanda selesai.
                Catat tugasmu, kerjakan, dan pantau performa produktivitasmu lewat grafik konsistensi 7 hari terakhir!
            </p>
        </div>
    </section>


    {{-- section fitur --}}
    <div id="fitur" class="screen-section">
        <h2 class="section-title">FITUR</h2>
        <p class="section-subtitle">Semua yang kamu butuhkan untuk mendominasi tugas dan ujian.</p>

        <div class="feature-grid">
            <div class="ui-card">
                <h3><i class="fas fa-edit"></i> Pencatatan Tugas Instan</h3>
                <p>Tambah, edit, dan atur daftar tugas kuliah atau sekolahmu berdasarkan tingkat prioritas dengan cepat
                    tanpa kerumitan.</p>
            </div>
            <div class="ui-card">
                <h3><i class="fas fa-chart-line"></i> Riwayat & Grafik Performa</h3>
                <p>Tandai tugas yang sudah selesai dan lihat jejak produktivitasmu di tab Riwayat. Tersedia grafik
                    konsistensi untuk menjaga semangat belajarmu!</p>
            </div>
            <div class="ui-card">
                <h3><i class="fas fa-moon"></i> Mode Fokus Gelap</h3>
                <p>Desain minimalis dengan kontras warna <i>deep navy</i> yang dioptimalkan untuk memastikan mata tetap
                    nyaman saat sesi belajar panjang di depan layar.</p>
            </div>
        </div>
    </div>


    {{-- section ulasan --}}
    <div id="ulasan" class="screen-section alt-bg">
        <h2 class="section-title">ULASAN PENGGUNA</h2>
        <p class="section-subtitle">Bergabung dengan pelajar lain yang telah meningkatkan produktivitasnya.</p>

        <div class="feature-grid">
            <div class="ui-card">
                <p>"Student.IO benar-benar mengubah cara saya mencatat tugas. Antarmuka tab-nya sangat rapi, membuat
                    pemisahan antara tugas aktif dan riwayat jadi jelas!"</p>
                <p class="author-text">- Rina, Mahasiswa</p>
            </div>
            <div class="ui-card">
                <p>"Grafik konsistensinya bikin ketagihan buat nyelesein tugas setiap hari. Jauh lebih asik dari sekadar
                    mencatat tugas di aplikasi notes biasa."</p>
                <p class="author-text">- Budi, Pelajar SMA</p>
            </div>
            <div class="ui-card">
                <p>"Sangat praktis! Dark mode-nya enak banget di mata buat nugas malem. Bikin hidup kuliah jadi jauh
                    lebih tertata dan fokus."</p>
                <p class="author-text">- Sari, Mahasiswa</p>
            </div>
        </div>
    </div>


    {{-- footer --}}
    <footer class="st-footer-copyright-only">
        <p>&copy; 2026 <strong>STUDENT.IO</strong></p>
    </footer>

    {{-- js --}}
    <script src="{{ asset('assets/js/home.js') }}"></script>
</body>

</html>