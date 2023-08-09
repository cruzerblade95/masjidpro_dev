<?php

$query_date = date('Y-m-d');
if($_GET['tarikh_slot'] != NULL) $query_date = e($_GET['tarikh_slot'], NULL, NULL);
if($_POST['tarikh_slot'] != NULL) $query_date = e($_POST['tarikh_slot'], NULL, NULL);
if($_GET['name_form'] != NULL) $name_form = e($_GET['name_form'], NULL, NULL);

$q = "SELECT nama_masjid, id_masjid FROM sej6x_data_masjid WHERE id_masjid = $id_masjid";

selValueSQL($q, 'infoMasjid');
$id_masjid = $row_infoMasjid['id_masjid'];
$nama_masjid = $row_infoMasjid['nama_masjid'];

//if($id_masjid == 6279) {
//    $pilihServer = 2;
//    $dftrSolat_db = $dftrSolat_db2;
//    $mysql_database_utama = $mysql_database_utama2;
//    if($pilihServer == 2) {
//        $bd2 = $bd2_dev;
//    }
//}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $name_form = e($_POST['nama_form'], NULL, NULL);
    // Update kapasiti untuk setiap slot
    if($_POST['nama_form'] == "jenisSlot") {
        $x = 0;
        foreach ($_POST['id_jeniskehadiran_masjid'] as $id) {
            foreach ($_POST as $key => $val) if (is_array($val)) ${$key} = $_POST[$key][$x];
            $k = "UPDATE jenis_kehadiran_masjid SET kapasiti_lelaki = '$kapasiti_lelaki', kapasiti_perempuan = '$kapasiti_perempuan', kapasiti = '$kapasiti' WHERE id_jeniskehadiran_masjid = $id_jeniskehadiran_masjid";
            cudSQL2($k, 'updateSlot');
            $x++;
        }
    }

    // Update kapasiti khusus untuk setiap slot
    if($_POST['nama_form'] == "slotKhusus") {
        $x = 0;
        $tarikh_slot = $_POST['tarikh_slot'];
        foreach ($_POST['id_slot'] as $id) {
            foreach ($_POST as $key => $val) if (is_array($val)) ${$key} = $_POST[$key][$x];
            if($_POST['ubah_slot'][$x] == 1) {
                $update = "UPDATE slot_tersedia SET id_jeniskehadiran_masjid = '$id_jeniskehadiran_masjid', tarikh_slot = '$tarikh_slot', slot_tersedia = '$slot_tersedia', kapasiti = '$kapasiti', kapasiti_lelaki = '$kapasiti_lelaki', kapasiti_perempuan = '$kapasiti_perempuan' WHERE id_jeniskehadiran_masjid = $id_jeniskehadiran_masjid";
                if ($_POST['id_slot'][$x] == NULL) {
                    $check = "SELECT * FROM slot_tersedia WHERE id_masjid = $id_masjid AND tarikh_slot = '$tarikh_slot' AND id_jeniskehadiran_masjid = $id_jeniskehadiran_masjid";
                    selValueSQL2($check, 'semak');
                    if($num2_semak < 1) $k = "INSERT INTO slot_tersedia (id_masjid, id_jeniskehadiran_masjid, tarikh_slot, slot_tersedia, kapasiti, kapasiti_lelaki, kapasiti_perempuan) VALUES ('$id_masjid', '$id_jeniskehadiran_masjid', '$tarikh_slot', '$slot_tersedia', '$kapasiti', '$kapasiti_lelaki', '$kapasiti_perempuan')";
                    else $k = $update;
                }
                else $k = $update;
                cudSQL2($k, 'slotKhusus');
            }
            else if($_POST['ubah_slot'][$x] == 0 && $_POST['id_slot'][$x] != NULL) {
                $k = "DELETE FROM slot_tersedia WHERE id_slot = ".$_POST['id_slot'][$x];
                cudSQL2($k, 'slotKhusus');
            }
            $x++;
        }
    }

}

// Auto create waktu solat slot ikut default setting kalau masjid berkenaan tak ada lagi slot
$q = "SELECT * FROM jenis_kehadiran";
selValueSQL2($q, 'checkJenisSlot');
do {
    $id_jeniskehadiran = $row2_checkJenisSlot['id_jeniskehadiran'];
    $kapasiti = $row2_checkJenisSlot['kapasiti'];
    $r = "SELECT * FROM jenis_kehadiran_masjid WHERE id_masjid = $id_masjid AND id_jeniskehadiran = $id_jeniskehadiran";
    selValueSQL2($r, 'checkJenisSlot2');
    if($num2_checkJenisSlot2 < 1){
        $s = "INSERT INTO jenis_kehadiran_masjid (id_masjid, id_jeniskehadiran, kapasiti) VALUES ($id_masjid, $id_jeniskehadiran, $kapasiti)";
        cudSQL2($s, 'masukSlot');
    }
} while($row2_checkJenisSlot = mysqli_fetch_assoc($fetch2_checkJenisSlot));

