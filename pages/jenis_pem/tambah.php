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


        <?php
        if (isset($_POST['tambah'])) {
            include "proses_tambah.php";
        }
        $tahun = tampil("SELECT * FROM tbl_tahun_ajaran WHERE status ='Active'");


        ?>

        <div class="row">
            <div class="col-12 row">
                <div class="card mb-3 col-12">
                    <div class="card-body">
                        <h4 class="header-title">Tambah Wali Kelas</h4>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row g-2">
                                <div class="mb-3  col-md-5">
                                    <label for="Jenis" class="form-label">Nama Pembayaran</label>
                                    <input type="text" id="Jenis" class="form-control" placeholder="Nama Jenis Pembayaran" name="name">
                                </div>
                                <div class="mb-3  col-md-5">
                                    <label for="tunai" class="form-label">Jumlah Tunai</label>
                                    <div class="input-group">
                                    <button  class="btn btn-primary" disabled>Rp</button>
                                    <input type="number" id="tunai" class="form-control" placeholder="Jumlah Tunai" name="tunai">
                                    </div>
                                    <input type="hidden" value="<?= $tahun[0]['id_tahun_ajaran'] ?>" name="tahun">
                                </div>
                                <div class="mb-3  col-md-2">
                                    <label for="bulanan" class="form-label">Pembayaran Bulanan</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="bulanan" value="0">
                                        <input type="checkbox" class="form-check-input" id="bulanan" name="bulanan" value="1">
                                    </div>
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