<?php
require_once '../Mobile_Detect.php';
$detect = new Mobile_Detect;
include("connection.php");
if($_GET['dapatkanSesi'] == 1) {
    if($_SESSION['no_ic'] != NULL) {
        $session_code = base64_encode(bin2hex($_SESSION['no_ic']));
        header("Location: https://daftarsolat.masjidpro.com/?sessionId=$session_code");
        exit;
    }
    $redirect = "daftar_solat";
}
if($_SESSION['no_ic'] != NULL) $btnLogin = "KEMASKINI PROFIL";
else $btnLogin = "LOG MASUK";
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
    <meta name="description" content="Masjid Pro - Kemaskini Maklumat">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/logo2.png">
    <title>Masjid Pro - Utama</title>

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
    <div class="login-register2" style="background-image:url(../themes/elite/images/background/login-register.jpg);">
        <div class="login-box2 card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" action="index.html">
                    <div class="col-12 text-center">
                        <div class="user-thumb text-center">
                            <?php
                            if($_GET['keterangan'] == 1 || $_GET['keterangan'] == NULL) $logo = "../images/logo.gif";
                            if($_GET['keterangan'] == 2) $logo = "../picture/logoGoMasjid.png";
                            ?>
                            <img alt="Masjid Pro" style="max-width: 300px" class="img-fluid" src="<?php echo($logo); ?>">
                            <hr />
                        </div>
                    </div>
                    <?php if($_GET['offWaktuSolat'] != 1) { ?>
                    <?php if($_GET['keterangan'] != 1 && $_GET['keterangan'] != 2) { if($_GET['dapatkanSesi'] == 1) { ?>
                        <div class="form-group text-center">
                            <div class="col-xs-12">
                                <div class="alert alert-danger" role="alert">
                                    Hanya ahli kariah berdaftar sahaja boleh memohon slot waktu solat
                                </div>
                                <div class="alert alert-info" role="alert">
                                    Sila log masuk sekiranya anda telah sah berdaftar atau membuat pendaftaran sebagai ahli kariah terlebih dahulu
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                        <?php if($_SESSION['no_ic'] == NULL) { ?>
                            <div class="form-group text-center">
                                <div class="col-xs-12">
                                    <a href="pilih_masjid.php"><button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="button">Daftar Ahli Kariah</button></a>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group text-center">
                            <div class="col-xs-12">
                                <a href="kemaskini.php?logmasuk=1&redirect=<?php echo($redirect); ?>">
                                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="button"><?php echo($btnLogin); ?></button>
                                </a>
                            </div>
                        </div>
                        <?php if($_SESSION['no_ic'] != NULL) { ?>
                            <div class="form-group text-center">
                                <div class="col-xs-12">
                                    <a href="index.php?action=keluar"><button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="button">Log Keluar</button></a>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group text-center" style="display: none">
                            <div class="col-xs-12">
                                <a href="javascript:history.back(-100);"><button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="button">Menu Utama</button></a>
                            </div>
                        </div>
                    <?php } else {
                    $q = "SELECT a.nama_masjid, a.no_tel, CONCAT(a.alamat_masjid, ', ', a.poskod, ' ', c.nama_daerah, ', ', b.name) AS alamat FROM sej6x_data_masjid a, negeri b, daerah c WHERE a.id_negeri = b.id_negeri AND a.id_daerah = c.id_daerah AND (a.url_masjid IS NOT NULL OR a.url_daftar IS NOT NULL) AND a.id_masjid NOT IN (6279, 6284, 6285)";
                    $q2 = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
                    $row_q = mysqli_fetch_assoc($q2);
                    ?>
                    <div class="form-group text-center">
                        <div class="col-12">
                            <div class="alert alert-info" role="alert">
                                <strong>Pendaftaran sebagai ahli kariah boleh dibuat di senarai Masjid seperti berikut:-</strong>
                            </div>
                        </div>
                        <div class="col-12">
                            <img style="max-height: 400px" class="img-fluid" src="../picture/gambarDaftar.jpg">
                        </div>
                        <hr />
                        <div class="table-responsive">
                            <table class="table table-sm table-hover table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Masjid</th>
                                    <th scope="col">Alamat</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; do { ?>
                                    <tr>
                                        <th scope="row"><?php echo($i); ?></th>
                                        <td align="left"><?php echo($row_q['nama_masjid']); ?></td>
                                        <td align="left"><?php echo($row_q['alamat']); ?><?php if($row_q['no_tel'] != NULL) echo('<br />'.$row_q['no_tel']); ?></td>
                                    </tr>
                                    <?php $i++; } while($row_q = mysqli_fetch_assoc($q2)); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php } } ?>
                </form>
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
    $(function() {
        $(".preloader").fadeOut();
    });
</script>
<?php if($_GET['notifyApp'] == 1 || ($detect->isiOS() && $_GET['keterangan'] != 1 && $_GET['keterangan'] != 2)) include("../notifyApp.php"); ?>
<?php //if($_GET['notifyApp'] == 1) include("../notifyApp.php"); ?>
</body>

</html>