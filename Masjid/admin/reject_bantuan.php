<?php

	include('../connection/connection.php');

	if(isset($_POST['tolak_bantuan']))
	{	
		$id_reject = $_POST['id_bantuan']; 
		$tarikh_tolak = date('Y-m-d');
		$remark = $_POST['remark'];
		
		$sql_reject = "UPDATE bantuan_zakat SET status_bantuan=2, sebab_lain='$remark', tarikh_proses='$tarikh_tolak' WHERE id_bantuan='$id_reject'";
		$query_reject = mysqli_query($bd2,$sql_reject);
		
		if($query_reject){
			header("Location: ../utama.php?view=admin&action=approve_bantuan");
		}
		
	}
?>