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

if($_GET['mode'] == "padam") {
    $q = "UPDATE jenis_kehadiran_masjid SET id_setting = NULL, kapasiti = NULL, kapasiti_lelaki = NULL, kapasiti_perempuan = NULL, umur = NULL, umur2 = NULL, vaksin = NULL, kariah = NULL, warganegara = NULL, jantina = NULL WHERE id_jeniskehadiran_masjid = ".$_GET['id'];
    cudSQL2($q, 'padamSetting');
}

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

    // Update setting
    if($_POST['nama_form'] == "tetapanUmum") {
        $kapasiti = $_POST['kapasiti'];
        $kapasiti_lelaki = $_POST['kapasiti_lelaki'];
        $kapasiti_perempuan = $_POST['kapasiti_perempuan'];
        $umur = $_POST['umur'];
        $umur2 = $_POST['umur2'];
        $vaksin = $_POST['vaksin'];
        $kariah = $_POST['kariah'];
        $warganegara = $_POST['warganegara'];
        $jantina = $_POST['jantina'];
        if($jantina == 1) {
            $kapasiti_q = "kapasiti_lelaki = '$kapasiti_lelaki',";
        }
        else if($jantina == 2) {
            $kapasiti_q = "kapasiti_perempuan = '$kapasiti_perempuan',";
        }
        else {
            $kapasiti_q = "kapasiti = '$kapasiti', kapasiti_lelaki = '$kapasiti_lelaki', kapasiti_perempuan = '$kapasiti_perempuan',";
        }
        if($_POST['id_setting'] == NULL) $id_setting = rand();
        $x = 0;
        foreach ($_POST['id_jeniskehadiran_masjid'] as $id) {
            foreach ($_POST as $key => $val) if (is_array($val)) ${$key} = $_POST[$key][$x];
            if($_POST['ubah_slot'][$x] == 1) {
                $update = "UPDATE jenis_kehadiran_masjid SET id_setting = '$id_setting', $kapasiti_q umur = '$umur', umur2 = '$umur2', vaksin = '$vaksin', kariah = '$kariah', warganegara = '$warganegara', jantina = '$jantina' WHERE id_jeniskehadiran_masjid = $id_jeniskehadiran_masjid";
            }
            else if($_POST['ubah_slot'][$x] == 0 && $_POST['id_setting'] != NULL) {
                $update = "UPDATE jenis_kehadiran_masjid SET id_setting = NULL, kapasiti = NULL, kapasiti_lelaki = NULL, kapasiti_perempuan = NULL, umur = NULL, umur2 = NULL, vaksin = NULL, kariah = NULL, warganegara = NULL, jantina = NULL WHERE id_jeniskehadiran_masjid = $id_jeniskehadiran_masjid";
            }
            cudSQL2($update, 'settingSediaAda');
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
        $s = "INSERT INTO jenis_kehadiran_masjid (id_masjid, id_jeniskehadiran) VALUES ($id_masjid, $id_jeniskehadiran)";
        cudSQL2($s, 'masukSlot');
    }
} while($row2_checkJenisSlot = mysqli_fetch_assoc($fetch2_checkJenisSlot));

// Semak setting sedia ada
$q = "SELECT * FROM jenis_kehadiran_masjid a, jenis_kehadiran b WHERE a.id_jeniskehadiran = b.id_jeniskehadiran AND a.id_masjid = $id_masjid AND a.id_setting IS NOT NULL";
selValueSQL2($q, 'semakSediaAda');

// Semak setting tertentu
//if($_GET['id_setting'] != NULL) {
    $q = "SELECT * FROM jenis_kehadiran_masjid WHERE id_masjid = $id_masjid AND id_setting = '" . e($_GET['id_setting'], NULL, NULL) . "' GROUP BY id_setting";
    selValueSQL2($q, 'semakSediaAda2');
//}

// Senarai Waktu Solat
$q = "SELECT a.nama_kehadiran, b.id_jeniskehadiran_masjid, b.id_setting FROM jenis_kehadiran a, jenis_kehadiran_masjid b WHERE a.id_jeniskehadiran = b.id_jeniskehadiran AND b.id_masjid = $id_masjid";
selValueSQL2($q, 'listSolat');

