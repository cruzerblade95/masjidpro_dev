<?php
//header('Content-Type: image/jpeg');
include("connection/connection.php");

$id_pegawai = $_GET['id_pegawai'];

$q = "SELECT gambar,jenis_gambar FROM data_pegawai_masjid where id_pegawai='$id_pegawai'";
$r = mysql_query("$q",$bd);
if($r)
{
$row = mysql_fetch_array($r);
$type = "Content-type: ".$row['jenis_gambar'];
header($type);
echo $row['gambar'];
}
else
{
echo mysql_error();
}

?>

