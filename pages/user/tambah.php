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


        <?php
        if (isset($_POST['tambah'])) {
            include "proses_tambah.php";
        }
        ?>

        <div class="row">
            <div class="col-12 row">
                <div class="card mb-3 col-12">
                    <div class="card-body">
                        <h4 class="header-title">Tambah User Petugas</h4>
                        <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="kode" value="<?php echo autonum("tbl_auth", "auth_id", 6, "AUTH"); ?>">
                        <input type="hidden" name="role" value="1">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Petugas">
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Email Petugas">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="kontak" class="form-label">Telepon</label>
                                    <input type="number" class="form-control" id="kontak" name="telepon" placeholder="Telepon Petugas">
                                </div>
                            </div>


                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="start" class="form-label">Date Start</label>
                                    <input type="date" class="form-control" id="start" name="start" placeholder="Tanggal Mulai Bekerja">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="finish" class="form-label">Date Finish</label>
                                    <input type="date" class="form-control" id="finish" name="finish" placeholder="Tanggal Akhir Bekerja">
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="Password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="Password" name="password" placeholder="Password">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="Password2" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="Password2" name="password2" placeholder="Repeat Password">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="Photo" class="form-label">Upload Foto</label>
                                <input type="file" id="Photo" name="Photo" class="form-control">
                            </div>


                            <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>