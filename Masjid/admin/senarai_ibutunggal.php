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
				<h1>Senarai Ibu Tunggal</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li><a href="utama.php?view=admin&action=pendaftaran_ibu_tunggal">Daftar Ibu Tunggal</a></li>
					<li class="active">Senarai Ibu Tunggal</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<?php

	include('connection/connection.php');
    
	$sql_search="SELECT * FROM sej6x_data_peribadi where data_ibutunggal=1 AND id_masjid='$id_masjid'"; 
	$result = mysql_query($sql_search) or die ("Error :".mysql_error());
	$row = mysql_num_rows($result);
				
?>		  
<div class="content mt-3">            
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Senarai Ibu Tunggal
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
					<?php
					
					include("excel/excel_ibutunggal.php");
					
					if($row>0)
					{
					?>
					<b>Klik Icon
					<?php
					$path = "output/".$kod_masjid."/SenaraiIbuTunggal.xlsx";
					?> 
					Untuk Muat Turun Hasil Carian Ahli Kariah</b>	<img src="picture/excel1.jpg" height="47" width="50" onClick="window.location.href=window.location='<?php echo $path; ?>'">
					<?php
					}
					?>
					<form method="post" id="anak_yatim" action="admin/del_ibutunggal.php">            	                               
						<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">No IC</div></th>
									<th><div align="center">No Telefon</div></th>
									<th><div align="center">Umur</div></th>
									<th><div align="center"></div></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								
								$x=1; 
								while($row = mysql_fetch_assoc($result)){ 
								?> 
								<tr>
									<td align="center"><?php echo $x; ?></td>
									<td align="center"><?php echo $row['nama_penuh']; ?></td>
									<td align="center"><?php echo $row['no_ic']; ?></td>
									<td align="center"><?php echo $row['no_hp']; ?></td>
									<td align="center"><?php echo $row['umur']; ?></td>
									<!-- <td><div align="center"><a href="utama.php?view=admin&action=semak_ibutunggal&id_data=<?php //echo $row['id_data'];?>">[Semak]</a></div></td> -->
									<td align="center">
										<input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
										<button type="submit" name="update" id="update" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam"><i class="fa fa-times"></i></button>
									</td> 
								</tr>
								<?php  
								$x++; 
								}
								?>
							</tbody>
						</table>
						</form>
					</div>
					<div id="anak_tanggungan" style="display:none">
						<form method="post" id="anak_yatim" action="admin/del_ibutunggal.php"> 
						<?php
					
						$sql="SELECT * FROM sej6x_data_anakqariah WHERE status_ibutunggal='1' AND id_masjid='$id_masjid'";
						$sqlquery=mysql_query($sql,$bd);
						$bilrow=mysql_num_rows($sqlquery);
						
						include("excel/excel_ibutunggal_t.php");
						
						if($bilrow>0)
						{
						?>
						<b>Klik Icon
						<?php
						$pathT = "output/".$kod_masjid."/SenaraiIbuTunggalTanggungan.xlsx";
						?> 
						Untuk Muat Turun Hasil Carian Tanggungan</b>	<img src="picture/excel1.jpg" height="47" width="50" onClick="window.location.href=window.location='<?php echo $pathT; ?>'">
						<?php
						}
						?>
						<table id="table_anak" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">No IC</div></th>
									<th><div align="center">No Telefon</div></th>
									<th><div align="center">Umur</div></th>
									<th><div align="center"></div></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								
								$sql="SELECT * FROM sej6x_data_anakqariah WHERE status_ibutunggal='1' AND id_masjid='$id_masjid'";
								$sqlquery=mysql_query($sql,$bd);
								
								$z=1; 
								while($data = mysql_fetch_array($sqlquery))
								{ 
								?> 
								<tr>
									<td align="center"><?php echo $z; ?></td>
									<td align="center"><?php echo $data['nama_penuh']; ?></td>
									<td align="center"><?php echo $data['no_ic']; ?></td>
									<td align="center"><?php echo $data['no_tel']; ?></td>
									<td align="center"><?php echo $data['umur']; ?></td>
									<!-- <td><div align="center"><a href="utama.php?view=admin&action=semak_ibutunggal&id_data=<?php //echo $row['id_data'];?>">[Semak]</a></div></td> -->
									<td align="center">
										<input type="hidden" name="id" value="<?php echo $data['ID']; ?>">
										<button type="submit" name="update" id="update" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam"><i class="fa fa-times"></i></button>
									</td> 
								</tr>
								<?php  
								$z++; 
								}
								?>
							</tbody>
						</table>
						</form>
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

 
                                         
                                
