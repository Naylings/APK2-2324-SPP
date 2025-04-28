<?php
ob_start();
require_once '../inc/function.php';


// $GAMBAR = $_FILES['Photo']['tmp_name']; //tangkap data file

$TINGKAT = htmlspecialchars($_POST["tingkat"]);
$TAHUN = htmlspecialchars($_POST["tahun"]);
$GURU = htmlspecialchars($_POST["guru"]);
$JURUSAN = htmlspecialchars($_POST["jurusan"]);

$used = false;
$kelas = tampil("SELECT * FROM `tbl_kelas` WHERE id_tahun_ajaran = '$TAHUN' AND tingkat = '$TINGKAT' AND jurusan = '$JURUSAN'");
if (!empty($kelas)) {
    $used = true;
}

// var_dump($_POST);
// var_dump($_FILES);

// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2. " | " . $JENKEL. " | " . $CABANG. " | ". $DOMISILI. " | " . $KTP. " | " . $NOKTP. " | " . $JABATAN. " | " . $START. " | ". $FINISH. " | " . $STATUS. " | " . $PASSWORD1. " | " . $PASSWORD2;

if (empty($TINGKAT) || empty($TAHUN)  || empty($JURUSAN)) { // jika dari pengecekan sebelumnya ada field yang kosong maka akan menampilkan pesan error
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
    if (empty($GURU)) {
        echo "<script>alert('Tolong Segera Cari Guru Untuk Wali Kelas!!!');</script>";
    }
    if (tambah_kelas($_POST) > 0) {
    ?>
        <div class="alert alert-success  text-bg-success border-0 fade show" role="alert">
            Data Berhasil Ditambahkan
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=kelas">
    <?php
    } else {
    ?>
        <div class="alert alert-danger  text-bg-danger border-0 fade show" role="alert">
            <strong>Error - </strong> Data Gagal Ditambahkan!!!
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=kelas">
<?php
    }
    echo '<meta http-equiv="refresh" content="1; url=index.php?inc=kelas">';
}

?>