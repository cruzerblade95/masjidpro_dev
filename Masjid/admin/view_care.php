<?php
include('connection/connection.php');
if(isset($_GET['no_ic']) AND isset($_GET['tarikh_awal']) AND isset($_GET['tarikh_akhir']))
{
    $no_ic = $_GET['no_ic'];
    $tarikh_awal = $_GET['tarikh_awal'];
    $tarikh_akhir = $_GET['tarikh_akhir'];
}

?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Rekod Masjid Care</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=care">Masjid Care</a></li>
                    <li class="active">Rekod Masjid Care</li>
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
                    Rekod Kehadiran
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-lg-12">
                                <center>
                                    <h4>Carian Tarikh</h4>
                                </center>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-3">
                                <center>Dari</center>
                            </div>
                            <div class="col-lg-3">
                                <center>Hingga</center>
                            </div>
                            <div class="col-lg-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-3">
                                <center><input type="date" name="tarikh_awal" class="form-control" style="width:200px" readonly <?php if(isset($_GET['tarikh_awal'])) { ?>value="<?php echo date_format(date_create($tarikh_awal),'Y-m-d'); ?>"<?php } ?></center>
                            </div>
                            <div class="col-lg-3">
                                <center><input type="date" name="tarikh_akhir" class="form-control" style="width:200px" readonly <?php if(isset($_GET['tarikh_akhir'])) { ?>value="<?php echo date_format(date_create($tarikh_akhir),'Y-m-d'); ?>"<?php } ?>></center>
                            </div>
                            <div class="col-lg-3">
                            </div>
                        </div>
                    </form>
                        <hr>
                        <div class="table-responsive">
                            <table id="meja_akaun2" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
                                <thead>
                                <tr>
                                    <th><div align="center">#</div></th>
                                    <th><div align="center">Nama</div></th>
                                    <th><div align="center">No K/P</div></th>
                                    <th><div align="center">No Telefon</div></th>
                                    <th><div align="center">Tarikh</div></th>
                                    <th><div align="center">Masa</div></th>
                                    <th><div align="center">Kariah Masjid</div></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $sql="SELECT a.id_gejala, a.id_data,a.no_ic 'no_ic', a.time, b.nama_penuh, b.no_hp, b.id_masjid FROM sej6x_data_gejala a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.no_ic=b.no_ic AND a.time BETWEEN '$tarikh_awal' AND '$tarikh_akhir' AND a.no_ic='$no_ic'
                                UNION SELECT c.id_gejala, c.ID 'id_data', c.no_ic 'no_ic', c.time, d.nama_penuh, d.no_tel 'no_hp', d.id_masjid FROM sej6x_data_gejala c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.no_ic=d.no_ic AND c.time BETWEEN '$tarikh_awal' AND '$tarikh_akhir' AND c.no_ic='$no_ic' ORDER BY time DESC";
                                $sqlquery = mysqli_query($bd2,$sql);
                                $row=mysqli_num_rows($sqlquery);

                                $x=1;
                                while($row = mysqli_fetch_array($sqlquery))
                                {
                                    ?>
                                    <tr>
                                        <td><div align="center"><?php echo $x; ?></div></td>
                                        <td><?php echo $row['nama_penuh']; ?></td>
                                        <td><div align="center"><?php echo $row['no_ic']; ?></div></td>
                                        <td><div align="center"><?php echo $row['no_hp']; ?></div></td>
                                        <td align="center"><?php echo date_format(date_create($row['time']),'Y-m-d'); ?></td>
                                        <td align="center"><?php echo date_format(date_create($row['time']),'H:i:s'); ?></td>
                                        <td align="center">
                                            <?php
                                            $id_masjid1=$row['id_masjid'];
                                            $sql1="SELECT * FROM sej6x_data_masjid WHERE id_masjid='$id_masjid1'";
                                            $sqlquery1=mysql_query($sql1,$bd);
                                            $data=mysql_fetch_array($sqlquery1);

                                            echo $data['nama_masjid'];
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $x++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="displayGejala" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Maklumat Gejala</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form enctype="multipart/form-data">
                <?php
                include("connection/connection.php");

                $sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid'";
                $result = mysql_query($sql_search) or die ("Error :".mysql_error());
                ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <center><h4><u>Maklumat Gejala</u></h4></center>
                        </div>
                    </div>
                    <hr>
                    <div id="div_gejala">
                    </div>
                    <hr>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    </div>
                </div>
                <!-- /.row -->
        </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>
<!-- modal-dialog modal-lg -->
</div>
<!-- modal fade -->
<script>
    function displayData(str){
        {
            if (str == "") {
                document.getElementById("div_gejala").innerHTML = "";
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
                        document.getElementById("div_gejala").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET","admin/getgejala.php?no_ic="+str,true);
                xmlhttp.send();
            }
        }
    }
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai Ahli Kariah', [ 0, 1, 2, 3, 4 ]);
    });
</script>



