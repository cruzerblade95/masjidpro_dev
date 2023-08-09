<?php 

include("connection/connection.php");

?> 
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });
</script>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Menu Baucer Bayaran</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=kewangan">Menu Kewangan</a></li>
					<li class="active">Menu Baucer Bayaran</li>
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
					Senarai Baucer Bayaran&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
					<a href="utama.php?view=admin&action=baucerbayaran" class="btn btn-success">Tambah Bayaran</a>
				</div>
				<!-- /.panel-heading -->
				<div class="card-body">
					<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th><div align="center">No Baucer</div></th>
								<th><div align="center">Nama Pembekal</div></th>
								<th><div align="center">Jenis Bayaran</div></th>
								<th><div align="center">Tarikh</div></th>
								<th><div align="center">Jumlah Amaun (RM)</div></th>
								<th><div align="center">Tindakan</div></th>
							</tr>
						</thead>
						<tbody>
							<?php
							
							$sql="SELECT * FROM baucer_bayaran WHERE id_masjid='$id_masjid'";
							$sqlquery=mysql_query($sql,$bd);
							
							while($data=mysql_fetch_array($sqlquery))
							{
							?>	
							<tr>
								<td align="center"><?php echo $data['no_baucer']; ?></td>
								<td align="center">
									<?php
									
									$id_pembekal=$data['id_pembekal']; 
									$sql1="SELECT * FROM sej6x_data_pembekal WHERE id_pembekal='$id_pembekal'";
									$sqlquery1=mysql_query($sql1,$bd);
									$data1=mysql_fetch_array($sqlquery1);
									
									echo $data1['nama_pembekal'];
									?>
								</td>
								<td align="center">
								<?php 
								$id_bayaran=$data['id_bayaran']; 
								$sql2="SELECT * FROM sej6x_data_jenisbayaran WHERE id_bayaran='$id_bayaran'";
								$sqlquery2=mysql_query($sql2,$bd);
								
								$data2=mysql_fetch_array($sqlquery2);
								
								echo $data2['nama_bayaran'];
								?>
								</td>
								<td align="center"><?php echo $data['tarikh'];?></td>
								<td align="center"><?php echo $data['jumlah']; ?></td>
								<td></td>
							</tr>
							<?php	
							}
							?>
						</tbody>
					</table>
					<!-- table -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row --> 
</div>                                                               
                     