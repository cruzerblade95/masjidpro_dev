<?php 

include("connection/connection.php");

if(isset($_POST['form_ic']))
{
	$id_masjid = $_POST['id_masjid'];
	$kariah_masjid = $_POST['kariah_masjid'];
	$idd = $_POST['id_data'];
	$no_ic = $_POST['no_ic'];
	$jenis_bantuan = $_POST['jenis_bantuan'];
	$tarikh_bantuan = $_POST['tarikh_bantuan'];
	$kaedah_bayar = $_POST['kaedah_bayar'];
	$amaun_bantuan = $_POST['amaun_bantuan'];
	
	$sqlcheck = "SELECT * FROM bantuan_zakat WHERE no_ic='$no_ic' AND tarikh_bantuan='$tarikh_bantuan'";
	$querycheck = mysqli_query($bd2,$sqlcheck);
	$bilcheck = mysqli_num_rows($querycheck);
	if($bilcheck==0)
	{
		if(strpos($idd, 'A-') !== true) $sql = "INSERT INTO bantuan_zakat (id_masjid,kariah_masjid,id_data,no_ic,jenis_bantuan,tarikh_bantuan,tarikh_ambil,kaedah_bayar,amaun,status_bantuan,status_ambil) VALUES ('$id_masjid','$kariah_masjid','$idd','$no_ic','$jenis_bantuan','$tarikh_bantuan','$tarikh_bantuan','$kaedah_bayar','$amaun_bantuan','1','1')";
		if(strpos($idd, 'A-') !== false) {
			$idd = str_replace('A-', '', $_POST['id_data']);
			$sql = "INSERT INTO bantuan_zakat (id_masjid,ID,no_ic,jenis_bantuan,tarikh_bantuan,tarikh_ambil,kaedah_bayar,amaun,status_bantuan,status_ambil) VALUES ('$id_masjid','$idd','$no_ic','$jenis_bantuan','$tarikh_bantuan','$tarikh_bantuan','$kaedah_bayar','$amaun_bantuan','1','1')";
		}
		$query = mysqli_query($bd2,$sql);
		
		if($query)
		{
			//header("Location: ../utama.php?view=admin&action=bantuan&no_ic=".$no_ic);
		}
	}
	else if($bilcheck>0)
	{
		?>
			<script LANGUAGE='JavaScript'>
				window.alert('Maaf, Terdapat Bantuan Pada Tarikh Yang Sama');
				//window.location.href='https://www.masjidpro.com/Masjid/SPMD/Bantuan/bantuan_app.php?no_ic=<?php echo $no_ic; ?>';
			</script>
		<?php
	}
}
if(isset($_POST['form_passport']))
{
	$id_masjid = $_POST['id_masjid'];
	$nama_penuh = $_POST['nama_penuh'];
	$no_passport = $_POST['no_passport'];
	$no_tel = $_POST['no_tel'];
	$status_perkahwinan = $_POST['status_perkahwinan'];
	$alamat_terkini = $_POST['alamat_terkini'];
	$id_negeri = $_POST['id_negeri'];
	$id_daerah = $_POST['id_daerah'];
	$poskod = $_POST['poskod'];
	$jumlah_tanggungan = $_POST['jumlah_tanggungan'];
	$jenis_bantuan = $_POST['jenis_bantuan'];
	$tarikh_bantuan = $_POST['tarikh_bantuan'];
	$kaedah_bayar = $_POST['kaedah_bayar'];
	$amaun_bantuan = $_POST['amaun_bantuan'];

	$sqlcheck = "SELECT * FROM bantuan_zakat WHERE no_passport='$no_passport' AND tarikh_bantuan='$tarikh_bantuan'";
	$querycheck = mysqli_query($bd2,$sqlcheck);
	$bilcheck = mysqli_num_rows($querycheck);
	if($bilcheck==0)
	{
		$sql = "INSERT INTO bantuan_zakat (id_masjid,no_passport,nama_penuh,no_tel,status_perkahwinan,alamat_terkini,id_negeri,id_daerah,poskod,jumlah_tanggungan,jenis_bantuan,tarikh_bantuan,tarikh_ambil,kaedah_bayar,amaun,status_bantuan,status_ambil) VALUES ('$id_masjid','$no_passport','$nama_penuh','$no_tel','$status_perkahwinan','$alamat_terkini','$id_negeri','$id_daerah','$poskod','$jumlah_tanggungan','$jenis_bantuan','$tarikh_bantuan','$tarikh_bantuan','$kaedah_bayar','$amaun_bantuan','1','1')";
		$query = mysqli_query($bd2,$sql);
		
		if($query)
		{
			//header("Location: ../utama.php?view=admin&action=bantuan&no_passport=".$no_passport);
		}
	}
	else if($bilcheck>0)
	{
		?>
			<script LANGUAGE='JavaScript'>
				window.alert('Maaf, Terdapat Bantuan Pada Tarikh Yang Sama');
				//window.location.href='https://www.masjidpro.com/Masjid/SPMD/Bantuan/bantuan_app.php?no_ic=<?php echo $no_ic; ?>';
			</script>
		<?php
	}
}
if(isset($_POST['button_bukan']))
{
	$masjid_kariah = $_POST['masjid_kariah'];
	$id_masjid = $_POST['id_masjid'];
	$nama_penuh = $_POST['nama_penuh'];
	$no_ic = $_POST['no_ic'];
	$no_tel = $_POST['no_tel'];
	$status_perkahwinan = $_POST['status_perkahwinan'];
	$alamat_terkini = $_POST['alamat_terkini'];
	$id_negeri = $_POST['id_negeri'];
	$id_daerah = $_POST['id_daerah'];
	$poskod = $_POST['poskod'];
	$jumlah_tanggungan = $_POST['jumlah_tanggungan'];
	$jenis_bantuan = $_POST['jenis_bantuan'];
	$tarikh_bantuan = $_POST['tarikh_bantuan'];
	$kaedah_bayar = $_POST['kaedah_bayar'];
	$amaun_bantuan = $_POST['amaun_bantuan'];
	
	$sqlcheck = "SELECT * FROM bantuan_zakat WHERE no_ic='$no_ic' AND tarikh_bantuan='$tarikh_bantuan'";
	$querycheck = mysqli_query($bd2,$sqlcheck);
	$bilcheck = mysqli_num_rows($querycheck);
	if($bilcheck==0)
	{
		$sql = "INSERT INTO bantuan_zakat (id_masjid,no_ic,kariah_masjid,nama_penuh,no_tel,status_perkahwinan,alamat_terkini,id_negeri,id_daerah,poskod,jumlah_tanggungan,jenis_bantuan,tarikh_bantuan,tarikh_ambil,kaedah_bayar,amaun,status_bantuan,status_ambil) VALUES ('$id_masjid','$no_ic','$masjid_kariah','$nama_penuh','$no_tel','$status_perkahwinan','$alamat_terkini','$id_negeri','$id_daerah','$poskod','$jumlah_tanggungan','$jenis_bantuan','$tarikh_bantuan','$tarikh_bantuan','$kaedah_bayar','$amaun_bantuan','1','1')";
		$query = mysqli_query($bd2,$sql);

		if($query)
		{
			//echo "DATA MASUK";
		}
	}
	else if($bilcheck>0)
	{
		?>
			<script LANGUAGE='JavaScript'>
				window.alert('Maaf, Terdapat Bantuan Pada Tarikh Yang Sama');
				//window.location.href='https://www.masjidpro.com/Masjid/SPMD/Bantuan/bantuan_app.php?no_ic=<?php echo $no_ic; ?>';
			</script>
		<?php
	}
}
if(isset($_POST['del_button']))
{
	if(isset($_POST['no_ic']))
	{	
		$id_bantuan	= $_POST['id_bantuan'];
		//$no_ic = $_POST['no_ic'];

		$delquery="DELETE FROM bantuan_zakat WHERE id_bantuan='$id_bantuan'";
		$delsqlquery = mysqli_query($bd2,$delquery);
		
		if($delsqlquery){
			//header("Location:../utama.php?view=admin&action=bantuan&no_ic=".$no_ic);
		}
	}
	if(isset($_POST['no_passport']))
	{	
		$id_bantuan = $_POST['id_bantuan'];
		//$no_passport = $_POST['no_passport'];

		$delquery="DELETE FROM bantuan_zakat WHERE id_bantuan='$id_bantuan'";
		$delsqlquery = mysqli_query($bd2,$delquery);
		
		if($delsqlquery){
			//header("Location:../utama.php?view=admin&action=bantuan&no_passport=".$no_passport);
		}
	}
}
if(isset($_POST['edit_ic']) OR isset($_POST['edit_passport']) OR isset($_POST['edit_bukan']))
{
	$id_bantuan_zakat = $_POST['id_bantuan'];
	$jenis_bantuan = $_POST['jenis_bantuan'];
	$tarikh_bantuan = $_POST['tarikh_bantuan'];
	$kaedah_bayar = $_POST['kaedah_bayar'];
	$amaun_item = $_POST['amaun_bantuan'];
	
	$sql_edit = "UPDATE bantuan_zakat SET jenis_bantuan='$jenis_bantuan', tarikh_bantuan='$tarikh_bantuan', kaedah_bayar='$kaedah_bayar', amaun='$amaun_item' WHERE id_bantuan='$id_bantuan_zakat'";
	$query_edit = mysqli_query($bd2,$sql_edit);
}
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Daftar Bantuan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li class="active">Daftar Bantuan</li>
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
					Carian Maklumat
				</div>
				<div class="card-body">
					<?php
					if(isset($_POST['no_ic']) OR isset($_POST['no_passport']) OR isset($_GET['no_ic']) OR isset($_GET['no_passport'])) { 
						if(isset($_POST['no_ic']) OR isset($_GET['no_ic'])) { 
							if(isset($_POST['no_ic']))
							{
								$no_ic = $_POST['no_ic'];
							}
							else if(isset($_GET['no_ic']))
							{
								$no_ic = $_GET['no_ic'];
							}
							$warganegara = $_POST['warganegara'];
							$sql_ic = "SELECT id_data, id_masjid, nama_penuh, no_ic, no_hp, status_perkahwinan, umur, alamat_terkini, id_negeri, id_daerah, poskod FROM sej6x_data_peribadi WHERE no_ic LIKE '$no_ic'
										UNION
										SELECT CONCAT('A-', ID) 'id_data', id_masjid, nama_penuh, no_ic, no_tel 'no_hp', status_kahwin 'status_perkahwinan', umur, NULL 'alamat_terkini', NULL 'id_negeri', NULL 'id_daerah', NULL 'poskod' FROM sej6x_data_anakqariah WHERE no_ic LIKE '$no_ic'";
							$query_ic = mysqli_query($bd2,$sql_ic);
							$data_ic = mysqli_fetch_array($query_ic);
							$row_ic = mysqli_num_rows($query_ic);
							$detect_id = $data_ic['id_data'];
							if(strpos($detect_id, 'A-') !== false) {
							?>
							<div class="row">
								<div class="alert alert-danger col-12" role="alert">
									<center>
									Permohonan Hanya Untuk Ketua Keluarga Sahaja
									</center>
								</div>
							</div>
							<?php
							}
						}
					}
					?>
					<div class="col-4 form-group">
						<div class="form-group">
							<h5>Kewarganegaraan<span class="text-danger">*</span></h5>
							<fieldset class="controls">
								<div class="custom-control custom-radio">
									<input type="radio" value="1" name="pilih_warganegara" required="" id="styled_radio1" class="custom-control-input" onClick="showWarganegara(this.value)">
									<label class="custom-control-label" for="styled_radio1">Warganegara</label>
								</div>
							<div class="help-block"></div></fieldset>
							<fieldset>
								<div class="custom-control custom-radio">
									<input type="radio" value="2" name="pilih_warganegara" id="styled_radio2" class="custom-control-input" onClick="showWarganegara(this.value)">
									<label class="custom-control-label" for="styled_radio2">Bukan Warganegara</label>
								</div>
							</fieldset>
						</div>
					</div>
					<form action="" method="POST">
						<div id="div_warganegara">
						</div>
						<div class="col-12 col-md-12 form-group" align="left">
							<button type="submit" id="carian" name="carian" class="btn btn-success" style="display:none">Carian</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php 
	if(isset($_POST['carian']) OR isset($_POST['no_ic']) OR isset($_POST['no_passport'])  OR isset($_GET['no_ic']) OR isset($_GET['no_passport'])) { 
	
	if(isset($_POST['no_ic']) OR isset($_GET['no_ic'])) { 
		if(isset($_POST['no_ic']))
		{
			$no_ic = $_POST['no_ic'];
		}
		else if(isset($_GET['no_ic']))
		{
			$no_ic = $_GET['no_ic'];
		}
		$warganegara = $_POST['warganegara'];
		$sql_ic = "SELECT id_data, id_masjid, nama_penuh, no_ic, no_hp, status_perkahwinan, umur, alamat_terkini, id_negeri, id_daerah, poskod FROM sej6x_data_peribadi WHERE no_ic LIKE '$no_ic'
					UNION
					SELECT CONCAT('A-', ID) 'id_data', id_masjid, nama_penuh, no_ic, no_tel 'no_hp', status_kahwin 'status_perkahwinan', umur, NULL 'alamat_terkini', NULL 'id_negeri', NULL 'id_daerah', NULL 'poskod' FROM sej6x_data_anakqariah WHERE no_ic LIKE '$no_ic'";
		$query_ic = mysqli_query($bd2,$sql_ic);
		$data_ic = mysqli_fetch_array($query_ic);
		$row_ic = mysqli_num_rows($query_ic);
		
		$check_data = "SELECT * FROM bantuan_zakat WHERE no_ic='$no_ic'";
		$query_check = mysqli_query($bd2,$check_data);
		$bil_data = mysqli_num_rows($query_check);
		$data_check = mysqli_fetch_array($query_check);
		
		if($row_ic>0)
		{
		$ic = $data_ic['no_ic'];
		}
		else if($bil_data>0)
		{
		$ic = $data_check['no_ic'];	
		}
		$kariah_masjid = $data_ic['id_masjid']; 
	}
	if(isset($_POST['no_passport']) OR isset($_GET['no_passport']))
	{
		if(isset($_POST['no_passport']))
		{
			$no_passport = $_POST['no_passport'];
		}
		else if(isset($_GET['no_passport']))
		{
			$no_passport = $_GET['no_passport'];
		}
	}
	if(isset($_POST['no_ic']) OR isset($_POST['no_passport']) OR isset($_GET['no_ic']) OR isset($_GET['no_passport'])) { 
	if(strpos($detect_id, 'A-') !== false) {
	}
	else{
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
				Maklumat Bantuan&nbsp;|&nbsp;
				<button class="btn btn-primary" <?php if(isset($_POST['no_ic']) OR isset($_GET['no_ic'])) { if($row_ic==0) { ?>style="display:none"<?php  } } ?>data-toggle="modal" data-target="#modalForm">Permohonan Baru</button>
				<?php 
				if(isset($_POST['no_ic']) OR isset($_GET['no_ic'])) 
				{ 
					if($row_ic==0) 
					{ 
					?>
					<a href="utama.php?view=admin&action=pendaftaran" target="_blank" class="btn btn-success">Daftar Ahli Kariah</a>
					&nbsp;
					<?php 
					
						if($row_ic==0 AND $bil_data>0) 
						{ 
						?>
						<button class="btn btn-primary" data-toggle="modal" data-target="#bukanForm">Permohonan Baru</button>
						<?php 
						}
						else if($row_ic==0 AND $bil_data==0)
						{ 
						?>
						<button class="btn btn-primary" data-toggle="modal" data-target="#bukanForm">Permohonan Bantuan Bukan Ahli Kariah</button>
						<?php 
						} 
					} 
				} 
				?>
				</div>
				<div class="card-body">
					<div class="col-12">
						<?php
							
						if(isset($_POST['no_ic']) OR isset($_GET['no_ic']))
						{
							$search_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$kariah_masjid'";
							$query_masjid = mysqli_query($bd2,$search_masjid);
							$data_masjid = mysqli_fetch_array($query_masjid);
							
							$nama_masjid = $data_masjid['nama_masjid']; 
							if($row_ic>0)
							{
								if($kariah_masjid==$id_masjid)
								{
							?>
							<div class="row">
								<div class="alert alert-success col-8 offset-2" role="alert">
									<center>
									Maklumat telah berdaftar di <?php echo ucwords(strtolower($nama_masjid)); ?>
									</center>
								</div>
							</div>
							<?php
								}
								else if($kariah_masjid!=$id_masjid)
								{
							?>
							<div class="row">
								<div class="alert alert-warning col-8 offset-2" role="alert">
									<center>
									Maklumat telah berdaftar di <?php echo ucwords(strtolower($nama_masjid)); ?>
									</center>
								</div>
							</div>
							<?php
								}
							}
							else if($row_ic==0)
							{
							?>
							<div class="row">
								<div class="alert alert-danger col-8 offset-2" role="alert">
									<center>
									Maklumat belum bedaftar dengan MasjidPro
									</center>
								</div>
							</div>
							<?php
								if($bil_data>0)
								{
									$idkariah_masjid = $data_check['kariah_masjid'];
									$sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$idkariah_masjid'";
									$query_masjid = mysqli_query($bd2,$sql_masjid);
									$data_masjid = mysqli_fetch_array($query_masjid);
							?>
								<div class="row">
								<div class="alert alert-info col-8 offset-2" role="alert">
									<center>
									Nama&nbsp;:&nbsp;<?php echo $data_check['nama_penuh']; ?><br>
									No Kad Pengenalan&nbsp;:&nbsp;<?php echo $data_check['no_ic']; ?><br>
									No Telefon&nbsp;:&nbsp;<?php echo $data_check['no_tel']; ?><br>
									Kariah&nbsp;:&nbsp;<?php echo $data_masjid['nama_masjid']; ?>
									</center>
								</div>
							</div>
							<?php
								}
							}
							?>
							<?php 
							if($row_ic>0)
							{
							?>
							<div class="row">
								<div class="alert alert-info col-8 offset-2" role="alert">
									<center>
									Kariah&nbsp;:&nbsp;<?php echo $nama_masjid; ?><br>
									Nama&nbsp;:&nbsp;<?php echo $data_ic['nama_penuh']; ?><br>
									No K/P&nbsp;:&nbsp;<?php echo $data_ic['no_ic']; ?><br>
									No Telefon&nbsp;:&nbsp;<?php echo $data_ic['no_hp']; ?>
									</center>
								</div>
							</div>
							<?php
							}
						}
						if(isset($_POST['no_passport']) OR isset($_GET['no_passport']))
						{
							$sql4 = "SELECT * FROM bantuan_zakat WHERE no_passport='$no_passport'";
							$sqlquery4 = mysqli_query($bd2,$sql4);
							$row4 = mysqli_num_rows($sqlquery4);
							$data4 = mysqli_fetch_array($sqlquery4);
							if($row4 == 0){
							?>
							<div class="row">
								<div class="alert alert-danger col-8 offset-2" role="alert">
									<center>
									Belum mempunyai seberang rekod bantuan
									</center>
								</div>
							</div>
							<?php
							}
							else if($row4>0)
							{
							?>
							<div class="row">
								<div class="alert alert-info col-8 offset-2" role="alert">
									<center>
									Nama&nbsp;:&nbsp;<?php echo $data4['nama_penuh']; ?><br>
									No Passport&nbsp;:&nbsp;<?php echo $data4['no_passport']; ?><br>
									No Telefon&nbsp;:&nbsp;<?php echo $data4['no_tel']; ?>
									</center>
								</div>
							</div>
							<?php
							}
						}
						?>
						<?php
						$j = 1;
						
						if(isset($_POST['no_ic']) OR isset($_GET['no_ic']))
						{
							//$sql1 = "SELECT * FROM bantuan_zakat WHERE no_ic='$ic' AND (status=1 OR status=0) ORDER BY id_bantuan_zakat DESC";
							$sql1 = "SELECT * FROM bantuan_zakat WHERE no_ic='$ic' ORDER BY id_bantuan DESC";
						}
						if(isset($_POST['no_passport']) OR isset($_GET['no_passport']))
						{
							//$sql1 = "SELECT * FROM bantuan_zakat WHERE no_passport='$no_passport' AND (status=1 OR status=0) ORDER BY id_bantuan_zakat DESC";
							$sql1 = "SELECT * FROM bantuan_zakat WHERE no_passport='$no_passport' ORDER BY id_bantuan DESC";
						}
						$sqlquery1 = mysqli_query($bd2,$sql1);
						$row1 = mysqli_num_rows($sqlquery1);
							
						?>
						<div class="table-responsive">
							<table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<td align="center">Bil</td>
										<td align="center">Jenis Bantuan</td>
										<td align="center">Tarikh<br>Bantuan/Mohon</td>
										<td align="center">Status</td>
										<td align="center">Kaedah Pembayaran</td>
										<td align="center">Amaun/Item</td>
										<td align="center">Masjid</td>
										<td align="center">Kemaskini</td>
										<td align="center">Padam</td>
									</tr>
								</thead>
								<tbody>
								<?php 
								if($row1==0)
								{
								?>
									<tr>
										<td align="center" colspan="9">*Tiada Rekod Bantuan*</td>
									</tr>
								<?php
								}
								else if($row1>0)
								{
									while($data1 = mysqli_fetch_array($sqlquery1))
									{
										$status_bantuan = $data1['status_bantuan'];
								?>
									<tr>
										<td align="center"><?php echo $j; ?></td>
										<td align="center"><?php echo $data1['jenis_bantuan']; ?></td>
										<td align="center">
										<?php 
										if($status_bantuan==1)
										{
										?>
											<?php echo fungsi_tarikh($data1['tarikh_bantuan'],11,2); ?>
										<?php
										}
										else if($status_bantuan==0)
										{
										?>
											<?php echo fungsi_tarikh($data1['tarikh_mohon'],11,2); ?>
										<?php
										}
										else if($status_bantuan==2)
										{
										?>
											<?php echo fungsi_tarikh($data1['tarikh_mohon'],11,2); ?>
										<?php
										}
										?>
										</td>
										<td align="center">
										<?php 
										if($status_bantuan==0)
										{
										?>
											<div class="alert alert-warning col-12" role="alert">
												Permohonan Sedang Diproses
											</div>
										<?php
										}
										else if($status_bantuan==1)
										{
										?>
											<div class="alert alert-success col-12" role="alert">
												Bantuan Lulus
											</div>
										<?php
										}
										else if($status_bantuan==2){
										?>
											<div class="alert alert-danger col-12" role="alert">
												Bantuan Ditolak
											</div>
										<?php	
										}
										?>
										</td>
										<td align="center"><?php echo $data1['kaedah_bayar']; ?></td>
										<td align="center"><?php echo $data1['amaun']; ?></td>
										<td align="center">
										<?php
										$bantuan_masjid = $data1['id_masjid'];
										
										$sql3 = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$bantuan_masjid'";
										$sqlquery3 = mysqli_query($bd2,$sql3);
										$data3 = mysqli_fetch_array($sqlquery3);
										
										echo $data3['nama_masjid'];
										?>
										</td>
										<td align="center">
										<?php 
										if($bantuan_masjid == $id_masjid)
										{
										?>
										<?php if($status_bantuan==1){ ?><button class="btn btn-success" data-toggle="modal" data-target="#FormEdit" value="<?php echo $data1['id_bantuan']; ?>" onClick="editForm(this.value)"><i class="fa fa-edit"></i></button><?php } ?>
										</td>
										<td align="center">
										<?php
											if(isset($_POST['no_ic']) OR isset($_GET['no_ic']))
											{
												if($status_bantuan!=0){
										?>
										<form action="" method="POST" onSubmit="return confirm('Padam Bantuan')">
											<input type="hidden" name="id_bantuan" value="<?php echo $data1['id_bantuan']; ?>">
											<input type="hidden" name="no_ic" value="<?php echo $data1['no_ic']; ?>">
											<button type="submit" name="del_button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
										</form>
										<!-- <a href="admin/del_bantuan.php?id_bantuan=<?php //echo $data1['id_bantuan_zakat']; ?>&no_ic=<?php //echo $data1['no_ic']; ?>" class="btn btn-danger" onclick="return confirm('Padam Bantuan?')"><i class="fa fa-trash"></i></a> -->
										<?php
												}
											}
											else if(isset($_POST['no_passport']) OR isset($_GET['no_passport']))
											{
												if($status_bantuan!=0){
										?>
										<form action="" method="POST" onSubmit="return confirm('Padam Bantuan')">
											<input type="hidden" name="id_bantuan" value="<?php echo $data1['id_bantuan']; ?>">
											<input type="hidden" name="no_passport" value="<?php echo $data1['no_passport']; ?>">
											<button type="submit" name="del_button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
										</form>
										<!-- <a href="admin/del_bantuan.php?id_bantuan=<?php //echo $data1['id_bantuan_zakat']; ?>&no_passport=<?php //echo $data1['no_passport']; ?>" class="btn btn-danger" onclick="return confirm('Padam Bantuan?')"><i class="fa fa-trash"></i></a> -->
										<?php 
												}
											}
										}
										?>
										</td>
									</tr>
								<?php
									$j++;
									}
								}
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<?php } } } ?>
</div>
<div class="modal long-modal" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="longmodal">Maklumat Bantuan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body" id="display_form">
				<?php
				if(isset($_POST['no_ic']) OR isset($_GET['no_ic']))
				{
					if($row_ic>0)
					{
						$status_perkahwinan = $data_ic['status_perkahwinan'];
				?>
				<form action="" class="form-horizontal form-bordered" method="POST">
					<div class="form-body">
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Nama Penuh</label>
							<div class="col-md-9">
								<input type="text" name="nama_penuh" class="form-control" value="<?php echo $data_ic['nama_penuh']; ?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">No Kad Pengenalan</label>
							<div class="col-md-9">
								<input type="text" name="no_ic" class="form-control" value="<?php echo $data_ic['no_ic']; ?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">No Telefon</label>
							<div class="col-md-9">
								<input type="text" name="no_hp" class="form-control" value="<?php echo $data_ic['no_hp']; ?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Status Perkahwinan</label>
							<div class="col-md-9">
								<select name="status_perkahwinan" class="form-control" readonly>
									<?php if($data_ic['status_perkahwinan'] == 1) { ?><option value="1">Bujang</option><? } ?>
									<?php if($data_ic['status_perkahwinan'] == 2) { ?><option value="2">Berkahwin</option><? } ?>
									<?php if($data_ic['status_perkahwinan'] == 3) { ?><option value="3">Duda</option><? } ?>
									<?php if($data_ic['status_perkahwinan'] == 4) { ?><option value="4">Janda</option><? } ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Alamat</label>
							<div class="col-md-9">
								<textarea name="alamat_terkini" class="form-control" readonly><?php echo $data_ic['alamat_terkini']; ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Negeri</label>
							<div class="col-md-9">
								<select name="id_negeri" class="form-control" readonly>
									<?php 
									$negeri = $data_ic['id_negeri'];
									$sql_negeri = "SELECT * FROM negeri";
									$query_negeri = mysqli_query($bd2,$sql_negeri);
									
									while($data_negeri = mysqli_fetch_array($query_negeri))
									{
									?>
									<?php if($data_ic['id_negeri']==$data_negeri['id_negeri']) { ?><option value="<?php echo $data_negeri['id_negeri']; ?>"><?php echo $data_negeri['name']; ?></option><?php } ?>
									<? 
									} 
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Daerah</label>
							<div class="col-md-9">
								<select name="id_daerah" class="form-control" readonly>
									<?php 
									$negeri = $data_ic['id_negeri'];
									$sql_daerah = "SELECT * FROM daerah WHERE id_negeri='$negeri'";
									$query_daerah = mysqli_query($bd2,$sql_daerah);
									echo mysqli_num_rows($query_daerah);
									
									while($data_daerah = mysqli_fetch_array($query_daerah))
									{
									?>
									<?php if($data_ic['id_daerah']==$data_daerah['id_daerah']) { ?><option value="<?php echo $data_daerah['id_daerah']; ?>"><?php echo $data_daerah['nama_daerah']; ?></option><?php } ?>
									<? 
									} 
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Poskod</label>
							<div class="col-md-9">
								<input type="text" name="poskod" class="form-control" readonly value="<?php echo $data_ic['poskod']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Jumlah Tanggungan</label>
							<div class="col-md-9">
								<?php
								$id_qariah = $data_ic['id_data'];
								$sql_tanggung = "SELECT * FROM sej6x_data_anakqariah WHERE id_qariah='$id_qariah'";
								$query_tanggung = mysqli_query($bd2,$sql_tanggung);
								$bil_tanggung = mysqli_num_rows($query_tanggung);
								?>
								<input type="number" step="1" name="jumlah_tanggungan" class="form-control" readonly value="<?php echo $bil_tanggung; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Jenis Bantuan</label>
							<div class="col-md-9">
								<input type="text" name="jenis_bantuan" class="form-control" required oninput="this.value = this.value.toUpperCase()">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Tarikh Bantuan</label>
							<div class="col-md-9">
								<input type="date" name="tarikh_bantuan" class="form-control" required oninput="this.value = this.value.toUpperCase()">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Kaedah Bayaran</label>
							<div class="col-md-9">
								<input type="text" name="kaedah_bayar" class="form-control" required oninput="this.value = this.value.toUpperCase()">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Amaun/Item</label>
							<div class="col-md-9">
								<input type="number" name="amaun_bantuan" class="form-control" required oninput="this.value = this.value.toUpperCase()" step="1">
							</div>
						</div>
						<input type="hidden" name="id_data" value="<?php echo $data_ic['id_data']; ?>">
						<input type="hidden" name="kariah_masjid" value="<?php echo $data_ic['id_masjid']; ?>">
						<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
						<div class="form-group row">
							<div class="col-md-4 offset-4">
								<center>
								<button type="submit" name="form_ic" class="btn btn-success">Simpan Maklumat</button>
								</center>
							</div>
						</div>
					</div>
				</form>
				<?php
					}
				}
				else if(isset($_POST['no_passport']) OR isset($_GET['no_passport']))
				{
				?>
				<form action="" class="form-horizontal form-bordered" method="POST">
					<div class="form-body">
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Nama Penuh</label>
							<div class="col-md-9">
								<input type="text" name="nama_penuh" class="form-control" oninput="this.value = this.value.toUpperCase()" value="<?php echo $data4['nama_penuh']; ?>" <?php if($row4==0) { ?>required<?php }else if($row4>0) { ?>readonly<?php } ?>>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">No Passport</label>
							<div class="col-md-9">
								<input type="text" name="no_passport" class="form-control" oninput="this.value = this.value.toUpperCase()" value="<?php echo $no_passport; ?>" <?php if($row4==0) { ?>readonly<?php }else if($row4>0) { ?>readonly<?php } ?>>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">No Telefon</label>
							<div class="col-md-9">
								<input type="text" name="no_tel" class="form-control" value="<?php echo $data4['no_tel']; ?>" <?php if($row4==0) { ?>required<?php }else if($row4>0) { ?>readonly<?php } ?>>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Status Perkahwinan</label>
							<div class="col-md-9">
								<select name="status_perkahwinan" class="form-control" <?php if($row4==0) { ?>required<?php }else if($row4>0) { ?>readonly<?php } ?>>
								<?php if($row4==0) { ?>
									<option value="">Sila Pilh:-</option>
									<option value="1" <?php if($data4['status_perkahwinan'] == 1) { ?>selected="selected"<? } ?>>BUJANG</option>
									<option value="2" <?php if($data4['status_perkahwinan'] == 2) { ?>selected="selected"<? } ?>>BERKAHWIN</option>
									<option value="3" <?php if($data4['status_perkahwinan'] == 3) { ?>selected="selected"<? } ?>>DUDA</option>
									<option value="4" <?php if($data4['status_perkahwinan'] == 4) { ?>selected="selected"<? } ?>>JANDA</option>
								<?php }
								else if($row4>0) { ?>
									<?php if($data4['status_perkahwinan'] == 1) { ?><option value="1" selected="selected">Bujang</option><? } ?>
									<?php if($data4['status_perkahwinan'] == 2) { ?><option value="2" selected="selected">Berkahwin</option><? } ?>
									<?php if($data4['status_perkahwinan'] == 3) { ?><option value="3" selected="selected">Duda</option><? } ?>
									<?php if($data4['status_perkahwinan'] == 4) { ?><option value="4" selected="selected">Janda</option><? } ?>
								<?php } ?>	
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Alamat</label>
							<div class="col-md-9">
								<textarea name="alamat_terkini" class="form-control" oninput="this.value = this.value.toUpperCase()" <?php if($row4==0) { ?>required<?php }else if($row4>0) { ?>readonly<?php } ?>><?php echo $data4['alamat_terkini']; ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Negeri</label>
							<div class="col-md-9">
								<select name="id_negeri" class="form-control" <?php if($row4==0) { ?>required onClick="showDaerah(this.value)" <?php }else if($row4>0) { ?>readonly<?php } ?>>
								<?php 
								$negeri = $data4['id_negeri'];
								$sql_negeri = "SELECT * FROM negeri";
								$query_negeri = mysqli_query($bd2,$sql_negeri);
								
								if($row4==0) { ?>
									<option value="">Sila Pilh:-</option>
									<?php 
									while($data_negeri = mysqli_fetch_array($query_negeri))
									{
									?>
									<option value="<?php echo $data_negeri['id_negeri']; ?>" <?php if($data4['id_negeri']==$data_negeri['id_negeri']) { ?>selected="selected"<?php } ?>><?php echo $data_negeri['name']; ?></option>
									<? 
									} 
								}
								else if($row4>0){
									while($data_negeri = mysqli_fetch_array($query_negeri)){
								?>
									<?php if($data4['id_negeri']==$data_negeri['id_negeri']) { ?><option value="<?php echo $data_negeri['id_negeri']; ?>" selected="selected"><?php echo $data_negeri['name']; ?></option><?php } ?>
								<?php
									}
								}
								?>
								</select>
							</div>
						</div>
						<div class="form-group row" id="div_daerah">
							<?php
							if($data4['id_daerah']!=""){
							?>
							<label class="control-label text-right col-md-3">Daerah</label>
							<div class="col-md-9">
								<select name="id_daerah" class="form-control" <?php if($row4==0) { ?>required<?php }else if($row4>0) { ?>readonly<?php } ?>>
								<?php 
								$negeri = $data4['id_negeri'];
								$sql_daerah = "SELECT * FROM daerah WHERE id_negeri='$negeri'";
								$query_daerah = mysqli_query($bd2,$sql_daerah);
								
								if($row4==0) { ?>	
									<option value="">Sila Pilh:-</option>
									<?php 
									while($data_daerah = mysqli_fetch_array($query_daerah))
									{
									?>
									<option value="<?php echo $data_daerah['id_daerah']; ?>" <?php if($data4['id_daerah']==$data_daerah['id_daerah']) { ?>selected="selected"<?php } ?>><?php echo $data_daerah['nama_daerah']; ?></option>
									<? 
									} 
								}
								else if($row4>0){
									while($data_daerah = mysqli_fetch_array($query_daerah)){
								?>
									<?php if($data4['id_daerah']==$data_daerah['id_daerah']) { ?><option value="<?php echo $data_daerah['id_daerah']; ?>" selected="selected"><?php echo $data_daerah['nama_daerah']; ?></option><?php } ?>
								<?php
									}
								}
								?>
								</select>
							</div>
							<?php
							}
							?>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Poskod</label>
							<div class="col-md-9">
								<input type="text" name="poskod" class="form-control" minlength="5" maxlength="5" <?php if($row4==0) { ?>required<?php }else if($row4>0) { ?>readonly<?php } ?> value="<?php echo $data4['poskod']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Jumlah Tanggungan</label>
							<div class="col-md-9">
								<input type="number" step="1" name="jumlah_tanggungan" class="form-control" <?php if($row4==0) { ?>required<?php }else if($row4>0) { ?>readonly<?php } ?> value="<?php echo $data4['jumlah_tanggungan']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Jenis Bantuan</label>
							<div class="col-md-9">
								<input type="text" name="jenis_bantuan" oninput="this.value = this.value.toUpperCase()" class="form-control" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Tarikh Bantuan</label>
							<div class="col-md-9">
								<input type="date" name="tarikh_bantuan" class="form-control" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Kaedah Bayaran</label>
							<div class="col-md-9">
								<input type="text" name="kaedah_bayar" oninput="this.value = this.value.toUpperCase()" class="form-control" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Amaun/Item</label>
							<div class="col-md-9">
								<input type="text" name="amaun_bantuan" oninput="this.value = this.value.toUpperCase()" class="form-control" required>
							</div>
						</div>
						<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
						<div class="form-group row">
							<div class="col-md-4 offset-4">
								<center>
								<button type="submit" name="form_passport" class="btn btn-success">Simpan Maklumat</button>
								</center>
							</div>
						</div>
					</div>
				</form>
				<?php
				}
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tutup</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
	</div>
