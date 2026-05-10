<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - STUDENT.IO</title>
    {{-- css & icon --}}
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="auth-body">

    <div class="auth-box">
        
        {{-- header register --}}
        <div class="auth-header">
            <h2><i class="fas fa-user-plus"></i> Create Account</h2>
            <p>Daftar untuk mengelola tugasmu</p>
        </div>

        {{-- pesan error --}}
        @if ($errors->any())
            <div class="alert alert-error" style="background: rgba(239,68,68,.15); border: 1px solid #ef4444; color: #fca5a5; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- form register --}}
        <form method="POST" action="{{ url('/register') }}">
            @csrf
            
            <div class="auth-input-field">
                <i class="fas fa-user"></i>
                <input type="text" name="username" maxlength="100" placeholder="Username" value="{{ old('username') }}" required autofocus>
            </div>

            <div class="auth-input-field">
                <i class="fas fa-id-badge"></i>
                <input type="text" name="panggilan" maxlength="100" placeholder="Nama Panggilan (Opsional)" value="{{ old('panggilan') }}">
            </div>

            <div class="auth-input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" maxlength="100" placeholder="Password (Min. 6 Karakter)" required>
            </div>

            <button type="submit" class="auth-btn-primary">Sign Up</button>
        </form>

        {{-- navigasi bawah --}}
        <div class="auth-footer">
            <p>Already have an account? <a href="{{ url('/login') }}">Log in</a></p>
            <p><a href="{{ url('/') }}">Back to Home</a></p>
        </div>
        
    </div>

</body>
</html>