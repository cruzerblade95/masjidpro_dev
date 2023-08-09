<?php

include('../connection/connection.php');

if(isset($_POST['tambahTetapan_pegawai']))
{
    $id_masjid = $id_masjid;
    $id_clockin = $_POST['id_clockin'];
    $id_jawatankuasa = $_POST['id_jawatankuasa'];


    $sql1 = "INSERT INTO kehadiran_tetapan(id_masjid, id_jawatankuasa, id_clockin) VALUES ('$id_masjid', '$id_jawatankuasa', '$id_clockin') ";
    $sqlquery1 = mysqli_query($bd2,$sql1);

    if($sqlquery1){
        header("Location: ../utama.php?view=admin&action=organisasi_tetapankehadiran_PEGAWAI&sideMenu=organisasi");
    }
}
?>