<!-- /.modal -->

<div class="modal long-modal" id="bukanForm" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="longmodal">Maklumat Bantuan Bukan Ahli Kariah</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body" id="form_bukan">
				<form action="" class="form-horizontal form-bordered" method="POST">
					<div class="form-body">
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Agama</label>
							<div class="col-sm-4">
								
								<div class="custom-control custom-radio">
									<input type="radio" id="customRadio1" name="agama" class="custom-control-input" value="1" <?php if($bil_data==1) { if($data_check['agama']=="1") { ?>checked='checked'<?php }else if($data_check['agama']!="1") { ?>disabled<?php } }else if($bil_data==0) { ?>checked<?php } ?>>
									<label class="custom-control-label" for="customRadio1">Islam</label>
								</div>
								<div class="custom-control custom-radio">
									<input type="radio" id="customRadio2" name="agama" class="custom-control-input" value="2" <?php if($bil_data==1) { if($data_check['agama']=="2") { ?>checked='checked'<?php }else if($data_check['agama']!="2") { ?>disabled<?php } } ?>>
									<label class="custom-control-label" for="customRadio2">Bukan Islam</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Kariah Masjid</label>
							<div class="col-md-9">
								<!-- <select class="form-control" style="display:none" id="masjid_negeri" name="masjid_negeri" required style="width: 100%; height:36px;">
									<option value="">Sila Pilih:-</option>
									<?php
									//$sqlnegeri = "SELECT * FROM negeri ORDER BY name ASC";
									//$querynegeri = mysqli_query($bd2,$sqlnegeri);
									
									//while($negeri=mysqli_fetch_array($querynegeri))
									//{
									//	$nama_negeri=$negeri['name'];
									?>
									<option value="<?php //echo $negeri['id_negeri']; ?>"><?php //echo $nama_negeri; ?></option>
									<?php
									//}
									?>
								</select> -->
								<select id="masjid_kariah" name="masjid_kariah" <?php if($bil_data==0) { ?>required class="select2 form-control custom-select"<?php }else if($bil_data>0) { ?>readonly class="form-control"<?php } ?> style="width: 100%; height:36px;">
									<?php if($bil_data==0) { ?>
									<option value="">Sila Pilih:-</option>
										<?php
										$sqlmasjid = "SELECT * FROM sej6x_data_masjid WHERE id_negeri='9'";
										$querymasjid = mysqli_query($bd2,$sqlmasjid);
										
										while($datamasjid = mysqli_fetch_array($querymasjid))
										{
											$masjid_id = $datamasjid['id_masjid'];
											$masjid_nama = $datamasjid['nama_masjid'];
											
										?>
										<option value="<?php echo $masjid_id; ?>" <?php if($data_check['kariah_masjid'] == $masjid_id) { ?>selected="selected"<? } ?>><?php echo $masjid_nama; ?></option>
										<?php
										}
									}
									else if($bil_data>0) { 
									
										$sqlmasjid = "SELECT * FROM sej6x_data_masjid WHERE id_negeri='9'";
										$querymasjid = mysqli_query($bd2,$sqlmasjid);
										
										while($datamasjid = mysqli_fetch_array($querymasjid))
										{
											$masjid_id = $datamasjid['id_masjid'];
											$masjid_nama = $datamasjid['nama_masjid'];
											
										?>
										<?php if($data_check['kariah_masjid'] == $masjid_id) { ?><option value="<?php echo $masjid_id; ?>" selected="selected"><?php echo $masjid_nama; ?></option><? } ?>
									<?php
										} 
									} 
									?>	
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Nama Penuh</label>
							<div class="col-md-9">
								<input type="text" name="nama_penuh" class="form-control" oninput="this.value = this.value.toUpperCase()" value="<?php echo $data_check['nama_penuh']; ?>" <?php if($bil_data==0) { ?>required<?php }else if($bil_data>0) { ?>readonly<?php } ?>>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">No Kad Pengenalan</label>
							<div class="col-md-9">
								<input type="text" name="no_ic" class="form-control" oninput="this.value = this.value.toUpperCase()" value="<?php echo $no_ic; ?>" <?php if($bil_data==0) { ?>readonly<?php }else if($bil_data>0) { ?>readonly<?php } ?>>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">No Telefon</label>
							<div class="col-md-9">
								<input type="text" name="no_tel" class="form-control" value="<?php echo $data_check['no_tel']; ?>" <?php if($bil_data==0) { ?>required<?php }else if($bil_data>0) { ?>readonly<?php } ?>>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Status Perkahwinan</label>
							<div class="col-md-9">
								<select name="status_perkahwinan" class="form-control" <?php if($bil_data==0) { ?>required<?php }else if($bil_data>0) { ?>readonly<?php } ?>>
								<?php if($bil_data==0) { ?>
									<option value="">Sila Pilh:-</option>
									<option value="1" <?php if($data_check['status_perkahwinan'] == 1) { ?>selected="selected"<? } ?>>BUJANG</option>
									<option value="2" <?php if($data_check['status_perkahwinan'] == 2) { ?>selected="selected"<? } ?>>BERKAHWIN</option>
									<option value="3" <?php if($data_check['status_perkahwinan'] == 3) { ?>selected="selected"<? } ?>>DUDA</option>
									<option value="4" <?php if($data_check['status_perkahwinan'] == 4) { ?>selected="selected"<? } ?>>JANDA</option>
								<?php }
								else if($bil_data>0) { ?>
									<?php if($data_check['status_perkahwinan'] == 1) { ?><option value="1" selected="selected">Bujang</option><? } ?>
									<?php if($data_check['status_perkahwinan'] == 2) { ?><option value="2" selected="selected">Berkahwin</option><? } ?>
									<?php if($data_check['status_perkahwinan'] == 3) { ?><option value="3" selected="selected">Duda</option><? } ?>
									<?php if($data_check['status_perkahwinan'] == 4) { ?><option value="4" selected="selected">Janda</option><? } ?>
								<?php } ?>	
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Alamat</label>
							<div class="col-md-9">
								<textarea name="alamat_terkini" class="form-control" oninput="this.value = this.value.toUpperCase()" <?php if($bil_data==0) { ?>required<?php }else if($bil_data>0) { ?>readonly<?php } ?>><?php echo $data_check['alamat_terkini']; ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Negeri</label>
							<div class="col-md-9">
								<select name="id_negeri" class="form-control" <?php if($bil_data==0) { ?>required onClick="showDaerah(this.value)" <?php }else if($bil_data>0) { ?>readonly<?php } ?>>
								<?php 
								$negeri = $data_check['id_negeri'];
								$sql_negeri = "SELECT * FROM negeri";
								$query_negeri = mysqli_query($bd2,$sql_negeri);
								
								if($bil_data==0) { ?>
									<option value="">Sila Pilh:-</option>
									<?php 
									while($data_negeri = mysqli_fetch_array($query_negeri))
									{
									?>
									<option value="<?php echo $data_negeri['id_negeri']; ?>" <?php if($data_check['id_negeri']==$data_negeri['id_negeri']) { ?>selected="selected"<?php } ?>><?php echo $data_negeri['name']; ?></option>
									<? 
									} 
								}
								else if($bil_data>0){
									while($data_negeri = mysqli_fetch_array($query_negeri)){
								?>
									<?php if($data_check['id_negeri']==$data_negeri['id_negeri']) { ?><option value="<?php echo $data_negeri['id_negeri']; ?>" selected="selected"><?php echo $data_negeri['name']; ?></option><?php } ?>
								<?php
									}
								}
								?>
								</select>
							</div>
						</div>
						<div class="form-group row" id="div_daerah">
							<?php
							if($data_check['id_daerah']!=""){
							?>
							<label class="control-label text-right col-md-3">Daerah</label>
							<div class="col-md-9">
								<select name="id_daerah" class="form-control" <?php if($bil_data==0) { ?>required<?php }else if($bil_data>0) { ?>readonly<?php } ?>>
								<?php 
								$negeri = $data_check['id_negeri'];
								$sql_daerah = "SELECT * FROM daerah WHERE id_negeri='$negeri'";
								$query_daerah = mysqli_query($bd2,$sql_daerah);
								
								if($bil_data==0) { ?>	
									<option value="">Sila Pilh:-</option>
									<?php 
									while($data_daerah = mysqli_fetch_array($query_daerah))
									{
									?>
									<option value="<?php echo $data_daerah['id_daerah']; ?>" <?php if($data_check['id_daerah']==$data_daerah['id_daerah']) { ?>selected="selected"<?php } ?>><?php echo $data_daerah['nama_daerah']; ?></option>
									<? 
									} 
								}
								else if($bil_data>0){
									while($data_daerah = mysqli_fetch_array($query_daerah)){
								?>
									<?php if($data_check['id_daerah']==$data_daerah['id_daerah']) { ?><option value="<?php echo $data_daerah['id_daerah']; ?>" selected="selected"><?php echo $data_daerah['nama_daerah']; ?></option><?php } ?>
								<?php
									}
								}
								?>
								</select>
							</div>
							<?php
							}
							?>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Poskod</label>
							<div class="col-md-9">
								<input type="text" name="poskod" class="form-control" minlength="5" maxlength="5" <?php if($bil_data==0) { ?>required<?php }else if($bil_data>0) { ?>readonly<?php } ?> value="<?php echo $data_check['poskod']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Jumlah Tanggungan</label>
							<div class="col-md-9">
								<input type="number" step="1" name="jumlah_tanggungan" class="form-control" <?php if($bil_data==0) { ?>required<?php }else if($bil_data>0) { ?>readonly<?php } ?> value="<?php echo $data_check['jumlah_tanggungan']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Jenis Bantuan</label>
							<div class="col-md-9">
								<input type="text" name="jenis_bantuan" oninput="this.value = this.value.toUpperCase()" class="form-control" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Tarikh Bantuan</label>
							<div class="col-md-9">
								<input type="date" name="tarikh_bantuan" class="form-control" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Kaedah Bayaran</label>
							<div class="col-md-9">
								<input type="text" name="kaedah_bayar" oninput="this.value = this.value.toUpperCase()" class="form-control" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-right col-md-3">Amaun/Item</label>
							<div class="col-md-9">
								<input type="text" name="amaun_bantuan" oninput="this.value = this.value.toUpperCase()" class="form-control" required>
							</div>
						</div>
						<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
						<div class="form-group row">
							<div class="col-md-4 offset-4">
								<center>
								<button type="submit" name="button_bukan" class="btn btn-success">Simpan Maklumat</button>
								</center>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tutup</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
	</div>
