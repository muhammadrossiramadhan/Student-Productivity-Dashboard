<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - STUDENT.IO</title>
    {{-- css & icon --}}
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="auth-body">

    <div class="auth-box">
        
        {{-- header login --}}
        <div class="auth-header">
            <h2><i class="fas fa-sign-in-alt"></i> Welcome Back</h2>
            <p>Silakan masuk ke akun Anda</p>
        </div>

        {{-- pesan error --}}
        @if (session('error'))
            <div class="alert alert-error" style="background: rgba(239,68,68,.15); border: 1px solid #ef4444; color: #fca5a5; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                {{ session('error') }}
            </div>
        @endif

        {{-- form login --}}
        <form method="POST" action="{{ url('/login') }}">
            @csrf
            
            <div class="auth-input-field">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>
            </div>

            <div class="auth-input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="auth-btn-primary">Login</button>
        </form>

        {{-- navigasi bawah --}}
        <div class="auth-footer">
            <p>Don't have an account? <a href="{{ url('/register') }}">Sign up</a></p>
            <p><a href="{{ url('/') }}">Back to Home</a></p>
        </div>
        
    </div>

</body>
</html>