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



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <h4 class="header-title"> Data Siswa</h4>
                            </div>
                            <div class="col-auto ms-auto">
                                <div class="btn-group mb-2 ">
                                    <a role="button" href="?inc=siswa&aksi=add" class="btn btn-success">Tambah Siswa</a>
                                    <!-- <button type="button" class="btn btn-warning">Warning</button>
                                    <button type="button" class="btn btn-danger">Danger</button> -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="alt-pagination-preview">
                                <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>NIS</th>
                                            <th>Photo</th>
                                            <th>Nama Siswa</th>
                                            <th>Telepon</th>
                                            <th>Status Siswa</th>
                                            <th>Kelas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php

                                        $sql_kelas = tampil("SELECT `tbl_kelas`.*, `tbl_jurusan`.*, `tbl_guru`.*, `tbl_tahun_ajaran`.* FROM `tbl_kelas` 	LEFT JOIN `tbl_jurusan` ON `tbl_kelas`.`jurusan` = `tbl_jurusan`.`id_jurusan` 	LEFT JOIN `tbl_guru` ON `tbl_kelas`.`wali_kelas` = `tbl_guru`.`nip` 	LEFT JOIN `tbl_tahun_ajaran` ON `tbl_kelas`.`id_tahun_ajaran` = `tbl_tahun_ajaran`.`id_tahun_ajaran`");

                                        $sql_siswa = "SELECT * FROM `tbl_siswa`  "; // sql untuk tampil

                                        $tampil = tampil($sql_siswa); // panggil tampil sesuai sql
                                        $no = 1;
                                        foreach ($tampil as $user) :
                                        ?>
                                            <tr>
                                                <td><?= $user['nis']; ?></td>
                                                <td class="table-user">
                                                    <img src="../assets/images/warga_sekolah/<?= empty($user['path_photo']) ? 'user.jpg' : $user['path_photo']; ?>" alt="table-user" class="me-2 rounded-circle">
                                                </td>
                                                <td><?= $user['nama_siswa']; ?></td>
                                                <td><?= $user['telepon_siswa']; ?></td>
                                                <td><?= $user['status']; ?></td>
                                                <td>
                                                    <?php
                                                    $output = " - "; // Default tampilan

                                                    foreach ($sql_kelas as $key) {
                                                        if ($user['id_kelas'] == $key['id_kelas']) {
                                                            $output = $key['tingkat'] . " - " . $key['simbol_jur'];
                                                            break;
                                                        }
                                                    }

                                                    echo $output;
                                                    ?>

                                                </td>
                                                <td>
                                                    <div class="dropdown text-center">
                                                        <a href="" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="?inc=siswa&aksi=edit&id=<?= $user['nis'] ?>">Edit</a>
                                                            <a class="dropdown-item" href="?inc=siswa&aksi=delete&id=<?= $user['nis'] ?>">Delete</a>
                                                            <a class="dropdown-item" href="#">View</a>
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