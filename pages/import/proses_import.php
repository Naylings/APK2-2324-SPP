<?php
ob_start();
require_once '../inc/function.php';


// $GAMBAR = $_FILES['Photo']['tmp_name']; //tangkap data file



// var_dump($_POST);
// var_dump($_FILES);

// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2. " | " . $JENKEL. " | " . $CABANG. " | ". $DOMISILI. " | " . $KTP. " | " . $NOKTP. " | " . $JABATAN. " | " . $START. " | ". $FINISH. " | " . $STATUS. " | " . $PASSWORD1. " | " . $PASSWORD2;


if (import_kelas($_POST) > 0) {
?>
    <div class="alert alert-success  text-bg-success border-0 fade show" role="alert">
        Data Berhasil Ditambahkan
    </div>
    <meta http-equiv="refresh" content="1; url=index.php?inc=siswa">
<?php
} else {
?>
    <div class="alert alert-danger  text-bg-danger border-0 fade show" role="alert">
        <strong>Error - </strong> Data Gagal Ditambahkan!!!
    </div>
    <meta http-equiv="refresh" content="1; url=index.php?inc=siswa">
<?php
}
?>
<meta http-equiv="refresh" content="1; url=index.php?inc=siswa">