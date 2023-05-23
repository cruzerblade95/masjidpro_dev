<?php 

	include("connection/connection.php"); 

	$idd = $_GET['id_kerosakkan'];
	
	//sql view selenggara
	$sql_search="SELECT * FROM sej6x_data_kerosakkan WHERE id_kerosakkan='".$idd."' "; 
	$result = mysqli_query($bd2,$sql_search) or die ("Error :".mysqli_error());
    $row = mysqli_fetch_assoc($result);
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Semak Kerosakan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=maklumatkerosakan">Laporan Kerosakan</a></li>
					<li class="active">Semak Kerosakan</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">Maklumat Kerosakan</div>
                <div class="card-body">
                    <form method="POST" action="admin/update_kerosakkan.php" name="kerosakan">
                    <div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Tarikh Kerosakan</label>
								<input class="form-control" name="tarikh_kerosakkan" type="date" value="<?php echo $row['tarikh_kerosakkan'] ?>" required>	            
							</div>																								 
							<div class="form-group">
								<label>Masa Kerosakan</label>
								<input class="form-control" name="masa_kerosakan" type="time" value="<?php echo $row['masa_kerosakan'] ?>"required>	
							</div>
							<div class="form-group">
								<label>Jenis Kerosakan</label>
								<input class="form-control" name="jenis_kerosakan" value="<?php echo $row['jenis_kerosakan'] ?>"required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Catatan Kerosakan</label>
								<input class="form-control"  name="catatan_kerosakkan" value="<?php echo $row['catatan_kerosakkan'] ?>">
							</div>
							<div class="form-group">
								<label>Catatan Tindakan</label>
								<input class="form-control"  name="catatan_tindakkan" value="<?php echo $row['catatan_tindakkan'] ?>">
							</div>
						</div>
						<div class="col-lg-12" align="center">
							<div class="form-group">
								<input type="hidden" name="id_kerosakkan" value="<?php echo $row['id_kerosakkan']; ?>">
                                <button type="submit" class="btn btn-success">Kemaskini</button>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>