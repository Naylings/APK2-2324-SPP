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
                            <li class="breadcrumb-item "><a href="<?= $_SERVER['PHP_SELF'] . "?inc=" . $_GET['inc']; ?>">Guru</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Guru</h4>
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
                        <h4 class="header-title">Tambah Guru</h4>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row g-2">
                                <div class="mb-3  col-md-6">
                                    <label for="kode" class="form-label">NIP</label>
                                    <input type="text" class="form-control" id="kode" name="kode" placeholder="NIP.......">
                                </div>
                                <div class="mb-3  col-md-6">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama Guru">
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
                                <label for="Photo" class="form-label">Upload Foto</label>
                                <input type="file" id="Photo" name="Photo" class="form-control">
                            </div>
                                <div class="mb-3 col-md-6">
                                    <label for="kontak" class="form-label">Telepon</label>
                                    <input type="number" class="form-control" id="kontak" name="telepon" placeholder="Telepon Petugas">
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>