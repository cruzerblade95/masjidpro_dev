<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Daftar Khairat</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li class="active">Daftar Khairat</li>
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
                    Carian
				</div>
				<div class="card-body">
                    <div class="row"> 
						<div class="col-lg-12">
						<form id="cari_khairat" name="cari_khairat" enctype="multipart/form-data">
							<div class="ui-widget col-md-4 col-6">
  								<label for="nama">No K/P atau Nama: </label>
  								<input class="form-control" name="nama" id="nama"><input name="no_ic" id="no_ic" type="hidden">
							</div>                     
							<div class="col-md-4 col-6">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Daftar Khairat</button> 
								</div>
							</div>
							<div class="col-md-4 col-6">
								<div class="form-group">
									<button type="button" class="btn btn-success" onClick="page_ajax('senarai_khairat', '#khairat_info', 'tunggu')">Senarai Khairat</button> 
								</div>
							</div>
						</form>
                        </div> 
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12" align="center">
			<div id="tunggu" class="col-md-12 col-12 sk-circle" style="display: none" align="center">
  <div class="sk-circle1 sk-child"></div>
  <div class="sk-circle2 sk-child"></div>
  <div class="sk-circle3 sk-child"></div>
  <div class="sk-circle4 sk-child"></div>
  <div class="sk-circle5 sk-child"></div>
  <div class="sk-circle6 sk-child"></div>
  <div class="sk-circle7 sk-child"></div>
  <div class="sk-circle8 sk-child"></div>
  <div class="sk-circle9 sk-child"></div>
  <div class="sk-circle10 sk-child"></div>
  <div class="sk-circle11 sk-child"></div>
  <div class="sk-circle12 sk-child"></div>
</div>
			<div id="khairat_info" class="card"></div>
		</div>
	</div>
</div>


                                        

                         
