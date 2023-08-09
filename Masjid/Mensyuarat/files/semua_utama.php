<?php 

require_once('connection/connection.php');

session_start();
///change page
 if(isset($_GET["view"]))
    $view = $_GET["view"];
  else $view = "";

$sql = "SELECT s.user_name,p.user_type 
        FROM masjid_user s 
        INNER JOIN jenis_user p 
        ON s.user_type_id=p.user_type_id
        WHERE s.user_id='$_SESSION[user_id]'";
$res = mysql_query($sql);
$datastaff = mysql_fetch_array($res);


//error diasble
error_reporting(0);
@ini_set('display_errors', 0);


?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Pengurusan Masjid</title>
    <link rel="icon" href="picture/mosque.png">

   <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
     

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>
     

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
 
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

</head>

<body>
<style>

.background {
  background-image: url("muka_depan.jpg"); /* The image used */
  background-color: #cccccc; /* Used if the image is unavailable */
  height: 500px; /* You must set a specified height */
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; /* Resize the background image to cover the entire container */
}
.sidebar{
  background-color: #4ba5ad;
  /* background: url(picture/bg.jpg) repeat-y; */
 
}

.navbar { 
  background-color: #4ba5ad; 
  
} 
.navbar-default .navbar-brand {
    color: #000000;
}

a { 
  color: #000000; 
  
} 

footer.sticky-footer {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  position: absolute;
  right: 0;
  bottom: 0;
  width: calc(100% - 90px);
  height: 40px;
  background-color: #4ba5ad;
}

footer.sticky-footer .copyright {
  line-height: 3;
  font-size: 1.3rem;
  color: #000000; 
}

@media (min-width: 768px) {
  footer.sticky-footer {
    width: calc(100% - 225px);
  }
}

body.sidebar-toggled footer.sticky-footer {
  width: 100%;
}

@media (min-width: 768px) {
  body.sidebar-toggled footer.sticky-footer {
    width: calc(100% - 90px);
  }
}

#wrapper {
    width: 100%;
    background-color: #4ba5ad;
}


.panel-default>.panel-heading {
    color: #000000;
    background-color: #b1cdd0;
    border-color: #f5f5f5;
}
                </style>
