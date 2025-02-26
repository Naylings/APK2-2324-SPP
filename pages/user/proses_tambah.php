<?php
ob_start();
require_once '../inc/function.php';


// $GAMBAR = $_FILES['Photo']['tmp_name']; //tangkap data file

$target = "../assets/images/users/";
$ID = htmlspecialchars($_POST["kode"]);
$NAMA = htmlspecialchars($_POST["name"]);
$EMAIL = htmlspecialchars($_POST["email"]);
$TELEPON = htmlspecialchars($_POST["telepon"]);
$START = htmlspecialchars($_POST["start"]);
$FINISH = htmlspecialchars($_POST["finish"]);
$PASSWORD1 = mysqli_real_escape_string($KONEKSI, $_POST["password"]);
$PASSWORD2 = mysqli_real_escape_string($KONEKSI, $_POST["password2"]);

// var_dump($_POST);
// var_dump($_FILES);

// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2. " | " . $JENKEL. " | " . $CABANG. " | ". $DOMISILI. " | " . $KTP. " | " . $NOKTP. " | " . $JABATAN. " | " . $START. " | ". $FINISH. " | " . $STATUS. " | " . $PASSWORD1. " | " . $PASSWORD2;

if (empty($ID) || empty($NAMA) || empty($EMAIL) || empty($TELEPON) || empty($PASSWORD1) || empty($PASSWORD2) || empty($START) || empty($FINISH)) { // jika dari pengecekan sebelumnya ada field yang kosong maka akan menampilkan pesan error
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Pastikan Semua Data Terisi!!!
    </div>
    <?php
} else {
    if (tambah_user($_POST, $_FILES, $target) > 0) {
    ?>
        <div class="alert alert-success  text-bg-success border-0 fade show" role="alert">
            Data Berhasil Ditambahkan
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=user">
    <?php
    } else {
    ?>
        <div class="alert alert-danger  text-bg-danger border-0 fade show" role="alert">
            <strong>Error - </strong> Data Gagal Ditambahkan!!!
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=user">
<?php
    }
    echo '<meta http-equiv="refresh" content="1; url=index.php?inc=user">';
}

?>