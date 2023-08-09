<?php

	include('../connection/connection.php');
	
	$id_masjid=$_POST['id_masjid'];
	$id_inventori=$_POST['id_inventori'];
	
	$sql="DELETE FROM sej6x_data_inventori WHERE id_masjid = $id_masjid AND id_inventori='$id_inventori'";
	$sqlquery=mysqli_query($bd2, $sql);

	
	if($sqlquery)
	{
	    header("Location:../utama.php?view=admin&action=maklumatinventori&sideMenu=masjid");

	}

?>