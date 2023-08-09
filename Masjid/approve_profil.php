<?php

namespace Verot\Upload;
include($_SERVER['DOCUMENT_ROOT']."/Masjid/Classes/phpUpload/class.upload.php");

include('connection/connection.php');
include('fungsi_tarikh.php');

if(isset($_GET['id'])){
    $id_data = $_GET['id'];

    $sql = "SELECT * FROM approve_qariah WHERE id='$id_data'";
    $sqlquery = mysqli_query($bd2,$sql);
    $data = mysqli_fetch_array($sqlquery);

    $no_ic_ketua = $data['no_ic'];

    $sql1 = "SELECT * FROM approve_anak WHERE ID='$id_data'";
    $sqlquery1 = mysqli_query($bd2,$sql1);
    $data1 = mysqli_fetch_array($sqlquery1);
    $row1 = mysqli_num_rows($sqlquery1);
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
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Masjid Pro - Rekod Kehadiran">
    <meta name="author" content="Masjid Pro">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="images/logo2.png">
    <title>Masjid Pro - Maklumat Ahli Kariah</title>

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
    <?php include("loader.php"); ?>

    <style type="text/css" media="print">
        @media print {
            #printbtn {
                display: none;
            }
        }
    </style>
    <!-- <style>
        #container1{
            position: relative;
            top: 600px;
        }
        #container2{
            position: absolute;
            top: -550px;
        }
    </style> -->
</head>

