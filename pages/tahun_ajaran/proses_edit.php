<?php
ob_start();
require_once '../inc/function.php';

$TAHUN1 = htmlspecialchars($_POST["tahun"]);
$TAHUN2 = htmlspecialchars($_POST["tahun2"]);
$ID = htmlspecialchars($_POST["id"]);
$STATUS = htmlspecialchars($_POST["status"]);
$START = htmlspecialchars($_POST["start"]);
$FINISH = htmlspecialchars($_POST["finish"]);

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

$tahun = tampil("SELECT * FROM `tbl_tahun` WHERE id_tahun =  '$TAHUN1'");
foreach ($tahun as $key) {
    $TAHUN1 = $key['tahun'];
}
$tahun = tampil("SELECT * FROM `tbl_tahun` WHERE id_tahun =  '$TAHUN2'");
foreach ($tahun as $key) {
    $TAHUN2 = $key['tahun'];
}

$tahun2 = tampil("SELECT * FROM `tbl_tahun_ajaran` WHERE id_tahun_ajaran = '$ID'");
$same = 0;
foreach ($tahun2 as $row) {
    if (strtolower($row['semester_ganjil']) == strtolower($TAHUN1)) {           // tahun
        if (strtolower($row['semester_genap']) == strtolower($TAHUN2)) {
            $same = 1;
        }
    }
}
$used = 0;
$tgl = tampil("SELECT * FROM `tbl_tahun_ajaran` WHERE id_tahun_ajaran !='$ID'");// tgl
foreach ($tgl as $row) {
    if (strtolower($row['tgl_start']) == strtolower($START) || strtolower($row['tgl_finish']) == strtolower($START) || strtolower($row['tgl_start']) == strtolower($FINISH) || strtolower($row['tgl_finish']) == strtolower($FINISH)) {
        $used = 1;
    }
}
// var_dump($_POST);
// var_dump($_FILES);$tahun = $_POST['id'];
$tahun_ajar = tampil("SELECT * FROM tbl_tahun_ajaran WHERE id_tahun_ajaran = '$ID'");
$tahun_ajar = $tahun_ajar[0]['simbol_tahun_ajaran'];

$kelas = tampil("SELECT * FROM tbl_kelas WHERE id_tahun_ajaran = '$ID'");
$wakel = tampil("SELECT * FROM tbl_wali_kelas WHERE id_tahun_ajaran = '$ID'");
$jenis = tampil("SELECT * FROM tbl_jenis_pembayaran WHERE id_tahun_ajaran = '$ID'");
$siswa = tampil("SELECT * FROM tbl_siswa WHERE LEFT(nis, 4) = '$tahun_ajar'");

$sudah = empty($kelas) || empty($wakel) || empty($jenis) || empty($siswa);
if ($TAHUN1 == $tahun2[0]['semester_ganjil'] && $TAHUN2 == $tahun2[0]['semester_genap'] && $START == $tahun2[0]['tgl_start'] && $FINISH== $tahun2[0]['tgl_finish'] ) {
   $sudah = "";
}

// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2;

if (empty($TAHUN1) || empty($TAHUN2) || empty($STATUS) || empty($START) || empty($FINISH)) {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Pastikan Semua Data Terisi!!!
    </div>
<?php
} elseif ($used == 1) {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Tanggal Sudah Digunakan!!!
    </div>
<?php
} elseif ($sama == true) {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Tahun Tidak Boleh Sama!!!
    </div>
<?php
} elseif ($sudah) {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Tolong Hapus Data Yang Terhubung Ke Data Tahun Ajaran!!!
    </div>
<?php
} elseif ($TAHUN1 > $TAHUN2) {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Tahun 2 Tidak Boleh Lebih Kecil Dari Tahun 1!!!
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