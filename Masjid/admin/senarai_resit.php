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
				<h1>Menu Resit</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=kewangan">Menu Kewangan</a></li>
					<li class="active">Menu Resit</li>
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
					Senarai Resit&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
					<a href="utama.php?view=admin&action=resit" class="btn btn-success">Tambah Sumbangan</a>
				</div>
				<!-- /.panel-heading -->
				<div class="card-body">
					<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th><div align="center">No Resit</div></th>
								<th><div align="center">Nama Penyumbang</div></th>
								<th><div align="center">Jenis Kutipan</div></th>
								<th><div align="center">Tarikh</div></th>
								<th><div align="center">Jumlah Amaun (RM)</div></th>
								<th><div align="center">Tunai/No Cek</div></th>
								<th><div align="center">Tindakan</div></th>
							</tr>
						</thead>
						<tbody>
							<?php
							
							$sql="SELECT * FROM sej6x_data_resit WHERE id_masjid='$id_masjid'";
							$sqlquery=mysql_query($sql,$bd);
							
							$i=1;
							while($data=mysql_fetch_array($sqlquery))
							{
								$id_resit=$data['id_resit'];
								$no_resit = str_pad($id_resit, 7, '0', STR_PAD_LEFT);
							?>	
							<tr>
								<td align="center"><?php echo $no_resit; ?></td>
								<td align="center">
									<?php
									
									$id_penyumbang=$data['id_penyumbang']; 
									$sql1="SELECT * FROM sej6x_data_pelanggan WHERE id_pelanggan='$id_penyumbang'";
									$sqlquery1=mysql_query($sql1,$bd);
									$data1=mysql_fetch_array($sqlquery1);
									
									echo $data1['nama_pelanggan'];
									?>
								</td>
								<td align="center">
									<?php 
									$id_kutipan=$data['id_jeniskutipan']; 
									$sql2="SELECT * FROM sej6x_data_jeniskutipan WHERE id_kutipan='$id_kutipan'";
									$sqlquery2=mysql_query($sql2,$bd);
									$data2=mysql_fetch_array($sqlquery2);
									
									echo $data2['nama_kutipan'];
									?>
								</td>
								<td align="center"><?php echo $data['tarikh']; ?></td>
								<td align="center"><?php echo $data['amaun']; ?></td>
								<td align="center"><?php echo $data['no_cek']; ?></td>
								<td></td>
							</tr>
							<?php	
							$i++;
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
                     