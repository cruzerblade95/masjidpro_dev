<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$isi = file_get_contents("https://mysejahtera.malaysia.gov.my/qrscan/formGeneral.html");
$isi = str_replace('/images/', 'https://mysejahtera.malaysia.gov.my/images/', $isi);
$isi = str_replace('id="chkTruthful"', 'id="chkTruthful" checked', $isi);
if($_GET['nama'] != NULL) $isi = str_replace('id="name"', 'id="name" value="'.$_GET['nama'].'"', $isi);
if($_GET['no_tel'] != NULL) $isi = str_replace('id="contactNumber"', 'id="contactNumber" value="'.$_GET['no_tel'].'"', $isi);

echo $isi;
?>