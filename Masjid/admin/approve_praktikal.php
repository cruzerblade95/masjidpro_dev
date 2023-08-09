<?php

include("connection/connection.php");

$sql_search="SELECT * FROM sej6x_data_praktikal WHERE id_masjid='$id_masjid'";
$result = mysql_query($sql_search) or die ("Error :".mysql_error());
$row=mysql_num_rows($result);
?>
<script src="js/jquery-3.4.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table_display').DataTable();
    } );
</script>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Approve Praktikal</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Approve Praktikal</li>
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
                    Maklumat Permohonan Praktikal&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_display" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="5%"><div align="center">No</div></th>
                                <th><div align="center">Nama</div></th>
                                <th><div align="center">No Telefon</div></th>
                                <th><div align="center">Bidang/Tahap Pengajian</div></th>
                                <th><div align="center">Pusat Pengajian</div></th>
                                <th><div align="center">Semester</div></th>
                                <th><div align="center">Surat Permohonan</div></th>
                                <th><div align="center">Status Permohonan</div></th>
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
                                while($row = mysql_fetch_assoc($result))
                                {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $x; ?></td>
                                        <td align="center"><?php echo $row['nama_penuh']; ?></td>
                                        <td align="center"><?php echo $row['no_hp']; ?></td>
                                        <td align="center"><?php echo $row['bidang']."/".$row['tahap_pengajian']; ?></td>
                                        <td align="center"><?php echo $row['pusat_pengajian']; ?></td>
                                        <td align="center"><?php echo $row['semester']; ?></td>
                                        <td align="center">
                                            <button type="button" class="btn btn-info" title="Lihat Surat Permohonan" data-toggle="modal" data-target="#table_surat" value="<?php echo $row['ID']; ?>" onClick="showSurat(this.value)"><i class="fa fa-info-circle"></i></button>
                                        </td>
                                        <td align="center">
                                            <?php
                                            if($row['status']==1)
                                            {
                                                ?>
                                                <button type="button" class="btn btn-success" disabled>Permohonan Diluluskan</button>
                                                <?php
                                            }
                                            else if($row['status']==2)
                                            {
                                                ?>
                                                <button type="button" class="btn btn-danger" disabled>Permohonan Ditolak</button>
                                                <?php
                                            }
                                            else if($row['status']=="0")
                                            {
                                                ?>
                                                <button type="button" class="btn btn-warning" disabled>Permohonan Menunggu Kelulusan</button>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php
                                            if($row['status']=="0")
                                            {
                                                ?>
                                                <form name="daftar" method="POST" action="admin/add_approve_praktikal.php">
                                                    <input type="hidden" name="id_praktikal" id="add" value="<?php echo $row['ID']; ?>">
                                                    <button type="submit" name="submit" id="submit" class="form-control"  title="Luluskan"><i class="fas fa-check" onclick="return confirm('Terima Permohonan?');"></i></button>
                                                </form>
                                                <?php
                                            }
                                            else if($row['status']==1)
                                            {
                                                ?>
                                                <!-- <a href="utama.php?view=admin&action=rekod_praktikal&id_praktikal=<?php //echo $row['ID']; ?>" class="form-control" title="Rekod Praktikal"><i class="fas fa-clipboard"></i></a> -->
                                                <?php
                                            }
                                            ?>
                                            <!-- <form name="delete" method="POST" action="admin/del_approve.php">
													<input type="hidden" name="del" id="del" value="<?php //echo $row['ID']; ?>">
													<button type="submit" name="delete" id="delete" class="form-control"  title="Padam"><i class="fas fa-user-minus" onclick="return confirm('Padam Rekod?');"></i></button>
												</form>  -->
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
<div class="modal fade" id="table_surat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">MAKLUMAT PERMOHONAN PRAKTIKAL</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
                <?php
                include("connection/connection.php");

                $sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid'";
                $result = mysql_query($sql_search) or die ("Error :".mysql_error());
                ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <center><h4><u>Maklumat Permohonan</u></h4></center>
                        </div>
                    </div>
                    <hr>
                    <div id="display_surat" align="center">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    </div>
                </div>
                <!-- /.row -->
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- modal-dialog modal-lg -->
</div>
<!-- modal fade -->
<script>
    function showSurat(str) {
        if (str == "") {
            document.getElementById("display_surat").innerHTML = "";
            return;
        }
        else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("display_surat").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/getsurat.php?id_praktikal="+str,true);
            xmlhttp.send();
        }
    }
</script>