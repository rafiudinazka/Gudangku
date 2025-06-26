<?php
include "sesi_admin.php";
if(isset($_GET['id_admin'])){
	include "../koneksi.php";
	$id=$_GET['id_admin'];
	$sql   = "SELECT * FROM tb_admin WHERE id_admin='$id'";
	$hapus = mysqli_query($koneksi,$sql);
	$r     = mysqli_fetch_array($hapus);
	
		$foto=$r['foto'];

		unlink("../images/admin/$foto");
		$sql1   = "DELETE FROM tb_admin WHERE id_admin='$id'";
	
		
	$hapus1 = mysqli_query($koneksi,$sql1);
	if($hapus1){

		header("Location: ?m=admin");
	}else{
		echo 'Data GAGAL diHapus';
		echo '<a href="index.php">Kembali</a>';
	}
}
?>
