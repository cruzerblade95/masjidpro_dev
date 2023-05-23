<?php
	
	include("../connection/connection.php");
		
	$ID = $_POST['id'];	
	$nama = $_POST['nama_tanggungan'];
	$ic = $_POST['ic_tanggungan'];
	$tarikh_lahir = $_POST['tarikh_lahir_tanggungan'];
	$no_tel = $_POST['tel_tanggungan'];
	$hubungan = $_POST['hubungan_tanggungan'];
		
	$sql = "UPDATE sej6x_data_anakqariah SET nama_penuh='$nama', no_ic='$ic', tarikh_lahir='$tarikh_lahir', no_tel='$no_tel', hubungan='$hubungan' WHERE ID='$ID'";
	$sqlquery = mysql_query($sql,$bd);
	
	if($sqlquery)
	{
		    header("location: ../utama.php?view=admin&action=pendaftaran_ahli_qariah"); 
	}
	else
	{
		echo mysql_error();
	}

?>