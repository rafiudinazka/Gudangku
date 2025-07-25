<?php 
date_default_timezone_set("Asia/Jakarta");
$tanggalSekarang = date("Y-m-d");
$jamSekarang = date("h:i a");

$id = $_SESSION['idinv2'];
include '../koneksi.php';
$sql = "SELECT * FROM tb_petugas WHERE id_petugas = '$id'";
$query = mysqli_query($koneksi, $sql);
$r = mysqli_fetch_array($query);

// Get filter status
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Gudang">
    <meta name="author" content="">
    <title><?php echo $judul; ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
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
            position: relative;
        }

        .nav-link .badge {
            position: absolute;
            right: 1.5rem;
            background: rgba(255,255,255,0.2);
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
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

        /* Top Navigation - Connected */
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

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 2.5rem;
            min-height: calc(100vh - var(--header-height));
        }

        .page-title {
            margin-bottom: 0;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 1.875rem;
            line-height: 1.2;
        }

        /* Filter Buttons - Minimized */
        .filter-buttons {
            margin-bottom: 1.5rem;
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .filter-buttons .btn {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-buttons .btn-outline-primary {
            color: var(--primary-color);
            border: 1px solid rgba(255, 155, 90, 0.3);
            background: transparent;
        }

        .filter-buttons .btn-outline-primary:hover {
            background: rgba(255, 155, 90, 0.1);
            border-color: var(--primary-color);
        }

        .filter-buttons .btn-outline-warning {
            color: var(--warning-color);
            border: 1px solid rgba(251, 191, 36, 0.3);
            background: transparent;
        }

        .filter-buttons .btn-outline-warning:hover {
            background: rgba(251, 191, 36, 0.1);
            border-color: var(--warning-color);
        }

        .filter-buttons .btn-outline-success {
            color: var(--success-color);
            border: 1px solid rgba(74, 222, 128, 0.3);
            background: transparent;
        }

        .filter-buttons .btn-outline-success:hover {
            background: rgba(74, 222, 128, 0.1);
            border-color: var(--success-color);
        }

        .filter-buttons .btn-outline-danger {
            color: var(--danger-color);
            border: 1px solid rgba(255, 107, 107, 0.3);
            background: transparent;
        }

        .filter-buttons .btn-outline-danger:hover {
            background: rgba(255, 107, 107, 0.1);
            border-color: var(--danger-color);
        }

        .filter-buttons .badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 10px;
        }

        /* Info Alert - Minimized */
        .info-alert {
            background: rgba(96, 165, 250, 0.08);
            border-left: 3px solid var(--info-color);
            padding: 1rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .info-alert h6 {
            font-size: 0.9375rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .info-alert ul {
            margin-bottom: 0;
            color: var(--text-muted);
        }

        /* Table Styles - Minimized */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            margin-bottom: 2rem;
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: rgba(255, 155, 90, 0.08);
            color: var(--text-dark);
            font-weight: 600;
            border: none;
            padding: 1rem;
            text-align: center;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 0.875rem;
            vertical-align: middle;
            border-bottom: 1px solid #f8f9fa;
            text-align: center;
            font-size: 0.9375rem;
        }

        .table tbody tr:hover {
            background-color: rgba(255, 155, 90, 0.03);
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Status Badges - Minimized */
        .badge-status {
            padding: 0.375rem 0.625rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-pending {
            background: rgba(251, 191, 36, 0.15);
            color: var(--warning-color);
        }

        .badge-approved {
            background: rgba(74, 222, 128, 0.15);
            color: var(--success-color);
        }

        .badge-rejected {
            background: rgba(255, 107, 107, 0.15);
            color: var(--danger-color);
        }

        .reason-box {
            background: rgba(255, 107, 107, 0.08);
            border-left: 2px solid var(--danger-color);
            padding: 0.375rem 0.625rem;
            border-radius: 4px;
            margin-top: 0.25rem;
            font-size: 0.8125rem;
            text-align: left;
        }

        /* Button Styles - Minimized */
        .btn-primary {
            background: var(--primary-color);
            border: 1px solid var(--primary-color);
            border-radius: 8px;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            transition: all 0.2s ease;
            font-size: 0.9375rem;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #6c757d;
            border: 1px solid #6c757d;
            border-radius: 8px;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            transition: all 0.2s ease;
            font-size: 0.9375rem;
        }

        .btn-secondary:hover {
            background: #5a6268;
            border-color: #5a6268;
        }

        /* Form Styles - Simplified */
        .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 0.625rem 0.875rem;
            transition: all 0.2s ease;
            font-size: 0.9375rem;
            background-color: white;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 155, 90, 0.15);
        }

        .form-select {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 0.625rem 0.875rem;
            transition: all 0.2s ease;
            font-size: 0.9375rem;
            background-color: white;
        }

        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 155, 90, 0.15);
        }

        .form-label {
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.375rem;
            font-size: 0.9375rem;
        }

        /* Modal Styles - Minimized */
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .modal-header {
            background: rgba(255, 155, 90, 0.08);
            border-radius: 12px 12px 0 0;
            border-bottom: 1px solid rgba(255, 155, 90, 0.2);
            padding: 1.25rem 1.5rem;
        }

        .modal-title {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 1.125rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 1.5rem;
        }

        .btn-close {
            background: none;
            opacity: 0.5;
        }

        .btn-close:hover {
            opacity: 0.8;
        }

        /* Form Help Text */
        .form-text {
            color: var(--text-muted);
            font-size: 0.8125rem;
            margin-top: 0.25rem;
        }

        /* Pagination - Simplified */
        .pagination {
            margin-top: 0;
        }

        .page-link {
            color: var(--text-dark);
            border: 1px solid #e0e0e0;
            padding: 0.5rem 0.875rem;
            margin: 0 0.125rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
            font-size: 0.875rem;
        }

        .page-link:hover {
            background-color: rgba(255, 155, 90, 0.1);
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .page-item.disabled .page-link {
            color: #c0c0c0;
            border-color: #e0e0e0;
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

        /* Mobile Responsive */
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
            }
            
            .table-container {
                overflow-x: auto;
            }
            
            .table {
                min-width: 800px;
            }
            
            .filter-buttons {
                overflow-x: auto;
                flex-wrap: nowrap;
                -webkit-overflow-scrolling: touch;
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
            <a href="?m=awal.php" class="nav-link">
                <i class="fas fa-tachometer-alt"></i>
                Beranda
            </a>
            <a href="?m=barangMasuk&s=awal" class="nav-link">
                <i class="fas fa-cart-arrow-down"></i>
                Data Barang Masuk
            </a>
            <a href="?m=ajuan&s=awal" class="nav-link active">
                <i class="fas fa-gift"></i>
                Data Ajuan
                <?php
                // Hitung jumlah pending UNTUK SEMUA AJUAN (tanpa filter petugas)
                $count_pending = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_ajuan WHERE status='pending'");
                $total_pending = mysqli_fetch_assoc($count_pending)['total'];
                if ($total_pending > 0) {
                    echo '<span class="badge">' . $total_pending . '</span>';
                }
                ?>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="page-title">Data Ajuan</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                <i class="fas fa-plus me-2"></i>
                Tambah Data
            </button>
        </div>

        <!-- Filter Buttons -->
        <div class="filter-buttons">
            <a href="?m=ajuan&s=awal&status=all" 
               class="btn <?php echo $status_filter == 'all' ? 'btn-primary' : 'btn-outline-primary'; ?>">
                <i class="fas fa-list"></i> Semua
                <?php
                // MENGHITUNG SEMUA AJUAN (tanpa filter petugas)
                $count_all = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_ajuan");
                $total_all = mysqli_fetch_assoc($count_all)['total'];
                ?>
                <span class="badge bg-secondary"><?php echo $total_all; ?></span>
            </a>
            
            <a href="?m=ajuan&s=awal&status=pending" 
               class="btn <?php echo $status_filter == 'pending' ? 'btn-warning' : 'btn-outline-warning'; ?>">
                <i class="fas fa-clock"></i> Pending
                <span class="badge bg-warning"><?php echo $total_pending; ?></span>
            </a>
            
            <a href="?m=ajuan&s=awal&status=approved" 
               class="btn <?php echo $status_filter == 'approved' ? 'btn-success' : 'btn-outline-success'; ?>">
                <i class="fas fa-check"></i> Disetujui
                <?php
                $count_approved = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_ajuan WHERE status='approved'");
                $total_approved = mysqli_fetch_assoc($count_approved)['total'];
                ?>
                <span class="badge bg-success"><?php echo $total_approved; ?></span>
            </a>
            
            <a href="?m=ajuan&s=awal&status=rejected" 
               class="btn <?php echo $status_filter == 'rejected' ? 'btn-danger' : 'btn-outline-danger'; ?>">
                <i class="fas fa-times"></i> Ditolak
                <?php
                $count_rejected = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_ajuan WHERE status='rejected'");
                $total_rejected = mysqli_fetch_assoc($count_rejected)['total'];
                ?>
                <span class="badge bg-danger"><?php echo $total_rejected; ?></span>
            </a>
        </div>

        <!-- Info Alert -->
        <div class="info-alert">
            <h6><i class="fas fa-info-circle me-2"></i>Informasi Status:</h6>
            <ul class="mb-0" style="padding-left: 1.5rem;">
                <li><strong>Pending:</strong> Ajuan sedang menunggu persetujuan admin</li>
                <li><strong>Disetujui:</strong> Ajuan telah disetujui dan stok akan dikurangi</li>
                <li><strong>Ditolak:</strong> Ajuan ditolak, lihat alasan penolakan</li>
            </ul>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-gift me-2"></i>
                            Tambah Data Ajuan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="?m=ajuan&s=simpan" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor Ajuan</label>
                                    <input type="text" class="form-control" name="no_ajuan" placeholder="Masukkan Nomor Ajuan" required>
                                    <div class="form-text">Masukkan nomor ajuan yang unik</div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="text" readonly class="form-control" value="<?php echo $tanggalSekarang; ?>" name="tanggal">
                                    <div class="form-text">Tanggal otomatis terisi</div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Kode Barang</label>
                                <?php 
                                include ("../koneksi.php");
                                $supp = ("SELECT * FROM tb_barang");
                                $result = mysqli_query($koneksi, $supp);

                                $jsArray = "var prdName = new Array();";

                                echo '<select name="kode_brg" class="form-select" onchange="changeValue(this.value)" required>';
                                echo '<option value="">--- PILIH BARANG ---</option>';

                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="'. $row['kode_brg'] .'">KDB'.$row['kode_brg'].' - '.htmlspecialchars($row['nama_brg']).'</option>';
                                    $jsArray .= "prdName['". $row['kode_brg'] ."'] 
                                    = {nama_brg:'". addslashes($row['nama_brg']) ."',
                                        stok:'". addslashes($row['stok']) ."', 
                                        supplier:'". addslashes($row['supplier']) ."'
                                    };";
                                }
                                echo '</select>';
                                ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Barang</label>
                                    <input type="text" name="nama_brg" readonly class="form-control" id="prd_nmbrg" placeholder="Nama barang akan muncul otomatis">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Stok Tersedia</label>
                                    <input type="text" class="form-control" id="prd_stk" name="stok" readonly placeholder="Stok akan muncul otomatis">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jumlah Ajuan</label>
                                    <input type="number" class="form-control" name="jml_ajuan" placeholder="Masukkan Jumlah Ajuan" min="1" required>
                                    <div class="form-text">Masukkan jumlah yang diajukan</div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Petugas</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($r['nama']); ?>" readonly name="petugas">
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2"></i>Batal
                                </button>
                                <button type="submit" name="simpan" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No Ajuan</th>
                            <th>Tanggal</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Ajuan</th>
                            <th>Petugas</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // PENTING: File paging.php harus menggunakan query TANPA filter petugas
                        // untuk menampilkan SEMUA data ajuan
                        include 'paging.php'; 
                        ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center p-3">
                <nav aria-label="Pagination">
                    <ul class="pagination">
                        <li class="page-item <?php echo ($halaman <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" <?php if($halaman > 1){ echo "href='?m=ajuan&s=awal&status=$status_filter&halaman=$previous'"; } ?>>
                                <i class="fas fa-chevron-left"></i> Previous
                            </a>
                        </li>
                        <?php 
                        for($x=1; $x<=$total_halaman; $x++){
                            $active = ($x == $halaman) ? 'active' : '';
                            echo '<li class="page-item '.$active.'">
                                    <a class="page-link" href="?m=ajuan&s=awal&status='.$status_filter.'&halaman='.$x.'">'.$x.'</a>
                                  </li>';
                        }
                        ?>              
                        <li class="page-item <?php echo ($halaman >= $total_halaman) ? 'disabled' : ''; ?>">
                            <a class="page-link" <?php if($halaman < $total_halaman) { echo "href='?m=ajuan&s=awal&status=$status_filter&halaman=$next'"; } ?>>
                                Next <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        <?php echo $jsArray; ?>
        function changeValue(id){
            if(id && prdName[id]) {
                document.getElementById('prd_nmbrg').value = prdName[id].nama_brg;
                document.getElementById('prd_stk').value = prdName[id].stok;
            } else {
                document.getElementById('prd_nmbrg').value = '';
                document.getElementById('prd_stk').value = '';
            }
        }

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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>