<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student.IO</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            overflow-x: hidden;
        }

        .hero-section {
            height: 100vh;
            background: #4b4e5d;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 30px;
        }

        .top-nav {
            width: 100%;
            text-align: left;
        }

        .top-nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }

        .hero-content {
            text-align: center;
        }

        .hero-content h1 {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .btn-buat {
            display: inline-block;
            margin: 10px;
            padding: 12px 25px;
            border: 2px solid white;
            color: white;
            text-decoration: none;
            border-radius: 30px;
        }

        .bottom-bar {
            display: flex;
            gap: 30px;
            border: 1px solid white;
            border-radius: 30px;
            padding: 15px 30px;
        }

        .bottom-bar a {
            color: white;
            text-decoration: none;
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

    <!-- HERO -->
    <div class="hero-section">
        
        <nav class="top-nav">
            <a href="#student">Apa itu Student.IO</a>
        </nav>

        <div class="hero-content">
            <h1>SATU TEMPAT UNTUK SEMUA<br>TUGAS DAN JADWALMU</h1>
            <p>Ayoo jadikan semua tugas dan jadwalmu lebih terorganisir!</p>
            
            <a href="#" class="btn-buat">Mulai Sekarang</a>
        </div>

        <div class="bottom-bar">
            <a href="#">COMMUNITY</a>
            <a href="#">INTEGRATION</a>
            <a href="#">COLLABORATE</a>
            <a href="#">HELP</a>
        </div>
    </div>

    <!-- SECTION PUTIH -->
    <section id="student" class="student-section">
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
            <img src="https://img.freepik.com/premium-vector/education-achievement-with-books-trophy-graduation-ceremony-concept_1326094-11473.jpg" alt="Student.IO">
        </div>
    </section>

</body>
</html>