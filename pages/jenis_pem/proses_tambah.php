<?php
ob_start();
require_once '../inc/function.php';


// $GAMBAR = $_FILES['Photo']['tmp_name']; //tangkap data file

$BULANAN = htmlspecialchars($_POST["bulanan"]);
$TAHUN = htmlspecialchars($_POST["tahun"]);
$NAME = htmlspecialchars($_POST["name"]);
$TUNAI = htmlspecialchars($_POST["tunai"]);

$used = false;
$janis = tampil("SELECT * FROM `tbl_jenis_pembayaran` WHERE nama_jenis = '$NAME' AND id_tahun_ajaran = '$TAHUN'");
if (!empty($janis)) {
    $used = true;
}

// var_dump($_POST);
// var_dump($_FILES);

// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2. " | " . $JENKEL. " | " . $CABANG. " | ". $DOMISILI. " | " . $KTP. " | " . $NOKTP. " | " . $JABATAN. " | " . $START. " | ". $FINISH. " | " . $STATUS. " | " . $PASSWORD1. " | " . $PASSWORD2;

if (empty($NAME) || empty($TAHUN)  || empty($TUNAI)) { // jika dari pengecekan sebelumnya ada field yang kosong maka akan menampilkan pesan error
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
        <strong>Error - </strong> Data Jenis Pembayaran Sudah Ada!!!
    </div>
    <?php
} else {
    if (tambah_jenis($_POST) > 0) {
    ?>
        <div class="alert alert-success  text-bg-success border-0 fade show" role="alert">
            Data Berhasil Ditambahkan
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=jenis_pem">
    <?php
    } else {
    ?>
        <div class="alert alert-danger  text-bg-danger border-0 fade show" role="alert">
            <strong>Error - </strong> Data Gagal Ditambahkan!!!
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=jenis_pem">
<?php
    }
    echo '<meta http-equiv="refresh" content="1; url=index.php?inc=jenis_pem">';
}

?>