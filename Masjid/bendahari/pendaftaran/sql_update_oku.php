<?php
include("../connection/connection.php");

			
	//UPDATE
			
	$id_data=$_POST['id_data'];
	$jenis_oku=mysql_real_escape_string($_POST['jenis_oku']);
	$keterangan=mysql_real_escape_string($_POST['keterangan']);

			
	$sql2 ="UPDATE sej6x_data_oku set jenis_oku='$jenis_oku',keterangan='$keterangan' where id_data='$id_data'";		


$test=mysql_query($sql2, $bd);
	if($test)
	{	
		    header("location: ../utama.php?view=senarai_oku"); 
	}
	else
	{
		echo mysql_error();
	}
			
			?> 
