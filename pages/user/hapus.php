<?php
require_once "../inc/function.php";
$ID = $_GET['id'];
$SQL = "SELECT `tbl_auth`.*, `tbl_user`.* FROM `tbl_auth`  LEFT JOIN `tbl_user` ON `tbl_user`.`auth_id` = `tbl_auth`.`auth_id` WHERE tbl_user.id_user='$ID'";
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
                        <li class="breadcrumb-item active">Settings</li>
                        <li class="breadcrumb-item "><a href="<?= $_SERVER['PHP_SELF']; ?>">User</a></li>
                    </ol>
                </div>
                <h4 class="page-title">User Petugas</h4>
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
                            <h4 class="header-title"> Hapus User Petugas</h4>
                        </div>
                    </div>
                    <div class="tab-content">
                        
            <div class="alert alert-dark  border-0 fade show" role="alert">
                <i class="ri-alert-line me-2"></i>
                <strong>Warning - </strong> Apakah anda yakin ingin menghapus data <span style="font-weight: bold; color:red"><?php echo $ROW['nama_user'] ?></span><br><br>

                <a href="?inc=user&aksi=proses delete&id=<?php echo $ROW['id_user'] ?>"><button type="button" class="btn btn-danger" name="Hapus"><i class="ri ri-delete-bin-line"></i> Delete</button></a>
                <a href="?inc=user"><button type="button" class="btn btn-success" name="Cancel"><i class="ri  ri-arrow-go-back-line"></i> <span>Cancle</span> </button></a>
            </div>

                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->


</div> <!-- container -->

</div> <!-- content -->