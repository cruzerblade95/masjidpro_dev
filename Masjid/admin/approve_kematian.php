<?php

include("connection/connection.php");

$sql_search="SELECT * FROM data_kematian WHERE id_masjid='$id_masjid' AND approved=0 ORDER BY tarikh_kematian DESC";
$result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
$row=mysqli_num_rows($result);
?>
<!--script src="js/jquery-3.4.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script-->

<script>
    $(document).ready(function() {
        $('#table_display').DataTable();
    } );
</script>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Kelulusan Kematian</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Kelulusan Kematian</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Maklumat Permohonan Kematian&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th width="5%"><div align="center">No</div></th>
                                <th><div align="center">No K/P</div></th>
                                <th><div align="center">No Sijil</div></th>
                                <th><div align="center">Tarikh Kematian</div></th>
                                <th><div align="center">Waktu Kematian</div></th>
                                <th><div align="center">No Telefon Waris</div></th>
                                <th><div align="center">No K/P Waris</div></th>
                                <th><div align="center">Tindakan</div></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($row==0)
                            {
                                ?>
                                <tr>
                                    <td colspan="9" align="center">*Tiada Rekod*</td>
                                </tr>
                                <?php
                            }
                            else if($row>0)
                            {
                                $x=1;
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    if($row['no_ic']!=NULL) {
                                        $no_ic = $row['no_ic'];
                                    }
                                    else if($row['id_data']!=NULL){
                                        $id_data = $row['id_data'];

                                        $sql1 = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_data'";
                                        $sqlquery1 = mysqli_query($bd2, $sql1);
                                        $data1 = mysqli_fetch_array($sqlquery1);

                                        $no_ic = $data1['no_ic'];
                                    }
                                    else if($row['id_anak']!=NULL){
                                        $id_anak = $row['id_anak'];

                                        $sql1 = "SELECT * FROM sej6x_data_anakqariah WHERE ID='$id_anak'";
                                        $sqlquery1 = mysqli_query($bd2,$sql1);
                                        $data1 = mysqli_fetch_array($sqlquery1);

                                        $no_ic = $data1['no_ic'];
                                    }
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $x; ?></td>
                                        <td align="center"><?php echo $no_ic; ?></td>
                                        <td align="center"><?php echo $row['no_sijil']; ?></td>
                                        <td align="center"><?php echo $row['tarikh_kematian']; ?></td>
                                        <td align="center"><?php echo $row['waktu_kematian']; ?></td>
                                        <td align="center"><?php echo $row['no_tel_waris']; ?></td>
                                        <td align="center"><?php echo $row['no_ic_pelapor']; ?></td>
                                        <td align="center">
                                            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modalKematian<?php echo $row['id_kematian']; ?>">Respon</button>
                                        </td>
                                    </tr>
                                    <?php
                                    $x++;
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<?php
$sql_search1="SELECT * FROM data_kematian WHERE id_masjid='$id_masjid' AND approved=0 ORDER BY tarikh_kematian DESC";
$result1 = mysqli_query($bd2, $sql_search1) or die ("Error :".mysqli_error($bd2));
while($row1 = mysqli_fetch_assoc($result1))
{
    if($row1['no_ic']!=NULL) {
        $no_ic = $row1['no_ic'];
    }
    else if($row1['id_data']!=NULL){
        $id_data = $row1['id_data'];

        $sql1 = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_data'";
        $sqlquery1 = mysqli_query($bd2, $sql1);
        $data1 = mysqli_fetch_array($sqlquery1);

        $no_ic = $data1['no_ic'];
    }
    else if($row1['id_anak']!=NULL){
        $id_anak = $row1['id_anak'];

        $sql1 = "SELECT * FROM sej6x_data_anakqariah WHERE ID='$id_anak'";
        $sqlquery1 = mysqli_query($bd2,$sql1);
        $data1 = mysqli_fetch_array($sqlquery1);

        $no_ic = $data1['no_ic'];
    }
?>
<div class="modal fade" id="modalKematian<?php echo $row1['id_kematian']; ?>" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form id="form_kematian<?php echo $row1['id_kematian']; ?>" name="form_kematian<?php echo $row1['id_kematian']; ?>" method="post" enctype="multipart/form-data" action="admin/add_approve_kematian.php">
            <div class="modal-header">
                <h5 class="modal-title" id="alasanPadamLabel">Status Kelulusan Kematian Bagi <?php echo $no_ic; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row form-group">
                        <div class="col-md-12 col-12">
                            <label>Status:</label>
                            <select required id="status" name="status" class="form-control" onChange="displayLulus<?php echo $row1['id_kematian'] ?>(this.value)">
                                <option value=""></option>
                                <option value="1">DILULUSKAN</option>
                                <option value="2">TIDAK DILULUSKAN</option>
                            </select>
                        </div>
                    </div>
                    <div id="div_lulus" style="display:none">
                        <div class="row form-group">
                            <div class="col-md-12 col-12">
                                <label>Waktu Dikebumikan:</label>
                                <input type="time" id="waktu_dikebumikan" name="waktu_dikebumikan" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 col-12">
                                <label>Tarikh Dikebumikan:</label>
                                <input type="date" id="tarikh_dikebumikan" name="tarikh_dikebumikan" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 col-12">
                                <label>Waktu Solat Jenazah:</label>
                                <input type="time" id="waktu_solatJenazah" name="waktu_solatJenazah" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="lain row form-group">
                        <div class="col-md-12 col-12">
                            <label>Remark</label>
                            <textarea placeholder="Lain-lain maklumat" name="remark" id="remark" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div id="div_noti" >
                    <div class="row form-group">
                        <div class="col-md-12 col-12">
                            <label>Hantar Notifikasi</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="send_noti" name="send_noti" class="custom-control-input" value="1">
                                <label class="custom-control-label" for="send_noti">Ya</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="send_noti2" name="send_noti" class="custom-control-input" value="2">
                                <label class="custom-control-label" for="send_noti2">Tidak</label>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <input id="id_kematian" name="id_kematian" type="hidden" value="<?php echo $row1['id_kematian']; ?>">
                        <input id="token" name="token" type="hidden" value="<?php echo($token_id); ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Respon</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
<script>
    function displayLulus<?php echo $row1['id_kematian']; ?>(str){
        var status = str;

        if(status==1){
            document.getElementById('div_lulus').style.display = 'block';
            document.getElementById('tarikh_dikebumikan').required = "true";
            document.getElementById('waktu_dikebumikan').required = "true";
            document.getElementById('waktu_solatJenazah').required = "true";
            document.getElementById('div_noti').style.display = 'block';
            document.getElementById('send_noti').required= true;
        }
        else if(status==2){
            document.getElementById('div_lulus').style.display = 'none';
            if(document.getElementById('tarikh_dikebumikan').required == "true") {
                document.getElementById('tarikh_dikebumikan').removeAttribute("required");
            }
            if(document.getElementById('waktu_dikebumikan').required == "true") {
                document.getElementById('waktu_dikebumikan').removeAttribute("required");
            }
            if(document.getElementById('waktu_solatJenazah').required == "true") {
                document.getElementById('waktu_solatJenazah').removeAttribute("required");
            }
            document.getElementById('div_noti').style.display = 'none';
            document.getElementById('send_noti').required= false;
        }
    }
</script>
<?php
}
?>