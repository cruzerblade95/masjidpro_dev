<?php
include("../connection/connection.php");
include("../fungsi.php");
// INSERT

if (isset($_POST['id_pegawai']))
{

    $id_column = 'id_pegawai';
    $id_pegawai = $_POST['id_pegawai'];
    $id_datapegawai = $_POST['id_datapegawai'];
    $jawatan = e($_POST['jawatan'], NULL, NULL);
    $pekerjaan = e($_POST['pekerjaan '], 1, NULL);
    $lantikkan = e($_POST['lantikkan'], NULL, NULL);
    $tarikh_lantikan = e($_POST['tarikh_lantikan'], NULL, NULL);

    $ada_gambar = 0;
    if($_FILES['gambar']['error'] != 4) {
        $gambar = e(base64_encode(file_get_contents(addslashes($_FILES['gambar']['tmp_name']))), NULL, NULL);
        $image = getimagesize(e($_FILES['gambar']['tmp_name']));//to know about image type etc
        $jenis_gambar = $image['mime'];
        $ada_gambar = 1;
    }

    if($id_datapegawai == NULL) {
        if(isset($_POST['nama_penuh']) AND isset($_POST['no_ic']) AND isset($_POST['no_tel'])){
            $nama_penuh = e($_POST['nama_penuh'], 1, NULL);
            $nama_penuh = str_replace("'","''",$nama_penuh);
            $no_ic = e($_POST['no_ic'], NULL, NULL);
            $no_tel = e($_POST['no_tel'], NULL, NULL);
            $sql1 = "INSERT INTO data_pegawai_masjid (id_masjid, nama_penuh, no_ic, no_tel, jawatan, tarikh_lantikan, gambar, jenis_gambar, time, lantikkan, pekerjaan)
                       VALUES ($id_masjid, '$nama_penuh', '$no_ic', '$no_tel','$jawatan', '$tarikh_lantikan', '$gambar', '$jenis_gambar', NOW(), '$lantikkan', '$pekerjaan')";
        }
        else {
            $sql2 = "UPDATE sej6x_data_peribadi SET data_pegawai = 1 WHERE id_data = $id_pegawai";

            if (strpos($_POST['id_pegawai'], 'A-') !== false) {
                $id_column = 'id_pegawai2';
                $id_pegawai = str_replace('A-', '', $_POST['id_pegawai']);
                $sql2 = "UPDATE sej6x_data_anakqariah SET data_pegawai = 1 WHERE ID = $id_pegawai";
            }

            $sql1 = "INSERT INTO data_pegawai_masjid (id_masjid, $id_column, jawatan, tarikh_lantikan, gambar, jenis_gambar, time, lantikkan)
	
            VALUES ($id_masjid, $id_pegawai, '$jawatan', '$tarikh_lantikan', '$gambar', '$jenis_gambar', NOW(), '$lantikkan')";

            //UPDATE STATUS DATA PEGAWAI

            mysqli_query($bd2, $sql2) or die(mysqli_error($bd2));
        }
    }

    if($id_datapegawai != NULL) {
        $sql1 = "UPDATE data_pegawai_masjid SET lantikkan = '$lantikkan', pekerjaan = '$pekerjaan', jawatan = '$jawatan', tarikh_lantikan = '$tarikh_lantikan', time = NOW() WHERE id_datapegawai = $id_datapegawai";
        if($ada_gambar == 1) {
            $sql3 = "UPDATE data_pegawai_masjid SET lantikkan = '$lantikkan', pekerjaan = '$pekerjaan', gambar = '$gambar', jenis_gambar = '$jenis_gambar' WHERE id_datapegawai = $id_datapegawai";
            mysqli_query($bd2, $sql3) or die(mysqli_error($bd2));
        }
    }
    mysqli_query($bd2, $sql1) or die(mysqli_error($bd2));

    header("Location: ../utama.php?view=admin&action=senarai_pegawai");
}
?>
