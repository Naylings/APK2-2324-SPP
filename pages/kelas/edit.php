<?php
$id = $_GET['id'];

// cari role user

// cari data berdasarkan id dari form edit
$sql = "SELECT * FROM `tbl_kelas`  WHERE id_kelas='$id'";

$edit = mysqli_query($KONEKSI, $sql);
while ($row = mysqli_fetch_assoc($edit)) {
    $id = $row['id_kelas'];
    $tingkat = $row['tingkat'];
    $tahun_ajaran = $row['id_tahun_ajaran'];
    $id_jurusan = $row['jurusan'];
    $guru = $row['wali_kelas'];
}
// var_dump($photo);

$tahun = tampil("SELECT * FROM tbl_tahun_ajaran");
$kelas = tampil("SELECT * FROM tbl_kelas WHERE wali_kelas != '';");


$wakel = tampil("SELECT * FROM tbl_guru WHERE status = 'Active' ORDER BY nama_guru ASC");
$jurusan = tampil("SELECT * FROM tbl_jurusan");


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
                            <li class="breadcrumb-item active">Main</li>
                            <li class="breadcrumb-item "><a href="<?= $_SERVER['PHP_SELF'] . "?inc=" . $_GET['inc']; ?>">Kelas</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Kelas</h4>
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
                        <h4 class="header-title">Edit Kelas</h4>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row g-2">
                                <input type="hidden" name="kode" value="<?= $id ?>">
                                <div class="mb-3  col-md-6">
                                    <label for="kode" class="form-label">Tingkatan Kelas</label>
                                    <input type="number" class="form-control" value="<?= $tingkat ?>" name="tingkat" placeholder="Tingkatan">
                                </div>
                                <div class="mb-3  col-md-6">
                                    <label for="tahun" class="form-label">Tahun Ajaran</label>
                                    <select class="form-select" id="tahun" name="tahun">
                                        <?php
                                        foreach ($tahun as $key) {
                                            $selected = "";
                                            if ($key['id_tahun_ajaran'] == $tahun_ajaran) {
                                                $selected = "selected";
                                            }
                                            echo '<option value="' . $key['id_tahun_ajaran'] . '"' . $selected . '>' . $key['semester_ganjil'] . " - " . $key['semester_genap'] . '</option>';
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3  col-md-6">
                                    <label for="guru" class="form-label">Wali Kelas</label>
                                    <select class="form-select" id="guru" name="guru">
                                        <option value=""> - </option>
                                        <?php
                                        if (!empty($wakel)) {
                                            // Ambil semua NIP wali kelas dari array $kelas
                                            $waliKelasNips = !empty($kelas) ? array_column($kelas, 'wali_kelas') : [];

                                            foreach ($wakel as $wakelItem) {
                                                if ($wakelItem['nip'] == $guru) {
                                                    echo '<option value="' . htmlspecialchars($wakelItem['nip']) . '"selected>' . htmlspecialchars($wakelItem['nama_guru']) . ' (' . htmlspecialchars($wakelItem['nip']) . ')</option>';
                                                } elseif (!in_array($wakelItem['nip'], $waliKelasNips)) {
                                                    echo '<option value="' . htmlspecialchars($wakelItem['nip']) . '">' . htmlspecialchars($wakelItem['nama_guru']) . ' (' . htmlspecialchars($wakelItem['nip']) . ')</option>';
                                                }
                                            }
                                        }
                                        ?>


                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <select class="form-select" id="jurusan" name="jurusan">
                                        <option value="" disabled selected> Pilih Jurusan Kelas </option>
                                        <?php
                                        foreach ($jurusan as $key) {
                                            $selected = "";
                                            if ($key['id_jurusan'] == $id_jurusan) {
                                                $selected = "selected";
                                            }
                                            echo '<option value="' . $key['id_jurusan'] . '"' . $selected . '>' . $key['nama_jurusan'] . '</option>';
                                        }
                                        ?>


                                    </select>
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