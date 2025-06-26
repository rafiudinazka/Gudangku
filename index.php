<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Gudangku - Aplikasi manajemen stok barang modern untuk UMKM">
    <meta name="author" content="Gudangku Team">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <title>Gudangku - Manajemen Stok Modern</title>
    
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --accent-color: #f093fb;
            --dark-color: #2d3748;
            --light-color: #f7fafc;
            --success-color: #48bb78;
            --warning-color: #ed8936;
            --gradient-bg: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--dark-color);
            overflow-x: hidden;
            background: #fafbfc;
        }

        /* Loader Animation */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .loader-content {
            text-align: center;
        }

        .loader-logo {
            font-size: 3rem;
            font-weight: 800;
            background: var(--gradient-bg);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: pulse 1.5s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }

        /* Navbar Styles */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 1.2rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .navbar-scrolled {
            padding: 0.8rem 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            background: var(--gradient-bg);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-brand i {
            font-size: 1.6rem;
            margin-right: 0.5rem;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: var(--dark-color) !important;
            margin: 0 0.8rem;
            padding: 0.5rem 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border-radius: 8px;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
            background: rgba(102, 126, 234, 0.08);
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link i {
            transition: transform 0.3s ease;
        }

        .navbar-nav .nav-link:hover i {
            transform: rotate(5deg);
        }

        /* Hero Section */
        .hero-section {
            background: var(--gradient-bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: backgroundMove 60s linear infinite;
            opacity: 0.3;
        }

        @keyframes backgroundMove {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 150px;
            background: linear-gradient(to top, rgba(247, 250, 252, 1), transparent);
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: float 20s ease-in-out infinite;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            top: 10%;
            left: -150px;
            animation-duration: 25s;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%;
            top: 50%;
            right: -100px;
            animation-duration: 30s;
            animation-delay: -5s;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            border-radius: 40% 60% 60% 40% / 60% 30% 70% 40%;
            bottom: 10%;
            left: 10%;
            animation-duration: 35s;
            animation-delay: -10s;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            margin-bottom: 1.5rem;
            animation: fadeInUp 1s cubic-bezier(0.4, 0, 0.2, 1);
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            letter-spacing: -0.02em;
        }

        .hero-subtitle {
            font-size: clamp(1.1rem, 2vw, 1.4rem);
            margin-bottom: 2.5rem;
            opacity: 0.95;
            animation: fadeInUp 1s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.7;
        }

        .hero-buttons {
            animation: fadeInUp 1s cubic-bezier(0.4, 0, 0.2, 1) 0.4s both;
        }

        .hero-buttons .btn {
            padding: 1rem 2.5rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.9rem;
        }

        .btn-light {
            background: white;
            color: var(--primary-color);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-light:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            color: var(--secondary-color);
        }

        .btn-outline-light {
            border: 2px solid white;
            background: transparent;
        }

        .btn-outline-light:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-3px);
            border-color: white;
        }

        /* Login Section */
        .login-section {
            padding: 8rem 0;
            background: var(--light-color);
            position: relative;
        }

        .login-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(102, 126, 234, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(118, 75, 162, 0.05) 0%, transparent 50%);
        }

        .section-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            margin-bottom: 1rem;
            background: var(--gradient-bg);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            padding: 4rem 3rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: visible; /* Changed from hidden to visible */
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--gradient-bg);
            pointer-events: none; /* Ensure it doesn't block clicks */
            z-index: 2;
        }

        .login-card::after {
            content: '';
            position: absolute;
            top: -100%;
            left: -100%;
            width: 300%;
            height: 300%;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.03) 0%, transparent 70%);
            transition: all 0.6s ease;
            pointer-events: none; /* Ensure it doesn't block clicks */
            z-index: 0;
        }

        .login-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
        }

        .login-card:hover::after {
            top: -150%;
            left: -150%;
        }

        .role-buttons-container {
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 3rem;
            position: relative;
            z-index: 1;
        }

        .role-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 3rem;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            position: relative;
            overflow: hidden;
            min-width: 200px;
            text-align: center;
            z-index: 1;
        }

        .role-button i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .role-button:hover i {
            transform: translateY(-5px) scale(1.1);
        }

        .role-button span {
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            position: relative;
            z-index: 2;
        }

        .role-button small {
            margin-top: 0.5rem;
            opacity: 0.8;
            font-weight: 400;
            position: relative;
            z-index: 2;
        }

        .btn-admin {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .btn-admin:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-petugas {
            background: linear-gradient(135deg, #ffecd2, #fcb69f);
            color: var(--dark-color);
            box-shadow: 0 10px 30px rgba(252, 182, 159, 0.3);
        }

        .btn-petugas:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 40px rgba(252, 182, 159, 0.4);
            color: var(--dark-color);
        }

        /* About Section */
        .about-section {
            padding: 8rem 0;
            background: white;
            position: relative;
            overflow: hidden;
        }

        .about-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -30%;
            width: 60%;
            height: 150%;
            background: var(--gradient-bg);
            opacity: 0.03;
            border-radius: 50%;
            transform: rotate(45deg);
        }

        .about-card {
            background: var(--light-color);
            border-radius: 24px;
            padding: 4rem;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .about-text {
            font-size: 1.15rem;
            line-height: 1.9;
            color: #4a5568;
            margin-bottom: 3rem;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .feature-box {
            padding: 2rem;
            border-radius: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            height: 100%;
        }

        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .feature-box:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-box:nth-child(1) .feature-icon {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        }

        .feature-box:nth-child(2) .feature-icon {
            background: linear-gradient(135deg, rgba(72, 187, 120, 0.1), rgba(56, 178, 172, 0.1));
        }

        .feature-box:nth-child(3) .feature-icon {
            background: linear-gradient(135deg, rgba(237, 137, 54, 0.1), rgba(236, 72, 153, 0.1));
        }

        .feature-box h5 {
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .feature-box p {
            color: #718096;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            color: white;
            padding: 3rem 0;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        }

        footer p {
            margin: 0;
            opacity: 0.9;
        }

        footer .fa-heart {
            animation: heartbeat 1.5s ease-in-out infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            25% { transform: scale(1.1); }
            50% { transform: scale(1); }
            75% { transform: scale(1.1); }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            33% {
                transform: translateY(-20px) rotate(2deg);
            }
            66% {
                transform: translateY(10px) rotate(-2deg);
            }
        }

        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s ease-in-out infinite;
        }

        .scroll-indicator i {
            font-size: 2rem;
            color: white;
            opacity: 0.7;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-10px);
            }
            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .login-card {
                padding: 3rem 2rem;
            }
            
            .role-buttons-container {
                flex-direction: column;
                align-items: center;
            }
            
            .role-button {
                width: 100%;
                max-width: 300px;
            }
            
            .about-card {
                padding: 3rem 2rem;
            }
            
            .shape-1, .shape-2, .shape-3 {
                display: none;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient-bg);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-color);
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Additional hover effects */
        .hover-lift {
            transition: transform 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
        }

        /* Glow effect */
        .glow {
            transition: all 0.3s ease;
        }

        .glow:hover {
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.5);
        }
    </style>
