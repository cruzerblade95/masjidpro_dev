<?php
include ("../connection/connection.php");
// INSERT

if (isset($_POST['id_data'])) {

    $id_masjid = $_POST['id_masjid'];
    $id_data = $_POST['id_data'];

    $tarikh_kematian = mysql_real_escape_string($_POST['tarikh_kematian']);
    $waktu_kematian = mysql_real_escape_string($_POST['waktu_kematian']);
    $sebab_kematian = mysql_real_escape_string($_POST['sebab_kematian']);
    $lokasi = mysql_real_escape_string($_POST['lokasi']);
    $tarikh_dikebumikan = mysql_real_escape_string($_POST['tarikh_dikebumikan']);
    $waktu_dikebumikan = mysql_real_escape_string($_POST['waktu_dikebumikan']);
    $no_kubur = mysql_real_escape_string($_POST['no_kubur']);

    mysql_select_db($mysql_database, $bd);
    $result = mysql_query(
          "SELECT * FROM data_kemation WHERE id_data='$id_data' LIMIT 1");
    
    if(mysql_fetch_array($result)){
       $sql1 = "update data_kemation set tarikh_kematian='$tarikh_kematian',waktu_kematian='$waktu_kematian',sebab_kematian='$sebab_kematian ',
               lokasi='$lokasi',tarikh_dikebumikan='$tarikh_dikebumikan',waktu_dikebumikan='$waktu_dikebumikan',no_kubur='$no_kubur',time=NOW()";
    }else{
       $sql1 = "INSERT INTO
	        data_kematian(id_masjid,id_data,tarikh_kematian,waktu_kematian,sebab_kematian,lokasi,
	        tarikh_dikebumikan,waktu_dikebumikan,no_kubur,time)
	        
            VALUES($id_masjid,$id_data,'$tarikh_kematian','$waktu_kematian','$sebab_kematian','$lokasi',
			'$tarikh_dikebumikan','$waktu_dikebumikan','$no_kubur',NOW())";
    }

    echo $sql1;
    
    mysql_query($sql1, $bd);

    // UPDATE
    $result2 = mysql_query("select * from sej6x_data_peribadi where id_data='$id_data' LIMIT 1");
    
    if(mysql_fetch_array($result2)){
       $sql2 = "UPDATE sej6x_data_peribadi set data_kematian=1 where id_data='$id_data'";
    }else{
       $sql2 = "UPDATE sej6x_data_anakqariah set status_kematian='Y' where id='$id_data'";
    }

    echo $sql2;
    mysql_query($sql2, $bd);

    header("Location: ../utama.php?view=admin&action=pendaftaran_kematian");
}
?> 
