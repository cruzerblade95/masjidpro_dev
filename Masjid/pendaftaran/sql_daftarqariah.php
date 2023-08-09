<?php
include("connection/connection.php");

// Connect to server and select database.

$nama_penuh=$_POST['nama_penuh'];
$no_ic=$_POST['no_ic'];
$tarikh_lahir=$_POST['tarikh_lahir'];
$warganegara=$_POST['warganegara'];
$umur=$_POST['umur'];
$bangsa=$_POST['bangsa'];
$status_perkahwinan=$_POST['status_perkahwinan'];
$status=$_POST['status'];
$tahap_pendidikan=$_POST['tahap_pendidikan'];
$sekolah_institusi=$_POST['sekolah_institusi'];
$no_hp=$_POST['no_hp'];
$no_rumah=$_POST['no_rumah'];

$alamat_terkini=$_POST['alamat_terkini'];
$poskod=$_POST['poskod'];
$id_daerah=$_POST['id_daerah'];
$id_negeri=$_POST['id_negeri'];
$zon_qariah=$_POST['zon_qariah'];
$bil_tanggungan=$_POST['bil_tanggungan'];
$data_umum=$_POST['data_umum'];
$data_undi=$_POST['data_undi'];
$status=$_POST['status'];
$data_ajk=$_POST['data_ajk'];
$data_asnaf=$_POST['data_asnaf'];
$data_ibutunggal=$_POST['data_ibutunggal'];
$data_anakyatim=$_POST['data_anakyatim'];

$data_cerai=$_POST['data_cerai'];
$data_kematian=$_POST['data_kematian'];
$data_khairat=$_POST['data_khairat'];
$data_nikah=$_POST['data_nikah'];
$data_asnaf=$_POST['data_asnaf'];
$data_oku=$_POST['data_oku'];
$id_bapa=$_POST['id_bapa'];

$id_ibu=$_POST['id_ibu'];
$last_added=$_POST['last_added'];

$q ="INSERT INTO sej6x_data_peribadi(id_masjid, nama_penuh, no_ic, tarikh_lahir, warganegara, umur, bangsa, status_perkahwinan, status, tahap_pendidikan, sekolah_institusi, no_hp, no_rumah, alamat_terkini, poskod, id_daerah, id_negeri, zon_qariah, bil_tanggungan, data_umum, data_undi, data_ajk, data_asnaf, data_ibutunggal, data_anakyatim, data_cerai, data_kematian, data_khairat, data_nikah, data_oku, id_bapa, id_ibu, last_added)

 VALUES ($id_masjid, '$nama_penuh', '$no_ic', '$tarikh_lahir', $warganegara, $umur, $bangsa, $status_perkahwinan, '0', $tahap_pendidikan, '0', '$no_hp', '$no_rumah', '$alamat_terkini', '$poskod', $id_daerah, $id_negeri, '$zon_qariah', $bil_tanggungan, '0', '0', '0', '0', '0', '0', '0', '0', '0','0', '0', '0', '0', NOW())";
$r = mysql_query($q,$conn);
if($r)
{
echo "Data Masuk";
}
else
{
echo mysql_error();
}


?> 
