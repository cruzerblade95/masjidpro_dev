<?php

include('../connection/connection.php');

if(isset($_POST['id_zon'])){
    $nama_zon = $_POST['nama_zon'];
    $no_huruf = $_POST['no_huruf'];

    $id_zon = $_POST['id_zon'];

    echo $sql_zon = "UPDATE sej6x_data_zonqariah SET nama_zon='$nama_zon', no_huruf='$no_huruf' WHERE id_zonqariah='$id_zon'";
    $query_zon = mysqli_query($bd2,$sql_zon);

    if($query_zon){
        echo '<script>alert("Maklumat Zon Berjaya Dikemaskini");window.location.href="../utama.php?view=admin&action=profil&sideMenu=masjid";</script>';
    }
}

?>