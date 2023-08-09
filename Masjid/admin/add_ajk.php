<?php
include("../connection/connection.php");
include("../fungsi.php");
// INSERT

if (isset($_POST['id_ajk']) || $_SERVER['REQUEST_METHOD'] == 'POST')
{
	$id_column = 'id_ajk';
	$id_ajk = $_POST['id_ajk'];
	$id_dataajk = $_POST['id_dataajk'];

    $rank = $_POST['index_ajk'];
    $emel = e($_POST['emel'], NULL, NULL);
    $jawatan = e($_POST['jawatan'], NULL, NULL);
    $tarikh_lantikan = e($_POST['tarikh_lantikan'], NULL, NULL);

    $ada_gambar = 0;
    if($_FILES['gambar']['error'] != 4) {
        $gambar = e(base64_encode(file_get_contents(addslashes($_FILES['gambar']['tmp_name']))), NULL, NULL);
        $image = getimagesize(e($_FILES['gambar']['tmp_name'], NULL, NULL));//to know about image type etc
        $jenis_gambar = $image['mime'];
        $ada_gambar = 1;
    }

	if($id_dataajk == NULL) {
        $sql2 = "UPDATE sej6x_data_peribadi SET data_ajk = 1 WHERE id_data = $id_ajk";

        if (strpos($_POST['id_ajk'], 'A-') !== false) {
            $id_column = 'id_ajk2';
            $id_ajk = str_replace('A-', '', $_POST['id_ajk']);
            $sql2 = "UPDATE sej6x_data_anakqariah SET data_ajk = 1 WHERE ID = $id_ajk";
        }

        $sql1 = "INSERT INTO data_ajkmasjid (id_masjid, $id_column, jawatan, tarikh_lantikan, gambar, jenis_gambar, time, `rank`, emel)
	
            VALUES ($id_masjid, $id_ajk, '$jawatan', '$tarikh_lantikan', '$gambar', '$jenis_gambar', NOW(), '$rank', '$emel')";

        //UPDATE STATUS DATA AJK

        mysqli_query($bd2, $sql2) or die(mysqli_error($bd2));
    }

	if($id_dataajk != NULL) {
	    $sql1 = "UPDATE data_ajkmasjid SET emel = '$emel', jawatan = '$jawatan', tarikh_lantikan = '$tarikh_lantikan', time = NOW() WHERE id_dataajk = $id_dataajk";
        if($ada_gambar == 1) {
            $sql3 = "UPDATE data_ajkmasjid SET emel = '$emel', gambar = '$gambar', jenis_gambar = '$jenis_gambar' WHERE id_dataajk = $id_dataajk";
            mysqli_query($bd2, $sql3) or die(mysqli_error($bd2));
        }
    }
	mysqli_query($bd2, $sql1) or die(mysqli_error($bd2));

	header("Location: ../utama.php?view=admin&action=senarai_ajk&sideMenu=organisasi");
}
?>