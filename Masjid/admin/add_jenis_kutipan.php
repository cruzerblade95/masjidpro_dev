<?php

	include('../connection/connection.php');
	
	$id_masjid=$_POST['id_masjid'];
	$id_tabung=$_POST['tabung'];
	
	$kategori=$_POST['kategori'];
	$nama_kutipan=$_POST['nama_kutipan'];

	echo $sql="INSERT INTO sej6x_data_jeniskutipan (id_masjid,id_tabung,kategori,nama_kutipan) VALUES ('$id_masjid','$id_tabung','$kategori','$nama_kutipan')";
	$sqlquery=mysql_query($sql,$bd);
	
	if($sqlquery)
	{
		header("Location:../utama.php?view=admin&action=jenis_kutipan");
	}
	
?>