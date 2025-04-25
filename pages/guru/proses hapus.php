<?php
require_once "../inc/function.php";


$target = "../assets/images/warga_sekolah/";
hapus_guru($_GET, $target);

echo "Proses Hapus Data Berhasil...."





?>
<meta http-equiv="refresh" content="1; url=index.php?inc=guru">