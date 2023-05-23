<?php
require_once('../connection/connection.php');
// Connect to server and select database.
$name= $_FILES['file']['name'];

$tmp_name= $_FILES['file']['tmp_name'];

$submitbutton= $_POST['submit'];

$position= strpos($name, "."); 

$fileextension= substr($name, $position + 1);

$fileextension= strtolower($fileextension);

$id_data=mysql_real_escape_string($_POST['id_data']);
$id_masjid=mysql_real_escape_string($_POST['id_masjid']);
$jenis_zakat=mysql_real_escape_string($_POST['jenis_zakat']);
$no_invoice=mysql_real_escape_string($_POST['no_invoice']);
$fail=mysql_real_escape_string($_POST['fail']);
$tarikh_mohon=mysql_real_escape_string($_POST['tarikh_mohon']);

//tambahan data luar
$nama=mysql_real_escape_string($_POST['nama']);
$no_kp=mysql_real_escape_string($_POST['no_kp']);
$no_phone=mysql_real_escape_string($_POST['no_phone']);

if (isset($name)) {

$path= '../zakat/files/';

if (!empty($name)){
if (move_uploaded_file($tmp_name, $path.$name)) {
echo 'Berjaya!';

}
}
}

//if(!empty($description)){

if(!$_POST['id_data']) $id_data = 0;

$q="INSERT INTO sej6x_data_zakat(id_zakat,id_masjid,id_data,jenis_zakat,no_invoice,tarikh_mohon,file,time, nama, no_kp, no_phone) 
VALUES('',$id_masjid,$id_data,$jenis_zakat,'$no_invoice','$tarikh_mohon','$name',NOW(),'$nama','$no_kp','$no_phone')";

$r = mysql_query($q,$bd);
if($r)
{
header("location: ../utama.php?view=admin&action=senarai_zakat"); 
}
else
{
echo mysql_error();
}
//}

?>