<?php
include("../connection/connection.php");
include("../fungsi.php");
// UPDATE

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $nokuasa  = $_POST['nokuasa'];
    $id_organisasi  = $_POST['id_organisasi'];

    $nama_penuh  = e($_POST['nama_penuh'], 1, NULL);
    $nama_penuh = str_replace("'","''",$nama_penuh);
    $no_pengenalan  = e($_POST['no_pengenalan'], NULL, NULL);
    $no_telefon  = e($_POST['no_telefon'], NULL, NULL);
    $emel = e($_POST['emel'], NULL, NULL);
    $kategori_jawatankuasa  = e($_POST['kategori_jawatankuasa'], NULL, NULL);
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


    $sqlupdate = "UPDATE rekod_organisasi SET nama_penuh ='$nama_penuh',no_pengenalan='$no_pengenalan',no_telefon='$no_telefon',
            emel='$emel',id_jawatankuasa='$id_jawatankuasa',kategori_jawatankuasa='$kategori_jawatankuasa',jawatan='$jawatan', ajk_biro = '$ajk_biro',
            tarikh_lantikan='$tarikh_lantikan' WHERE id = '$id_organisasi'";
    if($ada_gambar == 1) {
        $sqlupdate1 = "UPDATE rekod_organisasi SET gambar = '$gambar', jenis_gambar = '$jenis_gambar' WHERE id = '$id_organisasi'";
        mysqli_query($bd2, $sqlupdate1 ) or die(mysqli_error($bd2));
    }
    $up = mysqli_query($bd2, $sqlupdate);

    if($up){
        if($nokuasa == '1'){
            header("Location: ../utama.php?view=admin&action=view_jawatankuasa&id_organisasi=$id_organisasi&nokuasa=$nokuasa&sideMenu=organisasi");
        }
        else if($nokuasa == '2'){
            header("Location: ../utama.php?view=admin&action=view_jawatankuasa&id_organisasi=$id_organisasi&nokuasa=$nokuasa&sideMenu=organisasi");
        }
        else {
            header("Location: ../utama.php?view=admin&action=view_jawatankuasa&id_organisasi=$id_organisasi&nokuasa=$nokuasa&sideMenu=organisasi");
        }
        echo mysqli_error($bd2);
    }
}