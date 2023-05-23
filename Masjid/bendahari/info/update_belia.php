<?php
include("../connection/connection.php");
		
	$id=$_POST['id'];
	
	$nama_pengurus=mysql_real_escape_string($_POST['nama_pengurus']);
	$no_tel=mysql_real_escape_string($_POST['no_tel']);
	$nama_belia=mysql_real_escape_string($_POST['nama_belia']);
	$bil_anggota=$_POST['bil_anggota'];
	$alamat=mysql_real_escape_string($_POST['alamat']);
	$negeri=mysql_real_escape_string($_POST['negeri']);
	$daerah=mysql_real_escape_string($_POST['daerah']);
	$poskod=$_POST['poskod'];
	
    mysql_select_db($mysql_database, $bd);
       
    
     $query="UPDATE sej6x_data_beliaa set nama_pengurus='$nama_pengurus',no_tel='$no_tel',nama_belia='$nama_belia',bil_anggota='$bil_anggota',
alamat='$alamat',negeri='$negeri',daerah='$daerah',poskod='$poskod'
	  where id='$id' ";
    
	

$test=mysql_query($query, $bd);
	if($test)
	{
		    header("location: ../utama.php?view=belia"); 
	}
	else
	{
		echo mysql_error();
	}

//}


?>