<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

$dataPreview = [];
$sheetNames = [];
$selectedSheetIndex = 0;

$kelas = tampil("SELECT `tbl_kelas`.*, `tbl_jurusan`.*, `tbl_tahun_ajaran`.* FROM `tbl_kelas` 	LEFT JOIN `tbl_jurusan` ON `tbl_kelas`.`jurusan` = `tbl_jurusan`.`id_jurusan` 	LEFT JOIN `tbl_tahun_ajaran` ON `tbl_kelas`.`id_tahun_ajaran` = `tbl_tahun_ajaran`.`id_tahun_ajaran` WHERE tbl_tahun_ajaran.status = 'Active' ORDER BY tbl_jurusan.simbol_jur ASC, tbl_kelas.tingkat ASC"); // sql untuk tampil

if (isset($_POST['upload'])) {
    if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {
        $fileName = $_FILES['excel_file']['name'];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

        // Buat nama unik dan simpan file ke folder uploads/tmp/
        $uniqueName = uniqid('excel_', true) . '.' . $fileExt;
        $savePath = __DIR__ . '/../../assets/uploads/tmp/' . $uniqueName;

        if (!is_dir(__DIR__ . '/../../assets/uploads/tmp/')) {
            mkdir(__DIR__ . '/../../assets/uploads/tmp/', 0777, true);
        }

        move_uploaded_file($_FILES['excel_file']['tmp_name'], $savePath);

        // Load dari file yang sudah disimpan
        $spreadsheet = IOFactory::load($savePath);


        if (in_array($fileExt, ['xlsx', 'xls'])) {
            try {
                $spreadsheet = IOFactory::load($savePath);
                $sheetNames = $spreadsheet->getSheetNames();

                // Sheet aktif pertama
                $sheetIndex = 0;
                if (isset($_POST['sheet_index'])) {
                    $selectedSheetIndex = $sheetIndex;

                    $sheetIndex = (int) $_POST['sheet_index'];
                }

                $sheet = $spreadsheet->getSheet($sheetIndex);
                $dataPreview = $sheet->toArray();
            } catch (Exception $e) {
                $error = "Gagal membaca file Excel: " . $e->getMessage();
            }
        } else {
            $error = "Format file tidak didukung!";
        }
    } else {
        $error = "Gagal mengupload file!";
    }
}


if (isset($_POST['sheet_index']) && isset($_POST['uploaded_file'])) {
    $tmpFilePath = $_POST['uploaded_file'];

    try {
        $spreadsheet = IOFactory::load($_POST['uploaded_file']);
        $sheetNames = $spreadsheet->getSheetNames();

        $selectedSheetIndex = (int) $_POST['sheet_index'];
        $sheet = $spreadsheet->getSheet($selectedSheetIndex);
        $dataPreview = $sheet->toArray();
    } catch (Exception $e) {
        $error = "Gagal membaca ulang file: " . $e->getMessage();
    }
}

if (isset($_POST['import'])) {
    include "proses_import.php";
}


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

<?php
if (isset($_POST['import'])) {
    include "proses_import.php";
}


?>

        <div class="row">
            <div class="col-12 row">
                <div class="card mb-3 col-12">
                    <div class="card-body">
                        <h4 class="header-title">Import Excel</h4>

                        <div class="row g-2">

                            <div class="row g-2">


                                <!-- KIRI: Upload Excel dan Sheet -->
                                <div class="col-md-6">
                                    <form method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="uploaded_file" value="<?= htmlspecialchars($savePath ?? ($_POST['uploaded_file'] ?? '')) ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Upload File Excel (.xlsx / .xls)</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="excel_file" accept=".xlsx,.xls" required>
                                                <button class="btn btn-dark" type="submit" name="upload">Upload</button>
                                            </div>
                                        </div>

                                        <?php if (!empty($sheetNames)) : ?>
                                            <div class="mb-3">
                                                <label class="form-label">Pilih Sheet</label>
                                                <select class="form-select" name="sheet_index" onchange="this.form.submit()">
                                                    <?php foreach ($sheetNames as $index => $name) : ?>
                                                        <option value="<?= $index ?>" <?= ($index == $selectedSheetIndex) ? 'selected' : '' ?>>
                                                            <?= htmlspecialchars($name) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        <?php endif; ?>
                                    </form>
                                </div>

                                <!-- KANAN: Download + Kelas + Tombol Import -->
                                <div class="col-md-6">
                                    <label class="form-label">Contoh Format Excel</label>
                                    <div class="mb-3">
                                        <a href="../assets/contoh_siswa.xlsx" class="btn btn-success" download>Download</a>
                                    </div>

                                    <?php if (!empty($dataPreview)) : ?>
                                        <form method="post">
                                            <div class="row">
                                                <input type="hidden" name="import" value="1">
                                                <input type="hidden" name="uploaded_file" value="<?= htmlspecialchars($_POST['uploaded_file']) ?>">
                                                <input type="hidden" name="sheet_index" value="<?= htmlspecialchars($_POST['sheet_index']?? '0') ?>">

                                                <div class="mb-3 col-9">
                                                    <label class="form-label">Pilih Kelas</label>
                                                    <select class="form-select" name="id_kelas" required>
                                                        <option value="" disabled >-- Pilih Kelas --</option>
                                                        <?php foreach ($kelas as $key) : ?>
                                                            <option value="<?= $key['id_kelas'] ?>">
                                                                <?= $key['tingkat'] . ' - ' . $key['nama_jurusan'] . ' (' . $key['simbol_jur'] . ')' ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="mb-3 col-3">
                                                    <label class="form-label">Upload Data</label>
                                                    <button class="btn btn-primary" type="submit" name="import">Jalankan</button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>



                            <hr>
                            <h5>Preview Sheet</h5>

                            <?php if (!empty($dataPreview)) : ?>
                                <?php
                                $headers = array_filter($dataPreview[0], fn($h) => $h !== null && trim($h) !== '');
                                $headerCount = count($headers);
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <?php foreach ($headers as $header): ?>
                                                    <th><?= htmlspecialchars($header) ?></th>
                                                <?php endforeach; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 1; $i < count($dataPreview); $i++): ?>
                                                <tr>
                                                    <?php for ($j = 0; $j < $headerCount; $j++): ?>
                                                        <td><?= htmlspecialchars($dataPreview[$i][$j] ?? '') ?></td>
                                                    <?php endfor; ?>
                                                </tr>
                                            <?php endfor; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-warning text-center">
                                    Tidak ada data ditampilkan.
                                </div>
                            <?php endif; ?>


                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>