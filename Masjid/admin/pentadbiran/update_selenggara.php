<?php
include("../connection/connection.php");

$id_selenggara=$_POST['id_selenggara'];
$nama_syarikat=$_POST['nama_syarikat'];
$no_pendaftaran=$_POST['no_pendaftaran'];
$nama_syarikat=$_POST['nama_syarikat'];
$no_pendaftaran=$_POST['no_pendaftaran'];
$nama_pekerja=$_POST['nama_pekerja'];
$no_ic=$_POST['no_ic'];
$umur=$_POST['umur'];
$alamat_syarikat=$_POST['alamat_syarikat'];
$negeri=$_POST['negeri'];
$daerah=$_POST['daerah'];
$poskod=$_POST['poskod'];
$no_tel=$_POST['no_tel'];
$tarikh_selenggara=$_POST['tarikh_selenggara'];
$masa_selenggara=$_POST['masa_selenggara'];
$pilihan_selenggara=$_POST['pilihan_selenggara'];
$catatan=$_POST['catatan'];
//$id_lantikan=$_POST['id_lantikan'];
			 
mysql_select_db($mysql_database, $bd);
       
$query="UPDATE sej6x_data_selenggara set nama_syarikat='$nama_syarikat',no_pendaftaran='$no_pendaftaran',nama_syarikat='$nama_syarikat',no_pendaftaran='$no_pendaftaran',
nama_pekerja='$nama_pekerja',no_ic='$no_ic',umur='$umur',alamat_syarikat='$alamat_syarikat',negeri='$negeri',daerah='$daerah',poskod='$poskod',no_tel='$no_tel',tarikh_selenggara='$tarikh_selenggara',masa_selenggara='$masa_selenggara',pilihan_selenggara='$pilihan_selenggara',catatan='$catatan' where id_selenggara='$id_selenggara' ";
    
	$test=mysql_query($query, $bd);
	if($test)
	{
		    header("location: ../utama.php?view=maklumatselenggara"); 
	}
	else
	{
		echo mysql_error();
	}

//}


?>