<?php
include("../connection/connection.php");
   
    $id=$_POST['id'];

	$nama_pengurus=mysql_real_escape_string($_POST['nama_pengurus']);
	$no_tel=mysql_real_escape_string($_POST['no_tel']);
	$nama_surau=mysql_real_escape_string($_POST['nama_surau']);
	$bil_anggota=$_POST['bil_anggota'];
	$alamat=mysql_real_escape_string($_POST['alamat']);
	$negeri=mysql_real_escape_string($_POST['negeri']);
	$daerah=mysql_real_escape_string($_POST['daerah']);
	$poskod=$_POST['poskod'];
	$id_masjid=$_POST['id_masjid'];
	
	mysql_select_db($mysql_database, $bd);

	$sql1 ="UPDATE sej6x_data_surau set nama_pengurus='$nama_pengurus',no_tel='$no_tel',bil_anggota=$bil_anggota,
	nama_surau='$nama_surau',alamat='$alamat',negeri='$negeri',daerah='$daerah',poskod=$poskod  
	 where id='$id' ";

    $test=mysql_query($sql1, $bd);
	if($test)
	{
		    header("location: ../utama.php?view=surau"); 
	}
	else
	{
		echo mysql_error();
	}

	?> 
 