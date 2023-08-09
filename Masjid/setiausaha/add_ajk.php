<?php

include("connection/connection.php");

//require_once('../connection/connection.php');

// INSERT
   
 if (isset($_POST['id_ajk'])) 
    {
			
	$id_masjid=$_POST['id_masjid'];
	$id_ajk=$_POST['id_ajk'];
	
    $jawatan=mysql_real_escape_string($_POST['jawatan']);
	$tarikh_lantikan=mysql_real_escape_string($_POST['tarikh_lantikan']);
   
    $gambar = addslashes (file_get_contents($_FILES['gambar']['tmp_name']));
    $image = sgetimagesize(mysql_real_escape_string($_FILES['gambar']['tmp_name']));//to know about image type etc
    $jenis_gambar = $image['mime'];
	
	mysql_select_db($mysql_database, $bd);
	
	$sql1 ="INSERT INTO data_ajkmasjid(id_masjid, id_ajk,jawatan,tarikh_lantikan,gambar,jenis_gambar,time)
	
            VALUES($id_masjid,'$id_ajk','$jawatan','$tarikh_lantikan','$gambar','$jenis_gambar',NOW())";
			
	//UPDATE
			
	$id_data=$_POST['id_data'];
			
	$sql2 ="UPDATE sej6x_data_peribadi set data_ajk=1 where id_data='$id_data'";		

	mysql_query($sql1,$bd);
	mysql_query($sql2,$bd);
	
    header("Location: ../utama.php?view=admin&action=senarai_ajk");  
			}
			?> 
