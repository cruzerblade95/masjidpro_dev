<?php
require_once '../Mobile_Detect.php';
$versiStore = "3.0.1";
$detect = new Mobile_Detect;
if($_GET['keterangan'] == 1 || $_GET['keterangan'] == 2) {
    require_once '../Mobile_Detect.php';
    $detect = new Mobile_Detect;
    $ejen = $_SERVER['HTTP_USER_AGENT'];
    $hide = $_GET['hide'];
    if($_GET['versi'] != NULL) {
        if($_GET['versi'] == $versiStore) $hide = 1;
    }

    if($_GET['listBantuan'] != 1) header("Location: https://www.masjidpro.com/Masjid/SPMD/login.php?sumbang=1&hide=$hide");

}
if($_GET['map'] == 1) header("Location: https://masjidpro.com/Masjid/daftar_online");
include("../connection/connection.php");
if($_GET['sumbang'] != NULL) $tajuk_button = 'Sumbangan Kepada Masjid';
if($_GET['sumbang'] == NULL) $tajuk_button = 'Daftar Ahli Kariah';
$sumbang_val = $_GET['sumbang'];
if (strpos($_SERVER['SCRIPT_URI'], 'http://masjidpro.com/Masjid/SPMD/login.php') !== false) {
    header("Location: https://www.masjidpro.com/Masjid/SPMD/login.php?sumbang=$sumbang_val");
}
if (strpos($_SERVER['SCRIPT_URI'], 'http://www.masjidpro.com/Masjid/SPMD/login.php') !== false) {
    header("Location: https://www.masjidpro.com/Masjid/SPMD/login.php?sumbang=$sumbang_val");
}

if($sumbang_val == NULL && $_GET['map'] != 1) header('Location: login.php?map=1');

