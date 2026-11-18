
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin | Lost&Found</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;

            background: linear-gradient(
                110deg,
                #080c68,
                #1725a8,
                #303fe2
            );
        }

        .login-card {
            width: 100%;
            max-width: 480px;
            padding: 38px 35px;

            background-color: white;
            border-radius: 22px;

            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
        }

        .login-title {
            color: #080e69;
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 0;
        }

        .login-subtitle {
            color: #999;
            font-size: 15px;
            font-style: italic;
            margin-bottom: 25px;
        }

        .form-label {
            color: #080e69;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            height: 53px;
            border: 1.5px solid #10105a;
            border-radius: 11px;
            padding: 12px 18px;
            font-size: 15px;
        }

        .form-control::placeholder {
            color: #aaa;
            font-style: italic;
        }

        .form-control:focus {
            border-color: #303fe2;
            box-shadow: 0 0 0 0.15rem rgba(48, 63, 226, 0.15);
        }

        .form-check {
            margin-top: 14px;
            margin-bottom: 20px;
        }

        .form-check-input {
            width: 19px;
            height: 19px;
            border: 1.5px solid #10105a;
            cursor: pointer;
        }

        .form-check-label {
            color: #999;
            font-style: italic;
            margin-left: 5px;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            height: 54px;

            background-color: #080e69;
            color: white;

            border: none;
            border-radius: 11px;

            font-size: 25px;
            font-weight: 700;

            transition: 0.2s;
        }

        .btn-login:hover {
            background-color: #1725a8;
            color: white;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 30px 24px;
            }

            .login-title {
                font-size: 30px;
            }

            .btn-login {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    <div class="login-card">

        <!-- Judul -->
        <div class="text-center">
            <h1 class="login-title">Lost&Found</h1>
            <p class="login-subtitle">Login sebagai admin</p>
        </div>

        <!-- Form Login -->
        <form>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">
                    Email
                </label>

                <input
                    type="email"
                    class="form-control"
                    id="email"
                    placeholder="admin@email.ac.id"
                    autocomplete="username"
                >
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">
                    Password
                </label>

                <input
                    type="password"
                    class="form-control"
                    id="password"
                    placeholder="•••"
                    autocomplete="current-password"
                >
            </div>

            <!-- Ingat Saya -->
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="remember"
                >

                <label class="form-check-label" for="remember">
                    Ingat saya
                </label>
            </div>

            <!-- Tombol Masuk -->
            <button type="button" class="btn btn-login">
                Masuk
            </button>

        </form>

    </div>

</body>
</html>
