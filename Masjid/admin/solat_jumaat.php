<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Solat Jumaat</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li class="active">Solat Jumaat</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
	<div class="row">
		<div class="col-lg-12">
			<div class="card panel-default">
				<div class="card-header">
					Senarai Kariah Solat Jumaat
					<button onclick="myFunction()" class="btn btn-info">Cetak</button>
					<script>
					function myFunction() {
					window.print();
					}
					</script>
				</div>
				<div class="card-body">
					<div class="table-responsive">
					<?php 
					
					include("connection/connection.php");
				  
					$sql_search="SELECT nama_penuh,no_ic,alamat_terkini FROM sej6x_data_peribadi WHERE jantina='lelaki' AND id_masjid='$id_masjid'";  
					$result = mysql_query($sql_search) or die ("Error :".mysql_error());
					
					?>     
                        <table class="table table-striped table-bordered table-hover" id="bootstrap-data-table-export">
							<thead>
								<tr>
									<th><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">No Kad Pengenalan</div></th>
									<th><div align="center">Alamat</div></th>
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
									<td><?php echo $row['alamat_terkini']; ?></td>
								</tr>
							<?php 
							$x++;
							}
							?>   
							</tbody>
						</table>
					</div>
					<!-- /.table-responsive -->
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
