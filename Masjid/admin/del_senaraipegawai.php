<?php
include("../connection/connection.php");
if (isset($_POST['delete']) && isset($_POST['del']) && is_numeric($_POST['del'])) {
$id_datapegawai=$_POST['del'];

// Delete data in mysql from row that has this id
$sqldel="DELETE FROM data_pegawai_masjid WHERE id_datapegawai='$id_datapegawai' ";
$result=mysqli_query($bd2, $sqldel);

if($result){
header('Location: ../utama.php?view=admin&action=senarai_pegawai');  
 }
echo "error"; 
}
?>


