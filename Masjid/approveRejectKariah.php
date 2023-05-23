<?php

header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();

$user_array = array("tahfizte_spmd", "tahfizte_spmdbekap", "tahfizte_spmdbekap2", "tahfizte_spmdbekap3");
$host = "localhost";
$user = $user_array[rand(0, 3)];
$password = "WebmasterMasjid2019";
$db = "tahfizte_masjidpro";

$bd2 = mysqli_connect($host, $user, $password, $db) or die(mysqli_error($bd2));

include("fungsi_tarikh.php");

function utf8ize( $mixed ) {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } elseif (is_string($mixed)) {
        return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
    }
    return $mixed;
}

function selValueSQL($query, $key_name) {
    global $bd2, ${'meja_'.$key_name}, ${'row_'.$key_name}, ${'fetch_'.$key_name}, ${'num_'.$key_name}, ${'field_'.$key_name};

    ${'fetch_'.$key_name} = mysqli_query($bd2, $query) or die(mysqli_error($bd2));
    ${'field_'.$key_name} = mysqli_fetch_fields(${'fetch_'.$key_name});
    ${'num_'.$key_name} = mysqli_num_rows(${'fetch_'.$key_name});
    ${'row_'.$key_name} = mysqli_fetch_assoc(${'fetch_'.$key_name});
    ${'meja_'.$key_name} = mysqli_fetch_field(${'fetch_'.$key_name});
}

function cudSQL($query, $key_name) {
    global $bd2, ${'cud_'.$key_name}, ${'lastid_'.$key_name}, ${'delStatus_'.$key_name}, ${'updateStatus_'.$key_name};

    ${'cud_'.$key_name} = mysqli_query($bd2, $query) or die(mysqli_error($bd2));
    if(${'cud_'.$key_name}) {
        if (strpos(substr($query, 0, 6), 'INSERT') !== false) {
            ${'lastid_' . $key_name} = mysqli_insert_id($bd2);
        }
        if (strpos(substr($query, 0, 6), 'DELETE') !== false) {
            ${'delStatus_' . $key_name} = 1;
        }
        if (strpos(substr($query, 0, 6), 'UPDATE') !== false) {
            ${'updateStatus_' . $key_name} = 1;
        }
    }
}

// Padam semua session dan cookie
function logKeluar() {
    foreach ($_SESSION as $exit_session => $val_exit) {
        unset($_SESSION[$exit_session]);
    }
    foreach ($_COOKIE as $exit_session2 => $val_exit2) {
        setcookie($exit_session2, "", time() - (86400 * 500));
        setcookie($exit_session2, "", time() - (86400 * 500), '/');
    }
    setcookie("undefined", "", time() - (86400 * 500));
    setcookie("undefined", "", time() - (86400 * 500), '/');

    session_unset();
    session_destroy();
    session_write_close();
    session_start();
    session_regenerate_id(true);
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, "", time() - (86400 * 500));
            setcookie($name, "", time() - (86400 * 500), '/');
        }
    }
}

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

if($_GET['bearer'] != NULL) $BearerToken = $_GET['bearer'];
else if(getBearerToken() != NULL) $BearerToken = getBearerToken();
else logKeluar();

if($BearerToken != NULL || $_GET['token'] != NULL) {
    if($_GET['token'] != NULL) $BearerToken = $_GET['token'];
    $token = explode("|", $BearerToken);
    $token = $token[1];
    $q = "SELECT * FROM personal_access_tokens a, masjid_user b, sej6x_data_masjid c WHERE a.tokenable_id = b.user_id AND b.id_masjid = c.id_masjid AND a.tokenable_type LIKE '%MasjidUser%' AND a.token = SHA2('$token', 256)";
    selValueSQL($q, 'auth');
}

