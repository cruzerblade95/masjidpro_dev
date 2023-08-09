<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Daftar OKU</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li class="active">Daftar OKU</li>
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
							<form name="oku" method="POST" action="<?php echo $PHP_SELF;?>">
								<div class="col-lg-4">
									<div class="form-group">
										<label>No K/P</label>
										<input class="form-control" name="no_ic" id="no_ic" required >
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
  
		$sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND no_ic LIKE '%$no_ic%' "; 
		$result = mysql_query($sql_search) or die ("Error :".mysql_error());
		$bilrow = mysql_num_rows($result);
		
		$sql_search1="SELECT * FROM sej6x_data_anakqariah WHERE id_masjid='$id_masjid' AND no_ic LIKE '%$no_ic%'";
		$result1 = mysql_query($sql_search1) or die ("Error :".mysql_error());
		$bilrow1 = mysql_num_rows($result1);
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Maklumat OKU
				</div>
				<div class="card-body">
					<div class="table-responsive">
					<form method="post" id="OKU" >          
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
									<td colspan="4" align="center">*Tiada Rekod*</td>
								</tr>
							<?php
							}
							else if($bilrow>0)
							{
								$x=1; 
								while($row = mysql_fetch_assoc($result)){ 
								?>
									<tr>
										<td><div align="center"><?php echo $x; ?></div></td>
										<td><?php echo $row['nama_penuh']; ?></td>
										<td><div align="center"><?php echo $row['no_ic']; ?></div></td>
										<td>
											<div align="center">
												<?php
												$id_data=$row['id_data'];
												
												$sql="SELECT * FROM sej6x_data_oku WHERE id_data='$id_data'";
												$sqlquery=mysql_query($sql,$bd);
												$bil=mysql_num_rows($sqlquery);
												
												if($bil==0)
												{
												?>
												<a href="utama.php?view=admin&action=butiran_oku&id_data=<?php echo $row['id_data'];?>"><input type="button" value="Daftar" class="btn btn-success" /></a>
												<?php
												}
												else if($bil>0)
												{
												?>
												<a href="utama.php?view=admin&action=semak_oku&id_data=<?php echo $row['id_data'];?>"><input type="button" value="Kemaskini" class="btn btn-success" /></a>
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
							else if($bilrow1>0)
							{
								$x=1; 
								while($row1 = mysql_fetch_assoc($result1)){ 
								?>
									<tr>
										<td><div align="center"><?php echo $x; ?></div></td>
										<td><?php echo $row1['nama_penuh']; ?></td>
										<td><div align="center"><?php echo $row1['no_ic']; ?></div></td>
										<td>
											<div align="center">
												<?php
												$ID=$row1['ID'];
												
												$sql="SELECT * FROM sej6x_data_oku WHERE id_anak='$ID'";
												$sqlquery=mysql_query($sql,$bd);
												$bil=mysql_num_rows($sqlquery);
												
												if($bil==0)
												{
												?>
												<a href="utama.php?view=admin&action=butiran_oku&id=<?php echo $row1['ID'];?>"><input type="button" value="Daftar" class="btn btn-success" /></a>
												<?php
												}
												else if($bil>0)
												{
												?>
												<a href="utama.php?view=admin&action=semak_oku&id=<?php echo $row1['ID'];?>"><input type="button" value="Kemaskini" class="btn btn-success" /></a>
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


                                        

                         
