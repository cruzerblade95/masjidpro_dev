<?php

include('../connection/connection.php');

if(isset($_POST['edit_ic']) OR isset($_POST['edit_passport']) OR isset($_POST['edit_bukan']))
{
	$id_bantuan_zakat = $_POST['id_bantuan'];
	$jenis_bantuan = $_POST['jenis_bantuan'];
	$tarikh_bantuan = $_POST['tarikh_bantuan'];
	$kaedah_bayar = $_POST['kaedah_bayar'];
	$amaun_item = $_POST['amaun_bantuan'];
	
	$sql_edit = "UPDATE bantuan_zakat SET jenis_bantuan='$jenis_bantuan', tarikh_bantuan='$tarikh_bantuan', kaedah_bayar='$kaedah_bayar', amaun='$amaun_item' WHERE id_bantuan='$id_bantuan_zakat'";
	$query_edit = mysqli_query($bd2,$sql_edit);
	
	if($query_edit)
	{
		header("Location: ../utama.php?view=admin&action=rekod_bantuan");
	}
}
?>