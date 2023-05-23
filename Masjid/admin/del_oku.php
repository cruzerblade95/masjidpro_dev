<?php
	
	include("../connection/connection.php");

	if(isset($_POST['del']))
	{		
		$id_data=$_POST['del'];     
    
		$query="UPDATE sej6x_data_peribadi set data_oku='2' where id_data='$id_data'";
	   
		$sql="DELETE FROM sej6x_data_oku WHERE id_data='$id_data'";
		$sqlquery=mysql_query($sql,$bd);
    }
	else if(isset($_POST['del_anak']))
	{
		$ID=$_POST['del_anak'];
		
		$query="UPDATE sej6x_data_anakqariah SET status_oku='2' WHERE ID='$ID'";
		
		$sql="DELETE FROM sej6x_data_oku WHERE id_anak='$ID'";
		$sqlquery=mysql_query($sql,$bd);
	}

	$test=mysql_query($query, $bd);
	if($test)
	{
		    header("location: ../utama.php?view=admin&action=senarai_oku"); 
	} 


//}


?>