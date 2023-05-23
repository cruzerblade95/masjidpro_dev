<?php
require_once('../connection/connection.php');
// Connect to server and select database.

$id_masjid=$_POST['id_masjid'];
$tarikh_selenggara=$_POST['tarikh_selenggara'];
$masa_selenggara=$_POST['masa_selenggara'];
$pilihan_selenggara=$_POST['pilihan_selenggara'];
$catatan=$_POST['catatan'];

if($_POST['id_pic']==1)
{
    $id_vendor=$_POST['vendor_selenggara'];

    $q ="INSERT INTO sej6x_data_selenggara (id_masjid,id_vendor,tarikh_selenggara,masa_selenggara,pilihan_selenggara,catatan) VALUES ('$id_masjid','$id_vendor','$tarikh_selenggara','$masa_selenggara','$pilihan_selenggara','$catatan')";

}
else if($_POST['id_pic']==2)
{
    $id_ajk=$_POST['ajk_selenggara'];

    $q ="INSERT INTO sej6x_data_selenggara (id_masjid,id_dataajk,tarikh_selenggara,masa_selenggara,pilihan_selenggara,catatan) VALUES ('$id_masjid','$id_ajk','$tarikh_selenggara','$masa_selenggara','$pilihan_selenggara','$catatan')";

}



$r = mysqli_query($bd2, $q);
if($r)
{
header("Location: ../utama.php?view=admin&action=maklumatselenggara");
}
else
{
echo mysqli_error($bd2);
}


?>