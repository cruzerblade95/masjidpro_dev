<?php
include("../connection/connection.php");
// INSERT
   
 if (isset($_POST['id_data'])) 
    {
			
	$id_masjid=$_POST['id_masjid'];
	$id_data=$_POST['id_data'];
	
    $rawatan_terkini=mysql_real_escape_string($_POST['rawatan_terkini']);
	$jenis_penyakit=mysql_real_escape_string($_POST['jenis_penyakit']);
   
	
	mysql_select_db($mysql_database, $bd);
	
	$sql1 ="INSERT INTO sej6x_data_sakit(id_masjid,id_data,jenis_penyakit,rawatan_terkini,masa)
	
            VALUES($id_masjid,$id_data,'$jenis_penyakit','$rawatan_terkini',NOW())";
			
	//UPDATE
			
	$id_data=$_POST['id_data'];
			
	$sql2 ="UPDATE sej6x_data_peribadi set data_sakit=1 where id_data='$id_data'";		

	mysql_query($sql1,$bd);
	mysql_query($sql2,$bd);
	
    header("Location: ../utama.php?view=senarai_sakit");  
			}
			?> 
