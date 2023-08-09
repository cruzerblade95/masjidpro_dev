<?php

    include('../connection/connection.php');

    $month = $_POST['month'];
    $tahun = $_POST['tahun'];
    $id_aktiviti = $_POST['id_aktiviti'];
    $nama_aktiviti = $_POST['nama_aktiviti'];
    $jenis_aktiviti = $_POST['jenis_aktiviti'];
    $nama_penceramah = $_POST['nama_penceramah'];
    if($nama_penceramah==""){
        $nama_penceramah = NULL;
    }
    $tarikh = $_POST['tarikh'];
    $masa = $_POST['masa'];
    $lokasi = $_POST['lokasi'];

    $sql = "UPDATE sej6x_data_aktiviti SET nama_penceramah='$nama_penceramah', nama_aktiviti='$nama_aktiviti', jenis_aktiviti='$jenis_aktiviti', tarikh='$tarikh', masa='$masa', lokasi='$lokasi' WHERE id_aktiviti='$id_aktiviti'";
    $sqlquery = mysqli_query($bd2,$sql);

    $count = count($_FILES['failBaru']['name']);
    if($count>0) {
        for ($i = 0; $i < $count; $i++) {
            if($_FILES['failBaru']['size'][$i]>0) {
                $filetype = $_FILES['failBaru']['type'][$i];
                $imgData = addslashes(file_get_contents($_FILES['failBaru']['tmp_name'][$i]));
                $imageProperties = getimagesize($_FILES['failBaru']['tmp_name'][$i]);

                $sql2 = "INSERT INTO sej6x_data_aktivitifail (id_masjid,id_aktiviti,jenis_fail,fail) VALUES ('$id_masjid','$id_aktiviti','$filetype','$imgData')";
                $sqlquery2 = mysqli_query($bd2,$sql2);
            }
        }
    }

    if($sqlquery)
    {
        header("Location:../utama.php?view=admin&action=aktiviti&month=".$month."&tahun=".$tahun."&id_masjid=".$id_masjid);
    }

?>