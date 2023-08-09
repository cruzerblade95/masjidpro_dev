<?php
	include("../connection/connection.php");

	if(isset($_GET['id_data']))
	{	
		$id_data=$_GET['id_data'];

		$query="UPDATE sej6x_data_peribadi set data_asnaf=2 where id_data='$id_data'";
	}
	else if(isset($_GET['id']))
	{
		$ID=$_GET['id'];
		
		$query="UPDATE sej6x_data_anakqariah SET status_asnaf=2 WHERE ID='$ID'";
	}

	$test=mysql_query($query, $bd);
	if($test)
	{
		header("location: ../utama.php?view=admin&action=senarai_asnaf"); 
	}
?>