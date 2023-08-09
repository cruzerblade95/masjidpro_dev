<?php

include('../connection/connection.php');

$month=$_POST['month'];
$tahun=$_POST['tahun'];

$i=$_POST['day'];

$tarikh=$_POST['tarikh'];


$id_subuh_imam = $_POST['id_subuh_imam'.$i];
$id_subuh_bilal = $_POST['id_subuh_bilal'.$i];
$id_subuh_siak = $_POST['id_subuh_siak'.$i];

$subuh_imam = $_POST['subuh_imam'.$i];
$subuh_bilal = $_POST['subuh_bilal'.$i];
$subuh_siak = $_POST['subuh_siak'.$i];

$sql1 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh' AND solat='Subuh' AND jawatan='Imam'";
$sqlquery1 = mysqli_query($bd2,$sql1);
$bil1 = mysqli_num_rows($sqlquery1);

if($bil1>0){
    if($subuh_imam!="") {
        $sql1 = "UPDATE sej6x_data_jadual SET id_pegawai='$subuh_imam' WHERE ID='$id_subuh_imam'";
        $sqlquery1 = mysqli_query($bd2, $sql1);
    }
}
else if($bil==0){
    if($subuh_imam!="") {
        $sql1 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Subuh','Imam','$subuh_imam')";
        $sqlquery1 = mysqli_query($bd2, $sql1);
    }
}

$sql2 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh' AND solat='Subuh' AND jawatan='Bilal'";
$sqlquery2 = mysqli_query($bd2,$sql2);
$bil2 = mysqli_num_rows($sqlquery2);

if($bil2>0){
    if($subuh_bilal!="") {
        $sql2 = "UPDATE sej6x_data_jadual SET id_pegawai='$subuh_bilal' WHERE ID='$id_subuh_bilal'";
        $sqlquery2 = mysqli_query($bd2, $sql2);
    }
}
else if($bil2==0){
    if($subuh_bilal!="") {
        $sql2 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Subuh','Bilal','$subuh_bilal')";
        $sqlquery2 = mysqli_query($bd2, $sql2);
    }
}

$sql3 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh' AND solat='Subuh' AND jawatan='Siak'";
$sqlquery3 = mysqli_query($bd2,$sql3);
$bil3 = mysqli_num_rows($sqlquery3);

if($bil3>0) {
    if($subuh_siak!="") {
        $sql3 = "UPDATE sej6x_data_jadual SET id_pegawai='$subuh_siak' WHERE ID='$id_subuh_siak'";
        $sqlquery3 = mysqli_query($bd2, $sql3);
    }
}
else if($bil3==0){
    if($subuh_siak!="") {
        $sql3 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Subuh','Siak','$subuh_siak')";
        $sqlquery3 = mysqli_query($bd2, $sql3);
    }
}

$id_zohor_imam =$_POST['id_zohor_imam'.$i];
$id_zohor_bilal=$_POST['id_zohor_bilal'.$i];
$id_zohor_siak=$_POST['id_zohor_siak'.$i];

$zohor_imam = $_POST['zohor_imam'.$i];
$zohor_bilal = $_POST['zohor_bilal'.$i];
$zohor_siak = $_POST['zohor_siak'.$i];

$sql4 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh' AND solat='Zohor' AND jawatan='Imam'";
$sqlquery4 = mysqli_query($bd2,$sql4);
$bil4 = mysqli_num_rows($sqlquery4);

if($bil4>0) {
    if($zohor_imam!="") {
        $sql4 = "UPDATE sej6x_data_jadual SET id_pegawai='$zohor_imam' WHERE ID='$id_zohor_imam'";
        $sqlquery4 = mysqli_query($bd2, $sql4);
    }
}
else if($bil4==0){
    if($zohor_imam!="") {
        $sql4 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Zohor','Imam','$zohor_imam')";
        $sqlquery4 = mysqli_query($bd2, $sql4);
    }
}

$sql5 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh' AND solat='Zohor' AND jawatan='Bilal'";
$sqlquery5 = mysqli_query($bd2,$sql5);
$bil5 = mysqli_num_rows($sqlquery5);

