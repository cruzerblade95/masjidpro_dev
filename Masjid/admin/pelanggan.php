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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<script>
$(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Menu Penyumbang</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=kewangan">Menu Kewangan</a></li>
					<li class="active">Menu Penyumbang</li>
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
					Senarai Penyumbang&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
					<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Tambah Penyumbang </button>
				</div>
				<!-- /.panel-heading -->
				<div class="card-body">
					<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="3%"><div align="center">No</div></th>
								<th width="52%"><div align="center">Nama Penyumbang</div></th>
								<th width="15%"><div align="center">Kategori</div></th>
								<th width="15%"><div align="center">No Telefon</div></th>
								<th width="15%"><div align="center">Sumbangan</div></th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$x=1; 
						$sql="SELECT * FROM sej6x_data_pelanggan WHERE id_masjid='$id_masjid'";
						$sqlquery=mysql_query($sql,$bd);
						
						while($data=mysql_fetch_array($sqlquery))
						{ 
						?>
							<tr>
								<td align="center"><div align="center"><?php echo $x; ?></div></td>
								<td><?php echo $data['nama_pelanggan']; ?></td>
								<td align="center"><?php echo $data['kategori']; ?></td>
								<td align="center"><?php echo $data['no_telefon']; ?></td>
								<td align="center">
									<!-- 
									<a href="utama.php?view=admin&action=sumbangan&id_pelanggan=<?php //echo $data['id_pelanggan']; ?>" class="btn btn-info btn-sm btn-block">
										<i class="fas fa-file-invoice-dollar"></i>
										<br>Sumbang
									</a> -->
									<button class="btn btn-info btn-sm btn-block" type="button" data-toggle="modal" data-target="#modalSumbangan" onClick="showSumbangan(<?php echo $data['id_pelanggan']; ?>)"><i class="fas fa-file-invoice-dollar"></i><br>Sumbang</button>
								</td>
							</tr>
						<?php 
						$x++; } 
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
						<h4 class="modal-title" id="myModalLabel">BORANG DAFTAR PENYUMBANG</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<form method="post" id="insert_form" action="admin/add_pelanggan.php">
								<center>          
								<div class="row">
									<div class="col-lg-12">
										<center><h4><u>Maklumat Penyumbang</u></h4></center>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										<label style="color: red">*</label><b>Kategori</b>
											<select class="form-control" name="kategori" id="kategori" required>
												<option>Sila Pilih</option>							
												<option value="Ahli Kariah">Ahli Kariah</option>
												<option value="Orang Awam">Orang Awam</option>
												<option value="Jabatan">Jabatan</option>
												<option value="Korporat">Korporat</option>
											</select>
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>Nama</b>
											<input class="form-control" name="nama_pelanggan" required>
										</div>
										<div id="no_ic" class="form-group" >
											<label style="color: red">*</label><b>No IC / No Syarikat</b>
											<input class="form-control" name="no_pelanggan" placeholder="Contoh: 880528355036" required>	
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>No Telefon</b>
											<input class="form-control" name="no_telefon" id="no_telefon" placeholder="Contoh: 0143159891" required>
										</div>
									</div>
									<!-- /.col-lg-6 (nested) -->
									<div class="col-lg-6">
										<div class="form-group">
											<label style="color: red">*</label><b>Alamat</b>
											<input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat" name="alamat" id="alamat" required>
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>Negeri</b>
											<select class="form-control" name="id_negeri" id="id_negeri" onChange="showDaerah(this.value)" required>
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
											<input class="form-control" name="poskod" id="poskod" required>	                  
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
										<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
										<input type="hidden" name="view" id="view" value="<?php echo $view;?>">
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
		
		<div class="modal fade" id="modalSumbangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">BORANG DAFTAR PENYUMBANG</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div id="sumbangan">
						
						</div>
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
function showSumbangan(str) {
	if (str == "") {
	document.getElementById("sumbangan").innerHTML = "";
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
			document.getElementById("sumbangan").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","admin/getsumbangan.php?id_pelanggan="+str,true);
		xmlhttp.send();
	}
}
</script>                                                               
                     