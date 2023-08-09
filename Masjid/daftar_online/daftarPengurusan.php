<?php
$mysql_hostname_utama = "localhost";
$mysql_user_utama = "tahfizte_spmd";
$mysql_password_utama = "WebmasterMasjid2019";
$mysql_database_utama = "tahfizte_masjidpro";

$bd2 = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama, $mysql_database_utama) or die("Could not connect database");

function cudSQL($query, $key_name) {
    global $bd2, ${'cud_'.$key_name}, ${'lastid_'.$key_name}, ${'delStatus_'.$key_name};

    ${'cud_'.$key_name} = mysqli_query($bd2, $query) or die(mysqli_error($bd2));
    if(strpos(substr($query,0,6), 'INSERT') !== false) {
        ${'lastid_'.$key_name} = mysqli_insert_id($bd2);
    }
    if(strpos(substr($query,0,6), 'DELETE') !== false) {
        ${'delStatus_'.$key_name} = 1;
    }
}

function selValueSQL($query, $key_name) {
    global $bd2, ${'meja_'.$key_name}, ${'row_'.$key_name}, ${'fetch_'.$key_name}, ${'num_'.$key_name};

    ${'fetch_'.$key_name} = mysqli_query($bd2, $query) or die(mysqli_error($bd2));
    ${'num_'.$key_name} = mysqli_num_rows(${'fetch_'.$key_name});
    ${'row_'.$key_name} = mysqli_fetch_assoc(${'fetch_'.$key_name});
    ${'meja_'.$key_name} = mysqli_fetch_field(${'fetch_'.$key_name});
}

function e($a, $b, $c) {
    global $bd2;
    if($b == 1) $a = strtoupper($a);
    //$a = addslashes($a);
    //$a = htmlspecialchars($a);
    $a = mysqli_real_escape_string($bd2, $a);
    if($c == 1) $a = stripslashes($a);
    return $a;
}

if($_SERVER['REQUEST_METHOD'] == "POST" && is_numeric($_POST['id_masjid']) && is_numeric($_POST['user_type_id'])) {
    $id_masjid = $_POST['id_masjid'];
    $username = e($_POST['username'], NULL, NULL);
    $password = e($_POST['password'], NULL, NULL);
    if($_POST['email'] != NULL && $_POST['email'] != "" && strpos($_POST['email'], ' ') === false) {
        $email_col = ", email";
        $email = ", '".e($_POST['email'], NULL, NULL)."'";
    }
    $user_name = e($_POST['user_name'], 1, NULL);
    $user_type_id = $_POST['user_type_id'];
    $perlu_zon = $_POST['perlu_zon'];
    if($_POST['kod_jemputan'] == "MASJIDPRO PENANG 20220324") $aktif = 1;
    else $aktif = 0;
    $q_semak = "SELECT * FROM masjid_user WHERE username = '$username' AND id_masjid = $id_masjid";
    selValueSQL($q_semak, "listUser");
    if($num_listUser < 1) {
        $q = "INSERT INTO masjid_user (aktif, id_masjid, username, password, user_type_id $email_col) VALUES ('$aktif', '$id_masjid', '$username', '$password', '$user_type_id' $email)";
        cudSQL($q, "daftarUser");
        //echo($q.'<br />');
        //$lastid_daftarUser = 99999;
    }
    if($lastid_daftarUser != NULL) {
        // Update setting zon masjid
        $qSettingZon = "UPDATE sej6x_data_masjid SET perlu_zon = $perlu_zon WHERE id_masjid = $id_masjid";
        cudSQL($qSettingZon, "settingZon");
        //echo($qSettingZon.'<br />');

        // Daftar Zon
        if($perlu_zon == 1) {
            $i = 0;
            foreach ($_POST['nama_zon'] as $key => $val) {
                $no_huruf = $_POST['no_huruf'][$i];
                //echo $i.' : '.$key.' : '.$val.'<br />';
                //echo $i.' : no_huruf : '.$_POST['no_huruf'][$i].'<br />';
                $qMasukZon = "INSERT INTO sej6x_data_zonqariah (id_masjid, nama_zon, no_huruf) VALUES ('$id_masjid', '$val', '$no_huruf')";
                cudSQL($qMasukZon, "masukZon");
                $i++;
            }
        }
        $daftar = 1;
        $notisMsg = "Pendaftaran berjaya dihantar, Sekiranya pendaftaran diluluskan, anda boleh log masuk untuk menggunakan sistem ini.";
    }
    else {
        $daftar = 0;
        $notisMsg = "Pendaftaran tidak berjaya dihantar, ID Pengguna telah wujud. Sila cuba sekali lagi";
    }
}

