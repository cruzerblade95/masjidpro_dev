<?php

// memulai session
session_start();
require_once('connection/connection.php');
//error diasble
error_reporting(0);
@ini_set('display_errors', 0);

if(isset($_SESSION['username'])) {
	
     if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="1")) {
       header('Location: utama.php?view=superadmin&action=dashboard');}
     
         else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="2")) {
      header('Location: utama.php?view=admin&action=dashboard');}     
      
      else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="3")) {
      header('Location: utama.php?view=pengerusi&action=dashboard');}     
      
      else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="4")) {
      header('Location: utama.php?view=timbalan_pengerusi&action=dashboard');}  

      else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="5")) {
      header('Location: utama.php?view=setiausaha&action=dashboard');}      

      else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="6")) {
      header('Location: utama.php?view=bendahari&action=dashboard');}     
    
      else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="7")) {
      header('Location: utama.php?view=ajk&action=dashboard');}     
    
      else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="8")) {
      header('Location: utama.php?view=pegawai_khas&action=dashboard');}     

}

$xberjaya =0;

if ($_POST['Login']){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $kod_masjid = strtoupper($_POST['kod_masjid']);
  
  $kuiri = "SELECT * FROM sej6x_data_masjid WHERE kod_masjid='$kod_masjid'";
  $kuirirun = mysql_query($kuiri,$bd);
  $run = mysql_fetch_array($kuirirun);
  $id_masjid = $run['id_masjid'];
  // query untuk mendapatkan record dari username
  $query = "SELECT * FROM masjid_user WHERE username = '$username' AND id_masjid='$id_masjid'";
  $hasil = mysql_query($query);
  $data = mysql_fetch_array($hasil);

  if (($username!=NULL)&&($password == $data['password'])&&($kod_masjid == $run['kod_masjid'])) // check kewujudan username yang dihantar dan password dalam database
  {
		$_SESSION['nama_masjid'] = $run['nama_masjid'];
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

      echo "<p>Login Berjaya user : ".$_SESSION['user_name']."</p>";  //xfunction lg..
      //session_start();

      if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="1")) {
       header('Location: utama.php?view=superadmin&action=dashboard');}
     
         else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="2")) {
      header('Location: utama.php?view=admin&action=dashboard');}     
      
      else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="3")) {
      header('Location: utama.php?view=pengerusi&action=dashboard');}     
      
      else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="4")) {
      header('Location: utama.php?view=timbalan_pengerusi&action=dashboard');}  

      else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="5")) {
      header('Location: utama.php?view=setiausaha&action=dashboard');}      

      else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="6")) {
      header('Location: utama.php?view=bendahari&action=dashboard');}     
    
      else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="7")) {
      header('Location: utama.php?view=ajk&action=dashboard');}     
    
      else if(($_SESSION['username']!=NULL)&&($_SESSION['user_type_id']=="8")) {
      header('Location: utama.php?view=pegawai_khas&action=dashboard');}     
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

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

   
    <title>Masjid Pro</title>
    <link rel="icon" href="picture/mosque.png">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body background="picture/wallwhite.jpg" style="background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
  <!-- background="picture/4657cee25652c4a.png" -->

    <div class="container">
        <div class="row">
			<div class="col-lg-6" align="center">
			<div style="margin-top: 35%;">
			<img src="picture/masjidpro.png" style="width:100%;"></img>
			</div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<br>
            <div class="col-lg-6">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading" align="center" style="background-color:#36BFE9"> 
                        <h3 class="panel-title" ><b><br><br>
                       Applikasi MasjidPro</h3><br>
                        <img src="picture/mosque.png" height="90" width="100">
                    </div>


                    
                    <div class="panel-body" style="background-color:lightblue" >
                         <form name=loginform method=POST action="login.php">
                            <fieldset>
								<!-- div class="form-group">
									<input class="form-control" placeholder="Kod Masjid" name="kod_masjid" type="text" id="kod_masjid" required>
								</div -->
                                <div class="form-group">
                                  <input class="form-control" placeholder="Nama Pengguna" name="username" type="text" id="username" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Kata Laluan" name="password" type="password" value="" id="password" required>
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
                                <div class="form-group">
                                    <input class="btn btn-lg btn-default btn-block" type="submit" value="Log Masuk" id="Login" name="Login" >
                                </div>
                            </fieldset><br>
                        </form>
							<!-- div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<button class="btn btn-info btn-block" data-target="#daftar_kariah" data-toggle="modal">Daftar Kariah</button>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<button class="btn btn-info btn-block" data-target="#semak_kariah" data-toggle="modal">Semak Daftar Kariah</button>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<button class="btn btn-info btn-block" onClick="window.location.href='http://www.masjidpro.com/Majlis/login.php'">Pejabat Agama</button>
									</div>
								</div>
								<div class="col-lg-3">
								</div>
							</div -->
						<div align="center"><b>MyRich Dynasty © | 2019</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<div class="modal fade" id="daftar_kariah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">BORANG KEAHLIAN KARIAH</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-info">
								<div class="panel-body">
									<center>
										<h4>PENDAFTARAN AHLI KARIAH</h4>
										<br>
										
										<nav class="navbar navbar-default">
										  <div class="container-fluid">
											<ul class="nav navbar-nav">
											  <li class="active" id="nav_negeri"><a onClick="showNegeri()">Negeri</a></li>
											  <li style="display:none" id="nav_daerah"><a id="a_daerah" onClick="showDaerah(this.value)">Daerah</a></li>
											  <li style="display:none" id="nav_masjid"><a>Masjid</a></li>
											</ul>
										  </div>
										</nav>
										
										<div id="negeri">
										<?php
										$sql="SELECT * FROM negeri WHERE id_negeri IN ('7','2','8','9')";
										$sqlquery=mysql_query($sql,$bd);
										while($data=mysql_fetch_array($sqlquery))
										{
										?>
										<div class="col-lg-4">
											<div class="form-group">
											<button class="btn btn-success btn-block" value="<?php echo $data['id_negeri']; ?>" onClick="showDaerah(this.value)"><?php echo $data['name']; ?></button>
											</div>
										</div>
										<?php
										}
										?>
										</div>
										<div id="daerah">
										</div>
										<div id="masjid">
										</div>
									</center>
								</div>
								<!-- /.panel-body -->
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
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

