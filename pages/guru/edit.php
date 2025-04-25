<?php
$id = $_GET['id'];

// cari role user

// cari data berdasarkan id dari form edit
$sql = "SELECT * FROM `tbl_guru`  WHERE nip='$id'";

$edit = mysqli_query($KONEKSI, $sql);
while ($row = mysqli_fetch_assoc($edit)) {
    $id = $row['nip'];
    $nama = $row['nama_guru'];
    $telepon = $row['telepon_guru'];
    $photo = $row['path_photo'];
    $start = $row['date_start'];
    $finish = $row['date_finish'];
    $status = $row['status'];
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
                            <li class="breadcrumb-item active">Settings</li>
                            <li class="breadcrumb-item "><a href="<?= $_SERVER['PHP_SELF'] . "?inc=" . $_GET['inc']; ?>">Guru</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Guru</h4>
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
                        <h4 class="header-title">Edit Guru</h4>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row g-2">
                                <div class="mb-3  col-md-6">
                                    <label for="kode" class="form-label">NIP</label>
                                    <input type="text" class="form-control" id="kode" name="kode" value="<?= $id ?>" readonly>
                                </div>
                                <div class="mb-3  col-md-6">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $nama ?>" placeholder="Nama Guru">
                                </div>
                            </div>


                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="start" class="form-label">Date Start</label>
                                    <input type="date" class="form-control" id="start" name="start" value="<?= $start ?>" placeholder="Tanggal Mulai Bekerja">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="finish" class="form-label">Date Finish</label>
                                    <input type="date" class="form-control" id="finish" name="finish" value="<?= $finish ?>" placeholder="Tanggal Akhir Bekerja">
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col">
                                    <label for="kontak" class="form-label">Telepon</label>
                                    <input type="number" class="form-control" id="kontak" value="<?= $telepon ?>" name="telepon" placeholder="Telepon Petugas">
                                </div></div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="Photo" class="form-label ">Upload Foto</label>
                                    <input type="file" id="Photo" name="Photo" class="form-control mb-3">
                                    <img src="../assets/images/warga_sekolah/<?= empty($photo) ? 'user.jpg' : $photo; ?>" class="avatar-xl rounded-circle" width="150px" alt="">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <p class="  form-label">Status Petugas</p>
                                    <div class=" mt-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="Active" name="status" class="form-check-input" value="Active" <?= $status == "Active" ? 'checked' : ""; ?>>
                                            <label class="form-check-label" for="Active">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="hidden" class="form-control" name="photo_db" value="<?php echo $photo; ?>">
                                            <input type="radio" id="Inactive" name="status" class="form-check-input" value="Inactive" <?= $status == "Inactive" ? 'checked' : ""; ?>>
                                            <label class="form-check-label" for="Inactive">Inactive</label>
                                        </div>
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