<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Kelulusan Komuniti</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Kelulusan Komuniti</li>
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
                    Senarai Permohonan Komuniti&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                    <!-- <button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Tambah Komuniti</button> -->
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-12 col-md-auto">
                            <select class="form-control" onchange="document.location.href='utama.php?view=admin&action=komuniti_ekonomi&sideMenu=kariah&status='+this.value">
                                <option value="semua" <?php if($_GET['status'] == "semua") echo("selected"); ?>>Semua</option>
                                <option value="0" <?php if($_GET['status'] == "0" || $_GET['status'] == NULL) echo("selected"); ?>>Menunggu Kelulusan</option>
                                <option value="1"<?php if($_GET['status'] == "1") echo("selected"); ?>>Diluluskan</option>
                                <option value="2"<?php if($_GET['status'] == "2") echo("selected"); ?>>Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <table id="meja_akaun2" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Jenis Komuniti</th>
                            <th>Nama Perniagaan</th>
                            <th>No Telefon</th>
                            <th>Alamat</th>
                            <th>Tarikh Dimasukkan</th>
                            <th>Tarikh Respons</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        if($_GET['status'] == "semua") $status_approved = NULL;
                        else if($_GET['status'] != NULL) $status_approved = "AND status_approved = ".$_GET['status'];
                        else $status_approved = "AND status_approved = 0";
                        $sql_komuniti = "SELECT * FROM komuniti_list WHERE id_masjid='$id_masjid' $status_approved";
                        $query_komuniti = mysqli_query($bd2,$sql_komuniti);

                        while($data_komuniti=mysqli_fetch_array($query_komuniti)){
                            //if($data_komuniti['status_approved'] == 0) $statusText = '<span class="badge badge-pill badge-warning">Menunggu Kelulusan</span>';
                            if($data_komuniti['status_approved'] == 1) $statusText = '<a data-toggle="modal" data-target="#myModal" onClick="myFunction('.$data_komuniti['id_komunitiList'].')"><button type="button" class="btn btn-success">Diluluskan</button></a>';
                            else if($data_komuniti['status_approved'] == 2) $statusText = '<a data-toggle="modal" data-target="#myModal" onClick="myFunction('.$data_komuniti['id_komunitiList'].')"><button type="button" class="btn btn-danger">Ditolak</button></a>';
                            else $statusText = NULL;
                            ?>
                            <tr>
                                <td align="center"><?php echo $i; ?></td>
                                <td><?php
                                    $id_komuniti = $data_komuniti['id_komuniti'];

                                    $sql1 = "SELECT * FROM komuniti WHERE id_komuniti='$id_komuniti'";
                                    $sqlquery1 = mysqli_query($bd2,$sql1);
                                    $data1 = mysqli_fetch_array($sqlquery1);

                                    echo $data1['komuniti'];
                                    ?></td>
                                <td><?php echo $data_komuniti['nama_perniagaan']; ?></td>
                                <td align="center"><?php echo $data_komuniti['no_telephone']; ?></td>
                                <td>
                                    <?php
                                    $daerah_id = $data_komuniti['bandar'];
                                    $sql_daerah = "SELECT * FROM daerah WHERE id_daerah='$daerah_id'";
                                    $query_daerah = mysqli_query($bd2,$sql_daerah);
                                    $data_daerah = mysqli_fetch_array($query_daerah);

                                    $negeri_id = $data_komuniti['negeri'];
                                    $sql_negeri = "SELECT * FROM negeri WHERE id_negeri='$negeri_id'";
                                    $query_negeri = mysqli_query($bd2,$sql_negeri);
                                    $data_negeri = mysqli_fetch_array($query_negeri);
                                    echo $data_komuniti['alamat']."<br>".$data_daerah['nama_daerah']."<br>".$data_negeri['name'];
                                    ?>
                                </td>
                                <td><?php fungsi_tarikh($data_komuniti['created_at'], 1, 2); ?></td>
                                <td><?php $data_komuniti['responsDate'] != NULL ? fungsi_tarikh($data_komuniti['responsDate'], 1, 2) : NULL; ?></td>
                                <td align="center">
                                    <?php if($data_komuniti['status_approved'] == 0) { ?>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" onClick="myFunction(this.value)" value="<?php echo $data_komuniti['id_komunitiList']; ?>">Respon</button>
                                    <?php } ?>
                                    <?php echo($statusText); ?>
                                </td>
                                <td align="center">
                                    <a onclick="pastikan(<?php echo $data_komuniti['id_komunitiList']; ?>)"><button class="btn btn-danger">Padam</button></a>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal long-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="longmodal">Respon Komuniti</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="div_komuniti">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    function myFunction(str){
        if (str == "") {
            document.getElementById("div_komuniti").innerHTML = "";
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
                    document.getElementById("div_komuniti").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/getkomuniti.php?id_komunitiList="+str,true);
            xmlhttp.send();
        }
    }
</script>
<script>
    function pastikan(a) {
        if(confirm('Adakah anda pasti untuk memadam rekod ini?')) {
            document.location.href = 'admin/update_komuniti_ekonomi.php?del=1&id_komunitiList=' + a;
        }
    }
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai Komuniti', [ 0, 1, 2, 3, 4 ]);
    });
</script>