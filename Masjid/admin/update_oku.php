<?php

	include("../connection/connection.php");

	if(isset($_POST['id_data']))
	{
		
		$id_data=$_POST['id_data']; 

		$jenis_oku=mysql_real_escape_string($_POST['jenis_oku']);
		$keterangan=mysql_real_escape_string($_POST['keterangan']);
    
		$query="UPDATE sej6x_data_oku SET jenis_oku='$jenis_oku', keterangan='$keterangan' WHERE id_data='$id_data'";
    }
	else if(isset($_POST['id']))
	{
		$ID=$_POST['id'];
		
		$jenis_oku=mysql_real_escape_string($_POST['jenis_oku']);
		$keterangan=mysql_real_escape_string($_POST['keterangan']);
		
		$query="UPDATE sej6x_data_oku SET jenis_oku='$jenis_oku', keterangan='$keterangan' WHERE id_anak='$ID'";
		
	}	

	$test=mysql_query($query, $bd);
	if($test)
	{
		    header("location: ../utama.php?view=admin&action=senarai_oku"); 
	}
	else
	{
		echo mysql_error();
	}

?>