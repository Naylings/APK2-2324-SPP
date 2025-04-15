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
                            <li class="breadcrumb-item "><a href="<?= $_SERVER['PHP_SELF'] . "?inc=" . $_GET['inc']; ?>">Bulan</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Bulan</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <?php
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
                                <h4 class="header-title"> Data Bulan</h4>
                            </div>
                            <div class="col-auto ms-auto">
                                <div class="btn-group mb-2 ">
                                    <!-- <a role="button" href="?inc=bulan&aksi=add" class="btn btn-success">Tambah bulan</a> -->
                                    <!-- <button type="button" class="btn btn-warning">Warning</button>
                                    <button type="button" class="btn btn-danger">Danger</button> -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah-bulan">Tambah bulan</button>

                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="alt-pagination-preview">
                                <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>bulan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php


                                        $sql_bulan = "SELECT * FROM `tbl_bulan` ORDER BY no_bulan ASC"; // sql untuk tampil

                                        $tampil = tampil($sql_bulan); // panggil tampil sesuai sql
                                        $no = 1;
                                        foreach ($tampil as $user) :
                                        ?>
                                            <tr>
                                                <td><?= $user['no_bulan']; ?></td>
                                                <td><?= $user['nama_bulan']; ?></td>
                                                <td>
                                                    <div class="dropdown text-center">
                                                        <a href="" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#edit-bulan-<?= $user['no_bulan']; ?>">Edit</button>
                                                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#hapus-bulan-<?= $user['no_bulan']; ?>">Delete</button>
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