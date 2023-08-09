<?php

include('../connection/connection.php');
include("../fungsi.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tajuk_aktiviti = e($_POST['tajuk_aktiviti'],NULL,NULL);
    $kategori_aktiviti = e($_POST['kategori_aktiviti'],NULL,NULL);
    $tarikh_aktiviti = e($_POST['tarikh_aktiviti'],NULL,NULL);
    $masa_aktiviti = e($_POST['masa_aktiviti'],NULL,NULL);
    $nama_lokasi = e($_POST['nama_lokasi'],NULL,NULL);
    $link_lokasi = e($_POST['link_lokasi'],NULL,NULL);
    $live_platform = e($_POST['live_platform'],NULL,NULL);
    $nama_platform = e($_POST['nama_platform'],NULL,NULL);
    $link_platform = e($_POST['link_platform'],NULL,NULL);
    $ringkasan = e($_POST['ringkasan'],NULL,NULL);

    $ada_poster = 0;
    if($_FILES['poster']['error'] != 4) {
        $poster = e(base64_encode(file_get_contents(addslashes($_FILES['poster']['tmp_name']))), NULL, NULL);
        $image = getimagesize(e($_FILES['poster']['tmp_name'], NULL, NULL));//to know about image type etc
        $jenis_poster = $image['mime'];
        $ada_poster = 1;
    }

    $sqlAktiviti = "INSERT INTO aktiviti (id_masjid, tajuk_aktiviti, tarikh_aktiviti, masa_aktiviti, kategori_aktiviti, nama_lokasi, link_lokasi, live_platform, nama_platform, link_platform, poster, jenis_poster, ringkasan)
                    VALUES ('$id_masjid','$tajuk_aktiviti', '$tarikh_aktiviti', '$masa_aktiviti', '$kategori_aktiviti', '$nama_lokasi', '$link_lokasi', '$live_platform', '$nama_platform', '$link_platform', '$poster', '$jenis_poster','$ringkasan')";
    mysqli_query($bd2, $sqlAktiviti) or die(mysqli_error($bd2));

   header("Location: ../utama.php?view=admin&action=aktivitiMasjid&sideMenu=masjid");
}
?>