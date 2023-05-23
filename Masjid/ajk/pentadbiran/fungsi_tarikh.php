<?php
function fungsi_tarikh($tarikh_semua, $jenis, $jenis2) {
	    //date_default_timezone_set('Asia/Kuala_Lumpur');
		$tarikh_generate = date_create($tarikh_semua);
		if ($jenis == 1) $tarikh_generate = date_format($tarikh_generate, "g:i:s A, l, j F, Y");
		if ($jenis == 2) $tarikh_generate = date_format($tarikh_generate, "l, j F, Y");
		if ($jenis == 3) $tarikh_generate = date_format($tarikh_generate, "Y");
		if ($jenis == 4) $tarikh_generate = date_format($tarikh_generate, "F, Y");
		$tarikh_generate = str_replace("January","Januari", $tarikh_generate);
		$tarikh_generate = str_replace("February","Februari", $tarikh_generate);
		$tarikh_generate = str_replace("March","Mac", $tarikh_generate);
		$tarikh_generate = str_replace("May","Mei", $tarikh_generate);
		$tarikh_generate = str_replace("June","Jun", $tarikh_generate);
		$tarikh_generate = str_replace("July","Julai", $tarikh_generate);
		$tarikh_generate = str_replace("August","Ogos", $tarikh_generate);
		$tarikh_generate = str_replace("October","Oktober", $tarikh_generate);
		$tarikh_generate = str_replace("December","Disember", $tarikh_generate);
		
		$tarikh_generate = str_replace("Sunday","Ahad", $tarikh_generate);
		$tarikh_generate = str_replace("Monday","Isnin", $tarikh_generate);
		$tarikh_generate = str_replace("Tuesday","Selasa", $tarikh_generate);
		$tarikh_generate = str_replace("Wednesday","Rabu", $tarikh_generate);
		$tarikh_generate = str_replace("Thursday","Khamis", $tarikh_generate);
		$tarikh_generate = str_replace("Friday","Jumaat", $tarikh_generate);
		$tarikh_generate = str_replace("Saturday","Sabtu", $tarikh_generate);
		
	if($jenis2 == 1) echo($tarikh_generate);
	if($jenis2 == 2) echo(strtoupper($tarikh_generate));
}
?>