<?php
	
	include("../connection/connection.php");
	
	if(isset($_POST['id_data']))
	{
		$id_data=$_POST['id_data'];
		
		$query="UPDATE sej6x_data_peribadi set data_asnaf=1 where id_data='$id_data'";
    }
	if(isset($_POST['id']))
	{
		$ID=$_POST['id'];
		
		$query="UPDATE sej6x_data_anakqariah set status_asnaf=1 where ID='$ID'";
    }

	$test=mysql_query($query, $bd);
	if($test)
	{
		    header("location: ../utama.php?view=admin&action=senarai_asnaf"); 
	}
	else
	{
		echo mysql_error();
	}

//}


?>