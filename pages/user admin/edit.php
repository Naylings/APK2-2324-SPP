<?php
$id = $_GET['id'];

// cari role user

// cari data berdasarkan id dari form edit
$sql = "SELECT `tbl_auth`.*, `tbl_user`.* FROM `tbl_auth`  LEFT JOIN `tbl_user` ON `tbl_user`.`auth_id` = `tbl_auth`.`auth_id` WHERE tbl_user.id_user='$id'";

$edit = mysqli_query($KONEKSI, $sql);
while ($row = mysqli_fetch_assoc($edit)) {
    $id_user = $row['id_user'];
    $nama = $row['nama_user'];
    $email = $row['email'];
    $telepon = $row['telepon_user'];
    $photo = $row['path_photo'];
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
                            <li class="breadcrumb-item active">Settings</li>
                            <li class="breadcrumb-item "><a href="<?= $_SERVER['PHP_SELF'] . "?inc=" . $_GET['inc']; ?>">User</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">User Admin</h4>
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
                        <h4 class="header-title">Edit User Admin</h4>
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="kode" value="<?= $id_user ?>">
                            <input type="hidden" name="role" value="0">
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $nama ?>" placeholder="Nama Admin">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" readonly name="email" value="<?= $email ?>" placeholder="Email Admin">
                                </div>
                            </div>


                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="Photo" class="form-label ">Upload Foto</label>
                                    <input type="hidden" class="form-control" name="photo_db" value="<?php echo $photo; ?>">
                                    <input type="file" id="Photo" name="Photo" class="form-control mb-3">
                                    <img src="../assets/images/users/<?= empty($photo) ? 'user.jpg' : $photo; ?>" class=" avatar-xl rounded-circle" width="150px" alt="">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="kontak" class="form-label">Telepon</label>
                                    <input type="number" class="form-control" id="kontak" name="telepon" value="<?= $telepon ?>" placeholder="Telepon Admin">
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary" name="edit">Update</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>