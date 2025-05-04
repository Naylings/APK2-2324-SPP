<?php
$id = $_GET['id'];

// cari role user

// cari data berdasarkan id dari form edit
$sql = "SELECT * FROM `tbl_wali_kelas`  WHERE id_kelas='$id'";

$edit = mysqli_query($KONEKSI, $sql);
while ($row = mysqli_fetch_assoc($edit)) {
    $IDwakel = $row['wali_kelas'];
    $IDtahun_ajaran = $row['id_tahun_ajaran'];
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
                            <li class="breadcrumb-item active">Warga Sekolah</li>
                            <li class="breadcrumb-item "><a href="<?= $_SERVER['PHP_SELF'] . "?inc=" . $_GET['inc']; ?>">Wali Kelas</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Wali Kelas</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <?php
        if (isset($_POST['edit'])) {
            include "proses_edit.php";
        }
        $kelas = tampil("SELECT tbl_kelas.id_kelas, tbl_kelas.tingkat, CONCAT( tbl_jurusan.simbol_jur, ' ( ', tbl_tahun_ajaran.semester_ganjil, ' - ', tbl_tahun_ajaran.semester_genap, ' ) ' ) AS nama_kelas FROM tbl_kelas LEFT JOIN tbl_jurusan ON tbl_kelas.jurusan = tbl_jurusan.id_jurusan LEFT JOIN tbl_tahun_ajaran ON tbl_kelas.id_tahun_ajaran = tbl_tahun_ajaran.id_tahun_ajaran WHERE status ='Active' OR tbl_kelas.id_kelas ='$id' ORDER BY nama_kelas ASC,tbl_kelas.tingkat ASC");

        $wali_kelas = tampil("SELECT `tbl_wali_kelas`.`id_kelas`,`tbl_wali_kelas`.`wali_kelas` FROM `tbl_wali_kelas` LEFT JOIN tbl_tahun_ajaran ON tbl_wali_kelas.id_tahun_ajaran = tbl_tahun_ajaran.id_tahun_ajaran WHERE tbl_tahun_ajaran.status ='Active'");
        $sudah_ada_kelas = [""];
        foreach ($wali_kelas as $row) {
            $sudah_ada_kelas[] =  $row['id_kelas'];
        }
        $sudah_ada_wali = [""];
        foreach ($wali_kelas as $row) {
            $sudah_ada_wali[] =  $row['wali_kelas'];
        }
        $guru = tampil("SELECT * FROM tbl_guru  WHERE status ='Active' OR nip ='$IDwakel' ");
        ?>

        <div class="row">
            <div class="col-12 row">
                <div class="card mb-3 col-12">
                    <div class="card-body">
                        <h4 class="header-title">Edit Wali Kelas</h4>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row g-2">
                                <div class="mb-3  col-md-6">
                                    <label for="kelas" class="form-label">Nama Kelas</label>
                                    <select name="kelas" class="form-select" id="kelas">
                                        <?php
                                        foreach ($kelas as $key) {
                                            if (!in_array($key['id_kelas'], $sudah_ada_kelas) || $key['id_kelas'] == $id) {
                                                echo '<option value="' . $key['id_kelas'] . '" ';
                                                if ($key['id_kelas'] == $id) {
                                                    echo "selected";
                                                } else {
                                                    echo "disabled";
                                                }
                                                echo '>' . $key['tingkat'] . ' - ' . $key['nama_kelas'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3  col-md-6">
                                    <label for="wali" class="form-label">Wali Kelas</label>
                                    <select class="form-select" id="wali" name="wali">
                                        <option value="" disabled selected> Pilih Wali Kelas </option>
                                        <?php
                                        foreach ($guru as $key) {
                                            if (!in_array($key['nip'], $sudah_ada_wali) || $key['nip'] == $IDwakel) {
                                                echo '<option value="' . $key['nip'] . '"';

                                                if ($key['nip'] == $IDwakel) {
                                                    echo "selected";
                                                }
                                                echo '>' . $key['nama_guru'] . " ( " . $key['nip'] . " )" . '</option>';
                                            }
                                        }
                                        ?>


                                    </select>
                                    <input type="hidden" value="<?= $IDtahun_ajaran ?>" name="tahun">
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