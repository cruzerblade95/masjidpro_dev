<?php
require_once('../connection/connection.php');
// Connect to server and select database.

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
$id_lantikan=$_POST['id_lantikan'];

$q ="INSERT INTO sej6x_data_selenggara VALUES('','0','0','$nama_syarikat','$no_pendaftaran','$nama_pekerja','$no_ic','$umur','$alamat_syarikat','$negeri','$daerah','$poskod','$no_tel','$tarikh_selenggara','$masa_selenggara','$pilihan_selenggara','$catatan','0')";

$r = mysql_query($q,$bd);
if($r)
{
header("Location: ../utama.php?view=maklumatselenggara");  
}
else
{
echo mysql_error();
}


?>