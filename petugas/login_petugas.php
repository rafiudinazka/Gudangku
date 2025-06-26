<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Login Petugas Gudangku - Sistem Manajemen Inventory">
    <meta name="author" content="Gudangku Team">
    <title>Login Petugas - Gudangku</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --accent-color: #f093fb;
            --dark-color: #2d3748;
            --light-color: #f7fafc;
            --success-color: #48bb78;
            --danger-color: #f56565;
            --warning-color: #ed8936;
            --gradient-bg: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            --glass-bg: rgba(255, 255, 255, 0.15);
            --glass-border: rgba(255, 255, 255, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gradient-bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="white" stop-opacity="0.15"/><stop offset="100%" stop-color="white" stop-opacity="0"/></radialGradient></defs><circle cx="150" cy="150" r="80" fill="url(%23a)" class="floating-1"/><circle cx="850" cy="250" r="120" fill="url(%23a)" class="floating-2"/><circle cx="300" cy="800" r="100" fill="url(%23a)" class="floating-3"/><circle cx="750" cy="750" r="90" fill="url(%23a)" class="floating-4"/><circle cx="500" cy="100" r="60" fill="url(%23a)" class="floating-5"/></svg>');
            opacity: 0.4;
            animation: backgroundFloat 25s ease-in-out infinite;
        }

        /* Navbar */
        .navbar-custom {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
            z-index: 1000;
            padding: 1rem 0;
        }

        .navbar-brand {
            color: var(--dark-color) !important;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .navbar-brand i {
            margin-right: 0.5rem;
            color: var(--warning-color);
        }

        /* Login Container */
        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            padding: 2rem;
        }

        .login-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(237, 137, 54, 0.2);
            position: relative;
            overflow: hidden;
            animation: slideInUp 0.8s ease;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--warning-color), transparent);
            animation: shimmer 2s infinite;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-header h1 {
            color: var(--dark-color);
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: rgba(45, 55, 72, 0.7);
            font-size: 1rem;
        }

        .petugas-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--warning-color), #f6ad55);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 30px rgba(237, 137, 54, 0.3);
            animation: pulse 2s infinite;
        }

        .petugas-icon i {
            font-size: 2rem;
            color: white;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .input-group:focus-within {
            background: rgba(255, 255, 255, 0.25);
            border-color: var(--warning-color);
            box-shadow: 0 0 20px rgba(237, 137, 54, 0.3);
        }

        .input-group-text {
            background: none;
            border: none;
            color: rgba(45, 55, 72, 0.7);
            padding: 1rem;
            font-size: 1.1rem;
        }

        .form-control {
            background: none !important;
            border: none !important;
            color: var(--dark-color) !important;
            padding: 1rem 1rem 1rem 0;
            font-size: 1rem;
            flex: 1;
        }

        .form-control::placeholder {
            color: rgba(45, 55, 72, 0.5) !important;
        }

        .form-control:focus {
            box-shadow: none !important;
            outline: none !important;
        }

        /* Buttons */
        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-custom {
            flex: 1;
            padding: 0.875rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-custom:hover::before {
            left: 100%;
        }

        .btn-cancel {
            background: rgba(245, 101, 101, 0.2);
            color: var(--danger-color);
            border: 1px solid rgba(245, 101, 101, 0.3);
        }

        .btn-cancel:hover {
            background: rgba(245, 101, 101, 0.3);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(245, 101, 101, 0.3);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--warning-color), #f6ad55);
            color: white;
            box-shadow: 0 10px 25px rgba(237, 137, 54, 0.3);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #d69e2e, var(--warning-color));
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(237, 137, 54, 0.4);
            color: white;
        }

        /* Back to Home Link */
        .back-home {
            position: fixed;
            top: 50%;
            left: 2rem;
            transform: translateY(-50%);
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            padding: 1rem;
            color: var(--dark-color);
            text-decoration: none;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .back-home:hover {
            background: rgba(255, 255, 255, 0.3);
            color: var(--warning-color);
            transform: translateY(-50%) scale(1.1);
        }

        /* Role Badge */
        .role-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background: linear-gradient(135deg, var(--warning-color), #f6ad55);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(237, 137, 54, 0.3);
        }

        /* Loading State */
        .loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .loading i {
            animation: spin 1s linear infinite;
        }

        /* Animations */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 10px 30px rgba(237, 137, 54, 0.3);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 15px 40px rgba(237, 137, 54, 0.4);
            }
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }

        @keyframes backgroundFloat {
            0%, 100% {
                transform: rotate(0deg) scale(1);
            }
            33% {
                transform: rotate(120deg) scale(1.1);
            }
            66% {
                transform: rotate(240deg) scale(0.9);
            }
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                padding: 1rem;
            }
            
            .login-card {
                padding: 2rem;
            }
            
            .login-header h1 {
                font-size: 1.75rem;
            }
            
            .back-home {
                left: 1rem;
            }
            
            .btn-group {
                flex-direction: column;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient-bg);
            border-radius: 4px;
        }

        /* Additional Visual Elements */
        .decoration-dots {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 8px;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--warning-color);
            opacity: 0.6;
            animation: dotPulse 2s infinite;
        }

        .dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes dotPulse {
            0%, 100% {
                opacity: 0.6;
                transform: scale(1);
            }
            50% {
                opacity: 1;
                transform: scale(1.2);
            }
        }
    </style>
