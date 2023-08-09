<?php

//header("Location: http://webapp.masjidpro.com/kehadiran_pengurusan.php");

include ('connection/connection_qr.php');
include ('fungsi.php');
include ('fungsi_tarikh.php');

require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;

if($BearerToken != NULL) {
    $BearerToken = explode("|", $BearerToken);
    $personal_access_token = $BearerToken[1];
    $checkToken = "SELECT IF(tokenable_type LIKE '%Sej6xDataAnakqariah%', tokenable_id, '') 'tokenAnak', IF(tokenable_type LIKE '%Sej6xDataPeribadi%', tokenable_id, '') 'tokenKK' FROM personal_access_tokens WHERE token = SHA2('$personal_access_token', 256)";
    selValueSQL($checkToken ,'checkToken');
    $checkLogin = "SELECT a.no_ic, a.id_masjid, a.nama_penuh, a.no_hp, 1 AS jenisUser, a.id_data AS IDUser FROM sej6x_data_peribadi a WHERE a.id_data = '".$row_checkToken['tokenKK']."' UNION ";
    $checkLogin .= "SELECT b.no_ic, b.id_masjid, b.nama_penuh, b.no_tel 'no_hp', 2 AS jenisUser, b.ID AS IDUser FROM sej6x_data_anakqariah b WHERE b.ID = '".$row_checkToken['tokenAnak']."'";
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

$sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$id_masjid'";
$query_masjid = mysqli_query($conn,$sql_masjid);
$data_masjid = mysqli_fetch_array($query_masjid);

$date = date('Y-m-d H:i:s');

if($BearerToken != NULL) {
    $user_id = $_SESSION['autoLogin_userid'];
    $jenisUser = $_SESSION['jenisUser'];
    $token = $BearerToken;
    $no_ic_data = $_SESSION['autoLogin_userid'];
    $sql = "SELECT a.nama_penuh 'nama_penuh', a.no_ic 'no_ic', b.jawatan 'jawatan' FROM data_pengurusan_masjid a, jawatan_pengurusan_masjid b WHERE a.no_ic = '".$_SESSION['autoLogin_userid']."' AND a.jawatan=b.id_jawatan";
}
else {
    $user_id = $_GET['userid'];
    $jenisUser = $_GET['jenisUser'];
    $token = $_GET['token'];
    $no_ic_data = $_GET['userid'];
    $sql = "SELECT a.nama_penuh 'nama_penuh', a.no_ic 'no_ic', b.jawatan 'jawatan' FROM data_pengurusan_masjid a, jawatan_pengurusan_masjid b WHERE a.no_ic = '$no_ic_data' AND a.jawatan=b.id_jawatan";
}

$sqlquery = mysqli_query($conn,$sql);
$row = mysqli_num_rows($sqlquery);
$data = mysqli_fetch_array($sqlquery);

if($row>0){
    $sql1 = "SELECT * FROM kehadiran_pengurusan WHERE no_ic='$user_id' AND masa='$date'";
    $sqlquery1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_num_rows($sqlquery1);

    if($row1==0){
        if(isset($_POST['pilih_masa'])) {
            $pilih_masa = $_POST['pilih_masa'];
            $sql2 = "INSERT INTO kehadiran_pengurusan (id_masjid,no_ic,masa,jenis_imbas) VALUES ('$id_masjid','$user_id','$date','$pilih_masa')";
            $sqlquery2 = mysqli_query($conn, $sql2);
        }
    }
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
    <title>Masjid Pro - Rekod Kehadiran Pengurusan Masjid</title>

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
                            <?php if(!isset($_POST['pilih_masa'])){ ?>
                                <form action="<?php $PHP_SELF; ?>" method="POST">
                                    <center>
                                        <input type="hidden" name="pilih_masa" value="Masuk">
                                        <button class="btn btn-success form-control" onClick="">Imbas Masuk</button>
                                    </center>
                                </form>
                                <hr>
                                <form action="<?php $PHP_SELF; ?>" method="POST">
                                    <center>
                                        <input type="hidden" name="pilih_masa" value="Keluar">
                                        <button class="btn btn-danger form-control" onClick="">Imbas Keluar</button>
                                    </center>
                                </form>
                                <?php }
                                else { ?>
                            <center><h5><u>REKOD KEHADIRAN PENGURUSAN MASJID</u></h5></center>
                            <?php if($detect->isMobile()) { ?>
                                <?php if($no_ic_data == NULL) { ?>
                                    <div class="alert alert-danger" role="alert" style="font-weight: bold">
                                        Sila log masuk terlebih dahulu dan scan semula kehadiran
                                    </div>
                                <?php }
                                if($data['no_ic'] != NULL && $row > 0) { ?>
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
                                        <?php fungsi_tarikh($masa, 2, 4); ?><br />
                                        Jam: <?php fungsi_tarikh($masa, 5, 2); ?>
                                    </div>
                                <?php
                                }
                                ?>
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

