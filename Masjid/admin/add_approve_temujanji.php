<?php

include('../connection/connection.php');
include('../fungsi.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = e($_POST['id'], NULL, NULL);
    $status = e($_POST['status'], NULL, NULL);
    $nota = e($_POST['nota'], 1, NULL);

    $sql = "UPDATE sej6x_data_temujanji SET status='$status', nota = '$nota' WHERE ID=$id";
    $sqlquery = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));

}
    header("Location: ../utama.php?view=admin&action=approve_temujanji");
?>
