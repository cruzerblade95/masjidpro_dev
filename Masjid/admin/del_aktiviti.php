<?php

    include('../connection/connection.php');

    $id_aktiviti = $_POST['id_aktiviti'];
    $month = $_POST['bulan'];
    $tahun = $_POST['year'];

    $sql = "DELETE FROM sej6x_data_aktiviti WHERE id_aktiviti='$id_aktiviti'";
    $sqlquery = mysqli_query($bd2,$sql);

    if($sqlquery)
    {
        header("Location:../utama.php?view=admin&action=aktiviti&month=".$month."&tahun=".$tahun."&id_masjid=".$id_masjid);
    }
?>