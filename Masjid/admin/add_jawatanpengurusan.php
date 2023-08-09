<?php

include('../connection/connection.php');

if(isset($_POST['tambah_pengurusan']))
{
    $jawatan_pengurusan = $_POST['jawatan_pengurusan'];
    $kat_jawatankuasa = 'pengurusan';

    $sql1 = "INSERT INTO jawatankuasa_organisasi(id_masjid, kat_jawatankuasa, jawatan) VALUES ('$id_masjid','$kat_jawatankuasa','$jawatan_pengurusan') ";
    $sqlquery1 = mysqli_query($bd2,$sql1);

    if($sqlquery1){
        header("Location: ../utama.php?view=admin&action=organisasi_senaraiPENGURUSAN&sideMenu=organisasi");
    }
}
?>