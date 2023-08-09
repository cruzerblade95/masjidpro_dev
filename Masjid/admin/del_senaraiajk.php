<?php
include("../connection/connection.php");
//require_once('../connection/connection.php'); 
if (isset($_POST['delete']) && isset($_POST['del']))
//echo 'del';
{
$id_dataajk=$_POST['del'];

// Delete data in mysql from row that has this id
$sqldel="DELETE FROM data_ajkmasjid WHERE id_masjid = $id_masjid AND id_dataajk='$id_dataajk'";
$result=mysqli_query($bd2, $sqldel);

if($result){
header('Location: ../utama.php?view=admin&action=senarai_ajk');  
 }
echo "error"; 
}
?>


