<?php
$id = $_GET['id'];

// cari role user

// cari data berdasarkan id dari form edit
$sql = "SELECT * FROM `tbl_jenis_pembayaran` WHERE id_jenis = '$id'";

$edit = mysqli_query($KONEKSI, $sql);
while ($row = mysqli_fetch_assoc($edit)) {
    $name = $row['nama_jenis'];
    $tunai = $row['tunai'];
    $bulanan = $row['bulanan'];
    $tahun = $row['id_tahun_ajaran'];
}
// var_dump($photo);


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

        <?php
        if (isset($_POST['edit'])) {
            include "proses_edit.php";
        }
        ?>

        <div class="row">
            <div class="col-12 row">
                <div class="card mb-3 col-12">
                    <div class="card-body">
                        <h4 class="header-title">Edit Wali Kelas</h4>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row g-2">
                                
                            <div class="mb-3  col-md-5">
                                    <label for="Jenis" class="form-label">Nama Pembayaran</label>
                                    <input type="text" id="Jenis" class="form-control" placeholder="Nama Jenis Pembayaran" value="<?= $name ?>" name="name">
                                </div>
                                <div class="mb-3  col-md-5">
                                    <label for="tunai" class="form-label">Jumlah Tunai</label>
                                    <div class="input-group">
                                    <button  class="btn btn-primary" disabled>Rp</button>
                                    <input type="number" id="tunai" class="form-control" placeholder="Jumlah Tunai" name="tunai" value="<?= $tunai ?>">
                                    </div>
                                    <input type="hidden" value="<?= $tahun ?>" name="tahun">
                                    <input type="hidden" value="<?= $id ?>" name="id">
                                </div>
                                <div class="mb-3  col-md-2">
                                    <label for="bulanan" class="form-label">Pembayaran Bulanan</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="bulanan" value="0">
                                        <input type="checkbox" <?= $bulanan == '1' ? 'checked' : ''; ?> class="form-check-input" id="bulanan" name="bulanan" value="1">
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary" name="edit">Tambah</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>