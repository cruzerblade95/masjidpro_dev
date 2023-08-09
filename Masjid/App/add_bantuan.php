<?php

	include('connection/connection.php');
	
	$id_masjid=6279;
	
	$nama=$_POST['nama'];
	$no_ic=$_POST['no_ic'];
	$tujuan=$_POST['tujuan'];
	$jumlah=$_POST['jumlah'];
	
	$sql="INSERT INTO approve_bantuan (id_masjid,nama,no_ic,tujuan,jumlah) VALUES ('$id_masjid','$nama','$no_ic','$tujuan','$jumlah')";
	$sqlquery=mysql_query($sql,$bd);
	
	if($sqlquery)
	{
		header("Location: senarai_bantuan.php");
	}

?>