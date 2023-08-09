<?php
include("../connection/connection.php");

$id_kerosakan=$_POST['id_kerosakan'];
$id_peralatan=$_POST['id_peralatan'];
$id_penyelenggara=$_POST['id_penyelenggara'];
$tahap_kerosakan=$_POST['tahap_kerosakan'];
$kuantiti=$_POST['kuantiti'];
$kuantiti_unit=$_POST['kuantiti_unit'];
$tarikh_kerosakan=$_POST['tarikh_kerosakan'];
$masa_kerosakan=$_POST['masa_kerosakan'];
$lokasi_kerosakan=$_POST['lokasi_kerosakan'];
$id_pengesah=$_POST['id_pengesah'];
$catatan=$_POST['catatan'];
$id_statuskerosakan=$_POST['id_statuskerosakan'];

$query="UPDATE sej6x_data_kerosakkan SET id_peralatan = '$id_peralatan', id_penyelenggara = '$id_penyelenggara', tahap_kerosakan = '$tahap_kerosakan',
        kuantiti = '$kuantiti', kuantiti_unit = '$kuantiti_unit', tarikh_kerosakan = '$tarikh_kerosakan', masa_kerosakan = '$masa_kerosakan',
        lokasi_kerosakan = '$lokasi_kerosakan', id_pengesah = '$id_pengesah', catatan = '$catatan', id_statuskerosakan = '$id_statuskerosakan' 
        WHERE id_kerosakan = '$id_kerosakan'";
    
	$test=mysqli_query($bd2,$query);
	if($test)
	{
		    header("location: ../utama.php?view=admin&action=maklumatkerosakan&sideMenu=masjid");
	}
	else
	{
		echo mysqli_error();
	}

?>