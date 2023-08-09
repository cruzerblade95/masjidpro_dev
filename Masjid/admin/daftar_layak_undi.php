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
				<h1>Senarai Layak Mengundi</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li><a href="utama.php?view=admin&action=daftar_layak_mengundi">Daftar Layak Mengundi</a></li>
					<li class="active">Senarai Layak Mengundi</li>
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
					Senarai Layak Mengundi
					<button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal" style="display:none;">Tambah Ahli </button> 
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
					
					$sql_search="SELECT * FROM sej6x_data_peribadi WHERE data_undi=1 AND id_masjid='$id_masjid'"; 
					$result = mysql_query($sql_search) or die ("Error :".mysql_error());
					include("excel/excel_undi_l.php");
					include("excel/excel_undi_p.php");
					
					$bil_row = mysql_num_rows($result);
					if($bil_row>0)
					{
					?>
					<b>Klik Icon
					<?php
					$pathL = "output/".$kod_masjid."/SenaraiLayakMengundiLelaki.xlsx";
					$pathP = "output/".$kod_masjid."/SenaraiLayakMengundiPerempuan.xlsx";
					?> Untuk Muat Turun Hasil Carian</b>
					<br>	 
					Senarai Lelaki : <img src="picture/excel1.jpg" height="47" width="50" onClick="window.location.href=window.location='<?php echo $pathL; ?>'">
					<br>
					Senarai Perempuan : <img src="picture/excel1.jpg" height="47" width="50" onClick="window.location.href=window.location='<?php echo $pathP; ?>'">
					<?php
					}
					?>		                	                               
						<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">No IC</div></th>
									<th><div align="center">No Telefon</div></th>
									<th><div align="center">Alamat</div></th>
									<th><div align="center">Tindakan</div></th>
								</tr>
							</thead>
							<tbody>
							<?php
								$x=1; 
								while($row = mysql_fetch_assoc($result))
								{ 
							?>
								<tr>
									<td><div align="center"><?php echo $x; ?></div></td>
									<td><?php echo $row['nama_penuh']; ?></td>
									<td><div align="center"><?php echo $row['no_ic']; ?></div></td>
									<td align="center"><?php echo $row['no_hp']; ?></td>
									<td><?php echo $row['alamat_terkini']; ?></td>
									<td>
										<div align="center">
											<!-- <a href="utama.php?view=admin&action=kemaskini_layakmengundi&id_data=<?php echo $row['id_data'];?>">
												<button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Edit">
													<i class="fa fa-pencil"></i>
												</button>
											</a> -->
											<form name="delete" method="POST" action="admin/del_layakmengundi.php">
												<input type="hidden" name="del" id="del" value="<?php echo $row['id_data']; ?>">
												<button type="submit" onclick="return confirm('Padam Rekod?');" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam">
													<i class="fa fa-times"></i>
												</button>
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
					<!-- /.table-responsive -->
					<div id="anak_tanggungan" style="display:none">
						<?php
					
					$sql1="SELECT * FROM sej6x_data_anakqariah WHERE status_undi=1 AND id_masjid='$id_masjid'"; 
					$sqlquery1 = mysql_query($sql1,$bd) or die ("Error :".mysql_error());
					include("excel/excel_undi_l_tanggungan.php");
					include("excel/excel_undi_p_tanggungan.php");
					
					$bil_row1 = mysql_num_rows($sqlquery1);
					if($bil_row1>0)
					{
					?>
					<b>Klik Icon
					<?php
					$pathLT = "output/".$kod_masjid."/SenaraiLayakMengundiLelakiTanggungan.xlsx";
					$pathPT = "output/".$kod_masjid."/SenaraiLayakMengundiPerempuanTanggungan.xlsx";
					?> Untuk Muat Turun Hasil Carian</b>
					<br>	 
					Senarai Lelaki Tanggungan : <img src="picture/excel1.jpg" height="47" width="50" onClick="window.location.href=window.location='<?php echo $pathLT; ?>'">
					<br>
					Senarai Perempuan Tanggungan: <img src="picture/excel1.jpg" height="47" width="50" onClick="window.location.href=window.location='<?php echo $pathPT; ?>'">
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
									<th><div align="center">Tindakan</div></th>
								</tr>
							</thead>
							<tbody>
							<?php
								$z=1; 
								while($data1 = mysql_fetch_assoc($sqlquery1))
								{ 
							?>
								<tr>
									<td><div align="center"><?php echo $z; ?></div></td>
									<td><?php echo $data1['nama_penuh']; ?></td>
									<td><div align="center"><?php echo $data1['no_ic']; ?></div></td>
									<td align="center"><?php echo $data1['no_tel']; ?></td>
									<td>
										<div align="center">
											<!-- <a href="utama.php?view=admin&action=kemaskini_layakmengundi&id_data=<?php echo $row['id_data'];?>">
												<button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Edit">
													<i class="fa fa-pencil"></i>
												</button>
											</a> -->
											<form name="delete" method="POST" action="admin/del_layakmengundi.php">
												<input type="hidden" name="del_anak" id="del_anak" value="<?php echo $data1['ID']; ?>">
												<button type="submit" onclick="return confirm('Padam Rekod?');" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam">
													<i class="fa fa-times"></i>
												</button>
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
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
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
                       
