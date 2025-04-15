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
                            <li class="breadcrumb-item "><a href="<?= $_SERVER['PHP_SELF'] . "?inc=" . $_GET['inc']; ?>">Tahun Ajaran</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Tahun Ajaran</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <?php
        $tahun = tampil("SELECT * FROM `tbl_tahun` ORDER BY tahun ASC");
        if (isset($_POST['tambah'])) {
            include "proses_tambah.php";
        }
        if (isset($_POST['edit'])) {
            include "proses_edit.php";
        }
        if (isset($_POST['hapus'])) {
            include "proses hapus.php";
        }
        ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <h4 class="header-title"> Data Tahun Ajaran</h4>
                            </div>
                            <div class="col-auto ms-auto">
                                <div class="btn-group mb-2 ">
                                    <!-- <a role="button" href="?inc=tahun&aksi=add" class="btn btn-success">Tambah Tahun</a> -->
                                    <!-- <button type="button" class="btn btn-warning">Warning</button>
                                    <button type="button" class="btn btn-danger">Danger</button> -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah-tahun_ajaran">Tambah Tahun Ajaran</button>

                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="alt-pagination-preview">
                                <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Simbol</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php


                                        $sql_tahun = "SELECT * FROM `tbl_tahun_ajaran` ORDER BY simbol_tahun_ajaran ASC"; // sql untuk tampil

                                        $tampil = tampil($sql_tahun); // panggil tampil sesuai sql
                                        $no = 1;
                                        foreach ($tampil as $user) :
                                        ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $user['semester_ganjil']; ?> - <?= $user['semester_genap']; ?></td>
                                                <td><?= $user['simbol_tahun_ajaran']; ?></td>
                                                <td>
                                                    <div class="dropdown text-center">
                                                        <a href="" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#edit-tahun_ajaran-<?= $user['simbol_tahun_ajaran']; ?>">Edit</button>
                                                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#hapus-tahun_ajaran-<?= $user['simbol_tahun_ajaran']; ?>">Delete</button>
                                                            <a class="dropdown-item" href="#">View</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            include "edit1.php";
                                            include "hapus1.php";
                                            $no++;
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div> <!-- end preview-->

                        </div> <!-- end tab-content-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->


    </div> <!-- container -->

</div> <!-- content -->
<?php
include "tambah1.php";

?>