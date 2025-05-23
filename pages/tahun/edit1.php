<div id="edit-tahun-<?= $user['simbol']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Edit Tahun</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="row g-2">
                    <input type="hidden" name="id" value="<?= $user['id_tahun']; ?>" >
                        <div class="mb-3 col-md-6">
                            <label for="tahun" class="form-label">Tahun</label>
                            <input type="number" class="form-control" id="tahun" name="tahun" value="<?= $user['tahun']; ?>" placeholder="Tahun">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="tahun2" class="form-label">Simbol Tahun</label>
                            <input type="number" class="form-control" id="tahun2" name="tahun2" value="<?= $user['simbol']; ?>" placeholder="(max: 4 Characters)">
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