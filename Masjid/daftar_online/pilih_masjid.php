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

if($_GET['page'] == 2) {
    $daerah = e($_GET['daerah'], NULL, NULL);

    if ($daerah != NULL && is_numeric($daerah)) {
        $q = "SELECT * FROM sej6x_data_masjid WHERE id_daerah = '$daerah'";
        selValueSQL($q, "listMasjid");
    }
    else {
        header("Location: pilih_masjid.php");
        exit;
    }
}

if(!isset($_GET['page'])) { ?>
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
            <title>Masjid Pro Penang - Pendaftaran Pengurusan Kariah</title>
        <?php } ?>
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
        <div class="col-auto"><button onclick="selfLoad('pilih_masjid.php?no_ic=<?php echo($_GET['no_ic']); ?>&redirect=<?php echo($_GET['redirect']); ?>&page=1', '#penang_map')" class="btn waves-effect waves-light btn-rounded btn-info">Pilih Daerah</button></div>
    </nav>
    <br /><br />

    <section id="wrapper">
    <div class="container-fluid" align="center">
    <div align="center"><img class="img-fluid" style="max-height: 100px" src="https://masjidpropenang.com/wp-content/uploads/2021/09/MasjidPro-Penang.png"></div>
    <hr/>
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
    <div id="penang_map">
