<?php 

include("connection/connection.php");

?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Rekod Bantuan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=bantuan">Daftar Bantuan</a></li>
					<li class="active">Rekod Bantuan</li>
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
					Senarai Rekod Bantuan
				</div>
				<div class="card-body">
					<div class="table-responsive" style="overflow-x:auto;">
						<div class="col-12" align="center">
							<select class="form-control" style="width:300px" name="warganegara" onChange="document.location.href='utama.php?view=admin&action=rekod_bantuan&warganegara='+this.options[this.selectedIndex].value"> 
								<option value="semua" <?php if($_GET['warganegara']=="semua") { echo "selected"; } ?>>Keseluruhan</option>
								<option value="1" <?php if($_GET['warganegara']=="1") { echo "selected"; } ?>>Warganegara</option>
								<option value="2" <?php if($_GET['warganegara']=="2") { echo "selected"; } ?>>Bukan Warganegara</option>
							</select>
						</div>
						<?php
						if(isset($_GET['warganegara'])){
							if($_GET['warganegara']=="1"){
								$warganegara = $_GET['warganegara'];
						?>
						<br>
						<div class="col-12" align="center">
							<select class="form-control" style="width:300px" name="qariah" onChange="document.location.href='utama.php?view=admin&action=rekod_bantuan&warganegara=<?php echo $warganegara; ?>&qariah='+this.options[this.selectedIndex].value"> 
								<option value="semua" <?php if($_GET['qariah']=="semua") { echo "selected"; } ?>>Ahli Kariah & Bukan Ahli Kariah</option>
								<option value="1" <?php if($_GET['qariah']=="1") { echo "selected"; } ?>>Ahli Kariah</option>
								<option value="2" <?php if($_GET['qariah']=="2") { echo "selected"; } ?>>Bukan Ahli Kariah</option>
							</select>
						</div>
						<?php
							}
						}
						?>
						<?php
						if(!isset($_GET['warganegara']) OR $_GET['warganegara']=="semua")
						{
							include("excel/excel_bantuan.php");
							$filePath = "../output/".$kod_masjid."/RekodBantuan.xlsx";
						}
						else if($_GET['warganegara']==1){
							
							if(!isset($_GET['qariah']) OR $_GET['qariah']=="semua")
							{
								include("excel/excel_bantuan_warganegara.php");
								$filePath = "../output/".$kod_masjid."/RekodBantuanWarganegara.xlsx";
							}
							else if($_GET['qariah']==1)
							{
								include("excel/excel_bantuan_ahlikariah.php");
								$filePath = "../output/".$kod_masjid."/RekodBantuanAhliKariah.xlsx";
							}	
							else if($_GET['qariah']==2)
							{
								include("excel/excel_bantuan_bukankariah.php");
								$filePath = "../output/".$kod_masjid."/RekodBantuanBukanAhliKariah.xlsx";
							}
						}
						else if($_GET['warganegara']==2){
							
							include("excel/excel_bantuan_bukanwarganegara.php");
							$filePath = "../output/".$kod_masjid."/RekodBantuanBukanWarganegara.xlsx";
						}
						
						?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin/downloadbantuan.php?filepath=<?php echo $filePath; ?>" target="_blank" class="btn btn-success">Excel</a>
						<table id="myTable" width="100%" data-order="[]" class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th><div align="center">No</div></th>
									<th><div align="center" style="width:100px">Nama</div></th>
									<th><div align="center">
									<?php
									if(isset($_GET['warganegara'])){
										if($_GET['warganegara']=="semua"){
											echo "No K/P | No Passport";
										}
										else if($_GET['warganegara']=="1"){
											echo "No K/P";
										}
										else if($_GET['warganegara']=="2"){
											echo "No Passport";
										}
									}
									else if(!isset($_GET['warganegara']))
									{
										echo "No K/P | No Passport";
									}
									
									?></div></th>
									<th><div align="center">No Telefon</div></th>
									<th><div align="center">Jenis Bantuan</div></th>
									<!-- <th><div align="center">Tarikh Bantuan</div></th>
									<th><div align="center">Kaedah Pembayaran</div></th>
									<th><div align="center">Amaun(RM)/Item Bantuan</div></th> -->
									<th><div align="center" style="width:70px">Tarikh Bantuan</div></th>
									<th><div align="center">Status</div></th>
									<th width="7%"><div align="center">Info</div></th>
									<th><div align="center">Kemaskini</div></th> 
									<th><div align="center">Padam</div></th>
								</tr>
							</thead>
							<tbody>
							<?php
							
							$i=1;
							
							if(isset($_GET['warganegara']))
							{
								if(($_GET['warganegara']=="semua"))
								{
									$sql = "SELECT * FROM bantuan_zakat WHERE id_masjid='$id_masjid' AND status_bantuan=1";
								}
								else if($_GET['warganegara']=="1")
								{
									$sql = "SELECT * FROM bantuan_zakat WHERE id_masjid='$id_masjid' AND status_bantuan=1 AND no_ic IS NOT NULL";
									
									if(isset($_GET['qariah']))
									{
										if($_GET['qariah']==1)
										{
											$sql = $sql." AND kariah_masjid='$id_masjid'";
										}
										else if($_GET['qariah']==2)
										{
											$sql = $sql." AND kariah_masjid!='$id_masjid'";
										}
									}
								}
								else if($_GET['warganegara']=="2")
								{
									$sql = "SELECT * FROM bantuan_zakat WHERE id_masjid='$id_masjid' AND status_bantuan=1 AND no_passport IS NOT NULL";
								}
							}
							else if(!isset($_GET['warganegara']))
							{
								$sql = "SELECT * FROM bantuan_zakat WHERE id_masjid='$id_masjid' AND status_bantuan=1";
							}
							
							$sql = $sql." ORDER BY id_bantuan DESC";
							$sqlquery = mysqli_query($bd2,$sql);
							
							while($data=mysqli_fetch_array($sqlquery))
							{
							?>
								<tr>
									<td align="center"><?php echo $i; ?></td>
									<?php
									if($data['no_ic']!=NULL){
										if($data['id_data'] != NULL){
											$id_data = $data['id_data'];
											$sql1 = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_data'";
											$sqlquery1 = mysqli_query($bd2,$sql1);
											$data1 = mysqli_fetch_array($sqlquery1);
											
											$kariah_masjid = $data1['id_masjid'];
										}
										else if($data['ID'] != NULL){
											$ID = $data['ID'];
											$sql1 = "SELECT nama_penuh, no_ic, no_tel 'no_hp', id_masjid FROM sej6x_data_anakqariah WHERE ID='$ID'";
											$sqlquery1 = mysqli_query($bd2,$sql1);
											$data1 = mysqli_fetch_array($sqlquery1);

											$kariah_masjid = $data1['id_masjid'];
										}
                                        else if($data['id_data']==NULL AND $data['ID']==NULL)
                                        {
                                            $kariah_masjid = $data['kariah_masjid'];
                                        }
										
										
										$sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$kariah_masjid'";
										$query_masjid = mysqli_query($bd2,$sql_masjid);
						
										$data_masjid = mysqli_fetch_array($query_masjid);
									}
									?>
									<td align="center">
									<?php 
									if(($data['ID']!=NULL) OR ($data['id_data']!=NULL)) 
									{
										echo strtoupper($data1['nama_penuh'])."<br>(".$data_masjid['nama_masjid'].")";
									}
									else if($data['no_passport']!=NULL)
									{
										echo strtoupper($data['nama_penuh'])."<br>(BUKAN WARGANEGARA)";
									}
									else 
									{
										echo strtoupper($data['nama_penuh'])."<br>(".$data_masjid['nama_masjid'].")";
									}
									?>
									</td>
									<td align="center">
									<?php 
									if($data['no_ic']!=NULL)
									{
										echo $data['no_ic'];
									} 
									else if($data['no_passport']!=NULL)
									{
										echo $data['no_passport'];
									}
									?>
									</td>
									<td align="center">
									<?php 
									if(($data['ID']!=NULL) OR ($data['id_data']!=NULL)) 
									{
										echo $data1['no_hp'];
									}
									else
									{
										echo $data['no_tel'];
									}
									?>
									</td>
									<td align="center"><?php echo $data['jenis_bantuan']; ?></td>
									<td align="center">
									<?php 
									if($data['tarikh_bantuan']!=NULL){
									echo fungsi_tarikh($data['tarikh_bantuan'],11,2);
									//echo $data['tarikh_bantuan'];
									}
									?>
									</td>
									<!-- <td align="center"><?php //echo fungsi_tarikh($data['tarikh_bantuan'],11,2); ?></td>
									<td align="center"><?php //echo $data['kaedah_bayar']; ?></td>
									<td align="center"><?php //echo $data['amaun_item']; ?></td> -->
									<td align="center">
									<?php
									$status_bantuan = $data['status_bantuan'];
									
									if($status_bantuan==1){
										if($data['status_ambil']==1){
									?>
									<div class="alert alert-success col-12" role="alert">
										Bantuan Sudah Diambil
									</div>
									<?php
										}
										else if($data['status_ambil']!=1)
										{
									?>
									<div class="alert alert-warning col-12" role="alert">
										Bantuan Belum Diambil
									</div
									<?php
										}
									}
									else if($status_bantuan==2){
									?>
									<div class="alert alert-danger col-12" role="alert">
										Bantuan Ditolak
									</div>
									<?php
									}
									?>
									</td>
									<td align="center">
									<?php
									$status_bantuan = $data['status_bantuan'];
									
									if($status_bantuan==1){
										if($data['status_ambil']==1){
										?>
									<button class="btn btn-info" data-toggle="modal" data-target="#FormInfo" value="<?php echo $data['id_bantuan']; ?>" onClick="infoForm(this.value)">
										<i class="fas fa-file-alt"></i>&nbsp;<br>Lihat Info
									</button>
										<?php
										}
										else if($data['status_ambil']!=1)
										{
										?>
										<button class="btn btn-warning" data-toggle="modal" data-target="#FormInfo" value="<?php echo $data['id_bantuan']; ?>" onClick="infoForm(this.value)">
											<i class="fas fa-file-alt"></i>&nbsp;<br>Beri Bantuan
										</button>
										<?php
										}
									}
									else if($status_bantuan==2){
									?>
									<div class="alert alert-danger col-12" role="alert">
										<?php echo $data['sebab_lain']; ?>
									</div>
									<?php
									}
									?>
									</td>
									<td align="center">
									<?php
									if($data['status_bantuan']==1){
									?>
										<button class="btn btn-success" data-toggle="modal" data-target="#FormEdit" value="<?php echo $data['id_bantuan']; ?>" onClick="editForm(this.value)"><i class="fa fa-edit"></i></button>&nbsp;
									<?php
									}
									?>
									</td>
									<td align="center">
										<?php
											if($data['no_ic']!=NULL)
											{
										?>
										<form action="admin/del_rekodbantuan.php" method="POST" onSubmit="return confirm('Padam Bantuan')">
											<input type="hidden" name="id_bantuan" value="<?php echo $data['id_bantuan']; ?>">
											<input type="hidden" name="no_ic" value="<?php echo $data['no_ic']; ?>">
											<button type="submit" name="del_button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
										</form>
										<?php
											}
											else if($data['no_passport']!=NULL)
											{
										?>
										<form action="admin/del_rekodbantuan.php" method="POST" onSubmit="return confirm('Padam Bantuan')">
											<input type="hidden" name="id_bantuan" value="<?php echo $data['id_bantuan']; ?>">
											<input type="hidden" name="no_passport" value="<?php echo $data['no_passport']; ?>">
											<button type="submit" name="del_button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
										</form><?php 
											}
										?>
									</td>
								</tr>
							<?php
								$i++;
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
<div class="modal long-modal" id="FormInfo" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="longmodal">Maklumat Rekod Bantuan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body" id="div_info">
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

<div class="modal long-modal" id="FormEdit" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="longmodal">Kemaskini Maklumat Bantuan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body" id="form_edit">
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
function infoForm(str){ 
	if (str == "") {
		document.getElementById("div_info").innerHTML = "";
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
				document.getElementById("div_info").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","admin/getrekodbantuan.php?id_bantuan="+str,true);
		xmlhttp.send();
	}
}
function editForm(str){ 
	if (str == "") {
		document.getElementById("form_edit").innerHTML = "";
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
				document.getElementById("form_edit").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","admin/geteditrekodbantuan.php?id_bantuan="+str,true);
		xmlhttp.send();
	}
}

$(function () {
	$('#myTable').DataTable();
	var table = $('#example').DataTable({
		"columnDefs": [{
			"visible": false,
			"targets": 2
		}],
		"order": [
			[2, 'asc']
		],
		"displayLength": 25,
		"drawCallback": function (settings) {
			var api = this.api();
			var rows = api.rows({
				page: 'current'
			}).nodes();
			var last = null;
			api.column(2, {
				page: 'current'
			}).data().each(function (group, i) {
				if (last !== group) {
					$(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
					last = group;
				}
			});
		}
	});
});
</script>