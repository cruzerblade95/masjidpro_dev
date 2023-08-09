<?php

	include('../connection/connection.php');
	
	$id_masjid=$_POST['id_masjid'];
	$nama_akaun=$_POST['nama'];
	$amaun_akaun=$_POST['amaun'];
	
	$sql="INSERT INTO sej6x_data_jenisakaun (id_masjid,nama_akaun,amaun_akaun) VALUES ('$id_masjid','$nama_akaun','$amaun_akaun')";
	$sqlquery=mysql_query($sql,$bd);
	
	if($sqlquery)
	{
		header("Location:../utama.php?view=admin&action=akaun_bank");
	}

?>