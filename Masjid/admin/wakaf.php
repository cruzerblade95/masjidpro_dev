<?php
if($_GET['modul'] == "del" && $_GET['id_wakaf'] != NULL && is_numeric($_GET['id_wakaf'])) {
    $q = "DELETE FROM wakaf WHERE id_wakaf = ".$_GET['id_wakaf'];
    $padam = mysqli_query($bd2, $q);
    if($padam) {
        echo '<script>alert("Rekod berjaya dipadamkan")</script>';
    }
    else {
        echo '<script>alert("Rekod tidak berjaya dipadamkan")</script>';
    }
}
?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Wakaf</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Wakaf</li>
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
                    Senarai Wakaf&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Tambah Wakaf</button>
                </div>
                <div class="card-body">
                    <table id="meja_akaun2" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Wakaf</th>
                                <th>Harga</th>
                                <th>Kuantiti</th>
                                <th>Rekod Pewakaf</th>
                                <th>QR</th>
                                <th>Poster</th>
                                <th>Kemaskini</th>
                                <th>Padam</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;

                        $sql_wakaf = "SELECT * FROM wakaf WHERE id_masjid='$id_masjid' AND status=1";
                        $query_wakaf = mysqli_query($bd2,$sql_wakaf);

                        while($data_wakaf=mysqli_fetch_array($query_wakaf)){
                        ?>
                            <tr>
                                <td align="center"><?php echo $i; ?></td>
                                <td><?php echo $data_wakaf['nama_wakaf']; ?></td>
                                <td align="center">RM <?php echo $data_wakaf['harga_per_quantity']; ?></td>
                                <td align="center"><?php echo $data_wakaf['quantity']; ?></td>
                                <td align="center"><button class="btn btn-success" data-toggle="modal" data-target="#modalPewakaf" value="<?php echo $data_wakaf['id_wakaf']; ?>" onClick="myPewakaf(this.value)"><i class="fas fa-users" title="Lihat Senarai"></i> Pewakaf</button></td>
                                <td align="center"><button class="btn btn-info" data-toggle="modal" data-target="#modalQR" value="<?php echo $data_wakaf['id_wakaf']; ?>" onClick="myQR(this.value)"><i class="fas fa-qrcode" title="Lihat QR"></i> QR Kod</button></td>
                                <td align="center"><button class="btn btn-warning" data-toggle="modal" data-target="#modalPoster" value="<?php echo $data_wakaf['id_wakaf']; ?>" onClick="myPoster(this.value)"><i class="fas fa-image" title="Lihat Poster"></i> Poster</button></td>
                                <td align="center"><button class="btn btn-secondary" data-toggle="modal" data-target="#modalEdit" value="<?php echo $data_wakaf['id_wakaf']; ?>" onClick="editWakaf(this.value)"><i class="fas fa-edit"></i> </button></td>
                                <td align="center">
                                    <a href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>&modul=del&id_wakaf=<?php echo $data_wakaf['id_wakaf']; ?>"><button onclick="return confirm('Adakah anda pasti untuk memadam rekod ini?');" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                </td>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">TAMBAH WAKAF</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post" id="insert_form" action="admin/add_wakaf.php" enctype="multipart/form-data">
                            <center>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <center><h4><u>Maklumat Wakaf</u></h4></center>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-3">

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Wakaf</label>
                                            <input type="text" name="nama_wakaf" id="nama_wakaf" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" name="description" id="description" rows="5" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Kuantiti/Unit</label>&nbsp;
                                            <input class="form-control" type="number" name="quantity" id="quantity" min="1" step="1" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga (Per Kuantiti/Unit)</label>&nbsp;
                                            <input class="form-control" type="number" name="price" id="price" min="0.01" step=".01" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Gambar QR Kod *Format .JPG, .JPEG, .PNG Sahaja*</label>
                                            <input class="form-control" type="file" name="qr" id="qr" accept=".jpg, .jpeg, .png">
                                        </div>
                                        <div class="form-group">
                                            <label>Gambar Poster *Format .JPG, .JPEG, .PNG Sahaja*</label>
                                            <input type="file" class="form-control" name="poster" id="poster" accept=".jpg, .jpeg, .png">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row (nested) -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
                                        <input type="submit" name="insert" id="insert" value="Simpan" class="btn btn-success" />
                                    </div>
                                </div>
                                <br>
                            </center>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- modal-dialog modal-lg -->
</div>
<!-- modal fade -->
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
<!-- Modal QR Code -->
<div class="modal long-modal" id="modalQR" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="longmodal">QR Code</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="div_qr">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.Modal QR Code -->
<!-- Modal Poster -->
<div class="modal long-modal" id="modalPoster" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="longmodal">Poster</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="div_poster">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.Modal Poster -->
<div class="modal long-modal" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="longmodal">Kemaskini Maklumat Wakaf</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="div_edit">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.Modal Poster -->
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
    function myQR(str){
        if (str == "") {
            document.getElementById("div_qr").innerHTML = "";
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
                    document.getElementById("div_qr").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/getqr.php?id_wakaf="+str,true);
            xmlhttp.send();
        }
    }
    function myPoster(str){
        if (str == "") {
            document.getElementById("div_poster").innerHTML = "";
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
                    document.getElementById("div_poster").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/getposter.php?id_wakaf="+str,true);
            xmlhttp.send();
        }
    }
    function editWakaf(str){
        if (str == "") {
            document.getElementById("div_edit").innerHTML = "";
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
                    document.getElementById("div_edit").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/geteditwakaf.php?id_wakaf="+str,true);
            xmlhttp.send();
        }
    }
</script>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai Wakaf', [ 0, 1, 2, 3 ]);
    });
</script>
<script id="meja2">
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun3', 'Rekod Pewakaf', [ 0, 1, 2, 3, 4, 5, 6]);
    });

</script>