<?php 
  
  include '../koneksi.php';

if ( !isset($_SESSION["idinv"])) {
  header("Location: login.php");
  exit();
}

?>
<?php 
          $id = $_SESSION['idinv'];
           include '../koneksi.php';
           $sql = "SELECT * FROM tb_admin WHERE id_admin = '$id'";
           $query = mysqli_query($koneksi, $sql);
            $r_session = mysqli_fetch_array($query);

           // Data untuk edit
           $id_edit = $_GET['id_admin'];
           $sql_edit = "SELECT * FROM tb_admin WHERE id_admin = '$id_edit'";
           $query_edit = mysqli_query($koneksi, $sql_edit);
           $r = mysqli_fetch_array($query_edit);
           ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Manajemen Gudang">
    <meta name="author" content="">
    <title>Edit Data Admin</title>

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
            --secondary-color: rgb(255, 255, 255);
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

        /* Sidebar Styles - Simplified */
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

        /* Top Navigation - Simplified */
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

        /* Form Styles - Simplified */
        .form-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #e5e7eb;
        }

        .form-label {
            font-weight: 500;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .form-control {
            border: 1px solid #d1d5db;
            border-radius: 4px;
            padding: 0.625rem 0.875rem;
            font-size: 0.875rem;
            transition: border-color 0.2s ease;
            background: white;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .form-text {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.25rem;
        }

        .photo-preview {
            max-width: 150px;
            height: auto;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            margin-bottom: 1rem;
            border: 2px solid #e5e7eb;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 1rem 0;
            padding: 0.75rem;
            background: #f9fafb;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 16px;
            height: 16px;
        }

        /* Button Styles - Simplified */
        .btn-group-footer {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
            margin-top: 1.5rem;
        }

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

        /* File Input Styles - Simplified */
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            background: #f9fafb;
            border: 2px dashed #d1d5db;
            border-radius: 6px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.2s ease, border-color 0.2s ease;
            display: block;
            color: #64748b;
        }

        .file-input-label:hover {
            border-color: var(--secondary-color);
            background: #f3f4f6;
        }

        .file-input-label i {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #9ca3af;
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

            .form-card {
                padding: 1rem;
            }

            .btn-group-footer {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Input Groups - Simplified */
        .input-group-custom {
            margin-bottom: 1.25rem;
        }

        .input-icon {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            z-index: 10;
            font-size: 0.875rem;
        }

        .form-control-icon {
            padding-left: 2.5rem;
        }

        .input-wrapper {
            position: relative;
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
                <a href="?m=admin&s=awal" class="nav-link active">
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
                    <?php echo isset($r_session['nama']) ? strtoupper(substr($r_session['nama'], 0, 1)) : 'A'; ?>
                </div>
                <div>
                    <div style="font-weight: 600; font-size: 0.875rem;">
                        <?php echo isset($r_session['nama']) ? $r_session['nama'] : 'Admin'; ?>
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
                    <i class="fas fa-user-edit"></i>
                    Ubah Data Admin
                </h1>
                <p class="mb-0 text-muted">Kelola dan perbarui informasi admin</p>
            </div>

            <!-- Form Card -->
            <div class="form-card">
                <form action="?m=admin&s=update" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_admin" value="<?php echo $r['id_admin'];?>" >
                    
                    <div class="input-group-custom">
                        <label class="form-label">
                            <i class="fas fa-user me-1"></i>Username
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" class="form-control form-control-icon" name="username" 
                                   value="<?php echo $r['username']; ?>" placeholder="Masukkan Username" required>
                        </div>
                        <div class="form-text">Masukkan username untuk login</div>
                    </div>

                    <div class="input-group-custom">
                        <label class="form-label">
                            <i class="fas fa-lock me-1"></i>Password
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" class="form-control form-control-icon" name="password" 
                                   placeholder="Masukkan Password Baru">
                        </div>
                        <div class="form-text">Kosongkan jika tidak ingin mengubah password</div>
                    </div>

                    <div class="input-group-custom">
                        <label class="form-label">
                            <i class="fas fa-id-card me-1"></i>Nama Lengkap
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-id-card input-icon"></i>
                            <input type="text" class="form-control form-control-icon" name="nama" 
                                   value="<?php echo $r['nama']; ?>" placeholder="Masukkan Nama Lengkap" required>
                        </div>
                        <div class="form-text">Masukkan nama lengkap admin</div>
                    </div>

                    <div class="input-group-custom">
                        <label class="form-label">
                            <i class="fas fa-phone me-1"></i>Nomor Telepon
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-phone input-icon"></i>
                            <input type="text" class="form-control form-control-icon" name="telepon" 
                                   value="<?php echo $r['telepon']; ?>" placeholder="Masukkan Nomor Telepon" required>
                        </div>
                        <div class="form-text">Masukkan nomor telepon yang aktif</div>
                    </div>

                    <div class="input-group-custom">
                        <label class="form-label">
                            <i class="fas fa-camera me-1"></i>Foto Profil
                        </label>
                        
                        <div class="mb-3">
                            <img src="../images/admin/<?php echo $r['foto'];?>" class="photo-preview" alt="Current Photo">
                        </div>
                        
                        <div class="checkbox-wrapper">
                            <input type="checkbox" name="ubahfoto" value="true" id="ubahfoto">
                            <label for="ubahfoto">Klik jika ingin mengubah foto</label>
                        </div>
                        
                        <div class="file-input-wrapper">
                            <input type="file" name="inpfoto" id="inpfoto" accept="image/*">
                            <label for="inpfoto" class="file-input-label">
                                <i class="fas fa-cloud-upload-alt d-block"></i>
                                <strong>Pilih File Foto</strong>
                                <div class="form-text">JPG, PNG, GIF (Max. 2MB)</div>
                            </label>
                        </div>
                    </div>

                    <div class="btn-group-footer">
                        <button type="button" class="btn btn-secondary" onclick="history.back()">
                            <i class="fas fa-times"></i>
                            Batal
                        </button>
                        <button type="submit" name="simpan" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        // File Input Enhancement
        const fileInput = document.getElementById('inpfoto');
        const fileLabel = document.querySelector('.file-input-label');
        
        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const fileName = e.target.files[0].name;
                const fileSize = (e.target.files[0].size / 1024 / 1024).toFixed(2);
                
                if (e.target.files[0].size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB');
                    e.target.value = '';
                    return;
                }
                
                fileLabel.innerHTML = `
                    <i class="fas fa-check-circle d-block" style="color: var(--success-color);"></i>
                    <strong>${fileName}</strong>
                    <div class="form-text">${fileSize} MB</div>
                `;
            }
        });

        // Enable file input only when checkbox is checked
        const ubahFotoCheckbox = document.getElementById('ubahfoto');
        ubahFotoCheckbox.addEventListener('change', function() {
            fileInput.disabled = !this.checked;
            fileLabel.style.opacity = this.checked ? '1' : '0.5';
            fileLabel.style.cursor = this.checked ? 'pointer' : 'not-allowed';
        });

        // Initialize file input state
        fileInput.disabled = true;
        fileLabel.style.opacity = '0.5';
        fileLabel.style.cursor = 'not-allowed';

        // Auto-hide mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const menuBtn = document.querySelector('.mobile-menu-btn');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !menuBtn.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Form submit loading state
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        });
    </script>
  </body>
</html>