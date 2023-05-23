<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Daftar Warga Emas</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li class="active">Daftar Warga Emas</li>
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
					Carian
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
						<form name="ibu_tunggal" method="POST" action="<?php echo $PHP_SELF;?>">
							<div class="col-lg-4">
								<div class="form-group">
									<label>No.K/P</label>
									<input class="form-control" name="no_ic" id="no_ic"  required>
								</div>    
							</div>                     
							<div class="col-lg-4">
								<div class="form-group">
									<br>
									<input type="submit" name="search" value="Carian" class="btn btn-primary"></input>   
								</div>    
							</div>      
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 				
	if(isset($_POST['search']))
	{ 

		$no_ic = $_POST['no_ic']; 
	
		include("connection/connection.php");
  
		$sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini FROM sej6x_data_peribadi where no_ic LIKE '%$no_ic%' "; 
		$result = mysql_query($sql_search) or die ("Error :".mysql_error());
		$bilrow=mysql_num_rows($result);
		
		$sql="SELECT * FROM sej6x_data_anakqariah WHERE no_ic LIKE '%$no_ic%'";
		$sqlquery=mysql_query($sql,$bd);
		$bilrow1=mysql_num_rows($sqlquery);

	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Carian Warga Emas
				</div>
				<div class="card-body">
					<div class="table-responsive">  
					<form method="post" id="warga_emas" action="admin/update_wargaemas.php">          
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">No K/P</div></th>
									<th><div align="center">Tindakan</div></th>
								</tr>
							</thead>
							<tbody>
							<?php 
							if(($bilrow==0) AND ($bilrow1==0))
							{
							?>
								<tr>
									<td align="center" colspan="4">*Tiada Rekod*</td>
								</tr>
							<?php
							}
							else if($bilrow>0)
							{
								$x=1; 
								while($row = mysql_fetch_assoc($result))
								{ 
								?>
								<tr>
									<td><div align="center"><?php echo $x; ?></div></td>
									<td><?php echo $row['nama_penuh']; ?></td>
									<td><div align="center"><?php echo $row['no_ic']; ?></div></td>
									<td>
										<div align="center">
											<?php
											
											$id_data=$row['id_data'];
											
											$sql1="SELECT * FROM sej6x_data_peribadi WHERE warga_emas=1 AND id_data='$id_data'";
											$sqlquery1=mysql_query($sq1,$bd);
											$bil1=mysql_num_rows($sqlquery1);
											
											if($bil1>0)
											{												
											?>
											Sudah Berdaftar Sebagai Warga Emas<br>
											<a href="utama.php?view=admin&action=senarai_wargaemas" class="btn btn-success">Senarai Warga Emas</a>
											<?php
											}
											else if($bil1==0)
											{
												if($row['umur']>=60)
												{
												?>
												<input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
												<input type="submit" name="update" id="update" value="Daftar" class="btn btn-success" />      
												<?php
												}
												else if($row['umur']<60)
												{
												?>
												Umur Tidak Cukup 60 Tahun dan Ke Atas<br>
												<a href="utama.php?view=admin&action=senarai_wargaemas" class="btn btn-success">Senarai Warga Emas</a>
												<?php
												}
											}
											?>
										</div>
									</td>
								</tr>
								<?php 								
								$x++;
								}
							}
							else if($bilrow1>0)
							{
								$z=1;
								
								while($data=mysql_fetch_array($sqlquery))
								{
							?>
								<tr>
									<td><div align="center"><?php echo $z; ?></div></td>
									<td><?php echo $data['nama_penuh']; ?></td>
									<td><div align="center"><?php echo $data['no_ic']; ?></div></td>
									<td>
										<div align="center">
											<input type="hidden" name="id" value="<?php echo $data['ID']; ?>">
											<input type="submit" name="update" id="update" value="Daftar" class="btn btn-success" />      
										</div>
									</td>
								</tr>
							<?php
								$z++;
								}
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
	<?php
	}
	?>
</div>


                                        

                         
