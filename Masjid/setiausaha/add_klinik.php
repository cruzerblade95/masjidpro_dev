<?php
include("../connection/connection.php");

// Connect to server and select database.
if(!empty($_POST))
{
	$nama_pengurus=mysql_real_escape_string($_POST['nama_pengurus']);
	$no_tel=mysql_real_escape_string($_POST['no_tel']);
	$nama_klinik=mysql_real_escape_string($_POST['nama_klinik']);
	$bil_anggota=$_POST['bil_anggota'];
	$alamat=mysql_real_escape_string($_POST['alamat']);
	$negeri=mysql_real_escape_string($_POST['negeri']);
	$daerah=mysql_real_escape_string($_POST['daerah']);
	$poskod=$_POST['poskod'];
	$id_masjid=$_POST['id_masjid'];
	
	mysql_select_db($mysql_database, $bd);


	$sql1 ="INSERT INTO sej6x_data_klinik(id,id_masjid, nama_pengurus, no_tel,nama_klinik,bil_anggota, alamat, negeri, 
	        daerah,poskod,last_added)
			   		VALUES('',$id_masjid,'$nama_pengurus','$no_tel','$nama_klinik',$bil_anggota,'$alamat','$negeri',
			'$daerah',$poskod,NOW())";

$test=mysql_query($sql1, $bd);
	if($test)
	{
		    header("location: ../utama.php?view=admin&action=klinik"); 
	}
	else
	{
		echo mysql_error();
	}
}
	?> 