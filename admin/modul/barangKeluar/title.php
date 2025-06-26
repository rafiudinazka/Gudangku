<?php 
date_default_timezone_set("Asia/Jakarta");
$tanggalSekarang = date("Y-m-d");
$jamSekarang = date("h:i a");

// Ambil tab aktif
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'keluar';
?>
<?php 
$id = $_SESSION['idinv'];
include '../koneksi.php';
$sql = "SELECT * FROM tb_admin WHERE id_admin = '$id'";
$query = mysqli_query($koneksi, $sql);
$r = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Manajemen Gudang">
    <meta name="author" content="">
    <title><?php echo isset($judul) ? $judul : 'Gudangku - Barang Keluar'; ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/solid.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1e293b;
            --secondary-color: #3b82f6;
            --accent-color: #06b6d4;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --sidebar-width: 280px;
            --border-radius: 8px;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.06);
            --shadow: 0 4px 6px rgba(0,0,0,0.1);
            --transition: all 0.2s ease;
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
            color: #334155;
        }   

        /* Sidebar Styles - Selaras dengan acuan */
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
            font-weight: 600;
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
            position: relative;
        }

        .sidebar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .sidebar-nav .nav-link.active {
            background: var(--secondary-color);
            color: white;
        }

        .sidebar-nav .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .badge-count {
            background: var(--danger-color);
            color: white;
            border-radius: 10px;
            padding: 0.125rem 0.375rem;
            font-size: 0.75rem;
            position: absolute;
            right: 1rem;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        /* Top Navigation */
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

        .page-header {
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
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .page-title i {
            color: var(--secondary-color);
        }

        /* Card Styles */
        .data-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        /* Button Styles - Selaras dengan acuan */
        .btn {
            padding: 0.625rem 1.25rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.875rem;
            transition: opacity 0.2s ease, transform 0.1s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .btn-primary {
            background: var(--secondary-color);
            color: white;
        }

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: var(--primary-color);
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.8125rem;
        }

        /* Table Styles */
        .table-container {
            background: white;
            overflow-x: auto;
            overflow-y: visible;
            border-radius: var(--border-radius);
            border: 1px solid #e2e8f0;
        }

        .table {
            margin: 0;
            border-collapse: collapse;
        }

        .table thead th {
            background: #f8fafc;
            color: var(--primary-color);
            font-weight: 600;
            border: 1px solid #e2e8f0;
            padding: 0.75rem;
            font-size: 0.875rem;
            white-space: nowrap;
        }

        .table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid #e2e8f0;
        }

        .table tbody tr:nth-child(even) {
            background: #fafbfc;
        }

        .table tbody tr:hover {
            background: #f0f4f8;
        }

        .table tbody td {
            padding: 0.75rem;
            border-left: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            vertical-align: middle;
            font-size: 0.875rem;
        }

        .table tbody td:first-child {
            border-left: 1px solid #e2e8f0;
        }

        .table tbody td:last-child {
            border-right: 1px solid #e2e8f0;
        }

        /* Table Action Buttons */
        .table td .btn + .btn {
            margin-left: 0.25rem;
        }

        .table td .text-danger {
            font-size: 0.8125rem;
            display: inline-block;
            margin-right: 0.5rem;
        }

        /* Modal Styles - Selaras dengan acuan */
        .modal-content {
            border: none;
            border-radius: var(--border-radius);
        }

        .modal-header {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.25rem 1.5rem;
        }

        .modal-title {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.125rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        /* Form Styles - Selaras dengan acuan */
        .form-control, .form-select {
            border: 1px solid #d1d5db;
            border-radius: 4px;
            padding: 0.625rem 0.875rem;
            font-size: 0.875rem;
            transition: border-color 0.2s ease;
            background: white;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .form-control[readonly] {
            background-color: #f8fafc;
            cursor: not-allowed;
        }

        .form-label {
            font-weight: 500;
            color: var(--primary-color);
            margin-bottom: 0.375rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .form-label i {
            font-size: 0.875rem;
            color: #64748b;
        }

        .form-text {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.25rem;
        }

        .form-text i {
            font-size: 0.75rem;
        }

        .input-group-custom {
            margin-bottom: 1.25rem;
        }

        /* Tab Styles */
        .nav-tabs {
            border: none;
            background: white;
            padding: 0.75rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
            display: flex;
            gap: 0.5rem;
            border: 1px solid #e5e7eb;
        }

        .nav-tabs .nav-link {
            border: none;
            background: transparent;
            color: #64748b;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: var(--transition);
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-tabs .nav-link:hover {
            background: #f1f5f9;
            color: var(--primary-color);
        }

        .nav-tabs .nav-link.active {
            background: var(--secondary-color);
            color: white;
        }

        /* Status Badges */
        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-status {
            padding: 0.25rem 0.625rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .badge-pending {
            background: #fef3c7;
            color: #d97706;
        }

        /* Pagination */
        .pagination {
            gap: 0.25rem;
        }

        .page-link {
            border: none;
            color: var(--primary-color);
            background: white;
            border-radius: var(--border-radius);
            padding: 0.5rem 0.75rem;
            margin: 0 0.125rem;
            transition: var(--transition);
            font-weight: 500;
            font-size: 0.875rem;
        }

        .page-link:hover {
            background: #f1f5f9;
            color: var(--secondary-color);
        }

        .page-item.active .page-link {
            background: var(--secondary-color);
            color: white;
        }

        .page-item.disabled .page-link {
            color: #94a3b8;
            background: #f1f5f9;
        }

        /* Responsive Design */
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
            
            .page-header {
                padding: 1rem;
            }
            
            .top-nav {
                padding: 0.75rem 1rem;
            }

            .table {
                font-size: 0.75rem;
            }

            .table thead th,
            .table tbody td {
                padding: 0.5rem;
                font-size: 0.75rem;
            }

            .table thead th {
                font-size: 0.7rem;
            }

            .modal-dialog {
                margin: 1rem;
            }
        }

        /* Utility Classes */
        .text-muted {
            color: #94a3b8 !important;
        }

        .bg-secondary {
            background-color: #64748b !important;
        }

        .bg-success {
            background-color: var(--success-color) !important;
        }

        .bg-warning {
            background-color: var(--warning-color) !important;
        }

        .text-danger {
            color: var(--danger-color) !important;
        }

        /* Loading state */
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
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
                <a href="?m=awal.php" class="nav-link">
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
                <a href="?m=barangKeluar&s=awal" class="nav-link active">
                    <i class="fas fa-shipping-fast"></i>
                    <span>Barang Keluar</span>
                    <?php
                    // Hitung jumlah ajuan pending
                    $sql_pending = "SELECT COUNT(*) as pending FROM tb_ajuan WHERE status = 'pending'";
                    $query_pending = mysqli_query($koneksi, $sql_pending);
                    $pending = mysqli_fetch_assoc($query_pending)['pending'];
                    if ($pending > 0) {
                        echo '<span class="badge-count">' . $pending . '</span>';
                    }
                    ?>
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
                    <?php echo isset($r['nama_admin']) ? strtoupper(substr($r['nama_admin'], 0, 1)) : 'A'; ?>
                </div>
                <div>
                    <div style="font-weight: 600; font-size: 0.875rem;">
                        <?php echo isset($r['nama_admin']) ? $r['nama_admin'] : 'Admin'; ?>
                    </div>
                    <div style="font-size: 0.75rem; color: #64748b;">Administrator</div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="fas fa-shipping-fast"></i>
                    Data Barang Keluar
                </h1>
                <p class="mb-0 text-muted">Kelola data barang yang keluar dari gudang</p>
            </div>

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link <?php echo $tab == 'pending' ? 'active' : ''; ?>" href="?m=barangKeluar&s=awal&tab=pending">
                        <i class="fas fa-clock"></i>
                        Ajuan Pending
                        <?php if ($pending > 0): ?>
                            <span class="badge-count"><?php echo $pending; ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $tab == 'keluar' ? 'active' : ''; ?>" href="?m=barangKeluar&s=awal&tab=keluar">
                        <i class="fas fa-check-circle"></i>
                        Data Barang Keluar
                    </a>
                </li>
            </ul>

            <!-- Tab Content -->
            <?php if ($tab == 'pending'): ?>
            <!-- Tab Ajuan Pending -->
            <div class="data-card">
                <div class="table-container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Ajuan</th>
                                <th>Tanggal</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Stok Saat Ini</th>
                                <th>Jumlah Ajuan</th>
                                <th>Petugas</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT a.*, b.stok as stok_sekarang 
                                     FROM tb_ajuan a 
                                     LEFT JOIN tb_barang b ON a.kode_brg = b.kode_brg 
                                     WHERE a.status = 'pending' 
                                     ORDER BY a.tanggal DESC";
                            
                            $result = mysqli_query($koneksi, $query);
                            $no = 1;
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                $stok_cukup = $row['stok_sekarang'] >= $row['jml_ajuan'];
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>
                                        <span class="badge bg-secondary">AJ0<?php echo $row['no_ajuan']; ?></span>
                                    </td>
                                    <td><?php echo date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                                    <td><?php echo $row['kode_brg']; ?></td>
                                    <td><?php echo $row['nama_brg']; ?></td>
                                    <td>
                                        <span class="badge <?php echo $row['stok_sekarang'] > 10 ? 'bg-success' : 'bg-warning'; ?>">
                                            <?php echo $row['stok_sekarang']; ?>
                                        </span>
                                    </td>
                                    <td><?php echo $row['jml_ajuan']; ?></td>
                                    <td><?php echo $row['petugas']; ?></td>
                                    <td>
                                        <span class="badge-status badge-pending">
                                            <i class="fas fa-clock"></i>Menunggu
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($stok_cukup) { ?>
                                            <button class="btn btn-success btn-sm" 
                                                    onclick="approveAjuan(<?php echo $row['no_ajuan']; ?>)">
                                                <i class="fas fa-check"></i> Setujui
                                            </button>
                                        <?php } else { ?>
                                            <span class="text-danger">
                                                <i class="fas fa-exclamation-circle"></i> Stok tidak cukup
                                            </span>
                                        <?php } ?>
                                        <button class="btn btn-danger btn-sm" 
                                                onclick="rejectAjuan(<?php echo $row['no_ajuan']; ?>)">
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                            
                            if ($no == 1) {
                                echo '<tr><td colspan="10" class="text-center text-muted py-5" style="border: 1px solid #e2e8f0;">
                                        <i class="fas fa-inbox fa-3x mb-3 d-block" style="opacity: 0.2"></i>
                                        <span style="font-size: 1rem;">Tidak ada ajuan pending</span>
                                      </td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php else: ?>
            <!-- Tab Data Barang Keluar -->
            <!-- Action Button -->
            <div class="mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                    <i class="fas fa-plus"></i>
                    Tambah Data
                </button>
            </div>

            <!-- Data Table -->
            <div class="data-card">
                <div class="table-container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No Barang Keluar</th>               
                                <th>No Ajuan</th>
                                <th>Tanggal Ajuan</th>
                                <th>Tanggal Keluar</th>
                                <th>Petugas</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jml Ajuan</th>
                                <th>Stok</th>
                                <th>Jml Keluar</th>
                                <th>Admin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'paging.php'; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center py-3">
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            <li class="page-item <?php echo ($halaman <= 1) ? 'disabled' : ''; ?>">
                                <a class="page-link" <?php if($halaman > 1){ echo "href='?m=barangKeluar&s=awal&tab=keluar&halaman=$previous'"; } ?>>
                                    <i class="fas fa-chevron-left me-1"></i>Previous
                                </a>
                            </li>
                            
                            <?php for($x=1; $x<=$total_halaman; $x++): ?>
                                <li class="page-item <?php echo ($x == $halaman) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?m=barangKeluar&s=awal&tab=keluar&halaman=<?php echo $x; ?>">
                                        <?php echo $x; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                            
                            <li class="page-item <?php echo ($halaman >= $total_halaman) ? 'disabled' : ''; ?>">
                                <a class="page-link" <?php if($halaman < $total_halaman) { echo "href='?m=barangKeluar&s=awal&tab=keluar&halaman=$next'"; } ?>>
                                    Next<i class="fas fa-chevron-right ms-1"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Add Barang Keluar Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                        <i class="fas fa-plus-circle me-2"></i>
                        Tambah Data Barang Keluar
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="?m=barangKeluar&s=simpan" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="input-group-custom">
                                    <label for="no_brg_out" class="form-label">
                                        <i class="fas fa-hashtag"></i>No Barang Keluar
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="no_brg_out"
                                           name="no_brg_out" 
                                           placeholder="Masukkan nomor barang keluar..." 
                                           required>
                                    <div class="form-text">Nomor unik untuk transaksi barang keluar</div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="input-group-custom">
                                    <label for="no_ajuan" class="form-label">
                                        <i class="fas fa-file-alt"></i>Nomor Ajuan
                                    </label>
                                    <?php 
                                    include ("../koneksi.php");
                                    $supp = ("SELECT * FROM tb_ajuan WHERE status = 'approved' OR val = '1' ");
                                    $result = mysqli_query($koneksi, $supp);
                                    $jsArray = "var prdName = new Array();";
                                    echo '<select name="no_ajuan" id="no_ajuan" class="form-control form-select" onchange="changeValue(this.value)" required>';
                                    echo '<option value="">--- PILIH AJUAN ---</option>';
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '<option value="'. $row['no_ajuan'] .'">AJ0'.$row['no_ajuan'].'</option>';
                                        $jsArray .= "prdName['". $row['no_ajuan'] ."'] 
                                        = {tanggal_ajuan:'". addslashes($row['tanggal']) ."',
                                            petugas:'". addslashes($row['petugas']) ."',
                                            kode_brg:'". addslashes($row['kode_brg']) ."',
                                            nama_brg:'". addslashes($row['nama_brg']) ."',
                                            stok:'". addslashes($row['stok']) ."',
                                            jml_ajuan:'". addslashes($row['jml_ajuan']) ."',
                                            val:'". addslashes($row['val']) ."'
                                        };";
                                    }
                                    echo '</select>';
                                    ?>
                                    <div class="form-text">Pilih nomor ajuan yang sudah disetujui</div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="input-group-custom">
                                    <label for="prd_tanggal" class="form-label">
                                        <i class="fas fa-calendar-check"></i>Tanggal Ajuan
                                    </label>
                                    <input type="text" 
                                           readonly 
                                           class="form-control" 
                                           id="prd_tanggal" 
                                           name="tanggal_ajuan" 
                                           placeholder="Tanggal ajuan akan terisi otomatis">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="input-group-custom">
                                    <label for="tanggal_out" class="form-label">
                                        <i class="fas fa-calendar-minus"></i>Tanggal Keluar
                                    </label>
                                    <input type="date" 
                                           class="form-control" 
                                           id="tanggal_out"
                                           name="tanggal_out" 
                                           value="<?php echo $tanggalSekarang; ?>" 
                                           required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="input-group-custom">
                                    <label for="prd_petugas" class="form-label">
                                        <i class="fas fa-user"></i>Petugas
                                    </label>
                                    <input type="text" 
                                           readonly 
                                           class="form-control" 
                                           id="prd_petugas" 
                                           name="petugas" 
                                           placeholder="Nama petugas akan terisi otomatis">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="input-group-custom">
                                    <label for="prd_kodebrng" class="form-label">
                                        <i class="fas fa-barcode"></i>Kode Barang
                                    </label>
                                    <input type="text" 
                                           readonly 
                                           class="form-control" 
                                           id="prd_kodebrng" 
                                           name="kode_brg" 
                                           placeholder="Kode barang akan terisi otomatis">
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="input-group-custom">
                                    <label for="prd_namabrg" class="form-label">
                                        <i class="fas fa-box"></i>Nama Barang
                                    </label>
                                    <input type="text" 
                                           name="nama_brg" 
                                           readonly 
                                           class="form-control" 
                                           id="prd_namabrg" 
                                           placeholder="Nama barang akan terisi otomatis">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="input-group-custom">
                                    <label for="prd_stokbrga" class="form-label">
                                        <i class="fas fa-cubes"></i>Stok Tersedia
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="prd_stokbrga" 
                                           name="stok" 
                                           readonly 
                                           placeholder="0">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="input-group-custom">
                                    <label for="prd_jmlajuan" class="form-label">
                                        <i class="fas fa-clipboard-list"></i>Jumlah Ajuan
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           readonly 
                                           id="prd_jmlajuan" 
                                           name="jml_ajuan" 
                                           placeholder="0">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="input-group-custom">
                                    <label for="jml_keluar" class="form-label">
                                        <i class="fas fa-arrow-right"></i>Jumlah Keluar
                                    </label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="jml_keluar"
                                           name="jml_keluar" 
                                           placeholder="Masukkan jumlah..." 
                                           required 
                                           min="1">
                                    <div class="form-text">Jumlah barang yang akan dikeluarkan</div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="input-group-custom">
                                    <label for="admin" class="form-label">
                                        <i class="fas fa-user-shield"></i>Admin
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="admin"
                                           value="<?php echo isset($r['nama']) ? $r['nama'] : $r['nama_admin']; ?>" 
                                           readonly 
                                           name="admin">
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" id="prd_val" name="val">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i>Batal
                        </button>
                        <button type="submit" name="simpan" class="btn btn-success">
                            <i class="fas fa-save"></i>Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (jika diperlukan) -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    
    <script type="text/javascript">
        <?php echo $jsArray; ?>
        function changeValue(id){
            if(id && prdName[id]) {
                document.getElementById('prd_tanggal').value = prdName[id].tanggal_ajuan;
                document.getElementById('prd_petugas').value = prdName[id].petugas;
                document.getElementById('prd_kodebrng').value = prdName[id].kode_brg;
                document.getElementById('prd_namabrg').value = prdName[id].nama_brg;
                document.getElementById('prd_stokbrga').value = prdName[id].stok;
                document.getElementById('prd_jmlajuan').value = prdName[id].jml_ajuan;
                document.getElementById('prd_val').value = prdName[id].val;
            } else {
                // Clear all fields if no selection
                document.getElementById('prd_tanggal').value = '';
                document.getElementById('prd_petugas').value = '';
                document.getElementById('prd_kodebrng').value = '';
                document.getElementById('prd_namabrg').value = '';
                document.getElementById('prd_stokbrga').value = '';
                document.getElementById('prd_jmlajuan').value = '';
                document.getElementById('prd_val').value = '';
            }
        }

        // Toggle sidebar for mobile
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

        // Auto-focus on modal open
        document.getElementById('exampleModalCenter').addEventListener('shown.bs.modal', function () {
            document.getElementById('no_brg_out').focus();
        });

        // Functions for Approval
        function approveAjuan(no_ajuan) {
            if (confirm('Apakah Anda yakin ingin menyetujui ajuan ini?')) {
                window.location.href = 'proses_approval.php?action=approve&no_ajuan=' + no_ajuan;
            }
        }
        
        function rejectAjuan(no_ajuan) {
            var reason = prompt('Masukkan alasan penolakan:');
            if (reason && reason.trim() !== '') {
                window.location.href = 'proses_approval.php?action=reject&no_ajuan=' + no_ajuan + '&reason=' + encodeURIComponent(reason);
            }
        }

        // Form validation feedback
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Form submit loading state
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        });
    </script>
</body>
</html>