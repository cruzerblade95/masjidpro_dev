<?php
include("../connection/connection.php");
// INSERT
   
 if (isset($_POST['id_data'])) 
    {
			
	$id_masjid=$_POST['id_masjid'];
	$id_data=$_POST['id_data'];
	
    $jenis_oku=mysql_real_escape_string($_POST['jenis_oku']);
	$keterangan=mysql_real_escape_string($_POST['keterangan']);
   
	
	mysql_select_db($mysql_database, $bd);
	
	$sql1 ="INSERT INTO sej6x_data_oku(id_masjid,id_data,jenis_oku,keterangan,time)
	
            VALUES($id_masjid,$id_data,'$jenis_oku','$keterangan',NOW())";
			
	//UPDATE
			
	$id_data=$_POST['id_data'];
			
	$sql2 ="UPDATE sej6x_data_peribadi set data_oku=1 where id_data='$id_data'";		

	mysql_query($sql1,$bd);
	mysql_query($sql2,$bd);
	
    header("Location: ../utama.php?view=senarai_oku");  
			}
			?> 
