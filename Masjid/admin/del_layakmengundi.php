<?php
	include("../connection/connection.php");
	//require_once('../connection/connection.php'); 
	
	if(isset($_POST['del']))
	{
		$id_data=$_POST['del'];

		// Delete data in mysql from row that has this id
		echo $sqldel="UPDATE sej6x_data_peribadi SET data_undi='2' WHERE id_data='$id_data'";
		$result=mysql_query($sqldel,$bd);
	}
	else if(isset($_POST['del_anak']))
	{
		$ID=$_POST['del_anak'];
			
		$sql="UPDATE sej6x_data_anakqariah SET status_undi='2' WHERE ID='$ID'";
		$result=mysql_query($sql,$bd);
	}
	
	if($result){
	header('Location: ../utama.php?view=admin&action=pendaftaran_layak_mengundi');  
	 }
?>


