<?php 

	include("connection/connection.php");

	if(isset($_POST['search']))
	{ 
		$daripada = $_POST['daripada'];				
		$hingga = $_POST['hingga'];
	}

?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Laporan Utiliti</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li class="active">Laporan Utiliti</li>
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
					<form id="form1" name="form1" method="POST" action="<?php echo $PHP_SELF;?>">
					<div class="row"> 
					    <div class="col-lg-12">     
							<div class="col-lg-3">
								<div class="form-group">
									<label>Daripada</label>
									<input class="form-control" name="daripada" id="daripada" type="date" required>   
								</div>    
                            </div>                     
                            <div class="col-lg-3">
								<div class="form-group">
									<label>Hingga</label>
									<input class="form-control" name="hingga" id="hingga" type="date" required>   
								</div>    
                            </div>      
							<div class="col-lg-2">
								<div class="form-group">
									<br>
									<input type="submit" name="search" value="Carian" class="btn btn-primary"></input> 
								</div>
								<input type="hidden" name="carisearch" value="1" />
							</div>
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
					Maklumat Utiliti
                    <button onclick="myFunction()" class="btn btn-primary">Cetak</button>
					<script>
					function myFunction() {
					 window.print();
					}
					</script>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
							<center><h4>LAPORAN UTILITI<br>DARIPADA <?php echo $daripada; ?> HINGGA <?php echo $hingga; ?></h4></center>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="table-responsive">
							<?php 
							
							include("connection/connection.php");
							  
							if(isset($_POST['search']))
							{ 
								$daripada = $_POST['daripada']; 
								$hingga = $_POST['hingga'];
								$statuss = $_POST['carisearch']; 
							}
							if($statuss == '1')
							{
								$sql_search="SELECT id_utiliti,jenis_utiliti,tarikh_bayaran,ref_resit,harga_bayaran,catatan FROM sej6x_data_utiliti WHERE id_masjid='$id_masjid' AND tarikh_bayaran BETWEEN '$daripada' AND '$hingga' ";  
								$result = mysql_query($sql_search) or die ("Error :".mysql_error());
							?> 
							<table class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th><div align="center">Bil</div></th>
										<th><div align="center">Jenis Utiliti</div></th>
										<th><div align="center">Tarikh Bayar</div></th>
										<th><div align="center">Ref. Resit</div></th>
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
										<td>
											<div align="center">
											<?php 
											if($row["jenis_utiliti"]=='1')
											{
												echo "Air"; 
											}
											else if($row["jenis_utiliti"]=='2') 
											{
												echo "Elektrik"; 
											} 
											else if($row["jenis_utiliti"]=='3') 
											{
												echo "Internet"; 
											} 
											else if($row["jenis_utiliti"]=='4') 
											{
												echo "Lain-Lain"; 
											} 
											?>
											</div>
										</td>
										<td><div align="center"><?php echo $row['tarikh_bayaran']; ?></div></td>
										<td class="center"><div align="center"><?php echo $row['ref_resit']; ?></div></td>
										<td>
											<div align="center">
												<a href="utama.php?view=admin&action=semak_utiliti&id_utiliti=<?php echo $row['id_utiliti'];?>"> 
													<button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Edit">
														<i class="fa fa-pencil"></i>
													</button>
												</a>
											</div>
											<div align="center">
												<form name="delete" method="POST" action="admin/del_utiliti.php">
												   <input type="hidden" name="del" id="del" value="<?php echo $row['id_utiliti']; ?>">
												   <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam" onclick="return confirm('Padam rekod?')"><i class="fa fa-times"></i></button>
											   </form>
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
						</div>
						<!-- /.table-responsive -->
					</div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>           