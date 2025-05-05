<?php
require_once "../inc/function.php";
$ID = $_GET['id'];
$SQL = "SELECT tbl_wali_kelas.*,  tbl_guru.nama_guru, tbl_kelas.id_kelas, CONCAT( tbl_kelas.tingkat, ' - ', tbl_jurusan.simbol_jur, ' ( ', tbl_tahun_ajaran.semester_ganjil, ' - ', tbl_tahun_ajaran.semester_genap, ' ) ' ) AS nama_kelas FROM tbl_wali_kelas LEFT JOIN tbl_guru ON tbl_wali_kelas.wali_kelas = tbl_guru.nip LEFT JOIN tbl_kelas ON tbl_wali_kelas.id_kelas = tbl_kelas.id_kelas LEFT JOIN tbl_jurusan ON tbl_kelas.jurusan = tbl_jurusan.id_jurusan LEFT JOIN tbl_tahun_ajaran ON tbl_wali_kelas.id_tahun_ajaran = tbl_tahun_ajaran.id_tahun_ajaran WHERE tbl_kelas.id_kelas='$ID'";
$HASIL = mysqli_query($KONEKSI, $SQL) or die("ERROR BANG!!...   BACA TUH EROR -->" . mysqli_error($KONEKSI));
$ROW = mysqli_fetch_assoc($HASIL);


?>
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Warga Sekolah</li>
                            <li class="breadcrumb-item "><a href="<?= $_SERVER['PHP_SELF'] . "?inc=" . $_GET['inc']; ?>">Wali Kelas</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Wali Kelas</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->



        <div class="row justify-content-md-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <h4 class="header-title"> Hapus Wali Kelas</h4>
                            </div>
                        </div>
                        <div class="tab-content">

                            <div class="alert alert-dark  border-0 fade show" role="alert">
                                <i class="ri-alert-line me-2"></i>
                                <strong>Warning - </strong> Apakah anda yakin ingin menghapus data wali kelas <br><span style="font-weight: bold; color:red"><?= $ROW['nama_kelas']; ?>, <?= $ROW['nama_guru']; ?> ( <?= $ROW['wali_kelas']; ?> )</span><br><br>

                                <a href="?inc=wali_kelas&aksi=proses delete&id=<?php echo $ROW['id_kelas'] ?>"><button type="button" class="btn btn-danger" name="Hapus"><i class="ri ri-delete-bin-line"></i> Delete</button></a>
                                <a href="?inc=wali_kelas"><button type="button" class="btn btn-success" name="Cancel"><i class="ri  ri-arrow-go-back-line"></i> <span>Cancle</span> </button></a>
                            </div>

                        </div> <!-- end tab-content-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->


    </div> <!-- container -->

</div> <!-- content -->