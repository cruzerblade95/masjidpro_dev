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
				<h1>Menu Tabung Masjid</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=kewangan">Menu Kewangan</a></li>
					<li class="active">Menu Tabung Masjid</li>
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
					Maklumat Tabung-Tabung Masjid&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
					<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Tambah Tabung </button>
				</div>
				<!-- /.panel-heading -->
				<div class="card-body">
					<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="3%"><div align="center">#</div></th>
								<th><div align="center">Nama Tabung</div></th>
								<th width="15%"><div align="center">Amaun Tabung (RM)</div></th>
								<th width="15%"><div align="center">Sumbangan</div></th>
								<th width="15%"><div align="center">Bayaran</div></th>
							</tr>
						</thead>
						<tbody>
						<?php
							$sql="SELECT * FROM sej6x_data_jenistabung WHERE id_masjid='$id_masjid'";
							$sqlquery=mysql_query($sql,$bd);
							
							$i=1;
							while($data=mysql_fetch_array($sqlquery))
							{
						?>
							<tr>
								<td align="center"><?php echo $i; ?></td>
								<td><a href="utama.php?view=admin&action=maklumat_tabung&id_tabung=<?php echo $data['id_tabung']; ?>"><?php echo $data['nama_tabung'];?></a></td>
								<td align="center"><?php echo $data['amaun_tabung'];?></td>
								<td align="center"><a href="utama.php?view=admin&action=sumbangan&id_tabung=<?php echo $data['id_tabung']; ?>" class="btn btn-info btn-sm btn-block"><i class="fas fa-file-invoice-dollar"></i><br>Sumbang</a></td>
								<td align="center"><a href="utama.php?view=admin&action=bayaran&id_tabung=<?php echo $data['id_tabung']; ?>" class="btn btn-warning btn-sm btn-block"><i class="far fa-money-bill-alt"></i><br>Bayar</a></td>
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

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">BORANG TABUNG</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<form method="post" id="insert_form" action="admin/add_tabung.php">
								<center>          
								<div class="row">
									<div class="col-lg-12">
										<center><h4><u>Maklumat Tabung Masjid</u></h4></center>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-lg-3">
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label style="color: red">*</label><b>Nama Tabung</b>
											<input class="form-control" name="nama" id="nama" required>
										</div>
									</div>
									<!-- /.col-lg-6 (nested) -->
								</div>
								<div class="row">
									<div class="col-lg-3">
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label style="color:red">*</label><b>Amaun Dalam Tabung (RM)</b>
											<input type="number" class="form-control" name="amaun" id="amaun" required>
										</div>
									</div>
								</div>
								<!-- /.row (nested) -->
								<div class="row">
									<div class="col-lg-12">
										<center>
											Sila isi semua maklumat yang bertanda<label style="color: red">*</label>
										</center>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">	
										<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
										<input type="hidden" name="view" id="view" value="<?php echo $view;?>">
										<input type="submit" name="insert" id="insert" value="Simpan" class="btn btn-success" />            
									</div>
								</div>
								<br>
								</center>
								</form>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
								</div>
							</div>
							<!-- /.col-lg-12 -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.modal-body -->
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- modal-dialog modal-lg -->
		</div>
		<!-- modal fade -->
		
	</div>
	<!-- /.row --> 
</div>                                                              
                     