// Display slot setiap jenis
function tunjukSlot() {
    global $id_masjid, $pilihServer;
    $q = "SELECT *, b.kapasiti 'kapasiti', a.kapasiti 'kapasiti2' FROM jenis_kehadiran_masjid a, jenis_kehadiran b WHERE a.id_jeniskehadiran = b.id_jeniskehadiran AND a.id_masjid = $id_masjid";
    selValueSQL2($q, 'jenisSlot');
}

// Senarai jenis kehadiran
$y = "SELECT * FROM jenis_kehadiran";
selValueSQL2($y, 'jenisHadir');

// Senarai Kelulusan dan Kehadiran Jemaah
if(is_numeric($_GET['jenisHadir']) && $_GET['jenisHadir'] != NULL) $jenisHadir = e($_GET['jenisHadir'], NULL, NULL);
else $jenisHadir = 0;
$z = "SELECT c.nama, c.no_ic, c.no_tel, a.datetime_apply, d.datetime, g.mysejahtera_checkin, g.id_gejala FROM $dftrSolat_db.list_kehadiran a LEFT JOIN $mysql_database_utama.sej6x_data_masjid b ON a.id_masjid = b.id_masjid LEFT JOIN $dftrSolat_db.maklumat_peribadi c ON a.id_peribadi = c.id_peribadi LEFT JOIN $dftrSolat_db.log_kehadiran d ON a.id_listkehadiran = d.id_listkehadiran LEFT JOIN $dftrSolat_db.jenis_kehadiran_masjid e ON a.jenis_kehadiran_masjid = e.id_jeniskehadiran_masjid LEFT JOIN $dftrSolat_db.jenis_kehadiran f ON e.id_jeniskehadiran = f.id_jeniskehadiran LEFT JOIN $mysql_database_utama.sej6x_data_gejala g ON d.datetime = g.time WHERE a.id_masjid = $id_masjid AND f.id_jeniskehadiran = $jenisHadir AND a.tarikh_kehadiran = '$query_date' GROUP BY a.id_peribadi";
selValueSQL0($z, 'senaraiLulus');
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
<script type="text/javascript">
    var awal = [];
    var awalSetting = [];
    $(function () {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        var k = 1;
        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());
            k++;
        });

        var elems2 = Array.prototype.slice.call(document.querySelectorAll('.js-switch2'));
        var i = 1;
        $('.js-switch2').each(function () {
            awal[i] = new Switchery($(this)[0], $(this).data());
            awal[i].disable();
            i++;
        });
    });

    function updateSlot(a) {
        if($(a).is(':checked')) $(a).val('1');
        else $(a).val('0');
    }

    function ubahSlot(a, b, c) {
        if($(b).is(':checked')) {
            $('#'+a+' .ubah-slot').removeAttr('disabled');
            $(b).val('1');
            awal[c].enable();
        }
        else {
            $(b).val('0');
            if($('#id_slot_'+c).val() == 0) {
                $('#'+a+' .ubah-slot').attr('disabled', true);
                awal[c].disable();
            }
        }
    }

