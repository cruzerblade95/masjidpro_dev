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
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css"> -->
<script src="js/jquery-3.4.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#table_anak').DataTable();
} );
</script>
<script>
$(document).ready(function() {
    $('#table_kariah').DataTable();
} );
</script>
<script>
function checkIC()
{
	var ic=document.getElementById('no_ic').value;
	
	if(ic)
	{
		$.ajax({
			type: 'post',
			url: 'checkic.php',
			data: {
			no_ic:ic,
			},
			success:function(html) {
				$('#availability').html(html);
				if(html=="<small class='help-block form-text text-danger'>No K/P Telah Berdaftar</small>")
				{
					$('#no_ic').removeClass("form-control is-valid").addClass("is-invalid form-control");
					$('#insert').prop('disabled',true);
				}
				else if(html=="<small class='help-block form-text text-success'>No K/P Belum Digunakan</small>")
				{
					$('#no_ic').removeClass("form-control is-invalid").addClass("is-valid form-control");
					$('#insert').prop('disabled',false);
				}
			}
		});
	}
}
</script>
<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
  <!-- <script>
  $( function() {
    $( "#tarikh_lahir" ).datepicker({
		dateFormat:'dd-mm-yy'
	});
  } );
  </script> -->
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Menu Ahli Kariah</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li class="active">Menu Ahli Kariah</li>
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
					Maklumat Ahli Kariah&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
					<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Tambah Ahli </button>
				</div>
				<!-- /.panel-heading -->
				<div class="card-body">
					<!-- Nav Tabs -->
					<ul class="nav nav-pills nav-justified mb-3 mt-2" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#ahli_kariah" role="tab" aria-controls="pills-home" aria-selected="true" onClick="showKariah()">Ahli Kariah</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#anak_tanggungan" role="tab" aria-controls="pills-profile" aria-selected="false" onClick="showAnak()">Anak Tanggungan</a>
						</li>
					</ul>
					<div id="ahli_kariah" class="table-responsive">
						<table id="table_kariah" class="table table-striped table-bordered">
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
										<a href="utama.php?view=<?php echo $view;?>&action=view_ahliqariah&id_data=<?php echo $row['id_data'];?>"><button type="button" class="form-control" title="Kemaskini"><i class="fas fa-user-edit"></i></button></a><br>
										<form name="delete" method="POST" action="pendaftaran/del_ahlikariah.php" enctype="multipart/form-data">
											<input type="hidden" name="del" id="del" value="<?php echo $row['id_data']; ?>">
											<input type="hidden" name="view" id="view" value="<?php echo $view;?>">
											<button type="submit" name="delete" id="delete" class="form-control"  title="Padam"><i class="fas fa-user-minus" onclick="return confirm('Padam Rekod?');"></i></button>
										</form>                   	
									</td>
								</tr>
							<?php 
							$x++; } 
							?>	
							</tbody>
						</table>
						<!-- table -->
					</div>
					<div id="anak_tanggungan" style="display:none" class="table-responsive">
						<table id="table_anak" class="table table-striped table-bordered">
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
									<td align="center"><?php echo $x; ?></td>
									<td><?php echo $row_anak['nama_penuh']; ?></td>
									<td align="center"><?php echo $row_anak['no_ic']; ?></td>
									<td><?php echo $row_anak['nama_kariah']; ?>
									<td align="center"><?php echo $row_anak['ic_kariah']; ?>
									<td align="center"><?php echo $row_anak['hubungan']; ?></td>
									<td align="center">
										<?php
										//$ID=$row_anak['ID'];
										//$kuiri="SELECT * FROM sej6x_data_peribadi WHERE id_anakqariah='$ID'";
										//$kuirirun=mysql_query($kuiri,$bd);
										//mysql_num_rows($kuirirun);
										//if(mysql_num_rows==0)
										//{
										?>
										<!--<a href="utama.php?view=<?php echo $view;?>&action=daftar_anakqariah&id=<?php //echo $row_anak['ID'];?>"><button type="button" class="form-control" title="Daftar Sebagai Kariah"><i class=" fas fa-user-plus"></i></button></a><br>-->
										<?php
										//}
										?>
										<!-- <a href="utama.php?view=<?php echo $view;?>&action=view_anakqariah&id=<?php echo $row_anak['ID'];?>"> -->
										<button type="button" class="form-control" title="Kemaskini Maklumat" data-toggle="modal" data-target="#editAnak" value="<?php echo $row_anak['ID'];?>" onClick="displayAnak(this.value)"><i class="fas fa-user-edit"></i></button>
										<!-- </a><br> -->
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
						<h4 class="modal-title" id="myModalLabel">BORANG KEAHLIAN KARIAH</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<form method="post" id="insert_form" action="pendaftaran/add_daftarqariah.php" enctype="multipart/form-data">
								<center>
								<?php 
								include("connection/connection.php");

								$sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid'"; 
								$result = mysql_query($sql_search) or die ("Error :".mysql_error());  
								?>          
								<div class="row">
									<div class="col-lg-12">
										<center><h4><u>Maklumat Ahli</u></h4></center>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label style="color: red">*</label><b>Nama Penuh</b>
											<input class="form-control" name="nama_penuh" id="nama_penuh" required>
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>No. K/P</b>
											<input class="form-control" name="no_ic" id="no_ic" placeholder="Contoh: 880528355036" minlength="12" maxlength="12" required onChange="myFunction()" onKeyUp="checkIC()">	
											<span id="availability"></span>
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
												<option value="">Sila Pilih</option>							
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
												<option value="">Sila Pilih</option>
												<option value="1">Melayu</option>
												<option value="2">Cina</option>
												<option value="3">India</option>
												<option value="4">Lain-lain</option>
											</select>
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>Warganegara</b>
											<select class="form-control" name="warganegara" id="warganegara" required>
												<option value="">Sila Pilih</option>							
												<option value="1">Warganegara</option>
												<option value="2">Bukan Warganegara</option>
											</select>
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>Status Perkahwinan</b>
											<select class="form-control" name="status_perkahwinan" id="status_perkahwinan" required>
												<option value="">Sila Pilih</option>
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
											<select class="form-control" name="zon_qariah" id="zon_qariah">
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
											<label style="color: red">*</label><b>Poskod</b>
											<input class="form-control" name="poskod" id="poskod" required>	                  
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>Negeri</b>
											<select class="form-control" name="id_negeri" id="id_negeri" onChange="showDaerah(this.value)" required>
												<?php echo $options1;?> <?php echo $options;?>
											</select>
										</div>		
										<div class="form-group"id="daerah">
										</div>
										
										<br>
										<br>
											Sila isi semua maklumat yang bertanda<label style="color: red">*</label>
									</div>
									<!-- /.col-lg-4 (nested) -->
								</div>
								<!-- /.row (nested) -->
								<hr>
								<div class="row">
									<div class="col-lg-12">
										<center><h4><u>Muat-Naik Dokumen Pembuktian Warga Kariah</u></h4></center>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12 col-12">
										<label>Bil Utiliti / Lain-lain Dokumen</label>
										<input class="form-control" type="file" name="fileToUpload" id="fileToUpload" accept=".jpg, .png, .gif, .jpeg, .pdf">
										<input type="hidden" id="kod_masjid_form" name="kod_masjid_form" value="<?php echo($_SESSION['kod_masjid']); ?>">
									</div>	
								</div>
									<hr>
								<div class="row">
									<div class="col-lg-12">
										<center><h4><u>Catatan Masjid</u></h4></center>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label style="color: red">*</label><b>Warga Emas</b>
											<select class="form-control" name="warga_emas" id="warga_emas" required>
												<option value="">Sila Pilih</option>
												<option value="1">Ya</option>
												<option value="2">Tidak</option>
											</select>	            
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>Layak Mengundi</b>
											<select class="form-control" name="layak_mengundi" id="layak_mengundi" required>
												<option value="">Sila Pilih</option>
												<option value="1">Ya</option>
												<option value="2">Tidak</option>
											</select>	            
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>Ibu Tunggal</b>
											<select class="form-control" name="ibu_tunggal" id="ibu_tunggal" required>
												<option value="">Sila Pilih</option>
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
												<option value="">Sila Pilih</option>
												<option value="1">Ya</option>
												<option value="2">Tidak</option>
											</select>	            
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>Anak Yatim</b>
											<select class="form-control" name="anak_yatim" id="anak_yatim" required>
												<option value="">Sila Pilih</option>
												<option value="1">Ya</option>
												<option value="2">Tidak</option>
											</select>	            
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>Sakit Kronik</b>
											<select class="form-control" name="sakit_kronik" id="sakit_kronik" required>
												<option value="">Sila Pilih</option>
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
												<option value="">Sila Pilih</option>
												<option value="1">Ya</option>
												<option value="2">Tidak</option>
											</select>	            
										</div>
										<div class="form-group">
											<label style="color: red">*</label><b>Asnaf</b>
											<select class="form-control" name="asnaf" id="asnaf" required>
												<option value="">Sila Pilih</option>
												<option value="1">Ya</option>
												<option value="2">Tidak</option>
											</select>	            
										</div>
									</div>
									<!-- /.col-lg-4 (nested) -->
								</div>
								<hr>
								<div class="row">
									<div class="col-lg-12">
										<center><h4><u>Tanggungan Anak Kariah</u></h4></center>
									</div>
								</div>
								<hr>
									<script>
	mula_index = 0;
    id_butang_add = 'add_rekod_item';
    id_borang_dinamik = 'borang_rekod';
	id_baris = 'baris';
	class_remove_btn = 'btn_remove';
	data_dinamik = '<div class="col-md-12 form-group"><h4>Maklumat Tanggungan</h4></div><div class="col-md-12 form-group"><label>Nama Tanggungan</label><input class="form-control" type="text" name="nama_tanggungan[]" placeholder="Nama Penuh" required></div><div class="col-md-4"><label>No Kad Pengenalan</label><input class="form-control" type="text" name="ic_tanggungan[]" placeholder="Contoh: 001223011234" minlength="12" maxlength="12"></div><div class="col-md-4"><label>Tarikh Lahir</label><input class="form-control" type="date" name="tarikh_lahir_tanggungan[]"></div><div class="col-md-4"><label>No Telefon</label><input class="form-control" type="text" name="tel_tanggungan[]"></div><div class="col-md-4"><label>Hubungan</label><input class="form-control" type="text" name="hubungan_tanggungan[]" required></div><div class="col-md-4"><label>OKU</label><select class="form-control" type="text" name="tanggung_oku[]" requiredX><option value="0">Sila Pilih</option><option value="Y">Ya</option><option value="N">Tidak</option></select></div><div class="col-md-4"><label>Status Kahwin</label><select class="form-control" type="text" name="tanggung_kahwin[]" requiredX><option value="0">Sila Pilih</option><option value="1">Bujang</option><option value="2">Berkahwin</option><option value="3">Duda</option><option value="4">Janda</option><option value="5">Ibu Tunggal</option></select></div><div class="col-md-4"><label>Sakit Kronik</label><select class="form-control" type="text" name="tanggung_sakitkronik[]" requiredX><option value="0">Sila Pilih</option><option value="Y">Ya</option><option value="N">Tidak</option></select></div><div class="col-md-4"><label>Asnaf</label><select class="form-control" type="text" name="tanggung_asnaf[]" requiredX><option value="0">Sila Pilih</option><option value="Y">Ya</option><option value="N">Tidak</option></select></div>';
