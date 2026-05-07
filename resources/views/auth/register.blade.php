<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Student.io</title>
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="auth-body">

<div class="auth-box">
    <div class="auth-header">
        <h2><i class="fas fa-user-plus"></i> Create Account</h2>
        <p>Daftar untuk mengelola tugasmu</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-error" style="background: rgba(239,68,68,.15); border: 1px solid #ef4444; color: #fca5a5; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
            ⚠️ {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ url('/register') }}">
            @csrf
        <div class="auth-input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>
            @error('username') <span style="color: #fca5a5; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
        </div>

        <div class="auth-input-field">
            <i class="fas fa-id-badge"></i>
            <input type="text" name="panggilan" placeholder="Nama Panggilan (Opsional)" value="{{ old('panggilan') }}">
        </div>

        <div class="auth-input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            @error('email') <span style="color: #fca5a5; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
        </div>

        <div class="auth-input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password (Min. 6 karakter)" required>
            @error('password') <span style="color: #fca5a5; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="auth-btn-primary">Sign Up</button>
    </form>

    <div class="auth-footer">
        <p>Already have an account? <a href="{{ url('/login') }}">Log in</a></p>
    </div>
</div>
</body>
</html>
