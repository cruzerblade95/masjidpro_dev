<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Daftar Layak Undi</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li class="active">Daftar Layak Undi</li>
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
					Carian</div>

				<div class="card-body">
					<div class="row"> 
						<div class="col-lg-12">
							<form name="ibu_tunggal" method="POST" action="<?php echo $PHP_SELF;?>">
							<div class="col-lg-4">
								<div class="form-group">
									<label>No K/P</label>
									<input class="form-control" name="no_ic" id="no_ic" minlength="12" maxlength="12"  required>
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


		$sql_search="SELECT * FROM sej6x_data_peribadi WHERE no_ic LIKE '%$no_ic%' AND id_masjid='$id_masjid'"; 
		$result = mysql_query($sql_search) or die ("Error :".mysql_error());
		$bil_row=mysql_num_rows($result);
		if($bil_row==0)
		{
			$sql1="SELECT * FROM sej6x_data_anakqariah WHERE no_ic LIKE '%$no_ic' AND id_masjid='$id_masjid'";
			$sqlquery1 = mysql_query($sql1);
			$bil_anak = mysql_num_rows($sqlquery1);
		}
	?>  
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Maklumat Layak Undi
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<form method="post" id="layak_mengundi" action="admin/update_mengundi.php">          
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
							if(($bil_row==0) AND ($bil_anak==0))
							{
							?>
								<tr>
									<td align="center" colspan="4">
										*Tiada Rekod*
									</td>
								</tr>
							<?php
							}
							else if($bil_row>0)
							{
								$x=1; 
								while($row = mysql_fetch_assoc($result))
								{ 
									$id_data=$row['id_data'];
									$sql3="SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_data' AND data_undi='1'";
									$sqlquery3=mysql_query($sql3,$bd);
									$data3=mysql_fetch_array($sqlquery3);
									$row3=mysql_num_rows($sqlquery3);
							?>
								<tr>
									<td><div align="center"><?php echo $x; ?></div></td>
									<td><?php echo $row['nama_penuh']; ?></td>
									<td><div align="center"><?php echo $row['no_ic']; ?></div></td>
									<td>
										<div align="center">
											<?php
											if($row3==0)
											{
											?>
											<input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
											<input type="submit" name="update" id="update" value="Daftar" class="btn btn-success" />      
											<?php
											}
											else if($row3>0)
											{
											?>
											Sudah Berdaftar Sebagai Layak Mengundi<br>
											<a href="utama.php?view=admin&action=pendaftaran_layak_mengundi" class="btn btn-success">Senarai Layak Undi</a>
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
							else if($bil_anak>0)
							{
								$z=1;
								
								while($row1 = mysql_fetch_array($sqlquery1))
								{
									$ID=$row1['ID'];
									$sql2="SELECT * FROM sej6x_data_anakqariah WHERE ID='$ID' AND status_undi='1'";
									$sqlquery2=mysql_query($sql2,$bd);
									$data2=mysql_fetch_array($sqlquery2);
									$row2=mysql_num_rows($sqlquery2);
								?>
								<tr>
									<td><div align="center"><?php echo $z; ?></div></td>
									<td><?php echo $row1['nama_penuh']; ?></td>
									<td><div align="center"><?php echo $row1['no_ic']; ?></div></td>
									<td>
										<div align="center">
											<?php
											if($row2==0)
											{
											?>
											<input type="hidden" name="id_anak" value="<?php echo $row1['ID']; ?>">
											<input type="submit" name="update" id="update" value="Daftar" class="btn btn-success" />      
											<?php
											}
											else if($row2>0)
											{
											?>
											Sudah Berdaftar Sebagai Layak Mengundi<br>
											<a href="utama.php?view=admin&action=pendaftaran_layak_mengundi" class="btn btn-success">Senarai Layak Undi</a>
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
					<!-- /.table-responsive -->
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<?php
	}
	?>
</div>

                                        

                         
