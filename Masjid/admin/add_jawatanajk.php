<?php

include('../connection/connection.php');

if(isset($_POST['tambah_ajk']))
{
    $jawatan_ajk = $_POST['jawatan_ajk'];
    $kat_jawatankuasa = 'ajk';

    $sql1 = "INSERT INTO jawatankuasa_organisasi(id_masjid, kat_jawatankuasa, jawatan) VALUES ('$id_masjid','$kat_jawatankuasa','$jawatan_ajk') ";
    $sqlquery1 = mysqli_query($bd2,$sql1);

    if($sqlquery1){
        header("Location: ../utama.php?view=admin&action=organisasi_senaraiAJK&sideMenu=organisasi");
    }
}
?>