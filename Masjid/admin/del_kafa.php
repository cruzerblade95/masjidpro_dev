<?php
include("../connection/connection.php");
//require_once('../connection/connection.php'); 
if (isset($_POST['delete']) && isset($_POST['del']))
//echo 'del';
{
$id=$_POST['del'];

// Delete data in mysql from row that has this id
$sqldel="DELETE FROM sej6x_data_kafa WHERE id_masjid = $id_masjid AND id='$id' ";
$result=mysqli_query($bd2, $sqldel);

if($result){
header('Location: ../utama.php?view=admin&action=kafa');  
 }
echo "error"; 
}
?>


