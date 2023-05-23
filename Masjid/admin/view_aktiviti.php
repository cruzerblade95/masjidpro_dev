<?php

include('../connection/connection.php');

?><html>
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

<?php
if(isset($_GET['id_aktiviti'])) {
    $id_aktiviti = $_GET['id_aktiviti'];
    $sql = "SELECT * FROM sej6x_data_aktivitifail WHERE id_aktiviti='$id_aktiviti'";
}
else if(isset($_GET['ID'])) {
    $ID = $_GET['ID'];
    $sql = "SELECT * FROM sej6x_data_aktivitifail WHERE ID='$ID'";
}
$result = mysqli_query($bd2,$sql);

while($row = mysqli_fetch_array($result))
{
    ?>
        <img src="imageFail.php?id=<?php echo $row['ID']; ?>" width="100px" height="100px">

    <?php
}
?>


</body>
</html>

