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
$z = "SELECT c.nama, c.no_ic, c.no_tel, a.datetime_apply, d.datetime FROM $dftrSolat_db.list_kehadiran a LEFT JOIN $mysql_database_utama.sej6x_data_masjid b ON a.id_masjid = b.id_masjid LEFT JOIN $dftrSolat_db.maklumat_peribadi c ON a.id_peribadi = c.id_peribadi LEFT JOIN $dftrSolat_db.log_kehadiran d ON a.id_listkehadiran = d.id_listkehadiran LEFT JOIN $dftrSolat_db.jenis_kehadiran_masjid e ON a.jenis_kehadiran_masjid = e.id_jeniskehadiran_masjid LEFT JOIN $dftrSolat_db.jenis_kehadiran f ON e.id_jeniskehadiran = f.id_jeniskehadiran WHERE a.id_masjid = $id_masjid AND f.id_jeniskehadiran = $jenisHadir AND a.tarikh_kehadiran = '$query_date' GROUP BY a.id_peribadi";
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
                <h1>Pengurusan Daftar Solat</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Daftar Solat</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div id="accordion">
    <div class="card">
        <div class="card-header" id="headingThree">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Senarai Kelulusan dan Kehadiran Jemaah
                </button>
            </h5>
        </div>
        <div id="collapseThree" class="collapse <?php if($name_form == "lihatRekod") echo("show"); ?>" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body table-responsive">
                <div class="row">
                    <div align="center" class="col-12 col-md-12"><h3><strong><?php fungsi_tarikh($query_date, 2, 4); ?></strong></h3></div>
                </div>
                <hr />
                <form id="lihatRekod" name="lihatRekod" method="get" enctype="multipart/form-data" action="utama.php?view=admin&action=daftar_solat">
                    <div class="row">
                        <div class="col-auto col-md-auto">
                            <label>Pilih Tarikh</label>
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
                            <input type="hidden" name="action" value="daftar_solat">
                            <input type="hidden" name="name_form" value="lihatRekod">
                            <label>*</label>
                            <button type="submit" class="btn btn-info btn-block">Lihat Rekod</button>
                        </div>
                    </div>
                </form>
                <hr />
                <?php if($num0_senaraiLulus > 0) { ?>
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
                        </tr></thead>
                        <tbody>
                        <?php $i=1; do { ?>
                            <tr>
                                <td><div align="center"><?php echo($i); ?></div></td>
                                <td><?php echo($row0_senaraiLulus['nama']); ?></td>
                                <td><?php echo($row0_senaraiLulus['no_ic']); ?></td>
                                <td><?php echo($row0_senaraiLulus['no_tel']); ?></td>
                                <td><?php echo($row0_senaraiLulus['datetime_apply']); ?></td>
                                <td><?php echo($row0_senaraiLulus['datetime']); ?></td>
                            </tr>
                            <?php $i++; } while($row0_senaraiLulus = mysqli_fetch_assoc($fetch0_senaraiLulus)); ?>
                        </tbody>
                    </table>
                <?php } if($num0_senaraiLulus == 0) { ?>
                    <div class="col-12 col-md-12">
                        <div style="font-size: medium; font-weight: bold" class="alert alert-danger" role="alert" align="center">Tiada Rekod Disenaraikan</div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Tetapan Slot Umum
                </button>
            </h5>
        </div>
        <div id="collapseOne" class="collapse <?php if($name_form == "jenisSlot") echo("show"); ?>" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <form id="jenisSlot" name="jenisSlot" method="post" enctype="multipart/form-data" action="utama.php?view=admin&action=daftar_solat">
                    <div class="row">
                        <div class="col-6 col-md form-group"><h5>Slot</h5></div>
                        <div class="col-6 col-md form-group"><h5>Lelaki</h5></div>
                        <div class="col-6 col-md form-group"><h5>Perempuan</h5></div>
                        <div class="col-6 col-md form-group"><h5>Jumlah</h5></div>
                    </div>
                    <?php tunjukSlot(); do { ?>
                        <div class="row">
                            <div class="col-6 col-md form-group"><?php echo($row2_jenisSlot['nama_kehadiran']); ?></div>
                            <div class="col-6 col-md form-group"><input class="form-control" name="kapasiti_lelaki[]" type="number" step="1" value="<?php echo($row2_jenisSlot['kapasiti_lelaki']); ?>"></div>
                            <div class="col-6 col-md form-group"><input class="form-control" name="kapasiti_perempuan[]" type="number" step="1" value="<?php echo($row2_jenisSlot['kapasiti_perempuan']); ?>"></div>
                            <div class="col-6 col-md form-group"><input class="form-control" name="kapasiti[]" type="number" step="1" value="<?php if($row2_jenisSlot['kapasiti2'] != NULL) echo($row2_jenisSlot['kapasiti2']); else echo($row2_jenisSlot['kapasiti']); ?>" required></div>
                        </div>
                        <input name="id_jeniskehadiran_masjid[]" type="hidden" value="<?php echo($row2_jenisSlot['id_jeniskehadiran_masjid']); ?>">
                    <?php } while($row2_jenisSlot = mysqli_fetch_assoc($fetch2_jenisSlot)); ?>
                    <div class="col-12 col-md-12 form-group">
                        <input type="hidden" name="nama_form" value="jenisSlot">
                        <button class="btn btn-primary" id="tetapan" name="tetapan" type="submit">Kemaskini</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Tetapan Slot Khusus
                </button>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse <?php if($name_form == "slotKhusus") echo("show"); ?>" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                <form id="slotKhusus" name="slotKhusus" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?'.$_SERVER['QUERY_STRING']; ?>">
                    <div class="row form-group">
                        <div class="col-6 col-md-6 form-group">
                            <label class="m-t-20">Tarikh</label>
                            <input onchange="document.location.href='<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?'.$_SERVER['QUERY_STRING']; ?>&name_form=slotKhusus&tarikh_slot='+this.value" name="tarikh_slot" type="text" class="form-control" placeholder="" id="mdate" value="<?php echo($query_date); ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md form-group"><h5>Slot</h5></div>
                        <div class="col-6 col-md form-group"><h5>Lelaki</h5></div>
                        <div class="col-6 col-md form-group"><h5>Perempuan</h5></div>
                        <div class="col-6 col-md form-group"><h5>Jumlah</h5></div>
                        <div class="col-6 col-md form-group"><h5>Aktif</h5></div>
                    </div>
                    <?php tunjukSlot(); $i = 1; do {
                        $r = "SELECT * FROM slot_tersedia WHERE tarikh_slot = '$query_date' AND id_masjid = $id_masjid AND id_jeniskehadiran_masjid = ".$row2_jenisSlot['id_jeniskehadiran_masjid'];
                        selValueSQL2($r, 'slotKhusus');
                        ?>
                        <div id="ubah_slot_<?php echo($i); ?>" class="row">
                            <div class="col-6 col-md form-group">
                                <input id="id_slot_<?php echo($i); ?>" <?php if($row2_slotKhusus['id_slot'] != NULL) echo("checked"); ?> data-switchery="true" onchange="ubahSlot('ubah_slot_<?php echo($i); ?>', $(this), <?php echo($i); ?>)" type="checkbox" name="ubah_slot[]" data-color="#009efb" class="js-switch" value="<?php if($row2_slotKhusus['id_slot'] != NULL) echo("1"); else echo("0"); ?>">
                                <?php echo($row2_jenisSlot['nama_kehadiran']); ?>
                                <?php if($row2_slotKhusus['id_slot'] != NULL) {
                                    echo "<script>";
                                    echo "\r\n$(document).ready(function(){\r\n";
                                    echo 'ubahSlot("ubah_slot_'.$i.'", "#id_slot_'.$i.'", '.$i.');'."\r\n";
                                    echo "});\r\n";
                                    echo "</script>";
                                }
                                ?>
                            </div>
                            <div class="col-6 col-md form-group"><input <?php if($row2_slotKhusus['id_slot'] == NULL) echo("disabled"); ?> class="ubah-slot form-control" name="kapasiti_lelaki[]" type="number" step="1" value="<?php if($row2_slotKhusus['kapasiti_lelaki'] != NULL) echo($row2_slotKhusus['kapasiti_lelaki']); else echo($row2_jenisSlot['kapasiti_lelaki']); ?>"></div>
                            <div class="col-6 col-md form-group"><input <?php if($row2_slotKhusus['id_slot'] == NULL) echo("disabled"); ?> class="ubah-slot form-control" name="kapasiti_perempuan[]" type="number" step="1" value="<?php if($row2_slotKhusus['kapasiti_perempuan'] != NULL) echo($row2_slotKhusus['kapasiti_perempuan']); else echo($row2_jenisSlot['kapasiti_perempuan']); ?>"></div>
                            <div class="col-6 col-md form-group"><input <?php if($row2_slotKhusus['id_slot'] == NULL) echo("disabled"); ?> class="ubah-slot form-control" name="kapasiti[]" type="number" step="1" value="<?php if($row2_slotKhusus['kapasiti'] != NULL) echo($row2_slotKhusus['kapasiti']); else echo($row2_jenisSlot['kapasiti']); ?>" required></div>
                            <div class="col-6 col-md form-group">
                                <input data-switchery="true" onchange="updateSlot($(this))" type="checkbox" <?php if($row2_slotKhusus['slot_tersedia'] != 0 || $row2_slotKhusus['slot_tersedia'] == NULL) echo "checked"; else echo ""; ?> name="slot_tersedia[]" data-color="#009efb" class="js-switch2" value="<?php if($row2_slotKhusus['slot_tersedia'] != 0 || $row2_slotKhusus['slot_tersedia'] == NULL) echo("1"); else echo("0"); ?>">
                            </div>
                        </div>
                        <input class="ubah-slot" name="id_jeniskehadiran_masjid[]" type="hidden" value="<?php echo($row2_jenisSlot['id_jeniskehadiran_masjid']); ?>">
                        <input id="id_slot_<?php echo($i); ?>" class="ubah-slot" name="id_slot[]" type="hidden" value="<?php echo($row2_slotKhusus['id_slot']); ?>">

                        <?php $i++; } while($row2_jenisSlot = mysqli_fetch_assoc($fetch2_jenisSlot)); ?>
                    <div class="col-12 col-md-12 form-group">
                        <input type="hidden" name="nama_form" value="slotKhusus">
                        <button class="btn btn-primary" id="tetapan" name="tetapan" type="submit">Kemaskini</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>