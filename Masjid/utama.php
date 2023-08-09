<?php
error_reporting(E_ALL & ~E_NOTICE);
$time_start = microtime(true);
session_start();
$tema_layout = 2;
if($_GET['tema'] != NULL) $tema_layout = $_GET['tema'];
include('connection/connection.php');
include('fungsi.php');
include('fungsi_tarikh.php');
if($_SESSION['id_masjid']=="" OR $_SESSION['id_masjid']==NULL)
{
    header("Location: https://masjidpro.com/Masjid/login.php");
}
if($_GET['training'] == 1) $training = 2;
else $training = 1;
if(isset($_GET['data']) && $_GET['data'] == 'raw') {
    $strPage = str_replace('?','', $_SERVER['REQUEST_URI']);
    $strPage = str_replace($_SERVER['QUERY_STRING'],'', $strPage);
    $strPage = explode("/", $strPage);
    if($_GET['action'] == 'lihat_fail') include("lihat_fail.php");
    include("search.php");
    if($_GET['action'] == 'kewangan') {
        if($_GET['newModul'] != 1) {
            include("view_kewangan.php");
            include("kewangan_ajax_page.php");
        }
        else {
            include("accounts/requests.php");
            if($_GET['training'] == 1) $training = 2;
            else $training = 1;
            if(file_exists("accounts/controllers/sub_".$_GET['subModul'].".php")) include ("accounts/controllers/sub_".$_GET['subModul'].".php");
            if(file_exists("accounts/ajax/sub_".$_GET['subModul'].".php")) include ("accounts/ajax/sub_".$_GET['subModul'].".php");
        }
    }
    if($_GET['action'] == 'daftar_solat_senarai') include("admin/daftar_solat_senarai.php");
    if($_GET['action'] == 'daftar_khairat') include("khairat_ajax_page.php");
    if($_GET['action'] == 'pendaftaran' || $_GET['action'] == 'pendaftaranKematian') include("pendaftaran_ajax_page.php");
    if($_GET['action'] == 'qrcode') include("qrcode.php");
}