<body style="background-color: white">
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
    <center>
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card" id="card" style="background-image: url('images/logo_masjidpropenang_opacity.png');
            background-repeat: no-repeat;
            background-position: center;">
                <div class="card-body">
                    <center class="m-t-30">
                        <!-- <img src="../assets/images/users/5.jpg" class="img-circle" width="150" /> -->
                        <img class="img-fluid p-3" id="output_profil" src="<?php echo($data['gambar_profil']); ?>" class="img-circle" width="150">
                        <h4 class="card-title m-t-10"><?php echo $data['nama_penuh']; ?></h4>
                        <h6 class="card-subtitle"><?php echo $nama_masjid; ?></h6>
                        <div class="row text-center justify-content-md-center">
                            <div class="col-4">Jumlah Tanggungan<br><i class="icon-people"></i> <font class="font-medium"><?php echo $row1; ?></font></div>
                            <div class="col-4">No Rujukan<br></i> <font class="font-medium"><?php echo $data['no_rujukan']; ?></font></div>
                        </div>
                    </center>
                </div>
                <div>
                    <hr>
                </div>
                <div class="">
                    <center>
                        <?php
                        if(strpos($data['bukti_kariah'], 'data') !== false) { ?>
                            <img class="img-fluid p-3" id="output_profil" src="<?php echo($data['bukti_kariah']); ?>">
                            <?php
                        }
                        else if($data['bukti_kariah'] != NULL AND $data['bukti_kariah'] != " "){
                            $q = "SELECT bukti_kariah 'file' FROM approve_qariah WHERE id = " . $data['id'];
                            $file = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
                            $file2 = mysqli_fetch_assoc($file);
                            $file_base64 = $file2['file'];
                            $file_base64 = str_replace('data:image/jpg;base64', '', $file_base64);
                            $file_base64 = str_replace('data:image/jpeg;base64', '', $file_base64);
                            $file_base64 = str_replace('data:image/png;base64', '', $file_base64);
                            $file_base64 = str_replace('data:image/gif;base64', '', $file_base64);
                            $handle = new Upload('base64:'.$file_base64);
                            $file_gambar = 'data:'.$handle->file_src_mime.';base64,'.base64_encode($handle->process());
                            ?>
                            <img class="img-fluid p-3" id="output_profil" src="<?php echo $file_gambar; ?>">
                            <!-- <a target="_blank" href="../Masjid/utama.php?data=raw&action=lihat_fail&fileDB=1&file=gambarProfil&id_data=<?php //echo $kemas['id_data']; ?>"><img style="max-width: 128px" class="img-fluid" src="images/pdf_icon.png"></a> -->
                        <?php
                        }
                        ?>
                        <!-- <img class="img-fluid p-3" id="output_profil" src="<?php //echo($data['bukti_kariah']); ?>" class="img-circle" width="300" height="300"> -->
                    </center>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body">
                    <center><h6 class="card-subtitle">MAKLUMAT PERIBADI</h6></center>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                No Kad Pengenalan
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php echo $data['no_ic']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                No Telefon
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php echo $data['no_tel']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Tarikh Lahir
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php echo fungsi_tarikh($data['tarikh_lahir'],11,2); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Umur
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <input type="hidden" name="tarikh" id="tarikh" value="<?php echo $data['tarikh_lahir']; ?>">
                                        <div id="dis_umur"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Status Perkahwinan
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $status_perkahwinan = $data['status_perkahwinan'];
                                        if($status_perkahwinan==1){
                                            echo "BUJANG";
                                        }
                                        else if($status_perkahwinan==2){
                                            echo "BERKAHWIN";
                                        }
                                        else if($status_perkahwinan==3){
                                            echo "DUDA";
                                        }
                                        else if($status_perkahwinan==4){
                                            echo "JANDA";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Jantina
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $jantina = $data['jantina'];

                                        if($jantina==1){
                                            echo "LELAKI";
                                        }
                                        else if($jantina==2){
                                            echo "PEREMPUAN";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Bangsa
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $bangsa = $data['bangsa'];

                                        if($bangsa==1){
                                            echo "MELAYU";
                                        }
                                        else if($bangsa==2){
                                            echo "CINA";
                                        }
                                        else if($bangsa==3){
                                            echo "INDIA";
                                        }
                                        else if($bangsa==4){
                                            echo "LAIN-LAIN";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Warganegara
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $warganegara = $data['warganegara'];

                                        if($warganegara==1){
                                            echo "WARGANEGARA";
                                        }
                                        else if($warganegara==2){
                                            echo "BUKAN WARGANEGARA";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Pekerjaan
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $pekerjaan =  $data['pekerjaan'];

                                        if($pekerjaan==1){
                                            echo "KERAJAAN";
                                        }
                                        else if($pekerjaan==2){
                                            echo "SWASTA";
                                        }
                                        else if($pekerjaan==3){
                                            echo "SENDIRI";
                                        }
                                        else if($pekerjaan==4){
                                            echo "PENCEN";
                                        }
                                        else if($pekerjaan==5){
                                            echo "TIDAK BEKERJA";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Pendapatan Isi Rumah
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $pendapatan = $data['pendapatan'];

                                        if($pendapatan==1){
                                            echo "0-1000";
                                        }
                                        else if($pendapatan==2){
                                            echo "1001-2000";
                                        }
                                        else if($pendapatan==3){
                                            echo "2001-3000";
                                        }
                                        else if($pendapatan==4){
                                            echo "3001-4000";
                                        }
                                        else if($pendapatan==5){
                                            echo "LEBIH DARI 4000";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Alamat Terkini
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $sql_daerah = "SELECT * FROM daerah WHERE id_daerah='$data[daerah]'";
                                        $query_daerah = mysqli_query($bd2,$sql_daerah);
                                        $data_daerah = mysqli_fetch_array($query_daerah);

                                        $alamat_daerah = $data_daerah['nama_daerah'];

                                        $sql_negeri = "SELECT * FROM negeri WHERE id_negeri='$data[negeri]'";
                                        $query_negeri = mysqli_query($bd2,$sql_negeri);
                                        $data_negeri = mysqli_fetch_array($query_negeri);

                                        $alamat_negeri = $data_negeri['name'];
                                        ?>
                                        <?php echo $data['no_rumah']; ?>, <?php echo $data['poskod']; ?> <?php echo $alamat_daerah; ?>, <?php echo $alamat_negeri; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Zon Kariah
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $zon_qariah = $data['zon_qariah'];

                                        $sql_zon = "SELECT * FROM sej6x_data_zonqariah WHERE id_zonqariah='$zon_qariah'";
                                        $query_zon = mysqli_query($bd2,$sql_zon);
                                        $data_zon = mysqli_fetch_array($query_zon);

                                        echo $data_zon['nama_zon'];
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Tempoh Tinggal
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php echo $data['tempoh_tinggal']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Pemilikkan Rumah
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $pemilikkan = $data['pemilikkan'];

                                        if($pemilikkan==1){
                                            echo "BELI";
                                        }
                                        else if($pemilikkan==2){
                                            echo "SEWA";
                                        }
                                        else if($pemilikkan==3){
                                            echo "PUSAKA";
                                        }
                                        else if($pemilikkan==4){
                                            echo "MENUMPANG";
                                        }
                                        else if($pemilikkan==5){
                                            echo strtoupper($data['pemilikkan2']);
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body">
                    <center><h6 class="card-subtitle">CATATAN MASJID</h6></center>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Wajib Solat Jumaat
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $solat_jumaat = $data['solat_jumaat'];

                                        if($solat_jumaat==1){
                                            echo "YA";
                                        }
                                        else if($solat_jumaat==2){
                                            echo "TIDAK";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Asnaf
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $asnaf = $data['data_asnaf'];

                                        if($asnaf==1){
                                            echo "YA";
                                        }
                                        else if($asnaf==2){
                                            echo "TIDAK";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                OKU
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $oku = $data['oku'];

                                        if($oku==1){
                                            echo "YA";
                                        }
                                        else if($oku==2){
                                            echo "TIDAK";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Warga Emas
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <div id="dis_wargaemas"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Layak Mengundi
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <div id="dis_undi"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Ibu Tunggal
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        if($jantina==1){
                                            echo "TIDAK";
                                        }
                                        else if($jantina==2){
                                            $ibutunggal = $data['data_ibutunggal'];
                                            if($ibutunggal==1){
                                                echo "YA";
                                            }
                                            else if($ibutunggal==2){
                                                echo "TIDAK";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Sakit Kronik
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $sakit_kronik = $data['data_sakit'];

                                        if($sakit_kronik==1){
                                            echo "YA";
                                        }
                                        else if($sakit_kronik==2){
                                            echo "TIDAK";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Anak Yatim
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $anak_yatim = $data['data_anakyatim'];

                                        if($anak_yatim==1){
                                            echo "YA";
                                        }
                                        else if($anak_yatim==2){
                                            echo "TIDAK";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Mualaf
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $mualaf = $data['data_mualaf'];

                                        if($mualaf==1){
                                            echo "YA";
                                        }
                                        else if($mualaf==2){
                                            echo "TIDAK";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                        <div class="row">
                                            <div class="col-md-10" align="left">
                                                Khairat Kematian
                                            </div>
                                            <div class="col-md-2" align="left">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <?php
                                        $khairat_kematian = $data['data_khairat'];

                                        if($khairat_kematian==1){
                                            echo "YA";
                                        }
                                        else if($khairat_kematian==2){
                                            echo "TIDAK";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <?php
                                $jenis_oku = explode(',',$data['jenis_oku']);
                                $i = 0;
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Bil</th>
                                            <th>Jenis OKU</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(in_array("1", $jenis_oku))
                                        {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php  echo $i = $i+1; ?>
                                                </td>
                                                <td>
                                                    KURANG UPAYA PENDENGARAN
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php
                                        if(in_array("2", $jenis_oku))
                                        {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php  echo $i = $i+1; ?>
                                                </td>
                                                <td>
                                                    KURANG UPAYA PENGLIHATAN
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php
                                        if(in_array("3", $jenis_oku))
                                        {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php  echo $i = $i+1; ?>
                                                </td>
                                                <td>
                                                    KURANG UPAYA PERTUTURAN
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php
                                        if(in_array("4", $jenis_oku))
                                        {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php  echo $i = $i+1; ?>
                                                </td>
                                                <td>
                                                    KURANG UPAYA FIZIKAL
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php
                                        if(in_array("5", $jenis_oku))
                                        {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php  echo $i = $i+1; ?>
                                                </td>
                                                <td>
                                                    KURANG UPAYA PEMBELAJARAN
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php
                                        if(in_array("6", $jenis_oku))
                                        {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php  echo $i = $i+1; ?>
                                                </td>
                                                <td>
                                                    KURANG UPAYA MENTAL
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php
                                        if(in_array("7", $jenis_oku))
                                        {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php  echo $i = $i+1; ?>
                                                </td>
                                                <td>
                                                    KURANG UPAYA PELBAGAI
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Bil</th>
                                            <th>Jenis Penyakit</th>
                                            <!-- <th>Nama Penyakit</th> -->
                                            <th>Rawatan Terkini</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $j = 1;
                                        $sql_sakit = "SELECT * FROM sej6x_data_sakit WHERE id_data='$id_data'";
                                        $query_sakit = mysqli_query($bd2,$sql_sakit);
                                        while($data_sakit = mysqli_fetch_array($query_sakit))
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $j; ?></td>
                                                <td>
                                                    <?php
                                                    $jenis_sakit = $data_sakit['id_penyakit']; //Cari Table senarai penyakit

                                                    $sql2 = "SELECT * FROM list_penyakit WHERE id_penyakit='$jenis_sakit'";
                                                    $sqlquery2 = mysqli_query($bd2,$sql2);
                                                    $data2 = mysqli_fetch_array($sqlquery2);

                                                    echo $data2['penyakit'];
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $data_sakit['jenis_penyakit']; ?></td> -->
                                                <td><?php echo $data_sakit['rawatan_terkini']; ?></td>
                                            </tr>
                                            <?php
                                            $j++;
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body">
                    <center><h6 class="card-subtitle">SENARAI TANGGUNGAN</h6></center>
                    <div class="col-md-12">
                        <?php
                        $sql_anak = "SELECT * FROM approve_anak WHERE id_qariah='$id_data' OR no_ic_ketua='$no_ic_ketua'";
                        $query_anak = mysqli_query($bd2,$sql_anak);
                        $bil_anak = 1;
                        while($data_anak = mysqli_fetch_array($query_anak))
                        {
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <center><?php echo "MAKLUMAT TANGGUNGAN ".$bil_anak; ?></center><br>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6" align="left">
                                            <div class="row">
                                                <div class="col-md-10" align="left">
                                                    No Kad Pengenalan
                                                </div>
                                                <div class="col-md-2" align="left">
                                                    :
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" align="left">
                                            <?php echo $data_anak['nama_penuh']; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" align="left">
                                            <div class="row">
                                                <div class="col-md-10" align="left">
                                                    Nama Penuh
                                                </div>
                                                <div class="col-md-2" align="left">
                                                    :
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" align="left">
                                            <?php echo $data_anak['no_ic']; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" align="left">
                                            <div class="row">
                                                <div class="col-md-10" align="left">
                                                    No Telefon
                                                </div>
                                                <div class="col-md-2" align="left">
                                                    :
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" align="left">
                                            <?php echo $data_anak['no_tel']; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" align="left">
                                            <div class="row">
                                                <div class="col-md-10" align="left">
                                                    Hubungan
                                                </div>
                                                <div class="col-md-2" align="left">
                                                    :
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" align="left">
                                            <?php
                                            $hubungan = $data_anak['hubungan'];

                                            $sql_hubungan = "SELECT * FROM jenis_hubungan WHERE id_hubungan='$hubungan'";
                                            $query_hubungan = mysqli_query($bd2,$sql_hubungan);
                                            $data_hubungan = mysqli_fetch_array($query_hubungan);

                                            echo $data_hubungan['hubungan'];
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6" align="left">
                                            <div class="row">
                                                <div class="col-md-10" align="left">
                                                    Tarikh Lahir
                                                </div>
                                                <div class="col-md-2" align="left">
                                                    :
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" align="left">
                                            <?php echo fungsi_tarikh($data_anak['tarikh_lahir'],11,2); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" align="left">
                                            <div class="row">
                                                <div class="col-md-10" align="left">
                                                    Umur
                                                </div>
                                                <div class="col-md-2" align="left">
                                                    :
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" align="left">
                                            <input type="hidden" name="umur_anak<?php echo $bil_anak; ?>" id="umur_anak<?php echo $bil_anak; ?>" value="<?php echo $data_anak['tarikh_lahir']; ?>">
                                            <div id="dis_umur_anak<?php echo $bil_anak; ?>"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" align="left">
                                            <div class="row">
                                                <div class="col-md-10" align="left">
                                                    Jantina
                                                </div>
                                                <div class="col-md-2" align="left">
                                                    :
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" align="left">
                                            <?php
                                            $jantina_anak = $data_anak['jantina'];

                                            if($jantina_anak==1){
                                                echo "LELAKI";
                                            }
                                            else if($jantina_anak==2){
                                                echo "PEREMPUAN";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" align="left">
                                            <div class="row">
                                                <div class="col-md-10" align="left">
                                                    Bangsa
                                                </div>
                                                <div class="col-md-2" align="left">
                                                    :
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" align="left">
                                            <?php
                                            $bangsa_anak = $data_anak['bangsa'];

                                            if($bangsa_anak==1){
                                                echo "MELAYU";
                                            }
                                            else if($bangsa_anak==2){
                                                echo "CINA";
                                            }
                                            else if($bangsa_anak==3){
                                                echo "INDIA";
                                            }
                                            else if($bangsa_anak==4){
                                                echo "LAIN-LAIN";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6" align="left">
                                            <div class="row">
                                                <div class="col-md-10" align="left">
                                                    Warganegara
                                                </div>
                                                <div class="col-md-2" align="left">
                                                    :
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" align="left">
                                            <?php
                                            $warganegara_anak =  $data_anak['warganegara'];

                                            if($warganegara_anak==1){
                                                echo "WARGANEGARA";
                                            }
                                            else if($warganegara_anak==2){
                                                echo "BUKAN WARGANEGARA";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" align="left">
                                            <div class="row">
                                                <div class="col-md-10" align="left">
                                                    Status Perkahwinan
                                                </div>
                                                <div class="col-md-2" align="left">
                                                    :
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" align="left">
                                            <?php
                                            $status_kahwin = $data_anak['status_kahwin'];

                                            if($status_kahwin==1){
                                                echo "BUJANG";
                                            }
                                            else if($status_kahwin==2){
                                                echo "BERKAHWIN";
                                            }
                                            else if($status_kahwin==3){
                                                echo "DUDA";
                                            }
                                            else if($status_kahwin==4){
                                                echo "JANDA";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12"><br><br></div>
                            </div>
                            <?php
                            $bil_anak++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </center>
    <footer>
        Tarikh Mohon : <?php echo fungsi_tarikh($data['last_added'],1,1); ?>
        <br>
        Maklumat anda dilindungi oleh Akta 709 (Akta Perlindungan Data Peribadi 2010)
    </footer>
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
<!--Custom JavaScript -->
<script type="text/javascript">$(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    });
</script>
<script>

    var tarikh = document.getElementById('tarikh').value;

    var dob = new Date(tarikh);
    //calculate month difference from current date in time
    var month_diff = Date.now() - dob.getTime();

    //convert the calculated difference in date format
    var age_dt = new Date(month_diff);

    //extract year from date
    var year = age_dt.getUTCFullYear();

    //now calculate the age of the user
    var age = Math.abs(year - 1970);

    //display the calculated age
    if(age>17) {
        document.getElementById('dis_undi').innerHTML = "YA";
    }
    else if(age<18) {
        document.getElementById('dis_undi').innerHTML = "TIDAK";
    }

    if(age>59) {
        document.getElementById('dis_wargaemas').innerHTML = "YA";
    }
    else if(age<60) {
        document.getElementById('dis_wargaemas').innerHTML = "TIDAK";
    }
    document.getElementById('dis_umur').innerHTML = age + " TAHUN";
</script>
<?php
$sql_anak = "SELECT * FROM sej6x_data_anakqariah WHERE id_qariah='$id_data'";
$query_anak = mysqli_query($bd2,$sql_anak);
$j = 1;
while($data_anak = mysqli_fetch_array($query_anak))
{
    ?>
    <script>

        var tarikh = document.getElementById('umur_anak<?php echo $j; ?>').value;

        var dob = new Date(tarikh);
        //calculate month difference from current date in time
        var month_diff = Date.now() - dob.getTime();

        //convert the calculated difference in date format
        var age_dt = new Date(month_diff);

        //extract year from date
        var year = age_dt.getUTCFullYear();

        //now calculate the age of the user
        var age = Math.abs(year - 1970);

        //display the calculated age
        document.getElementById('dis_umur_anak<?php echo $j; ?>').innerHTML = age + " TAHUN";
    </script>
    <?php
    $j++;
}
?>
