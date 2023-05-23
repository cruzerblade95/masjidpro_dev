<?php

	include("../connection/connection.php");
	
	if(isset($_POST['del']))
	{
		$id_data=$_POST['del'];

		$sql1="UPDATE sej6x_data_peribadi SET data_sakit='2' WHERE id_data='$id_data'";
		$sqlquery1=mysql_query($sql1,$bd);

		$sqldel="DELETE FROM sej6x_data_sakit WHERE id_data='$id_data' ";
		$result=mysql_query($sqldel);
	}
	else if(isset($_POST['del_anak']))
	{
		$ID=$_POST['del_anak'];

		$sql1="UPDATE sej6x_data_anakqariah SET status_sakit='2' WHERE ID='$ID'";
		$sqlquery1=mysql_query($sql1,$bd);

		$sqldel="DELETE FROM sej6x_data_sakit WHERE id_anak='$ID'";
		$result=mysql_query($sqldel);
	}
	
	if($result)
	{
		header('Location: ../utama.php?view=admin&action=senarai_sakit');  
	}
?>