</head>
<body>
    <!-- Loader -->
    <div class="loader" id="loader">
        <div class="loader-content">
            <div class="loader-logo">
                <i class="fas fa-warehouse me-2"></i>Gudangku
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <i class="fas fa-warehouse"></i>
                <span>Gudangku</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">
                            <i class="fas fa-home me-2"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#login">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">
                            <i class="fas fa-info-circle me-2"></i>Tentang
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero-content">
                        <h1 class="hero-title">
                            Kelola Stok Barang dengan <span class="text-warning">Mudah</span>
                        </h1>
                        <p class="hero-subtitle">
                            Solusi manajemen gudang modern untuk UMKM dan organisasi. 
                            Pantau stok, kelola barang, dan buat laporan real-time dengan antarmuka yang intuitif.
                        </p>
                        <div class="hero-buttons">
                            <a href="#login" class="btn btn-light me-3">
                                <i class="fas fa-rocket me-2"></i>Mulai Sekarang
                            </a>
                            <a href="#tentang" class="btn btn-outline-light">
                                <i class="fas fa-info-circle me-2"></i>Pelajari Lebih
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

    <!-- Login Section -->
    <section id="login" class="login-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-5">
                        <h2 class="section-title">Pilih Role Anda</h2>
                        <p class="text-muted">Masuk sesuai dengan level akses yang Anda miliki</p>
                    </div>
                    <div class="login-card">
                        <div class="role-buttons-container">
                            <a href="admin/login.php" class="role-button btn-admin" target="_blank">
                                <i class="fas fa-user-shield"></i>
                                <span>ADMIN</span>
                                <small>Kelola sistem & pengguna</small>
                            </a>
                            
                            <a href="petugas/login_petugas.php" class="role-button btn-petugas" target="_blank">
                                <i class="fas fa-user-tie"></i>
                                <span>PETUGAS</span>
                                <small>Kelola stok & transaksi</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="about-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-5">
                        <h2 class="section-title">Tentang Gudangku</h2>
                    </div>
                    <div class="about-card">
                        <p class="about-text text-center">
                            Gudangku adalah aplikasi berbasis web yang dirancang khusus untuk membantu pelaku usaha, 
                            UMKM, dan organisasi dalam mengelola stok barang dengan lebih mudah, efisien, dan terorganisir. 
                            Dengan antarmuka yang ramah pengguna dan fitur lengkap seperti pencatatan stok masuk/keluar, 
                            pelacakan barang, serta laporan real-time, Gudangku menjadi mitra terpercaya dalam menjaga 
                            ketersediaan barang dan kelancaran operasional bisnis Anda.
                        </p>
                        
                        <div class="row g-4 mt-4">
                            <div class="col-md-4">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="fas fa-boxes fa-3x" style="color: var(--primary-color);"></i>
                                    </div>
                                    <h5>Manajemen Stok</h5>
                                    <p>Kelola stok masuk dan keluar dengan mudah melalui sistem yang terintegrasi</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="fas fa-chart-line fa-3x" style="color: var(--success-color);"></i>
                                    </div>
                                    <h5>Laporan Real-time</h5>
                                    <p>Dapatkan insight bisnis dengan laporan akurat dan visualisasi data yang informatif</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="fas fa-mobile-alt fa-3x" style="color: var(--warning-color);"></i>
                                    </div>
                                    <h5>Responsif</h5>
                                    <p>Akses dari perangkat apapun, kapan saja dengan tampilan yang optimal</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2025 Gudangku. Semua hak dilindungi.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>Dibuat dengan <i class="fas fa-heart text-danger"></i> untuk UMKM Indonesia</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Hide loader when page loads
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('loader').style.opacity = '0';
                setTimeout(() => {
                    document.getElementById('loader').style.display = 'none';
                }, 500);
            }, 500);
        });

        // Navbar scroll effect
        let lastScroll = 0;
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
            
            lastScroll = currentScroll;
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 70;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements
        document.querySelectorAll('.feature-box, .login-card, .about-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            observer.observe(el);
        });

        // Add ripple effect to buttons
        document.querySelectorAll('.role-button').forEach(button => {
            button.addEventListener('click', function(e) {
                // Don't prevent default - let the link work
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.style.pointerEvents = 'none'; // Make sure ripple doesn't block clicks
                ripple.classList.add('ripple');
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Active nav link
        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('.nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= sectionTop - 100) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').slice(1) === current) {
                    link.classList.add('active');
                }
            });
        });
    </script>

    <style>
        /* Ripple effect */
        .role-button {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            transform: scale(0);
            animation: ripple-animation 0.6s ease-out;
            pointer-events: none;
            z-index: 0;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .nav-link.active {
            color: var(--primary-color) !important;
            background: rgba(102, 126, 234, 0.08);
        }
    </style>
</body>
</html>