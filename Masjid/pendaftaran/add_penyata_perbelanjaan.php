<?php
include("../connection/connection.php");
// INSERT
   	
	if(isset($_GET['id_data']))
	{
		
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
		$baki=$_POST['baki'];
		
		mysql_select_db($mysql_database, $bd);
		
		$result = mysql_query(
			"SELECT * FROM sej6x_data_penyata_perbelanjaan WHERE id_masjid='$id_masjid' and id_data='$id_data' LIMIT 1");
		
		if(mysql_fetch_array($result)){
			$sql1="update sej6x_data_penyata_perbelanjaan set mandi='$mandi', kain_kapan='$kain_kapan', keranda='$keranda',
				   liang='$liang', imam='$imam',
					caj_unit='$caj_unit',caj_hospital='$caj_hospital',jumlah_asas='$jumlah_asas',jemputan_solat='$jemputan_solat',
					solat_hadiah='$solat_hadiah',sewa_van='$sewa_van',
					caj_bukan_pakatan='$caj_bukan_pakatan',lain_perbelanjaan='$lain_perbelanjaan',jum_belanja_pilihan='$jum_belanja_pilihan',
					jum_belanja_seluruh='$jum_belanja_seluruh',
					jum_sumbangan_pakatan='$jum_sumbangan_pakatan',baki='$baki',time=NOW()
					where id_masjid='$id_masjid' and id_data='$id_data'";  
		}else{
			$sql1 ="INSERT INTO sej6x_data_penyata_perbelanjaan(id_masjid,id_data,mandi,kain_kapan,
			keranda,liang,imam,caj_unit,caj_hospital,jumlah_asas,jemputan_solat,
			solat_hadiah,sewa_van,caj_bukan_pakatan,lain_perbelanjaan,jum_belanja_pilihan,
			jum_belanja_seluruh,jum_sumbangan_pakatan,baki,time)
			VALUES($id_masjid,$id_data,$mandi,$kain_kapan,$keranda,$liang,$imam,$caj_unit,
			$caj_hospital,$jumlah_asas,$jemputan_solat,$solat_hadiah,
			$sewa_van,$caj_bukan_pakatan,$lain_perbelanjaan,$jum_belanja_pilihan,$jum_belanja_seluruh,
			$jum_sumbangan_pakatan,$baki,NOW())";
			
			echo $sql1;
		}
		
		$test=mysql_query($sql1,$bd);
		
		if($test)
		{
			  header("Location: ../utama.php?view=admin&action=semak_kematian&id_data=".$id_data);  
		}
		else
		{
			echo mysql_error();
		}			
	}
	else if(isset($_POST['id']))
	{
	
	$id_masjid=$_POST['id_masjid'];
	$ID=$_POST['id'];
	
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
	$baki=$_POST['baki'];
	
	mysql_select_db($mysql_database, $bd);
	
	$result = mysql_query(
	    "SELECT * FROM sej6x_data_penyata_perbelanjaan WHERE id_masjid='$id_masjid' and id_anak='$ID' LIMIT 1");
	
	if(mysql_fetch_array($result)){
	    $sql1="update sej6x_data_penyata_perbelanjaan set mandi='$mandi', kain_kapan='$kain_kapan', keranda='$keranda',
               liang='$liang', imam='$imam',
                caj_unit='$caj_unit',caj_hospital='$caj_hospital',jumlah_asas='$jumlah_asas',jemputan_solat='$jemputan_solat',
                solat_hadiah='$solat_hadiah',sewa_van='$sewa_van',
                caj_bukan_pakatan='$caj_bukan_pakatan',lain_perbelanjaan='$lain_perbelanjaan',jum_belanja_pilihan='$jum_belanja_pilihan',
                jum_belanja_seluruh='$jum_belanja_seluruh',
                jum_sumbangan_pakatan='$jum_sumbangan_pakatan',baki='$baki',time=NOW()
                where id_masjid='$id_masjid' and id_anak='$ID'";  
	}else{
	    $sql1 ="INSERT INTO sej6x_data_penyata_perbelanjaan(id_masjid,id_anak,mandi,kain_kapan,
        keranda,liang,imam,caj_unit,caj_hospital,jumlah_asas,jemputan_solat,
        solat_hadiah,sewa_van,caj_bukan_pakatan,lain_perbelanjaan,jum_belanja_pilihan,
        jum_belanja_seluruh,jum_sumbangan_pakatan,baki,time)
        VALUES($id_masjid,$ID,$mandi,$kain_kapan,$keranda,$liang,$imam,$caj_unit,
        $caj_hospital,$jumlah_asas,$jemputan_solat,$solat_hadiah,
        $sewa_van,$caj_bukan_pakatan,$lain_perbelanjaan,$jum_belanja_pilihan,$jum_belanja_seluruh,
        $jum_sumbangan_pakatan,$baki,NOW())";
	    
        echo $sql1;
	}
	
	$test=mysql_query($sql1,$bd);
	
	if($test)
	{
		  header("Location: ../utama.php?view=admin&action=semak_kematian&id=".$ID);  
	}
	else
	{
		echo mysql_error();
	}			
	}
	?> 
