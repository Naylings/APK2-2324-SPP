<?php
// ob_start();
// require_once '../inc/function.php';

$ID = htmlspecialchars($_POST["id"]);
$SEKALI = isset($_POST["data_pembayaran"]) ? array_map('htmlspecialchars', $_POST["data_pembayaran"]) : [];
$BULANAN = isset($_POST["data_pembayaran_bulan"]) ? array_map('htmlspecialchars', $_POST["data_pembayaran_bulan"]) : [];
// $selectedFacilities = $_POST['fasilitas'] ?? [];
// foreach ($selectedFacilities as $facility) {
//     // Proses setiap fasilitas
// }


// $GAMBAR = $_FILES['Photo']['tmp_name']; //tangkap data file

// var_dump($_POST);
// var_dump($_FILES);

// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2;



    if (tambah_pembayaran($_POST) > 0) {
    ?>

        <div class="alert alert-success  text-bg-success border-0 fade show" role="alert">
            Data Berhasil Ditambahkan
        </div> Data Berhasil Diubah
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=siswa&aksi=view&id=<?= $_GET['id']?>">
    <?php
    } else {
    ?>
        <div class="alert alert-danger  text-bg-danger border-0 fade show" role="alert">
            <strong>Error - </strong> Data Gagal Ditambahkan!!!
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=siswa&aksi=view&id=<?= $_GET['id']?>">
<?php
    }
    echo '<meta http-equiv="refresh" content="1; url=index.php?inc=siswa&aksi=view&id=' . $_GET['id'].'">';


?>