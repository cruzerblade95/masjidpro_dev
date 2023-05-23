<?php
if ($tengoklah != 1) die ("You are not allowed to view this file!");
$id_masjid = $_POST['id_masjid'.$prefix_borang];
    $id_data = $_POST['id_data'.$prefix_borang];
	$nama_penuh = strtoupper($_POST['nama_penuh'.$prefix_borang]);
	$no_ic = strtoupper($_POST['no_ic'.$prefix_borang]);
	if($_POST['tarikh_lahir'.$prefix_borang] != NULL) $tarikh_lahir = $_POST['tarikh_lahir'.$prefix_borang]; else $tarikh_lahir = '0000-00-00';
	if($_POST['warganegara'.$prefix_borang] != NULL) $warganegara = $_POST['warganegara'.$prefix_borang]; else $warganegara = -1;
	if($_POST['umur'.$prefix_borang] != NULL) $umur = $_POST['umur'.$prefix_borang]; else $umur = -1;
	if($_POST['bangsa'.$prefix_borang] != NULL) $bangsa = $_POST['bangsa'.$prefix_borang]; else $bangsa = -1;
	if($_POST['status_perkahwinan'.$prefix_borang] != NULL) $status_perkahwinan = $_POST['status_perkahwinan'.$prefix_borang]; else $status_perkahwinan = -1;
	if($_POST['status'.$prefix_borang] != NULL) $status = $_POST['status'.$prefix_borang]; else $status = -1;
	if($_POST['tahap_pendidikan'.$prefix_borang] != NULL) $tahap_pendidikan = $_POST['tahap_pendidikan'.$prefix_borang]; else $tahap_pendidikan = -1;
	if($_POST['sekolah_institusi'.$prefix_borang] != NULL) $sekolah_institusi = strtoupper($_POST['sekolah_institusi'.$prefix_borang]); else $sekolah_institusi = "";
	if($_POST['no_hp'.$prefix_borang] != NULL) $no_hp = $_POST['no_hp'.$prefix_borang]; else $no_hp = "";
	if($_POST['no_rumah'.$prefix_borang] != NULL) $no_rumah = $_POST['no_rumah'.$prefix_borang]; else $no_rumah = "";
	if($_POST['alamat_terkini'.$prefix_borang] != NULL) $alamat_terkini = strtoupper($_POST['alamat_terkini'.$prefix_borang]); else $alamat_terkini = "";
	if($_POST['poskod'.$prefix_borang] != NULL) $poskod = $_POST['poskod'.$prefix_borang]; else $poskod = "";
	if($_POST['id_daerah'.$prefix_borang] != NULL) $id_daerah = $_POST['id_daerah'.$prefix_borang]; else $id_daerah = -1;
	if($_POST['id_negeri'.$prefix_borang] != NULL) $id_negeri = $_POST['id_negeri'.$prefix_borang]; else $id_negeri = -1;
	if($_POST['zon_qariah'.$prefix_borang] != NULL) $zon_qariah = strtoupper($_POST['zon_qariah'.$prefix_borang]); else $zon_qariah = -1;
	if($_POST['bil_tanggungan'.$prefix_borang] != NULL) $bil_tanggungan = $_POST['bil_tanggungan'.$prefix_borang]; else $bil_tanggungan = -1;
	if($_POST['data_umum'.$prefix_borang] != NULL) $data_umum = $_POST['data_umum'.$prefix_borang]; else $data_umum = "0";
	if($_POST['data_ajk'.$prefix_borang] != NULL) $data_ajk = $_POST['data_ajk'.$prefix_borang]; else $data_ajk = "0";
	if($_POST['data_undi'.$prefix_borang] != NULL) $data_undi = $_POST['data_undi'.$prefix_borang]; else $data_undi = "0";
	if($_POST['data_asnaf'.$prefix_borang] != NULL) $data_asnaf = $_POST['data_asnaf'.$prefix_borang]; else $data_asnaf = "0";
	if($_POST['data_ibutunggal'.$prefix_borang] != NULL) $data_ibutunggal = $_POST['data_ibutunggal'.$prefix_borang]; else $data_ibutunggal = "0";
	if($_POST['data_anakyatim'.$prefix_borang] != NULL) $data_anakyatim = $_POST['data_anakyatim'.$prefix_borang]; else $data_anakyatim = "0";
	if($_POST['data_cerai'.$prefix_borang] != NULL) $data_cerai = $_POST['data_cerai'.$prefix_borang]; else $data_cerai = "0";
	if($_POST['data_kematian'.$prefix_borang] != NULL) $data_kematian = $_POST['data_kematian'.$prefix_borang]; else $data_kematian = "0";
	if($_POST['data_khairat'.$prefix_borang] != NULL) $data_khairat = $_POST['data_khairat'.$prefix_borang]; else $data_khairat = "0";
	if($_POST['data_nikah'.$prefix_borang] != NULL) $data_nikah = $_POST['data_nikah'.$prefix_borang]; else $data_nikah = "0";
	if($_POST['data_oku'.$prefix_borang] != NULL) $data_oku = $_POST['data_oku'.$prefix_borang]; else $data_oku = "0";
	$id_bapa = $_POST['id_bapa'.$prefix_borang];
	$id_ibu = $_POST['id_ibu'.$prefix_borang];
	
  if($id_data == NULL) $insertPeribadi = "INSERT INTO sej6x_data_peribadi (id_masjid, nama_penuh, no_ic, tarikh_lahir, warganegara, umur, bangsa, status_perkahwinan, status, tahap_pendidikan, sekolah_institusi, no_hp, no_rumah, alamat_terkini, poskod, id_daerah, id_negeri, zon_qariah, bil_tanggungan, data_umum, data_undi, data_ajk, data_asnaf, data_ibutunggal, data_anakyatim, data_cerai, data_kematian, data_khairat, data_nikah, data_oku, id_bapa, id_ibu, last_added) VALUES ($id_masjid, '$nama_penuh', '$no_ic', '$tarikh_lahir', $warganegara, $umur, $bangsa, $status_perkahwinan, $status, $tahap_pendidikan, '$sekolah_institusi', '$no_hp', '$no_rumah', '$alamat_terkini', '$poskod', $id_daerah, $id_negeri, '$zon_qariah', $bil_tanggungan, '$data_umum', '$data_undi', '$data_ajk', '$data_asnaf', '$data_ibutunggal', '$data_anakyatim', '$data_cerai', '$data_kematian', '$data_khairat', '$data_nikah', '$data_oku', $id_bapa, $id_ibu, NOW())";

