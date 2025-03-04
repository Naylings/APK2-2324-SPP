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
                            <li class="breadcrumb-item "><a href="<?= $_SERVER['PHP_SELF']; ?>">School</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">School</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <?php
        if (isset($_POST['update'])) {
            include "update.php";
        }
        if (isset($_POST['update_logo'])) {
            include "update_logo.php";
        }

        $sql = "SELECT * FROM tbl_sekolah WHERE id_sekolah='1'";
        
        $edit = tampil($sql);
        foreach ($edit as $row) {
            $id = $row['id_sekolah'];
            $alamat = $row['alamat_sekolah'];
            $nama = $row['nama_sekolah'];
            $kontak = $row['kontak_sekolah'];
            $email = $row['email_sekolah'];
        }

        ?>


        <div class="row">
            <div class="col-12 row">
                <div class="card mb-3 col-12">
                    <div class="card-body">
                        <h4 class="header-title">Informasi Sekolah</h4>
                        <form method="post">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name"value="<?= $nama ?>" placeholder="Nama Sekolah">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" name="email"value="<?= $email ?>" placeholder="Email Sekolah">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="kontak" class="form-label">Kontak</label>
                                <input type="number" class="form-control" id="kontak" name="kontak"value="<?= $kontak ?>" placeholder="Kontak Sekolah">
                            </div>

                            <div class="mb-3">
                                <label for="Alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="Alamat" name="alamat"value="<?= $alamat ?>" placeholder="Alamat Sekolah">
                            </div>


                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                        </form>
                    </div>
                </div>
                <div class="card mb-3 col-auto">
                    <div class="card-body">
                        <h4 class="header-title">Logo Sekolah <span class="text-muted">(resolusi disarankan : 1x1)</span></h4>
                        <img src="../assets/images/favicon.ico" alt="" width="100%">
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <input type="file" id="example-fileinput" name="Photo" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-success" name="update_logo">Update Logo</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>