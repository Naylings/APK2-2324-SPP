<?php
ob_start();
require_once '../inc/function.php';


// $GAMBAR = $_FILES['Photo']['tmp_name']; //tangkap data file

$WALI = htmlspecialchars($_POST["wali"]);
$TAHUN = htmlspecialchars($_POST["tahun"]);
$KELAS = htmlspecialchars($_POST["kelas"]);

$used = false;
$wakel = tampil("SELECT * FROM `tbl_wali_kelas` WHERE id_tahun_ajaran = '$TAHUN' AND wali_kelas = '$WALI' AND id_kelas = '$KELAS'");
if (!empty($wakel)) {
    $used = true;
}

// var_dump($_POST);
// var_dump($_FILES);

// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2. " | " . $JENKEL. " | " . $CABANG. " | ". $DOMISILI. " | " . $KTP. " | " . $NOKTP. " | " . $JABATAN. " | " . $START. " | ". $FINISH. " | " . $STATUS. " | " . $PASSWORD1. " | " . $PASSWORD2;

if (empty($WALI) || empty($TAHUN)  || empty($KELAS)) { // jika dari pengecekan sebelumnya ada field yang kosong maka akan menampilkan pesan error
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
        <strong>Error - </strong> Data Wali Kelas Sudah Ada!!!
    </div>
    <?php
} else {
    if (tambah_wali_kelas($_POST) > 0) {
    ?>
        <div class="alert alert-success  text-bg-success border-0 fade show" role="alert">
            Data Berhasil Ditambahkan
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=wali_kelas">
    <?php
    } else {
    ?>
        <div class="alert alert-danger  text-bg-danger border-0 fade show" role="alert">
            <strong>Error - </strong> Data Gagal Ditambahkan!!!
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=wali_kelas">
<?php
    }
    echo '<meta http-equiv="refresh" content="1; url=index.php?inc=wali_kelas">';
}

?>