<?php
	
	include("../connection/connection.php");
   
	if (isset($_POST['id_data'])) 
    {
		$id_masjid=$_POST['id_masjid'];
		$id_data=$_POST['id_data'];
	
		$jenis_oku=mysql_real_escape_string($_POST['jenis_oku']);
		$keterangan=mysql_real_escape_string($_POST['keterangan']);
	   
		$sql ="UPDATE sej6x_data_peribadi set oku=1 where id_data='$id_data'"; 
	
		mysql_query($sql,$bd);
	
		$sql1="INSERT INTO sej6x_data_oku(id_data,id_masjid,jenis_oku,keterangan,time) values('$id_data','$id_masjid','$jenis_oku','$keterangan',NOW())";
	
		mysql_query($sql1,$bd);
	
		header("Location: ../utama.php?view=admin&action=senarai_oku");  
	}
	else if(isset($_POST['id']))
	{
		$id_masjid=$_POST['id_masjid'];
		$ID=$_POST['id'];
	
		$jenis_oku=mysql_real_escape_string($_POST['jenis_oku']);
		$keterangan=mysql_real_escape_string($_POST['keterangan']);
	   
		$sql ="UPDATE sej6x_data_anakqariah SET status_oku=1 WHERE ID='$ID'"; 
	
		mysql_query($sql,$bd);
	
		$sql1="INSERT INTO sej6x_data_oku(id_anak,id_masjid,jenis_oku,keterangan,time) VALUES ('$ID','$id_masjid','$jenis_oku','$keterangan',NOW())";
	
		mysql_query($sql1,$bd);
	
		header("Location: ../utama.php?view=admin&action=senarai_oku");
	}
?> 
