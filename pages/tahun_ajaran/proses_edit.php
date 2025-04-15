<?php
ob_start();
require_once '../inc/function.php';

$TAHUN1 = htmlspecialchars($_POST["tahun"]);
$TAHUN2 = htmlspecialchars($_POST["tahun2"]);
$ID = htmlspecialchars($_POST["id"]);

$sama = $TAHUN1 == $TAHUN2;

// $GAMBAR = $_FILES['Photo']['tmp_name']; //tangkap data file

// $tahun = tampil("SELECT * FROM `tbl_tahun` WHERE id_tahun != '$ID'");
// $used = 0;
// foreach ($tahun as $row) {
//     if (strtolower($row['tahun']) == strtolower($TAHUN)) {
//         $used = 1;
//     } elseif (strtolower($row['simbol']) == strtolower($SIMBOL)) {
//         $used = 1;
//     }
// }

$tahun2 = tampil("SELECT * FROM `tbl_tahun_ajaran` WHERE id_tahun_ajaran = '$ID'");
$same = 0;
foreach ($tahun2 as $row) {
    if (strtolower($row['semester_ganjil']) == strtolower($TAHUN1)) {
        if (strtolower($row['semester_genap']) == strtolower($TAHUN2)) {
            $same = 1;
        }
    }
}
// var_dump($_POST);
// var_dump($_FILES);


// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2;

if (empty($TAHUN1) || empty($TAHUN2)) {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Pastikan Semua Data Terisi!!!
    </div>
<?php
// } elseif ($used == 1) {
?>
    <!-- <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Data Tahun Sudah Ada!!!
    </div> -->
    <?php
}  elseif ($sama == true) {
    ?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Tahun Tidak Boleh Sama!!!
    </div> 
    <?php
} else {
    if (edit_tahun_ajaran($_POST) > 0 || $same) {
    ?>
        <div class="alert alert-success  text-bg-success border-0 fade show" role="alert">
            Data Berhasil Diubah
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=tahun_ajaran">
    <?php

    } else {
    ?>
        <div class="alert alert-danger  text-bg-danger border-0 fade show" role="alert">
            <strong>Error - </strong> Data Gagal Diubah!!!
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=tahun_ajaran">
<?php
    }
    echo '<meta http-equiv="refresh" content="1; url=index.php?inc=tahun_ajaran">';
}

?>