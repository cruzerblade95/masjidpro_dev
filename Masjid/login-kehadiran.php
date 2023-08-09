<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if($_GET['kehadiranTakmir'] == 1) {
    $lokasi = $_GET['lokasi'];
    $tujuan = $_GET['tujuan'];
    header("Location: https://dashboard.masjidpro.com/login-kehadiran.php?lokasi=$lokasi&tujuan=$tujuan");
    exit;
}
session_start();

if($_GET['token'] != NULL && $_GET['userid'] != NULL && $_GET['jenisUser'] != NULL) {
    //echo($_GET['userid'].'<br />');
    //echo($_GET['jenisUser'].'<br />');
    //echo($_GET['token'].'<br />');
    setcookie('no_ic_qr', $_GET['userid'], time() + (86400 * 365), "/");
    $_SESSION["no_ic_qr"] = $_GET['userid'];
    $_SESSION["no_ic"] = $_SESSION["no_ic_qr"];
    setcookie('no_ic_qr', $_SESSION["no_ic"], time() + (86400 * 365), "/");
    $no_ic_data = $_SESSION["no_ic"];
}

if($_POST['dev'] == 1) $dev = 1;
if($_GET['token'] != NULL) $token = $_GET['token'];
if($_POST['token'] != NULL && $_GET['userid'] == "KKKK840827025081") {
    $token = $_POST['token'];
    $dev = 1;
}

if($_SESSION['no_ic'] != NULL || $_COOKIE['no_ic'] != NULL) {
    if($_SESSION['no_ic'] != NULL) {
        $_SESSION["no_ic_qr"] = $_SESSION['no_ic'];
        $no_ic_data = $_SESSION['no_ic'];
    }
    else if($_COOKIE['no_ic'] != NULL) {
        $_SESSION["no_ic_qr"] = $_COOKIE['no_ic'];
        $no_ic_data = $_COOKIE['no_ic'];
    }
}
//if($_GET['sejarah'] == 1 || $_GET['checkIn'] == 1) goto info_db;
if(($_SESSION["no_ic_qr"] != NULL || $_GET['userid'] != NULL || $_SESSION["username"] != NULL) && ($_GET['sejarah'] == 1 || $_GET['checkIn'] == 1)) goto info_db;
else if($_SESSION["no_ic_qr"] == NULL && ($_GET['sejarah'] == 1 || $_GET['checkIn'] == 1)) {
    echo 'Sila kembali ke halaman utama aplikasi dan masuk semula ke Rekod Kehadiran';
    exit;
}
if($_GET['action'] == "keluar") {
    foreach ($_SESSION as $exit_session => $val_exit) {
        if($exit_session != "token_device") unset($_SESSION[$exit_session]);
    }
    foreach ($_COOKIE as $exit_session2 => $val_exit2) {
        if($exit_session2 != "token_device") {
            setcookie($exit_session2, "", time() - (86400 * 500));
            setcookie($exit_session2, "", time() - (86400 * 500), '/');
        }
    }
    setcookie("undefined", "", time() - (86400 * 500));
    setcookie("undefined", "", time() - (86400 * 500), '/');

    session_unset();
    session_destroy();
    session_write_close();
    session_regenerate_id(true);
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, "", time() - (86400 * 500));
            setcookie($name, "", time() - (86400 * 500), '/');
        }
    }
    setcookie("token_device", $token_device, time() + (86400 * 365), "/");
    $_SESSION['token_device'] = $token_device;
    if($_GET['keluarDulu'] == 1) {
        foreach($_GET as $key => $val) {
            ${$key} = $val;
            //echo($key.' : '.$val);
        }
        header("Location: login-kehadiran.php?sejarah=1&userid=$userid&jenisUser=$jenisUser&token=$token&id_mysejahtera=$id_mysejahtera");
        exit;
    }
    else header("Location: login-kehadiran.php");
}

info_db:
if(($_SERVER['REQUEST_METHOD'] == "POST" && $no_ic_data != "KKKK840827025081" && ($row_masjid['url_mysejahtera'] != NULL || $num_nama < 1)) || $_GET['checkIn'] == 1) {
    //if($_GET['checkIn'] == 1) $dev = 1;
}
include('connection/connection_qr.php');
include('fungsi.php');
include('fungsi_tarikh.php');

if($_SESSION["username"] != NULL && $_GET['sejarah'] == 1) goto load_sejarahAdmin;
if($_SESSION["no_ic_qr"] != NULL && $_GET['sejarah'] == 1) goto load_rekod;
if($_SESSION["no_ic_qr"] != NULL && $_GET['checkIn'] == 1) goto checkMasjid;

require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;

