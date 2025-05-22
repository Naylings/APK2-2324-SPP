<?php
require_once "../inc/function.php";







$tahun = $_POST['id'];
$tahun_ajar = tampil("SELECT * FROM tbl_tahun_ajaran WHERE id_tahun_ajaran = '$tahun'");
$tahun_ajar = $tahun_ajar[0]['simbol_tahun_ajaran'];



$kelas = tampil("SELECT * FROM tbl_kelas WHERE id_tahun_ajaran = '$tahun'");
$wakel = tampil("SELECT * FROM tbl_wali_kelas WHERE id_tahun_ajaran = '$tahun'");
$jenis = tampil("SELECT * FROM tbl_jenis_pembayaran WHERE id_tahun_ajaran = '$tahun'");
$siswa = tampil("SELECT * FROM tbl_siswa WHERE LEFT(nis, 4) = '$tahun_ajar'");

if (empty($kelas) || empty($wakel) || empty($jenis) || empty($siswa)) {
    hapus_tahun_ajaran($_POST);
    echo "Proses Hapus Data Berhasil....";
?>
    <meta http-equiv="refresh" content="1; url=index.php?inc=tahun_ajaran">
<?php
} else {
?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Tolong Hapus Data Kelas Yang Terhubung Ke Data Tahun Ajaran!!!
    </div>
<?php
}






?>