<?php
require_once "../inc/function.php";


$sudah = $_GET['id'];
$sudah1 = tampil("SELECT * FROM tbl_wali_kelas WHERE id_kelas = '$sudah'");
$sudah2 = tampil("SELECT * FROM tbl_siswa WHERE id_kelas = '$sudah'");



if (empty($sudah1) || empty($sudah2)) {
    echo "Proses Hapus Data Berhasil....";
    hapus_kelas($_GET);

?>
    <meta http-equiv="refresh" content="1; url=index.php?inc=kelas">
<?php
} else {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Tolong Hapus Data Kelas Yang Terhubung Ke Data Kelas!!!
    </div>
<?php
}


?>
<meta http-equiv="refresh" content="1; url=index.php?inc=kelas">