<?php

include ('../connection/connection.php');

if(isset($_GET['id_praktikal']))
{
    $id_praktikal = $_GET['id_praktikal'];
?>
<img src="admin/imageView.php?id_praktikal=<?php echo $id_praktikal; ?>" />
<?php
}
?>