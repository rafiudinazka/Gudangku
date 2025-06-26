<?php
// Get status filter
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';

// Base query - TANPA FILTER PETUGAS
$where_clause = "";

// Add status filter if not 'all'
if ($status_filter != 'all') {
    $where_clause = "WHERE status = '$status_filter'";
}

// Pagination setup
$batas = 10;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
$previous = $halaman - 1;
$next = $halaman + 1;

// Count total records
$query_total = "SELECT COUNT(*) as total FROM tb_ajuan $where_clause";
$result_total = mysqli_query($koneksi, $query_total);
$total_data = mysqli_fetch_assoc($result_total)['total'];
$total_halaman = ceil($total_data / $batas);

// Get data with pagination
$query = "SELECT * FROM tb_ajuan $where_clause ORDER BY 
          CASE WHEN status = 'pending' THEN 0 ELSE 1 END,
          tanggal DESC 
          LIMIT $halaman_awal, $batas";
$result = mysqli_query($koneksi, $query);

$nomor = $halaman_awal + 1;

while ($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <td>
            <span class="badge bg-secondary">AJ<?php echo $row['no_ajuan']; ?></span>
        </td>
        <td><?php echo date('d/m/Y', strtotime($row['tanggal'])); ?></td>
        <td>KDB<?php echo $row['kode_brg']; ?></td>
        <td><?php echo $row['nama_brg']; ?></td>
        <td><?php echo $row['jml_ajuan']; ?></td>
        <td><?php echo $row['petugas']; ?></td>
        <td>
            <?php if ($row['status'] == 'pending') { ?>
                <span class="badge-status badge-pending">
                    <i class="fas fa-clock me-1"></i>Pending
                </span>
            <?php } elseif ($row['status'] == 'approved') { ?>
                <span class="badge-status badge-approved">
                    <i class="fas fa-check me-1"></i>Disetujui
                </span>
            <?php } elseif ($row['status'] == 'rejected') { ?>
                <span class="badge-status badge-rejected">
                    <i class="fas fa-times me-1"></i>Ditolak
                </span>
            <?php } else { ?>
                <?php if ($row['val'] == 1) { ?>
                    <span class="badge bg-success">
                        <i class="fas fa-check-circle me-1"></i>Valid
                    </span>
                <?php } else { ?>
                    <span class="badge bg-warning">
                        <i class="fas fa-clock me-1"></i>Pending
                    </span>
                <?php } ?>
            <?php } ?>
        </td>
        <td>
            <?php if ($row['status'] == 'rejected' && !empty($row['reject_reason'])) { ?>
                <div class="reason-box">
                    <strong>Alasan:</strong><br>
                    <?php echo htmlspecialchars($row['reject_reason']); ?>
                </div>
            <?php } elseif ($row['status'] == 'approved') { ?>
                <span class="text-success">
                    <i class="fas fa-check-circle me-1"></i>
                    Disetujui oleh: <?php echo $row['approved_by'] ?: 'Admin'; ?>
                    <?php if ($row['approved_date']) { ?>
                        <br><small><?php echo date('d/m/Y H:i', strtotime($row['approved_date'])); ?></small>
                    <?php } ?>
                </span>
            <?php } else { ?>
                <span class="text-muted">-</span>
            <?php } ?>
        </td>
        <td>
            <?php 
            // Hanya izinkan hapus jika:
            // 1. Status pending DAN dibuat oleh petugas yang login
            // 2. ATAU jika user adalah admin (bisa ditambahkan kondisi role check)
            $can_delete = false;
            
            if (($row['status'] == 'pending' || (empty($row['status']) && $row['val'] == 0))) {
                // Cek apakah ajuan dibuat oleh petugas yang login
                if ($row['petugas'] == $r['nama']) {
                    $can_delete = true;
                }
                // OPTIONAL: Tambahkan kondisi jika user adalah admin
                // if ($r['role'] == 'admin') {
                //     $can_delete = true;
                // }
            }
            
            if ($can_delete) { ?>
                <a href="index.php?m=ajuan&s=hapus&no_ajuan=<?php echo $row['no_ajuan']; ?>" 
                   class="btn btn-danger btn-sm" 
                   onclick="return confirm('Yakin Akan dihapus?')">
                    <i class="fas fa-trash"></i> Hapus
                </a>
            <?php } else { ?>
                <button class="btn btn-secondary btn-sm" disabled>
                    <i class="fas fa-lock"></i> Terkunci
                </button>
            <?php } ?>
        </td>
    </tr>
    <?php
    $nomor++;
}

// Jika tidak ada data
if (mysqli_num_rows($result) == 0) {
    ?>
    <tr>
        <td colspan="9" class="text-center py-4">
            <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
            <p class="text-muted">Tidak ada data ajuan</p>
        </td>
    </tr>
    <?php
}
?>