<?php


use Verot\Upload\Upload;
include($_SERVER['DOCUMENT_ROOT']."/Masjid/Classes/phpUpload/class.upload.php");

$query_date = date('Y-m-d');

// First day of the month.
$mula = date('Y-m-01', strtotime($query_date));

// Last day of the month.
$tamat =  date('Y-m-t', strtotime($query_date));

$aktif_mula = "active";
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $aktif_mula = "";
    $aktif_kelik = "active show";
    $mula = $_POST['mdate'];
    $tamat = $_POST['mdate2'];
}
?>
    <div class="row page-titles printPageHide">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Masjid Care - Hasil Carian</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="utama.php?view=admin&action=dashboard&qariah=semua">Utama</a></li>
                    <li class="breadcrumb-item active">Masjid Care</li>
                </ol>
            </div>
        </div>
    </div>
<?php

if(is_numeric($_GET['id_keluarga'])) {
    $id_keluarga = $_GET['id_keluarga'];
    $q_m = "SELECT * FROM sej6x_data_masjid WHERE id_masjid = $id_masjid";
    $q_m2 = mysqli_query($bd2, $q_m) or die(mysqli_error($bd2));
    $q_masjid = mysqli_fetch_assoc($q_m2);
    $zon_solat = $q_masjid['zon_solat'];

    $q = "SELECT *, YEAR(NOW()) - YEAR(tarikh_lahir) 'umur', b.name, c.nama_daerah, d.nama_zon, e.pekerjaan FROM sej6x_data_peribadi a LEFT JOIN negeri b ON a.id_negeri = b.id_negeri LEFT JOIN daerah c ON a.id_daerah = c.id_daerah LEFT JOIN sej6x_data_zonqariah d ON a.zon_qariah = d.id_zonqariah LEFT JOIN pekerjaan e ON a.pekerjaan = e.id_pekerjaan WHERE a.id_data = $id_keluarga AND a.id_masjid = $id_masjid";
    $q2 = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $kemas = mysqli_fetch_assoc($q2);
    $q_num = mysqli_num_rows($q2);

    $q_2 = "SELECT *, YEAR(NOW()) - YEAR(tarikh_lahir) 'umur' FROM sej6x_data_anakqariah WHERE id_qariah = $id_keluarga AND id_masjid = $id_masjid";
    $q_22 = mysqli_query($bd2, $q_2) or die(mysqli_error($bd2));
    $kemas2 = mysqli_fetch_assoc($q_22);
    $q_num2 = mysqli_num_rows($q_22);
    $sql_bantuan = "SELECT * FROM bantuan_zakat WHERE id_data='$id_keluarga' AND status_bantuan='1'";
    $query_bantuan = mysqli_query($bd2,$sql_bantuan);
    $row_bantuan = mysqli_num_rows($query_bantuan);
    $data_bantuan = mysqli_fetch_assoc($query_bantuan);
    if($q_num > 0) {
        ?>
        <div class="row" style="color: #000000">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <?php if($kemas['umur'] >= 60) { ?><div class="ribbon ribbon-bookmark ribbon-warning" style="color: black">Warga Emas</div><?php } ?>
                    <div class="card-body" style="margin-bottom: -20px">
                        <center class="m-t-30">
                            <?php
                            $q = "SELECT gambar_profil 'file' FROM sej6x_data_peribadi WHERE id_data = " . $_GET['id_keluarga'];
                            $file = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
                            $file2 = mysqli_fetch_assoc($file);
                            $file_base64 = $file2['file'];
                            $file_base64 = str_replace('data:image/jpg;base64', '', $file_base64);
                            $file_base64 = str_replace('data:image/jpeg;base64', '', $file_base64);
                            $file_base64 = str_replace('data:image/png;base64', '', $file_base64);
                            $file_base64 = str_replace('data:image/gif;base64', '', $file_base64);
                            $handle = new Upload('base64:'.$file_base64);
                            $file_gambar = 'data:'.$handle->file_src_mime.';base64,'.base64_encode($handle->process());
                            ?>
                            <img class="img-fluid p-3" id="output_profil" src="<?php echo $file_gambar; ?>" class="img-circle" width="100">
                            <h4 class="card-title m-t-10" style="font-weight: bold"><?php echo($kemas['nama_penuh']); ?></h4>
                            <div style="font-weight: bold">Ahli kariah <?php echo($_SESSION['nama_masjid']); ?></div>
                        </center>
                    </div>
                    <hr />
                    <div id="profail" class="card-body profail-kariah" style="margin-top: -20px">
                        <strong>No K/P / Passpot</strong>
                        <div><?php echo($kemas['no_ic']); ?></div>
                        <strong>Tarikh Lahir</strong>
                        <div><?php fungsi_tarikh($kemas['tarikh_lahir'], 2, 7); ?></div>
                        <strong>Umur</strong>
                        <div><?php echo($kemas['umur']); ?> Tahun</div>
                        <strong>Bangsa</strong>
                        <div>
                            <?php if($kemas['bangsa'] == 1) echo('Melayu'); ?>
                            <?php if($kemas['bangsa'] == 2) echo('Cina'); ?>
                            <?php if($kemas['bangsa'] == 3) echo('India'); ?>
                            <?php if($kemas['bangsa'] == 4) echo('Lain-lain'); ?>
                        </div>
                        <strong>Jantina</strong>
                        <div>
                            <?php if($kemas['jantina'] == 1) echo('Lelaki'); ?>
                            <?php if($kemas['jantina'] == 2) echo('Perempuan'); ?>
                        </div>
                        <strong>Alamat</strong>
                        <div><?php echo($kemas['alamat_terkini']); ?></div>
                        <strong>Poskod</strong>
                        <div><?php echo($kemas['poskod']); ?></div>
                        <strong>Daerah</strong>
                        <div><?php echo($kemas['nama_daerah']); ?></div>
                        <strong>Negeri</strong>
                        <div><?php echo($kemas['name']); ?></div>
                        <div class="map-box" style="display: none">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                        <strong>Status Perkahwinan</strong>
                        <div>
                            <?php if($kemas['status_perkahwinan'] == 1) echo('Bujang'); ?>
                            <?php if($kemas['status_perkahwinan'] == 2) echo('Berkahwin'); ?>
                            <?php if($kemas['status_perkahwinan'] == 3) echo('Duda'); ?>
                            <?php if($kemas['status_perkahwinan'] == 4) echo('Janda'); ?>
                        </div>
                        <strong>No. Telefon</strong>
                        <div><?php echo($kemas['no_hp']); ?></div>
                        <strong>Warganegara</strong>
                        <div>
                            <?php if($kemas['warganegara'] == 1) echo('Warganegara'); ?>
                            <?php if($kemas['warganegara'] == 2) echo('Bukan Warganegara'); ?>
                        </div>
                        <strong>Pekerjaan</strong>
                        <div><?php echo($kemas['pekerjaan']); ?></div>
                        <strong>Tempoh Tinggal Di Kariah</strong>
                        <div><?php echo($kemas['tempoh_tinggal']); ?></div>
                        <strong>Zon Kariah</strong>
                        <div><?php echo($kemas['nama_zon']); ?></div>
                    </div>
                    <hr style="margin-top: -20px"/>
                    <div id="profail2" class="card-body profail-kariah" style="margin-top: -20px">
                        <div align="center"><strong>Catatan Masjid</strong></div>
                        <strong>No Rujukan Fail</strong>
                        <div><?php echo($kemas['no_rujukan']); ?></div>
                        <strong>Asnaf</strong>
                        <div>
                            <?php if($kemas['data_asnaf'] == 1) echo('Ya'); ?>
                            <?php if($kemas['data_asnaf'] == 2) echo('Tidak'); ?>
                            <?php if($kemas['data_asnaf'] != 1 && $kemas['data_asnaf'] != 2) echo(' - '); ?>
                        </div>
                        <strong>Wajib Solat Jumaat</strong>
                        <div>
                            <?php if($kemas['solat_jumaat'] == 1) echo('Ya'); ?>
                            <?php if($kemas['solat_jumaat'] == 2) echo('Tidak'); ?>
                            <?php if($kemas['solat_jumaat'] != 1 && $kemas['data_jumaat'] != 2) echo(' - '); ?>
                        </div>
                        <strong>OKU</strong>
                        <div>
                            <?php if($kemas['oku'] == 1 || $kemas['oku'] == "Y") echo('Ya'); ?>
                            <?php if($kemas['oku'] == 2 || $kemas['oku'] == "N") echo('Tidak'); ?>
                            <?php if($kemas['oku'] != 1 && $kemas['oku'] != 2) echo(' - '); ?>
                        </div>
                        <?php
                        if($kemas['oku'] == 1 || $kemas['oku'] == "Y") {
                        ?>
                            <strong>Jenis OKU</strong>
                            <div>
                                <?php
                                $jenis_oku = explode(',',$kemas['jenis_oku']);
                                $i = 0;
                                if(in_array("1", $jenis_oku))
                                {
                                ?>
                                    -   KURANG UPAYA PENDENGARAN<br>
                                <?php } ?>
                                <?php
                                if(in_array("2", $jenis_oku))
                                {
                                ?>
                                    -   KURANG UPAYA PENGLIHATAN<br>
                                <?php } ?>
                                <?php
                                if(in_array("3", $jenis_oku))
                                {
                                ?>
                                    -   KURANG UPAYA PERTUTURAN<br>
                                <?php } ?>
                                <?php
                                if(in_array("4", $jenis_oku))
                                {
                                ?>
                                    -   KURANG UPAYA FIZIKAL<br>
                                <?php } ?>
                                <?php
                                if(in_array("5", $jenis_oku))
                                {
                                ?>
                                    -   KURANG UPAYA PEMBELAJARAN<br>
                                <?php } ?>
                                <?php
                                if(in_array("6", $jenis_oku))
                                {
                                ?>
                                    -   KURANG UPAYA MENTAL<br>
                                <?php } ?>
                                <?php
                                if(in_array("7", $jenis_oku))
                                {
                                ?>
                                    <?php  echo $i = $i+1; ?>
                                    -   KURANG UPAYA PELBAGAI<br>
                                <?php } ?>
                            </div>
                        <?php
                        }
                        ?>
                        <strong>Ibu Tunggal</strong>
                        <div>
                            <?php if($kemas['data_ibutunggal'] == 1) echo('Ya'); ?>
                            <?php if($kemas['data_ibutunggal'] == 2) echo('Tidak'); ?>
                            <?php if($kemas['data_ibutunggal'] != 1 && $kemas['data_ibutunggal'] != 2) echo(' - '); ?>
                        </div>
                        <strong>Anak Yatim</strong>
                        <div>
                            <?php if($kemas['data_anakyatim'] == 1) echo('Ya'); ?>
                            <?php if($kemas['data_anakyatim'] == 2) echo('Tidak'); ?>
                            <?php if($kemas['data_anakyatim'] != 1 && $kemas['data_anakyatim'] != 2) echo(' - '); ?>
                        </div>
                        <strong>Khairat Kematian</strong>
                        <div>
                            <?php if($kemas['data_khairat'] == 1) echo('Ya'); ?>
                            <?php if($kemas['data_khairat'] == 2) echo('Tidak'); ?>
                            <?php if($kemas['data_khairat'] != 1 && $kemas['data_khairat'] != 2) echo(' - '); ?>
                        </div>
                        <strong>Mualaf</strong>
                        <div>
                            <?php if($kemas['data_mualaf'] == 1) echo('Ya'); ?>
                            <?php if($kemas['data_mualaf'] == 2) echo('Tidak'); ?>
                            <?php if($kemas['data_mualaf'] != 1 && $kemas['data_mualaf'] != 2) echo(' - '); ?>
                        </div>
                        <?php if($kemas['data_mualaf'] == 1) { ?>
                            <strong>Tarikh Memeluk Islam</strong>
                            <div><?php fungsi_tarikh($kemas['tarikh_mualaf'], 2, 7); ?></div>
                            <strong>Tempat</strong>
                            <div><?php echo($kemas['tempat_mualaf']); ?></div>
                            <strong>Dihadapan</strong>
                            <div><?php echo($kemas['dihadapan_mualaf']); ?></div>
                        <?php } ?>
                        <strong>Sakit Kronik</strong>
                        <div>
                            <?php if($kemas['data_sakit'] == 1) echo('Ya'); ?>
                            <?php if($kemas['data_sakit'] == 2) echo('Tidak'); ?>
                            <?php if($kemas['data_sakit'] != 1 && $kemas['data_sakit'] != 2) echo(' - '); ?>
                        </div>
                        <?php if($kemas['data_sakit'] == 1) {
                            $q_sakit = "SELECT * FROM sej6x_data_sakit a, list_penyakit b WHERE a.id_penyakit = b.id_penyakit AND a.id_data = $id_keluarga";
                            $q_sakit2 = mysqli_query($bd2, $q_sakit) or die(mysqli_error($bd2));
                            $row_sakit = mysqli_fetch_assoc($q_sakit2);
                            $i = 1;
                            do {
                                ?>
                                <strong><?php echo($i); ?>. Penyakit</strong>
                                <div><?php echo($row_sakit['penyakit']); ?></div>
                                <strong>Rawatan Terkini</strong>
                                <div><?php echo($row_sakit['rawatan_terkini']); ?></div>
                                <?php $i++; } while($row_sakit = mysqli_fetch_assoc($q_sakit2)); } ?>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item"> <a class="nav-link <?php echo($aktif_mula); ?>" data-toggle="tab" href="#home" role="tab">Kariah</a> </li>
                        <?php if($q_num2 > 0) { ?><li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Tanggungan <i class="icon-people"></i> <font class="font-medium"><?php echo($q_num2); ?></font></a> </li><?php } ?>
                        <li class="nav-item"> <a class="nav-link <?php echo($aktif_kelik); ?>" data-toggle="tab" href="#settings" role="tab">Kehadiran</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings2" role="tab">Permohonan</a> </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane <?php echo($aktif_mula); ?>" id="home" role="tabpanel">
                            <div class="card-body">
                                <div class="row" style="color: #000000">
                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Masjid</strong>
                                        <br>
                                        <div><?php echo($_SESSION['nama_masjid']); ?></div>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Alamat Masjid</strong>
                                        <br>
                                        <div><?php echo($q_masjid['alamat_masjid']); ?></div>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Daerah</strong>
                                        <br>
                                        <div><?php echo($q_masjid['daerah']); ?></div>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Negeri</strong>
                                        <br>
                                        <div><?php echo($q_masjid['negeri']); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--second tab-->
                        <?php if($q_num2 > 0) { ?>
                            <div class="tab-pane" id="profile" role="tabpanel">
                                <div id="accordian-3">
                                    <?php
                                    $ii = 1;
                                    $val = array(1, 2, "Y", "N");
                                    $ya = array(1, "Y");
                                    $tidak = array(2, "N");
                                    do { ?>
                                        <div class="card">
                                            <a class="card-header" id="heading11">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo($ii); ?>" aria-expanded="true" aria-controls="collapse<?php echo($ii); ?>">
                                                    <h5 class="mb-0" style="color: black; font-weight: bold"><i class="fa fa-plus-circle"></i> <?php echo($kemas2['nama_penuh']); ?></h5>
                                                </button>
                                            </a>
                                            <div id="collapse<?php echo($ii); ?>" class="collapse" aria-labelledby="heading<?php echo($ii); ?>" data-parent="#accordian-3">
                                                <div class="card-body profail-kariah">
                                                    <strong>No K/P / Passpot</strong>
                                                    <div><?php echo($kemas2['no_ic']); ?></div>
                                                    <strong>Tarikh Lahir</strong>
                                                    <div><?php fungsi_tarikh($kemas2['tarikh_lahir'], 2, 7); ?></div>
                                                    <strong>Umur</strong>
                                                    <div><?php echo($kemas2['umur']); ?> Tahun</div>
                                                    <strong>Jantina</strong>
                                                    <div>
                                                        <?php if($kemas2['jantina'] == 1) echo('Lelaki'); ?>
                                                        <?php if($kemas2['jantina'] == 2) echo('Perempuan'); ?>
                                                    </div>
                                                    <strong>Status Perkahwinan</strong>
                                                    <div>
                                                        <?php if($kemas2['status_kahwin'] == 1) echo('Bujang'); ?>
                                                        <?php if($kemas2['status_kahwin'] == 2) echo('Berkahwin'); ?>
                                                        <?php if($kemas2['status_kahwin'] == 3) echo('Duda'); ?>
                                                        <?php if($kemas2['status_kahwin'] == 4) echo('Janda'); ?>
                                                    </div>
                                                    <strong>No. Telefon</strong>
                                                    <div><?php echo($kemas2['no_tel']); ?></div>
                                                    <strong>OKU</strong>
                                                    <div>
                                                        <?php if(in_array($kemas2['status_oku'], $ya)) echo('Ya'); ?>
                                                        <?php if(in_array($kemas2['status_oku'], $tidak)) echo('Tidak'); ?>
                                                        <?php if(!in_array($kemas2['status_oku'], $val)) echo(' - '); ?>
                                                    </div>
                                                    <strong>Ibu Tunggal</strong>
                                                    <div>
                                                        <?php if(in_array($kemas2['status_ibutunggal'], $ya)) echo('Ya'); ?>
                                                        <?php if(in_array($kemas2['status_ibutunggal'], $tidak)) echo('Tidak'); ?>
                                                        <?php if(!in_array($kemas2['status_ibutunggal'], $val)) echo(' - '); ?>
                                                    </div>
                                                    <strong>Anak Yatim</strong>
                                                    <div>
                                                        <?php if(in_array($kemas2['status_anakyatim'], $ya)) echo('Ya'); ?>
                                                        <?php if(in_array($kemas2['status_anakyatim'], $tidak)) echo('Tidak'); ?>
                                                        <?php if(!in_array($kemas2['status_anakyatim'], $val)) echo(' - '); ?>
                                                    </div>
                                                    <strong>Mualaf</strong>
                                                    <div>
                                                        <?php if(in_array($kemas2['status_mualaf'], $ya)) echo('Ya'); ?>
                                                        <?php if(in_array($kemas2['status_mualaf'], $tidak))echo('Tidak'); ?>
                                                        <?php if(!in_array($kemas2['status_mualaf'], $val)) echo(' - '); ?>
                                                    </div>
                                                    <strong>Sakit Kronik</strong>
                                                    <div>
                                                        <?php if(in_array($kemas2['status_sakit'], $ya)) echo('Ya'); ?>
                                                        <?php if(in_array($kemas2['status_sakit'], $tidak)) echo('Tidak'); ?>
                                                        <?php if(!in_array($kemas2['status_sakit'], $val)) echo(' - '); ?>
                                                    </div>
                                                    <?php if(in_array($kemas2['status_sakit'], $ya)) {
                                                        $q_sakit_anak = "SELECT * FROM sej6x_data_sakit a, list_penyakit b WHERE a.id_penyakit = b.id_penyakit AND a.id_anak = ".$kemas2['ID'];
                                                        $q_sakit_anak2 = mysqli_query($bd2, $q_sakit_anak) or die(mysqli_error($bd2));
                                                        $row_sakit_anak = mysqli_fetch_assoc($q_sakit_anak2);
                                                        $i = 1;
                                                        do {
                                                            ?>
                                                            <strong><?php echo($i); ?>. Penyakit</strong>
                                                            <div><?php echo($row_sakit_anak['penyakit']); ?></div>
                                                            <strong>Rawatan Terkini</strong>
                                                            <div><?php echo($row_sakit_anak['rawatan_terkini']); ?></div>
                                                            <?php $i++; } while($row_sakit_anak = mysqli_fetch_assoc($q_sakit_anak2)); } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $ii++; } while($kemas2 = mysqli_fetch_assoc($q_22)); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="tab-pane <?php echo($aktif_kelik); ?>" id="settings" role="tabpanel">
                            <div class="card-body">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']); ?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12 col-md-12 form-group" style="display: none"><h4>Data Kehadiran</h4></div>
                                        <div class="col-6 col-md-6 form-group">
                                            <label class="m-t-20">Dari</label>
                                            <input name="mdate" type="text" class="form-control" placeholder="Dari" id="mdate" value="<?php echo($mula); ?>">
                                        </div>
                                        <div class="col-6 col-md-6 form-group">
                                            <label class="m-t-20">Hingga</label>
                                            <input name="mdate2" type="text" class="form-control" placeholder="Hingga" id="mdate2" value="<?php echo($tamat); ?>">
                                        </div>
                                        <div class="col-12 col-md-12 form-group">
                                            <label>Nama</label>
                                            <?php
                                            $query = "SELECT a.nama_penuh 'val', a.no_ic 'id' FROM sej6x_data_peribadi a WHERE a.no_ic = '".$kemas['no_ic']."'
                                            UNION SELECT b.nama_penuh 'val', b.no_ic 'id' FROM sej6x_data_anakqariah b WHERE b.id_qariah = ".$kemas['id_data'];
                                            if(isset($_POST['no_ic'])) $pilih = $_POST['no_ic'];
                                            else $pilih = $kemas['no_ic'];
                                            pilihVal3('test', $query, 1, 'no_ic', 'no_ic', 'form-control', 'required', $pilih, 0);
                                            ?>
                                        </div>
                                        <input type="hidden" name="cari" id="cari" value="<?php echo($result); ?>">
                                        <div class="col-12 col-md-12 form-group"><button type="submit" class="btn btn-primary">Lihat</button></div>
                                    </div>
                                </form>
                                <div class="table-responsive row">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr id="waktu_solat_list">
                                            <th>Tarikh</th>
                                            <th>Subuh <span id="subuh" class="badge badge-info"><?php echo($kira_subuh); ?></span></th>
                                            <th>Zohor / Jumaat <span id="zohor" class="badge badge-info"><?php echo($kira_zohor); ?></span></th>
                                            <th>Asar <span id="asar" class="badge badge-info"><?php echo($kira_asar); ?></span></th>
                                            <th>Maghrib <span id="maghrib" class="badge badge-info"><?php echo($kira_maghrib); ?></span></th>
                                            <th>Isyak <span id="isyak" class="badge badge-info"><?php echo($kira_isyak); ?></span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $kira_subuh = 0;
                                        $kira_zohor = 0;
                                        $kira_asar = 0;
                                        $kira_maghrib = 0;
                                        $kira_isyak = 0;
                                        $date = date_create(date());
                                        $tarikh_check = date_format($date, "Y-m-d");
                                        $period = new DatePeriod(new DateTime($mula), new DateInterval('P1D'), new DateTime($tamat.' +1 day'));
                                        $ii = 1;
                                        foreach ($period as $date) {
                                            $hari_tahun = $date->format("z");
                                            $q = "SELECT * FROM sej6x_data_gejala WHERE year(time) = '".$date->format("Y")."' AND month(time) = '".$date->format("m")."' AND day(time) = '".$date->format("d")."' AND no_ic = '".$pilih."' GROUP BY tujuan ORDER BY time DESC";
                                            $q2 = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
                                            $row_waktu = mysqli_fetch_assoc($q2);
                                            $num_waktu = mysqli_num_rows($q2);
                                            if($num_waktu > 0) {
                                                do {
                                                    $tujuan = $row_waktu['tujuan'];
                                                    $waktu = fungsi_tarikh($row_waktu['time'], 5, 99);

                                                    if($tujuan == "Subuh") {
                                                        $kira_subuh = $kira_subuh + 1;
                                                        $waktu1[$ii] = $waktu;
                                                    }
                                                    if(strpos($tujuan, 'Zohor') !== false) {
                                                        $kira_zohor = $kira_zohor + 1;
                                                        $waktu2[$ii] = $waktu;
                                                    }
                                                    if($tujuan == "Asar") {
                                                        $kira_asar = $kira_asar + 1;
                                                        $waktu3[$ii] = $waktu;
                                                    }
                                                    if($tujuan == "Maghrib") {
                                                        $kira_maghrib = $kira_maghrib + 1;
                                                        $waktu4[$ii] = $waktu;
                                                    }
                                                    if($tujuan == "Isyak") {
                                                        $kira_isyak = $kira_isyak + 1;
                                                        $waktu5[$ii] = $waktu;
                                                    }
                                                } while ($row_waktu = mysqli_fetch_assoc($q2));
                                                selesai:
                                            }
                                            ?>
                                            <tr>
                                                <td><?php fungsi_tarikh($date->format("Y-m-d"), 2, 4); ?></td>
                                                <td align="right" <?php if($waktu1[$ii]) { ?>bgcolor='#44FF62'<?php } ?>><?php echo($waktu1[$ii]); ?></td>
                                                <td align="right" <?php if($waktu2[$ii]) { ?>bgcolor='#44FF62'<?php } ?>><?php echo($waktu2[$ii]); ?></td>
                                                <td align="right" <?php if($waktu3[$ii]) { ?>bgcolor='#44FF62'<?php } ?>><?php echo($waktu3[$ii]); ?></td>
                                                <td align="right" <?php if($waktu4[$ii]) { ?>bgcolor='#44FF62'<?php } ?>><?php echo($waktu4[$ii]); ?></td>
                                                <td align="right" <?php if($waktu5[$ii]) { ?>bgcolor='#44FF62'<?php } ?>><?php echo($waktu5[$ii]); ?></td>
                                            </tr>
                                            <?php $ii++; } ?>
                                        </tbody>
                                    </table>
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                            var subuh = <?php echo($kira_subuh); ?>;
                                            var zohor = <?php echo($kira_zohor); ?>;
                                            var asar = <?php echo($kira_asar); ?>;
                                            var maghrib = <?php echo($kira_maghrib); ?>;
                                            var isyak = <?php echo($kira_isyak); ?>;
                                            $('#subuh').text(subuh);
                                            $('#zohor').text(zohor);
                                            $('#asar').text(asar);
                                            $('#maghrib').text(maghrib);
                                            $('#isyak').text(isyak);
                                            $('#waktu_solat_list .badge').each(function() {
                                                if($(this).text() < 1) {
                                                    $(this).removeClass('badge-info');
                                                    $(this).addClass('badge-warning');
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="settings2" role="tabpanel">
                            <div id="accordian-4">
                                <div class="card">
                                    <a class="card-header" id="tajukmohon1">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#isi1" aria-expanded="true" aria-controls="isi1">
                                            <h5 class="mb-0" style="color: black; font-weight: bold"><i class="fa fa-plus-circle"></i> Bantuan Dari Masjid</h5>
                                        </button>
                                    </a>
                                    <div id="isi1" class="collapse" aria-labelledby="tajukmohon1" data-parent="#accordian-4">
                                        <div class="card-body">
                                            <div class="table-responsive row">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Bil</th>
                                                        <th>Jenis Bantuan</th>
                                                        <th>Tarikh</th>
                                                        <th>Kaedah Pembayaran</th>
                                                        <th>Amaun/Item</th>
                                                        <th>Masjid</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $k=1;
                                                    while($data_bantuan=mysqli_fetch_assoc($query_bantuan))	{
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $k; ?></td>
                                                            <td><?php echo $data_bantuan['jenis_bantuan']; ?></td>
                                                            <td><?php echo $data_bantuan['tarikh_bantuan']; ?></td>
                                                            <td><?php echo $data_bantuan['kaedah_bayar']; ?></td>
                                                            <td><?php echo $data_bantuan['amaun']; ?></td>
                                                            <td><?php $bantuan_masjid = $data_bantuan['id_masjid'];
                                                                $sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$bantuan_masjid'";
                                                                $query_masjid = mysqli_query($bd2,$sql_masjid);
                                                                $data_masjid = mysqli_fetch_assoc($query_masjid);
                                                                echo $data_masjid['nama_masjid'];
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php $k++; } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <a class="card-header" id="tajukmohon2">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#isi2" aria-expanded="false" aria-controls="isi2">
                                            <h5 class="mb-0" style="color: black; font-weight: bold"><i class="fa fa-plus-circle"></i> Bantuan Dari Zakat</h5>
                                        </button>
                                    </a>
                                    <div id="isi2" class="collapse" aria-labelledby="tajukmohon2" data-parent="#accordian-4">
                                        <div class="card-body">
                                            -
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    <?php } } if(!is_numeric($_GET['id_keluarga']) || $q_num < 1) { ?>
    <div class="col-12 col-md-12">
        <div style="font-size: medium" class="alert alert-danger" role="alert" align="center">Halaman Tidak Dijumpai</div>
    </div>
<?php } ?>