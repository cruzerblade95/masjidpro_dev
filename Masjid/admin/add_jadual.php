<?php

include('../connection/connection.php');

$month=$_POST['month'];
$tahun=$_POST['tahun'];

$i=$_POST['day'];

$tarikh=$_POST['tarikh'];

$sql = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$tarikh'";
$sqlquery = mysqli_query($bd2,$sql1);
$row = mysqli_num_rows($sqlquery);


if($row==15) {
    header("Location: ../utama.php?view=admin&action=jadualkehadiran&month=$month&tahun=$tahun");
}
else if($row==0) {

    $subuh_imam=$_POST['subuh_imam'.$i];
    $subuh_bilal=$_POST['subuh_bilal'.$i];
    $subuh_siak=$_POST['subuh_siak'.$i];

    if($subuh_imam!="") {
        $sql1 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Subuh','Imam','$subuh_imam')";
        $sqlquery1 = mysqli_query($bd2, $sql1);
    }
    if($subuh_bilal!="") {
        $sql2 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Subuh','Bilal','$subuh_bilal')";
        $sqlquery2 = mysqli_query($bd2, $sql2);
    }
    if($subuh_siak!="") {
        $sql3 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Subuh','Siak','$subuh_siak')";
        $sqlquery3 = mysqli_query($bd2, $sql3);
    }

    $zohor_imam = $_POST['zohor_imam' . $i];
    $zohor_bilal = $_POST['zohor_bilal' . $i];
    $zohor_siak = $_POST['zohor_siak' . $i];

    if($zohor_imam!="") {
        $sql4 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Zohor','Imam','$zohor_imam')";
        $sqlquery4 = mysqli_query($bd2, $sql4);
    }
    if($zohor_bilal!="") {
        $sql5 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Zohor','Bilal','$zohor_bilal')";
        $sqlquery5 = mysqli_query($bd2, $sql5);
    }
    if($zohor_siak!="") {
        $sql6 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Zohor','Siak','$zohor_siak')";
        $sqlquery6 = mysqli_query($bd2, $sql6);
    }

    $asar_imam = $_POST['asar_imam' . $i];
    $asar_bilal = $_POST['asar_bilal' . $i];
    $asar_siak = $_POST['asar_siak' . $i];

    if($asar_imam!="") {
        $sql7 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Asar','Imam','$asar_imam')";
        $sqlquery7 = mysqli_query($bd2, $sql7);
    }
    if($asar_bilal!="") {
        $sql8 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Asar','Bilal','$asar_bilal')";
        $sqlquery8 = mysqli_query($bd2, $sql8);
    }
    if($asar_siak!="") {
        $sql9 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Asar','Siak','$asar_siak')";
        $sqlquery9 = mysqli_query($bd2, $sql9);
    }

    $maghrib_imam = $_POST['maghrib_imam' . $i];
    $maghrib_bilal = $_POST['maghrib_bilal' . $i];
    $maghrib_siak = $_POST['maghrib_siak' . $i];

    if($maghrib_imam!="") {
        $sql10 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Maghrib','Imam','$maghrib_imam')";
        $sqlquery10 = mysqli_query($bd2, $sql10);
    }
    if($maghrib_bilal!="") {
        $sql11 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Maghrib','Bilal','$maghrib_bilal')";
        $sqlquery11 = mysqli_query($bd2, $sql11);
    }
    if($maghrib_siak!="") {
        $sql12 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Maghrib','Siak','$maghrib_siak')";
        $sqlquery12 = mysqli_query($bd2, $sql12);
    }

    $isya_imam = $_POST['isya_imam' . $i];
    $isya_bilal = $_POST['isya_bilal' . $i];
    $isya_siak = $_POST['isya_siak' . $i];

    if($isya_imam!="") {
        $sql13 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Isya','Imam','$isya_imam')";
        $sqlquery13 = mysqli_query($bd2, $sql13);
    }
    if($isya_bilal!="") {
        $sql14 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Isya','Bilal','$isya_bilal')";
        $sqlquery14 = mysqli_query($bd2, $sql14);
    }
    if($isya_siak!="") {
        $sql15 = "INSERT INTO sej6x_data_jadual (id_masjid,tarikh,solat,jawatan,id_pegawai) VALUES ('$id_masjid','$tarikh','Isya','Siak','$isya_siak')";
        $sqlquery15 = mysqli_query($bd2, $sql15);
    }

        header("Location: ../utama.php?view=admin&action=jadualkehadiran&month=$month&tahun=$tahun");
}
?>