</head>
<body>
    <!-- Back to Home -->
    <a href="../index.php" class="back-home" title="Kembali ke Beranda">
        <i class="fas fa-arrow-left"></i>
    </a>

    <!-- Navbar -->
    <nav class="navbar navbar-custom">
        <div class="container">
            <a class="navbar-brand">
                <i class="fas fa-user-tie"></i>
                Login Petugas Gudangku
            </a>
        </div>
    </nav>

    <!-- Login Section -->
    <div class="login-container">
        <div class="login-card">
            <div class="role-badge">
                <i class="fas fa-briefcase me-1"></i>
                PETUGAS
            </div>
            
            <div class="decoration-dots">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>

            <div class="login-header">
                <div class="petugas-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h1>Selamat Datang</h1>
                <p>Masuk sebagai Petugas Gudang</p>
            </div>

            <form id="loginForm" action="pro_login_petugas.php" method="post">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                        <input 
                            type="text" 
                            class="form-control" 
                            name="user" 
                            placeholder="Username" 
                            required
                            autocomplete="username"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input 
                            type="password" 
                            class="form-control" 
                            name="pass" 
                            placeholder="Password" 
                            required
                            autocomplete="current-password"
                        >
                        <button 
                            type="button" 
                            class="input-group-text" 
                            id="togglePassword"
                            style="cursor: pointer; border-left: 1px solid rgba(255,255,255,0.3);"
                        >
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="btn-group">
                    <a href="../index.php" class="btn btn-custom btn-cancel">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" name="daftar" class="btn btn-custom btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle Password Visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.querySelector('input[name="pass"]');
            const toggleIcon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });

        // Form Submit with Loading State
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const submitIcon = submitBtn.querySelector('i');
            
            // Add loading state
            submitBtn.classList.add('loading');
            submitIcon.classList.remove('fa-sign-in-alt');
            submitIcon.classList.add('fa-spinner');
            submitBtn.disabled = true;
        });

        // Add floating animation to input focus
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.closest('.input-group').style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.closest('.input-group').style.transform = 'translateY(0)';
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // ESC to go back
            if (e.key === 'Escape') {
                window.location.href = '../index.php';
            }
            
            // Enter to submit (when focused on username)
            if (e.key === 'Enter' && e.target.name === 'user') {
                e.preventDefault();
                document.querySelector('input[name="pass"]').focus();
            }
        });

        // Auto-focus username field on page load
        window.addEventListener('load', function() {
            document.querySelector('input[name="user"]').focus();
        });

        // Add ripple effect to buttons
        document.querySelectorAll('.btn-custom').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(255, 255, 255, 0.3)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.pointerEvents = 'none';
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Role badge animation on hover
        document.querySelector('.role-badge').addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotate(5deg)';
        });

        document.querySelector('.role-badge').addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });

        // Add ripple animation style
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Interactive background on mouse move
        document.addEventListener('mousemove', function(e) {
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            document.body.style.setProperty('--mouse-x', mouseX);
            document.body.style.setProperty('--mouse-y', mouseY);
        });
    </script>
</body>
</html>