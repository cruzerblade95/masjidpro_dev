<?php
	include("../connection/connection.php");
	//require_once('../connection/connection.php'); 

	if (isset($_POST['del']))
	{
		$id_data=$_POST['del'];

		$sql1="UPDATE sej6x_data_peribadi SET data_kematian='2' WHERE id_data='$id_data'";
		$sqlquery1=mysql_query($sql1,$bd);

		$sql2="DELETE FROM sej6x_data_penyata_perbelanjaan WHERE id_data='$id_data'";
		$sqlquery2=mysql_query($sql2,$bd);

		// Delete data in mysql from row that has this id
		$sqldel="DELETE FROM data_kematian WHERE id_data='$id_data'";
		$result=mysql_query($sqldel);
	}
	else if(isset($_POST['del_anak']))
	{
		$ID=$_POST['del_anak'];
		
		$sql1="UPDATE sej6x_data_anakqariah SET status_kematian='2' WHERE ID='$ID'";
		$sqlquery1=mysql_query($sql1,$bd);

		$sql2="DELETE FROM sej6x_data_penyata_perbelanjaan WHERE id_anak='$ID'";
		$sqlquery2=mysql_query($sql2,$bd);

		// Delete data in mysql from row that has this id
		$sqldel="DELETE FROM data_kematian WHERE id_anak='$ID'";
		$result=mysql_query($sqldel);
	}
	
	if($result)
	{
		header('Location: ../utama.php?view=admin&action=pendaftaran_kematian');  
	}
?>


