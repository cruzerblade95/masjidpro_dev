<?php

	include('../connection/connection.php');
	
	$id_masjid=$_POST['id_masjid'];
	
	$jenis=$_POST['jenis'];
	$nama_pembekal=$_POST['nama_pembekal'];
	$no_hp=$_POST['no_hp'];
	$alamat=$_POST['alamat'];
	$id_negeri=$_POST['id_negeri'];
	$id_daerah=$_POST['id_daerah'];
	$poskod=$_POST['poskod'];
	
	$sql="INSERT INTO sej6x_data_pembekal (id_masjid,jenis,nama_pembekal,no_hp,alamat,id_negeri,id_daerah,poskod) VALUES ('$id_masjid','$jenis','$nama_pembekal','$no_hp','$alamat','$id_negeri','$id_daerah','$poskod')";
	$sqlquery=mysql_query($sql,$bd);
	
	if($sqlquery)
	{
		header('Location:../utama.php?view=admin&action=pembekal');
	}

?>
