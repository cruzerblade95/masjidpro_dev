<?php

	include('../connection/connection.php');
	
	$id_masjid=$_POST['id_masjid'];
	$id_tabung=$_POST['tabung'];
	$kategori=$_POST['kategori'];
	$nama_bayaran=$_POST['nama_bayaran'];
	$sql="INSERT INTO sej6x_data_jenisbayaran (id_masjid,id_tabung,kategori,nama_bayaran) VALUES ('$id_masjid','$id_tabung','$kategori','$nama_bayaran')";
	$sqlquery=mysql_query($sql,$bd);

	if($sqlquery)
	{
		header('Location:../utama.php?view=admin&action=jenis_pembayaran');
	}
?>