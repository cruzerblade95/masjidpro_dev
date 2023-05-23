<?php
include("../connection/connection.php");

// Connect to server and select database.
if(!empty($_POST))
{
	$nama_pengurus=mysqli_real_escape_string($bd2, $_POST['nama_pengurus']);
	$no_tel=mysqli_real_escape_string($bd2, $_POST['no_tel']);
	$nama_belia=mysqli_real_escape_string($bd2, $_POST['nama_belia']);
	$bil_anggota=$_POST['bil_anggota'];
	$alamat=mysqli_real_escape_string($bd2, $_POST['alamat']);
	$negeri=mysqli_real_escape_string($bd2, $_POST['negeri']);
	$daerah=mysqli_real_escape_string($bd2, $_POST['id_daerah']);
	$poskod=$_POST['poskod'];
	$id_masjid=$_POST['id_masjid'];


	$sql1 ="INSERT INTO sej6x_data_beliaa(id_masjid, nama_pengurus, no_tel,nama_belia,bil_anggota, alamat, negeri, 
	        daerah,poskod,last_added)
			   		VALUES($id_masjid,'$nama_pengurus','$no_tel','$nama_belia',$bil_anggota,'$alamat','$negeri',
			'$daerah',$poskod,NOW())";

$test=mysqli_query($bd2, $sql1);
	if($test)
	{
		    header("location: ../utama.php?view=admin&action=belia"); 
	}
	else
	{
		echo mysqli_error($bd2);
	}
}
	?> 