<?php
	include ('connection/connection.php');
	
	$daerah=intval($_GET['daerah']);
	
	$sql="SELECT * FROM sej6x_data_masjid WHERE id_daerah='$daerah'";
	$sqlquery=mysqli_query($bd2, $sql);
	
	$sql1="SELECT * FROM daerah WHERE id_daerah='$daerah'";
	$sqlquery1=mysqli_query($bd2, $sql1);
	$data1=mysqli_fetch_array($sqlquery1);
	
	$nama_daerah=$data1['nama_daerah'];
?>
<h4><u><?php echo $nama_daerah; ?></u></h4>
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