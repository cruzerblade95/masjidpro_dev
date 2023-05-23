<?php
include("../connection/connection.php");
include("../fungsi.php");
// INSERT

    $nama_penuh = e($_POST['nama_penuh'], 1, NULL);
    $no_ic = e($_POST['no_ic'], NULL, NULL);
    $no_tel = e($_POST['no_tel'], NULL, NULL);
    $jawatan = e($_POST['jawatan'], NULL, NULL);

    $sql = "INSERT INTO data_pengurusan_masjid (id_masjid,nama_penuh,no_ic,no_tel,jawatan) VALUES ('$id_masjid','$nama_penuh','$no_ic','$no_tel','$jawatan')";

    $sqlquery = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));

    if($sqlquery) {
        header("Location: ../utama.php?view=admin&action=senarai_pengurusan");
    }

?>
