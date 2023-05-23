<?php
if($_GET['data'] != "raw") {
    $query_date = date('Y-m-d');
    if ($_GET['tarikh_slot'] != NULL) $query_date = e($_GET['tarikh_slot'], NULL, NULL);
    if ($_POST['tarikh_slot'] != NULL) $query_date = e($_POST['tarikh_slot'], NULL, NULL);
    if ($_GET['name_form'] != NULL) $name_form = e($_GET['name_form'], NULL, NULL);
}
$q = "SELECT nama_masjid, id_masjid FROM sej6x_data_masjid WHERE id_masjid = $id_masjid";

selValueSQL($q, 'infoMasjid');
$id_masjid = $row_infoMasjid['id_masjid'];
$nama_masjid = $row_infoMasjid['nama_masjid'];

//if($id_masjid == 6279) {
//    $pilihServer = 2;
//    $dev_status = 1;
//    $dftrSolat_db = $dftrSolat_db2;
//    $mysql_database_utama = $mysql_database_utama2;
//    if($pilihServer == 2) {
//        $bd2 = $bd2_dev;
//    }
//}

if($_GET['data'] == "raw") {
    $approve = $_GET['approve'];
    $status = $_GET['status'];
    $no_ic_vaksin = $_GET['no_ic'];
    $id_vaksin = $_GET['id_vaksin'];
    $load_area = $_GET['load_area'];
    $url = "utama.php?view=admin&action=daftar_solat_senarai&data=raw&approve=$approve&no_ic=$no_ic_vaksin&id_vaksin=$id_vaksin&load_area=$load_area";
    if($approve == 1) $extra = "status = '$status'";
    if($approve == 2) $extra = "status2 = '$status'";
    $q = "UPDATE data_vaksin SET $extra WHERE no_ic = '$no_ic_vaksin' AND id_vaksin = $id_vaksin";
    cudSQL($q, 'updateVaksin');
    if($updateStatus_updateVaksin == 1) {
        if($status == 1) $pilih = "selected";
        if($status == 2) $pilih2 = "selected";
        if($approve == 1) {
            $nama_select = "status[]";
        }
        if($approve == 2) {
            $nama_select = "status2[]";
        }
    }
    echo '<select onchange="loadPage(\''.$url.'&status=\'+this.value, \''.$load_area.'\')" class="form-control" name="'.$nama_select.'">
<option value=""></option>
<option value="1" '.$pilih.'>Diluluskan</option>
<option value="2" '.$pilih2.'>Ditolak</option>
</select>';
}


