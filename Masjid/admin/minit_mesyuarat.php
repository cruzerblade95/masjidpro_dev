<?php
include ("../fungsi.php");
$id_mesyuarat = $_GET['id_mesyuarat'];
if (strpos($id_mesyuarat, ' ') !== false) {
    $id_mesyuarat_array = explode(" ", $id_mesyuarat);
    $id_mesyuarat          = $id_mesyuarat_array[0];
    //echo($id_mesyuarat);
}
if(!is_numeric($id_mesyuarat)) $id_mesyuarat = "";
$check_mesyuarat = "SELECT COUNT(*) FROM minit_mesyuarat WHERE id_masjid = ? AND id_mesyuarat = ?";
if($check_mesyuarat = $bd2->prepare($check_mesyuarat)) {
    $check_mesyuarat->bind_param("ii", $id_masjid, $id_mesyuarat);
    $check_mesyuarat->execute();
    $check_mesyuarat->bind_result($num);
    $check_mesyuarat->fetch();
    $check_mesyuarat->close();
}
if($num < 1) $id_mesyuarat == NULL;
//echo($num);
$query_list_nama = "SELECT a.id_dataajk 'id_dataajk', a.jawatan 'jawatan', b.nama_penuh 'nama_penuh', a.rank 'rank' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_masjid = $id_masjid AND a.id_ajk = b.id_data UNION
SELECT d.id_dataajk 'id_dataajk', d.jawatan 'jawatan', c.nama_penuh 'nama_penuh', d.rank 'rank' FROM sej6x_data_anakqariah c, data_ajkmasjid d WHERE d.id_ajk2 = c.ID AND d.id_masjid = $id_masjid ORDER BY `rank` ASC";
$list_nama = mysqli_query($bd2, $query_list_nama) or die(mysqli_error($bd2));
$list_nama2 = mysqli_query($bd2, $query_list_nama) or die(mysqli_error($bd2));
$list_nama3 = mysqli_query($bd2, $query_list_nama) or die(mysqli_error($bd2));
$list_nama4 = mysqli_query($bd2, $query_list_nama) or die(mysqli_error($bd2));

