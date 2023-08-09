<!-- Page Add Ahli -->
<?php
$notis = $_GET['status_daftar'];
if($_GET['status_daftar'] == 1 || $notis == 1) $notis = 'Pendaftaran Berjaya';
if($_GET['status_daftar'] == 2 || $notis == 2) $notis = 'Kemaskini Berjaya';
if($_GET['status_daftar'] != NULL && $_GET['data'] != "raw") echo "<script>alert('".$notis."');</script>";
if($_GET['module'] == 'add_ahli') {
    $admin_view = 1;
    $id_masjid = $_SESSION['id_masjid'];
    $reff = $_SESSION['username'];
    include("daftar_online/pendaftaran.php");
}
?>

<!-- Page List Kariah -->
<?php if($_GET['data'] == 'raw' && $_GET['module'] == 'list_ahli') {
    $id_masjid = $_SESSION['id_masjid'];
    $q_ahli = "SELECT (SELECT SUM(1) FROM sej6x_data_anakqariah aa WHERE aa.id_qariah = a.id_data OR aa.no_ic_ketua = a.no_ic) AS no_tanggungan, a.added_by 'added_by', a.last_added 'last_added', a.no_rujukan 'no_rujukan', a.nama_penuh 'nama_penuh', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.no_ic 'no_ic', a.id_data 'id_data', 1 'id_parent', a.id_data 'id_keluarga', a.jenisPengenalan FROM sej6x_data_peribadi a WHERE a.id_masjid = $id_masjid";
    $q_anak = "SELECT '-' AS no_tanggungan, c.added_by 'added_by', IF(b.last_added IS NOT NULL, b.last_added, c.last_added) 'last_added', b.no_rujukan 'no_rujukan', b.nama_penuh 'nama_penuh', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.no_ic 'no_ic', b.ID 'id_data', 2 'id_parent', b.id_qariah 'id_keluarga', b.jenisPengenalan FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_qariah = c.id_data AND b.id_masjid = $id_masjid";

    //$q_ahli = "SELECT a.added_by 'added_by', a.last_added 'last_added', a.no_rujukan 'no_rujukan', a.nama_penuh 'nama_penuh', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.no_ic 'no_ic', a.id_data 'id_data', 1 'id_parent', a.id_data 'id_keluarga' FROM sej6x_data_peribadi a WHERE a.id_masjid = $id_masjid";
    //$q_anak = "SELECT c.added_by 'added_by', 'last_added', b.no_rujukan 'no_rujukan', b.nama_penuh 'nama_penuh', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.no_ic 'no_ic', b.ID 'id_data', 2 'id_parent', b.id_qariah 'id_keluarga' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_qariah = c.id_data AND b.id_masjid = $id_masjid";

    if($_SESSION['perlu_zon'] == 1) {
        if ($_GET['zon'] != NULL || $_GET['zon'] != "") {
            $extra_pilih .= "AND a.zon_qariah = " . $_GET['zon'] . " ";
            $extra_pilih2 .= "AND c.zon_qariah = '" . $_GET['zon'] . "' ";
        }
    }

    if($_GET['warganegara'] != NULL) {
        $warganegara = $_GET['warganegara'];
        if($warganegara == 99) $warganegara = "'1', '2'";
        $extra_pilih .= "AND a.warganegara IN ($warganegara) ";
        $extra_pilih2 .= "AND b.warganegara IN ($warganegara) ";
    }

    if($_GET['bangsa'] != NULL) {
        $bangsa = $_GET['bangsa'];
        if($bangsa == 99) $bangsa = "'1', '2', '3', '4'";
        $extra_pilih .= "AND a.bangsa IN ($bangsa) ";
        $extra_pilih2 .= "AND b.bangsa IN ($bangsa) ";
    }

    if($_GET['status'] != NULL) {
        $status = $_GET['status'];
        if($status == 99) $status = "'1', '2', '3', '4', '5'";
        $extra_pilih .= "AND a.status_perkahwinan IN ($status) ";
        $extra_pilih2 .= "AND b.status_kahwin IN ($status) ";
    }

    if($_GET['julatUmur'] != NULL) {
        $julatUmur = explode('|', $_GET['julatUmur']);
        $dariUmur = $julatUmur[0];
        $hinggaUmur = $julatUmur[1];
        $extra_pilih .= "AND a.tarikh_lahir != '0000-00-00' AND a.tarikh_lahir IS NOT NULL AND (YEAR(NOW()) - YEAR(a.tarikh_lahir)) BETWEEN $dariUmur AND $hinggaUmur ";
        $extra_pilih2 .= "AND b.tarikh_lahir != '0000-00-00' AND b.tarikh_lahir IS NOT NULL AND (YEAR(NOW()) - YEAR(b.tarikh_lahir)) BETWEEN $dariUmur AND $hinggaUmur ";
    }

    if($_GET['jantina'] != NULL) {
        $jantina = $_GET['jantina'];
        if($jantina == 99) $jantina = "'1', '2'";
        $extra_pilih .= "AND a.jantina IN ($jantina) ";
        $extra_pilih2 .= "AND b.jantina IN ($jantina) ";
    }

    if($_GET['asnaf'] != NULL) {
        $asnaf_pilih = explode('|', $_GET['asnaf']);
        $extra_pilih .= "AND a.data_asnaf = ".$asnaf_pilih[0]." ";
        $extra_pilih2 .= "AND b.status_asnaf = '".$asnaf_pilih[1]."' ";
    }

    if($_GET['oku'] != NULL) {
        $oku_pilih = explode('|', $_GET['oku']);
        $extra_pilih .= "AND a.data_oku = ".$oku_pilih[0]." ";
        $extra_pilih2 .= "AND b.status_oku = '".$oku_pilih[1]."' ";
    }

    if($_GET['warga_emas'] != NULL) {
        if($_GET['warga_emas'] == 1) $umur_tua = ">= 60";
        if($_GET['warga_emas'] == 2) $umur_tua = "< 60";
        $extra_pilih .= "AND a.tarikh_lahir != '0000-00-00' AND a.tarikh_lahir IS NOT NULL AND (YEAR(NOW()) - YEAR(a.tarikh_lahir)) $umur_tua ";
        $extra_pilih2 .= "AND b.tarikh_lahir != '0000-00-00' AND b.tarikh_lahir IS NOT NULL AND (YEAR(NOW()) - YEAR(b.tarikh_lahir)) $umur_tua ";
    }
    if($_GET['mengundi'] != NULL) {
        if($_GET['mengundi'] == 1) {
            $extra_pilih .= "AND a.tarikh_lahir != '0000-00-00' AND a.tarikh_lahir IS NOT NULL AND DATE(a.tarikh_lahir) <= DATE_SUB(DATE(NOW()), INTERVAL 18 YEAR) ";
            $extra_pilih2 .= "AND b.tarikh_lahir != '0000-00-00' AND b.tarikh_lahir IS NOT NULL AND DATE(b.tarikh_lahir) <= DATE_SUB(DATE(NOW()), INTERVAL 18 YEAR) ";
        }
        if($_GET['mengundi'] == 2) {
            $extra_pilih .= "AND a.tarikh_lahir != '0000-00-00' AND a.tarikh_lahir IS NOT NULL AND DATE(a.tarikh_lahir) > DATE_SUB(DATE(NOW()), INTERVAL 18 YEAR) ";
            $extra_pilih2 .= "AND b.tarikh_lahir != '0000-00-00' AND b.tarikh_lahir IS NOT NULL AND DATE(b.tarikh_lahir) > DATE_SUB(DATE(NOW()), INTERVAL 18 YEAR) ";
        }
    }

    if($_GET['sakit'] != NULL) {
        $extra_pilih .= "AND a.data_sakit = '".$_GET['sakit']."' ";
        $extra_pilih2 .= "AND b.status_sakit = '".$_GET['sakit']."' ";
    }

    if($_GET['ibu_tunggal'] != NULL) {
        $extra_pilih .= "AND a.data_ibutunggal = '".$_GET['ibu_tunggal']."' ";
        $extra_pilih2 .= "AND b.status_ibutunggal = '".$_GET['ibu_tunggal']."' ";
    }

    if($_GET['anak_yatim'] != NULL) {
        $anak_yatim = $_GET['anak_yatim'];
        if($anak_yatim == 'Y') $anak_yatim2 = 1;
        if($anak_yatim == 'N') $anak_yatim2 = 2;
        $extra_pilih .= "AND (a.data_anakyatim = '".$anak_yatim."' OR a.data_anakyatim = '".$anak_yatim2."') ";
        $extra_pilih2 .= "AND (b.status_anakyatim = '".$anak_yatim."' OR b.status_anakyatim = '".$anak_yatim2."') ";
    }

    if($_GET['mualaf'] != NULL) {
        $extra_pilih .= "AND a.data_mualaf = '".$_GET['mualaf']."' ";
        $extra_pilih2 .= "AND b.status_mualaf = '".$_GET['mualaf']."' ";
    }

    if($_GET['khairat'] != NULL) {
        $extra_pilih .= "AND a.data_khairat = '".$_GET['khairat']."' ";
        $extra_pilih2 .= "AND (SELECT c.data_khairat FROM sej6x_data_peribadi c WHERE c.id_data = b.id_qariah) = '".$_GET['khairat']."' ";
    }

    if($_GET['aktif'] == 1 || $_GET['aktif'] == NULL) {
        $extra_pilih .= "AND (((SELECT COUNT(*) FROM data_pindah c WHERE c.id_data = a.id_data) < 1) AND ((SELECT COUNT(*) FROM data_kematian d WHERE d.id_data = a.id_data) < 1))";
        $extra_pilih2 .= "AND (((SELECT COUNT(*) FROM data_pindah c WHERE c.id_anak = b.ID) < 1) AND  ((SELECT COUNT(*) FROM data_kematian d WHERE d.id_anak = b.ID) < 1))";
    }

    if($_GET['aktif'] == 2) {
        $extra_pilih .= "AND (SELECT COUNT(*) FROM data_pindah c WHERE c.id_data = a.id_data) > 0 ";
        $extra_pilih2 .= "AND (SELECT COUNT(*) FROM data_pindah c WHERE c.id_anak = b.ID) > 0 ";
    }

    if($_GET['pekerjaan'] != NULL) {
        $extra_pilih .= "AND a.pekerjaan = '".$_GET['pekerjaan']."' ";
        //echo $extra_pilih2 .= "AND (SELECT d.pekerjaan FROM sej6x_data_peribadi d WHERE d.id_data = b.id_qariah) = '".$_GET['pekerjaan']."' ";
    }

    if($_GET['pendapatan'] != NULL) {
        $extra_pilih .= "AND a.pendapatan = '".$_GET['pendapatan']."' ";
        $extra_pilih2 .= "AND (SELECT d.pendapatan FROM sej6x_data_peribadi d WHERE d.id_data = b.id_qariah) = '".$_GET['pendapatan']."' ";
    }

    if($_GET['pemilikkan'] != NULL) {
        $extra_pilih .= "AND a.pemilikkan = '".$_GET['pemilikkan']."' ";
        $extra_pilih2 .= "AND (SELECT d.pemilikkan FROM sej6x_data_peribadi d WHERE d.id_data = b.id_qariah) = '".$_GET['pemilikkan']."' ";
    }

    if(isset($_GET['added_by']) && $_GET['added_by'] != NULL) {
        $extra_pilih .= "AND a.added_by = ".$_GET['added_by']." ";
        $extra_pilih2 .= "AND (SELECT d.added_by FROM sej6x_data_peribadi d WHERE d.id_data = b.id_qariah) = '".$_GET['added_by']."' ";
    }

    $q = "$q_ahli $extra_pilih UNION $q_anak $extra_pilih2 ORDER BY last_added DESC, id_keluarga ASC, id_parent ASC";

    if($_GET['list_ahli'] != NULL) {
        if($_GET['list_ahli'] == 1) $q = "$q_ahli $extra_pilih";
        if($_GET['list_ahli'] == 2) $q = "$q_anak $extra_pilih2";
    }

    if($_GET['dev'] == 9999) echo($q);
    $qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $q_row = mysqli_fetch_assoc($qq);
    $q_tot = mysqli_num_rows($qq);
    ?>
    <script>
        eval(document.getElementById("pdf_var").innerHTML);
        nama_masjid = '<?php echo($_SESSION['nama_masjid']); ?>'
        <?php if($_GET['module'] == 'list_ahli') { ?>tajuk_dokumen = 'Senarai Ahli Kariah';<?php } ?>
        <?php if($_GET['module'] == 'list_tanggungan') { ?>tajuk_dokumen = 'Senarai Tanggungan Ahli Kariah';<?php } ?>
        <?php if($_GET['module'] == 'list_semua') { ?>tajuk_dokumen = 'Senarai Semua Ahli Kariah';<?php } ?>
        eval(document.getElementById("pdf_sekerip").innerHTML);
        document.getElementById('tajuk_besar').innerHTML = tajuk_dokumen;
        function pilih_ahli() {
            jQuery(document).ready(function () {
                var added_by = jQuery('#added_by').val();
                var list_ahli = jQuery('#list_ahli').val();
                var zon = jQuery('#zon').val();
                var status = jQuery('#status').val();
                var umur = jQuery('#julatUmur').val();
                var bangsa = jQuery('#bangsa').val();
                var warganegara = jQuery('#warganegara').val();
                var jantina = jQuery('#jantina').val();
                var asnaf = jQuery('#asnaf').val();
                var oku = jQuery('#oku').val();
                var warga_emas = jQuery('#warga_emas').val();
                var mengundi = jQuery('#mengundi').val();
                var sakit = jQuery('#sakit').val();
                var ibu_tunggal = jQuery('#ibu_tunggal').val();
                var anak_yatim = jQuery('#anak_yatim').val();
                var mualaf = jQuery('#mualaf').val();
                var khairat = jQuery('#khairat').val();
                var pekerjaan = jQuery('#pekerjaan').val();
                var pendapatan = jQuery('#pendapatan').val();
                var pemilikkan = jQuery('#pemilikkan').val();
                var aktif = jQuery('#aktif').val();
                var params = 'list_ahli&sideMenu=<?php echo($sideMenu); ?>&added_by='+added_by+'&list_ahli='+list_ahli+'&zon='+zon+'&bangsa='+bangsa+'&julatUmur='+umur+'&warganegara='+warganegara+'&status='+status+'&jantina='+jantina+'&warga_emas='+warga_emas+'&mengundi='+mengundi+'&sakit='+sakit+'&asnaf='+asnaf+'&oku='+oku+'&ibu_tunggal='+ibu_tunggal+'&anak_yatim='+anak_yatim+'&mualaf='+mualaf+'&khairat='+khairat+'&pekerjaan='+pekerjaan+'&pendapatan='+pendapatan+'&pemilikkan='+pemilikkan+'&aktif='+aktif;
                page_ajax(params, '#module_kariah', 'tunggu');
            });
        }
    </script>
    <div class="row">
        <div class="col-12 col-md-12" align="center">
            <h4><?php echo($_SESSION['nama_masjid']); ?></h4>
            <h4 id="tajuk_besar"></h4>
        </div>
    </div>
    <hr />
    <?php include("toolbarFilter.php"); ?>
    <script>
        jQuery('#mesej').on('keyup', function() {
            var bil_char = this.value.length;
            if(bil_char == 0) bil_char = '';
            jQuery('#bil_char').html('Mesej: '+bil_char);
        });
        jQuery('#on_sms_button').on('click', function() {
            jQuery('#borang_sms').show();
            jQuery('#off_sms').show();
            jQuery('#on_sms').hide();
        });
        jQuery('#off_sms_button').on('click', function() {
            jQuery('#borang_sms').hide();
            jQuery('#on_sms').show();
            jQuery('#off_sms').hide();
        });
    </script>
    <!--p>//$alamatSMS = "http://login.bulksms.my/websmsapi/ISendSMS.aspx?username=$user&password=$pass&message=$mesejSMS&mobile=$cb_notel&type=1&sseqno=$refID";</p-->
    <div class="row form-group" style="display: none">
        <div id="on_sms" class="col-12 col-md-12"><button id="on_sms_button" type="button" class="btn btn-primary">+ Hebahan SMS</button></div>
        <div style="display: none" id="off_sms" class="col-12 col-md-12"><button id="off_sms_button" type="button" class="btn btn-primary">- Hebahan SMS</button></div>
    </div>
    <form role="form" name="hantar_sms" id="hantar_sms" enctype="multipart/form-data"></form>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo('Test SMS');
    }
    ?>
    <div id="borang_sms" style="display: none">
        <div class="row form-group">
            <div class="col-12 col-md-6">
                <label id="bil_char">Mesej:</label>
                <textarea id="mesej" name="mesej" class="form-control" required form="hantar_sms" rows="3"></textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-12 col-md-6">
                <button type="submit" class="btn btn-warning" form="hantar_sms">Hantar SMS</button>
            </div>
        </div>
    </div>
    <div class="row table-responsive">
        <?php if($q_tot > 0) { ?>
            <div class="col-12 col-md-12">
                <div style="font-size: medium" class="alert alert-success" role="alert" align="center">Sebanyak <strong><?php echo number_format($q_tot); ?></strong> Rekod Disenaraikan</div>
            </div>
            <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover table-striped">
                <thead><tr>
                    <th scope="col"><div align="center">Bil</div></th>
                    <th><div align="center">Nama</div></th>
                    <th><div align="center">No K/P</div></th>
                    <th><div align="center">Alamat</div></th>
                    <th><div align="center">No H/P</div></th>
                    <th><div align="center">Bil Tanggungan</div></th>
                    <?php if($_GET['sakit'] != NULL) { ?><th><div align="center">Sakit Kronik</div></th><?php } ?>
                    <?php if($_GET['aktif'] == 2) { ?><th><div align="center">Sebab</div></th><?php } ?>
                    <?php if($_GET['aktif'] == NULL || $_GET['aktif'] == 1) { ?>
                        <th><div align="center">No Rujukan</div></th>
                        <th><div align="center">Tarikh Pendaftaran</div></th>
                        <th><div align="center">Tindakkan</div></th>
                    <?php } ?>
                </tr></thead>
                <tbody>
                <?php $i=1; do {
                    $check_ic = $q_row['no_ic'];
                    $length_ic = strlen($check_ic);
                    $jenisPengenalan = $q_row['jenisPengenalan'];
                    ?>
                    <tr <?php if($length_ic < 12 && $jenisPengenalan == 1) { ?>style="background-color:#E03730"<?php } ?>>
                        <td><div align="center"><?php echo($i); ?></div></td>
                        <td><?php echo($q_row['nama_penuh']); ?></td>
                        <td><?php echo($q_row['no_ic']); ?></td>
                        <td><?php echo($q_row['alamat_terkini']); ?></td>
                        <td><?php echo($q_row['no_hp']); ?></td>
                        <td><div align="center"><?php echo($q_row['no_tanggungan']); ?></div></td>
                        <?php if($_GET['sakit'] != NULL) {
                        if($q_row['id_parent'] == 1) $q_sakit = "SELECT * FROM sej6x_data_sakit WHERE id_data = ".$q_row['id_data'];
                        if($q_row['id_parent'] == 2) $q_sakit = "SELECT * FROM sej6x_data_sakit WHERE id_anak = ".$q_row['id_data'];
                        $result_sakit = mysqli_query($bd2, $q_sakit) or die(mysqli_error($bd2));
                        $r_sakit = mysqli_fetch_assoc($result_sakit);
                        ?>
                        <td>
                            <?php do { ?>
                                <?php echo($r_sakit['jenis_penyakit']); ?><br />
                            <?php } while($r_sakit = mysqli_fetch_assoc($result_sakit)); } ?>
                        </td>
                        <?php if($_GET['aktif'] == 2) {
                            if($q_row['id_parent'] == 1) $id_sebab = 'id_data';
                            if($q_row['id_parent'] == 2) $id_sebab = 'id_anak';
                            $q_aktif = "SELECT * FROM data_pindah WHERE $id_sebab = ".$q_row['id_data'];
                            $result_aktif = mysqli_query($bd2, $q_aktif) or die(mysqli_error($bd2));
                            $r_aktif = mysqli_fetch_assoc($result_aktif);
                            ?>
                            <td>
                                <?php do { ?>
                                    <?php
                                    if($r_aktif['sebab'] == 1) echo 'Kematian';
                                    if($r_aktif['sebab'] == 2) echo 'Berpindah';
                                    if($r_aktif['sebab'] == 3) echo 'Berkahwin';
                                    if($r_aktif['sebab'] == 5) echo 'Lain-lain';
                                    ?><br />
                                    <?php echo($r_aktif['sebab_lain']); ?>
                                <?php } while($r_aktif = mysqli_fetch_assoc($result_aktif)); ?>
                            </td>
                        <?php } ?>
                        <?php if($_GET['aktif'] == NULL || $_GET['aktif'] == 1) { ?>
                            <td><?php echo($q_row['no_rujukan']); ?></td>
                            <td>
                                <?php
                            if($q_row['last_added'] != '' && $q_row['last_added'] != '0000-00-00 00:00:00') echo fungsi_tarikh($q_row['last_added'], 7, 2);
                            ?>
                            </td>
                            <td>
                                <form id="borang_<?php echo($q_row['id_data']); ?>" name="<?php echo($q_row['id_data']); ?>" method="post" enctype="multipart/form-data" action="utama.php?view=admin&action=pendaftaran&module=add_ahli">
                                    <input type="hidden" name="id_masjid" id="id_masjid" value="<?php echo($id_masjid); ?>">
                                    <input type="hidden" name="no_ic" id="no_ic" value="<?php echo($q_row['no_ic']); ?>">
                                    <input type="hidden" id="semak" name="semak" value="1">
                                    <?php if($_SESSION['user_id'] == $q_row['added_by'] || $_SESSION['user_type_id'] != 10) { ?><button type="submit" name="simpan" id="simpan" class="btn btn-sm btn-success form-control" title="Kemaskini"><i class="fa fa-edit"></i></button><?php } ?>
                                </form>
                                <?php if($_SESSION['user_id'] == $q_row['added_by'] || $_SESSION['user_type_id'] != 10) { ?><button class="btn btn-sm btn-danger form-control" type="button" title="Padam" onclick="showPadam(<?php echo($q_row['id_data']); ?>, '<?php echo($q_row['nama_penuh']); ?>', <?php echo($q_row['id_parent']); ?>, <?php echo($id_masjid); ?>)"><i class="fa fa-trash"></i></button><?php } ?>
                                <?php if($_SESSION['user_type_id']==2) { ?><button onclick="window.open('printProfil.php?id_data=<?php echo $q_row['id_keluarga']; ?>')" class="btn btn-sm btn-info form-control" title="Cetak"><i class="fas fa-print"></i></button><?php } ?>
                            </td>
                        <?php } ?>
                    </tr>
                    <?php $i++; } while($q_row = mysqli_fetch_assoc($qq)); ?>
                </tbody>
            </table>
        <?php } if($q_tot == 0) { ?>
            <div class="col-12 col-md-12">
                <div style="font-size: medium" class="alert alert-danger" role="alert" align="center">Tiada Rekod Disenaraikan</div>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<!-- Page Add Kematian -->
<?php
if($_GET['data'] == 'raw' && $_GET['module'] == 'add_kematian') {
    $admin_view = 1;
    $id_masjid = $_SESSION['id_masjid'];
    $reff = $_SESSION['username'];
    include("daftar_online/daftar_kematian.php");
}
?>

<!-- Page List Kematian -->
<?php if($_GET['data'] == 'raw' && $_GET['module'] == 'list_kematian') {
    $id_masjid = $_SESSION['id_masjid'];

    if($_GET['mode'] == 'padam' && $_GET['id_kematian'] != NULL) {
        $id_kematian = $_GET['id_kematian'];
        $q_del = "DELETE FROM data_kematian WHERE id_kematian = $id_kematian AND id_masjid = $id_masjid";
        mysqli_query($bd2, $q_del) or die(mysqli_error($bd2));
        echo "<script>
	jQuery('#exampleModal').modal('show');
	jQuery('#exampleModalLabel').html('Padam Senarai Kematian');
	jQuery('#badan').html('Senarai Kematian Berjaya Dipadam');
	</script>";
    }

    $q = "SELECT a.id_kematian, b.nama_penuh, a.tarikh_kematian, a.waktu_kematian, a.no_sijil, a.tarikh_dikebumikan, a.waktu_dikebumikan, b.no_ic, CONCAT(SUBSTRING(b.no_ic, 1, 6), '-', SUBSTRING(b.no_ic, 7, 2), '-', SUBSTRING(b.no_ic, 9, 4)) 'no_kp' FROM data_kematian a, sej6x_data_peribadi b WHERE a.approved = 1 AND a.id_data = b.id_data AND a.id_masjid = $id_masjid";
    $q .= " UNION SELECT c.id_kematian, d.nama_penuh, c.tarikh_kematian, c.waktu_kematian, c.no_sijil, c.tarikh_dikebumikan, c.waktu_dikebumikan, d.no_ic, CONCAT(SUBSTRING(d.no_ic, 1, 6), '-', SUBSTRING(d.no_ic, 7, 2), '-', SUBSTRING(d.no_ic, 9, 4)) 'no_kp' FROM data_kematian c, sej6x_data_anakqariah d WHERE c.approved = 1 AND c.id_anak = d.ID AND c.id_masjid = $id_masjid";
    $qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $q_row = mysqli_fetch_assoc($qq);
    $q_tot = mysqli_num_rows($qq);
    ?>
    <script>
        eval(document.getElementById("pdf_var").innerHTML);
        nama_masjid = '<?php echo($_SESSION['nama_masjid']); ?>'
        tajuk_dokumen = 'Senarai Kematian Ahli Kariah';
        eval(document.getElementById("pdf_sekerip").innerHTML);
    </script>
    <div class="row">
        <div class="col-12 col-md-12" align="center">
            <h4><?php echo($_SESSION['nama_masjid']); ?></h4>
            <h4>Senarai Kematian Ahli Kariah</h4>
        </div>
    </div>
    <div class="row table-responsive">
        <?php if($q_tot > 0) { ?>
            <div class="col-12 col-md-12 p-3">
                <div style="font-size: medium" class="alert alert-success" role="alert" align="center">Sebanyak <strong><?php echo number_format($q_tot); ?></strong> Rekod Disenaraikan</div>
            </div>
            <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
                <thead><tr>
                    <th scope="col"><div align="center">Bil</div></th>
                    <th><div align="center">Nama</div></th>
                    <th><div align="center">No K/P</div></th>
                    <th><div align="center">Tarikh & Masa Kematian</div></th>
                    <th><div align="center">No Sijil</div></th>
                    <th><div align="center">Tarikh & Waktu Dikebumikan</div></th>
                    <th><div align="center">Tindakkan</div></th>
                </tr></thead>
                <tbody>
                <?php $i=1; do { ?>
                    <tr>
                        <td><div align="center"><?php echo($i); ?></div></td>
                        <td><?php echo($q_row['nama_penuh']); ?></td>
                        <td><?php echo($q_row['no_kp']); ?></td>
                        <td><?php fungsi_tarikh($q_row['tarikh_kematian'], 2, 4); ?>, <?php echo($q_row['waktu_kematian']); ?></td>
                        <td><?php echo($q_row['no_sijil']); ?></td>
                        <td><?php fungsi_tarikh($q_row['tarikh_dikebumikan'], 2, 4); ?>, <?php echo($q_row['waktu_dikebumikan']); ?></td>
                        <td align="center">
                            <a target="_blank" href="daftar_online/daftar_kematian.php?id_kematian=<?php echo($q_row['id_kematian']); ?>&no_ic=<?php echo($q_row['no_ic']); ?>"><button type="button" class="btn btn-primary">Lihat</button></a>
                            <button type="button" class="btn btn-danger" onclick="if(confirm('Padam Rekod Kematian <?php echo($q_row['nama_penuh']); ?>?')) page_ajax('list_kematian&id_kematian=<?php echo($q_row['id_kematian']); ?>&mode=padam', '#modul_kematian', 'tunggu2')">Padam</button>
                        </td>
                    </tr>
                    <?php $i++; } while($q_row = mysqli_fetch_assoc($qq)); ?>
                </tbody>
            </table>
        <?php } if($q_tot == 0) { ?>
            <div class="col-12 col-md-12 p-3">
                <div style="font-size: medium" class="alert alert-danger" role="alert" align="center">Tiada Rekod Disenaraikan</div>
            </div>
        <?php } ?>
    </div>
<?php } ?>
<script>
    <?php if($_GET['idInfo'] != NULL) {
        echo 'document.getElementById("borang_'.$_GET['idInfo'].'").submit();';
    }
    ?>
</script>