checkMasjid:
if(ee($_GET['lokasi'], NULL, NULL) != NULL) {
    if(ee($_GET['lokasi'], NULL, NULL) != NULL) $lokasi = ee($_GET['lokasi'], NULL, NULL);
    //if(ee($lokasi) == NULL || ee($lokasi) == "") $lokasi = ee($_POST['lokasi']);

    $q = "SELECT * FROM sej6x_data_masjid WHERE kod_qr = '$lokasi'";
    $q2 = mysqli_query($conn, $q) or die(mysqli_error($conn));
    $row_masjid = mysqli_fetch_assoc($q2);
    $num_masjid = mysqli_num_rows($q2);
    $id_masjid = $row_masjid['id_masjid'];
    $zon_solat = $row_masjid['zon_solat'];
    $nama_masjid = $row_masjid['nama_masjid'];
    $alamat_masjid = $row_masjid['alamat_masjid'];
}

if($_SESSION["no_ic_qr"] != NULL && $_GET['checkIn'] == 1) goto checkIn_mySejahtera;

if($_GET['apps'] == 1 && $_SERVER['REQUEST_METHOD'] == "GET") {
    echo '[{
    "lokasi":"'.$lokasi.'"
    }]';
    exit;
}

if(isset($_GET['tujuan'])) {
    $tujuan = hex2bin($_GET['tujuan']);
    $tujuan = substr($tujuan, 0, strpos($tujuan, "<->"));
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $no_ic = ee($_POST['no_ic'], NULL, NULL);
    //$lokasi = ee($_POST['lokasi']);

    $q_nama = "SELECT a.nama_penuh, a.no_ic, NOW() 'waktu_hadir', a.no_hp FROM sej6x_data_peribadi a WHERE a.no_ic = '$no_ic' UNION SELECT b.nama_penuh, b.no_ic, NOW() 'waktu_hadir', b.no_tel FROM sej6x_data_anakqariah b WHERE b.no_ic = '$no_ic'";
    $q_nama2 = mysqli_query($conn, $q_nama) or die(mysqli_error($conn));
    $row_nama = mysqli_fetch_assoc($q_nama2);
    $num_nama = mysqli_num_rows($q_nama2);
    $nama_penuh = $row_nama['nama_penuh'];
    if($row_nama['no_hp'] != NULL) $no_hp = $row_nama['no_hp'];
    if($row_nama['no_tel'] != NULL) $no_hp = $row_nama['no_tel'];
    $no_ic_data = $row_nama['no_ic'];
    $waktu_hadir = $row_nama['waktu_hadir'];
    $waktu_hadir_time = strtotime($waktu_hadir);
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $device = $_SERVER['HTTP_USER_AGENT'];
    if($device == NULL || $device == "") $device = $_POST['device'];


    $koordinat_x = "0.000000";
    $koordinat_y = "0.000000";

    if(ee($_POST['koordinat_x'], NULL, NULL) != NULL) $koordinat_x = ee($_POST['koordinat_x'], NULL, NULL);
    if(ee($_POST['koordinat_y'], NULL, NULL) != NULL) $koordinat_y = ee($_POST['koordinat_y'], NULL, NULL);

    //Data JSON Waktu Solat JAKIM Setahun
    if($zon_solat != NULL && !isset($_GET['tujuan'])) {
        $date = date_create(date("Y-m-d H:i:s"));
        $tarikh_check = date_format($date, "Y-m-d");
        $hari_tahun = date_format($date, "z");
        $JSONdata = file_get_contents("https://www.e-solat.gov.my/index.php?r=esolatApi/takwimsolat&period=year&zone=" . $zon_solat);
        $data_solat = json_decode($JSONdata, true);
        if ($data_solat['prayerTime'][$hari_tahun]['date'] == fungsi_tarikh(date("Y-m-d H:i:s"), 11, 99)) {
            $hari_ini_date = date_format(date_create(date("Y-m-d H:i:s")), 'Y-m-d');
            $imsak_cd = $hari_ini_date . ' ' . $data_solat['prayerTime'][$hari_tahun]['imsak'];
            $subuh_cd = $hari_ini_date . ' ' . $data_solat['prayerTime'][$hari_tahun]['fajr'];
            $syuruk_cd = $hari_ini_date . ' ' . $data_solat['prayerTime'][$hari_tahun]['syuruk'];
            $zohor_cd = $hari_ini_date . ' ' . $data_solat['prayerTime'][$hari_tahun]['dhuhr'];
            $asar_cd = $hari_ini_date . ' ' . $data_solat['prayerTime'][$hari_tahun]['asr'];
            $maghrib_cd = $hari_ini_date . ' ' . $data_solat['prayerTime'][$hari_tahun]['maghrib'];
            $isyak_cd = $hari_ini_date . ' ' . $data_solat['prayerTime'][$hari_tahun]['isha'];

            $waktu_solat = array();

            $imsak = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['imsak']), "H:i:s");
            $waktu_solat[0] = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['fajr']), "H:i:s");
            $syuruk = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['syuruk']), "H:i:s");
            $waktu_solat[1] = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['dhuhr']), "H:i:s");
            $waktu_solat[2] = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['asr']), "H:i:s");
            $waktu_solat[3] = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['maghrib']), "H:i:s");
            $waktu_solat[4] = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['isha']), "H:i:s");

            //check waktu solat
            for($i = 0; $i < count($waktu_solat); $i++) {
                if($i != 1) {
                    $sebelum = strtotime($waktu_solat[$i]) - 1800;
                    $selepas = strtotime($waktu_solat[$i]) + 1800;
                }
                if($i == 1) {
                    $sebelum = strtotime($waktu_solat[$i]) - 3600;
                    $selepas = strtotime($waktu_solat[$i]) + 3600;
                }
                if($waktu_hadir_time >= $sebelum && $waktu_hadir_time <= $selepas) {
                    if($i == 0) $tujuan = "Subuh";
                    if($i == 1) {
                        $tujuan = "Zohor / Jumaat";
                    }
                    if($i == 2) $tujuan = "Asar";
                    if($i == 3) $tujuan = "Maghrib";
                    if($i == 4) $tujuan = "Isyak";
                }
            }
        }
    }
    if($num_nama > 0 && $_POST['login'] != 1 && $no_ic_data != "KKKK840827025081") {
        $q_simpan = "INSERT INTO sej6x_data_gejala (id_masjid, no_ic, tujuan, ip_address, device, koordinat_x, koordinat_y, time) VALUES ($id_masjid, '$no_ic_data', '$tujuan', '$ip_address', '$device', $koordinat_x, $koordinat_y, '$waktu_hadir')";
        mysqli_query($conn, $q_simpan) or die(mysqli_error($conn));
        $last_id = mysqli_insert_id($conn);

        if($last_id != NULL) {
            $q_data = "SELECT * FROM sej6x_data_gejala WHERE id_gejala = $last_id";
            $q_data2 = mysqli_query($conn, $q_data) or die(mysqli_error($conn));
            $row_data = mysqli_fetch_assoc($q_data2);
            $tarikh_masa = $row_data['time'];
            $tarikh_data = date_format(date_create($row_data['time']),"Y-m-d");
            $masa_data = date_format(date_create($row_data['time']),"H:i:s");

            $data_solat = '{"lokasi":"'.$lokasi.'","jenis_user":"1","id_peribadi":"'.$no_ic.'","tarikh":"'.$tarikh_data.'","masa":"'.$masa_data.'","tarikh_masa":"'.$tarikh_masa.'","dev":"'.$dev.'"}';
            loadcURL("$data_solat", "https://daftarsolat.masjidpro.com/__sahkan_kehadiran.php", "daftarSolat", NULL);
            foreach ($infocURL_daftarSolat as $key_solat => $val_solat) ${'cURLSolat_'.$key_solat} = $val_solat;
            $status_daftarSolat = $cURLSolat_http_code;
        }
    }

    if($num_nama > 0 && ($_SESSION['no_ic_qr'] == NULL && $_SESSION['lokasi_qr'] == NULL)) {
        $_SESSION['no_ic_qr'] = $no_ic_data;
        $_SESSION['nama_penuh'] = $nama_penuh;
        $_SESSION['no_hp'] = $no_hp;
        $_SESSION['lokasi_qr'] = $lokasi;
        setcookie("no_ic_qr", $no_ic_data, time() + (86400 * 365), "/");
        setcookie("nama_penuh", $nama_penuh, time() + (86400 * 365), "/");
        setcookie("no_hp", $no_hp, time() + (86400 * 365), "/");
        setcookie("lokasi_qr", $lokasi, time() + (86400 * 365), "/");
        $no_ic_data = $_SESSION['no_ic_qr'];
        $nama_penuh = $_SESSION['nama_penuh'];
        $no_hp = $_SESSION['no_hp'];
        $lokasi = $_SESSION['lokasi_qr'];
    }
}