if($_GET['data'] != "raw") {
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

if($_SERVER['REQUEST_METHOD'] == "POST") {
    //$name_form = e($_POST['nama_form'], NULL, NULL);

//    // Update kapasiti untuk setiap slot
//    if($_POST['nama_form'] == "jenisSlot") {
//        $x = 0;
//        foreach ($_POST['id_jeniskehadiran_masjid'] as $id) {
//            foreach ($_POST as $key => $val) if (is_array($val)) ${$key} = $_POST[$key][$x];
//            $k = "UPDATE jenis_kehadiran_masjid SET kapasiti_lelaki = '$kapasiti_lelaki', kapasiti_perempuan = '$kapasiti_perempuan', kapasiti = '$kapasiti' WHERE id_jeniskehadiran_masjid = $id_jeniskehadiran_masjid";
//            cudSQL2($k, 'updateSlot');
//            $x++;
//        }
//    }

    // Update kapasiti khusus untuk setiap slot
//    if($_POST['nama_form'] == "slotKhusus") {
//        $x = 0;
//        $tarikh_slot = $_POST['tarikh_slot'];
//        foreach ($_POST['id_slot'] as $id) {
//            foreach ($_POST as $key => $val) if (is_array($val)) ${$key} = $_POST[$key][$x];
//            if($_POST['ubah_slot'][$x] == 1) {
//                $update = "UPDATE slot_tersedia SET id_jeniskehadiran_masjid = '$id_jeniskehadiran_masjid', tarikh_slot = '$tarikh_slot', slot_tersedia = '$slot_tersedia', kapasiti = '$kapasiti', kapasiti_lelaki = '$kapasiti_lelaki', kapasiti_perempuan = '$kapasiti_perempuan' WHERE id_jeniskehadiran_masjid = $id_jeniskehadiran_masjid";
//                if ($_POST['id_slot'][$x] == NULL) {
//                    $check = "SELECT * FROM slot_tersedia WHERE id_masjid = $id_masjid AND tarikh_slot = '$tarikh_slot' AND id_jeniskehadiran_masjid = $id_jeniskehadiran_masjid";
//                    selValueSQL2($check, 'semak');
//                    if($num2_semak < 1) $k = "INSERT INTO slot_tersedia (id_masjid, id_jeniskehadiran_masjid, tarikh_slot, slot_tersedia, kapasiti, kapasiti_lelaki, kapasiti_perempuan) VALUES ('$id_masjid', '$id_jeniskehadiran_masjid', '$tarikh_slot', '$slot_tersedia', '$kapasiti', '$kapasiti_lelaki', '$kapasiti_perempuan')";
//                    else $k = $update;
//                }
//                else $k = $update;
//                cudSQL2($k, 'slotKhusus');
//            }
//            else if($_POST['ubah_slot'][$x] == 0 && $_POST['id_slot'][$x] != NULL) {
//                $k = "DELETE FROM slot_tersedia WHERE id_slot = ".$_POST['id_slot'][$x];
//                cudSQL2($k, 'slotKhusus');
//            }
//            $x++;
//        }
//    }

    // Update kelulusan
    if($_POST['name_form'] == "lihatVaksinasi") {
        foreach ($_POST as $key => $val) ${$key} = e($val, NULL, NULL);
        if($dos_vaksin == "Semua") $extra = "";
        else if($dos_vaksin == "Tiada Maklumat") $extra = "AND (b.dos_vaksin IS NULL OR b.dos_vaksin = '')";
        else $extra = "AND b.dos_vaksin = '$dos_vaksin'";
        $q = "SELECT b.last_added, b.id_vaksin, a.nama, a.no_ic, a.no_tel, b.status, b.status2, b.dos_vaksin, IF(CHAR_LENGTH(b.file_attach > 10), 1, 0) AS bukti_vaksin FROM $dftrSolat_db.maklumat_peribadi a LEFT JOIN $mysql_database_utama.data_vaksin b ON a.no_ic = b.no_ic WHERE a.id_masjid = $id_masjid $extra ORDER BY b.last_added DESC";
        selValueSQL0($q, 'lihatVaksinasi');
    }

}

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

    function statusVaksin(approve, status, no_ic, id_vaksin, load_area) {
        var web = "utama.php?view=admin&action=daftar_solat_senarai&data=raw&approve="+approve+"&no_ic="+no_ic+"&id_vaksin="+id_vaksin+"&load_area="+load_area;
        var pilih = "";
        var pilih2 = "";
        var nama_select = "";
        if(status == 1) pilih = 'selected';
        if(status == 2) pilih2 = 'selected';
        if(approve == 1) nama_select = "status[]";
        if(approve == 2) nama_select = "status2[]";
        var dataVaksin = '<select onchange="loadPage(\''+web+'&status=\'+this.value, \'#'+load_area+'\')" class="form-control" name="'+nama_select+'">' +
            '<option value=""></option>' +
            '<option value="1" '+pilih+'>Diluluskan</option>' +
            '<option value="2" '+pilih2+'>Ditolak</option>' +
            '</select>';
        document.writeln(dataVaksin);
    }
</script>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Kelulusan Vaksinasi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Kelulusan Vaksinasi</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-12 col-md-12"><h3><strong>Senarai Vaksinasi <?php if($name_form == "lihatVaksinasi") echo('('.$dos_vaksin.')'); ?></strong></h3></div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <form id="lihatVaksinasi" name="lihatVaksinasi" method="POST" enctype="multipart/form-data" action="utama.php?view=admin&action=daftar_solat_senarai">
            <div class="row">
                <div class="col-auto col-md-auto">
                    <select class="form-control" name="dos_vaksin" required>
                        <option value="">Pilih Maklumat Vaksinasi:-</option>
                        <option value="Semua" <?php if($dos_vaksin == "Semua") echo('selected'); ?>>Semua</option>
                        <option value="1 Dos" <?php if($dos_vaksin == "1 Dos") echo('selected'); ?>>1 Dos</option>
                        <option value="Lengkap" <?php if($dos_vaksin == "Lengkap") echo('selected'); ?>>Lengkap</option>
                        <option value="Belum Vaksin" <?php if($dos_vaksin == "Belum Vaksin") echo('selected'); ?>>Belum Vaksin</option>
                        <option value="Tiada Maklumat" <?php if($dos_vaksin == "Tiada Maklumat") echo('selected'); ?>>Tiada Maklumat</option>
                    </select>
                </div>
                <div class="col-auto col-md-auto">
                    <input type="hidden" name="view" value="admin">
                    <input type="hidden" name="action" value="daftar_solat_senarai">
                    <input type="hidden" name="name_form" value="lihatVaksinasi">
                    <button type="submit" class="btn btn-info btn-block">Lihat Rekod</button>
                </div>
            </div>
        </form>
        <hr />
        <?php if($name_form == "lihatVaksinasi") { if($num0_lihatVaksinasi > 0) { ?>
            <div class="col-12 col-md-12">
                <div style="font-size: medium; font-weight: bold" class="alert alert-success" role="alert" align="center">Sebanyak <strong><?php echo number_format($num0_lihatVaksinasi); ?></strong> Rekod Disenaraikan</div>
            </div>
            <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
                <thead><tr>
                    <th scope="col"><div align="center">Bil</div></th>
                    <th><div align="center">Nama</div></th>
                    <th><div align="center">No K/P</div></th>
                    <th><div align="center">No H/P</div></th>
                    <th><div align="center">Vaksinasi</div></th>
                    <th><div align="center">Fail</div></th>
                    <th><div align="center">Tarikh</div></th>
                    <th><div align="center">Status 1</div></th>
                    <th><div align="center">Status 2</div></th>
                </tr></thead>
                <tbody>
                <?php $i=1; do { ?>
                    <tr>
                        <td><div align="center"><?php echo($i); ?></div></td>
                        <td><?php echo strtoupper($row0_lihatVaksinasi['nama']); ?></td>
                        <td><?php echo($row0_lihatVaksinasi['no_ic']); ?></td>
                        <td><?php echo($row0_lihatVaksinasi['no_tel']); ?></td>
                        <td><?php echo($row0_lihatVaksinasi['dos_vaksin']); ?></td>
                        <td align="center"><?php if($row0_lihatVaksinasi['bukti_vaksin'] == 1) echo ('<i onclick="semakVaksin(\''.strtoupper($row0_lihatVaksinasi['nama']).'\', \''.$row0_lihatVaksinasi['dos_vaksin'].'\', \'utama.php?data=raw&action=lihat_fail&fileDB=1&file=vaksin&no_ic='.$row0_lihatVaksinasi['no_ic'].'&id_vaksin='.$row0_lihatVaksinasi['id_vaksin'].'&dev='.$dev_status.'\')" style="font-size: 20px" class="ti-file"></i>'); ?></td>
                        <td><?php echo($row0_lihatVaksinasi['last_added']); ?></td>
                        <td id="status_<?php echo($i); ?>"><?php if($row0_lihatVaksinasi['dos_vaksin'] != NULL) { ?><script>statusVaksin('1', '<?php echo($row0_lihatVaksinasi['status']); ?>', '<?php echo($row0_lihatVaksinasi['no_ic']); ?>', '<?php echo($row0_lihatVaksinasi['id_vaksin']); ?>', 'status_<?php echo($i); ?>');</script><?php } ?></td>
                        <td id="status2_<?php echo($i); ?>"><?php if($row0_lihatVaksinasi['dos_vaksin'] != NULL) { ?><script>statusVaksin('2', '<?php echo($row0_lihatVaksinasi['status2']); ?>', '<?php echo($row0_lihatVaksinasi['no_ic']); ?>', '<?php echo($row0_lihatVaksinasi['id_vaksin']); ?>', 'status2_<?php echo($i); ?>');</script><?php } ?></td>
                    </tr>
                    <?php $i++; } while($row0_lihatVaksinasi = mysqli_fetch_assoc($fetch0_lihatVaksinasi)); ?>
                </tbody>
            </table>
        <?php } if($num0_lihatVaksinasi == 0) { ?>
            <div class="col-12 col-md-12">
                <div style="font-size: medium; font-weight: bold" class="alert alert-danger" role="alert" align="center">Tiada Rekod Disenaraikan</div>
            </div>
        <?php } } ?>
    </div>
</div>
<?php } ?>