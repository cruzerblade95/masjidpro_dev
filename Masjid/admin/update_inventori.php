<?php

	include('../connection/connection.php');
	
	//hiddenvalue
	$id_masjid=$_POST['id_masjid'];
	$id_inventori=$_POST['id_inventori'];
	$id_pembekal=$_POST['id_pembekal'];

	//update table sej6x_data_inventori
	$nama_peralatan = $_POST['nama_peralatan'];
	$kod_peralatan = $_POST['kod_peralatan'];
	$jenis_peralatan = $_POST['jenis_peralatan'];
	$nama_pegawai = $_POST['nama_pegawai'];
	$nama_penyelenggara = $_POST['nama_penyelenggara'];
	$kuantiti_belian = $_POST['kuantiti_belian'];
	$kuantiti_unit = $_POST['kuantiti_unit'];
	$tarikh_belian = $_POST['tarikh_belian'];
	$harga_belian = $_POST['harga_belian'];
	$lokasi = $_POST['lokasi'];
	$catatan = $_POST['catatan'];

	//update table sej6x_data_pembekal
	$jenis_pembekal = $_POST['jenis_pembekal'];
	$jenis_sewaan = $_POST['jenis_sewaan'];
	$kat_wakaf = $_POST['kat_wakaf'];
	$nama_sewa = $_POST['nama_sewa'];
	$no_sewa = $_POST['no_sewa'];
	$nama_beli = $_POST['nama_beli'];
	$no_beli = $_POST['no_beli'];
	$nama_sumbang = $_POST['nama_sumbang'];

	if($jenis_peralatan == 'other') {

		$otherInput = $_POST['otherInput'];

		$sql_catTool = "INSERT INTO sej6x_data_jenisinventori (jenis_inventori, id_masjid) VALUE ('$otherInput', '$id_masjid')";
		$r_catTool = mysqli_query($bd2, $sql_catTool);

		$jenis_peralatan = mysqli_insert_id($bd2);
	}

	$sql1 = "UPDATE sej6x_data_pembekal SET jenis_pembekal = '$jenis_pembekal', jenis_sewaan = '$jenis_sewaan', kat_wakaf = '$kat_wakaf', nama_sewa = '$nama_sewa',
             no_sewa = '$no_sewa', nama_beli = '$nama_beli', no_beli = '$no_beli', nama_sumbang = '$nama_sumbang' WHERE id_pembekal = '$id_pembekal'";
	$r1 = mysqli_query($bd2, $sql1);

	$sql2 = "UPDATE sej6x_data_inventori SET nama_peralatan = '$nama_peralatan', kod_peralatan = '$kod_peralatan', jenis_peralatan = '$jenis_peralatan',
             tarikh_belian = '$tarikh_belian', id_pegawai = '$nama_pegawai', id_penyelenggara = '$nama_penyelenggara', kuantiti_belian = '$kuantiti_belian',
             kuantiti_unit = '$kuantiti_unit', harga_belian = '$harga_belian', lokasi = '$lokasi', catatan = '$catatan' 
			 WHERE id_inventori = '$id_inventori' AND id_masjid = '$id_masjid' ";
	$r2 = mysqli_query($bd2, $sql2);

	if($r2)
	{
		header("Location:../utama.php?view=admin&action=view_inventori&id_inventori=$id_inventori&sideMenu=masjid");
	}
?>
