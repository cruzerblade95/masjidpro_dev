<?php
include("../connection/connection.php");

//if(isset($_POST['update']))
//{
//	echo"masuk";

$id_data = $_POST['id_data'];
echo $id_data;
$nama_penuh = $_POST['nama_penuh_anak'];
$no_ic = $_POST['no_ic_anak'];
$no_hp = $_POST['no_hp_anak'];

$status_perkahwinan = $_POST['statuskahwin_anak'];

$status_oku = $_POST['status_oku'];
$status_sakitkronik = $_POST['status_sakitkronik'];
$status_asnaf = $_POST['status_asnaf'];

$hubungan = $_POST['hubungan'];


mysql_select_db($mysql_database, $bd);

try {
	$query = "update sej6x_data_anakqariah set nama_penuh='$nama_penuh',no_ic='$no_ic',no_tel='$no_hp',
	status_kahwin='$status_perkahwinan',status_oku='$status_oku',
 status_sakitkronik='$status_sakitkronik',status_asnaf='$status_asnaf',hubungan='$hubungan'
 where ID='$id_data'";

	$test = mysql_query($query, $bd);
	if ($test) {
		$message = "Maklumat telah dikemaskini.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("location: ../utama.php?view=admin&action=senarai_anakyatim");
	} else {
		echo mysql_error();
	}
} catch (Exception $e) {
	echo $e->getMessage();
}



//}
