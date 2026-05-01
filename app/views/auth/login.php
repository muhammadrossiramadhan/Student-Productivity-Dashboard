<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-In | Student.io</title>
    <link rel="stylesheet" href="assets/css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="auth-body"> 
    <div class="auth-box"> 

        <div class="auth-header"> 
            <h2><i class="fas fa-sign-in-alt"></i> Welcome Back!</h2>
            <p>Sign in to continue to your account.</p>
        </div>
            
        <form action="index.php?action=process_login" method="POST">
            <div class="auth-input-field"> 
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            
            <div class="auth-input-field"> 
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            
            <button type="submit" name="login" class="auth-btn-primary">Sign In</button> 
        </form>

        <div class="auth-footer"> 
            <p>Don't have an account? <a href="index.php?action=register">Sign up</a></p>
            <p><a href="index.php">Back to Home</a></p>
        </div>
        
    </div>
</body>
</html>
