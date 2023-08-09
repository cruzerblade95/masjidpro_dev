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
				<h1>Menu Jenis Pendapatan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=kewangan">Menu Kewangan</a></li>
					<li class="active">Menu Jenis Pendapatan</li>
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
					Jenis-Jenis Pendapatan&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
					<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Tambah Jenis Pendapatan </button>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				</div>
				<!-- /.panel-heading -->
				<div class="card-body">
					<div class="table-responsive">
						<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th width="3%"><div align="center">#</div></th>
									<th width="57%"><div align="center">Nama Kutipan</div></th>
									<th width="20%"><div align="center">Kategori</div></th>
									<th width="20%"><div align="center">Tindakan</div></th>
								</tr>
							</thead>
							<tbody>
								<?php
								
								$i=1;
								$sql="SELECT * FROM sej6x_data_jeniskutipan WHERE id_masjid='$id_masjid' ORDER BY kategori ASC";
								$sqlquery=mysql_query($sql,$bd);
								$row=mysql_num_rows($sqlquery);
								
								if($row>0)
								{
									while($data=mysql_fetch_array($sqlquery))
									{
									?>	
								<tr>
									<td align="center"><?php echo $i; ?></td>
									<td align="center"><?php echo $data['nama_kutipan']; ?></td>
									<td align="center">
									<?php 
									$kategori=$data['kategori'];
									if($kategori=='1'){
										echo "Kutipan";
									}
									else if($kategori=='2'){
										echo "Aktiviti Ekonomi";
									}
									else if($kategori=='3'){
										echo "Lain-Lain";
									}
									?>
									</td>
									<td align="center"><a href="utama.php?view=admin&action=sumbangan&id_kutipan=<?php echo $data['id_kutipan']; ?>" class="btn btn-info btn-sm btn-block"><i class="fas fa-file-invoice-dollar"></i><br>Sumbang</a></td>
								</tr>
									<?php
									$i++;
									}
								}
								else if($row==0)
								{
								?>
								<tr>
									<td colspan="3" align="center">*Tiada Rekod*</td>
								</tr>
								<?php
								}
								?>
							</tbody>
						</table>
						<!-- table -->
					</div>			
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
						<h4 class="modal-title" id="myModalLabel">TAMBAH JENIS PENDAPATAN</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<form method="post" id="insert_form" action="admin/add_jenis_kutipan.php">
								<center>          
								<div class="row">
									<div class="col-lg-12">
										<center><h4><u>Maklumat Jenis Pendapatan</u></h4></center>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-lg-3">
									
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label style="color: red">*</label><b>Tabung</b>
											<select class="form-control" name="tabung" id="tabung" required>
												<option>Sila Pilih:-</option>
												<?php
												$sql1="SELECT * FROM sej6x_data_jenistabung WHERE id_masjid='$id_masjid'";
												$sqlquery1=mysql_query($sql1,$bd);
												
												while($data1=mysql_fetch_array($sqlquery1))
												{
												?>
												<option value="<?php echo $data1['id_tabung']; ?>"><?php echo $data1['nama_tabung']; ?></option>
												<?php
												}
												?>
											</select>
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>Kategori</b>
											<select class="form-control" name="kategori" id="kategori" required>
												<option>Sila Pilih:-</option>							
												<option value="1">Kutipan</option>
												<option value="2">Aktiviti Ekonomi</option>
												<option value="3">Lain-Lain</option>
											</select>
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>Nama Kutipan</b>
											<input class="form-control" name="nama_kutipan" id="nama_kutipan" required>
										</div>
									</div>
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
										<input type="hidden" name="user_id" id="user_id" value="<?php echo $datastaff['user_id'];?>">
										<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
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
</script>                                                               
                     