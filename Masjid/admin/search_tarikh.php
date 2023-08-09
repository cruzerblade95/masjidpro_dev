<?php

	include('../connection/connection.php');
	
	if(isset($_GET['awal']))
	{
		$awal=$_GET['awal'];
	}
	else if($_GET['awal']==NULL OR $_GET['awal']=="")
	{
		$awal="0";
	}
	
	if(isset($_GET['akhir']))
	{
		$akhir=$_GET['akhir'];
	}
	else if($_GET['akhir']==NULL OR $_GET['akhir']=="")
	{
		$akhir="0";
	}
	
	header("Location: ../utama.php?view=admin&action=dashboard_payment&awal='$awal'&akhir='$akhir'");
?>