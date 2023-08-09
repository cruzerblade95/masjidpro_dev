<?php

include('../connection/connection.php');
$sql = "DELETE FROM sej6x_data_aktivitifail WHERE ID = '".$_POST["id"]."'";
if(mysqli_query($bd2, $sql))
{
    echo 'Fail Berjaya Dipadam';
}
?>