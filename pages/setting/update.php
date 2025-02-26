<?php

$NAMA = htmlspecialchars($_POST["name"]);
$EMAIL = htmlspecialchars($_POST["email"]);
$KONTAK = htmlspecialchars($_POST["kontak"]);
$ALAMAT = htmlspecialchars($_POST["alamat"]);

// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2;


if (empty($NAMA) || empty($EMAIL)||empty($KONTAK) || empty($ALAMAT)) {
    // echo "<pre>";
    // print_r($data); // melihat data yang akan diterima
    // print_r($file); // melihat file yang akan diterima
    // echo "</pre>";

?>
    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Error - </strong> Tidak Ada Data Yang Diubah.
    </div>
<?php
} else {
    if (update_sekolah($_POST) > 0) {
    ?>

        <div class="alert alert-success  text-bg-success border-0 fade show" role="alert">
            Data Berhasil Ditambahkan
        </div> Data Berhasil Diubah
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=setting">
    <?php
    } else {
    ?>
        <div class="alert alert-danger  text-bg-danger border-0 fade show" role="alert">
            <strong>Error - </strong> Data Gagal Ditambahkan!!!
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?inc=setting">
<?php
    }
    echo '<meta http-equiv="refresh" content="1; url=index.php?inc=setting">';
}

?>