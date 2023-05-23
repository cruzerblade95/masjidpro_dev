<?php
include("../connection/connection.php");
global $url_back, $last_id, $id_mesyuarat, $id_mesyuarat2;
$url_back = "../../Masjid/utama.php?view=admin&action=suratnotis";

// escape string
function e($val){
	global $bd2;
	return mysqli_real_escape_string($bd2, $val);
}

//Error Mesej

function error_mesej() {
	global $url_back;
	echo "<br />Sila masukkan kesemua maklumat yang diperlukan";
	echo '<br /><a href="'.$url_back.'">Kembali ke halaman sebelumnya</a>';

}

// fungsi simpan query

function simpanData($sql_query) {
	global $bd2, $url_back, $last_id;
	if (mysqli_query($bd2, $sql_query)) {
    	echo "<br />Maklumat Berjaya Dipadam/Dikemaskini/Dipadam";
		echo '<br />Query: '.$sql_query;
		$last_id = mysqli_insert_id($bd2);
	}
	else {
    	echo "<br />Ralat: " . mysqli_error($bd2);
		echo '<br />Query: '.$sql_query;
		echo '<br /><a href="'.$url_back.'">Kembali ke halaman sebelumnya</a>';
	}
}

//Semak bilangan array kotak input

$number = count($_POST['id_kehadiran']);
$number2 = count($_POST['id_kehadiran2']);
$number3 = count($_POST['id_kehadiran3']);
$number4 = count($_POST['id_perkara']);
echo($number." - ".$number2." - ".$number3." - ".$number4." - ".$number5);

if($number2_padam > 0) {
 for($j=0; $j<$number2; $j++) {
	 $padam = $_POST['id_khairat_padam'][$j];
     $sql2 = "DELETE FROM sej6x_data_khairat WHERE id_khairat = $padam";
     simpanData("$sql2");
 
 }
}

//Simpan Data Umum Mesyuarat

$id_mesyuarat = e($_POST['id_mesyuarat']);
$id_mesyuarat2 = e($_POST['id_mesyuarat']);
$id_masjid = e($_POST['id_masjid']);
$tajuk = e($_POST['tajuk_meeting']);
$no_rujukan = e($_POST['no_rujukan']);
$tarikh = e($_POST['tarikh']);
$masa = e($_POST['masa']);
$masa_tamat = e($_POST['masa_tamat']);
$tempat = e($_POST['tempat']);
$disediakan = e($_POST['disediakan']);
$disemak = e($_POST['disemak']);
$disahkan = e($_POST['disahkan']);

if($id_mesyuarat == NULL) $sql_data_mesyuarat = "INSERT INTO minit_mesyuarat (id_masjid, tajuk, no_rujukan, tarikh, masa, masa_tamat, tempat, id_disediakan, id_disemak, id_disahkan, last_added) VALUES ($id_masjid, UPPER('$tajuk'), UPPER('$no_rujukan'), '$tarikh', '$masa', '$masa_tamat', '$tempat', $disediakan, $disemak, $disahkan, NOW())";

if($id_mesyuarat != NULL) $sql_data_mesyuarat = "UPDATE minit_mesyuarat SET id_masjid = $id_masjid, tajuk = UPPER('$tajuk'), no_rujukan = UPPER('$no_rujukan'), tarikh = '$tarikh', masa = '$masa', masa_tamat = '$masa_tamat', tempat = '$tempat', id_disediakan = $disediakan, id_disemak = $disemak, id_disahkan = $disahkan, last_added = NOW() WHERE id_mesyuarat = $id_mesyuarat";

simpanData("$sql_data_mesyuarat");
$id_mesyuarat_insert = $last_id;
if($id_mesyuarat == 0 || $id_mesyuarat == NULL || $id_mesyuarat == "") $id_mesyuarat = $id_mesyuarat2;
//Simpan Data Kehadiran AJK

if($number > 0) {
	for($i=0; $i<$number; $i++) {
		$check_value = isset($_POST['tanda_kehadiran'][$i]) ? 1 : 0;
		if($check_value == 1) { 
	 		$id_ajk = e($_POST['id_ajk'][$i]);
			$id_kehadiran = e($_POST['id_kehadiran'][$i]);
			$nama = e($_POST['nama_kehadiran'][$i]);
	 		$jawatan = e($_POST['jawatan_kehadiran'][$i]);
			$jenis_kehadiran = e($_POST['jenis_kehadiran'][$i]);
 			if($id_kehadiran == NULL) $sql_kehadiran_ajk = "INSERT INTO kehadiran_mesyuarat (id_masjid, id_mesyuarat, id_ajk, nama, jawatan, jenis_kehadiran) VALUES ($id_masjid, $id_mesyuarat_insert, $id_ajk, UPPER('$nama'), UPPER('$jawatan'), $jenis_kehadiran)";
 			if($id_kehadiran != NULL) $sql_kehadiran_ajk = "UPDATE kehadiran_mesyuarat SET id_masjid = $id_masjid, id_mesyuarat = $id_mesyuarat, id_ajk = $id_ajk, nama = UPPER('$nama'), jawatan = UPPER('$jawatan'), jenis_kehadiran = $jenis_kehadiran WHERE id_kehadiran = $id_kehadiran";
 simpanData("$sql_kehadiran_ajk");
 		}
 	}
}

