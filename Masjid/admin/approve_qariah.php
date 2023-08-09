<?php

namespace Verot\Upload;
include($_SERVER['DOCUMENT_ROOT']."/Masjid/Classes/phpUpload/class.upload.php");

include("connection/connection.php");

$sql_search = "SELECT * FROM approve_qariah a LEFT JOIN negeri b ON a.negeri = b.id_negeri LEFT JOIN daerah c ON a.daerah = c.id_daerah WHERE id_masjid = $id_masjid ORDER BY nama_penuh ASC";
$result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
$bil = mysqli_num_rows($result);

$sql1 = "SELECT a.ID, a.nama_penuh 'nama_penuh', a.no_ic 'no_ic', a.last_added 'last_added', b.nama_penuh 'nama_ketua', a.no_ic_ketua 'no_ic_ketua', a.id_qariah 'id_qariah', b.id_data 'id_data', c.id 'id_data_approved', c.nama_penuh 'nama_ketua_approved', IF(b.nama_penuh IS NOT NULL, 1, 0) 'kk_approved' FROM approve_anak a LEFT JOIN sej6x_data_peribadi b ON a.no_ic_ketua = b.no_ic LEFT JOIN approve_qariah c ON (a.no_ic_ketua = c.no_ic OR a.id_qariah = c.id) WHERE b.id_masjid='$id_masjid' OR c.id_masjid='$id_masjid' ORDER BY a.last_added DESC";
$sqlquery1 = mysqli_query($bd2,$sql1);
$bil1 = mysqli_num_rows($sqlquery1);

?>
<!-- <script>
    eval(document.getElementById("pdf_var").innerHTML);
    nama_masjid = '<?php echo($_SESSION['nama_masjid']); ?>'
    tajuk_dokumen = 'Senarai Untuk Kelulusan Ahli Kariah';
    eval(document.getElementById("pdf_sekerip").innerHTML);
    document.getElementById('tajuk_besar').innerHTML = tajuk_dokumen;
</script>
<script>
    function displayDetail(borang) {
        jQuery('#'+borang).on('submit', function(e){
            e.preventDefault();
            jQuery('#display_maklumat').html('');
            jQuery.ajax({
                type: 'POST',
                url: 'daftar_online/pendaftaran.php?id_masjid=<?php echo($id_masjid); ?>',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    jQuery('#display_maklumat').html(data);
                    //eval(document.getElementById('sekerip_adjust').innerHTML);
                }
            });
        });
    }

