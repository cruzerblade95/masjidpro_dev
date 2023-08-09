<?php
include("../connection/connection.php");
// INSERT
   
if (isset($_POST['id_data'])) 
{
			
	$id_masjid=$_POST['id_masjid'];
	$id_data=$_POST['id_data'];
	
    $tarikh_kematian=mysql_real_escape_string($_POST['tarikh_kematian']);
	$waktu_kematian=mysql_real_escape_string($_POST['waktu_kematian']);
	$sebab_kematian=mysql_real_escape_string($_POST['sebab_kematian']);
	$lokasi=mysql_real_escape_string($_POST['lokasi']);
	$tarikh_dikebumikan=mysql_real_escape_string($_POST['tarikh_dikebumikan']);
	$waktu_dikebumikan=mysql_real_escape_string($_POST['waktu_dikebumikan']);
	$no_kubur=mysql_real_escape_string($_POST['no_kubur']);
   
	$sql="SELECT * FROM data_kematian WHERE id_data='$id_data'";
	$sqlquery=mysql_query($sql,$bd);
	$row=mysql_num_rows($sqlquery);
	if($row==0)
	{
	
	$sql3="UPDATE sej6x_data_peribadi set data_kematian=1 where id_data='$id_data'";
	$sqlquery3=mysql_query($sql3,$bd);
	
	$sql1 ="INSERT INTO   	
	        data_kematian(id_masjid,id_data,tarikh_kematian,waktu_kematian,sebab_kematian,lokasi,
	        tarikh_dikebumikan,waktu_dikebumikan,no_kubur,time)
	
            VALUES($id_masjid,$id_data,'$tarikh_kematian','$waktu_kematian','$sebab_kematian','$lokasi',
			'$tarikh_dikebumikan','$waktu_dikebumikan','$no_kubur',NOW())";
	$sqlquery1=mysql_query($sql1,$bd);
		if($sqlquery1)
		{
		header("Location: ../utama.php?view=admin&action=semak_kematian&id_data='$id_data'");  
		}
	}
	else if($row>0)
	{
		//UPDATE
				
		$id_data=$_POST['id_data'];
				
		$sql2 ="UPDATE 
		data_kematian 
		SET 
		tarikh_kematian='$tarikh_kematian',
		waktu_kematian='$waktu_kematian',
		sebab_kematian='$sebab_kematian',
		lokasi='$lokasi',
		tarikh_dikebumikan='$tarikh_dikebumikan',
		waktu_dikebumikan='$waktu_dikebumikan',
		no_kubur='$no_kubur'
		WHERE
		id_data='$id_data'";		

		
		$sqlquery2=mysql_query($sql2,$bd);
		if($sqlquery2)
		{
			header("Location: ../utama.php?view=admin&action=semak_kematian&id_data='$id_data'");  
		}	
	}		
}
else if (isset($_POST['id'])) 
{
			
	$id_masjid=$_POST['id_masjid'];
	$ID=$_POST['id'];
	
    $tarikh_kematian=mysql_real_escape_string($_POST['tarikh_kematian']);
	$waktu_kematian=mysql_real_escape_string($_POST['waktu_kematian']);
	$sebab_kematian=mysql_real_escape_string($_POST['sebab_kematian']);
	$lokasi=mysql_real_escape_string($_POST['lokasi']);
	$tarikh_dikebumikan=mysql_real_escape_string($_POST['tarikh_dikebumikan']);
	$waktu_dikebumikan=mysql_real_escape_string($_POST['waktu_dikebumikan']);
	$no_kubur=mysql_real_escape_string($_POST['no_kubur']);
   
	$sql="SELECT * FROM data_kematian WHERE id_anak='$ID'";
	$sqlquery=mysql_query($sql,$bd);
	$row=mysql_num_rows($sqlquery);
	if($row==0)
	{
	
	$sql3="UPDATE sej6x_data_anakqariah set status_kematian=1 where ID='$ID'";
	$sqlquery3=mysql_query($sql3,$bd);
	
	$sql1 ="INSERT INTO   	
	        data_kematian(id_masjid,id_anak,tarikh_kematian,waktu_kematian,sebab_kematian,lokasi,
	        tarikh_dikebumikan,waktu_dikebumikan,no_kubur,time)
	
            VALUES($id_masjid,$ID,'$tarikh_kematian','$waktu_kematian','$sebab_kematian','$lokasi',
			'$tarikh_dikebumikan','$waktu_dikebumikan','$no_kubur',NOW())";
	$sqlquery1=mysql_query($sql1,$bd);
		if($sqlquery1)
		{
		header("Location: ../utama.php?view=admin&action=semak_kematian&id=".$ID);  
		}
	}
	else if($row>0)
	{
		//UPDATE
				
		$ID=$_POST['id'];
				
		$sql2 ="UPDATE 
		data_kematian 
		SET 
		tarikh_kematian='$tarikh_kematian',
		waktu_kematian='$waktu_kematian',
		sebab_kematian='$sebab_kematian',
		lokasi='$lokasi',
		tarikh_dikebumikan='$tarikh_dikebumikan',
		waktu_dikebumikan='$waktu_dikebumikan',
		no_kubur='$no_kubur'
		WHERE
		id_anak='$ID'";		

		
		$sqlquery2=mysql_query($sql2,$bd);
		if($sqlquery2)
		{
			header("Location: ../utama.php?view=admin&action=semak_kematian&id=".$ID);  
		}	
	}		
}
			?> 
