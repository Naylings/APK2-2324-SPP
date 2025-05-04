<?php
ob_start();
require_once '../inc/function.php';

$ID = htmlspecialchars($_POST["kode"]);
$TINGKAT = htmlspecialchars($_POST["tingkat"]);
$TAHUN = htmlspecialchars($_POST["tahun"]);
$JURUSAN = htmlspecialchars($_POST["jurusan"]);

// $GAMBAR = $_FILES['Photo']['tmp_name']; //tangkap data file


$used = false;
        $same = false;
$kelas = tampil("SELECT * FROM `tbl_kelas` WHERE id_tahun_ajaran = '$TAHUN' AND tingkat = '$TINGKAT' AND jurusan = '$JURUSAN'");

if (!empty($kelas)) {
$used = true;
    if ($kelas[0]['id_kelas'] == $ID) {
        $used = false;
        $same = true;
    }
}
// var_dump($_POST);
// var_dump($_FILES);

$sudah = tampil("SELECT * FROM tbl_wali_kelas WHERE id_kelas = '$ID'");
$sudah1 = tampil("SELECT * FROM tbl_siswa WHERE id_kelas = '$ID'");

// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2;

if (empty($TINGKAT) || empty($TAHUN)  || empty($JURUSAN)) {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Pastikan Semua Data Terisi!!!
    </div>
<?php
}elseif ((!empty($sudah1) || !empty($sudah)) && !$same) {
    ?>
        <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Error - </strong> Tolong Hapus Data Kelas Yang Terhubung Ke Data Tahun Ajaran!!!
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