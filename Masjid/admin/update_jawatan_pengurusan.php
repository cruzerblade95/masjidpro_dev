<?php

include('../connection/connection.php');

$id_jawatan = $_POST['id_jawatan'];
$jawatan = $_POST['jawatan'];

$sql_update = "UPDATE jawatan_pengurusan_masjid SET jawatan='$jawatan' WHERE id_jawatan='$id_jawatan'";
$query_update = mysqli_query($bd2,$sql_update);

if($query_update) {
    echo("<script LANGUAGE='JavaScript'>
        window.alert('Berjaya Dikemaskini');
        window.location.href='../utama.php?view=admin&action=jawatan_pengurusan';
        </script>");
}
?>