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
        .full-screen-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; 
            z-index: -1; 
            filter: brightness(0.6); 
    }

        .student-section {
            min-height: 100vh;
            background: white;
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
            <a href="#student" class="btn-info">Apa itu Student.IO</a>
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

        <div class="image">
            <img src="https://blogassets.leverageedu.com/blog/wp-content/uploads/2019/11/23172446/PhD-in-English-380x220.png" class="full-screen-background" alt="Haro-Image">
        </div>

    </div>

    <section id="student" class="student-section">
        <div class="student-text">
            <h2>Apa itu Student.IO?</h2>
            <p>
                Student.IO adalah platform yang membantu pelajar dan mahasiswa
                untuk mengatur tugas, jadwal, dan aktivitas belajar dalam satu
                tempat. Dengan Student.IO, semua tugas menjadi lebih terorganisir dan
                mudah dipantau.
            </p>
        </div>

        <div class="student-image">
            <img src="https://img.freepik.com/premium-vector/education-achievement-with-books-trophy-graduation-ceremony-concept_1326094-11473.jpg" alt="Student.IO">
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