$row_list_nama = mysqli_fetch_assoc($list_nama);
$row_list_nama2 = mysqli_fetch_assoc($list_nama2);
$row_list_nama3 = mysqli_fetch_assoc($list_nama3);
$row_list_nama4 = mysqli_fetch_assoc($list_nama4);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $status_success = array();
    $f = 1;
    $id_masjid = $_POST['id_masjid'];
    $id_mesyuarat = $_POST['id_mesyuarat'];
    $tajuk = strtoupper(e($_POST['tajuk'], NULL, NULL));
    //$no_rujukan = strtoupper($_POST['no_rujukan']);
    $tarikh = $_POST['tarikh'];
    $masa = $_POST['masa'];
    $masa_tamat = $_POST['masa_tamat'];
    $tempat = strtoupper(e($_POST['tempat'], NULL, NULL));
    $disediakan = e($_POST['disediakan'], NULL, NULL);
    $disemak = e($_POST['disemak'], NULL, NULL);
    $disahkan = e($_POST['disahkan'], NULL, NULL);
    $date_now = date("Y-m-d h:i:s");
    $tahun = date_format(date_create($tarikh),"Y");
    if($_POST['no_rujukan']=="") {
        //$qr = "SELECT IF(MAX(no_rujukan) IS NOT NULL, MAX(no_rujukan) + 1, 1) 'No Rujukan'FROM minit_mesyuarat WHERE id_masjid = $id_masjid";
        //$list_qr = mysqli_query($bd2, $qr) or die(mysqli_error($bd2));
        //$row_qr = mysqli_fetch_assoc($list_qr);
        //$no_rujukan = $row_qr['No Rujukan'];
        $qr = "SELECT * FROM minit_mesyuarat WHERE id_masjid='$id_masjid' AND no_rujukan IS NOT NULL ORDER BY id_mesyuarat DESC LIMIT 1";
        $list_qr = mysqli_query($bd2,$qr) or die(mysqli_error($bd2));
        $row_qr = mysqli_fetch_assoc($list_qr);
        $bil_qr = mysqli_num_rows($list_qr);
        if($bil_qr>0) {
            $no_rujukan = $row_qr['no_rujukan'] + 1;
        }
        else if($bil_qr==0){
            $no_rujukan = 1;
        }

        if(isset($_POST['rujukan_update'])){
            $no_rujukan = $_POST['rujukan_update'];
        }
        $rujukan_auto = 1;
        $no_rujukan_manual = NULL;
    }
    else{
        $no_rujukan = NULL;
        $no_rujukan_manual = $_POST['no_rujukan'];
        $rujukan_auto = 2;
    }


    if($id_mesyuarat == NULL) $q_meeting = "INSERT INTO minit_mesyuarat (id_masjid, tajuk, rujukan_auto, no_rujukan, no_rujukan_manual, tahun, tarikh, masa, masa_tamat, tempat, id_disediakan, id_disemak, id_disahkan, last_added) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if($id_mesyuarat != NULL) $q_meeting = "UPDATE minit_mesyuarat SET id_masjid = ?, tajuk = ?, no_rujukan = ?, no_rujukan_manual = ?, tarikh = ?, masa = ?, masa_tamat = ?, tempat = ?, id_disediakan = ?, id_disemak = ?, id_disahkan = ?, last_added = ? WHERE id_mesyuarat = ?";
    $stmt = $bd2->prepare($q_meeting);
    if($id_mesyuarat == NULL) $stmt->bind_param("isisssssssiiis", $id_masjid, $tajuk, $rujukan_auto, $no_rujukan, $no_rujukan_manual, $tahun, $tarikh, $masa, $masa_tamat, $tempat, $disediakan, $disemak, $disahkan, $date_now);
    if($id_mesyuarat != NULL) $stmt->bind_param("isssssssiiisi", $id_masjid, $tajuk, $no_rujukan, $no_rujukan_manual,$tarikh, $masa, $masa_tamat, $tempat, $disediakan, $disemak, $disahkan, $date_now, $id_mesyuarat);
    if($stmt->execute()) {
        if($id_mesyuarat == NULL) $last_id = $stmt->insert_id;
        $status_success[$f] = 1;
    }
    else {
        $status_success[$f] = 0;
        echo '<br />ERROR: '.$stmt->errno.' '.$stmt->error;
    }
    $f++;


    // Ketua Segala Array
    $ketua_array = array();

    //Semak bilangan array kotak input

    $ketua_array[0] = count($_POST['jenis_kehadiran']);
    $ketua_array[1] = count($_POST['jenis_kehadiran2']);
    $ketua_array[2] = count($_POST['jenis_kehadiran3']);
    $perkara = count($_POST['perkara_isu']);

    if($id_mesyuarat == NULL) $id_mesyuarat = $last_id;
    // Loop 3 Jenis Kehadiran (AJK, Jemputan dan Urusetia)
    for($a = 0; $a < count($ketua_array); $a++) {
        if($ketua_array[$a] > 0) {
            for ($i = 0; $i < $ketua_array[$a]; $i++) {
                $id_form = $a+1;
                if($a == 0) {
                    $id_form = "";
                    $id_ajk = $_POST['id_ajk'][$i];
                    $check_value = isset($_POST['tanda_kehadiran'][$i]) ? 1 : 99;
                    $jenis_kehadiran = $check_value;
                }
                else $jenis_kehadiran   = $_POST['jenis_kehadiran' . $id_form][$i];
                $id_kehadiran           = $_POST['id_kehadiran'.$id_form][$i];
                $nama                   = strtoupper($_POST['nama'.$id_form][$i]);
                $jawatan                = strtoupper($_POST['jawatan'.$id_form][$i]);

                if($id_kehadiran == NULL) $q_hadir = "INSERT INTO kehadiran_mesyuarat (id_masjid, id_mesyuarat, id_ajk, nama, jawatan, jenis_kehadiran) VALUES (?, ?, ?, ?, ?, ?)";
                if($id_kehadiran != NULL) $q_hadir = "UPDATE kehadiran_mesyuarat SET id_masjid = ?, id_mesyuarat = ?, id_ajk = ?, nama = ?, jawatan = ?, jenis_kehadiran = ? WHERE id_kehadiran = ?";
                $stmt2 = $bd2->prepare($q_hadir);
                if($id_kehadiran == NULL) $stmt2->bind_param("iiissi", $id_masjid, $id_mesyuarat, $id_ajk, $nama, $jawatan, $jenis_kehadiran);
                if($id_kehadiran != NULL) $stmt2->bind_param("iiissii", $id_masjid, $id_mesyuarat, $id_ajk, $nama, $jawatan, $jenis_kehadiran, $id_kehadiran);
                if($stmt2->execute()) $status_success[$f] = 1;
                else {
                    $status_success[$f] = 0;
                    echo '<br />ERROR: ' . $stmt2->errno . ' ' . $stmt2->error;
                }
                $f++;
            }
            $id_ajk = NULL;
        }
    }

    // Simpan perkara mesyuarat

    if($perkara > 0) {
        for ($l = 0; $l < $perkara; $l++) {
            $id_perkara  = $_POST['id_perkara'][$l];
            $perkara_isu = e($_POST['perkara_isu'][$l], NULL, NULL);
            $perkara_isu = e(str_replace('\r\n', '', $perkara_isu), NULL, NULL);
            $perkara_isu = e(str_replace('\\', '', $perkara_isu), NULL, NULL);
            //$status_tindakan = $_POST['status_tindakan'][$l];
            $status_tindakan = "";
            $index = $l + 1;
            if (isset($_POST['status_tindakkan_'.$index])) {
                // Retrieving each selected option
                foreach ($_POST['status_tindakkan_'.$index] as $nilai) {
                    $status_tindakan .= $nilai . '|';
                }
            }

            if ($id_perkara == null) $q_perkara = "INSERT INTO perkara_mesyuarat (id_masjid, id_mesyuarat, perkara_isu, status_tindakan) VALUES (?, ?, ?, ?)";
            if ($id_perkara != null) $q_perkara = "UPDATE perkara_mesyuarat SET id_masjid = ?, id_mesyuarat = ?, perkara_isu = ?, status_tindakan = ? WHERE id_perkara = ?";
            $stmt3 = $bd2->prepare($q_perkara);
            if ($id_perkara == null) $stmt3->bind_param("iiss", $id_masjid, $id_mesyuarat, $perkara_isu, $status_tindakan);
            if ($id_perkara != null) $stmt3->bind_param("iissi", $id_masjid, $id_mesyuarat, $perkara_isu, $status_tindakan, $id_perkara);
            if ($stmt3->execute()) $status_success[$f] = 1;
            else {
                $status_success[$f] = 0;
                echo '<br />ERROR: ' . $stmt3->errno . ' ' . $stmt3->error;
            }
            $f++;
        }
    }
    $pass = 1;
    for($s = 1; $s <= count($status_success); $s++) {
        if($status_success[$s] == 0) $pass = 0;
        if ($pass == 1 && $s == count($status_success)) echo '<button class="tst3 btn btn-success btn-block btn-rounded mb-15">Minit Mesyuarat BERJAYA disimpan</button>';
        if ($pass == 0 && $s == count($status_success)) echo '<button class="tst4 btn btn-danger btn-block btn-rounded mb-15">Minit Mesyuarat GAGAL disimpan</button>';
    }
}

