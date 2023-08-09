<?php

//session_start();
$tema_layout = 2;
if($_GET['tema'] != NULL) $tema_layout = $_GET['tema'];

//include('connection/connection.php');
//include('fungsi.php');
//include('fungsi_tarikh.php');
//if($_SESSION['id_masjid']=="" OR $_SESSION['id_masjid']==NULL)
//{
//header("Location: login-kehadiran.php");
//}
?>
<?php

// memulai session

//error diasble
error_reporting(0);
@ini_set('display_errors', 0);

if(isset($_SESSION['username'])) {

    if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="1")) {
        header('Location: utama.php?view=superadmin&action=dashboard');}

    else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="2")) {
        header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}

    else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="3")) {
        header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}

    else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="4")) {
        header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}

    else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="5")) {
        header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}

    else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="6")) {
        header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}

    else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="7")) {
        header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}

    else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="8")) {
        header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}

    else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="10")) {
        header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}
		
	else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="11")) {
		header('Location: utama.php?view=admin&action=dashboard_selenggara');}
}

$xberjaya =0;

if (isset($_POST['submit'])){

    session_start();

    require_once('connection/connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $kod_masjid = strtoupper($_POST['kod_masjid']);

    $kuiri = "SELECT * FROM sej6x_data_masjid WHERE kod_masjid='$kod_masjid'";
    $kuirirun = mysqli_query($bd2, $kuiri);
    $run = mysqli_fetch_array($kuirirun);
    $id_masjid = $run['id_masjid'];
    // query untuk mendapatkan record dari username
    $query = "SELECT * FROM masjid_user WHERE username = '$username' AND id_masjid='$id_masjid'";
    $hasil = mysqli_query($bd2, $query);
    $data = mysqli_fetch_array($hasil);

    if (($username!=NULL)&&($password == $data['password'])&&($kod_masjid == $run['kod_masjid'])) // check kewujudan username yang dihantar dan password dalam database
    {
        $_SESSION['nama_masjid'] = $run['nama_masjid'];
        $_SESSION['perlu_zon'] = $run['perlu_zon'];
        $_SESSION['id_masjid'] = $data['id_masjid'];
        $_SESSION['kod_masjid'] = $run['kod_masjid'];
        $_SESSION['id_negeri'] = $run['id_negeri'];
        $_SESSION['id_daerah'] = $run['id_daerah'];
        $_SESSION['negeri_masjid'] = $run['negeri'];
        $_SESSION['daerah_masjid'] = $run['daerah'];
        $_SESSION['user_type_id'] = $data['user_type_id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['user_name'] = $data['user_name'];
        $_SESSION['user_id'] = $data['user_id'];

        $id_masjid = $_SESSION['id_masjid'];
        $kod_masjid = $_SESSION['kod_masjid'];
        $nama_masjid = $_SESSION['nama_masjid'];
        $id_negeri = $_SESSION['id_masjid'];
        $id_daerah = $_SESSION['id_daerah'];
        $negeri_masjid = $_SESSION['negeri_masjid'];
        $daerah_masjid = $_SESSION['daerah_masjid'];
        $user_id = $_SESSION['user_id'];
        $user_type_id = $_SESSION['user_type_id'];

        echo "<p>Login Berjaya user : ".$_SESSION['user_name']."</p>";  //xfunction lg..
        //session_start();

        if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="1")) {
            header('Location: utama.php?view=superadmin&action=dashboard');}

        else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="2")) {
            header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}

        else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="3")) {
            header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}

        else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="4")) {
            header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}

        else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="5")) {
            header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}

        else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="6")) {
            header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}

        else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="7")) {
            header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}

        else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="8")) {
            header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}

        else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="10")) {
            header('Location: utama.php?view=admin&action=dashboard&qariah=semua');}
			
		else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="11")) {
            header('Location: utama.php?view=admin&action=dashboard_selenggara');}
    }

    else
    {
        $xberjaya =1;
        //echo 'Log Masuk Gagal';
    }
}

