<?php

	include('../daftar_online/connection.php');
	
	if(isset($_GET['no_ic']))
	{
		$no_ic=$_GET['no_ic'];
		$sql2="SELECT a.nama_penuh, a.id_data, a.no_ic, a.no_hp, b.nama_masjid, b.id_masjid FROM sej6x_data_peribadi a, sej6x_data_masjid b WHERE a.no_ic=$no_ic AND a.id_masjid=b.id_masjid";
		$sqlquery2=mysqli_query($bd2, $sql2) or die(mysqli_error($bd2));
		mysqli_num_rows($sqlquery2);
		$data2=mysqli_fetch_array($sqlquery2);
	}
	
	if(isset($_POST['submit']))
	{
		$id_masjid=$_POST['id_masjid'];
		$id_data=$_POST['id_data'];
		$no_ic=$_POST['no_ic'];
		$jenis_bantuan=$_POST['jenis_bantuan'];
		$tujuan=$_POST['tujuan'];
		$amaun=$_POST['amaun'];
		$bank=$_POST['bank'];
		$akaun_bank=$_POST['akaun_bank'];
		$nama_akaun=$_POST['nama_akaun'];
		
		$sql1="INSERT INTO sej6x_data_bantuan (id_masjid,id_data,no_ic,jenis_bantuan,tujuan,amaun,bank,akaun_bank,nama_akaun,tarikh_mohon,status_bantuan) VALUES ('$id_masjid','$id_data','$no_ic','$jenis_bantuan','$tujuan','$amaun','$bank','$akaun_bank','$nama_akaun',NOW(),0)";
		$sqlquery1=mysqli_query($bd2, $sql1) or die(mysqli_error($bd2));
		
		if($sqlquery1)
		{
			header("Location:bantuan.php?no_ic=$no_ic&status=1");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Masjid Pro</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="../apple-icon.png">
    <link rel="shortcut icon" href="../favicon.ico">


    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="../assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body style="position:relative; background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
<div class="col-lg-12">
	<div class="col-lg-3">
	</div>
	<div class="col-lg-6">
		<br><br><br><br><br>
		<div class="card">
			<div class="card-header" style="background-color:#32C9FF">
				<center>
					<img src="../picture/masjidpro.png" height="100" width="250">
				</center>
			</div>
			<div class="card-body">
				<form method="POST" action="bantuan.php">
				<div class="form-group" align="center">
					<h2>
					<?php
					
					echo $data2['nama_masjid'];
					
					?>
					</h2>
				</div>
				<div class="alert alert-info">   
					<center>
					Nama : <?php echo $data2['nama_penuh']; ?><br>
					No K/P : <?php echo $data2['no_ic']; ?><br>
					No Telefon : <?php echo $data2['no_hp']; ?>
					</center>
				</div>
				<?php 
				if(isset($_GET['status']))
				{
				?>
				<div class="alert alert-success alert-dismissable">   
					<center>
					Permohonan Berjaya Dihantar
					</center>
				</div>
				<?php
				}
				?>
				<div class="form-group">
					<label>Jenis Bantuan</label>
					<select class="form-control" name="jenis_bantuan" required>
						<option value="">Sila Pilih:-</option>
						<option value="Bekalan Asas">Bekalan Asas</option>
						<option value="Kewangan">Kewangan</option>
						<option value="Kesihatan">Kesihatan</option>
						<option value="Kecemasan">Kecemasan</option>
						<option value="Bencana">Bencana</option>
						<option value="Lain-Lain">Lain-Lain</option>
					</select>
				</div>
				<div class="form-group">
					<label>Tujuan</label>
					<input type="text" class="form-control" name="tujuan" required>
				</div>
				<div class="form-group">
					<label>Jumlah Amaun (RM)</label>
					<input type="number" class="form-control" name="amaun" required>
				</div>
				<div class="form-group">
					<label>Maklumat Bank</label>
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
				<hr>
				<div class="form-group">
					<button class="btn btn-lg btn-primary btn-block" type='submit' name="submit">Hantar Permohonan</button>
				</div>
				<input type="hidden" name="id_masjid" value="<?php echo $data2['id_masjid']; ?>">
				<input type="hidden" name="id_data" value="<?php echo $data2['id_data']; ?>">
				<input type="hidden" name="no_ic" value="<?php echo $data2['no_ic']; ?>">
				<hr>
				<div align="center">MyRich Dynasty © | <?php echo date('Y'); ?></div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
