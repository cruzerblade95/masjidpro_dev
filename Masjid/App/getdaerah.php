<?php
require_once('../connection/connection.php');
// Connect to server and select database.

$negeri=intval($_GET['negeri']);

$sql="SELECT * FROM daerah WHERE id_negeri='$negeri'";
$sqlquery=mysql_query($sql,$bd);

echo "<label style='color: red'>*</label><b>Daerah</b>
<select class='form-control' name='id_daerah' id='id_daerah' required>
<option value='0'>Sila Pilih Daerah</option>
";
while($data=mysql_fetch_array($sqlquery))
{
	echo "<option value='$data[id_daerah]'>$data[nama_daerah]</option>";
}
echo "</select>";

