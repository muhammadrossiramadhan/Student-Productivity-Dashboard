<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password — Student.io</title>
    <link rel="stylesheet" href="<?= BASE_PATH ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="auth-body">

<div class="auth-box" style="text-align: center;">
    <div class="auth-header">
        <h2><i class="fas fa-key"></i> Lupa Password?</h2>
        <p>Fitur reset otomatis belum tersedia.</p>
    </div>

    <div class="alert alert-warning" style="background: rgba(245,158,11,.15); border: 1px solid #f59e0b; color: #fcd34d;">
        Saat ini, silakan hubungi <strong>Admin Aplikasi</strong> (kelompokmu) untuk melakukan reset password secara manual melalui database.
    </div>

    <div class="auth-footer" style="margin-top: 30px;">
        <a href="<?= BASE_PATH ?>/index.php?url=auth/login" class="btn-primary" style="display: inline-block; width: 100%; box-sizing: border-box; color: white; text-decoration: none;">Kembali ke Login</a>
    </div>
</div>

</body>
</html>