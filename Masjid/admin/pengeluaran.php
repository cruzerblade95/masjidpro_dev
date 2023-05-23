<?php 
	include("connection/connection.php");
	$result= mysql_query("SELECT id_masjid,kod_masjid,nama_masjid,alamat_masjid FROM sej6x_data_masjid WHERE kod_masjid='$jname'") or die("SELECT Error: ".mysql_error()); 
	$namamasjid = mysql_fetch_assoc($result);
?>


<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Utama</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=dashboard&qariah=semua">Statistik Ahli Kariah</a></li>
					<li class="active">Statistik Bayaran</li>
					<li><a href="utama.php?view=admin&action=dashboard_bantuan">Statistik Bantuan</a></li>
				</ol>
			</div>
		</div>
	</div>
</div>
<!--link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css"-->

<script id="pilih_jquery" src="js/jquery-3.4.1.js"></script>
<script id="pilih_ui" src="js/jquery-ui.js"></script>
<script>
    //function semak() {
    //    var dari = $('#dari').val();
    //    var hingga = $('#hingga').val();
    //    document.location.href='utama.php?view=admin&action=dashboard_payment&dari='+dari+'&hingga='+hingga
    //}
    $(document).ready(function () {
        $( "#datepicker" ).datepicker({
            altField: "#dari",
            altFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
        $( "#datepicker1" ).datepicker({
            altField: "#hingga",
            altFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    });
</script>
<div class="content mt-3">
	<div class="row">
		<div class="col-lg-12">
			<!-- <div class="card">
				<div class="card-header">
				<?php
				if(isset($_GET['dari']) AND isset($_GET['hingga']))
				{
				?>
					<div class="col-lg-12" align="center">
						<a href="utama.php?view=admin&action=dashboard_payment" class="btn btn-primary">Carian Tarikh</a>
					</div>
				<?php
				}
				else
				{
				?>
				<form enctype="multipart/form-data" id="rekod_bayaran" name="rekod_bayaran" action="utama.php" method="GET">
					<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6" align="center">
							Dari : <input type="date" id="datepicker" name="dari">
						</div>
						<div class="col-lg-6" align="center">
							Hingga : <input type="date" id="datepicker1" name="hingga">
						</div>
						<br>
						<div class="col-lg-12" align="center">
							<input type="submit" class="btn btn-primary" value="Papar">
							<input type="hidden" name="view" value="admin">
							<input type="hidden" name="action" value="dashboard_payment">
						</div>	
					</div>
					</div>
				</form>
				<?php
				}
				?>
				</div>
			</div> -->
		</div>
	</div>
	<?php
		//$tarikh_awal = "".$_GET['dari']."";
		$tarikh_awal = $_GET['dari'];
		$tarikh_awal=str_replace("'","",$tarikh_awal);
		$tarikh_awal=str_replace("/","-",$tarikh_awal);
		$year_awal=substr($tarikh_awal, 0, 4);
		$month_awal=substr($tarikh_awal, 5, 2);
		$day_awal=substr($tarikh_awal, 8,2);
		$tarikh_awal=$year_awal."-".$month_awal."-".$day_awal;
		
		//$tarikh_akhir = "".$_GET['hingga']."";
		$tarikh_akhir = $_GET['hingga'];
		$tarikh_akhir=str_replace("'","",$tarikh_akhir);
		$tarikh_akhir=str_replace("/","-",$tarikh_akhir);
		$year_akhir=substr($tarikh_akhir, 0, 4);
		$month_akhir=substr($tarikh_akhir, 5, 2);
		$day_akhir=substr($tarikh_akhir, 8,2);
		$tarikh_akhir=$year_akhir."-".$month_akhir."-".$day_akhir;

		$q_main = "SELECT SUM(amaun) 'amaun' FROM sej6x_bayar_online WHERE id_masjid = $id_masjid AND status_bayaran = '1'";
		$sql_main = "SELECT * FROM sej6x_bayar_online WHERE id_masjid='$id_masjid' AND status_bayaran='1'";

		if($_GET['dari'] != NULL && $_GET['hingga'] != NULL) $q_main .= " AND tarikh_bayaran BETWEEN CAST('$tarikh_awal 00:00:00' AS DATETIME) AND CAST('$tarikh_akhir 23:59:59' AS DATETIME)";
		if($_GET['dari'] != NULL && $_GET['hingga'] != NULL) $sql_main .= " AND tarikh_bayaran BETWEEN CAST('$tarikh_awal 00:00:00' AS DATETIME) AND CAST('$tarikh_akhir 23:59:59' AS DATETIME)";
		
		//Sumbangan
		$sql = "$sql_main AND jenis_bayaran = 'Sumbangan'";
		$sqlquery = mysql_query($sql,$bd);
		$row5 = mysql_num_rows($sqlquery);
		if(mysql_num_rows($sqlquery)==0)
		{
			$amaun_sumbangan = 0;
		}
		else if(mysql_num_rows($sqlquery)>0)
		{
			$sql = "$q_main AND jenis_bayaran = 'Sumbangan'";
			$sqlquery = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
			$data = mysqli_fetch_array($sqlquery);
			$amaun_sumbangan = $data['amaun'];
		}
		
		//Derma
		$sql1 = "$sql_main AND jenis_bayaran = 'Derma'";
		$sqlquery1 = mysql_query($sql1,$bd);
		$row6 = mysql_num_rows($sqlquery1);
		if(mysql_num_rows($sqlquery1)==0)
		{
			$amaun_derma = 0;
		}
		else if(mysql_num_rows($sqlquery1)>0)
		{
			$sql1 = "$q_main AND jenis_bayaran = 'Derma'";
			$sqlquery1 = mysqli_query($bd2, $sql1) or die(mysqli_error($bd2));
			$data1 = mysqli_fetch_array($sqlquery1);
			$amaun_derma = $data1['amaun'];
		}
		
		
		//Wakaf
		$sql3 = "$sql_main AND jenis_bayaran = 'Wakaf'";
		$sqlquery3 = mysql_query($sql3,$bd);
		$row8 = mysql_num_rows($sqlquery3);
		if(mysql_num_rows($sqlquery3)==0)
		{
			$amaun_wakaf = 0;
		}
		else if(mysql_num_rows($sqlquery3)>0)
		{
			$sql3 = "$q_main AND jenis_bayaran ='Wakaf'";
			$sqlquery3 = mysqli_query($bd2, $sql3) or die(mysqli_error($bd2));
			$data3 = mysqli_fetch_array($sqlquery3);
			$amaun_wakaf=$data3['amaun'];
		}
		
		//Tabung Jumaat
		$sql4 = "$sql_main AND jenis_bayaran = 'Tabung Jumaat'";
		$sqlquery4 = mysql_query($sql4,$bd);
		$row9 = mysql_num_rows($sqlquery4);
		if(mysql_num_rows($sqlquery4)==0)
		{
			$amaun_jumaat = 0;
		}
		else if(mysql_num_rows($sqlquery4)>0)
		{
			$sql4 = "$q_main AND jenis_bayaran = 'Tabung Jumaat'";
			$sqlquery4 = mysqli_query($bd2, $sql4) or die(mysqli_error($bd2));
			$data4 = mysqli_fetch_array($sqlquery4);
			$amaun_jumaat = $data4['amaun'];
		}
	?>
	<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
	<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
	<script>
	window.onload = function () {

	var options = {
		animationEnabled: true,
		title: {
			text: "Jumlah Bayaran Online"
		},
		axisY: {
			title: "Jumlah Amaun(RM)",
			includeZero: true
		},
		axisX: {
			title: "Jenis Bayaran"
		},
		data: [{
			type: "column",
			yValueFormatString: "# Ringgit Malaysia",
			dataPoints: [
				{ label: "Sumbangan", y: <?php echo $amaun_sumbangan; ?> },	
				{ label: "Derma", y: <?php echo $amaun_derma; ?> },	
				{ label: "Wakaf", y: <?php echo $amaun_wakaf; ?> },
				{ label: "Tabung Jumaat", y: <?php echo $amaun_jumaat; ?> }
				
			]
		}]
	};
	$("#chartContainer").CanvasJSChart(options);

	}
	</script>
	<?php
	if(isset($_GET['dari']) AND isset($_GET['hingga']))
	{
	?>
	<!-- <div class="row">
		<div class="col-lg-12" align="center">
			<h4>Carian Tarikh Dari <?php echo $tarikh_awal; ?> Sehingga <?php echo $tarikh_akhir; ?></h4>
		</div>
	</div>
	<br> -->
	<?php
	} 
	?>
	<!-- <div class="row">
		<div class="col-lg-12">
			<div id="chartContainer" style="height: 370px; width: 100%;"></div>
		</div>
	</div> -->
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th><div align="center">#</div></th>
									<th><div align="center">Jenis Bayaran</div></th>
									<!-- <th><div align="center">Bilangan Bayaran</div></th> -->
									<th><div align="center">Jumlah Amaun Bayaran</div></th>
									<th><div align="center">Caj Pengurusan</div></th>
									<th><div align="center">Jumlah Amaun Bersih</div></th>
									<th><div align="center">Pengeluaran Tunai</div></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td align="center">1</td>
									<td align="center">Sumbangan</td>
									<!-- <td align="center">
									<?php
									//$sql5="SELECT * FROM sej6x_bayar_online WHERE id_masjid='$id_masjid' AND status_bayaran='1' AND jenis_bayaran='Sumbangan'";
									//$sqlquery5=mysql_query($sql5,$bd);
									//echo $row5;
									?>
									</td>  -->
									<td align="center"><?php echo "RM ".number_format($amaun_sumbangan,2); ?></td>
									<td align="center">
									<?php
									if($row5>0)
									{
										$amaun_sumbangan = floatval($amaun_sumbangan);
										$caj_sumbangan = $amaun_sumbangan * 0.02 + 1;
										echo "RM ".$caj_sumbangan = number_format($caj_sumbangan,2);
									}
									else if($row5==0)
									{
										echo "RM 0.00";
									}
									?>
									</td>
									<td align="center">
									<?php
									if($row5>0)
									{
										$bersih_sumbangan = $amaun_sumbangan - $caj_sumbangan;
										echo "RM ".number_format($bersih_sumbangan,2);
									}
									else if($row5==0)
									{
										echo "RM 0.00";
									}
									?>
									</td>
									<td align="center">
										<input type="hidden" name="view" value="admin">
										<input type="hidden" name="action" value="senarai_bayaran">
										<input type="hidden" name="jenis_bayaran" value="Sumbangan">
										<?php
										if(isset($_GET['dari']) AND isset($_GET['hingga']))
										{
										?>
										<input type="hidden" name="dari" value="<?php echo $tarikh_awal; ?>">
										<input type="hidden" name="hingga" value="<?php echo $tarikh_akhir; ?>">
										<?php
										}
										?>
										<button type="button" class="form-control" data-toggle="modal" data-target="#mySumbangan" title="Lihat Maklumat Bayaran"><i class="fas fa-hand-holding-usd"></i></button>
									</td>
								</tr>          
								<tr>
									<td align="center">2</td>
									<td align="center">Derma</td>
									<!-- <td align="center">
									<?php
									//$sql6="SELECT * FROM sej6x_bayar_online WHERE id_masjid='$id_masjid' AND status_bayaran='1' AND jenis_bayaran='Derma'";
									//$sqlquery6=mysql_query($sql6,$bd);
									//echo $row6;
									?>
									</td> -->
									<td align="center"><?php echo "RM ".number_format($amaun_derma,2); ?></td>
									<td align="center">
									<?php
									if($row6>0)
									{
										$amaun_derma = floatval($amaun_derma);
										$caj_derma = $amaun_derma * 0.02 + 1;
										echo "RM ".$caj_derma = number_format($caj_derma,2);
									}
									else if($row6==0)
									{
										echo "RM 0.00";
									}
									?>
									</td>
									<td align="center">
									<?php
									if($row6>0)
									{
										$bersih_derma = $amaun_derma - $caj_derma;
										echo "RM ".number_format($bersih_derma,2);
									}
									else if($row6==0)
									{
										echo "RM 0.00";
									}
									?>
									</td>
									<td align="center">
										<form action="utama.php" method="GET" target="_blank">
											<input type="hidden" name="view" value="admin">
											<input type="hidden" name="action" value="senarai_bayaran">
											<input type="hidden" name="jenis_bayaran" value="Derma">
											<?php
											if(isset($_GET['dari']) AND isset($_GET['hingga']))
											{
											?>
											<input type="hidden" name="dari" value="<?php echo $tarikh_awal; ?>">
											<input type="hidden" name="hingga" value="<?php echo $tarikh_akhir; ?>">
											<?php
											}
											?>
											<button type="submit" class="form-control"  title="Lihat Maklumat Bayaran"><i class="fas fa-hand-holding-usd"></i></button>
										</form>
									</td>
								</tr>
								<tr>
									<td align="center">3</td>
									<td align="center">Wakaf</td>
									<!-- <td align="center">
									<?php
									//$sql8="SELECT * FROM sej6x_bayar_online WHERE id_masjid='$id_masjid' AND status_bayaran='1' AND jenis_bayaran='Wakaf'";
									//$sqlquery8=mysql_query($sql8,$bd);
									//echo $row8;
									?>
									</td> -->
									<td align="center"><?php echo "RM ".number_format($amaun_wakaf,2); ?></td>
									<td align="center">
									<?php
									if($row8>0)
									{
										$amaun_wakaf = floatval($amaun_wakaf);
										$caj_wakaf = $amaun_wakaf * 0.02 + 1;
										echo "RM ".$caj_wakaf = number_format($caj_wakaf,2);
									}
									else if($row8==0)
									{
										echo "RM 0.00";
									}
									?>
									</td>
									<td align="center">
									<?php
									if($row8>0)
									{
										$bersih_wakaf = $amaun_wakaf - $caj_wakaf;
										echo "RM ".number_format($bersih_wakaf,2);
									}
									else if($row8==0)
									{
										echo "RM 0.00";
									}
									?>
									</td>
									<td align="center">
										<form action="utama.php" method="GET" target="_blank">
											<input type="hidden" name="view" value="admin">
											<input type="hidden" name="action" value="senarai_bayaran">
											<input type="hidden" name="jenis_bayaran" value="Wakaf">
											<?php
											if(isset($_GET['dari']) AND isset($_GET['hingga']))
											{
											?>
											<input type="hidden" name="dari" value="<?php echo $tarikh_awal; ?>">
											<input type="hidden" name="hingga" value="<?php echo $tarikh_akhir; ?>">
											<?php
											}
											?>
											<button type="submit" class="form-control"  title="Lihat Maklumat Bayaran"><i class="fas fa-hand-holding-usd"></i></button>
										</form>
									</td>
								</tr>
								<tr>
									<td align="center">4</td>
									<td align="center">Tabung Jumaat</td>
									<!-- <td align="center">
									<?php
									//$sql9="SELECT * FROM sej6x_bayar_online WHERE id_masjid='$id_masjid' AND status_bayaran='1' AND jenis_bayaran='Tabung Jumaat'";
									//$sqlquery9=mysql_query($sql9,$bd);
									//echo $row9;
									?>
									</td> -->
									<td align="center"><?php echo "RM ".number_format($amaun_jumaat,2); ?></td>
									<td align="center">
									<?php
									if($row9>0)
									{
										$amaun_jumaat = floatval($amaun_jumaat);
										$caj_jumaat = $amaun_jumaat * 0.02 + 1;
										echo "RM ".$caj_jumaat = number_format($caj_jumaat,2);
									}
									else if($row9==0)
									{
										echo "RM 0.00";
									}
									?>
									</td>
									<td align="center">
									<?php
									if($row9>0)
									{
										$bersih_jumaat = $amaun_jumaat - $caj_jumaat;
										echo "RM ".number_format($bersih_jumaat,2);
									}
									else if($row9==0)
									{
										echo "RM 0.00";
									}
									?>
									</td>
									<td align="center">
										<form action="utama.php" method="GET" target="_blank">
											<input type="hidden" name="view" value="admin">
											<input type="hidden" name="action" value="senarai_bayaran">
											<input type="hidden" name="jenis_bayaran" value="Tabung Jumaat">
											<?php
											if(isset($_GET['dari']) AND isset($_GET['hingga']))
											{
											?>
											<input type="hidden" name="dari" value="<?php echo $tarikh_awal; ?>">
											<input type="hidden" name="hingga" value="<?php echo $tarikh_akhir; ?>">
											<?php
											}
											?>
											<button type="submit" class="form-control"  title="Lihat Maklumat Bayaran"><i class="fas fa-hand-holding-usd"></i></button>
										</form>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="mySumbangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">MAKLUMAT PENGELUARAN TUNAI</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <center>
                            <div class="row">
                                <div class="col-lg-3">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Jumlah Pengeluaran</label><br>
                                        <input type="number" class="form-control" placeholder="Masukkan Jumlah Pengeluran" required">
                                    </div>
                                    <div class="form-group">
                                        <label>Maklumat Bank</label><br>
                                        <select class="form-control" name="bank" required>
											<option value="">Sila Pilih:-</option>
											<option value="Affin Bank Berhad" >Affin Bank Berhad</option>
											<option value="Al Rajhi Banking & Investment Corporation (Malaysia) Berhad" >Al Rajhi Banking & Investment Corporation (Malaysia) Berhad</option>
											<option value="Alliance Bank Malaysia Berhad" >Alliance Bank Malaysia Berhad</option>
											<option value="AmBank (M) Berhad" >AmBank (M) Berhad</option>
											<option value="Bangkok Bank Berhad" >Bangkok Bank Berhad</option>
											<option value="Bank Islam Malaysia Berhad" >Bank Islam Malaysia Berhad</option>
											<option value="Bank Kerjasama Rakyat Malaysia Berhad (Bank Rakyat)" >Bank Kerjasama Rakyat Malaysia Berhad (Bank Rakyat)</option>
											<option value="Bank Muamalat Malaysia Berhad" >Bank Muamalat Malaysia Berhad</option>
											<option value="Bank of America Malaysia Berhad" >Bank of America Malaysia Berhad</option>
											<option value="Bank of China (Malaysia) Berhad" >Bank of China (Malaysia) Berhad</option>
											<option value="Bank Simpanan Nasional (BSN)" >Bank Simpanan Nasional (BSN)</option>
											<option value="BNP Paribas Malaysia Berhad" >BNP Paribas Malaysia Berhad</option>
											<option value="China Construction Bank (Malaysia) Berhad" >China Construction Bank (Malaysia) Berhad</option>
											<option value="CIMB Bank Berhad" >CIMB Bank Berhad</option>
											<option value="Citibank Berhad" >Citibank Berhad</option>
											<option value="Deutsche Bank (Malaysia) Berhad" >Deutsche Bank (Malaysia) Berhad</option>
											<option value="Hong Leong Bank Berhad" >Hong Leong Bank Berhad</option>
											<option value="HSBC Bank Malaysia Berhad" >HSBC Bank Malaysia Berhad</option>
											<option value="India International Bank (Malaysia) Berhad" >India International Bank (Malaysia) Berhad</option>
											<option value="Industrial and Commercial Bank of China (Malaysia) Berhad" >Industrial and Commercial Bank of China (Malaysia) Berhad</option>
											<option value="J.P. Morgan Chase Bank Berhad" >J.P. Morgan Chase Bank Berhad</option>
											<option value="Kuwait Finance House (Malaysia) Berhad" >Kuwait Finance House (Malaysia) Berhad</option>
											<option value="Malayan Banking Berhad (Maybank)" >Malayan Banking Berhad (Maybank)</option>
											<option value="MBSB Bank Berhad" >MBSB Bank Berhad</option>
											<option value="Mizuho Bank (Malaysia) Berhad" >Mizuho Bank (Malaysia) Berhad</option>
											<option value="MUFG Bank (Malaysia) Berhad" >MUFG Bank (Malaysia) Berhad</option>
											<option value="OCBC Bank (Malaysia) Berhad" >OCBC Bank (Malaysia) Berhad</option>
											<option value="Public Bank Berhad" >Public Bank Berhad</option>
											<option value="RHB Bank Berhad" >RHB Bank Berhad</option>
											<option value="Standard Chartered Bank Malaysia Berhad" >Standard Chartered Bank Malaysia Berhad</option>
											<option value="Sumitomo Mitsui Banking Corporation Malaysia Berhad" >Sumitomo Mitsui Banking Corporation Malaysia Berhad</option>
											<option value="The Bank of Nova Scotia Berhad" >The Bank of Nova Scotia Berhad</option>
											<option value="United Overseas Bank (Malaysia) Bhd." >United Overseas Bank (Malaysia) Bhd.</option>
										</select>
                                    </div>
                                    <div class="form-group">
										<label>No Akaun Bank</label>
										<input type="text" class="form-control" name="akaun_bank" required>
									</div>
									<div class="form-group">
										<label>Nama Pemilik Akaun</label>
										<input type="text" class="form-control" name="nama_akaun" required>
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