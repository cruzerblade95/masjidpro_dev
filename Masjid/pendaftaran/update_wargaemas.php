<?php
include("../connection/connection.php");

	//if(isset($_POST['update']))
	//{
	//	echo"masuk";
		
	   $id_data=$_POST['id_data'];
	  
			 
	   mysql_select_db($mysql_database, $bd);
       
    
     $query="UPDATE sej6x_data_peribadi set warga_emas=1 where id_data='$id_data'";
    
	

$test=mysql_query($query, $bd);
	if($test)
	{
		    header("location: ../utama.php?view=senarai_wargaemas"); 
	}
	else
	{
		echo mysql_error();
	}

//}


?>