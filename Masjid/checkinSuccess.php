<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$isi = file_get_contents("https://mysejahtera.malaysia.gov.my/qrscan/checkinSuccess.html");
$isi = str_replace('/images/', 'https://mysejahtera.malaysia.gov.my/images/', $isi);
//$isi = str_replace('id="location">', 'id="location">'.$location, $isi);
//$isi = str_replace('id="displayName">', 'id="displayName">'.$name, $isi);
//$isi = str_replace('id="contact">', 'id="contact">'.$contact, $isi);
//$isi = str_replace('id="date">', 'id="date">'.$date, $isi);
//$isi = str_replace('id="time">', 'id="time">'.$time, $isi);
//$isi = str_replace('id="status">', 'id="status">Low', $isi);

echo $isi
?>