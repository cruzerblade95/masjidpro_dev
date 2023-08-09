<?php

include('../connection/connection.php');
include('../fungsi.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_aduan = e($_POST['id_aduan']);
    $tindakkan = e($_POST['tindakkan']);

    $sql = "UPDATE data_aduan SET tindakkan = '$tindakkan' WHERE id_aduan=$id_aduan";
    $sqlquery = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));

}

header("Location: ../utama.php?view=admin&action=aduan");

?>
