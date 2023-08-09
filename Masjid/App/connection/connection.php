<?php

$mysql_hostname_utama = "localhost";
$mysql_user_utama = "tahfizte_spmd";
$mysql_password_utama = "WebmasterMasjid2019";
$mysql_database_utama = "tahfizte_masjidpro";

$utama_conn2 = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama) or die("Could not connect database utama con2");
mysqli_select_db($utama_conn2, $mysql_database_utama) or die("Could not select database");

$bd = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama) or die("Could not connect database bd");
mysqli_select_db($bd, $mysql_database_utama) or die("Could not select database");

$bd2 = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama) or die("Could not connect database bd2");
mysqli_select_db($bd2, $mysql_database_utama) or die("Could not select database");
?>