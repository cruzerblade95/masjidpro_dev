<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Upload Minit Mesyuarat</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li class="active">Upload Minit Mesyuarat</li>
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
					Maklumat Fail
				</div>
				<div class="card-body">
					<form action="admin/add_laporanaktiviti.php" method='post' enctype="multipart/form-data">
                        <div class="col-lg-4">
							<div class="form-group">
								<label>Tarikh</label>
								<input class="form-control" name="tarikh" id="tarikh" type="date" required>
							</div>    
						</div>                     
                        <div class="col-lg-4">
							<div class="form-group">
								<label>Nama Fail</label>
								<input class="form-control" placeholder="Contoh:Minit Mensyuarat 1/10/2018" name="description" id="description" required>   
							</div>    
						</div>      
						<div class="col-lg-4">
							<div class="form-group">
								 <label>Upload Fail</label>
								 <input type="file" class="form-control" name="file" id="file" />
							</div>    
						</div>      
						<div class="col-lg-2">
							<div class="form-group">
								<br>
								<input type="submit" name="submit" value="Upload" class="btn btn-primary"></input> 
							</div>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Laporan</div>
					<script>
					function myFunction() {
					window.print();
					}
					</script>
				<div class="card-body">
					<div class="table-responsive">
					<?php 
					include("connection/connection.php");
					$result= mysqli_query($bd2,"SELECT id,tarikh,description,filename FROM laporan_aktiviti WHERE id_masjid='$id_masjid'
					ORDER BY ID desc" ) or die("SELECT Error: ".mysqli_error()); 
					?>
					   <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th><div align="center">No.</div></th>
									<th><div align="center">Nama Fail</div></th>
									<th><div align="center">Tarikh</div></th>
                                    <th><div align="center">Lihat Fail</div></th>
									<th><div align="center">Muat Turun</div></th>
									<th><div align="center">Padam</div></th>
								</tr>
							</thead>
							<tbody>
						  <?php $x=1; ?>
						  <?php while ($row = mysqli_fetch_array($result)){ 
						  $files_field= $row['filename'];
						  $files_show= "Uploads/files/$files_field";
						  $descriptionvalue= $row['description'];  ?>
								<tr class="odd gradeX">
									<td><div align="center"><?php echo $x; ?></div></td>
									<td><?php echo $descriptionvalue; ?></td>
									<td><div align="center"><?php echo $row['tarikh']; ?></div></td>
									<td>
                                        <div align="center">
                                            <?php if(strpos($files_show, '.pdf') === false) echo "<a target='_blank' href='https://view.officeapps.live.com/op/embed.aspx?src=https://masjidpro.com/Masjid/$files_show' class='btn btn-warning'><i class='fa fa-file'></i></a>"?>
                                        </div>
									</td>
                                    <td>
                                        <div align="center">
                                            <?php echo "<a href='$files_show' class='btn btn-info'><i class='fa fa-upload'></i></a>"?>
                                        </div>
                                    </td>
									 <td><div align="center">
								   <form name="delete" method="POST" action="admin/del_laporanaktiviti.php">
								   <input type="hidden" name="del" id="del" value="<?php echo $row['id']; ?>">
								   <button type="submit" name="delete" id="delete" class="btn btn-danger" title="Padam" onclick="return confirm('Padam Laporan Aktiviti?');" ><i class="fas fa-trash"></i>
										 </button> </form>
								  </div></td>
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
				<!-- /.card-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-6 -->
	</div>
</div>

 
                                         
                                
