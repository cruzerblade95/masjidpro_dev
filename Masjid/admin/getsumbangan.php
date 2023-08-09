<?php
	include('../connection/connection.php');
	
	$id_pelanggan=$_GET['id_pelanggan'];
	
	$sql="SELECT * FROM sej6x_data_pelanggan WHERE id_pelanggan='$id_pelanggan'";
	$sqlquery=mysql_query($sql,$bd);
	
	$data=mysql_fetch_array($sqlquery);
	
	?>
	<div class="row">
		<div class="col-lg-12">
			<form method="post" id="insert_form" action="admin/add_sumbangan.php">
			<center>          
			<div class="row">
				<div class="col-lg-12">
					<center><h4><u>Maklumat Sumbangan</u></h4></center>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-12">
					<div class="form-group">
						<div class="col-lg-4">
							<label style="color: red">*</label><b>Nama</b>
						</div>
						<div class="col-lg-2">
							<b>:</b>
						</div>
						<div class="col-lg-6">
							<input class="form-control" name="nama_pelanggan" readonly value="<?php echo $data['nama_pelanggan']; ?>">
						<div class="col-lg-6">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<div class="col-lg-4">
							<label style="color: red">*</label><b>Maklumat Pembayaran</b>
						</div>
						<div class="col-lg-2">
							<b>:</b>
						</div>
						<div class="col-lg-6">
							<select class="form-control" name="jenis_kutipan" required>
								<option><option>
								<?php
								$sql1="SELECT * FROM sej6x_data_jeniskutipan WHERE id_masjid='$id_masjid'";
								$sqlquery1=mysql_query($sql1,$bd);
								
								while($data1=mysql_fetch_array($sqlquery1))
								{
								?>
								<option value="<?php echo $data1['id_kutipan']; ?>"><?php echo $data1['nama_kutipan']; ?></option>
								<?php
								}
								?>
							</select>
						<div class="col-lg-6">
					</div>
				</div>
			</div>
			</center>
			</form>
		</div>
	</div>
	<?php
?>