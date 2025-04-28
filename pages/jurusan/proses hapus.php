<?php
require_once "../inc/function.php";


$jurusan = $_POST['id'];
$jurusan = tampil("SELECT * FROM tbl_kelas WHERE jurusan = '$jurusan'");
if (empty($jurusan)) {
hapus_jurusan($_POST);
    echo "Proses Hapus Data Berhasil....";
?>
    <meta http-equiv="refresh" content="1; url=index.php?inc=tahun_ajaran">
<?php
} else {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Tolong Hapus Data Kelas Yang Terhubung Ke Data Jurusan!!!
    </div>
<?php
}

echo "Proses Hapus Data Berhasil...."





?>
<meta http-equiv="refresh" content="1; url=index.php?inc=jurusan">