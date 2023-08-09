<?php

    include('../connection/connection.php');

    $ID = $_GET['id'];
    $sql = "SELECT * FROM sej6x_data_aktivitifail WHERE ID='$ID'";
    $sqlquery = mysqli_query($bd2,$sql);
    $data = mysqli_fetch_array($sqlquery);
    header('Content-type: '.$data['jenis_fail']);
    echo $data['fail'];

?>