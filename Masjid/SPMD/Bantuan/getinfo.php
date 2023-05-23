<?php
	include ('../../connection/connection.php');
	
	if($_GET['id_bantuan'])
	{
		$id_bantuan = $_GET['id_bantuan']; 
		$sql_info = "SELECT * FROM bantuan_zakat WHERE id_bantuan='$id_bantuan'";
		$query_info = mysqli_query($bd2,$sql_info);
		$data_info = mysqli_fetch_array($query_info);
?>
	<div class="col-12">
		<div class="row">
			<div class="alert alert-info col-12" role="alert">
				<center>
					<?php
					$status_ambil = $data_info['status_ambil'];
					?>
					<u>MAKLUMAT BANTUAN</u><hr>
					Tarikh Ambil Bantuan&nbsp;;&nbsp;<?php echo $data_info['tarikh_bantuan']; ?><br>
					Kaedah Pembayaran&nbsp;:&nbsp;<?php echo $data_info['kaedah_bayar']; ?><br>
					Amaun/Item&nbsp;:&nbsp;<?php echo $data_info['amaun']; ?><br>
					Status Bantuan&nbsp;:&nbsp;<?php if($status_ambil==1) { echo "<b>BANTUAN SUDAH DIAMBIL</b>"; }else if($status_ambil==0) { echo "<b>BANTUAN BELUM DIAMBIL</b>"; }?><br>
					Catatan&nbsp;:&nbsp;<?php echo $data_info['sebab_lain']; ?>
				</center>
			</div>
		</div>
	</div>
<?php
	}
?>