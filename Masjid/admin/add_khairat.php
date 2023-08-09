<?php
include("../connection/connection.php");

// escape string
function e($val){
	global $bd2;
	return mysqli_real_escape_string($bd2, $val);
}

$number = count($_POST['id_khairat']);
$number2 = count($_POST['id_khairat_padam']);
echo($number." - ".$number2);
$url_back = $_POST['url_back'];

if($number2 > 0) {
 for($j=0; $j<$number2; $j++) {
	 $padam = $_POST['id_khairat_padam'][$j];
     $sql2 = "DELETE FROM sej6x_data_khairat WHERE id_khairat = $padam";
 if (mysqli_query($bd2, $sql2)) {
    echo "<br />Maklumat Berjaya Dipadam";
	echo '<br />Query: '.$sql2;
} else {
    echo "<br />Ralat: " . mysqli_error($bd2);
	echo '<br />Query: '.$sql2;
	echo '<br /><a href="'.$url_back.'">Kembali ke halaman sebelumnya</a>';
}
 
 }
}

if($number > 0)
{
 for($i=0; $i<$number; $i++)
 {
	 $id_masjid = e($_POST['id_masjid']);
	 $id_data = e($_POST['id_data']);
	 $pakej2 = e($_POST['pakej2']);
	 $id_khairat = e($_POST['id_khairat'][$i]);
	 $nama = e($_POST['nama'][$i]);
	 $hubungan = e($_POST['hubungan'][$i]);
	 $tarikh_lahir = e($_POST['tarikh_lahir'][$i]);
	 $no_kp = e($_POST['no_kp'][$i]);
 if($id_khairat < 1) $sql = "INSERT INTO sej6x_data_khairat (id_data, id_masjid, pakej, nama, hubungan, tarikh_lahir, no_kp, time) VALUES ($id_data, $id_masjid, $pakej2, UPPER('$nama'), '$hubungan', '$tarikh_lahir', '$no_kp', NOW())";
 if($id_khairat > 0) $sql = "UPDATE sej6x_data_khairat SET id_data = $id_data, id_masjid = $id_masjid, pakej = $pakej2, nama = UPPER('$nama'), hubungan = '$hubungan', tarikh_lahir = '$tarikh_lahir', no_kp = '$no_kp', time = NOW() WHERE id_khairat = $id_khairat";
 if (mysqli_query($bd2, $sql)) {
    echo "<br />Maklumat Berjaya Disimpan";
	echo '<br />Query: '.$sql;
} else {
    echo "<br />Ralat: " . mysqli_error($bd2);
	echo '<br />Query: '.$sql;
	echo '<br /><a href="'.$url_back.'">Kembali ke halaman sebelumnya</a>';
}
 //}
 }
}
else
{
 echo "<br />Sila masukkan kesemua maklumat yang diperlukan";
 echo '<br /><a href="'.$url_back.'">Kembali ke halaman sebelumnya</a>';
}

    echo '<br /><a href="'.$url_back.'">Kembali ke halaman sebelumnya</a>';
	mysqli_close($bd2);
	header("Location: ".$url_back);
	
?> 
