<?php

	include('../connection/connection.php');
	
	$id_masjid=$_POST['id_masjid'];
	$nama_tabung=$_POST['nama'];
	$amaun_tabung=$_POST['amaun'];
	$amaun_tabung=number_format($amaun_tabung,2,'.','');
	$sql="INSERT INTO sej6x_data_jenistabung (id_masjid,nama_tabung,amaun_tabung) VALUES ('$id_masjid','$nama_tabung','$amaun_tabung')";
	$sqlquery=mysqli_query($bd2, $sql);

	if($sqlquery)
	{
		header('Location:../utama.php?view=admin&action=tabung');
	}
?>