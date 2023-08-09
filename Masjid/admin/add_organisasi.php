<?php
include("../connection/connection.php");
include("../fungsi.php");
// INSERT

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $jenisPengenalan  = $_POST['jenisPengenalan'];
    $id_rekod  = $_POST['id_rekod'];

    $nama_penuh  = e($_POST['nama_penuh'], 1, NULL);
    $nama_penuh = str_replace("'","''",$nama_penuh);
    $no_pengenalan  = e($_POST['no_pengenalan'], NULL, NULL);
    $no_telefon  = e($_POST['no_telefon'], NULL, NULL);
    $emel = e($_POST['emel'], NULL, NULL);
    $kategori_jawatankuasa  = e($_POST['kat_jawatan'], NULL, NULL);
    $id_jawatankuasa  = e($_POST['id_jawatankuasa'], NULL, NULL);
    $tarikh_lantikan  = e($_POST['tarikh_lantikan'], NULL, NULL);

    $sqljawatan = "SELECT jawatan, ajk_biro FROM jawatankuasa_organisasi WHERE id_jawatankuasa = '$id_jawatankuasa'";
    $result = mysqli_query($bd2,$sqljawatan) or die(mysqli_error($bd2));
    $row = mysqli_fetch_assoc($result);
    $jawatan = $row['jawatan'];
    $ajk_biro = $row['ajk_biro'];

    $ada_gambar = 0;
    if($_FILES['gambar']['error'] != 4) {
        $gambar = e(base64_encode(file_get_contents(addslashes($_FILES['gambar']['tmp_name']))), NULL, NULL);
        $image = getimagesize(e($_FILES['gambar']['tmp_name'], NULL, NULL));//to know about image type etc
        $jenis_gambar = $image['mime'];
        $ada_gambar = 1;
    }

//    $name= $_FILES['file']['name'];
//
//    $tmp_name= $_FILES['file']['tmp_name'];
//
//    $submitbutton= $_POST['submit'];
//
//    $position= strpos($name, ".");
//
//    $fileextension= substr($name, $position + 1);
//
//    $fileextension= strtolower($fileextension);
//
//    $description= $_POST['description'];
//    $tarikh=$_POST['tarikh'];
//
//    if (isset($name)) {
//
//        $path= '../Uploads/rekod_organisasi/';
//
//        if (!empty($name)){
//            if (move_uploaded_file($tmp_name, $path.$name)) {
//                echo 'Berjaya!';
//
//            }
//        }
//    }

    $sqlorganisasi = "INSERT INTO rekod_organisasi ( id_rekod, id_masjid, nama_penuh, jenisPengenalan, no_pengenalan, no_telefon, emel, id_jawatankuasa, kategori_jawatankuasa, jawatan, ajk_biro, tarikh_lantikan, gambar, jenis_gambar)
                      VALUES ( '$id_rekod', '$id_masjid', '$nama_penuh', '$jenisPengenalan', '$no_pengenalan', '$no_telefon', '$emel', '$id_jawatankuasa', '$kategori_jawatankuasa', '$jawatan', '$ajk_biro', '$tarikh_lantikan', '$gambar', '$jenis_gambar')";
    mysqli_query($bd2, $sqlorganisasi) or die(mysqli_error($bd2));

    header("Location: ../utama.php?view=admin&action=semakorganisasi&sideMenu=organisasi&success=1");
}