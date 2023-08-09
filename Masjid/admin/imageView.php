<?php

include ('../connection/connection.php');

if(isset($_GET['id_praktikal'])) {
    $sql = "SELECT jenis_file,file_surat FROM sej6x_data_praktikal WHERE ID=". $_GET['id_praktikal'];
    $result = mysql_query($sql,$bd);
    $row = mysql_fetch_array($result);
    header("Content-type: " . $row["jenis_file"]);
    echo $row["file_surat"];
}

?>