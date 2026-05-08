<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENT.IO</title>
    {{-- font dan icon --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                <a href="#apa itu" class="btn-info" onclick="toggleMenu()">Apa itu STUDENT.IO?</a>
                <a href="#kenapa-harus" class="btn-info" onclick="toggleMenu()">Kenapa Harus STUDENT.IO?</a>
                <a href="#fitur" class="btn-info" onclick="toggleMenu()">Fitur</a>
                <a href="#ulasan" class="btn-info" onclick="toggleMenu()">Ulasan</a>
                
                <div class="nav-auth">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-info">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-info btn-buat">Masuk</a>
                    @endauth
                </div>
            </div>

            {{-- hamburger icon (mobile/tablet) --}}
            <div class="hamburger" id="hamburgerMenu" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </div>
        </nav>

        {{-- konten hero --}}
        <main class="hero-content">
            <h1>SATU TEMPAT UNTUK SEMUA<br>TUGAS DAN JADWALMU</h1>
            <p>Ayo Jadikan Semua Tugas dan Jadwalmu Lebih Terorganisir!</p>
            
            @auth
                <a href="{{ route('dashboard') }}" class="btn-buat">Ke Dashboard</a>
            @else
                <a href="{{ route('register') }}" class="btn-buat">Mulai Sekarang</a>
            @endauth
        </main>
    </div>


    {{-- section apa itu --}}
    <section id="apa itu" class="student-section">
        <div class="student-text">
            <h2>APA ITU STUDENT.IO?</h2>
            <p>
                STUDENT.IO adalah platform manajemen tugas simpel yang dirancang khusus 
                untuk pelajar dan mahasiswa. Kami menyediakan kemudahan pencatatan daftar 
                tugas (To-Do List) dan pelacakan riwayat aktivitas dalam satu ruang kerja 
                <i>dark-mode</i> yang terpusat dan bebas distraksi.
            </p>
        </div>

        <div class="student-image">
            <img src="https://img.freepik.com/premium-vector/education-achievement-with-books-trophy-graduation-ceremony-concept_1326094-11473.jpg" alt="Student.IO">
        </div> 
    </section>


    {{-- section kenapa harus --}}
    <section id="kenapa-harus" class="student-section alt-bg">    
        <div class="student-image">
            <img src="https://img.freepik.com/premium-vector/education-achievement-with-books-trophy-graduation-ceremony-concept_1326094-11473.jpg" alt="Student.IO">
        </div>

        <div class="student-text">
            <h2>KENAPA HARUS STUDENT.IO?</h2>
            <p>
                Dibangun untuk menunjang fokus eksekusimu. Dengan desain antarmuka yang bersih, 
                pengelolaan daftar tugas yang praktis, dan fitur penanda selesai (Mark as Done), 
                STUDENT.IO membantumu mengatur pekerjaan tanpa kerumitan. Catat tugasmu, 
                kerjakan, dan bersihkan riwayatnya dengan satu klik!
            </p>
        </div>
    </section>


    {{-- section fitur --}}
    <div id="fitur" class="screen-section">
        <h2 class="section-title">FITUR</h2>
        <p class="section-subtitle">Semua yang kamu butuhkan untuk mendominasi tugas dan ujian.</p>
        
        <div class="feature-grid">
            <div class="ui-card">
                <h3>Pencatatan Tugas Cepat</h3>
                <p>Tambah, edit, dan hapus setiap daftar tugas kuliah atau sekolahmu (To-Do List) dengan cepat tanpa formulir yang rumit.</p>
            </div>
            <div class="ui-card">
                <h3>Pantau Progres Belajar</h3>
                <p>Tandai tugas yang sudah diselesaikan, dan bersihkan riwayat penyelesaian tugas kapan saja untuk menjaga dashboard tetap rapi.</p>
            </div>
            <div class="ui-card">
                <h3>Mode Fokus Gelap</h3>
                <p>Desain minimalis dengan kontras warna <i>deep navy</i> yang dioptimalkan untuk memastikan mata tetap nyaman saat sesi belajar panjang.</p>
            </div>
        </div>
    </div>

    
    {{-- section ulasan --}}
    <div id="ulasan" class="screen-section alt-bg">
        <h2 class="section-title">ULASAN PENGGUNA</h2>
        <p class="section-subtitle">Bergabung dengan pelajar lain yang telah meningkatkan produktivitasnya.</p>
        
        <div class="feature-grid">
            <div class="ui-card">
                <p>"Student.IO benar-benar mengubah cara saya mencatat tugas. Antarmukanya sangat bersih, membuat daftar To-Do jauh lebih rapi dari sebelumnya!"</p>
                <p class="author-text">- Rina, Mahasiswa</p>
            </div>
            <div class="ui-card">
                <p>"Mode gelapnya sangat membantu untuk sesi belajar malam. Jauh lebih baik dari sekadar mencatat tugas di kertas atau aplikasi notes biasa."</p>
                <p class="author-text">- Budi, Pelajar SMA</p>
            </div>
            <div class="ui-card">
                <p>"Sangat praktis! Fitur riwayat tugasnya seru banget. Bikin hidup kuliah jadi jauh lebih tertata dan nggak perlu pusing mikirin tugas mana yang belum selesai."</p>
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