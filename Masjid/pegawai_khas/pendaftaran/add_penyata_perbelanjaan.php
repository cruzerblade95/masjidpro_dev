<?php
include("../connection/connection.php");
// INSERT
   	
	$id_masjid=$_POST['id_masjid'];
	$id_data=$_POST['id_data'];
	
    $mandi=$_POST['mandi'];
	$kain_kapan=$_POST['kain_kapan'];
	$keranda=$_POST['keranda'];
	$liang=$_POST['liang'];
	
	$imam=$_POST['imam'];
	$caj_unit=$_POST['caj_unit'];
	$caj_hospital=$_POST['caj_hospital'];
	$jumlah_asas=$_POST['jumlah_asas'];
   
	$jemputan_solat=$_POST['jemputan_solat'];
	$solat_hadiah=$_POST['solat_hadiah'];
	$sewa_van=$_POST['sewa_van'];
	$caj_bukan_pakatan=$_POST['caj_bukan_pakatan'];
	
	$lain_perbelanjaan=$_POST['lain_perbelanjaan'];
	$jum_belanja_pilihan=$_POST['jum_belanja_pilihan'];
	$jum_belanja_seluruh=$_POST['jum_belanja_seluruh'];
	$jum_sumbangan_pakatan=$_POST['jum_sumbangan_pakatan'];
	$tolak_keseluruhan=$_POST['tolak_keseluruhan'];
	$baki=$_POST['baki'];
	
	mysql_select_db($mysql_database, $bd);
	
	$sql1 ="INSERT INTO sej6x_data_penyata_perbelanjaan(id_masjid,id_data,mandi,kain_kapan,
keranda,liang,imam,caj_unit,caj_hospital,jumlah_asas,jemputan_solat,
solat_hadiah,sewa_van,caj_bukan_pakatan,lain_perbelanjaan,jum_belanja_pilihan,
jum_belanja_seluruh,jum_sumbangan_pakatan,tolak_keseluruhan,baki,time) 

VALUES($id_masjid,$id_data,$mandi,$kain_kapan,$keranda,$liang,$imam,$caj_unit,
$caj_hospital,$jumlah_asas,$jemputan_solat,$solat_hadiah,
$sewa_van,$caj_bukan_pakatan,$lain_perbelanjaan,$jum_belanja_pilihan,$jum_belanja_seluruh,
$jum_sumbangan_pakatan,$tolak_keseluruhan,$baki,NOW())";
	
    echo $sql1;

$test=mysql_query($sql1,$bd);
	if($test)
	{
		  header("Location: ../utama.php?view=pendaftaran_kematian");  
	}
	else
	{
		echo mysql_error();
	}			?> 
