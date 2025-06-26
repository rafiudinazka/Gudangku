<?php 
include '../koneksi.php';
if (!isset($_SESSION["idinv"])) {
    header("Location: login.php");
    exit();
}

// Get admin data
$id = $_SESSION['idinv'];
$sql = "SELECT * FROM tb_admin WHERE id_admin = '$id'";
$query = mysqli_query($koneksi, $sql);
$admin = mysqli_fetch_array($query);
$judul = "Beranda";

// Function to get count from database
function getCount($koneksi, $table, $column) {
    $sql = "SELECT COUNT($column) as total FROM $table";
    $query = mysqli_query($koneksi, $sql);
    $result = mysqli_fetch_assoc($query);
    return $result['total'];
}

// Get all counts
$totalAdmin = getCount($koneksi, 'tb_admin', 'id_admin');
$totalSupplier = getCount($koneksi, 'tb_sup', 'id_sup');
$totalRak = getCount($koneksi, 'tb_rak', 'id_rak');
$totalBarang = getCount($koneksi, 'tb_barang', 'kode_brg');
$totalBarangMasuk = getCount($koneksi, 'tb_barang_in', 'id_brg_in');
$totalAjuan = getCount($koneksi, 'tb_ajuan', 'no_ajuan');
$totalBarangKeluar = getCount($koneksi, 'tb_barang_out', 'no_brg_out');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Gudangku - Sistem Manajemen Gudang Modern">
    <meta name="author" content="">
    <title><?php echo isset($judul) ? $judul : 'Dashboard Gudangku'; ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome - Only Essential Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/solid.min.css" rel="stylesheet">
    <!-- Google Fonts - Keep Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1e293b;
            --secondary-color: #3b82f6;
            --accent-color: #06b6d4;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #33b5e5;
            --purple-color: #aa66cc;
            --teal-color: #00695c;
            --orange-color: #ff6900;
            --sidebar-width: 280px;
            --header-height: 70px;
            --border-radius: 8px;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.06);
            --shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            font-size: 14px;
        }

        /* Sidebar Styles - Selaras dengan halaman admin */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--primary-color);
            color: white;
            transition: transform 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
            box-shadow: var(--shadow);
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .sidebar-brand i {
            color: var(--accent-color);
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .sidebar-nav .nav-item {
            margin: 0.25rem 1rem;
        }

        .sidebar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: background-color 0.2s ease;
            text-decoration: none;
            font-weight: 500;
        }

        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .sidebar-nav .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        /* Top Navigation - Selaras dengan halaman admin */
        .top-nav {
            background: white;
            padding: 1rem 2rem;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary-color);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: var(--border-radius);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            background: #f1f5f9;
            border-radius: var(--border-radius);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        /* Content Area */
        .content-area {
            padding: 2rem;
        }

        /* Welcome Section - Simplified */
        .welcome-section {
            background: white;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
            border-left: 4px solid var(--secondary-color);
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }

        .page-subtitle {
            color: #64748b;
            margin-top: 0.5rem;
        }

        /* Dashboard Cards - Simplified */
        .dashboard-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-sm);
            transition: box-shadow 0.2s ease;
            height: 100%;
        }

        .dashboard-card:hover {
            box-shadow: var(--shadow);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .card-icon {
            width: 56px;
            height: 56px;
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .card-body {
            flex: 1;
        }

        .card-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            line-height: 1;
        }

        .card-title {
            color: #6c757d;
            font-size: 0.875rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .card-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.2s ease;
        }

        .card-link:hover {
            color: var(--secondary-color);
        }

        /* Color variants - Solid colors */
        .bg-warning-gradient { 
            background: #f59e0b; 
        }
        .text-warning-gradient { 
            color: #f59e0b;
        }

        .bg-success-gradient { 
            background: #10b981; 
        }
        .text-success-gradient { 
            color: #10b981;
        }

        .bg-danger-gradient { 
            background: #ef4444; 
        }
        .text-danger-gradient { 
            color: #ef4444;
        }

        .bg-info-gradient { 
            background: #06b6d4; 
        }
        .text-info-gradient { 
            color: #06b6d4;
        }

        .bg-purple-gradient { 
            background: #8b5cf6; 
        }
        .text-purple-gradient { 
            color: #8b5cf6;
        }

        .bg-teal-gradient { 
            background: #14b8a6; 
        }
        .text-teal-gradient { 
            color: #14b8a6;
        }

        /* Responsive Design - Selaras dengan halaman admin */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .content-area {
                padding: 1rem;
            }
            
            .welcome-section {
                padding: 1rem;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .top-nav {
                padding: 0.75rem 1rem;
            }

            .dashboard-card {
                padding: 1rem;
            }

            .card-icon {
                width: 48px;
                height: 48px;
                font-size: 1.25rem;
            }

            .card-number {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">
                <i class="fas fa-warehouse"></i>
                Gudangku
            </a>
        </div>
        
        <div class="sidebar-nav">
            <div class="nav-item">
                <a href="?m=awal.php" class="nav-link active">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="?m=admin&s=awal" class="nav-link">
                    <i class="fas fa-user-shield"></i>
                    <span>Data Admin</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="?m=petugas&s=awal" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Data Petugas</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="?m=supplier&s=awal" class="nav-link">
                    <i class="fas fa-truck"></i>
                    <span>Data Supplier</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="?m=rak&s=awal" class="nav-link">
                    <i class="fas fa-layer-group"></i>
                    <span>Data Rak</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="?m=barang&s=awal" class="nav-link">
                    <i class="fas fa-boxes"></i>
                    <span>Data Barang</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="?m=barangKeluar&s=awal" class="nav-link">
                    <i class="fas fa-shipping-fast"></i>
                    <span>Barang Keluar</span>
                </a>
            </div>
            <div class="nav-item mt-3">
                <a href="logout.php" class="nav-link" onclick="return confirm('Yakin ingin logout?')">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        <div class="top-nav">
            <button class="mobile-menu-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="user-info">
                <div class="user-avatar">
                    <?php echo isset($admin['nama']) ? strtoupper(substr($admin['nama'], 0, 1)) : 'A'; ?>
                </div>
                <div>
                    <div style="font-weight: 600; font-size: 0.875rem;">
                        <?php echo isset($admin['nama']) ? $admin['nama'] : 'Administrator'; ?>
                    </div>
                    <div style="font-size: 0.75rem; color: #64748b;">Administrator</div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <h1 class="page-title">
                    <i class="fas fa-home me-2"></i>
                    Selamat Datang, <?php echo $admin['nama']; ?>
                </h1>
                <p class="page-subtitle mb-0">Dashboard Manajemen Gudang - Kelola inventori dengan mudah</p>
            </div>
            
            <div class="row g-3">
                <!-- Supplier Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-icon bg-warning-gradient">
                                <i class="fas fa-building"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-number text-warning-gradient"><?php echo $totalSupplier; ?></div>
                            <div class="card-title">Total Supplier</div>
                            <a href="?m=supplier&s=awal" class="card-link">
                                Lihat Detail <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Rak Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-icon bg-success-gradient">
                                <i class="fas fa-cubes"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-number text-success-gradient"><?php echo $totalRak; ?></div>
                            <div class="card-title">Total Rak</div>
                            <a href="?m=rak&s=awal" class="card-link">
                                Lihat Detail <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Barang Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-icon bg-danger-gradient">
                                <i class="fas fa-archive"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-number text-danger-gradient"><?php echo $totalBarang; ?></div>
                            <div class="card-title">Total Barang</div>
                            <a href="?m=barang&s=awal" class="card-link">
                                Lihat Detail <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Barang Masuk Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-icon bg-info-gradient">
                                <i class="fas fa-cart-plus"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-number text-info-gradient"><?php echo $totalBarangMasuk; ?></div>
                            <div class="card-title">Barang Masuk</div>
                            <a href="#" class="card-link">
                                Lihat Detail <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Ajuan Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-icon bg-purple-gradient">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-number text-purple-gradient"><?php echo $totalAjuan; ?></div>
                            <div class="card-title">Total Ajuan</div>
                            <a href="#" class="card-link">
                                Lihat Detail <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Barang Keluar Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-icon bg-teal-gradient">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-number text-teal-gradient"><?php echo $totalBarangKeluar; ?></div>
                            <div class="card-title">Barang Keluar</div>
                            <a href="?m=barangKeluar&s=awal" class="card-link">
                                Lihat Detail <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle Sidebar for Mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const mobileBtn = document.querySelector('.mobile-menu-btn');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !mobileBtn.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
    </script>
</body>
</html>     