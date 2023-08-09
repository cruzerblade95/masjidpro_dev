<?php

$id_masjid = $_SESSION['id_masjid'];
//$url_cur = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&data_view=raw';
$url_cur = $_SERVER['REQUEST_URI'];
$cur_year = date('Y');
$cur_month = date('m');
$cur_day = date('d');
$tajuk_report = '<br>Keseluruhan';
$tahun = $_GET['tahun'];
$bulan = $_GET['bulan'];
$minggu = $_GET['minggu'];

if($bulan != "minggu") {
    if(!is_numeric($tahun)) $tahun = NULL;
    if(!is_numeric($bulan)) $bulan = NULL;
    if ($tahun == NULL || !$_GET['tahun']) $tahun = -1;
    if ($bulan == NULL || !$_GET['bulan']) $bulan = -1;

    if ($bulan != -1 && $tahun != -1) {
        $tajuk_report = '<br>Bulan: ' . fungsi_tarikh('2000-' . $bulan . '-01 10:00:00', 8, 99) . ', Tahun: ' . $tahun;
        $extra = "AND year(a.tarikh) = $tahun AND month(a.tarikh) = $bulan";
        $extra2 = "AND a.tarikh < '$tahun-$bulan-01'";
        //$extraBaki = "AND year(tarikhBaki) = $tahun AND (month(tarikhBaki) = $bulan OR month(tarikhBaki) = $bulan - 1)";
        $extraBaki2 = "AND tarikhBaki < '$tahun-$bulan-01'";
    }
    if ($bulan == -1 && $tahun != -1) {
        $tajuk_report = '<br>Tahun: ' . $tahun;
        $extra = "AND year(a.tarikh) = $tahun";
        $extra2 = "AND a.tarikh < '$tahun-01-01'";
        //$extraBaki = "AND year(tarikhBaki) = $tahun";
        $extraBaki2 = "AND tarikhBaki < '$tahun-01-01'";
        $bulan = "01";
    }
    if ($tahun == -1) $extra2 = "AND a.tarikh < '$cur_year-01-01'";

}
if($bulan == "minggu") {
    if (strpos($minggu, '|') !== false) {
        $m = explode("|", $minggu);
        $no_minggu = $m[0];
        $mula = $m[1];
        $mula2 = fungsi_tarikh($m[1], 7, 99);
        $tamat = $m[2];
        $tamat2 = fungsi_tarikh($m[2], 7, 99);
    }
    $tajuk_report = '<br>Tahun: '.$tahun;
    $tajuk_report .= ', Minggu: '.$no_minggu;
    $tajuk_report .= '<br>Dari: '.$mula2.', Hingga: '.$tamat2;
    $extra = "AND a.tarikh BETWEEN CAST('$mula' AS DATE) AND CAST('$tamat' AS DATE)";
    $extra2 = "AND a.tarikh BETWEEN CAST('$mula' AS DATE) AND CAST('$tamat' AS DATE)";
    $extraBaki = "AND tarikhBaki BETWEEN CAST('$mula' AS DATE) AND CAST('$tamat' AS DATE)";
}

if($_GET['tahun'] == NULL && $_GET['bulan'] == NULL) $extraBaki = "";


$q_tahun = "SELECT DISTINCT year(dateRecords) 'tahun' FROM accountsRecords WHERE id_masjid = $id_masjid AND typeModule = $training";
$qq = mysqli_query($bd2, $q_tahun) or die(mysqli_error($bd2));
$q_row = mysqli_fetch_assoc($qq);

?>
<!DOCTYPE html>
<html>
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0RCF4Z4X27"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-0RCF4Z4X27');
    </script>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="stylesheet" href="../../../Masjid/bootstrap_latest/css/bootstrap.css" />
    <link rel="stylesheet" href="../../../Masjid/vendors/font-awesome/css/font-awesome.css">
    <style>
        .garis1 {
            border-bottom: 1px solid black;
        }
        .kotak1 {
            border: 1px solid black;
        }
        .isi-padat {
            max-width: fit-content;
        }
        hr {
            border-color: black;
        }
        input[type=checkbox] {
            transform: scale(2.5);
        }
        span.email {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media print {
            div.portrait, div.landscape {
                margin: 10px auto;
                padding: 10mm;
                border: solid 1px black;
                overflow: hidden;
                page-break-after: always;
                background: white;
            }
            div.portrait {
                width: 190mm;
                height: 276mm;
            }
            div.landscape {
                width: 255mm;
                height: 190mm;
            }
            body {
                background: none;
                -ms-zoom: 1.665;
            }
            div.portrait, div.landscape {
                margin: 0;
                padding: 0;
                border: none;
                background: none;
            }
            div.landscape {
                transform: rotate(270deg) translate(-260mm, 0);
                transform-origin: 0 0;
            }
        }
        body {
            margin: 0;
            font-family: arial, sans-serif;
            font-weight: bold;
            border-collapse: collapse;
            width: 100%;
        }

        .kelasthlebar {
            width: 350px;
        }

        .kelastd, .kelasth {
            border: 1px solid #dddddd;
            text-align2: left;
            padding: 8px;
        }

        .kelastr tr:nth-child(even) {
            background-color: #dddddd;
        }
        #kepala {
            width: 600px;
        }
        #table_tarikh {
            width: 600px;
        }
        #table_tarikh tr {
            border: none;
        }
        #table_tarikh th {
            border: none;
        }
        #table_tarikh td {
            border: none;
        }
        @media print {

            table {
                font-size: small;
            }

            .printPageButton {
                display: none;
            }
            #butang_pering{
                display: none;
            }
            footer {page-break-after: always;}
            .kelastd, .kelasth {
                border: none;
                width: max-content;
            }

            .kelastr tr:nth-child(even) {
                background-color: transparent;
                width: max-content;
            }
        }
    </style>
    <?php if($training == 2){ ?>
    <style type="text/css" media="print">
    * { 
        /*
        display: none; 
       */ 
    }
    </style>
    <?php } ?>
    <?php include("loader.php"); ?>
