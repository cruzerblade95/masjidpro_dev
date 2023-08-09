<?php

include('../connection/connection.php');

if(isset($_GET['id_zon']))
{
    $id_zon = $_GET['id_zon'];

    $sql_zon = "SELECT * FROM sej6x_data_zonqariah WHERE id_zonqariah='$id_zon'";
    $query_zon = mysqli_query($bd2,$sql_zon);
    $data_zon = mysqli_fetch_array($query_zon);
    ?>
    <form action="admin/edit_zon.php" id="form_editzon" name="form_editzon" class="form-horizontal form-bordered" method="POST">
        <div class="form-body">
            <div class="form-group row">
                <label class="control-label text-right col-md-6">Nama Zon</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="nama_zon" value="<?php echo $data_zon['nama_zon']; ?>" required />
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label text-right col-md-6">Nombor / Huruf / Simbol Zon</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="no_huruf" value="<?php echo $data_zon['no_huruf']; ?>" />
                </div>
            </div>
            <input type="hidden" name="id_zon" value="<?php echo $id_zon; ?>">
            <center>
                <button type="submit" name="submit_editzon" class="btn btn-success">Kemaskini</button>
            </center>
        </div>
    </form>
    <?php
}
?>
