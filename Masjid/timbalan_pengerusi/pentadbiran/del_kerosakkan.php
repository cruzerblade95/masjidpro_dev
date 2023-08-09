<?php
include("../connection/connection.php");
//require_once('../connection/connection.php'); 
if (isset($_POST['delete']) && isset($_POST['del']))
//echo 'del';
{
$id_kerosakkan=$_POST['del'];

// Delete data in mysql from row that has this id
$sqldel="DELETE FROM sej6x_data_kerosakkan WHERE id_kerosakkan='$id_kerosakkan' ";
$result=mysql_query($sqldel);

if($result){
header('Location: ../utama.php?view=maklumatkerosakan');  
 }
echo "error"; 
}
?>


