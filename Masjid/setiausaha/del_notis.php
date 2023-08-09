<?php
include("../connection/connection.php");
//require_once('../connection/connection.php'); 
if (isset($_POST['delete']) && isset($_POST['passdel']))
echo 'passdel';
{
$id=$_POST['passdel'];

// Delete data in mysql from row that has this id
$sql="DELETE FROM notis WHERE id='$id' ";
$result=mysql_query($sql);

if($result){
header('Location: ../utama.php?view=suratnotis');  
 }
echo "error"; 
}
?>