// Delete turut hadir, urusetia, perkara mesyuarat

function padam_item($a, $b, $c) {
    global $bd2, $id_masjid, $id_mesyuarat;
    for($k = 0; $k < count($_POST[$a]); $k++) {
        $id_padam = $_POST[$a][$k];
        $q = "DELETE FROM $b WHERE id_masjid = $id_masjid AND id_mesyuarat = $id_mesyuarat AND $c = $id_padam";
        mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    }
}

padam_item('id_kehadiran2_padam', 'kehadiran_mesyuarat', 'id_kehadiran');
padam_item('id_kehadiran3_padam', 'kehadiran_mesyuarat', 'id_kehadiran');
padam_item('id_perkara_padam', 'perkara_mesyuarat', 'id_perkara');



if($num > 0) {
    $q1 = "SELECT * FROM minit_mesyuarat WHERE id_masjid = $id_masjid AND id_mesyuarat = $id_mesyuarat";
    //$q2 = "SELECT a.nama, a.jenis_kehadiran, a.id_kehadiran, a.id_ajk FROM kehadiran_mesyuarat a, data_ajkmasjid b WHERE a.id_ajk = b.id_ajk AND a.id_masjid = $id_masjid AND a.id_mesyuarat = $id_mesyuarat AND a.jenis_kehadiran IN (1, 99) ORDER BY b.rank ASC";
    $q3 = "SELECT * FROM kehadiran_mesyuarat WHERE id_masjid = $id_masjid AND id_mesyuarat = $id_mesyuarat AND jenis_kehadiran = 2";
    $q4 = "SELECT * FROM kehadiran_mesyuarat WHERE id_masjid = $id_masjid AND id_mesyuarat = $id_mesyuarat AND jenis_kehadiran = 3";
    $q5 = "SELECT * FROM perkara_mesyuarat WHERE id_masjid = $id_masjid AND id_mesyuarat = $id_mesyuarat ORDER BY id_perkara ASC";

    $m1 = mysqli_query($bd2, $q1) or die(mysqli_error($bd2));
    //$m2 = mysqli_query($bd2, $q2) or die(mysqli_error($bd2));
    $m3 = mysqli_query($bd2, $q3) or die(mysqli_error($bd2));
    $m4 = mysqli_query($bd2, $q4) or die(mysqli_error($bd2));
    $m5 = mysqli_query($bd2, $q5) or die(mysqli_error($bd2));

    $jum_hadir2 = mysqli_num_rows($m3);
    $jum_hadir3 = mysqli_num_rows($m4);
    $jum_perkara = mysqli_num_rows($m5);

    $r1 = mysqli_fetch_assoc($m1);
    //$r2 = mysqli_fetch_assoc($m2);
    $r3 = mysqli_fetch_assoc($m3);
    $r4 = mysqli_fetch_assoc($m4);
    $r5 = mysqli_fetch_assoc($m5);

    //$list_nama5 = mysqli_query($bd2, $query_list_nama) or die(mysqli_error($bd2));
    //$row_list_nama5 = mysqli_fetch_assoc($list_nama5);

    //$i = 1;
    //do {
        //$r2_val[$i]  = $r2['jenis_kehadiran'];
        //$r2_val2[$i] = $r2['id_kehadiran'];
        //$r2_val3[$i] = $r2['id_ajk'];
        //$i++;
    //} while ($r2 = mysqli_fetch_assoc($m2));
}

