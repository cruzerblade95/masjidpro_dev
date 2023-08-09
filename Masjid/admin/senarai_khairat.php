<?php

	$sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini,no_hp FROM sej6x_data_peribadi where id_masjid='$id_masjid' AND data_khairat=1"; 
	$result = mysql_query($sql_search) or die ("Error :".mysql_error());

?>		  
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Senarai Khairat</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li class="active">Senarai Khairat</li>
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
					Senarai Khairat
				</div>
				<div class="card-body">
				   <div class="table-responsive">              	                               
						<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">No IC</div></th>
									<th><div align="center">No Telefon</div></th>
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
									<td><div align="center"><?php echo $x; ?></div></td>
									<td><?php echo $row['nama_penuh']; ?></td>
									<td><div align="center"><?php echo $row['no_ic']; ?></div></td>
									<td><div align="center"><?php echo $row['no_hp']; ?></div></td>
									<td><div align="center"><a href="utama.php?view=admin&action=semak_khairat&id_data=<?php echo $row['id_data'];?>">[Semak]</a></div></td>
								</tr>
								<?php
								$x++;
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

 
                                         
                                