<!-- /.modal -->

<div class="modal long-modal" id="FormEdit" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="longmodal">Kemaskini Maklumat Bantuan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body" id="form_edit">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tutup</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
	</div>
<!-- /.modal -->

<script>
function showWarganegara(str){ 
	if (str == "") {
		document.getElementById("div_warganegara").innerHTML = "";
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
				document.getElementById("div_warganegara").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","admin/getwarganegara.php?warganegara="+str,true);
		xmlhttp.send();
	}
	
	document.getElementById('carian').style.display="block";
}
function showDaerah(str){ 
	if (str == "") {
		document.getElementById("div_daerah").innerHTML = "";
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
				document.getElementById("div_daerah").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","admin/getdaerahbantuan.php?id_negeri="+str,true);
		xmlhttp.send();
	}
}
function editForm(str){ 
	if (str == "") {
		document.getElementById("form_edit").innerHTML = "";
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
				document.getElementById("form_edit").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","admin/geteditbantuan.php?id_bantuan="+str,true);
		xmlhttp.send();
	}
}
function editDaerah(str){ 
	if (str == "") {
		document.getElementById("edit_daerah").innerHTML = "";
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
				document.getElementById("edit_daerah").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","admin/getdaerahbantuan.php?id_negeri="+str,true);
		xmlhttp.send();
	}
}
jQuery(document).ready(function () {
	meja_akaun('#meja_akaun2', 'Senarai Bantuan', [ 0, 1, 2, 3 ]);
});
</script>