</head>
<body>
<div class="container-fluid printPageButton" align="center">
    <?php if($_GET['sub'] != 'baucar') { ?>
        <div class="row justify-content-md-center form-group">
            <div class="col-md-auto col-4"><label>Bulan:</label><br/>
                Dari:<select id="bulan1" name="bulan1" class="form-control" onchange="tunjuk_minggu($('#tahun').val(), this.value)">
                    <option></option>
                    <option style="display: none" value="minggu" <?php echo $_GET['bulan'] == "minggu" ? 'selected' : ''; ?>>Minggu</option>
                    <?php for($i=1; $i<=12; $i++) { $bulan = $i; if($i<10) $bulan = '0'.$i; ?><option value="<?php echo($bulan); ?>" <?php echo $_GET['bulan1'] == $bulan ? 'selected' : NULL; ?>><?php echo fungsi_tarikh('2000-'.$bulan.'-01 10:00:00', 8, 99); ?></option><?php } ?>
                </select>
                Hingga:<select id="bulan2" name="bulan2" class="form-control" onchange="tunjuk_minggu($('#tahun').val(), this.value)">
                    <option></option>
                    <option style="display: none" value="minggu" <?php echo $_GET['bulan'] == "minggu" ? 'selected' : ''; ?>>Minggu</option>
                    <?php for($i=1; $i<=12; $i++) { $bulan = $i; if($i<10) $bulan = '0'.$i; ?><option value="<?php echo($bulan); ?>" <?php echo $_GET['bulan2'] == $bulan ? 'selected' : NULL; ?>><?php echo fungsi_tarikh('2000-'.$bulan.'-01 10:00:00', 8, 99); ?></option><?php } ?>
                </select>
            </div>
            <div class="col-md-auto col-4"><label>Tahun:</label>
                <select id="tahun" name="tahun" class="form-control" onchange="tunjuk_minggu(this.value, $('#bulan').val())">
                <option value=""></option>
                    <?php do { 
                            if($q_row['tahun'] != NULL){
                        ?>
                            <option value="<?php echo($q_row['tahun']); ?>" <?php echo $q_row['tahun'] == $tahun ? 'selected' : ''; ?>><?php echo($q_row['tahun']); ?></option>
                        <?php 
                            }else if($q_row['tahun'] == NULL){
                        ?>
                                <!-- <option value="2023">2023</option> -->
                        <?php
                            }
                    } while($q_row = mysqli_fetch_assoc($qq)); ?>
                </select>
            </div>
            <div id="tunggu_minggu" class="col-md-auto col-4 sk-circle" style="display: none" align="center">
                <div class="sk-circle1 sk-child"></div>
                <div class="sk-circle2 sk-child"></div>
                <div class="sk-circle3 sk-child"></div>
                <div class="sk-circle4 sk-child"></div>
                <div class="sk-circle5 sk-child"></div>
                <div class="sk-circle6 sk-child"></div>
                <div class="sk-circle7 sk-child"></div>
                <div class="sk-circle8 sk-child"></div>
                <div class="sk-circle9 sk-child"></div>
                <div class="sk-circle10 sk-child"></div>
                <div class="sk-circle11 sk-child"></div>
                <div class="sk-circle12 sk-child"></div>
            </div>
            <div id="tunjuk_minggu" class="col-md-auto col-4" style="display: none"></div>
            <?php if($_GET['sub'] == 'penyata_tunai') { ?>
                <div class="col-md-auto col-6">
                    <label>Laporan:</label>
                    <select id="laporan" name="laporan" class="form-control">
                        <option></option>
                        <option value="1">Ringkas</option>
                        <option value="2">Terperinci</option>
                    </select>
                </div>
            <?php } ?>
            <div class="col-md-auto col-6">
                <?php if($_GET['trigger'] == 1){ ?>
                    <button type="button" onClick="document.location.href='utama.php?view=admin&action=kewangan&newModul=1&training=<?php echo($_GET['training']); ?>&subModul=8&subModul2=<?php echo($_GET['subModul2']); ?>&sub=kedudukan_kewangan_sebenars&trigger=1&tabungan=<?php echo($_GET['tabungan']); ?>&data=raw&tahun='+$('#tahun').val()+'&bulan1='+$('#bulan1').val()+'&bulan2='+$('#bulan2').val()" class="btn btn-primary btn-block" style="margin-top: 30px; text-align: center; font-size: 14pt; font-weight: bold">Lihat</button>
                <?php }else{ ?>
                    <button type="button" onClick="document.location.href='utama.php?view=admin&action=kewangan&newModul=1&training=<?php echo($_GET['training']); ?>&subModul=8&subModul2=<?php echo($_GET['subModul2']); ?>&sub=kedudukan_kewangan_sebenar&tabungan=<?php echo($_GET['tabungan']); ?>&data=raw&tahun='+$('#tahun').val()+'&bulan1='+$('#bulan1').val()+'&bulan2='+$('#bulan2').val()" class="btn btn-primary btn-block" style="margin-top: 30px; text-align: center; font-size: 14pt; font-weight: bold">Lihat</button>
                <?php }?>
            </div>
        </div>
    <?php } ?>
    <?php if($_GET['mode'] != 1) { ?>
        <div class="row justify-content-md-center form-group">
            <div class="col-md-6 col-12">
                <?php if($_GET['subModul2'] != NULL) { ?><a href="utama.php?view=admin&action=kewangan&newModul=1&training=<?php echo($_GET['training']); ?>"><button class="btn btn-info" style="text-align: center; font-size: 14pt; font-weight: bold">Menu Utama Kewangan</button></a><?php } ?>
                <?php // if($training != 2) { ?><button class="btn btn-success" id="butang_pering" style="text-align: center; font-size: 14pt; font-weight: bold" onclick="window.print()">Cetak Halaman Ini</button><?php // } ?>
            </div>
        </div>
    <?php } ?>
