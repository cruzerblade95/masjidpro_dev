<?php

include ('../connection/connection.php');

$id_komunitiList = $_POST['id_komunitiList'] != NULL ? $_POST['id_komunitiList'] : $_GET['id_komunitiList'];
if(is_numeric($id_komunitiList)) {
    $status = $_POST['status'];
    $sebab = $_POST['sebab'];

    if($_GET['del'] == 1) $sql = "DELETE FROM komuniti_list WHERE id_komunitiList = '$id_komunitiList' AND id_masjid = ".$_SESSION['id_masjid'];
    else $sql = "UPDATE komuniti_list SET sebab = '$sebab', status_approved='$status', responsDate = NOW() WHERE id_komunitiList='$id_komunitiList' AND id_masjid = ".$_SESSION['id_masjid'];
    $sqlquery = mysqli_query($bd2,$sql);

    if($sqlquery){
        ?>
        <script LANGUAGE='JavaScript'>
            <?php
            if($status==1){
            ?>
            window.alert('Permohonan Diluluskan');
            <?php
            }
            else if($status==2){
            ?>
            window.alert('Permohonan Ditolak');
            <?php
            }
            ?>
            window.location.href='../utama.php?view=admin&action=komuniti_ekonomi';
        </script>
        <?php
    }
}
header("Location: ../utama.php?view=admin&action=komuniti_ekonomi");
exit;
?>