if($id_data != NULL) $insertPeribadi = "UPDATE sej6x_data_peribadi SET id_masjid = $id_masjid, nama_penuh = '$nama_penuh', no_ic = '$no_ic', tarikh_lahir = '$tarikh_lahir', warganegara = $warganegara, umur = $umur, bangsa = $bangsa, status_perkahwinan = $status_perkahwinan, status = $status, tahap_pendidikan = $tahap_pendidikan, sekolah_institusi = '$sekolah_institusi', no_hp = '$no_hp', no_rumah = '$no_rumah', alamat_terkini = '$alamat_terkini', poskod = '$poskod', id_daerah = $id_daerah, id_negeri = $id_negeri, zon_qariah = '$zon_qariah', bil_tanggungan = $bil_tanggungan, data_umum = '$data_umum', data_undi = '$data_undi', data_ajk = '$data_ajk', data_asnaf = '$data_asnaf', data_ibutunggal = '$data_ibutunggal', data_anakyatim = '$data_anakyatim', data_cerai = '$data_cerai', data_kematian = '$data_kematian', data_khairat = '$data_khairat', data_nikah = '$data_nikah', data_oku = '$data_oku', id_bapa = $id_bapa, id_ibu = $id_ibu, last_added = NOW() WHERE id_data = $id_data";
  //echo($insertPeribadi.'<br />');
  mysql_select_db($database_koneksi, $koneksi);
  mysql_query($insertPeribadi, $koneksi) or die(mysql_error());
  if($id_data == NULL) $id_akhir = mysql_insert_id($koneksi);
  if($id_data != NULL) $id_akhir = $id_data;
 ?>