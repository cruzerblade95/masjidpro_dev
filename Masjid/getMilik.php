<?php
require_once('connection/connection.php');
// Connect to server and select database.

$id_milik=intval($_GET['id_milik']);

if($id_milik==5){
    ?>
    <label style='color: red'>*</label><b>Lain-Lain Pemilikan</b>
    <input type='text' class='form-control' name='pemilikan2' id='pemilikan2' value='<?php echo $kemas['pemilikkan2']; ?>' required>
    <?php
}
?>
