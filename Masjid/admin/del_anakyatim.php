<?php
include("../connection/connection.php");

		
	   $id_data=$_POST['id_data'];

	   mysql_select_db($mysql_database, $bd);
       
    
       $query="UPDATE sej6x_data_peribadi set data_anakyatim=0 where id_data='$id_data'";
    
	

$test=mysql_query($query, $bd);
	if($test)
	{
		    header("location: ../utama.php?view=admin&action=senarai_anakyatim"); 
 }
echo "error"; 


//}


?>