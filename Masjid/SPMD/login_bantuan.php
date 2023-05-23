<?php

	include('../daftar_online/connection.php');
	
	if(isset($_POST['no_ic']))
	{
		echo $no_ic=$_POST['no_ic'];

		$sql="SELECT * FROM sej6x_data_peribadi WHERE no_ic='$no_ic'";
		$sqlquery=mysqli_query($bd2, $sql);
		$row=mysqli_num_rows($sqlquery);
		if($row>0)
		{
			header("Location: bantuan.php?no_ic=$no_ic");
		}
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0RCF4Z4X27"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-0RCF4Z4X27');
    </script>
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
				<form method="POST" action="login_bantuan.php">
				<div class="form-group">
					<label>No Kad Pengenalan</label>
					<input type="text" name="no_ic" class="form-control" minlength="12" maxlength="12">					
				</div>
				<div class="form-group">
					<button class="btn btn-lg btn-primary btn-block" type='submit'>Log Masuk</button>
				</div>
				<?php
				if(isset($_POST['no_ic']))
				{
					if($row==0)
				{
				?>
				<div class="alert alert-danger alert-dismissable">                            
					Anda Belum Berdaftar Sebagai Ahli Kariah                               
				</div>
				<?php
				}
				}
				?>
				<hr>
				<div align="center">MyRich Dynasty © | <?php echo date('Y'); ?></div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