</body>
</html>

<script>
function showNegeri() {
	document.getElementById('negeri').style.display="block";
	document.getElementById('nav_negeri').className="active";
	document.getElementById('daerah').style.display="none";
	document.getElementById('nav_daerah').style.display="none";
	document.getElementById('masjid').style.display="none";
	document.getElementById('nav_masjid').style.display="none";
}
function showDaerah(str) {
	if (str == "") {
	document.getElementById("daerah").innerHTML = "";
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
			document.getElementById("daerah").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","getdaerah.php?negeri="+str,true);
		xmlhttp.send();
	}
	
	document.getElementById('negeri').style.display="none";
	document.getElementById('nav_negeri').className="";
	document.getElementById('daerah').style.display="block";
	document.getElementById('nav_daerah').style.display="block";
	document.getElementById('nav_daerah').className="active";
	document.getElementById('a_daerah').value=str;
	document.getElementById('masjid').style.display="none";
	document.getElementById('nav_masjid').style.display="none";
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
		xmlhttp.open("GET","getmasjid.php?daerah="+str,true);
		xmlhttp.send();
		
		document.getElementById('negeri').style.display="none";
		document.getElementById('nav_negeri').className="";
		document.getElementById('daerah').style.display="none";
		document.getElementById('nav_daerah').className="";
		document.getElementById('masjid').style.display="block";
		document.getElementById('nav_masjid').style.display="block";
		document.getElementById('nav_masjid').className="active";
	}
}
</script>