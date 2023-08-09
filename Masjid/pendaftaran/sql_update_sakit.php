<?php
include("../connection/connection.php");

			
	//UPDATE
			
	$id_data=$_POST['id_data'];
	$rawatan_terkini=$_POST['rawatan_terkini'];
    $jenis_penyakit=$_POST['jenis_penyakit'];
	
			
	$sql2 ="UPDATE sej6x_data_sakit set jenis_penyakit='$jenis_penyakit',rawatan_terkini='$rawatan_terkini' where id_data='$id_data'";		


$test=mysql_query($sql2, $bd);
	if($test)
	{	
		    header("location: ../utama.php?view=senarai_sakit"); 
	}
	else
	{
		echo mysql_error();
	}
			
			?> 
