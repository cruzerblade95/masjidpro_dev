<?php
include("../connection/connection.php");
//require_once('../connection/connection.php'); 
if (isset($_POST['delete']) && isset($_POST['del']))
//echo 'del';
{
$id_data=$_POST['del'];

// Delete data in mysql from row that has this id
$sqldel="DELETE FROM sej6x_data_peribadi WHERE id_data='$id_data' ";
$result=mysql_query($sqldel);

if($result){
header('Location: ../utama.php?view=admin&view=pendaftaran_ahli_qariah');  
 }
echo "error"; 
}
?>