$q_tindakkan = "SELECT jawatan 'jawatan' FROM jawatan WHERE tindakkan IN (1, 2) UNION SELECT DISTINCT jawatan 'jawatan' FROM data_ajkmasjid WHERE id_masjid = $id_masjid";
$list_tindakkan = mysqli_query($bd2, $q_tindakkan) or die(mysqli_error($bd2));
$row_tindakkan = mysqli_fetch_assoc($list_tindakkan);

?>
<script src="https://cdn.tiny.cloud/1/ozx2fxw7uuk1ap0zbdsxmahpwitt6n4b0vdkxrqmn5iwfta8/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    function addTinyMCE() {
        // Initialize
        tinymce.init({
            selector: '.perkaraMeeting'
        });
    }
</script>
<!-- /.row -->
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Borang Minit Mesyuarat</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Borang Minit Mesyuarat</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3 col-md-12 col-12">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Borang Minit Mesyuarat
				</div>
				<div class="card-body">
					<form onsubmit2="return $('.perkaraMeeting').show();" name="add_minit" id="add_minit" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']); ?>" method="post" enctype="multipart/form-data">
						<div class="row form-group">
							<div class="col-12 col-md-12"><h4>Maklumat Minit Mesyuarat (<?php if($num > 0) echo 'Draf'; else echo 'Baharu'; ?>)</h4></div>
							<div class="col-6 col-md-3"><?php if($num > 0) echo '<a href="admin/view_minit_mesyuarat.php?html=1&id_mesyuarat='.$r1['id_mesyuarat'].'"><button type="button" class="btn-primary btn btn-info btn-block margin-top-10">Lihat / Cetak</button></a>'; ?></div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="form-group row">
									<div class="col-12 col-md-12">
										<label>* Perkara (Tajuk):</label>
										<input name="id_mesyuarat" id="id_mesyuarat" type="hidden" value="<?php echo($r1['id_mesyuarat']); ?>" />
										<input id="tajuk" name="tajuk" required aria-required="true" placeholder="Tajuk Mesyuarat" class="form-control required" value="<?php echo($r1['tajuk']); ?>">
									</div>
								</div>
                                <?php if($r1['rujukan_auto']==NULL) { ?>
                                <div class="form-group row">
                                    <div class="col-12 col-md-6">
                                        <label>Jana No Rujukan Mesyurat Secara Automatik?</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="ya" name="customRadio" class="custom-control-input" value="1" required onClick="displayRujukan(this.value)">
                                            <label class="custom-control-label" for="ya">Ya</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="tidak" name="customRadio" class="custom-control-input" value="2" onClick="displayRujukan(this.value)">
                                            <label class="custom-control-label" for="tidak">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="form-group row" <?php if($r1['rujukan_auto']==NULL OR $r1['rujukan_auto']!=2) { ?>style="display: none" <?php } ?> id="rujukan_manual">
                                    <div class="col-12 col-md-6">
                                        <label>* No Rujukan Mesyuarat :</label>
                                        <input class="form-control" id="no_rujukan" name="no_rujukan" type="text" value="<?php echo $r1['no_rujukan_manual']; ?>">
                                    </div>
                                </div>
								<div class="form-group row" <?php if($r1['rujukan_auto']==NULL OR $r1['rujukan_auto']!=1) { ?>style="display: none" <?php } ?> id="rujukan_auto">
									<div class="col-12 col-md-6">
										<label>No Rujukan Mesyuarat (Akan Dijana Automatik):</label>
										<input class="form-control" id="no_rujukan2" name="no_rujukan2" disabled value="BIL <?php echo($r1['no_rujukan']); ?> / <?php echo($r1['tahun']); ?>">
                                        <?php
                                        if($r1['rujukan_auto']==1){
                                        ?>
                                        <input type="hidden" name="rujukan_update" value="<?php echo $r1['no_rujukan']; ?>">
                                        <?php
                                        }
                                        ?>
									</div>
								</div>
								<div class="form-group row">
                                    <div class="col-12 col-md-4">
                                        <label>* Tarikh: </label>
                                        <input required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control required" id="tarikh" name="tarikh" type="date" aria-required="true" value="<?php echo($r1['tarikh']); ?>">
                                    </div>
									<div class="col-12 col-md-4">
										<label>* Masa Mula: </label>
										<input class="form-control required" type="time" id="masa" name="masa" required aria-required="true" placeholder="Masa Mula" value="<?php echo($r1['masa']); ?>">
									</div>
									<div class="col-12 col-md-4">
										<label>Masa Tamat: </label>
										<input class="form-control" type="time" id="masa_tamat" name="masa_tamat" placeholder="Masa Tamat" value="<?php echo($r1['masa_tamat']); ?>">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-12 col-md-12">
										<label>* Tempat: </label>
										<textarea id="tempat" name="tempat" rows="5" required aria-required="true" class="form-control required" placeholder="Tempat"><?php echo($r1['tempat']); ?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-12 col-md-6">
										<label>* Disediakan oleh: </label>
										<select class="form-control required" name="disediakan" id="disediakan" required aria-required="true">
											<option>Pilih Nama:-</option>
											<?php do { ?>
												<option value="<?php echo($row_list_nama['id_dataajk']); ?>" <?php if($row_list_nama['id_dataajk'] == $r1['id_disediakan']) echo 'selected'; ?>><?php echo($row_list_nama['nama_penuh']); ?></option>
											<?php } while($row_list_nama = mysqli_fetch_assoc($list_nama)); ?>
										</select>
									</div>
									<div class="col-12 col-md-6">
										<label>* Disemak oleh: </label>
										<select class="form-control" name="disemak" id="disemak" required>
											<option>Pilih Nama:-</option>
											<?php do { ?>
												<option value="<?php echo($row_list_nama2['id_dataajk']); ?>" <?php if($row_list_nama2['id_dataajk'] == $r1['id_disemak']) echo 'selected'; ?>><?php echo($row_list_nama2['nama_penuh']); ?></option>
											<?php } while($row_list_nama2 = mysqli_fetch_assoc($list_nama2)); ?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-12 col-md-12"><div align="center">
											<label>* Disahkan oleh: </label>
											<select class="form-control" name="disahkan" id="disahkan" required>
												<option>Pilih Nama:-</option>
												<?php do { ?>
													<option value="<?php echo($row_list_nama3['id_dataajk']); ?>" <?php if($row_list_nama3['id_dataajk'] == $r1['id_disahkan']) echo 'selected'; ?>><?php echo($row_list_nama3['nama_penuh']); ?></option>
												<?php } while($row_list_nama3 = mysqli_fetch_assoc($list_nama3)); ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-12 form-group"><h4>Kehadiran AJK</h4></div>
							<div class="col-12">
								<div class="form-group row">
									<div class="col-1 col-md-1"><strong>Bil</strong></div>
									<div class="col-11 col-md-5"><strong>Nama</strong></div>
									<div class="col-8 col-md-4"><strong>Jawatan</strong></div>
									<div class="col-4 col-md-2"><strong>Kehadiran</strong></div>
								</div>
								<div class="form-group row">
									<?php $i = 1; do {
										if($id_mesyuarat != NULL) {
											$q_hadir_ada = "SELECT * FROM kehadiran_mesyuarat WHERE id_mesyuarat = $id_mesyuarat AND id_ajk = " . $row_list_nama4['id_dataajk'];
											$q_hadir_ada2 = mysqli_query($bd2, $q_hadir_ada) or die(mysqli_error($bd2));
											$r2_hadir = mysqli_fetch_assoc($q_hadir_ada2);
										}
										?>
										<div class="col-1 col-md-1"><?php echo($i); ?></div>
										<div class="col-11 col-md-5"><input name="nama[]" type="hidden" value="<?php echo($row_list_nama4['nama_penuh']); ?>" /><?php echo($row_list_nama4['nama_penuh']); ?></div>
										<div class="col-8 col-md-4"><input name="jawatan[]" type="hidden" value="<?php echo($row_list_nama4['jawatan']); ?>" /><?php echo($row_list_nama4['jawatan']); ?></div>
										<div class="col-4 col-md-2"><input id="tanda_<?php echo($i); ?>" name="tanda_kehadiran[]" type="checkbox" <?php if($id_mesyuarat != NULL && $r2_hadir['jenis_kehadiran'] == 1) echo 'value="1" checked'; else echo 'value="99"'; ?>><label for="tanda_<?php echo($i); ?>"></label></div>
										<input name="jenis_kehadiran[]" type="hidden" value="<?php if($id_mesyuarat != NULL && $r2_hadir['jenis_kehadiran'] == 1) echo '1'; else echo '99'; ?>"/>
										<input name="id_ajk[]" type="hidden" value="<?php echo($row_list_nama4['id_dataajk']); ?>" />
										<input name="id_kehadiran[]" type="hidden" value="<?php if($id_mesyuarat != NULL) echo $r2_hadir['id_kehadiran']; else echo ''; ?>" />
										<?php $i++; } while($row_list_nama4 = mysqli_fetch_assoc($list_nama4)); ?>
								</div>
							</div>
						</div>
						<script id="data_sakit_sekerip">
							function data_meeting(a, b, data_hidden, c, d, e, f, g, h, i, j, k, l, m, o, p) {
								jQuery(document).ready(function(){
									var data_meeting_i = a;
									var data_meeting = '<div class="col-12 col-md-6"><div class="form-group"><input name="'+b+'" type="hidden" value="'+data_hidden+'" /><input name="'+c+'" type="hidden" value="'+d+'" /><input class="form-control" name="'+e+'" type="text" required placeholder="'+f+'" /></div></div><div class="col-12 col-md-4"><div class="form-group"><input class="form-control" name="'+g+'" type="text" placeholder="Jawatan" /></div></div>';
									dinamik_tambah(data_meeting_i, h, i, data_meeting, j, k, l, m, o, p);
								});
							}

							function data_perkara(a, data_hidden, h, i, j, k, l, m, o, p) {
								jQuery(document).ready(function(){
									var data_perkara_i = a;
									var data_perkara = '<div class="col-12 col-md-6"><div class="form-group"><input name="id_perkara[]" type="hidden" value="'+data_hidden+'" /><textarea name="perkara_isu[]" placeholder="Perkara / Isu Mesyuarat" rows="5" class="perkaraMeeting form-control"></textarea></div></div><div class="col-12 col-md-4"><div class="form-group"><select multiple size="5" class="form-control" name="status_tindakkan" required><?php do { ?><option value="<?php echo($row_tindakkan['jawatan']); ?>"><?php echo($row_tindakkan['jawatan']); ?></option><?php } while($row_tindakkan = mysqli_fetch_assoc($list_tindakkan)); ?></select></div></div>';
									dinamik_tambah(data_perkara_i, h, i, data_perkara, j, k, l, m, o, p);
								});
							}

							function data_meeting_ada(a, b, c, d, e, f, g, h, i, j) {
								jQuery(document).ready(function(){
									jQuery(a).click();
									document.getElementsByName(c)[b].value = d;
									document.getElementsByName(e)[b].value = f;
									document.getElementsByName(g)[b].value = h;
									document.getElementsByName(i)[b].value = j;
								});
							}

							function data_perkara_ada(a, b, c, d, e, f, g, h) {
								jQuery(document).ready(function(){
									jQuery(a).click();
									document.getElementsByName(c)[b].value = d;
									document.getElementsByName(e)[b].value = f;
									jQuery("[name='"+g+"']").each(function(){
										jQuery.each(h, function(key, value) {
											jQuery("[name='"+g+"'] option[value=" + value + "]").prop('selected', true);
										});
									});
								});
							}
						</script>
						<div class="row">
							<div class="col-12 col-md-12 form-group"><h4>Turut Hadir (Jemputan)</h4></div>
							<div class="col-12">
								<script>data_meeting(<?php if($jum_hadir2 > 0) echo($jum_hadir2); if($jum_hadir2 == 0) echo '0'; ?>, 'id_kehadiran2[]', '', 'jenis_kehadiran2[]', 2, 'nama2[]', 'Nama Jemputan', 'jawatan2[]', 'add_hadir', 'borang_hadir', 'padam_hadir', 'baris_hadir', 'id_kehadiran2_', 'id_kehadiran2[]', 'id_kehadiran2_padam[]', 'Padam');</script>
								<div class="form-group row">
									<div class="col-12 col-md-6"><div class="form-group"><strong>Nama</strong></div></div>
									<div class="col-12 col-md-4"><div class="form-group"><strong>Jawatan</strong></div></div>
									<div class="col-12 col-md-2">&nbsp;</div>
								</div>
								<div id="borang_hadir">
									<?php if($jum_hadir2 > 0) { $x = 1; do { ?>
									<div class="add_hadir row form-group" id="baris_hadir<?php echo($x); ?>">
										<div class="col-12 col-md-6">
											<div class="form-group">
												<input id="id_kehadiran2_<?php echo($x); ?>" name="id_kehadiran2[]" type="hidden" value="<?php echo($r3['id_kehadiran']); ?>" />
												<input name="jenis_kehadiran2[]" type="hidden" value="<?php echo($r3['jenis_kehadiran']); ?>" />
												<input class="form-control" name="nama2[]" type="text" required placeholder="Nama Jemputan" value="<?php echo($r3['nama']); ?>" />
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<input class="form-control" name="jawatan2[]" type="text" placeholder="Jawatan" value="<?php echo($r3['jawatan']); ?>" />
											</div>
										</div>
										<div class="col-md-2 col-12 form-group">
											<button name="remove" id="<?php echo($x); ?>" type="button" class="padam_hadir btn btn-warning form-group">Padam</button>
										</div>
									</div>
										<?php if($guna_sekerip != NULL) { ?>
										<script>
											window.onload = function(){
												data_meeting_ada('#add_hadir', <?php echo(round($x - 1)); ?>, 'id_kehadiran2[]', '<?php echo($r3['id_kehadiran']); ?>', 'jenis_kehadiran2[]', '<?php echo($r3['jenis_kehadiran']); ?>', 'nama2[]', '<?php echo($r3['nama']); ?>', 'jawatan2[]', '<?php echo($r3['jawatan']); ?>');
											}
										</script>
											<?php } ?>
										<?php $x++; } while($r3 = mysqli_fetch_assoc($m3)); } ?>
								</div>
								<div id="padam_hadir"></div>
								<div class="form-group row">
									<div class="col-12 col-md-6"><div class="form-group"><strong>&nbsp;</strong></div></div>
									<div class="col-12 col-md-4"><div class="form-group"><strong>&nbsp;</strong></div></div>
									<div class="col-12 col-md-2"><div class="form-group"><button id="add_hadir" type="button" class="btn-primary btn btn-info btn-block">Tambah</button></div></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12 col-md-12 form-group"><h4>Urusetia (Jika Berkenaan)</h4></div>
							<div class="col-12">
								<script>data_meeting(<?php if($jum_hadir3 > 0) echo($jum_hadir3); if($jum_hadir3 == 0) echo '0'; ?>, 'id_kehadiran3[]', '', 'jenis_kehadiran3[]', 3, 'nama3[]', 'Nama Jemputan', 'jawatan3[]', 'add_hadir2', 'borang_hadir2', 'padam_hadir2', 'baris_hadir2', 'id_kehadiran3_', 'id_kehadiran3[]', 'id_kehadiran3_padam[]', 'Padam');</script>
								<div class="form-group row">
									<div class="col-12 col-md-6"><div class="form-group"><strong>Nama</strong></div></div>
									<div class="col-12 col-md-4"><div class="form-group"><strong>Jawatan</strong></div></div>
									<div class="col-12 col-md-2">&nbsp;</div>
								</div>
								<div id="borang_hadir2">
									<?php if($jum_hadir3 > 0) { $y = 1; do { ?>
									<div class="add_hadir2 row form-group" id="baris_hadir2<?php echo($y); ?>">
										<div class="col-12 col-md-6">
											<div class="form-group">
												<input id="id_kehadiran3_<?php echo($y); ?>" name="id_kehadiran3[]" type="hidden" value="<?php echo($r4['id_kehadiran']); ?>" />
												<input name="jenis_kehadiran3[]" type="hidden" value="<?php echo($r4['jenis_kehadiran']); ?>" />
												<input class="form-control" name="nama3[]" type="text" required placeholder="Nama Urusetia" value="<?php echo($r4['nama']); ?>" />
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<input class="form-control" name="jawatan3[]" type="text" placeholder="Jawatan" value="<?php echo($r4['jawatan']); ?>" />
											</div>
										</div>
										<div class="col-md-2 col-12 form-group">
											<button name="remove" id="<?php echo($y); ?>" type="button" class="padam_hadir2 btn btn-warning form-group">Padam</button>
										</div>
									</div>
										<?php if($guna_sekerip != NULL) { ?>
										<script>
											window.onload = function(){
												data_meeting_ada('#add_hadir2', <?php echo(round($y - 1)); ?>, 'id_kehadiran3[]', '<?php echo($r4['id_kehadiran']); ?>', 'jenis_kehadiran3[]', '<?php echo($r4['jenis_kehadiran']); ?>', 'nama3[]', '<?php echo($r4['nama']); ?>', 'jawatan3[]', '<?php echo($r4['jawatan']); ?>');
											}
										</script>
											<?php } ?>
										<?php $y++; } while($r4 = mysqli_fetch_assoc($m4)); } ?>
								</div>
								<div id="padam_hadir2"></div>
								<div class="form-group row">
									<div class="col-12 col-md-6"><div class="form-group"><h4><div align="center">&nbsp;</div></h4></div></div>
									<div class="col-12 col-md-4"><div class="form-group"><h4><div align="center">&nbsp;</div></h4></div></div>
									<div class="col-12 col-md-2"><div class="form-group"><button id="add_hadir2" type="button" class="btn-primary btn btn-info btn-block">Tambah</button></div></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12 col-md-12 form-group"><h4>Perkara/Agenda Mesyuarat</h4></div>
							<div class="col-12">
								<script>data_perkara(<?php if($jum_perkara > 0) echo($jum_perkara); if($jum_perkara == 0) echo '0'; ?>, '', 'add_perkara', 'borang_perkara', 'padam_perkara', 'baris_perkara', 'id_perkara_', 'id_perkara[]', 'id_perkara_padam[]', 'Padam')</script>
								<div class="form-group row">
									<div class="col-12 col-md-6"><div class="form-group"><strong>Perkara / Isu</strong></div></div>
									<div class="col-12 col-md-4"><div class="form-group"><strong>Status Tindakan</strong></div></div>
									<div class="col-12 col-md-2">&nbsp;</div>
								</div>
								<div id="borang_perkara">
									<?php if($jum_perkara > 0) { $z = 1; do {
									    $perkara_isu = $r5['perkara_isu'];
                                        $perkara_isu = str_replace('\r\n', '', $perkara_isu);
                                        $perkara_isu = str_replace('\\', '', $perkara_isu);
										$q_tindakkan2 = "SELECT jawatan 'jawatan' FROM jawatan WHERE tindakkan IN (1, 2) UNION SELECT DISTINCT jawatan 'jawatan' FROM data_ajkmasjid WHERE id_masjid = $id_masjid";
										$list_tindakkan2 = mysqli_query($bd2, $q_tindakkan2) or die(mysqli_error($bd2));
										$row_tindakkan2 = mysqli_fetch_assoc($list_tindakkan2);
										?>
										<div class="add_perkara row form-group" id="baris_perkara<?php echo($z); ?>">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<input id="id_perkara_<?php echo($z); ?>" name="id_perkara[]" type="hidden" value="<?php echo($r5['id_perkara']); ?>">
													<textarea name="perkara_isu[]" placeholder="Perkara / Isu Mesyuarat" rows="5" class="perkaraMeeting form-control"><?php echo($perkara_isu); ?></textarea>
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<select multiple size="5" class="form-control" name="status_tindakkan_<?php echo($z); ?>[]" required>
														<?php do { ?>
															<option value="<?php echo($row_tindakkan2['jawatan']); ?>" <?php if(strpos($r5['status_tindakan'], $row_tindakkan2['jawatan']) !== false) echo 'selected'; ?>><?php echo($row_tindakkan2['jawatan']); ?></option>
														<?php } while($row_tindakkan2 = mysqli_fetch_assoc($list_tindakkan2)); ?>
													</select>
												</div>
											</div>
											<div class="col-md-2 col-12 form-group">
												<button name="remove" id="<?php echo($z); ?>" type="button" class="padam_perkara btn btn-warning form-group">Padam</button>
											</div>
										</div>
										<?php if($guna_sekerip != NULL) { ?>
										<script>
											window.onload = function(){
												data_perkara_ada('#add_perkara', <?php echo(round($z - 1)); ?>, 'id_perkara[]', <?php echo($r5['id_perkara']); ?>, 'perkara_isu[]', '<?php echo($r5['perkara_isu']); ?>', 'status_tindakkan_<?php echo($z); ?>', '<?php echo str_replace(',""','',json_encode(explode('|',addslashes($r5['status_tindakan'])))); ?>');
											}
										</script>
											<?php } ?>
										<?php $z++; } while($r5 = mysqli_fetch_assoc($m5)); } ?>
								</div>
								<div id="padam_perkara"></div>
								<div class="form-group row">
									<div class="col-12 col-md-6"><div class="form-group"><h4><div align="center">&nbsp;</div></h4></div></div>
									<div class="col-12 col-md-4"><div class="form-group"><h4><div align="center">&nbsp;</div></h4></div></div>
									<div class="col-12 col-md-2"><div class="form-group"><button id="add_perkara" type="button" class="btn-primary btn btn-info btn-block">Tambah</button></div></div>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-12 col-md-6 text-center">
								<input name="id_masjid" id="id_masjid" value="<?php echo($id_masjid); ?>" type="hidden">
								<input name="id_mesyuarat" id="id_mesyuarat" value="<?php echo($id_mesyuarat); ?>" type="hidden">
								<button type="submit" class="btn-primary validate btn btn-info btn-block margin-top-10"><?php if($num > 0) echo 'Simpan'; else echo 'Simpan'; ?></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    function displayRujukan(str){
        var jenis_rujukan = str;

        if(jenis_rujukan==1){
            document.getElementById('rujukan_auto').style.display = "block";
            document.getElementById('rujukan_manual').style.display = "none";

            document.getElementById('no_rujukan').required = false;
        }
        else if(jenis_rujukan==2){
            document.getElementById('rujukan_manual').style.display = "block";
            document.getElementById('rujukan_auto').style.display = "none";

            document.getElementById('no_rujukan').required = true;
        }
    }
    addTinyMCE();
</script>