</head>
						<?php 
						include("connection/connection.php");
						$result= mysql_query("SELECT id_masjid,kod_masjid,nama_masjid,alamat_masjid 
						FROM sej6x_data_masjid 
						WHERE kod_masjid='$jname'") or die("SELECT Error: ".mysql_error()); 
						$namamasjid = mysql_fetch_assoc($result);?>

<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">
                   MASJID DATO' SHEIKH ADNAN PENAGA
              <?php /*?>
                <?php echo $namamasjid['nama_masjid'];echo",";echo $namamasjid['alamat_masjid']; ?> <?php */?>
              </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">                    
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>
                        <?php echo $datastaff['user_name'];?>                        
                    </a>
                </li>
                 <li>
                    <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Log Keluar</a>
                </li>
            </ul>
            <!-- /.navbar-top-links -->
     <!-- MENU SECTION -->
       <?php 
     // include("Connections/billing_connect.php"); 
    //include("sidebar/sedebar.php"); 
      ?>
      <?php 
if ($_SESSION['user_type_id']==1){
    include ("sidebar/sidebar_superadmin.php");

}elseif ($_SESSION['user_type_id']==2){
    include ("sidebar/sidebar_admin.php");

}elseif ($_SESSION['user_type_id']==3){
    include ("sidebar/sidebar_pengerusi.php");

}elseif ($_SESSION['user_type_id']==4){
    include ("sidebar/sidebar_timbalan_pengerusi.php");

}elseif ($_SESSION['user_type_id']==5){
    include ("sidebar/sidebar_setiausaha.php");

}elseif ($_SESSION['user_type_id']==6){
    include ("sidebar/sidebar_bendahari.php");

}elseif ($_SESSION['user_type_id']==7){
    include ("sidebar/sidebar_ajk.php");

}elseif ($_SESSION['user_type_id']==8){
    include ("sidebar/sidebar_pegawai_khas.php");

}


?>


<!-- start view pages -->
<?php 
if (isset($_GET['view'])){
    $view=$_GET['view'];
}else{
    $view="";
}

if (isset($_GET['action'])){
    $action=$_GET['action'];
}else{
    $action="";
} 
?>

<div id="page-wrapper">

<?php

//viewing for superadmin page
if ($view=="superadmin"){
    if ($action=="dashboard"){
        include ("superadmin/dashboard.php");
    }
    



//viewing for admin page
    }elseif ($view=="admin"){

//Sidebar - Dashboard
    if ($action=="dashboard"){
        include ("admin/dashboard.php");
    }
/Sidebar - Pendaftaran

    elseif ($action=="pendaftaran"){
        include ("admin/pendaftaran_dashboard.php");
    }
    elseif ($action=="pendaftaran_ahli_qariah"){
        include ("admin/daftar_qariah.php");
    }
     elseif ($action=="view_ahliqariah")   // VIEW DAFTAR QARIAH
    {
        include("admin/view_ahliqariah.php");
    }
     elseif ($action=="view_ahliqariah")   // VIEW DAFTAR QARIAH
    {
        include("admin/view_ahliqariah.php");
    }
     elseif ($action=="pendaftaran_layak_mengundi")   //DAFTAR LAYAK MENGUNDI
    {
        include("admin/daftar_layak_undi.php");
    }
           elseif ($action=="daftar_layak_mengundi")   //DAFTAR LAYAK MENGUNDI
    {
        include("admin/pendaftaran_layak_undi.php");
    }
           elseif ($action=="kemaskini_layakmengundi")   //KEMASKINI LAYAK MENGUNDI
    {
        include("admin/kemaskini_layakmengundi.php");
    }
           elseif ($action=="pendaftaran_kematian")   //SENARAI KEMATIAN
    {
        include("admin/daftar_kematian.php");
    }
           elseif ($action=="daftar_kematian")   //DAFTAR KEMATIAN
    {
        include("admin/pendaftaran_kematian.php");
    }
           elseif ($action=="butiran_kematian")   //BUTIRAN KEMATIAN
    {
        include("admin/butiran_kematian.php");
    }
           elseif ($action=="semak_kematian")   //SEMAK KEMATIAN
    {
        include("admin/semak_kematian.php");
    }
           elseif ($action=="penyata_perbelanjaan")   //PENYATA PERBELANJAAN
    {
        include("admin/penyata_perbelanjaan.php");
    }
            elseif ($action=="pendaftaran_anak_yatim")   //DAFTAR ANAK YATIM
    {
        include("admin/daftar_anak_yatim.php");
    }
            elseif ($action=="senarai_anakyatim")   //SENARAI ANAK YATIM
    {
        include("admin/senarai_anakyatim.php");
    }
            elseif ($action=="semak_anakyatim")   //SEMAK ANAK YATIM
    {
        include("admin/semak_anakyatim.php");
    }
            elseif ($action=="pendaftaran_asnaf")   //DAFTAR ASNAF/FAQIR
    {
        include("admin/daftar_asnaf.php");
    }
            elseif ($action=="senarai_asnaf")   //SENARAI ASNAF
    {
        include("admin/senarai_asnaf.php");
    }
            elseif ($action=="semak_asnaf")   //UPDATE ASNAF
    {
        include("admin/semak_asnaf.php");
    }
            elseif ($action=="pendaftaran_ibu_tunggal")   //DAFTAR IBU TUNGGAL
    {
          include("admin/daftar_ibu_tunggal.php");
        }
          elseif ($action=="senarai_ibutunggal")   //SENARAI IBU TUNGGAL
        {
          include("admin/senarai_ibutunggal.php");
        }
        
         elseif ($action=="semak_ibutunggal")   //SEMAK IBU TUNGGAL
        {
          include("admin/semak_ibutunggal.php");
        }

        elseif ($action=="pendaftaran_sakit_kronik")   //DAFTAR SAKIT KRONIK
        {
          include("admin/daftar_sakit_kronik.php");
        }
        
        elseif ($action=="butiran_sakit")   //BUTIRAN SAKIT KRONIK
        {
          include("admin/butiran_sakit.php");
        }
        
        elseif ($action=="semak_sakit")   //SEMAK SAKIT KRONIK
        {
          include("admin/semak_sakit.php");
        }
        elseif ($action=="senarai_sakit")   //SENARAI SAKIT KRONIK
        {
          include("admin/senarai_sakit.php");
        }

        elseif ($action=="pendaftaran_oku")   //DAFTAR OKU
        {
          include("admin/daftar_oku.php");
        }
        
         elseif ($action=="senarai_oku")   //SENARAI OKU
        {
          include("admin/senarai_oku.php");
        }
         elseif ($action=="semak_oku")   //SEMAK OKU
        {
          include("admin/semak_oku.php");
        }
        
        elseif ($action=="butiran_oku")   //BUTIRAN OKU
        {
          include("admin/butiran_oku.php");
        }
        elseif ($action=="pendaftaran_qairat")   
        {
          include("admin/pakatan_qairat.php");
        }


        elseif ($action=="daftar_warga_emas")   //DAFTAR WARGA EMAS
        {
          include("admin/daftar_warga_emas.php");
        }
         elseif ($action=="senarai_wargaemas")   //SENARAI WARGA EMAS
        {
          include("admin/senarai_wargaemas.php");
        }
         elseif ($action=="semak_wargaemas")   //SEMAK WARGA EMAS
        {
          include("admin/semak_wargaemas.php");
        }


          elseif ($action=="daftar_khairat")   //PENDAFTARAN KHAIRAT
        {
          include("admin/daftar_khairat.php");
        }
        elseif ($action=="butiran_khairat")   // BUTIRAN KHAIRAT
        {
          include("admin/butiran_khairat.php");
        }
            elseif ($action=="senarai_khairat")   // SENARAI KHAIRAT

        {
          include("admin/senarai_khairat.php");
        }
        elseif ($action=="semak_khairat")   // SEMAK KHAIRAT
        {
          include("admin/semak_khairat.php");
        }



         elseif ($action=="pendaftaran_zakat")   //DAFTAR ZAKAT
        {
          include("admin/daftar_zakat.php");
        }
         elseif ($action=="pemohonan_zakat")   //PEMOHONAN DAFTAR ZAKAT
        {
          include("admin/pemohonan_zakat.php");
        }
        elseif ($action=="butiran_zakat")   //BUTIRAN ZAKAT
        {
          include("admin/butiran_zakat.php");
        }
        elseif ($action=="senarai_zakat")   //SENARAI ZAKAT
        {
          include("admin/senarai_pemohonzakat.php");
        }
        elseif ($action=="del_senaraizakat")   //SENARAI ZAKAT
        {
          include("admin/del_senaraizakat.php");
        }
        elseif ($action=="add_mohonzakat")   //SENARAI ZAKAT
        {
          include("admin/add_mohonzakat.php");


 //Pentadbiran_kewangan
        }elseif ($action=="bukutunai") {
          include("admin/bukuTunai.php"); //buku tunai
        }elseif ($action=="penyata") {
          include("admin/laporan.php");
        }elseif ($action=="dashboard_terimabayaran") {
          include("admin/dashboard_terimabayaran.php"); //dashboard terima bayaran
          
        }elseif ($action=="senarai_pembayar_yurankariah") {
          include("admin/senarai_pembayar_yurankariah.php"); //senarai_pembayar_yurankariah
          
        }elseif ($action=="yuran_kariah") {
          include("admin/yuran_kariah.php"); //yuran kariah
        }elseif ($action=="butirbayaran_kariah") {
          include("admin/butirbayaran_kariah.php"); //butir bayaran kariah
        }elseif ($action=="terima_bayaran_terperinci") {
          include("admin/terima_bayaran_terperinci.php"); //terima bayaran terperinci
          
         
        }elseif ($action=="yuran_khairat") {
          include("admin/yuran_khairat.php"); //yuran khairat 
        }elseif ($action=="butirbayaran_khariat") {
          include("admin/butirbayaran_khariat.php"); //butir bayaran khairat
        }elseif ($action=="terima_bayarankhairat_terperinci") {
          include("admin/terima_bayarankhairat_terperinci.php"); //terima bayarankhairat terperinci 
        }elseif ($action=="senarai_pembayar_yurankhariat") {
          include("admin/senarai_pembayar_yurankhariat.php"); //senarai_pembayar_yurankhariat 
          
          
        }elseif ($action=="zakat") {
          include("admin/zakat.php"); //zakat
        }elseif ($action=="zakat") {
          include("admin/zakat.php"); //wakaf
 
        }elseif ($action=="terimabayaran") {
          include("admin/terima_bayaran.php"); //terima bayaran
        }elseif ($action=="laporanpendapatan") {
          include("admin/laporan_pendapatan.php");
        }elseif ($action=="penyata2018") {
          include("admin/laporan_pendapatan2018.php");
        }elseif ($action=="del_penyata2018") {
          include("admin/del_penyata2018.php");  //delete penyata2018
         }elseif ($action=="kehadiran") {
          include("admin/kehadiran_keseluruhan.php");
          
         }elseif ($action=="kehadiranterperinci") {
          include("admin/kehadiran_terperinci.php");  //kehadiran terperinci
        }

//REPORTS
         elseif  ($action=="laporan")
        {
          include("admin/laporan_dashboard.php");
        }
        elseif ($action=="tabung_bergerak")   //PENYATA TABUNG BERGERAK
        {
          include("admin/tabungBergerak.php");
        }

        elseif ($action=="tabung_am")   //7. PENYATA TABUNG AM
        {
          include("admin/tabungAm.php");
        }

        elseif ($action=="tabung_kebajikan")   //8. PENYATA KEBAJIKAN
        {
          include("admin/tabungKebajikan.php");
        }

        elseif ($action=="tabung_kematian")   //PENYATA TABUNG KEMATIAN
        {
          include("admin/tabungKematian.php");
        }

        elseif ($action=="tabung_kenduri")    //PENYATA TABUNG KENDURI
        {
          include("admin/tabungKenduri.php");
        }

        elseif ($action=="tabung_wakaf")   //PENYATA TABUNG WAKAF
        {
          include("admin/tabungWakaf.php");
        }

        elseif ($action=="tlk_wakaf_kubur")   //6. PENYATA WAKAF KUBUR
        {
          include("admin/tlk_wakaf_kubur.php");
        }

        elseif ($action=="tlk_wakaf_masjid")   //5.PENYATA WAKAF MASJID
        {
          include("admin/tlk_wakaf_masjid.php");
          
        }

//Sidebar - Kehadiran
        elseif ($action=="kehadiran")
        {
        include ("admin/kehadiran_keseluruhan.php");
    }
   

//Sidebar - Pengurusan Surat
    elseif ($action=="minitmensyuarat"){
        include ("admin/minit_mensyuarat.php");
    }
    elseif ($action=="laporanaktiviti"){
        include ("admin/laporanaktiviti.php");
    }
  
    elseif ($action=="suratnotis"){
        include("admin/surat_notis.php");
    }



//Sidebar - Kewangan
    elseif ($action=="bukutunai"){
        include ("admin/bukuTunai.php");
    }
    elseif ($action=="penyata"){
        include ("admin/laporan.php");
    }
  
    elseif ($action=="laporanpendapatan"){
        include("admin/laporan_pendapatan.php");
    }

    elseif ($action=="penyata2018"){
        include("admin/laporan_pendapatan2018.php");
    }

    elseif ($action=="dashboard_terimabayaran"){
        include("admin/dashboard_terimabayaran.php");
    }



//Sidebar - Selenggara
    elseif ($action=="selenggara"){
        include ("admin/selenggara.php");
    }
    elseif ($action=="maklumatselenggara"){
        include ("admin/maklumat_selenggara.php");
    }
    elseif ($action=="semak_selenggara"){
        include ("admin/semak_selenggara.php");
    }


    
    elseif ($action=="kerosakan"){
        include("admin/kerosakan.php");
    }
    elseif ($action=="maklumatkerosakan"){
        include("admin/maklumat_kerosakan.php");
    }
    elseif ($action=="semak_kerosakan"){
        include("admin/semak_kerosakan.php");
    }



//Sideabr - Selenggara - Utiliti
    elseif ($action=="utiliti"){
        include("admin/utiliti.php");
    }

    elseif ($action=="maklumatutiliti"){
        include("admin/maklumat_utiliti.php");
    }


//Sideabr - Selenggara - Sewa
    elseif ($action=="tambah_fasiliti"){
        include("admin/tambah_fasiliti.php");
    }

    elseif ($action=="sewa"){
        include("admin/sewa.php");
    }

    elseif ($action=="maklumatsewa"){
        include("admin/maklumat_sewa.php");
    }

    elseif ($action=="borang_sewa"){
        include("admin/borang_sewa.php");
    }


//Sideabr - Selenggara - Inventori
    elseif ($action=="inventori"){
        include("admin/inventori.php");
    }

    elseif ($action=="maklumatinventori"){
        include("admin/maklumat_inventori.php");
    }











//Sideabr - Carta Organisasi
    elseif ($action=="dashboard_tetapan"){
        include("admin/dashboard_tetapan.php");
    }
    elseif ($action=="daftar_ajk") {                    //Daftar AJK
        include("admin/daftar_ajk.php");
    }
    elseif ($action=="senarai_ajk") {                    //Senarai AJK
        include("admin/senarai_ajk.php");
    }
    elseif ($view=="butiran_jawatanajk") {              //Butiran Jawatan AJK
        include("admin/butiran_jawatanajk.php");
    }
    elseif ($view=="semak_ajk") {              //Butiran Jawatan AJK
        include("admin/semak_ajk.php");
    }



//Sideabr - Aduan Awam
    elseif ($action=="aduan"){
        include("admin/aduan.php");
    }

//Sideabr - Solat Jumaaat
    elseif ($action=="solatjumaat"){
        include("admin/solat_jumaat.php");
    }





//Sideabr - Carian Pantas
    elseif ($action=="carian"){
        include("admin/carian.php");
    }






//Sidebar - Komuniti
    elseif ($action=="komuniti"){
        include("admin/komuniti.php");
    }

    elseif ($action=="kafa"){
        include("admin/kafa.php");
    }
    elseif ($action=="semak_kafa"){
        include("admin/semak_kafa.php");
    }



    elseif ($action=="kemas"){
        include("admin/kemas.php");
    }
    elseif ($action=="semak_kemas"){
        include("admin/semak_kemas.php");
    }



    elseif ($action=="sekolah"){
        include("admin/sekolah.php");
    }
    elseif ($action=="semak_sekolah"){
        include("admin/semak_sekolah.php");
    }



    elseif ($action=="pasti"){
        include("admin/pasti.php");
    }
    elseif ($action=="semak_pasti"){
        include("admin/semak_pasti.php");
    }


    elseif ($action=="rukuntetangga"){
        include("admin/rukuntetangga.php");
    }
    elseif ($action=="semak_rukuntetangga"){
        include("admin/semak_rukuntetangga.php");
    }


    elseif ($action=="semak_rukuntetangga"){
        include("admin/semak_rukuntetangga.php");
    }
    elseif ($action=="semak_rukuntetangga"){
        include("admin/semak_rukuntetangga.php");
    }


    elseif ($action=="belia"){
        include("admin/belia.php");
    }
    elseif ($action=="semak_belia"){
        include("admin/semak_belia.php");
    }


    elseif ($action=="balai"){
        include("admin/balai.php");
    }
    elseif ($action=="semak_balai"){
        include("admin/semak_balai.php");
    }


    elseif ($action=="persatuan"){
        include("admin/persatuan.php");
    }
    elseif ($action=="semak_persatuan"){
        include("admin/semak_persatuan.php");
    }


    elseif ($action=="surau"){
        include("admin/surau.php");
    }
    elseif ($action=="semak_surau"){
        include("admin/semak_surau.php");
    }


    elseif ($action=="klinik"){
        include("admin/klinik.php");
    }
    elseif ($action=="semak_klinik"){
        include("admin/semak_klinik.php");
    }


    elseif ($action=="rumahibadat"){
        include("admin/rumah_ibadat.php");
    }
    elseif ($action=="semak_rumahibadat"){
        include("admin/semak_rumahibadat.php");
    }





   















    elseif ($action=="hebahan"){
        include("admin/hebahan.php");
    }





    






//viewing for pengerusi page
}elseif ($view=="pengerusi"){

//Sidebar - Dashboard
    if ($action=="dashboard"){
        include ("pengerusi/dashboard.php");
    }

//Sidebar - Pendaftaran
    elseif ($action=="pendaftaran"){
        include ("pengerusi/pendaftaran/pendaftaran_dashboard.php");
    }
    elseif ($action=="pendaftaran_ahli_qariah"){
        include ("pengerusi/pendaftaran/daftar_qariah.php");
    }


//Sidebar - Kehadiran
    elseif ($action=="kehadiran"){
        include ("pengerusi/pentadbiran/kehadiran_keseluruhan.php");
    }
   

//Sidebar - Pengurusan Surat
    elseif ($action=="minitmensyuarat"){
        include ("pengerusi/pentadbiran/minit_mensyuarat.php");
    }
    elseif ($action=="laporanaktiviti"){
        include ("pengerusi/pentadbiran/laporanaktiviti.php");
    }
  
    elseif ($action=="suratnotis"){
        include("pengerusi/pentadbiran/surat_notis.php");
    }


//Sidebar - Kewangan
    elseif ($action=="bukutunai"){
        include ("pengerusi/pentadbiran/bukuTunai.php");
    }
    elseif ($action=="penyata"){
        include ("pengerusi/pentadbiran/laporan.php");
    }
  
    elseif ($action=="laporanpendapatan"){
        include("pengerusi/pentadbiran/laporan_pendapatan.php");
    }

    elseif ($action=="penyata2018"){
        include("pengerusi/pentadbiran/laporan_pendapatan2018.php");
    }

    elseif ($action=="dashboard_terimabayaran"){
        include("pengerusi/pentadbiran/dashboard_terimabayaran.php");
    }



//Sidebar - Selenggara
    elseif ($action=="selenggara"){
        include ("pengerusi/pentadbiran/selenggara.php");
    }
    elseif ($action=="maklumatselenggara"){
        include ("pengerusi/pentadbiran/maklumat_selenggara.php");
    }
  
    elseif ($action=="kerosakan"){
        include("pengerusi/pentadbiran/kerosakan.php");
    }

    elseif ($action=="maklumatkerosakan"){
        include("pengerusi/pentadbiran/maklumat_kerosakan.php");
    }

//Sideabr - Selenggara - Utiliti
    elseif ($action=="utiliti"){
        include("pengerusi/pentadbiran/utiliti.php");
    }

    elseif ($action=="maklumatutiliti"){
        include("pengerusi/pentadbiran/maklumat_utiliti.php");
    }


//Sideabr - Selenggara - Sewa
    elseif ($action=="sewa"){
        include("pengerusi/pentadbiran/sewa.php");
    }

    elseif ($action=="maklumatsewa"){
        include("pengerusi/pentadbiran/maklumat_sewa.php");
    }


//Sideabr - Selenggara - Inventori
    elseif ($action=="inventori"){
        include("pengerusi/pentadbiran/inventori.php");
    }

    elseif ($action=="maklumatinventori"){
        include("pengerusi/pentadbiran/maklumat_inventori.php");
    }


//Sideabr - Carta Organisasi
    elseif ($action=="dashboard_tetapan"){
        include("pengerusi/tetapan/dashboard_tetapan.php");
    }

//Sideabr - Aduan Awam
    elseif ($action=="aduan"){
        include("pengerusi/aduan/aduan.php");
    }

//Sideabr - Solat Jumaaat
    elseif ($action=="solatjumaat"){
        include("pengerusi/laporan/solat_jumaat.php");
    }


//Sideabr - Carian Pantas
    elseif ($action=="carian"){
        include("pengerusi/carian/carian.php");
    }


//Sideabr - Komuniti
    elseif ($action=="komuniti"){
        include("pengerusi/info/komuniti.php");
    }

    elseif ($action=="hebahan"){
        include("pengerusi/info/hebahan.php");
    }









//viewing for timbalan_penegerusi page
}elseif ($view=="timbalan_pengerusi"){

//Sidebar - Dashboard
    if ($action=="dashboard"){
        include ("timbalan_pengerusi/dashboard.php");
    }

//Sidebar - Pendaftaran
    elseif ($action=="pendaftaran"){
        include ("timbalan_pengerusi/pendaftaran/pendaftaran_dashboard.php");
    }
    elseif ($action=="pendaftaran_ahli_qariah"){
        include ("timbalan_pengerusi/pendaftaran/daftar_qariah.php");
    }


//Sidebar - Kehadiran
    elseif ($action=="kehadiran"){
        include ("timbalan_pengerusi/pentadbiran/kehadiran_keseluruhan.php");
    }
   

//Sidebar - Pengurusan Surat
    elseif ($action=="minitmensyuarat"){
        include ("timbalan_pengerusi/pentadbiran/minit_mensyuarat.php");
    }
    elseif ($action=="laporanaktiviti"){
        include ("timbalan_pengerusi/pentadbiran/laporanaktiviti.php");
    }
  
    elseif ($action=="suratnotis"){
        include("timbalan_pengerusi/pentadbiran/surat_notis.php");
    }


//Sidebar - Kewangan
    elseif ($action=="bukutunai"){
        include ("timbalan_pengerusi/pentadbiran/bukuTunai.php");
    }
    elseif ($action=="penyata"){
        include ("timbalan_pengerusi/pentadbiran/laporan.php");
    }
  
    elseif ($action=="laporanpendapatan"){
        include("timbalan_pengerusi/pentadbiran/laporan_pendapatan.php");
    }

    elseif ($action=="penyata2018"){
        include("timbalan_pengerusi/pentadbiran/laporan_pendapatan2018.php");
    }

    elseif ($action=="dashboard_terimabayaran"){
        include("timbalan_pengerusi/pentadbiran/dashboard_terimabayaran.php");
    }



//Sidebar - Selenggara
    elseif ($action=="selenggara"){
        include ("timbalan_pengerusi/pentadbiran/selenggara.php");
    }
    elseif ($action=="maklumatselenggara"){
        include ("timbalan_pengerusi/pentadbiran/maklumat_selenggara.php");
    }
  
    elseif ($action=="kerosakan"){
        include("timbalan_pengerusi/pentadbiran/kerosakan.php");
    }

    elseif ($action=="maklumatkerosakan"){
        include("timbalan_pengerusi/pentadbiran/maklumat_kerosakan.php");
    }

//Sideabr - Selenggara - Utiliti
    elseif ($action=="utiliti"){
        include("timbalan_pengerusi/pentadbiran/utiliti.php");
    }

    elseif ($action=="maklumatutiliti"){
        include("timbalan_pengerusi/pentadbiran/maklumat_utiliti.php");
    }


//Sideabr - Selenggara - Sewa
    elseif ($action=="sewa"){
        include("timbalan_pengerusi/pentadbiran/sewa.php");
    }

    elseif ($action=="maklumatsewa"){
        include("timbalan_pengerusi/pentadbiran/maklumat_sewa.php");
    }


//Sideabr - Selenggara - Inventori
    elseif ($action=="inventori"){
        include("timbalan_pengerusi/pentadbiran/inventori.php");
    }

    elseif ($action=="maklumatinventori"){
        include("timbalan_pengerusi/pentadbiran/maklumat_inventori.php");
    }


//Sideabr - Carta Organisasi
    elseif ($action=="dashboard_tetapan"){
        include("timbalan_pengerusi/tetapan/dashboard_tetapan.php");
    }

//Sideabr - Aduan Awam
    elseif ($action=="aduan"){
        include("timbalan_pengerusi/aduan/aduan.php");
    }

//Sideabr - Solat Jumaaat
    elseif ($action=="solatjumaat"){
        include("timbalan_pengerusi/laporan/solat_jumaat.php");
    }


//Sideabr - Carian Pantas
    elseif ($action=="carian"){
        include("timbalan_pengerusi/carian/carian.php");
    }


//Sideabr - Komuniti
    elseif ($action=="komuniti"){
        include("timbalan_pengerusi/info/komuniti.php");
    }

    elseif ($action=="hebahan"){
        include("timbalan_pengerusi/info/hebahan.php");
    }















//viewing for setiausaha page
}elseif ($view=="setiausaha"){

//Sidebar - Dashboard
    if ($action=="dashboard"){
        include ("setiausaha/dashboard.php");
    }

//Sidebar - Pendaftaran
    elseif ($action=="pendaftaran"){
        include ("setiausaha/pendaftaran/pendaftaran_dashboard.php");
    }
    elseif ($action=="pendaftaran_ahli_qariah"){
        include ("setiausaha/pendaftaran/daftar_qariah.php");
    }


//Sidebar - Kehadiran
    elseif ($action=="kehadiran"){
        include ("setiausaha/pentadbiran/kehadiran_keseluruhan.php");
    }
   

//Sidebar - Pengurusan Surat
    elseif ($action=="minitmensyuarat"){
        include ("setiausaha/pentadbiran/minit_mensyuarat.php");
    }
    elseif ($action=="laporanaktiviti"){
        include ("setiausaha/pentadbiran/laporanaktiviti.php");
    }
  
    elseif ($action=="suratnotis"){
        include("setiausaha/pentadbiran/surat_notis.php");
    }


//Sidebar - Kewangan
    elseif ($action=="bukutunai"){
        include ("setiausaha/pentadbiran/bukuTunai.php");
    }
    elseif ($action=="penyata"){
        include ("setiausaha/pentadbiran/laporan.php");
    }
  
    elseif ($action=="laporanpendapatan"){
        include("setiausaha/pentadbiran/laporan_pendapatan.php");
    }

    elseif ($action=="penyata2018"){
        include("setiausaha/pentadbiran/laporan_pendapatan2018.php");
    }

    elseif ($action=="dashboard_terimabayaran"){
        include("setiausaha/pentadbiran/dashboard_terimabayaran.php");
    }



//Sidebar - Selenggara
    elseif ($action=="selenggara"){
        include ("setiausaha/pentadbiran/selenggara.php");
    }
    elseif ($action=="maklumatselenggara"){
        include ("setiausaha/pentadbiran/maklumat_selenggara.php");
    }
  
    elseif ($action=="kerosakan"){
        include("setiausaha/pentadbiran/kerosakan.php");
    }

    elseif ($action=="maklumatkerosakan"){
        include("setiausaha/pentadbiran/maklumat_kerosakan.php");
    }

//Sideabr - Selenggara - Utiliti
    elseif ($action=="utiliti"){
        include("setiausaha/pentadbiran/utiliti.php");
    }

    elseif ($action=="maklumatutiliti"){
        include("setiausaha/pentadbiran/maklumat_utiliti.php");
    }


//Sideabr - Selenggara - Sewa
    elseif ($action=="sewa"){
        include("setiausaha/pentadbiran/sewa.php");
    }

    elseif ($action=="maklumatsewa"){
        include("setiausaha/pentadbiran/maklumat_sewa.php");
    }


//Sideabr - Selenggara - Inventori
    elseif ($action=="inventori"){
        include("setiausaha/pentadbiran/inventori.php");
    }

    elseif ($action=="maklumatinventori"){
        include("setiausaha/pentadbiran/maklumat_inventori.php");
    }


//Sideabr - Carta Organisasi
    elseif ($action=="dashboard_tetapan"){
        include("setiausaha/tetapan/dashboard_tetapan.php");
    }

//Sideabr - Aduan Awam
    elseif ($action=="aduan"){
        include("setiausaha/aduan/aduan.php");
    }

//Sideabr - Solat Jumaaat
    elseif ($action=="solatjumaat"){
        include("setiausaha/laporan/solat_jumaat.php");
    }


//Sideabr - Carian Pantas
    elseif ($action=="carian"){
        include("setiausaha/carian/carian.php");
    }


//Sideabr - Komuniti
    elseif ($action=="komuniti"){
        include("setiausaha/info/komuniti.php");
    }

    elseif ($action=="hebahan"){
        include("setiausaha/info/hebahan.php");
    }










//viewing for bendahari page
}elseif ($view=="bendahari"){

//Sidebar - Dashboard
    if ($action=="dashboard"){
        include ("bendahari/dashboard.php");
    }

//Sidebar - Pendaftaran
    elseif ($action=="pendaftaran"){
        include ("bendahari/pendaftaran/pendaftaran_dashboard.php");
    }
    elseif ($action=="pendaftaran_ahli_qariah"){
        include ("bendahari/pendaftaran/daftar_qariah.php");
    }


//Sidebar - Kehadiran
    elseif ($action=="kehadiran"){
        include ("bendahari/pentadbiran/kehadiran_keseluruhan.php");
    }
   

//Sidebar - Pengurusan Surat
    elseif ($action=="minitmensyuarat"){
        include ("bendahari/pentadbiran/minit_mensyuarat.php");
    }
    elseif ($action=="laporanaktiviti"){
        include ("bendahari/pentadbiran/laporanaktiviti.php");
    }
  
    elseif ($action=="suratnotis"){
        include("bendahari/pentadbiran/surat_notis.php");
    }


//Sidebar - Kewangan
    elseif ($action=="bukutunai"){
        include ("bendahari/pentadbiran/bukuTunai.php");
    }
    elseif ($action=="penyata"){
        include ("bendahari/pentadbiran/laporan.php");
    }
  
    elseif ($action=="laporanpendapatan"){
        include("bendahari/pentadbiran/laporan_pendapatan.php");
    }

    elseif ($action=="penyata2018"){
        include("bendahari/pentadbiran/laporan_pendapatan2018.php");
    }

    elseif ($action=="dashboard_terimabayaran"){
        include("bendahari/pentadbiran/dashboard_terimabayaran.php");
    }



//Sidebar - Selenggara
    elseif ($action=="selenggara"){
        include ("bendahari/pentadbiran/selenggara.php");
    }
    elseif ($action=="maklumatselenggara"){
        include ("bendahari/pentadbiran/maklumat_selenggara.php");
    }
  
    elseif ($action=="kerosakan"){
        include("bendahari/pentadbiran/kerosakan.php");
    }

    elseif ($action=="maklumatkerosakan"){
        include("bendahari/pentadbiran/maklumat_kerosakan.php");
    }

//Sideabr - Selenggara - Utiliti
    elseif ($action=="utiliti"){
        include("bendahari/pentadbiran/utiliti.php");
    }

    elseif ($action=="maklumatutiliti"){
        include("bendahari/pentadbiran/maklumat_utiliti.php");
    }


//Sideabr - Selenggara - Sewa
    elseif ($action=="sewa"){
        include("bendahari/pentadbiran/sewa.php");
    }

    elseif ($action=="maklumatsewa"){
        include("bendahari/pentadbiran/maklumat_sewa.php");
    }


//Sideabr - Selenggara - Inventori
    elseif ($action=="inventori"){
        include("bendahari/pentadbiran/inventori.php");
    }

    elseif ($action=="maklumatinventori"){
        include("bendahari/pentadbiran/maklumat_inventori.php");
    }


//Sideabr - Carta Organisasi
    elseif ($action=="dashboard_tetapan"){
        include("bendahari/tetapan/dashboard_tetapan.php");
    }

//Sideabr - Aduan Awam
    elseif ($action=="aduan"){
        include("bendahari/aduan/aduan.php");
    }

//Sideabr - Solat Jumaaat
    elseif ($action=="solatjumaat"){
        include("bendahari/laporan/solat_jumaat.php");
    }


//Sideabr - Carian Pantas
    elseif ($action=="carian"){
        include("bendahari/carian/carian.php");
    }


//Sideabr - Komuniti
    elseif ($action=="komuniti"){
        include("bendahari/info/komuniti.php");
    }

    elseif ($action=="hebahan"){
        include("bendahari/info/hebahan.php");
    }
















//viewing for ajk page
}elseif ($view=="ajk"){

//Sidebar - Dashboard
    if ($action=="dashboard"){
        include ("ajk/dashboard.php");
    }

//Sidebar - Pendaftaran
    elseif ($action=="pendaftaran"){
        include ("ajk/pendaftaran/pendaftaran_dashboard.php");
    }
    elseif ($action=="pendaftaran_ahli_qariah"){
        include ("ajk/pendaftaran/daftar_qariah.php");
    }


//Sidebar - Kehadiran
    elseif ($action=="kehadiran"){
        include ("ajk/pentadbiran/kehadiran_keseluruhan.php");
    }
   

//Sidebar - Pengurusan Surat
    elseif ($action=="minitmensyuarat"){
        include ("ajk/pentadbiran/minit_mensyuarat.php");
    }
    elseif ($action=="laporanaktiviti"){
        include ("ajk/pentadbiran/laporanaktiviti.php");
    }
  
    elseif ($action=="suratnotis"){
        include("ajk/pentadbiran/surat_notis.php");
    }


//Sidebar - Kewangan
    elseif ($action=="bukutunai"){
        include ("ajk/pentadbiran/bukuTunai.php");
    }
    elseif ($action=="penyata"){
        include ("ajk/pentadbiran/laporan.php");
    }
  
    elseif ($action=="laporanpendapatan"){
        include("ajk/pentadbiran/laporan_pendapatan.php");
    }

    elseif ($action=="penyata2018"){
        include("ajk/pentadbiran/laporan_pendapatan2018.php");
    }

    elseif ($action=="dashboard_terimabayaran"){
        include("ajk/pentadbiran/dashboard_terimabayaran.php");
    }



//Sidebar - Selenggara
    elseif ($action=="selenggara"){
        include ("ajk/pentadbiran/selenggara.php");
    }
    elseif ($action=="maklumatselenggara"){
        include ("ajk/pentadbiran/maklumat_selenggara.php");
    }
  
    elseif ($action=="kerosakan"){
        include("ajk/pentadbiran/kerosakan.php");
    }

    elseif ($action=="maklumatkerosakan"){
        include("ajk/pentadbiran/maklumat_kerosakan.php");
    }

//Sideabr - Selenggara - Utiliti
    elseif ($action=="utiliti"){
        include("ajk/pentadbiran/utiliti.php");
    }

    elseif ($action=="maklumatutiliti"){
        include("ajk/pentadbiran/maklumat_utiliti.php");
    }


//Sideabr - Selenggara - Sewa
    elseif ($action=="sewa"){
        include("ajk/pentadbiran/sewa.php");
    }

    elseif ($action=="maklumatsewa"){
        include("ajk/pentadbiran/maklumat_sewa.php");
    }


//Sideabr - Selenggara - Inventori
    elseif ($action=="inventori"){
        include("ajk/pentadbiran/inventori.php");
    }

    elseif ($action=="maklumatinventori"){
        include("ajk/pentadbiran/maklumat_inventori.php");
    }


//Sideabr - Carta Organisasi
    elseif ($action=="dashboard_tetapan"){
        include("ajk/tetapan/dashboard_tetapan.php");
    }

//Sideabr - Aduan Awam
    elseif ($action=="aduan"){
        include("ajk/aduan/aduan.php");
    }

//Sideabr - Solat Jumaaat
    elseif ($action=="solatjumaat"){
        include("ajk/laporan/solat_jumaat.php");
    }


//Sideabr - Carian Pantas
    elseif ($action=="carian"){
        include("ajk/carian/carian.php");
    }


//Sideabr - Komuniti
    elseif ($action=="komuniti"){
        include("ajk/info/komuniti.php");
    }

    elseif ($action=="hebahan"){
        include("ajk/info/hebahan.php");
    }










//viewing for pegawai_khas page
}elseif ($view=="pegawai_khas"){

//Sidebar - Dashboard
    if ($action=="dashboard"){
        include ("pegawai_khas/dashboard.php");
    }

//Sidebar - Pendaftaran
    elseif ($action=="pendaftaran"){
        include ("pegawai_khas/pendaftaran/pendaftaran_dashboard.php");
    }
    elseif ($action=="pendaftaran_ahli_qariah"){
        include ("pegawai_khas/pendaftaran/daftar_qariah.php");
    }


//Sidebar - Kehadiran
    elseif ($action=="kehadiran"){
        include ("pegawai_khas/pentadbiran/kehadiran_keseluruhan.php");
    }
   

//Sidebar - Pengurusan Surat
    elseif ($action=="minitmensyuarat"){
        include ("pegawai_khas/pentadbiran/minit_mensyuarat.php");
    }
    elseif ($action=="laporanaktiviti"){
        include ("pegawai_khas/pentadbiran/laporanaktiviti.php");
    }
  
    elseif ($action=="suratnotis"){
        include("pegawai_khas/pentadbiran/surat_notis.php");
    }


//Sidebar - Kewangan
    elseif ($action=="bukutunai"){
        include ("pegawai_khas/pentadbiran/bukuTunai.php");
    }
    elseif ($action=="penyata"){
        include ("pegawai_khas/pentadbiran/laporan.php");
    }
  
    elseif ($action=="laporanpendapatan"){
        include("pegawai_khas/pentadbiran/laporan_pendapatan.php");
    }

    elseif ($action=="penyata2018"){
        include("pegawai_khas/pentadbiran/laporan_pendapatan2018.php");
    }

    elseif ($action=="dashboard_terimabayaran"){
        include("pegawai_khas/pentadbiran/dashboard_terimabayaran.php");
    }



//Sidebar - Selenggara
    elseif ($action=="selenggara"){
        include ("pegawai_khas/pentadbiran/selenggara.php");
    }
    elseif ($action=="maklumatselenggara"){
        include ("pegawai_khas/pentadbiran/maklumat_selenggara.php");
    }
  
    elseif ($action=="kerosakan"){
        include("pegawai_khas/pentadbiran/kerosakan.php");
    }

    elseif ($action=="maklumatkerosakan"){
        include("pegawai_khas/pentadbiran/maklumat_kerosakan.php");
    }

//Sideabr - Selenggara - Utiliti
    elseif ($action=="utiliti"){
        include("pegawai_khas/pentadbiran/utiliti.php");
    }

    elseif ($action=="maklumatutiliti"){
        include("pegawai_khas/pentadbiran/maklumat_utiliti.php");
    }


//Sideabr - Selenggara - Sewa
    elseif ($action=="sewa"){
        include("pegawai_khas/pentadbiran/sewa.php");
    }

    elseif ($action=="maklumatsewa"){
        include("pegawai_khas/pentadbiran/maklumat_sewa.php");
    }


//Sideabr - Selenggara - Inventori
    elseif ($action=="inventori"){
        include("pegawai_khas/pentadbiran/inventori.php");
    }

    elseif ($action=="maklumatinventori"){
        include("pegawai_khas/pentadbiran/maklumat_inventori.php");
    }


//Sideabr - Carta Organisasi
    elseif ($action=="dashboard_tetapan"){
        include("pegawai_khas/tetapan/dashboard_tetapan.php");
    }

//Sideabr - Aduan Awam
    elseif ($action=="aduan"){
        include("pegawai_khas/aduan/aduan.php");
    }

//Sideabr - Solat Jumaaat
    elseif ($action=="solatjumaat"){
        include("pegawai_khas/laporan/solat_jumaat.php");
    }


//Sideabr - Carian Pantas
    elseif ($action=="carian"){
        include("pegawai_khas/carian/carian.php");
    }


//Sideabr - Komuniti
    elseif ($action=="komuniti"){
        include("pegawai_khas/info/komuniti.php");
    }

    elseif ($action=="hebahan"){
        include("pegawai_khas/info/hebahan.php");
    }

}
?>



        <!--END MENU SECTION -->

        <!-- Page Content -->
        
          <?php /*
        $view = $_GET["view"];

         if ($view=="home")
        {
          include("home/dashboard.php");
        }
		 elseif ($view=="dashboard")   //Dashboard
        {
          include("home/dashboard.php");
		}
         elseif ($view=="pendaftaran")   //DAFTAR QARIAH
        {
          include("pendaftaran/pendaftaran_dashboard.php");
		}
        elseif ($view=="pendaftaran_ahli_qariah")   //DAFTAR QARIAH
        {
          include("pendaftaran/daftar_qariah.php");
        }
		  elseif ($view=="view_ahliqariah")   // VIEW DAFTAR QARIAH
        {
          include("pendaftaran/view_ahliqariah.php");
        }
		elseif ($view=="edit_ahliqariah")   // EDIT DAFTAR QARIAH
        {
          include("pendaftaran/edit_ahliqariah.php");
        }
		elseif ($view=="form_online")   // DAFTAR QARIAH ONLINE
        {
          include("pendaftaran/form_online.php");
        }
		
       
      
        }
		elseif ($view=="daftar_khairat")   //PENDAFTARAN KHAIRAT
        {
          include("pendaftaran/daftar_khairat.php");
        }
		elseif ($view=="butiran_khairat")   // BUTIRAN KHAIRAT
        {
          include("pendaftaran/butiran_khairat.php");
        }
			elseif ($view=="senarai_khairat")   // SENARAI KHAIRAT
        {
          include("pendaftaran/senarai_khairat.php");
        }
		elseif ($view=="semak_khairat")   // SEMAK KHAIRAT
        {
          include("pendaftaran/semak_khairat.php");
        }
         elseif ($view=="pendaftaran_zakat")   //DAFTAR ZAKAT
        {
          include("pendaftaran/daftar_zakat.php");
        }
		 elseif ($view=="pemohonan_zakat")   //PEMOHONAN DAFTAR ZAKAT
        {
          include("pendaftaran/pemohonan_zakat.php");
        }
		elseif ($view=="butiran_zakat")   //BUTIRAN ZAKAT
        {
          include("pendaftaran/butiran_zakat.php");
        }
		elseif ($view=="senarai_zakat")   //SENARAI ZAKAT
        {
          include("pendaftaran/senarai_pemohonzakat.php");
        }
        
        
         elseif ($view=="pendaftaran_nikah")   //DAFTAR NIKAH
        {
          include("pendaftaran/daftar_nikah.php");
        }


        elseif ($view=="pendaftaran_cerai")   //DAFTAR CERAI
        {
          include("pendaftaran/daftar_cerai.php");
        }


        elseif ($view=="pendaftaran_ibu_tunggal")   //DAFTAR IBU TUNGGAL
        {
          include("pendaftaran/daftar_ibu_tunggal.php");
        }
          elseif ($view=="senarai_ibutunggal")   //SENARAI IBU TUNGGAL
        {
          include("pendaftaran/senarai_ibutunggal.php");
        }
		
		 elseif ($view=="semak_ibutunggal")   //SEMAK IBU TUNGGAL
        {
          include("pendaftaran/semak_ibutunggal.php");
        }

        elseif ($view=="pendaftaran_sakit_kronik")   //DAFTAR SAKIT KRONIK
        {
          include("pendaftaran/daftar_sakit_kronik.php");
        }
		
		elseif ($view=="butiran_sakit")   //BUTIRAN SAKIT KRONIK
        {
          include("pendaftaran/butiran_sakit.php");
        }
		
		elseif ($view=="semak_sakit")   //SEMAK SAKIT KRONIK
        {
          include("pendaftaran/semak_sakit.php");
        }
		elseif ($view=="senarai_sakit")   //SENARAI SAKIT KRONIK
        {
          include("pendaftaran/senarai_sakit.php");
        }

        elseif ($view=="pendaftaran_oku")   //DAFTAR OKU
        {
          include("pendaftaran/daftar_oku.php");
        }
		
		 elseif ($view=="senarai_oku")   //SENARAI OKU
        {
          include("pendaftaran/senarai_oku.php");
        }
		 elseif ($view=="semak_oku")   //SEMAK OKU
        {
          include("pendaftaran/semak_oku.php");
        }
		
		elseif ($view=="butiran_oku")   //BUTIRAN OKU
        {
          include("pendaftaran/butiran_oku.php");
        }
 		elseif ($view=="pendaftaran_qairat")   
        {
          include("pendaftaran/pakatan_qairat.php");
        }
        elseif ($view=="daftar_warga_emas")   //DAFTAR WARGA EMAS
        {
          include("pendaftaran/daftar_warga_emas.php");
		}
		 elseif ($view=="senarai_wargaemas")   //SENARAI WARGA EMAS
        {
          include("pendaftaran/senarai_wargaemas.php");
		}
		 elseif ($view=="semak_wargaemas")   //SEMAK WARGA EMAS
        {
          include("pendaftaran/semak_wargaemas.php");
		}
		  elseif ($view=="pendaftaran_pejabatagama")   //PEJABAT AGAMA
        {
          include("pendaftaran/dashboard_pejabat_agama.php");

	    }elseif ($view=="laporanaktiviti") {
          include("pentadbiran/laporanaktiviti.php");  
		}elseif ($view=="del_laporanaktiviti") {
          include("pentadbiran/del_laporanaktiviti.php");  //delete laporan_aktiviti  
	    }elseif ($view=="minitmensyuarat") {
          include("pentadbiran/minit_mensyuarat.php");
		}elseif ($view=="del_minitmensyuarat") {
          include("pentadbiran/del_minitmensyuarat.php");  //delete minit_mensyuarat
		}elseif ($view=="suratnotis") {
          include("pentadbiran/surat_notis.php");
	   
	    }elseif ($view=="del_notis") {
          include("pentadbiran/del_notis.php");  //delete notis
		  
		}elseif ($view=="laporanpendapatan") {
          include("pentadbiran/laporan_pendapatan.php");
		}elseif ($view=="penyata2018") {
          include("pentadbiran/laporan_pendapatan2018.php");
		}elseif ($view=="del_penyata2018") {
          include("pentadbiran/del_penyata2018.php");  //delete penyata2018
		  
		  //Pentadbiran_kewangan
        }elseif ($view=="bukutunai") {
          include("pentadbiran/bukuTunai.php"); //buku tunai
		}elseif ($view=="penyata") {
          include("pentadbiran/laporan.php");
		}elseif ($view=="dashboard_terimabayaran") {
          include("pentadbiran/dashboard_terimabayaran.php"); //dashboard terima bayaran
		  
		}elseif ($view=="senarai_pembayar_yurankariah") {
          include("pentadbiran/senarai_pembayar_yurankariah.php"); //senarai_pembayar_yurankariah
		  
		}elseif ($view=="yuran_kariah") {
          include("pentadbiran/yuran_kariah.php"); //yuran kariah
		}elseif ($view=="butirbayaran_kariah") {
          include("pentadbiran/butirbayaran_kariah.php"); //butir bayaran kariah
		}elseif ($view=="terima_bayaran_terperinci") {
          include("pentadbiran/terima_bayaran_terperinci.php"); //terima bayaran terperinci
		  
		 
		}elseif ($view=="yuran_khairat") {
          include("pentadbiran/yuran_khairat.php"); //yuran khairat 
		}elseif ($view=="butirbayaran_khariat") {
          include("pentadbiran/butirbayaran_khariat.php"); //butir bayaran khairat
		}elseif ($view=="terima_bayarankhairat_terperinci") {
          include("pentadbiran/terima_bayarankhairat_terperinci.php"); //terima bayarankhairat terperinci 
	    }elseif ($view=="senarai_pembayar_yurankhariat") {
          include("pentadbiran/senarai_pembayar_yurankhariat.php"); //senarai_pembayar_yurankhariat 
		  
		  
		}elseif ($view=="zakat") {
          include("pentadbiran/zakat.php"); //zakat
	   	}elseif ($view=="zakat") {
          include("pentadbiran/zakat.php"); //wakaf
		
		  
		  
		  
		  
		}elseif ($view=="terimabayaran") {
          include("pentadbiran/terima_bayaran.php"); //terima bayaran
		  
		  
		  
	    }elseif ($view=="selenggara") {
          include("pentadbiran/selenggara.php");
		}elseif ($view=="maklumatselenggara") {       
          include("pentadbiran/maklumat_selenggara.php");   //selenggara
		}elseif ($view=="semak_selenggara") {       
          include("pentadbiran/semak_selenggara.php");   //semak selenggara 
		}elseif ($view=="kerosakan") {
          include("pentadbiran/kerosakan.php");     //kerosakan
		}elseif ($view=="maklumatkerosakan") {
          include("pentadbiran/maklumat_kerosakan.php");  
		}elseif ($view=="semak_kerosakan") {    //semak kerosakkan
          include("pentadbiran/semak_kerosakan.php");   
		}elseif ($view=="sewa") {
          include("pentadbiran/sewa.php");
		}elseif ($view=="maklumatsewa") {
          include("pentadbiran/maklumat_sewa.php");
	    }elseif ($view=="inventori") {
          include("pentadbiran/inventori.php");
		}elseif ($view=="maklumatinventori") {
          include("pentadbiran/maklumat_inventori.php");
		}elseif ($view=="utiliti") {
          include("pentadbiran/utiliti.php");   //utiliti
		}elseif ($view=="maklumatutiliti") {
          include("pentadbiran/maklumat_utiliti.php"); //maklumat utiliti
		}elseif ($view=="semak_utiliti") {
          include("pentadbiran/semak_utiliti.php");    //semak utiliti
		 }elseif ($view=="kehadiran") {
          include("pentadbiran/kehadiran_keseluruhan.php");
		  
		 }elseif ($view=="kehadiranterperinci") {
          include("pentadbiran/kehadiran_terperinci.php");  //kehadiran terperinci

		 }elseif ($view=="susut_nilai") {
          include("pentadbiran/susut_nilai.php");  //susut nilai

		 }elseif ($view=="jadual") {
          include("pentadbiran/jadual_ajkmasjid.php");  
		  
		}elseif ($view=="aduan") {
          include("aduan/aduan.php");
		}elseif ($view=="komuniti") {
          include("info/komuniti.php");
		}elseif ($view=="kafa") {    //kafa
          include("info/kafa.php");
		}elseif ($view=="semak_kafa") {  //semak_kafa
          include("info/semak_kafa.php");
		}elseif ($view=="kemas") {
          include("info/kemas.php");
		}elseif ($view=="semak_kemas") {  //semak_kemas
          include("info/semak_kemas.php");
		}elseif ($view=="sekolah") {
          include("info/sekolah.php");
		}elseif ($view=="semak_sekolah") {
          include("info/semak_sekolah.php"); //semak sekolah
		}elseif ($view=="pasti") {
          include("info/pasti.php");
		}elseif ($view=="semak_pasti") {
          include("info/semak_pasti.php"); //semak pasti  
		}elseif ($view=="rukuntetangga") {
          include("info/rukuntetangga.php");
		}elseif ($view=="semak_rukuntetangga") {
          include("info/semak_rukuntetangga.php"); //semak rukun tetangga  
		}elseif ($view=="belia") {
          include("info/belia.php");
		}elseif ($view=="semak_belia") {
          include("info/semak_belia.php"); //semak belia 
		}elseif ($view=="balai") {
          include("info/balai.php");
		}elseif ($view=="semak_balai") {
          include("info/semak_balai.php"); //semak balai 
		}elseif ($view=="persatuan") {
          include("info/persatuan.php");
		}elseif ($view=="semak_persatuan") {
          include("info/semak_persatuan.php"); //semak persatuan 
		  
		}elseif ($view=="surau") {             //Surau
          include("info/surau.php");
		}elseif ($view=="semak_surau") {             //SEmak Surau
          include("info/semak_surau.php");
		}elseif ($view=="kemaskini_surau") {   //Kemaskini surau
          include("info/kemaskini_surau.php");
		}
		elseif ($view=="klinik") {
          include("info/klinik.php");
			}elseif ($view=="semak_klinik") {             //SEmak klinik
          include("info/semak_klinik.php");
		}elseif ($view=="hebahan") {
          include("info/hebahan.php");
		}elseif ($view=="rumahibadat") {
          include("info/rumah_ibadat.php");
		}elseif ($view=="semak_rumahibadat") {             //SEmak rumah ibadat
          include("info/semak_rumahibadat.php");
		  
		//TETAPAN
		  
	    }elseif ($view=="ajkmasjid") {
          include("tetapan/ajk_masjid.php");
		}elseif ($view=="dashboard_tetapan") {
          include("tetapan/dashboard_tetapan.php");
		}elseif ($view=="daftar_ajk") {                    //Daftar AJK
          include("tetapan/daftar_ajk.php");
		}elseif ($view=="senarai_ajk") {
          include("tetapan/senarai_ajk.php");
		}elseif ($view=="daftar_pegawai") {
          include("tetapan/daftar_pegawai.php");         	//Daftar Pegawai
		}elseif ($view=="senarai_pegawai") {
          include("tetapan/senarai_pegawai.php");
		}elseif ($view=="butiran_jawatanajk") {              //Butiran Jawatan AJK
          include("tetapan/butiran_jawatanajk.php");
		}elseif ($view=="semak_ajk") {              //Butiran Jawatan AJK
          include("tetapan/semak_ajk.php");
		}elseif ($view=="gambar_ajk") {              //Gambar Jawatan AJK
          include("tetapan/gambar_ajk.php");
		}elseif ($view=="butiran_jawatanpegawai") {              //Butiran Jawatan Pegawai
          include("tetapan/butiran_jawatanpegawai.php");
		}elseif ($view=="semak_pegawai") {              //Butiran Jawatan Pegawai
          include("tetapan/semak_pegawai.php");
		}elseif ($view=="gambar_pegawai") {              //Gambar Jawatan Pegawai
          include("tetapan/gambar_pegawai.php");
		}

        //SEWA
		elseif ($view=="tempahan_baru") 
        {
          include("pentadbiran/tempahan_baru.php");
        }
        elseif ($view=="tempahan_belum_bayar") 
        {
          include("pentadbiran/tempahan_belum_bayar.php");
        }
        elseif ($view=="tempahan_dibayar") 
        {
          include("pentadbiran/tempahan_dibayar.php");
        }
       elseif ($view=="tambah_fasiliti") 
        {
          include("pentadbiran/tambah_fasiliti.php");
        }
        elseif ($view=="borang_sewa") 
        {
          include("pentadbiran/borang_sewa.php");
        }



		 //REPORTS


         elseif  ($view=="laporan")
        {
          include("laporan/laporan_dashboard.php");
        }


        elseif ($view=="tabung_bergerak")   //PENYATA TABUNG BERGERAK
        {
          include("pentadbiran/tabungBergerak.php");
        }

        elseif ($view=="tabung_am")   //7. PENYATA TABUNG AM
        {
          include("pentadbiran/tabungAm.php");
        }

        elseif ($view=="tabung_kebajikan")   //8. PENYATA KEBAJIKAN
        {
          include("pentadbiran/tabungKebajikan.php");
        }

        elseif ($view=="tabung_kematian")   //PENYATA TABUNG KEMATIAN
        {
          include("pentadbiran/tabungKematian.php");
        }

        elseif ($view=="tabung_kenduri")    //PENYATA TABUNG KENDURI
        {
          include("pentadbiran/tabungKenduri.php");
        }

        elseif ($view=="tabung_wakaf")   //PENYATA TABUNG WAKAF
        {
          include("pentadbiran/tabungWakaf.php");
        }

        elseif ($view=="tlk_wakaf_kubur")   //6. PENYATA WAKAF KUBUR
        {
          include("pentadbiran/tlk_wakaf_kubur.php");
        }

        elseif ($view=="tlk_wakaf_masjid")   //5.PENYATA WAKAF MASJID
        {
          include("pentadbiran/tlk_wakaf_masjid.php");
		  
         }elseif ($view=="solatjumaat") {
          include("laporan/solat_jumaat.php");
		  
		 }elseif ($view=="pengurusanjenazah") {
          include("laporan/penyata_perbelanjaan.php");
		  
		  }elseif ($view=="carian") {
          include("carian/carian.php");



}
  */   ?>




        </div>
        <!-- /#page-wrapper -->
</nav>

    </div>
    <!-- /#wrapper -->

   
 
</body>

</html>

 