<?php
if($_GET['modul'] == "del" && $_GET['id_tabung'] != NULL && is_numeric($_GET['id_tabung'])) {
    $q = "DELETE FROM category_infaq WHERE id_tabung = ".$_GET['id_tabung'];
    $padam = mysqli_query($bd2, $q);
    $sql_delete = "DELETE FROM list_harga_infaq WHERE id_tabung = ".$_GET['id_tabung'];
    $query_delete = mysqli_query($bd2, $sql_delete);
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
                <h1>Infaq</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Infaq</li>
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
                    Senarai Infaq&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Tambah Infaq</button>
                </div>
                <div class="card-body">
                    <table id="meja_akaun2" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Kategori</th>
                            <th>Jenis Tabung</th>
                            <th>Keterangan</th>
                            <th>Lihat Info</th>
                            <th>Padam</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;

                        $sql_infaq = "SELECT * FROM category_infaq WHERE id_masjid='$id_masjid'";
                        $query_infaq = mysqli_query($bd2,$sql_infaq);

                        while($data_infaq=mysqli_fetch_array($query_infaq)){
                            ?>
                            <tr>
                                <td align="center"><?php echo $i; ?></td>
                                <td align="center"><?php echo $data_infaq['category']; ?></td>
                                <td align="center"><?php echo $data_infaq['jenis_tabung']; ?></td>
                                <td><?php echo $data_infaq['description']; ?></td>
                                <td align="center">
                                    <a href="utama.php?view=admin&action=list_infaq&id_tabung=<?php echo $data_infaq['id_tabung']; ?>" class="btn btn-info"><i class="fa fa-clipboard-list"</a>
                                </td>
                                <td align="center">
                                    <a href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>&modul=del&id_tabung=<?php echo $data_infaq['id_tabung']; ?>"><button onclick="return confirm('Adakah anda pasti untuk memadam rekod ini?');" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
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
                <h4 class="modal-title" id="myModalLabel">TAMBAH INFAQ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post" action="admin/add_infaq.php" enctype="multipart/form-data">
                            <center>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <center><h4><u>Maklumat Infaq</u></h4></center>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-3">

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Kategori Infaq</label>
                                            <select class="form-control" name="kategori" id="kategori" required>
                                                <option value="">Sila Pilih:-</option>
                                                <option value="Barang">Barang</option>
                                                <option value="Tabung">Tabung</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>* Jenis Tabung</label>
                                            <input type="text" class="form-control" name="jenis_tabung" id="jenis_tabung" required maxlength="50">
                                            <small>Maks: 50 huruf</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" name="keterangan" id="keterangan" rows="5" maxlength="1000"></textarea>
                                            <small>Maks: 1000 huruf</small>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row (nested) -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
                                        <input type="submit" name="add_infaq" id="add_infaq" value="Simpan" class="btn btn-success" />
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
<script>
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
</script>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai Infaq', [ 0, 1, 2, 3 ]);
    });
</script>