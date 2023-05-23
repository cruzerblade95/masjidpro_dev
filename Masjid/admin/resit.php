<?php

	include("connection/connection.php");

	$sql_resit="SELECT * FROM sej6x_data_resit WHERE id_masjid='$id_masjid'";
	$query_resit=mysql_query($sql_resit,$bd);
	$resit=mysql_num_rows($query_resit);
	
	$id_resit=$resit+1;
	$no_resit = str_pad($id_resit, 7, '0', STR_PAD_LEFT); 

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Resit Terimaan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=kewangan">Menu Kewangan</a></li>
					<li><a href="utama.php?view=admin&action=senarai_resit">Menu Resit</a></li>
					<li class="active">Resit Terimaan</li>
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
					Resit Terimaan
				</div>
				<div class="card-body">
					<form action="admin/add_resit.php" method="POST">
						<div class="row" align="center">
							<div class="col-lg-12">
								<h3><b><u>RESIT TERIMAAN</u></b></h3>
								<br>
								<?php echo $nama_masjid; ?>
							</div>
						</div>
						<br>
						<div class="row" align="right">
							<div class="col-lg-12">
								<table border="0">
									<tr>
										<td>NO RESIT</td><td>:</td><td><input type="text" name="no_resit" value="<?php echo $no_resit; ?>" style="width:150px" readonly></td>
									</tr>
									<tr>
										<td>TARIKH</td><td>:</td><td><input type="date" name="tarikh" style="width:150px" required></td>
									</tr>
								</table>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-lg-12">
								<table border="0" cellpadding="10" width="100%">
									<tr>
										<td width="20%"><b>TERIMA DARIPADA</b></td>
										<td width="2%">:</td>
										<td width="78%">
											<select id="terima" name="terima" class="form-control" width="100%" required>
												<option></option>
												<?php
												$sql1="SELECT * FROM sej6x_data_pelanggan WHERE id_masjid='$id_masjid'";
												$sqlquery1=mysql_query($sql1,$bd);
												
												while($data1=mysql_fetch_array($sqlquery1))
												{
												?>
												<option value="<?php echo $data1['id_pelanggan']; ?>"><?php echo $data1['nama_pelanggan']; ?></option>
												<?php
												}
												?>
											</select>
										</td>
									</tr>
									<!-- <tr>
										<td width="20%"><b>RINGGIT MALAYSIA</b></td><td>:</td><td><input type="text" name="ringgit" class="form-control" width="100%"></td>
									</tr> -->
									<tr>
										<td width="20%"><b>MAKLUMAT PEMBAYARAN</b></td>
										<td>:</td>
										<td>
											<select name="maklumat" class="form-control" width="100%" required>
												<option></option>
												<?php
												$sql2="SELECT * FROM sej6x_data_jeniskutipan WHERE id_masjid='$id_masjid'";
												$sqlquery2=mysql_query($sql2,$bd);
												
												while($data2=mysql_fetch_array($sqlquery2))
												{
												?>
												<option value="<?php echo $data2['id_kutipan']; ?>"><?php echo $data2['nama_kutipan']; ?></option>
												<?php
												}
												?>
											</select>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-lg-12" align="right">
								<table border="0" width="50%">
									<tr>
										<td>
											<div class="form-check">
												<div class="radio">
													<label for="tunai" class="form-check-label ">
														<input type="radio" id="tunai" name="cara_bayaran" value="tunai" class="form-check-input" onChange="jenisBayar(this.value)">Tunai
													</label>
												</div>
											</div>
										</td>
										<td>
											<div class="form-check">
												<div class="radio">
													<label for="cek" class="form-check-label ">
														<input type="radio" id="cek" name="cara_bayaran" value="cek" class="form-check-input" onChange="jenisBayar(this.value)">Cek
													</label>
												</div>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<div id="dis_tunai" style="display:none">
							<div class="col-lg-12" align="right">
								<table border="0" width="50%">
									<tr>
										<td width="50%">Tunai</td>
										<td width="2%">:</td>
										<td width="5%">RM</td>
										<td width="43%"><input type="number" name="amaun_tunai" style="width:100%"></td>
									</tr>
									<tr>
										<td width="50%">Tabung</td>
										<td width="2%">:</td>
										<td width="48%" colspan="2">
											<select name="tabung_tunai" class="form-control" style="width:100%">
												<option></option>
												<?php
												$sql3="SELECT * FROM sej6x_data_jenistabung WHERE id_masjid='$id_masjid'";
												$sqlquery3=mysql_query($sql3,$bd);
												
												while($data3=mysql_fetch_array($sqlquery3))
												{
												?>
												<option value="<?php echo $data3['id_tabung']; ?>"><?php echo $data3['nama_tabung']; ?></option>
												<?php
												}
												?>
											</select>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<div  id="dis_cek" style="display:none">
							<div class="col-lg-12" align="right">
								<table border="0" width="50%">
									<tr>
										<td width="50%">Cek</td>
										<td width="2%">:</td>
										<td width="5%">RM</td>
										<td width="43%"><input type="number" name="amaun_cek" style="width:100%"></td>
									</tr>
									<tr>
										<td width="50%">No Cek</td>
										<td width="2%">:</td>
										<td width="48%" colspan="2"><input type="text" name="no_cek" style="width:100%"></td>
									</tr>
									<tr>
										<td width="50%">Tabung</td>
										<td width="2%">:</td>
										<td width="48%" colspan="2">
											<select name="tabung_cek" class="form-control" style="width:100%">
												<option></option>
												<?php
												$sql3="SELECT * FROM sej6x_data_jenistabung WHERE id_masjid='$id_masjid'";
												$sqlquery3=mysql_query($sql3,$bd);
												
												while($data3=mysql_fetch_array($sqlquery3))
												{
												?>
												<option value="<?php echo $data3['id_tabung']; ?>"><?php echo $data3['nama_tabung']; ?></option>
												<?php
												}
												?>
											</select>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<br>
						<div class="row">
						<div class="col-lg-12" align="right">
							<br>
							<br>
							<br>
							<?php
							$sql="SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_ajk=b.id_data AND a.jawatan='Bendahari'";
							$sqlquery=mysql_query($sql,$bd);
							$data=mysql_fetch_array($sqlquery);
							?>
							<table border="0">
								<tr>
									<td>..............................................................</td>
								</tr>
								<tr>
									<td><?php echo $data['jawatan']; ?></td>
								</tr>
								<tr>
									<td><?php echo $data['nama_penuh']; ?></td>
								</tr>
							</table>
						</div>
					</div>
					<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
					<br>
					<br>
					<center>
						<input type="submit" class="btn btn-success" name="submit" value="Submit">
					</center>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="test">
</div>
<script>
function jenisBayar(src) {
	var tunai = 'tunai';
	var cek = 'cek';
	
	if(src==tunai)
	{
		document.getElementById('dis_tunai').style.display = 'block';
		document.getElementById('dis_cek').style.display = 'none';
	}
	else if(src==cek)
	{
		document.getElementById('dis_tunai').style.display = 'none';
		document.getElementById('dis_cek').style.display = 'block';	
	}
}
$(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>