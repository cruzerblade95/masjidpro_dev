<?php
require_once('../connection/connection.php');
// Connect to server and select database.
$name= $_FILES['file']['name'];

$tmp_name= $_FILES['file']['tmp_name'];

$submitbutton= $_POST['submit'];

$position= strpos($name, "."); 

$fileextension= substr($name, $position + 1);

$fileextension= strtolower($fileextension);

$id_data=$_POST['id_data'];
$id_masjid=$_POST['id_masjid'];
$jenis_zakat=$_POST['jenis_zakat'];
$no_invoice=$_POST['no_invoice'];
$fail=$_POST['fail'];
$tarikh_mohon=$_POST['tarikh_mohon'];

//tambahan data luar
$nama=$_POST['nama'];
$no_kp=$_POST['no_kp'];
$no_phone=$_POST['no_phone'];

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

$q="INSERT INTO sej6x_data_zakat(id_masjid,id_data,jenis_zakat,no_invoice,tarikh_mohon,file,time, nama, no_kp, no_phone) 
VALUES($id_masjid,$id_data,$jenis_zakat,'$no_invoice','$tarikh_mohon','$name',NOW(),'$nama','$no_kp','$no_phone')";

$r = mysql_query($q,$bd);
if($r)
{
header("location: ../utama.php?view=senarai_zakat"); 
}
else
{
echo mysql_error();
}
//}

?>