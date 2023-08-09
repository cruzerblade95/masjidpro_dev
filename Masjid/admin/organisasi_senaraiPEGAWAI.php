<?php

$sql_search1 = "SELECT * FROM jawatankuasa_organisasi WHERE kat_jawatankuasa = 'pegawai' AND ajk_biro IS NULL AND id_masjid = '$id_masjid'";
$result1 = mysqli_query($bd2, $sql_search1) or die ("Error :".mysqli_error($bd2));

if(mysqli_num_rows($result1) > 0) {

    $sql_search2 = "SELECT * FROM jawatankuasa_organisasi WHERE kat_jawatankuasa = 'pegawai' AND ajk_biro IS NULL AND id_masjid = '$id_masjid'";
    $result2 = mysqli_query($bd2, $sql_search2) or die ("Error :".mysqli_error($bd2));

} else {

    $new_id_masjid = $id_masjid;
    $sql_insert = "INSERT INTO jawatankuasa_organisasi (id_masjid, kat_jawatankuasa, jawatan)SELECT '$new_id_masjid', kat_jawatankuasa, jawatan FROM jawatankuasa_organisasi WHERE kat_jawatankuasa = 'pegawai' AND id_masjid = '0'";
    $result2 = mysqli_query($bd2, $sql_insert) or die ("Error :".mysqli_error($bd2));
}
?>
<div class="breadcrumbs">
    <div class="col-sm-5">
        <div class="page-header float-left">
            <div class="page-title">
                <h2>Tetapan Organisasi</h2>
            </div>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Senarai Jawatankuasa</li>
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
                    <div class="row">
                        <div class="col-lg-8">
                            <h3>Senarai Jawatan Pegawai Masjid</h3>
                        </div>
                        <div class="col-lg-4" align="end">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#FormAddJawatanPegawai" value="<?php echo $id_masjid ?>" onClick="addJawatanPegawaiForm(this.value)">Tambah Jawatan</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="senarai_orgpegawai" width="100%" data-order="[]" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th><div align="center">No</div></th>
                                <th><div align="center">Jawatan</div></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $x=1;
                            while($row = mysqli_fetch_assoc($result2))
                            {
                                ?>
                                <tr>
                                    <td><div align="center"><?php echo $x; ?></div></td>
                                    <td><div align="center"><?php echo strtoupper($row['jawatan']); ?></div></td>
                                </tr>
                                <?php
                                $x++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal long-modal" id="FormAddJawatanPegawai" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="longmodal">Tambah Jawatan Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="form_addJawatanPegawai">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    function addJawatanPegawaiForm(str){
        if (str == "") {
            document.getElementById("form_addJawatanPegawai").innerHTML = "";
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
                    document.getElementById("form_addJawatanPegawai").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/getaddjawatanpegawai.php?id_masjid="+str,true);
            xmlhttp.send();
        }
    }
</script>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#senarai_orgpegawai', 'Senarai Jawatan Pegawai Masjid', [ 0, 1, 2, 3 ]);
    });
</script>




