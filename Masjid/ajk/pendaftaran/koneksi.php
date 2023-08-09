<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_koneksi = "spmd.tk";
$database_koneksi = "greenap4_masjid";
$username_koneksi = "greenap4_masjid";
$password_koneksi = "WebmasterMasjid2018";
$koneksi = mysql_pconnect($hostname_koneksi, $username_koneksi, $password_koneksi) or trigger_error(mysql_error(),E_USER_ERROR); 
?>