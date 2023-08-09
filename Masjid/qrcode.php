<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if($_GET['data'] == 'raw' && $_GET['action'] == 'qrcode') {
    if($_SERVER['SERVER_NAME'] == "sistem.gomasjid.my") $id_masjid = $_SESSION['id_masjidAsal'];
    else $id_masjid = $_SESSION['id_masjid'];
    $q = "SELECT * FROM sej6x_data_masjid WHERE id_masjid = $id_masjid";
    $q2 = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $row_masjid = mysqli_fetch_assoc($q2);
    $nama_masjid = $row_masjid['nama_masjid'];
    if($_SERVER['SERVER_NAME'] == "sistem.gomasjid.my") $url_qr = "https://sistem.gomasjid.my/login-kehadiran.php?lokasi=".$row_masjid['kod_qr'];
    else $url_qr = "https://masjidpro.com/Masjid/login-kehadiran.php?lokasi=".$row_masjid['kod_qr'];
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $secret = md5($row_masjid['kod_masjid']);
        $tujuan = strtoupper($_POST['tujuan']);
        $binn = bin2hex($tujuan."<->".$secret);
        $nama_masjid .= " :: $tujuan";
        $url_qr .= "&tujuan=$binn";
    }
    if($_GET['mode'] == "kehadiranPegawai") {
        if($_SERVER['SERVER_NAME'] == "sistem.gomasjid.my") $url_qr = "https://sistem.gomasjid.my/kehadiran_pegawai.php?id_masjid=$id_masjid";
        else $url_qr = "https://masjidpro.com/Masjid/kehadiran_pegawai.php?id_masjid=$id_masjid";
    }
    if($_GET['mode'] == "kehadiranPengurusan") {
        if($_SERVER['SERVER_NAME'] == "sistem.gomasjid.my") $url_qr = "https://sistem.gomasjid.my/kehadiran_pengurusan.php?id_masjid=$id_masjid";
        else $url_qr = "https://masjidpro.com/Masjid/kehadiran_pegawai.php?id_masjid=$id_masjid";
    }
    ?>
    <!doctype html>
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
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <meta charset="utf-8">
        <!--meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css" integrity="sha512-drnvWxqfgcU6sLzAJttJv7LKdjWn0nxWCSbEAtxJ/YYaZMyoNLovG7lPqZRdhgL1gAUfa+V7tbin8y+2llC1cw==" crossorigin="anonymous" />
        <title><?php echo $_SERVER['SERVER_NAME'] == "sistem.gomasjid.my" ? 'GoMasjid' : 'Masjid Pro'; ?> - Kod QR :: <?php echo($nama_masjid); ?></title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.js" integrity="sha512-g6uKBhbH4/FmsKhkup5OCgdNJ6hHQxcJZ7jPPF5lI7ZTeQtBqTC0B0nT1Rg15blk6pnOd5CoMUwvXSxjaYUzuA==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.js" integrity="sha512-KCgUnRzizZDFYoNEYmnqlo0PRE6rQkek9dE/oyIiCExStQ72O7GwIFfmPdkzk4OvZ/sbHKSLVeR4Gl3s7s679g==" crossorigin="anonymous"></script>
        <!--script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.js" integrity="sha512-is1ls2rgwpFZyixqKFEExPHVUUL+pPkBEPw47s/6NDQ4n1m6T/ySeDW3p54jp45z2EJ0RSOgilqee1WhtelXfA==" crossorigin="anonymous"></script-->
        <script src="qrcode.js"></script>
        <style type="text/css">
            html, body, .container {
                height:100%;
                width:100%;
            }
            @media print {
                .printPageButton {
                    display: none;
                }
            }
        </style>
    </head>
    <body style="background-color: #010280">
    <div id="pengisi" style="padding-bottom: 20px; padding-top: 20px; padding-left: 20px; padding-right: 20px">
        <div class="printPageButton row justify-content-md-center form-group" align="center">
            <div class="col-md-auto col-6"><button class="btn btn-success" style="text-align: center; font-size: 14pt; font-weight: bold" onclick="window.print()">Cetak Kod QR</button></div>
            <div class="col-md-auto col-6"><a href="utama.php?view=admin&action=profil"><button class="btn btn-primary" style="text-align: center; font-size: 14pt; font-weight: bold">Kembali ke Profil</button></a></div>
        </div>
        <div class="row" style="padding-bottom: 20px; padding-top: 20px; padding-left: 20px; padding-right: 20px">
            <div class="col-12 col-md-12 p-10">
                <div class="row">
                    <div class="col-12 col-md-12" style="background: white" align="center">
                        <img class="img-fluid" src="<?php echo $_SERVER['SERVER_NAME'] == "sistem.gomasjid.my" ? 'https://dashboard2.gomasjid.my/assets/images/logo_gomasjid.png' : 'images/logo.png'; ?>" width="800px" style="padding-bottom: 20px; padding-top: 20px; padding-left: 20px; padding-right: 20px">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12" align="center" style="color: white">
                        <br />
                        <h3 style="font-weight: bold">SAHKAN KEHADIRAN ANDA DENGAN MENGIMBAS KOD QR DIBAWAH</h3>
                        <br />
                    </div>
                </div>
                <div class="row">
                    <div class="qr-code-generator col-12 col-md-12" align="center" style="background: white; color: black">
                        <div id="qrcode" class="img-fluid" style="padding-bottom: 30px; padding-top: 30px; padding-left: 20px; padding-right: 20px"></div>
                    </div>
                </div>
                <div id="last_sekali" class="row" style="background: white">
                    <div class="col-12 col-md-12 align-items-start" align="center">
                        <h3>Anda kini berada di Masjid:</h3>
                        <h1 style="font-weight: bold"><?php echo($row_masjid['nama_masjid']); ?></h1>
                    </div>
                    <?php if($_SERVER['REQUEST_METHOD'] == "POST") { ?>
                        <div class="col-12 col-md-12 align-items-start" align="center">
                            <h3>Aktiviti:</h3>
                            <h1 style="font-weight: bold"><?php echo($tujuan); ?></h1>
                        </div>
                    <?php } ?>
                </div>
                <?php
                if(($_GET['mode']!="kehadiranPegawai") AND ($_GET['mode']!="kehadiranPengurusan")) {
                ?>
                <div class="row" style="background: white">
                    <div class="col-12 col-md-12 align-items-end" align="center" style="background: white">
                        <table width="100%" border="0">
                            <tr>
                                <td align="right" valign="middle" style="font-weight: bold"><h4>Sistem ini integrasi bersama MySejahtera</h4></td>
                                <td align="right" width="100px"><img src="https://mysejahtera.malaysia.gov.my/checkin/images/logo.png" class="img-fluid" width="100px"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                    <?php } ?>
            </div>
        </div>
    </div>
    <script id="rendered-js" >
        $('#last_sekali').css("height", '280');
        // Clear Previous QR Code
        $('#qrcode').empty();
        $('#qrcode').css({
            'width': '100%',
            'height': 'auto' });

        // Generate and Output QR Code
        $('#qrcode').qrcode({ width: '600', height: '600', text: "<?php echo($url_qr); ?>" });

        //# sourceURL=pen.js
    </script>
    </body>
    </html>
<?php } ?>