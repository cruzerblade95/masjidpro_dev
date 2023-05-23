<?php

include('../connection/connection.php');

if(isset($_POST['submit_bantuan']))
{
	$tarikh_ambil = $_POST['tarikh_ambil'];
	$id_bantuan = $_POST['id_bantuan'];
	
	$sql1 = "UPDATE bantuan_zakat SET tarikh_ambil='$tarikh_ambil', status_ambil='1' WHERE id_bantuan='$id_bantuan'";
	$sqlquery1 = mysqli_query($bd2,$sql1);
	
	if($sqlquery1){
		header("Location: ../utama.php?view=admin&action=rekod_bantuan");
	}
}
?>