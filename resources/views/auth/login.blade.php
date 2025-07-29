<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sikapin - Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            display: flex;
            overflow: hidden;
        }

        .container {
            display: flex;
            width: 100%;
            height: 100vh;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.1);
        }

        /* Left Side - Illustration */
        .left-side {
            flex: 1;
            background: linear-gradient(135deg, #e3f4ff 0%, #c8e8ff 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
            position: relative;
            overflow: hidden;
        }

        .left-side::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .illustration-container {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 400px;
        }

        .illustration-text {
            margin-bottom: 0px;
        }

        .illustration-text h2 {
            font-size: 24px;
            color: #1e40af;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .illustration-text .highlight {
            color: #ef4444;
            font-weight: 700;
        }

        .illustration-text p {
            color: #1e40af;
            font-size: 16px;
            line-height: 1.5;
        }

        .illustration {
            position: relative;
            width: 100%;
            max-width: 350px;
            margin: 0 auto;
        }

        /* 3D Illustration Elements */
        .scene {
            width: 100%;
            height: 300px;
            position: relative;
            perspective: 1000px;
        }

        .desk {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 60px;
            background: linear-gradient(145deg, #e0e7ff, #c7d2fe);
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.2);
        }

        .accept-button {
            position: absolute;
            bottom: 120px;
            right: 20px;
            background: #10b981;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .plant {
            position: absolute;
            bottom: 0;
            right: 80px;
            width: 20px;
            height: 40px;
            z-index: 1;
        }

        .plant-pot {
            position: absolute;
            bottom: 0;
            width: 20px;
            height: 15px;
            background: #92400e;
            border-radius: 2px;
        }

        .plant-stem {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 20px;
            background: #16a34a;
        }

        .plant-leaves {
            position: absolute;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            width: 12px;
            height: 8px;
            background: #22c55e;
            border-radius: 50%;
        }

        /* Floating Elements */
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .float-icon {
            position: absolute;
            opacity: 0.6;
            animation: float 6s ease-in-out infinite;
        }

        .float-icon:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .float-icon:nth-child(2) {
            top: 30%;
            right: 15%;
            animation-delay: 2s;
        }

        .float-icon:nth-child(3) {
            bottom: 30%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        /* Right Side - Login Form */
        .right-side {
            flex: 1;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 50px;
            position: relative;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 40px;
        }

        .brand-icon {
            width: 32px;
            height: 32px;
            background: #white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
        }

        .welcome-section {
            margin-bottom: 40px;
        }

        .welcome-section h1 {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .welcome-section p {
            color: #6b7280;
            font-size: 14px;
        }

        .login-form {
            width: 100%;
            max-width: 400px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-input {

            width: 100%;
            padding: 14px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            background: #f9fafb;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: #0083ee;
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .password-input-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
        }

        .password-toggle:hover {
            color: #3b82f6;
        }

        .login-button {
            width: 100%;
            padding: 14px;
            background:#0083ee;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }

        .forgot-password {
            text-align: center;
            margin-bottom: 30px;
        }

        .forgot-password a {
            color: #3b82f6;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
            color: #6b7280;
            font-size: 14px;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
            z-index: 1;
        }

        .divider span {
            background: white;
            padding: 0 16px;
            position: relative;
            z-index: 2;
        }

        .social-login {
            display: flex;
            gap: 12px;
            margin-bottom: 30px;
        }

        .social-btn {
            flex: 1;
            padding: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .social-btn:hover {
            border-color: #d1d5db;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .google-btn {
            color: #ea4335;
        }

        .facebook-btn {
            color: #1877f2;
        }

        .apple-btn {
            color: #000;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #3b82f6;
        }

        .remember-me label {
            font-size: 14px;
            color: #374151;
            cursor: pointer;
        }

        .terms-section {
            font-size: 12px;
            color: #6b7280;
            text-align: center;
            line-height: 1.5;
        }

        .terms-section a {
            color: #3b82f6;
            text-decoration: none;
        }

        .terms-section a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .container {
                flex-direction: column;
                height: auto;
                min-height: 100vh;
            }

            .left-side {
                flex: none;
                height: 40vh;
                padding: 30px 20px;
            }

            .right-side {
                flex: none;
                padding: 40px 30px;
            }

            .scene {
                height: 200px;
            }
        }

        @media (max-width: 768px) {
            .left-side {
                height: 30vh;
                padding: 20px;
            }

            .right-side {
                padding: 30px 20px;
            }

            .illustration-text h2 {
                font-size: 20px;
            }

            .welcome-section h1 {
                font-size: 24px;
            }

            .social-login {
                flex-direction: column;
            }
        }

        /* Loading Animation */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-left: 8px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Success/Error Messages */
        .message {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: none;
        }

        .success-message {
            background: #d1fae5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .error-message {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Left Side - Illustration -->
        <div class="left-side">
            <div class="floating-elements">
                <div class="float-icon" style="font-size: 24px; color: #3b82f6;">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="float-icon" style="font-size: 20px; color: #10b981;">
                    <i class="fas fa-book"></i>
                </div>
                <div class="float-icon" style="font-size: 18px; color: #f59e0b;">
                    <i class="fas fa-lightbulb"></i>
                </div>
            </div>

            <div class="illustration-container">
                <div class="illustration-text">
                    <h2>Permudah interaksi antar <span class="highlight">Dosen</span> dan</h2>
                    <h2><span class="highlight">Mahasiswa</span> secara online!</h2>
                </div>

                <div class="illustration">
                    <div class="scene">
                        <div
                            style="display: flex; justify-content: center; align-items: center; margin-top: 10px; margin-bottom: 20px">
                            <div style="width: 450px; height: 450px; border-radius: 50%; overflow: hidden;">
                                <img src="{{ asset('img/loginanimasi.png') }}" alt="animasi-login"
                                    style="width: 100%; height: 100%; object-fit: cover; display: block;">
                            </div>
                        </div>
                        <div class="accept-button">Accept</div>
                        <div class="plant">
                            <div class="plant-pot"></div>
                            <div class="plant-stem"></div>
                            <div class="plant-leaves"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="right-side">
            <div class="brand-header">
                <div class="brand-icon">
                    <img src="{{ asset('img/logo-11.png') }}" alt="logo-11"
                        style="width: 100%; height: 100%; object-fit: cover; display: block;">
                </div>
                <span class="brand-name">Sikapin</span>
            </div>

            <div class="welcome-section">
                <h1>Hai, selamat datang kembali</h1>
                <p>Masuk ke Sikapin! | <a href="#" style="color: #3b82f6;">Daftar baru?</a></p>
            </div>

            <div class="success-message message" id="successMessage">
                <i class="fas fa-check-circle"></i> Login berhasil! Mengalihkan...
            </div>

            <div class="error-message message" id="errorMessage">
                <i class="fas fa-exclamation-circle"></i> Email atau password salah. Silakan coba lagi.
            </div>

            <form method="POST" action="/login" class="login-form" id="loginForm">
                @csrf

                <div class="form-group">
                    <input type="email" name="email" class="form-input" placeholder="Contoh: myedulinks@ui.ac.id"
                        required>
                </div>

                <div class="form-group">
                    <div class="password-input-wrapper">
                        <input type="password" name="password" class="form-input" placeholder="Masukkan kata sandi Anda"
                            required>
                        <button type="button" class="password-toggle" id="passwordToggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>



                <button type="submit" class="login-button" id="loginBtn">
                    Masuk
                    <span class="spinner" style="display: none;"></span>
                </button>
            </form>
        </div>
    </div>


</body>

</html>
