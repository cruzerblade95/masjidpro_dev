<?php
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if($_GET['nama'] != NULL) $nama = $_GET['nama'];
if($_GET['no_tel'] != NULL) $no_tel = $_GET['no_tel'];
if($_GET['data'] != NULL) {
    $data = $_GET['data'];
    $json_data = json_decode(base64_decode($data), true);
    $location = $json_data['location'];
    $name = $json_data['name'];
    $contact = $json_data['contact'];
    $createdDate = $json_data['createdDate'];
    $createdDate = str_replace('T', ' ', $createdDate);
    $createdDate = str_replace('Z', '', $createdDate);
    $tarikh_qr = date_format(date_create($createdDate), 'M j, Y');
    $masa_qr = date_format(date_create($createdDate), 'g:i:s a');
}

$lld = $_GET['lId'];
$eln = $_GET['eln'];

$isi = file_get_contents("https://mysejahtera.malaysia.gov.my/qrscan");
$isi = str_replace('/images/', 'https://mysejahtera.malaysia.gov.my/images/', $isi);
$isi = str_replace('/css/', 'https://mysejahtera.malaysia.gov.my/css/', $isi);
$isi = str_replace('/js/', 'https://mysejahtera.malaysia.gov.my/js/', $isi);
if($_GET['data'] != NULL) $isi = str_replace("formGeneral.html", "checkinSuccess.php", $isi);
else $isi = str_replace("formGeneral.html", "formGeneral.php?nama=$nama&no_tel=$no_tel", $isi);
$isi = str_replace("checkinSuccess.html", "checkinSuccess.php?data=$data", $isi);
if($_GET['rekod'] == 1) $isi = str_replace('"/clockinSec"', '"/clockin.php?rekod=1"', $isi);
else $isi = str_replace('"/clockinSec"', '"/clockin.php"', $isi);
$isi = str_replace('"https://" + window.location.host', '"https://masjidpro.com/Masjid"', $isi);
$isi = str_replace('margin-top: 100px;', '', $isi);
//$isi = str_replace('class="row justify-content-center"', 'style="margin-left: -35px; margin-right: -35px" class="row justify-content-center"', $isi);
if($_GET['nama'] != NULL && $_GET['no_tel'] != NULL) {
    //$auto_cari = "afterFormInit();";
    //$ganti = $auto_cari."\r\n".'document.getElementById("btnSubmit").click();'."\r\n";
    //$ganti = $auto_cari . "showLoader('btnSubmit');submitCheckInDetails();";
    //$ganti = $auto_cari . "submitCheckInDetails();";
    //$isi = str_replace($auto_cari, $ganti, $isi);
}
if($_GET['data'] != NULL) {
    $auto_cari = "afterFormInit();";
    $ganti = $auto_cari."\r\n".'document.getElementById("btnSubmit").click();'."\r\n";
    $ganti .= "document.getElementById('location').innerHTML = '$location';
            document.getElementById('displayName').innerHTML = '$name';
            document.getElementById('contact').innerHTML = '$contact';
            document.getElementById('date').innerHTML = '$tarikh_qr';
			document.getElementById('time').innerHTML = '$masa_qr';
			document.getElementById('status').innerHTML = 'Low';";
    $isi = str_replace($auto_cari, $ganti, $isi);
    $isi = str_replace('dataJSON.userStatus', '"LOW"', $isi);
    $isi = str_replace('formattedDate(null)', '"'.$tarikh_qr.'"', $isi);
    $isi = str_replace('formattedTime(null)', '"'.$masa_qr.'"', $isi);
//    $isi = str_replace('jsonData.date = formattedDate(null)', 'jsonData.date = "'.$tarikh_qr.'"', $isi);
//    $isi = str_replace('jsonData.time = formattedTime(null)', 'jsonData.time = "'.$masa_qr.'"', $isi);
}
$isi_dua = '
<script>document.getElementById("formContainer").style.display = "";
document.getElementById("navbar").style.display = "none";
</script></body>';
$isi = str_replace('</body>', $isi_dua, $isi);
echo $isi;
?>
