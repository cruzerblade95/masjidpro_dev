<?php 

include("connection/connection.php");

$sql_search="SELECT * FROM bantuan_zakat WHERE id_masjid='$id_masjid' AND status_bantuan=0 ORDER BY tarikh_mohon DESC";
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
				<h1>Kelulusan Bantuan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li class="active">Kelulusan Bantuan</li>
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
					Maklumat Bantuan&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="meja_akaun2" width="100%" style="overflow-x:auto;" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
							<thead>
								<tr>
									<th width="5%"><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">No K/P<br>No Passport</div></th>
									<!-- <th><div align="center">No Telefon</div></th>
									<th><div align="center">Jumlah<br>Tanggungan</div></th> -->
									<th><div align="center">Tarikh Mohon</div></th>
									<th><div align="center">Jenis Bantuan</div></th>
									<!-- <th><div align="center">Status</div></th> -->
									<th><div align="center">Maklumat<br>Permohonan</div></th>
									<th><div align="center">Lulus<br>Permohonan</div></th>
									<th><div align="center">Tolak<br>Permohonan</div></th>
								</tr>
							</thead>
							<tbody>
							<?php 
							if($row==0)
							{
							?>
								<tr>
									<td colspan="8" align="center">*Tiada Rekod*</td>
								</tr>
							<?php
							}
							else if($row>0)
							{
								$x=1; 
								while($data = mysqli_fetch_assoc($result))
								{ 
							?>
								<tr>
									<td align="center"><?php echo $x; ?></td>
									<?php
									if($data['no_ic']!=NULL){
										if($data['id_data']!=NULL){
											$id_data = $data['id_data'];
										
											$sql = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_data'";
										}
										else if($data['ID']!=NULL){
										    $id_anak = $data['ID'];

										    $sql = "SELECT * FROM sej6x_data_anakqariah WHERE ID='$id_anak'";
                                        }
										else if($data['id_data']==NULL AND $data['ID']==NULL){
											$ic = $data['no_ic'];
											
											$sql="SELECT * FROM bantuan_zakat WHERE no_ic='$ic'";
										}
										$sqlquery=mysqli_query($bd2, $sql);
										$data_ic=mysqli_fetch_array($sqlquery);
										?>
										<td align="center">
										<?php
										$masjid_id = $data_ic['id_masjid'];
										
										$sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$masjid_id'";
										$query_masjid = mysqli_query($bd2,$sql_masjid);
										$data_masjid = mysqli_fetch_array($query_masjid);
										echo strtoupper($data_ic['nama_penuh'])."<br>(".$data_masjid['nama_masjid'].")";
										?>
										</td>
										<td align="center"><?php echo $data_ic['no_ic']; ?></td>
										<!-- <td align="center"><?php //echo $data_ic['no_hp']; ?></td>
										<td align="center">
										<?php
										$sql_tanggungan = "SELECT * FROM sej6x_data_anakqariah WHERE id_qariah='$id_data'";
										$query_tanggungan = mysqli_query($bd2,$sql_tanggungan);
										//echo $bil_tanggungan = mysqli_num_rows($query_tanggungan);
										?>
										</td> -->
										<?php
									}
									else if($data['no_passport']!=NULL){
									?>
									<td align="center"><?php echo strtoupper($data['nama_penuh'])."<br>(BUKAN WARGANEGARA)"; ?></td>
									<td align="center"><?php echo $data['no_passport']; ?></td>
									<!--<td align="center"><?php //echo $data['no_tel']; ?></td>
									<td align="center"><?php //echo $data['jumlah_tanggungan']; ?></td> -->
									<?php
									}
									?>
									<td align="center"><?php echo fungsi_tarikh($data['tarikh_mohon'],11,2); ?></td>
									<td align="center"><?php echo $data['jenis_bantuan']; ?></td>
									<!-- <td align="center">
									<?php 
									//if($data['status']==1)
									//{
									?>
									<button type="button" class="btn btn-success" disabled>Bantuan Diluluskan</button>
									<?php
									//}
									//else if($data['status']==2)
									//{
									?>
									<button type="button" class="btn btn-danger" disabled>Bantuan Ditolak</button>
									<?php
									//}
									//else if($data['status'] == 0)
									//{
									?>
									<button type="button" class="btn btn-warning" disabled>Menunggu<br>Kelulusan</button>
									<?php
									//}
									?>
									</td> -->
									<td align="center">
										<button class="btn btn-info" data-toggle="modal" data-target="#FormInfo" value="<?php echo $data['id_bantuan']; ?>" onClick="infoForm(this.value)"><i class="fas fa-file-alt"></i></button>
									</td>
									<td align="center">
										<button class="btn btn-success" data-toggle="modal" data-target="#FormApprove" value="<?php echo $data['id_bantuan']; ?>" onClick="approveForm(this.value)"><i class="far fa-check-square"></i></button>
									</td>
									<td align="center">
										<button class="btn btn-danger" data-toggle="modal" data-target="#FormReject" value="<?php echo $data['id_bantuan']; ?>" onClick="rejectForm(this.value)"><i class="far fa-window-close"></i></button>
										<!-- form action="admin/reject_bantuan.php" method="POST" onSubmit="return confirm('Menolak Permohonan Bantuan?')">
											<input type="hidden" name="id_bantuan" value="<?php //echo $data['id_bantuan_zakat']; ?>">
											<button type="submit" name="tolak_bantuan" class="btn btn-danger"><i class="far fa-window-close"></i></button>
										</form -->
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
<div class="modal long-modal" id="FormApprove" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="longmodal">Maklumat Bantuan Diluluskan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body" id="div_approve">
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
<div class="modal long-modal" id="FormReject" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="longmodal">Maklumat Bantuan Ditolak</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body" id="div_reject">
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
<div class="modal long-modal" id="FormInfo" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="longmodal">Maklumat Permohonan Bantuan</h4>
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

<script>
function approveForm(str){ 
	if (str == "") {
		document.getElementById("div_approve").innerHTML = "";
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
				document.getElementById("div_approve").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","admin/getapprovebantuan.php?id_bantuan="+str,true);
		xmlhttp.send();
	}
}
function rejectForm(str){ 
	if (str == "") {
		document.getElementById("div_reject").innerHTML = "";
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
				document.getElementById("div_reject").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","admin/getrejectbantuan.php?id_bantuan="+str,true);
		xmlhttp.send();
	}
}
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
				eval(document.getElementById('meja2').innerHTML);
				document.getElementById("div_info").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","admin/getinfobantuan.php?id_bantuan="+str,true);
		xmlhttp.send();
	}
}
jQuery(document).ready(function () {
	meja_akaun('#meja_akaun2', 'Senarai Permohonan Bantuan', [ 0, 1, 2, 3, 4, 5, 6]);
});
</script>
<script id="meja2">
jQuery(document).ready(function () {
	meja_akaun('#meja_akaun3', 'Rekod Bantuan', [ 0, 1, 2, 3, 4, 5, 6]);
});

</script>