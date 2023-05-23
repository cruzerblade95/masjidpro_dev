<?php
$query_date = date('Y-m-d');
?>
<style type="text/css">

    .field-icon {
        float: right;
        margin-left: -25px;
        margin-top: -25px;
        position: relative;
        z-index: 2;
    }

    .container{
        padding-top:50px;
        margin: auto;
    }
    .btn-link {
        color: black;
        font-weight: bold;
    }
</style>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Senarai Layak Mengundi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Senarai Layak Mengundi</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header" id="headingThree" align="center">
        <div class="row">
            <div align="center" class="col-12 col-md-12"><h3><strong><?php fungsi_tarikh($query_date, 2, 4); ?></strong></h3></div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <form id="lihatRekod" name="lihatRekod" method="post" enctype="multipart/form-data" action="senaraiPengundiPrint.php" target="_blank">
            <div class="row justify-content-md-center form-group">
                <div class="col-auto col-md-auto">
                    <label>Tarikh Akhir Bantahan</label>
                    <input name="tarikh_akhir" type="text" class="form-control" placeholder="" id="mdate2" required>
                </div>
                <div class="col-auto col-md-auto">
                    <label>Jantina</label>
                    <select id="jantina" name="jantina" class="form-control" required>
                        <option value="0">SEMUA</option>
                        <option value="1">LELAKI</option>
                        <option value="2">PEREMPUAN</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-md-center form-group">
                <div class="col-auto col-md-auto">
                    <button type="submit" class="btn btn-info btn-block">Lihat Senarai Layak Mengundi</button>
                </div>
            </div>
        </form>
    </div>
</div>