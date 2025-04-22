<div id="edit-jurusan-<?= $user['id_jurusan']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Edit jurusan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="row g-2">
                    <input type="hidden" name="id" value="<?= $user['id_jurusan']; ?>" >
                        <div class="mb-3 col-md-6">
                            <label for="jurusan" class="form-label">Nama Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= $user['nama_jurusan']; ?>" placeholder="Nama Jurusan">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="jurusan2" class="form-label">Simbol Jurusan</label>
                            <input type="text" class="form-control" id="jurusan2" name="jurusan2" value="<?= $user['simbol_jur']; ?>"  placeholder="Simbol jurusan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="edit">Ubah Data</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->