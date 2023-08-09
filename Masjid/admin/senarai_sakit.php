<?php

	include('connection/connection.php');
	
?>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    $('#table_anak').DataTable();
} );
</script>		  
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Senarai Sakit Kronik</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li><a href="utama.php?view=admin&action=pendaftaran_sakit_kronik">Daftar Sakit Kronik</a></li>
					<li class="active">Senarai Sakit Kronik</li>
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
					Senarai Pesakit Kronik
				</div>
				<div class="card-body">
					<ul class="nav nav-pills nav-justified mb-3 mt-2" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#ahli_kariah" role="tab" aria-controls="pills-home" aria-selected="true" onClick="showKariah()">Ahli Kariah</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#anak_tanggungan" role="tab" aria-controls="pills-profile" aria-selected="false" onClick="showAnak()">Tanggungan</a>
						</li>
					</ul>
					<hr>
					<div id="ahli_kariah"> 
					<b>Klik Icon
					<?php
					include("excel/excel_sakit.php");
					$path = "output/".$kod_masjid."/SenaraiSakitKronik.xlsx";
					?> Untuk Muat Turun Hasil Carian Ahli Kariah</b><img src="picture/excel1.jpg" height="47" width="50" onClick="window.location.href=window.location='<?php echo $path; ?>'" style="cursor:pointer;">
						             	                               
						<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">No IC</div></th>
									<th><div align="center">Jenis Penyakit</div></th>
									<th><div align="center">Rawatan Terkini</div></th>
									<th><div align="center">Tindakan</div></th>
									<th><div align="center"></div></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								
								$sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', a.no_ic 'no_ic', b.jenis_penyakit 'jenis_penyakit', b.rawatan_terkini 'rawatan_terkini', b.id_sakit 'id_sakit' FROM sej6x_data_peribadi a, sej6x_data_sakit b WHERE  a.id_data=b.id_data AND a.id_masjid='$id_masjid'";
								$sqlquery=mysql_query($sql,$bd);
								
								$x=1; 
								while($data = mysql_fetch_assoc($sqlquery)){ 
								?> 
								<tr>
									<td align="center"><?php echo $x; ?></td>
									<td><?php echo $data['nama_penuh']; ?></td>
									<td align="center"><?php echo $data['no_ic']; ?></td>
									<td align="center"><?php echo $data['jenis_penyakit']; ?></td>
									<td align="center"><?php echo $data['rawatan_terkini']; ?></td>
									<td align="center"><a href="utama.php?view=admin&action=semak_sakit&id_data=<?php echo $data['id_data'];?>">[Semak]</a></td>
									<td>
										<div align="center">
											<form name="delete" method="POST" action="admin/del_sakit.php">
												<input type="hidden" name="del" id="del" value="<?php echo $data['id_data']; ?>">
												<button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam"><i class="fa fa-times"></i></button>
											</form>
										</div> 
								  </td>
								</tr>
								<?php  
								$x++; 
								}
								?>  
							</tbody>
						</table>
					</div>
					<div id="anak_tanggungan" style="display:none">
						<b>Klik Icon
					<?php
					include("excel/excel_sakit_t.php");
					$pathT = "output/".$kod_masjid."/SenaraiSakitKronikTanggungan.xlsx";
					?> Untuk Muat Turun Hasil Carian Tanggungan</b>	<img src="picture/excel1.jpg" height="47" width="50" onClick="window.location.href=window.location='<?php echo $pathT; ?>'" style="cursor:pointer;">
						<table id="table_anak" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">No IC</div></th>
									<th><div align="center">Jenis Penyakit</div></th>
									<th><div align="center">Rawatan Terkini</div></th>
									<th><div align="center">Tindakan</div></th>
									<th><div align="center"></div></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								
								$sql1="SELECT a.ID 'ID', a.nama_penuh 'nama_penuh', a.no_ic 'no_ic', b.jenis_penyakit 'jenis_penyakit', b.rawatan_terkini 'rawatan_terkini', b.id_sakit 'id_sakit' FROM sej6x_data_anakqariah a, sej6x_data_sakit b WHERE  a.ID=b.id_anak AND a.id_masjid='$id_masjid'";
								$sqlquery1=mysql_query($sql1,$bd);
								
								$z=1; 
								while($data1 = mysql_fetch_assoc($sqlquery1)){ 
								?> 
								<tr>
									<td align="center"><?php echo $z; ?></td>
									<td><?php echo $data1['nama_penuh']; ?></td>
									<td align="center"><?php echo $data1['no_ic']; ?></td>
									<td align="center"><?php echo $data1['jenis_penyakit']; ?></td>
									<td align="center"><?php echo $data1['rawatan_terkini']; ?></td>
									<td align="center"><a href="utama.php?view=admin&action=semak_sakit&id=<?php echo $data1['ID'];?>">[Semak]</a></td>
									<td>
										<div align="center">
											<form name="delete" method="POST" action="admin/del_sakit.php">
												<input type="hidden" name="del_anak" id="del_anak" value="<?php echo $data1['ID']; ?>">
												<button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam"><i class="fa fa-times"></i></button>
											</form>
										</div> 
								  </td>
								</tr>
								<?php  
								$z++; 
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
<script>
function showAnak() {
	document.getElementById('ahli_kariah').style.display = "none";
	document.getElementById('anak_tanggungan').style.display = "block";
}
function showKariah() {
	document.getElementById('ahli_kariah').style.display = "block";
	document.getElementById('anak_tanggungan').style.display = "none";
}
</script>   

 
                                         
                                
