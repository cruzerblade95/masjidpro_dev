<?php
include("../connection/connection.php");

$id_penyelenggara=$_POST['id_penyelenggara'];

$selectedValues = $_POST['kat_peralatan']; // Get the selected values as an array
$kat_penyelenggara = $_POST['kat_penyelenggara'];
$no_telefon = $_POST['no_telefon'];
$tempoh_perkhidmatan = $_POST['tempoh_perkhidmatan'];

$nama_ajkmasjid = $_POST['nama_ajkmasjid'];
$nama_vendor = $_POST['nama_vendor'];

if ($nama_ajkmasjid !=''){
    $nama_penyelenggara = $nama_ajkmasjid;
} else {
    $nama_penyelenggara = $nama_vendor;
}

// Combine selected values into a comma-separated string
$kat_peralatan = implode(',', $selectedValues);

$query = "UPDATE penyelenggara SET kat_penyelenggara = '$kat_penyelenggara', nama_penyelenggara = '$nama_penyelenggara',
          kat_peralatan = '$kat_peralatan', no_telefon ='$no_telefon', tempoh_perkhidmatan ='$tempoh_perkhidmatan' WHERE id_penyelenggara = '$id_penyelenggara'";

	$test=mysqli_query($bd2,$query);
	if($test)
	{
		    header("location: ../utama.php?view=admin&action=maklumatselenggara&sideMenu=masjid");
	}
	else
	{
		echo mysqli_error();
	}

//}


?>