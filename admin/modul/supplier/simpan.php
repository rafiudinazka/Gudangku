<?php
include "sesi_admin.php";

if (isset($_POST['simpan'])) {
    include "../koneksi.php";

    $nama_sup     = trim($_POST['nama_sup']);
    $kontak_sup   = trim($_POST['kontak_sup']);
    $alamat_sup   = trim($_POST['alamat_sup']);
    $telepon_sup  = trim($_POST['telepon_sup']);

    // 1. Cek apakah supplier dengan nama dan telepon yang sama sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM tb_sup WHERE nama_sup='$nama_sup' AND telepon_sup='$telepon_sup'");
    
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Supplier dengan nama dan nomor telepon ini sudah ada!'); window.history.back();</script>";
        exit;
    }

    // 2. Simpan ke database
    $sql = "INSERT INTO tb_sup (nama_sup, kontak_sup, alamat_sup, telepon_sup) 
            VALUES ('$nama_sup', '$kontak_sup', '$alamat_sup', '$telepon_sup')";

    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        echo "<script>alert('Data supplier berhasil disimpan!'); window.location='index.php?m=supplier';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data supplier.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Permintaan tidak valid.'); window.history.back();</script>";
}
?>
