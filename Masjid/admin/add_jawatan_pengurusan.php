<?php

include('../connection/connection.php');

if(isset($_POST['submit'])){
    $jawatan = strtoupper($_POST['jawatan']);

    $sql1 = "SELECT * FROM jawatan_pengurusan_masjid WHERE id_masjid='$id_masjid' AND jawatan='$jawatan'";
    $sqlquery1 = mysqli_query($bd2,$sql1);
    $row1 = mysqli_num_rows($sqlquery1);

    if($row1==0) {
        $sql = "INSERT INTO jawatan_pengurusan_masjid (id_masjid,jawatan) VALUES ('$id_masjid','$jawatan')";
        $sqlquery = mysqli_query($bd2, $sql);

        if ($sqlquery) {
            header("Location: ../utama.php?view=admin&action=jawatan_pengurusan");
        }
    }
    else if($row1>0){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Jawatan Sudah Berdaftar');
        window.location.href='utama.php?view=admin&action=jawatan_pengurusan';
        </script>");
    }
}

?>