<?php
function UploadFoto($namafile, $folder, $ukuran) {
    $fileupload = $folder . $namafile;

    // Simpan file ukuran asli
    move_uploaded_file($_FILES['foto']['tmp_name'], $fileupload);

    // Identitas file asli
    $gbr_asli = imagecreatefromjpeg($fileupload);
    $lebar    = imagesx($gbr_asli);
    $tinggi   = imagesy($gbr_asli);

    // Hitung dimensi gambar kecil
    $thumb_lebar  = $ukuran;
    $thumb_tinggi = ($thumb_lebar / $lebar) * $tinggi;

    // Proses resize
    $gbr_thumb = imagecreatetruecolor($thumb_lebar, $thumb_tinggi);
    imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $thumb_lebar, $thumb_tinggi, $lebar, $tinggi);

    // Simpan versi thumbnail
    imagejpeg($gbr_thumb, $fileupload, 90);

    // Bersihkan dari memory
    imagedestroy($gbr_asli);
    imagedestroy($gbr_thumb);
}

function kecilkangambar($gambar, $lebar = 0, $tinggi = 0) {
    if ($lebar == 0 && $tinggi == 0) $lebar = 50;

    $im1 = imagecreatefromjpeg($gambar);
    $lebar1 = imagesx($im1);
    $tinggi1 = imagesy($im1);

    $lebar2 = $lebar1;
    $tinggi2 = $tinggi1;

    if ($lebar > 0 && $lebar1 > $lebar) {
        $lebar2 = $lebar;
        $tinggi2 = round(($lebar2 / $lebar1) * $tinggi1);
    } elseif ($tinggi > 0 && $tinggi1 > $tinggi) {
        $tinggi2 = $tinggi;
        $lebar2 = round(($tinggi2 / $tinggi1) * $lebar1);
    }

    if ($lebar2 < $lebar1 || $tinggi2 < $tinggi1) {
        $im2 = imagecreatetruecolor($lebar2, $tinggi2);
        imagecopyresized($im2, $im1, 0, 0, 0, 0, $lebar2, $tinggi2, $lebar1, $tinggi1);
        imagejpeg($im2, $gambar, 90);
        imagedestroy($im2);
    }

    imagedestroy($im1);
}
?>
