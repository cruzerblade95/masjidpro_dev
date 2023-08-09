<?php 

include("connection/connection.php");

$sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini FROM 
sej6x_data_peribadi WHERE id_masjid='$id_masjid' ORDER BY nama_penuh ASC"; 
$result = mysql_query($sql_search) or die ("Error :".mysql_error());

$sql_anak="SELECT a.ID 'ID', a.id_qariah 'id_data', a.nama_penuh 'nama_penuh', a.no_ic 'no_ic', b.nama_penuh 'nama_kariah', b.no_ic 'ic_kariah', b.alamat_terkini 'alamat', a.hubungan 'hubungan' FROM sej6x_data_anakqariah a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_qariah=b.id_data ORDER BY a.nama_penuh ASC";
$result_anak = mysql_query($sql_anak) or die ("Error :".mysql_error());

//untuk sql negeri
$sql_negeri="SELECT id_negeri,name FROM negeri"; 
$result1 = mysql_query($sql_negeri) or die ("Error :".mysql_error());

$options1 = $options1."<option value='0'>Sila Pilih Negeri</option>";  
while($row1=mysql_fetch_array($result1))
{

$options=$options."<option value='$row1[id_negeri]'>$row1[name]</option>";
}

//untuk sql daerah
$sql_daerah="SELECT id_daerah,id_negeri,nama_daerah FROM daerah WHERE id_negeri='$id_negeri'"; 
$result2=mysql_query($sql_daerah) or die ("Error :".mysql_error());

$options3 = $options3."<option value='0'>Sila Pilih Daerah</option>";  
while($row2=mysql_fetch_array($result2))
{
$options4=$options4."<option value='$row2[id_daerah]'>$row2[nama_daerah]</option>";
}

//untuk sql zon kariah
$sql_zonkariah="SELECT id_zonqariah,nama_zon,no_huruf FROM sej6x_data_zonqariah WHERE id_masjid='$id_masjid'"; 
$sql_zon=mysql_query($sql_zonkariah) or die ("Error :".mysql_error());

$options5 = $options5."<option value='0'>Sila Pilih Zon</option>";  
while($row2=mysql_fetch_array($sql_zon))
{
$pilihanzon=$pilihanzon."<option value='$row2[id_zonqariah]'>$row2[no_huruf]: $row2[nama_zon]</option>";
}

