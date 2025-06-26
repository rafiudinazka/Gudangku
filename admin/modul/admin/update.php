<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../koneksi.php';

// Fungsi untuk mengecilkan gambar
function kecilkanGambar($gambar, $lebarBaru = 300) {
    if (!file_exists($gambar)) return;

    $gambarAsli = imagecreatefromjpeg($gambar);
    if (!$gambarAsli) return;

    $lebarAsli = imagesx($gambarAsli);
    $tinggiAsli = imagesy($gambarAsli);

    $tinggiBaru = ($lebarBaru / $lebarAsli) * $tinggiAsli;

    $gambarBaru = imagecreatetruecolor($lebarBaru, $tinggiBaru);
    imagecopyresampled($gambarBaru, $gambarAsli, 0, 0, 0, 0, $lebarBaru, $tinggiBaru, $lebarAsli, $tinggiAsli);

    imagejpeg($gambarBaru, $gambar, 85);
    imagedestroy($gambarAsli);
    imagedestroy($gambarBaru);
}

// Proses input
if (isset($_POST['simpan'])) {
    $id_admin = $_POST['id_admin'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama     = $_POST['nama'];
    $telepon  = $_POST['telepon'];

    $updateFoto = isset($_POST['ubahfoto']);
    $fotoBaru   = null;

    if ($updateFoto && isset($_FILES['inpfoto']) && $_FILES['inpfoto']['error'] === 0) {
        $namaFoto = $_FILES['inpfoto']['name'];
        $tmpFoto  = $_FILES['inpfoto']['tmp_name'];
        $ext      = strtolower(pathinfo($namaFoto, PATHINFO_EXTENSION));
        $extValid = ['jpg', 'jpeg', 'png'];

        if (in_array($ext, $extValid)) {
            $fotoBaru = date('dmYHis') . '.' . $ext;
            $pathFoto = "../images/admin/" . $fotoBaru;

            if (move_uploaded_file($tmpFoto, $pathFoto)) {
                kecilkanGambar($pathFoto);

                // Hapus foto lama
                $cekFoto = mysqli_query($koneksi, "SELECT foto FROM tb_admin WHERE id_admin = '$id_admin'");
                if ($cekFoto && $row = mysqli_fetch_assoc($cekFoto)) {
                    $fotoLama = $row['foto'];
                    $pathLama = "../images/admin/" . $fotoLama;
                    if (file_exists($pathLama)) unlink($pathLama);
                }
            } else {
                echo "<script>alert('Upload foto gagal!'); window.history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('Format file tidak didukung! Hanya JPG/JPEG/PNG.'); window.history.back();</script>";
            exit;
        }
    }

    // SQL update
    $sql = "UPDATE tb_admin SET 
                username = '$username',
                password = '$password',
                nama     = '$nama',
                telepon  = '$telepon'";

    if ($fotoBaru) {
        $sql .= ", foto = '$fotoBaru'";
    }

    $sql .= " WHERE id_admin = '$id_admin'";

    $update = mysqli_query($koneksi, $sql);

    if ($update) {
        echo "<script>alert('Ubah data admin berhasil!'); window.location='index.php?m=awal';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menyimpan ke database.'); window.history.back();</script>";
    }
}
?>
