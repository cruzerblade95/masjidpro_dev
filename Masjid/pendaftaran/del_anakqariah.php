<?php

	include("../connection/connection.php");
	
	$ID=$_GET['id_tanggungan'];
	
	$sql="DELETE FROM sej6x_data_anakqariah WHERE ID='$ID'";
	$result=mysql_query($sql,$bd);

	if($result)
	{
		header("Location: ../utama.php?view=admin&action=pendaftaran_ahli_qariah");  
	}
?>


