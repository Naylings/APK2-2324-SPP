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
if (empty($kelas_id)) {
    ?>
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="text-center">
                    <img src="../assets/images/svg/file-searching.svg" height="90" alt="File not found Image">
    
                    <h1 class="text-error mt-4">404</h1>
                    <h4 class="text-uppercase text-danger mt-3">Page Not Found</h4>
                    <p class="text-muted mt-3">Siswa Dengan Nis <?= $id ?> Tidak Ditemukan, Tolong Diisi Dengan Benar.</p>
    
                    <a class="btn btn-info mt-3" href="index.php"><i class="mdi mdi-reply"></i> Kembali</a>
                </div> <!-- end /.text-center-->
            </div> <!-- end col-->
        </div>
    <?php
        die;
    }

$tahun = tampil("SELECT `tbl_tahun_ajaran`.`simbol_tahun_ajaran` FROM `tbl_tahun_ajaran` WHERE status = 'Active'");
$kelas = tampil("SELECT tbl_kelas.id_kelas, tbl_kelas.tingkat, CONCAT( tbl_kelas.tingkat, ' ', tbl_jurusan.simbol_jur, ' ( ', tbl_tahun_ajaran.semester_ganjil, ' - ', tbl_tahun_ajaran.semester_genap, ' ) ' ) AS nama_kelas FROM tbl_kelas LEFT JOIN tbl_jurusan ON tbl_kelas.jurusan = tbl_jurusan.id_jurusan LEFT JOIN tbl_tahun_ajaran ON tbl_kelas.id_tahun_ajaran = tbl_tahun_ajaran.id_tahun_ajaran WHERE id_kelas ='$kelas_id' ");


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


        <div class="row">
            <div class="col-12 row">
                <div class="card mb-3 col-12">
                    <div class="card-body">
                        <h4 class="header-title">View Siswa</h4>
                        <div class="row align-items-center">
                            <div class="col-md-5 text-center ">
                                <div class="profile-image mb-3 "><img src="../assets/images/warga_sekolah/<?= empty($photo) ? 'user.jpg' : $photo; ?>" class="rounded-circle avatar-xl" alt="" width="70%"> </div>

                                <h4><?= $id ?></h4>
                                <h4><?= $nama ?></h4>

                                <strong><?= $status == "Active" ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' ?></strong>


                            </div>
                            <div class="table-responsive col-md-7">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" colspan="2">Data Pribadi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Nama : </strong></td>
                                            <td><?= $nama ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Telepon : </strong></td>
                                            <td><?= $telepon ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jenis Kelamin : </strong></td>
                                            <td><?= $jenkel == "L" ? 'Laki-Laki' : 'Perempuan' ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kelas : </strong></td>
                                            <td><?= $kelas[0]['nama_kelas'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Alamat Domisili : </strong></td>
                                            <td><?= $alamat ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="header-title">Pembayaran <?= $nama ?></h4>
                            </div>

                            <div class="col-12 row align-items-center">

                                <div class="btn-group col-auto ms-auto mb-2">
                                    <a href="?inc=pem&aksi=add&id=<?= $id ?>" class="btn btn-success">Atur Pembayaran</a>
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
                                            <th>Status</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php
                                        // $sql_tahun_ajar = tampil("SELECT id_tahun_ajaran FROM tbl_tahun_ajaran WHERE status = 'Active';");
                                        // $sql_tahun_ajar = $sql_tahun_ajar[0]["id_tahun_ajaran"];
                                        $tahun_ajar;
                                        if (isset($_GET['tahun'])) {
                                            $tahun_ajar = "tbl_tahun_ajaran.id_tahun_ajaran = '" . $_GET['tahun'] . "'";
                                        } else {
                                            $tahun_ajar = "tbl_tahun_ajaran.status = 'Active'";
                                        }

                                        $sql_pembayaran = "SELECT  tbl_pembayaran.*,   CONCAT( tbl_jenis_pembayaran.nama_jenis, ' ',  IFNULL(tbl_bulan.nama_bulan, '-'), ' ( ',  tbl_tahun_ajaran.semester_ganjil, ' - ',  tbl_tahun_ajaran.semester_genap, ' )' ) AS nama_pembayaran FROM  tbl_pembayaran LEFT JOIN  tbl_jenis_pembayaran ON tbl_pembayaran.id_jenis = tbl_jenis_pembayaran.id_jenis LEFT JOIN  tbl_bulan ON tbl_pembayaran.id_bulan = tbl_bulan.id_bulan LEFT JOIN  tbl_tahun_ajaran ON tbl_jenis_pembayaran.id_tahun_ajaran = tbl_tahun_ajaran.id_tahun_ajaran WHERE  tbl_pembayaran.nis = '3334000001' ORDER BY
    tbl_pembayaran.status ASC,                             
    CASE WHEN tbl_pembayaran.id_bulan IS NULL THEN 0 ELSE 1 END ASC, 
    tbl_jenis_pembayaran.nama_jenis ASC,
    tbl_bulan.no_bulan ASC";

                                        $tampil = tampil($sql_pembayaran); // panggil tampil sesuai sql
                                        $no = 1;
                                        foreach ($tampil as $user) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $user['nama_pembayaran']; ?></td>
                                                <td><?= ($user['status'] == 1) ? 'Lunas' : 'Belum Lunas'; ?></td>
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


    </div>
</div>