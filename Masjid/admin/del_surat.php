<?php

    include ('../connection/connection.php');

    $id_surat = $_GET['id_surat'];

    $sql = "DELETE FROM surat_rasmi  WHERE id_surat='$id_surat'";
    $sqlquery = mysqli_query($bd2,$sql);

    if($sqlquery)
    {
        header("Location:../utama.php?view=admin&action=rekod_surat_rasmi");
    }
?>