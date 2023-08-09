<?php

include('../connection/connection.php');

if(isset($_GET['id_jawatan'])){
    $id_jawatan = $_GET['id_jawatan'];

    $sql_jawatan = "SELECT * FROM jawatan_pengurusan_masjid WHERE id_jawatan='$id_jawatan'";
    $query_jawatan = mysqli_query($bd2,$sql_jawatan);
    //mysqli_num_rows($query_jawatan);
    $data_jawatan = mysqli_fetch_array($query_jawatan);


?>
<div class="form-body">
    <form action="admin/update_jawatan_pengurusan.php" method="POST">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 offset-4">
                    <div class="form-group">
                        <label>Jawatan</label>
                        <input type="text" name="jawatan" class="form-control" required value="<?php echo $data_jawatan['jawatan']; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 offset-4">
                    <center>
                        <input type="hidden" id="id_jawatan" name="id_jawatan" value="<?php echo $id_jawatan; ?>">
                        <button type="submit" name="submit" class="btn btn-success">Kemaskini Jawatan</button>
                    </center>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
}
?>