if($bil5>0) {
    if($zohor_bilal!="") {
        $sql5 = "UPDATE sej6x_data_jadual SET id_pegawai='$zohor_bilal' WHERE ID='$id_zohor_bilal'";
        $sqlquery5 = mysqli_query($bd2, $sql5);
    }
}
else if($bil5==0){
    if($zohor_bilal!="") {
        $sql5 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Zohor','Bilal','$zohor_bilal')";
        $sqlquery5 = mysqli_query($bd2, $sql5);
    }
}

$sql6 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh' AND solat='Zohor' AND jawatan='Siak'";
$sqlquery6 = mysqli_query($bd2,$sql6);
$bil6 = mysqli_num_rows($sqlquery6);

if($bil6>0) {
    if($zohor_siak!="") {
        $sql6 = "UPDATE sej6x_data_jadual SET id_pegawai='$zohor_siak' WHERE ID='$id_zohor_siak'";
        $sqlquery6 = mysqli_query($bd2, $sql6);
    }
}
else if($bil6==0){
    if($zohor_siak!=""){
        $sql6 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Zohor','Siak','$zohor_siak')";
        $sqlquery6 = mysqli_query($bd2, $sql6);
    }
}

$id_asar_imam =$_POST['id_asar_imam'.$i];
$id_asar_bilal=$_POST['id_asar_bilal'.$i];
$id_asar_siak=$_POST['id_asar_siak'.$i];

$asar_imam = $_POST['asar_imam'.$i];
$asar_bilal = $_POST['asar_bilal'.$i];
$asar_siak = $_POST['asar_siak'.$i];

$sql7 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh' AND solat='Asar' AND jawatan='Imam'";
$sqlquery7 = mysqli_query($bd2,$sql7);
$bil7 = mysqli_num_rows($sqlquery7);

if($bil7>0) {
    if($asar_imam!="") {
        $sql7 = "UPDATE sej6x_data_jadual SET id_pegawai='$asar_imam' WHERE ID='$id_asar_imam'";
        $sqlquery7 = mysqli_query($bd2, $sql7);
    }
}
else if($bil7==0){
    if($asar_imam!=""){
        $sql7 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Asar','Imam','$asar_imam')";
        $sqlquery7 = mysqli_query($bd2, $sql7);
    }
}

$sql8 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh' AND solat='Asar' AND jawatan='Bilal'";
$sqlquery8 = mysqli_query($bd2,$sql8);
$bil8 = mysqli_num_rows($sqlquery8);

if($bil8>0) {
    if($asar_bilal!="") {
        $sql8 = "UPDATE sej6x_data_jadual SET id_pegawai='$asar_bilal' WHERE ID='$id_asar_bilal'";
        $sqlquery8 = mysqli_query($bd2, $sql8);
    }
}
else if($bil8==0){
    if($asar_bilal!="") {
        $sql8 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Asar','Bilal','$asar_bilal')";
        $sqlquery8 = mysqli_query($bd2, $sql8);
    }
}

$sql9 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh' AND solat='Asar' AND jawatan='Siak'";
$sqlquery9 = mysqli_query($bd2,$sql9);
$bil9 = mysqli_num_rows($sqlquery9);

if($bil9>0) {
    if($asar_siak!="") {
        $sql9 = "UPDATE sej6x_data_jadual SET id_pegawai='$asar_siak' WHERE ID='$id_asar_siak'";
        $sqlquery9 = mysqli_query($bd2, $sql9);
    }
}
else if($bil9==0){
    if($asar_siak!=""){
        $sql9 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Asar','Siak','$asar_siak')";
        $sqlquery9 = mysqli_query($bd2, $sql9);
    }
}

$id_maghrib_imam =$_POST['id_maghrib_imam'.$i];
$id_maghrib_bilal=$_POST['id_maghrib_bilal'.$i];
$id_maghrib_siak=$_POST['id_maghrib_siak'.$i];

$maghrib_imam = $_POST['maghrib_imam'.$i];
$maghrib_bilal = $_POST['maghrib_bilal'.$i];
$maghrib_siak = $_POST['maghrib_siak'.$i];

$sql10 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh' AND solat='Maghrib' AND jawatan='Imam'";
$sqlquery10 = mysqli_query($bd2,$sql10);
$bil10 = mysqli_num_rows($sqlquery10);