</div>
<div id="tunggu" class="col-md-12 col-12 sk-circle" style="display: none" align="center">
    <div class="sk-circle1 sk-child"></div>
    <div class="sk-circle2 sk-child"></div>
    <div class="sk-circle3 sk-child"></div>
    <div class="sk-circle4 sk-child"></div>
    <div class="sk-circle5 sk-child"></div>
    <div class="sk-circle6 sk-child"></div>
    <div class="sk-circle7 sk-child"></div>
    <div class="sk-circle8 sk-child"></div>
    <div class="sk-circle9 sk-child"></div>
    <div class="sk-circle10 sk-child"></div>
    <div class="sk-circle11 sk-child"></div>
    <div class="sk-circle12 sk-child"></div>
</div>
<div id="pering_report" class="potrait container-fluid">
    <?php include("accounts/ajax/includes/".$_GET['sub'].".php"); ?>
</div>
<?php if($_GET['sub'] == 'penyata_kewangan' && $_GET['data_view'] == 'raw') {
    $q = "SELECT c.kategori_akaun 'kategori_akaun', SUM(a.amaun) 'jumlah' FROM kew_rekod_akaun a, kew_jenis_akaun b, kew_kategori_akaun c WHERE a.id_akaun = b.id_akaun AND b.id_kategori_akaun = c.id_kategori_akaun AND b.id_masjid = $id_masjid AND c.jenis_akaun = 1 $extra GROUP BY c.id_kategori_akaun";
    $qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $q_row = mysqli_fetch_assoc($qq);

    $q2 = "SELECT c.kategori_akaun 'kategori_akaun', SUM(a.amaun) 'jumlah' FROM kew_rekod_akaun a, kew_jenis_akaun b, kew_kategori_akaun c WHERE a.id_akaun = b.id_akaun AND b.id_kategori_akaun = c.id_kategori_akaun AND b.id_masjid = $id_masjid AND c.jenis_akaun = 2 $extra GROUP BY c.id_kategori_akaun";
    $qq2 = mysqli_query($bd2, $q2) or die(mysqli_error($bd2));
    $q_row2 = mysqli_fetch_assoc($qq2);

    $q_dapat = "SELECT SUM(a.amaun) 'jumlah_dapat' FROM kew_rekod_akaun a, kew_jenis_akaun b, kew_kategori_akaun c WHERE a.id_akaun = b.id_akaun AND b.id_kategori_akaun = c.id_kategori_akaun AND b.id_masjid = $id_masjid AND c.jenis_akaun = 1 $extra2 GROUP BY c.jenis_akaun";
    $qq_dapat = mysqli_query($bd2, $q_dapat) or die(mysqli_error($bd2));
    $q_row_dapat = mysqli_fetch_assoc($qq_dapat);

    $q_belanja = "SELECT SUM(a.amaun) 'jumlah_belanja' FROM kew_rekod_akaun a, kew_jenis_akaun b, kew_kategori_akaun c WHERE a.id_akaun = b.id_akaun AND b.id_kategori_akaun = c.id_kategori_akaun AND b.id_masjid = $id_masjid AND c.jenis_akaun = 2 $extra2 GROUP BY c.jenis_akaun";
    $qq_belanja = mysqli_query($bd2, $q_belanja) or die(mysqli_error($bd2));
    $q_row_belanja = mysqli_fetch_assoc($qq_belanja);

    //echo($q_dapat.'<br />'.$q_belanja);

    $baki_sebelum_pendapatan = $q_row_dapat['jumlah_dapat'] - $q_row_belanja['jumlah_belanja'];
    if($baki_sebelum_pendapatan < 0) {
        $baki_sebelum_perbelanjaan = $baki_sebelum_pendapatan * -1;
        //$baki_sebelum_perbelanjaan = number_format($baki_sebelum_pendapatan, 2);
    }
    ?>
    <div align="center"><h3><?php echo($_SESSION['nama_masjid']); ?></h3></div><br />
    <div align="center" style="border: solid"><h3>Penyata Pendapatan dan Perbelanjaan<?php echo($tajuk_report); ?></h3></div><br />
    <table width="100%" border="1" cellpadding="5" cellspacing="0" id="bah_a">
        <tr>
            <th colspan="2" align="center" class="isi-padat"><h4>PENDAPATAN</h4></th>
            <th colspan="2" align="center" class="isi-padat"><h4>PERBELANJAAN</h4></th>
        </tr>
        <tr>
            <th width="35%" align="center" class="isi-padat">Butiran</th>
            <th width="15%" align="center" class="isi-padat">RM</th>
            <th width="35%" align="center" class="isi-padat">Butiran</th>
            <th width="15%" align="center" class="isi-padat">RM</th>
        </tr>
        <tr>
            <td colspan="2" width="50%" class="isi-padat" valign="top">
                <table width="100%" border="1" cellpadding="5" cellspacing="0">
                    <?php if($baki_sebelum_pendapatan >= 0 && ($_GET['tahun'] != NULL || $_GET['bulan'] != NULL)) {
                        $jum = $jum + $baki_sebelum_pendapatan;
                        ?>
                        <tr>
                            <td width="70%" align="left" class="isi-padat">BAKI PENDAPATAN SEBELUM</td>
                            <td width="30%" align="right" class="isi-padat"><?php echo number_format($baki_sebelum_pendapatan, 2); ?></td>
                        </tr>
                    <?php } ?>
                    <?php do { ?>
                        <tr>
                            <td width="70%" align="left" class="isi-padat"><?php echo($q_row['kategori_akaun']); ?></td>
                            <td width="30%" align="right" class="isi-padat"><?php echo number_format($q_row['jumlah'], 2); ?></td>
                        </tr>
                        <?php $jum = $jum + $q_row['jumlah']; } while($q_row = mysqli_fetch_assoc($qq)); ?>
                </table>
            </td>
            <td colspan="2" width="50%" class="isi-padat" valign="top">
                <table width="100%" border="1" cellpadding="5" cellspacing="0">
                    <?php if($baki_sebelum_perbelanjaan != NULL && ($_GET['tahun'] != NULL || $_GET['bulan'] != NULL)) {
                        $jum2 = $jum2 + $baki_sebelum_perbelanjaan;
                        ?>
                        <tr>
                            <td width="70%" align="left" class="isi-padat">BAKI PERBELANJAAN SEBELUM</td>
                            <td width="30%" align="right" class="isi-padat"><?php echo number_format($baki_sebelum_perbelanjaan, 2); ?></td>
                        </tr>
                    <?php } ?>
                    <?php do { ?>
                        <tr>
                            <td width="70%" align="left" class="isi-padat"><?php echo($q_row2['kategori_akaun']); ?></td>
                            <td width="30%" align="right" class="isi-padat"><?php echo number_format($q_row2['jumlah'], 2); ?></td>
                        </tr>
                        <?php $jum2 = $jum2 + $q_row2['jumlah']; } while($q_row2 = mysqli_fetch_assoc($qq2)); ?>
                </table>
            </td>
        </tr>
        <tr>
            <th width="35%" align="right" class="isi-padat"><h4>JUMLAH PENDAPATAN</h4></th>
            <th width="15%" align="right" class="isi-padat"><h4><?php echo number_format($jum, 2); ?></h4></th>
            <th width="35%" align="right" class="isi-padat"><h4>JUMLAH PERBELANJAAN</h4></th>
            <th width="15%" align="right" class="isi-padat"><h4><?php echo number_format($jum2, 2); ?></h4></th>
        </tr>
        <tr>
            <th width="35%" align="right" class="isi-padat"><h4>BAKI BERSIH</h4></th>
            <th width="15%" align="right" class="isi-padat"><h4><?php echo number_format($jum - $jum2, 2); ?></h4></th>
            <th width="35%" align="right" class="isi-padat"><h4>&nbsp;</h4></th>
            <th width="15%" align="right" class="isi-padat"><h4>&nbsp;</h4></th>
        </tr>
    </table>
    <br />
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tbody>
        <tr>
            <td width="40%" align="center" valign="top" class="kotak1"><p>Disemak oleh:</p>
                <p>&nbsp;</p>
                <p>.......................................................</p>
                <p>&nbsp;</p></td>
            <td width="20%" valign="top">&nbsp;</td>
            <td width="40%" align="center" valign="top" class="kotak1"><p>Disahkan oleh:</p>
                <p>&nbsp;</p>
                <p>........................................................</p></td>
        </tr>
        </tbody>
    </table>
<?php } ?>
<?php if($_GET['sub'] == 'penyata_tunai' && $_GET['data_view'] == 'raw') {
    $id_akaun_regu = $_GET['id_akaun'];
    $nama_tabung = "SELECT CONCAT(IF(kod_akaun IS NOT NULL, CONCAT('(', kod_akaun, ') '), ''), nama_akaun) 'nama_akaun' FROM kew_jenis_akaun WHERE id_akaun = $id_akaun_regu";
    $qq_nama = mysqli_query($bd2, $nama_tabung) or die(mysqli_error($bd2));
    $q_row3 = mysqli_fetch_assoc($qq_nama);

    if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) {
        $nama_pilih = "SELECT CONCAT('PINDAHAN KE ', CONCAT(IF(kod_akaun IS NOT NULL, CONCAT('(', kod_akaun, ') '), ''), nama_akaun)) 'nama_akaun' FROM kew_jenis_akaun WHERE id_akaun = d.id_akaun_regu";
        $pilih = "IF(d.pindah = $id_akaun_regu, ($nama_pilih), CONCAT(IF(b.kod_akaun IS NOT NULL, CONCAT('(', b.kod_akaun, ') '), ''), b.nama_akaun)) 'nama_akaun', ROUND(d.amaun_regu, 2) 'jumlah', DATE_FORMAT(a.tarikh, '%d / %m / %Y') 'tarikh', a.tarikh 'tarikh2', a.id_rekod 'ID Rekod'";
        $pilih2 = "";
        $pilih3 = ", IF(d.pindah = $id_akaun_regu, 1, 2) 'jenis_rekod'";
        $lebar_span = 3;
        $jumlah_span = 'colspan="2"';
    }

    if($_GET['laporan'] == 1) {
        $nama_pilih = "SELECT CONCAT('PINDAHAN KE ', x.kategori_akaun) FROM kew_jenis_akaun z, kew_kategori_akaun x WHERE z.id_kategori_akaun = x.id_kategori_akaun AND z.id_akaun = d.id_akaun_regu";
        $pilih = "IF(d.pindah = $id_akaun_regu, ($nama_pilih), c.kategori_akaun) 'nama_akaun', ROUND(SUM(d.amaun_regu), 2) 'jumlah'";
        $pilih2 = "GROUP BY c.id_kategori_akaun";
        $lebar_span = 2;
    }

    $debug_test = 0;

    $q = "SELECT $pilih $pilih3 FROM kew_rekod_akaun a, kew_jenis_akaun b, kew_kategori_akaun c, kew_rekod_akaun_item d WHERE a.id_akaun = b.id_akaun AND b.id_kategori_akaun = c.id_kategori_akaun AND a.id_rekod = d.id_rekod AND b.id_masjid = $id_masjid AND d.id_akaun_regu = $id_akaun_regu AND (c.jenis_akaun = 1 OR d.pindah != d.id_akaun_item) $extra $pilih2 ORDER BY a.tarikh ASC";
    $qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $q_row = mysqli_fetch_assoc($qq);

    $q2 = "SELECT $pilih $pilih3 FROM kew_rekod_akaun a, kew_jenis_akaun b, kew_kategori_akaun c, kew_rekod_akaun_item d WHERE a.id_akaun = b.id_akaun AND b.id_kategori_akaun = c.id_kategori_akaun AND a.id_rekod = d.id_rekod AND b.id_masjid = $id_masjid AND (d.id_akaun_regu = $id_akaun_regu AND c.jenis_akaun = 2 OR d.pindah = $id_akaun_regu) $extra $pilih2 ORDER BY a.tarikh ASC";
    $qq2 = mysqli_query($bd2, $q2) or die(mysqli_error($bd2));
    $q_row2 = mysqli_fetch_assoc($qq2);

    $q_masuk = "SELECT CONCAT(IF(b.kod_akaun IS NOT NULL, CONCAT('(', b.kod_akaun, ') '), ''), b.nama_akaun) 'nama_akaun', ROUND(SUM(d.amaun_regu), 2) 'jumlah' FROM kew_rekod_akaun a, kew_jenis_akaun b, kew_kategori_akaun c, kew_rekod_akaun_item d WHERE a.id_akaun = b.id_akaun AND b.id_kategori_akaun = c.id_kategori_akaun AND a.id_rekod = d.id_rekod AND b.id_masjid = $id_masjid AND d.id_akaun_regu = $id_akaun_regu AND (c.jenis_akaun = 1 OR d.pindah != d.id_akaun_item) $extra2 GROUP BY b.id_masjid";
    $qq_masuk = mysqli_query($bd2, $q_masuk) or die(mysqli_error($bd2));
    $q_row_masuk = mysqli_fetch_assoc($qq_masuk);

    $q_keluar = "SELECT CONCAT(IF(b.kod_akaun IS NOT NULL, CONCAT('(', b.kod_akaun, ') '), ''), b.nama_akaun) 'nama_akaun', ROUND(SUM(d.amaun_regu), 2) 'jumlah' FROM kew_rekod_akaun a, kew_jenis_akaun b, kew_kategori_akaun c, kew_rekod_akaun_item d WHERE a.id_akaun = b.id_akaun AND b.id_kategori_akaun = c.id_kategori_akaun AND a.id_rekod = d.id_rekod AND b.id_masjid = $id_masjid AND (d.id_akaun_regu = $id_akaun_regu AND c.jenis_akaun = 2 OR d.pindah = $id_akaun_regu) $extra2 GROUP BY b.id_masjid";
    $qq_keluar = mysqli_query($bd2, $q_keluar) or die(mysqli_error($bd2));
    $q_row_keluar = mysqli_fetch_assoc($qq_keluar);

    if($id_akaun_regu != NULL) $extraAkaunRegu = "id_akaun = $id_akaun_regu AND";

    $q_awal = "SELECT IFNULL(ROUND(SUM(baki_awal), 2), 0) 'baki_awal', DATE_FORMAT(tarikhBaki, '%d / %m / %Y') 'tarikhBaki' FROM kew_jenis_akaun WHERE $extraAkaunRegu id_masjid = $id_masjid $extraBaki";
    $qq_awal = mysqli_query($bd2, $q_awal) or die(mysqli_error($bd2));
    $q_row_awal = mysqli_fetch_assoc($qq_awal);
    $baki_awal = $q_row_awal['baki_awal'];
    $tarikhBaki = $q_row_awal['tarikhBaki'];
    if($baki_awal < 0) $baki_awal2 = $baki_awal * -1;
    $baki_masuk = $q_row_awal['baki_awal'] + $q_row_masuk['jumlah'] - $q_row_keluar['jumlah'];

    if($baki_masuk < 0) {
        $baki_keluar = $baki_masuk * -1;
        //$baki_keluar = $baki_keluar;
    }
    if($_GET['testDev'] == 1) echo($baki_keluar);
    if($_GET['dev'] == 9999) echo($baki_masuk.' = '.$q_row_awal['baki_awal'].' + '.$q_row_masuk['jumlah'].' - '.$q_row_keluar['jumlah']);
    //echo($q . '<br>' . $q2);
    ?>
    <?php if($debug_test == 1) { ?>
        <h1 style="display: none"><?php echo($q.' - '.$q2); ?></h1>
        <h1 style="display: none"><?php echo($q_row_masuk['jumlah'].' - '.$q_row_keluar['jumlah'].' - '.$q_row_awal['baki_awal']); ?></h1>
    <?php } ?>
    <div align="center"><h3><?php echo($_SESSION['nama_masjid']); ?></h3></div><br />
    <div align="center" style="border: solid"><h3>Penyata -  <?php echo($q_row3['nama_akaun']); ?><?php echo($tajuk_report); ?></h3></div><br />
    <table width="100%" border="1" cellpadding="5" cellspacing="0" id="bah_a">
        <tr>
            <th width="50%" colspan="<?php echo($lebar_span); ?>" align="center" class="isi-padat"><h4>Duit Masuk</h4></th>
            <th width="50%" colspan="<?php echo($lebar_span); ?>" align="center" class="isi-padat"><h4>Duit Keluar</h4></th>
        </tr>
        <tr>
            <td colspan="<?php echo($lebar_span); ?>" width="50%" class="isi-padat" valign="top">
                <table width="100%" border="1" cellpadding="5" cellspacing="0">
                    <tr>
                        <?php if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) { ?><th align="center" class="isi-padat">Tarikh</th><?php } ?>
                        <th align="center" class="isi-padat">Butiran</th>
                        <?php if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) { ?><th align="center" class="isi-padat">No. Resit</th><?php } ?>
                        <th align="center" class="isi-padat">RM</th>
                    </tr>
                    <?php if($baki_awal > 0 && (($baki_masuk == NULL && $baki_keluar == NULL) || ($_GET['tahun'] == NULL && $_GET['bulan'] == NULL))) {
                        $jum = $jum + $baki_awal;
                        ?>
                        <tr><?php if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) { ?><td align="left" class="isi-padat"><?php echo($tarikhBaki); ?></td><?php } ?>
                            <td align="left" class="isi-padat">BAKI PERMULAAN</td>
                            <?php if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) { ?><td></td><?php } ?>
                            <td align="right" class="isi-padat"><?php echo number_format($baki_awal, 2); ?></td>
                        </tr>
                    <?php } ?>
                    <?php if($baki_masuk > 0 && ($_GET['tahun'] != NULL || $_GET['bulan'] != NULL)) {
                        $jum = $jum + $baki_masuk;
                        ?>
                        <tr><?php if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) { ?><td align="left" class="isi-padat"><?php echo('01 / '.$bulan.' / '.$tahun) ?></td><?php } ?>
                            <td align="left" class="isi-padat">BAKI DUIT MASUK SEBELUM</td>
                            <?php if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) { ?><td></td><?php } ?>
                            <td align="right" class="isi-padat"><?php echo number_format($baki_masuk, 2); ?></td>
                        </tr>
                    <?php } ?>
                    <?php do { ?>
                        <tr><?php if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) { ?><td align="left" class="isi-padat"><?php echo($q_row['tarikh']); ?></td><?php } ?>
                            <td align="left" class="isi-padat"><?php echo($q_row['nama_akaun']); ?></td>
                            <?php if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) { ?><td align="left" class="isi-padat"><?php if($q_row['jenis_rekod'] == 2) { ?><a target="_blank" href="utama.php?view=admin&action=kewangan&data=raw&module=view_kewangan&sub=baucar&id_rekod=<?php echo($q_row['ID Rekod']); ?>"><?php echo($_SESSION['kod_masjid']); ?> / <?php fungsi_tarikh($q_row['tarikh2'], 10, 2); ?> / <?php echo($q_row['ID Rekod']); ?></a><?php } ?></td><?php } ?>
                            <td align="right" class="isi-padat"><?php echo number_format($q_row['jumlah'], 2); ?></td>
                        </tr>
                        <?php $jum = $jum + $q_row['jumlah']; } while($q_row = mysqli_fetch_assoc($qq)); ?>
                </table>
            </td>
            <td colspan="<?php echo($lebar_span); ?>" width="50%" class="isi-padat" valign="top">
                <table width="100%" border="1" cellpadding="5" cellspacing="0">
                    <tr>
                        <?php if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) { ?><th align="center" class="isi-padat">Tarikh</th><?php } ?>
                        <th align="center" class="isi-padat">Butiran</th>
                        <?php if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) { ?><th align="center" class="isi-padat">No. Baucar</th><?php } ?>
                        <th align="center" class="isi-padat">RM</th>
                    </tr>
                    <?php if($baki_awal2 != NULL && (($baki_masuk == NULL && $baki_keluar == NULL) || ($_GET['tahun'] == NULL && $_GET['bulan'] == NULL))) {
                        $jum2 = $jum2 + $baki_awal2;
                        ?>
                        <tr><?php if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) { ?><td align="left" class="isi-padat"><?php echo($tarikhBaki); ?></td><?php } ?>
                            <td align="left" class="isi-padat">BAKI PERMULAAN</td>
                            <td align="right" class="isi-padat"><?php echo ($baki_awal2); ?></td>
                        </tr>
                    <?php } ?>
                    <?php if($baki_keluar != NULL && ($_GET['tahun'] != NULL || $_GET['bulan'] != NULL)) {
                        $jum2 = $jum2 + $baki_keluar;
                        if($_GET['testDev'] == 1) echo($jum2);
                        ?>
                        <tr><?php if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) { ?><td align="left" class="isi-padat"><?php echo('01, '.$bulan.', '.$tahun) ?></td><?php } ?>
                            <td align="left" class="isi-padat">BAKI DUIT KELUAR SEBELUM</td>
                            <?php if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) { ?><td></td><?php } ?>
                            <td align="right" class="isi-padat"><?php echo number_format($baki_keluar, 2); ?></td>
                        </tr>
                    <?php } ?>
                    <?php do { ?>
                        <tr><?php if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) { ?><td align="left" class="isi-padat"><?php echo($q_row2['tarikh']); ?></td><?php } ?>
                            <td align="left" class="isi-padat"><?php echo($q_row2['nama_akaun']); ?></td>
                            <?php if($_GET['laporan'] == 2 || $_GET['laporan'] == NULL) { ?><td align="left" class="isi-padat"><?php if($q_row2['jenis_rekod'] == 2) { ?><a target="_blank" href="utama.php?view=admin&action=kewangan&data=raw&module=view_kewangan&sub=baucar&id_rekod=<?php echo($q_row2['ID Rekod']); ?>"><?php echo($_SESSION['kod_masjid']); ?> / <?php fungsi_tarikh($q_row2['tarikh2'], 10, 2); ?> / <?php echo($q_row2['ID Rekod']); ?></a><?php } ?></td><?php } ?>
                            <td align="right" class="isi-padat"><?php echo number_format($q_row2['jumlah'], 2); ?></td>
                        </tr>
                        <?php $jum2 = $jum2 + $q_row2['jumlah']; } while($q_row2 = mysqli_fetch_assoc($qq2)); ?>
                </table>
            </td>
        </tr>
        <tr>
            <th <?php echo($jumlah_span); ?> width="35%" align="right" class="isi-padat"><h4>JUMLAH ALIRAN MASUK</h4></th>
            <th width="15%" align="right" class="isi-padat"><h4><?php echo number_format($jum, 2); ?></h4></th>
            <th <?php echo($jumlah_span); ?> width="35%" align="right" class="isi-padat"><h4>JUMLAH ALIRAN KELUAR</h4></th>
            <th width="15%" align="right" class="isi-padat"><h4><?php echo number_format($jum2, 2); ?></h4></th>
        </tr>
        <tr>
            <th <?php echo($jumlah_span); ?> width="35%" align="right" class="isi-padat"><h4>BAKI BERSIH</h4></th>
            <th width="15%" align="right" class="isi-padat"><h4><?php echo number_format($jum - $jum2, 2); ?></h4></th>
            <th <?php echo($jumlah_span); ?> width="35%" align="right" class="isi-padat"><h4>&nbsp;</h4></th>
            <th width="15%" align="right" class="isi-padat"><h4>&nbsp;</h4></th>
        </tr>
    </table>
    <br />
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tbody>
        <tr>
            <td width="40%" align="center" valign="top" class="kotak1"><p>Disemak oleh:</p>
                <p>&nbsp;</p>
                <p>.......................................................</p>
                <p>&nbsp;</p></td>
            <td width="20%" valign="top">&nbsp;</td>
            <td width="40%" align="center" valign="top" class="kotak1"><p>Disahkan oleh:</p>
                <p>&nbsp;</p>
                <p>........................................................</p></td>
        </tr>
        </tbody>
    </table>
