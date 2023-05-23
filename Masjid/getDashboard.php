<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-Type: application/json; charset=UTF-8");
session_start();

if($_SESSION['id_masjid'] != NULL) {
    // Dapatkan dashboard data guna curl
    $auth = $_GET['auth'];
    $info = $_GET['info'];
    $url = "https://dashboard.masjidpro.com/dataKariah?diluluskan=1&auth=$auth&views=json&info=$info";
    $headers = array(
        "referer2: https://dashboard.masjidpro.com",
        "origin2: https://dashboard.masjidpro.com",
    );

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

//for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $JSONdata = curl_exec($curl);
    curl_close($curl);
//var_dump($JSONdata);
    echo($JSONdata);
}
?>