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
        if (isset($_POST['tambah'])) {
            include "proses_tambah.php";
        }
        $tahun = tampil("SELECT * FROM tbl_tahun_ajaran WHERE status ='Active'");


        $jurusan = tampil("SELECT * FROM tbl_jurusan");
        ?>

        <div class="row">
            <div class="col-12 row">
                <div class="card mb-3 col-12">
                    <div class="card-body">
                        <h4 class="header-title">Tambah Kelas</h4>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row g-2">
                                <div class="mb-3  col-md-6">
                                    <label for="tingkat" class="form-label">Tingkatan Kelas</label>
                                    <select name="tingkat" class="form-select" id="tingkat">
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="mb-3  col-md-6">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <select class="form-select" id="jurusan" name="jurusan">
                                        <option value="" disabled selected> Pilih Jurusan Kelas </option>
                                        <?php
                                        foreach ($jurusan as $key) {
                                            echo '<option value="' . $key['id_jurusan'] . '">'  . $key['nama_jurusan'] . '</option>';
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