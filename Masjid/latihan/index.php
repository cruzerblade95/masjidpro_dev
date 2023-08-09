<?php

session_start();
include('../connection/connection.php');
if($_SESSION['id_masjid']=="" OR $_SESSION['id_masjid']==NULL)
{
    header("Location: https://masjidpro.com/Masjid/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="Streamlab - Video Streaming HTML5 Template" />
    <meta name="description" content="Streamlab - Video Streaming HTML5 Template" />
    <meta name="author" content="StreamLab" />
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
    <!-- Font Awesome -->
    <link href="font-awesome/css/all.css" rel="stylesheet">
</head>

<body>

<!--=========== Loader =============-->
<div id="gen-loading">
    <div id="gen-loading-center">
        <img src="images/logo.png" alt="loading">
    </div>
</div>
<!--=========== Loader =============-->

<!--========== Header ==============-->
<header id="gen-header" class="gen-header-style-1 gen-has-sticky">
    <div class="gen-bottom-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="../utama.php?view=admin&action=utama">
                            <img class="img-fluid logo" src="images/logo.png" alt="Sistem MasjidPro">
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!--========== Header ==============-->

<!-- owl-carousel Banner Start -->
<section class="pt-0 pb-0">
    <div class="container-fluid px-0">
        <div class="row no-gutters">
            <div class="col-12">
                <div class="gen-banner-movies banner-style-2">
                    <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true" data-desk_num="1"
                         data-lap_num="1" data-tab_num="1" data-mob_num="1" data-mob_sm="1" data-autoplay="true"
                         data-loop="true" data-margin="0">
                        <div class="item" style="height:500px">
                            <div class="gen-movie-contain-style-2 h-100">
                                <div class="container h-100">
                                    <div class="row flex-row-reverse align-items-center h-100">
                                        <div class="col-xl-6">
                                            <div class="gen-front-image">
                                                <img src="images/thumbnail_masjidpro.png" alt="owl-carousel-banner-image">
                                                <a href="video/intro.mp4" class="playBut popup-youtube popup-vimeo popup-gmaps">
                                                    <!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In  -->
                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="213.7px"
                                                         height="213.7px" viewBox="0 0 213.7 213.7"
                                                         enable-background="new 0 0 213.7 213.7" xml:space="preserve">
                                             <polygon class="triangle" id="XMLID_17_" fill="none" stroke-width="7"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                      points="
                                                            73.5,62.5 148.5,105.8 73.5,149.1 "></polygon>
                                                        <circle class="circle" id="XMLID_18_" fill="none" stroke-width="7"
                                                                stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                                cx="106.8" cy="106.8" r="103.3">
                                                        </circle>
                                          </svg>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="gen-movie-info">
                                                <h3>Latihan Bimbingan MasjidPro</h3>
                                            </div>
                                            <div class="gen-movie-action">
                                                <div class="gen-btn-container">
                                                    <a href="video/intro.mp4" class="gen-button .gen-button-dark">
                                                        <i aria-hidden="true" class="fas fa-play"></i> <span class="text">Lihat Video</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- owl-carousel Banner End -->

<!-- Icon-Box Start -->
<section class="gen-section-padding-3">
    <div class="container container-2">
        <div class="row">
            <div class="col-xl-4 col-md-6 offset-2" onclick="location.href='manual.pdf';">
                <div class="gen-icon-box-style-1">
                    <div class="gen-icon-box-icon">
                            <span class="gen-icon-animation">
                                <i class="fas fa-book"></i></span>
                    </div>
                    <div class="gen-icon-box-content">
                        <h3 class="pt-icon-box-title mb-2">
                            <span>Manual Latihan</span>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mt-4 mt-md-0" onclick="location.href='modul.php';">
                <div class="gen-icon-box-style-1">
                    <div class="gen-icon-box-icon">
                            <span class="gen-icon-animation">
                                <i class="fas fa-video"></i></span>
                    </div>
                    <div class="gen-icon-box-content">
                        <h3 class="pt-icon-box-title mb-2">
                            <span>Video Latihan</span>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Icon-Box End -->

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