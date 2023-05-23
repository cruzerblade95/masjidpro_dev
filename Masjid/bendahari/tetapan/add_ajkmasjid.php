<?php  
require_once('../connection/connection.php');

 if(isset($_POST['ok']))
{ 
$nama_penuh = $_POST['nama_penuh'];
$no_ic = $_POST['no_ic'];	
$umur = $_POST['umur'];
$bangsa = $_POST['bangsa'];
$status_perkahwinan = $_POST['status_perkahwinan'];
$no_tel = $_POST['no_tel'];
$tahap_pendidikan = $_POST['tahap_pendidikan'];
$no_rumah = $_POST['no_rumah'];
$negeri = $_POST['negeri'];
$daerah = $_POST['daerah'];
$poskod = $_POST['poskod'];
//$gambar = $_POST['gambar'];
$pekerjaan = $_POST['pekerjaan'];
$status_pekerjaan = $_POST['status_pekerjaan'];
$majikan = $_POST['majikan'];
$pendapatan = $_POST['pendapatan'];
$lantikan = $_POST['lantikan'];
$tarikh_lantikan = $_POST['tarikh_lantikan'];
$tempoh_lantikan = $_POST['tempoh_lantikan'];

$sql = "INSERT INTO sej6x_data_ajkmasjid 
VALUES('','0','3857','$nama_penuh','$no_ic','$umur',$bangsa','$status_perkahwinan','$no_tel','$tahap_pendidikan',
'$pekerjaan','$majikan','$status_pekerjaan','$pendapatan_bulanan','$no_rumah','$negeri','$daerah','$poskod','0',
'$jawatan_lantikan','$tarikh_lantikan','$tempoh_lantikan')";

$r = mysql_query($sql,$bd);
if($r)
{
echo "Data Masuk";
}
}


?>
