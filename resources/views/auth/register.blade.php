<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SPK Kredit</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #eef2ff 0%, #e8f4f0 50%, #f0f8f0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 20px;
        }

        /* Decorative circles */
        .circle-top-right {
            position: fixed;
            top: -60px;
            right: -60px;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(200, 210, 230, 0.45);
            z-index: 0;
        }

        .circle-bottom-left {
            position: fixed;
            bottom: -70px;
            left: -70px;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: rgba(200, 210, 230, 0.35);
            z-index: 0;
        }

        /* Back link */
        .back-link-wrapper {
            position: fixed;
            top: 32px;
            left: 40px;
            z-index: 10;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #555e7a;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #2d3a6b;
        }

        .back-link svg {
            width: 16px;
            height: 16px;
        }

        /* Card */
        .card {
            background: #ffffff;
            border-radius: 20px;
            padding: 44px 40px 36px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 40px rgba(80, 100, 160, 0.10);
            position: relative;
            z-index: 5;
        }

        /* Header */
        .card-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .card-title {
            font-size: 26px;
            font-weight: 700;
            color: #1a2550;
            margin-bottom: 6px;
            letter-spacing: -0.3px;
        }

        .card-subtitle {
            font-size: 14px;
            color: #9aa3bf;
            font-weight: 400;
        }

        /* Form group */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 13.5px;
            font-weight: 600;
            color: #2d3560;
            margin-bottom: 7px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #aab3cc;
            display: flex;
            align-items: center;
        }

        .input-icon svg {
            width: 16px;
            height: 16px;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px 12px 40px;
            border: 1.5px solid #e4e8f5;
            border-radius: 10px;
            font-size: 14px;
            color: #2d3560;
            background: #fafbff;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-input::placeholder {
            color: #c2c9de;
        }

        .form-input:focus {
            border-color: #3b5bdb;
            box-shadow: 0 0 0 3px rgba(59, 91, 219, 0.10);
            background: #fff;
        }

        .form-input.has-toggle {
            padding-right: 42px;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #aab3cc;
            display: flex;
            align-items: center;
            padding: 0;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: #3b5bdb;
        }

        .toggle-password svg {
            width: 17px;
            height: 17px;
        }

        /* Error messages */
        .error-message {
            color: #e53e3e;
            font-size: 12px;
            margin-top: 4px;
        }

        /* Terms */
        .terms-text {
            font-size: 13px;
            color: #7b849e;
            text-align: center;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .terms-text a {
            color: #3b5bdb;
            text-decoration: none;
            font-weight: 600;
        }

        .terms-text a:hover {
            text-decoration: underline;
        }

        /* Submit button */
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #3b5bdb;
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.3px;
            transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
            box-shadow: 0 4px 16px rgba(59, 91, 219, 0.25);
            margin-bottom: 20px;
        }

        .btn-submit:hover {
            background: #2f4ac5;
            box-shadow: 0 6px 20px rgba(59, 91, 219, 0.35);
        }

        .btn-submit:active {
            transform: scale(0.99);
        }

        /* Login link */
        .login-link {
            text-align: center;
            font-size: 14px;
            color: #7b849e;
        }

        .login-link a {
            color: #3b5bdb;
            text-decoration: none;
            font-weight: 700;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Alert error */
        .alert-error {
            background: #fff5f5;
            border: 1px solid #fed7d7;
            color: #c53030;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .alert-error ul {
            margin: 0;
            padding-left: 16px;
        }

        @media (max-width: 480px) {
            .card {
                padding: 36px 24px 28px 24px;
            }

            .back-link-wrapper {
                top: 20px;
                left: 20px;
            }
        }
    </style>
</head>
<body>

    {{-- Decorative Circles --}}
    <div class="circle-top-right"></div>
    <div class="circle-bottom-left"></div>

    {{-- Back Link --}}
    <div class="back-link-wrapper">
        <a href="{{ url('/') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Beranda
        </a>
    </div>

    {{-- Registration Card --}}
    <div class="card">

        {{-- Header --}}
        <div class="card-header">
            <h1 class="card-title">Buat Akun Baru</h1>
            <p class="card-subtitle">Bergabung dengan SPK Kredit sekarang</p>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Nama Lengkap --}}
            <div class="form-group">
                <label class="form-label" for="name">Nama Lengkap</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </span>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        class="form-input"
                        placeholder="Masukkan nama lengkap"
                        value="{{ old('name') }}"
                        autocomplete="name"
                        autofocus
                    >
                </div>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat Email --}}
            <div class="form-group">
                <label class="form-label" for="email">Alamat Email</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </span>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="form-input"
                        placeholder="contoh@email.com"
                        value="{{ old('email') }}"
                        autocomplete="email"
                    >
                </div>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </span>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-input has-toggle"
                        placeholder="Minimal 6 karakter"
                        autocomplete="new-password"
                    >
                    <button type="button" class="toggle-password" onclick="togglePassword('password', this)" aria-label="Tampilkan password">
                        <svg id="eye-icon-password" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="form-group" style="margin-bottom: 16px;">
                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </span>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="form-input has-toggle"
                        placeholder="Ulangi password"
                        autocomplete="new-password"
                    >
                    <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', this)" aria-label="Tampilkan konfirmasi password">
                        <svg id="eye-icon-password_confirmation" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Terms & Conditions --}}
            <p class="terms-text">
                Saya setuju dengan <a href="#">Syarat &amp; Ketentuan</a> dan
                <a href="#">Kebijakan Privasi</a>
            </p>

            {{-- Submit Button --}}
            <button type="submit" class="btn-submit">
                Daftar Sekarang
            </button>

            {{-- Login Link --}}
            <p class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
            </p>

        </form>
    </div>

    <script>
        function togglePassword(fieldId, btn) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById('eye-icon-' + fieldId);

            if (input.type === 'password') {
                input.type = 'text';
                // Eye-slash icon
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                `;
            } else {
                input.type = 'password';
                // Eye icon
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                `;
            }
        }
    </script>

</body>
</html>