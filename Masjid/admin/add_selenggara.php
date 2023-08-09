<?php
require_once('../connection/connection.php');

// Connect to the server and select the database.

$selectedValues = $_POST['kat_peralatan']; // Get the selected values as an array

$id_masjid = $id_masjid;
$kat_penyelenggara = $_POST['kat_penyelenggara'];
$no_telefon = $_POST['no_telefon'];
$tempoh_perkhidmatan = $_POST['tempoh_perkhidmatan'];
//$kat_peralatan = $_POST['kat_peralatan'];

$nama_ajkmasjid = $_POST['nama_ajkmasjid'];
$nama_vendor = $_POST['nama_vendor'];

if ($nama_ajkmasjid != '') {
    $nama_penyelenggara = $nama_ajkmasjid;
} else {
    $nama_penyelenggara = $nama_vendor;
}

$jenis_peralatan = $_POST['jenis_peralatan'];
if($jenis_peralatan == 'other') {

    $otherInput = $_POST['otherInput'];
    $jenis_peralatanLain = $otherInput;

    $sql_catTool = "INSERT INTO sej6x_data_jenisinventori (jenis_inventori, id_masjid) VALUE ('$jenis_peralatanLain', '$id_masjid')";
    $r_catTool = mysqli_query($bd2, $sql_catTool);
    $jenis_peralatan = mysqli_insert_id($bd2);
}
// Combine selected values into a comma-separated string
//$kat_peralatan = implode(',', $selectedValues);

// Prepare the insert query
$query = "INSERT INTO penyelenggara (id_masjid, kat_penyelenggara, nama_penyelenggara, kat_peralatan, no_telefon, tempoh_perkhidmatan) 
            VALUES ('$id_masjid', '$kat_penyelenggara', '$nama_penyelenggara', '$jenis_peralatan', '$no_telefon', '$tempoh_perkhidmatan')";

$sql1 = mysqli_query($bd2, $query) or die("SQL error: " . $query . mysqli_error($bd2));

header("Location: ../utama.php?view=admin&action=maklumatselenggara&sideMenu=masjid");
?>
