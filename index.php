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
</head>
<body>
    <div class="hero-section">
        
        <nav class="top-nav">
            <a href="#fitur">A</a>
            <a href="#metode">B</a>
            <a href="login.php">C</a>
            <a href="#">D</a>
        </nav>

        <main class="hero-content">
            <h1>SATU TEMPAT UNTUK SEMUA<br>TUGAS DAN JADWALMU</h1>
            <p>Ayoo jadikan  semua tugas dan jadwalmu lebih terorganisir!</p>
            
            <a href="register.php" class="btn-buat">MULAI SEKARANG &#8599;</a> 
        </main>

        <div class="bottom-bar">
            <a href="#">COMMUNITY</a>
            <a href="#">INTEGRATION</a>
            <a href="#">COLLABORATE</a>
            <a href="#">HELP</a>
        </div>

    </div>

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