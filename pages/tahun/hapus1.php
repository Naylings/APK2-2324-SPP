<div id="hapus-tahun-<?= $user['simbol']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title" id="standard-modalLabel">Hapus Tahun</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $user['id_tahun']; ?>" ><strong>Warning - </strong> Apakah anda yakin ingin menghapus data Tahun <span style="font-weight: bold; color:red"><?php echo $user['tahun'] ?></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus Data</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->