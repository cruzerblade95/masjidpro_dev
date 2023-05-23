<?php

include ('../connection/connection.php');

$id_wakaf = $_POST['id_wakaf'];

$tarikhMasa = date("YmdHis");

$sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$id_masjid'";
$query_masjid = mysqli_query($bd2,$sql_masjid);
$data_masjid = mysqli_fetch_array($query_masjid);

$kod_masjid = $data_masjid['kod_masjid'];

$sql_wakaf = "SELECT * FROM wakaf WHERE id_wakaf='$id_wakaf'";
$query_wakaf = mysqli_query($bd2,$sql_wakaf);
$data_wakaf = mysqli_fetch_array($query_wakaf);
$data_qr = $data_wakaf['gambar_qr'];
$data_poster = $data_wakaf['poster_wakaf'];

$path = '../images/wakaf/'.$kod_masjid."/";

if(!is_dir($path)){
    $make_dir = mkdir($path,0777, true);
}
$new_path = str_replace('../','',$path);
$url =  "https://masjidpro.com/Masjid/";
$url_replacePoster = str_replace($url,'../',$data_poster);
$url_replaceQR = str_replace($url,'../',$data_qr);

if(!empty($_FILES['qr']['name'])){
    if($data_qr!=NULL OR $data_qr!="") {
        unlink($url_replaceQR);
    }
    $name_qr = $_FILES['qr']['name'];
    $tmpName_qr = $_FILES['qr']['tmp_name'];
    $extension_qr = pathinfo($_FILES["qr"]["name"], PATHINFO_EXTENSION);
    $qr = "QR_".$tarikhMasa.".".$extension_qr;
    $url_qr = $url.'images/wakaf/'.$kod_masjid.'/'.$qr;
    move_uploaded_file($tmpName_qr, $path.$qr);
}
else{
    $url_qr = $data_qr;
}

if(!empty($_FILES['poster']['name'])){
    if($data_poster!=NULL OR $data_poster!="") {
        unlink($url_replacePoster);
    }
    $name_poster = $_FILES['poster']['name'];
    $tmpName_poster = $_FILES['poster']['tmp_name'];
    $extension_poster = pathinfo($_FILES["poster"]["name"], PATHINFO_EXTENSION);
    $poster = "Poster_".$tarikhMasa.".".$extension_poster;
    $url_poster = $url.'images/wakaf/'.$kod_masjid.'/'.$poster;
    move_uploaded_file($tmpName_poster, $path.$poster);
}
else{
    $url_poster = $data_poster;
}
$nama_wakaf = $_POST['nama_wakaf'];
$description = $_POST['description'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$total_price = $quantity*$price;

$sql = "UPDATE wakaf SET nama_wakaf='$nama_wakaf', description='$description', quantity='$quantity', harga_per_quantity='$price', jumlah_wakaf='$total_price', gambar_qr='$url_qr', poster_wakaf='$url_poster', date_lastUpdated=NOW() WHERE id_wakaf='$id_wakaf'";
$sqlquery = mysqli_query($bd2,$sql);

if($sqlquery){
    header ("Location: ../utama.php?view=admin&action=wakaf");
}
?>