<?php

	include('../connection/connection.php');
	
	if(isset($_POST['submit_approve']))
	{
		$id_approve = $_POST['id_bantuan'];
		$kaedah_bayar = $_POST['kaedah_bayar'];
		$amaun_item = $_POST['amaun_bantuan']; 
		$remark = $_POST['remark'];
		$tarikh_approve = date('Y-m-d');
		$tarikh_bantuan = $_POST['tarikh_bantuan'];
		
		$sql_approve = "UPDATE bantuan_zakat SET kaedah_bayar='$kaedah_bayar', tarikh_bantuan='$tarikh_bantuan', amaun='$amaun_item', tarikh_proses='$tarikh_approve', sebab_lain='$remark', status_bantuan='1' WHERE id_bantuan='$id_approve'";
		$query_approve = mysqli_query($bd2,$sql_approve);
		
		if($query_approve){
			header("Location: ../utama.php?view=admin&action=approve_bantuan");
		}
	}
?>
