<?php
include("connection.php");
include("../fungsi.php");
if($_SERVER['REQUEST_METHOD'] == "POST" || $_SESSION['no_ic'] != NULL) {
    goto semak_data;
    semak_balik:
    $semak = 1;

    semak_data:
    $no_ic = e($_POST['no_ic'], NULL, NULL);
    if($_SESSION['no_ic'] != NULL) $no_ic = $_SESSION['no_ic'];
    selValueSQL("SELECT *, id_data 'id_data' FROM sej6x_data_peribadi WHERE no_ic = '$no_ic'", "infoKariah");
    if($num_infoKariah < 1) selValueSQL("SELECT *, ID 'id_data' FROM sej6x_data_anakqariah WHERE no_ic = '$no_ic'", "infoKariah");
    else if($num_infoKariah < 1) selValueSQL("SELECT *, id 'id_data' FROM approve_qariah WHERE no_ic = '$no_ic'", "infoKariah");
    else if($num_infoKariah < 1) selValueSQL("SELECT *, ID 'id_data' FROM approve_anak WHERE no_ic = '$no_ic'", "infoKariah");
    else $rekod = 0;
    if(($row_infoKariah['emel'] == NULL || $semak == 1) && $_POST['lupa'] != 1) {
        if($semak == 1) $pass = 1;
        goto info_masjid;
    }

    if($_POST['password'] != NULL && $_POST['semak'] == 1 && $_POST['lupa'] != 1) {
        if (password_verify($_POST['password'], $row_infoKariah['password'])) $pass = 1;
        else $pass = 0;
    }

    if($_SESSION['no_ic'] != NULL && $_POST['lupa'] != 1) $pass = 1;

    info_masjid:
    if($num_infoKariah > 0) {
        do {
            $meja = $meja_infoKariah->table;
        } while ($meja_infoKariah = mysqli_fetch_field($fetch_infoKariah));
    }
    if((($num_infoKariah > 0 && $row_infoKariah['emel'] == NULL) || ($pass == 1 && $num_infoKariah > 0)) && $_POST['lupa'] != 1) {
        $rekod = 1;
        selValueSQL("SELECT * FROM sej6x_data_masjid WHERE id_masjid = ".$row_infoKariah['id_masjid'], "infoMasjid");
        $_SESSION['no_ic'] = $row_infoKariah['no_ic'];
        setcookie("no_ic", $row_infoKariah['no_ic'], time() + (86400 * 365), "/");
        $_COOKIE['no_ic'] = $row_infoKariah['no_ic'];
        if($semak == 1) goto teruskan;
    }
    if($_POST['edit_pass'] == 1) {
        selValueSQL("SHOW KEYS FROM $meja WHERE Key_name = 'PRIMARY'", "keyKariah");
        $col_key = $row_keyKariah['Column_name'];
        $id_data = $row_infoKariah['id_data'];
        $emel = e($_POST['emel'], NULL, NULL);
        cudSQL("UPDATE $meja SET emel = '$emel' WHERE $col_key = $id_data", "updateEmel");
        if($_POST['password'] != NULL) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            cudSQL("UPDATE $meja SET password = '$password' WHERE $col_key = $id_data", "updatePassword");
        }
        goto semak_balik;
    }
}
teruskan:

