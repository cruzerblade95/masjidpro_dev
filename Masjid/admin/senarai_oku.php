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
				<h1>Senarai OKU</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li><a href="utama.php?view=admin&action=pendaftaran_oku">Daftar OKU</a></li>
					<li class="active">Senarai OKU</li>
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
					Senarai OKU
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
					
					include("excel/excel_oku.php");
					
					$sql_search="SELECT a.id_data,a.nama_penuh,a.no_ic,a.umur,b.jenis_oku,b.id_oku FROM sej6x_data_peribadi a, sej6x_data_oku b WHERE a.id_data=b.id_data AND b.id_masjid='$id_masjid'"; 
					$result = mysql_query($sql_search) or die ("Error :".mysql_error());
					$row=mysql_num_rows($result);			
					
					if($row>0)
					{
					?>
					<b>Klik Icon
					<?php
					$path = "output/".$kod_masjid."/SenaraiOKU.xlsx";
					?> 
					Untuk Muat Turun Hasil Carian Ahli Kariah</b>	<img src="picture/excel1.jpg" height="47" width="50" onClick="window.location.href=window.location='<?php echo $path; ?>'">
					<?php
					}
					?>
						<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">No IC</div></th>
									<th><div align="center">Umur</div></th>
									<th><div align="center">Kategori OKU</div></th>
									<th><div align="center">Tindakan</div></th>
									<th><div align="center"></div></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								
								$x=1;
								while($row = mysql_fetch_assoc($result)){ 
								?> 
								<tr>
									<td><div align="center"><?php echo $x; ?></div></td>
									<td><?php echo $row['nama_penuh']; ?></td>
									<td><div align="center"><?php echo $row['no_ic']; ?></div></td>
									<td><div align="center"><?php echo $row['umur']; ?></div></td>
									<td align="center"><?php echo $row['jenis_oku']; ?></td>
									<td><div align="center"><a href="utama.php?view=admin&action=semak_oku&id_data=<?php echo $row['id_data'];?>">[Semak]</a></div></td>
									<td>
										<div align="center">
											<form name="delete" method="POST" action="admin/del_oku.php">
											   <input type="hidden" name="del" id="del" value="<?php echo $row['id_data']; ?>">
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
					<?php
					
					include("excel/excel_oku_t.php");
					
					$sql_search1="SELECT a.ID,a.nama_penuh,a.no_ic,a.umur,b.jenis_oku,b.id_oku FROM sej6x_data_anakqariah a, sej6x_data_oku b WHERE a.ID=b.id_anak AND a.id_masjid='$id_masjid'"; 
					$result1 = mysql_query($sql_search1) or die ("Error :".mysql_error());
					$row1 = mysql_num_rows($result1);
					if($row1>0)
					{
					?>
					<b>Klik Icon
					<?php
					$pathT = "output/".$kod_masjid."/SenaraiOKUTanggungan.xlsx";
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
									<th><div align="center">Umur</div></th>
									<th><div align="center">Kategori OKU</div></th>
									<th><div align="center">Tindakan</div></th>
									<th><div align="center"></div></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								
								$z=1;
								while($row1 = mysql_fetch_assoc($result1)){ 
								?> 
								<tr>
									<td><div align="center"><?php echo $z; ?></div></td>
									<td><?php echo $row1['nama_penuh']; ?></td>
									<td><div align="center"><?php echo $row1['no_ic']; ?></div></td>
									<td><div align="center"><?php echo $row1['umur']; ?></div></td>
									<td align="center"><?php echo $row1['jenis_oku']; ?></td>
									<td><div align="center"><a href="utama.php?view=admin&action=semak_oku&id=<?php echo $row1['ID'];?>">[Semak]</a></div></td>
									<td>
										<div align="center">
											<form name="delete" method="POST" action="admin/del_oku.php">
											   <input type="hidden" name="del_anak" id="del_anak" value="<?php echo $row1['ID']; ?>">
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
 
                                         
                                
