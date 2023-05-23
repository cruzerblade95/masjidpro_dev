<?php
$host = "localhost";
$user = "tahfizte_spmd";
$password = "WebmasterMasjid2019";
$db = "tahfizte_masjidpro";

$conn = mysqli_connect($host, $user, $password, $db) or die(mysqli_error($conn));

/**
 * Get hearder Authorization
 * */
function getAuthorizationHeader() {
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}
/**
 * get access token from header
 * */
function getBearerToken() {
    $headers = getAuthorizationHeader();
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}
$BearerToken = getBearerToken();

if($_SERVER['REQUEST_METHOD'] == "POST") {
    foreach($_POST as $key => $val) ${$key} = $val;
    if($borang == 1) {
        $q = "SELECT a.id_masjid, a.nama_penuh, a.no_ic, a.no_hp, a.email, b.nama_masjid FROM sej6x_data_peribadi a, sej6x_data_masjid b WHERE a.id_masjid = b.id_masjid AND a.no_ic = '$no_kp' UNION
SELECT c.id_masjid, c.nama_penuh, c.no_ic , c.no_tel 'no_hp', c.email, d.nama_masjid FROM sej6x_data_anakqariah c, sej6x_data_masjid d WHERE c.id_masjid = d.id_masjid AND c.no_ic = '$no_kp'";
        $q_semak = "SELECT no_ic FROM insuransKariah WHERE no_ic = '$no_kp'";
        $q2_semak = mysqli_query($conn, $q_semak) or die(mysqli_error($conn));
        $num_semak = mysqli_num_rows($q2_semak);
        $row_semak = mysqli_fetch_assoc($q2_semak);
    } else if($borang == 2) {
        // Semak permohonan sekiranya belum memohon
        $q = "SELECT no_ic FROM insuransKariah WHERE no_ic = '$no_kp'";
    }
    if($borang != NULL) {
        $q2 = mysqli_query($conn, $q) or die(mysqli_error($conn));
        $num = mysqli_num_rows($q2);
        $row = mysqli_fetch_assoc($q2);
    }
    if($borang == 2 && $num == 0) {
        // Sekiranya belum memohon, masukkan maklumat permohonan
        $device = $_SERVER['HTTP_USER_AGENT'];
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $qInsert = "INSERT INTO insuransKariah (id_masjid, nama_penuh, no_ic, no_hp, email, ipAddress, device) VALUES ($id_masjid, '$nama_penuh', '$no_ic', '$no_hp', '$email', '$ipAddress', '$device')";
        $qInsert2 = mysqli_query($conn, $qInsert);
        if($qInsert2) $berjaya = 1;
        else $berjaya = 0;
    }
    else $berjaya = 2;
}

