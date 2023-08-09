<?php
include("../connection/connection.php");

$id_kerosakkan=$_POST['id_kerosakkan'];
$tarikh_kerosakkan=$_POST['tarikh_kerosakkan'];
//$hari_kerosakan=$_POST['hari_kerosakan'];
$masa_kerosakan=$_POST['masa_kerosakan'];
$jenis_kerosakan=$_POST['jenis_kerosakan'];
$catatan_kerosakkan=$_POST['catatan_kerosakkan'];
$catatan_tindakkan=$_POST['catatan_tindakkan'];
//$id_lantikan=$_POST['id_lantikan'];
			 
mysql_select_db($mysql_database, $bd);
       
$query="UPDATE sej6x_data_kerosakkan set tarikh_kerosakkan='$tarikh_kerosakkan',masa_kerosakan='$masa_kerosakan',jenis_kerosakan='$jenis_kerosakan',catatan_kerosakkan='$catatan_kerosakkan',
catatan_tindakkan='$catatan_tindakkan' where id_kerosakkan='$id_kerosakkan' ";
    
	$test=mysql_query($query, $bd);
	if($test)
	{
		    header("location: ../utama.php?view=maklumatkerosakan"); 
	}
	else
	{
		echo mysql_error();
	}

?>