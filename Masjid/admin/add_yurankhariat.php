<?php
require_once('../connection/connection.php');
// Connect to server and select database.

$id_data=$_POST['id_data'];
$pakej=$_POST['pakej'];
$id_jenisbayaran=$_POST['id_jenisbayaran'];
$tarikh_bayaran=$_POST['tarikh_bayaran'];
$jumlah=$_POST['jumlah'];

$id_ajk=$_POST['id_ajk'];
//$time=$_POST['time'];

$q ="INSERT INTO sej6x_data_terimabayaran (id_data,id_masjid,id_jenisbayaran,tarikh_bayaran,jumlah,pakej, jenis_zakat,jenis_wakaf,id_ajk,time)
VALUES($id_data,$id_masjid,$id_jenisbayaran,'$tarikh_bayaran','$jumlah','$pakej','0','0','$id_ajk',NOW())";

$r = mysql_query($q,$bd);
if($r)
{
header("location: ../utama.php?view=admin&action=senarai_pembayar_yurankhariat"); 
}
else
{
echo mysql_error();
}


?>