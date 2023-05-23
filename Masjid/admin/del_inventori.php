<?php

	include('../connection/connection.php');
	
	$id_masjid=$_POST['id_masjid'];
	$id_inventori=$_POST['id_inventori'];
	$no_rujukan=$_POST['no_rujukan'];
	
	$sql="DELETE FROM sej6x_data_inventori WHERE id_masjid = $id_masjid AND id_inventori='$id_inventori'";
	$sqlquery=mysqli_query($bd2, $sql);
	
	$sql1="DELETE FROM status_barang WHERE id_masjid='$id_masjid' AND no_barang='$no_rujukan'";
	$sqlquery1=mysqli_query($bd2, $sql1);
	
	if($sqlquery)
	{
		if($sqlquery1)
		{
			header("Location:../utama.php?view=admin&action=maklumatinventori");
		}
	}

?>