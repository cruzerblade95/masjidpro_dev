<?php

	include('../connection/connection.php');
	include("../fungsi.php");

	if(isset($_POST['insert']))
	{
		$id_masjid=e($_POST['id_masjid'], NULL, NULL);
		$nama_aktiviti=e($_POST['nama_aktiviti'], 1, NULL);
		$jenis_aktiviti=e($_POST['jenis_aktiviti'], 1, NULL);
		$tarikh=e($_POST['tarikh'], NULL, NULL);
		$masa=e($_POST['masa'], NULL, NULL);
		$lokasi=e($_POST['lokasi'], 1, NULL);
		$month=e($_POST['month'], NULL, NULL);
		$tahun=e($_POST['tahun'], NULL, NULL);
        $nama_penceramah = e($_POST['nama_penceramah'], 1, NULL);
		
		$sql="INSERT INTO sej6x_data_aktiviti (id_masjid,nama_aktiviti,jenis_aktiviti,tarikh,masa,lokasi,nama_penceramah) VALUES ('$id_masjid','$nama_aktiviti','$jenis_aktiviti','$tarikh','$masa','$lokasi','$nama_penceramah')";
		$sqlquery=mysqli_query($bd2,$sql);

        $sql1 = "SELECT * FROM sej6x_data_aktiviti WHERE id_masjid='$id_masjid' AND nama_aktiviti='$nama_aktiviti' AND jenis_aktiviti='$jenis_aktiviti' AND tarikh='$tarikh' AND masa='$masa' AND lokasi='$lokasi' AND nama_penceramah='$nama_penceramah'";
        $sqlquery1 = mysqli_query($bd2,$sql1);
        $data1 = mysqli_fetch_assoc($sqlquery1);

        $id_aktiviti = e($data1['id_aktiviti'], NULL, NULL);

        $count = count($_FILES['fail']['name']);
        if($count>0) {
            for ($i = 0; $i < $count; $i++) {
                if($_FILES['fail']['size'][$i]>0) {
                    $filetype = $_FILES['fail']['type'][$i];
                    $imgData = addslashes(file_get_contents($_FILES['fail']['tmp_name'][$i]));
                    $imageProperties = getimagesize($_FILES['fail']['tmp_name'][$i]);

                    $sql2 = "INSERT INTO sej6x_data_aktivitifail (id_masjid,id_aktiviti,jenis_fail,fail) VALUES ('$id_masjid','$id_aktiviti','$filetype','$imgData')";
                    $sqlquery2 = mysqli_query($bd2, $sql2);
                }
            }
        }

		if($sqlquery)
		{
		    if($month=="" AND $tahun=="")
            {
                header("Location: ../utama.php?view=admin&action=aktiviti");
            }
		    else {
               header("Location: ../utama.php?view=admin&action=aktiviti&month=" . $month . "&tahun=" . $tahun . "&id_masjid=" . $id_masjid);
            }
        }
	}
	
?>