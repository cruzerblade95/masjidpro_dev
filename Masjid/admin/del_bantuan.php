<?php
	include("../connection/connection.php");

	if(isset($_GET['no_ic']))
	{	
		$id_bantuan	= $_GET['id_bantuan'];
		$no_ic = $_GET['no_ic'];

		$query="DELETE FROM bantuan_zakat WHERE id_bantuan_zakat='$id_bantuan'";
		$sqlquery = mysqli_query($bd2,$query);
		
		if($sqlquery){
			header("Location:../utama.php?view=admin&action=bantuan&no_ic=".$no_ic);
		}
	}
	if(isset($_GET['no_passport']))
	{	
		$id_bantuan	= $_GET['id_bantuan'];
		$no_passport = $_GET['no_passport'];

		$query="DELETE FROM bantuan_zakat WHERE id_bantuan_zakat='$id_bantuan'";
		$sqlquery = mysqli_query($bd2,$query);
		
		if($sqlquery){
			header("Location:../utama.php?view=admin&action=bantuan&no_passport=".$no_passport);
		}
	}
?>