<?php
ob_start();
require_once '../inc/function.php';

$ID = htmlspecialchars($_POST["kode"]);
$TINGKAT = htmlspecialchars($_POST["tingkat"]);
$TAHUN = htmlspecialchars($_POST["tahun"]);
$JURUSAN = htmlspecialchars($_POST["jurusan"]);

// $GAMBAR = $_FILES['Photo']['tmp_name']; //tangkap data file


$used = false;
$kelas = tampil("SELECT * FROM `tbl_kelas` WHERE id_tahun_ajaran = '$TAHUN' AND tingkat = '$TINGKAT' AND jurusan = '$JURUSAN'");
if (isset($kelas[0]['id_kelas']) == $ID) {
    $used = false;
    $same = 1;
} elseif (!empty($kelas)) {
    $used = true;
}
// var_dump($_POST);
// var_dump($_FILES);


// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2;

if (empty($TINGKAT) || empty($TAHUN)  || empty($JURUSAN)) {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Pastikan Semua Data Terisi!!!
    </div>
<?php
} elseif ($used) {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Data Kelas Sudah Ada!!!
    </div>
    <?php
} else {
    if (edit_kelas($_POST) > 0 || $same) {
    ?>
        <div class="alert alert-success  text-bg-success border-0 fade show" role="alert">
            Data Berhasil Diubah
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=kelas">
    <?php

    } else {
    ?>
        <div class="alert alert-danger  text-bg-danger border-0 fade show" role="alert">
            <strong>Error - </strong> Data Gagal Diubah!!!
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=kelas">
<?php
    }
    echo '<meta http-equiv="refresh" content="1; url=index.php?inc=kelas">';
}

?>