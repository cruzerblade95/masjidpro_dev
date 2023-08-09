<?php
include("../connection/connection.php");
//require_once('../connection/connection.php');
if (isset($_POST['delete']) && isset($_POST['del']))
//echo 'del';
{
    $id=$_POST['del'];
    $nokuasa = $_POST['nokuasa'];


// Delete data in mysql from row that has this id
    $sqldel="DELETE FROM rekod_organisasi WHERE id='$id'";
    $result=mysqli_query($bd2, $sqldel);

    if($result){
        if($nokuasa == '1'){
            header('Location: ../utama.php?view=admin&action=senaraiJawatankuasa_AJK&sideMenu=organisasi');
        } else if($nokuasa =='2'){
            header('Location: ../utama.php?view=admin&action=senaraiJawatankuasa_PEGAWAI&sideMenu=organisasi');
        } else{
            header('Location: ../utama.php?view=admin&action=senaraiJawatankuasa_PENGURUSAN&sideMenu=organisasi');
        }
        
    }
    echo "error";
}
?>


