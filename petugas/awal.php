<?php 
include '../koneksi.php';

if (!isset($_SESSION["idinv2"])) {
    header("Location: login_petugas.php");
    exit();
}

$id = $_SESSION['idinv2'];
$sql = "SELECT * FROM tb_petugas WHERE id_petugas = '$id'";
$query = mysqli_query($koneksi, $sql);
$r = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dashboard Gudang">
    <meta name="author" content="">
    <title><?php echo $judul; ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #ff9b5a;
            --secondary-color: #ff7b3a;
            --success-color: #4ade80;
            --danger-color: #ff6b6b;
            --warning-color: #fbbf24;
            --info-color: #60a5fa;
            --sidebar-width: 280px;
            --bg-cream: #f5f0e8;
            --bg-light: #faf7f2;
            --text-dark: #4a4a4a;
            --text-muted: #8b8b8b;
            --header-height: 70px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, var(--bg-cream) 0%, var(--bg-light) 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: var(--text-dark);
            font-size: 16px;
            line-height: 1.6;
        }

        /* Sidebar Styles - Improved */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            transition: transform 0.3s ease;
            z-index: 999;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-header {
            height: var(--header-height);
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand {
            font-size: 1.75rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .sidebar-nav {
            padding: 1rem 0 1.5rem 0;
        }

        .nav-link {
            color: rgba(255,255,255,0.85);
            padding: 0.875rem 1.5rem;
            margin: 0.125rem 0.75rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 0.9375rem;
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
            padding-left: 1.75rem;
        }

        .nav-link.active {
            background-color: rgba(255,255,255,0.15);
            color: white;
            font-weight: 600;
        }

        .nav-link i {
            width: 20px;
            margin-right: 12px;
            font-size: 1.125rem;
            text-align: center;
        }

        /* Top Navigation - Improved */
        .top-nav {
            background: white;
            height: var(--header-height);
            padding: 0 2rem;
            margin-left: 0;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 998;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .top-nav::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            z-index: -1;
        }

        .dropdown-toggle {
            background: rgba(255, 155, 90, 0.08);
            border: 1px solid rgba(255, 155, 90, 0.2);
            color: var(--text-dark);
            font-weight: 500;
            padding: 0.625rem 1.25rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-size: 0.9375rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .dropdown-toggle:hover,
        .dropdown-toggle:focus {
            background-color: rgba(255, 155, 90, 0.15);
            border-color: var(--primary-color);
            box-shadow: none;
            color: var(--text-dark);
        }

        .dropdown-toggle::after {
            margin-left: 0.5rem;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 0.5rem;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            border-radius: 6px;
            padding: 0.625rem 1rem;
            font-size: 0.9375rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 155, 90, 0.1);
        }

        /* Main Content - Improved */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 2.5rem;
            min-height: calc(100vh - var(--header-height));
        }

        .page-title {
            margin-bottom: 2.5rem;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 1.875rem;
            line-height: 1.2;
        }

        /* Dashboard Cards - Improved */
        .dashboard-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid rgba(0, 0, 0, 0.04);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, transparent, rgba(255, 155, 90, 0.3), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .dashboard-card:hover::before {
            opacity: 1;
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1.25rem;
        }

        .card-number {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: var(--text-dark);
            line-height: 1.2;
        }

        .card-title {
            color: var(--text-muted);
            font-size: 0.9375rem;
            margin-bottom: 1.5rem;
            font-weight: 400;
        }

        .card-footer {
            padding-top: 1.25rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            margin-top: auto;
        }

        .card-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9375rem;
            transition: color 0.2s ease;
            display: inline-flex;
            align-items: center;
        }

        .card-link:hover {
            color: var(--secondary-color);
        }

        .card-link i {
            margin-left: 0.5rem;
            font-size: 0.875rem;
            transition: transform 0.2s ease;
        }

        .card-link:hover i {
            transform: translateX(3px);
        }

        /* Color variants - Simplified */
        .bg-primary-gradient { 
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
        }
        .bg-warning-gradient { 
            background: linear-gradient(135deg, var(--warning-color), #f59e0b); 
        }
        .bg-success-gradient { 
            background: linear-gradient(135deg, var(--success-color), #22c55e); 
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            background: transparent;
            border: 1px solid rgba(255, 155, 90, 0.2);
            font-size: 1.25rem;
            color: var(--primary-color);
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            margin-left: var(--sidebar-width);
        }

        .mobile-menu-btn:hover {
            background-color: rgba(255, 155, 90, 0.1);
            border-color: var(--primary-color);
        }

        /* Logout button styling */
        .logout-btn {
            color: rgba(255, 255, 255, 0.85) !important;
            margin-top: 1rem;
        }

        .logout-btn:hover {
            background-color: rgba(255, 107, 107, 0.2) !important;
            color: white !important;
        }

        .logout-btn i {
            color: #ff6b6b;
        }

        /* Mobile Responsive - Improved */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .top-nav {
                padding: 0 1rem;
            }
            
            .top-nav::before {
                display: none;
            }
            
            .main-content {
                margin-left: 0;
                padding: 1.5rem;
            }
            
            .mobile-menu-btn {
                display: block;
                margin-left: 0;
            }
            
            .page-title {
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .dashboard-card {
                padding: 1.5rem;
            }
            
            .card-number {
                font-size: 1.875rem;
            }
            
            .card-icon {
                width: 50px;
                height: 50px;
                font-size: 1.25rem;
            }
        }

        /* Scrollbar styling */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 2px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.5);
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3 class="sidebar-brand">Gudangku</h3>
        </div>
        
        <div class="sidebar-nav">
            <a href="?m=awal.php" class="nav-link active">
                <i class="fas fa-tachometer-alt"></i>
                Beranda
            </a>
            <a href="?m=barangMasuk&s=awal" class="nav-link">
                <i class="fas fa-cart-arrow-down"></i>
                Data Barang Masuk
            </a>
            <a href="?m=ajuan&s=awal" class="nav-link">
                <i class="fas fa-gift"></i>
                Data Ajuan
            </a>
            <a href="logout.php" class="nav-link logout-btn" onclick="return confirm('Yakin ingin logout?');">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </div>
    </div>

    <!-- Top Navigation -->
    <div class="top-nav">
        <button class="mobile-menu-btn" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="dropdown" style="margin-left: auto; margin-right: 0;">
            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle"></i>
                <?php echo htmlspecialchars($r['nama']); ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <form action="logout_petugas.php" method="post" class="m-0">
                        <button class="dropdown-item text-danger" type="submit" name="keluar" 
                                onclick="return confirm('Yakin ingin logout?');">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="page-title">
            Selamat Datang, <?php echo htmlspecialchars($r['nama']); ?>! 👋
        </h1>

        <div class="row g-4">
            <!-- Card Barang Masuk -->
            <div class="col-lg-4 col-md-6">
                <div class="dashboard-card d-flex flex-column">
                    <div class="card-icon bg-primary-gradient">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <div class="card-number">
                        <?php
                        include_once "../koneksi.php";
                        $sql = "SELECT count(id_brg_in) as jbrg_in FROM tb_barang_in";
                        $query = mysqli_query($koneksi, $sql);
                        $result = mysqli_fetch_assoc($query);
                        echo $result['jbrg_in'];
                        ?>
                    </div>
                    <div class="card-title">Total Barang Masuk</div>
                    <div class="card-footer mt-auto">
                        <a href="?m=barangMasuk&s=awal" class="card-link">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Total Ajuan -->
            <div class="col-lg-4 col-md-6">
                <div class="dashboard-card d-flex flex-column">
                    <div class="card-icon bg-warning-gradient">
                        <i class="fas fa-gift"></i>
                    </div>
                    <div class="card-number">
                        <?php
                        $sql = "SELECT count(no_ajuan) as jajuan FROM tb_ajuan";
                        $query = mysqli_query($koneksi, $sql);
                        $result = mysqli_fetch_assoc($query);
                        echo $result['jajuan'];
                        ?>
                    </div>
                    <div class="card-title">Total Ajuan</div>
                    <div class="card-footer mt-auto">
                        <a href="?m=ajuan&s=awal" class="card-link">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Ajuan Disetujui -->
            <div class="col-lg-4 col-md-6">
                <div class="dashboard-card d-flex flex-column">
                    <div class="card-icon bg-success-gradient">
                        <i class="fas fa-check-square"></i>
                    </div>
                    <div class="card-number">
                        <?php
                        $sql = "SELECT count(val) as jval FROM tb_ajuan WHERE val='0'";
                        $query = mysqli_query($koneksi, $sql);
                        $result = mysqli_fetch_assoc($query);
                        echo $result['jval'];
                        ?>
                    </div>
                    <div class="card-title">Ajuan Disetujui</div>
                    <div class="card-footer mt-auto">
                        <a href="?m=ajuan&s=awal" class="card-link">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const menuBtn = document.querySelector('.mobile-menu-btn');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !menuBtn.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
            }
        });
    </script>
</body>
</html>