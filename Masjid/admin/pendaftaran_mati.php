<?php

    $fungsi_kelik = 'page_ajax(\'list_kematian\', \'#module_kematian\', \'tunggu\')';
        echo "<script>
            jQuery(document).ready(function () {
                $fungsi_kelik
            });
        </script>";

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
    <div class="row" >
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
                        <div class="btn btn-danger btn-lg btn-block" onClick="<?php echo($fungsi_kelik); ?>">
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
            <div id="module_kematian" class="all-ajax-module col-md-12 col-12 form-group">
                <?php include("pendaftaran_ajax_page.php"); ?>
            </div>
    </div>
</div>