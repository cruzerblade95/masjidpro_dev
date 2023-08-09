<?php
if($_GET['module'] != 'add_ahli') {
        $fungsi_daftar = 'document.location.href=\'' . htmlspecialchars($_SERVER['PHP_SELF'] . '?' . str_replace('&module=list_ahli', '', $_SERVER['QUERY_STRING']) . '&module=add_ahli') . '\'';
        $fungsi_kelik = 'page_ajax(\'list_ahli\', \'#module_kariah\', \'tunggu\')';
    if($_GET['module'] == 'list_ahli') {
        echo "<script>
        jQuery(document).ready(function () {
        $fungsi_kelik
        });
        </script>";
    }
}
if($_GET['module'] == 'add_ahli') $fungsi_kelik = 'document.location.href=\''.htmlspecialchars($_SERVER['PHP_SELF'].'?'.str_replace('&module=add_ahli', '', $_SERVER['QUERY_STRING']).'&module=list_ahli').'\'';
?>
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
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-md-12 col-12">
                    <center>
                        <h4>Maklumat Ahli Kariah</h4>
                    </center>
                </div>
            </div>
			<div id="excel_div" style="display:none">
            <hr>
			<div class="col-12">
				<div class="row">
					<div class="col-6">
						<div class="row">
							<h5>Klik Ikon Untuk Muat Turun Excel:-</h5>
						</div>
						<div class="row">
							<h5><a href="#"><i class="far fa-file-excel"></i>&nbsp;Ketua Keluarga</a></h5>
						</div>
						<div class="row">
							<h5><a href="#"><i class="far fa-file-excel"></i>&nbsp;Tanggungan</a></h5>
						</div>
					</div>
					<div class="col-6">
						<h5>Muat Naik Excel:-</h5>
						<div class="form-group">
							<input type="radio" name="pilihExcel">&nbsp;Ketua Keluarga
							<input type="radio" name="pilihExcel">&nbsp;Tanggungan
						</div>
						<div class="form-group">
							<input type="file" name="uploadExcel" required class="form-control">
						</div>
					</div>
				</div>
			</div>
			</div>
			<hr>
            <div class="row">
                <div class="col-md-6 col-6 form-group">
                    <div class="btn btn-info btn-lg btn-block" onClick="<?php echo($fungsi_daftar); ?>">
                        <center>
                            <i class="fas fa-users"></i>
                            <br>
                            <h6>Daftar Ahli</h6>
                        </center>
                    </div>
                </div>
                <div class="col-md-6 col-6 form-group">
                    <div class="btn btn-info btn-lg btn-block" onClick="<?php echo($fungsi_kelik); ?>">
                        <center>
                            <i class="fas fa-list"></i>
                            <br>
                            <h6>Senarai Ahli Kariah</h6>
                        </center>
                    </div>
                </div>
            </div>
            <hr>
        </div>
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
        <div id="module_kariah" class="all-ajax-module col-md-12 col-12 form-group">
            <?php include("pendaftaran_ajax_page.php"); ?>
        </div>
    </div>
    <?php if($_SESSION['user_type_id'] != 10)  { ?>
    <div class="row" style="display: none">
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-md-12 col-12">
                    <center>
                        <h4>Maklumat Kematian</h4>
                    </center>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6 col-6 form-group">
                    <a target="_blank" href="daftar_online/daftar_kematian.php" class="btn btn-danger btn-lg btn-block" onClick2="page_ajax('add_kematian', '#modul_kematian', 'tunggu2')">
                        <center>
                            <i class="fas fa-book"></i>
                            <br>
                            <h6>Daftar Kematian</h6>
                        </center>
                    </a>
                </div>
                <div class="col-md-6 col-6 form-group">
                    <div class="btn btn-danger btn-lg btn-block" onClick="page_ajax('list_kematian', '#modul_kematian', 'tunggu2')">
                        <center>
                            <i class="fas fa-list"></i>
                            <br>
                            <h6>Senarai Kematian</h6>
                        </center>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <div id="tunggu2" class="col-md-12 col-12 sk-circle" style="display: none" align="center">
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
        <div id="modul_kematian" class="all-ajax-module col-md-12 col-12 form-group"></div>
    </div>
    <?php } ?>
    <div class="row" style="display: none">
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-md-12 col-12">
                    <center>
                        <h4>Pengurusan Tabung / Tunai / Akaun Bank</h4>
                    </center>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 col-12 form-group">
                    <div class="btn btn-primary btn-lg btn-block"
                         onClick="page_ajax('pindahan', '#module_rekod2', 'tunggu5')">
                        <center>
                            <i class="fas fa-exchange-alt"></i>
                            <br>
                            <h6>Pindahan Antara Akaun Bank / Tabung / Tunai</h6>
                        </center>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <div id="tunggu5" class="col-md-12 col-12 sk-circle" style="display: none" align="center">
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
        <div id="module_rekod2" class="all-ajax-module col-md-12 col-12 form-group"></div>
    </div>
    <div class="row" style="display: none">
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-md-12 col-12">
                    <center>
                        <h4>Rekod Kewangan</h4>
                    </center>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4 col-6 form-group">
                    <div class="btn btn-primary btn-lg btn-block"
                         onClick="page_ajax('pendapatan', '#module_rekod', 'tunggu3')">
                        <center>
                            <i class="fas fa-plus-square"></i>
                            <br>
                            <h6>Pendapatan</h6>
                        </center>
                    </div>
                </div>
                <div class="col-md-4 col-6 form-group">
                    <div class="btn btn-warning btn-lg btn-block"
                         onClick="page_ajax('perbelanjaan', '#module_rekod', 'tunggu3')">
                        <center>
                            <i class="fas fa-minus-square"></i>
                            <br>
                            <h6>Perbelanjaan</h6>
                        </center>
                    </div>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <div class="btn btn-success btn-lg btn-block"
                         onClick="page_ajax('lihat_rekod_kewangan', '#module_rekod', 'tunggu3')">
                        <center>
                            <i class="fas fa-list"></i>
                            <br>
                            <h6>Lihat Rekod Kewangan</h6>
                        </center>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <div id="tunggu3" class="col-md-12 col-12 sk-circle" style="display: none" align="center">
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
        <div id="module_rekod" class="all-ajax-module col-md-12 col-12 form-group"></div>
    </div>
    <div class="row" style="display: none">
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-md-12 col-12">
                    <center>
                        <h4>Laporan Kewangan</h4>
                    </center>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6 col-12 form-group">
                    <a target="_blank"
                       href="utama.php?view=admin&action=kewangan&data=raw&module=view_kewangan&sub=penyata_kewangan">
                        <button class="btn btn-success btn-lg btn-block"
                                onClick22="page_ajax('penyata', '#module_penyata', 'tunggu4')">
                            <center>
                                <i class="fas fa-chart-line"></i>
                                <br>
                                <h6>Penyata Pendapatan &amp; Perbelanjaan</h6>
                            </center>
                        </button>
                    </a>
                </div>
                <div class="col-md-6 col-12 form-group">
                    <button class="btn btn-primary btn-lg btn-block"
                            onClick="page_ajax('penyata_tunai', '#module_penyata', 'tunggu4')">
                        <center>
                            <i class="fas fa-donate"></i>
                            <br>
                            <h6>Penyata Aliran Tunai</h6>
                        </center>
                    </button>
                </div>
            </div>
            <hr>
        </div>
        <div id="tunggu4" class="col-md-12 col-12 sk-circle" style="display: none" align="center">
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
        <div id="module_penyata" class="all-ajax-module col-md-12 col-12 form-group"></div>
    </div>
</div>