<?php
ob_start();
require_once '../inc/function.php';


// $GAMBAR = $_FILES['Photo']['tmp_name']; //tangkap data file

$target = "../assets/images/warga_sekolah/";
$ID = htmlspecialchars($_POST["kode"]);
$NAMA = htmlspecialchars($_POST["name"]);
$ALAMAT = htmlspecialchars($_POST["alamat"]);
$TELEPON = htmlspecialchars($_POST["telepon"]);
$KELAS = htmlspecialchars($_POST["kelas"]);
$JENKEL = htmlspecialchars($_POST["jenkel"]);


// var_dump($_POST);
// var_dump($_FILES);

// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2. " | " . $JENKEL. " | " . $CABANG. " | ". $DOMISILI. " | " . $KTP. " | " . $NOKTP. " | " . $JABATAN. " | " . $START. " | ". $FINISH. " | " . $STATUS. " | " . $PASSWORD1. " | " . $PASSWORD2;

if (empty($ID) || empty($NAMA)  || empty($TELEPON)  || empty($ALAMAT) || empty($JENKEL)) { // jika dari pengecekan sebelumnya ada field yang kosong maka akan menampilkan pesan error
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
    if (tambah_siswa($_POST, $_FILES, $target) > 0) {
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
    echo '<meta http-equiv="refresh" content="1; url=index.php?inc=siswa">';
}

?>