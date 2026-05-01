<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Student.io</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="auth-body">

<div class="auth-box">
    <div class="auth-header">
        <h2><i class="fas fa-sign-in-alt"></i> Welcome Back</h2>
        <p>Silakan masuk ke akun Anda</p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-error">
            ⚠️ <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?url=auth/doLogin">
        <div class="auth-input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username"
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                   required autofocus>
        </div>

        <div class="auth-input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit" name="login" class="auth-btn-primary">
            Login
        </button>
    </form>

    <div class="auth-footer">
        <p>Don't have an account? <a href="index.php?url=auth/register">Sign up</a></p>
        <p><a href="index.php?url=home/index">Back to Home</a></p>
    </div>
</div>

</body>
</html>
