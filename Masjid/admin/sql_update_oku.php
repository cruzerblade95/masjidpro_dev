<?php
include("../connection/connection.php");

			
	//UPDATE
			
	$id_oku=$_POST['id_oku'];
	$jenis_oku=mysql_real_escape_string($_POST['jenis_oku']);
	$keterangan=mysql_real_escape_string($_POST['keterangan']);

			
	$sql2 ="UPDATE sej6x_data_oku set jenis_oku='$jenis_oku',keterangan='$keterangan' where id_oku='$id_oku'";		


$test=mysql_query($sql2, $bd);
	if($test)
	{	
		    header("location: ../utama.php?view=admin&action=senarai_oku"); 
	}
	else
	{
		echo mysql_error();
	}
			
			?> 
