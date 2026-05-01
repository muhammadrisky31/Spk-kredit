<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPK Kredit</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef1f7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Decorative blobs */
        .blob {
            position: absolute;
            border-radius: 50%;
            background-color: #d8e2f3;
            opacity: 0.6;
            z-index: 0;
        }

        .blob-top-right {
            width: 180px;
            height: 180px;
            top: -40px;
            right: -40px;
            background-color: #c8d9ef;
            opacity: 0.5;
        }

        .blob-bottom-left {
            width: 220px;
            height: 220px;
            bottom: -60px;
            left: -60px;
            background-color: #b8cde8;
            opacity: 0.45;
        }

        .blob-bottom-left-small {
            width: 100px;
            height: 100px;
            bottom: 60px;
            left: 80px;
            background-color: #3b5bdb;
            opacity: 0.15;
            border-radius: 50%;
        }

        /* Back link */
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
            color: #555;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #3b5bdb;
        }

        .back-link svg {
            width: 16px;
            height: 16px;
        }

        /* Card */
        .card-wrapper {
            position: relative;
            z-index: 5;
            width: 100%;
            max-width: 390px;
            padding: 0 20px;
            margin-top: 20px;
        }

        .card {
            background: #ffffff;
            border-radius: 20px;
            padding: 42px 40px 36px;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.09);
        }

        /* Heading */
        .card-title {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a2e;
            text-align: center;
            margin-bottom: 6px;
        }

        .card-subtitle {
            font-size: 13px;
            color: #888;
            text-align: center;
            margin-bottom: 28px;
        }

        /* Form */
        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 13px;
            display: flex;
            align-items: center;
            color: #aaa;
        }

        .input-icon svg {
            width: 16px;
            height: 16px;
        }

        .form-input {
            width: 100%;
            padding: 11px 14px 11px 38px;
            border: 1.5px solid #e0e4ef;
            border-radius: 10px;
            font-size: 13.5px;
            color: #333;
            background: #f9fafd;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-input::placeholder {
            color: #bbb;
        }

        .form-input:focus {
            border-color: #3b5bdb;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(59, 91, 219, 0.1);
        }

        /* Password toggle */
        .toggle-password {
            position: absolute;
            right: 13px;
            background: none;
            border: none;
            cursor: pointer;
            color: #aaa;
            display: flex;
            align-items: center;
            padding: 0;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: #555;
        }

        .toggle-password svg {
            width: 17px;
            height: 17px;
        }

        /* Error messages */
        .error-message {
            font-size: 12px;
            color: #e53e3e;
            margin-top: 4px;
        }

        /* Submit button */
        .btn-submit {
            width: 100%;
            padding: 13px;
            background: #3b5bdb;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.2s, transform 0.1s;
            letter-spacing: 0.3px;
        }

        .btn-submit:hover {
            background: #3451c7;
        }

        .btn-submit:active {
            transform: scale(0.99);
        }

        /* Register link */
        .register-text {
            text-align: center;
            font-size: 13px;
            color: #888;
            margin-top: 18px;
        }

        .register-text a {
            color: #3b5bdb;
            font-weight: 600;
            text-decoration: none;
        }

        .register-text a:hover {
            text-decoration: underline;
        }

        /* Alert errors (Laravel) */
        .alert-error {
            background: #fff5f5;
            border: 1px solid #fed7d7;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 16px;
            font-size: 13px;
            color: #c53030;
        }
    </style>
</head>
<body>

    <!-- Decorative Blobs -->
    <div class="blob blob-top-right"></div>
    <div class="blob blob-bottom-left"></div>
    <div class="blob blob-bottom-left-small"></div>

    <!-- Back to Home Link -->
    <div class="back-link-wrapper">
        <a href="{{ url('/') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Beranda
        </a>
    </div>

    <!-- Login Card -->
    <div class="card-wrapper">
        <div class="card">

            <h1 class="card-title">Selamat Datang!</h1>
            <p class="card-subtitle">Masuk ke akun SPE Kredit Anda</p>

            {{-- Session error messages --}}
            @if ($errors->any())
                <div class="alert-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('error'))
                <div class="alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">Alamat Email</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-input"
                            placeholder="contoh@email.com"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required
                        >
                    </div>
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                        </span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-input"
                            placeholder="Minimal 8 karakter"
                            autocomplete="current-password"
                            required
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword()" aria-label="Tampilkan/Sembunyikan password">
                            <!-- Eye icon (show) -->
                            <svg id="eye-show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <!-- Eye-slash icon (hide) -->
                            <svg id="eye-hide" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" style="display:none;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">Masuk</button>
            </form>

            <p class="register-text">
                Belum punya akun?&nbsp;<a href="{{ route('register') }}">Daftar Sekarang</a>
            </p>

        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const eyeShow = document.getElementById('eye-show');
            const eyeHide = document.getElementById('eye-hide');

            if (input.type === 'password') {
                input.type = 'text';
                eyeShow.style.display = 'none';
                eyeHide.style.display = 'block';
            } else {
                input.type = 'password';
                eyeShow.style.display = 'block';
                eyeHide.style.display = 'none';
            }
        }
    </script>

</body>
</html>