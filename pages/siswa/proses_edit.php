<?php
ob_start();
require_once '../inc/function.php';

$target = "../assets/images/warga_sekolah/";
$ID = htmlspecialchars($_POST["kode"]);
$NAMA = htmlspecialchars($_POST["name"]);
$TELEPON = htmlspecialchars($_POST["telepon"]);
$ALAMAT = htmlspecialchars($_POST["alamat"]);
$KELAS = htmlspecialchars($_POST["kelas"]);
$JENKEL = htmlspecialchars($_POST["jenkel"]);
$STATUS = htmlspecialchars($_POST["status"]);
$PHOTO_LAMA = htmlspecialchars($_POST["photo_db"]);

// $GAMBAR = $_FILES['Photo']['tmp_name']; //tangkap data file


// var_dump($_POST);
// var_dump($_FILES);


// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2;

if (empty($NAMA) || empty($ID) || empty($TELEPON)   || empty($STATUS)  || empty($JENKEL) || empty($ALAMAT)  ) {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Pastikan Semua Data Terisi!!!
    </div>
    <?php
} else {
    if (empty($KELAS)) {
        echo "<script>alert('Tolong Segera Cari Kelas Untuk Siswa!!!');</script>";
    }
    if (edit_siswa($_POST, $_FILES, $target) > 0) {
    ?>
        <div class="alert alert-success  text-bg-success border-0 fade show" role="alert">
            Data Berhasil Diubah
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=siswa">
    <?php

    } else {
    ?>
        <div class="alert alert-danger  text-bg-danger border-0 fade show" role="alert">
            <strong>Error - </strong> Data Gagal Diubah!!!
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=siswa">
<?php
    }
    echo '<meta http-equiv="refresh" content="1; url=index.php?inc=siswa">';
}

?>