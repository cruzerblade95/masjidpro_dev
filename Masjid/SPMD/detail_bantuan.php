<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include('../daftar_online/connection.php');
//include('../fungsi.php');
$bayarTerus = 0;
include("../payment_api.php");
function e($a) {
    global $bd2;
    $val = mysqli_real_escape_string($bd2, $a);
    return $val;
}

if($_GET['bayaran'] == "wakaf") goto selesaiWakaf;

if($_GET['mode_derma'] == 2) {
    $q = "SELECT * FROM kempen_masjid WHERE aktif = 1 AND nama_kempen LIKE '%Kotak Peduli Kariah%'";
    $q1 = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $r = mysqli_fetch_assoc($q1);
    $jum_kotak = $r['unit'];
    $nama_kempen = $r['nama_kempen'];

    $q = "SELECT * FROM sej6x_bayar_online WHERE jenis_bayaran LIKE '%Kotak Peduli Kariah%' AND status_bayaran = 1 AND id_masjid = ".$_GET['id_masjid'];
    $q1 = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $r = mysqli_fetch_assoc($q1);
    $n = mysqli_num_rows($q1);
    $bil_dapat = $n;
    $baki_kotak = $jum_kotak - $n;

}

if($_GET['mode_derma'] == 4) {
    $q = "SELECT * FROM kempen_masjid WHERE aktif = 1 AND nama_kempen LIKE '%Kotak Peduli Raya%'";
    $q1 = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $r = mysqli_fetch_assoc($q1);
    $jum_kotak = $r['unit'];
    $nama_kempen = $r['nama_kempen'];

    $q = "SELECT * FROM sej6x_bayar_online WHERE jenis_bayaran LIKE '%Kotak Peduli Raya%' AND status_bayaran = 1 AND id_masjid = ".$_GET['id_masjid'];
    $q1 = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $r = mysqli_fetch_assoc($q1);
    $n = mysqli_num_rows($q1);
    $bil_dapat = $n;
    $baki_kotak = $jum_kotak - $n;

}

if($_GET['sumbang'] != NULL && $_GET['id_masjid'] != NULL && is_numeric($_GET['id_masjid'])) {
    $id_masjid_url = $_GET['id_masjid'];
    if(!is_numeric($id_masjid_url)) $id_masjid_url = "";
    if($id_masjid_url != NULL) {
        $sql = "SELECT * FROM sej6x_data_masjid WHERE id_masjid = " . e($id_masjid_url);
        $sqlquery = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
        $result = mysqli_fetch_assoc($sqlquery);
        $num_row = mysqli_num_rows($sqlquery);
        $nama_masjid = $result['nama_masjid'];
        $id_masjid = $result['id_masjid'];
        $kod_masjid = $result['kod_masjid'];
        $toyyibKey = $result['toyyibKey'];
        $cat_api = $result['cat_api'];
    }
}

if($_GET['sumbang'] == NULL) {
    $id_bantuan1 = e($_GET['id_bantuan']);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') $id_bantuan1 = e($_POST['id_bantuan']);
    if(!is_numeric($id_bantuan1)) $id_bantuan1 = "";

    if($id_bantuan1 != NULL) {
        $sql = "SELECT a.id_masjid, a.id_bantuan, a.jenis_bantuan, a.tujuan, a.amaun, b.nama_penuh, b.no_ic, b.no_hp, c.cat_api, c.kod_masjid, c.nama_masjid FROM sej6x_data_bantuan a, sej6x_data_peribadi b, sej6x_data_masjid c WHERE a.id_masjid = c.id_masjid AND a.id_bantuan='$id_bantuan1' AND a.id_data = b.id_data AND a.status_bantuan = 1";
        $sqlquery = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
        $num_row = mysqli_num_rows($sqlquery);
        $data = mysqli_fetch_array($sqlquery);
        $cat_api = $data['cat_api'];
        $nama_bantuan = $data['nama_penuh'];
        $tujuan = $data['tujuan'];
        $jenis_bantuan = $data['jenis_bantuan'];
        $kod_masjid = $data['kod_masjid'];
        $nama_masjid = $data['nama_masjid'];
        $id_masjid = $data['id_masjid'];
        $id_bantuan = $data['id_bantuan'];
    }
}

