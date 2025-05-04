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



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="header-title">Data Wali Kelas</h4>
                            </div>

                            <div class="col-12 row align-items-center">
                                <form action="" method="get" class="col-auto">
                                    <div class="input-group">
                                        <select class="form-select" id="tahun" name="tahun">
                                            <?php
                                            $sql_tahun = tampil("SELECT * FROM `tbl_tahun_ajaran` ORDER BY simbol_tahun_ajaran ASC");
                                            foreach ($sql_tahun as $key) {
                                                if (isset($_GET['tahun'])) {
                                                $selected = ($key['id_tahun_ajaran'] == $_GET['tahun']) ? 'selected' : '';
                                                }else {
                                                $selected = ($key['status'] == "Active") ? 'selected' : '';
                                                }
                                                echo '<option value="' . $key['id_tahun_ajaran'] . '" ' . $selected . '> Kelas ' . $key['semester_ganjil'] . ' - ' . $key['semester_genap'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <button type="submit" class="btn btn-primary"  name="inc" value="wali_kelas">Ubah</button>
                                    </div>
                                </form>

                                <div class="btn-group col-auto ms-auto mb-2">
                                    <a href="?inc=wali_kelas&aksi=add" class="btn btn-success">Tambah Wali Kelas</a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane show active" id="alt-pagination-preview">
                                <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kelas</th>
                                            <th>Nama Wali Kelas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php
                                        // $sql_tahun_ajar = tampil("SELECT id_tahun_ajaran FROM tbl_tahun_ajaran WHERE status = 'Active';");
                                        // $sql_tahun_ajar = $sql_tahun_ajar[0]["id_tahun_ajaran"];
                                        $tahun_ajar;
                                        if (isset($_GET['tahun'])) {
                                            $tahun_ajar = "tbl_tahun_ajaran.id_tahun_ajaran = '".$_GET['tahun']."'";
                                        }else {
                                            $tahun_ajar = "tbl_tahun_ajaran.status = 'Active'";
                                        }

                                        $sql_wali_kelas = "SELECT tbl_wali_kelas.*,  tbl_guru.nama_guru, tbl_kelas.id_kelas, CONCAT( tbl_kelas.tingkat, ' - ', tbl_jurusan.simbol_jur, ' ( ', tbl_tahun_ajaran.semester_ganjil, ' - ', tbl_tahun_ajaran.semester_genap, ' ) ' ) AS nama_kelas FROM tbl_wali_kelas LEFT JOIN tbl_guru ON tbl_wali_kelas.wali_kelas = tbl_guru.nip LEFT JOIN tbl_kelas ON tbl_wali_kelas.id_kelas = tbl_kelas.id_kelas LEFT JOIN tbl_jurusan ON tbl_kelas.jurusan = tbl_jurusan.id_jurusan LEFT JOIN tbl_tahun_ajaran ON tbl_wali_kelas.id_tahun_ajaran = tbl_tahun_ajaran.id_tahun_ajaran WHERE $tahun_ajar ORDER BY nama_kelas ASC"; // sql untuk tampil


                                        $tampil = tampil($sql_wali_kelas); // panggil tampil sesuai sql
                                        $no = 1;
                                        foreach ($tampil as $user) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $user['nama_kelas']; ?></td>
                                                <td><?= $user['nama_guru'] ." ( ". $user['wali_kelas']." )"; ?></td>
                                                <td>
                                                    <div class="dropdown text-center">
                                                        <a href="" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="?inc=wali_kelas&aksi=edit&id=<?= $user['id_kelas'] ?>">Edit</a>
                                                            <a class="dropdown-item" href="?inc=wali_kelas&aksi=delete&id=<?= $user['id_kelas'] ?>">Delete</a>
                                                            <a class="dropdown-item" href="?inc=wali_kelas&aksi=view&id=<?= $user['id_kelas'] ?>">View</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div> <!-- end preview-->

                        </div> <!-- end tab-content-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->


    </div> <!-- container -->

</div> <!-- content -->