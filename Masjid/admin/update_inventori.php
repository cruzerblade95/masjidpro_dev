<?php

	include('../connection/connection.php');
	
	$id_masjid=$_POST['id_masjid'];
	$id_inventori=$_POST['id_inventori'];
	$no_rujukan=$_POST['no_rujukan'];
	$jenis_inventori=$_POST['jenis_inventori'];
	$id_ajk=$_POST['id_ajk'];
	$nama_inventori=$_POST['nama_inventori'];
	$tarikh_belian=$_POST['tarikh_belian'];
	$kuantiti=$_POST['kuantiti'];
	$lokasi=$_POST['lokasi'];
	$harga_belian=$_POST['harga_belian'];
	$harga_sewa=$_POST['harga_sewa'];
	$status_belian=$_POST['status_belian'];
	$catatan=$_POST['catatan'];
	
	$sql="UPDATE sej6x_data_inventori SET 
	jenis_inventori='$jenis_inventori',
	id_ajk='$id_ajk',
	nama_inventori='$nama_inventori',
	tarikh_belian='$tarikh_belian',
	kuantiti='$kuantiti',
	lokasi='$lokasi',
	harga_belian='$harga_belian',
	harga_sewa='$harga_sewa',
	status_belian='$status_belian',
	catatan='$catatan'
	WHERE id_inventori='$id_inventori'";
	$sqlquery=mysqli_query($bd2,$sql);
	
	$sql1="UPDATE status_barang SET 
	status_nama_perkara='$jenis_inventori',
	status_nama='$nama_inventori',
	status_lokasi='$lokasi',
	status_luas_kuantiti='$kuantiti',
	status_harga_sewa='$harga_sewa'
	WHERE no_barang='$no_rujukan'";
	$sqlquery1=mysqli_query($bd2,$sql1);
	
	if($sqlquery1)
	{
		header("Location:../utama.php?view=admin&action=maklumatinventori");
	}
?>
