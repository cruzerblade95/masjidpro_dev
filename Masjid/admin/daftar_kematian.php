<script src="js/jquery-3.4.1.js"></script>
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
				<h1>Senarai Kematian Kariah</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li><a href="utama.php?view=admin&action=daftar_kematian">Daftar Kematian Kariah</a></li>
					<li class="active">Senarai Kematian Kariah</li>
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
					Senarai Kematian Kariah
					<!-- <button onclick="myFunction()" class="btn btn-info">Cetak</button>
					<script>
					function myFunction() {
					window.print();
					}
					</script> -->
				</div>
				<div class="card-body">
					<ul class="nav nav-pills nav-justified mb-3 mt-2" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#ahli_kariah" role="tab" aria-controls="pills-home" aria-selected="true" onClick="showKariah()">Ahli Kariah</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#anak_tanggungan" role="tab" aria-controls="pills-profile" aria-selected="false" onClick="showAnak()">Anak Tanggungan</a>
						</li>
					</ul>
					<hr>
					<div id="ahli_kariah">
						<?php 
						include("connection/connection.php");
						  
						$sql_search="SELECT b.nama_penuh,a.tarikh_kematian,a.tarikh_dikebumikan,a.id_data,a.id_kematian,b.id_data,b.data_kematian
									FROM data_kematian a,sej6x_data_peribadi b
									WHERE a.id_data=b.id_data AND b.id_masjid='$id_masjid'"; 
						$result = mysql_query($sql_search) or die ("Error :".mysql_error());
						include('excel/excel_kematian.php');
						
						$bilrow=mysql_num_rows($result);
						if($bilrow>0)
						{
						?>
						<b>Klik Icon
						<?php
						$path = "output/".$kod_masjid."/SenaraiKematian.xlsx";
						?> Untuk Muat Turun Senarai Kematian Ahli Kariah</b><img src="picture/excel1.jpg" height="47" width="50" onClick="window.location.href=window.location='<?php echo $path; ?>'">
						<?php
						}
						?>   
						<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">Tarikh Kematian</div></th>
									<th><div align="center">Tarikh Dikebumikan</div></th>
									<th><div align="center">Tindakan</div></th>
									<th><div align="center"></div></th>
								</tr>
							</thead>
							<tbody>
							<?php 
							$x=1; 
							while($row = mysql_fetch_assoc($result))
							{
							?>
								<tr>
									<td align="center"><?php echo $x; ?></td>
									<td align="center"><?php echo $row['nama_penuh']; ?></td>
									<td align="center"><?php echo $row['tarikh_kematian']; ?></td>
									<td align="center"><?php echo $row['tarikh_dikebumikan']; ?></td>
									<td align="center"><a href="utama.php?view=admin&action=semak_kematian&id_data=<?php echo $row['id_data'];?>">[Semak]</a></td>
									<td align="center">
										<form name="delete" method="POST" action="admin/del_kematian.php">
										   <input type="hidden" name="del" id="del" value="<?php echo $row['id_data']; ?>">
										   <button type="submit" onclick="return confirm('Padam Rekod?');" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam">
										   <i class="fa fa-times" ></i>
										   </button>
										</form>
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
						include("connection/connection.php");
						  
						$sql1="SELECT b.nama_penuh 'nama_penuh',a.tarikh_kematian,a.tarikh_dikebumikan,a.id_anak,a.id_kematian,b.ID,b.status_kematian
									FROM data_kematian a,sej6x_data_anakqariah b
									WHERE a.id_anak=b.ID AND b.id_masjid='$id_masjid'"; 
						$sqlquery1 = mysql_query($sql1) or die ("Error :".mysql_error());
						include('excel/excel_kematian_t.php');
						
						$row1=mysql_num_rows($sqlquery1);
						if($row1>0)
						{
						?>
						<b>Klik Icon
						<?php
						$pathT = "output/".$kod_masjid."/SenaraiKematianTanggungan.xlsx";
						?> Untuk Muat Turun Senarai Kematian Tanggungan Kariah</b><img src="picture/excel1.jpg" height="47" width="50" onClick="window.location.href=window.location='<?php echo $pathT; ?>'">
						<?php
						}
						?>   
						<table id="table_anak" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">Tarikh Kematian</div></th>
									<th><div align="center">Tarikh Dikebumikan</div></th>
									<th><div align="center">Tindakan</div></th>
									<th><div align="center"></div></th>
								</tr>
							</thead>
							<tbody>
							<?php 
							$z=1; 
							while($data1 = mysql_fetch_assoc($sqlquery1))
							{
							?>
								<tr>
									<td align="center"><?php echo $z; ?></td>
									<td align="center"><?php echo $data1['nama_penuh']; ?></td>
									<td align="center"><?php echo $data1['tarikh_kematian']; ?></td>
									<td align="center"><?php echo $data1['tarikh_dikebumikan']; ?></td>
									<td align="center"><a href="utama.php?view=admin&action=semak_kematian&id=<?php echo $data1['ID'];?>">[Semak]</a></td>
									<td align="center">
										<form name="delete" method="POST" action="admin/del_kematian.php">
										   <input type="hidden" name="del_anak" id="del_anak" value="<?php echo $data1['ID']; ?>">
										   <button type="submit" onclick="return confirm('Padam Rekod?');" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam">
										   <i class="fa fa-times"></i>
										   </button>
										</form>
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