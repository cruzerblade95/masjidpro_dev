<?php

include ('connection/connection_qr.php');
include ('fungsi.php');
include ('fungsi_tarikh.php');

require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;

if($BearerToken != NULL) {
    $BearerToken = explode("|", $BearerToken);
    $personal_access_token = $BearerToken[1];
    $checkToken = "SELECT tokenable_type, tokenable_id FROM personal_access_tokens WHERE token = SHA2('$personal_access_token', 256)";
    selValueSQL($checkToken ,'checkToken');
    $needle = $row_checkToken['tokenable_type'];
    if(strpos("Sej6xDataPeribadi", $needle) !== false) $checkLogin = "SELECT a.no_ic, a.id_masjid, a.nama_penuh, a.no_hp, 1 AS jenisUser, a.id_data AS IDUser FROM sej6x_data_peribadi a WHERE a.id_data = ".$row_checkToken['tokenable_id'];
    else if(strpos("Sej6xDataAnakqariah", $needle) !== false) $checkLogin = "SELECT b.no_ic, b.id_masjid, b.nama_penuh, b.no_tel 'no_hp', 3 AS jenisUser, b.ID AS IDUser FROM sej6x_data_anakqariah b WHERE b.ID = ".$row_checkToken['tokenable_id'];
    else if(strpos("ApproveQariah", $needle) !== false) $checkLogin = "SELECT b.no_ic, b.id_masjid, b.nama_penuh, b.no_tel 'no_hp', 4 AS jenisUser, b.id AS IDUser FROM approve_qariah b WHERE b.id = ".$row_checkToken['tokenable_id'];
    else if(strpos("ApproveAnak", $needle) !== false) $checkLogin = "SELECT b.no_ic, b.id_masjid, b.nama_penuh, b.no_tel 'no_hp', 5 AS jenisUser, b.ID AS IDUser FROM approve_anak b WHERE b.ID = ".$row_checkToken['tokenable_id'];
    else if(strpos("LuarKawasanKariah", $needle) !== false) $checkLogin = "SELECT b.no_ic, b.id_masjid, b.nama_penuh, b.no_tel 'no_hp', 6 AS jenisUser, b.ID AS IDUser FROM luarkawasan_qariah b WHERE b.id = ".$row_checkToken['tokenable_id'];


    //echo($checkToken.'<br />'.$checkLogin);
    selValueSQL($checkLogin ,'checkLogin');
    if($num_checkLogin > 0) {
        foreach ($_GET as $key => $val) $_SESSION['autoLogin_' . $key] = mysqli_real_escape_string($bd2, $val);
        $_SESSION['autoLogin_idMasjid'] = $row_checkLogin['id_masjid'];
        $_SESSION['autoLogin_namaPenuh'] = $row_checkLogin['nama_penuh'];
        $_SESSION['autoLogin_userid'] = $row_checkLogin['no_ic'];
        $_SESSION['autoLogin_noHP'] = $row_checkLogin['no_hp'];
        $_SESSION['jenisUser'] = $row_checkLogin['jenisUser'];
        $_SESSION['IDUser'] = $row_checkLogin['IDUser'];
        $IDUser = $_SESSION['IDUser'];
        $user_id = $_SESSION['autoLogin_userid'];
        $_SESSION['isLogin'] = 1;
        $id_masjid = $_SESSION['autoLogin_idMasjid'];
        $isLogin = 1;
        $jsonData = json_encode($_SESSION);
//                $myfile = fopen("cariAhliLogin.txt", "w") or die("Unable to open file!");
//                fwrite($myfile, $checkLogin.' :: '.$jsonData);
//                fclose($myfile);
    }
    else {
        $_SESSION['isLogin'] = 0;
        $isLogin = 0;
    }
}

