<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $no_ajuan = mysqli_real_escape_string($koneksi, $_POST['no_ajuan']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $kode_brg = mysqli_real_escape_string($koneksi, $_POST['kode_brg']);
    $nama_brg = mysqli_real_escape_string($koneksi, $_POST['nama_brg']);
    $stok = intval($_POST['stok']);
    $jml_ajuan = intval($_POST['jml_ajuan']);
    $petugas = mysqli_real_escape_string($koneksi, $_POST['petugas']);
    
    // Validasi jumlah ajuan tidak melebihi stok
    if ($jml_ajuan > $stok) {
        echo "<script>
            alert('Jumlah ajuan melebihi stok tersedia!');
            window.location.href='index.php?m=ajuan&s=awal';
        </script>";
        exit;
    }
    
    // Validasi jumlah ajuan minimal 1
    if ($jml_ajuan < 1) {
        echo "<script>
            alert('Jumlah ajuan minimal 1!');
            window.location.href='index.php?m=ajuan&s=awal';
        </script>";
        exit;
    }
    
    // Cek apakah nomor ajuan sudah ada
    $cek_no = mysqli_query($koneksi, "SELECT * FROM tb_ajuan WHERE no_ajuan = '$no_ajuan'");
    if (mysqli_num_rows($cek_no) > 0) {
        echo "<script>
            alert('Nomor ajuan sudah ada! Gunakan nomor lain.');
            window.location.href='index.php?m=ajuan&s=awal';
        </script>";
        exit;
    }
    
    // Insert data ajuan dengan status 'pending' dan val = 0
    $query = "INSERT INTO tb_ajuan (no_ajuan, tanggal, kode_brg, nama_brg, stok, jml_ajuan, petugas, val, status) 
              VALUES ('$no_ajuan', '$tanggal', '$kode_brg', '$nama_brg', $stok, $jml_ajuan, '$petugas', 0, 'pending')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
            alert('Ajuan berhasil dibuat! Menunggu persetujuan admin.');
            window.location.href='index.php?m=ajuan&s=awal';
        </script>";
    } else {
        echo "<script>
            alert('Gagal membuat ajuan: " . mysqli_error($koneksi) . "');
            window.location.href='index.php?m=ajuan&s=awal';
        </script>";
    }
} else {
    // Jika tidak ada POST data, redirect
    header("Location: index.php?m=ajuan&s=awal");
}
?>