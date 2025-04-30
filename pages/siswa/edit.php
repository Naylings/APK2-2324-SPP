<?php
$id = $_GET['id'];

// cari role user

// cari data berdasarkan id dari form edit
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
// var_dump($photo);

$tahun = tampil("SELECT `tbl_tahun_ajaran`.`simbol_tahun_ajaran` FROM `tbl_tahun_ajaran` WHERE status = 'Active'");
$kelas = tampil("SELECT `tbl_kelas`.*, `tbl_jurusan`.*, `tbl_guru`.*, `tbl_tahun_ajaran`.* FROM `tbl_kelas` 	LEFT JOIN `tbl_jurusan` ON `tbl_kelas`.`jurusan` = `tbl_jurusan`.`id_jurusan` 	LEFT JOIN `tbl_guru` ON `tbl_kelas`.`wali_kelas` = `tbl_guru`.`nip` 	LEFT JOIN `tbl_tahun_ajaran` ON `tbl_kelas`.`id_tahun_ajaran` = `tbl_tahun_ajaran`.`id_tahun_ajaran` ORDER BY (CASE WHEN tbl_tahun_ajaran.status = 'Active' THEN 0 ELSE 1 END), tbl_tahun_ajaran.simbol_tahun_ajaran ASC, tbl_kelas.tingkat ASC");


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
                            <li class="breadcrumb-item active">Warga Sekolah</li>
                            <li class="breadcrumb-item "><a href="<?= $_SERVER['PHP_SELF'] . "?inc=" . $_GET['inc']; ?>">Siswa</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Siswa</h4>
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
                        <h4 class="header-title">Edit Siswa</h4>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row g-2">
                                <div class="mb-3  col-md-6">
                                    <label for="kode" class="form-label">NIS</label>
                                    <input type="text" class="form-control" id="kode" name="kode" value="<?= $id ?>" readonly>
                                </div>
                                <div class="mb-3  col-md-6">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $nama ?>" placeholder="Nama Siswa">
                                </div>
                            </div>


                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="alamat" class="form-label">Alamat Siswa</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $alamat ?>" placeholder="Isi Alamat Domisili">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="kontak" class="form-label">Telepon</label>
                                    <input type="number" class="form-control" id="kontak" name="telepon" value="<?= $telepon ?>" placeholder="Telepon Siswa">
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <select class="form-select" id="kelas" name="kelas">
                                        <option value=""> - </option>
                                        <?php
                                        foreach ($kelas as $key) {
                                            $select = "";
                                            if ($key['id_kelas'] == $kelas_id) {
                                            $select = "selected";
                                            }
                                            echo '<option value="' . $key['id_kelas'] . '"' . $select . '>' . $key['tingkat'] . " - " . $key['simbol_jur'] . ' (' . $key['semester_ganjil'] . " - " . $key['semester_genap'] . ')</option>';
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <p class="form-label">Jenis Kelamin</p>
                                    <div class=" mt-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="jenkel" class="form-check-input" id="L" value="L" <?= $jenkel == "L" ? 'checked' : ""; ?>>
                                            <label class="form-check-label" for="L">Laki - Laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="jenkel" class="form-check-input" id="P" value="P" <?= $jenkel == "P" ? 'checked' : ""; ?>>
                                            <label class="form-check-label" for="P">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6"> 
                                    <input type="hidden" class="form-control" name="photo_db" value="<?php echo $photo; ?>">

                                    <label for="Photo" class="form-label ">Upload Foto</label>
                                    <input type="file" id="Photo" name="Photo" class="form-control mb-3">
                                    <img src="../assets/images/warga_sekolah/<?= empty($photo) ? 'user.jpg' : $photo; ?>" class="avatar-xl rounded-circle" width="150px" alt="">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <p class="  form-label">Status Siswa</p>
                                    <div class=" mt-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="Active" name="status" class="form-check-input" value="Active" <?= $status == "Active" ? 'checked' : ""; ?>>
                                            <label class="form-check-label" for="Active">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
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