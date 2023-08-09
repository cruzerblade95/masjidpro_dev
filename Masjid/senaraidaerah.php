<?php
require_once('connection/connection.php');
// Connect to server and select database.

$negeri=intval($_GET['negeri']);

$sql="SELECT * FROM sej6x_data_masjid WHERE id_negeri='$negeri' AND jenis_masjid='MASJID MUKIM / KARIAH' GROUP BY daerah ORDER BY no_daerah ASC";
$sqlquery=mysqli_query($bd2, $sql);

echo "<h4><u>MASJID KARIAH</u></h4>";
echo "<br>";
while($data=mysqli_fetch_array($sqlquery))
{
	echo 
	"<div class='col-lg-8'>
		<div class='form-group'>
			<button class='btn btn-success btn-block' value='$data[daerah]' onClick='showMasjid(this.value)'>$data[daerah]</button>
		</div>
	</div>";
}
echo "</select>";