if($bil10>0) {
    if($maghrib_imam!="") {
        $sql10 = "UPDATE sej6x_data_jadual SET id_pegawai='$maghrib_imam' WHERE ID='$id_maghrib_imam'";
        $sqlquery10 = mysqli_query($bd2, $sql10);
    }
}
else if($bil10==0){
    if($maghrib_imam!=""){
        $sql10 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Maghrib','Imam','$maghrib_imam')";
        $sqlquery10 = mysqli_query($bd2, $sql10);
    }
}

$sql11 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh' AND solat='Maghrib' AND jawatan='Bilal'";
$sqlquery11 = mysqli_query($bd2,$sql11);
$bil11 = mysqli_num_rows($sqlquery11);

if($bil11>0) {
    if($maghrib_bilal!="") {
        $sql11 = "UPDATE sej6x_data_jadual SET id_pegawai='$maghrib_bilal' WHERE ID='$id_maghrib_bilal'";
        $sqlquery11 = mysqli_query($bd2, $sql11);
    }
}
else if($bil11==0) {
    if($maghrib_bilal!=""){
        $sql11 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Maghrib','Bilal','$maghrib_bilal')";
        $sqlquery11 = mysqli_query($bd2, $sql11);
    }
}

$sql12 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh' AND solat='Maghrib' AND jawatan='Siak'";
$sqlquery12 = mysqli_query($bd2,$sql12);
$bil12 = mysqli_num_rows($sqlquery12);

if($bil12>0) {
    if($maghrib_siak!="") {
        $sql12 = "UPDATE sej6x_data_jadual SET id_pegawai='$maghrib_siak' WHERE ID='$id_maghrib_siak'";
        $sqlquery12 = mysqli_query($bd2, $sql12);
    }
}
else if($bil12==0){
    if($maghrib_siak!=""){
        $sql12 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Maghrib','Siak','$maghrib_siak')";
        $sqlquery12 = mysqli_query($bd2, $sql12);
    }
}

$id_isya_imam =$_POST['id_isya_imam'.$i];
$id_isya_bilal=$_POST['id_isya_bilal'.$i];
$id_isya_siak=$_POST['id_isya_siak'.$i];

$isya_imam = $_POST['isya_imam'.$i];
$isya_bilal = $_POST['isya_bilal'.$i];
$isya_siak = $_POST['isya_siak'.$i];

$sql13 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh' AND solat='Isya' AND jawatan='Imam'";
$sqlquery13 = mysqli_query($bd2,$sql13);
$bil13 = mysqli_num_rows($sqlquery13);

if($bil13>0) {
    if($isya_imam!="") {
        $sql13 = "UPDATE sej6x_data_jadual SET id_pegawai='$isya_imam' WHERE ID='$id_isya_imam'";
        $sqlquery13 = mysqli_query($bd2, $sql13);
    }
}
else if($bil13==0){
    if($isya_imam!=""){
        $sql13 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Isya','Imam','$isya_imam')";
        $sqlquery13 = mysqli_query($bd2, $sql13);
    }
}

$sql14 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh' AND solat='Isya' AND jawatan='Bilal'";
$sqlquery14 = mysqli_query($bd2,$sql14);
$bil14 = mysqli_num_rows($sqlquery14);

if($bil14>0) {
    if($isya_bilal!="") {
        $sql14 = "UPDATE sej6x_data_jadual SET id_pegawai='$isya_bilal' WHERE ID='$id_isya_bilal'";
        $sqlquery14 = mysqli_query($bd2, $sql14);
    }
}
else if($bil14==0){
    if($isya_bilal!=""){
        $sql14 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Isya','Bilal','$isya_bilal')";
        $sqlquery14 = mysqli_query($bd2, $sql14);
    }
}

$sql15 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh' AND solat='Isya' AND jawatan='Siak'";
$sqlquery15 = mysqli_query($bd2,$sql15);
$bil15 = mysqli_num_rows($sqlquery15);

if($bil15>0) {
    if($isya_siak!="") {
        $sql15 = "UPDATE sej6x_data_jadual SET id_pegawai='$isya_siak' WHERE ID='$id_isya_siak'";
        $sqlquery = mysqli_query($bd2, $sql15);
    }
}
else if($bil15==0){
    if($isya_siak!=""){
        $sql15 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Isya','Siak','$isya_siak')";
        $sqlquery15 = mysqli_query($bd2, $sql15);
    }
}

    header("Location: ../utama.php?view=admin&action=jadualkehadiran&month=$month&tahun=$tahun");

?>