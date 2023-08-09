<?php

include('../connection/connection.php');

if(isset($_POST['form_ic']))
{
	$id_masjid = $_POST['id_masjid'];
	$idd = $_POST['id_data'];
	$no_ic = $_POST['no_ic'];
	$jenis_bantuan = $_POST['jenis_bantuan'];
	$tarikh_bantuan = $_POST['tarikh_bantuan'];
	$kaedah_bayar = $_POST['kaedah_bayar'];
	$amaun_bantuan = $_POST['amaun_bantuan'];
	if(strpos($idd, 'A-') !== true) $sql = "INSERT INTO bantuan_zakat (id_masjid,id_data,no_ic,jenis_bantuan,tarikh_bantuan,kaedah_bayar,amaun,status_bantuan) VALUES ('$id_masjid','$idd','$no_ic','$jenis_bantuan','$tarikh_bantuan','$kaedah_bayar','$amaun_bantuan','1')";
	if(strpos($idd, 'A-') !== false) {
		$idd = str_replace('A-', '', $_POST['id_data']);
		$sql = "INSERT INTO bantuan_zakat (id_masjid,ID,no_ic,jenis_bantuan,tarikh_bantuan,kaedah_bayar,amaun,status_bantuan) VALUES ('$id_masjid','$idd','$no_ic','$jenis_bantuan','$tarikh_bantuan','$kaedah_bayar','$amaun_bantuan','1')";
	}
	$query = mysqli_query($bd2,$sql);
	
	if($query)
	{
		header("Location: ../utama.php?view=admin&action=bantuan&no_ic=".$no_ic);
	}
}
if(isset($_POST['form_passport']))
{
	$id_masjid = $_POST['id_masjid'];
	$nama_penuh = $_POST['nama_penuh'];
	$no_passport = $_POST['no_passport'];
	$no_tel = $_POST['no_tel'];
	$status_perkahwinan = $_POST['status_perkahwinan'];
	$alamat_terkini = $_POST['alamat_terkini'];
	$id_negeri = $_POST['id_negeri'];
	$id_daerah = $_POST['id_daerah'];
	$poskod = $_POST['poskod'];
	$jenis_bantuan = $_POST['jenis_bantuan'];
	$tarikh_bantuan = $_POST['tarikh_bantuan'];
	$kaedah_bayar = $_POST['kaedah_bayar'];
	$amaun_bantuan = $_POST['amaun_bantuan'];

	$sql = "INSERT INTO bantuan_zakat (id_masjid,no_passport,nama_penuh,no_tel,status_perkahwinan,alamat_terkini,id_negeri,id_daerah,poskod,jenis_bantuan,tarikh_bantuan,kaedah_bayar,amaun,status_bantuan) VALUES ('$id_masjid','$no_passport','$nama_penuh','$no_tel','$status_perkahwinan','$alamat_terkini','$id_negeri','$id_daerah','$poskod','$jenis_bantuan','$tarikh_bantuan','$kaedah_bayar','$amaun_bantuan','1')";
	$query = mysqli_query($bd2,$sql);
	
	if($query)
	{
		header("Location: ../utama.php?view=admin&action=bantuan&no_passport=".$no_passport);
	}
}
?>