$id_masjid = $_GET['id_masjid'];
if($_GET['lat'] != NULL && $_GET['long'] != NULL) {
    $lat = $_GET['lat'];
    $lng = $_GET['long'];
}
else {
    $lat = 0;
    $lng = 0;
}
//$sql_masjid = "SELECT *, @jarak := ( 6371 * acos( cos( radians($lat) ) * cos( radians( koordinat_y ) ) * cos( radians( koordinat_x ) - radians($lng) ) + sin( radians($lat) ) * sin(radians(koordinat_y)) ) ) AS distance, ROUND(@jarak, 2) 'jarakRadiusKM' FROM sej6x_data_masjid WHERE id_masjid='$id_masjid' HAVING distance <= 1";
$sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$id_masjid'";
$query_masjid = mysqli_query($conn,$sql_masjid);
$num_masjid = mysqli_num_rows($query_masjid);
$data_masjid = mysqli_fetch_array($query_masjid);

$date = date('Y-m-d H:i:s');
if($BearerToken != NULL) {
    $user_id = $_SESSION['autoLogin_userid'];
    $jenisUser = $_SESSION['jenisUser'];
    $token = $BearerToken;
    $no_ic_data = $_SESSION['autoLogin_userid'];
    $sql = "SELECT a.nama_penuh 'nama_penuh', a.no_ic 'no_ic', b.jawatan 'jawatan' FROM sej6x_data_peribadi a, data_pegawai_masjid b WHERE a.no_ic = '".$_SESSION['autoLogin_userid']."' AND a.id_data=b.id_pegawai AND b.id_masjid='$id_masjid'
UNION SELECT c.nama_penuh 'nama_penuh', c.no_ic 'no_ic', d.jawatan 'jawatan' FROM sej6x_data_anakqariah c, data_pegawai_masjid d WHERE c.no_ic = '".$_SESSION['autoLogin_userid']."' AND c.id_qariah=d.id_pegawai2 AND d.id_masjid='$id_masjid'
    UNION SELECT e.nama_penuh 'nama_penuh', e.no_ic 'no_ic', e.jawatan 'jawatan' FROM data_pegawai_masjid e WHERE e.no_ic='".$_SESSION['autoLogin_userid']."' AND e.id_masjid='$id_masjid'";
}
else {
    $user_id = $_GET['userid'];
    $jenisUser = $_GET['jenisUser'];
    $token = $_GET['token'];
    $no_ic_data = $_GET['userid'];
    $sql = "SELECT a.nama_penuh 'nama_penuh', a.no_ic 'no_ic', b.jawatan 'jawatan' FROM sej6x_data_peribadi a, data_pegawai_masjid b WHERE a.no_ic = '$user_id' AND a.jenisUser = $jenisUser AND a.firebase_token = '$token' AND a.id_data=b.id_pegawai AND b.id_masjid='$id_masjid'
UNION SELECT c.nama_penuh 'nama_penuh', c.no_ic 'no_ic', d.jawatan 'jawatan' FROM sej6x_data_anakqariah c, data_pegawai_masjid d WHERE c.no_ic = '$user_id' AND c.jenisUser = $jenisUser AND c.firebase_token = '$token' AND c.id_qariah=d.id_pegawai2 AND d.id_masjid='$id_masjid'
    UNION SELECT e.nama_penuh 'nama_penuh', e.no_ic 'no_ic', e.jawatan 'jawatan' FROM data_pegawai_masjid e WHERE e.no_ic='$user_id' AND e.id_masjid='$id_masjid'";
}

$sqlquery = mysqli_query($conn,$sql);
$row = mysqli_num_rows($sqlquery);
$data = mysqli_fetch_array($sqlquery);

