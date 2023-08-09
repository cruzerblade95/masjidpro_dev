<?php
$host = "localhost";
$user1 = "spmd";
$pass1 = "WebmasterMasjid2019";
$db1 = "myrichdy_spmd";

$user2 = "appsmasjid_devspmd";
$pass2 = "AdminDev@2021";
$db2 = "dev_spmd";

$conn1 = mysqli_connect($host, $user1, $pass1, $db1) or die(mysqli_error($conn1));
$conn2 = mysqli_connect($host, $user2, $pass2, $db2) or die(mysqli_error($conn2));

$semak1 = "SELECT id_masjid, no_ic, daerah, negeri, poskod, no_rumah FROM approve_qariah";
$semak1_conn1 = mysqli_query($conn1, $semak1) or die(mysqli_error($conn1));
$semak1_fetch = mysqli_fetch_assoc($semak1_conn1);

$i = 1;
do {
    $id_masjid = $semak1_fetch['id_masjid'];
    $no_ic = $semak1_fetch['no_ic'];
    $daerah = $semak1_fetch['daerah'];
    $negeri = $semak1_fetch['negeri'];
    $poskod = mysqli_real_escape_string($conn2, $semak1_fetch['poskod']);
    $no_rumah = strtoupper(mysqli_real_escape_string($conn2, $semak1_fetch['no_rumah']));
    $update = "UPDATE approve_qariah SET poskod = '$poskod', no_rumah = '$no_rumah' WHERE no_ic = '$no_ic' AND id <= 5992";
    //echo($i.': '.$update.'<br />');
    //mysqli_query($conn2, $update) or die(mysqli_error($conn2));
    $i++;
} while($semak1_fetch = mysqli_fetch_assoc($semak1_conn1));
?>
