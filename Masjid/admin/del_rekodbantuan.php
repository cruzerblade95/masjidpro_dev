<?php

include('../connection/connection.php');

if(isset($_POST['del_button']))
{
	if(isset($_POST['no_ic']))
	{	
		$id_bantuan	= $_POST['id_bantuan'];
		//$no_ic = $_POST['no_ic'];

		echo $delquery="DELETE FROM bantuan_zakat WHERE id_bantuan='$id_bantuan'";
		$delsqlquery = mysqli_query($bd2,$delquery);
		
		if($delsqlquery){
			header("Location:../utama.php?view=admin&action=rekod_bantuan");
		}
	}
	if(isset($_POST['no_passport']))
	{	
		$id_bantuan = $_POST['id_bantuan'];
		//$no_passport = $_POST['no_passport'];

		$delquery="DELETE FROM bantuan_zakat WHERE id_bantuan='$id_bantuan'";
		$delsqlquery = mysqli_query($bd2,$delquery);
		
		if($delsqlquery){
			header("Location:../utama.php?view=admin&action=rekod_bantuan");
		}
	}
}
?>