if($_GET['raw'] == 1 && $borang == 1) { ?>
    <?php if($num > 0 && $num_semak == 0) { ?>
        <div class="alert alert-success" role="alert">
            Anda telah berdaftar dengan MasjidPro Penang, Anda boleh meneruskan permohonan dengan mengemaskini nombor telefon dan e-mel dibawah sekiranya terdapat perubahan
        </div>
        <div class="form-group ">
            <div class="col-xs-12">
                Masjid Yang Didaftarkan: <br /><strong><?php echo($row['nama_masjid']); ?></strong>
            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" type="text" name="nama_penuh" required placeholder="Nama Mengikut Kad Pengenalan" readonly value="<?php echo($row['nama_penuh']); ?>">
            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" type="text" name="no_ic" required placeholder="No Kad Pengenalan" readonly value="<?php echo($row['no_ic']); ?>">
            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" type="text" name="no_hp" required placeholder="No Telefon Bimbit" value="<?php echo($row['no_hp']); ?>">
            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" type="text" name="email" required placeholder="Alamat E-Mel" value="<?php echo($row['email']); ?>">
            </div>
        </div>
        <div class="form-group text-center">
            <div class="col-xs-6 p-b-20">
                <input type="hidden" name="borang" value="2">
                <input type="hidden" name="id_masjid" value="<?php echo($row['id_masjid']); ?>">
                <button class="btn btn-block btn-lg btn-info btn-rounded" name="submit" type="submit">Hantar Permohonan</button>
            </div>
            <div class="col-xs-6 p-b-20">
                <a href="insurans.php"><button class="btn btn-block btn-lg btn-info btn-rounded" name="submit2" type="button">Semak Semula</button></a>
            </div>
        </div>
    <?php } else { ?>
        <?php if($num_semak > 0) { ?>
            <div class="alert alert-warning" role="alert">
                Rekod permohonan telah wujud.
            </div>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                Anda tidak berdaftar dengan MasjidPro Penang, Anda tidak layak untuk memohon
            </div>
        <?php } ?>
    <?php } ?>
<?php } else if($_GET['raw'] == 1 && $borang == 2) { ?>
    <?php if($berjaya == 1) { ?>
        <div class="alert alert-success" role="alert">
            Permohonan anda berjaya disimpan dan akan diproses.
        </div>
    <?php } else if($berjaya == 0) { ?>
        <div class="alert alert-danger" role="alert">
            Maaf, terdapat ralat pada input data yang diberikan, sila cuba sekali lagi.
        </div>
    <?php } else if($berjaya == 2) { ?>
        <div class="alert alert-warning" role="alert">
            Rekod permohonan telah wujud.
        </div>
    <?php } ?>
<?php } else {
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
        <meta name="description" content="GoMasjid Pro - Insurans daripada Masjid Pro">
        <meta name="author" content="GoMasjid Pro daripada Masjid Pro">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" href="images/logo2.png">
        <title>GoMasjid Pro - Permohonan Insurans Khas Anak Kariah</title>

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

    <body class="skin-default" style2="background-image:url(picture/banner_masjidpro4.jpg);">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">GoMasjid Pro - Insurans</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class2="login-register">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal form-material" method="POST" id="loginform" enctype="multipart/form-data">
                        <div align="center"><a href="javascript:void(0)" class="db"><img style="max-height: 480px" src="images/insuran.jpg" class="img-fluid" lt="Insurans" /></a></div>
                        <?php if($_GET['hide'] != 1) { ?>
                            <hr />
                            <h3 class="text-center m-b-20" style="color: #000000">Permohonan Insurans Khas Anak Kariah</h3>
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
                            <div id="frmContent">
                                <div class="alert alert-info" role="alert">
                                    Sila masukkan nombor kad pengenalan anda untuk meneruskan permohonan
                                </div>
                                <div class="form-group ">
                                    <div class="col-xs-12">
                                        <input class="form-control" type="text" name="no_kp" required placeholder="No Kad Pengenalan">
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-6 p-b-20">
                                        <input type="hidden" name="borang" value="1">
                                        <button class="btn btn-block btn-lg btn-info btn-rounded" name="submit" type="submit">Mohon Sekarang</button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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
    <?php if($_GET['hide'] != 1) { ?>
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Syarat Kelayakkan Insurans Khas Anak Kariah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tidak">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ol>
                            <li>Mesti berdaftar dengan Bantuan Keluarga Malaysia (BKM)</li>
                            <li>Golongan B40</li>
                            <li>Anak kariah mesti sah mendaftar melalui aplikasi MasjidPro Penang</li>
                        </ol>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Saya faham</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <script src="themes/elite/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="themes/elite/node_modules/popper/popper.min.js"></script>
    <script src="themes/elite/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $(document).ready(function(){
            $(".btn-info").css("background-color", "#010280");
            <?php if($_GET['hide'] != 1) { ?>
            $('#staticBackdrop').modal('show');
            <?php } ?>
        });
        <?php if($_GET['hide'] != 1) { ?>
        function selfUpdate(a, b, c) {
            $(a).on('submit', function(e){
                $(c).hide();
                $("#tunggu").show();
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: b,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        $(c).show();
                        $("#tunggu").hide();
                        $(c).html(data);
                    }
                });
            });
        }
        selfUpdate('#loginform', '<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>&raw=1', '#frmContent');
        <?php } ?>
    </script>
    </body>

    </html>
    <?php
}
//echo($BearerToken);
mysqli_close($conn);
?>