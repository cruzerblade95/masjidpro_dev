<?php
include("../connection/connection.php");
// Connect to server and select database.



$name= $_FILES['file']['name'];

$tmp_name= $_FILES['file']['tmp_name'];

$submitbutton= $_POST['submit'];

$position= strpos($name, "."); 

$fileextension= substr($name, $position + 1);

$fileextension= strtolower($fileextension);

$description= $_POST['description'];
$tarikh=$_POST['tarikh'];

if (isset($name)) {

$path= '../Uploads/files/';

if (!empty($name)){
if (move_uploaded_file($tmp_name, $path.$name)) {
echo 'Berjaya!';

}
}
}

if(!empty($description)){
mysqli_query($bd2,"INSERT INTO laporan_aktiviti (id_masjid,tarikh,description, filename)
VALUES ('$id_masjid','$tarikh','$description','$name')");
}
header("Location: ../utama.php?view=admin&action=laporanaktiviti");  

?>