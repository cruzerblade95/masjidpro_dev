<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
$user_array = array("tahfizte_spmd", "tahfizte_spmdbekap", "tahfizte_spmdbekap2", "tahfizte_spmdbekap3");
$servername = "localhost";
$username = $user_array[rand(0, 3)];
$password = "WebmasterMasjid2019";
$database = "tahfizte_masjidpro";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
    // echo "Connected successfully";
}
//


$servername = "localhost";
$username = $user_array[rand(0, 3)];
$password = "WebmasterMasjid2019";
$database = "tahfizte_masjidpro";

// Create connection
$conn2 = mysqli_connect($servername, $username, $password,$database);

?>