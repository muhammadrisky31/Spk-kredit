<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPK Kredit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

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

        .blob { position: absolute; border-radius: 50%; opacity: 0.6; z-index: 0; }
        .blob-top-right { width: 180px; height: 180px; top: -40px; right: -40px; background-color: #c8d9ef; opacity: 0.5; }
        .blob-bottom-left { width: 220px; height: 220px; bottom: -60px; left: -60px; background-color: #b8cde8; opacity: 0.45; }
        .blob-bottom-left-small { width: 100px; height: 100px; bottom: 60px; left: 80px; background-color: #3b5bdb; opacity: 0.15; border-radius: 50%; }

        .back-link-wrapper { position: fixed; top: 32px; left: 40px; z-index: 10; }
        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            color: #555; text-decoration: none; font-size: 13.5px; font-weight: 500; transition: color 0.2s;
        }
        .back-link:hover { color: #3b5bdb; }
        .back-link svg { width: 16px; height: 16px; }

        .card-wrapper { position: relative; z-index: 5; width: 100%; max-width: 390px; padding: 0 20px; margin-top: 20px; }
        .card { background: #ffffff; border-radius: 20px; padding: 42px 40px 36px; box-shadow: 0 8px 40px rgba(0,0,0,0.09); }

        .card-title { font-size: 24px; font-weight: 700; color: #1a1a2e; text-align: center; margin-bottom: 6px; }
        .card-subtitle { font-size: 13px; color: #888; text-align: center; margin-bottom: 28px; }

        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: #333; margin-bottom: 6px; }

        .input-wrapper { position: relative; display: flex; align-items: center; }

        .input-icon {
            position: absolute; left: 13px;
            display: flex; align-items: center;
            color: #aaa; font-size: 15px;
        }

        .form-input {
            width: 100%;
            padding: 11px 42px 11px 38px;
            border: 1.5px solid #e0e4ef;
            border-radius: 10px;
            font-size: 13.5px; color: #333;
            background: #f9fafd; outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-input::placeholder { color: #bbb; }
        .form-input:focus {
            border-color: #3b5bdb;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(59,91,219,0.1);
        }

        /* Sembunyikan icon bawaan browser */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }
        input[type="password"]::-webkit-credentials-auto-fill-button {
            display: none;
        }

        .toggle-password {
            position: absolute; right: 13px;
            background: none; border: none;
            cursor: pointer; color: #aaa;
            font-size: 15px;
            display: flex; align-items: center; justify-content: center;
            padding: 0; width: 22px; height: 22px;
            transition: color 0.2s;
        }
        .toggle-password:hover { color: #555; }

        .error-message { font-size: 12px; color: #e53e3e; margin-top: 4px; }

        .btn-submit {
            width: 100%; padding: 13px;
            background: #3b5bdb; color: #fff;
            font-size: 15px; font-weight: 600;
            border: none; border-radius: 10px;
            cursor: pointer; margin-top: 8px;
            transition: background 0.2s, transform 0.1s;
            letter-spacing: 0.3px;
        }
        .btn-submit:hover { background: #3451c7; }
        .btn-submit:active { transform: scale(0.99); }

        .register-text { text-align: center; font-size: 13px; color: #888; margin-top: 18px; }
        .register-text a { color: #3b5bdb; font-weight: 600; text-decoration: none; }
        .register-text a:hover { text-decoration: underline; }

        .alert-error {
            background: #fff5f5; border: 1px solid #fed7d7;
            border-radius: 8px; padding: 10px 14px;
            margin-bottom: 16px; font-size: 13px; color: #c53030;
        }
    </style>
</head>
<body>

    <div class="blob blob-top-right"></div>
    <div class="blob blob-bottom-left"></div>
    <div class="blob blob-bottom-left-small"></div>

    <div class="back-link-wrapper">
        <a href="{{ url('/') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Beranda
        </a>
    </div>

    <div class="card-wrapper">
        <div class="card">

            <h1 class="card-title">Selamat Datang!</h1>
            <p class="card-subtitle">Masuk ke akun SPK Kredit Anda</p>

            @if ($errors->any())
                <div class="alert-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Alamat Email</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <i class="fa-regular fa-envelope"></i>
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

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-input"
                            placeholder="Minimal 8 karakter"
                            autocomplete="new-password"
                            minlength="8"
                            required
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i id="eye-icon" class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

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
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

</body>
</html>