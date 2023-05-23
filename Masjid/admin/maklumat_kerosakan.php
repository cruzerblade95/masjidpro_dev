<?php 
                include("connection/connection.php");
				
				 if(isset($_POST['search']))
	 			 { 
				 $daripada = $_POST['daripada'];				
				 $hingga = $_POST['hingga'];
				
				}
				?>
<?php
if($_GET['action']=="maklumatkerosakan")
{
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Laporan Kerosakan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
					<li class="active">Laporan Kerosakan</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<div class="content mt-3">
	<!-- <div class="row">
		<div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Carian &nbsp;&nbsp;
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
	</div> -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Laporan Kerosakan&nbsp;
                    <?php
                    if($_GET['action']=="maklumatkerosakan")
                    {
                    ?>
					    <a href="utama.php?view=admin&action=kerosakan" class="btn btn-primary">Borang Kerosakan</a>
                    <?php
                    }
                    ?>
					<!-- <button onclick="myFunction()" class="btn btn-primary">Cetak</button>
					<script>
					function myFunction() {
					window.print();
					}
					</script> -->
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
							<center><h4>LAPORAN KEROSAKAN <!-- <br> DARIPADA <?php echo $daripada?> HINGGA <?php echo $hingga ?></h4></center> -->
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
						//if($statuss == '1')
						//{
							//$sql_search="SELECT id_kerosakkan,jenis_kerosakan,catatan_kerosakkan,catatan_tindakkan,tarikh_kerosakkan FROM sej6x_data_kerosakkan WHERE id_masjid='$id_masjid' AND tarikh_kerosakkan BETWEEN '$daripada' AND '$hingga' "; 
							$sql_search="SELECT id_kerosakkan,jenis_kerosakan,catatan_kerosakkan,catatan_tindakkan,tarikh_kerosakkan FROM sej6x_data_kerosakkan WHERE id_masjid='$id_masjid'"; 							
							$result = mysqli_query($bd2,$sql_search) or die ("Error :".mysqli_error());
						?> 
							<table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
								<thead>
									<tr>
										<th><div align="center">Bil</div></th>
										<th><div align="center">Jenis Kerosakan</div></th>
										<th><div align="center">Kerosakan</div></th>
										<th><div align="center">Ulasan</div></th>
										<th><div align="center">Tindakan</div></th>
									</tr>
								</thead>
								<tbody>
								<?php 
								$x=1; 
								while($row = mysqli_fetch_assoc($result))
								{ 
								?>
									<tr>
										<td><div align="center"><?php echo $x; ?></div></td>
										<td><div align="center"><?php echo $row['jenis_kerosakan']; ?></div></td>
										<td><div align="center"><?php echo $row['catatan_kerosakkan']; ?></div></td>
										<td class="center"><div align="center"><?php echo $row['catatan_tindakkan']; ?></div></td>
										<td>
											<div align="center">
												<a href="utama.php?view=admin&action=semak_kerosakan&id_kerosakkan=<?php echo $row['id_kerosakkan'];?>"> 
													<button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Edit">
														<i class="fa fa-pencil"></i>
													</button>
												</a>
											</div>
											<div align="center">
												<form name="delete" method="POST" action="admin/del_kerosakkan.php">
													<input type="hidden" name="del" id="del" value="<?php echo $row['id_kerosakkan']; ?>">
													<button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam"><i class="fa fa-times"></i></button>
												</form>
											</div> 
										</td>
									</tr>
						<?php 
							
								$x++;
								}
						//}
						?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
   