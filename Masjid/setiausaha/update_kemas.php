<?php
include("../connection/connection.php");
		
	$id=$_POST['id'];
	
	$nama_pengurus=mysql_real_escape_string($_POST['nama_pengurus']);
	$no_tel=mysql_real_escape_string($_POST['no_tel']);
	$nama_kemas=mysql_real_escape_string($_POST['nama_kemas']);
	$bil_pelajar=$_POST['bil_pelajar'];
	$alamat=mysql_real_escape_string($_POST['alamat']);
	$negeri=mysql_real_escape_string($_POST['negeri']);
	$daerah=mysql_real_escape_string($_POST['daerah']);
	$poskod=$_POST['poskod'];
	
    mysql_select_db($mysql_database, $bd);
       
    
     $query="UPDATE sej6x_data_kemas set nama_pengurus='$nama_pengurus',no_tel='$no_tel',nama_kemas='$nama_kemas',bil_pelajar='$bil_pelajar',
alamat='$alamat',negeri='$negeri',daerah='$daerah',poskod='$poskod'
	  where id='$id' ";
    
	

$test=mysql_query($query, $bd);
	if($test)
	{
		    header("location: ../utama.php?view=admin&action=kemas"); 
	}
	else
	{
		echo mysql_error();
	}

//}


?>