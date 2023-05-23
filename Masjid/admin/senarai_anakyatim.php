<?php
    
	$sql_search="SELECT b.nama_penuh 'nama_penuh', b.no_ic 'no_ic', b.no_tel 'no_tel',b.ID as id_data FROM sej6x_data_anakyatim a, sej6x_data_anakqariah b WHERE a.id_masjid='$id_masjid' AND a.id_anakqariah=b.ID"; 
	$result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
?>		  
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Senarai Anak Yatim & Piatu</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li class="active">Senarai Anak Yatim & Piatu</li>
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
					Senarai Anak Yatim/Piatu
				</div>
				<div class="card-body">
				   <div class="table-responsive"> 
						<form method="post" id="anak_yatim" action="admin/del_anakyatim.php">             	                               
						<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">No IC</div></th>
									<th><div align="center">No Telefon</div></th>
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
									<td><div align="center"><?php echo $row['no_tel']; ?></div></td>
									<td><div align="center"><a href="utama.php?view=admin&action=semak_anakyatim&id_data=<?php echo $row['id_data'];?>">[Semak]</a></div></td>
									<td>
										<div align="center">
											<input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
											<button type="submit" name="update" id="update" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam"><i class="fa fa-times"></i></button>
										</div> 
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
					<!-- /.table-responsive -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
</div>

 
                                         
                                
