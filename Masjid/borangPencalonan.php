<?php
use function Verot\Upload\uploadFile;

if($_GET['raw'] != 1) include("uploadFunctions.php");
if($tengoklah != 1) {
    header("Access-Control-Allow-Origin: *");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    session_start();
    if($_GET['json'] == 1) header("Content-Type: application/json; charset=UTF-8");
    $host = "localhost";
    $user = "tahfizte_spmd";
    $password = "WebmasterMasjid2019";
    $db = "tahfizte_masjidpro";

    $bd2 = mysqli_connect($host, $user, $password, $db) or die(mysqli_error($bd2));

    include("fungsi_tarikh.php");

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

    function showImage($data, $inputName, $idName, $idImagePreview, $required) {
        if($required == 1 || $required == 'required') $required = "required";
        if($data != NULL && $data != null && $data != 'null') $data2 = "https://masjidpro.com/Masjid/Uploads/$data";
        else $data2 = "https://masjidpro.com/Masjid/Uploads/imagesDefaultAvatar.png";
        echo '<div class="input-upload">';
        echo '<img style="max-height: 320px" class="img-fluid" id="'.$idImagePreview.'" src="'.$data2.'" />';
        echo '<input '.$required.' id="'.$idName.'" name="'.$inputName.'" class="form-control" type="file" accept=".jpg,.gif,.png,.jpeg" onchange="preview_image2(event, \''.$idImagePreview.'\')" />';
        echo '<input type="hidden" id="'.$inputName.'_current" name="'.$inputName.'_current" value="'.$data.'" /></div>';
    }

    if($BearerToken != $_SESSION['autoLogin_token']) {
        unset($_SESSION['autoLogin_jenisUser']);
        unset($_SESSION['autoLogin_userid']);
        unset($_SESSION['autoLogin_token']);
        unset($_SESSION['autoLogin_idMasjid']);
        unset($_SESSION['autoLogin_namaPenuh']);
        unset($_SESSION['autoLogin_noHP']);
    }

    if($_SESSION['autoLogin_userid'] == NULL || $_SESSION['autoLogin_idMasjid'] == NULL || $_SESSION['autoLogin_namaPenuh'] == NULL) {
        if($BearerToken != NULL) {
            $BearerToken = explode("|", $BearerToken);
            $personal_access_token = $BearerToken[1];
            $checkToken = "SELECT IF(tokenable_type LIKE '%Sej6xDataAnakqariah%', tokenable_id, '') 'tokenAnak', IF(tokenable_type LIKE '%Sej6xDataPeribadi%', tokenable_id, '') 'tokenKK' FROM personal_access_tokens WHERE token = SHA2('$personal_access_token', 256)";
            selValueSQL($checkToken ,'checkToken');
            $checkLogin = "SELECT a.no_ic, a.id_masjid, a.nama_penuh, a.no_hp FROM sej6x_data_peribadi a WHERE a.id_data = '".$row_checkToken['tokenKK']."' UNION ";
            $checkLogin .= "SELECT b.no_ic, b.id_masjid, b.nama_penuh, b.no_tel 'no_hp' FROM sej6x_data_anakqariah b WHERE b.ID = '".$row_checkToken['tokenAnak']."'";
            //echo($checkToken.'<br />'.$checkLogin);
            selValueSQL($checkLogin ,'checkLogin');
            if($num_checkLogin > 0) {
                foreach ($_GET as $key => $val) $_SESSION['autoLogin_' . $key] = mysqli_real_escape_string($bd2, $val);
                $_SESSION['autoLogin_idMasjid'] = $row_checkLogin['id_masjid'];
                $_SESSION['autoLogin_namaPenuh'] = $row_checkLogin['nama_penuh'];
                $_SESSION['autoLogin_userid'] = $row_checkLogin['no_ic'];
                $_SESSION['autoLogin_noHP'] = $row_checkLogin['no_hp'];
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
    }
    if($_SESSION['isLogin'] == 1) $id_masjid = $_SESSION['autoLogin_idMasjid'];
}
if($_SERVER['REQUEST_METHOD'] == "POST" || ($_GET['page'] == 1 && $_GET['jenisUser'] != NULL && $_GET['userid'] != NULL && $_GET['token'] != NULL)) {
    $request_body = array();
    if (strpos($_SERVER["CONTENT_TYPE"], 'application/json') !== false) {
        $request_body = json_decode(file_get_contents('php://input'), true);
    }
    else if($_SERVER['REQUEST_METHOD'] == "POST") $request_body = $_POST;
    else {
        $request_body = $_GET;
        $semakNoIC = $_GET['userid'];
        if($_SESSION['autoLogin_userid'] != NULL) $semakNoIC = $_SESSION['autoLogin_userid'];
    }
    foreach ($request_body as $key => $val) ${$key} = mysqli_real_escape_string($bd2, $val);
    if ($_GET['raw'] == 1) {
        if ($_GET['p'] == "users") {
            if ($no_ic != NULL && $no_ic != "") {
                if ($id_masjid != NULL) {
                    $extra = "AND a.id_masjid = $id_masjid";
                    $extra2 = "AND b.id_masjid = $id_masjid";
                }
                $q = "SELECT a.id_data 'idPerson', (YEAR(NOW()) - YEAR(a.tarikh_lahir)) AS umur, a.no_ic, a.nama_penuh, a.no_hp, a.alamat_terkini, '200' AS code FROM sej6x_data_peribadi a WHERE (a.no_ic LIKE '%$no_ic%' OR a.nama_penuh LIKE '%$no_ic%') $extra UNION ";
                $q .= "SELECT CONCAT('T', b.ID) 'idPerson', (YEAR(NOW()) - YEAR(b.tarikh_lahir)) AS umur, b.no_ic, b.nama_penuh, b.no_tel 'no_hp', c.alamat_terkini, '200' AS code FROM sej6x_data_anakqariah b LEFT JOIN sej6x_data_peribadi c ON b.id_qariah = c.id_data WHERE (b.no_ic LIKE '%$no_ic%' OR b.nama_penuh LIKE '%$no_ic%') $extra2";
                selValueSQL($q, 'getKariah');
                $result = array();
                $i = 0;
            }
            if ($num_getKariah > 0) {
                do {
                    foreach ($field_getKariah as $field) {
                        if ($num_getKariah > 1) $result[$i][$field->name] = addslashes($row_getKariah[$field->name]);
                        else $result[$field->name] = addslashes($row_getKariah[$field->name]);
                    }
                    $i++;
                } while ($row_getKariah = mysqli_fetch_assoc($fetch_getKariah));
                $jsonData = json_encode(utf8ize($result), JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
                $jsonData = str_replace('\n', '', $jsonData);
                $jsonData = str_replace('\r', '', $jsonData);
                $jsonData = str_replace('\t', '', $jsonData);
                echo($jsonData);
            } else {
                http_response_code(404);
                echo '{';
                echo '"msg":"Ahli Kariah Tidak Dijumpai"';
                echo ',"code":"404"';
                echo '}';
            }
//            $myfile = fopen("cariAhli.txt", "w") or die("Unable to open file!");
//            fwrite($myfile, $q.' :: '.$jsonData);
//            fclose($myfile);
        }

    } else {
        if ($_GET['page'] == 1) {
            $q = "SELECT aa.id_masjid, aa.nama_masjid, (YEAR(NOW()) - YEAR(a.tarikh_lahir)) AS umur, a.no_ic, a.nama_penuh, a.no_hp, a.alamat_terkini, '200' AS code FROM sej6x_data_peribadi a LEFT JOIN sej6x_data_masjid aa ON a.id_masjid = aa.id_masjid WHERE a.no_ic = '$semakNoIC' UNION ";
            $q .= "SELECT bb.id_masjid, bb.nama_masjid, (YEAR(NOW()) - YEAR(b.tarikh_lahir)) AS umur, b.no_ic, b.nama_penuh, b.no_tel 'no_hp', c.alamat_terkini, '200' AS code FROM sej6x_data_anakqariah b LEFT JOIN sej6x_data_masjid bb ON b.id_masjid = bb.id_masjid LEFT JOIN sej6x_data_peribadi c ON (b.id_qariah = c.id_data OR b.no_ic_ketua = c.no_ic) WHERE b.no_ic = '$semakNoIC' LIMIT 1";
            selValueSQL($q, 'getKariah2');
            $id_masjid = $row_getKariah2['id_masjid'];
        }

        if ($_GET['page'] == 2) {
            $sizeFile = $_FILES['gambarCalon']['size'];
            if($sizeFile > 0) {
                $gambarCalon = uploadFile('gambarCalon', 'file', 'pencalonan');

                // Update nama file di database sekiranya berjaya upload
                if ($gambarCalon != "0") {
                    if ($id != NULL) $gambarCalon_val = "gambarCalon='$gambarCalon',";
                    else {
                        $gambarCalon_col = "gambarCalon,";
                        $gambarCalon_val = "'$gambarCalon',";
                    }
                }
            }
            if ($id != NULL) {
                if ($catatanPengurusan != NULL) $catatanPengurusan_val = ", catatanPengurusan = '$catatanPengurusan'";
                if ($status != NULL) $status_val = ", status = '$status'";
                if ($created_by != NULL) $created_by_val = ", created_by = '$created_by'";
            } else {
                if ($catatanPengurusan != NULL) {
                    $catatanPengurusan_col = ", catatanPengurusan";
                    $catatanPengurusan_val = ", '$catatanPengurusan'";
                }
                if ($status != NULL) {
                    $status_col = ", status";
                    $status_val = ", '$status'";
                }
                if ($created_by != NULL) {
                    $created_by_col = ", created_by";
                    $created_by_val = ", '$created_by'";
                }
            }

            if ($id != NULL) $q = "UPDATE pencalonan SET sesi_pemilihan_id = $sesi_pemilihan_id, jawatan = '$jawatan', noIc_calon = '$noIc_calon',
                      namaCalon = '$namaCalon', alamatCalon = '$alamatCalon', noTel_calon = '$noTel_calon', $gambarCalon_val noIc_cadang = '$noIc_cadang',
                      namaCadang = '$namaCadang', noTel_cadang = '$noTel_cadang', noIc_sokong = '$noIc_sokong', namaSokong = '$namaSokong',
                      noTel_sokong = '$noTel_sokong', catatan = '$catatan' $catatanPengurusan_val $status_val WHERE id = $id";
            else $q = "INSERT INTO pencalonan (sesi_pemilihan_id, jawatan, noIc_calon, namaCalon, alamatCalon, noTel_calon, $gambarCalon_col noIc_cadang, namaCadang, noTel_cadang, noIc_sokong, namaSokong, noTel_sokong, catatan $catatanPengurusan_col $status_col $created_by_col)
VALUES ($sesi_pemilihan_id, '$jawatan', '$noIc_calon', '$namaCalon', '$alamatCalon', '$noTel_calon', $gambarCalon_val '$noIc_cadang', '$namaCadang', '$noTel_cadang', '$noIc_sokong', '$namaSokong', '$noTel_sokong', '$catatan' $catatanPengurusan_val $status_val $created_by_val)";

            $simpan = mysqli_query($bd2, $q);
            if (!$simpan) {
                //echo mysqli_error($bd2);
                $error = 1;
                //echo($q);
            } else {
                if($_GET['self'] != 1) {
                    $_SESSION['berjaya'] = 1;
                    echo '<script>document.location.href="' . $_SERVER['REQUEST_URI'] . '&page=1"</script>';
                }
                else {
                    //echo($sizeFile);
                    header("Location: $redirectURL");
                    exit;
                }
            }
        }

        if($_GET['page'] == 3) {
            if(count($_POST['pencalonan_id']) > 0) {
                $ip_address = $_SERVER['REMOTE_ADDR'];
                $device = $_SERVER['HTTP_USER_AGENT'];
                $q = "INSERT INTO borang_undi (sesi_pemilihan_id, no_ic, namaPenuh, noTel, ip_address, device) VALUES
                ($sesi_pemilihan_id, '$no_ic', '$namaPenuh', '$noTel', '$ip_address', '$device')";
                mysqli_query($bd2, $q);
                $last_id = mysqli_insert_id($bd2);
                if ($last_id != NULL) {
                    foreach ($_POST['pencalonan_id'] as $key) {
                        if ($key != NULL) {
                            $q2 = "INSERT INTO pencalonan_undi (sesi_pemilihan_id, borang_undi_id, pencalonan_id) VALUES
                                ($sesi_pemilihan_id, $last_id, $key)";
                            mysqli_query($bd2, $q2);
                        }
                    }
                }
            }
        }
    }
}
if($_GET['raw'] == 1) {
    if($_GET['p'] == "clear") {
        unset($_SESSION['berjaya']);
    }
}

if($tengoklah != 1 && $_GET['raw'] != 1) {
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
        <meta name="description" content="MasjidPro Penang - Pendaftaran Baharu dan Semakan Ahli Kariah Lama">
        <meta name="author" content="Pendaftaran Baharu dan Semakan Ahli Kariah Lama menerusi aplikasi MasjidPro Penang">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" href="images/logo2.png">
        <title>MasjidPro Penang - Pendaftaran Baharu dan Semakan Ahli Kariah Lama</title>

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
    <div class="preloader" style2="display: none">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">MasjidPro Penang
                <?php //echo($row_checkLogin['nama_penuh']); ?>
            </p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
    <div class2="login-register">
    <div class="card">
    <div class="card-header">
        <?php if($semakNoIC == NULL && $_GET['page'] != NULL) { ?>
            <div class="row">
                <div class="col-10">
                    <h4>
                        <?php if($_GET['page'] == 1) { ?>Semakan Layak Mengundi<?php } ?>
                        <?php if($_GET['page'] == 2) { ?>Borang Pencalonan<?php } ?>
                        <?php if($_GET['page'] == 3) { ?>Borang Pengundian<?php } ?>
                    </h4>
                </div>
                <?php if($_SESSION['isLogin'] == 1) { ?>
                    <div class="col-2" align="right">
                        <button type="button" class="btn btn-secondary btn-outline" data-html="true" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo($_SESSION['autoLogin_namaPenuh']); ?><br><?php echo($_SESSION['autoLogin_userid']); ?>"><i class="fa fa-user"></i></button>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <div class="card-body">
    <?php if($_GET['page'] == NULL || $semakNoIC != NULL) { ?>
        <div class="row form-group">
            <div class="col-12 col-md-12" align="center">
                <img style="max-height: 128px" class="img-fluid" src="picture/logo_masjidpropenang.png">
            </div>
        </div>
        <hr />
        <?php if($semakNoIC == NULL) { ?>
            <div class="row form-group">
                <div class="col-12 col-md-12" align="center">
                    <div class="alert alert-info" role="alert">
                        <h4>Semak Kelayakan Mengundi</h4>
                    </div>
                </div>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>?page=1" method="post" enctype="multipart/form-data">
                <div class="row form-group" align="center">
                    <div class="col-12 col-md-12">
                        <label>No Kad Pengenalan</label>
                        <input class="form-control" name="semakNoIC" type="text" required maxlength="20" style="text-align: center">
                        <small>* No Kad Pengenalan tidak perlu letak "-"</small>
                    </div>
                </div>
                <div class="row form-group" align="center">
                    <div class="col-12 col-md-12">
                        <button class="btn btn-info" type="submit">Semak Kelayakan Mengundi</button>
                    </div>
                </div>
            </form>
        <?php } ?>
    <?php } ?>
<?php } if($_GET['raw'] != 1 && ($tengoklah == 1 || $_SESSION['isLogin'] == 1 || $semakNoIC != NULL)) { ?>
    <?php

    if($_GET['page'] == 1 || $_GET['page'] == 3) {
        if($_SESSION['isLogin'] == 1) {
            $semakNoIC = $_SESSION['autoLogin_userid'];
            $q = "SELECT *, IF(DATE(NOW()) BETWEEN tarikh_dibuka AND tarikh_ditutup, 1, IF(DATE(NOW()) < tarikh_dibuka, 2, 0)) AS status, IF(DATE(NOW()) BETWEEN tarikhUndi_dibuka AND tarikhUndi_ditutup, 1, IF(DATE(NOW()) < tarikhUndi_ditutup, 2, 0)) AS status2 FROM sesi_pemilihan WHERE id_masjid = " . $_SESSION['autoLogin_idMasjid'] . " ORDER BY tarikh_ditutup DESC LIMIT 1";
            selValueSQL($q, 'listPencalonan');

            $q2 = "SELECT * FROM pencalonan WHERE sesi_pemilihan_id = '" . $row_listPencalonan['id'] . "' AND created_by = '" . $_SESSION['autoLogin_userid'] . "'";
            selValueSQL($q2, 'donePencalonan');
            //echo($q2);
        }
    }

    if($_GET['page'] == 1) {

        $q3 = "SELECT id_data 'id', nama_penuh FROM sej6x_data_peribadi WHERE tarikh_lahir IS NOT NULL AND tarikh_lahir != '0000-00-00' AND (YEAR(NOW()) - YEAR(tarikh_lahir)) >= 18 AND no_ic = '$semakNoIC' UNION ";
        $q3 .= "SELECT ID 'id', nama_penuh FROM sej6x_data_anakqariah WHERE tarikh_lahir IS NOT NULL AND tarikh_lahir != '0000-00-00' AND (YEAR(NOW()) - YEAR(tarikh_lahir)) >= 18 AND no_ic = '$semakNoIC'";
        selValueSQL($q3, 'semakLayakUndi');

        if($num_semakLayakUndi > 0) { ?>
            <div class="row form-group" align="center">
                <div class="col-12 col-md-12">
                    <div class="alert alert-info font-weight-bold" role="alert">
                        <?php if($_SESSION['isLogin'] == 1) { ?>
                            <?php echo($_SESSION['autoLogin_namaPenuh']); ?><br><?php echo($_SESSION['autoLogin_userid']); ?>
                        <?php } else if($semakNoIC != NULL) { ?>
                            <h3><?php echo($row_getKariah2['nama_masjid']); ?></h3><br /><br />
                            <h4>
                                <?php echo($row_getKariah2['nama_penuh']); ?><br />
                                <?php echo($row_getKariah2['no_ic']); ?><br />
                                <?php echo($row_getKariah2['umur']); ?> Tahun<br />
                                <?php echo($row_getKariah2['alamat_terkini']); ?>
                            </h4>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="alert alert-success font-weight-bold" role="alert">Anda layak untuk mengundi</div>
                </div>
            </div>
            <?php if($semakNoIC != NULL && $_SESSION['autoLogin_userid'] == NULL) { ?>
                <div class="row form-group" align="center">
                    <div class="col-12">
                        <a href="borangPencalonan.php"><button class="btn btn-info" type="button">Semak Semula</button></a>
                    </div>
                </div>
            <?php } ?>
            <?php if($_SESSION['isLogin'] == 1) { do { ?>
                <div class="row" style="display: none">
                    <div class="col-12 col-md-6">
                        <div class="ribbon-wrapper card">
                            <div class="ribbon ribbon-bookmark  ribbon-info">Pencalonan</div>
                            <?php if($num_listPencalonan > 0) { ?>
                                <p class="ribbon-content">
                                    <?php echo($row_listPencalonan['nama_sesi']); ?>
                                    <?php
                                    if($row_listPencalonan['status'] == 1) echo '<span class="badge badge-success badge-pill">DIBUKA</span>';
                                    else if($row_listPencalonan['status'] == 2) echo '<span class="badge badge-warning badge-pill">BELUM DIBUKA</span><br /><small>Dibuka: '.fungsi_tarikh($row_listPencalonan['tarikh_dibuka'], 7, 99).'</small>';
                                    else if($row_listPencalonan['status'] == 0) echo '<span class="badge badge-danger badge-pill">DITUTUP</span><br /><small>Ditutup: '.fungsi_tarikh($row_listPencalonan['tarikh_ditutup'], 7, 99).'</small>';
                                    ?>
                                </p>
                                <hr />
                                <?php if($num_donePencalonan > 0) { ?>
                                    <div class="alert alert-success" role="alert">Anda telah pun membuat <?php echo($num_donePencalonan); ?> pencalonan</div>
                                <?php } if($row_listPencalonan['status'] == 1) { ?>
                                    <a href="borangPencalonan.php?sesi_pemilihan_id=<?php echo($row_listPencalonan['id']); ?>&page=2"><button class="btn btn-info" type="button">Borang Pencalonan</button></a>
                                <?php } ?>
                            <?php } else { ?>
                                <p class="ribbon-content">
                                <div class="alert alert-warning font-weight-bold" role="alert">Tiada sebarang pencalonan dibuka buat masa ini</div>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="ribbon-wrapper card">
                            <div class="ribbon ribbon-bookmark  ribbon-success">Pengundian</div>
                            <?php if($num_listPencalonan > 0) { ?>
                                <p class="ribbon-content">
                                    <?php echo($row_listPencalonan['nama_sesi']); ?>
                                    <?php
                                    if($row_listPencalonan['status2'] == 1) echo '<span class="badge badge-success badge-pill">DIBUKA</span>';
                                    else if($row_listPencalonan['status2'] == 2) echo '<span class="badge badge-warning badge-pill">BELUM DIBUKA</span><br /><small>Dibuka: '.fungsi_tarikh($row_listPencalonan['tarikhUndi_dibuka'], 7, 99).'</small>';
                                    else if($row_listPencalonan['status2'] == 0) echo '<span class="badge badge-danger badge-pill">DITUTUP</span><br /><small>Ditutup: '.fungsi_tarikh($row_listPencalonan['tarikhUndi_ditutup'], 7, 99).'</small>';
                                    ?>
                                </p>
                                <hr />
                                <?php if($row_listPencalonan['status2'] == 1) { ?><a href="borangPencalonan.php?sesi_pemilihan_id=<?php echo($row_listPencalonan['id']); ?>&page=3"><button class="btn btn-success" type="button">Pengundian</button></a><?php } ?>
                            <?php } else { ?>
                                <p class="ribbon-content">
                                <div class="alert alert-warning font-weight-bold" role="alert">Tiada sebarang pengundian dibuka buat masa ini</div>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } while($row_listPencalonan = mysqli_fetch_assoc($fetch_listPencalonan)); } } else { ?>
            <div class="row form-group">
                <div class="col-12" align="center">
                    <?php if($num_listPencalonan < 1 && $num_semakLayakUndi > 0) { ?>
                        <div class="alert alert-danger" role="alert"><strong>Maaf, tiada sebarang rekod pencalonan dan pengundian buat masa ini</strong></div>
                    <?php } else if($num_getKariah2 > 0) { ?>
                        <div class="alert alert-danger" role="alert"><strong>Maaf <?php echo($row_getKariah2['nama_penuh']); ?>, Anda tidak layak mengundi kerana anda belum mencapai umur 18 tahun pada tahun <?php echo(date('Y')); ?>, Sila berhubung dengan pihak pengurusan <?php echo($row_getKariah2['nama_masjid']); ?></strong></div>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert"><strong>Maaf, tiada rekod dijumpai, Sila berhubung dengan pihak pengurusan masjid atau anda boleh muat turun aplikasi MasjidPro Penang dengan mengimbas kod QR dibawah menerusi telefon pintar anda</strong></div>
                        <hr />
                        <img style="max-height: 350px" class="img-fluid" src="picture/muat_turun.png">
                    <?php } ?>
                </div>
            </div>
            <?php if($semakNoIC != NULL) { ?>
                <div class="row form-group" align="center">
                    <div class="col-12">
                        <a href="borangPencalonan.php"><button class="btn btn-info" type="button">Semak Semula</button></a>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    <?php } if($_GET['page'] == 2 || $tengoklah == 1) {
        $urlPOST = htmlspecialchars($_SERVER['REQUEST_URI']);
        if($tengoklah == 1) {
            $urlPOST = "borangPencalonan.php?self=1&page=2";
            $redirectURL = htmlspecialchars($_SERVER['REQUEST_URI']);
        }
        ?>
        <form action="<?php echo($urlPOST); ?>" method="post" enctype="multipart/form-data">
            <h4>Maklumat Calon</h4>
            <hr />
            <div class="row form-group">
                <div class="col-12 col-md-6">
                    <label>Jawatan</label>
                    <select class="form-control" name="jawatan" id="jawatan" required>
                        <option value="">Sila Pilih</option>
                        <option value="Pengerusi">Pengerusi</option>
                        <option value="Timbalan Pengerusi">Timbalan Pengerusi</option>
                        <option value="AJK">AJK </option>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12 dataCalon gambarCalon" style="display: none" align="center">
                    <label>Gambar Calon</label>
                    <?php showImage(NULL, 'gambarCalon', 'gambarCalon', 'gambarCalon_preview', 0); ?>
                </div>
                <div class="col-12 dataCalon" style="display: none">
                    <label>Nama Calon</label>
                    <input class="form-control" id="namaCalon" name="namaCalon" required readonly />
                </div>
                <div class="col-12 col-md-6">
                    <label>No K/P atau Nama</label>
                    <div class="input-group mb-3">
                        <input class="form-control" id="noIc_calon" name="noIc_calon" required list="search_terms" />
                        <div class="input-group-append">
                            <button style="display: none" type="button" class="dataCalon btn btn-info" onclick="resetData('#errMsgCalon', '.dataCalon', '#noIc_calon', '#butangCari')">Cari Semula</button>
                            <button id="butangCari" type="button" class="btn btn-info" onclick="selfUpdateForm('#errMsgCalon', $('#noIc_calon').val(), '.dataCalon', '#gambarCalon', '#noIc_calon', '#namaCalon', '#noTel_calon|', '#alamatCalon|', '#butangCari', '#search_terms')">Cari</button>
                        </div>
                        <datalist id="search_terms"></datalist>
                    </div>
                </div>
                <div class="col-12 col-md-6 dataCalon" style="display: none">
                    <label>No Tel</label>
                    <input class="form-control" id="noTel_calon" name="noTel_calon" required />
                </div>
                <div class="col-12 dataCalon" style="display: none">
                    <label>Alamat Calon</label>
                    <textarea oninput="this.value = this.value.toUpperCase()" class="form-control" id="alamatCalon" name="alamatCalon" maxlength="300" required rows="3"></textarea>
                </div>
                <div class="col-12 dataCalon" style="display: none">
                    <label>Lain-lain Maklumat</label>
                    <textarea oninput="this.value = this.value.toUpperCase()" class="form-control" id="catatan" name="catatan" maxlength="300" required rows="5"></textarea>
                </div>
                <div id="errMsgCalon" class="col-12" style="display: none"></div>
            </div>
            <hr />
            <h4>Maklumat Pencadang</h4>
            <hr />
            <div class="row form-group">
                <div class="col-12 dataCadang" style="display: none">
                    <label>Nama</label>
                    <input class="form-control" id="namaCadang" name="namaCadang" required readonly />
                </div>
                <div class="col-12 col-md-6">
                    <label>No K/P atau Nama</label>
                    <div class="input-group mb-3">
                        <input class="form-control" id="noIc_cadang" name="noIc_cadang" required />
                        <div class="input-group-append">
                            <button style="display: none" type="button" class="dataCadang btn btn-info" onclick="resetData('#errMsgCadang', '.dataCadang', '#noIc_cadang', '#butangCari2')">Cari Semula</button>
                            <button id="butangCari2" type="button" class="btn btn-info" onclick="selfUpdateForm('#errMsgCadang', $('#noIc_cadang').val(), '.dataCadang', null, '#noIc_cadang', '#namaCadang', '#noTel_cadang|', '|', '#butangCari2')">Cari</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 dataCadang" style="display: none">
                    <label>No Tel</label>
                    <input class="form-control" id="noTel_cadang" name="noTel_cadang" required />
                </div>
                <div id="errMsgCadang" class="col-12" style="display: none"></div>
            </div>
            <hr />
            <h4>Maklumat Penyokong</h4>
            <hr />
            <div class="row form-group">
                <div class="col-12 dataSokong" style="display: none">
                    <label>Nama</label>
                    <input class="form-control" id="namaSokong" name="namaSokong" required readonly />
                </div>
                <div class="col-12 col-md-6">
                    <label>No K/P atau Nama</label>
                    <div class="input-group mb-3">
                        <input class="form-control" id="noIc_sokong" name="noIc_sokong" required />
                        <div class="input-group-append">
                            <button style="display: none" type="button" class="dataSokong btn btn-info" onclick="resetData('#errMsgSokong', '.dataSokong', '#noIc_sokong', '#butangCari3')">Cari Semula</button>
                            <button id="butangCari3" type="button" class="btn btn-info" onclick="selfUpdateForm('#errMsgSokong', $('#noIc_sokong').val(), '.dataSokong', null, '#noIc_sokong', '#namaSokong', '#noTel_sokong|', '|', '#butangCari3')">Cari</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 dataSokong" style="display: none">
                    <label>No Tel</label>
                    <input class="form-control" id="noTel_sokong" name="noTel_sokong" required />
                </div>
                <div id="errMsgSokong" class="col-12" style="display: none"></div>
            </div>
            <?php if($tengoklah == 1) { ?>
                <hr />
                <h4>Keputusan Pencalonan</h4>
                <hr />
                <div class="row form-group">
                    <div class="col-12 col-md-6">
                        <label>Status Pencalonan</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="">Sila Pilih</option>
                            <option value="1">Lulus Pencalonan</option>
                            <option value="2">Tolak Pencalonan</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12">
                        <label>Ulasan (Jika ada)</label>
                        <textarea oninput="this.value = this.value.toUpperCase()" class="form-control" id="catatanPengurusan" name="catatanPengurusan" maxlength="300" rows="5"></textarea>
                    </div>
                </div>
            <?php } ?>
            <div class="row form-group">
                <div class="col-auto">
                    <?php if($_SESSION['isLogin'] == 1) { ?><input type="hidden" id="created_by" name="created_by" value="<?php echo($_SESSION['autoLogin_userid']); ?>"><?php } ?>
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="sesi_pemilihan_id" name="sesi_pemilihan_id" value="<?php echo $_GET['sesi_pemilihan_id']; ?>">
                    <?php if($tengoklah == 1) { ?><input type="hidden" name="redirectURL" value="<?php echo($redirectURL); ?>"><?php } ?>
                    <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                </div>
            </div>
        </form>
    <?php } if($_GET['page'] == 3) {
        $qAsal = "SELECT *, IF(a.jawatan = 'Pengerusi', 1, IF(a.jawatan = 'Timbalan Pengerusi', 2, IF(a.jawatan = 'AJK', 3, 99))) AS susunan FROM pencalonan a LEFT JOIN sesi_pemilihan b ON a.sesi_pemilihan_id = b.id WHERE a.status = 1 AND a.sesi_pemilihan_id = '".$row_listPencalonan['id']."' AND b.id_masjid = ".$_SESSION['autoLogin_idMasjid']." ORDER BY susunan ASC";
        $q = "SELECT *, a.id 'idCalon' FROM pencalonan a LEFT JOIN sesi_pemilihan b ON a.sesi_pemilihan_id = b.id WHERE a.jawatan = 'Pengerusi' AND a.status = 1 AND a.sesi_pemilihan_id = '".$row_listPencalonan['id']."' AND b.id_masjid = ".$_SESSION['autoLogin_idMasjid']." ORDER BY a.namaCalon ASC";
        selValueSQL($q, 'listCalon');
        $q2 = "SELECT *, a.id 'idCalon' FROM pencalonan a LEFT JOIN sesi_pemilihan b ON a.sesi_pemilihan_id = b.id WHERE a.jawatan = 'Timbalan Pengerusi' AND a.status = 1 AND a.sesi_pemilihan_id = '".$row_listPencalonan['id']."' AND b.id_masjid = ".$_SESSION['autoLogin_idMasjid']." ORDER BY a.namaCalon ASC";
        selValueSQL($q2, 'listCalon2');
        $q3 = "SELECT *, a.id 'idCalon' FROM pencalonan a LEFT JOIN sesi_pemilihan b ON a.sesi_pemilihan_id = b.id WHERE a.jawatan = 'AJK' AND a.status = 1 AND a.sesi_pemilihan_id = '".$row_listPencalonan['id']."' AND b.id_masjid = ".$_SESSION['autoLogin_idMasjid']." ORDER BY a.namaCalon ASC";
        selValueSQL($q3, 'listCalon3');
        $urlPOST = htmlspecialchars($_SERVER['REQUEST_URI']).'&page=3';
        ?>
        <form action="<?php echo($urlPOST); ?>" method="post" enctype="multipart/form-data">
            <div class="row form-group">
                <div class="col-auto">
                    <label>Nama</label>
                    <input class="form-control" name="namaPenuh" value="<?php echo($_SESSION['autoLogin_namaPenuh']); ?>" required readonly>
                </div>
                <div class="col-auto">
                    <label>No Telefon</label>
                    <input class="form-control" name="noTel" value="<?php echo($_SESSION['autoLogin_noHP']); ?>" required>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12 font-weight-bold"><h3>Pengerusi</h3></div>
                <?php if($num_listCalon > 0) { do { ?>
                    <div class="col-10">
                        <label><?php echo($row_listCalon['namaCalon']); ?></label>
                    </div>
                    <div class="col-2 j1">
                        <input name="pencalonan_id[]" type="checkbox" value="<?php echo($row_listCalon['idCalon']); ?>">
                    </div>
                <?php } while($row_listCalon = mysqli_fetch_assoc($fetch_listCalon)); } else { ?>
                    <div class="col-12">
                        <div class="alert alert-warning" role="alert">Tiada pencalonan untuk jawatan ini</div>
                    </div>
                <?php } ?>
            </div>
            <div class="row form-group">
                <div class="col-12 font-weight-bold"><h3>Timbalan Pengerusi</h3></div>
                <?php if($num_listCalon2 > 0) { do { ?>
                    <div class="col-10">
                        <label><?php echo($row_listCalon2['namaCalon']); ?></label>
                    </div>
                    <div class="col-2 j2">
                        <input name="pencalonan_id[]" type="checkbox" value="<?php echo($row_listCalon2['idCalon']); ?>">
                    </div>
                <?php } while($row_listCalon2 = mysqli_fetch_assoc($fetch_listCalon2)); } else { ?>
                    <div class="col-12">
                        <div class="alert alert-warning" role="alert">Tiada pencalonan untuk jawatan ini</div>
                    </div>
                <?php } ?>
            </div>
            <div class="row form-group">
                <div class="col-12 font-weight-bold"><h3>AJK</h3></div>
                <?php if($num_listCalon3 > 0) { do { ?>
                    <div class="col-10">
                        <label><?php echo($row_listCalon3['namaCalon']); ?></label>
                    </div>
                    <div class="col-2 j3">
                        <input name="pencalonan_id[]" type="checkbox" value="<?php echo($row_listCalon3['idCalon']); ?>">
                    </div>
                <?php } while($row_listCalon3 = mysqli_fetch_assoc($fetch_listCalon3)); } else { ?>
                    <div class="col-12">
                        <div class="alert alert-warning" role="alert">Tiada pencalonan untuk jawatan ini</div>
                    </div>
                <?php } ?>
            </div>
            <div class="row form-group">
                <div class="col-auto">
                    <input type="hidden" id="no_ic" name="no_ic" value="<?php echo($_SESSION['autoLogin_userid']); ?>">
                    <input type="hidden" id="idBorang" name="idBorang">
                    <input type="hidden" id="sesi_pemilihan_id" name="sesi_pemilihan_id" value="<?php echo $_GET['sesi_pemilihan_id']; ?>">
                    <input type="hidden" name="redirectURL" value="<?php echo($redirectURL); ?>">
                    <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                </div>
            </div>
        </form>
    <?php } ?>
<?php } if($tengoklah != 1 && $_GET['raw'] != 1) { ?>
    <?php if($_SESSION['isLogin'] != 1 && $semakNoIC == NULL) { ?>
        <?php if($_GET['page'] != NULL) { ?>
            <div class="alert alert-danger" role="alert"><strong>Hanya ahli kariah yang sah berdaftar sahaja boleh mengakses halaman ini</strong></div>
        <?php } ?>
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
        popupMsg2('alert', 'Kemasukkan Rekod Berjaya', '1 Pencalonan baharu telah dimasukkan', null, null, null);
        <?php } ?>
    </script>
<?php } if(($_GET['raw'] != 1 && $_GET['page'] != NULL) || $tengoklah == 1) { ?>
    <script id="sekeripCari" type="text/javascript">
        function carianInfo(inputData, a, b, c, d, e, f, errMsg, formGroupClass) {
            $(inputData).on('input', function() {
                alert(inputData);
                var value = $(inputData).val();
                var nilai = $(f+' [value="' + value + '"]').data('value');
                var myArray = nilai.split("|");
                $(errMsg).hide();
                $(e).hide();
                $(formGroupClass).show();
                $(a).val(myArray[2]);
                $(a).prop('readonly', true);
                $(b).val(myArray[0]);
                $(c).val(myArray[3]);
                if(c1 != null && c1 != '') $(c).val(c1);
                if(myArray[1] != null) $(d).val(myArray[1]);
                if(d1 != null && d1 != '') $(d).val(d1);
                $('.gambarCalon').hide();
            });
        }
    </script>
    <script type="text/javascript">
        //alert('<?php echo($_SERVER['REQUEST_URI']); ?>');

        function selfUpdateForm(errMsg, inputData, formGroupClass, gambar, a, b, c, d, e, f) {
            var SendInfo = {"no_ic":""+inputData+"", "id_masjid":<?php if($tengoklah == 1) echo($id_masjidCalon); else echo($id_masjid); ?>};
            var c1 = c.split("|")[1];
            c = c.split("|")[0];
            var d1 = d.split("|")[1];
            d = d.split("|")[0];
            $.ajax({
                type: 'POST',
                <?php if($tengoklah == 1) { ?>
                url: 'borangPencalonan.php?raw=1&p=users&json=1',
                <?php } else { ?>
                url: 'borangPencalonan.php?raw=1&p=users&json=1',
                <?php } ?>
                data: JSON.stringify(SendInfo),
                contentType: "application/json; charset=utf-8",
                cache: false,
                dataType: 'json',
                processData:false,
                statusCode: {
                    404: function() {
                        $(formGroupClass+' input').val(null);
                        $(formGroupClass+' textarea').val(null);
                        $(formGroupClass+' img').attr('src', 'https://masjidpro.com/Masjid/Uploads/imagesDefaultAvatar.png');
                        $(a).val(null);
                        $(errMsg).show();
                        $(errMsg).html('<div class="alert alert-danger" role="alert">Rekod Tidak Dijumpai</div>');
                    }
                },
                success: function(data) {
                    //alert(JSON.stringify(data));
                    $(f).html('');
                    $.each(data, function(i, obj) {
                        searchTerms = '<option data-value="'+data[i]['nama_penuh']+'|'+data[i]['alamat_terkini']+'|'+data[i]['no_ic']+'|'+data[i]['no_hp']+'" value="'+data[i]['no_ic']+'">'+data[i]['nama_penuh']+'</option>';
                        $(f).append(searchTerms);
                    });
                    eval(document.getElementById('sekeripCari').innerHTML);
                    carianInfo(inputData, a, b, c, d, e, f, errMsg, formGroupClass);
                    // $(errMsg).hide();
                    // $(e).hide();
                    // $(formGroupClass).show();
                    // $(a).val(data.no_ic);
                    // $(a).prop('readonly', true);
                    // $(b).val(data.nama_penuh);
                    // $(c).val(data.no_hp);
                    // if(c1 != null && c1 != '') $(c).val(c1);
                    // if(d != null) $(d).val(data.alamat_terkini);
                    // if(d1 != null && d1 != '') $(d).val(d1);
                    // $('.gambarCalon').hide();
                }
            });
            return true;
        }
        function resetData(errMsg, formGroupClass, a, b) {
            $(a).prop('readonly', false);
            $(a).val(null);
            $(formGroupClass+' input').val(null);
            $(formGroupClass+' textarea').val(null);
            $(formGroupClass+' img').attr('src', 'https://masjidpro.com/Masjid/Uploads/imagesDefaultAvatar.png');
            $(formGroupClass+','+errMsg).hide();
            $(b).show();
            $('#gambarCalon').removeAttr('required');
        }

        function preview_image2(event, b) {
            var reader = new FileReader();
            reader.onload = function()
            {
                var output = document.getElementById(b);
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
        <?php if($num_listCalon > 0) { ?>
        $('.j1 input[type=checkbox]').on('change', function (e) {
            if ($('.j1 input[type=checkbox]:checked').length > <?php echo($row_listCalon['pilihPengerusi']); ?>) {
                $(this).prop('checked', false);
                alert("Anda boleh memilih <?php echo($row_listCalon['pilihPengerusi']); ?> sahaja");
            }
        });
        <?php } if($num_listCalon2 > 0) { ?>
        $('.j2 input[type=checkbox]').on('change', function (e) {
            if ($('.j2 input[type=checkbox]:checked').length > <?php echo($row_listCalon2['pilihTimb']); ?>) {
                $(this).prop('checked', false);
                alert("Anda boleh memilih <?php echo($row_listCalon2['pilihTimb']); ?> sahaja");
            }
        });
        <?php } if($num_listCalon3 > 0) { ?>
        $('.j3 input[type=checkbox]').on('change', function (e) {
            if ($('.j3 input[type=checkbox]:checked').length > <?php echo($row_listCalon3['pilihAJK']); ?>) {
                $(this).prop('checked', false);
                alert("Anda boleh memilih <?php echo($row_listCalon3['pilihAJK']); ?> sahaja");
            }
        });
        <?php } ?>
    </script>
<?php } if($tengoklah != 1 && $_GET['raw'] != 1) { ?>
    <script type="text/javascript" src="borangPencalonan.php?raw=1&p=clear"></script>
    </body>

    </html>
<?php }
if($tengoklah != 1 && $_GET['raw'] != 1) {
//    if($_SESSION['autoLogin_userid'] == '840827025081') {
//        foreach ($_SESSION as $key => $val) echo "$key: $val<br />";
//        foreach ($_SERVER as $key => $val) echo "$key: $val<br />";
//    }
    mysqli_close($bd2);
}
?>