</script> -->
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Kelulusan Ahli Kariah</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">kelulusan Ahli Kariah</li>
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
                    Maklumat Ahli&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#ketua" role="tab"><span class="hidden-sm-up"><i class="fas fa-user"></i></span> <span class="hidden-xs-down">Ketua Keluarga</span> <span class="badge badge-pill badge-primary"><?php echo $bil; ?></span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tanggungan" role="tab"><span class="hidden-sm-up"><i class="fas fa-users"></i></span> <span class="hidden-xs-down">Tanggungan</span> <span class="badge badge-pill badge-primary"><?php echo $bil1; ?></span> </a> </li>
                    </ul>
                    <div class="tab-content tabcontent-border">
                        <div class="tab-pane active" id="ketua" role="tabpanel">
                            <div class="alert alert-info" role="alert">* Senarai ketua keluarga yang telah mendaftar menerusi aplikasi MasjidPro Penang untuk diproses, sekiranya diluluskan tanggungan jagaannya juga akan diluluskan begitu juga sebaliknya</div>
                            <table id="meja_akaun2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style='width:5%'><div align="center">No</div></th>
                                    <th style='width:15%'><div align="center">Nama</div></th>
                                    <th style='width:10%'><div align="center">No K/P</div></th>
                                    <th style='width:35%'><div align="left">Alamat</div></th>
                                    <th style='width:20%'><div align="left">Tarikh Pendaftaran</div></th>
                                    <th style='width:15%'><div align="center">Tindakan</div></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($bil==0)
                                {
                                    ?>
                                    <tr>
                                        <td colspan="6" align="center">*Tiada Rekod*</td>
                                    </tr>
                                    <?php
                                }
                                else if($bil>0)
                                {
                                    $x=1;
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        ?>
                                        <tr>
                                            <td ><div align="center"><?php echo $x; ?></div></td>
                                            <td><?php echo $row['nama_penuh']; ?></td>
                                            <td><div align="center"><?php echo $row['no_ic']; ?></div></td>
                                            <td><?php echo $row['no_rumah']; ?>, <?php echo $row['poskod']; ?>, <?php echo $row['name']; ?></td>
                                            <td align="center"><?php echo $row['last_added']; ?></td>
                                            <td>
                                                <form name="daftar" method="POST" action="admin/add_approve.php" onclick="return confirm('Daftar Ahli Qariah?');">
                                                    <input type="hidden" name="add" id="add" value="<?php echo $row['id']; ?>">
                                                    <input type="hidden" name="view" id="view" value="<?php echo $view;?>">
                                                    <input type="hidden" name="approve_ketua" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" name="submit" id="submit" class="form-control"  title="Daftar"><i class="fas fa-user-plus" ></i></button>
                                                </form>
                                                <!-- <form name="delete" method="POST" action="admin/del_approve.php" onSubmit="return confirm('Padam Rekod Ahli Qariah?');">
                                                    <input type="hidden" name="del" id="del" value="<?php //echo $row['id']; ?>">
                                                    <input type="hidden" name="view" id="view" value="<?php //echo $view;?>">
                                                    <input type="hidden" name="del_ketua" value="<?php //echo $row['id']; ?>">
                                                    <input type="hidden" name="sebab_padam" id="sebab_padam" value="99">
                                                    <button type="submit" name="delete" id="delete" class="form-control"  title="Padam"><i class="fas fa-user-minus"></i></button>
                                                </form> -->
                                                <!--
                                                        <form role="form" id="<?php //echo $row['no_ic'];?>" name="<?php //echo $row['no_ic'];?>" enctype="multipart/form-data">
                                                            <input type="hidden" name="id_masjid" id="id_masjid" value="<?php //echo $id_masjid; ?>">
                                                            <input type="hidden" name="no_ic" id="no_ic" value="<?php //echo $row['no_ic'];?>">
                                                            <input type="hidden" name="semak" id="semak" value="1">
                                                            <input type="hidden" name="admin_view2" id="admin_view2" value="1">
                                                            <input type="hidden" name="preview" id="preview" value="1">
                                                            <button type="submit" name="simpan" id="simpan" class="form-control"  data-toggle="modal" data-target="#myModal" title="Maklumat" onClick="displayDetail(this.value)" value="<?php //echo $row['no_ic'];?>"><i class="fas fa-user-alt"></i></button>
                                                        </form>
                                                        -->
                                                <button id="btndel-profil" class="form-control" data-toggle="modal" data-target="#FormDel" value="<?php echo $row['id']; ?>" title="Padam" onClick="formDel(this.value)"><i class="fas fa-user-minus"></i></button>
                                                <button id="btn-profil" class="form-control" value="<?php echo $row['id']; ?>" title="Maklumat" onclick="window.open('approve_profil.php?id=<?php echo $row['id']; ?>')"><i class="fas fa-file-alt"></i></button>
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
                        <div class="tab-pane" id="tanggungan" role="tabpanel">
                            <div class="alert alert-info" role="alert">* Senarai tanggungan yang telah mendaftar secara berasingan menerusi aplikasi MasjidPro Penang untuk diproses</div>
                            <table id="meja_akaun3" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style='width:5%'><div align="center">No</div></th>
                                    <th style='width:15%'><div align="center">Nama</div></th>
                                    <th style='width:10%'><div align="center">No K/P</div></th>
                                    <th style='width:35%'><div align="left">Ketua Keluarga</div></th>
                                    <th style='width:20%'><div align="left">Tarikh Pendaftaran</div></th>
                                    <th style='width:15%'><div align="center">Tindakan</div></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                if($bil1==0)
                                {
                                    ?>
                                    <tr>
                                        <td colspan="6" align="center">*Tiada Rekod*</td>
                                    </tr>
                                    <?php
                                }
                                else if($bil1>0)
                                {
                                    $x=1;
                                    while($row1 = mysqli_fetch_assoc($sqlquery1))
                                    {
                                        ?>
                                        <tr>
                                            <td ><div align="center"><?php echo $x; ?></div></td>
                                            <td><?php echo $row1['nama_penuh']; ?></td>
                                            <td><div align="center"><?php echo $row1['no_ic']; ?></div></td>
                                            <td align="center">
                                                <?php
                                                $no_ic_ketua = $row1['no_ic_ketua'];
                                                $id_qariah = $row1['id_qariah'];
                                                $id_data = $row1['id_data'];
                                                $id_data_approve = $row1['id_data_approved'];
                                                $kk_approved = $row1['kk_approved'];

                                                if($no_ic_ketua!=NULL){
                                                    if($id_data!=NULL) {
                                                        $sql_ketua = "SELECT nama_penuh FROM sej6x_data_peribadi WHERE no_ic='$no_ic_ketua'";
                                                    }
                                                    else if($id_data_approve!=NULL){
                                                        $sql_ketua = "SELECT nama_penuh FROM approve_qariah WHERE no_ic='$no_ic_ketua'";
                                                    }
                                                }
                                                else if($id_qariah!=NULL) {
                                                    $sql_ketua = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_qariah'";
                                                }
                                                $query_ketua = mysqli_query($bd2,$sql_ketua);
                                                $data_ketua = mysqli_fetch_array($query_ketua);
                                                ?>
                                                <h5><span onclick="window.open('<?php if($kk_approved == 1) echo('printProfil.php?id_data='.$id_data); else echo('approve_profil.php?id='.$id_data_approve); ?>')" class="label <?php if($kk_approved == 1) echo ('label-success'); else echo 'label-warning'; ?>"><?php echo $data_ketua['nama_penuh']; ?></span></h5>
                                                <?php //echo $data_ketua['no_ic']; ?>
                                            </td>
                                            <td align="center"><?php echo $row1['last_added']; ?></td>
                                            <td align="center">
                                                <?php if($id_data != NULL || $id_data_approve != NULL) {
                                                    $q = "SELECT ID FROM sej6x_data_anakqariah WHERE no_ic ='". $row1['no_ic'] ."'";
                                                    $q2 = mysqli_query($bd2, $q);
                                                    $num_q2 = mysqli_num_rows($q2); ?>
                                                    <?php if($num_q2 < 1 && $id_data != NULL) { ?>
                                                        <form name="approveAnak" method="POST" action="admin/addAnak_new.php" onSubmit="return confirm('Terima Rekod Ahli Qariah (Tanggungan) - <?php echo $row1['nama_penuh']; ?>?');">
                                                            <input type="hidden" name="ID" id="ID" value="<?php echo $row1['ID']; ?>">
                                                            <input type="hidden" name="id_data" id="id_data" value="<?php echo $id_data; ?>">
                                                            <button type="submit" class="form-control"  title="Terima"><i class="fas fa-user-plus"></i></button>
                                                        </form>
                                                    <?php } ?>
                                                    <form name="deleteAnak" method="POST" action="admin/delAnak_new.php" onSubmit="return confirm('Padam Rekod Ahli Qariah (Tanggungan) - <?php echo $row1['nama_penuh']; ?>?');">
                                                        <input type="hidden" name="ID" id="ID" value="<?php echo $row1['ID']; ?>">
                                                        <?php if($num_q2 > 0) { ?><h5><span class="label label-info">Data telah wujud, anda boleh memadam maklumat ini</span></h5><?php } ?>
                                                        <?php if($id_data_approve != NULL) { ?><h5><span class="label label-warning">Rekod Ketua Keluarga telah wujud dan sedang diproses</span></h5><?php } ?>
                                                        <button type="submit" class="form-control"  title="Padam"><i class="fas fa-user-minus"></i></button>
                                                    </form>
                                                <?php } else { ?>
                                                    <h5><span class="label label-danger">Ketua Keluarga Belum Mendaftar</span></h5>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $x++; } } ?>
                                </tbody>
                            </table>
                        </div>
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
<!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">MAKLUMAT KARIAH</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-info">
							<div class="panel-body" id="display_maklumat">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> -->
<div class="modal bs-example-modal-lg fade" id="FormDel" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">PADAM KELULUSAN KARIAH</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-body">
                                <form action="admin/del_approve.php" class="form-horizontal form-bordered" method="POST" onsubmit="return validateForm();" enctype="multipart/form-data">
                                    <div class="container-fluid">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Sebab Padam</label>
                                                <select class="form-control" name="sebab_padam" id="sebab_padam" required onChange="dis_Select(this.value)">
                                                    <option value="">Sila Pilih:-</option>
                                                    <option value="99">Kesilapan Data</option>
                                                    <option value="100">Kariah Lain</option>
                                                </select>
                                            </div>
                                            <div class="form-group" style="display:none" id="div_masjid">
                                                <label>Kariah Masjid</label>
                                                <select class="select2 form-control custom-select" name="pilih_masjid" id="pilih_masjid" style="width:100%">
                                                    <option value="">Sila Pilih:-</option>
                                                    <?php
                                                    $sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_negeri=9";
                                                    $query_masdjid = mysqli_query($bd2,$sql_masjid);

                                                    while($data_masjid = mysqli_fetch_array($query_masdjid)){
                                                        ?>
                                                        <option value="<?php echo $data_masjid['id_masjid']; ?>"><?php echo $data_masjid['nama_masjid']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div id="div_profil">
                                            </div>
                                            <br>
                                            <br>
                                            <center>
                                                <button type="submit" name="btnDel_approve" class="btn btn-danger">Padam</button>
                                            </center>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>
<script>
    function formDel(str){
        if (str == "") {
            document.getElementById("div_profil").innerHTML = "";
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
                    document.getElementById("div_profil").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/del_profil.php?id="+str,true);
            xmlhttp.send();
        }
    }
    function dis_Select(str){
        var sebab_padam = str;

        if(sebab_padam==100){
            document.getElementById('div_masjid').style.display = 'block';
        }
        else if(sebab_padam==99){
            document.getElementById('div_masjid').style.display = 'none';
        }
        else{
            document.getElementById('div_masjid').style.display = 'none';
        }

    }
    function validateForm(){
        var sebab_padam = document.getElementById('sebab_padam').value;

        if(sebab_padam==100){
            var pilih_masjid = document.getElementById('pilih_masjid').value;

            if(pilih_masjid==""){
                alert("Sila Pilih Masjid");
                return false;
            }

        }
            return confirm('Padam Rekod?');

    }
</script>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai Kelulusan Ketua Keluarga', [ 0, 1, 2, 3, 4, 5 ]);
    });
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun3', 'Senarai Kelulusan Tanggungan', [ 0, 1, 2, 3, 4, 5 ]);
    });
</script>