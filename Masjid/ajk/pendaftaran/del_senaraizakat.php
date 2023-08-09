<?php
include("../connection/connection.php");
//require_once('../connection/connection.php'); 
if (isset($_POST['delete']) && isset($_POST['del']))
//echo 'del';
{
$id_zakat=$_POST['del'];

// Delete data in mysql from row that has this id
$sqldel="DELETE FROM sej6x_data_zakat WHERE id_zakat='$id_zakat' ";
$result=mysql_query($sqldel);

if($result){
header('Location: ../utama.php?view=senarai_zakat');  
 }
echo "error"; 
}
?>


