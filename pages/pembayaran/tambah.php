<?php
$id = $_GET['id'];

$sql = "SELECT * FROM `tbl_siswa`  WHERE nis='$id'";

$edit = mysqli_query($KONEKSI, $sql);
while ($row = mysqli_fetch_assoc($edit)) {
    $id = $row['nis'];
    $nama = $row['nama_siswa'];
    $telepon = $row['telepon_siswa'];
    $photo = $row['path_photo'];
    $alamat = $row['alamat_siswa'];
    $jenkel = $row['jenkel'];
    $status = $row['status'];
    $kelas_id = $row['id_kelas'];
}




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
                            <li class="breadcrumb-item active">siswa</li>
                            <li class="breadcrumb-item "><a href="<?= $_SERVER['PHP_SELF'] . "?inc=siswa&aksi=view&id=" . $_GET['id']; ?>"><?= $nama ?></a></li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?= $nama ?></h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <?php
        if (isset($_POST['tambah'])) {
            include "proses_tambah.php";
        }
        $pembayaran = tampil("SELECT * FROM tbl_pembayaran WHERE nis = '$id'");

        ?>

        <div class="row">
            <div class="col-12 row">
                <div class="card mb-3 col-12">
                    <div class="card-body">
                        <h4 class="header-title">Tambah Siswa</h4>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row g-2">
                                <div class="mb-3  col-md-6">
                                    <label for="kode" class="form-label">NIS</label>
                                    <input type="text" class="form-control" readonly id="kode" name="id" value="<?= $id ?>">
                                </div>
                                <div class="mb-3  col-md-6">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" readonly value="<?= $nama ?>">
                                </div>
                            </div>

                            <div class="row mb-4 g-3">
                                <label class="h5 mt-4">Satu Kali Pembayaran :</label>
                                <?php

                                $pembayaran_sekali = tampil("SELECT tbl_jenis_pembayaran.*, CONCAT(  ' ( ', tbl_tahun_ajaran.semester_ganjil, ' - ', tbl_tahun_ajaran.semester_genap, ' ) ' ) AS tahun_ajar FROM tbl_jenis_pembayaran LEFT JOIN tbl_tahun_ajaran ON tbl_jenis_pembayaran.id_tahun_ajaran = tbl_tahun_ajaran.id_tahun_ajaran WHERE tbl_tahun_ajaran.status = 'Active' AND tbl_jenis_pembayaran.bulanan = 0 ORDER BY   tbl_jenis_pembayaran.nama_jenis ASC");


                                foreach ($pembayaran_sekali as $key) {
                                ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-check ">
                                            <input class="form-check-input" type="checkbox" value="<?= $key['id_jenis'] ?>" id="jenis_<?= $key['id_jenis'] ?>" name="data_pembayaran[]">
                                            <label class="form-check-label" for="jenis_<?= $key['id_jenis'] ?>">
                                                <?= $key['nama_jenis'] . " " . $key['tahun_ajar'] ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>


                                <label class="h5 mt-4">Pembayaran Bulanan :</label>
                                <?php

                                $pembayaran_bulanan = tampil("SELECT tbl_jenis_pembayaran.*, CONCAT(  ' ( ', tbl_tahun_ajaran.semester_ganjil, ' - ', tbl_tahun_ajaran.semester_genap, ' ) ' ) AS tahun_ajar FROM tbl_jenis_pembayaran LEFT JOIN tbl_tahun_ajaran ON tbl_jenis_pembayaran.id_tahun_ajaran = tbl_tahun_ajaran.id_tahun_ajaran WHERE tbl_tahun_ajaran.status = 'Active' AND tbl_jenis_pembayaran.bulanan = 1 ORDER BY   tbl_jenis_pembayaran.nama_jenis ASC");

                                $bulan = tampil("SELECT * FROM tbl_bulan ORDER BY no_bulan ASC");
                                foreach ($pembayaran_bulanan as $key) {
                                ?>
                                    <label class="h6 mt-4"> <?= $key['nama_jenis'] . " " . $key['tahun_ajar'] ?> :</label>
                                    <?php
                                    foreach ($bulan as $key2) {
                                    ?>
                                        <div class="col-lg-3 col-md-4">
                                            <div class="form-check ">
                                                <input class="form-check-input" type="checkbox" value="<?= $key['id_jenis'] . "-" . $key2['id_bulan'] ?>" id="jenis_<?= $key['id_jenis'] . "-" . $key2['id_bulan'] ?>" name="data_pembayaran_bulan[]">
                                                <label class="form-check-label" for="jenis_<?= $key['id_jenis'] . "-" . $key2['id_bulan'] ?>">
                                                    <?= $key2['no_bulan'].". ".$key2['nama_bulan'] ?>
                                                </label>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>




                            <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>