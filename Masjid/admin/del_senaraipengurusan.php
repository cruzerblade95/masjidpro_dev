<?php
include("../connection/connection.php");
//require_once('../connection/connection.php');
if (isset($_POST['delete']) && isset($_POST['del']))
//echo 'del';
{
    $id_pengurusan=$_POST['del'];

// Delete data in mysql from row that has this id
    $sqldel="DELETE FROM data_pengurusan_masjid WHERE id_pengurusan='$id_pengurusan' ";
    $result=mysqli_query($bd2,$sqldel);

    if($result){
        header('Location: ../utama.php?view=admin&action=senarai_pengurusan');
    }
    //echo "error";
}
?>


