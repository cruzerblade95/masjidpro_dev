<?php
//include('connection/connection.php');
if($_SESSION['id_masjid'] != NULL) {
    $sql3 = "SELECT IFNULL(SUM(1), 0) 'pending' FROM approve_qariah WHERE id_masjid=$id_masjid";
    $sqlquery3 = mysqli_query($bd2, $sql3);
    $row3 = mysqli_fetch_assoc($sqlquery3)['pending'];

    $sql4 = "SELECT IFNULL(SUM(1), 0) 'pending' FROM approve_anak a LEFT JOIN approve_qariah b ON a.no_ic_ketua = b.no_ic LEFT JOIN approve_qariah d ON a.id_qariah = d.id LEFT JOIN sej6x_data_peribadi c ON a.no_ic_ketua = c.no_ic WHERE b.id_masjid = $id_masjid OR c.id_masjid = $id_masjid OR d.id_masjid = $id_masjid";
    $sqlquery4 = mysqli_query($bd2, $sql4);
    $row4 = mysqli_fetch_assoc($sqlquery4)['pending'];

    $row_all = $row3 + $row4;
}
else $row_all = 0;
?>
<link href="themes/elite/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
<link href="themes/elite/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="themes/elite/node_modules/chartist-js/dist/chartist.min.css" rel="stylesheet">
<link href="themes/elite/node_modules/chartist-js/dist/chartist-init.css" rel="stylesheet">
<link href="themes/elite/node_modules/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
<link href="themes/elite/node_modules/css-chart/css-chart.css" rel="stylesheet">
<!-- Custom CSS -->
<!--link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.css"-->
<link href="themes/elite/node_modules/switchery/dist/switchery.min.css" rel="stylesheet" />
<link href="themes/elite/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
<link href="themes/elite/dist/css/style.min.css" rel="stylesheet">
<link href="themes/elite/dist/css/pages/ribbon-page.css" rel="stylesheet">
<link href="themes/elite/dist/css/pages/ui-bootstrap-page.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.css" integrity="sha512-9Tu/Gu0+bXW+oGrTGJOeNz2RG4MaF52FznXCciXFrXehFTLF6phJnJFNVOU2mmj9FWIXk9ap0H1ocygu1ZTRqg==" crossorigin="anonymous" />
<link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.css">
<!-- page css -->
<link href="themes/elite/dist/css/pages/widget-page.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style type="text/css">
    .nav-tetap {
        position: -webkit-sticky;
    }
    .sticky-tetap {
        position: fixed;
        width: 100%;
        left: 0;
        top: 0;
        z-index: 100;
        border-top: 0;
    }
    .printPageShow {
        display: none;
    }
    @media print {
        .printPageHide, #tunggu, aside {
            display: none;
        }
        .printPageShow {
            display: unset;
        }
        footer {page-break-after: always;}
    }
    .text-muted {color: #000000}
</style>
<script src="https://kit.fontawesome.com/b5589dbb40.js" crossorigin="anonymous"></script>
</head>
<body class="skin-blue fixed-layout <?php if($_GET['action'] == "utama") echo("single-column"); ?>" style="color: #000000">
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">
            <?php if($_SERVER['SERVER_NAME'] == "sistem.gomasjid.my") { ?>GoMasjid<?php } else { ?>Masjid Pro<?php } ?>
        </p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar nav-tetap">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-header">
                <a class="navbar-brand" href="utama.php?view=admin&action=utama">
                    <!-- Logo icon --><b>
                        <img src="images/logo2.png" alt="homepage" class="logo-kecil img-fluid" width="48" />
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span>
                        <?php if($_SERVER['SERVER_NAME'] == "sistem.gomasjid.my") { ?>
                            <img src="https://gomasjid.my/Masjid/images/logo_gomasjid.png" class="img-fluid" alt="homepage" width="198" />
                        <?php } else { ?>
                            <img src="images/logo.png" class="img-fluid" alt="homepage" width="198" />
                        <?php } ?>
                    </span> </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto">
                    <!-- This is  -->
                    <li class="nav-item"> <a class="kelik-hide nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    <li class="nav-item"> <a class="kelik-hide nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                    <!-- ============================================================== -->
                    <!-- Search -->
                    <!-- ============================================================== -->
                    <li class="nav-item">
                        <form class="app-search d-none2 d-md-block2 d-lg-block2" action="utama.php?view=admin&action=caripantas" method="post" enctype="multipart/form-data">
                            <input id="cari" name="cari" type="text" class="form-control" placeholder="Carian" style="width: 100px">
                        </form>
                    </li>
                </ul>
                <div class="navbar-nav mr-auto d-none d-sm-block"><strong><?php echo($_SESSION['nama_masjid']); ?></strong></div>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <ul class="navbar-nav my-lg-0">
                    <!-- ============================================================== -->
                    <!-- Comment -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ti-email"></i>
                            <?php if($row_all > 0) { ?><div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div><?php } ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                            <ul>
                                <li>
                                    <div class="drop-title">Notifikasi</div>
                                </li>
                                <li>
                                    <div class="message-center">
                                        <!-- Message -->
                                        <a href="utama.php?view=admin&action=approve_qariah">
                                            <div class="btn btn-danger btn-circle"><i class="fa fa-check-circle"></i></div>
                                            <div class="mail-contnet">
                                                <h5>Menunggu Kelulusan Kariah <span class="badge badge-success"><?php echo $row_all; ?></span></h5> </div>
                                        </a>
                                        <?php if($themeAsalShow == 1) { ?>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" style="display: none">
                                                <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" style="display: none">
                                                <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" style="display: none">
                                                <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </li>
                                <li style="display: none">
                                    <a class="nav-link text-center link" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- End Comment -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Messages -->
                    <!-- ============================================================== -->
                    <?php if($themeAsalShow == 1) { ?>
                        <li class="nav-item dropdown" style="display: none">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icon-note"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox dropdown-menu-right animated bounceInDown" aria-labelledby="2">
                                <ul>
                                    <li>
                                        <div class="drop-title">You have 4 new messages</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="javascript:void(0)">
                                                <div class="user-img"> <img src="themes/elite/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)">
                                                <div class="user-img"> <img src="themes/elite/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)">
                                                <div class="user-img"> <img src="themes/elite/images/users/3.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)">
                                                <div class="user-img"> <img src="themes/elite/images/users/4.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center link" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>
                    <!-- ============================================================== -->
                    <!-- End Messages -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- mega menu -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown mega-dropdown" style="display:none"> <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-layout-width-default"></i></a>
                        <div class="dropdown-menu animated bounceInDown col-md-auto">
                            <ul class="mega-dropdown-menu">
                                <?php if($hide_elemen == 1) { ?>
                                    <li class="col-lg-3 col-xlg-2 m-b-30">
                                        <h4 class="m-b-20">CAROUSEL</h4>
                                        <!-- CAROUSEL -->
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <div class="container"> <img class="d-block img-fluid" src="themes/elite/images/big/img1.jpg" alt="First slide"></div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="container"><img class="d-block img-fluid" src="themes/elite/images/big/img2.jpg" alt="Second slide"></div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="container"><img class="d-block img-fluid" src="themes/elite/images/big/img3.jpg" alt="Third slide"></div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                                        </div>
                                        <!-- End CAROUSEL -->
                                    </li>
                                    <li class="col-lg-3 m-b-30">
                                        <h4 class="m-b-20">ACCORDION</h4>
                                        <!-- Accordian -->
                                        <div class="accordion" id="accordionExample">
                                            <div class="card m-b-0">
                                                <div class="card-header bg-white p-0" id="headingOne">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            Collapsible Group Item #1
                                                        </button>
                                                    </h5>
                                                </div>

                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card m-b-0">
                                                <div class="card-header bg-white p-0" id="headingTwo">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                                                aria-controls="collapseTwo">
                                                            Collapsible Group Item #2
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card m-b-0">
                                                <div class="card-header bg-white p-0" id="headingThree">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                                                aria-controls="collapseThree">
                                                            Collapsible Group Item #3
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-lg-3 col-xlg-4 m-b-30" style="display: none">
                                        <h4 class="m-b-20">List style</h4>
                                        <!-- List style -->
                                        <ul class="list-style-none">
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> You can give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another Give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Forth link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another fifth link</a></li>
                                        </ul>
                                    </li>

                                <li class="col-md-auto" class2="col-lg-3  m-b-30">
                                    <h4 class="m-b-20">SOKONGAN TEKNIKAL</h4>
                                    <!-- Contact -->
                                    <form>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="exampleInputname1" placeholder="Masukkan Nama"> </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Masukkan No Tel"> </div>
                                        <div class="form-group">
                                            <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Mesej"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-info">Hantar</button>
                                    </form>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- End mega menu -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- User Profile -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown u-pro">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <span class="hidden-md-down"><?php echo($_SESSION['username']); ?> &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                        <div class="dropdown-menu dropdown-menu-right animated flipInY">
                            <!-- text-->
                            <a <?php if($_SESSION['user_type_id'] == 11) { ?>style="display:none"<?php } ?> href="utama.php?view=admin&action=profil" class="dropdown-item"><i class="ti-user"></i> Profil Saya</a>
                            <a href="logout.php" class="dropdown-item"><i class="fa fa-power-off"></i> Log Keluar</a>
                            <!-- text-->
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- End User Profile -->
                    <!-- ============================================================== -->
                    <li class="nav-item right-side-toggle" style="display: none"> <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <?php

    if ($_SESSION['user_type_id'] == 2) {
        if ($_GET['action'] == "gomasjidpro") include('gomasjidpro/sidebar_menu.php');
        else include('sidebar/sidebar_admin.php');
    } else if ($_SESSION['user_type_id'] == 5) {
        include('sidebar/sidebar_setiausaha.php');
    } else if ($_SESSION['user_type_id'] == 6) {
        include('sidebar/sidebar_bendahari.php');
    } else if ($_SESSION['user_type_id'] == 10 || $_SESSION['user_type_id'] == 7) {
        include('sidebar/sidebar_admin.php');
    } else if ($_SESSION['user_type_id'] == 11 || $_SESSION['user_type_id'] == 111) {
        include('sidebar/sidebar_praktikal.php');
    }

    ?>
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->