if($_GET['data'] != 'raw') {
    if($_GET['action'] == "kewangan" && $_GET['newModul'] == 1) {
        include("accounts/requests.php");
        if(file_exists("accounts/controllers/sub_".$_GET['subModul'].".php")) include ("accounts/controllers/sub_".$_GET['subModul'].".php");
    }
    ?>
<!DOCTYPE html>
    <?php if($tema_layout == 1) { ?>
        <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
        <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
        <!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
        <!--[if gt IE 8]><!-->
        <html class="no-js" lang="en">
        <!--<![endif]-->
    <?php } ?>
    <?php if($tema_layout == 2) { ?><html lang="en"><?php } ?>
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
    <title><?php echo $_SERVER['SERVER_NAME'] == "sistem.gomasjid.my" ? 'GoMasjid' : 'Masjid Pro'; ?> - <?php echo $_SESSION['nama_masjid']; ?></title>
    <meta name="description" content="<?php echo $_SERVER['SERVER_NAME'] == "sistem.gomasjid.my" ? 'GoMasjid' : 'Masjid Pro'; ?> - Merevolusikan Institusi Masjid Dengan IR 4.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="images/logo2.png">
    <link rel="shortcut icon" href="images/logo2.png">
    <?php if($tema_layout == 1) { ?>
        <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
        <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">

        <link rel="stylesheet" href="vendors/chosen/chosen.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel='stylesheet' type='text/css'>
    <?php } ?>
    <script src="js/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
        } );
    </script>
    <?php //if($_GET['action'] == 'kewangan' || $_GET['action'] == 'pendaftaran') { ?>
    <?php if($tema_layout == 1) { ?>
        <link rel="stylesheet" type="text/css" href="vendors/datatable/datatables.css">
    <?php } ?>
    <?php if($tema_layout == 2) { ?>
        <!--link rel="stylesheet" type="text/css" href="vendors/datatable/datatables.css"-->
        <link rel="stylesheet" type="text/css" href="themes/elite/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
        <link rel="stylesheet" type="text/css" href="themes/elite/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <?php } ?>
    <?php //} ?>
    <?php if($tema_layout == 1) { ?>
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/b5589dbb40.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="js/jquery-ui.css" />
    <?php } ?>
    <?php include("loader.php"); ?>
    <style type="text/css">
        #meja_akaun_filter input {
            background-color: white;
        }
    </style>
    <?php if($tema_layout == 1) { ?>
</head>
<body>
    <!-- Left Panel -->
<?php
//include('sidebar/sidebar_admin.php');
?>
    <!-- Left Panel -->

    <!-- Right Panel -->
<div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header">
        <div class="header-menu">
            <div class="col-sm-7">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                <div class="header-left">
                    <?php echo $_SESSION['nama_masjid']; ?>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar"> -->
                        <i class="fa fa-cog"></i>
                    </a>

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>

                        <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php } ?>
    <?php
    if($_GET['action']=="bantuan" OR $_GET['action']=="approve_qariah")
    {
        ?>
        <link href="themes/elite/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<!--        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>-->
        <link href="themes/elite/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
        <?php
    }
    ?>
    <?php if($tema_layout == 2) include("theme_2.php"); ?>
    <?php if($_GET['module'] != 'add_ahli') { ?>
        <!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script-->
        <script src="vendors/jquery/dist/jquery.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="vendors/chosen/chosen.jquery.min.js"></script>
    <?php if($_GET['action'] != 'minitmesyuarat') { ?>
        <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <?php if($tema_layout == 1) { ?>
        <script src="assets/js/dashboard.js"></script>
        <script src="assets/js/widgets.js"></script>
    <?php } ?>
        <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
        <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <?php } ?>
        <script id="pilih_tarikh" src="js/jquery-ui.js"></script>
    <?php } ?>
    <?php //if($_GET['action'] == 'kewangan' || $_GET['action'] == 'pendaftaran') { ?>
    <script src="vendors/datatable/datatables.js"></script>
    <?php //} ?>
    <?php if($_GET['action'] != 'kewangan' && $_GET['action'] != 'pendaftaran') { ?>
        <!--script src="vendors/datatables.net/js/jquery.dataTables.js"></script>
        <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="vendors/jszip/dist/jszip.min.js"></script>
        <script src="vendors/pdfmake/build/pdfmake.js"></script>
        <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.js" integrity="sha256-dgFbqbQVzjkZPQxWd8PBtzGiRBhChc4I2wO/q/s+Xeo=" crossorigin="anonymous"></script-->
    <?php } ?>
    <!-- /header -->
    <!-- Header-->
    <?php
    if(isset($_GET['view'])){
        $view=$_GET['view'];
    }
    else{
        $view="";
    }

    if(isset($_GET['action'])){
        $action=$_GET['action'];
    }else{
        $action="";
    }

    if($view=="admin")
    {
        //Sidebar - Dashboard
        if ($action=="dashboard")
        {
            include ("admin/dashboard.php");
        }
        else if($action=="utama")
        {
            include ("menu_utama.php");
        }
        else if($action=="dashboard_payment")
        {
            include ("admin/dashboard_payment.php");
        }
        else if($action=="senarai_bayaran")
        {
            include ("admin/senarai_bayaran.php");
        }
        else if($action=="dashboard_bantuan")
        {
            include ("admin/dashboard_bantuan.php");
        }

        else if($action=="testExcel")
        {
            include("testExcel.php");
        }

        //Menu-Menu
        else if($action=="menu_pengurusanMasjid"){
            include("admin/menu_pengurusanMasjid.php");
        }
        else if($action=="menu_pengurusanKariah"){
            include("admin/menu_pengurusanKariah.php");
        }
        else if($action=="menu_organisasi"){
            include("admin/menu_organisasi.php");
        }
        else if($action=="menu_infaqWakaf"){
            include("admin/menu_infaqWakaf.php");
        }

        //Sidebar - Pendaftaran
        elseif ($action=="pendaftaran") //PENDAFTARAN MODUL KARIAH
        {
            include ("admin/pendaftaran_ajax.php");
        }
        elseif ($action=="pendaftaranKematian") //PENDAFTARAN MODUL KEMATIAN
        {
            include ("admin/pendaftaran_mati.php");
        }
        else if($action=="uploadDaftar") // UPLOAD PENDAFTARAN EXCEL
        {
            include ("admin/uploadDaftar.php");
        }
        elseif ($action=="pendaftaran_ahli_qariah")
        {
            include ("admin/daftar_qariah.php");
        }
        elseif ($action=="daftar_anakqariah")
        {
            include ("admin/daftar_anakqariah.php");
        }
        elseif ($action=="view_ahliqariah")   // VIEW DAFTAR QARIAH
        {
            include ("admin/view_ahliqariah.php");
        }
        elseif ($action=="view_anakqariah")   //VIEW DAFTAR ANAK QARIAH
        {
            include ("admin/view_anakqariah.php");
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


        elseif ($action=="pendaftaran_nikah")   //DAFTAR NIKAH
        {
            include("admin/daftar_nikah.php");
        }


        elseif ($action=="pendaftaran_cerai")   //DAFTAR CERAI
        {
            include("admin/daftar_cerai.php");
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


            //Approve Ahli QARIAH
        }
        elseif ($action=="approve_qariah") //KELULUSAN QARIAH
        {
            include("admin/approve_qariah.php");
        }
        else if($action=="approve_bantuan") { //KELULUSAN BANTUAN
            include("admin/approve_bantuan.php");
        }
        else if($action=="approve_praktikal"){
            include("admin/approve_praktikal.php");
        }
        else if($action=="approve_temujanji"){ //KELULUSAN TEMUJANJI
            include("admin/approve_temujanji.php");
        }
        else if($action=="approve_kematian"){ //KELULUSAN KEMATIAN
            include("admin/approve_kematian.php");
        }

        //Pentadbiran_kewangan

        elseif ($action=="bukutunai") {
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
        else if($action=="kehadiran_bulanan"){
            include("admin/kehadiran_bulanan.php");
        }
        elseif ($action=="jadualkehadiran") {
            include("admin/jadual_kehadiran.php");
        }
        elseif ($action=="jadualterperinci") {
            include("admin/jadual_terperinci.php");
        }
        else if($action=="kehadiran_pengurusan"){
            include("admin/kehadiran_keseluruhan_pengurusan.php");
        }
        else if($action=="kehadiranterperincipengurusan"){
            include("admin/kehadiran_terperinci_pengurusan.php");
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
        elseif ($action=="kehadiran"){
            include ("admin/pentadbiran/kehadiran_keseluruhan.php");
        }


        //Sidebar - Pengurusan Surat
        elseif ($action=="minitmesyuarat"){
            include ("admin/minit_mesyuarat.php");
        }
        elseif ($action=="laporanaktiviti"){
            include ("admin/laporanaktiviti.php");
        }

        elseif ($action=="suratnotis"){
            include("admin/surat_notis.php");
        }
        else if($action=="surat_rasmi"){
            include("admin/surat_rasmi.php");
        }
        else if($action=="rekod_surat_rasmi"){
            include("admin/rekod_surat_rasmi.php");
        }
        else if($action=="edit_surat_rasmi"){
            include("admin/edit_surat_rasmi.php");
        }
        else if($action=="upload_surat"){
            include("admin/upload_surat.php");
        }
        else if($action=="NewMinitMesyuarat"){
            include("admin/dokumentasi/minit_mesyuarat.php");
        }


        //Sidebar - Kewangan
        else if($action=="kewangan"){
            include ("admin/kewangan.php");
        }
        else if($action=="pelanggan"){
            include ("admin/pelanggan.php");
        }
        else if($action=="jenis_kutipan"){
            include ("admin/jenis_kutipan.php");
        }
        else if($action=="aktiviti"){
            include ("admin/aktiviti.php");
        }
        else if($action=="resit"){
            include("admin/resit.php");
        }
        else if($action=="senarai_resit"){
            include("admin/senarai_resit.php");
        }
        else if($action=="tabung"){
            include ("admin/tabung.php");
        }
        else if($action=="akaun_bank"){
            include ("admin/akaun_bank.php");
        }
        else if($action=="pembekal"){
            include ("admin/pembekal.php");
        }
        else if($action=="jenis_pembayaran"){
            include ("admin/jenis_pembayaran.php");
        }
        else if($action=="baucerbayaran"){
            include ("admin/baucerbayaran.php");
        }
        else if($action=="senarai_baucer"){
            include ("admin/senarai_baucer.php");
        }
        else if($action=="penyata_kewangan"){
            include ("admin/penyata_kewangan.php");
        }
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
        elseif ($action=="bantuan"){
            include("admin/bantuan.php");
        }
        elseif ($action=="rekod_bantuan"){
            include("admin/rekod_bantuan.php");
        }
        else if($action=="wakaf"){
            include("admin/wakaf.php");
        }
        else if($action=="komuniti_ekonomi"){
            include("admin/komuniti_ekonomi.php");
        }
        else if($action=="infaq"){
            include("admin/infaq.php");
        }
        else if($action=="list_infaq"){
            include("admin/list_infaq.php");
        }
        else if($action=="notifikasi"){
            include("admin/notifikasi.php");
        }

        //Sidebar - Zakat
        else if ($action=="zakat"){
            include("admin/zakat.php");
        }

        //INVENTORI
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
        else if($action=="dashboard_selenggara"){
            include ("admin/dashboard_selenggara.php");
        }
        else if($action=="edit_inventori"){
            include ("admin/edit_inventori.php");
        }
        else if($action=="view_inventori"){
            include ("admin/view_inventori.php");
        }
        else if($action=="rekod_inventori"){
            include ("admin/rekod_inventori.php");
        }




        elseif ($action=="view_kerosakan"){
            include("admin/view_kerosakan.php");
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
        elseif ($action=="masih_disewa"){
            include("admin/masih_dalam_sewaan.php");
        }

        elseif ($action=="habis_tempoh"){
            include("admin/sewa_habis_tempoh.php");
        }

        elseif ($action=="sewa_rosak"){
            include("admin/sewa_rosak.php");
        }
        elseif ($action=="detail_sewa_rosak"){
            include("admin/detail_sewa_rosak.php");
        }

        elseif ($action=="detail_masihsewaan")   //detail_masihsewaan
        {
            include("admin/detail_masihsewaan.php");
        }

        //Sideabr - Selenggara - Utiliti
        elseif ($action=="utiliti"){
            include("admin/utiliti.php");
        }

        elseif ($action=="maklumatutiliti"){
            include("admin/maklumat_utiliti.php");
        }
        elseif ($action=="semak_utiliti"){
            include("admin/semak_utiliti.php");
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
        elseif ($action=="susut_nilai"){
            include("admin/susut_nilai.php");
        }


        ///ORGANISASI BARU

        elseif ($action=="semakorganisasi") {                    //semak ic
            include("admin/semak_organisasi.php");
        }
        elseif ($action=="daftarorganisasi") {                    //daftar maklumat organisasi
            include("admin/butiran_organisasi.php");
        }
        elseif ($action=="paparorganisasi") {                    //display maklumat organisasi
            include("admin/papar_organisasi.php");
        }
        elseif ($action=="organisasi_senaraiAJK") {                    //jawatan ajk
            include("admin/organisasi_senaraiAJK.php");
        }
        elseif ($action=="organisasi_senaraiPEGAWAI") {                    //jawatan pegawai
            include("admin/organisasi_senaraiPEGAWAI.php");
        }
        elseif ($action=="organisasi_senaraiPENGURUSAN") {                    //jawatan pengurusan
            include("admin/organisasi_senaraiPENGURUSAN.php");
        }
        elseif ($action=="organisasi_senaraiBIRO") {                    //jawatan biro
            include("admin/organisasi_senaraiBIRO.php");
        }
        elseif ($action=="senaraiJawatankuasa_AJK") {                    //Senarai jawatankuasa AJK
            include("admin/senarai_jawatankuasa_ajk.php");
        }
        elseif ($action=="senaraiJawatankuasa_PEGAWAI") {                    //Senarai jawatankuasa pegawai
            include("admin/senarai_jawatankuasa_pegawai.php");
        }
        elseif ($action=="senaraiJawatankuasa_PENGURUSAN") {                    //Senarai jawatankuasa pengurusan
            include("admin/senarai_jawatankuasa_pengurusan.php");
        }
        elseif ($action=="view_jawatankuasa") {                    //view jawatankuasa pengurusan
            include("admin/view_jawatankuasa.php");
        }
        elseif ($action=="edit_jawatankuasa") {                    //edit jawatankuasa pengurusan
            include("admin/edit_jawatankuasa.php");
        }
        elseif ($action=="organisasi_tetapankehadiran_AJK") {                    //kehadiran tetapan ajk
            include("admin/");
        }
        elseif ($action=="organisasi_tetapankehadiran_PEGAWAI") {                    //kehadiran tetapan pegawai
            include("admin/organisasi_tetapankehadiran_PEGAWAI.php");
        }
        elseif ($action=="organisasi_tetapankehadiran_PENGURUSAN") {                    //kehadiran tetapan pengurusan
            include("admin/organisasi_tetapankehadiran_PENGURUSAN.php");
        }
        elseif ($action=="organisasi_laporan_senaraiAJK") {                    // senarai laporan kehadiran ajk
            include("admin/");
        }
        elseif ($action=="organisasi_laporan_senaraiAJK_individu") {                    //laporan kehadiran ajk individu
            include("admin/");
        }
        elseif ($action=="organisasi_laporan_senaraiAJK_bulanan") {                    //laporan kehadiran ajk bulanan
            include("admin/");
        }
        elseif ($action=="organisasi_laporan_senaraiPEGAWAI") {                    // senarai laporan kehadiran pegawai
            include("admin/organisasi_laporan_senaraiPEGAWAI.php");
        }
        elseif ($action=="organisasi_laporan_senaraiPEGAWAI_individu") {                    //laporan kehadiran pegawai individu
            include("admin/organisasi_laporan_senaraiPEGAWAI_individu.php");
        }
        elseif ($action=="organisasi_laporan_senaraiPEGAWAI_bulanan") {                    //laporan kehadiran pegawai bulanan
            include("admin/organisasi_laporan_senaraiPEGAWAI_bulanan.php");
        }
        elseif ($action=="organisasi_laporan_senaraiPENGURUSAN") {                    //senarai laporan kehadiran pengurusan
            include("admin/organisasi_laporan_senaraiPENGURUSAN.php");
        }
        elseif ($action=="organisasi_laporan_senaraiPENGURUSAN_individu") {                    //laporan kehadiran pengurusan individu
            include("admin/organisasi_laporan_senaraiPENGURUSAN_individu.php");
        }
        elseif ($action=="organisasi_laporan_senaraiPENGURUSAN_bulanan") {                    //laporan kehadiran pengurusan bulanan
            include("admin/organisasi_laporan_senaraiPENGURUSAN_bulanan.php");
        }




        ///Sideabr - Carta Organisasi
        elseif ($action=="dashboard_tetapan"){      //SIDEBAR Organisasi
            include("admin/dashboard_tetapan.php");
        }
        elseif ($action=="daftar_ajk") {                    //Daftar AJK
            include("admin/daftar_ajk.php");
        }
        elseif ($action=="senarai_ajk") {                    //Senarai AJK
            include("admin/senarai_ajk.php");
        }
        elseif ($action=="butiran_jawatanajk") {              //Butiran Jawatan AJK
            include("admin/butiran_jawatanajk.php");
        }
        elseif ($action=="semak_ajk") {              //Semak Jawatan AJK
            include("admin/semak_ajk.php");
        }
        elseif ($action=="daftar_pegawai") {    //Daftar Pegawai
            include("admin/daftar_pegawai.php");
        }
        elseif ($action=="senarai_pegawai") {       //Senarai Pegawai
            include("admin/senarai_pegawai.php");
        }
        elseif ($action=="butiran_jawatanpegawai") {              //Butiran Jawatan Pegawai
            include("admin/butiran_jawatanpegawai.php");
        }
        elseif ($action=="semak_pegawai") {              //Butiran Jawatan Pegawai
            include("admin/semak_pegawai.php");
        }
        elseif ($action=="gambar_pegawai") {              //Gambar Jawatan Pegawai
            include("admin/gambar_pegawai.php");
        }
        else if($action=="daftar_pengurusan"){      //Daftar Pengurusan
            include("admin/daftar_pengurusan.php");
        }
        else if($action=="senarai_pengurusan"){     //Senarai Pengurusan
            include("admin/senarai_pengurusan.php");
        }
        else if($action=="jawatan_pengurusan"){     //Senarai Jawatan Pengurusan
            include("admin/jawatan_pengurusan.php");
        }
        else if($action=="semak_pengurusan"){       //Semak  Pengurusan
            include("admin/semak_pengurusan.php");
        }
        else if($action=="daftar_rekod_organisasi"){       //Daftar rekod organisasi
            include("admin/daftar_rekod_organisasi.php");
        }
        elseif ($action=="butiran_rekod_organisasi") {     //Semak IC
            include("admin/butiran_rekod_organisasi.php");
        }
        elseif ($action=="senarai_rekod") {     //Senarai rekod organisasi
            include("admin/senarai_rekod_organisasi.php");
        }
        elseif ($action=="semak_rekod_organisasi") {     //Display Maklumat Rekod
            include("admin/semak_rekod_organisasi.php");
        }
        elseif ($action=="rekod_tahunan_organisasi_masjid") {     //Display Maklumat Rekod Tahunan
            include("admin/rekod_tahunan_organisasi_masjid.php");
        }
        elseif ($action=="kemaskini_rekod_organisasi") {     //Update Maklumat Jawatan Rekod Organisasi
            include("admin/kemaskini_rekod_organisasi.php");
        }
        elseif ($action=="senarai_ajk") {                    //Senarai AJK
            include("admin/senarai_ajk.php");
        }

        //Sidebar - AKTIVITI
        elseif ($action=="aktivitiMasjid"){
            include("admin/aktivitiMasjid.php");
        }
        elseif ($action=="tambahAktiviti"){
            include("admin/tambah_aktiviti.php");
        }

        //Sideabar - Aduan Awam
        elseif ($action=="aduan"){
            include("admin/aduan.php");
        }

        //Sidebar - Penarafan Masjid
        else if($action=="penarafan_masjid"){
            include("admin/penarafan_masjid.php");
        }

        //Sidebar - Masjid Care
        else if ($action=="care"){
            include("admin/care.php");
        }

        else if($action=="view_care"){
            include("admin/view_care.php");
        }

        else if ($action=="caripantas"){
            include("admin/care_pantas.php");
        }

        else if ($action=="caridetail"){
            include("admin/care_pantas_detail.php");
        }

        //Sidebar - Praktikal
        else if($action=="praktikal"){
            include("admin/praktikal.php");
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

        else if ($action=="pengeluaran"){
            include("admin/pengeluaran.php");
        }



        elseif ($action=="hebahan"){
            include("admin/hebahan.php");
        }



        elseif ($action=="profil"){
            include("admin/profil.php");
        }

        elseif ($action=="pemilihan_jawatankuasa"){
            include("admin/pemilihan_jawatankuasa.php");
        }

        elseif ($action=="senaraiPengundiForm"){
            include("admin/senaraiPengundiForm.php");
        }

        elseif ($action=="info_pemilihan_jawatankuasa"){
            include("admin/info_pemilihan_jawatankuasa.php");
        }

        elseif ($action=="gomasjidpro"){
            if($_GET['page'] != NULL && file_exists("gomasjidpro/".$_GET['page'].".php")) include("gomasjidpro/".$_GET['page'].".php");
            else include("gomasjidpro/index.php");
        }

        elseif ($action=="daftar_solat" && $_SESSION['user_type_id'] != 10){
            include("admin/daftar_solat.php");
        }
        elseif ($action=="daftar_solat_senarai" && $_SESSION['user_type_id'] != 10){
            include("admin/daftar_solat_senarai.php");
        }
        elseif ($action=="daftar_solat_kehadiran" && $_SESSION['user_type_id'] != 10){
            include("admin/daftar_solat_kehadiran.php");
        }
        elseif ($action=="daftar_solat_senaraiLulus" && $_SESSION['user_type_id'] != 10){
            include("admin/daftar_solat_senaraiLulus.php");
        }

        else if($action=="notifikasi") {
            include("admin/notifikasi.php");
        }
        // Lain-lain file / action
        else if(file_exists("admin/$action.php")) {
            if(($action == "super_admin" && $_SESSION['kod_masjid'] == "SPMD00000") || $action != "super_admin") include ("admin/$action.php");
        }
    }
    ?>

    <?php if($tema_layout == 1) { ?></div><!-- /#right-panel --><?php } ?>
    <?php if($tema_layout == 2) include("theme_2_rightsidebar.php"); ?>
    <!-- Right Panel -->
    <?php if($_GET['action'] != 'minitmesyuarat' && $tema_layout == 1) { ?>
        <script>
            (function($) {
                "use strict";

                jQuery('#vmap').vectorMap({
                    map: 'world_en',
                    backgroundColor: null,
                    color: '#ffffff',
                    hoverOpacity: 0.7,
                    selectedColor: '#1de9b6',
                    enableZoom: true,
                    showTooltip: true,
                    values: sample_data,
                    scaleColors: ['#1de9b6', '#03a9f5'],
                    normalizeFunction: 'polynomial'
                });
            })(jQuery);
        </script>
    <?php } ?>
    <?php if($tema_layout == 2) { ?>
        <?php if($_GET['module'] != "add_ahli") { ?><script src="vendors/jquery/dist/jquery.js"></script><?php } ?>
        <script src="vendors/popper.js/dist/umd/popper.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.js"></script>
        <?php if($_GET['module'] != "add_ahli") { ?><script src="themes/elite/node_modules/jquery/jquery-3.2.1.min.js"></script><?php } ?>
        <script src="themes/elite/node_modules/popper/popper.min.js"></script>
        <script src="themes/elite/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="themes/elite/dist/js/perfect-scrollbar.jquery.min.js"></script>
        <script src="themes/elite/dist/js/waves.js"></script>
        <script src="themes/elite/dist/js/sidebarmenu.js"></script>
        <script src="themes/elite/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
        <script src="themes/elite/node_modules/sparkline/jquery.sparkline.min.js"></script>
        <script src="themes/elite/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<!--        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" type="text/javascript"></script>-->
        <script src="themes/elite/dist/js/custom.min.js"></script>
        <script src="themes/elite/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <!--script src="vendors/datatable/datatables.js"></script-->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/jquery.canvasjs.js" integrity="sha512-K0pOiOu3G8R2xDzk0RsZHUywWA4nWr/1Dg09qbQRGn3tY3Ra9hzIvVtp71GeM/uxqPPM38KA+GAOB4vgNTWOtA==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.js" integrity="sha512-P0pdbdTHc6MzepVlBNGN/c+lBFfFk0ISSc/GLLnQzR5QzfgVdQMvOhVK4RvnhylawHSn2QxgAjb3f+zxSMfyNg==" crossorigin="anonymous"></script>
        <script src="themes/elite/node_modules/moment/moment.js?ver=3"></script>
        <script src="themes/elite/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
        <script src="themes/elite/node_modules/switchery/dist/switchery.min.js"></script>
    <?php //if($_GET['action'] == 'kewangan' || $_GET['action'] == 'pendaftaran') { ?>
        <script src="vendors/datatable/datatables.js"></script>
    <?php //} ?>
        <script src="themes/elite/node_modules/sweetalert2/sweet-alert.init.js?rand=<?php echo(rand()); ?>"></script>
        <script>
            function kelik_hide() {
                $(document).ready(function(){
                    if ($(".mini-sidebar")[0]){
                        $(".logo-kecil").fadeIn();
                    } else {
                        $(".logo-kecil").hide();
                    }
                });
            }
            $(document).ready(function(){
                $(".breadcrumbs").addClass("row page-titles");
                $(".page-titles").removeClass("breadcrumbs");
                $("ol.breadcrumb li").addClass("breadcrumb-item");
                $("li.menu-item-has-children a").removeAttr("data-toggle aria-haspopup");
                $("li.menu-item-has-children a").addClass("has-arrow waves-effect waves-dark");
                $("li.menu-item-has-children a").removeClass("dropdown-toggle");
                $("ul.dropdown-menu").addClass("collapse");
                $("ul.dropdown-menu").attr("aria-expanded","false");
                $(".collapse").removeClass("sub-menu children dropdown-menu");
                $(".sidebar-nav ul li a").css("color", "#FFFFFF");
                $(".sidebar-nav ul li i").css("color", "#FFFFFF");
                $(".nav-tetap").css("background-color", "#FFFFFF");
                $(".app-search input").css("background-color", "rgba(0, 0, 0, 0.05)");
                $(".navbar-nav i").css("color", "#000000");
                $(".navbar-nav span").css("color", "#000000");
                $(".bg-royal").css("background-color", "#010280");
                //$(".left-sidebar").css("background-image", "url(images/latar_menu.jpeg)");
                //$(".left-sidebar").css("background-size", "contain");
                $(".left-sidebar").css("background-color", "#010280");
                $(".left-sidebar a").css("background-color", "#010280");
                $(".h4, h4").css("font-size", "1.5rem");
                $(".kelik-hide").click(function(){
                    kelik_hide();
                });
                kelik_hide();
                $('.profail-kariah div').css("margin-bottom", "10px");
                $('#meja_akaun_filter input').css({"background-color":"white"});
            });
            $(document).ready(function() {
                // grab the initial top offset of the navigation
                var stickyNavTop = $('.nav-tetap').offset().top;

                // our function that decides weather the navigation bar should have "fixed" css position or not.
                var stickyNav = function(){
                    var scrollTop = $(window).scrollTop(); // our current vertical position from the top

                    // if we've scrolled more than the navigation, change its position to fixed to stick to top,
                    // otherwise change it back to relative
                    if (scrollTop > stickyNavTop) {
                        $('.nav-tetap').addClass('sticky-tetap');
                    } else {
                        $('.nav-tetap').removeClass('sticky-tetap');
                    }
                };

                stickyNav();
                // and run it again every time you scroll
                $(window).scroll(function() {
                    stickyNav();
                });
            });
        </script>
    <?php } ?>
    <?php
    if($_GET['action']=="bantuan" OR $_GET['action']=="approve_qariah"){
        ?>
        <script src="themes/elite/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                // For select 2
                $(".select2").select2({
                    multiple: true
                });
                $('.selectpicker').selectpicker();
                $(".ajax").select2({
                    ajax: {
                        url: "https://api.github.com/search/repositories",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                q: params.term, // search term
                                page: params.page
                            };
                        },
                        processResults: function (data, params) {
                            // parse the results into the format expected by Select2
                            // since we are using custom formatting functions we do not need to
                            // alter the remote JSON data, except to indicate that infinite
                            // scrolling can be used
                            params.page = params.page || 1;
                            return {
                                results: data.items,
                                pagination: {
                                    more: (params.page * 30) < data.total_count
                                }
                            };
                        },
                        cache: true
                    },
                    escapeMarkup: function (markup) {
                        return markup;
                    }, // let our custom formatter work
                    minimumInputLength: 1,
                    //templateResult: formatRepo, // omitted for brevity, see the source of this page
                    //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
                });
            });
        </script>
    <?php } ?>
    <?php
    include("ajax_functions.php");
    if($_GET['action'] == "kewangan") {
        if(file_exists("accounts/js-page/sub_".$_GET['subModul'].".php")) include("accounts/js-page/sub_".$_GET['subModul'].".php");
        include("accounts/js-page/default.php");
    }
    ?>
</body>

</html>
<?php }
$time_end = microtime(true);
//dividing with 60 will give the execution time in minutes otherwise seconds
$execution_time = ($time_end - $time_start);
//execution time of the script
if ($_GET['testDebug'] == 1) {
    $query_exec = "SELECT MAX(query_id) 'query_id', SUM(duration) 'duration' FROM information_schema.profiling";
    //$query_exec = "SELECT query_id, duration, state FROM information_schema.profiling ORDER BY query_id DESC;";
    $exec_time_result=mysqli_query($bd2, $query_exec) or die(mysqli_error($bd2));
    $exec_time_row = mysqli_fetch_assoc($exec_time_result);
    //do {
        //$jumlahMasaData = $jumlahMasaData + $exec_time_row['duration'];
        //echo '<div align="center"><b>Query ID / State / Duration:</b> '. $exec_time_row['query_id'] .' / '.$exec_time_row['state'].' / '.$exec_time_row['duration'].'</div>';
    //} while ($exec_time_row = mysqli_fetch_assoc($exec_time_result));
    //echo '<div align="center"><b>Current User:</b> ' . $mysql_user_utama . '</div>';
    echo '<div align="center"><b>Jumlah Query Data:</b> ' . $exec_time_row['query_id'] . '</div>';
    echo '<div align="center"><b>Masa Data Diambil:</b> ' . number_format(($exec_time_row['duration'] * 1000), 2) . ' Milisaat</div>';
    echo '<div align="center"><b>Jumlah Masa Diambil:</b> ' . number_format(($execution_time * 1000), 2) . ' Milisaat</div>';
}
mysqli_close($bd2);
mysqli_close($conn0);
mysqli_close($conn);
exit;
?>