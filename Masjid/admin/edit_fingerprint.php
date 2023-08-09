<?php

    include('../connection/connection.php');

    $id_fingerprint = $_POST['id_fingerprint'];
    $id_pegawai = $_POST['id_pegawai'];

    $sql1 = "SELECT * FROM data_pegawai_masjid WHERE (id_masjid='$id_masjid' AND id_fingerprint='$id_fingerprint')";
    $sqlquery1 = mysqli_query($bd2,$sql1);
    $row1 = mysqli_num_rows($sqlquery1);

    if($row1==0) {
        $sql = "UPDATE data_pegawai_masjid SET id_fingerprint='$id_fingerprint' WHERE id_datapegawai='$id_pegawai'";
        $sqlquery = mysqli_query($bd2, $sql);
    }
    else if($row1>0){
        ?>
        <script LANGUAGE='JavaScript'>
            window.alert('Duplicate ID Fingerprint');
            window.location.href='../utama.php?view=admin&action=kehadiran';
        </script>
        <?php
    }

    if($sqlquery==1)
    {
        header("Location:../utama.php?view=admin&action=kehadiran");
    }
?>