<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sikapin - Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #56a6e8;
            --primary-dark: #0083ee;
            --primary-light: #3456ff;
            --secondary: #2387d8;
            --success: #10b981;
            --error: #ef4444;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --white: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --shadow-2xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --border-radius-sm: 0.375rem;
            --border-radius: 0.5rem;
            --border-radius-md: 0.75rem;
            --border-radius-lg: 1rem;
            --border-radius-xl: 1.5rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .login-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: var(--white);
            border-radius: var(--border-radius-xl);
            box-shadow: var(--shadow-2xl);
            overflow: hidden;
            min-height: 640px;
            width: 100%;
            max-width: 1100px;
            position: relative;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Left Side - Login Form */
        .left-side {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem 3.5rem;
            background: var(--white);
            position: relative;
            z-index: 10;
        }

        .login-header {
            margin-bottom: 3rem;
            text-align: center;
        }

        .login-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.75rem;
            letter-spacing: -0.025em;
            line-height: 1.1;
        }

        .login-subtitle {
            color: var(--gray-600);
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.6;
            max-width: 320px;
            margin: 0 auto;
        }

        .login-form {
            width: 100%;
            max-width: 380px;
            margin: 0 auto;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 2rem;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.75rem;
            font-weight: 600;
            color: var(--gray-700);
            font-size: 0.875rem;
            letter-spacing: 0.025em;
            text-transform: uppercase;
        }

        .input-wrapper {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            border: 2px solid var(--gray-200);
            border-radius: var(--border-radius-md);
            background: var(--gray-50);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
            color: var(--gray-900);
            font-weight: 500;
            position: relative;
        }

        .form-input:focus {
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            transform: translateY(-1px);
        }

        .form-input::placeholder {
            color: var(--gray-400);
            font-weight: 400;
        }

        .form-input:not(:placeholder-shown) {
            background: var(--white);
            border-color: var(--gray-300);
        }

        /* Password Input Special Styling */
        .password-input-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-400);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: var(--border-radius-sm);
            transition: all 0.2s ease;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            color: var(--primary);
            background: rgba(99, 102, 241, 0.05);
        }

        /* Forgot Password */
        .forgot-password {
            text-align: right;
            margin-bottom: 2.5rem;
        }

        .forgot-password a {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            position: relative;
            padding: 0.25rem 0;
        }

        .forgot-password a:hover {
            color: var(--primary-dark);
        }

        .forgot-password a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .forgot-password a:hover::after {
            width: 100%;
        }

        /* Login Button */
        .login-button {
            width: 100%;
            padding: 1rem 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            border: none;
            border-radius: var(--border-radius-md);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .login-button:active {
            transform: translateY(-1px);
        }

        .login-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .login-button:hover::before {
            left: 100%;
        }

        /* Messages */
        .message {
            padding: 1rem 1.25rem;
            border-radius: var(--border-radius-md);
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            display: none;
            align-items: center;
            gap: 0.75rem;
            border: 1px solid;
            backdrop-filter: blur(10px);
        }

        .success-message {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border-color: rgba(16, 185, 129, 0.2);
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            color: var(--error);
            border-color: rgba(239, 68, 68, 0.2);
        }

        /* Loading State */
        .loading {
            opacity: 0.8;
            pointer-events: none;
        }

        .spinner {
            display: inline-block;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: var(--white);
            animation: spin 1s ease-in-out infinite;
            margin-left: 0.5rem;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Right Side - Illustration */
        .right-side {
            position: relative;
            overflow: hidden;
            display: flex;
            background: rgb(114, 192, 255);
            flex-direction: column;
            justify-content: space-between;
            order: 1;
            height: 650px;
            padding: 2rem;

        }

        /* Decorative Elements */
        .decorative-grid {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.1;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            z-index: 1;
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 2;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 80px;
            height: 80px;
            top: 20%;
            right: 15%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 70%;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 40px;
            height: 40px;
            top: 80%;
            right: 30%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        /* Logo Section */
        .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
            z-index: 10;
            position: relative;
            margin-bottom: 2rem;
        }

        .logo-icon {
            width: 3rem;
            height: 3rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e3e3e3;
            font-size: 1.5rem;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: var(--shadow-lg);
        }

        .logo-text {
            color: #e3e3e3;
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: 0.1em;
        }

        /* Enhanced Image Wrapper - FIXED POSITIONING */
        .image-wrapper {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 5;
            width: 240px;
            height: 240px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-circle {
            width: 550px;
            height: 450px;
            border-radius: 50%;
            overflow: hidden;
        }

        .image-content {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .image-circle:hover .image-content {
            transform: scale(1.05);
        }

        /* Enhanced Landscape */
        .landscape-container {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 75%;
            z-index: 3;
        }

        /* Mountains with Better Gradients */
        .mountain-layer {
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .mountain-1 {
            height: 200px;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
            clip-path: polygon(0 100%, 15% 50%, 35% 70%, 60% 30%, 80% 60%, 100% 40%, 100% 100%);
            z-index: 6;
        }

        .mountain-2 {
            height: 160px;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.08));
            clip-path: polygon(0 100%, 20% 60%, 40% 40%, 70% 70%, 90% 30%, 100% 50%, 100% 100%);
            z-index: 5;
        }

        .mountain-3 {
            height: 120px;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.06));
            clip-path: polygon(0 100%, 25% 40%, 50% 60%, 75% 20%, 100% 70%, 100% 100%);
            z-index: 4;
        }

        /* Enhanced Wind Turbines */
        .turbine {
            position: absolute;
            z-index: 7;
        }

        .turbine-1 {
            left: 25%;
            bottom: 180px;
        }

        .turbine-2 {
            right: 35%;
            bottom: 150px;
        }

        .turbine-3 {
            right: 18%;
            bottom: 190px;
        }

        .turbine-pole {
            width: 4px;
            height: 80px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7));
            margin: 0 auto;
            position: relative;
            border-radius: 2px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .turbine-blades {
            position: absolute;
            top: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 36px;
            height: 36px;
            animation: rotate 4s linear infinite;
        }

        .turbine-blades::before,
        .turbine-blades::after {
            content: '';
            position: absolute;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 3px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .turbine-blades::before {
            width: 3px;
            height: 16px;
            left: 50%;
            top: 0;
            transform: translateX(-50%);
        }

        .turbine-blades::after {
            width: 16px;
            height: 3px;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
        }

        @keyframes rotate {
            from {
                transform: translateX(-50%) rotate(0deg);
            }

            to {
                transform: translateX(-50%) rotate(360deg);
            }
        }

        /* Brand Integration */
        .brand-integration {
            position: relative;
            z-index: 10;
            color: #e3e3e3;
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem 1.25rem;
            border-radius: 2rem;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--shadow-lg);
            margin-top: auto;
        }

        /* Wave Separation */
        .wave-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 8;
        }

        .wave-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: -60px;
            width: calc(100% + 120px);
            height: 100%;
            background: var(--white);
            clip-path: ellipse(75% 100% at 100% 50%);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .login-container {
                grid-template-columns: 1fr;
                grid-template-rows: auto 1fr;
                max-width: 500px;
                margin: 0 auto;
            }

            .right-side {
                order: 1;
                height: 320px;
                padding: 2rem;
            }

            .left-side {
                order: 2;
                padding: 3rem 2.5rem;
            }

            .wave-overlay::before {
                clip-path: ellipse(100% 80% at 50% 0%);
                height: 80px;
                bottom: -1px;
                top: auto;
            }

            .landscape-container {
                height: 65%;
            }

            .mountain-1 {
                height: 140px;
            }

            .mountain-2 {
                height: 110px;
            }

            .mountain-3 {
                height: 80px;
            }

            .turbine-pole {
                height: 60px;
            }

            .turbine-1 {
                bottom: 130px;
            }

            .turbine-2 {
                bottom: 110px;
            }

            .turbine-3 {
                bottom: 140px;
            }

            .image-wrapper {
                width: 180px;
                height: 180px;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .login-container {
                border-radius: var(--border-radius-lg);
            }

            .right-side {
                height: 280px;
                padding: 1.5rem;
            }

            .left-side {
                padding: 2.5rem 2rem;
            }

            .login-title {
                font-size: 2rem;
            }

            .login-header {
                margin-bottom: 2.5rem;
            }

            .image-wrapper {
                width: 160px;
                height: 160px;
            }
        }

        @media (max-width: 480px) {
            .left-side {
                padding: 2rem 1.5rem;
            }

            .login-title {
                font-size: 1.75rem;
            }

            .form-input {
                padding: 0.875rem 1rem;
                font-size: 1rem;
            }

            .login-button {
                padding: 0.875rem 0;
                font-size: 0.9rem;
            }

            .brand-integration {
                padding: 0.75rem 1rem;
                font-size: 0.8rem;
            }

            .image-wrapper {
                width: 140px;
                height: 140px;
            }
        }

        /* Loading Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Focus styles for accessibility */
        *:focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }
    </style>
