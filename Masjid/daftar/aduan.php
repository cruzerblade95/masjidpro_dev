<?php 
global $reff_url2;
$reff_url2 = $_SERVER['HTTP_REFERER'];
$reff_url2 = str_replace('http://www.', '', $reff_url2);
$reff_url2 = str_replace('https://www.', '', $reff_url2);
$reff_url2 = str_replace('http://', '', $reff_url2);
$reff_url2 = str_replace('https://', '', $reff_url2);
$reff_url2 = strstr($reff_url2, '/' , true);
include("../connection/connection.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Aduan</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h4><?php echo($nama_masjid); ?></h4>
                    <h2 class="title">-Aduan-</h2>
                    <form method="POST" action="<?php echo $PHP_SELF;?>" name="aduan" onSubmit="alert('Terima Kasih atas Keperihatinan Aduan Anda!');">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Nama</label>
                                    <input class="input--style-4" type="text" name="nama" id="nama" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">No. K/P</label>
                                    <input class="input--style-4" type="text" name="no_kp" id="no_kp" required>
                                    <div align="center">contoh: 911111072222 </div>
                                </div>
                            </div>
                        </div>
							 <div class="input-group">
                            <label class="label">Jenis Aduan</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="jenis_aduan">
                                    <option disabled="disabled" selected="selected">Sila Pilih</option>
                                    <option value="1">Pentadbiran</option>
                                    <option value="2">Penceramah</option>
                                    <option value="3">Dana</option>
                                    <option value="4">Kerosakan</option>
                                    <option value="5">Jenayah</option>
                                    <option value="6">Lain-Lain</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                                <div class="input-group">
                                  <label class="label">Aduan</label>
                                    <textarea name="aduan" class="textarea--style-4" required></textarea>
                                </div>
                                <div class="input-group">
                                  <label class="label">Cadangan (berdasarkan aduan)</label>
                                    <textarea name="cadangan" class="textarea--style-4" required></textarea>
                                </div>
                            
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit">Hantar Aduan</button>
                       <br /><br />
                            <button class="btn btn--radius-2 btn--blue" onclick="location.href='<?php echo($_SERVER['HTTP_REFERER']); ?>'">Kembali ke Laman Web</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>
   

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->

<?php
// INSERT
 if (isset($_POST['nama'])) 
    {
    $nama=mysql_real_escape_string($_POST['nama']);
	$no_kp=mysql_real_escape_string($_POST['no_kp']);
	$jenis_aduan=$_POST['jenis_aduan'];
	$aduan=mysql_real_escape_string($_POST['aduan']);
	$cadangan=mysql_real_escape_string($_POST['cadangan']);
	
	mysql_select_db($mysql_database, $bd);
	
	$sql1 ="INSERT INTO data_aduan(																										
	        id_masjid,nama,no_kp,jenis_aduan,aduan,cadangan,time)
	
            VALUES('$id_masjid','$nama','$no_kp',$jenis_aduan,'$aduan','$cadangan',NOW())";

	mysql_query($sql1,$bd);
	{
		?>
	<script>alert('Terima Kasih atas Keperihatinan Aduan Anda!');</script>
		<?php
	}
   // header('Location: http://www.masjidpenaga.spmdkk.com/');  
	}			
			?> 
