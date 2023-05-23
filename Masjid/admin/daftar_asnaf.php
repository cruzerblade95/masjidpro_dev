<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Daftar Asnaf</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li class="active">Daftar Asnaf</li>
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
					<form name="asnaf" method="POST" action="<?php echo $PHP_SELF;?>">
					<div class="row"> 
						<div class="col-lg-4">
							<div class="form-group">
								<label>No.K/P</label>
								<input class="form-control" name="no_ic" id="no_ic" minlength="12" maxlength="12" required>
							</div>    
						</div>                     
						<div class="col-lg-4">
							<div class="form-group">
								<br>
								<input type="submit" name="search" value="Carian" class="btn btn-primary"></input>   
							</div>    
						</div>      
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php 
	
	include("connection/connection.php");
	
	if(isset($_POST['search']))
	{ 
		$no_ic = $_POST['no_ic']; 

		$sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini FROM sej6x_data_peribadi where no_ic LIKE '%$no_ic%' "; 
		$result = mysql_query($sql_search) or die ("Error :".mysql_error());
		$bil = mysql_num_rows($result);
		
		$sql="SELECT * FROM sej6x_data_anakqariah WHERE no_ic LIKE '%$no_ic%'";
		$sqlquery=mysql_query($sql,$bd);
		$bilrow = mysql_num_rows($sqlquery);
	?> 
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Carian  Asnaf
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<form method="post" id="ibu_tunggal" action="admin/update_asnaf.php">               	                               
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>No IC</th>
								 
									<th><div align="center">Tindakan</div></th>
								</tr>
							</thead>
							<tbody>
							<?php 
							if(($bil==0) AND ($bilrow==0))
							{
							?>
								<tr>
									<td align="center" colspan="4">*Tiada Rekod*</td>
								</tr>
							<?php
							}
							else if($bil>0)
							{
								$x=1; 
								while($row = mysql_fetch_assoc($result))
								{ 
								?>
								<tr>
									<td><div align="center"><?php echo $x; ?></div></td>
									<td><?php echo $row['nama_penuh']; ?></td>
									<td><?php echo $row['no_ic']; ?></td>
									<td>
										<div align="center">
											<?php
											$id_data=$row['id_data'];
											
											$sql1="SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_data'";
											$sqlquery1=mysql_query($sql1,$bd);
											$row1=mysql_num_rows($sqlquery1);
											
											if($row==0)
											{
											?>
											<input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
											<input type="submit" name="update" id="update" value="Daftar" class="btn btn-success" />      
											<?php
											}
											else if($row>0)
											{
											?>
											Sudah Berdaftar Sebagai Asnaf<br>
											<a href="utama.php?view=admin&action=senarai_asnaf" class="btn btn-success">Senarai Asnaf</a>
											<?php
											}
											?>
										</div>
									</td>
								</tr>
							<?php 						
								$x++;
								}
							}
							else if($bilrow>0)
							{
								$z=1; 
								while($row = mysql_fetch_assoc($sqlquery))
								{ 
								?>
								<tr>
									<td><div align="center"><?php echo $z; ?></div></td>
									<td><?php echo $row['nama_penuh']; ?></td>
									<td><?php echo $row['no_ic']; ?></td>
									<td>
										<div align="center">
											<?php
											$ID=$row['ID'];
											
											$sql1="SELECT * sej6x_data_anakqariah WHERE ID='$ID'";
											$sqlquery1=mysql_query($sql1,$bd);
											$row1=mysql_num_rows($sqlquery1);
											
											if($row1==0)
											{
											?>
											<input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
											<input type="submit" name="update" id="update" value="Daftar" class="btn btn-success" />      
											<?php
											}
											else if($row1>0)
											{
											?>
											Sudah Berdaftar Sebagai Asnaf<br> 
											<a href="utama.php?view=admin&action=senarai_asnaf" class="btn btn-success">Senarai Asnaf</a>
											<?php
											}
											?>
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

                                        

                         
