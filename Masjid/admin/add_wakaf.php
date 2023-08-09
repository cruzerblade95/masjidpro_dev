<?php

include ('../connection/connection.php');

$tarikhMasa = date("YmdHis");

$sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$id_masjid'";
$query_masjid = mysqli_query($bd2,$sql_masjid);
$data_masjid = mysqli_fetch_array($query_masjid);

$kod_masjid = $data_masjid['kod_masjid'];

$sql_wakaf = "SELECT * FROM wakaf WHERE id_masjid='$id_masjid'";
$query_wakaf = mysqli_query($bd2,$sql_wakaf);
$row_wakaf = mysqli_num_rows($query_wakaf);
$row_wakaf = $row_wakaf + 1;

$path = '../images/wakaf/'.$kod_masjid."/";

if(!is_dir($path)){
    $make_dir = mkdir($path,0777, true);
}

$url =  "https://masjidpro.com/Masjid/";

if(!empty($_FILES['qr']['name'])){
    $name_qr = $_FILES['qr']['name'];
    $tmpName_qr = $_FILES['qr']['tmp_name'];
    $extension_qr = pathinfo($_FILES["qr"]["name"], PATHINFO_EXTENSION);
    $qr = "QR_".$tarikhMasa.".".$extension_qr;
    $url_qr = $url.'images/wakaf/'.$kod_masjid.'/'.$qr;
    move_uploaded_file($tmpName_qr, $path.$qr);
}
else{
    $url_qr = '';
}

if(!empty($_FILES['poster']['name'])){
    $name_poster = $_FILES['poster']['name'];
    $tmpName_poster = $_FILES['poster']['tmp_name'];
    $extension_poster = pathinfo($_FILES["poster"]["name"], PATHINFO_EXTENSION);
    $poster = "Poster_".$tarikhMasa.".".$extension_poster;
    $url_poster = $url.'images/wakaf/'.$kod_masjid.'/'.$poster;
    move_uploaded_file($tmpName_poster, $path.$poster);
}
else{
    $url_poster = '';
}
$nama_wakaf = $_POST['nama_wakaf'];
$description = $_POST['description'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$total_price = $quantity*$price;

$sql = "INSERT INTO wakaf (id_masjid,nama_wakaf,description,quantity,harga_per_quantity,jumlah_wakaf,gambar_qr,poster_wakaf,date_added,status) 
VALUES ('$id_masjid','$nama_wakaf','$description','$quantity','$price','$total_price','$url_qr','$url_poster',NOW(),1)";
$sqlquery = mysqli_query($bd2,$sql);

if($sqlquery){
    header ("Location: ../utama.php?view=admin&action=wakaf");
}
?>