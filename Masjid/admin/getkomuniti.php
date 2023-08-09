<?php

include("../connection/connection.php");

if(isset($_GET['id_komunitiList']))
{
    $id_komuniti = $_GET['id_komunitiList'];

    $sql_komuniti = "SELECT * FROM komuniti_list WHERE id_komunitiList='$id_komuniti'";
    $query_komuniti = mysqli_query($bd2,$sql_komuniti);

    $data_komuniti = mysqli_fetch_array($query_komuniti);

    $komuniti_id = $data_komuniti['id_komuniti'];

    $sql2 = "SELECT * FROM komuniti WHERE id_komuniti='$komuniti_id'";
    $sqlquery2 = mysqli_query($bd2,$sql2);
    $data2 = mysqli_fetch_array($sqlquery2);

    $daerah_id = $data_komuniti['bandar'];
    $sql_daerah = "SELECT * FROM daerah WHERE id_daerah='$daerah_id'";
    $query_daerah = mysqli_query($bd2,$sql_daerah);
    $data_daerah = mysqli_fetch_array($query_daerah);

    $negeri_id = $data_komuniti['negeri'];
    $sql_negeri = "SELECT * FROM negeri WHERE id_negeri='$negeri_id'";
    $query_negeri = mysqli_query($bd2,$sql_negeri);
    $data_negeri = mysqli_fetch_array($query_negeri);
    ?>
    <form action="admin/update_komuniti_ekonomi.php" id="komuniti_form" name="komuniti_form" class="form-horizontal form-bordered" method="POST">
        <div class="form-body">
            <div class="form-group row">
                    <div class="alert alert-info col-md-12" role="alert">
                        <div class="row">
                            <div class="col-md-12"><u>MAKLUMAT PEMOHONAN KOMUNITI</u></div><hr>
                            <div class="col-12 col-md-12" align="center"><img style="width: 300px; height: auto" class="img-fluid" src="utama.php?data=raw&action=lihat_fail&fileDB=1&file=komuniti&id_komunitiList=<?php echo($data_komuniti['id_komunitiList']); ?>"></div>
                            <div class="col-md-3" align="left">Jenis Komuniti</div><div class="col-md-1" align="left">:</div><div class="col-md-8" align="left"><?php echo $data2['komuniti']; ?></div>
                            <div class="col-md-3" align="left">Nama Perniagaan</div><div class="col-md-1" align="left">:</div><div class="col-md-8" align="left"><?php echo $data_komuniti['nama_perniagaan']; ?></div>
                            <div class="col-md-3" align="left">No Telefon</div><div class="col-md-1" align="left">:</div><div class="col-md-8" align="left"><?php echo $data_komuniti['no_telephone']; ?></div>
                            <div class="col-md-3" align="left">Alamat</div><div class="col-md-1" align="left">:</div><div class="col-md-8" align="left"><?php echo $data_komuniti['alamat']."<br>".$data_daerah['nama_daerah']."<br>".$data_negeri['name']; ?></div>
                        </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label text-right col-md-3">Respon</label>
                <div class="col-md-9">
                    <select class="form-control" required name="status">
                        <option value="" <?php echo $data_komuniti['status_approved'] == NULL ? "selected" : ""; ?>>Sila Pilih:-</option>
                        <option value="1" <?php echo $data_komuniti['status_approved'] == 1 ? "selected" : ""; ?>>LULUS PERMOHONAN</option>
                        <option value="2" <?php echo $data_komuniti['status_approved'] == 2 ? "selected" : ""; ?>>TOLAK PERMOHONAN</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12 col-md-12">
                    <label>Sebab</label>
                    <textarea oninput="this.value = this.value.toUpperCase()" class="form-control" name="sebab" rows="3"><?php echo $data_komuniti['sebab']; ?></textarea>
                </div>
            </div>
            <input type="hidden" name="id_komunitiList" value="<?php echo $id_komuniti; ?>">
            <div class="form-group row">
                <div class="col-md-4 offset-4">
                    <center>
                        <button type="submit" name="tolak_bantuan" class="btn btn-success">Respon Permohonan</button>
                    </center>
                </div>
            </div>
        </div>
    </form>
    <?php
}
?>
