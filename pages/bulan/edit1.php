<div id="edit-bulan-<?= $user['no_bulan']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Edit bulan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="row g-2">
                    <input type="hidden" name="id" value="<?= $user['id_bulan']; ?>" >
                        <div class="mb-3 col-md-6">
                            <label for="bulan" class="form-label">No. bulan</label>
                            <input type="number" class="form-control" id="bulan" name="bulan" value="<?= $user['no_bulan']; ?>" placeholder="No. bulan">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="bulan2" class="form-label">Nama bulan</label>
                            <input type="text" class="form-control" id="bulan2" name="bulan2" value="<?= $user['nama_bulan']; ?>" placeholder="Nama bulan">
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