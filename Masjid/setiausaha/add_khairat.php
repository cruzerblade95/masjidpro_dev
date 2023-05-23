<?php
include("../connection/connection.php");
// INSERT
   
 if (isset($_POST['id_data'])) 
    {
			
	$id_masjid=$_POST['id_masjid'];
	$id_data=$_POST['id_data'];
	
	$pakej=$_POST['pakej'];
    $nama=mysql_real_escape_string($_POST['nama']);
	$hubungan=mysql_real_escape_string($_POST['hubungan']);
	$tarikh_lahir=mysql_real_escape_string($_POST['tarikh_lahir']);
	$no_kp=$_POST['no_kp'];
   
	
	mysql_select_db($mysql_database, $bd);
	
	$sql1 ="INSERT INTO sej6x_data_khairat(id_data,id_masjid,pakej,nama,hubungan,tarikh_lahir,no_kp,time)
	
            VALUES($id_data,$id_masjid,$pakej,'$nama','$hubungan','$tarikh_lahir',$no_kp,NOW())";
			
	//UPDATE
			
	$id_data=$_POST['id_data'];
			
	$sql2 ="UPDATE sej6x_data_peribadi set data_khairat=1 where id_data='$id_data'";		

	mysql_query($sql1,$bd);
	mysql_query($sql2,$bd);
	
    header("Location: ../utama.php?view=setiausaha&action=senarai_khairat");  
			}
			?> 