?>

<?php

if(isset($_GET["action"]))
    $action = $_GET["action"];
else $action = "";


if(isset($_GET["login"]))
    $login = $_GET["login"];
else $login = "";



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
    <meta name="description" content="Masjid Pro - Rekod Kehadiran">
    <meta name="author" content="Masjid Pro">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="images/logo2.png">
    <title>Masjid Pro - Log Masuk</title>

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
</head>

<body class="skin-default card-no-border">
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
    <div class="login-register" style="background-image:url(picture/banner_masjidpro.png);">
        <div style="margin-top:-8%; margin-right:15%" class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" method="POST" id="loginform" action="login.php">
                    <a href="javascript:void(0)" class="db"><img src="images/logo.png" class="img-fluid" lt="Home" height="96"/></a>
                    <hr />
                    <h3 class="text-center m-b-20" style="color: #000000">Maklumat Log Masuk</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="kod_masjid" required="" placeholder="Kod Masjid" <?php if(isset($_GET['kod_masjid'])) { ?>value="<?php echo $_GET['kod_masjid']; ?>"<?php }?>>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="username" required="" placeholder="Nama Pengguna">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="Kata Laluan">
                        </div>
                    </div>
                    <?php
                    if ($xberjaya==1){
                        ?>

                        <div class="alert alert-danger alert-dismissable">
                            Gagal. Sila Log Masuk Semula.
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group text-center">
                        <div class="col-xs-12 p-b-20">
                            <button class="btn btn-block btn-lg btn-info btn-rounded" name="submit" type="submit">Log Masuk</button>
                        </div>
                    </div>
                </form>
                <div class="form-group text-center">
                    <div class="col-xs-12 p-b-20">
                        <button class="btn btn-warning btn-block btn-rounded" data-target="#daftar_kariah" data-toggle="modal">Kod Masjid</button>
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="col-xs-12 p-b-20">
                        <button class="btn btn-info btn-block btn-rounded" onClick="window.open('https://sistem.masjidpro.com')">Sistem JHEAIPP & Pejabat Agama Daerah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="daftar_kariah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title" id="myModalLabel">BORANG KEAHLIAN KARIAH</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-body">
                                <center>
                                    <h4>PENDAFTARAN AHLI KARIAH</h4>
                                    <br>

									<div class="col-12">
										<div class="row">
											<div id="nav_negeri"><a class="btn btn-warning" onClick="showNegeri()">Negeri</a></div>&nbsp;
											<div style="display:none" id="dis_masjid"><a class="btn btn-warning" id="j_masjid" onClick="showJenis(this.value)">Jenis Masjid</a></div>&nbsp;
											<div style="display:none" id="dis_negeri"><a class="btn btn-warning" >Masjid Negeri</a></div>
											<div style="display:none" id="dis_daerah"><a class="btn btn-warning" >Masjid Daerah</a></div>
											<div style="display:none" id="dis_kariah"><a class="btn btn-warning" id="k_masjid" onClick="masjidKariah(this.value)">Masjid Kariah</a></div>&nbsp;
											<div style="display:none" id="nav_masjid"><a class="btn btn-warning" >Senarai Masjid</a></div>&nbsp; 
										</div>
									</div>
									<br>
                                    <div id="negeri">
                                        <?php

                                        include('connection/connection.php');
                                        //$sql="SELECT * FROM negeri WHERE id_negeri IN ('7','2','8','9')";
                                        $sql="SELECT * FROM negeri WHERE id_negeri IN ('9')";
                                        $sqlquery=mysqli_query($bd2, $sql);

                                        while($data=mysqli_fetch_array($sqlquery))
                                        {
                                            ?>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <button class="btn btn-success btn-block" value="<?php echo $data['id_negeri']; ?>" onClick="showJenis(this.value)"><?php echo $data['name']; ?></button>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
									<div style="display:none" id="jenis_masjid">
										<div class="col-lg-4">
											<div class="form-group">
												<button class="btn btn-success btn-block" id="masjid_negeri" onClick="masjidNegeri(this.value)">MASJID NEGERI</button>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<button class="btn btn-success btn-block" id="masjid_daerah" onClick="masjidDaerah(this.value)">MASJID DAERAH</button>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<button class="btn btn-success btn-block" id="masjid_kariah" onClick="masjidKariah(this.value)">MASJID KARIAH</button>
											</div>
										</div>
										<input type="hidden" id="negeri_id" name="negeri_id">
									</div>
									<div id="div_negeri">
									</div>
									<div id="div_daerah">
									</div>
									<div id="div_kariah">
									</div>
                                    <!-- <div id="daerah">
                                    </div> -->
                                    <div id="masjid">
                                    </div>
                                </center>
                            </div>
                            <!-- /.panel-body -->
                            <div class="modal-footer">
                                <div style="display:none" id="kembali_negeri"><a class="btn btn-warning" onClick="showNegeri()">Kembali</a></div>
								<div style="display:none" id="kembali_jenis"><a class="btn btn-warning" id="jenis_kembali" onClick="showJenis(this.value)">Kembali</a></div>
								<div style="display:none" id="kembali_kariah"><a class="btn btn-warning" id="kariah_kembali" onClick="masjidKariah(this.value)">Kembali</a></div>&nbsp;
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                        <!-- /.panel pnael-info -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- modal-dialog modal-lg -->
</div>
<!-- modal fade -->

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
<!--Custom JavaScript -->
<script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
    });
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
    });
