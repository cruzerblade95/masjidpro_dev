<?php
require_once('../connection/connection.php');
// Connect to server and select database.

$jenis_inventori=$_POST['jenis_inventori'];
$nama_inventori=$_POST['nama_inventori'];
$tarikh_belian=$_POST['tarikh_belian'];
$kuantiti=$_POST['kuantiti'];
$peratus=$_POST['peratus'];
$bil_tahun=$_POST['bil_tahun'];
$harga_belian=$_POST['harga_belian'];
$no_rujukan=$_POST['no_rujukan'];
$catatan=$_POST['catatan'];

$q ="INSERT INTO sej6x_data_inventori VALUES('','0','$jenis_inventori','$nama_inventori','$tarikh_belian','$kuantiti','$harga_belian','0','0','$no_rujukan','$catatan','0','0')";

$r = mysql_query($q,$bd);
if($r)
{
header("Location: ../utama.php?view=admin&action=maklumatinventori");  
}
else
{
echo mysql_error();
}


?>