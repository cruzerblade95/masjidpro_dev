<?php
require_once('connection/connection.php');
// Connect to server and select database.

$negeri=intval($_GET['negeri']);

$sql="SELECT * FROM daerah WHERE id_negeri='$negeri'";
$sqlquery=mysqli_query($bd2, $sql);

$sql1="SELECT * FROM negeri WHERE id_negeri='$negeri'";
$sqlquery1=mysqli_query($bd2, $sql1);
$data1=mysqli_fetch_array($sqlquery1);
$nama_negeri=$data1['name'];

echo "<h4><u>".$nama_negeri."</u></h4>";
echo "<br>";
while($data=mysqli_fetch_array($sqlquery))
{
	echo 
	"<div class='col-lg-4'>
		<div class='form-group'>
			<button class='btn btn-success btn-block' value='$data[id_daerah]' onClick='showMasjid(this.value)'>$data[nama_daerah]</button>
		</div>
	</div>";
}
echo "</select>";

