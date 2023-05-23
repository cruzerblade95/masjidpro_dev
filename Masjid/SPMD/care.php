<?php

	include('../daftar_online/connection.php');
	
	if(isset($_POST['no_ic']))
	{
		$no_ic=$_POST['no_ic'];
		$id_masjid1=$_POST['id_masjid'];
		$sql1="SELECT * FROM sej6x_data_masjid WHERE id_masjid='$id_masjid1'";
		$sqlquery1=mysqli_query($bd2,$sql1);
		$data1=mysqli_fetch_array($sqlquery1);
		
		$sql2="SELECT a.nama_penuh, a.id_data, a.no_ic, a.no_hp, a.umur, b.nama_masjid, b.id_masjid FROM sej6x_data_peribadi a, sej6x_data_masjid b WHERE a.no_ic=$no_ic AND a.id_masjid=b.id_masjid 
                UNION SELECT c.nama_penuh, CONCAT ('A-',c.ID) 'id_data', c.no_ic, c.no_tel 'no_hp', c.umur, d.nama_masjid, d.id_masjid FROM sej6x_data_anakqariah c, sej6x_data_masjid d WHERE c.no_ic='$no_ic' AND c.id_masjid=d.id_masjid";
		$sqlquery2=mysqli_query($bd2,$sql2);
		$row2=mysqli_num_rows($sqlquery2);
		$data2=mysqli_fetch_array($sqlquery2);
		
		$sql3="SELECT * FROM sej6x_data_peribadi WHERE no_ic='$no_ic'";
		$sqlquery3=mysqli_query($bd2,$sql3);
		$data3=mysqli_fetch_array($sqlquery3);
		
		if($row2==0)
		{
			echo "<script>
			alert('Maaf, Anda Perlu Berdaftar dengan Sistem MasjidPro');
			document.location='login_care.php?id_masjid=$id_masjid1&no_ic=$no_ic';
			</script>";
		}
		
		else if($data1['id_masjid']!=$data2['id_masjid'])
		{
			echo "<script>
			alert('Maaf, Solat Fardhu dan Solat Jumaat hanya dibenarkan untuk Anak Kariah sahaja');
			document.location='login_care.php?id_masjid=$id_masjid1';
			</script>";
			
		}
	}
	
	if(isset($_GET['no_ic']))
	{
		$no_ic=$_GET['no_ic'];
		$sql2 = "SELECT a.nama_penuh, a.id_data, a.no_ic, a.no_hp, a.umur, b.nama_masjid, b.id_masjid FROM sej6x_data_peribadi a, sej6x_data_masjid b WHERE a.no_ic=$no_ic AND a.id_masjid=b.id_masjid 
                UNION SELECT c.nama_penuh, CONCAT ('A-',c.ID) 'id_data', c.no_ic, c.no_tel 'no_hp', c.umur, d.nama_masjid, d.id_masjid FROM sej6x_data_anakqariah c, sej6x_data_masjid d WHERE c.no_ic='$no_ic' AND c.id_masjid=d.id_masjid";
		$sqlquery2=mysqli_query($bd2,$sql2);
		$data2=mysqli_fetch_array($sqlquery2);
	}
	
	if(isset($_POST['submit']))
	{
		$id_column = 'id_data';
		$id_data=$_POST['id_data'];
		
		if(strpos($_POST['id_data'], 'A-') !== false) {
		$id_column = 'ID';
		$id_data = str_replace('A-', '', $_POST['id_data']);
		}
		
		$id_masjid=$_POST['id_masjid'];
		$no_ic=$_POST['no_ic'];
		$suhu=$_POST['suhu'];
		$tujuan=$_POST['tujuan'];
		
		$sql="INSERT INTO sej6x_data_gejala (id_masjid,$id_column,no_ic,suhu,tujuan,time) VALUES ('$id_masjid','$id_data','$no_ic','$suhu','$tujuan',NOW())";
		$sqlquery = mysqli_query($bd2,$sql);
		
		//$sql1="";
		//$sqlquery1=mysql_query($sql1,$bd);
		
		if($sqlquery)
		{
			header("Location:care.php?no_ic=$no_ic&status=1");
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
	
	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<style>
/* Hiding the checkbox, but allowing it to be focused */
.badgebox
{
    opacity: 0;
}

.badgebox + .badge
{
    /* Move the check mark away when unchecked */
    text-indent: -999999px;
    /* Makes the badge's width stay the same checked and unchecked */
	width: 27px;
}

.badgebox:focus + .badge
{
    /* Set something to make the badge looks focused */
    /* This really depends on the application, in my case it was: */
    
    /* Adding a light border */
    box-shadow: inset 0px 0px 5px;
    /* Taking the difference out of the padding */
}

.badgebox:checked + .badge
{
    /* Move the check mark back when checked */
	text-indent: 0;
}
</style>
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
				<form method="POST" action="care.php">
				<div class="form-group" align="center">
					<h2>
					<?php
					
					echo $data1['nama_masjid'];
					
					?>
					</h2>
				</div>
				<div class="alert alert-info">   
					<center>
					Nama : <?php echo $data2['nama_penuh']; ?><br>
					No K/P : <?php echo $data2['no_ic']; ?><br>
					No Telefon : <?php echo $data2['no_hp']; ?><br>
					Umur : <?php echo $data2['umur']; ?><br>
					Kariah : <?php echo $data2['nama_masjid']; ?>
					</center>
				</div>
				<?php 
				if(isset($_GET['status']))
				{
				?>
				<div class="alert alert-success alert-dismissable">   
					<center>
					Maklumat Berjaya Dihantar
					</center>
				</div>
				<?php
				}
				?>
				<hr>
				<div class="form-group">
					<label>Suhu Badan</label>
					<input type="number" name="suhu" required min="0" step="0.1" class="form-control" required>
				</div>
				<hr>
				<div class="form-group">
					<label>Tujuan</label>
					<select class="form-control" name="tujuan" required>
						<option value="">Sila Pilih:-</option>
						<option value="Subuh">Solat Subuh</option>
						<option value="Zohor">Solat Zohor</option>
						<option value="Asar">Solat Asar</option>
						<option value="Maghrib">Solat Maghrib</option>
						<option value="Isyak">Solat Isyak</option>
						<option value="Jumaat">Solat Jumaat</option>
					</select>
				</div>
				<!-- <center>
				<h3>Adakah anda mempunyai gejala berikut?</h3>
				(Pilih gejala yang berkenaan)
				
				<br>
				<div class="form-group">
					<label for="primary1" class="btn btn-primary">Tiada <input type="checkbox" name="tiada" id="primary1" class="badgebox" value="1"><span class="badge">&check;</span></label><br><br>
					<label for="primary2" class="btn btn-primary">Batuk Kering<input type="checkbox" name="batuk" id="primary2" class="badgebox" value="2"><span class="badge">&check;</span></label><br><br>
					<label for="primary3" class="btn btn-primary">Cirit-Birit<input type="checkbox" name="cirit" id="primary3" class="badgebox" value="3"><span class="badge">&check;</span></label><br><br>
					<label for="primary4" class="btn btn-primary">Demam<input type="checkbox" name="demam" id="primary4" class="badgebox" value="4"><span class="badge">&check;</span></label><br><br>
					<label for="primary5" class="btn btn-primary">Hidung Berair<input type="checkbox" name="hidung" id="primary5" class="badgebox" value="5"><span class="badge">&check;</span></label><br><br>
					<label for="primary6" class="btn btn-primary">Keletihan<input type="checkbox" name="letih" id="primary6" class="badgebox" value="6"><span class="badge">&check;</span></label><br><br>
					<label for="primary7" class="btn btn-primary">Pening Kepala<input type="checkbox" name="pening" id="primary7" class="badgebox" value="7"><span class="badge">&check;</span></label><br><br>
					<label for="primary8" class="btn btn-primary">Sakit Badan<input type="checkbox" name="badan" id="primary8" class="badgebox" value="8"><span class="badge">&check;</span></label><br><br>
					<label for="primary9" class="btn btn-primary">Sakit Tekak<input type="checkbox" name="tekak" id="primary9" class="badgebox" value="9"><span class="badge">&check;</span></label><br><br>
					<label for="primary10" class="btn btn-primary">Sesak Nafas<input type="checkbox" name="sesak" id="primary10" class="badgebox" value="10"><span class="badge">&check;</span></label>
				</div>
				</center> -->
				<hr>
				<div class="form-group">
					<button class="btn btn-lg btn-primary btn-block" type='submit' name="submit">Hantar Maklumat</button>
				</div>
				<input type="hidden" name="id_masjid" value="<?php echo $data1['id_masjid']; ?>">
				<input type="hidden" name="id_data" value="<?php echo $data2['id_data']; ?>">
				<input type="hidden" name="no_ic" value="<?php echo $data2['no_ic']; ?>">
				<hr>
				<div align="center">MyRich Dynasty © | 2019</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
