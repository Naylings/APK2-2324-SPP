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
        if (isset($_POST['tambah'])) {
            include "proses_tambah.php";
        }
        $kelas = tampil("SELECT tbl_kelas.id_kelas, tbl_kelas.tingkat, CONCAT( tbl_jurusan.simbol_jur, ' ( ', tbl_tahun_ajaran.semester_ganjil, ' - ', tbl_tahun_ajaran.semester_genap, ' ) ' ) AS nama_kelas FROM tbl_kelas LEFT JOIN tbl_jurusan ON tbl_kelas.jurusan = tbl_jurusan.id_jurusan LEFT JOIN tbl_tahun_ajaran ON tbl_kelas.id_tahun_ajaran = tbl_tahun_ajaran.id_tahun_ajaran WHERE status ='Active' ORDER BY nama_kelas ASC,tbl_kelas.tingkat ASC");

        $wali_kelas = tampil("SELECT `tbl_wali_kelas`.`id_kelas`,`tbl_wali_kelas`.`wali_kelas` FROM `tbl_wali_kelas` LEFT JOIN tbl_tahun_ajaran ON tbl_wali_kelas.id_tahun_ajaran = tbl_tahun_ajaran.id_tahun_ajaran WHERE tbl_tahun_ajaran.status ='Active'");
        $sudah_ada_kelas = [""];
        foreach ($wali_kelas as $row) {
            $sudah_ada_kelas[] =  $row['id_kelas'];
        }
        $sudah_ada_wali = [""];
        foreach ($wali_kelas as $row) {
            $sudah_ada_wali[] =  $row['wali_kelas'] ;
        }
        $tahun = tampil("SELECT * FROM tbl_tahun_ajaran WHERE status ='Active'");
        $guru = tampil("SELECT * FROM tbl_guru  WHERE status ='Active'");


        ?>

        <div class="row">
            <div class="col-12 row">
                <div class="card mb-3 col-12">
                    <div class="card-body">
                        <h4 class="header-title">Tambah Wali Kelas</h4>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row g-2">
                                <div class="mb-3  col-md-6">
                                    <label for="kelas" class="form-label">Nama Kelas</label>
                                    <select name="kelas" class="form-select" id="kelas">
                                        <?php
                                        foreach ($kelas as $key) {
                                            if (!in_array($key['id_kelas'], $sudah_ada_kelas)) {
                                                echo '<option value="' . $key['id_kelas'] . '">' . $key['tingkat'] . ' - ' . $key['nama_kelas'] . '</option>';
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
                                            if (!in_array($key['nip'], $sudah_ada_wali)) {
                                                echo '<option value="' . $key['nip'] . '">' . $key['nama_guru'] . " ( " . $key['nip'] . " )" . '</option>';
                                            }
                                        }
                                        ?>


                                    </select>
                                    <input type="hidden" value="<?= $tahun[0]['id_tahun_ajaran'] ?>" name="tahun">
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