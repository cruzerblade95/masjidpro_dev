<?php

	include('../connection/connection.php');

	$id_masjid=$_POST['id_masjid'];
	$tarikh=$_POST['tarikh'];
	$no_baucer=$_POST['no_baucer'];
	$jenis_baucer=$_POST['jenis_baucer'];
	$penerima=$_POST['bayar_kepada'];
	$id_bayaran=$_POST['id_bayaran'];
	$total_baucer=$_POST['total_baucer'];

	$sql="INSERT INTO baucer_bayaran (id_masjid,tarikh,no_baucer,jenis_baucer,id_pembekal,id_bayaran,jumlah) VALUES ('$id_masjid','$tarikh','$no_baucer','$jenis_baucer','$penerima','$id_bayaran','$total_baucer')";
	$sqlquery=mysql_query($sql,$bd);
	
	$kuiri="SELECT * FROM baucer_bayaran WHERE no_baucer='$no_baucer'";
	$kuirirun=mysql_query($kuiri,$bd);
	$run=mysql_fetch_array($kuirirun);
	
	$id_baucer=$run['id_baucer'];
	
	if($jenis_baucer==1)
	{
		$number=count($_POST["tarikh_baucer"]);
		if($number>0)
		{
			for($i=0;$i<$number;$i++)
			{
				$sql2="INSERT INTO 
				sej6x_data_baucer(id_baucer,id_pembekal,id_bayaran,tarikh,invoice_no,no_cek,butir,jumlah) 
				VALUES 
				('$id_baucer','$penerima','$id_bayaran','".$_POST["tarikh_baucer"][$i]."','".$_POST["invoice_baucer"][$i]."','TUNAI','".$_POST["butir_baucer"][$i]."','".$_POST["jumlah_baucer"][$i]."')";
				$sqlquery2=mysql_query($sql2,$bd);
			}
		}
	}
	else if($jenis_baucer==2)
	{
		$number=count($_POST["tarikh_baucer"]);
		if($number>0)
		{
			for($i=0;$i<$number;$i++)
			{
				echo $sql2="INSERT INTO 
				sej6x_data_baucer(id_baucer,id_pembekal,id_bayaran,tarikh,invoice_no,no_cek,butir,jumlah) 
				VALUES 
				('$id_baucer','$penerima','$id_bayaran','".$_POST["tarikh_baucer"][$i]."','".$_POST["invoice_baucer"][$i]."','".$_POST["cek_baucer"][$i]."','".$_POST["butir_baucer"][$i]."','".$_POST["jumlah_baucer"][$i]."')";
				$sqlquery2=mysql_query($sql2,$bd);
			}
		}
	}
	
	if($sqlquery2)
	{
		header('Location:../utama.php?view=admin&action=senarai_baucer');
	}
?>