<?php
if(isset($_GET['id_bantuan']))
{
	$id_bantuan = $_GET['id_bantuan'];
	
?>
<form action="admin/reject_bantuan.php" id="reject_form" name="reject_form" class="form-horizontal form-bordered" method="POST">
	<div class="form-body">
		<div class="form-group row">
			<label class="control-label text-right col-md-3">Sebab Permohonan Ditolak</label>
			<div class="col-md-9">
				<textarea name="remark" oninput="this.value = this.value.toUpperCase()" class="form-control" rows="4" required></textarea>
			</div>
		</div>
		<input type="hidden" name="id_bantuan" value="<?php echo $id_bantuan; ?>">
		<div class="form-group row">
			<div class="col-md-4 offset-4">
				<center>
				<button type="submit" name="tolak_bantuan" class="btn btn-success">Tolak Permohonan</button>
				</center>
			</div>
		</div>
	</div>
</form>
<?php 
} 
?>
