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
    <title>Semakan Ahi Kariah: <?php echo($nama_masjid); ?></title>

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
        <div class="wrapper wrapper--w980">
            <div class="card card-4">
                <div class="card-body">
                 
                      <h4><?php echo($nama_masjid); ?></h4>
                      <h2 class="title">-Maklumat Ahli Kariah-</h2>
                    <form method="POST" action="<?php echo $PHP_SELF;?>" name="DAFTAR" >
                     
                      <div class="input-group">
                           
                            <div class="input-group">
                              <div class="input-group">
                                <label class="label">Nama</label>
                                <input class="input--style-4" type="text" required name="nama_penuh">
                              </div>
                            </div>
                      </div>

                        <div class="row row-space">
                            <div class="col-2">
                              <div class="input-group">
                                <label class="label">No. K/P</label>
                                <input class="input--style-4" type="text" maxlength="12" minlength="12" required name="no_ic">
                                
                                </div>
                            </div>
                            <div class="col-2">
                              <div class="input-group">
                                    <label class="label">Tarikh Lahir</label>
                   <input class="input--style-4 js-datepicker" type="text" name="tarikh_lahir" required>  
                                   
                                </div>
                            </div>
                        </div>
                       <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">No. Telefon</label>
                                    <input class="input--style-4" type="text" name="no_hp" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Umur</label>
                                    <input class="input--style-4" type="text" name="umur" required>
                                </div>
                            </div>
                        </div>
                      
                        <div class="input-group">
                            <label class="label">Jantina</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="jantina" required>
                                    <option disabled="disabled" selected="selected">Sila Pilih</option>
                                     <option value="1">Lelaki</option>
                                     <option value="2">Perempuan</option>
                                  
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                          <div class="input-group">
                            <label class="label">Bangsa</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                           <select name="bangsa" required>
                           <option disabled="disabled" selected="selected">Sila Pilih</option>
                                       
							         <option value="1">Melayu</option>
							         <option value="2">Cina</option>
							         <option value="3">India</option>
							         <option value="4">Lain-lain</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                         <div class="input-group">
                            <label class="label">Warganegara</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                           <select name="warganegara" required>
                           <option disabled="disabled" selected="selected">Sila Pilih</option>
							       <option value="1">Warganegara</option>
                                   <option value="2">Bukan Warganegara</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="label">Status Perkahwinan</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                           <select name="status_perkahwinan" required>
                           <option disabled="disabled" selected="selected">Sila Pilih</option>
							    
						
						 <option value="1">Bujang</option>
						<option value="2">Berkahwin</option>
						 <option value="3">Duda</option>
						 <option value="4">Janda</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div> 
                        
                           <div class="row row-space">
                            <div class="col-2">
                              <div class="input-group">
                                <label class="label">Pekerjaan</label>
                                <input class="input--style-4" type="text" required name="pekerjaan">
                                
                                </div>
                            </div>
                            <div class="col-2">
                              <div class="input-group">
                                    <label class="label">Tempoh Tinggal Kariah</label>
                  <input class="input--style-4" type="text" name="tempoh_tinggal" required>
                                
                                   
                                </div>
                            </div>
                        </div>
                        
                          <div class="input-group">
                            <label class="label">Zon Kariah</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                           <select name="zon_qariah" required>
						    <?php echo $options5;?> <?php echo $pilihanzon;?>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div> 
                        
                          <div class="input-group">
                              <div class="input-group">
                                <label class="label">No.Rumah</label>
                                <input class="input--style-4" type="text" required name="alamat_terkini">
                              </div>
                            </div>
                    
                      
                        <div class="input-group">
                            <label class="label">Negeri</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                           <select name="id_negeri" required>
                            <?php echo $options1;?> <?php echo $options;?>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div> 
                        
                          <div class="input-group">
                            <label class="label">Daerah</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                           <select name="id_daerah" required>
                            <?php echo $options3;?><?php echo $options4;?>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div> 
                        
                         <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Poskod</label>
                                    <input class="input--style-4" type="text" required name="poskod">
                                </div>
                            </div>
                            </div> 

                            <div class="input-group">
                            <label class="label">Warga Emas</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                           <select name="warga_emas" required>
                           <option disabled="disabled" selected="selected">Sila Pilih</option>
                  
            
             <option value="1">Ya</option>
            <option value="2">Tidak</option>
             
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div> 


                             <div class="input-group">
                            <label class="label">Wajib Solat Jumaat</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                           <select name="solat_jumaat" required>
                           <option disabled="disabled" selected="selected">Sila Pilih</option>
                  
            
             <option value="1">Ya</option>
            <option value="2">Tidak</option>
             
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div> 


                        <div class="col-lg-6"><br>
    <button class="btn btn--radius-2 btn--blue" type="submit" onSubmit="alert('Terima Kasih. Pendaftaran Anda Berjaya!');">Hantar Pemohonan</button>
                        </div>
<input type="hidden" id="website" name="website" value="<?php echo($reff_url2); ?>" />
                    </form>
<div class="col-lg-6"><br /><br />
<button class="btn btn--radius-2 btn--blue" onclick="location.href='<?php echo($_SERVER['HTTP_REFERER']); ?>'">Kembali ke Laman Web</button>
</div>

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
