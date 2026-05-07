<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password — Student.io</title>
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="auth-body">

<div class="auth-box">
    <div class="auth-header">
        <h2><i class="fas fa-key"></i> Lupa Password</h2>
        <p>Masukkan email Anda untuk menerima link reset password.</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success" style="background: rgba(34,197,94,.15); border: 1px solid #22c55e; color: #86efac; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="auth-input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
            @error('email') <span style="color: #fca5a5; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="auth-btn-primary">Kirim Link Reset</button>
    </form>

    <div class="auth-footer" style="margin-top: 20px; display: flex; justify-content: space-between; font-size: 14px;">
        <p><a href="{{ route('login') }}">Kembali ke Login</a></p>
        <p><a href="mailto:admin@student.io" style="color: #9ca3af;">Lupa Email Anda?</a></p>
    </div>
</div>
</body>
</html>