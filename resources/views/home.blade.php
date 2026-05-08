<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <style>
        body {
            background-color: #0e1322;
            color: #c2c6d7;
            overflow-x: hidden;
        }

        .student-section {
            min-height: 100vh;
            background-color: #0e1322;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px 10%;
            gap: 50px;
        }

        .screen-section {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #0e1322;
        }

        .alt-bg {
            background-color: #161b2b !important;
            border-top: 1px solid rgba(66, 70, 85, 0.2);
            border-bottom: 1px solid rgba(66, 70, 85, 0.2);
        }

        .student-text {
            width: 50%;
        }

        .student-text h2 {
            font-size: 40px;
            margin-bottom: 20px;
            color: #dee1f7;
            font-weight: 700;
        }

        .student-text p {
            font-size: 18px;
            color: #c2c6d7;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .student-image {
            width: 45%;
            text-align: center;
        }

        .student-image img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            border: 1px solid rgba(66, 70, 85, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            opacity: 0.9;
            transition: 0.3s ease;
        }

        .student-image img:hover {
            opacity: 1;
            box-shadow: 0 15px 40px rgba(41, 121, 255, 0.15);
            border-color: #424655;
        }

        .section-title {
            text-align: center;
            width: 100%;
            font-size: 36px;
            color: #dee1f7;
            margin: 0 0 15px;
            font-weight: 700;
        }

        .section-subtitle {
            text-align: center;
            color: #c2c6d7;
            margin-bottom: 50px;
            font-size: 18px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 0 10%;
            background-color: transparent;
        }

        .ui-card {
            background: #161b2b;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid rgba(66, 70, 85, 0.4); 
        }

        .ui-card h3 {
            color: #b0c6ff;
            font-size: 20px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ui-card p {
            font-size: 16px;
            color: #c2c6d7;
            line-height: 1.6;
            margin-bottom: 0;
        }
        
        .author-text {
            margin-top: 20px !important;
            font-size: 14px !important;
            color: #b0c6ff !important;
            font-weight: 600;
        }

        .logo {
            position: absolute;
            left: 50px;
            font-weight: 800;
            font-size: 1.2rem;
            letter-spacing: 2px;
            color: #dee1f7;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div class="hero-section">
        
        <nav class="top-nav">
            <div class="logo"><i class="fas fa-graduation-cap"></i> STUDENT.IO</div>
            <a href="#apa itu" class="btn-info">Apa itu STUDENT.IO?</a>
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
        </nav>

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

<footer class="st-footer-copyright-only">
    <p>&copy; 2026 <strong>STUDENT.IO</strong></p>
</footer>
</body>
</html>