</script>
								<div id="borang_rekod"></div>
									<div class="row"><div class="col" align="right"><button id="add_rekod_item" type="button" class="btn btn-success">Tambah</button></div></div>
									<?php if($page_lama == 1) { ?>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group table-responsive">
											<table class="table table-bordered" id="myTable">
												<tr>
													<th align="middle">Bil</th>
													<th>Nama Tanggungan</th>
													<th>No Kad Pengenalan</th>
													<th>Tarikh Lahir</th>
													<th>No Telefon</th>
													<th>Hubungan</th>
													<th>Oku</th>
            										<th>Status Kahwin</th>
            										<th>Sakit Kronik</th>
            										<th>Asnaf</th>
													<th></th>
												</tr><!-- <tr style="display:none">
													<td align="middle">1</td>
													<td><input class="form-control" type="text" name="nama_tanggungan[]" placeholder="Nama Penuh" requiredX></td>
													<td><input class="form-control" type="text" name="ic_tanggungan[]" placeholder="Contoh: 001223011234" minlength="12" maxlength="12" requiredX></td>
													<td><input class="form-control" type="date" name="tarikh_lahir_tanggungan[]" requiredX></td>
													<td><input class="form-control" type="text" name="tel_tanggungan[]" requiredX></td>
													<td><input class="form-control" type="text" name="hubungan_tanggungan[]" requiredX></td>
													<td><button type="button" name="add" id="add" onClick="insertRow()" class="btn btn-success">+</button></td>
												</tr> -->
											</table>
											<center>
												<button type="button" name="add" id="add" onClick="insertRow()" class="btn btn-success">+</button>
											</center>
										</div>
									</div>
								</div>
									<?php } ?>
									
								<div class="row">
									<div class="col-lg-12">	
										<input type="hidden" name="view" id="view" value="<?php echo $view;?>">
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
		
		<div class="modal fade" id="editAnak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">BORANG KEAHLIAN KARIAH</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<form method="post" id="insert_form" action="pendaftaran/update_anakqariah.php" enctype="multipart/form-data">
					<?php 
					include("connection/connection.php");

					$sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid'"; 
					$result = mysql_query($sql_search) or die ("Error :".mysql_error());  
					?> 
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<center><h4><u>Maklumat Tanggungan Kariah</u></h4></center>
							</div>
						</div>	
						<hr>
						<div id="anak_kariah">
						</div>
						<hr>
						<div class="row">
							<div class="col-lg-12">	
						`	<center>
								<input type="hidden" name="view" id="view" value="<?php echo $view;?>">
								<input type="hidden" name="user_id" id="user_id" value="<?php echo $datastaff['user_id'];?>">
								<input type="submit" name="insert1" id="insert1" value="Simpan" class="btn btn-success" />            
							</center>
							</div>
						</div>
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
	cell1.innerHTML = "<input class='form-control' type='text' name='nama_tanggungan[]' placeholder='Nama Penuh' required>";

	cell1=row.insertCell(2);
	cell1.innerHTML = "<input class='form-control' type='text' name='ic_tanggungan[]' placeholder='Contoh: 001223011234' minlength='12' maxlength='12'>";

	cell1=row.insertCell(3);
	cell1.innerHTML = "<input class='form-control' type='date' name='tarikh_lahir_tanggungan[]'>";

	cell1=row.insertCell(4);
	cell1.innerHTML = "<input class='form-control' type='text' name='tel_tanggungan[]'>";
	
	cell1=row.insertCell(5);
	cell1.innerHTML = "<input class='form-control' type='text' name='hubungan_tanggungan[]' required>";

	cell1=row.insertCell(6);
	cell1.innerHTML = "<select class='form-control' type='text' name='tanggung_oku[]' requiredX>" +
					  "<option value='0'>Sila Pilih</option>" +
					  "<option value='Y'>Ya</option>" +
					  "<option value='N'>Tidak</option>" +
					  "</select>";

	cell1=row.insertCell(7);
	cell1.innerHTML = "<select class='form-control' type='text' name='tanggung_kahwin[]' requiredX>" +
					  "<option value='0'>Sila Pilih</option>" +
					  "<option value='1'>Bujang</option>" +
					  "<option value='2'>Berkahwin</option>" +
					  "<option value='3'>Duda</option>" +
					  "<option value='4'>Janda</option>" +
					  "<option value='5'>Ibu Tunggal</option>" +
					  "</select>";

  	cell1=row.insertCell(8);
	cell1.innerHTML = "<select class='form-control' type='text' name='tanggung_sakitkronik[]' requiredX>" +
					  "<option value='0'>Sila Pilih</option>" +
					  "<option value='Y'>Ya</option>" +
					  "<option value='N'>Tidak</option>" +
					  "</select>";

  	cell1=row.insertCell(9);
	cell1.innerHTML = "<select class='form-control' type='text' name='tanggung_asnaf[]' requiredX>" +
					  "<option value='0'>Sila Pilih</option>" +
					  "<option value='Y'>Ya</option>" +
					  "<option value='N'>Tidak</option>" +
					  "</select>";

	cell1=row.insertCell(10);
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

function showAnak() {
	document.getElementById('ahli_kariah').style.display = "none";
	document.getElementById('anak_tanggungan').style.display = "block";
}
function showKariah() {
	document.getElementById('ahli_kariah').style.display = "block";
	document.getElementById('anak_tanggungan').style.display = "none";
}

function displayAnak(str){
	{
	if (str == "") {
	document.getElementById("anak_kariah").innerHTML = "";
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
			document.getElementById("anak_kariah").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","admin/getdataanak.php?ID="+str,true);
		xmlhttp.send();
	}
}
}
function myFunction(){
	var tl = document.getElementById('no_ic').value;
	var date = tl.substr(0,6);
	var year = tl.substr(0,2);
	var month = tl.substr(2,2);
	var day = tl.substr(4,2);
	
	if(year > 30)
	{
		year = 19+year;
	}
	else if(year < 31)
	{
		year = 20+year;
	}
	
	var tarikh = year+'-'+month+'-'+day;
	document.getElementById('tarikh_lahir').value = tarikh;
	
	var today = new Date();
	var dd = String(today.getDate()).padStart(2,'0');
	var mm = String(today.getMonth()+1).padStart(2,'0');
	var yyyy = today.getFullYear();
	
	today = yyyy+'-'+mm+'-'+dd;
	
	var umur = parseInt(yyyy) - parseInt(year);
	var umur_bulan = parseInt(mm) - parseInt(month);
	if(umur_bulan < 0 )
	{
		umur = parseInt(umur) - 1;
	}
	else if(umur_bulan == 0 )
	{
		var umur_hari = parseInt(dd) - parseInt(day);
		
		if(umur_hari < 0 ) 
		{
			umur = parseInt(umur) - 1;
		}
	}
	
	document.getElementById('umur').value = umur;
	
	if(umur > 59)
	{
		document.getElementById('warga_emas').selectedIndex = "1";
		//document.getElementById('warga_emas').value = "Ya";
	}
	else if(umur < 60)
	{
		document.getElementById('warga_emas').selectedIndex = "2";
		//document.getElementById('warga_emas').value = "Tidak";
	}
	
}

</script>                                                               
                     