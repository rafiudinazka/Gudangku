<?php
session_start();
include 'sesi_admin.php'; // Sesuaikan dengan sistem Anda
include '../koneksi.php';

$action = $_GET['action'] ?? '';
$no_ajuan = $_GET['no_ajuan'] ?? '';
$admin_name = $_SESSION['namainv']; // Sesuaikan dengan nama session

if ($action == 'approve' && $no_ajuan) {
    
    // Get ajuan data
    $query = mysqli_query($koneksi, "SELECT * FROM tb_ajuan WHERE no_ajuan = '$no_ajuan'");
    $ajuan = mysqli_fetch_assoc($query);
    
    if ($ajuan) {
        mysqli_begin_transaction($koneksi);
        
        try {
            // 1. Update ajuan status
            mysqli_query($koneksi, "UPDATE tb_ajuan SET 
                status = 'approved',
                val = 1,
                approved_by = '$admin_name',
                approved_date = NOW()
                WHERE no_ajuan = '$no_ajuan'");
            
            // 2. Kurangi stok
            mysqli_query($koneksi, "UPDATE tb_barang SET 
                stok = stok - {$ajuan['jml_ajuan']} 
                WHERE kode_brg = '{$ajuan['kode_brg']}'");
            
            // 3. Get updated stock
            $result = mysqli_query($koneksi, "SELECT stok FROM tb_barang WHERE kode_brg = '{$ajuan['kode_brg']}'");
            $stok_now = mysqli_fetch_assoc($result)['stok'];
            
            // 4. Insert to barang_out
            mysqli_query($koneksi, "INSERT INTO tb_barang_out 
                (no_ajuan, tanggal_ajuan, tanggal_out, petugas, kode_brg, 
                 nama_brg, stok, jml_ajuan, jml_keluar, admin) 
                VALUES 
                ('$no_ajuan', '{$ajuan['tanggal']}', NOW(), '{$ajuan['petugas']}',
                 '{$ajuan['kode_brg']}', '{$ajuan['nama_brg']}', '$stok_now', 
                 '{$ajuan['jml_ajuan']}', '{$ajuan['jml_ajuan']}', '$admin_name')");
            
            mysqli_commit($koneksi);
            $message = "Ajuan berhasil disetujui!";
            
        } catch (Exception $e) {
            mysqli_rollback($koneksi);
            $message = "Error: " . $e->getMessage();
        }
    }
    
} elseif ($action == 'reject' && $no_ajuan) {
    
    $reason = $_GET['reason'] ?? 'Tidak ada alasan';
    
    mysqli_query($koneksi, "UPDATE tb_ajuan SET 
        status = 'rejected',
        val = 0,
        approved_by = '$admin_name',
        approved_date = NOW(),
        reject_reason = '$reason'
        WHERE no_ajuan = '$no_ajuan'");
    
    $message = "Ajuan berhasil ditolak!";
}

// Redirect kembali - SESUAIKAN dengan routing sistem Anda
echo "<script>
alert('$message');
window.location='index.php?m=barangKeluar&s=awal&tab=pending';
</script>";
?>