if($num_auth > 0 && $_GET['id'] != NULL && is_numeric($_GET['id']) && $_SERVER['REQUEST_METHOD'] != "POST") {
    $q2 = "SELECT * FROM approve_qariah WHERE id = ".$_GET['id']. " AND id_masjid = ".$row_auth['id_masjid'];
    selValueSQL($q2, 'kariah');
    if($num_kariah > 0) {
        $q3 = "SELECT * FROM approve_anak WHERE id_qariah = ".$row_kariah['id']." OR no_ic_ketua = '".$row_kariah['no_ic']."'";
        selValueSQL($q3, 'anak');
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
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="MasjidPro Penang - Pengesahan Penerimaan / Penolakkan Ahli Kariah">
        <meta name="author" content="MasjidPro Penang - Pengesahan Penerimaan / Penolakkan Ahli Kariah">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" href="images/logo2.png">
        <title>MasjidPro Penang - Pengesahan Penerimaan / Penolakkan Ahli Kariah</title>

        <!-- page css -->
        <link href="themes/elite/dist/css/pages/login-register-lock.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="themes/elite/dist/css/style.min.css" rel="stylesheet">
        <link href="themes/elite/dist/css/pages/ribbon-page.css" rel="stylesheet">
        <link href="themes/elite/dist/css/pages/stylish-tooltip.css" rel="stylesheet">
        <link href="assets/js/sweetalert2/sweetalert2.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.css" integrity="sha512-4wfcoXlib1Aq0mUtsLLM74SZtmB73VHTafZAvxIp/Wk9u1PpIsrfmTvK0+yKetghCL8SHlZbMyEcV8Z21v42UQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php include("loader.php"); ?>
    </head>

    <body class="skin-default"">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!--div class="preloader" style2="display: none">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">MasjidPro Penang</p>
        </div>
    </div-->
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class2="login-register">
            <div class="card">
                <div class="card-body">
                    <?php if($show == 1) { ?>
                        <div class="row form-group">
                            <div class="col-12 col-md-12" align="center">
                                <img style="max-height: 128px" class="img-fluid" src="picture/logo_masjidpropenang.png">
                            </div>
                        </div>
                        <hr />
                    <?php } ?>
                    <div class="row form-group">
                        <div class="col-12 col-md-12" align="center">
                            <?php if($num_auth > 0 && $num_kariah > 0 && !isset($_GET['success']) && !isset($_GET['msg'])) { ?>
                                <div class="alert alert-info" role="alert">
                                    <h4>Pengesahan Penerimaan / Penolakkan Ahli Kariah</h4>
                                </div>
                            <?php } else if($_GET['success'] == 1) { ?>
                            <div class="alert alert-success" role="alert">
                                <h4>Pendaftaran kariah diluluskan</h4>
                            </div>
                            <?php } else if($_GET['success'] == 2) { ?>
                            <div class="alert alert-danger" role="alert">
                                <h4>Pendaftaran kariah ditolak, notifikasi telah dihantar secara automatik kepada ahli kariah tersebut</h4>
                            </div>
                            <?php } else if($_GET['msg'] == 1) { ?>
                                <div class="alert alert-warning" role="alert">
                                    <h4>Maklumat ahli kariah telah wujud</h4>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-danger" role="alert">
                                    <h4>Anda tidak dapat mengakses halaman ini</h4>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if($num_auth > 0 && $num_kariah > 0 && !isset($_GET['success']) && !isset($_GET['msg'])) { ?>
                        <form id="pengesahan" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">
                            <div class="row form-group">
                                <div class="col-12 col-md-12">
                                    <label>Nama</label>
                                    <input name="nama_penuh" class="form-control" value="<?php echo($row_kariah['nama_penuh']); ?>" readonly>
                                </div>
                            </div>
                            <?php if($num_anak > 0) { ?>
                                <hr /><h4>Maklumat Tanggungan</h4><hr />
                                <?php $i = 1; do { ?>
                                    <div class="row form-group">
                                        <div class="col-12 col-md-12">
                                            <label>Nama Tanggungan <?php echo($i); ?></label>
                                            <input class="form-control" value="<?php echo($row_anak['nama_penuh']); ?>" readonly>
                                        </div>
                                    </div>
                                    <?php $i++; } while($row_anak = mysqli_fetch_assoc($fetch_anak));  ?>
                            <?php } ?>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Status Pendaftaran</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="status1" name="status" class="custom-control-input" value="1" onclick="statusForm(this.value)" required>
                                            <label class="custom-control-label" for="status1">Diluluskan</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="status2" name="status" class="custom-control-input" value="2" onclick="statusForm(this.value)" required>
                                            <label class="custom-control-label" for="status2">Ditolak</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="display: none" id="alasanTolak" class="row form-group">
                                <div class="col-12 col-md-12">
                                    <label>* Sebab Pendaftaran Ditolak</label>
                                    <textarea oninput="this.value = this.value.toUpperCase()" name="sebabDitolak" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row form-group" align="center">
                                <div class="col-12 col-md-12">
                                    <input type="hidden" name="isApp" value="1">
                                    <input type="hidden" name="userFBToken" value="<?php echo($row_kariah['firebase_token']); ?>">
                                    <input type="hidden" name="firebase_token" value="<?php echo($row_kariah['firebase_token']); ?>">
                                    <input type="hidden" name="sebab_padam" value="99">
                                    <input type="hidden" name="token" value="<?php echo($_GET['token']); ?>">
                                    <input type="hidden" name="id_masjid" value="<?php echo($row_auth['id_masjid']); ?>">
                                    <input type="hidden" name="user_id" value="<?php echo($row_auth['user_id']); ?>">
                                    <input type="hidden" name="id_data" value="<?php echo($row_kariah['id']); ?>">
                                    <input type="hidden" name="del" value="<?php echo($row_kariah['id']); ?>">
                                    <input type="hidden" name="no_ic" value="<?php echo($row_kariah['no_ic']); ?>">
                                    <input type="hidden" name="no_tel" value="<?php echo($row_kariah['no_tel']); ?>">
                                    <input type="hidden" name="email" value="<?php echo($row_kariah['email']); ?>">
                                    <button style="display: none" id="simpan" class="btn btn-info" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
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
    <script src="themes/elite/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="themes/elite/node_modules/popper/popper.min.js"></script>
    <script src="themes/elite/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/sweetalert2/sweetalert2.all.js"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        // $(function() {
        //     $(".preloader").fadeOut();
        // });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $(document).ready(function(){
            $(".btn-info").css("background-color", "#010280");
            <?php if($_GET['hide'] != 1) { ?>
            $('#staticBackdrop').modal('show');
            <?php } ?>
        });

        function statusForm(a) {
            $('#simpan').show();
            if(a == 2) {
                $('#pengesahan').attr('action', 'admin/del_approve.php');
                $('#alasanTolak').show();
                $('#alasanTolak textarea').attr('required', true);
                $('#simpan').html('Tolak Pendaftaran');
            }
            else {
                $('#pengesahan').attr('action', 'admin/add_approve.php');
                $('#alasanTolak').hide();
                $('#alasanTolak textarea').removeAttr('required');
                $('#simpan').html('Terima Pendaftaran');
            }
        }

        function popupMsg2(type, title, text, footer, link, linkTitle) {
            if(link != null && linkTitle != null) footerDescription = '<p><a href="'+link+'"><button type="button" class="btn btn-primary">'+linkTitle+'</button></a></p>';
            else footerDescription = null;
            Swal.fire({
                type: type,
                title: title,
                text: text,
                footer: footer + footerDescription
            });
        }

        <?php if($_SESSION['berjaya'] == 1) { ?>
        popupMsg2('alert', 'Kemasukkan Rekod Berjaya', '1 Rekod baharu telah dimasukkan', null, null, null);
        <?php } ?>
    </script>
    </body>

    </html>
<?php
//foreach ($_GET as $key => $val) echo "$key: $val<br />";
mysqli_close($bd2);
?>