<?php } ?>
<script src="../../../Masjid/bootstrap_latest/jquery.js" integrity2="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin2="anonymous"></script>
<script src="../../../Masjid/bootstrap_latest/popper.js" integrity2="sha512-3npORiJBjCw8YewByo9prUHQKH+JF9EGu6rc2IQA3GdV/V5TUo1JibA3g3jAeNOdToEh2rHkhswWJcOo6ljuPQ==" crossorigin2="anonymous"></script>
<script src="../../../Masjid/bootstrap_latest/js/bootstrap.js" integrity2="sha512-2nWfr/l1RS9Cj5j3i7Shr8mcGA+CRKbmnhSKX7aDNsZvCn6xX2NpT4FHEhxOT8oaq9mwMdu9CNQ65xi41sJu2A==" crossorigin2="anonymous"></script>
<script id="form_ajax">
    function page_ajax(a, b, c) {
        $('#'+b).html('');
        $('#'+b).hide();
        $('#'+c).show();
        $.ajax({
            url:a,
            success: function(data)
            {
                $('#'+c).hide();
                $('#'+b).html(data);
                $('#'+b).fadeIn('slow');
                eval(document.getElementById('form_ajax').innerHTML);
            }
        });
    }
    function tunjuk_minggu(tahun, bulan) {
        $(document).ready(function(){
            if(tahun != "" && bulan == "minggu") {
                page_ajax('get_week.php?sel=minggu&tahun='+tahun, 'tunjuk_minggu', 'tunggu_minggu');
            }
            else {
                $('#tunjuk_minggu').html('');
                $('#tunjuk_minggu').hide();
            }
        });
    }
    var jum_buka_akaun = document.getElementById('jum_buka_akaun').value;
    var jum_pendapatan = document.getElementById('jum_pendapatan').value;
    var jum_perbelanjaan = document.getElementById('jum_perbelanjaan').value;
    var jum_baki = document.getElementById('jum_baki').value;

    document.getElementById('output_jum_buka_akaun').innerHTML = jum_buka_akaun;
    document.getElementById('output_jum_buka_akaun1').innerHTML = jum_buka_akaun;
    document.getElementById('output_jum_pendapatan').innerHTML = jum_pendapatan;
    document.getElementById('output_jum_perbelanjaan').innerHTML = jum_perbelanjaan;
    document.getElementById('output_jum_baki').innerHTML = jum_baki;
    console.log(jum_pendapatan);
    console.log(jum_perbelanjaan);
    var jpendapatan = parseFloat(jum_pendapatan.replace(",", ""));
    var jperbelanjaan = parseFloat(jum_perbelanjaan.replace(",", ""));
    var jbaki = parseFloat(jum_buka_akaun.replace(",", ""));
    console.log(jpendapatan);
    console.log(jperbelanjaan);
    console.log(jbaki);
    
    var jum_baki_1;
    var jum_baki_2;
    var percentage_pendapatan;
    
    function commafy( num ) {
        var str = num.toString().split('.');
        if (str[0].length >= 5) {
            str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
        }
        if (str[1] && str[1].length >= 5) {
            str[1] = str[1].replace(/(\d{3})/g, '$1 ');
        }
        return str.join('.');
    }
    
    if(jpendapatan > jperbelanjaan){
        
        jum_baki_1 = jpendapatan - jperbelanjaan;
        percentage_pendapatan = (jum_baki_1 / jbaki) * 100;
        
        document.getElementById('percentage_pendapatan').innerHTML = percentage_pendapatan.toFixed(2);
        document.getElementById('jum_baki_1').innerHTML = commafy(jum_baki_1.toFixed(2));
        document.getElementById('rowSurplus').style.display = 'table-row';
        document.getElementById('rowDeficit').style.display = 'none';
    }else if(jperbelanjaan > jpendapatan){
        
        jum_baki_1 = jperbelanjaan - jpendapatan;
        jum_baki_2 = jpendapatan - jperbelanjaan;
        percentage_pendapatan = (jum_baki_1 / jbaki) * 100;
        
        document.getElementById('percentage_perbelanjaan').innerHTML = percentage_pendapatan.toFixed(2);
        document.getElementById('jum_baki_2').innerHTML = commafy(jum_baki_2.toFixed(2));
        document.getElementById('rowDeficit').style.display = 'table-row';
        document.getElementById('rowSurplus').style.display = 'none';
    }

    // console.log(jum_pendapatan);
</script>
<?php
if(file_exists("accounts/js-page/sub_".$_GET['subModul'].".php")) include("accounts/js-page/sub_".$_GET['subModul'].".php");
include("accounts/js-page/default.php");
?>
</body>
</html>