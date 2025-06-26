<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Inventory Management">
    <meta name="author" content="">
    <title><?php echo $judul; ?></title>
 
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

        .page-subtitle {
            color: #64748b;
            margin-top: 0.5rem;
        }

        /* Card Styles - Simplified */
        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            transition: box-shadow 0.2s ease;
        }

        .card:hover {
            box-shadow: var(--shadow);
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Table Styles - Selaras dengan halaman admin */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f9fafb;
            border-bottom: 2px solid #e5e7eb;
            padding: 1rem;
            font-weight: 600;
            color: var(--primary-color);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        .table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: #f9fafb;
        }

        /* Button Styles - Selaras dengan halaman admin */
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

        .btn-secondary {
            background: #e5e7eb;
            color: var(--primary-color);
        }

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-warning {
            background: var(--warning-color);
            color: white;
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
        }

        /* Modal Styles - Simplified */
        .modal-content {
            border: none;
            border-radius: var(--border-radius);
        }

        .modal-header {
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
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
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
            padding: 1rem 1.5rem;
        }

        /* Form Styles - Simplified */
        .form-label {
            font-weight: 500;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .form-control {
            padding: 0.625rem 0.875rem;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            transition: border-color 0.2s ease;
            background: white;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        /* Pagination - Selaras dengan halaman admin */
        .pagination .page-link {
            background: white;
            border: 1px solid #e5e7eb;
            color: var(--primary-color);
            padding: 0.5rem 0.75rem;
            margin: 0 0.125rem;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .pagination .page-link:hover {
            background: #f9fafb;
        }

        .pagination .page-item.active .page-link {
            background: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
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
                font-size: 0.875rem;
            }
        }

        /* Loading state */
        .btn.loading {
            opacity: 0.7;
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
                <a href="?m=petugas&s=awal" class="nav-link active">
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
                    <i class="fas fa-users"></i>
                    Data Petugas
                </h1>
                <p class="page-subtitle mb-0">Kelola data petugas sistem inventory dengan mudah</p>
            </div>

            <!-- Action Button -->
            <div class="mb-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPetugasModal">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Petugas
                </button>
            </div>

            <!-- Data Table Card -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-hashtag me-2"></i>ID Petugas</th>
                                    <th><i class="fas fa-user me-2"></i>Nama Petugas</th>
                                    <th><i class="fas fa-phone me-2"></i>Telepon</th>
                                    <th><i class="fas fa-cogs me-2"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include 'paging.php'; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php echo ($halaman <= 1) ? 'disabled' : ''; ?>">
                                <a class="page-link" <?php if($halaman > 1){ echo "href='?m=petugas&s=awal&halaman=$previous'"; } ?>>
                                    <i class="fas fa-chevron-left me-1"></i>Previous
                                </a>
                            </li>
                            <?php 
                            for($x=1; $x<=$total_halaman; $x++){
                                $active = ($x == $halaman) ? 'active' : '';
                                echo "<li class='page-item $active'><a class='page-link' href='?m=petugas&s=awal&halaman=$x'>$x</a></li>";
                            }
                            ?>              
                            <li class="page-item <?php echo ($halaman >= $total_halaman) ? 'disabled' : ''; ?>">
                                <a class="page-link" <?php if($halaman < $total_halaman) { echo "href='?m=petugas&s=awal&halaman=$next'"; } ?>>
                                    Next<i class="fas fa-chevron-right ms-1"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Add Petugas Modal -->
            <div class="modal fade" id="tambahPetugasModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-user-plus me-2"></i>
                                Tambah Data Petugas
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <form action="?m=petugas&s=simpan" method="POST" enctype="multipart/form-data" id="formTambah">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-user me-1"></i>Username
                                    </label>
                                    <input type="text" class="form-control" name="username" required 
                                           placeholder="Masukkan username">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-lock me-1"></i>Password
                                    </label>
                                    <input type="password" class="form-control" name="password" required 
                                           placeholder="Masukkan password">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-id-card me-1"></i>Nama Petugas
                                    </label>
                                    <input type="text" class="form-control" name="nama" required 
                                           placeholder="Masukkan nama petugas">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-phone me-1"></i>Nomor Telepon
                                    </label>
                                    <input type="tel" class="form-control" name="telepon" required 
                                           placeholder="Masukkan nomor telepon">
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-1"></i>Batal
                                </button>
                                <button type="submit" name="simpan" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Simpan Data
                                </button>
                            </div>
                        </form>
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

        // Form submission loading state
        document.getElementById('formTambah').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
            
            // Re-enable button after a delay (in case of validation errors)
            setTimeout(() => {
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
            }, 3000);
        });
    </script>
</body>
</html>