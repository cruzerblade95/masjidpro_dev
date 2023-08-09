<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Daftar Anak Yatim & Piatu</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li class="active">Daftar Anak Yatim & Piatu</li>
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
									<label>No K/P</label>
                                    <input class="form-control" name="no_ic" id="no_ic" maxlength="12" required>
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
			  
		$sql_search="SELECT * FROM sej6x_data_anakqariah where no_ic ='$no_ic' "; 
		$result = mysql_query($sql_search) or die ("Error :".mysql_error());

	?>  
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Carian Anak Yatim/Piatu
				</div>
				<div class="card-body">
			  
					<div class="table-responsive">
					   <form method="post" id="ibu_tunggal" action="admin/update_anakyatim.php">          
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
							while($row = mysql_fetch_assoc($result)){ ?>
								<tr>
									<td><div align="center"><?php echo $x; ?></div></td>
									<td><?php echo $row['nama_penuh']; ?></td>
									<td><div align="center"><?php echo $row['no_ic']; ?></div></td>
									<td>
										<div align="center">
											<input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
											<input type="hidden" name="id_qariah" value="<?php echo $row['id_qariah']; ?>">
											<input type="submit" name="update" id="update" value="Daftar" class="btn btn-success" />     
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
			</div>
		</div>
	</div>
	<!-- /.row -->
	<?php
	}
	?>
</div>
                                        

                         
