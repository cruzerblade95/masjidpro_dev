<?php
include("../connection/connection.php");

	if(isset($_POST['id_data']))
	{		
	
	   $id_data=$_POST['id_data'];
    
       $query="UPDATE sej6x_data_peribadi set data_ibutunggal='2' where id_data='$id_data'";
    }
	else if(isset($_POST['id']))
	{
		$ID=$_POST['id'];
		
		$query="UPDATE sej6x_data_anakqariah SET status_ibutunggal='2' WHERE ID='$ID'";
	}
	

	$test=mysql_query($query, $bd);
	if($test)
	{
		header("location: ../utama.php?view=admin&action=senarai_ibutunggal"); 
	}


//}


?>