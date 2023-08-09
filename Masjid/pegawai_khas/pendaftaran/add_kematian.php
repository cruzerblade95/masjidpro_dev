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
   
	
	mysql_select_db($mysql_database, $bd);
	
	$sql1 ="INSERT INTO   	
	        data_kematian(id_masjid,id_data,tarikh_kematian,waktu_kematian,sebab_kematian,lokasi,
	        tarikh_dikebumikan,waktu_dikebumikan,no_kubur,time)
	
            VALUES($id_masjid,$id_data,'$tarikh_kematian','$waktu_kematian','$sebab_kematian','$lokasi',
			'$tarikh_dikebumikan','$waktu_dikebumikan','$no_kubur',NOW())";
			
	//UPDATE
			
	$id_data=$_POST['id_data'];
			
	$sql2 ="UPDATE sej6x_data_peribadi set data_kematian=1 where id_data='$id_data'";		

	mysql_query($sql1,$bd);
	mysql_query($sql2,$bd);
	
    header("Location: ../utama.php?view=pendaftaran_kematian");  
			}
			?> 
