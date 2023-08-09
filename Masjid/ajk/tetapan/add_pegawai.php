<?php
include("../connection/connection.php");
// INSERT
   
 if (isset($_POST['id_pegawai'])) 
    {
			
	$id_masjid=$_POST['id_masjid'];
	$id_pegawai=$_POST['id_pegawai'];
	
    $jawatan=mysql_real_escape_string($_POST['jawatan']);
	$tarikh_lantikan=mysql_real_escape_string($_POST['tarikh_lantikan']);
   
    $gambar = addslashes (file_get_contents($_FILES['gambar']['tmp_name']));
    $image = getimagesize(mysql_real_escape_string($_FILES['gambar']['tmp_name']));//to know about image type etc
    $jenis_gambar = $image['mime'];
	
	mysql_select_db($mysql_database, $bd);
	
	$sql1 ="INSERT INTO data_pegawai_masjid(id_masjid, id_pegawai,jawatan,tarikh_lantikan,gambar,jenis_gambar,time)
	
            VALUES($id_masjid,'$id_pegawai','$jawatan','$tarikh_lantikan','$gambar','$jenis_gambar',NOW())";
			
	//UPDATE
			
	$id_data=$_POST['id_data'];
			
	$sql2 ="UPDATE sej6x_data_peribadi set data_pegawai=1 where id_data='$id_data'";		

	mysql_query($sql1,$bd);
	mysql_query($sql2,$bd);
	
    header("Location: ../utama.php?view=senarai_pegawai");  
			}
			?> 
