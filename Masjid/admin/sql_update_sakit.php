<?php
	
	include("../connection/connection.php");
	
	if(isset($_POST['id_data']))
	{
		$id_data=$_POST['id_data'];
		$rawatan_terkini=$_POST['rawatan_terkini'];
		$jenis_penyakit=$_POST['jenis_penyakit'];
		
		$sql ="UPDATE sej6x_data_sakit set jenis_penyakit='$jenis_penyakit',rawatan_terkini='$rawatan_terkini' where id_data='$id_data'";		
	}
	else if(isset($_POST['id']))
	{
		$id_anak=$_POST['id'];
		$rawatan_terkini=$_POST['rawatan_terkini'];
		$jenis_penyakit=$_POST['jenis_penyakit'];
		
		$sql ="UPDATE sej6x_data_sakit set jenis_penyakit='$jenis_penyakit',rawatan_terkini='$rawatan_terkini' where id_anak='$id_anak'";		
	}

	$test=mysql_query($sql, $bd);
	if($test)
	{	
		    header("location: ../utama.php?view=admin&action=senarai_sakit"); 
	}
	else
	{
		echo mysql_error();
	}
?> 
