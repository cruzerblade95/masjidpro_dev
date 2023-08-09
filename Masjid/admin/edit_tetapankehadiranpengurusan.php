<?php

include('../connection/connection.php');

if(isset($_POST['updateTetapan_pengurusan']))
{
    $id_masjid = $id_masjid;
    $id_clockin = $_POST['id_clockin'];
    $id_kehadiran = $_POST['id_kehadiran'];


    $sql1 = "UPDATE kehadiran_tetapan SET id_clockin = '$id_clockin' WHERE id = '$id_kehadiran'";
    $sqlquery = mysqli_query($bd2,$sql1);

    if($sqlquery){
        header("Location: ../utama.php?view=admin&action=organisasi_tetapankehadiran_PENGURUSAN&sideMenu=organisasi");
    }
}
?>