if(($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['mode'] == NULL) || $_GET['sumbangApps'] == 1 || $_GET['views'] == "json") {
    if($_GET['views'] == "json") goto semakKategori;
    if($_GET['mode_derma'] == 3) $id_masjid = 0;
    if($_GET['sumbang'] == NULL) $jenis_bayaran = 'Bantuan';
    if($_GET['sumbang'] != NULL) {
        $jenis_bayaran = e($_POST['jenis_bayaran']);
        $jenis_bantuan = $jenis_bayaran;
        $id_bantuan = 0;
    }

    $nama_penuh = e(strtoupper($_POST['nama_penuh']));
    $no_kp = e(strtoupper($_POST['no_kp']));
    $no_hp = e(strtoupper($_POST['no_hp']));
    $emel = e($_POST['emel']);
    if($emel == NULL) $emel = 'hamba_allah@masjidpro.com';
    if($no_kp == NULL) $no_kp = '000000000000';
    if($nama_penuh == NULL) $nama_penuh = 'HAMBA ALLAH';
    if($no_hp == NULL) $no_hp = '000-0000000';
    $amaun = e($_POST['amaun']);
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Kategori banjir
    if($_GET['mode_derma'] == 3) $cat_api = "av9x5zws";

    semakKategori:
    if(($cat_api == NULL && semakKategori($cat_api)->CategoryName == NULL) || ($cat_api != NULL && semakKategori($cat_api)->CategoryName == NULL)) {
        $cat_api = buatKategori($kod_masjid, $nama_masjid)[0]->CategoryCode;
        if($cat_api != NULL) {
            $u_api = "UPDATE sej6x_data_masjid SET cat_api = '$cat_api' WHERE id_masjid = $id_masjid";
            mysqli_query($bd2, $u_api) or die(mysqli_error($bd2));
        }
    }
    if(semakKategori($cat_api)->CategoryName != NULL) {
        $category = $cat_api;

        if($_GET['views'] == "json") goto semakKategori2;
        $q_insert = "INSERT INTO sej6x_bayar_online (id_masjid, id_bayaran, nama_penuh, no_kp, no_hp, jenis_bayaran, amaun, transaction_id, refno, reason, status_bayaran, billcode, category, last_added, ip_address, tarikh_bayaran) VALUES ($id_masjid, $id_bantuan, '$nama_penuh', '$no_kp', '$no_hp', '$jenis_bayaran', $amaun, '$transaction_id', '$refno', '$reason', '$status_bayaran', '$billcode', '$category', NOW(), '$ip_address', NOW())";
        //mysqli_query($bd2, $q_insert) or die($q_insert.'<br />'.mysqli_error($bd2));
        mysqli_query($bd2, $q_insert) or die(mysqli_error($bd2));
        $last_id = mysqli_insert_id($bd2);

        if($_GET['mode_derma'] == 1) {
            if ($_GET['sumbang'] != NULL) $nama_bill = "Sumbangan ikhlas";
            if ($_GET['sumbang'] == NULL) $nama_bill = "Bantuan ikhlas";
            $jenis_bantuan = $jenis_bantuan . ' untuk ' . $nama_masjid;
        }
        if($_GET['mode_derma'] == 2 || $_GET['mode_derma'] == 4) {
            $kuantiti = $_POST['kuantiti'];
            $nama_bill = $jenis_bantuan;
            $jenis_bantuan = $kuantiti . ' Unit ' . $jenis_bantuan . ' untuk ' . $nama_masjid;
        }
        if($_GET['mode_derma'] == 3) {
            $nama_bill = "Sumbangan ikhlas";
            $jenis_bantuan = "Tabung Banjir KL Selangor";
        }

        $billCode = buatBill($category, $nama_bill, $jenis_bantuan, $amaun, $last_id, $nama_penuh, $emel, $no_hp)[0]['BillCode'];
        //$billCode = buatBill($category, $nama_bill, $jenis_bantuan, $amaun, $last_id, $nama_penuh, $emel, $no_hp);
        $q_update = "UPDATE sej6x_bayar_online SET billcode = '$billCode' WHERE id_payment = $last_id";
        mysqli_query($bd2, $q_update) or die(mysqli_error($bd2));
        //header("Location: https://toyyibpay.com/".$billCode);
        header("Location: https://masjidpro.com/Masjid/payment_api.php?bayarTerus=1&billCode=$billCode");
    }
}

