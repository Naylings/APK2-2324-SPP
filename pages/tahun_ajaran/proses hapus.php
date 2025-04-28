<?php
require_once "../inc/function.php";







$tahun = $_POST['id'];
$tahun = tampil("SELECT * FROM tbl_kelas WHERE id_tahun_ajaran = '$tahun'");
if (empty($tahun)) {
    hapus_tahun_ajaran($_POST);
    echo "Proses Hapus Data Berhasil....";
?>
    <meta http-equiv="refresh" content="1; url=index.php?inc=tahun_ajaran">
<?php
} else {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Tolong Hapus Data Kelas & Siswa Yang Terhubung Ke Data Tahun Ajaran!!!
    </div>
<?php
}






?>