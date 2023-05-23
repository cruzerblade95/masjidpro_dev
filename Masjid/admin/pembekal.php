<?php 

include("connection/connection.php");

?> 
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });
</script>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Menu Pembekal</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=kewangan">Menu Kewangan</a></li>
					<li class="active">Menu Pembekal</li>
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
					Senarai Pembekal&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
					<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Tambah Pembekal </button>
				</div>
				<!-- /.panel-heading -->
				<div class="card-body">
					<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="5%"><div align="center">No</div></th>
								<th width="57%"><div align="center">Nama Pembekal</div></th>
								<th width="20%"><div align="center">Jenis Pembekal</div></th>
								<th width="20%"><div align="center">Tindakan</div></th>
							</tr>
						</thead>
						<tbody>
							<?php
							
							$sql="SELECT * FROM sej6x_data_pembekal WHERE id_masjid='$id_masjid'";
							$sqlquery=mysql_query($sql,$bd);
							
							$i=1;
							while($data=mysql_fetch_array($sqlquery))
							{
							?>	
							<tr>
								<td align="center"><?php echo $i; ?></td>
								<td align="center"><?php echo $data['nama_pembekal']; ?></td>
								<td align="center">
									<?php 
									if($data['jenis']==1)
									{
										echo "Ultiliti"; 
									}
									else if($data['jenis']==2)
									{
										echo "Penyelenggaraan"; 
									}
									else if($data['jenis']==3)
									{
										echo "Pengurusan"; 
									}
									else if($data['jenis']==4)
									{
										echo "Aktiviti Pengimarahan"; 
									}
									else if($data['jenis']==5)
									{
										echo "Peralatan & Aset";
									}
									else if($data['jenis']==6)
									{
										echo "Lain-Lain";
									}
									?>
								</td>
								<td></td>
							</tr>
							<?php	
							$i++;
							}
							?>
						</tbody>
					</table>
					<!-- table -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">BORANG PEMBEKAL</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<form method="post" id="insert_form" action="admin/add_pembekal.php">
								<center>          
								<div class="row">
									<div class="col-lg-12">
										<center><h4><u>Maklumat Pembekal</u></h4></center>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										<label style="color: red">*</label><b>Jenis Pembekal</b>
											<select class="form-control" name="jenis" id="jenis" required>
												<option>Sila Pilih</option>	
												<option value="1">Ultiliti</option>
												<option value="2">Penyelenggaraan</option>
												<option value="3">Pengurusan</option>
												<option value="4">Aktiviti Pengimarahan</option>
												<option value="5">Peralatan & Aset</option>
												<option value="6">Lain-Lain</option>
											</select>
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>Nama</b>
											<input class="form-control" name="nama_pembekal" id="nama_pembekal" required>
										</div>
										<div id="no_ic" class="form-group" style="display:none">
											<label style="color: red">*</label><b>No IC / No Syarikat</b>
											<input class="form-control" name="no" id="no" placeholder="Contoh: 880528355036" minlength="12" maxlength="12">	
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>No Telefon</b>
											<input class="form-control" name="no_hp" id="no_hp" placeholder="Contoh: 0143159891" >
										</div>
									</div>
									<!-- /.col-lg-6 (nested) -->
									<div class="col-lg-6">
										<div class="form-group">
											<label style="color: red">*</label><b>Alamat</b>
											<input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat" name="alamat" id="alamat" >
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>Negeri</b>
											<select class="form-control" name="id_negeri" id="id_negeri" onChange="showDaerah(this.value)" >
												<option>Sila Pilih:-</option>
												<?php 
												$sql_negeri="SELECT * FROM negeri";
												$query_negeri=mysql_query($sql_negeri);
												
												while($negeri=mysql_fetch_array($query_negeri))
												{
												?>
												<option value="<?php echo $negeri['id_negeri']; ?>"><?php echo $negeri['name']; ?></option>
												<?php
												}
												?>
											</select>
										</div>		
										<div class="form-group"id="daerah">
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>Poskod</b>
											<input class="form-control" name="poskod" id="poskod" >	                  
										</div>
									</div>
									<!-- /.col-lg-6 (nested) -->
								</div>
								<!-- /.row (nested) -->
								<div class="row">
									<div class="col-lg-12">
										<center>
											Sila isi semua maklumat yang bertanda<label style="color: red">*</label>
										</center>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">	
										<input type="hidden" name="view" id="view" value="<?php echo $view;?>">
										<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
										<input type="hidden" name="user_id" id="user_id" value="<?php echo $datastaff['user_id'];?>">
										<input type="submit" name="insert" id="insert" value="Simpan" class="btn btn-success" />            
									</div>
								</div>
								<br>
								</center>
								</form>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
								</div>
							</div>
							<!-- /.col-lg-12 -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.modal-body -->
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- modal-dialog modal-lg -->
		</div>
		<!-- modal fade -->
		
	</div>
	<!-- /.row --> 
</div>
<script> 
function insertRow(){
	var table=document.getElementById("myTable");
	var row=table.insertRow(table.rows.length);
	var bil=(table.rows.length)-1;
	var cell1=row.insertCell(0);
	cell1.style.textAlign="center";
	cell1.innerHTML = bil;

	cell1=row.insertCell(1);
	cell1.innerHTML = "<input class='form-control' type='text' name='nama_tanggungan[]' placeholder='Nama Penuh' requiredX>";

	cell1=row.insertCell(2);
	cell1.innerHTML = "<input class='form-control' type='text' name='ic_tanggungan[]' placeholder='Contoh: 001223011234' minlength='12' maxlength='12' requiredX>";

	cell1=row.insertCell(3);
	cell1.innerHTML = "<input class='form-control' type='date' name='tarikh_lahir_tanggungan[]' requiredX>";

	cell1=row.insertCell(4);
	cell1.innerHTML = "<input class='form-control' type='text' name='tel_tanggungan[]' requiredX>";
	
	cell1=row.insertCell(5);
	cell1.innerHTML = "<input class='form-control' type='text' name='hubungan_tanggungan[]' requiredX>";

	cell1=row.insertCell(6);
	cell1.innerHTML = "<button class='btn btn-danger btn_remove'onclick='removeRow(this);'>x</button>"; 
}
function removeRow(src){
	var oRow = src.parentElement.parentElement;  
	document.all("myTable").deleteRow(oRow.rowIndex);
} 
function showDaerah(str) {
	if (str == "") {
	document.getElementById("daerah").innerHTML = "";
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
			document.getElementById("daerah").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","admin/getdaerah.php?negeri="+str,true);
		xmlhttp.send();
	}
}
</script>                                                               
                     