<?php } if($_GET['page'] == "semakPay") {
    $tengoklah = 1;
    include("../semakPay_old.php");
}
if($_GET['page'] == 1) { ?>
    <script>var alamat = 'pilih_masjid.php?no_ic=<?php echo($_GET['no_ic']); ?>&redirect=<?php echo($_GET['redirect']); ?>&page=2&daerah='; var kawasan = '#penang_map';</script>
    <div class="alert alert-info" role="alert" style="font-weight: bold">Pilih daerah masjid kariah tempat anda</div>
    <img class="img-fluid" src="../images/penang_map_caption.png" usemap="#m_penang_map" alt="" />
    <map name="m_penang_map" id="m_penang_map">
        <area onclick="selfLoad(alamat+$(this).data('value'), kawasan)" href="javascript:null" data-value="71" data-name="BARAT DAYA" alt="BARAT DAYA" shape="poly" coords="45,230,43,233,41,237,46,242,51,243,64,239,64,243,65,246,68,247,72,249,79,247,77,254,79,259,84,263,96,266,109,261,116,257,121,254,129,258,135,256,140,259,148,255,150,255,152,257,154,258,160,259,158,266,157,269,154,274,156,277,159,281,155,289,151,297,153,305,157,320,162,339,161,343,159,344,158,346,161,357,162,355,164,353,171,355,162,357,158,361,157,365,158,374,159,374,161,377,152,388,144,400,146,403,151,407,155,414,157,420,158,430,162,431,162,426,165,422,174,427,173,427,172,430,174,433,178,437,185,439,187,437,189,435,194,437,194,444,189,448,187,454,187,457,193,461,194,491,199,490,201,492,202,495,205,504,212,511,215,515,219,521,224,521,227,525,233,537,249,533,263,532,271,529,277,521,287,505,295,511,306,517,294,541,282,566,280,572,279,580,275,593,272,607,261,626,260,630,260,640,254,646,246,656,241,665,240,674,242,677,245,680,243,685,238,688,229,686,225,679,224,672,220,667,216,663,214,659,213,655,201,645,189,640,194,636,191,635,182,641,175,640,171,641,169,644,168,648,165,653,164,649,157,638,150,631,142,626,132,623,124,623,119,625,117,631,118,631,119,633,117,639,101,634,90,635,89,638,85,641,82,642,72,638,67,634,58,633,49,636,44,640,40,647,38,652,39,659,34,659,35,652,32,645,27,640,25,636,26,630,30,625,30,621,31,617,34,613,37,608,40,602,41,598,38,593,36,589,51,581,54,582,59,587,63,586,61,584,63,580,66,577,66,575,63,564,63,546,65,543,62,542,60,521,60,517,64,516,58,516,56,506,56,500,58,496,64,489,61,486,59,487,58,490,52,476,49,461,49,437,57,409,61,406,65,404,59,404,62,383,63,364,67,348,64,341,57,341,50,338,51,330,50,326,47,323,41,324,35,322,25,318,28,314,31,309,34,302,31,297,27,297,31,288,36,286,39,280,41,275,37,268,35,259,36,254,33,249,29,246,25,242,23,238,23,234,25,232,33,228,43,227,45,230,45,230" />
        <area onclick="selfLoad(alamat+$(this).data('value'), kawasan)" href="javascript:null" data-value="68" data-name="TIMUR LAUT" alt="TIMUR LAUT" shape="poly" coords="198,220,203,226,207,226,212,229,216,227,220,225,226,228,233,234,233,239,234,247,236,250,241,253,242,252,244,251,250,253,264,248,273,254,283,254,285,257,288,258,294,257,298,257,298,256,299,259,297,268,299,272,304,277,304,282,298,280,295,280,294,282,295,285,297,294,297,300,306,313,319,325,334,335,348,341,366,343,373,345,377,350,374,355,370,361,363,364,359,368,359,370,361,371,359,373,355,371,353,375,358,378,356,381,353,384,349,382,346,385,349,388,340,395,334,403,334,406,333,404,327,411,322,421,322,428,313,443,310,460,313,466,317,475,308,502,306,515,296,509,291,506,289,502,286,502,279,513,272,525,264,529,259,529,234,534,228,524,219,518,214,511,207,502,205,498,204,494,201,490,196,487,195,471,195,461,193,457,189,456,191,449,193,446,195,444,196,441,195,430,194,427,192,425,187,428,189,433,186,436,179,436,175,431,177,428,171,423,165,419,163,420,162,423,157,413,153,406,149,402,147,399,148,396,150,394,152,391,154,388,159,382,164,377,162,374,161,374,160,365,161,360,163,358,173,357,173,353,167,351,162,352,161,347,162,344,164,344,165,339,161,319,159,317,154,297,158,289,162,281,160,278,157,275,160,271,160,265,161,262,163,259,162,256,155,257,153,255,157,251,162,250,160,248,168,242,178,230,190,218,191,220,192,220,194,219,198,220,198,220" />
        <area onclick="selfLoad(alamat+$(this).data('value'), kawasan)" href="javascript:null" data-value="72" data-name="SEBERANG PERAI SELATAN" alt="SEBERANG PERAI SELATAN" shape="poly" coords="712,606,717,606,721,607,725,610,728,608,730,607,737,607,739,606,746,607,752,611,764,622,766,626,769,633,773,655,774,672,804,929,793,936,783,940,715,924,706,928,700,928,695,930,689,933,685,938,681,949,588,961,505,971,497,969,492,967,491,964,495,952,503,935,504,928,507,920,509,916,513,914,512,907,516,900,526,889,534,881,540,876,543,871,540,865,535,862,525,860,533,841,534,829,534,804,536,799,540,794,540,791,542,785,545,781,542,771,543,765,537,741,532,725,526,709,515,682,511,679,508,678,504,677,504,674,508,670,512,663,516,657,522,652,523,648,525,644,526,639,550,632,555,632,558,635,560,642,560,649,562,652,567,653,577,651,581,647,583,643,581,636,582,632,586,632,593,634,596,632,600,628,599,632,600,635,606,638,612,634,617,631,633,634,636,632,638,629,638,630,640,631,643,627,646,624,651,626,654,624,654,621,654,618,656,617,663,619,680,621,689,618,701,612,704,607,708,605,712,606,712,606" />
        <area onclick="selfLoad(alamat+$(this).data('value'), kawasan)" href="javascript:null" data-value="69" data-name="SEBERANG PERAI TENGAH" alt="SEBERANG PERAI TENGAH" shape="poly" coords="582,281,584,283,580,286,580,288,583,290,589,288,588,291,590,294,594,297,598,293,601,299,603,302,608,304,610,301,612,297,616,297,618,298,620,304,621,309,624,311,629,312,636,309,654,323,661,323,667,327,672,331,679,333,684,331,689,326,695,317,698,317,706,321,713,323,724,319,728,319,729,323,735,326,742,323,745,324,747,328,750,332,755,334,751,449,751,466,753,483,755,500,757,518,770,629,769,626,767,621,763,618,756,611,749,605,739,603,736,604,730,604,728,605,726,607,708,603,703,605,701,609,689,615,681,619,664,617,656,614,653,615,652,617,652,624,647,622,644,623,642,626,644,621,643,617,641,615,636,622,633,620,630,617,626,619,629,624,635,631,616,629,613,629,611,632,610,634,607,635,602,632,601,629,603,625,600,624,596,628,593,632,587,630,580,631,579,635,580,643,578,646,575,649,567,651,564,650,563,647,561,640,558,632,555,629,550,629,536,633,524,635,519,623,517,611,514,588,513,581,511,576,496,564,493,561,493,556,494,548,496,543,499,538,501,530,503,522,505,517,498,509,487,500,478,496,469,489,464,482,459,472,453,469,451,466,447,458,443,455,440,447,437,443,435,442,432,444,423,429,432,422,441,415,442,410,443,406,444,401,447,399,458,399,469,399,472,397,474,393,465,377,466,372,469,368,476,365,480,367,482,373,484,378,491,381,498,378,503,373,501,368,497,366,490,363,494,356,498,350,493,341,493,333,498,332,513,335,516,332,518,327,520,322,525,320,535,322,543,331,546,328,547,326,546,321,547,318,552,315,551,321,552,324,556,326,559,324,561,321,564,314,569,314,564,323,565,324,568,326,572,323,576,319,574,313,576,315,580,318,583,315,587,311,591,305,587,298,583,302,584,307,577,304,572,307,573,303,570,297,574,301,577,301,578,298,574,284,579,281,582,281,582,281" />
        <area onclick="selfLoad(alamat+$(this).data('value'), kawasan)" href="javascript:null" data-value="150" data-name="SEBERANG PERAI UTARA (BUTTERWORTH)" alt="SEBERANG PERAI UTARA (BUTTERWORTH)" shape="rect" coords="326,199,565,305" />
        <area onclick="selfLoad(alamat+$(this).data('value'), kawasan)" href="javascript:null" data-value="70" data-name="SEBERANG PERAI UTARA (KEPALA BATAS)" alt="SEBERANG PERAI UTARA (KEPALA BATAS)" shape="rect" coords="484,71,748,180" />
        <!--area data-name="SEBERANG PERAI UTARA" alt="SEBERANG PERAI UTARA" shape="poly" coords="447,15,452,13,455,10,457,7,460,6,463,8,464,13,465,18,471,21,481,17,490,20,503,29,507,35,512,43,515,44,520,45,531,50,542,53,550,51,559,47,560,53,562,56,566,57,570,55,571,51,572,42,575,41,574,44,575,45,579,47,586,44,591,50,596,54,600,52,601,48,601,44,605,43,612,47,620,51,625,48,630,46,635,48,640,49,647,54,649,55,654,52,660,50,664,50,667,52,669,55,675,58,677,56,677,37,684,43,690,45,704,43,715,45,716,55,720,60,726,62,735,58,743,61,752,63,749,71,751,76,756,80,759,78,761,75,762,70,755,331,751,329,748,325,745,321,743,320,735,323,732,321,730,319,729,316,727,315,719,317,713,320,704,317,698,314,692,316,689,322,684,327,679,330,673,327,667,323,661,321,655,321,645,312,636,307,633,308,630,310,623,307,621,299,620,295,618,294,611,295,609,301,603,295,598,291,594,294,591,289,592,288,591,285,588,285,583,287,587,284,584,280,580,278,574,280,572,284,575,298,572,294,569,294,569,308,571,309,578,306,579,308,583,310,584,308,585,305,585,302,587,301,588,305,585,310,581,315,578,313,576,310,573,310,573,316,572,320,570,323,567,323,572,314,569,311,566,311,561,312,559,316,558,324,555,324,554,314,550,313,545,315,544,320,544,328,536,320,525,317,520,319,516,324,514,333,497,330,491,331,490,337,495,350,491,356,488,362,489,365,494,368,498,370,500,373,498,375,495,377,491,378,487,377,485,375,483,370,481,364,479,362,476,362,467,367,462,376,466,384,471,393,470,395,468,396,461,396,450,396,444,399,441,404,438,415,429,421,420,427,417,423,422,420,425,417,422,411,417,406,415,406,411,395,427,359,438,332,442,321,444,312,448,283,448,252,441,191,441,138,435,118,429,99,426,85,420,72,406,55,392,41,379,35,368,32,366,31,365,29,365,23,367,21,374,22,413,29,418,27,422,25,426,17,429,8,431,6,434,5,436,6,439,10,441,13,447,15,447,15" / -->
    </map>
<?php } if($_GET['page'] == 2) { ?>
    <?php if($num_listMasjid > 0) { ?>
        <div class="row form-group">
            <?php $i=1; do { ?>
                <div class="col-12 col-md-4 form-group">
                    <div class="card">
                        <h5 class="card-header"><?php echo($row_listMasjid['nama_masjid']); ?></h5>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo($row_listMasjid['alamat_masjid']); ?></h5>
                            <p class="card-text"><?php echo($row_listMasjid['poskod']); ?></p>
                            <?php if($_GET['ahliKariah'] == 1) { ?>
                                <a href="../daftar_online/pendaftaran.php?no_ic=<?php echo($_GET['no_ic']); ?>&redirect=<?php echo($_GET['redirect']); ?>&id_masjid=<?php echo($row_listMasjid['id_masjid']); ?>"><button class="btn btn-primary btn-block" type="button">Daftar</button></a>
                            <?php } else { ?>
                                <a href="daftarPengurusan.php?id_masjid=<?php echo($row_listMasjid['id_masjid']); ?>"><button class="btn btn-primary btn-block" type="button">Daftar</button></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php $i++; } while($row_listMasjid = mysqli_fetch_assoc($fetch_listMasjid)); ?>
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="alert alert-danger" role="alert">Tiada senarai masjid dijumpai!</div>
            </div>
        </div>
    <?php } ?>
<?php } if(!isset($_GET['page'])) { ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/history.js/1.8/bundled/html4+html5/jquery.history.js" integrity="sha512-mjkjqy4sU2OBLfLuKA4nNWtBWslKyZ57NeM0vr00VO2CKSO3k2dGPYvvEwt+fpw/eU2t/zptneQGablbT/8uEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/image-map-resizer/1.0.10/js/imageMapResizer.js" integrity="sha512-wR8ZLk/8O2Tu993LEOlQTN/J/wKrPgaJ2R2/xkekedTyfCi5+6FbuKhS344c9Ktyapklge9X1TouKob5LCnixQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/maphilight/1.4.2/jquery.maphilight.js" integrity="sha512-SL6PrnSRiLYsA4Y5GdS99KadsBRdQ1OaSrtsRZsWrbc+0Hiq6R9e/ILWPfyAIb/6d6qDd49ikGNI5217vqLDFA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script-->
    <!--script src="../js/imageMapResizer.js"></script-->
    <script id="load_sekerip">
        $(document).ready(function(){
            $('#m_penang_map').imageMapResize();
            //$('img[usemap]').maphilight();
        });
    </script>
    <script>
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
                //this.reset();
            });
        }
        function selfLoad(a, b) {
            $(b).hide();
            $("#tunggu").show();
            $.ajax({
                url: a,
                success: function(data)
                {
                    $(b).show();
                    $("#tunggu").hide();
                    $(b).html(data);
                    eval(document.getElementById('load_sekerip').innerHTML);
                }
            });
        }
        selfLoad('pilih_masjid.php?no_ic=<?php echo($_GET['no_ic']); ?>&redirect=<?php echo($_GET['redirect']); ?>&page=1', '#penang_map');

        //selfUpdate('#loginform', 'kemaskini.php', '#load_content');
    </script>
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
    </script>
    </body>
    </html>
<?php } mysqli_close($bd2); ?>