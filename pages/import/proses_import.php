<?php
ob_start();
require_once '../inc/function.php';

// $GAMBAR = $_FILES['Photo']['tmp_name']; //tangkap data file



// var_dump($_POST);
// var_dump($_FILES);

// echo $ID . " | " . $NAMA . " | " . $EMAIL . " | " . $ROLE. " | " . $TELEPON. " | " . $PASSWORD1. " | " . $PASSWORD2. " | " . $JENKEL. " | " . $CABANG. " | ". $DOMISILI. " | " . $KTP. " | " . $NOKTP. " | " . $JABATAN. " | " . $START. " | ". $FINISH. " | " . $STATUS. " | " . $PASSWORD1. " | " . $PASSWORD2;


$result = import_kelas($_POST);

if ($result['success']) {
    $berhasil = $result['count'];
    ?>
    <div class="alert alert-success text-bg-success border-0 fade show" role="alert">
        ✅ Data <?= $berhasil ?> siswa berhasil ditambahkan.
    </div>
    <meta http-equiv="refresh" content="1.5; url=index.php?inc=siswa">
    <?php
} else {
    ?>
    <div class="alert alert-danger text-bg-danger border-0 fade show" role="alert">
        <strong>Import dibatalkan:</strong><br>
        <ul>
            <?php foreach ($result['errors'] as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php
}

?>