if(($_GET['id_masjid'] != NULL || $_POST['id_masjid'] != NULL) && (is_numeric($_GET['id_masjid']) || is_numeric($_POST['id_masjid']))) {
    if($_SERVER['REQUEST_METHOD'] == "POST") $id_masjid = e($_POST['id_masjid'], NULL, NULL);
    else $id_masjid = e($_GET['id_masjid'], NULL, NULL);

    if ($id_masjid != NULL) {
        $q = "SELECT * FROM sej6x_data_masjid WHERE id_masjid = $id_masjid";
        selValueSQL($q, "listMasjid");

        $q_jenisUser = "SELECT *, IF(user_type_id = 2, CONCAT(user_type, ' / TIMB PENGERUSI'), user_type) 'user_type' FROM jenis_user WHERE user_type_id NOT IN (1,3,9,12,13,4,14)";
        selValueSQL($q_jenisUser, "listJenisUser");

        $q_listZon = "SELECT * FROM sej6x_data_zonqariah WHERE id_masjid = $id_masjid";
        selValueSQL($q_listZon, "listZon");

        if(date('Y-m-d') == "2022-03-24") $kod_jemputan_default = "MASJIDPRO PENANG 20220324";
    }
    if($num_listMasjid < 1) {
        header("Location: pilih_masjid.php");
        exit;
    }
}
else {
    header("Location: pilih_masjid.php");
    exit;
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
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Masjid Pro - Pendaftaran Ahli Kariah">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="../images/logo2.png">
        <?php if($_GET['ahliKariah'] == 1) { ?>
            <title>Masjid Pro Penang - Pendaftaran Ahli Kariah</title>
        <?php } else { ?>
            <title><?php echo($row_listMasjid['nama_masjid']); ?> - Pendaftaran Pengurusan Kariah</title>
        <?php } ?>
        <link href="../themes/elite/node_modules/wizard/steps.css" rel="stylesheet">
        <!--alerts CSS -->
        <link href="../themes/elite/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
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
        <?php include("../loader.php"); ?>
    </head>

    <body class="horizontal-nav skin-megna fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Masjid Pro Penang</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->

    <nav class="navbar fixed-top navbar-light bg-light">
        <div class="col-auto"><a href="pilih_masjid.php"><button class="btn waves-effect waves-light btn-rounded btn-info">Kembali</button></a></div>
    </nav>
    <br /><br />

    <section id="wrapper">
        <div class="container-fluid" align="center">
            <div align="center"><img class="img-fluid" style="max-height: 100px" src="https://masjidpropenang.com/wp-content/uploads/2021/09/MasjidPro-Penang.png"></div>
            <hr/>
            <h2><?php echo($row_listMasjid['nama_masjid']); ?></h2>
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
            <!-- Validation wizard -->
            <div class="row" id="validation">
                <div class="col-12">
                    <div class="card wizard-content">
                        <div class="card-body">
                            <h4 class="card-title">Lengkapkan pendaftaran dibawah</h4>
                            <form id="daftarKariah" name="daftarKariah" action="daftarPengurusan.php" class="validation-wizard wizard-circle" method="post" enctype="multipart/form-data">
                                <!-- Step 1 -->
                                <h6>Maklumat Log Masuk</h6>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="username"> ID Pengguna : <span class="danger">*</span> </label>
                                                <input minlength="6" maxlength="20" type="text" class="form-control required" id="username" name="username"> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password"> Kata Laluan : <span class="danger">*</span> </label>
                                                <input maxlength="255" type="password" class="form-control required" id="password" name="password"> </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email"> Alamat E-Mel : </label>
                                                <input minlength="6" maxlength="191" type="email" class="form-control" id="email" name="email"> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="user_name">Nama : <span class="danger">*</span> </label>
                                                <input oninput="this.value = this.value.toUpperCase()" maxlength="50" type="text" class="form-control required" id="user_name" name="user_name"> </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="user_type_id"> Jawatan : <span class="danger">*</span> </label>
                                                <select id="user_type_id" name="user_type_id" class="form-control required">
                                                    <option value=""></option>
                                                    <?php do { ?>
                                                        <option value="<?php echo($row_listJenisUser['user_type_id']); ?>"><?php echo($row_listJenisUser['user_type']); ?></option>
                                                    <?php } while($row_listJenisUser = mysqli_fetch_assoc($fetch_listJenisUser)); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kod_jemputan">Kod Jemputan (Jika ada): </label>
                                                <input maxlength="100" type="text" class="form-control" id="kod_jemputan" name="kod_jemputan" value="<?php echo($kod_jemputan_default); ?>"> </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- Step 2 -->
                                <h6>Maklumat Zon Masjid</h6>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="perlu_zon">Mempunyai Zon Masjid : <span class="danger">*</span> </label>
                                                <select id="perlu_zon" name="perlu_zon" class="form-control required">
                                                    <option value=""></option>
                                                    <option value="1">Ya</option>
                                                    <option value="2">Tidak</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="ada_zon" class="row" style="display: none">
                                        <div id="inputFormRow" class="col-md-12 form-group">
                                            <div class="input-group">
                                                <input oninput="this.value = this.value.toUpperCase()" placeholder="* Nama Zon" type="text" class="form-control required" name="nama_zon[]">
                                                <input oninput="this.value = this.value.toUpperCase()" placeholder="Nombor / Huruf / Simbol Zon" type="text" class="col-md-3 form-control" name="no_huruf[]">
                                                <div class="input-group-append">
                                                    <button id="removeRow" type="button" class="btn btn-danger">Padam</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="ada_zon2" class="row" style="display: none">
                                        <div class="col-md-12"><button id="addRow" type="button" class="btn btn-info">Tambah</button></div>
                                    </div>
                                    <input id="id_masjid" name="id_masjid" type="hidden" value="<?php echo($id_masjid); ?>">
                                </section>
                            </form>
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
    <script src="../themes/elite/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../themes/elite/node_modules/popper/popper.min.js"></script>
    <script src="../themes/elite/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- This Page JS -->
    <script src="../themes/elite/node_modules/wizard/jquery.steps.min.js"></script>
    <script src="../themes/elite/node_modules/wizard/jquery.validate.min.js"></script>
    <script src="../themes/elite/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script>
        //Custom design form example
        $(".tab-wizard").steps({
            headerTag: "h6",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: "Daftar"
            },
            onFinished: function (event, currentIndex) {
                Swal.fire("Pendaftaran berjaya dihantar", "Sekiranya pendaftaran diluluskan, anda boleh log masuk untuk menggunakan sistem ini");

            }
        });


        var form = $(".validation-wizard").show();

        $(".validation-wizard").steps({
            headerTag: "h6",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: "Daftar"
            },
            onStepChanging: function (event, currentIndex, newIndex) {
                return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
            },
            onFinishing: function (event, currentIndex) {
                return form.validate().settings.ignore = ":disabled", form.valid()
            },
            onFinished: function (event, currentIndex) {
                $('#daftarKariah').submit();
                //Swal.fire("Pendaftaran berjaya dihantar", "Sekiranya pendaftaran diluluskan, anda boleh log masuk untuk menggunakan sistem ini");
            }
        }), $(".validation-wizard").validate({
            ignore: "input[type=hidden]",
            errorClass: "text-danger",
            successClass: "text-success",
            highlight: function (element, errorClass) {
                $(element).removeClass(errorClass)
            },
            unhighlight: function (element, errorClass) {
                $(element).removeClass(errorClass)
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element)
            },
            rules: {
                email: {
                    email: !0
                }
            }
        })
    </script>
    <script type="text/javascript">
        $(function() {
            var html = $('#ada_zon').html();
            $('#ada_zon').html('');
            $('#perlu_zon').on('change', function() {
                if(this.value == 1) $('#ada_zon, #ada_zon2').show();
                else $('#ada_zon, #ada_zon2').hide();
            });
            // add row
            $("#addRow").click(function () {
                $('#ada_zon').append(html);
            });

            // remove row
            $(document).on('click', '#removeRow', function () {
                $(this).closest('#inputFormRow').remove();
            });
            <?php if($_SERVER['REQUEST_METHOD'] == "POST") { if($daftar == 1) { ?>
            Swal.fire({
                type: 'success',
                title: 'Berjaya',
                text: '<?php echo($notisMsg); ?>',
                footer: '<a href="https://masjidpro.com/Masjid/login.php?kod_masjid=<?php echo($row_listMasjid['kod_masjid']); ?>"><h2>Log Masuk MasjidPro Penang</h2></a>'
            });
            <?php } else { ?>
            Swal.fire({
                type: 'error',
                title: 'Ralat',
                text: 'Pendaftaran Tidak Berjaya',
                footer: 'ID Pengguna telah wujud, sila cuba sekali lagi'
            });
            <?php } } ?>
            $(".preloader").fadeOut();
        });
    </script>
    </body>
    </html>
<?php mysqli_close($bd2); ?>