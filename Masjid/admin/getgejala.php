<?php 
require_once('../connection/connection.php');
// Connect to server and select database.

$no_ic=$_GET['no_ic'];

$sql="SELECT * FROM sej6x_data_gejala WHERE no_ic='$no_ic' GROUP BY time";
$sqlquery=mysql_query($sql,$bd);
?>
<div class="row">
	<div class="col-lg-2">
	</div>
	<div class="col-lg-8">
	<div class="table-responsive">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th><div align="center">#</div></th>
						<th><div align="center">Suhu Badan</div></th>
						<th><div align="center">Gejala</div></th>
						<th><div align="center">Tarikh/Masa</div></th>
					</tr>
				</thead>
				<tbody>	
					<?php
					$i=1;
					while($data=mysql_fetch_array($sqlquery))
					{
					?>
					<tr>
						<td align="center"><?php echo $i; ?></td>
						<td align="center"><?php echo $data['suhu']."°C"; ?></td>
						<td>
						<?php 
						$id_jenis_gejala=$data['id_jenis_gejala']; 
						$time=$data['time'];
						//$sql2="SELECT * FROM sej6x_jenis_gejala WHERE id_jenis_gejala='$id_jenis_gejala'";
						$sql2="SELECT a.id_jenis_gejala, b.gejala FROM sej6x_data_gejala a, sej6x_jenis_gejala b WHERE a.time='$time' AND a.id_jenis_gejala=b.id_jenis_gejala";
						$sqlquery2=mysql_query($sql2,$bd);
						//echo mysql_num_rows($sqlquery2);
						while($data2=mysql_fetch_array($sqlquery2))
						{
							echo $data2['gejala']."<br>";
						}
						
						
						?>
						</td>
						<td><?php echo $data['time']; ?></td>
					</tr>
					<?php
					$i++;
					}
					?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div> 