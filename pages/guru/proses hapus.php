<?php
require_once "../inc/function.php";


$target = "../assets/images/users/";
hapus_user($_GET, $target);

echo "Proses Hapus Data Berhasil...."





?>
<meta http-equiv="refresh" content="1; url=index.php?inc=user">