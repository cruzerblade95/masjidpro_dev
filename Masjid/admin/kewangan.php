<?php if($_GET['newModul'] != 1) { ?>
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Menu Kewangan</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Menu Kewangan</li>
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
                            <h4>Jenis Pendapatan / Perbelanjaan</h4>
                        </center>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-6 form-group">
                        <div class="btn btn-secondary btn-lg btn-block" onClick="page_ajax('add_jenis_vendor', '#module_jenis_vendor', 'tunggu_vendor')">
                            <center>
                                <i class="fas fa-tools"></i>
                                <br>
                                <h6>Tambah</h6>
                            </center>
                        </div>
                    </div>
                    <div class="col-md-6 col-6 form-group">
                        <div class="btn btn-secondary btn-lg btn-block" onClick="page_ajax('list_jenis_vendor', '#module_jenis_vendor', 'tunggu_vendor')">
                            <center>
                                <i class="fas fa-list"></i>
                                <br>
                                <h6>Lihat</h6>
                            </center>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <div id="tunggu_vendor" class="col-md-12 col-12 sk-circle" style="display: none" align="center">
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
            <div id="module_jenis_vendor" class="all-ajax-module col-md-12 col-12 form-group"></div>
        </div>
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <center>
                            <h4>Maklumat Vendor / Organisasi / Individu</h4>
                        </center>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-6 form-group">
                        <div class="btn btn-info btn-lg btn-block" onClick="page_ajax('add_vendor', '#module_vendor', 'tunggu')">
                            <center>
                                <i class="fas fa-users"></i>
                                <br>
                                <h6>Tambah</h6>
                            </center>
                        </div>
                    </div>
                    <div class="col-md-6 col-6 form-group">
                        <div class="btn btn-info btn-lg btn-block" onClick="page_ajax('list_vendor', '#module_vendor', 'tunggu')">
                            <center>
                                <i class="fas fa-list"></i>
                                <br>
                                <h6>Lihat</h6>
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
            <div id="module_vendor" class="all-ajax-module col-md-12 col-12 form-group"></div>
        </div>
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <center>
                            <h4>Maklumat Jenis Akaun / Tabung / Bank</h4>
                        </center>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-6 form-group">
                        <div class="btn btn-danger btn-lg btn-block" onClick="page_ajax('add_akaun', '#module_akaun', 'tunggu2')">
                            <center>
                                <i class="fas fa-book"></i>
                                <br>
                                <h6>Tambah Jenis Akaun</h6>
                            </center>
                        </div>
                    </div>
                    <div class="col-md-6 col-6 form-group">
                        <div class="btn btn-danger btn-lg btn-block" onClick="page_ajax('list_akaun', '#module_akaun', 'tunggu2')">
                            <center>
                                <i class="fas fa-list"></i>
                                <br>
                                <h6>Lihat Jenis Akaun</h6>
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
            <div id="module_akaun" class="all-ajax-module col-md-12 col-12 form-group"></div>
        </div>
        <div class="row">
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
                        <div class="btn btn-primary btn-lg btn-block" onClick="page_ajax('pindahan', '#module_rekod2', 'tunggu5')">
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

        <div class="row">
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
                        <div class="btn btn-primary btn-lg btn-block" onClick="page_ajax('pendapatan', '#module_rekod', 'tunggu3')">
                            <center>
                                <i class="fas fa-plus-square"></i>
                                <br>
                                <h6>Pendapatan</h6>
                            </center>
                        </div>
                    </div>
                    <div class="col-md-4 col-6 form-group">
                        <div class="btn btn-warning btn-lg btn-block" onClick="page_ajax('perbelanjaan', '#module_rekod', 'tunggu3')">
                            <center>
                                <i class="fas fa-minus-square"></i>
                                <br>
                                <h6>Perbelanjaan</h6>
                            </center>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 form-group">
                        <div class="btn btn-success btn-lg btn-block" onClick="page_ajax('lihat_rekod_kewangan', '#module_rekod', 'tunggu3')">
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
        <div class="row">
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
                        <a target="_blank" href="utama.php?view=admin&action=kewangan&data=raw&module=view_kewangan&sub=penyata_kewangan"><button class="btn btn-success btn-lg btn-block" onClick22="page_ajax('penyata', '#module_penyata', 'tunggu4')">
                                <center>
                                    <i class="fas fa-chart-line"></i>
                                    <br>
                                    <h6>Penyata Pendapatan &amp; Perbelanjaan</h6>
                                </center>
                            </button></a>
                    </div>
                    <div class="col-md-6 col-12 form-group">
                        <button class="btn btn-primary btn-lg btn-block" onClick="page_ajax('penyata_tunai', '#module_penyata', 'tunggu4')">
                            <center>
                                <i class="fas fa-donate"></i>
                                <br>
                                <h6>Penyata</h6>
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
        <div class="row" style="display: none">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <center>
                            <h4>Pendapatan</h4>
                        </center>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-3">
                        <a href="utama.php?view=admin&action=pelanggan"class="btn btn-warning btn-lg btn-block">
                            <center>
                                <i class="fas fa-users"></i>
                                <br>
                                <h6>Penyumbang</h6>
                            </center>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="utama.php?view=admin&action=jenis_kutipan" class="btn btn-warning btn-lg btn-block">
                            <center>
                                <i class="fas fa-hand-holding-usd"></i>
                                <br>
                                <h6>Jenis Pendapatan</h6>
                            </center>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="utama.php?view=admin&action=senarai_resit" class="btn btn-warning btn-lg btn-block">
                            <center>
                                <i class="fas fa-file-invoice-dollar"></i>
                                <br>
                                <h6>Rekod Pendapatan</h6>
                            </center>
                        </a>
                    </div>
                    <!-- <div class="col-lg-3">
                        <a href="utama.php?view=admin&action=tabung" class="btn btn-warning btn-lg btn-block">
                            <center>
                                <i class="fas fa-university"></i>
                                <br>
                                <h6>Tabung</h6>
                            </center>
                        </a>
                    </div> -->
                </div>
                <hr>
            </div>
        </div>
        <div class="row" style="display: none">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <center>
                            <h4>Perbelanjaan</h4>
                        </center>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-3">
                        <a href="utama.php?view=admin&action=pembekal" class="btn btn-danger btn-lg btn-block">
                            <center>
                                <i class="fas fa-users"></i>
                                <br>
                                <h6>Pembekal</h6>
                            </center>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="utama.php?view=admin&action=jenis_pembayaran" class="btn btn-danger btn-lg btn-block">
                            <center>
                                <i class="fas fa-shopping-cart"></i>
                                <br>
                                <h6>Jenis Perbelanjaan</h6>
                            </center>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="utama.php?view=admin&action=senarai_baucer" class="btn btn-danger btn-lg btn-block">
                            <center>
                                <i class="fas fa-money-check-alt"></i>
                                <br>
                                <h6>Baucer Bayaran</h6>
                            </center>
                        </a>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <div class="row" style="display: none">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <center>
                            <h4>Laporan</h4>
                        </center>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <!-- <div class="col-lg-3">
                        <button type="button" class="btn btn-primary btn-lg btn-block">
                            <center>
                                <i class="fas fa-money-check"></i>
                                <br>
                                <h6>Buku Tunai</h6>
                            </center>
                        </button>
                    </div>
                    <div class="col-lg-3">
                        <button type="button" class="btn btn-primary btn-lg btn-block">
                            <center>
                                <i class="fas fa-chart-line"></i>
                                <br>
                                <h6>Pendapatan</h6>
                            </center>
                        </button>
                    </div>
                    <div class="col-lg-3">
                        <button type="button" class="btn btn-primary btn-lg btn-block">
                            <center>
                                <i class="fas fa-chart-bar"></i>
                                <br>
                                <h6>Perbelanjaan</h6>
                            </center>
                        </button>
                    </div> -->
                    <div class="col-lg-3">
                        <a href="utama.php?view=admin&action=tabung" class="btn btn-primary btn-lg btn-block">
                            <center>
                                <i class="fas fa-university"></i>
                                <br>
                                <h6>Tabung</h6>
                            </center>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="utama.php?view=admin&action=penyata_kewangan" class="btn btn-primary btn-lg btn-block">
                            <center>
                                <i class="fas fa-file-invoice"></i>
                                <br>
                                <h6>Penyata Kewangan</h6>
                            </center>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="utama.php?view=admin&action=akaun_bank" class="btn btn-primary btn-lg btn-block">
                            <center>
                                <i class="fas fa-wallet"></i>
                                <br>
                                <h6>Akaun Bank</h6>
                            </center>
                        </a>
                    </div>
                </div>
            </div>
            <br>
            <!-- <div class="row">
                <div class="col-lg-3">
                    <button type="button" class="btn btn-primary btn-lg btn-block">
                        <center>
                            <i class="fas fa-wallet"></i>
                            <br>
                            <h6>Akaun Bank</h6>
                        </center>
                    </button>
                </div>
            </div> -->
            <hr>
        </div>
    </div>
    </div>
<?php } else include("account.php"); ?>