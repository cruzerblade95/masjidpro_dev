<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Senarai Bayaran</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=dashboard_payment">Dashboard Statistik Bayaran</a></li>
					<li class="active">Senarai Bayaran</li>
				</ol>
			</div>
		</div>
	</div>
</div> 
<script src="js/jquery-3.4.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#table_bayaran').DataTable();
} );
</script>
<div class="content mt-3">
	<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
					Senarai Bayaran
				</div> 
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="table_bayaran">
							<thead>
								<tr>
									<th><div align="center">No.</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">No.K/P</div></th>
									<th><div align="center">No.H/P</div></th>
									<th><div align="center">Amaun Bayaran</div></th>
									<th><div align="center">Tarikh/Masa Bayaran</div></th>
								</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							$jenis_bayaran=$_GET['jenis_bayaran'];
							$status_bayaran=$_GET['status_bayaran'];
							$sql="SELECT * FROM sej6x_bayar_online WHERE id_masjid='$id_masjid' AND jenis_bayaran='$jenis_bayaran' AND status_bayaran='1'";
							if(isset($_GET['dari']) AND isset($_GET['hingga']))
							{
								$tarikh_awal = $_GET['dari'];
								$tarikh_akhir = $_GET['hingga'];
								$sql.= " AND tarikh_bayaran BETWEEN CAST('$tarikh_awal 00:00:00' AS DATETIME) AND CAST('$tarikh_akhir 23:59:59' AS DATETIME)";
							}
							$sqlquery=mysql_query($sql,$bd);
							while($data=mysql_fetch_array($sqlquery))
							{
							?>
								<tr>
									<td align="center"><?php echo $x; ?></td>
									<td align="center"><?php echo $data['nama_penuh']; ?></td>
									<td align="center"><?php echo $data['no_kp']; ?></td>
									<td align="center"><?php echo $data['no_hp']; ?></td>
									<td align="center"><?php echo "RM ".$data['amaun']; ?></td>
									<td align="center"><?php echo $data['tarikh_bayaran']; ?></td>
								</tr>  
							<?php
							$x++;
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

 
                                         
                                