</head>

<body>
    <!-- Left Side - Login Form -->
    <div class="left-side">
        <div class="login-header">
            <h1 class="login-title">LOGIN</h1>
            <p class="login-subtitle">Masuk ke Sikapin untuk melanjutkan pembelajaran Anda dengan fitur terdepan
            </p>
        </div>

        <!-- Success & Error Messages -->
        <div class="success-message message" id="successMessage">
            <i class="fas fa-check-circle"></i>
            <span>Login berhasil! Mengalihkan ke dashboard...</span>
        </div>

        <div class="error-message message" id="errorMessage">
            <i class="fas fa-exclamation-circle"></i>
            <span>Email atau password salah. Silakan coba lagi.</span>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login.submit') }}" class="login-form">
            @csrf
            <div class="form-group">
                <label class="form-label">NIP</label>
                <div class="input-wrapper">
                    <input type="text" name="nip_wakasek" class="form-input" placeholder="yourname@email.com"
                        required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrapper password-input-wrapper">
                    <input type="password" name="password" class="form-input" placeholder="Masukkan password Anda"
                        required>
                    <button type="button" class="password-toggle" id="passwordToggle">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="forgot-password">
                <a href="#">Lupa password?</a>
            </div>

            <button type="submit" class="login-button" id="loginBtn">
                LOGIN
                <span class="spinner" style="display: none;"></span>
            </button>
        </form>
    </div>

    <!-- Right Side - Illustration -->
    <div class="right-side">
        <!-- Decorative Elements -->
        <div class="decorative-grid"></div>
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>

        <!-- Logo Section -->
        <div class="logo-section">
            <div class="logo-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <span class="logo-text">SIKAPIN</span>
        </div>

        <!-- Landscape Illustration -->
        <div class="landscape-container">
            <!-- Mountain Layers -->
            <div class="mountain-layer mountain-3"></div>
            <div class="mountain-layer mountain-2"></div>
            <div class="mountain-layer mountain-1"></div>

            <!-- Wind Turbines -->
            <div class="turbine turbine-1">
                <div class="turbine-blades"></div>
                <div class="turbine-pole"></div>
            </div>
            <div class="turbine turbine-2">
                <div class="turbine-blades"></div>
                <div class="turbine-pole"></div>
            </div>
            <div class="turbine turbine-3">
                <div class="turbine-blades"></div>
                <div class="turbine-pole"></div>
            </div>
        </div>

        <!-- Fixed Image Position -->
        <div class="image-wrapper">
            <div class="image-circle">
                <img src="{{ asset('img/loginanimasi.png') }}" alt="animasi-login" class="image-content">
            </div>
        </div>

        <div class="brand-integration">
            <i class="fas fa-users"></i>
            <span>Permudah interaksi Guru & Siswa</span>
        </div>
    </div>
    </div>

    <script>
        // Password toggle functionality
        document.getElementById('passwordToggle').addEventListener('click', function() {
            const passwordInput = document.querySelector('input[name="password"]');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const button = document.getElementById('loginBtn');
            const spinner = button.querySelector('.spinner');

            // Show loading state
            button.classList.add('loading');
            spinner.style.display = 'inline-block';
            button.innerHTML = 'LOGGING IN... <span class="spinner"></span>';

            // Simulate login process (replace with actual login logic)
            setTimeout(() => {
                // Hide loading state
                button.classList.remove('loading');
                spinner.style.display = 'none';
                button.innerHTML = 'LOGIN';

                // Show success message (or error message based on result)
                const successMessage = document.getElementById('successMessage');
                successMessage.style.display = 'flex';

                // Redirect after 2 seconds
                setTimeout(() => {
                    // window.location.href = '/dashboard';
                    console.log('Redirecting to dashboard...');
                }, 2000);
            }, 2000);
        });
    </script>
</body>

</html>
