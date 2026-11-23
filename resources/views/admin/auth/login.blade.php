<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Lost&amp;Found</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #000456;
            --blue: #1d40d4;
            --text: #182044;
            --muted: #7c8294;
            --border: #cbd2e3;
        }
        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            margin: 0;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            color: var(--text);
            background: linear-gradient(180deg, #000456 0%, #1633b8 55%, #2347e0 100%);
        }
        .login-card {
            width: 100%;
            max-width: 440px;
            padding: 40px 38px;
            background: #fff;
            border-radius: 26px;
            box-shadow: 0 18px 50px rgba(0, 4, 86, .22);
        }
        .login-header { margin-bottom: 28px; text-align: center; }
        .login-header h1 {
            margin: 0;
            color: var(--navy);
            font-size: 30px;
            line-height: 1.3;
            font-weight: 800;
            letter-spacing: -1.2px;
        }
        .login-header p { margin: 5px 0 0; color: var(--muted); font-size: 13px; }
        .form-title {
            margin-bottom: 24px;
            padding: 12px 16px;
            border-radius: 12px;
            color: #fff;
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            background: linear-gradient(90deg, #000456 0%, #1d40d4 100%);
        }
        .form-group { margin-bottom: 18px; }
        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: var(--navy);
            font-size: 13px;
            font-weight: 700;
        }
        .form-group input {
            display: block;
            width: 100%;
            min-height: 46px;
            padding: 11px 14px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            outline: none;
            color: var(--text);
            background: #fff;
            font: 13px 'Poppins', sans-serif;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-group input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(29, 64, 212, .12);
        }
        .form-group input::placeholder { color: #a0a5b5; }
        .login-button {
            width: 100%;
            min-height: 47px;
            margin-top: 5px;
            border: 0;
            border-radius: 14px;
            color: #fff;
            background: linear-gradient(90deg, #000456 0%, #1d40d4 100%);
            font: 600 15px 'Poppins', sans-serif;
            cursor: pointer;
            transition: opacity .2s, transform .2s;
        }
        .login-button:hover { opacity: .92; transform: translateY(-1px); }
        .back-link { margin-top: 20px; text-align: center; }
        .back-link a { color: #2545c7; font-size: 12px; text-decoration: none; }
        .back-link a:hover { text-decoration: underline; }
        .alert {
            margin-bottom: 17px;
            padding: 11px 13px;
            border-radius: 9px;
            font-size: 12px;
            line-height: 1.6;
        }
        .alert-error { color: #991b1b; background: #fee2e2; }
        .alert-success { color: #166534; background: #dcfce7; }
        .field-error { display: block; margin-top: 5px; color: #b42332; font-size: 11px; }
        @media (max-width: 480px) {
            body { padding: 16px; }
            .login-card { padding: 30px 23px; border-radius: 21px; }
            .login-header h1 { font-size: 27px; }
        }
    </style>
</head>
<body>
    <main class="login-card">
        <header class="login-header">
            <h1>Lost&amp;Found</h1>
            <p>Sistem Informasi Kehilangan dan Temuan Barang</p>
        </header>

        <div class="form-title">Login Administrator</div>

        @if (session('error'))
            <div class="alert alert-error" role="alert">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="alert alert-success" role="status">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error" role="alert">
                Mohon periksa kembali data login yang dimasukkan.
            </div>
        @endif

        <form action="{{ route('admin.authenticate') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email admin"
                    autocomplete="username"
                    required
                    autofocus
                >
                @error('email') <small class="field-error">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >
                @error('password') <small class="field-error">{{ $message }}</small> @enderror
            </div>

            <button class="login-button" type="submit">Masuk</button>
        </form>

        <div class="back-link">
            <a href="{{ route('home') }}">&larr; Kembali ke Beranda Pengunjung</a>
        </div>
    </main>
</body>
</html>
