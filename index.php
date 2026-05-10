<?php
session_start();
// Tetap mempertahankan logika redirect jika user sudah masuk
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
    <title></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/index.css">
    <style>
        .student-section {
            min-height: 100vh;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 10%;
            gap: 50px;
        }

        .student-text {
            width: 50%;
        }

        .student-text h2 {
            font-size: 40px;
            margin-bottom: 20px;
            color: #222;
        }

        .student-text p {
            font-size: 18px;
            color: #555;
            line-height: 1.8;
        }

        .student-image {
            width: 45%;
            text-align: center;
        }

        .student-image img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="hero-section">
        
        <nav class="top-nav">
            <a href="#apa itu" class="btn-info">Apa itu Student.IO</a>
            <a href="#kenapa-harus" class="btn-info">Kenapa Harus Student.IO</a>
            <a href="#fitur" class="btn-info">Fitur</a>
            <a href="#ulasan" class="btn-info">Ulasan</a>
        </nav>

        <main class="hero-content">
            <h1>SATU TEMPAT UNTUK SEMUA<br>TUGAS DAN JADWALMU</h1>
            <p>Ayoo jadikan  semua tugas dan jadwalmu lebih terorganisir!</p>
            
            <a href="register.php" class="btn-buat">Mulai Sekarang &#8599;</a>
        </main>

        <div class="bottom-bar">
            <a href="#">COMMUNITY</a>
            <a href="#">INTEGRATION</a>
            <a href="#">COLLABORATE</a>
            <a href="#">HELP</a>
        </div>

    </div>

    <section id="apa itu" class="student-section">
        <div class="student-text">
            <h2>Apa itu Student.IO?</h2>
            <p>
                Student.IO adalah platform yang membantu pelajar dan mahasiswa
                mengatur tugas, jadwal, dan aktivitas belajar dalam satu tempat.
                Dengan Student.IO, semua tugas menjadi lebih terorganisir dan
                mudah dipantau.
            </p>
        </div>

         <div class="student-image">
            <img src="https://media.istockphoto.com/id/1289812848/vector/tiny-male-character-with-huge-pencil-sit-on-guidance-booklet-or-guided-textbook-user-manual.jpg?s=170667a&w=0&k=20&c=g1Cjcgp5e4FY5yasMfpFxFIAR-JFkQ7A4zIfCMWUGhM=" alt="Student.IO">
        </div> 
    </section>

    <section id="kenapa-harus" class="student-section">    
        <div class="student-text">
            <h2>Kenapa Harus Student.IO?</h2>
            <p>
                Dengan fitur-fitur seperti pengingat tugas, kalender jadwal, dan
                integrasi dengan berbagai platform pembelajaran, Student.IO
                memudahkan kamu untuk tetap fokus dan produktif. Jadikan
                pengalaman belajar kamu lebih menyenangkan dan teratur dengan
                Student.IO!
            </p>
        </div>

        <div class="student-image">
            <img src="https://tse4.mm.bing.net/th/id/OIP.SM1uoSZBRVMkL6L7FGfM1wHaHa?r=0&w=600&h=600&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Student.IO">
        </div>
    </section>

    <section id="fitur" class="student-section">
        <div class="student-text">
            <h2>Fitur Student.IO</h2>
            <p>
                - Pengingat Tugas: Notifikasi untuk setiap tugas yang
                mendekati tenggat waktu. <br>
                - Kalender Jadwal: Meihat semua jadwal kuliah, ujian, dan tugas
                dalam satu kalender yang mudah digunakan. <br>
                - Integrasi Platform: Sinkronisasi dengan Google Calendar, Microsoft
                Outlook, dan platform pembelajaran lainnya untuk kemudahan akses.
            </p>
        </div>

        <div class="student-image">
            <img src="https://png.pngtree.com/png-vector/20210713/ourlarge/pngtree-online-information-resources-online-certificate-graduation-png-image_3557486.jpg" alt="Student.IO">
        </div>
    </section>

    <section id="ulasan" class="student-section">
        <div class="student-text">
            <h2>Ulasan Pengguna</h2>
            <p>
                "Student.IO benar-benar membantu saya mengatur semua tugas dan jadwal kuliah saya. Saya tidak pernah melewatkan tenggat waktu lagi!" - Rina, Mahasiswa<br>
                "Fitur pengingat tugas sangat berguna. Saya bisa fokus belajar tanpa khawatir lupa dengan tugas yang harus dikerjakan." - Budi, Pelajar SMA<br>
                "Integrasi dengan Google Calendar membuat semuanya lebih mudah. Saya bisa melihat semua jadwal saya dalam satu tempat." - Sari, Mahasiswa
            </p>
        </div>

        <div class="student-image">
            <img src="https://static.vecteezy.com/system/resources/thumbnails/011/979/493/small_2x/graduate-achievement-university-learning-education-illustration-flat-template-free-vector.jpg" alt="Student.IO">
        </div>
    </section>

    <?php if(isset($_GET['status'])): ?>
        <script>
            const status = "<?php echo $_GET['status']; ?>";
            if(status === 'gagal_daftar') alert('Pendaftaran gagal. Username sudah digunakan!');
            if(status === 'sukses_daftar') alert('Pendaftaran berhasil! Silakan masuk.');
            if(status === 'gagal_login') alert('Masuk gagal. Username atau password salah!');
        </script>
    <?php endif; ?>
</body>
</html>