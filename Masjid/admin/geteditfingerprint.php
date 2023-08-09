<?php

include('../connection/connection.php');

if(isset($_GET['id_pegawai']))
{
    $id_pegawai = $_GET['id_pegawai'];

    $sql_fingerprint = "SELECT * FROM data_pegawai_masjid WHERE id_datapegawai='$id_pegawai'";
    $query_fingerprint = mysqli_query($bd2,$sql_fingerprint);
    $data_fingerprint = mysqli_fetch_array($query_fingerprint);
    ?>
    <form action="admin/edit_fingerprint.php" id="form_editfingerprint" name="form_editfingerprint" class="form-horizontal form-bordered" method="POST">
        <div class="form-body">
            <div class="form-group row">
                <label class="control-label text-right col-md-3 offset-3">ID Fingerprint</label>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="id_fingerprint" min="1" value="<?php echo $data_fingerprint['id_fingerprint']; ?>" required />
                </div>
            </div>
            <input type="hidden" name="id_pegawai" value="<?php echo $id_pegawai; ?>">
            <center>
                <button type="submit" name="submit_editfingerprint" class="btn btn-success">Kemaskini</button>
            </center>
        </div>
    </form>
    <?php
}
?>
