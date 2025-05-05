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



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="header-title">Data Jenis Pembayaran</h4>
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
                                                echo '<option value="' . $key['id_tahun_ajaran'] . '" ' . $selected . '> Pembayaran ' . $key['semester_ganjil'] . ' - ' . $key['semester_genap'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <button type="submit" class="btn btn-primary"  name="inc" value="jenis_pem">Ubah</button>
                                    </div>
                                </form>

                                <div class="btn-group col-auto ms-auto mb-2">
                                    <a href="?inc=jenis_pem&aksi=add" class="btn btn-success">Tambah Jenis Pembayaran</a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane show active" id="alt-pagination-preview">
                                <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pembayaran</th>
                                            <th>Jumlah Tunai</th>
                                            <th>Tipe</th>
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

                                        $sql_jenis_pembayaran = " SELECT `tbl_jenis_pembayaran`.*, `tbl_tahun_ajaran`.* FROM `tbl_jenis_pembayaran` LEFT JOIN `tbl_tahun_ajaran` ON `tbl_jenis_pembayaran`.`id_tahun_ajaran` = `tbl_tahun_ajaran`.`id_tahun_ajaran` WHERE $tahun_ajar ORDER BY nama_jenis ASC"; // sql untuk tampil


                                        $tampil = tampil($sql_jenis_pembayaran); // panggil tampil sesuai sql
                                        $no = 1;
                                        foreach ($tampil as $user) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $user['nama_jenis'] ." ( ". $user['semester_ganjil']." - ". $user['semester_genap']." )"; ?></td>
                                                <td>Rp<?= number_format($user['tunai'], 2, ',', '.'); ?></td>
                                                <td><?= ($user['bulanan'] == 1) ? 'Bulanan' : '1x Pembayaran'; ?></td>
                                                <td>
                                                    <div class="dropdown text-center">
                                                        <a href="" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="?inc=jenis_pem&aksi=edit&id=<?= $user['id_jenis'] ?>">Edit</a>
                                                            <a class="dropdown-item" href="?inc=jenis_pem&aksi=delete&id=<?= $user['id_jenis'] ?>">Delete</a>
                                                            <a class="dropdown-item" href="?inc=jenis_pem&aksi=view&id=<?= $user['id_jenis'] ?>">View</a>
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