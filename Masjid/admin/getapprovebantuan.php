<?php

include('../connection/connection.php');

if(isset($_GET['id_bantuan']))
{
	$id_bantuan = $_GET['id_bantuan'];

	$sql_bantuan = "SELECT * FROM bantuan_zakat WHERE id_bantuan='$id_bantuan'";
	$query_bantuan = mysqli_query($bd2,$sql_bantuan);
	$data_bantuan = mysqli_fetch_array($query_bantuan);

	$jenis_bantuan = $data_bantuan['jenis_bantuan'];
	
?>
<form action="admin/add_approve_bantuan.php" id="approve_form" name="approve_form" class="form-horizontal form-bordered" method="POST">
	<div class="form-body">
		<div class="form-group row">
			<label class="control-label text-right col-md-3">Kaedah Bayaran</label>
			<div class="col-md-9">
				<input type="text" name="kaedah_bayar" oninput="this.value = this.value.toUpperCase()" class="form-control" required>
			</div>
		</div>
		<div class="form-group row">
			<label class="control-label text-right col-md-3">Amaun/Item</label>
			<div class="col-md-9">
				<input type="text" name="amaun_bantuan" oninput="this.value = this.value.toUpperCase()" class="form-control" <?php if($jenis_bantuan=="Kewangan") { ?>readonly value="<?php echo $data_bantuan['amaun']; ?>"<?php } else { ?>required <?php } ?>>
			</div>
		</div>
		<div class="form-group row">
			<label class="control-label text-right col-md-3">Tarikh Ambil Bantuan</label>
			<div class="col-md-9">
				<input type="date" name="tarikh_bantuan" class="form-control" required>
			</div>
		</div>
		<div class="form-group row">
			<label class="control-label text-right col-md-3">Catatan Untuk Penerima</label>
			<div class="col-md-9">
				<textarea name="remark" oninput="this.value = this.value.toUpperCase()" class="form-control" rows="4" required></textarea>
			</div>
		</div>
		<input type="hidden" name="id_bantuan" value="<?php echo $id_bantuan; ?>">
		<div class="form-group row">
			<div class="col-md-4 offset-4">
				<center>
				<button type="submit" name="submit_approve" class="btn btn-success">Luluskan Permohonan</button>
				</center>
			</div>
		</div>
	</div>
</form>
<?php 
} 
?>
