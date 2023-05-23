<?php
$user_array = array("tahfizte_spmd", "tahfizte_spmdbekap", "tahfizte_spmdbekap2", "tahfizte_spmdbekap3");
$hostname ="localhost";
$user = $user_array[rand(0, 3)];
$password = "WebmasterMasjid2019";
$database = "tahfizte_msjdprokehadiran";


$conn = mysqli_connect($hostname, $user, $password) or die("Could not connect database");
mysqli_select_db($conn, $database) or die("Could not select database");


$conn2 = mysqli_connect($hostname, $user, $password) or die("Could not connect database");
mysqli_select_db($conn2, $database) or die("Could not select database");

?>
