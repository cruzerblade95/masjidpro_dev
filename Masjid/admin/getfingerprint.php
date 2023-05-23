<?php
if(isset($_GET['id_pegawai']))
{
    $id_pegawai = $_GET['id_pegawai'];

    ?>
    <form action="admin/add_fingerprint.php" id="form_fingerprint" name="form_fingerprint" class="form-horizontal form-bordered" method="POST">
        <div class="form-body">
            <div class="form-group row">
                <label class="control-label text-right col-md-3 offset-3">Masukkan ID Fingerprint</label>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="id_fingerprint" min="1" required/>
                </div>
            </div>
            <input type="hidden" name="id_pegawai" value="<?php echo $id_pegawai; ?>">
            <center>
                <button type="submit" name="submit_fingerprint" class="btn btn-success">Simpan</button>
            </center>
        </div>
    </form>
    <?php
}
?>