if($number < 1) error_mesej();

//Simpan Data Kehadiran Jemputan

if($number2 > 0) {
	for($j=0; $j<$number2; $j++) {
		$id_kehadiran2 = e($_POST['id_kehadiran2'][$j]);
		$nama2 = e($_POST['nama_jemputan'][$j]);
	 	$jawatan2 = e($_POST['jawatan_jemputan'][$j]);
		$jenis_kehadiran2 = e($_POST['jenis_kehadiran2'][$j]);
 		if($id_kehadiran2 == NULL) $sql_kehadiran_jemputan = "INSERT INTO kehadiran_mesyuarat (id_masjid, id_mesyuarat, nama, jawatan, jenis_kehadiran) VALUES ($id_masjid, $id_mesyuarat_insert, UPPER('$nama2'), UPPER('$jawatan2'), $jenis_kehadiran2)";
 		if($id_kehadiran2 != NULL) $sql_kehadiran_jemputan = "UPDATE kehadiran_mesyuarat SET id_masjid = $id_masjid, id_mesyuarat = $id_mesyuarat, nama = UPPER('$nama2'), jawatan = UPPER('$jawatan2'), jenis_kehadiran = $jenis_kehadiran2 WHERE id_kehadiran = $id_kehadiran2";
 simpanData("$sql_kehadiran_jemputan");
 	}
}

if($number2 < 1) error_mesej();

//Simpan Data Kehadiran Urusetia

if($number3 > 0) {
	for($k=0; $k<$number3; $k++) {
		$id_kehadiran3 = e($_POST['id_kehadiran3'][$k]);
		$nama3 = e($_POST['nama_urusetia'][$k]);
	 	$jawatan3 = e($_POST['jawatan_urusetia'][$k]);
		$jenis_kehadiran3 = e($_POST['jenis_kehadiran3'][$k]);
 		if($id_kehadiran3 == NULL) $sql_kehadiran_urusetia = "INSERT INTO kehadiran_mesyuarat (id_masjid, id_mesyuarat, nama, jawatan, jenis_kehadiran) VALUES ($id_masjid, $id_mesyuarat_insert, UPPER('$nama3'), UPPER('$jawatan3'), $jenis_kehadiran3)";
 		if($id_kehadiran3 != NULL) $sql_kehadiran_urusetia = "UPDATE kehadiran_mesyuarat SET id_masjid = $id_masjid, id_mesyuarat = $id_mesyuarat, nama = UPPER('$nama3'), jawatan = UPPER('$jawatan3'), jenis_kehadiran = $jenis_kehadiran3 WHERE id_kehadiran = $id_kehadiran3";
 simpanData("$sql_kehadiran_urusetia");
 	}
}

if($number3 < 1) error_mesej();

//Simpan Data Perkara Mesyuarat

if($number4 > 0) {
	for($l=0; $l<$number4; $l++) {
		$id_perkara = e($_POST['id_perkara'][$l]);
		$tajuk = e($_POST['tajuk'][$l]);
		$perkara_isu = e($_POST['perkara_isu'][$l]);
		$status_tindakan = e($_POST['status_tindakan'][$l]);
 		if($id_perkara == NULL) $sql_perkara = "INSERT INTO perkara_mesyuarat (id_masjid, id_mesyuarat, perkara_isu, status_tindakan, tajuk) VALUES ($id_masjid, $id_mesyuarat_insert, '$perkara_isu', '$status_tindakan', '$tajuk')";
 		if($id_perkara != NULL) $sql_perkara = "UPDATE perkara_mesyuarat SET id_masjid = $id_masjid, id_mesyuarat = $id_mesyuarat, perkara_isu = '$perkara_isu', status_tindakan = '$status_tindakan', tajuk = '$tajuk' WHERE id_perkara = $id_perkara";
 simpanData("$sql_perkara");
 	}
}

if($number4 < 1) error_mesej();

    echo '<br /><a href="'.$url_back.'">Kembali ke halaman sebelumnya</a>';
	mysqli_close($bd2);
	//header('Location: '.$url_back);
    //echo '<script>top.location.href="'.$url_back.'"</script>';
	echo '<a href="'.$url_back.'">Seterusnya</a>'
?> 