</script>
<script>
    function showNegeri() {
        document.getElementById('negeri').style.display="block";
        document.getElementById('nav_negeri').className="active";
		document.getElementById('dis_masjid').style.display="none";
		document.getElementById('jenis_masjid').style.display="none";
		document.getElementById('dis_negeri').style.display="none";
		document.getElementById('div_negeri').style.display="none";
		document.getElementById('dis_daerah').style.display="none";
		document.getElementById('div_daerah').style.display="none";
		document.getElementById('dis_kariah').style.display="none";
		document.getElementById('div_kariah').style.display="none";
		document.getElementById('masjid').style.display="none";
		document.getElementById('nav_masjid').style.display="none";
		document.getElementById('nav_masjid').className="";
        document.getElementById('kembali_negeri').style.display="none";
		document.getElementById('kembali_jenis').style.display="none";
		document.getElementById('kembali_kariah').style.display="none";
    }
	function showJenis(str){
		document.getElementById('negeri').style.display="none";
        document.getElementById('nav_negeri').className="";
		document.getElementById('jenis_masjid').style.display="block";
		document.getElementById('dis_masjid').style.display="block";
		//document.getElementById('negeri_id').value=str;
		document.getElementById('j_masjid').value=str;
		document.getElementById('masjid_negeri').value=str;
		document.getElementById('masjid_daerah').value=str;
		document.getElementById('masjid_kariah').value=str;
		document.getElementById('dis_negeri').style.display="none";
		document.getElementById('div_negeri').style.display="none";
		document.getElementById('dis_daerah').style.display="none";
		document.getElementById('div_daerah').style.display="none";
		document.getElementById('dis_kariah').style.display="none";
		document.getElementById('div_kariah').style.display="none";
		document.getElementById('masjid').style.display="none";
		document.getElementById('nav_masjid').style.display="none";
		document.getElementById('nav_masjid').className="";
		document.getElementById('kembali_negeri').style.display="block";
		document.getElementById('kembali_jenis').style.display="none";
		document.getElementById('jenis_kembali').value=str;
		document.getElementById('kembali_kariah').style.display="none";
		
	}
	function masjidNegeri(str){ 
		if (str == "") {
            document.getElementById("div_negeri").innerHTML = "";
            return;
        }
        else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("div_negeri").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","getmasjidnegeri.php?negeri="+str,true);
            xmlhttp.send();
        }
		
		document.getElementById('negeri').style.display="none";
        document.getElementById('nav_negeri').className="";
		document.getElementById('jenis_masjid').style.display="none";
		document.getElementById('dis_negeri').style.display="block";
		document.getElementById('div_negeri').style.display="block";
		document.getElementById('dis_daerah').style.display="none";
		document.getElementById('div_daerah').style.display="none";
		document.getElementById('dis_kariah').style.display="none";
		document.getElementById('div_kariah').style.display="none";
		document.getElementById('masjid').style.display="none";
		document.getElementById('nav_masjid').style.display="none";
		document.getElementById('nav_masjid').className="";
		document.getElementById('kembali_negeri').style.display="none";
		document.getElementById('kembali_jenis').style.display="block";
		document.getElementById('kembali_kariah').style.display="none";
	}
	function masjidDaerah(str){ 
		if (str == "") {
            document.getElementById("div_daerah").innerHTML = "";
            return;
        }
        else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("div_daerah").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","getmasjiddaerah.php?negeri="+str,true);
            xmlhttp.send();
        }
		
		document.getElementById('negeri').style.display="none";
        document.getElementById('nav_negeri').className="";
		document.getElementById('jenis_masjid').style.display="none";
		document.getElementById('dis_negeri').style.display="none";
		document.getElementById('div_negeri').style.display="none";
		document.getElementById('dis_daerah').style.display="block";
		document.getElementById('div_daerah').style.display="block";
		document.getElementById('dis_kariah').style.display="none";
		document.getElementById('div_kariah').style.display="none";
		document.getElementById('masjid').style.display="none";
		document.getElementById('nav_masjid').style.display="none";
		document.getElementById('nav_masjid').className="";
		document.getElementById('kembali_negeri').style.display="none";
		document.getElementById('kembali_jenis').style.display="block";
		document.getElementById('kembali_kariah').style.display="none";
	}
	function masjidKariah(str){
		if (str == "") {
            document.getElementById("div_kariah").innerHTML = "";
            return;
        }
        else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("div_kariah").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","senaraidaerah.php?negeri="+str,true);
            xmlhttp.send();
        }
		
		document.getElementById('negeri').style.display="none";
        document.getElementById('nav_negeri').className="";
		document.getElementById('jenis_masjid').style.display="none";
		document.getElementById('dis_negeri').style.display="none";
		document.getElementById('div_negeri').style.display="none";
		document.getElementById('dis_daerah').style.display="none";
		document.getElementById('div_daerah').style.display="none";
		document.getElementById('dis_kariah').style.display="block";
		document.getElementById('div_kariah').style.display="block";
		document.getElementById('k_masjid').value=str;
		document.getElementById('masjid').style.display="none";
		document.getElementById('nav_masjid').style.display="none";
		document.getElementById('nav_masjid').className="";
		document.getElementById('kembali_negeri').style.display="none";
		document.getElementById('kembali_jenis').style.display="block";
		document.getElementById('kembali_kariah').style.display="none";
		document.getElementById('kariah_kembali').value=str;
	}
	function showMasjid(str) {
        if (str == "") {
            document.getElementById("masjid").innerHTML = "";
            return;
        }
        else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("masjid").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","senaraimasjid.php?daerah="+str,true);
            xmlhttp.send();

            document.getElementById('negeri').style.display="none";
			document.getElementById('nav_negeri').className="";
			document.getElementById('jenis_masjid').style.display="none";
			document.getElementById('dis_negeri').style.display="none";
			document.getElementById('div_negeri').style.display="none";
			document.getElementById('dis_daerah').style.display="none";
			document.getElementById('div_daerah').style.display="none";
			document.getElementById('div_kariah').style.display="none";
            document.getElementById('masjid').style.display="block";
            document.getElementById('nav_masjid').style.display="block";
            document.getElementById('nav_masjid').className="active";
			document.getElementById('kembali_negeri').style.display="none";
			document.getElementById('kembali_jenis').style.display="none";
			document.getElementById('kembali_kariah').style.display="block";
        }
    }
    $(".btn-info").css("background-color", "#010280");
</script>
</body>

</html>