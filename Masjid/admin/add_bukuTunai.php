<?php
require_once('../connection/connection.php');
// Connect to server and select database.

$jenis_duit=$_POST['jenis_duit'];
$jenis_tabung=$_POST['jenis_tabung'];
$jenis_program=$_POST['jenis_program'];
$tarikh=$_POST['tarikh'];
$butiran=$_POST['butiran'];
$amount=$_POST['amount'];
$nama_pembayar=$_POST['nama_pembayar'];
$rujukan=$_POST['rujukan'];

$q ="INSERT INTO buku_tunai VALUES('','$id_masjid','$jenis_duit','$jenis_tabung','$jenis_program','$tarikh','$butiran','$amount','$nama_pembayar','$rujukan')";

$r = mysql_query($q,$bd);
if($r)
{
header("Location: ../utama.php?view=admin&action=laporanpendapatan");  
}
else
{
echo mysql_error();
}


?>