<div id="edit-tahun_ajaran-<?= $user['simbol_tahun_ajaran']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Edit Tahun Ajaran</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="row g-2">
                        <input type="hidden" name="id" value="<?= $user['id_tahun_ajaran']; ?>">
                        <div class="mb-3 col-md-5">

                            <label for="tahun" class="form-label">Tahun Semester Ganjil</label>
                            <select class="form-select" id="tahun" name="tahun">
                                <?php
                                $yearlist = tampil("SELECT semester_ganjil FROM tbl_tahun_ajaran WHERE semester_ganjil != '" . $user['semester_ganjil'] . "'");

                                $usedyearList = [];

                                foreach ($yearlist as $row) {
                                    $usedyearList[] = "'" . $row['semester_ganjil'] . "'";
                                }

                                if (count($usedyearList) > 0) {
                                    $tahun_ganjil2 = implode(", ", $usedyearList);
                                    $tahun1 = tampil("SELECT * FROM tbl_tahun WHERE tahun NOT IN ($tahun_ganjil2) ORDER BY tahun ASC");
                                } else {
                                    // Jika tabel kosong, maka tampilkan semua tahun
                                    $tahun1 = tampil("SELECT * FROM tbl_tahun ORDER BY tahun ASC");
                                }
                                $selected = "";

                                foreach ($tahun1 as $key) :
                                    if ($user['semester_ganjil'] == $key['tahun']) {
                                        $selected = "selected";
                                    }
                                ?>
                                    <option value="<?= $key['id_tahun'] ?>" <?= $selected ?>><?= $key['tahun'] ?></option>
                                <?php
                                    $selected = "";
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="mb-3 col-md-5">
                            <label for="tahun2" class="form-label">Tahun Semester Genap</label>
                            <select class="form-select" id="tahun2" name="tahun2">
                                <?php
                                $yearlist = tampil("SELECT semester_genap FROM tbl_tahun_ajaran WHERE semester_genap != '" . $user['semester_genap'] . "'");

                                $usedyearList = [];

                                foreach ($yearlist as $row) {
                                    $usedyearList[] = "'" . $row['semester_genap'] . "'";
                                }

                                if (count($usedyearList) > 0) {
                                    $tahun_ganjil2 = implode(", ", $usedyearList);
                                    $tahun1 = tampil("SELECT * FROM tbl_tahun WHERE tahun NOT IN ($tahun_ganjil2) ORDER BY tahun ASC");
                                } else {
                                    // Jika tabel kosong, maka tampilkan semua tahun
                                    $tahun1 = tampil("SELECT * FROM tbl_tahun ORDER BY tahun ASC");
                                }

                                $selected = "";
                                foreach ($tahun1 as $key) :
                                    if ($user['semester_genap'] == $key['tahun']) {
                                        $selected = "selected";
                                    }
                                ?>
                                    <option value="<?= $key['id_tahun'] ?>" <?= $selected ?>><?= $key['tahun'] ?></option>
                                <?php
                                    $selected = "";
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="mb-3 col-md-2">
                            <label for="customSwitch1" class="form-label">Aktif</label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="status" value="Inactive">
                                <input type="checkbox" class="form-check-input" id="customSwitch1" name="status" value="Active"
                                    <?= $user['status'] == 'Active' ? 'checked' : ''; ?>>
                            </div>

                        </div>

                    </div>
                    <div class="row g-2">
                        <div class="mb-3 col-md-6">
                            <label for="start" class="form-label">Tanggal mulai</label>
                            <input type="date" class="form-control" name="start" value="<?= $user['tgl_start'] ?>" id="start">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="finish" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" name="finish" value="<?= $user['tgl_finish'] ?>" id="finish">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="edit">Tambah Data</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->