?>  
<div class="row">
	<div class="col-lg-12">
		<h1 align="center" class="page-header">AHLI KARIAH</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Maklumat Ahli Kariah&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Tambah Ahli </button>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<!-- Nav Tabs -->
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#ahli_kariah" data-toggle="tab">Ahli Kariah</a>
					</li>
					<li>
						<a href="#anak_tanggungan" data-toggle="tab">Anak Tanggungan</a>
					</li>
				</ul>
				
				<div class="table-responsive">
					<div class="tab-content"> 
						<div class="tab-pane fade in active" id="ahli_kariah">
							<div class="panel-body">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th><div align="center">No</div></th>
											<th><div align="center">Nama</div></th>
											<th><div align="center">No K/P</div></th>
											<th><div align="left">Alamat</div></th>
											<th><div align="center">Tindakan</div></th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$x=1; 
									while($row = mysql_fetch_assoc($result))
									{ 
									?>
										<tr class="odd gradeX">
											<td ><div align="center"><?php echo $x; ?></div></td>
											<td><?php echo $row['nama_penuh']; ?></td>
											<td><div align="center"><?php echo $row['no_ic']; ?></div></td>
											<td ><?php echo $row['alamat_terkini']; ?></td>
											<td>
												<a href="utama.php?view=<?php echo $view;?>&action=view_ahliqariah&id_data=<?php echo $row['id_data'];?>"><button type="button" class="form-control" title="Kemaskini"><i class="glyphicon glyphicon-edit"></i></button></a><br>
												<form name="delete" method="POST" action="pendaftaran/del_ahlikariah.php">
													<input type="hidden" name="del" id="del" value="<?php echo $row['id_data']; ?>">
													<input type="hidden" name="view" id="view" value="<?php echo $view;?>">
													<button type="submit" name="delete" id="delete" class="form-control"  title="Padam"><i class="glyphicon glyphicon-remove" onclick="return confirm('Padam Rekod?');"></i></button>
												</form>                   	
											</td>
										</tr>
									<?php 
									$x++; } 
									?>	
									</tbody>
								</table>
							</div>
						</div>
						<!-- ahli_kariah -->
						<div class="tab-pane fade in active" id="anak_tanggungan">
							<div class="panel-body">
								<table class="table table-striped table-bordered table-hover" id="table-anak">
									<thead>
										<tr>
											<th><div align="center">No</div></th>
											<th><div align="center">Nama Tanggungan</div></th>
											<th><div align="center">No K/P</div></th>
											<th><div align="center">Ahli Kariah</div></th>
											<th><div align="center">No K/P Ahli Kariah</div></th>
											<th><div align="center">Hubungan</div></th>
											<th><div align="center">Tindakan</div></th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$x=1; 
									while($row_anak = mysql_fetch_assoc($result_anak))
									{ 
									?>
										<tr class="odd gradeX">
											<td ><div align="center"><?php echo $x; ?></div></td>
											<td><?php echo $row_anak['nama_penuh']; ?></td>
											<td><div align="center"><?php echo $row_anak['no_ic']; ?></div></td>
											<td><?php echo $row_anak['nama_kariah']; ?>
											<td><?php echo $row_anak['ic_kariah']; ?>
											<td ><?php echo $row_anak['hubungan']; ?></td>
											<td>
												<?php
												$kuiri="SELECT * FROM sej6x_data_peribadi WHERE id_anakqariah='$ID'";
												$kuirirun=mysql_query($kuiri,$bd);
												echo mysql_num_rows($kuirirun);
												if(mysql_num_rows==0)
												{
												?>
												<a href="utama.php?view=<?php echo $view;?>&action=daftar_anakqariah&id=<?php echo $row_anak['ID'];?>"><button type="button" class="form-control" title="Daftar Sebagai Kariah"><i class="glyphicon glyphicon-plus-sign"></i></button></a><br>
												<?php
												}
												?>
												<a href="utama.php?view=<?php echo $view;?>&action=view_anakqariah&id=<?php echo $row_anak['ID'];?>"><button type="button" class="form-control" title="Kemaskini Maklumat"><i class="glyphicon glyphicon-edit"></i></button></a><br>
												<!-- <form name="delete" method="POST" action="pendaftaran/del_ahlikariah.php">
													<input type="hidden" name="del" id="del" value="<?php echo $row_anak['ID']; ?>">
													<input type="hidden" name="view" id="view" value="<?php echo $view;?>">
													<button type="submit" name="delete" id="delete" class="form-control"  title="Padam"><i class="glyphicon glyphicon-remove" onclick="return confirm('Padam Rekod?');"></i></button>
												</form> -->               	
											</td>
										</tr>
									<?php 
									$x++; } 
									?>	
									</tbody>
								</table>
							</div>
						</div>
						<!-- anak_tanggungan -->
					</div>
					<!-- tab-content -->
				</div>
				<!-- table-responsive -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">BORANG KEAHLIAN KARIAH</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-info">
								<div class="panel-body">
									<form method="post" id="insert_form" action="pendaftaran/add_daftarqariah.php">
									<?php 
									include("connection/connection.php");

									$sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid'"; 
									$result = mysql_query($sql_search) or die ("Error :".mysql_error());  
									?>          
									<div class="row">
										<h4 align="center"><u>Maklumat Ahli</u></h4>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label style="color: red">*</label><b>Nama Penuh</b>
												<input class="form-control" name="nama_penuh" id="nama_penuh" required>
											</div>
											<div class="form-group">
												<label style="color: red">*</label><b>No. K/P</b>
												<input class="form-control" name="no_ic" id="no_ic" placeholder="Contoh: 880528355036" minlength="12" maxlength="12" required>	
											</div>
											<div class="form-group">
												<label style="color: red">*</label><b>No Telefon</b>
												<input class="form-control" name="no_hp" id="no_hp" placeholder="Contoh: 0143159891" required>
											</div>
											<div class="form-group">
												<label style="color: red">*</label><b>Umur</b>
												<input class="form-control" name="umur" id="umur" required>
											</div>
											<div class="form-group">
												<label style="color: red">*</label><b>Tarikh Lahir</b>
												<input class="form-control" name="tarikh_lahir" id="tarikh_lahir" placeholder="Contoh: 1992-05-30" type="date" required>	
											</div>
											<div class="form-group">
											<label style="color: red">*</label><b>Jantina</b>
												<select class="form-control" name="jantina" id="jantina" required>
													<option value="0">Sila Pilih</option>							
													<option value="1">Lelaki</option>
													<option value="2">Perempuan</option>
												</select>
											</div>
										</div>
										<!-- /.col-lg-4 (nested) -->
										<div class="col-lg-4">	
											<div class="form-group">
												<label style="color: red">*</label><b>Bangsa</b>
												<select class="form-control" name="bangsa" id="bangsa" required>
													<option value="0">Sila Pilih</option>
													<option value="1">Melayu</option>
													<option value="2">Cina</option>
													<option value="3">India</option>
													<option value="4">Lain-lain</option>
												</select>
											</div>
											<div class="form-group">
												<label style="color: red">*</label><b>Warganegara</b>
												<select class="form-control" name="warganegara" id="warganegara" required>
													<option value="0">Sila Pilih</option>							
													<option value="1">Warganegara</option>
													<option value="2">Bukan Warganegara</option>
												</select>
											</div>
											<div class="form-group">
												<label style="color: red">*</label><b>Status Perkahwinan</b>
												<select class="form-control" name="status_perkahwinan" id="status_perkahwinan" required>
													<option value="0">Sila Pilih</option>
													<option value="1">Bujang</option>
													<option value="2">Berkahwin</option>
													<option value="3">Duda</option>
													<option value="4">Janda</option>
												</select>
											</div>
											<div class="form-group">
												<label style="color: red">*</label><b>Pekerjaan</b>
												<input class="form-control" name="pekerjaan" id="pekerjaan" required>	                  
											</div> 
											<div class="form-group">
												<label style="color: red">*</label><b>Tempoh Tinggal di Kariah</b>
												<input class="form-control" name="tempoh_tinggal" id="tempoh_tinggal" required>	                  
											</div> 
											<div class="form-group" id="zon">
												<label style="color: red">*</label><b>Zon Kariah</b>
												<select class="form-control" name="zon_qariah" id="zon_qariah" required>
													<?php echo $options5;?> <?php echo $pilihanzon;?> 
												</select>
											</div>
										</div>
										<!-- /.col-lg-4 (nested) -->
										<div class="col-lg-4">
											<div class="form-group">
												<label style="color: red">*</label><b>No Rumah (Alamat Terkini)</b>
												<input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat" name="alamat_terkini" id="alamat_terkini" required>
											</div>
											<div class="form-group">
												<label style="color: red">*</label><b>Negeri</b>
												<select class="form-control" name="id_negeri" id="id_negeri" onChange="showDaerah(this.value)" required>
													<?php echo $options1;?> <?php echo $options;?>
												</select>
											</div>		
											<div class="form-group"id="daerah">
											</div>
											<div class="form-group">
												<label style="color: red">*</label><b>Poskod</b>
												<input class="form-control" name="poskod" id="poskod" required>	                  
											</div>
											<br>
											<br>
												Sila isi semua maklumat yang bertanda<label style="color: red">*</label>
										</div>
										<!-- /.col-lg-4 (nested) -->
									</div>
									<!-- /.row (nested) -->
									
									<div class="row">
										<h4 align="center"><u>Catatan Masjid</u></h4>

										<div class="col-lg-4">
											<div class="form-group">
												<label style="color: red">*</label><b>Warga Emas</b>
												<select class="form-control" name="warga_emas" id="warga_emas" required>
													<option value="0">Sila Pilih</option>
													<option value="1">Ya</option>
													<option value="2">Tidak</option>
												</select>	            
											</div>
										</div>
										<!-- /.col-lg-4 (nested) -->
										<div class="col-lg-4">	
											<div class="form-group">
												<label style="color: red">*</label><b>Wajib Solat Jumaat</b>
												<select class="form-control" name="solat_jumaat" id="solat_jumaat" required>
													<option value="0">Sila Pilih</option>
													<option value="1">Ya</option>
													<option value="2">Tidak</option>
												</select>	            
											</div>
										</div>
										<!-- /.col-lg-4 (nested) -->
										<div class="col-lg-4">	
											<div class="form-group">
												<label style="color: red">*</label><b>OKU</b>
												<select class="form-control" name="oku" id="oku" required>
													<option value="0">Sila Pilih</option>
													<option value="1">Ya</option>
													<option value="2">Tidak</option>
												</select>	            
											</div>
										</div>
										<!-- /.col-lg-4 (nested) -->
									</div>

									<div class="row">
										<h4 align="center"><u>Tanggungan Anak Kariah</u></h4>

										<div class="col-lg-12">
											<div class="form-group">
												<table class="table table-bordered" id="myTable">
													<tr>
														<th align="middle">Bil</th>
														<th>Nama Tanggungan</th>
														<th>No Kad Pengenalan</th>
														<th>Tarikh Lahir</th>
														<th>Hubungan</th>
														<th></th>
													</tr>
													<tr>
														<td align="middle">1</td>
														<td><input class="form-control" type="text" name="nama_tanggungan[]" placeholder="Nama Penuh" requiredX></td>
														<td><input class="form-control" type="text" name="ic_tanggungan[]" placeholder="Contoh: 001223011234" minlength="12" maxlength="12" requiredX></td>
														<td><input class="form-control" type="date" name="tarikh_lahir_tanggungan[]" requiredX></td>
														<td><input class="form-control" type="text" name="hubungan_tanggungan[]" requiredX></td>
														<td><button type="button" name="add" id="add" onClick="insertRow()" class="btn btn-success">+</button></td>
													</tr>
												</table>
											</div>
										</div>
									</div>

									<div class="row">
									<center>
										<div class="col-lg-12">	
											<input type="hidden" name="view" id="view" value="<?php echo $view;?>">
											<input type="hidden" name="user_id" id="user_id" value="<?php echo $datastaff['user_id'];?>">
											<input type="submit" name="insert" id="insert" value="Simpan" class="btn btn-success" />            
										</div>
									</center>
									</div>
									</form>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
									</div>
								</div>
								<!-- /.panel-body -->
							</div>
							<!-- /.panel pnael-info -->
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
	cell1.innerHTML = "<input class='form-control' type='text' name='hubungan_tanggungan[]' requiredX>";

	cell1=row.insertCell(5);
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
$(document).ready(function() {
	$('#table-anak').DataTable();
} );
</script>                                                               
                     