<?php
ob_start();
require_once '../inc/function.php';


// $GAMBAR = $_FILES['Photo']['tmp_name']; //tangkap data file

$NAMA = htmlspecialchars($_POST["jurusan"]);
$SIMBOL = htmlspecialchars($_POST["jurusan2"]);

// var_dump($_POST);
// var_dump($_FILES);

// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2. " | " . $JENKEL. " | " . $CABANG. " | ". $DOMISILI. " | " . $KTP. " | " . $NOKTP. " | " . $JABATAN. " | " . $START. " | ". $FINISH. " | " . $STATUS. " | " . $PASSWORD1. " | " . $PASSWORD2;

$jurusan = tampil("SELECT * FROM `tbl_jurusan`");
$used = 0;
foreach ($jurusan as $row) {
    if (strtolower($row['nama_jurusan']) == strtolower($NAMA)) {
        $used = 1;
    } elseif (strtolower($row['simbol_jur']) == strtolower($SIMBOL)) {
        $used = 1;
    }
}

if (empty($NAMA) || empty($SIMBOL) ) { // jika dari pengecekan sebelumnya ada field yang kosong maka akan menampilkan pesan error
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Pastikan Semua Data Terisi!!!
    </div>
    <?php
    }elseif ($used == 1) {
        ?>
        <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Error - </strong> Data jurusan Sudah Ada!!!
        </div>
        <?php
    } else {
    if (tambah_jurusan($_POST) > 0) {
    ?>
        <div class="alert alert-success  text-bg-success border-0 fade show" role="alert">
            Data Berhasil Ditambahkan
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=jurusan">
    <?php
    } else {
    ?>
        <div class="alert alert-danger  text-bg-danger border-0 fade show" role="alert">
            <strong>Error - </strong> Data Gagal Ditambahkan!!!
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=jurusan">
<?php
    }
    echo '<meta http-equiv="refresh" content="1; url=index.php?inc=jurusan">';
}

?>