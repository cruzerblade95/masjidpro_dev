<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Pemohon Zakat</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li class="active">Pemohonan Zakat</li>
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
						<form name="pemohonan_zakat" method="POST" action="<?php echo $PHP_SELF;?>">
							<div class="col-lg-4">
								<div class="form-group">
									<label>No K/P</label>
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
		
	?>  
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Carian Pemohon Zakat
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<form method="post" id="ibu_tunggal" action="admin/update_sakitkronik.php">          
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
											<a href="utama.php?view=admin&action=butiran_zakat&id_data=<?php echo $row['id_data'];?>"><input type="button" value="Mohon" class="btn btn-success" /></a>
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
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
	<?php
	}
	?>
</div>


                                        

                         