if($num_masjid > 0) {



    if($row>0) {

        $sql1 = "INSERT INTO kehadiran_pegawai (id_masjid,no_ic,masa) VALUES ('$id_masjid','$user_id','$date')";
        $sqlquery1 = mysqli_query($conn,$sql1);

        $sql2 = "SELECT * FROM sej6x_data_perkarakehadiran";
        $sqlquery2 = mysqli_query($conn, $sql2);

        while ($data2 = mysqli_fetch_array($sqlquery2)) {

            $waktu_solat = $data2['perkara'];
            if ($waktu_solat == 'Solat Subuh') {
                $mula_subuh = $data2['masa_mula'];
                $tamat_subuh = $data2['masa_tamat'];
            } else if ($waktu_solat == 'Solat Zohor') {
                $mula_zohor = $data2['masa_mula'];
                $tamat_zohor = $data2['masa_tamat'];
            } else if ($waktu_solat == 'Solat Asar') {
                $mula_asar = $data2['masa_mula'];
                $tamat_asar = $data2['masa_tamat'];
            } else if ($waktu_solat == 'Solat Maghrib') {
                $mula_maghrib = $data2['masa_mula'];
                $tamat_maghrib = $data2['masa_tamat'];
            } else if ($waktu_solat == 'Solat Isyak') {
                $mula_isyak = $data2['masa_mula'];
                $tamat_isyak = $data2['masa_tamat'];
            }

        }

        $tarikh = date('Y-m-d');

        $mula_subuh = date_create($mula_subuh);
        $mula_subuh = date_format($mula_subuh, 'H:i:s');

        $tamat_subuh = date_create($tamat_subuh);
        $tamat_subuh = date_format($tamat_subuh, 'H:i:s');

        $waktu_mula_subuh = $tarikh . " " . $mula_subuh;
        $waktu_tamat_subuh = $tarikh . " " . $tamat_subuh;

        if ($date >= $waktu_mula_subuh && $date <= $waktu_tamat_subuh) {
            $sql_subuh = "SELECT DATE_FORMAT(masa, '%r') 'Waktu Hadir' FROM kehadiran_pegawai WHERE id_masjid='$id_masjid' AND no_ic='$user_id' AND masa BETWEEN DATE_FORMAT('$waktu_mula_subuh', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat_subuh', '%Y-%m-%d %H:%i:%s') GROUP BY year(masa), month(masa), day(masa), hour(masa)";
            $query_subuh = mysqli_query($conn, $sql_subuh);
            $bil_subuh = mysqli_num_rows($query_subuh);


            if ($bil_subuh == 0) {
                $sql1 = "INSERT INTO kehadiran_pegawai (id_masjid,no_ic,masa) VALUES ('$id_masjid','$user_id','$date')";
                //$sqlquery1 = mysqli_query($conn,$sql1);
            }
        }

        $mula_zohor = date_create($mula_zohor);
        $mula_zohor = date_format($mula_zohor, 'H:i:s');

        $tamat_zohor = date_create($tamat_zohor);
        $tamat_zohor = date_format($tamat_zohor, 'H:i:s');

        $waktu_mula_zohor = $tarikh . " " . $mula_zohor;
        $waktu_tamat_zohor = $tarikh . " " . $tamat_zohor;

        if ($date >= $waktu_mula_zohor && $date <= $waktu_tamat_zohor) {
            $sql_zohor = "SELECT DATE_FORMAT(masa, '%r') 'Waktu Hadir' FROM kehadiran_pegawai WHERE id_masjid='$id_masjid' AND no_ic='$user_id' AND masa BETWEEN DATE_FORMAT('$waktu_mula_zohor', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat_zohor', '%Y-%m-%d %H:%i:%s') GROUP BY year(masa), month(masa), day(masa), hour(masa)";
            $query_zohor = mysqli_query($conn, $sql_zohor);
            $bil_zohor = mysqli_num_rows($query_zohor);

            if ($bil_zohor == 0) {
                $sql1 = "INSERT INTO kehadiran_pegawai (id_masjid,no_ic,masa) VALUES ('$id_masjid','$user_id','$date')";
                //$sqlquery1 = mysqli_query($conn,$sql1);
            }
        }

        $mula_asar = date_create($mula_asar);
        $mula_asar = date_format($mula_asar, 'H:i:s');

        $tamat_asar = date_create($tamat_asar);
        $tamat_asar = date_format($tamat_asar, 'H:i:s');

        $waktu_mula_asar = $tarikh . " " . $mula_asar;
        $waktu_tamat_asar = $tarikh . " " . $tamat_asar;

        if ($date >= $waktu_mula_asar && $date <= $waktu_tamat_asar) {
            $sql_asar = "SELECT DATE_FORMAT(masa, '%r') 'Waktu Hadir' FROM kehadiran_pegawai WHERE id_masjid='$id_masjid' AND no_ic='$user_id' AND masa BETWEEN DATE_FORMAT('$waktu_mula_asar', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat_asar', '%Y-%m-%d %H:%i:%s') GROUP BY year(masa), month(masa), day(masa), hour(masa)";
            $query_asar = mysqli_query($conn, $sql_asar);
            $bil_asar = mysqli_num_rows($query_asar);

            if ($bil_asar == 0) {
                $sql1 = "INSERT INTO kehadiran_pegawai (id_masjid,no_ic,masa) VALUES ('$id_masjid','$user_id','$date')";
                //$sqlquery1 = mysqli_query($conn,$sql1);
            }
        }

        $mula_maghrib = date_create($mula_maghrib);
        $mula_maghrib = date_format($mula_maghrib, 'H:i:s');

        $tamat_maghrib = date_create($tamat_maghrib);
        $tamat_maghrib = date_format($tamat_maghrib, 'H:i:s');

        $waktu_mula_maghrib = $tarikh . " " . $mula_maghrib;
        $waktu_tamat_maghrib = $tarikh . " " . $tamat_maghrib;

        if ($date >= $waktu_mula_maghrib && $date <= $waktu_tamat_maghrib) {
            $sql_maghrib = "SELECT DATE_FORMAT(masa, '%r') 'Waktu Hadir' FROM kehadiran_pegawai WHERE id_masjid='$id_masjid' AND no_ic='$user_id' AND masa BETWEEN DATE_FORMAT('$waktu_mula_maghrib', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat_maghrib', '%Y-%m-%d %H:%i:%s') GROUP BY year(masa), month(masa), day(masa), hour(masa)";
            $query_maghrib = mysqli_query($conn, $sql_maghrib);
            $bil_maghrib = mysqli_num_rows($query_maghrib);

            if ($bil_maghrib == 0) {
                $sql1 = "INSERT INTO kehadiran_pegawai (id_masjid,no_ic,masa) VALUES ('$id_masjid','$user_id','$date')";
                //$sqlquery1 = mysqli_query($conn,$sql1);
            }
        }

        $mula_isyak = date_create($mula_isyak);
        $mula_isyak = date_format($mula_isyak, 'H:i:s');

        $tamat_isyak = date_create($tamat_isyak);
        $tamat_isyak = date_format($tamat_isyak, 'H:i:s');

        $waktu_mula_isyak = $tarikh . " " . $mula_isyak;
        $waktu_tamat_isyak = $tarikh . " " . $tamat_isyak;

        if ($date >= $waktu_mula_isyak && $date <= $waktu_tamat_isyak) {
            $sql_isyak = "SELECT DATE_FORMAT(masa, '%r') 'Waktu Hadir' FROM kehadiran_pegawai WHERE id_masjid='$id_masjid' AND no_ic='$user_id' AND masa BETWEEN DATE_FORMAT('$waktu_mula_isyak', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat_isyak', '%Y-%m-%d %H:%i:%s') GROUP BY year(masa), month(masa), day(masa), hour(masa)";
            $query_isyak = mysqli_num_rows($conn, $sql_isyak);
            $bil_isyak = mysqli_num_rows($query_isyak);

            if ($bil_isyak == 0) {
                $sql1 = "INSERT INTO kehadiran_pegawai (id_masjid,no_ic,masa) VALUES ('$id_masjid','$user_id','$date')";
                //$sqlquery1 = mysqli_query($conn,$sql1);
            }
        }

        $sql3 = "SELECT * FROM kehadiran_pegawai WHERE no_ic='$user_id'";
        $sqlquery3 = mysqli_query($conn, $sql3);

    }
}
//where no_ic = $_GET['userid'] and jenisUser = $_GET['jenisUser'] and token = $_GET['token']
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
    <meta name="description" content="Masjid Pro - Rekod Kehadiran">
    <meta name="author" content="Masjid Pro">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="images/logo2.png">
    <title>Masjid Pro - Rekod Kehadiran Pegawai Masjid</title>

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
        <p class="loader__label">Masjid Pro</p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper">
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
                            <center><h5><u>REKOD KEHADIRAN PEGAWAI MASJID</u></h5></center>
                            <?php if($detect->isMobile()) { ?>
                                <?php if($no_ic_data == NULL) { ?>
                                    <div class="alert alert-danger" role="alert" style="font-weight: bold">
                                        Sila log masuk terlebih dahulu dan scan semula kehadiran
                                    </div>
                                <?php } else if($data['no_ic'] != NULL && $row > 0 && $num_masjid > 0) { ?>
                                    <div class="alert alert-info" role="alert" style="font-weight: bold">
                                        <?php echo($data_masjid['nama_masjid']); ?>
                                    </div>
                                    <div class="alert alert-info" role="alert" style="font-weight: bold">
                                        Nama : <?php echo($data['nama_penuh']); ?><br />
                                        No K/P : <?php echo($data['no_ic']); ?><br />
                                        Jawatan : <?php echo strtoupper($data['jawatan']); ?>
                                    </div>
                                    <div class="alert alert-success" role="alert" style="font-weight: bold" align="center">
                                        Kehadiran Berjaya Direkodkan
                                    </div>
                                    <div class="alert alert-success" role="alert" style="font-weight: bold" align="center">

                                        <img width="64" height="64" class="img-fluid" src="images/daftar_solat_lulus.png" style="float: left;">
                                        <?php fungsi_tarikh($masa, 2, 4); ?><br />
                                        Jam: <?php fungsi_tarikh($masa, 5, 2); ?>
                                    </div>
                                    <?php
                                    if($data['no_ic'] == "840827025081") echo($_GET['lat'].' : '.$_GET['long']);
                                }
                                else if($row > 0 && $num_masjid < 1) {
                                    ?>
                                    <div class="alert alert-warning" role="alert" style="font-weight: bold">
                                        Anda tidak berada di sekitar kawasan, sila hidupkan / benarkan akses aplikasi ini untuk menggunakan fungsi lokasi GPS pada telefon pintar anda
                                    </div>
                                <?php } else if($row==0) { ?>
                                    <div class="alert alert-danger" role="alert" style="font-weight: bold">
                                        Anda perlu berdaftar sebagai Pegawai Masjid
                                    </div>
                                <?php } } ?>
                        </div>
                        <?php
                        if(!$detect->isMobile()) { ?>
                            <div class="alert alert-danger" role="alert" style="font-weight: bold">
                                Halaman ini hanya boleh diakses melaui telefon pintar atau tablet.
                            </div>
                        <?php } ?>
                    </div>
                </div>
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
<script src="themes/elite/node_modules/jquery/jquery-3.2.1.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="themes/elite/node_modules/popper/popper.min.js"></script>
<script src="themes/elite/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<!--Custom JavaScript -->
<script type="text/javascript">
    <?php if ($detect->isMobile()) { ?>
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
                <?php if($no_ic_data != NULL && $_GET['lokasi'] != NULL && $_POST['no_ic'] == NULL) { ?>$('#tekan').click();<?php } ?>
            }
            //if(xxx == null || yyy == null) tiada_lokasi();
        });
    }
    $(document).ready(function(){
        getLocation();
    });
    <?php } ?>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    });
</script></body>

</html>
<?php
if($_GET['id_masjid'] == 6279) {
//    foreach ($_GET as $key => $val) echo($key.' : '.$val.'<br />');
//    foreach ($_SESSION as $key => $val) echo($key.' : '.$val.'<br />');
//    echo($sql);
}
?>

