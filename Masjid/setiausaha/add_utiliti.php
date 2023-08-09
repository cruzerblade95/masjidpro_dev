<?php
require_once('../connection/connection.php');
// Connect to server and select database.

$jenis_utiliti=$_POST['jenis_utiliti'];
$tarikh_bayaran=$_POST['tarikh_bayaran'];
$harga_bayaran=$_POST['harga_bayaran'];
$ref_resit=$_POST['ref_resit'];
$catatan=$_POST['catatan'];

$q ="INSERT INTO sej6x_data_utiliti VALUES('','0','$jenis_utiliti','$tarikh_bayaran','$harga_bayaran','$ref_resit','$catatan')";

$r = mysql_query($q,$bd);
if($r)
{
header("Location: ../utama.php?view=admin&action=maklumatutiliti");  
}
else
{
echo mysql_error();
}


?>