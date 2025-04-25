<?php
ob_start();
require_once '../inc/function.php';


// $GAMBAR = $_FILES['Photo']['tmp_name']; //tangkap data file

$TAHUN1 = htmlspecialchars($_POST["tahun"]);
$TAHUN2 = htmlspecialchars($_POST["tahun2"]);
$START = htmlspecialchars($_POST["start"]);
$FINISH = htmlspecialchars($_POST["finish"]);

$tahun = tampil("SELECT * FROM `tbl_tahun` WHERE id_tahun =  '$TAHUN1'");
foreach ($tahun as $key) {
    $TAHUN1 = $key['tahun'];
}
$tahun = tampil("SELECT * FROM `tbl_tahun` WHERE id_tahun =  '$TAHUN2'");
foreach ($tahun as $key) {
    $TAHUN2 = $key['tahun'];
}
$used = 0;
$tgl = tampil("SELECT * FROM `tbl_tahun_ajaran` ");
foreach ($tgl as $row) {
    if (strtolower($row['tgl_start']) == strtolower($START) || strtolower($row['tgl_finish']) == strtolower($START)||strtolower($row['tgl_start']) == strtolower($FINISH) || strtolower($row['tgl_finish']) == strtolower($FINISH)) {
        $used = 1;
    }
}


// var_dump($_POST);
// var_dump($_FILES);

// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2. " | " . $JENKEL. " | " . $CABANG. " | ". $DOMISILI. " | " . $KTP. " | " . $NOKTP. " | " . $JABATAN. " | " . $START. " | ". $FINISH. " | " . $STATUS. " | " . $PASSWORD1. " | " . $PASSWORD2;

// $tahun = tampil("SELECT * FROM `tbl_tahun`");
// $used = 0;
// foreach ($tahun as $row) {
//     if (strtolower($row['tahun']) == strtolower($TAHUN)) {
//         $used = 1;
//     } elseif (strtolower($row['simbol']) == strtolower($SIMBOL)) {
//         $used = 1;
//     }
// }

if (empty($TAHUN1) || empty($TAHUN2) || empty($START) || empty($FINISH)) { // jika dari pengecekan sebelumnya ada field yang kosong maka akan menampilkan pesan error
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Pastikan Semua Data Terisi!!!
    </div>
    <?php
    // }elseif ($used == 1) {
    ?>
    <!-- <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Error - </strong> Data Tahun Sudah Ada!!!
        </div>  -->
<?php
} elseif ($TAHUN1 == $TAHUN2 || $START == $FINISH) {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Data Tidak Boleh Sama!!!
    </div>
<?php
} elseif ($used == 1) {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Tanggal Sudah Digunakan!!!
    </div>
<?php
}elseif ($TAHUN1 > $TAHUN2) {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Tahun 2 Tidak Boleh Lebih Kecil Dari Tahun 1!!!
    </div>
    <?php
} else {
    if (tambah_tahun_ajaran($_POST) > 0) {
    ?>
        <div class="alert alert-success  text-bg-success border-0 fade show" role="alert">
            Data Berhasil Ditambahkan
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=tahun_ajaran">
    <?php
    } else {
    ?>
        <div class="alert alert-danger  text-bg-danger border-0 fade show" role="alert">
            <strong>Error - </strong> Data Gagal Ditambahkan!!!
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=tahun_ajaran">
<?php
    }
    echo '<meta http-equiv="refresh" content="1; url=index.php?inc=tahun_ajaran">';
}

?>