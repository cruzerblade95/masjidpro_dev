<?php
include("../connection/connection.php");
//require_once('../connection/connection.php'); 
if (isset($_POST['delete']) && isset($_POST['del']))
//echo 'del';
{
$id_penyelenggara=$_POST['id_penyelenggara'];

// Delete data in mysql from row that has this id
$sqldel="DELETE FROM penyelenggara WHERE id_penyelenggara='$id_penyelenggara' ";
$result=mysqli_query($bd2,$sqldel);

if($result){
header('Location: ../utama.php?view=admin&action=maklumatselenggara&sideMenu=masjid');
 }
echo "error"; 
}
?>


