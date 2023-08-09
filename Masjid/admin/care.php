<?php
	include('connection/connection.php');
    if(isset($_POST['carian']))
    {
        $tarikh_awal = $_POST['tarikh_awal'];
        $tarikh_akhir = $_POST['tarikh_akhir'];

        $tarikh_awal = $tarikh_awal." 00:00:00";
        $tarikh_akhir = $tarikh_akhir." 23:59:59";
    }

?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Masjid Care</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li class="active">Masjid Care</li>
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
					Senarai Maklumat
				</div>
				<div class="card-body">
                    <form action="" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <center>
                                <h4>Carian Tarikh</h4>
                            </center>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-3">
                        </div>
                        <div class="col-lg-3">
                            <center>Dari</center>
                        </div>
                        <div class="col-lg-3">
                            <center>Hingga</center>
                        </div>
                        <div class="col-lg-3">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                        </div>
                        <div class="col-lg-3">
                            <center><input type="date" name="tarikh_awal" class="form-control" style="width:200px" required <?php if(isset($_POST['carian'])) { ?>value="<?php echo $_POST['tarikh_awal']; ?>"<?php } ?></center>
                        </div>
                        <div class="col-lg-3">
                            <center><input type="date" name="tarikh_akhir" class="form-control" style="width:200px" required <?php if(isset($_POST['carian'])) { ?>value="<?php echo $_POST['tarikh_akhir']; ?>"<?php } ?>></center>
                        </div>
                        <div class="col-lg-3">
                        </div>
                    </div>
                    <br>
                    <center><button type="submit" class="btn btn-info" name="carian">Carian</button></center>
                    </form>
                    <?php
                    if(isset($_POST['carian']))
                    {
                    ?>
                    <hr>
					<div class="table-responsive">
                        <table id="meja_akaun2" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
							<thead>
								<tr>
									<th><div align="center">#</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">No K/P</div></th>
									<th><div align="center">No Telefon</div></th>
									<th><div align="center">Kariah Masjid</div></th>
									<th><div align="center">Lihat Rekod</div></th>
								</tr>
							</thead>
							<tbody>
							<?php 
														
							$sql="SELECT a.id_gejala, a.id_data,a.no_ic 'no_ic', a.time, b.nama_penuh, b.no_hp, b.id_masjid FROM sej6x_data_gejala a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.no_ic=b.no_ic AND a.time BETWEEN '$tarikh_awal' AND '$tarikh_akhir' GROUP BY a.no_ic
                                UNION SELECT c.id_gejala, c.ID 'id_data', c.no_ic 'no_ic', c.time, d.nama_penuh, d.no_tel 'no_hp', d.id_masjid FROM sej6x_data_gejala c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.no_ic=d.no_ic AND c.time BETWEEN '$tarikh_awal' AND '$tarikh_akhir' GROUP BY c.no_ic";
							$sqlquery = mysqli_query($bd2,$sql);
							$row=mysqli_num_rows($sqlquery);
							
							$x=1; 
							while($row = mysqli_fetch_array($sqlquery))
							{ 
							?>
									<tr>
									<td><div align="center"><?php echo $x; ?></div></td>
									<td><?php echo $row['nama_penuh']; ?></td>
									<td><div align="center"><?php echo $row['no_ic']; ?></div></td>
									<td><div align="center"><?php echo $row['no_hp']; ?></div></td>
									<td align="center">
									<?php
									$id_masjid1=$row['id_masjid'];
									$sql1="SELECT * FROM sej6x_data_masjid WHERE id_masjid='$id_masjid1'";
									$sqlquery1=mysqli_query($sql1,$bd2);
									$data=mysqli_fetch_array($sqlquery1);
									
									echo $data['nama_masjid'];
									?>
									</td>
									<td align="center">
										<a href="utama.php?view=admin&action=view_care&no_ic=<?php echo $row['no_ic']; ?>&tarikh_awal=<?php echo $tarikh_awal; ?>&tarikh_akhir=<?php echo $tarikh_akhir; ?>" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="right" title="Lihat" ><i class="fa fa-search"></i></a>
										<!-- <button type="button" class="form-control" title="Papar Gejala" data-toggle="modal" data-target="#displayGejala" value="<?php echo $row['no_ic'];?>" onClick="displayData(this.value)"><i class="fas fa-search"></i></button> -->
									</td>
									<!-- <td><div align="center">
											<form name="delete" method="POST" action="admin/del_senaraizakat.php">
												<input type="hidden" name="del" id="del" value="<?php //echo $row['id_zakat']; ?>">
												<button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam" onclick="return confirm('Padam rekod?')"><i class="fa fa-times"></i></button> 
											</form>
										</div>
									</td> -->
								  </tr>
							<?php
							$x++;
							} 
							?>           
							</tbody>
						</table>
					</div>
                    <?php
                    }
                    ?>
				</div>
			</div>
		</div>
	</div>
</div>
		<div class="modal fade" id="displayGejala" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Maklumat Gejala</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<form enctype="multipart/form-data">
					<?php 
					include("connection/connection.php");

					$sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid'"; 
					$result = mysqli_query($sql_search) or die ("Error :".mysqli_error());
					?> 
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<center><h4><u>Maklumat Gejala</u></h4></center>
							</div>
						</div>	
						<hr>
						<div id="div_gejala">
						</div>
						<hr>
						<br>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
						</div>
						</div>
						<!-- /.row -->
					</div>
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- modal-dialog modal-lg -->
		</div>
		<!-- modal fade -->
<script>
function displayData(str){
	{
	if (str == "") {
	document.getElementById("div_gejala").innerHTML = "";
	return;
	} 
	else { 
		if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
		} 
		else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			document.getElementById("div_gejala").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","admin/getgejala.php?no_ic="+str,true);
		xmlhttp.send();
	}
}
}
jQuery(document).ready(function () {
    meja_akaun('#meja_akaun2', 'Senarai Ahli Kariah', [ 0, 1, 2, 3, 4 ]);
});
</script>
 
                                         
                                
