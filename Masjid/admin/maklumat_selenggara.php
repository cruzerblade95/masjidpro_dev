<?php 

	include("connection/connection.php");

	if(isset($_POST['search']))
	{ 
		$daripada = $_POST['daripada'];				
		$hingga = $_POST['hingga'];
	}
	
?>
<?php
if($_GET['action']=="maklumatselenggara")
{
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Laporan Penyelenggaraan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
					<li class="active">Laporan Penyelenggaraan</li>
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
					Carian
				</div>
				<div class="panel-body">
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
					Maklumat Penyelenggaraan&nbsp;
                    <?php
                    if($_GET['action']=="maklumatselenggara")
                    {
                    ?>
                        <a href="utama.php?view=admin&action=selenggara" class="btn btn-primary">Borang Penyelenggaraan</a>
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
							<center><h4>LAPORAN PENYELENGGARAAN <!-- <br> DARIPADA <?php echo $daripada; ?> HINGGA <?php echo $hingga; ?></</h4></center> -->
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
							//$sql_search="SELECT id_selenggara,pilihan_selenggara,id_vendor,tarikh_selenggara FROM sej6x_data_selenggara WHERE id_masjid='$id_masjid' AND tarikh_selenggara BETWEEN '$daripada' AND '$hingga' "; 
							$sql_search="SELECT * FROM sej6x_data_selenggara WHERE id_masjid='$id_masjid'";
							$result = mysqli_query($bd2,$sql_search) or die ("Error :".mysqli_error());
						?> 
							<table id="meja_akaun2" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
								<thead>
									<tr>
										<th><div align="center">Bil</div></th>
										<th><div align="center">Jenis Selenggara</div></th>
										<th><div align="center">P.I.C (Person-In-Charge)</div></th>
                                        <th><div align="center">Nama P.I.C</div></th>
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
										<td>
											<div align="center">
											<?php 
											if($row["pilihan_selenggara"]=='1')
											{
												echo "Fasiliti"; 
											}
											else if($row["pilihan_selenggara"]=='2') 
											{
												echo "Elektrik"; 
											} 
											else if($row["pilihan_selenggara"]=='3') 
											{
												echo "Air"; 
											} 
											else if($row["pilihan_selenggara"]=='4') 
											{
												echo "Komunikasi"; 
											} 
											else if($row["pilihan_selenggara"]=='5') 
											{
												echo "Perkakasan"; 
											} 
											?>
											</div>
										</td>
                                        <td align="center">
                                            <?php
                                            if($row['id_vendor']!="")
                                            {
                                                echo "Vendor";
                                            }
                                            else if($row['id_dataajk']!="")
                                            {
                                                echo "Masjid";
                                            }
                                            ?>
                                        </td>
										<td>
											<div align="center">
												<?php
                                                if($row['id_vendor']!="")
                                                {
                                                    $id_vendor=$row['id_vendor'];

                                                    $sql="SELECT * FROM kew_vendor WHERE id_vendor='$id_vendor'";
                                                    $sqlquery=mysqli_query($bd2,$sql);
                                                    $data=mysqli_fetch_array($sqlquery);
												?>
												<button class="form-control" type="button" data-toggle="modal" data-target="#myVendor<?php echo $id_vendor; ?>">
													<?php echo $data['nama_vendor']; ?>&nbsp;<i class="fas fa-id-card"></i>
												</button>
                                                <?php
                                                }
                                                else if($row['id_dataajk']!="")
                                                {
                                                    $id_dataajk=$row['id_dataajk'];

                                                    $sql="SELECT a.nama_penuh, a.no_ic, a.no_hp, a.alamat_terkini, a.id_data FROM sej6x_data_peribadi a, data_ajkmasjid b WHERE b.id_dataajk='$id_dataajk' AND a.id_data=b.id_ajk";
                                                    $sqlquery=mysqli_query($bd2,$sql);
                                                    $data=mysqli_fetch_array($sqlquery);
                                                ?>
                                                <button class="form-control" type="button" data-toggle="modal" data-target="#myAJK<?php echo $id_dataajk; ?>">
                                                    <?php echo $data['nama_penuh']; ?>&nbsp;<i class="fas fa-id-card"></i>
                                                </button>
                                                <?php
                                                }
                                                ?>
											</div>
										</td>
										<td align="center">
											<form name="delete" method="POST" action="admin/del_selenggara.php">
												<a href="utama.php?view=admin&action=semak_selenggara&id_selenggara=<?php echo $row['id_selenggara'];?>"> 
													<button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Edit">
														<i class="fa fa-pencil"></i>
													</button>
												</a>
												<input type="hidden" name="del" id="del" value="<?php echo $row['id_selenggara']; ?>">
												<button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam" onclick="return confirm('Padam rekod?')">
													<i class="fa fa-times"></i>
												</button>
											</form> 
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
						<!-- /.table-responsive -->
					</div>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>    
<?php
$sql1="SELECT * FROM sej6x_data_selenggara WHERE id_masjid='$id_masjid'";
$sqlquery1=mysqli_query($bd2,$sql1);
while($data1=mysqli_fetch_array($sqlquery1))
{
	$id_vendor=$data1['id_vendor'];
	
	$sql2="SELECT * FROM kew_vendor WHERE id_vendor='$id_vendor'";
	$sqlquery2=mysqli_query($bd2,$sql2);
	$data2=mysqli_fetch_array($sqlquery2);
?>
<div class="modal fade" id="myVendor<?php echo $id_vendor; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">MAKLUMAT VENDOR</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<center>          
						<div class="row">
							<div class="col-lg-12">
								<center><h4><u>Maklumat Vendor</u></h4></center>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-lg-3">
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Nama Vendor</label><br>
									<input type="text" class="form-control" disabled value="<?php echo $data2['nama_vendor']; ?>">
								</div>
								<div class="form-group">
									<label>No Kad Pengenalan / No Syarikat</label><br>
									<input type="text" class="form-control" disabled value="<?php echo $data2['ic_id']; ?>">
								</div>
								<div class="form-group">
									<label>No Telefon</label>
									<input type="text" class="form-control" disabled value="<?php echo $data2['no_phone']; ?>">
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<textarea rows="5" class="form-control" disabled><?php echo $data2['alamat']; ?></textarea>
								</div>
							</div>
						</div>
						<br>
						</center>
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
<?php
}
?>
<?php
$sql3="SELECT * FROM sej6x_data_selenggara WHERE id_masjid='$id_masjid'";
$sqlquery3=mysqli_query($bd2,$sql3);
while($data3=mysqli_fetch_array($sqlquery3))
{
    $id_dataajk=$data3['id_dataajk'];

    $sql4="SELECT a.nama_penuh, a.no_ic, a.no_hp, a.alamat_terkini, a.id_data FROM sej6x_data_peribadi a, data_ajkmasjid b WHERE b.id_dataajk='$id_dataajk' AND a.id_data=b.id_ajk";
    $sqlquery4=mysqli_query($bd2,$sql4);
    $data4=mysqli_fetch_array($sqlquery4);
?>
<div class="modal fade" id="myAJK<?php echo $id_dataajk; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">MAKLUMAT VENDOR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <center>
                            <div class="row">
                                <div class="col-lg-12">
                                    <center><h4><u>Maklumat Vendor</u></h4></center>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-3">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nama Vendor</label><br>
                                        <input type="text" class="form-control" disabled value="<?php echo $data4['nama_penuh']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>No Kad Pengenalan / No Syarikat</label><br>
                                        <input type="text" class="form-control" disabled value="<?php echo $data4['no_ic']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>No Telefon</label>
                                        <input type="text" class="form-control" disabled value="<?php echo $data4['no_hp']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea rows="5" class="form-control" disabled><?php echo $data4['alamat_terkini']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </center>
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
    <?php
}
?>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai Penyelenggaraan', [ 0, 1, 2, 3 ]);
    });
</script>
