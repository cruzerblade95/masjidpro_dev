<?php

include('../connection/connection.php');

if(isset($_POST['tambah_pegawai']))
{
    $jawatan_pegawai = $_POST['jawatan_pegawai'];
    $kat_jawatankuasa = 'pegawai';

    $sql1 = "INSERT INTO jawatankuasa_organisasi(id_masjid, kat_jawatankuasa, jawatan) VALUES ('$id_masjid','$kat_jawatankuasa','$jawatan_pegawai') ";
    $sqlquery1 = mysqli_query($bd2,$sql1);

    if($sqlquery1){
        header("Location: ../utama.php?view=admin&action=organisasi_senaraiPEGAWAI&sideMenu=organisasi");
    }
}
?>