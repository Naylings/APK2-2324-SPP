<div id="tambah-tahun_ajaran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Tambah Tahun Ajaran</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="mb-3 col-md-6">

                            <label for="tahun" class="form-label">Tahun Semester Ganjil</label>
                            <select class="form-select" id="tahun" name="tahun">
                                <?php
                                $yearlist = tampil("SELECT semester_ganjil FROM tbl_tahun_ajaran ");

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

                                foreach ($tahun1 as $key) :
                                ?>
                                    <option value="<?= $key['id_tahun'] ?>"><?= $key['tahun'] ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="tahun2" class="form-label">Tahun Semester Genap</label>
                            <select class="form-select" id="tahun2" name="tahun2">
                                <?php
                                $yearlist = tampil("SELECT semester_genap FROM tbl_tahun_ajaran ");

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

                                foreach ($tahun1 as $key) :
                                ?>
                                    <option value="<?= $key['id_tahun'] ?>"><?= $key['tahun'] ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->