<div class="row form-group">
    <?php //if($_GET['action'] != "dashboard") { ?>
        <div class="col-12 col-md-3"><label>Didaftarkan Oleh</label>
            <?php
            $q = "SELECT user_id 'id', user_name 'val' FROM masjid_user WHERE id_masjid = ".$_SESSION['id_masjid']." ORDER BY user_type_id ASC";
            pilihVal3('popup_user', $q, 1, 'added_by', 'added_by', 'form-control', '', $_GET['added_by'], '');
            ?>
            <script type="text/javascript">
                var asal = $("#added_by").html();
                asal = asal.replace("<option></option>", "");
                $("#added_by").change(function(){
                    pilih_ahli();
                });
                $("#added_by").html('');
                $("#added_by").append('<option value="" <?php if($_GET['added_by'] == NULL) echo 'selected'; ?>>Semua Pengguna</option>');
                $("#added_by").append(asal);
            </script>
        </div>
    <?php //} ?>
    <div class="col-12 col-md-3"><label>Ahli</label>
        <select id="list_ahli" name="list_ahli" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Semua Ahli Kariah:-</option>
            <option value="1" <?php if($_GET['list_ahli'] == 1) echo 'selected'; ?>>Ketua Keluarga</option>
            <option value="2" <?php if($_GET['list_ahli'] == 2) echo 'selected'; ?>>Tanggungan</option>
        </select>
    </div>
    <?php if($_SESSION['perlu_zon'] == 1) { ?>
        <div class="col-12 col-md-3"><label>Zon</label>
            <select id="zon" name="zon" class="form-group form-control" onchange2="pilih_ahli()">
                <option value="">Semua Zon Kariah:-</option>
                <?php
                $q = "SELECT * FROM sej6x_data_zonqariah WHERE id_masjid = $id_masjid OR id_zonqariah = 0";
                $q2 = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
                $row_zon = mysqli_fetch_assoc($q2);
                do {
                    ?>
                    <option value="<?php echo($row_zon['id_zonqariah']); ?>" <?php if($row_zon['id_zonqariah'] == $_GET['zon']) echo 'selected'; ?>><?php echo($row_zon['nama_zon']); ?></option>
                <?php } while($row_zon = mysqli_fetch_assoc($q2)); ?>
            </select>
        </div>
    <?php } ?>
    <div class="col-12 col-md-3"><label>Jantina</label>
        <select id="jantina" name="jantina" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Jantina:-</option>
            <option value="99" <?php if($_GET['jantina'] == 99) echo 'selected'; ?>>Semua</option>
            <option value="1" <?php if($_GET['jantina'] == 1) echo 'selected'; ?>>Lelaki</option>
            <option value="2" <?php if($_GET['jantina'] == 2) echo 'selected'; ?>>Perempuan</option>
        </select>
    </div>
    <div class="col-12 col-md-3"><label>Status</label>
        <select id="status" name="status" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Status:-</option>
            <option value="99" <?php if($_GET['status'] == 99) echo 'selected'; ?>>Semua</option>
            <?php
            $qStatus = "SELECT * FROM itemStatistik WHERE id_jenisStatistik = 5";
            selValueSQL($qStatus, 'qStatus');
            $status = fetchSQL('qStatus');
            $i = 0; foreach ($status as $col[$i]) {
                ?>
                <option value="<?php echo($col[$i]['itemStatistikNama']); ?>" <?php if($_GET['status'] == $col[$i]['itemStatistikNama']) echo 'selected'; ?>><?php echo($col[$i]['itemStatistikLabel']); ?></option>
                <?php $i++; } ?>
        </select>
    </div>
    <div class="col-12 col-md-3"><label>Warganegara</label>
        <select id="warganegara" name="warganegara" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Warganegara:-</option>
            <option value="99" <?php if($_GET['warganegara'] == 99) echo 'selected'; ?>>Semua</option>
            <?php
            $qWarga = "SELECT * FROM itemStatistik WHERE id_jenisStatistik = 1";
            selValueSQL($qWarga, 'qWarga');
            $warga = fetchSQL('qWarga');
            $i = 0; foreach ($warga as $col[$i]) {
                ?>
                <option value="<?php echo($col[$i]['itemStatistikNama']); ?>" <?php if($_GET['warganegara'] == $col[$i]['itemStatistikNama']) echo 'selected'; ?>><?php echo($col[$i]['itemStatistikLabel']); ?></option>
                <?php $i++; } ?>
        </select>
    </div>
    <div class="col-12 col-md-3"><label>Bangsa</label>
        <select id="bangsa" name="bangsa" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Bangsa:-</option>
            <option value="99" <?php if($_GET['bangsa'] == 99) echo 'selected'; ?>>Semua</option>
            <?php
            $qBangsa = "SELECT * FROM itemStatistik WHERE id_jenisStatistik = 3";
            selValueSQL($qBangsa, 'qBangsa');
            $bangsa = fetchSQL('qBangsa');
            $i = 0; foreach ($bangsa as $col[$i]) {
                ?>
                <option value="<?php echo($col[$i]['itemStatistikNama']); ?>" <?php if($_GET['bangsa'] == $col[$i]['itemStatistikNama']) echo 'selected'; ?>><?php echo($col[$i]['itemStatistikLabel']); ?></option>
                <?php $i++; } ?>
        </select>
    </div>
    <div class="col-12 col-md-3"><label>Umur</label>
        <select id="julatUmur" name="julatUmur" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Umur:-</option>
            <option value="Semua" <?php if($_GET['julatUmur'] == 'Semua') echo 'selected'; ?>>Semua</option>
            <?php
            $qUmur = "SELECT * FROM itemStatistik WHERE id_jenisStatistik = 2";
            selValueSQL($qUmur, 'qUmur');
            $julatUmur = fetchSQL('qUmur');
            $i = 0; foreach ($julatUmur as $col[$i]) {
                ?>
                <option value="<?php echo($col[$i]['number1'].'|'.$col[$i]['number2']); ?>" <?php if($_GET['julatUmur'] == $col[$i]['number1'].'|'.$col[$i]['number2']) echo 'selected'; ?>><?php echo($col[$i]['itemStatistikLabel']); ?></option>
                <?php $i++; } ?>
        </select>
    </div>
    <div class="col-12 col-md-3"><label>Asnaf</label>
        <select id="asnaf" name="asnaf" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Asnaf:-</option>
            <option value="1|Y" <?php if($_GET['asnaf'] == 1) echo 'selected'; ?>>Ya</option>
            <option value="2|N" <?php if($_GET['asnaf'] == 2) echo 'selected'; ?>>Tidak</option>
        </select>
    </div>
    <div class="col-12 col-md-3"><label>O.K.U.</label>
        <select id="oku" name="oku" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">O.K.U.:-</option>
            <option value="1|Y" <?php if($_GET['oku'] == 1) echo 'selected'; ?>>Ya</option>
            <option value="2|N" <?php if($_GET['oku'] == 2) echo 'selected'; ?>>Tidak</option>
        </select>
    </div>
    <div class="col-12 col-md-3"><label>Warga Emas</label>
        <select id="warga_emas" name="warga_emas" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Warga Emas:-</option>
            <option value="1" <?php if($_GET['warga_emas'] == 1) echo 'selected'; ?>>Ya</option>
            <option value="2" <?php if($_GET['warga_emas'] == 2) echo 'selected'; ?>>Tidak</option>
        </select>
    </div>
    <?php //if($_GET['action'] != "dashboard") { ?>
        <div class="col-12 col-md-3"><label>Layak Mengundi</label>
            <select id="mengundi" name="mengundi" class="form-group form-control" onchange2="pilih_ahli()">
                <option value="">Mengundi:-</option>
                <option value="1" <?php if($_GET['mengundi'] == 1) echo 'selected'; ?>>Ya</option>
                <option value="2" <?php if($_GET['mengundi'] == 2) echo 'selected'; ?>>Tidak</option>
            </select>
        </div>
    <?php //} ?>
    <div class="col-12 col-md-3"><label>Ibu Tunggal</label>
        <select id="ibu_tunggal" name="ibu_tunggal" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Ibu Tunggal:-</option>
            <option value="1" <?php if($_GET['ibu_tunggal'] == 1) echo 'selected'; ?>>Ya</option>
            <option value="2" <?php if($_GET['ibu_tunggal'] == 2) echo 'selected'; ?>>Tidak</option>
        </select>
    </div>
    <div class="col-12 col-md-3"><label>Sakit Kronik</label>
        <select id="sakit" name="sakit" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Sakit Kronik:-</option>
            <option value="1" <?php if($_GET['sakit'] == 1) echo 'selected'; ?>>Ya</option>
            <option value="2" <?php if($_GET['sakit'] == 2) echo 'selected'; ?>>Tidak</option>
        </select>
    </div>
    <div class="col-12 col-md-3"><label>Anak Yatim</label>
        <select id="anak_yatim" name="anak_yatim" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Anak Yatim:-</option>
            <option value="Y" <?php if($_GET['anak_yatim'] == 'Y') echo 'selected'; ?>>Ya</option>
            <option value="N" <?php if($_GET['anak_yatim'] == 'N') echo 'selected'; ?>>Tidak</option>
        </select>
    </div>
    <div class="col-12 col-md-3"><label>Mualaf</label>
        <select id="mualaf" name="mualaf" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Mualaf:-</option>
            <option value="1" <?php if($_GET['mualaf'] == '1') echo 'selected'; ?>>Ya</option>
            <option value="2" <?php if($_GET['mualaf'] == '2') echo 'selected'; ?>>Tidak</option>
        </select>
    </div>
    <div class="col-12 col-md-3"><label>Khairat Kematian</label>
        <select id="khairat" name="khairat" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Khairat Kematian:-</option>
            <option value="1" <?php if($_GET['khairat'] == '1') echo 'selected'; ?>>Ya</option>
            <option value="2" <?php if($_GET['khairat'] == '2') echo 'selected'; ?>>Tidak</option>
        </select>
    </div>
    <div class="col-12 col-md-3"><label>Pekerjaan</label>
        <select id="pekerjaan" name="pekerjaan" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Pekerjaan:-</option>
            <option value="1" <?php if($_GET['pekerjaan'] == '1') echo 'selected'; ?>>Kerajaan</option>
            <option value="2" <?php if($_GET['pekerjaan'] == '2') echo 'selected'; ?>>Swasta</option>
            <option value="3" <?php if($_GET['pekerjaan'] == '3') echo 'selected'; ?>>Sendiri</option>
            <option value="4" <?php if($_GET['pekerjaan'] == '4') echo 'selected'; ?>>Pencen</option>
            <option value="5" <?php if($_GET['pekerjaan'] == '5') echo 'selected'; ?>>Tidak Bekerja</option>
        </select>
    </div>
    <div class="col-12 col-md-3"><label>Pendapatan</label>
        <select id="pendapatan" name="pendapatan" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Pendapatan:-</option>
            <option value="1" <?php if($_GET['pendapatan'] == '1') echo 'selected'; ?>>0 - 1000</option>
            <option value="2" <?php if($_GET['pendapatan'] == '2') echo 'selected'; ?>>1001 - 2000</option>
            <option value="3" <?php if($_GET['pendapatan'] == '3') echo 'selected'; ?>>2001 - 3000</option>
            <option value="4" <?php if($_GET['pendapatan'] == '4') echo 'selected'; ?>>3001 - 4000</option>
            <option value="5" <?php if($_GET['pendapatan'] == '5') echo 'selected'; ?>>Lebih dari 4000</option>
        </select>
    </div>
    <div class="col-12 col-md-3"><label>Pemilikkan</label>
        <select id="pemilikkan" name="pemilikkan" class="form-group form-control" onchange2="pilih_ahli()">
            <option value="">Pemilikkan:-</option>
            <option value="1" <?php if($_GET['pemilikkan'] == '1') echo 'selected'; ?>>Beli</option>
            <option value="2" <?php if($_GET['pemilikkan'] == '2') echo 'selected'; ?>>Sewa</option>
            <option value="3" <?php if($_GET['pemilikkan'] == '3') echo 'selected'; ?>>Pusaka</option>
            <option value="4" <?php if($_GET['pemilikkan'] == '4') echo 'selected'; ?>>Menumpang</option>
            <option value="5" <?php if($_GET['pemilikkan'] == '5') echo 'selected'; ?>>Lain - Lain</option>
        </select>
    </div>
    <?php //if($_GET['action'] != "dashboard") { ?>
        <div class="col-12 col-md-3"><label>Aktif</label>
            <select id="aktif" name="aktif" class="form-group form-control" onchange2="pilih_ahli()">
                <option value="">Aktif (Semua):-</option>
                <option value="1" <?php if($_GET['aktif'] == '1' || $_GET['aktif'] == NULL) echo 'selected'; ?>>Ya</option>
                <option value="2" <?php if($_GET['aktif'] == '2') echo 'selected'; ?>>Tidak</option>
            </select>
        </div>
    <?php //} ?>
</div>
<div class="row">
    <div class="col-12 col-md-3">
        <button type="button" class="btn btn-info" onclick="pilih_ahli()">Lihat Senarai</button>
    </div>
</div>