</script>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Senarai Kehadiran</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Senarai Kehadiran</li>
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
        <form id="lihatRekod" name="lihatRekod" method="get" enctype="multipart/form-data" action="utama.php?view=admin&action=daftar_solat_senaraiLulus">
            <div class="row justify-content-md-center">
                <div class="col-auto col-md-auto">
                    <label>Tarikh</label>
                    <input name="tarikh_slot" type="text" class="form-control" placeholder="" id="mdate2" value="<?php echo($query_date); ?>" required>
                </div>
                <div class="col-auto col-md-auto">
                    <label>Kehadiran</label>
                    <select class="form-control" name="jenisHadir" required>
                        <option value="">Pilih Kehadiran</option>
                        <?php do { ?>
                            <option value="<?php echo($row2_jenisHadir['id_jeniskehadiran']); ?>" <?php if($row2_jenisHadir['id_jeniskehadiran'] == $jenisHadir) echo("selected"); ?>><?php echo($row2_jenisHadir['nama_kehadiran']); ?></option>
                        <?php } while($row2_jenisHadir = mysqli_fetch_assoc($fetch2_jenisHadir)); ?>
                    </select>
                </div>
                <div class="col-auto col-md-auto">
                    <input type="hidden" name="view" value="admin">
                    <input type="hidden" name="action" value="daftar_solat_senaraiLulus">
                    <input type="hidden" name="name_form" value="lihatRekod">
                    <label>*</label>
                    <button type="submit" class="btn btn-info btn-block">Lihat Rekod</button>
                </div>
            </div>
        </form>
        <hr />
        <?php if($_GET['name_form'] == "lihatRekod") { if($num0_senaraiLulus > 0) { ?>
            <div class="col-12 col-md-12">
                <div style="font-size: medium; font-weight: bold" class="alert alert-success" role="alert" align="center">Sebanyak <strong><?php echo number_format($num0_senaraiLulus); ?></strong> Rekod Disenaraikan</div>
            </div>
            <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
                <thead><tr>
                    <th scope="col"><div align="center">Bil</div></th>
                    <th><div align="center">Nama</div></th>
                    <th><div align="center">No K/P</div></th>
                    <th><div align="center">No H/P</div></th>
                    <th><div align="center">Tarikh Mohon</div></th>
                    <th><div align="center">Tarikh Hadir</div></th>
                    <th><div align="center">MySejahtera</div></th>
                </tr></thead>
                <tbody>
                <?php $i=1; do {
                    $nama = $row0_senaraiLulus['nama'];
                    $no_ic = $row0_senaraiLulus['no_ic'];
                    $no_tel = $row0_senaraiLulus['no_tel'];
                    $datetime_apply = $row0_senaraiLulus['datetime_apply'];
                    $datetime = $row0_senaraiLulus['datetime'];
                    $id_mysejahtera = $row0_senaraiLulus['id_gejala'];
                    $sample = "sejarah=1&userid=850915075415&jenisUser=1&token=fMcMcYb0Su-kZj56fkNvu9:APA91bFR7gnlR5RGM8S0smPM86Qn_VL3je83ovQ6OAG-iYNZpTc7SnznWjqR8xKp6yFBaxX8UBCvTXvv_67_H956c-rjQcsqY03lubX7GS7XaPuKEEXOsjWoZ2x-h-TiTieUOi8hWk6k&id_mysejahtera=4437";
                    $code = "sejarah=1&userid=$no_ic&jenisUser=1&token=ADMIN8888&id_mysejahtera=$id_mysejahtera";
                    //echo($code);
                    $code = base64_encode($code);
                    ?>
                    <tr>
                        <td><div align="center"><?php echo($i); ?></div></td>
                        <td><?php echo($nama); ?></td>
                        <td><?php echo($no_ic); ?></td>
                        <td><?php echo($no_tel); ?></td>
                        <td><?php echo($datetime_apply); ?></td>
                        <td><?php echo($datetime); ?></td>
                        <td align="center"><img onclick="sejarah('<?php echo($code); ?>')" width="48" class="img-fluid" src="https://mysejahtera.malaysia.gov.my/checkin/images/logo.png"></td>
                    </tr>
                    <?php $i++; } while($row0_senaraiLulus = mysqli_fetch_assoc($fetch0_senaraiLulus)); ?>
                </tbody>
            </table>
        <?php } if($num0_senaraiLulus == 0) { ?>
            <div class="col-12 col-md-12">
                <div style="font-size: medium; font-weight: bold" class="alert alert-danger" role="alert" align="center">Tiada Rekod Disenaraikan</div>
            </div>
        <?php } } ?>
    </div>
</div>
<?php if($_GET['name_form'] == "lihatRekod") { ?>
    <div class="modal fade" id="exampleModalSejahtera" tabindex="-1" aria-labelledby="exampleModalLabelSejahtera" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="tajukMysejahtera" class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelSejahtera">MySejahtera Check-In</h5>
                    <button onclick="$('#mySejahtera_frame').removeAttr('src')" type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <iframe id="mySejahtera_frame" frameborder="0" width="100%" scrolling="no"></iframe>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="display: none">
                    <button onclick="$('#mySejahtera_frame').removeAttr('src')" type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function sejarah(a) {
            $('#mySejahtera_frame').attr('src', 'https://api.masjidpro.com/rekodSolat?lihat='+a);
            $('#exampleModalSejahtera').modal('show');
        }
        $('#mySejahtera_frame').height($(document).height() - ($(document).height() * 0.2));
    </script>
<?php } ?>
