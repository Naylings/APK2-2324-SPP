<?php
require_once "../inc/function.php";
$ID = $_GET['id'];
$sql = " SELECT `tbl_jenis_pembayaran`.*, `tbl_tahun_ajaran`.* FROM `tbl_jenis_pembayaran` LEFT JOIN `tbl_tahun_ajaran` ON `tbl_jenis_pembayaran`.`id_tahun_ajaran` = `tbl_tahun_ajaran`.`id_tahun_ajaran` WHERE id_jenis = '$ID'";
$HASIL = mysqli_query($KONEKSI, $sql) or die("ERROR BANG!!...   BACA TUH EROR -->" . mysqli_error($KONEKSI));
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
                            <li class="breadcrumb-item active">Kategori</li>
                            <li class="breadcrumb-item "><a href="<?= $_SERVER['PHP_SELF'] . "?inc=" . $_GET['inc']; ?>">Jenis Pembayaran</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Jenis Pembayaran</h4>
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
                                <h4 class="header-title"> Hapus Jenis Pembayaran</h4>
                            </div>
                        </div>
                        <div class="tab-content">

                            <div class="alert alert-dark  border-0 fade show" role="alert">
                                <i class="ri-alert-line me-2"></i>
                                <strong>Warning - </strong> Apakah anda yakin ingin menghapus data Pembayaran<br><span style="font-weight: bold; color:red"><?= $ROW['nama_jenis'] ." ( ". $ROW['semester_ganjil']." - ". $ROW['semester_genap']." )"; ?></span><br><br>

                                <a href="?inc=jenis_pem&aksi=proses delete&id=<?php echo $ROW['id_jenis'] ?>"><button type="button" class="btn btn-danger" name="Hapus"><i class="ri ri-delete-bin-line"></i> Delete</button></a>
                                <a href="?inc=jenis_pem"><button type="button" class="btn btn-success" name="Cancel"><i class="ri  ri-arrow-go-back-line"></i> <span>Cancle</span> </button></a>
                            </div>

                        </div> <!-- end tab-content-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->


    </div> <!-- container -->

</div> <!-- content -->