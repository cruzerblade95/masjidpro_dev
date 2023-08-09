<?php
include("../connection/connection.php");
//require_once('../connection/connection.php'); 
if (isset($_POST['delete']) && isset($_POST['del']))
echo 'del';
{
$id=$_POST['del'];

// Delete data in mysql from row that has this id
$sql="DELETE FROM minit_mensyuarat WHERE id='$id' ";
$result=mysql_query($sql);

if($result){
header('Location: ../utama.php?view=minitmensyuarat');  
 }
echo "error"; 
}
?>