selesaiWakaf:
if($_GET['mode'] != NULL) {

    if($_GET['mode'] == 1) {
        $status_id = $_GET['status_id'];
        $billcode = $_GET['billcode'];
        $msg = $_GET['msg'];
        $transaction_id = $_GET['transaction_id'];
        $id_rujukan = $transaction_id;
        if($_GET['bayaran'] == "wakaf") {
            $q_update = "UPDATE rekod_wakaf SET statusBayaran = '$status_id' WHERE billCode = '$billcode'";
        }
        else if($_GET['bayaran'] == "infaq") {
            $q_update = "UPDATE order_infaq SET status_bayaran = '$status_id' WHERE billCode = '$billcode'";
        }
        else {
            $q_update = "UPDATE sej6x_bayar_online SET status_bayaran = '$status_id', transaction_id = '$transaction_id' WHERE billcode = '$billcode'";
        }
    }
    if($_GET['mode'] == 2) {
        $refno = $_POST['refno'];
        $status_id = $_POST['status'];
        $reason = $_POST['reason'];
        $billcode = $_POST['billcode'];
        $amount = str_replace('RM', '', $_POST['amount']);
        $id_rujukan = $refno;
        if($_GET['bayaran'] == "wakaf") {
            $q_update = "UPDATE rekod_wakaf SET statusBayaran = '$status_id', tarikh_bayaran = NOW() WHERE billCode = '$billcode'";
        }
        else if($_GET['bayaran'] == "infaq") {
            $q_update = "UPDATE order_infaq SET status_bayaran = '$status_id', dateAdded = NOW() WHERE billCode = '$billcode'";
        }
        else {
            $q_update = "UPDATE sej6x_bayar_online SET status_bayaran = '$status_id', reason = '$reason', refno = '$refno', amaun = $amount, tarikh_bayaran = NOW() WHERE billcode = '$billcode'";
        }
    }
    mysqli_query($bd2, $q_update);
    //if($_GET['bayaran'] != "wakaf") mysqli_query($bd2, $q_update);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0RCF4Z4X27"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-0RCF4Z4X27');
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/logo2.png">
    <?php if($_GET['sumbang'] != NULL) { ?>
        <title>Sumbangan - <?php echo($nama_masjid); ?></title>
        <meta name="description" content="Go Masjid Pro - Sumbangan">
    <?php } ?>
    <?php if($_GET['sumbang'] == NULL && isset($_GET['mode'])) { ?>
        <title>Go Masjid Pro - Status Pembayaran</title>
        <meta name="description" content="Go Masjid Pro - Status Pembayaran">
    <?php } ?>
    <?php if($_GET['sumbang'] == NULL && !isset($_GET['mode'])) { ?>
        <title>Go Masjid Pro - Derma Kempen Bantuan</title>
        <meta name="description" content="Go Masjid Pro - Derma Bantuan">
    <?php } ?>
    <link rel="apple-touch-icon" href="../images/logo2.png">
    <link rel="shortcut icon" href="../images/logo2.png">
    <!-- page css -->
    <link href="../themes/elite/dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../themes/elite/dist/css/style.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">Masjid Pro</p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper">
    <div class2="login-register" style="background-image:url(../themes/elite/images/background/login-register.jpg);">
        <div class="login-box card">
            <div class="card-header" align="center">
                <img alt="Masjid Pro" class="img-fluid" src="picture/logo_masjidpropenang.png">
            </div>
            <div class="card-body">
                <?php if(($num_row > 0 || $_GET['mode_derma'] == 3) && $_GET['mode'] == NULL) { ?>
                    <form id="derma" name="derma" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']); ?>">
                        <?php if($_GET['sumbang'] == NULL) { ?>
                            <div class="form-group" align="center">
                                MAKLUMAT PEMOHON BANTUAN
                            </div>
                            <div class="alert alert-info">
                                <center>
                                    Nama : <?php echo $data['nama_penuh']; ?><br>
                                    No K/P : <?php echo $data['no_ic']; ?><br>
                                    No Telefon : <?php echo $data['no_hp']; ?><br>
                                    Ahli Kariah: <?php echo $data['nama_masjid']; ?>
                                </center>
                            </div>
                            <hr>
                            <div class="form-group" align="center">
                                MAKLUMAT BANTUAN
                            </div>
                            <div class="alert alert-warning">
                                <center>
                                    Jenis Bantuan : <?php echo $data['jenis_bantuan']; ?><br>
                                    Tujuan Bantuan : <?php echo $data['tujuan']; ?><br>
                                    Amaun Diperlukan(RM) : <?php echo $data['amaun']; ?>
                                </center>
                            </div>
                        <?php } ?>
                        <?php if($_GET['sumbang'] != NULL) { ?>
                            <?php if($_GET['mode_derma'] != 3) { ?>
                                <div class="alert alert-info" role="alert">
                                    <strong><?php echo $nama_masjid; ?><?php echo $result['alamat']; ?><br>
                                        <?php echo $result['poskod']; ?>, <?php echo $result['daerah']; ?><br>
                                        <?php echo $result['negeri']; ?></strong>
                                </div>
                            <?php } ?>
                            <?php if($_GET['mode_derma'] == 1) { ?>
                                <div class="form-group"><label>* Jenis Bayaran</label>
                                    <select class="form-control" name="jenis_bayaran" id="jenis_bayaran" required>
                                        <option value="">Pilih Jenis Bayaran:-</option>
                                        <option value="Tabung Jumaat">Tabung Jumaat</option>
                                        <option value="Sumbangan">Sumbangan</option>
                                        <option value="Derma">Derma</option>
                                        <option value="Wakaf">Wakaf</option>
                                    </select>
                                </div>
                            <?php } if($_GET['mode_derma'] == 2) { ?>
                                <div class="form-group">
                                    <div class="alert alert-info" role="alert">
                                        <img height="150" class="img-fluid" src="../images/kotak_peduli_kariah.jpg">
                                        <hr />
                                        <h3 align="center"><strong>Kotak Peduli Kariah</strong></h3>
                                    </div>
                                    <div class="alert alert-success" role="alert">
                                        Jumlah Diperlukan: <strong><?php echo($jum_kotak); ?></strong><br />
                                        Bilangan Semasa: <strong><?php echo($bil_dapat); ?></strong><br />
                                        Baki: <strong><?php echo($baki_kotak); ?></strong>
                                    </div>
                                </div>
                            <?php } if($_GET['mode_derma'] == 3) { ?>
                                <div class="form-group">
                                    <div class="alert alert-info" role="alert">
                                        <img height="150" class="img-fluid" src="../images/tabung_bencana.jpg">
                                        <hr />
                                        <h3 align="center"><strong>Tabung Bencana</strong></h3>
                                    </div>
                                </div>
                            <?php } if($_GET['mode_derma'] == 4) { ?>
                                <div class="form-group">
                                    <div class="alert alert-info" role="alert">
                                        <img height="150" class="img-fluid" src="../images/kotak_peduli_raya3.jpg">
                                        <hr />
                                        <h3 align="center"><strong>Kotak Peduli Raya Fakir dan Asnaf</strong></h3>
                                    </div>
                                    <div class="alert alert-success" role="alert">
                                        Bilangan Semasa: <strong><?php echo($bil_dapat); ?></strong><br />
                                    </div>
                                </div>
                            <?php } } ?>
                        <hr>
                        <div class="maklumat-asas form-group">
                            <label>* No Telefon Penderma</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" maxlength="20" required>
                        </div>
                        <div class="maklumat-tambahan form-group">
                            <label>Nama Penderma</label>
                            <input class="form-control" id="nama_penuh" name="nama_penuh" maxlength="200" placeholder="HAMBA ALLAH">
                        </div>
                        <div class="maklumat-tambahan form-group no_ic_view" style="display: none">
                            <label>No K/P</label>
                            <input class="form-control" id="no_kp" name="no_kp" maxlength="12">
                        </div>
                        <div class="maklumat-tambahan form-group">
                            <label>Alamat E-Mel</label>
                            <input class="form-control" id="emel" name="emel" type="email" placeholder="hamba_allah@masjidpro.com">
                        </div>
                        <div class="form-group">
                            <?php if($_GET['mode_derma'] == 1 || $_GET['mode_derma'] == 3) { ?>
                                <label for="amaun">* Jumlah Amaun (RM)</label>
                                <div>
                                    <input class="btn btn-secondary form-group" type="button" value="RM10" onclick="$('#amaun').val('10')">
                                    <input class="btn btn-secondary form-group" type="button" value="RM20" onclick="$('#amaun').val('20')">
                                    <input class="btn btn-secondary form-group" type="button" value="RM50" onclick="$('#amaun').val('50')">
                                    <input class="btn btn-secondary form-group" type="button" value="RM100" onclick="$('#amaun').val('100')">
                                    <input class="btn btn-secondary form-group" type="button" value="RM500" onclick="$('#amaun').val('500')">
                                    <input class="btn btn-secondary form-group" type="button" value="RM1000" onclick="$('#amaun').val('1000')">
                                </div>
                                <input type="number" class="form-control" id="amaun" name="amaun" required min="10" placeholder="Sumbangan minima RM10" step="10">
                            <?php } if($_GET['mode_derma'] == 2 || $_GET['mode_derma'] == 4) { ?>
                                <div class="form-group">
                                    <label class="control-label">Jenis</label>
                                    <?php if($_GET['mode_derma'] == 2) { ?>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="peduli_1" name="jenis_bayaran_nilai" class="custom-control-input" checked value="50" onclick="updateAmaun()">
                                            <label class="custom-control-label" for="peduli_1">Kotak Peduli Kariah RM50</label>
                                        </div>
                                    <?php } ?>
                                    <div class="custom-control custom-radio">
                                        <?php if($_GET['mode_derma'] == 2) { ?>
                                            <input type="radio" id="peduli_2" name="jenis_bayaran_nilai" class="custom-control-input" value="100" onclick="updateAmaun()">
                                            <label class="custom-control-label" for="peduli_2">Kotak Peduli Kariah RM100</label>
                                            <input id="jenis_bayaran" name="jenis_bayaran" type="hidden" value="Kotak Peduli Kariah RM50">
                                        <?php } if($_GET['mode_derma'] == 4) { ?>
                                            <input type="radio" id="peduli_1" name="jenis_bayaran_nilai" class="custom-control-input" checked value="100" onclick="updateAmaun()">
                                            <label class="custom-control-label" for="peduli_2">Kotak Peduli Raya Fakir dan Asnaf RM100</label>
                                            <input id="jenis_bayaran" name="jenis_bayaran" type="hidden" value="Kotak Peduli Raya RM100">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>* Kuantiti Kotak</label>
                                    <input class="form-control" id="kuantiti" name="kuantiti" type="number" required value="1" min="1" oninput="updateAmaun()" step="1">
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label for="amaun">* Jumlah Amaun (RM)</label>
                                    <?php if($_GET['mode_derma'] == 2) { ?>
                                        <input readonly type="number" class="form-control" id="amaun" name="amaun" required min="50" value="50">
                                    <?php } if($_GET['mode_derma'] == 4) { ?>
                                        <input readonly type="number" class="form-control" id="amaun" name="amaun" required min="100" value="100">
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <hr>
                        <div>
                            <small>* Wajib diisi</small>
                            <button id="tajuk_sumbang" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type='submit' name="submit">Derma</button>
                        </div>
                        <input type="hidden" id="id_masjid" name="id_masjid" value="<?php echo $data['id_masjid']; ?>">
                        <input type="hidden" id="id_bantuan" name="id_bantuan" value="<?php echo $id_bantuan1; ?>">
                        <hr>
                        <div align="center">Masjid Pro © | 2019</div>
                    </form>
                <?php } if($num_row == 0 && $_GET['mode'] == NULL && $_GET['mode_derma'] != 3) { ?>
                    <div class="alert alert-danger" role="alert">
                        Tiada maklumat dijumpai!
                    </div>
                <?php } if($_GET['mode'] != NULL) {
                    if($status_id == 1) { ?>
                        <div class="alert alert-success" role="alert">
                            Pembayaran Berjaya Diterima. ID Rujukan Transaksi: <?php echo($id_rujukan); ?><br /><br />
                            <a class="btn btn-primary btn-lg" href="javascript:history.back(-100)" role="button">Kembali</a>
                        </div>
                    <?php } if($status_id == 2) { ?>
                        <div class="alert alert-warning" role="alert">
                            Pembayaran Masih Belum Selesai (Pending), Sila semak baki akaun bank anda, sekiranya tiada penolakkan baki, anda boleh cuba lagi membayar, sekiranya berlaku penolakkan daripada baki akaun anda bermakna pembayaran telah berjaya. ID Rujukan Transaksi (jika berkenaan): <?php echo($refno); ?>
                        </div>
                    <?php } if($status_id == 3) { ?>
                        <div class="alert alert-danger" role="alert">
                            Pembayaran Gagal Dibuat, Sila Cuba Sekali Lagi
                        </div>
                    <?php } if($status_id == 2 || $status_id == 3) { ?>
                        <a class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" href="https://masjidpro.com/Masjid/payment_api.php?bayarTerus=1&billCode=<?php echo($billcode); ?>" role="button">Bayar Sekarang</a>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="../themes/elite/node_modules/jquery/jquery-3.2.1.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="../themes/elite/node_modules/popper/popper.min.js"></script>
<script src="../themes/elite/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
    <?php if($_GET['mode_derma'] == 2 || $_GET['mode_derma'] == 4) { ?>
    function updateAmaun() {
        $(document).ready(function(){
            var nilai = $("input[name='jenis_bayaran_nilai']:checked").val();
            $('#amaun').val($('#kuantiti').val() * nilai);
            if(nilai == 50) $('#jenis_bayaran').val('Kotak Peduli Kariah RM50');
            <?php if($_GET['mode_derma'] == 2) { ?>if(nilai == 100) $('#jenis_bayaran').val('Kotak Peduli Kariah RM100');<?php } ?>
            <?php if($_GET['mode_derma'] == 4) { ?>if(nilai == 100) $('#jenis_bayaran').val('Kotak Peduli Raya RM100');<?php } ?>
        });
    }
    $(document).ready(function(){
        $('#tajuk_sumbang').html('TERUSKAN');
        $('.no_ic_view').hide();
    });
    <?php } ?>
    $(function() {
        $(".preloader").fadeOut();
    });
</script>
</body>
</html>
<?php
semakKategori2:
if($_GET['views'] == "json") {
    header("Content-Type: application/json; charset=UTF-8");
    //$toiyyib_api = 'lkkd8asu-ogca-gzvt-bzds-xh5vwmlc2ia8';
    $toiyyib_api = $toyyibKey;

    echo '{';
    echo '"toyyibAPI": "'.$toiyyib_api.'"';
    echo ', "catCode": "'.$category.'"';
    echo '}';
}
mysqli_close($bd2);
?>