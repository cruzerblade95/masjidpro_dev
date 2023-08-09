<?php

include('../connection/connection.php');

if(isset($_POST['tambah_biro']))
{
    $ajk_biro = $_POST['ajk_biro'];
    $kat_jawatankuasa = 'ajk';
    $jawatan = 'ajk';

    $sql1 = "INSERT INTO jawatankuasa_organisasi(id_masjid, kat_jawatankuasa, jawatan, ajk_biro) VALUES ('$id_masjid','$kat_jawatankuasa','$jawatan','$ajk_biro') ";
    $sqlquery1 = mysqli_query($bd2,$sql1);

    if($sqlquery1){
        header("Location: ../utama.php?view=admin&action=organisasi_senaraiBIRO&sideMenu=organisasi");
    }
}
?>