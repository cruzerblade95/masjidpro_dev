<?php
include("../connection/connection.php");

// Connect to server and select database.
   if(!empty($_POST))
    {	
	$view=$_POST['view'];
	$user_id=$_POST['user_id'];
	
	echo $ID=$_POST['id'];
	$nama_penuh=trim(($_POST['nama_penuh'])," ");
	$no_ic=mysql_real_escape_string($_POST['no_ic']);
	$no_hp=mysql_real_escape_string($_POST['no_hp']);
	$umur=$_POST['umur'];
	
	$tarikh_lahir=mysql_real_escape_string($_POST['tarikh_lahir']);
	$jantina=mysql_real_escape_string($_POST['jantina']);
	$bangsa=$_POST['bangsa'];
	$warganegara=$_POST['warganegara'];
	$status_perkahwinan=$_POST['status_perkahwinan'];
	
	$pekerjaan=mysql_real_escape_string($_POST['pekerjaan']);
	$tempoh_tinggal=mysql_real_escape_string($_POST['tempoh_tinggal']);
	$zon_qariah=$_POST['zon_qariah'];
	$alamat_terkini=mysql_real_escape_string($_POST['alamat_terkini']);
	$id_negeri=$_POST['id_negeri'];
	
	$id_daerah=$_POST['id_daerah'];
	$poskod=mysql_real_escape_string($_POST['poskod']);
	$solat_jumaat=$_POST['solat_jumaat'];
	$warga_emas=$_POST['warga_emas'];
  
	mysql_select_db($mysql_database, $bd);
	
	$sql = "INSERT INTO sej6x_data_peribadi(id_masjid, id_anakqariah, nama_penuh, no_ic,tarikh_lahir, warganegara, umur, bangsa, jantina,status_perkahwinan, status, tahap_pendidikan, sekolah_institusi, no_hp, no_rumah, alamat_terkini, poskod, id_daerah, id_negeri, zon_qariah, tempoh_tinggal,bil_tanggungan, data_umum,solat_jumaat,warga_emas,data_ajk,data_pegawai,data_undi, data_asnaf, data_ibutunggal, data_anakyatim, data_cerai, data_kematian, data_khairat, data_nikah, data_sakit, data_oku, id_suami, id_bapa, id_ibu, pekerjaan, majikan, pendapatan, last_added,added_by)
	
VALUES($id_masjid,'$ID','$nama_penuh','$no_ic','$tarikh_lahir',$warganegara,$umur,$bangsa,'$jantina',$status_perkahwinan,'-1','-1','0','$no_hp','0','$alamat_terkini','$poskod',$id_daerah,$id_negeri,$zon_qariah,'$tempoh_tinggal','-1','0',$solat_jumaat,$warga_emas,'0','0','0','0','0','0','0','0','0','0',
'0','0','-1','-1','-1','$pekerjaan','0','0',NOW(),'$user_id')";

	$sqlquery = mysql_query($sql,$bd);
	
	$sql1 = "SELECT * FROM sej6x_data_peribadi WHERE id_anakqariah='$ID'";
	$sqlquery1 = mysql_query($sql1,$bd);
	$data1=mysql_fetch_array($sqlquery1);
	$id_data=$data1['id_data'];

	$sql2 = "UPDATE sej6x_data_anakqariah SET id_dataperibadi='$id_data' WHERE ID='$ID'";
	$sqlquery2 = mysql_query($sql2,$bd);
	
	if($sqlquery2)
	{
		header("location: ../utama.php?view=".$view."&action=pendaftaran_ahli_qariah"); 
	}

		


}
?> 
