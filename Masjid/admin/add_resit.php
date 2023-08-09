<?php

	include('../connection/connection.php');
	
	$id_masjid=$_POST['id_masjid'];
	$tarikh=$_POST['tarikh'];
	$id_penyumbang=$_POST['terima'];
	$id_jeniskutipan=$_POST['maklumat'];
	$amaun_tunai=$_POST['amaun_tunai'];
	$amaun_cek=$_POST['amaun_cek'];
	if($amaun_tunai>0)
	{
		$amaun_tunai=$_POST['amaun_tunai'];
		$tunai="Tunai";
		$id_tabung=$_POST['tabung_tunai'];
		echo $sql="INSERT INTO sej6x_data_resit (id_masjid,tarikh,id_penyumbang,id_jeniskutipan,amaun,no_cek,tabung) VALUES ('$id_masjid','$tarikh','$id_penyumbang','$id_jeniskutipan','$amaun_tunai','$tunai','$id_tabung')";
		$sqlquery=mysql_query($sql,$bd);
	}
	else if($amaun_cek>0)
	{	
		$amaun_cek=$_POST['amaun_cek'];
		$no_cek=$_POST['no_cek'];
		$id_tabung=$_POST['tabung_cek'];
		echo $sql="INSERT INTO sej6x_data_resit (id_masjid,tarikh,id_penyumbang,id_jeniskutipan,amaun,no_cek,tabung) VALUES ('$id_masjid','$tarikh','$id_penyumbang','$id_jeniskutipan','$amaun_cek','$no_cek','$id_tabung')";
		$sqlquery=mysql_query($sql,$bd);
	}
	
	if($sqlquery)
	{
		header('Location:../utama.php?view=admin&action=senarai_resit');
	}
?>