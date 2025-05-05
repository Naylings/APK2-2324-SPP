<?php
require_once "../inc/function.php";
$ID = $_GET['id'];
$SQL = "SELECT `tbl_kelas`.*, `tbl_jurusan`.*, `tbl_guru`.*, `tbl_tahun_ajaran`.* FROM `tbl_kelas` 	LEFT JOIN `tbl_jurusan` ON `tbl_kelas`.`jurusan` = `tbl_jurusan`.`id_jurusan` 	LEFT JOIN `tbl_guru` ON `tbl_kelas`.`wali_kelas` = `tbl_guru`.`nip` 	LEFT JOIN `tbl_tahun_ajaran` ON `tbl_kelas`.`id_tahun_ajaran` = `tbl_tahun_ajaran`.`id_tahun_ajaran` WHERE tbl_kelas.id_kelas='$ID'";
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
                            <li class="breadcrumb-item active">Main</li>
                            <li class="breadcrumb-item "><a href="<?= $_SERVER['PHP_SELF'] . "?inc=" . $_GET['inc']; ?>">Kelas</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Kelas</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->



        <div class="row justify-content-md-center">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <h4 class="header-title"> View Kelas <?= $ROW['tingkat'] . " - " . $ROW['simbol_jur']; ?></h4>
                            </div>
                        </div>
                        <div class="tab-content">
                            


                        </div> <!-- end tab-content-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->


    </div> <!-- container -->

</div> <!-- content -->