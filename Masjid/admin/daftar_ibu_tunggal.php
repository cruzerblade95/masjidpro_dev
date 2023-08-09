<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Daftar Ibu Tunggal</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li class="active">Daftar Ibu Tunggal</li>
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
					<form name="ibu_tunggal" method="POST" action="<?php echo $PHP_SELF;?>">
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
	
	if(isset($_POST['search']))
	{ 

	$no_ic = $_POST['no_ic']; 

	include("connection/connection.php");


	$sql_search="SELECT * FROM sej6x_data_peribadi where no_ic LIKE '%$no_ic%' "; 
	$result = mysql_query($sql_search) or die ("Error :".mysql_error());
	$bil=mysql_num_rows($result);
	
	$sql="SELECT * FROM sej6x_data_anakqariah WHERE no_ic LIKE '%$no_ic%'";
	$sqlquery=mysql_query($sql,$bd);
	$bilrow=mysql_num_rows($sqlquery);

	?>    
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Maklumat Ibu Tunggal
				</div>
				<div class="card-body">
			  		<div class="table-responsive">
					<form method="post" id="ibu_tunggal" action="admin/update_ibutunggal.php">          
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
									$id_data=$row['id_data'];
									$jantina=$row['jantina'];
									if($jantina==2)
									{
								?>
									<tr>
										<td><div align="center"><?php echo $x; ?></div></td>
										<td><?php echo $row['nama_penuh']; ?></td>
										<td><div align="center"><?php echo $row['no_ic']; ?></div></td>
										<td>
											<div align="center">
												<?php
												$sql2="SELECT * FROM sej6x_data_peribadi WHERE data_ibutunggal='1' AND id_data='$id_data'";
												$sqlquery2=mysql_query($sql2,$bd);
												$query2=mysql_num_rows($sqlquery2);
												
												if($query2==0)
												{
												?>
												<input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
												<input type="submit" name="update" id="update" value="Daftar" class="btn btn-success" />
												<?php
												}
												else if($query2>0)
												{
												?>
												Sudah Berdaftar Sebagai Ibu Tunggal<br>
												<a href="utama.php?view=admin&action=senarai_ibutunggal" class="btn btn-success">Senarai Ibu Tunggal</a></td>
												<?php
												}
												?>
											</div>
										</td>
									</tr>
								<?php 
									}
									else if($jantina!=2)
									{
									?>
									<tr>
										<td><div align="center"><?php echo $x; ?></div></td>
										<td><?php echo $row['nama_penuh']; ?></td>
										<td><div align="center"><?php echo $row['no_ic']; ?></div></td>
										<td align="center">Hanya Perempuan Sahaja Boleh Berdaftar<br><a href="utama.php?view=admin&action=senarai_ibutunggal" class="btn btn-success">Senarai Ibu Tunggal</a></td>
									</tr>
									<?php
									}
								$x++;
								}
							}
							else if($bilrow>0)
							{
								$z=1; 
								while($row = mysql_fetch_assoc($sqlquery))
								{ 
									$ID=$row['ID'];
									$jantina=$row['jantina'];
									if($jantina==2)
									{
								?>
									<tr>
										<td><div align="center"><?php echo $z; ?></div></td>
										<td><?php echo $row['nama_penuh']; ?></td>
										<td><div align="center"><?php echo $row['no_ic']; ?></div></td>
										<td>
											<div align="center">
												<?php
												$sql1="SELECT * FROM sej6x_data_anakqariah WHERE status_ibutunggal='1' AND ID='$ID'";
												$sqlquery1=mysql_query($sql1,$bd);
												$query1=mysql_num_rows($sqlquery1);
												
												if($query1==0)
												{
												?>
												<input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
												<input type="submit" name="update" id="update" value="Daftar" class="btn btn-success" />
												<?php
												}
												else if($query1==1)
												{
												?>
												Sudah Berdaftar Sebagai Ibu Tunggal<br>
												<a href="utama.php?view=admin&action=senarai_ibutunggal" class="btn btn-success">Senarai Ibu Tunggal</a>
												<?php
												}
												?>
											</div>
										</td>
									</tr>
								<?php 
									}
									else if($jantina!=2)
									{
									?>
									<tr>
										<td><div align="center"><?php echo $z; ?></div></td>
										<td><?php echo $row['nama_penuh']; ?></td>
										<td><div align="center"><?php echo $row['no_ic']; ?></div></td>
										<td align="center">Hanya Perempuan Sahaja Boleh Berdaftar<br><a href="utama.php?view=admin&action=senarai_ibutunggal" class="btn btn-success">Senarai Ibu Tunggal</a></td>
									</tr>
									<?php
									}
								$z++;
								}
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
	<!-- /.row -->
	<?php
	}
	?>
</div>

                                        

                         
