<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Menu Selenggara</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Menu Selenggara</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-4">
				<div class="card">
					<div class="card-body">
						<button class="btn btn-warning btn-lg btn-block" onClick="displayKerosakan()">
							<i class="fas fa-house-damage"></i>
							<br>Kerosakan
						</button>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card">
					<div class="card-body">
						<button class="btn btn-info btn-lg btn-block" onClick="displaySelenggara()">
							<i class="fas fa-wrench"></i>
							<br>Penyelenggaraan
						</button>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card">
					<div class="card-body">
						<button class="btn btn-success btn-lg btn-block" onClick="displayInventori()">
							<i class="fas fa-warehouse"></i>
							<br>Inventori
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="display_selenggara" style="display:none">
    <div class="content mt-3">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-6">
					<div class="card">
						<div class="card-body">
							<button class="btn btn-info btn-lg btn-block" onclick="borangSelenggara()">
								<i class="fas fa-wrench"></i>
								<br>Borang Penyelenggaraan
							</button>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card">
						<div class="card-body">
							<button class="btn btn-info btn-lg btn-block" onclick="laporanSelenggara()">
								<i class="fas fa-wrench"></i>
								<br>Laporan Penyelenggaraan
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="borang_selenggara" style="display:none">
    <?php include('admin/selenggara.php'); ?>
</div>
<div id="laporan_selenggara" style="display:none">
    <?php include('admin/maklumat_selenggara.php'); ?>
</div>

<div id="display_kerosakan" style="display:none">
    <div class="content mt-3">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-6">
					<div class="card">
						<div class="card-body">
							<button class="btn btn-warning btn-lg btn-block" onclick="borangKerosakan()">
								<i class="fas fa-house-damage"></i>
								<br>Borang Kerosakan
							</button>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card">
						<div class="card-body">
							<button class="btn btn-warning btn-lg btn-block" onclick="laporanKerosakan()">
								<i class="fas fa-house-damage"></i>
								<br>Laporan Kerosakan
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<div id="borang_kerosakan" style="display:none">
    <?php include ('admin/kerosakan.php'); ?>
</div>
<div id="laporan_kerosakan" style="display:none">
    <?php include('admin/maklumat_kerosakan.php'); ?>
</div>

<div id="display_inventori" style="display:none">
    <div class="content mt-3">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-6">
					<div class="card">
						<div class="card-body">
							<button class="btn btn-success btn-lg btn-block" onclick="borangInventori()">
								<i class="fas fa-warehouse"></i>
								<br>Borang Inventori
							</button>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card">
						<div class="card-body">
							<button class="btn btn-success btn-lg btn-block" onclick="laporanInventori()">
								<i class="fas fa-warehouse"></i>
								<br>Laporan Inventori
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<div id="borang_inventori" style="display:none">
    <?php include ('admin/inventori.php'); ?>
</div>
<div id="laporan_inventori" style="display:none">
    <?php include ('admin/maklumat_inventori.php'); ?>
</div>
<script>
function displaySelenggara(){
    document.getElementById('display_selenggara').style.display = "block";

    document.getElementById('display_kerosakan').style.display = "none";
    document.getElementById('borang_kerosakan').style.display = "none";
    document.getElementById('laporan_kerosakan').style.display = "none";

    document.getElementById('display_inventori').style.display = "none";
    document.getElementById('laporan_inventori').style.display = "none";
    document.getElementById('borang_inventori').style.display = "none";
}
function borangSelenggara(){
    document.getElementById('borang_selenggara').style.display = "block";
    document.getElementById('laporan_selenggara').style.display = "none";
}
function laporanSelenggara(){
    document.getElementById('laporan_selenggara').style.display = "block";
    document.getElementById('borang_selenggara').style.display = "none";
}
function displayKerosakan(){
    document.getElementById('display_kerosakan').style.display = "block";

    document.getElementById('display_selenggara').style.display = "none";
    document.getElementById('laporan_selenggara').style.display = "none";
    document.getElementById('borang_selenggara').style.display = "none";

    document.getElementById('display_inventori').style.display = "none";
    document.getElementById('laporan_inventori').style.display = "none";
    document.getElementById('borang_inventori').style.display = "none";
}
function borangKerosakan(){
    document.getElementById('borang_kerosakan').style.display = "block";
    document.getElementById('laporan_kerosakan').style.display = "none";
}
function laporanKerosakan(){
    document.getElementById('laporan_kerosakan').style.display = "block";
    document.getElementById('borang_kerosakan').style.display = "none";
}
function displayInventori(){
    document.getElementById('display_inventori').style.display = "block";

    document.getElementById('display_kerosakan').style.display = "none";
    document.getElementById('borang_kerosakan').style.display = "none";
    document.getElementById('laporan_kerosakan').style.display = "none";

    document.getElementById('display_selenggara').style.display = "none";
    document.getElementById('laporan_selenggara').style.display = "none";
    document.getElementById('borang_selenggara').style.display = "none";
}
function borangInventori(){
    document.getElementById('borang_inventori').style.display = "block";
    document.getElementById('laporan_inventori').style.display = "none";
}
function laporanInventori(){
    document.getElementById('laporan_inventori').style.display = "block";
    document.getElementById('borang_inventori').style.display = "none";
}
</script>