if($_SESSION['no_ic_qr'] != NULL && $_SESSION['lokasi_qr'] != NULL) {
    $no_ic_data = ee($_SESSION['no_ic_qr'], NULL, NULL);
    //$lokasi = ee($_SESSION['lokasi_qr']);
}

if($_SESSION['no_ic_qr'] == NULL && $_SESSION['lokasi_qr'] == NULL && $_COOKIE['no_ic_qr'] != NULL && $_COOKIE['lokasi_qr'] != NULL) {
    $no_ic_data = ee($_COOKIE['no_ic_qr'], NULL, NULL);
    //$lokasi = ee($_COOKIE['lokasi_qr']);
}
//if(count($_COOKIE) > 0) echo '1';

if($_GET['apps'] == 1 || $_POST['apps'] == 1) {
    echo '[{
    "id_masjid":"'.$id_masjid.'",
    "zon_solat":"'.$zon_solat.'",
    "nama_masjid":"'.$nama_masjid.'",
    "alamat_masjid":"'.$alamat_masjid.'",
    "poskod":"'.$row_masjid['poskod'].'",
    "daerah":"'.$row_masjid['daerah'].'",
    "negeri":"'.$row_masjid['negeri'].'",
    "nama_penuh":"'.$nama_penuh.'",
    "no_ic":"'.$no_ic_data.'",
    "tarikh_hadir_masihi":"'.fungsi_tarikh($waktu_hadir, 2, 99).'",
    "tarikh_hadir_hijrah":"'.fungsi_tarikh($waktu_hadir, 2, 100).'",
    "waktu_hadir":"'.fungsi_tarikh($waktu_hadir, 5, 99).'",
    "url_mysejahtera":"'.$row_masjid['url_mysejahtera'].'"
    }]';
    exit;
}
load_rekod:
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
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Masjid Pro Penang - Rekod Kehadiran">
        <meta name="author" content="Masjid Pro Penang">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" href="images/logo2.png">
        <title>Masjid Pro - Rekod Kehadiran<?php if($_POST['no_ic'] != NULL && $num_nama > 0) { ?> - <?php echo($nama_masjid); ?><?php } ?></title>

        <!-- page css -->
        <link href="themes/elite/dist/css/pages/login-register-lock.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="themes/elite/dist/css/style.min.css" rel="stylesheet">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php include("loader.php"); ?>
    </head>

    <body class="skin-default card-no-border" style="color: black">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Masjid Pro Penang</p>
        </div>
    </div>
    <?php if($num_masjid > 0 && $_POST['token'] == NULL && ($_POST['no_ic'] != NULL || $no_ic_data != NULL) && $_GET['sejarah'] != 1) { ?>
        <nav class="navbar fixed-top navbar-light bg-light">
            <div class="col-auto"><button onclick="loadPage('login-kehadiran.php?sejarah=1', '#rekod_sejarah')" data-target="#carouselExampleIndicators2" data-slide-to="1" id="rekod" class="btn waves-effect waves-light btn-rounded btn-info">Rekod Kehadiran</button></div>
            <div class="col-auto"><button data-target="#carouselExampleIndicators2" data-slide-to="0" id="utama" class="btn waves-effect waves-light btn-rounded btn-success">Utama</button></div>
        </nav>
        <br /><br />
    <?php } ?>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <?php if($_GET['sejarah'] != 1) { ?>
        <div class="login-register" style="background-image:url(picture/banner_masjidpro.jpg); background-color: #010280; background-size: contain">
            <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel" data-interval="false">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                </ol>
                <div id="muka_utama" class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <div class="login-box card">
                            <div class="card-body">
                                <div align="center"><img src="images/logo_mobile.gif" class="img-fluid" lt="Home" width="250"/></div>
                                <hr />
                                <?php if($detect->isMobile()) { ?>
                                    <?php if($_SERVER['REQUEST_METHOD'] != "POST" && $no_ic_data == NULL) { ?>
                                        <div class="alert alert-danger" role="alert" style="font-weight: bold">
                                            Sila log masuk terlebih dahulu dan scan semula kehadiran
                                        </div>
                                    <?php } if($num_masjid > 0 && $_SERVER['REQUEST_METHOD'] != "POST" && ($_POST['no_ic'] != NULL || $no_ic_data != NULL)) { ?>
                                        <form class="form-horizontal form-material" id="loginform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?lokasi=<?php if(!isset($_GET['tujuan'])) echo($_GET['lokasi']); if(isset($_GET['tujuan'])) echo($_GET['lokasi'].'&tujuan='.$_GET['tujuan']); ?>" method="post" enctype="multipart/form-data">
                                            <div class="alert alert-info" role="alert" style="font-weight: bold">
                                                <h4 class="text-center m-b-20" style="font-weight: bold"><?php echo($nama_masjid); ?></h4>
                                                <?php echo($alamat_masjid); ?>, <?php echo($row_masjid['poskod']); ?>, <br /><?php echo($row_masjid['daerah']); ?>, <?php echo($row_masjid['negeri']); ?>
                                            </div>
                                            <h4 class="text-center m-b-20" style="color: black">Rekod Kehadiran</h4>
                                            <div class="form-group ">
                                                <div class="col-xs-12">
                                                    <input readonly id="no_ic" name="no_ic" class="form-control" type="text" required="" placeholder="No K/P" value="<?php echo($no_ic_data); ?>"> </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="col-xs-12 p-b-20">
                                                    <input id="lokasi" name="lokasi" type="hidden" value="<?php echo($lokasi); ?>">
                                                    <input id="dev_old" name="dev" type="hidden" value="<?php echo($dev); ?>">
                                                    <input id="token" name="token" type="hidden" value="<?php echo($token); ?>">
                                                    <input id="koordinat_x" name="koordinat_x" type="hidden" value="<?php echo($_GET['lat']); ?>">
                                                    <input id="koordinat_y" name="koordinat_y" type="hidden" value="<?php echo($_GET['long']); ?>">
                                                    <button id="tekan" class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Sahkan</button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php } if($num_masjid < 1) { ?>
                                        <div class="alert alert-danger" role="alert" style="font-weight: bold">
                                            Kod QR tidak sah, Sila imbas sekali lagi.
                                        </div>
                                    <?php } if($_POST['no_ic'] != NULL && $num_nama < 1) { ?>
                                        <div class="alert alert-danger" role="alert" style="font-weight: bold">
                                            Anda bukan ahli kariah mana-mana Masjid didalam Masjid Pro. Untuk meneruskan Check In My Sejahtera, sila klik butang di bawah.
                                        </div>
                                        <a href="SPMD/login.php" style="display: none"><button class="btn btn-primary">Daftar</button></a>
                                    <?php } if($_POST['no_ic'] != NULL && $num_nama > 0) { ?>
                                        <div class="alert alert-info" role="alert" style="font-weight: bold">
                                            <?php echo($row_masjid['nama_masjid']); ?>
                                        </div>
                                        <div class="alert alert-info" role="alert" style="font-weight: bold">
                                            <?php echo($nama_penuh); ?><br />
                                            No K/P: <?php echo($no_ic_data); ?>
                                        </div>
                                        <div class="alert alert-success" role="alert" style="font-weight: bold" align="center">
                                            Kehadiran Berjaya Direkodkan
                                        </div>
                                        <div class="alert alert-success" role="alert" style="font-weight: bold" align="center">
                                            <?php if($status_daftarSolat == 201) { ?>
                                                <img width="64" height="64" onclick="$('#daftar_solat_show').fadeIn()" class="img-fluid" src="images/daftar_solat_lulus.png" style="float: left;">
                                            <?php } ?>
                                            <?php fungsi_tarikh($waktu_hadir, 2, 4); ?><br />
                                            Jam: <?php fungsi_tarikh($waktu_hadir, 5, 2); ?>
                                        </div>
                                        <?php echo($resultcURL_daftarSolat); if(isset($_GET['tujuan']))  { ?>
                                            <div class="alert alert-success" role="alert" style="font-weight: bold" align="center">
                                                <?php echo($tujuan); ?>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php
                                    checkIn_mySejahtera:
                                    if(($_SERVER['REQUEST_METHOD'] == "POST" && $no_ic_data != "KKKK840827025081" && ($row_masjid['url_mysejahtera'] != NULL || $num_nama < 1)) || $_GET['checkIn'] == 1) {
                                        if($_GET['checkIn'] != 1) {
                                            $tarikh_qr = date_format(date_create($waktu_hadir), 'Y-m-d');
                                            $masa_qr = date_format(date_create($waktu_hadir), 'H:i:s');
                                            $last_id = base64_encode(bin2hex($last_id));
                                        }
                                        if($_GET['checkIn'] == 1) {
                                            $request_body = json_decode(file_get_contents('php://input'), true);
                                            $url_sejahtera = str_replace('https://mysejahtera.malaysia.gov.my/qrscan?', '', $row_masjid['url_mysejahtera']);
                                            $url_sejahtera_json = json_decode(file_get_contents("https://daftarsolat.masjidpro.com/getParams.php?$url_sejahtera"), true);
                                            $tenant = $url_sejahtera_json['lId'];
                                            $eln = base64_decode($url_sejahtera_json['eln']);

                                            $dev = $request_body['dev'];
                                            $last_id = hex2bin(base64_decode($request_body['last_id']));
                                            $tarikh_qr = $request_body['tarikh_qr'];
                                            $masa_qr = $request_body['masa_qr'];
                                            $tarikhMasa_qr = "$tarikh_qr"."T"."$masa_qr"."Z";
                                            $nama_penuh = $request_body['nama_penuh'];
                                            $no_hp = $request_body['no_hp'];
                                            $data = '{"name":"'.$nama_penuh.'","contact":"'.$no_hp.'","userStatus":"Low","tenant":"'.$tenant.'","location":"'.$eln.'","createdDate":"'.$tarikhMasa_qr.'","type":0}';
                                            loadcURL("$data", "https://mysejahtera.malaysia.gov.my/clockin", "daftarSejahtera", "json");
                                            foreach ($infocURL_daftarSejahtera as $key => $val) ${'cURL_'.$key} = $val;
                                            $data_send = base64_encode($data);
                                        }
                                        else {
                                            $data2 = '{"last_id":"'.$last_id.'","checkIn":1, "tarikh_qr":"'.$tarikh_qr.'","masa_qr":"'.$masa_qr.'","nama_penuh":"'.$nama_penuh.'","no_hp":"'.$no_hp.'","dev":"'.$dev.'"}';
                                            ?>
                                            <div id="load_sejahtera">
                                        <?php }

                                        if($cURL_http_code == 200) {
                                            $q_my = "UPDATE sej6x_data_gejala SET mysejahtera_checkin = 1 WHERE id_gejala = $last_id";
                                            mysqli_query($conn, $q_my) or die(mysqli_error($conn));
                                            ?>
                                            <div align="center" onclick="document.location.href='qrscan.php?rekod=1&lId=<?php echo($tenant); ?>&eln=<?php echo($url_sejahtera_json['eln']); ?>&formType=REGULAR&isExternal=false&data=<?php echo ($data_send); ?>'" onclick2="sejarah('<?php echo($tenant); ?>', '<?php echo($url_sejahtera_json['eln']); ?>', '<?php echo ($data_send); ?>', 1)">
                                                <button class="btn btn-info">
                                                    <img width="48" class="img-fluid" src="https://mysejahtera.malaysia.gov.my/checkin/images/logo.png" style="float: left"> <span style="vertical-align:middle">MySejahtera Berjaya Didaftarkan Automatik, Klik disini untuk paparan</span>
                                                </button>
                                            </div>
                                        <?php } if($_GET['checkIn'] == 1) {
                                            mysqli_close($conn);
                                            exit;
                                        } } ?>
                                    </div>
                                <?php } if(!$detect->isMobile()) { ?>
                                    <div class="alert alert-danger" role="alert" style="font-weight: bold">
                                        Halaman ini hanya boleh diakses melaui telefon pintar atau tablet.
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } if($num_masjid > 0 && ($_POST['no_ic'] != NULL || $no_ic_data != NULL) || ($_GET['sejarah'] == 1 && $_GET['token'] != NULL && $_GET['userid'] != NULL && $_GET['jenisUser'] != NULL)) { ?>
                    <?php if($_GET['sejarah'] != 1) { ?><div class="carousel-item"><?php } ?>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="table-responsive">
                                    <table class="table color-table info-table full-color-table full-info-table hover-table table-striped">
                                        <?php if($_GET['sejarah'] != 1) { ?>
                                            <thead>
                                            <tr>
                                                <th colspan="2">
                                                    <small>Rekod kehadiran ke Masjid dan juga check in My Sejahtera melalui Aplikasi MasjidPro boleh dilihat di bahagian ini</small>
                                                </th>
                                            </tr>
                                            </thead>
                                        <?php } ?>
                                        <tbody id="rekod_sejarah">
                                        <?php if($_GET['sejarah'] != 1) { ?>
                                            <tr>
                                                <td colspan="2">
                                                    <div id="tunggu" class="col-md-12 col-12 sk-circle" align="center">
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
                                                </td>
                                            </tr>
                                        <?php }
                                        //load_rekod2:
                                        load_sejarahAdmin:
                                        if(($_SESSION["no_ic_qr"] != NULL || $_SESSION["username"] != NULL) && $_GET['sejarah'] == 1) {
                                        $no_ic_data = $_SESSION["no_ic_qr"];

                                        if($_GET['id_mysejahtera'] != NULL) {
                                            $id_gejala = ee($_GET['id_mysejahtera'], NULL, NULL);
                                            $extra_detail = "AND id_gejala = '$id_gejala'";
                                        }
                                        $q_rekod = "SELECT a.no_ic, b.nama_masjid, a.time, a.tujuan, a.mysejahtera_checkin, b.url_mysejahtera FROM sej6x_data_gejala a, sej6x_data_masjid b WHERE a.id_masjid = b.id_masjid AND a.no_ic = '$no_ic_data' $extra_detail ORDER BY a.time DESC LIMIT 20";
                                        //if($no_ic_data == "840827025081") echo($q_rekod);
                                        $q_rekod2 = mysqli_query($conn, $q_rekod) or die(mysqli_error($conn));
                                        $row_rekod = mysqli_fetch_assoc($q_rekod2);
                                        $num_rekod = mysqli_num_rows($q_rekod2);

                                        if($num_rekod > 0) {
                                            $q_nama = "SELECT a.nama_penuh, a.no_ic, a.no_hp FROM sej6x_data_peribadi a WHERE a.no_ic = '$no_ic_data' UNION SELECT b.nama_penuh, b.no_ic, b.no_tel FROM sej6x_data_anakqariah b WHERE b.no_ic = '$no_ic_data'";
                                            $q_nama2 = mysqli_query($conn, $q_nama) or die(mysqli_error($conn));
                                            $row_nama = mysqli_fetch_assoc($q_nama2);
                                            $num_nama = mysqli_num_rows($q_nama2);
                                            $nama_penuh = $row_nama['nama_penuh'];
                                            if($row_nama['no_hp'] != NULL) $no_hp = $row_nama['no_hp'];
                                            if($row_nama['no_tel'] != NULL) $no_hp = $row_nama['no_tel'];
                                            do {
                                                if($row_rekod['mysejahtera_checkin'] == 1) {
                                                    $url_sejahtera2 = str_replace('https://mysejahtera.malaysia.gov.my/qrscan?', '', $row_rekod['url_mysejahtera']);
                                                    $url_sejahtera_json2 = json_decode(file_get_contents("https://daftarsolat.masjidpro.com/getParams.php?$url_sejahtera2"), true);
                                                    $tenant2 = $url_sejahtera_json2['lId'];
                                                    $eln2 = base64_decode($url_sejahtera_json2['eln']);

                                                    $tarikh_qr2 = date_format(date_create($row_rekod['time']), 'Y-m-d');
                                                    $masa_qr2 = date_format(date_create($row_rekod['time']), 'H:i:s');
                                                    $tarikhMasa_qr2 = "$tarikh_qr2" . "T" . "$masa_qr2" . "Z";
                                                    $data2 = '{"name":"' . $nama_penuh . '","contact":"' . $no_hp . '","userStatus":"Low","tenant":"' . $tenant2 . '","location":"' . $eln2 . '","createdDate":"' . $tarikhMasa_qr2 . '","type":0}';
                                                    $data2 = base64_encode($data2);
                                                }
                                                if($id_gejala != NULL) {
                                                    //foreach($_SESSION AS $key => $val) echo($key.': '.$val.'<br />');
                                                    header("Location: https://masjidpro.com/Masjid/qrscan.php?rekod=1&lId=$tenant2&eln=".$url_sejahtera_json2['eln']."&formType=REGULAR&isExternal=false&data=$data2");
                                                    exit;
                                                }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo($row_rekod['nama_masjid']); ?><br />
                                                        <?php fungsi_tarikh($row_rekod['time'], 2, 4); ?><br />
                                                        <?php fungsi_tarikh($row_rekod['time'], 5, 2); ?>
                                                        <?php if($row_rekod['tujuan'] != NULL && $row_rekod['tujuan'] != "") echo('<br />'.$row_rekod['tujuan']); ?>
                                                    </td>
                                                    <td>
                                                        <?php if($row_rekod['mysejahtera_checkin'] == 1) { ?><img onclick="sejarah('<?php echo($tenant2); ?>', '<?php echo($url_sejahtera_json2['eln']); ?>', '<?php echo($data2); ?>', 1)" width="48" class="img-fluid" src="https://mysejahtera.malaysia.gov.my/checkin/images/logo.png"><?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } while($row_rekod = mysqli_fetch_assoc($q_rekod2)); } else { ?>
                                            <tr>
                                                <td>
                                                    <div class="alert alert-danger" role="alert" style="font-weight: bold">
                                                        Rekod tidak dijumpai
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } if($_GET['sejarah'] != 1) { ?>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    <?php } } ?>
    </section>

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="themes/elite/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="themes/elite/node_modules/popper/popper.min.js"></script>
    <script src="themes/elite/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--Custom JavaScript -->
    <?php if($_GET['sejarah'] != 1) { ?>
        <script>
            var test;
            <?php if ($detect->isMobile() && ($_GET['lat'] == NULL || $_GET['long'] == NULL)) { ?>
            function getLocation() {
                $(document).ready(function(){
                    /*
                    navigator.permissions.query({name:'geolocation'}).then(function(result) {
                        // Will return ['granted', 'prompt', 'denied']
                        //console.log(result.state);
                        status_lokasi = result.state;
                        alert(result.state);
                    });
                    */
                    ///*
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition);
                    } else {
                        //x.innerHTML = "Peranti ini tidak menyokong fungsi geo-lokasi.";
                        //alert("Peranti ini tidak menyokong fungsi geo-lokasi.");
                    }
                    //*/
                });
            }

            function showPosition(position) {
                $(document).ready(function(){
                    //$('#isi').html('');
                    //$('#isi').append('<div class="map"><div id="googleMap" data-google-map="true" style="width:100%; height:100%; overflow: hidden"></div></div>');
                    xxx = position.coords.latitude;
                    yyy = position.coords.longitude;
                    //alert(xxx + ', ' + yyy);
                    $('#koordinat_x').val(xxx);
                    $('#koordinat_y').val(yyy);
                    if(xxx != null && yyy != null) {
                        //initMap(xxx, yyy);
                        //$('#demo').hide();
                        //document.getElementById('tunggu').style.display = 'none';
                        //$("body").css("overflow", "hidden");
                        <?php if(($no_ic_data != NULL || $token != NULL) && $_GET['lokasi'] != NULL && $_POST['no_ic'] == NULL) { ?>$('#tekan').click();<?php } ?>
                    }
                    //if(xxx == null || yyy == null) tiada_lokasi();
                });
            }
            $(document).ready(function(){
                getLocation();
            });
            <?php } ?>
            <?php if($token != NULL && $_GET['lokasi'] != NULL && $_POST['no_ic'] == NULL) { ?>$('#tekan').click();<?php } ?>
        </script>
    <?php } if($_SERVER['REQUEST_METHOD'] == "POST" || $_GET['sejarah'] == 1 || $_GET['lokasi'] != NULL) { ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalSejahtera" tabindex="-1" aria-labelledby="exampleModalLabelSejahtera" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div id="tajukMysejahtera" class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelSejahtera">MySejahtera Check-In</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup" onclick="resetSRC()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <iframe id="mySejahtera_frame" <?php if($_GET['lokasi2'] != NULL) { ?>src="qrscan.php?lId=<?php echo($tenant); ?>&eln=<?php echo($url_sejahtera_json['eln']); ?>&formType=REGULAR&isExternal=false&data=<?php echo(base64_encode($data)); ?>"<?php } ?> frameborder="0" width="100%"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="display: none">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="resetSRC()">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <script id="importSejarah">
            function sejarah(a, b, c, d) {
                var e = 'qrscan.php?rekod='+d+'&lId='+a+'&eln='+b+'&formType=REGULAR&isExternal=false&data='+c;
                //console.log(e);
                $('#mySejahtera_frame').attr('src', e);
                $('#exampleModalSejahtera').modal('show');
            }
            function resetSRC() {
                $('#mySejahtera_frame').removeAttr('src');
            }
        </script>
        <script id="importSekerip">
            function loadPage(alamat_web, load_area) {
                $(document).ready(function(){
                    $.ajax({
                        url: alamat_web,
                        success: function(result){
                            $(load_area).html('');
                            $(load_area).html(result);
                        }
                    });
                });
            }
            function loadPage2(alamat_web, load_area, data) {
                $(document).ready(function(){
                    $.ajax({
                        type: 'POST',
                        data: data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        url: alamat_web,
                        success: function(result){
                            $(load_area).html('');
                            $(load_area).html(result);
                        }
                    });
                });
            }
        </script>
        <script>
            $(document).ready(function(){
                var tinggi = screen.availHeight - 90;
                $('#mySejahtera_frame').height(''+tinggi+'px');
                <?php if($_GET['lokasi'] != NULL) { ?>loadPage2('login-kehadiran.php?checkIn=1&lokasi=<?php echo($_GET['lokasi']); ?>', '#load_sejahtera', '<?php echo addslashes($data2); ?>');<?php } ?>
            });
        </script>
    <?php } ?>
    <?php if($_GET['debug'] == 1) {
        echo '<div class="modal fade" id="modalDebug" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header">
                <h4 class="modal-title" id="defaultDebugLabel">Debug</h4></div><div class="modal-body">';
        foreach ($_SESSION as $lihat_session => $val) {
            echo('$_SESSION[\''.$lihat_session.'\']: '.$_SESSION[$lihat_session].'<br />');
        }
        foreach ($_COOKIE as $lihat_session2 => $val2) {
            echo('$_COOKIE[\''.$lihat_session2.'\']: '.$_COOKIE[$lihat_session2].'<br />');
        }
        echo '</div><div class="modal-footer"><button type="button" class="btn btn-link" data-dismiss="modal">TUTUP</button>
            </div></div></div></div>';
        ?>
        <script>
            $('#modalDebug').modal('show');
        </script>
    <?php } ?>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            $(".preloader").fadeOut();
        });
    </script>
    </body>

    </html>
<?php
mysqli_close($conn);
?>