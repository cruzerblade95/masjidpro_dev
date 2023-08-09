<?php

	include('../daftar_online/connection.php');
	
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
<script src="js/jquery-3.4.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
	$('#table_display').DataTable();
} );
</script>
<html>
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
				<div class="table-responsive">
					<table id="table_display" class="table table-striped table-bordered">
						<thead>
							<tr>
							<th><div align="center">Bil</div></th>
							<th><div align="center">Bantuan</div></th>
							<th><div align="center">Amaun</div></th>
							<th><div align="center">Info</div></th>
							</tr>
						</thead>
						<tbody>
						<?php
						$x=1;
						$sql="SELECT * FROM sej6x_data_bantuan WHERE status_bantuan=1";
						$sqlquery=mysql_query($sql,$bd);
						while($data=mysql_fetch_array($sqlquery))
						{
						?>
						<tr>
							<td align="center"><?php echo $x; ?></td>
							<td align="center"><?php echo $data['jenis_bantuan']; ?></td>
							<td align="center"><?php echo $data['amaun']; ?></td>
							<td align="center"><a href="detail_bantuan.php?id_bantuan=<?php echo $data['id_bantuan']; ?>" class="btn btn-info"><i class="fa fa-info-circle"></i></a></td>
						<tr>
						<?php
						$x++;
						}
						?>
						</tbody>
					</table>
				</div>
				<hr>
				<div align="center">MyRich Dynasty © | <?php echo date('Y'); ?></div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
