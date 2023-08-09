<?php
global $db, $db_host, $db_user, $db_pass, $conn;

$db_host = "localhost";
$db_user = "tahfizte_spmd";
$db_pass = "WebmasterMasjid2019";
$db = "tahfizte_masjidpro";

$conn = mysqli_connect($db_host, $db_user, $db_pass) or die("Tidak berjaya sambung ke pengkalan data");
mysqli_select_db($conn, $db) or die("Tidak dapat memilih pengkalan data");
?>
