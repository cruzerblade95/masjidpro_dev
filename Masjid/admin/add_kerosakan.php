<?php
require_once('../connection/connection.php');
// Connect to server and select database.

$tarikh_kerosakan=$_POST['tarikh_kerosakan'];
//$hari_kerosakan=$_POST['hari_kerosakan'];
$masa_kerosakan=$_POST['masa_kerosakan'];
$jenis_kerosakan=$_POST['jenis_kerosakan'];
$catatan_kerosakan=$_POST['catatan_kerosakan'];
$catatan_tindakan=$_POST['catatan_tindakan'];

$q ="INSERT INTO sej6x_data_kerosakkan (id_masjid, tarikh_kerosakkan, hari_kerosakan, masa_kerosakan, jenis_kerosakan, catatan_kerosakkan, catatan_tindakkan, id_lantikkan) VALUES('$id_masjid','$tarikh_kerosakan', '0', '$masa_kerosakan','$jenis_kerosakan','$catatan_kerosakan','$catatan_tindakan','0')";

$r = mysqli_query($bd2, $q);
if($r)
{
header("Location: ../utama.php?view=admin&action=maklumatkerosakan");  
}
else
{
echo mysqli_error($bd2);
}

?>