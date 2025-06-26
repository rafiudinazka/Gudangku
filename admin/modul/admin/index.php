<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "sesi_admin.php";

$modul = (isset($_GET['s'])) ? $_GET['s'] : "awal";
switch($modul){
    case 'awal': default: include "title.php"; break;
    case 'simpan': include "simpan.php"; break;
    case 'hapus': include "hapus.php"; break;
    case 'ubah': include "ubah.php"; break;
    case 'update': include "update.php"; break;
}