if($_GET['map'] == 1) {
    $lat = $_GET['y'];
    $lng = $_GET['x'];
    $lat = 6.193062666666667;
    $lng = 100.43226333333332;
    if($lat != NULL && $lng != NULL) {
        $masjid_terdekat = "SELECT *, ( 6371 * acos( cos( radians($lat) ) * cos( radians( koordinat_y ) ) * cos( radians( koordinat_x ) - radians($lng) ) + sin( radians($lat) ) * sin(radians(koordinat_y)) ) ) AS distance FROM sej6x_data_masjid WHERE koordinat_y IS NOT NULL AND koordinat_x IS NOT NULL HAVING distance < 10 ORDER BY distance";
        $terdekat = mysqli_query($bd2, $masjid_terdekat) or die(mysqli_error($bd2));
        $info_terdekat = mysqli_fetch_assoc($terdekat);
        $num_terdekat = mysqli_num_rows($terdekat);

        if ($num_terdekat > 0) {
            $lokasi = array();
            $i = 0;
            do {
                $lokasi[$i]->form = "masjid_".$info_terdekat['id_masjid'];
                $lokasi[$i]->id_masjid = $info_terdekat['id_masjid'];
                $lokasi[$i]->lat = $info_terdekat['koordinat_y'];
                $lokasi[$i]->lng = $info_terdekat['koordinat_x'];
                $lokasi[$i]->icon = 'images/masjid.png';
                $lokasi[$i]->content = '<div class="store card border-0 rounded-0"><button class="btn btn-lg btn-primary btn-block" type="submit" form="masjid_'.$info_terdekat['id_masjid'].'">'.$tajuk_button.'</button><div class="card-body">
<a href="listing-details-full-image.html" class="card-title font-weight-semibold font-size-lg text-capitalize text-dark" style="font-weight: bold">'.$info_terdekat['nama_masjid'].'</a>
<div class="card-footer border-0 px-0 bg-transparent"><a href="#" class="link-hover-dark-primary"><span class="d-inline-block mr-2">
<i class="fa fa-map-marker"></i></span>'.$info_terdekat['negeri'].' - '.$info_terdekat['daerah'].'</a></div></div></div>';
                $i++;
            } while ($info_terdekat = mysqli_fetch_assoc($terdekat));
            $lokasi_json = json_encode($lokasi, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            $lokasi_json = str_replace('[', '', $lokasi_json);
            $lokasi_json = str_replace(']', '', $lokasi_json);
        }
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
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/logo2.png">
    <?php if($_GET['sumbang'] != NULL) { ?><title>Masjid Pro - Sumbangan</title><?php } ?>
    <?php if($_GET['sumbang'] == NULL) { ?><title>Masjid Pro - Pendaftaran Ahli Kariah</title><?php } ?>
    <link rel="apple-touch-icon" href="../images/logo2.png">
    <link rel="shortcut icon" href="../images/logo2.png">
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
    <style type="text/css">
        .gm-style-cc { display:none; }
    </style>
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
<?php if($_GET['map'] == 1) { ?>
    <nav class="navbar sticky-top" style="background-color:#32C9FF; margin-bottom: 0px" align="center">
        <div align="center"><img src="../picture/masjidpro.png" height="75" width="188"></div>
        <div align="center" style="display: none">
            <select name="mode_daftar" id="mode_daftar" class="form-control" style="width: fit-content">
                <option value="1">Peta Masjid Terdekat (< 5KM)</option>
                <option value="2">Senarai Masjid Terdekat (< 5KM)</option>
                <option value="3">Carian Mengikut Poskod Masjid</option>
                <option value="4">Senarai Semua Masjid</option>
            </select>
        </div>
    </nav>
    <div id="tunggu" class="sk-circle" align="center">
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
    <div id="isi" class="all-ajax-module"></div>
    <div id="demo" style="visibility: hidden;"></div>
    <div id="daftar_map" style="display: none"></div>
<?php } if($_GET['map'] != 1) { ?>
    <section id="wrapper">
        <div class2="login-register" style="background-image:url(../themes/elite/images/background/login-register.jpg);">
            <div class="login-box2 card">
                <div class="card-header" align="center">
                    <?php
                    if($_GET['keterangan'] == 1 || $_GET['keterangan'] == NULL) $logo = "../images/logo_masjidpropenang.png";
                    if($_GET['keterangan'] == 2) $logo = "../picture/logoGoMasjid.png";
                    ?>
                    <img alt="Masjid Pro" class="img-fluid" src="<?php echo($logo); ?>">
                </div>
                <div class="card-body">
                    <?php if($_GET['keterangan'] != 1 && $_GET['keterangan'] != 2 && $_GET['listBantuan'] != 1 && $_GET['hide'] != 1) { ?>
                    <?php if($_GET['sumbang'] != NULL) { ?><form id="form_sumbang" method="GET" action="../SPMD/detail_bantuan.php"><input name="sumbang" id="sumbang" value="1" type="hidden"><?php } ?>
                        <?php if($_GET['sumbang'] == NULL) { ?><form method="GET" action="../daftar_online/pendaftaran.php"><?php } ?>
                            <?php if($_GET['sumbang'] != NULL) { ?>
                                <div id="butang_peduli3" class="form-group jenis-derma" style="display: none">
                                    <button id="butang_peduli4" onclick="return mode_derma(4)" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type='button'>KOTAK PEDULI RAYA FAKIR DAN ASNAF</button>
                                </div>
                                <div id="butang_tabung" class="form-group jenis-derma" style="display: none">
                                    <button id="butang_tabung2" onclick="return mode_derma(3)" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type='button'>TABUNG BENCANA</button>
                                </div>
                                <div id="butang_peduli" class="form-group jenis-derma">
                                    <button id="butang_peduli2" onclick="return mode_derma(2)" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type='button'>KOTAK PEDULI KARIAH</button>
                                </div>
                            <?php } ?>
                            <div id="butang_sumbang" class="form-group jenis-derma">
                                <button id="butang_sumbang2" onclick="return mode_derma(1)" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type='button'><?php echo($tajuk_button); ?></button>
                            </div>
                            <hr>
                            <div id="kotakMasjid" class="form-group alert alert-success" role="alert" style="display: none">
                                <label>Pilih Daerah dan Masjid:-</label>
                                <div class="accordion" id="accordionExample">
                                    <?php
                                    $q = "SELECT * FROM daerah WHERE id_negeri = 9 ORDER BY nama_daerah ASC";
                                    $q2 = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
                                    $row_q = mysqli_fetch_assoc($q2);
                                    $i = 1;
                                    do {
                                        ?>
                                        <div class="card">
                                            <div class="card-header" id="daerah_<?php echo($i); ?>">
                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse_<?php echo($i); ?>" aria-expanded="true" aria-controls="collapse_<?php echo($i); ?>">
                                                    <?php echo($row_q['nama_daerah']); ?>
                                                </button>
                                            </div>
                                            <div id="collapse_<?php echo($i); ?>" class="collapse" aria-labelledby="daerah_<?php echo($i); ?>" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <?php
                                                    $sql="SELECT id_masjid, nama_masjid FROM sej6x_data_masjid WHERE url_masjid IS NOT NULL AND id_masjid NOT IN (6279, 6284) AND id_daerah = ".$row_q['id_daerah']." ORDER BY nama_masjid ASC";
                                                    $sqlquery=mysqli_query($bd2, $sql);
                                                    $data=mysqli_fetch_assoc($sqlquery);
                                                    $k = 1;
                                                    do {
                                                        ?>
                                                        <div class="list-sejid row form-group" onclick="pilihlahMasjid(<?php echo $data['id_masjid']; ?>)"><div class="col-12"><button class="btn btn-info btn-block text-left" type="button"><?php echo $k.'. '.$data['nama_masjid'];?></button></div></div>
                                                        <?php
                                                        $k++;
                                                    } while($data=mysqli_fetch_assoc($sqlquery));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $i++; } while($row_q = mysqli_fetch_assoc($q2)); ?>
                                </div>
                                <input type="hidden" id="id_masjid" name="id_masjid" required>
                            </div>
                            <hr />
                            <div style="text-align: center">Masjid Pro © | 2019</div>
                        </form>
                        <?php } else if($_GET['listBantuan'] == 1) {
                            $q = "SELECT a.nama_masjid, a.no_tel, CONCAT(a.alamat_masjid, ', ', a.poskod, ' ', c.nama_daerah, ', ', b.name) AS alamat FROM sej6x_data_masjid a, negeri b, daerah c WHERE a.id_negeri = b.id_negeri AND a.id_daerah = c.id_daerah AND (a.url_masjid IS NOT NULL OR a.url_daftar IS NOT NULL) AND a.id_masjid NOT IN (6279, 6284, 6285)";
                            $q2 = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
                            $row_q = mysqli_fetch_assoc($q2);
                            ?>
                            <div class="alert alert-info" role="alert">
                                Berikut adalah senarai masjid yang menawarkan bantuan khusus untuk ahli kariah yang mengalami musibah atau kesusahan
                            </div>
                            <hr />
                            <div class="table-responsive">
                                <table class="table table-sm table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Masjid</th>
                                        <th scope="col">Alamat</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; do { ?>
                                        <tr>
                                            <th scope="row"><?php echo($i); ?></th>
                                            <td><?php echo($row_q['nama_masjid']); ?></td>
                                            <td><?php echo($row_q['alamat']); ?></td>
                                        </tr>
                                        <?php $i++; } while($row_q = mysqli_fetch_assoc($q2)); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <h4><strong>Apa itu infaq?</strong></h4>
                            <hr />
                            <div>
                                Apakah perbezaan antara sedekah (derma), wakaf dan infak?
                                <br /><br />
                                Sedekah bererti pemberian yang padanya dicari pahala daripada Allah SWT. (Rujuk al-Ta’rifat - 1/132)
                                Ibn Manzur memberikan definisi sedekah sebagai apa yang kita berikan kerana Allah SWT kepada golongan fakir yang memerlukan. (Rujuk Lisan al-Arab (10/196)
                                Sedekah merangkumi maksud zakat wajib dan sedekah sunat seperti yang dimaksudkan dalam al-Quran yang bermaksud: “Sesungguhnya sedekahsedekah (zakat) itu hanyalah untuk orang-orang fakir dan orang-orang miskin dan amil-amil yang menguruskannya, dan orang-orang muallaf yang dijinakkan hatinya, dan untuk hamba-hamba yang hendak memerdekakan dirinya, dan orang-orang yang berhutang, dan untuk (dibelanjakan pada) jalan Allah, dan orang-orang musafir (yang keputusan) dalam perjalanan. (Ketetapan hukum yang demikian itu ialah) sebagai satu ketetapan (yang datangnya) daripada Allah. Dan (ingatlah) Allah Maha Mengetahui, lagi Maha Bijaksana.” (Surah al-Taubah -9:60)
                                Begitu juga keterangan hadis dalam surat yang ditulis Saidina Abu Bakar RA yang maksudnya: “Kefarduan sedekah (iaitu zakat) ini ialah sepertimana yang difardukan Rasulullah SAW ke atas kaum Muslimin. (Hadis riwayat Imam Bukhari (1454)
                                <hr />
                                Infak pula menurut al-Jurjani bererti membelanjakan harta kepada yang berhajat. (Rujuk al-Ta’rifat - 1/39)
                                <br /><br />
                                Dalam Surah al-Baqarah, ayat 3, Allah SWT berfirman yang bermaksud: “(Orang yang beriman itu adalah) orang-orang yang beriman dengan perkara yang ghaib, menunaikan solat dan mereka memberi infak apa yang kami rezekikan kepada mereka.”
                                Perkataan ‘yunfiquun’ dalam ayat itu menurut pilihan Imam al-Tabari merujuk kepada pensyariatan zakat dan pemberian nafkah kepada ahli keluarga yang ditanggung. (Rujuk Jami’ al-Bayan - 1/244)
                                Justeru, sedekah dan infak itu adalah sinonim manakala wakaf dari sudut bahasa bermaksud menahan sesuatu.
                                <br /><br />
                                Dari sudut istilah, ia membawa maksud menahan harta yang boleh diambil daripadanya manfaat berserta mengekalkan ‘ain harta berkenaan.
                                Ia menghilangkan pemilikan dan pengurusan harta itu daripada pewakaf dan harta itu akan digunakan pada jalan yang dibenarkan ataupun keuntungan daripadanya (harta wakaf itu) digunakan untuk jalan kebaikan. (Lihat Mughni al-Muhtaj - 2/376)
                                Pahala orang yang berwakaf akan berkekalan selagi harta wakaf itu masih wujud walaupun selepas kematian pewakaf.
                                <br /><br />
                                Wakaf juga disebut sebagai sedekah jariah. Sabda Rasulullah SAW yang bermaksud: “Jika mati seorang manusia itu akan terputuslah catatan amalannya melainkan tiga perkara, sedekah jariah, ilmu yang dimanfaatkan dan anak soleh yang mendoakan baginya kebaikan. (Hadis riwayat Imam Muslim - 1631)
                                Imam Nawawi menjelaskan, sedekah jariah itu bermaksud wakaf. (Rujuk Syarh Muslim - 11/85)
                                Pengertian infak dan sedekah adalah zakat wajib, sedekah sunat dan wakaf manakala wakaf pula lebih khusus kepada amalan wakaf.
                            </div>
                        <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
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

<!--script src="../bootstrap_latest/jquery.js" integrity2="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin2="anonymous"></script>
<script src="../bootstrap_latest/popper.js" integrity2="sha256-c19z0qoUHRAEAfVnlZCHbzLyBk46F379Q+h+C2n2xi8=" crossorigin2="anonymous"></script>
<script src="../bootstrap_latest/js/bootstrap.js" integrity2="sha256-i/Jq6Tc8SbPMBrnvq/sOTfH81hW5emVa4OzZPqhcwtI=" crossorigin2="anonymous"></script>
<script src="../vendors/datatable/datatables.js"></script-->
<?php include("../ajax_functions.php"); ?>
<?php if($_GET['map'] == 1) { ?>
    <script>
        var map;
        var xxx;
        var yyy;
        var x = document.getElementById("demo");

        function daftar_map(a, b) {
            $('#daftar_map').append('<form id="'+a+'" name="'+a+'" action="../daftar_online/pendaftaran.php" method="get"><input name="id_masjid" id="id_masjid" type="hidden" value="'+b+'"></form>');
        }

        function initMap(a, b) {
            ///alert(a + ', ' + b);
            x.innerHTML = "Latitude: " + xxx + "<br>Longitude: " + yyy;
            var latlng = new google.maps.LatLng(a, b);

            var mapProp = {
                center: latlng,
                zoom: 14,
                mapTypeId: 'roadmap',
                disableDefaultUI: true,
                fullscreenControl: true,
                styles: [
                    {
                        "featureType": "poi.business",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    }
                ]
            };
            map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            var positions = [
                {
                    lat: a,
                    lng: b,
                    icon: 'images/orang.png',
                    content: '<div class="store card border-0 rounded-0">\n' +
                        '\t<div class="card-body">\n' +
                        '\t\t<a href="#" class="card-title font-weight-semibold font-size-lg text-capitalize text-dark">Lokasi Anda</a>\n' +
                        '\t\t<div class="card-footer border-0 px-0 bg-transparent">\n' +
                        '\t\t\t<a href="#" class="link-hover-dark-primary"><span class="d-inline-block mr-2"><i\n' +
                        '\t\t\t\t\tclass="fal fa-map-marker-alt"></i></span>Anda di sini\n' +
                        '\t\t</div>\n' +
                        '\t</div>\n' +
                        '</div>'
                },
                <?php echo($lokasi_json); ?>
            ];
            positions.forEach(function (position) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(position.lat, position.lng),
                    icon: position.icon,
                    map: map
                });
                var infowindow = new google.maps.InfoWindow({
                    content: position.content
                });
                marker.addListener('click', function () {
                    infowindow.open(map, marker);
                });
                google.maps.event.addListener(map, "click", function (event) {
                    infowindow.close();
                });
                if(position.form != null && position.id_masjid != null) daftar_map(position.form, position.id_masjid);
                marker.setMap(map);
            });
            document.getElementById("googleMap").style.height = screen.availHeight - 75 +'px';
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD5njWxeTQjMy0rT6hEiFs1eywV27_IO34"></script>
    <script>
        var status_lokasi;
        function tiada_lokasi() {
            $("body").css("overflow", "auto");
            document.getElementById('tunggu').style.display = 'none';
            $('#isi').html('');
            page_ajax2('../list_masjid.php', '#isi', 'tunggu');
        }

        function getLocation() {
            /*
            navigator.permissions.query({name:'geolocation'}).then(function(result) {
                // Will return ['granted', 'prompt', 'denied']
                //console.log(result.state);
                status_lokasi = result.state;
                alert(result.state);
            });
            */
            ///*
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Peranti ini tidak menyokong fungsi geo-lokasi.";
            }
            //*/
        }

        function showPosition(position) {
            $('#isi').html('');
            $('#isi').append('<div class="map"><div id="googleMap" data-google-map="true" style="width:100%; height:100%; overflow: hidden"></div></div>');
            xxx = position.coords.latitude;
            yyy = position.coords.longitude;
            //alert(xxx + ', ' + yyy);
            if(xxx != null && yyy != null) {
                initMap(xxx, yyy);
                $('#demo').hide();
                document.getElementById('tunggu').style.display = 'none';
                $("body").css("overflow", "hidden");
            }
            //if(xxx == null || yyy == null) tiada_lokasi();
        }
        tiada_lokasi();
        //getLocation();
    </script>
<?php } ?>
<?php if($_GET['sumbang'] != NULL) { ?>
    <script type="text/javascript">
        function mode_derma(a) {
            $("#form_sumbang").append('<input name="mode_derma" id="mode_derma" type="hidden" value="'+a+'">');
            if(a == 1) {
                $("#butang_peduli").fadeOut();
                $("#butang_sumbang").fadeIn();
                $("#butang_sumbang2").attr("disabled", true);
            }
            if(a == 2) {
                $("#butang_peduli").fadeIn();
                $("#butang_sumbang").fadeOut();
                $("#butang_peduli2").attr("disabled", true)
            }
            if(a == 4) {
                $(".jenis-derma").fadeOut();
                $("#butang_peduli3").fadeIn();
            }
            if(a == 2 || a == 1 || a == 4) $("#kotakMasjid").fadeIn();
            else {
                $("#id_masjid").removeAttr("required");
                document.getElementById('form_sumbang').submit();
            }
        }
        function pilihlahMasjid(a) {
            $('.list-sejid').css("background-color", "");
            $(this).css("background-color", "#00654c");
            $('#id_masjid').val(a);
            document.getElementById('form_sumbang').submit();
        }
        <?php if(isset($_GET['mode_derma']) && $_GET['mode_derma'] != NULL && is_numeric($_GET['mode_derma'])) echo 'mode_derma('.$_GET['mode_derma'].');'; ?>
    </script>
<?php } ?>
<script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
    });
</script>
<?php //if($_GET['notifyApp'] == 1 || ($detect->isiOS() && $_GET['keterangan'] != 1 && $_GET['keterangan'] != 2)) include("../notifyApp.php"); ?>
<?php //if($_GET['notifyApp'] == 1 || $detect->isiOS()) include("../notifyApp.php"); ?>
</body>
</html>