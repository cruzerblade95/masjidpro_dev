<?php
include("../connection/connection.php");
include("../fungsi.php");
// INSERT

    $id = $_POST['id'];

    $nama_penuh = e($_POST['nama_penuh'], 1, NULL);
    $nama_penuh = str_replace("'","''",$nama_penuh);
    $no_pengenalan = e($_POST['no_pengenalan'], NULL, NULL);
    $no_telefon = e($_POST['no_telefon'], NULL, NULL);
    $jawatan = e($_POST['jawatan'], 1, NULL);
    $tarikh_lantikan = e($_POST['tarikh_lantikan'], NULL, NULL);
    $tarikh_perletakan = e($_POST['tarikh_perletakan'], NULL, NULL);
    $sebab_perletakan = e($_POST['sebab_perletakan'], NULL, NULL);

    $sql1 = "UPDATE rekod_organisasi SET nama_penuh = '$nama_penuh', no_pengenalan = '$no_pengenalan', no_telefon = '$no_telefon', jawatan = '$jawatan', tarikh_lantikan = '$tarikh_lantikan', tarikh_perletakan = '$tarikh_perletakan', sebab_perletakan = '$sebab_perletakan', time_update = NOW()
                 WHERE id = $id";

    $test = mysqli_query($bd2, $sql1);

    if($test) {

        header("Location: ../utama.php?view=admin&action=senarai_rekod");
    }
    else {

        echo mysqli_error();
    }
?>
