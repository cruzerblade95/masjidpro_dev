<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Menu Pendaftaran</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Menu Pendaftaran</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
   <div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Muat Naik Excel Ahli Kariah&nbsp;&nbsp;
				</div>
				<div class="card-body">
					<div class="col-12">
						<div class="row">
							<div class="col-6">
								<div class="row">
									<h5>Klik Ikon Untuk Muat Turun Excel:-</h5>
								</div>
								<div class="row">
									<h5><a class="btn btn-primary" href="excel/FormatKetuaKeluarga.xlsx" target="_blank"><i class="far fa-file-excel"></i>&nbsp;Ketua Keluarga</a></h5>
								</div>
								<div class="row">
									<h5><a class="btn btn-primary" href="excel/FormatAnakTanggungan.xlsx" target="_blank"><i class="far fa-file-excel"></i>&nbsp;Tanggungan</a></h5>
								</div>
							</div>
							<div class="col-6">
								<h5>Muat Naik Excel:-</h5>
                                <form action="uploadExcel.php" enctype="multipart/form-data" method="POST">
								<div class="form-group">
									<input type="radio" name="pilihExcel" value="1" checked="checked">&nbsp;Ketua Keluarga
									<input type="radio" name="pilihExcel" value="2">&nbsp;Tanggungan
								</div>
								<div class="form-group">
									<input type="file" name="uploadfile" required class="form-control">
								</div>
								<div class="form-group">
									<button class="btn btn-success" type="submit" name="uploadButton">Muat Naik</button>
								</div>
                                </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>