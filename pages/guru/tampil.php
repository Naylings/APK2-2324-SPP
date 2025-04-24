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
                            <li class="breadcrumb-item "><a href="<?= $_SERVER['PHP_SELF'] . "?inc=" . $_GET['inc']; ?>">Guru</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Guru</h4>
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
                                <h4 class="header-title"> Data Guru</h4>
                            </div>
                            <div class="col-auto ms-auto">
                                <div class="btn-group mb-2 ">
                                    <a role="button" href="?inc=guru&aksi=add" class="btn btn-success">Tambah Guru</a>
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
                                            <th>No</th>
                                            <th>Photo</th>
                                            <th>NIP</th>
                                            <th>Nama Guru</th>
                                            <th>Telepon</th>
                                            <th>Status Guru</th>
                                            <th>Work Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php


                                        $sql_guru = "SELECT * FROM `tbl_guru`  ORDER BY nip ASC "; // sql untuk tampil

                                        $tampil = tampil($sql_guru); // panggil tampil sesuai sql
                                        $no = 1;
                                        foreach ($tampil as $user) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td class="table-user">
                                                    <img src="../assets/images/warga_sekolah/<?= empty($user['path_photo']) ? 'user.jpg' : $user['path_photo']; ?>" alt="table-user" class="me-2 rounded-circle">
                                                </td>
                                                <td><?= $user['nip']; ?></td>
                                                <td><?= $user['nama_guru']; ?></td>
                                                <td><?= $user['telepon_guru']; ?></td>
                                                <td><?= $user['status']; ?></td>
                                                <td><?= $user['date_start'] . " - " . $user['date_finish']; ?></td>
                                                <td>
                                                    <div class="dropdown text-center">
                                                        <a href="" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="?inc=guru&aksi=edit&id=<?= $user['nip'] ?>">Edit</a>
                                                            <a class="dropdown-item" href="?inc=guru&aksi=delete&id=<?= $user['nip'] ?>">Delete</a>
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