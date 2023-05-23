<?php
require_once('../connection/connection.php');
// Connect to server and select database.

$jenis_inventori=$_POST['jenis_inventori'];
$nama_inventori=$_POST['nama_inventori'];
$tarikh_belian=$_POST['tarikh_belian'];
$kuantiti=$_POST['kuantiti'];
$peratus=$_POST['peratus'];
$bil_tahun=$_POST['bil_tahun'];
$harga_belian=$_POST['harga_belian'];
//$no_rujukan=$_POST['no_rujukan'];
$status_belian=$_POST['status_belian'];
$catatan=$_POST['catatan'];

$lokasi=$_POST['lokasi'];
$id_ajk=$_POST['id_ajk'];
$harga_sewa=$_POST['harga_sewa'];

if($jenis_inventori==1)
{
	$f=substr('PERKAKAS DAPUR', 0, 2); // pre defined function of php	
}
else if($jenis_inventori==2)
{
	$f=substr('PERALATAN', 0, 2); // pre defined function of php
}
else if($jenis_inventori==3)
{
	$f=substr('ELEKTRIK', 0, 2); // pre defined function of php
}
else if($jenis_inventori==4)
{
	$f=substr('PERABOT', 0, 2); // pre defined function of php
}
else if($jenis_inventori==5)
{
	$f=substr('KENDERAAN', 0, 2); // pre defined function of php
}
else if($jenis_inventori==6)
{
	$f=substr('LAIN-LAIN', 0, 2); // pre defined function of php
}
echo '<br>';
echo $m=date('m'); // Get the month
echo '<br>';
echo $y=date('y'); // Get the dat
echo '<br>';
echo $d=date('d'); // Get the Year
echo '<br>';
echo '<br>';

// Get the rows count
$GetSidNo=mysqli_query($bd2, "SELECT * FROM sej6x_data_inventori WHERE id_masjid='$id_masjid'");
$GetSidNo1=mysqli_num_rows($GetSidNo);
$invID = str_pad($GetSidNo1, 4, '0', STR_PAD_LEFT);

$no_rujukan=$f.$y.$m.$d.$invID;

$t=time();


//date($variable, 'd-m-Y H:i:s');



echo $inventori="INSERT INTO sej6x_data_inventori
(id_masjid,jenis_inventori,nama_inventori,tarikh_belian,kuantiti,harga_belian,peratus,bil_tahun,no_rujukan,status_belian,catatan,lokasi,id_ajk,harga_sewa,susut_nilai,id_lantikkan)
VALUES ('$id_masjid','$jenis_inventori','$nama_inventori','$tarikh_belian','$kuantiti','$harga_belian','0','0','$no_rujukan','$status_belian','$catatan','$lokasi','$id_ajk','$harga_sewa','0','0')";

$sewa= "INSERT INTO status_barang (no_barang,id_masjid,status_nama_perkara,status_nama,status_lokasi,status_luas_kuantiti,status_harga_sewa,status) 
VALUES('$no_rujukan','$id_masjid','$jenis_inventori','$nama_inventori','$lokasi','$kuantiti','$harga_sewa','ADA')";


$r = mysqli_query($bd2, $inventori);
$r = mysqli_query($bd2, $sewa);
if($r)
{
	header("Location: ../utama.php?view=admin&action=maklumatinventori");  
}
else
{
echo mysqli_error($bd2);
}


?>