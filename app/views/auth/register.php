<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Student.io</title>
    <link rel="stylesheet" href="<?= BASE_PATH ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="auth-body">

<div class="auth-box">
    <div class="auth-header">
        <h2><i class="fas fa-user-plus"></i> Create Account</h2>
        <p>Daftar untuk mengelola tugasmu</p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-error">
            ⚠️ <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_PATH ?>/index.php?url=auth/doRegister">
        <div class="auth-input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username"
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                   required autofocus>
        </div>

        <div class="auth-input-field">
            <i class="fas fa-id-badge"></i>
            <input type="text" name="panggilan" placeholder="Nama Panggilan (Opsional)"
                   value="<?= htmlspecialchars($_POST['panggilan'] ?? '') ?>">
        </div>

        <div class="auth-input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password (Min. 6 karakter)" required>
        </div>

        <button type="submit" name="register" class="auth-btn-primary">
            Sign Up
        </button>
    </form>

    <div class="auth-footer">
        <p>Already have an account? <a href="<?= BASE_PATH ?>/index.php?url=auth/login">Log in</a></p>
    </div>
</div>

</body>
</html>