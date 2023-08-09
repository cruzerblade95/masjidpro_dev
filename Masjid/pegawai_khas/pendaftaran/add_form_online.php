<?php
include("../connection/connection.php");

// Connect to server and select database.
   if(!empty($_POST))
    {	
	$id_masjid=$_POST['id_masjid'];
	$nama_penuh=mysql_real_escape_string($_POST['nama_penuh']);
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
	
	$sql1 ="INSERT INTO sej6x_data_peribadi(id_masjid, nama_penuh, no_ic,tarikh_lahir, warganegara, umur, bangsa, jantina,status_perkahwinan, status, tahap_pendidikan, sekolah_institusi, no_hp, no_rumah, alamat_terkini, poskod, id_daerah, id_negeri, zon_qariah, tempoh_tinggal,bil_tanggungan, data_umum,solat_jumaat,warga_emas,data_ajk,data_pegawai,data_undi, data_asnaf, data_ibutunggal, data_anakyatim, data_cerai, data_kematian, data_khairat, data_nikah, data_sakit, data_oku, id_suami, id_bapa, id_ibu, pekerjaan, majikan, pendapatan, last_added)
	
VALUES($id_masjid,'$nama_penuh','$no_ic','$tarikh_lahir',$warganegara,$umur,$bangsa,'$jantina',$status_perkahwinan,'-1','-1','0','$no_hp','0','$alamat_terkini','$poskod',$id_daerah,$id_negeri,$zon_qariah,'$tempoh_tinggal','-1','0',$solat_jumaat,$warga_emas,'0','0','0','0','0','0','0','0','0','0',
'0','0','-1','-1','-1','$pekerjaan','0','0',NOW())";

	$test=mysql_query($sql1,$bd);
	if($test)
	{
		header("location: ../utama.php?view=pendaftaran_ahli_qariah"); 
	}
	else
	{
		echo mysql_error();
	}

}
?> 
