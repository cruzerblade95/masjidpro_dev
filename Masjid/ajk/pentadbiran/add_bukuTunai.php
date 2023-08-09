<?php
require_once('../connection/connection.php');
// Connect to server and select database.

$jenis_duit=$_POST['jenis_duit'];
$jenis_tabung=$_POST['jenis_tabung'];
$tarikh=$_POST['tarikh'];
$butiran=$_POST['butiran'];
$amount=$_POST['amount'];
$nama_pembayar=$_POST['nama_pembayar'];
$rujukan=$_POST['rujukan'];

$q ="INSERT INTO buku_tunai VALUES('','0','$jenis_duit','$jenis_tabung','$tarikh','$butiran','$amount','$nama_pembayar','$rujukan')";

$r = mysql_query($q,$bd);
if($r)
{
header("Location: ../utama.php?view=laporanpendapatan");  
}
else
{
echo mysql_error();
}


?>