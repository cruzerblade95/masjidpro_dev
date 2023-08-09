<?php

include('../connection/connection.php');
include ("../fungsi.php");
if(isset($_GET['id']))
{
    $id_data = $_GET['id'];
    $q2 = "SELECT * FROM approve_qariah WHERE id = $id_data";
    selValueSQL($q2, 'kariah');
    ?>
    <input type="hidden" name="del" value="<?php echo $id_data; ?>">
    <input type="hidden" name="nama_penuh" value="<?php echo($row_kariah['nama_penuh']); ?>">
    <input type="hidden" name="no_ic" value="<?php echo($row_kariah['no_ic']); ?>">
    <input type="hidden" name="firebase_token" value="<?php echo($row_kariah['firebase_token']); ?>">
    <?php
}
?>
