<?php
include("../connection/connection.php");
if (isset($_POST['delete']) && isset($_POST['del']))
//echo 'del';
{
 $id=$_POST['del'];
 $id_masjid=$_POST['id_masjid'];

// Delete data in mysql from row that has this id
 $sqldel="DELETE FROM jawatan_pengurusan_masjid WHERE id_masjid = $id_masjid AND id_jawatan='$id' ";
 $result=mysqli_query($bd2, $sqldel);

 if($result){
  header('Location: ../utama.php?view=admin&action=jawatan_pengurusan&sideMenu=organisasi');
  exit;
 }
 echo "error";
}
?>