if($_SERVER['REQUEST_METHOD'] != "POST") { ?>
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
        <title>Masjid Pro - Log Masuk Pengguna</title>

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
    <div class="login-register" style="background-image:url(../themes/elite/images/background/login-register.jpg); overflow-x: hidden">
    <div class="login-box card">
    <div class="card-body">
    <form class="form-horizontal form-material2" id="loginform" enctype="multipart/form-data">
    <input name="token" type="hidden" value="<?php echo($_GET['token']); ?>">
    <?php if($_GET['redirect'] != NULL) { ?><input name="redirect" type="hidden" value="<?php echo($_GET['redirect']); ?>"><?php } ?>
    <div>
        <div class="col-12 text-center">
            <div class="user-thumb text-center">
                <img alt="Masjid Pro" class="img-fluid" src="../images/logo.gif">
                <hr />
            </div>
        </div>
    </div>
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
    <div id="load_content">
<?php } if($_POST['lupa'] == 1) {
    $tengoklah = 1;
    include("sendMail.php");
    if($berjaya == 1) {
        ?>
        <div class="form-group">
            <div class="alert alert-success" style="font-weight: bold">
                Pautan (link) untuk menetapkan kata laluan baharu telah dihantar ke alamat emel anda<br/>
                <?php echo($row_infoKariah['emel']); ?><br />
                Sila semak peti e-mel anda, sekiranya tiada, sila semak dalam bahagian folder SPAM
            </div>
        </div>
    <?php } } if($_POST['lupa'] != 1) {?>
    <div class="form-group">
        <h3 class="card-title">Log Masuk Pengguna</h3>
    </div>
<?php } if(($_SERVER['REQUEST_METHOD'] == "POST" || $_SESSION['no_ic'] != NULL) && $_POST['lupa'] != 1) { ?>
    <?php if($num_infoKariah < 1) { ?>
        <div class="form-group">
            <div class="alert alert-danger" style="font-weight: bold">Maklumat ahli kariah tidak dijumpai</div>
        </div>
    <?php } else if($_POST['semak'] == 1 && $row_infoKariah['emel'] != NULL && $pass == 0) { ?>
        <div class="form-group">
            <div class="alert alert-danger" style="font-weight: bold">Kata Laluan tidak tepat</div>
        </div>
    <?php } else if(($num_infoKariah > 0 && $row_infoKariah['emel'] == NULL) || ($num_infoKariah > 0 && $pass == 1)) { ?>
        <div class="form-group">
            <div class="alert alert-success" style="font-weight: bold">
                <?php echo($row_infoMasjid['nama_masjid']); ?><br />
                <?php echo($row_infoKariah['nama_penuh']); ?>
            </div>
        </div>
    <?php } ?>
<?php } if($_POST['lupa'] != 1) { ?>
    <div class="form-group">
        <?php if($_SERVER['REQUEST_METHOD'] == "POST" || $_SESSION['no_ic'] != NULL) { ?><label class="control-label">No K/P atau Passpot</label><?php } ?>
        <input id="no_ic" name="no_ic" class="form-control" required placeholder="No K/P atau Passpot" <?php if($_SERVER['REQUEST_METHOD'] == "POST" || $_SESSION['no_ic'] != NULL) echo('value="'.$row_infoKariah['no_ic'].'"'); if($num_infoKariah > 0) echo(' readonly'); ?>>
    </div>
<?php } if($_SERVER['REQUEST_METHOD'] == "POST" || $_SESSION['no_ic'] != NULL) { ?>
    <?php if($num_infoKariah > 0 && $_POST['lupa'] != 1) { ?>
        <?php if((($num_infoKariah > 0 && $row_infoKariah['emel'] == NULL) || ($num_infoKariah > 0 && $pass == 1)) && $_POST['lupa'] != 1) { ?>
            <div class="form-group" align="center">
                <script>
                    $(document).ready(function(){
                        $('.edit-pass').hide();
                        $("#password, #password2").keyup(checkPasswordMatch);
                        <?php if($_POST['edit_pass'] == 1) { ?>$('#sa-success').click();<?php } ?>
                    });
                </script>
                <?php if($_POST['edit_pass'] == 1) { ?><img style="display: none" id="sa-success" src="#" /><?php } ?>
                <?php if($row_infoKariah['emel'] != NULL) { ?>
                    <div id="btn_tetap" class="col-12 form-group"><button type="button" class="btn btn-info" onclick="tetapkan()">Kemaskini E-Mel & Kata Laluan</button></div>
                <?php } else { ?>
                    <div class="alert alert-warning">Anda belum menetapkan e-mel dan kata laluan, anda digalakkan menetapkannya untuk keselamatan maklumat peribadi anda</div>
                    <div id="btn_tetap" class="col-12 form-group"><button type="button" class="btn btn-info" onclick="tetapkan()">Tetapkan E-Mel & Kata Laluan Sekarang</button></div>
                <?php } ?>
                <div class="col-12 form-group"><button type="button" class="btn btn-warning" onclick="langkau()">Langkau & Teruskan</button></div>
            </div>
            <div class="form-group edit-pass">
                <label class="control-label">E-Mel</label>
                <input type="email" name="emel" id="emel" class="form-control" placeholder="Masukkan Alamat E-Mel" value="<?php echo($row_infoKariah['emel']); ?>">
            </div>
            <?php if($_POST['redirect'] == "daftar_solat") { ?><script>document.location.href="https://daftarsolat.masjidpro.com";</script><?php } ?>
        <?php } if($_POST['lupa'] != 1) { ?>
            <div class="form-group edit-pass">
                <label class="control-label">Kata Laluan</label>
                <input type="password" name="password" id="password" class="form-control" minlength="6" <?php if($row_infoKariah['emel'] == NULL) echo('required'); ?>>
                <small class="form-control-feedback">Minima 6 aksara</small>
                <?php if($row_infoKariah['emel'] != NULL && $pass == 1) { ?><br /><small class="form-control-feedback">* Biarkan kosong sekiranya anda tidak ingin menukar kata laluan</small><?php } ?>
            </div>
        <?php } if(($num_infoKariah > 0 && $row_infoKariah['emel'] == NULL) || ($num_infoKariah > 0 && $pass == 1) && $_POST['lupa'] != 1) { ?>
            <div class="form-group edit-pass">
                <label class="control-label">Sahkan Kata Laluan</label>
                <input type="password" name="password2" id="password2" class="form-control" minlength="6" <?php if($row_infoKariah['emel'] == NULL) echo('required'); ?>>
                <div id="divCheckPasswordMatch"></div>
            </div>
            <input id="edit_pass" name="edit_pass" type="hidden" value="0">
            <input id="simpan" name="simpan" type="hidden" value="semak">
            <input id="id_masjid" name="id_masjid" type="hidden" value="<?php echo($row_infoMasjid['id_masjid']); ?>">
        <?php } ?>
    <?php } ?>
<?php } if($_POST['lupa'] != 1) { ?>
    <input id="semak" name="semak" type="hidden" value="<?php if($_SERVER['REQUEST_METHOD'] == "POST" || $_SESSION['no_ic'] != NULL) echo('1'); else echo('0')?>">
    <div id="button_daftar" class="form-group text-center edit-pass">
        <div class="col-12">
            <button id="btn_kemaskini" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">OK</button>
        </div>
    </div>
<?php } if($_SERVER['REQUEST_METHOD'] == "POST" && $pass == 0 && $_SESSION['no_ic'] == NULL && $_POST['lupa'] != 1) { ?>
    <input name="lupa" id="lupa" type="hidden">
    <div id="button_reset_password" class="form-group text-center">
        <div class="col-12">
            <button onclick="return $('#lupa').val('1');" id="btn_lupa" class="btn btn-danger btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Lupa Kata Laluan</button>
        </div>
    </div>
<?php } ?>
<?php if($_SERVER['REQUEST_METHOD'] != "POST") { ?>
    <div class="form-group text-center" style="display: none">
        <div class="col-xs-12">
            <a href="javascript:history.back(-100);"><button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="button">Menu Utama</button></a>
        </div>
    </div>
    </div>
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
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../themes/elite/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="../themes/elite/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../themes/elite/dist/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../themes/elite/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../themes/elite/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="../themes/elite/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script id="load_sekerip2">
        !function ($) {
            "use strict";

            var SweetAlert = function () { };

            //examples
            SweetAlert.prototype.init = function () {

                //Basic
                $('#sa-basic').click(function () {
                    Swal.fire("Here's a message!");
                });

                //A title with a text under
                $('#sa-title').click(function () {
                    Swal.fire("Here's a message!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.")
                });

                //Success Message
                $('#sa-success').click(function () {
                    Swal.fire("Berjaya", "Maklumat telah dikemaskini", "success")
                });
            },
                //init
                $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
        }(window.jQuery),

            //initializing
            function ($) {
                "use strict";
                $.SweetAlert.init()
            }(window.jQuery);
    </script>
    <script id="load_sekerip" type="text/javascript">
        function checkPasswordMatch() {
            var password = $("#password").val();
            var confirmPassword = $("#password2").val();

            if (password != confirmPassword) {
                $("#divCheckPasswordMatch").html('<br/><div class="alert alert-danger">Kata laluan TIDAK sepadan!</div>');
                $('#button_daftar').fadeOut();
            }
            else {
                $("#divCheckPasswordMatch").html('<br/><div class="alert alert-success">Kata laluan sepadan.</div>');
                $('#button_daftar').fadeIn();
            }
        }

        function tetapkan() {
            $('#btn_tetap').hide();
            $('.edit-pass').fadeIn();
            $('#edit_pass').val('1');
            $('#emel').attr('required', true);
        }

        function langkau() {
            $('#loginform').attr('action', 'pendaftaran.php?id_masjid=6279');
            $('#loginform').attr('method', 'POST');
            $('#loginform').attr('id', 'langkau');
            document.getElementById("langkau").submit();
        }

    </script>
    <script type="text/javascript">
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
                        eval(document.getElementById('load_sekerip').innerHTML);
                        eval(document.getElementById('load_sekerip2').innerHTML);
                    }
                });
                //this.reset();
            });
        }

        selfUpdate('#loginform', 'kemaskini.php', '#load_content');

        $(function() {
            <?php if($_SESSION['no_ic'] != NULL) { ?>$('.edit-pass').hide();<?php } ?>
            $(".preloader").fadeOut();
        });
    </script>
<?php if($_GET['debug'] == 1) {
echo '<div class="modal fade" id="modalDebug" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header">
                <h4 class="modal-title" id="defaultDebugLabel">Debug</h4></div><div class="modal-body">';
foreach ($_SESSION as $lihat_session => $val) {
    echo('$_SESSION[\''.$lihat_session.'\']: '.$_SESSION[$lihat_session].'<br />');
}
foreach ($_COOKIE as $lihat_session2 => $val2) {
    echo('$_COOKIE[\''.$lihat_session2.'\']: '.$_COOKIE[$lihat_session2].'<br />');
}
echo '</div><div class="modal-footer"><button type="button" class="btn btn-link" data-dismiss="modal">TUTUP</button>
            </div></div></div></div>';
?>
    <script>
        $('#modalDebug').modal('show');
    </script>
<?php } ?>
    </body>
    </html>
<?php }
mysqli_close($bd2);
?>