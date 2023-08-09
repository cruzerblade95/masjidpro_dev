<?php
$sql_search1 = "SELECT jawatankuasa_organisasi.id_jawatankuasa, jawatankuasa_organisasi.id_masjid, jawatankuasa_organisasi.kat_jawatankuasa, kehadiran_tetapan.id 'id_kehadiran',
                jawatankuasa_organisasi.jawatan, jawatankuasa_organisasi.ajk_biro , kehadirantetapan_kategori.kat_clockin 'jenisKehadiran' 
                FROM jawatankuasa_organisasi LEFT JOIN kehadiran_tetapan ON kehadiran_tetapan.id_jawatankuasa = jawatankuasa_organisasi.id_jawatankuasa 
                LEFT JOIN kehadirantetapan_kategori ON kehadirantetapan_kategori.id_clockin = kehadiran_tetapan.id_clockin 
                WHERE jawatankuasa_organisasi.kat_jawatankuasa = 'pengurusan' AND jawatankuasa_organisasi.id_masjid = '$id_masjid'";
$result1 = mysqli_query($bd2, $sql_search1) or die ("Error :".mysqli_error($bd2));

?>
<div class="breadcrumbs">
    <div class="col-sm-5">
        <div class="page-header float-left">
            <div class="page-title">
                <h2>Tetapan Kehadiran</h2>
            </div>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Tetapan Kehadiran Pengurusan Masjid</li>
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
                            <h5>Tetapan Kehadiran Pengurusan Masjid</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tetapan_kehadiran_pengurusan" width="100%" data-order="[]" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th><div align="center">No</div></th>
                                <th><div align="center">Jawatan</div></th>
                                <th><div align="center">Jenis Kehadiran</div></th>
                                <th><div align="center"></div></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $x=1;
                            while($row = mysqli_fetch_assoc($result1))
                            {
                                ?>
                                <tr>
                                    <td><div align="center"><?php echo $x; ?></div></td>
                                    <td>
                                        <div align="center">
                                            <?php if ($row['ajk_biro'] != NULL) { echo strtoupper($row['jawatan']) . ' ' . strtoupper($row['ajk_biro']);} else {echo strtoupper($row['jawatan']);} ?>
                                        </div>
                                    </td>
                                    <td><div align="center"><?php echo $row['jenisKehadiran']; ?></div></td>
                                    <td>
                                        <div align="center">
                                            <?php if($row['jenisKehadiran'] != NULL) { ?>
                                                <button class="btn btn-info" data-toggle="modal" data-target="#FormEditTetapanKehadiranPENGURUSAN" value="<?php echo $row['id_kehadiran']; ?>" onClick="editTetapanKehadiranPENGURUSANForm(this.value)">Kemaskini Jenis Kehadiran</button>
                                            <?php } else { ?>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#FormAddTetapanKehadiranPENGURUSAN" value="<?php echo $row['id_jawatankuasa']; ?>" onClick="addTetapanKehadiranPENGURUSANForm(this.value)">Tambah Jenis Kehadiran</button>
                                            <?php } ?>
                                        </div>
                                    </td>
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
<div class="modal long-modal" id="FormAddTetapanKehadiranPENGURUSAN" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="longmodal">Tambah Jenis Kehadiran Pengurusan Masjid</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="form_addTetapanKehadiranPENGURUSAN">
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
<div class="modal long-modal" id="FormEditTetapanKehadiranPENGURUSAN" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="longmodal">Kemaskini Jenis Kehadiran Pengurusan Masjid</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="form_editTetapanKehadiranPENGURUSAN">
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
    function addTetapanKehadiranPENGURUSANForm(str){
        if (str == "") {
            document.getElementById("form_addTetapanKehadiranPENGURUSAN").innerHTML = "";
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
                    document.getElementById("form_addTetapanKehadiranPENGURUSAN").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/getaddTetapanKehadiranPENGURUSAN.php?id_jawatankuasa="+str,true);
            xmlhttp.send();
        }
    }
</script>
<script>
    function editTetapanKehadiranPENGURUSANForm(str){
        if (str == "") {
            document.getElementById("form_editTetapanKehadiranPENGURUSAN").innerHTML = "";
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
                    document.getElementById("form_editTetapanKehadiranPENGURUSAN").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/geteditTetapanKehadiranPENGURUSAN.php?id_kehadiran="+str,true);
            xmlhttp.send();
        }
    }
</script>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#tetapan_kehadiran_pengurusan', 'Tetapan Kehadiran Pengurusan Masjid', [ 0, 1]);
    });
</script>




