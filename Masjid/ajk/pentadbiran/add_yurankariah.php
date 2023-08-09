<?php
require_once('../connection/connection.php');
// Connect to server and select database.

$id_data=$_POST['id_data'];
$id_masjid=$_POST['id_masjid'];
$id_jenisbayaran=$_POST['id_jenisbayaran'];
$tarikh_bayaran=$_POST['tarikh_bayaran'];
$jumlah=$_POST['jumlah'];
$jenis=$_POST['jenis'];

$nama=$_POST['nama'];
$no_kp=$_POST['no_kp'];
$no_phone=$_POST['no_phone'];

if(!$_POST['id_data']) $id_data = 0;

$id_ajk=$_POST['id_ajk'];

$q ="INSERT INTO sej6x_data_terimabayaran(id_data,id_masjid,id_jenisbayaran,tarikh_bayaran,jumlah, pakej, jenis_zakat,jenis_wakaf,id_ajk,time, nama, no_kp, no_phone) VALUES($id_data,$id_masjid,$id_jenisbayaran,'$tarikh_bayaran',$jumlah,'0','0','0',$id_ajk,NOW(), '$nama','$no_kp','$no_phone')";

$r = mysql_query($q,$bd);
if($r)
{
header("location: ../utama.php?view=senarai_pembayar_yurankariah&jenis=".$jenis); 
}
else
{
echo mysql_error();
}


?>