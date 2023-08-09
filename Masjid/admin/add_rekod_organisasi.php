<?php
use function Verot\Upload\uploadFile;
include("../connection/connection.php");
// INSERT

if (isset($_POST['id_rekod'])) {

    $id_rekod = $_POST['id_rekod'];
    $nama_penuh = e($_POST['nama_penuh'], 1, NULL);
    $nama_penuh = str_replace("'","''",$nama_penuh);
    $no_pengenalan = e($_POST['no_pengenalan'], NULL, NULL);
    $no_telefon = e($_POST['no_telefon'], NULL, NULL);
    $emel = e($_POST['emel'], NULL, NULL);
    $kat_jawatan = e($_POST['kat_jawatan'], NULL, NULL);
    $id_jawatankuasa = e($_POST['id_jawatankuasa'], NULL, NULL);
    $tarikh_lantikan = e($_POST['tarikh_lantikan'], NULL, NULL);

    $sqljawatan = "SELECT jawatan FROM jawatankuasa_organisasi WHERE id_jawatankuasa = '$id_jawatankuasa'";
    $result = mysqli_query($bd2,$sqljawatan) or die(mysqli_error($bd2));
    $row = mysqli_fetch_assoc($result);
    $jawatan = $row['jawatan'];

    $gambar = uploadFile('gambar', 'file', 'rekod_organisasi');
    // Update nama file di database sekiranya berjaya upload
    if ($gambar != "0") {
            $gambar_col = "gambar";
            $gambar_val = "'$gambar'";

    }

    $sql = "INSERT INTO rekod_organisasi ( id_rekod, id_masjid, nama_penuh, no_pengenalan, no_telefon, emel, id_jawatankuasa, kategori_jawatankuasa, jawatan, tarikh_lantikan, $gambar_col) 
            VALUES ('$id_rekod', '$id_masjid', '$nama_penuh', '$no_pengenalan', '$no_telefon', '$emel', '$id_jawatankuasa', '$kat_jawatan', '$jawatan', '$tarikh_lantikan', $gambar_val)";
    mysqli_query($bd2, $sql) or die(mysqli_error($bd2));

    header("Location: ../utama.php?view=admin&action=semakorganisasi&sideMenu=organisasi");

} else {

    $id_rekod = 0;
    $nama_penuh = e($_POST['nama_penuh'], 1, NULL);
    $nama_penuh = str_replace("'","''",$nama_penuh);
    $no_pengenalan = e($_POST['no_pengenalan'], NULL, NULL);
    $no_telefon = e($_POST['no_telefon'], NULL, NULL);
    $emel = e($_POST['emel'], NULL, NULL);
    $kat_jawatan = e($_POST['kat_jawatan'], NULL, NULL);
    $id_jawatankuasa = e($_POST['id_jawatankuasa'], NULL, NULL);
    $tarikh_lantikan = e($_POST['tarikh_lantikan'], NULL, NULL);

    $sqljawatan1 = "SELECT jawatan FROM jawatankuasa_organisasi WHERE id_jawatankuasa = '$id_jawatankuasa'";
    $result1 = mysqli_query($bd2,$sqljawatan1) or die(mysqli_error($bd2));
    $row1 = mysqli_fetch_assoc($result1);
    $jawatan = $row1['jawatan'];

    $gambar = uploadFile('gambar', 'file', 'rekod_organisasi');
    // Update nama file di database sekiranya berjaya upload
    if ($gambar != "0") {
        $gambar_col = "gambar";
        $gambar_val = "'$gambar'";

    }

    $sql1 = "INSERT INTO rekod_organisasi ( id_rekod, id_masjid, nama_penuh, no_pengenalan, no_telefon, emel, id_jawatankuasa, kategori_jawatankuasa, jawatan, tarikh_lantikan, $gambar_col) 
            VALUES ('$id_rekod', '$id_masjid', '$nama_penuh', '$no_pengenalan', '$no_telefon', '$emel', '$id_jawatankuasa', '$kat_jawatan', '$jawatan', '$tarikh_lantikan', $gambar_val)";
    mysqli_query($bd2, $sql1) or die(mysqli_error($bd2));

    header("Location: ../utama.php?view=admin&action=semakorganisasi&sideMenu=organisasi");
}
?>
