<?php
include("../connection/connection.php");

	//if(isset($_POST['update']))
	//{
	//	echo"masuk";
	
	if(isset($_POST['id_data']))
	{	
		$id_data=$_POST['id_data'];
       
		$query="UPDATE sej6x_data_peribadi set data_undi=1 where id_data='$id_data'";
    }
	else if(isset($_POST['id_anak']))
	{
		$id_anak=$_POST['id_anak'];
		$query="UPDATE sej6x_data_anakqariah SET status_undi=1 WHERE ID='$id_anak'";
	}

	$test=mysql_query($query, $bd);
	if($test)
	{
		    header("location: ../utama.php?view=admin&action=pendaftaran_layak_mengundi"); 
	}
	else
	{
		echo mysql_error();
	}



?>