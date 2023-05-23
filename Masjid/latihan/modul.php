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
                            Modul Latihan
                        </h1>
                    </div>
                    <div class="gen-breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home mr-2"></i>Utama</a></li>
                            <li class="breadcrumb-item active">Modul</li>
                        </ol>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb -->


<?php

$sql_modul = "SELECT * FROM modul_video";
$query_modul = mysqli_query($bd2,$sql_modul);
$i=1;
while($data_modul = mysqli_fetch_array($query_modul)){
    ?>
    <!-- owl-carousel Videos Section-1 Start -->
    <section class="gen-section-padding-2" style="padding: 50px 0 0px">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <h4 class="gen-heading-title"><?php echo $i.".".$data_modul['nama_modul']; ?></h4>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 d-none d-md-inline-block">
                    <div class="gen-movie-action">
                        <div class="gen-btn-container text-right">
                            <a href="modul_video.php?id_modul=<?php echo $data_modul['id_modul']; ?>" class="gen-button gen-button-flat">
                                <span class="text">Video Lain</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="gen-style-2">
                        <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true" data-desk_num="4"
                             data-lap_num="3" data-tab_num="2" data-mob_num="1" data-mob_sm="1" data-autoplay="false"
                             data-loop="false" data-margin="30">
                            <?php
                            $id_modul = $data_modul['id_modul'];
                            $sql_video = "SELECT * FROM list_video WHERE id_modul='$id_modul'";
                            $query_video = mysqli_query($bd2,$sql_video);
                            $j=1;
                            while($data_video = mysqli_fetch_array($query_video)){
                                ?>
                                <div class="item">
                                    <div class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                        <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                            <div class="gen-movie-contain">
                                                <div class="gen-movie-img">
                                                    <img src="images/thumbnail_masjidpro.png" alt="owl-carousel-video-image">
                                                    <div class="gen-movie-action">
                                                        <a href="<?php echo $data_video['link_video']; ?>" class="gen-button">
                                                            <i class="fa fa-play"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="gen-info-contain">
                                                    <div class="gen-movie-info">
                                                        <h3><a href="<?php echo $data_video['link_video']; ?>"><?php echo $i.".".$j."&nbsp;".$data_video['nama_video']; ?></a>
                                                        </h3>
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
                                    <!-- #post-## -->
                                </div>
                                <?php
                                $j++;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- owl-carousel Videos Section-1 End -->
    <?php
    $i++;
}
?>

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