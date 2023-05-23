<?php

if(!isset($_GET['id_modul'])){
    header("Location: index.php");
}

session_start();
include('../connection/connection.php');
if($_SESSION['id_masjid']=="" OR $_SESSION['id_masjid']==NULL)
{
    header("Location: https://masjidpro.com/Masjid/login.php");
}

$id_modul = $_GET['id_modul'];

$sql_modul = "SELECT * FROM modul_video WHERE id_modul='$id_modul'";
$query_modul = mysqli_query($bd2,$sql_modul);
$data_modul = mysqli_fetch_array($query_modul);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="Hostingo HTML5 Template" />
    <meta name="description" content="Hostingo Html5 template" />
    <meta name="author" content="Hostingo" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Latihan Bimbingan - MasjidPro</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <!-- CSS bootstrap-->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!--  Style -->
    <link rel="stylesheet" href="css/style.css" />
    <!--  Responsive -->
    <link rel="stylesheet" href="css/responsive.css" />
</head>

<body>

<!--=========== Loader =============-->
<div id="gen-loading">
    <div id="gen-loading-center">
        <img src="images/logo.png" alt="loading">
    </div>
</div>
<!--=========== Loader =============-->

<!-- breadcrumb -->
<div class="gen-breadcrumb">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <div class="gen-breadcrumb-title">
                        <h1>
                            <?php echo $data_modul['nama_modul'];?>
                        </h1>
                    </div>
                    <div class="gen-breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home mr-2"></i>Utama</a></li>
                            <li class="breadcrumb-item"><a href="modul.php">Modul</a></li>
                            <li class="breadcrumb-item active"><?php echo $data_modul['nama_modul']; ?></li>
                        </ol>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb -->

<!-- Section-1 Start -->
<section class="gen-section-padding-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <?php
                    $sql_video = "SELECT * FROM list_video  WHERE id_modul='$id_modul'";
                    $query_video = mysqli_query($bd2,$sql_video);
                    $i=1;
                    while($data_video = mysqli_fetch_array($query_video)){
                    ?>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gen-carousel-movies-style-3 movie-grid style-3">
                            <div class="gen-movie-contain">
                                <div class="gen-movie-img">
                                    <img src="images/thumbnail_masjidpro.png" alt="streamlab-image">
                                    <div class="gen-movie-action">
                                        <a href="<?php echo $data_video['link_video']; ?>" class="gen-button">
                                            <i class="fa fa-play"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="gen-info-contain">
                                    <div class="gen-movie-info">
                                        <h3><a href="<?php echo $data_video['link_video']; ?>"><?php echo $i.".&nbsp;".$data_video['nama_video']; ?></a></h3>
                                    </div>
                                    <div class="gen-movie-meta-holder">
                                        <ul>
                                            <li>
                                                <a href="modul_video.php?id_modul=<?php echo $data_modul['id_modul']; ?>"><span><?php echo $data_modul['nama_modul']; ?></span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        $i++;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section-1 End -->


<!-- Back-to-Top start -->
<div id="back-to-top">
    <a class="top" id="top" href="#top"> <i class="ion-ios-arrow-up"></i> </a>
</div>
<!-- Back-to-Top end -->

<!-- js-min -->
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/asyncloader.min.js"></script>
<!-- JS bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- owl-carousel -->
<script src="js/owl.carousel.min.js"></script>
<!-- counter-js -->
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<!-- popper-js -->
<script src="js/popper.min.js"></script>
<script src="js/swiper-bundle.min.js"></script>
<!-- Iscotop -->
<script src="js/isotope.pkgd.min.js"></script>

<script src="js/jquery.magnific-popup.min.js"></script>

<script src="js/slick.min.js"></script>

<script src="js/streamlab-core.js"></script>

<script src="js/script.js"></script>


</body>

</html>