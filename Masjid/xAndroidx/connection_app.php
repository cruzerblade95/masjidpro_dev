<?php
session_start();

$mysql_hostname_utama = "localhost";
$mysql_user_utama = "tahfizte_spmd";
$mysql_password_utama = "WebmasterMasjid2019";
$mysql_database_utama = "tahfizte_masjidpro";

//$utama_conn = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama, $mysql_database_utama) or die("Could not connect database");
//$query_db = "SELECT * FROM sej6x_data_masjid WHERE url_masjid LIKE '%$reff_url%'";
//$list_db = mysqli_query($utama_conn, $query_db) or die(mysqli_error($utama_conn));
//$row_list_db = mysqli_fetch_assoc($list_db);
//$id_masjid = $row_list_db['id_masjid'];
//$kod_masjid = $row_list_db['kod_masjid'];
//$nama_masjid = $row_list_db['nama_masjid'];
//$negeri_masjid = $row_list_db['id_negeri'];
//$daerah_masjid = $row_list_db['id_daerah'];

$utama_conn2 = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama) or die("Could not connect database utama con2");
mysqli_select_db($utama_conn2, $mysql_database_utama) or die("Could not select database");

$bd = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama) or die("Could not connect database bd");
mysqli_select_db($bd, $mysql_database_utama) or die("Could not select database");

$bd2 = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama) or die("Could not connect database bd2");
mysqli_select_db($bd2, $mysql_database_utama) or die("Could not select database");
?>