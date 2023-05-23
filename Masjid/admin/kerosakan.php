<?php
if($_GET['action']=="kerosakan")
{
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Borang Kerosakan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
					<li class="active">Borang Kerosakan</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<div class="content mt-3">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
				   Maklumat Kerosakan
				</div>
				<div class="card-body">
					<div class="panel-body">
						<form method="POST" action="admin/add_kerosakan.php" name="kerosakan">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>Tarikh Kerosakan</label>
									<input class="form-control" type="date" name="tarikh_kerosakan" required>	            
								</div>
								<div class="form-group">
									<label>Masa Kerosakan</label>
									<input class="form-control" type="time" name="masa_kerosakan" required>	
								</div>
								<div class="form-group">
									<label>Jenis Kerosakan</label>
									<input class="form-control" name="jenis_kerosakan"required>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Catatan Kerosakan</label>
									<textarea class="form-control" rows="2" name="catatan_kerosakan"></textarea>
								</div>
								<div class="form-group">
									<label>Catatan Tindakan</label>
									<textarea class="form-control" rows="2" name="catatan_tindakan"></textarea>
								</div>
							</div>
							<div class="col-lg-12" align="center">
								<button type="submit" class="btn btn-primary">Simpan</button>
								<button type="reset" class="btn btn-primary">Padam</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>