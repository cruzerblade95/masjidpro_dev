<?php

    include('../connection/connection.php');

?>
<html>
<head>
    <style>
        div.gallery {
            margin: 5px;
            border: 1px solid #ccc;
            float: left;
            width: 180px;
        }

        div.gallery:hover {
            border: 1px solid #777;
        }

        div.gallery img {
            width: 100%;
            height: auto;
        }

        div.desc {
            padding: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="gallery">
    <?php
    $id_aktiviti = $_GET['id_aktiviti'];
    $sql = "SELECT * FROM sej6x_data_aktivitifail WHERE id_aktiviti='$id_aktiviti'";
    $result = mysqli_query($bd,$sql);
    $row = mysqli_fetch_array($result);
    header("Content-type: " . $row["jenis_fail"]);
    echo $row["fail"];
    ?>
</div>

</body>
</html>