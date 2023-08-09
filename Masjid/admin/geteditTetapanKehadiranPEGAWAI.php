<?php
    include('../connection/connection.php');

    $id_kehadiran = $_GET['id_kehadiran'];

    $sql_search = "SELECT id, id_masjid, id_jawatankuasa, id_clockin
                   FROM kehadiran_tetapan WHERE id = '$id_kehadiran'";
    $query = mysqli_query($bd2,$sql_search);
?>
<center>
    <div class="col-12">
        <form action="admin/edit_tetapankehadiranpegawai.php" method="POST" onSubmit="return confirm('Pastikan Maklumat Betul')">
            <div class="row">
                <?php while($row = mysqli_fetch_assoc($query)){?>
                <div class="col-12">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Jenis Kehadiran&nbsp;:</label>
                            <div class="col-md-9">
                                <select class="form-control" name="id_clockin" id="id_clockin">
                                    <option value=""></option>
                                    <option value="1" <?php if($row['id_clockin']=='1') { echo "selected"; } ?>>CHECK IN WAKTU SOLAT</option>
                                    <option value="2" <?php if($row['id_clockin']=='2') { echo "selected"; } ?>>CHECK IN NO LIMIT</option>
                                    <option value="3" <?php if($row['id_clockin']=='3') { echo "selected"; } ?>>CHECK IN WAKTU PEJABAT</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 offset-4">
                    <center>
                        <input type="hidden" name="id_kehadiran" value="<?php echo $row['id'];?>">
                        <button class="btn-success btn" type="submit" name="updateTetapan_pegawai">Kemaskini</button>
                    </center>
                </div>
                <?php }?>
            </div>
        </form>
    </div>
</center>
