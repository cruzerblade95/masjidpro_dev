<?php
require_once('../connection/connection.php');
// Connect to server and select database.

$negeri = intval($_GET['negeri']);
$daerah = intval($_GET['daerah']);

$sql = "SELECT * FROM daerah WHERE id_negeri='$negeri'";
$sqlquery = mysqli_query($bd2, $sql);
?>
<label style="color: red">*</label><b>Daerah</b>
<select class="form-control" name="id_daerah" id="id_daerah" required>
    <option value="">Sila Pilih Daerah</option>
    <?php while($data = mysqli_fetch_assoc($sqlquery)) { ?>
        <option value="<?php echo($data['id_daerah']); ?>" <?php if($data['id_daerah'] == $daerah) echo('selected'); ?>><?php echo($data['nama_daerah']); ?></option>
    <?php } ?>
</select>