// Display slot setiap jenis
function tunjukSlot() {
    global $id_masjid, $pilihServer;
    $q = "SELECT *, b.kapasiti 'kapasiti', a.kapasiti 'kapasiti2' FROM jenis_kehadiran_masjid a, jenis_kehadiran b WHERE a.id_jeniskehadiran = b.id_jeniskehadiran AND a.id_masjid = $id_masjid";
    selValueSQL2($q, 'jenisSlot');
}

// Senarai jenis kehadiran
$y = "SELECT * FROM jenis_kehadiran";
selValueSQL2($y, 'jenisHadir');

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

        var elems3 = Array.prototype.slice.call(document.querySelectorAll('.js-switch3'));
        var j = 1;
        $('.js-switch3').each(function () {
            new Switchery($(this)[0], $(this).data());
            j++;
        });
    });

    function updateDefault(a) {
        if($(a).is(':checked')) {
            $(a).val('1');
            $('.tetapanAsas').fadeOut();
        }
        else {
            $(a).val('0');
            $('.tetapanAsas').fadeIn();
        }
    }

    function updateUmur(a) {
        if($(a).is(':checked')) {
            $(a).val('1');
            $('.had-umur').fadeIn();
            $('.had-umur input').attr('required', true);
        }
        else {
            $(a).val('0');
            $('.had-umur').fadeOut();
            $('.had-umur input').removeAttr('required');
        }
    }

    function updateSlot(a) {
        if($(a).is(':checked')) $(a).val('1');
        else $(a).val('0');
    }

    function ubahSlot(a, b, c) {
        if($(b).is(':checked')) {
            $('#id_jeniskehadiran_masjid_'+c).removeAttr('disabled');
            //$('#'+a+' .ubah-slot').removeAttr('disabled');
            $(b).val('1');
            //awal[c].enable();
        }
        else {
            $(b).val('0');
            if($('#id_slot_'+c).val() == 0) {
                $('#id_jeniskehadiran_masjid_'+c).attr('disabled', true);
                //$('#'+a+' .ubah-slot').attr('disabled', true);
                //awal[c].disable();
            }
        }
    }

    function kiraKapasiti(lelaki, perempuan) {
        lelaki = lelaki || 0;
        perempuan = perempuan || 0;
        var jumlah = parseInt(lelaki) + parseInt(perempuan);
        $('#jumlah_kapasiti').val(jumlah);
    }

    function updateKapasiti(a) {
        if($(a).is(':checked')) {
            $(a).val('1');
            if($('#jantina option:selected').val() == 1) {
                $('.semua-jantina').fadeOut();
                $('.lelaki').fadeIn();
                $('#jumlah_kapasiti').val(null);
                $('#kapasiti_lelaki').attr('required', true);
                $('#kapasiti_perempuan').val(null);
                $('#kapasiti_perempuan').removeAttr('required');
            }
            else if($('#jantina option:selected').val() == 2) {
                $('.semua-jantina').fadeOut();
                $('.perempuan').fadeIn();
                $('#jumlah_kapasiti').val(null);
                $('#kapasiti_perempuan').attr('required', true);
                $('#kapasiti_lelaki').val(null);
                $('#kapasiti_lelaki').removeAttr('required');
            }
            else {
                $('.semua-jantina').fadeIn();
                $('.semua-jantina input').attr('required', true);
            }
        }
        else {
            $(a).val('0');
            $('.semua-jantina').fadeOut();
            $('.semua-jantina input').removeAttr('required');
        }
    }

    function sahPadam(a) {
        var result = confirm("Anda pasti untuk memadam tetapan ini?");
        if (result) {
            document.location.href = 'utama.php?view=admin&action=daftar_solat&mode=padam&id='+a;
        }
    }

    $(document).ready(function(){
        $('#jantina').on('change', function() {
            if($(this).val() == 1) {
                $('.semua-jantina').fadeOut();
                //$('.lelaki').fadeIn();
                $('#jumlah_kapasiti').val(null);
                $('#kapasiti_lelaki').attr('required', true);
                $('#kapasiti_perempuan').val(null);
                $('#kapasiti_perempuan').removeAttr('required');
            }
            else if($(this).val() == 2) {
                $('.semua-jantina').fadeOut();
                //$('.perempuan').fadeIn();
                $('#jumlah_kapasiti').val(null);
                $('#kapasiti_perempuan').attr('required', true);
                $('#kapasiti_lelaki').val(null);
                $('#kapasiti_lelaki').removeAttr('required');
            }
        });
    });
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
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card border-info">
            <div class="card-header bg-royal">
                <div class="row">
                    <div class="col-auto col-md-8" align="left"><h4 class="m-b-0 text-white">Senarai Ketetapan</h4></div>
                    <div class="col-auto col-md-4" align="right"><button type="button" data-toggle="modal" data-target="#verticalcenter" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Tetapan Baharu</button></div>
                </div>
            </div>
            <div class="row">
                <div class="row card-body">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <?php if($num2_semakSediaAda > 0) { ?>
                                <table id="meja_akaun" class="table table-striped table-secondary">
                                    <thead>
                                    <tr>
                                        <th scope="col">Umur</th>
                                        <th scope="col">Vaksinasi</th>
                                        <th scope="col">Jantina</th>
                                        <th scope="col">Kariah</th>
                                        <th scope="col">Warganegara</th>
                                        <th scope="col">Kapasiti</th>
                                        <th scope="col">Lelaki / Perempuan</th>
                                        <th scope="col">Slot</th>
                                        <th scope="col">Tindakkan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 0; do {
                                        $vaksin = $row2_semakSediaAda['vaksin'];
                                        $jantina = $row2_semakSediaAda['jantina'];
                                        $warganegara = $row2_semakSediaAda['warganegara'];
                                        $kariah = $row2_semakSediaAda['kariah'];
                                        if($vaksin == 0 || $vaksin == NULL) $vaksinLabel = "Semua";
                                        if($vaksin == 1) $vaksinLabel = "1 Dos";
                                        if($vaksin == 2) $vaksinLabel = "Lengkap";
                                        if($jantina == 0 || $jantina == NULL) $jantinaLabel = "Semua";
                                        if($jantina == 1) $jantinaLabel = "Lelaki";
                                        if($jantina == 2) $jantinaLabel = "Perempuan";
                                        if($warganegara == 0 || $warganegara == NULL) $warganegaraLabel = "Semua";
                                        if($warganegara == 1) $warganegaraLabel = "Warganegara Sahaja";
                                        if($kariah == 0 || $kariah == NULL) $kariahLabel = "Semua";
                                        if($kariah == 1) $kariahLabel = "Ahli Kariah";
                                        ?>
                                        <tr>
                                            <td><?php echo($row2_semakSediaAda['umur'].' - '.$row2_semakSediaAda['umur2']); ?></td>
                                            <td><?php echo($vaksinLabel); ?></td>
                                            <td><?php echo($jantinaLabel); ?></td>
                                            <td><?php echo($kariahLabel); ?></td>
                                            <td><?php echo($warganegaraLabel); ?></td>
                                            <td><?php echo($row2_semakSediaAda['kapasiti_lelaki'] + $row2_semakSediaAda['kapasiti_perempuan']); ?></td>
                                            <td><?php echo($row2_semakSediaAda['kapasiti_lelaki']); ?> / <?php echo($row2_semakSediaAda['kapasiti_perempuan']); ?></td>
                                            <td><?php echo($row2_semakSediaAda['nama_kehadiran']); ?></td>
                                            <td><button onclick="sahPadam('<?php echo($row2_semakSediaAda['id_jeniskehadiran_masjid']); ?>')" type="button" class="btn btn-danger">Padam</button></td>
                                        </tr>
                                        <?php $i++; } while($row2_semakSediaAda = mysqli_fetch_assoc($fetch2_semakSediaAda)); ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <div style="font-size: medium; font-weight: bold; display: block" class="alert alert-danger" role="alert" align="center">Tiada Rekod Ketetapan Ditemui</div>
                                <div style="font-size: medium; font-weight: bold; display: block" class="alert alert-success" role="alert" align="center">Ketetapan 'Default' akan digunakan seperti berikut:-</div>
                                <div style="font-size: medium; font-weight: bold; display: block" class="alert alert-info" role="alert" align="left">
                                    <ol>
                                        <li>Semua peringkat umur dibenarkan</li>
                                        <li>Semua status tahap vaksinasi dibenarkan</li>
                                        <li>Semua jemaah sama ada ahli kariah atau bukan kariah berkenaan dibenarkan</li>
                                        <li>Warganegara atau bukan warganegara dibenarkan</li>
                                        <li>Terbuka untuk jemaah lelaki dan perempuan</li>
                                        <li>Tiada had kapasiti jemaah</li>
                                        <li>Slot waktu solat sentiasa terbuka untuk jemaah mendaftar</li>
                                        <li>Terpakai untuk semua slot waktu solat</li>
                                    </ol>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="verticalcenter" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="row modal-content">
            <div class="col-12 col-md-12">
                <div class="border-info">
                    <div class="bg-royal modal-header">
                        <h4 class="m-b-0 text-white">Tetapan</h4>
                        <button type="button" style="background: white" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="card-body2 modal-body">
                        <div class="row form-group" style="display: none">
                            <div class="col-12 col-md-6">
                                <label>Default (Semua Dibenarkan)</label>
                                <input onchange="updateDefault($(this))" type="checkbox" class="js-switch3" data-color="#010280" <?php if($num2_semakDefault < 1) echo('checked'); ?> value="<?php if($num2_semakDefault < 1) echo('1'); else echo('0'); ?>" />
                            </div>
                        </div>
                        <form id="tetapanUmum" name="tetapanUmum" method="post" enctype="multipart/form-data" action="utama.php?view=admin&action=daftar_solat">
                            <div class="row tetapanAsas form-group">
                                <div class="col-12 col-md-auto">
                                    <label>Peringkat Umur</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <label>Hadkan Umur</label>
                                    <input onchange="updateUmur($(this))" type="checkbox" class="js-switch3" data-color="#010280" <?php if($row2_semakSediaAda2['umur'] != NULL || $row2_semakSediaAda2['umur2'] != NULL) echo('checked'); ?> value="<?php if($row2_semakSediaAda2['umur'] != NULL || $row2_semakSediaAda2['umur2'] != NULL) echo('1'); else echo('0'); ?>" />
                                </div>
                                <div class="col-6 col-md-6 had-umur" style="<?php if($row2_semakSediaAda2['umur'] == NULL || $row2_semakSediaAda2['umur2'] == NULL) echo 'display: none'; ?>">
                                    <input class="form-control" name="umur" type="number" step="1" placeholder="Dari" value="<?php echo($row2_semakSediaAda2['umur']); ?>">
                                </div>
                                <div class="col-6 col-md-6 had-umur" style="<?php if($row2_semakSediaAda2['umur'] == NULL || $row2_semakSediaAda2['umur2'] == NULL) echo 'display: none'; ?>">
                                    <input class="form-control" name="umur2" type="number" step="1" placeholder="Hingga" value="<?php echo($row2_semakSediaAda2['umur2']); ?>">
                                </div>
                            </div>
                            <div class="row tetapanAsas form-group">
                                <div class="col-6 col-md-6">
                                    <label class="control-label">Vaksinasi</label>
                                    <select name="vaksin" class="form-control" required>
                                        <option value="">Pilih:-</option>
                                        <option value="0" <?php if($row2_semakSediaAda2['vaksin'] == 0 || $row2_semakSediaAda2['vaksin'] == NULL) echo('selected'); ?>>Semua</option>
                                        <option value="1" <?php if($row2_semakSediaAda2['vaksin'] == 1) echo('selected'); ?>>1 Dos</option>
                                        <option value="2" <?php if($row2_semakSediaAda2['vaksin'] == 2) echo('selected'); ?>>Lengkap</option>
                                    </select>
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="control-label">Kariah Jemaah</label>
                                    <select name="kariah" class="form-control" required>
                                        <option value="">Pilih:-</option>
                                        <option value="0" <?php if($row2_semakSediaAda2['kariah'] == 0 || $row2_semakSediaAda2['kariah'] == NULL) echo('selected'); ?>>Semua</option>
                                        <option value="1" <?php if($row2_semakSediaAda2['kariah'] == 1) echo('selected'); ?>>Ahli Kariah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row tetapanAsas form-group">
                                <div class="col-6 col-md-6">
                                    <label class="control-label">Warganegara</label>
                                    <select name="warganegara" class="form-control" required>
                                        <option value="">Pilih:-</option>
                                        <option value="0" <?php if($row2_semakSediaAda2['warganegara'] == 0 || $row2_semakSediaAda2['warganegara'] == NULL) echo('selected'); ?>>Semua</option>
                                        <option value="1" <?php if($row2_semakSediaAda2['warganegara'] == 1) echo('selected'); ?>>Warganegara Sahaja</option>
                                    </select>
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="control-label">Jantina</label>
                                    <select id="jantina" name="jantina" class="form-control" required>
                                        <option value="">Pilih:-</option>
                                        <option value="0" <?php if($row2_semakSediaAda2['jantina'] == 0 || $row2_semakSediaAda2['jantina'] == NULL) echo('selected'); ?>>Semua</option>
                                        <option value="1" <?php if($row2_semakSediaAda2['jantina'] == 1) echo('selected'); ?>>Lelaki</option>
                                        <option value="2" <?php if($row2_semakSediaAda2['jantina'] == 2) echo('selected'); ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row tetapanAsas form-group">
                                <div class="col-12 col-md-12">
                                    <label>Hadkan Kapasiti</label>
                                    <input onchange="updateKapasiti($(this))" type="checkbox" class="js-switch3" data-color="#010280" <?php if($row2_semakSediaAda2['kapasiti'] != NULL || $row2_semakSediaAda2['kapasiti_lelaki'] != NULL || $row2_semakSediaAda2['kapasiti_perempuan'] != NULL) echo('checked'); ?> value="<?php if($row2_semakSediaAda2['kapasiti'] != NULL || $row2_semakSediaAda2['kapasiti_lelaki'] != NULL || $row2_semakSediaAda2['kapasiti_perempuan'] != NULL) echo('1'); else echo('0'); ?>" />
                                </div>
                                <div class="col-6 col-md-4 lelaki semua-jantina" style="<?php if($row2_semakSediaAda2['kapasiti_lelaki'] == NULL) echo('display: none'); else echo(''); ?>">
                                    <label>Lelaki</label>
                                    <input oninput="kiraKapasiti(this.value, $('#kapasiti_perempuan').val())" class="form-control" id="kapasiti_lelaki" name="kapasiti_lelaki" type="number" step="1" value="<?php echo($row2_semakSediaAda2['kapasiti_lelaki']); ?>">
                                </div>
                                <div class="col-6 col-md-4 perempuan semua-jantina" style="<?php if($row2_semakSediaAda2['kapasiti_perempuan'] == NULL) echo('display: none'); else echo(''); ?>">
                                    <label>Perempuan</label>
                                    <input oninput="kiraKapasiti($('#kapasiti_lelaki').val(), this.value)" class="form-control" id="kapasiti_perempuan" name="kapasiti_perempuan" type="number" step="1" value="<?php echo($row2_semakSediaAda2['kapasiti_perempuan']); ?>">
                                </div>
                                <div class="col-6 col-md-4 semua-jantina" style="<?php if($row2_semakSediaAda2['kapasiti_lelaki'] == NULL || $row2_semakSediaAda2['kapasiti_perempuan'] == NULL) echo('display: none'); else echo(''); ?>">
                                    <label>Jumlah</label>
                                    <input readonly class="form-control" id="jumlah_kapasiti" name="kapasiti" type="number" step="1" value="<?php echo($row2_semakSediaAda2['kapasiti']); ?>">
                                </div>
                            </div>
                            <div class="row tetapanAsas form-group">
                                <div class="col-12 col-md-auto">
                                    <label>Jenis Solat (Slot)</label>
                                    <div class="row">
                                        <?php $i = 1; do { ?>
                                            <div class="col-6 col-md-6">
                                                <input disabled id="id_jeniskehadiran_masjid_<?php echo($i); ?>" name="id_jeniskehadiran_masjid[]" type="hidden" value="<?php echo($row2_listSolat['id_jeniskehadiran_masjid']); ?>">
                                                <input <?php if($row2_semakSediaAda2['id_setting'] == NULL) echo(""); else echo("disabled"); ?> id="ubah_slot_<?php echo($i); ?>" <?php if($row2_semakSediaAda2['id_setting'] != NULL) echo("checked"); ?> data-switchery="true" onchange="ubahSlot('ubah_slot_<?php echo($i); ?>', $(this), <?php echo($i); ?>)" type="checkbox" name="ubah_slot[]" data-color="#010280" class="js-switch" value="<?php if($row2_semakSediaAda2['id_setting'] != NULL) echo("1"); else echo("0"); ?>">
                                                <label><?php echo($row2_listSolat['nama_kehadiran']); ?></label>
                                            </div>
                                        <?php $i++; } while($row2_listSolat = mysqli_fetch_assoc($fetch2_listSolat)); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row tetapanAsas form-group">
                                <div class="col-12 col-md-6">
                                    <input type="hidden" name="nama_form" value="tetapanUmum">
                                    <input type="hidden" name="id_setting" value="<?php echo($row2_semakSediaAda2['id_setting']); ?>">
                                    <button type="submit" class="btn btn-rounded btn-block btn-info"><i class="fa fa-database"></i> Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer2 modal-footer">
                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->