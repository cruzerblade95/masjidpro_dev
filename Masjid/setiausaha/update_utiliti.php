<?php
include("../connection/connection.php");

$id_utiliti=$_POST['id_utiliti'];
$jenis_utiliti=$_POST['jenis_utiliti'];
$tarikh_bayaran=$_POST['tarikh_bayaran'];
$harga_bayaran=$_POST['harga_bayaran'];
$ref_resit=$_POST['ref_resit'];
$catatan=$_POST['catatan'];
			 
mysql_select_db($mysql_database, $bd);
       
$query="UPDATE sej6x_data_utiliti set jenis_utiliti='$jenis_utiliti',tarikh_bayaran='$tarikh_bayaran',harga_bayaran='$harga_bayaran',ref_resit='$ref_resit',
catatan='$catatan' where id_utiliti='$id_utiliti' ";
    
	$test=mysql_query($query, $bd);
	if($test)
	{
		    header("location: ../utama.php?view=admin&action=maklumatutiliti"); 
	}
	else
	{
		echo mysql_error();
	}

//}


?>