<?php
session_start();

global $bd2, $reff_url;

if(isset($_POST['selection'])){
$reff_url = $_POST['selection'];
}
else{
$reff_url = $_SERVER['HTTP_REFERER'];
}
$reff_url = str_replace('http://www.', '', $reff_url);
$reff_url = str_replace('https://www.', '', $reff_url);
$reff_url = str_replace('http://', '', $reff_url);
$reff_url = str_replace('https://', '', $reff_url);
$reff_url = strstr($reff_url, '/' , true);

if($_SESSION["website"] != NULL) $reff_url = $_SESSION['website'];
if($reff_url2 != NULL) $reff_url = $reff_url2;
if(isset($_POST['website'])) $reff_url = $_POST['website'];

$mysql_hostname_utama = "localhost";
$mysql_user_utama = "tahfizte_spmd";
$mysql_password_utama = "WebmasterMasjid2019";
$mysql_database_utama = "tahfizte_masjidpro";

$utama_conn = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama, $mysql_database_utama) or die("Could not connect database");
$query_db = "SELECT * FROM sej6x_data_masjid WHERE url_masjid LIKE '%$reff_url%'";
$list_db = mysqli_query($utama_conn, $query_db) or die(mysqli_error($utama_conn));
$row_list_db = mysqli_fetch_assoc($list_db);
$mysql_hostname = $row_list_db['db_host'];
$mysql_user = $row_list_db['db_uname'];
$mysql_password = $row_list_db['db_pass'];
$mysql_database = $row_list_db['db_name'];
$id_masjid = $row_list_db['id_masjid'];
$kod_masjid = $row_list_db['kod_masjid'];
$nama_masjid = $row_list_db['nama_masjid'];
$negeri_masjid = $row_list_db['id_negeri'];
$daerah_masjid = $row_list_db['id_daerah'];
$url_masjid = $row_list_db['url_masjid'];
if(mysqli_num_rows($list_db) > 0 && $reff_url2 == NULL) $_SESSION["website"] = $reff_url;
if(mysqli_num_rows($list_db) > 0 && $reff_url2 != NULL) $reff_url2 = $reff_url;
$prefix = "";

$utama_conn2 = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama) or die("Could not connect database");
mysqli_select_db($utama_conn2, $mysql_database_utama) or die("Could not select database");

$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database"."-".$reff_url."-".$reff_url2);
mysqli_select_db($bd, $mysql_database) or die("Could not select database");

$bd2 = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database"."-".$reff_url."-".$reff_url2);
mysqli_select_db($bd2, $mysql_database) or die("Could not select database");
?>