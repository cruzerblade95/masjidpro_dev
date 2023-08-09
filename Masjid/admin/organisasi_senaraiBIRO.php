<?php

$sql_search1 = "SELECT * FROM jawatankuasa_organisasi WHERE jawatan = 'ajk' AND id_masjid = '$id_masjid' AND ajk_biro IS NOT NULL";
$result1 = mysqli_query($bd2, $sql_search1) or die ("Error :".mysqli_error($bd2));

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
                    <li><a href="utama.php?view=admin&action=organisasi_senaraiAJK&sideMenu=organisasi">Senarai Jawatan Ahli Jawatankuasa Masjid</a></li>
                    <li class="active">Senarai Biro</li>
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
                            <h5>Senarai Jawatan Biro Masjid</h5>
                        </div>
                        <div class="col-lg-4" align="end">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#FormAdd" value="<?php echo $id_masjid ?>" onClick="addForm(this.value)">Tambah Biro</button>
                            <a href="utama.php?view=admin&action=organisasi_senaraiAJK&sideMenu=organisasi"><button class="btn btn-info">Kembali </button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="senarai_orgbiro" width="100%" data-order="[]" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th><div align="center">No</div></th>
                                <th><div align="center">Biro</div></th>
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
                                    <td><div align="center"><?php echo strtoupper($row['ajk_biro']); ?></div></td>
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
<div class="modal long-modal" id="FormAdd" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="longmodal">Tambah Biro</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="form_add">
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
    function addForm(str){
        if (str == "") {
            document.getElementById("form_add").innerHTML = "";
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
                    document.getElementById("form_add").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/getaddajkbiro.php?id_masjid="+str,true);
            xmlhttp.send();
        }
    }
</script>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#senarai_orgbiro', 'Senarai Jawatan Biro Masjid', [ 0, 1]);
    });
</script>


