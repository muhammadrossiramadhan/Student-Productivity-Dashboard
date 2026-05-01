<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up | Student.io</title>
    <link rel="stylesheet" href="assets/css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="auth-body"> 
    <div class="auth-box"> 

        <div class="auth-header"> 
            <h2><i class="fas fa-user-plus"></i> Create Account</h2>
            <p>Sign up to get started.</p>
        </div>
            
        <form action="index.php?action=process_register" method="POST">
            <div class="auth-input-field"> 
                <i class="fas fa-id-card"></i>
                <input type="text" name="panggilan" placeholder="Nama Panggilan" required>
            </div>

            <div class="auth-input-field"> 
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            
            <div class="auth-input-field"> 
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            
            <button type="submit" name="register" class="auth-btn-primary">Register</button> 
        </form>

        <div class="auth-footer"> 
            <p>Already have an account? <a href="index.php?action=login">Sign in</a></p>
            <p><a href="index.php">Back to Home</a></p>
        </div>
        
    </div>
</body>
</html>
