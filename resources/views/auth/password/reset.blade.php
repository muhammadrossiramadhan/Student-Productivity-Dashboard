<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password — Student.io</title>
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="auth-body">

<div class="auth-box">
    <div class="auth-header">
        <h2><i class="fas fa-lock-open"></i> Atur Password Baru</h2>
        <p>Buat password baru untuk akun Anda.</p>
    </div>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        
        <!-- Hidden Token & Email -->
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="auth-input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" value="{{ $email ?? old('email') }}" required readonly style="background-color: #2a2f45; cursor: not-allowed;">
            @error('email') <span style="color: #fca5a5; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
        </div>

        <div class="auth-input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password Baru" required>
            @error('password') <span style="color: #fca5a5; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
        </div>

        <div class="auth-input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru" required>
        </div>

        <button type="submit" class="auth-btn-primary">Reset Password</button>
    </form>
</div>
</body>
</html>