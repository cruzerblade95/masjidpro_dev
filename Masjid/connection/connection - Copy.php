<?php
global $bd2;
$mysql_hostname = "localhost";
$mysql_user = "greenap4_masjid";
$mysql_password = "WebmasterMasjid2018";
$mysql_database = "greenap4_masjid";
$prefix = "";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");

$bd2 = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysqli_select_db($bd2, $mysql_database) or die("Could not select database");
?>