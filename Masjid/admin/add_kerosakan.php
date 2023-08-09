<?php

require_once('../connection/connection.php');
// Connect to server and select database.

    //TABLE SEJ6X_DATA_KEROSAKKAN
    $id_peralatan = $_POST['id_peralatan'];
    $id_penyelenggara = $_POST['id_penyelenggara'];
    $tahap_kerosakan = $_POST['tahap_kerosakan'];
    $kuantiti = $_POST['kuantiti'];
    $kuantiti_unit = $_POST['kuantiti_unit'];
    $tarikh_kerosakan = $_POST['tarikh_kerosakan'];
    $masa_kerosakan = $_POST['masa_kerosakan'];
    $lokasi_kerosakan = $_POST['lokasi_kerosakan'];
    $id_pengesah = $_POST['id_pengesah'];
    $catatan = $_POST['catatan'];

    $query = "INSERT INTO sej6x_data_kerosakkan (id_masjid, id_peralatan, id_penyelenggara, tahap_kerosakan, kuantiti, kuantiti_unit, tarikh_kerosakan, masa_kerosakan, lokasi_kerosakan, id_pengesah, catatan)
              VALUES ('$id_masjid', '$id_peralatan', '$id_penyelenggara', '$tahap_kerosakan', '$kuantiti', '$kuantiti_unit', '$tarikh_kerosakan', '$masa_kerosakan', '$lokasi_kerosakan', '$id_pengesah', '$catatan')";
    $r = mysqli_query($bd2, $query);
    if($r)
    {
        header("Location: ../utama.php?view=admin&action=maklumatkerosakan&sideMenu=masjid");
    }
    else
    {
        echo mysqli_error($bd2);
    }

?>