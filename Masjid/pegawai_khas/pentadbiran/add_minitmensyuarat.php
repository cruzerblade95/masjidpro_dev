<?php
include("../connection/connection.php");
// Connect to server and select database.



$name= $_FILES['file']['name'];

$tmp_name= $_FILES['file']['tmp_name'];

//$submitbutton= $_POST['submit'];

$position= strpos($name, "."); 

$fileextension= substr($name, $position + 1);

$fileextension= strtolower($fileextension);

$description= $_POST['description'];
$tarikh=$_POST['tarikh'];

if (isset($name)) {

$path= '../Mensyuarat/files/';

if (!empty($name)){
if (move_uploaded_file($tmp_name, $path.$name)) {
echo 'Berjaya!';

}
}
}

if(!empty($description)){
mysql_query("INSERT INTO minit_mensyuarat (id,id_masjid,tarikh,description, filename)
VALUES ('','0','$tarikh','$description','$name')");
}
header("Location: ../utama.php?view=minitmensyuarat");  

?>