<?php
	include ('connection/connection.php');
	
	$negeri=intval($_GET['negeri']);
	
	$sql="SELECT * FROM sej6x_data_masjid WHERE id_negeri='$negeri' AND jenis_masjid='MASJID NEGERI'";
	$sqlquery=mysqli_query($bd2, $sql);

?>
<h4><u>MASJID NEGERI</u></h4>
<br>
<div class="table-responsive">          
	<table class="table">
		<thead>
			<tr>
				<th bgcolor="#5cb85c">BIL</th>
				<th bgcolor="#5cb85c">NAMA MASJID</th>
				<th bgcolor="#5cb85c">KOD MASJID</th>
				<th bgcolor="#5cb85c"></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i=1;
		$bil_function = 0;
		while($data=mysqli_fetch_array($sqlquery))
		{
		?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $data['nama_masjid']; ?></td>
				<td><?php echo $data['kod_masjid']; ?></td>
				<td><a class="btn btn-success" href="login.php?kod_masjid=<?php echo $data['kod_masjid'] ;?>">Log Masuk</a></td>
				<!-- <td><button class="btn btn-success" onClick="myFunction<?php //echo $i;?>()">Copy</button></td> -->
			</tr>		
		<?php
			$i++;
			$bil_function = $bil_function + 1;
		}
		?>
		</tbody>
	</table>
</div>
<script>
<?php 
for($j=1;$j<=$bil_function; $j++)
{
?>
function myFunction<?php echo $j;?>() {
  var copyText = document.getElementById("data_kodmasjid<?php echo $j; ?>");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  //alert("Copied the text: " + copyText.value);
}
<?php
}
?>
</script>