<?php

	include('../connection/connection.php');
	
	$id_masjid=$_POST['id_masjid'];
	$kategori=$_POST['kategori'];
	$nama_pelanggan=$_POST['nama_pelanggan'];
	$no_pelanggan=$_POST['no_pelanggan'];
	$no_telefon=$_POST['no_telefon'];
	$alamat=$_POST['alamat'];
	$negeri=$_POST['id_negeri'];
	$daerah=$_POST['id_daerah'];
	$poskod=$_POST['poskod'];
	
	$sql="INSERT INTO sej6x_data_pelanggan 
	(id_masjid,kategori,nama_pelanggan,no_pelanggan,no_telefon,alamat,negeri,daerah,poskod) 
	VALUES
	('$id_masjid','$kategori','$nama_pelanggan','$no_pelanggan','$no_telefon','$alamat','$negeri','$daerah','$poskod')";
	$sqlquery=mysql_query($sql,$bd);
	
	if($sqlquery)
	{
		header("Location:../utama.php?view=admin&action=pelanggan");
	}
?>