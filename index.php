<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUKTIVITAS PELAJAR DAN MAHASISWA</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        .hero-section {
            background: url() no-repeat center center;
            background-size: cover;
            height: 100vh;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            color: #1e293b;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 60px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .navbar h2 {
            margin: 0;
            color: #2563eb;
        }

        .nav-buttons a {
            text-decoration: none;
            margin-left: 15px;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
        }

        .login-btn {
            border: 2px solid #2563eb;
            color: #2563eb;
        }

        .signup-btn {
            background: #10b981;
            color: white;
        }

        .hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 80px 60px;
        }

        .hero-text {
            max-width: 50%;
        }

        .hero-text h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero-text p {
            font-size: 20px;
            color: #475569;
            margin-bottom: 30px;
        }

        .hero-buttons a {
            text-decoration: none;
            padding: 14px 28px;
            margin-right: 15px;
            border-radius: 10px;
            font-weight: bold;
        }

        .get-started {
            background: #10b981;
            color: white;
        }

        .login-main {
            background: #2563eb;
            color: white;
        }

        .features {
            margin-top: 30px;
            display: flex;
            gap: 30px;
            font-size: 18px;
            color: #334155;
        }

        .hero-image img {
            width: 500px;
            max-width: 100%;
        }
    </style>
</head>
<body>
    <div class="hero-section">
    
        <div class="navbar">
            <h2>PRODUKTIVITAS PELAJAR DAN MAHASISWA</h2>
            <div class="nav-buttons">
                <a href="dashboard.php" class="login-btn">Masuk</a>
                <a href="dashboard.php" class="signup-btn">Daftar</a>
            </div>
        </div>

        <section class="hero">
            <div class="hero-text">
                <h1>Tingkatkan Produktivitasmu</h1>
                <p>Kelola tugas dan kegiatan belajar dengan lebih teratur untuk mencapai target akademikmu</p>

                <div class="hero-buttons">
                    <a href="dashboard.php" class="get-started">Mulai Sekarang</a>
                    <a href="dashboard.php" class="login-main">Masuk</a>
                </div>

                <div class="features">
                    <span>✔ Kelola Tugas</span>
                    <span>✔ Atur Target</span>
                    <span>✔ Tetap Terorganisir</span>
                </div>
                
            </div>
        </section>

    </div>
</body>
</html>