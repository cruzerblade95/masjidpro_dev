<?php

$id_tabung = $_GET['id_tabung'];

$sql_infaq = "SELECT * FROM category_infaq WHERE id_tabung='$id_tabung'";
$query_infaq = mysqli_query($bd2,$sql_infaq);

$data_infaq = mysqli_fetch_array($query_infaq);
?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Harga/Pakej Infaq</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=infaq">Infaq</a></li>
                    <li class="active">Harga/Pakej Infaq</li>
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
                    Senarai Harga/Pakej Infaq&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Tambah&nbsp;<i class="fa fa-plus-circle"></i></button>
                </div>
                <div class="card-body">
                    <div class="row" align="center">
                        <div class="col-md-6 offset-md-3">
                            <div class="alert alert-info">
                                <div class="row">
                                    <div class="col-md-4" align="left">KATEGORI INFAQ</div><div class="col-md-1" align="left">:</div><div class="col-md-7" align="left"><?php echo $data_infaq['category']; ?></div>
                                    <div class="col-md-4" align="left">JENIS TABUNG</div><div class="col-md-1" align="left">:</div><div class="col-md-7" align="left"><?php echo $data_infaq['jenis_tabung']; ?></div>
                                    <div class="col-md-4" align="left">KETERANGAN</div><div class="col-md-1" align="left">:</div><div class="col-md-7" align="left"><?php echo $data_infaq['description']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                    <table id="meja_akaun2" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;

                        $sql_list_infaq = "SELECT * FROM list_harga_infaq WHERE id_tabung='$id_tabung'";
                        $query_list_infaq = mysqli_query($bd2,$sql_list_infaq);

                        while($list_infaq=mysqli_fetch_array($query_list_infaq)){
                            ?>
                            <tr>
                                <td align="center"><?php echo $i; ?></td>
                                <td align="center"><?php echo $list_infaq['harga']; ?></td>
                                <td align="left"><?php echo $list_infaq['description']; ?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Pakej/Harga</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="admin/add_infaq.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control" name="harga" min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" rows="5"></textarea>
                </div>
                <input type="hidden" name="id_tabung" value="<?php echo $id_tabung; ?>">
                <center>
                    <button type="submit" name="add_harga" class="btn btn-success">Simpan</button>
                </center>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal Pewakaf -->
<div class="modal bs-example-modal-lg long-modal" id="modalPewakaf" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="longmodal">Senarai Pewakaf</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="div_pewakaf">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.Modal Pewakaf -->
<script>
    function myPewakaf(str){
        if (str == "") {
            document.getElementById("div_pewakaf").innerHTML = "";
            return;
        }
        else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    eval(document.getElementById('meja2').innerHTML);
                    document.getElementById("div_pewakaf").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/getwakaf.php?id_wakaf="+str,true);
            xmlhttp.send();
        }
    }
</script>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai Infaq', [ 0, 1, 2, 3 ]);
    });
</script>
<script id="meja2">
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun3', 'Rekod Infaq', [ 0, 1, 2, 3, 4, 5, 6]);
    });
</script>