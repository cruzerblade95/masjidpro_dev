<?php
require_once('../connection/connection.php');
include ("../fungsi.php");
// Connect to server and select database.

$jenis_utiliti=e($_POST['jenis_utiliti'], NULL, NULL);
$tarikh_bayaran=e($_POST['tarikh_bayaran'], NULL, NULL);
$harga_bayaran=e($_POST['harga_bayaran'], NULL, NULL);
$ref_resit=e($_POST['ref_resit'], NULL, NULL);
$catatan=e($_POST['catatan'], 1, NULL);

$q ="INSERT INTO sej6x_data_utiliti VALUES('','$id_masjid','$jenis_utiliti','$tarikh_bayaran','$harga_bayaran','$ref_resit','$catatan')";

$r = mysqli_query($bd2, $q);
if($r)
{
header("Location: ../utama.php?view=admin&action=maklumatutiliti");  
}
else
{
echo mysqli_error($bd2);
}


?>