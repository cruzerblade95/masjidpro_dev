<?php

	$mysql_hostname_utama = "localhost";
	$mysql_user_utama = "tahfizte_spmd";
	$mysql_password_utama = "WebmasterMasjid2019";
	$mysql_database_utama = "tahfizte_masjidpro";
	
	$bd = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama) or die("Could not connect database bd");
	mysqli_select_db($bd, $mysql_database_utama) or die("Could not select database");
	
	$no_ic=$_POST['no_ic'];
	$sql_ic="SELECT * FROM sej6x_data_peribadi WHERE no_ic='$no_ic'";
	$query_ic=mysqli_query($bd, $sql_ic);
	
	if(mysqli_num_rows($query_ic)>0)
	{
		echo "<small class='help-block form-text text-danger'>No K/P Telah Berdaftar</small>";
	}
	else if(mysqli_num_rows($query_ic)==0)
	{
		echo "<small class='help-block form-text text-success'>No K/P Belum Digunakan</small>";
	}
	exit();
?>