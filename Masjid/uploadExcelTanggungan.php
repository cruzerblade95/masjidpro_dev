<?php

	include('connection/connection.php');

	$uploadfile=$_FILES['uploadTanggungan']['tmp_name'];

	require 'PHPExcel/Classes/PHPExcel.php';
	require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

	$objExcel=PHPExcel_IOFactory::load($uploadfile);
	foreach($objExcel->getWorksheetIterator() as $worksheet)
	{
		$highestrow=$worksheet->getHighestRow();

		for($row=2;$row<=$highestrow;$row++)
		{
			$ic_kariah = $worksheet->getCellByColumnAndRow(0,$row)->getValue();
			$no_rujukan = $worksheet->getCellByColumnAndRow(1,$row)->getValue();
			$nama_penuh = $worksheet->getCellByColumnAndRow(2,$row)->getValue();
			$no_ic = $worksheet->getCellByColumnAndRow(3,$row)->getValue();
			$no_tel = $worksheet->getCellByColumnAndRow(4,$row)->getValue();
			$jantina = $worksheet->getCellByColumnAndRow(5,$row)->getValue();
			$hubungan = $worksheet->getCellByColumnAndRow(6,$row)->getValue();
			$bangsa = $worksheet->getCellByColumnAndRow(7,$row)->getValue();
			$warganegara = $worksheet->getCellByColumnAndRow(8,$row)->getValue();
			$status_perkahwinan = $worksheet->getCellByColumnAndRow(9,$row)->getValue();

			$no_ic = str_replace("-","",$no_ic);
			$str_ic = strlen($no_ic);
			
			if($str_ic==12)
			{
				
				if($warganegara=="Warganegara")
				{
					$warganegara = 1;
				}
				if($warganegara=="Bukan Warganegara")
				{
					$warganegara = 2;
				}
				
				$year = substr($no_ic,0,2);
				$month = substr($no_ic,2,2);
				$day = substr($no_ic,4,2);
				if($year >= (date('y') + 1))
				{
					$year = "19".$year;
				}
				else if($year <= date('y'))
				{
					$year = "20".$year;
				}
				$tarikh_lahir = $year."-".$month."-".$day;
				
				if($bangsa=="Melayu")
				{
					$bangsa = 1;
				}
				else if($bangsa=="Cina")
				{
					$bangsa = 2;
				}
				else if($bangsa=="India")
				{
					$bangsa = 3;
				}
				else if($bangsa=="Lain-Lain")
				{
					$bangsa = 4;
				}
				
				if($jantina=="Lelaki")
				{
					$jantina = 1;
				}
				else if($jantina=="Perempuan")
				{
					$jantina = 2;
				}
				
				if($status_perkahwinan=="Bujang")
				{
					$status_perkahwinan = 1;
				}
				else if($status_perkahwinan=="Berkahwin")
				{
					$status_perkahwinan = 2;
				}
				else if($status_perkahwinan=="Duda")
				{
					$status_perkahwinan = 3;
				}	
				else if($status_perkahwinan=="Janda")
				{
					$status_perkahwinan = 4;
				}
				
				$nama_penuh = strtoupper($nama_penuh);
				
				$sql = "SELECT * FROM excel_test WHERE no_ic='$no_ic'";
				$sqlquery = mysqli_query($bd2,$sql);
				$bil = mysqli_num_rows($sqlquery);
				
				if($bil==0)
				{
					echo $insertqry="INSERT INTO excel_test(no_rujukan,id_masjid,nama_penuh,no_ic,no_tel,tarikh_lahir,warganegara,bangsa,jantina,status_kahwin,hubungan) VALUES ('$no_rujukan','$id_masjid','$nama_penuh','$no_ic','$no_tel','$tarikh_lahir','$warganegara','$bangsa','$jantina','$status_perkahwinan','$hubungan')";
					//$insertres=mysqli_query($bd2,$insertqry);
				}
			}
		}
	}
	//echo ("<script LANGUAGE='JavaScript'>
    //window.alert('Maklumat Berjaya Dimasukkan');
    //window.location.href='utama.php?view=admin&action=testExcel';
    //</script>");
?>