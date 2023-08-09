<?php
header('Content-Type: image/jpeg');
include("connection/connection.php");

$id_ajk = $_GET['id_ajk'];

$q = "SELECT gambar,jenis_gambar FROM data_ajkmasjid where id_ajk='$id_ajk'";
$r = mysql_query("$q",$bd);
if($r)
{
$row = mysql_fetch_array($r);
$type = "Content-type: ".$row['jenis_gambar'];
//header($type);
echo $row['gambar'];
}
else
{
echo mysql_error();
}

?>

