<?php
$sideMenu = $_GET['sideMenu'];

if($_SERVER['REQUEST_METHOD'] == "GET") {
//foreach($_SERVER as $key => $val) echo $key.': '.$val.'<br />'."\r\n";
}
//include('connection/connection.php');

$sql="SELECT * FROM bantuan_zakat WHERE id_masjid='$id_masjid' AND status_bantuan='0'";
$sqlquery=mysqli_query($bd2, $sql);
$row=mysqli_num_rows($sqlquery);

$sql1="SELECT * FROM sej6x_data_praktikal WHERE id_masjid=$id_masjid AND status=0";
$sqlquery1=mysqli_query($bd2, $sql1);
$row1=mysqli_num_rows($sqlquery1);

$sql2="SELECT * FROM sej6x_data_temujanji WHERE id_masjid=$id_masjid AND status=0";
$sqlquery2=mysqli_query($bd2, $sql2);
$row2=mysqli_num_rows($sqlquery2);

$sql3="SELECT id FROM approve_qariah WHERE id_masjid=$id_masjid";
$sqlquery3=mysqli_query($bd2, $sql3);
$row3=mysqli_num_rows($sqlquery3);

$sql4 = "SELECT a.id FROM approve_anak a LEFT JOIN approve_qariah b ON a.no_ic_ketua = b.no_ic LEFT JOIN approve_qariah d ON a.id_qariah = d.id LEFT JOIN sej6x_data_peribadi c ON a.no_ic_ketua = c.no_ic WHERE b.id_masjid = $id_masjid OR c.id_masjid = $id_masjid OR d.id_masjid = $id_masjid";
$sqlquery4 = mysqli_query($bd2, $sql4);
$row4 = mysqli_num_rows($sqlquery4);

$sql_aduan = "SELECT * FROM data_aduan WHERE id_masjid='$id_masjid' AND (tindakkan IS NULL OR tindakkan='')";
$query_aduan = mysqli_query($bd2,$sql_aduan);
$row_aduan = mysqli_num_rows($query_aduan);

$sql_kematian = "SELECT * FROM data_kematian WHERE id_masjid='$id_masjid' AND approved='0'";
$query_kematian = mysqli_query($bd2,$sql_kematian);
$row_kematian = mysqli_num_rows($query_kematian);

$sql_komuniti = "SELECT * FROM komuniti_list WHERE id_masjid='$id_masjid' AND status_approved='0'";
$query_komuniti = mysqli_query($bd2,$sql_komuniti);
$row_komuniti = mysqli_num_rows($query_komuniti);

$q = "SELECT COUNT(*) 'pendingVaksin' FROM data_vaksin a LEFT JOIN sej6x_data_peribadi b ON a.no_ic = b.no_ic AND b.id_masjid = $id_masjid LEFT JOIN sej6x_data_anakqariah c ON a.no_ic = c.no_ic AND c.id_masjid = $id_masjid LEFT JOIN approve_qariah d ON a.no_ic = d.no_ic AND d.id_masjid = $id_masjid LEFT JOIN approve_anak e ON a.no_ic = e.no_ic AND e.id_masjid = $id_masjid WHERE b.id_masjid = $id_masjid AND (a.status IS NULL OR a.status = 0) AND (a.status2 IS NULL OR a.status2 = 0) AND CHAR_LENGTH(a.file_attach) > 20";
selValueSQL($q, 'semakVaksin');
$rowlulusVaksin = $row_semakVaksin['pendingVaksin'];

$total_row=$row+$row2+$row3+$row_aduan+$row_kematian+$row_komuniti+$row4;

$sideMenuKariah = array("super_admin", "pendaftaran", "uploadDaftar", "dashboard", "dashboard_payment", "dashboard_bantuan",
"daftar_solat_senarai", "daftar_solat_senaraiLulus", "approve_qariah", "approve_kematian", "approve_bantuan", "approve_temujanji", "aduan", "komuniti_ekonomi","menu_pengurusanKariah");
$sideMenuMasjid = array("daftar_solat", "daftar_solat_kehadiran", "jadualkehadiran", "kehadiran", "kehadiran_bulanan", "kehadiran_pengurusan",
"kewangan", "minitmesyuarat", "suratnotis", "laporanaktiviti", "surat_rasmi", "rekod_surat_rasmi", "dashboard_selenggara","komuniti" ,"aduan", "bantuan", "rekod_bantuan", "care", "praktikal", "penarafan_masjid", "aktiviti", "zakat", "profil","kehadiranterperinci","kehadiranterperincipengurusan","menu_pengurusanMasjid",
"kafa","kemas","sekolah","pasti","rukuntetangga","belia","balai","persatuan","surau","klinik","rumahibadat","view_care","upload_surat");
$sideMenuOrganisasi = array("dashboard_tetapan","pemilihan_jawatankuasa","menu_organisasi","daftar_ajk","senarai_ajk","daftar_pegawai","senarai_pegawai","daftar_pengurusan","senarai_pengurusan","jawatan_pengurusan","senaraiPengundiForm","butiran_jawatanpegawai");
$sideMenuWakafInfaq = array("wakaf", "infaq","list_infaq","menu_infaqWakaf");
?>
<?php if($tema_layout == 2) { ?>
    <aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
    <ul id="sidebarnav">
    <li>
<a class="waves-effect waves-dark" href="utama.php?view=admin&action=utama" aria-expanded="false">
<i class="ti-home"></i><span class="hide-menu">Menu Utama</span>
</a>
    </li>
<?php } ?>
<?php if($tema_layout == 1) { ?>
    <aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

    <div class="navbar-header">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="https://<?php echo($_SERVER['SERVER_NAME']); ?>"><i class="fas fa-mosque"></i>&nbsp;Masjid Pro</a>
        <a class="navbar-brand hidden" href="https://<?php echo($_SERVER['SERVER_NAME']); ?>"><i class="fas fa-mosque"></i></a>
    </div>

    <div id="main-menu" class="main-menu collapse navbar-collapse">
    <ul class="nav navbar-nav">
    <!-- <li class="active">
        <a href="utama.php?view=admin&action=dashboard&qariah=semua">
            <i class="menu-icon fas fa-tachometer-alt"></i>Dashboard
        </a>
    </li> -->
<?php } if($_GET['action'] != "utama") {
    if($_GET['sideMenu'] == "kariah" || (in_array($_GET['action'], $sideMenuKariah) && $_GET['sideMenu'] == NULL)) {
    ?>
    <?php if($_SESSION['kod_masjid'] == "SPMD00000" && $_SESSION['username'] == "pengerusi") { ?>
    <li><a href="utama.php?view=admin&action=super_admin&sideMenu=<?php echo($sideMenu); ?>"><i class="menu-icon fas fa-tachometer-alt"></i><span class="hide-menu">Super Admin</span></a></li>
    <?php } ?>
    <li class="menu-item-has-children dropdown">
        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fas fa-tachometer-alt"></i><span class="hide-menu">Statistik</span></a>
        <ul class="sub-menu children dropdown-menu">
            <li><a href="statistik?sideMenu=<?php echo($sideMenu); ?>" href2="utama.php?view=admin&action=dashboard&qariah=semua&sideMenu=<?php echo($sideMenu); ?>">Ahli Kariah</a></li>
            <?php if($_SESSION['user_type_id'] != 10  AND $_SESSION['user_type_id'] != 7)  { ?>
                <li style="display: none"><a href="utama.php?view=admin&action=dashboard_payment&sideMenu=<?php echo($sideMenu); ?>">Bayaran</a></li>
                <li><a href="utama.php?view=admin&action=dashboard_bantuan&sideMenu=<?php echo($sideMenu); ?>">Bantuan</a></li>
                <?php
                if($id_masjid == 6279 && $_SERVER['SERVER_NAME'] != "sistem.gomasjid.my"){
                ?>
                <li><a href="https://statistik.masjidpro.com/" target="_blank">Keseluruhan</a></li>
                <?php
                }
                ?>
            <?php } ?>
        </ul>
    </li>
    <!-- <li>
        <a href="utama.php?view=admin&action=pendaftaran">
            <i class="menu-icon fas fa-edit"></i><span class="hide-menu">Pendaftaran</span>
        </a>
    </li> -->
    <li class="menu-item-has-children dropdown">
        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fas fa-edit"></i><span class="hide-menu">Pendaftaran</span></a>
        <ul class="sub-menu children dropdown-menu">


            <li><a href="utama.php?view=admin&action=pendaftaran&sideMenu=<?php echo($sideMenu); ?>">Ahli Kariah</a></li>
            <li><a href="utama.php?view=admin&action=pendaftaranKematian&sideMenu=<?php echo($sideMenu); ?>">  Kematian</a></li>
            <li><a href="utama.php?view=admin&action=uploadDaftar&sideMenu=<?php echo($sideMenu); ?>">Muat Naik Excel <br>Ahli Kariah</a></li>
        </ul>
    </li>
    <?php if($_SESSION['user_type_id'] != 10 AND $_SESSION['user_type_id'] != 7) { ?>
    <li style="display: none" class="menu-item-has-children dropdown">
        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fas fa-pray"></i><span class="hide-menu">Daftar Solat</span></a>
        <ul class="sub-menu children dropdown-menu">
            <li><a href="utama.php?view=admin&action=daftar_solat&sideMenu=<?php echo($sideMenu); ?>">Tetapan</a></li>
            <li><a href="utama.php?view=admin&action=daftar_solat_senaraiLulus&sideMenu=<?php echo($sideMenu); ?>">Senarai Kehadiran</a></li>
            <li style="display: none"><a href="utama.php?view=admin&action=daftar_solat_kehadiran&sideMenu=<?php echo($sideMenu); ?>">Senarai Kehadiran</a></li>
        </ul>
    </li>
    <?php } } ?>
<?php if($_SESSION['user_type_id'] != 10 AND $_SESSION['user_type_id'] != 7)  {
     if($_GET['sideMenu'] == "masjid" || (in_array($_GET['action'], $sideMenuMasjid) && $_GET['sideMenu'] == NULL)) {
    ?>
    <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-gear"></i><span class="hide-menu">Tetapan</span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="utama.php?view=admin&action=profil"><i class="ti-user"></i> Profil Saya</a></li>
            <!--li><a href="logout.php"><i class="fa fa-power-off"></i> Log Keluar</a></li-->
        </ul>
    </li>
    <li>
        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
            <i class="menu-icon fas fa-calendar"></i><span class="hide-menu">Kehadiran</span>
        </a>
        <ul aria-expanded="false" class="collapse">
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-mosque"></i>&nbsp;Pegawai Masjid</a>
                <ul aria-expanded="false" class="collapse">
                    <li style="display: none"><a href="utama.php?view=admin&action=jadualkehadiran&sideMenu=<?php echo($sideMenu); ?>">Jadual Bertugas</a></li>
                    <li><a href="utama.php?view=admin&action=kehadiran&sideMenu=<?php echo($sideMenu); ?>">Rekod Kehadiran Pegawai</a></li>
                    <li><a href="utama.php?view=admin&action=kehadiran_bulanan&sideMenu=<?php echo($sideMenu); ?>">Rekod Kehadiran Bulanan</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-mosque"></i>&nbsp;Pengurusan Masjid</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="utama.php?view=admin&action=kehadiran_pengurusan&sideMenu=<?php echo($sideMenu); ?>">Rekod Kehadiran</a></li>
                </ul>
            </li>
            <!-- <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-pray"></i>&nbsp;Ahli Kariah</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="">Vaksin</a></li>
                    <li><a href="">Rekod Kehadiran</a></li>
                </ul>
            </li> -->
        </ul>
    </li>
    <li>
        <a <?php if($_GET['action'] == "kewangan" && $_GET['newModul'] == 1) echo('class="has-arrow waves-effect waves-dark"'); ?> href="utama.php?view=admin&action=kewangan&sideMenu=<?php echo($sideMenu); ?>&newModul=1">
            <i class="menu-icon fas fa-money-bill-alt"></i><span class="hide-menu">Kewangan</span>
        </a>
        <?php if($_GET['action'] == "kewangan" && $_GET['newModul'] == 1) { ?>
        <ul aria-expanded="false" class="collapse <?php echo $_GET['action'] == "kewangan" ? 'in' : NULL; ?>">
        <li <?php echo $training == 1 ? 'class="active"' : NULL; ?>><a <?php echo $training == 1 ? 'class="active"' : NULL; ?> href="utama.php?view=admin&action=kewangan&sideMenu=<?php echo($sideMenu); ?>&newModul=1">Modul Sebenar</a></li>
        <li <?php echo $training == 2 ? 'class="active"' : NULL; ?>><a <?php echo $training == 2 ? 'class="active"' : NULL; ?> href="utama.php?view=admin&action=kewangan&sideMenu=<?php echo($sideMenu); ?>&newModul=1&training=1">Modul Latihan</a></li>
        </ul>
        <?php } ?>
    </li>
    <li>
        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
            <i class="ti-align-left"></i><span class="hide-menu">Dokumentasi</span>
        </a>
        <ul aria-expanded="false" class="collapse">
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-envelope"></i>&nbsp;Minit Mesyuarat</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="utama.php?view=admin&action=minitmesyuarat&sideMenu=<?php echo($sideMenu); ?>">Borang Minit Mesyuarat</a></li>
                    <li><a href="utama.php?view=admin&action=suratnotis&sideMenu=<?php echo($sideMenu); ?>">Laporan Minit Mesyuarat</a></li>
                    <li><a href="utama.php?view=admin&action=laporanaktiviti&sideMenu=<?php echo($sideMenu); ?>">Muat Naik Minit Mesyuarat</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-mail-bulk fa fa-users"></i>&nbsp;Surat Rasmi</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="utama.php?view=admin&action=surat_rasmi&sideMenu=<?php echo($sideMenu); ?>">Surat Rasmi</a></li>
                    <li><a href="utama.php?view=admin&action=rekod_surat_rasmi&sideMenu=<?php echo($sideMenu); ?>">Rekod Surat Rasmi</a></li>
                </ul>
            </li>
            <li><a href="utama.php?view=admin&action=aktiviti&sideMenu=<?php echo($sideMenu); ?>"><i class="menu-icon fas fa-file-signature"></i>&nbsp;Aktiviti</a></li>
            <li><a href="utama.php?view=admin&action=penarafan_masjid&sideMenu=<?php echo($sideMenu); ?>"><i class="menu-icon fas fa-clipboard"></i>&nbsp;Penarafan Masjid</a></li>
        </ul>
    </li>
    <?php }  if($_GET['sideMenu'] == "kariah" || (in_array($_GET['action'], $sideMenuKariah) && $_GET['sideMenu'] == NULL)) { ?>
    <li class="menu-item-has-children dropdown">
        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fas fa-exclamation-circle"></i><span class="hide-menu">Kelulusan <b>(<?php echo $total_row; ?>)</b></span></a>
        <ul class="sub-menu children dropdown-menu">
            <?php if($_SESSION['user_type_id'] != 10  AND $_SESSION['user_type_id'] != 7) { ?>
                <li style="display: none"><a href="utama.php?view=admin&action=daftar_solat_senarai&sideMenu=<?php echo($sideMenu); ?>">Vaksinasi <b>(<?php echo $rowlulusVaksin; ?>)</b></a></li>
            <?php } ?>
            <li><a href="utama.php?view=admin&action=approve_qariah&sideMenu=<?php echo($sideMenu); ?>">Kariah <b>(<?php echo $row3 + $row4; ?>)</b></a></li>
            <li><a href="utama.php?view=admin&action=approve_kematian&sideMenu=<?php echo($sideMenu); ?>">Kematian <b>(<?php echo $row_kematian; ?>)</b></a></li>
            <li><a href="utama.php?view=admin&action=approve_bantuan&sideMenu=<?php echo($sideMenu); ?>">Bantuan&nbsp;<b>(<?php echo $row; ?>)</b></a></li>
            <li><a href="utama.php?view=admin&action=komuniti_ekonomi&sideMenu=<?php echo($sideMenu); ?>">Komuniti&nbsp;<b>(<?php echo $row_komuniti; ?>)</b></a></li>
            <!-- <li><i class="fas fa-exclamation-circle"></i><a href="utama.php?view=admin&action=approve_praktikal">Praktikal&nbsp;<b>(<?php //echo $row1; ?>)</b></a></li> -->
            <li><a href="utama.php?view=admin&action=approve_temujanji&sideMenu=<?php echo($sideMenu); ?>">Temujanji&nbsp;<b>(<?php echo $row2; ?>)</b></a></li>
            <li><a href="utama.php?view=admin&action=aduan&sideMenu=<?php echo($sideMenu); ?>">Pandangan & Cadangan&nbsp;<b>(<?php echo $row_aduan; ?>)</b></a></li>
        </ul>
    </li>
    <?php } if($_GET['sideMenu'] == "masjid" || (in_array($_GET['action'], $sideMenuMasjid) && $_GET['sideMenu'] == NULL)) {?>
    <li>
        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
            <i class="fas fa-warehouse"></i><span class="hide-menu">&nbsp;Fasiliti</span>
        </a>
        <ul aria-expanded="false" class="collapse">
<!--            <li><a href="utama.php?view=admin&action=dashboard_selenggara&sideMenu=--><?php //echo($sideMenu); ?><!--"><i class=""></i>&nbsp;Menu Fasiliti</a></li>-->
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-wrench"></i>&nbsp;Penyelenggara</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="utama.php?view=admin&action=selenggara&sideMenu=masjid">Daftar Penyelenggara</a></li>
                    <li><a href="utama.php?view=admin&action=maklumatselenggara&sideMenu=masjid">Senarai Penyelenggara</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-warehouse"></i>&nbsp;Inventori</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="utama.php?view=admin&action=inventori&sideMenu=masjid">Daftar Inventori</a></li>
                    <li><a href="utama.php?view=admin&action=maklumatinventori&sideMenu=masjid">Laporan Inventori</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-house-damage"></i>&nbsp;Kerosakan</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="utama.php?view=admin&action=kerosakan&sideMenu=masjid">Lapor Kerosakan</a></li>
                    <li><a href="utama.php?view=admin&action=maklumatkerosakan&sideMenu=masjid">Senarai Kerosakan</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <?php } } ?>
    <?php if($hideMenu == 1) { ?>
    <li>
        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
            <i class="ti-menu-alt"></i><span class="hide-menu">Pengurusan</span>
        </a>
        <ul aria-expanded="false" class="collapse">
            <!-- <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-calendar"></i>&nbsp;Kehadiran</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="utama.php?view=admin&action=jadualkehadiran">Jadual Pegawai Masjid</a></li>
                    <li><a href="utama.php?view=admin&action=kehadiran">Kehadiran Pegawai Masjid</a></li>
                </ul>
            </li> -->
            <?php } if($_GET['sideMenu'] == "organisasi" || (in_array($_GET['action'], $sideMenuOrganisasi) && $_GET['sideMenu'] == NULL)) { ?>
<!--            <li><a href="utama.php?view=admin&action=dashboard_tetapan&sideMenu=--><?php //echo($sideMenu); ?><!--"><i class="menu-icon fas fa-sitemap"></i><span class="hide-menu">Organisasi</span></a></li>-->
<!--            <li><a href="utama.php?view=admin&action=pemilihan_jawatankuasa&sideMenu=--><?php //echo($sideMenu); ?><!--"><i class="menu-icon fas fa-briefcase"></i><span class="hide-menu">Pemilihan Jawatankuasa</span></a></li>-->
<!--            <li><a href="utama.php?view=admin&action=senaraiPengundiForm&sideMenu=--><?php //echo($sideMenu); ?><!--"><i class="menu-icon fas fa-user"></i><span class="hide-menu">Senarai Layak Mengundi</span></a></li>-->
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-sitemap"></i>&nbsp;ORGANISASI</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="utama.php?view=admin&action=semakorganisasi&sideMenu=<?php echo($sideMenu); ?>">Daftar Organisasi</a></li>
                    <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">Senarai Jawatankuasa</a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="utama.php?view=admin&action=senaraiJawatankuasa_AJK&sideMenu=<?php echo($sideMenu); ?>">AJK Masjid</a></li>
                            <li><a href="utama.php?view=admin&action=senaraiJawatankuasa_PEGAWAI&sideMenu=<?php echo($sideMenu); ?>">Pegawai Masjid</a></li>
                            <li><a href="utama.php?view=admin&action=senaraiJawatankuasa_PENGURUSAN&sideMenu=<?php echo($sideMenu); ?>">Pengurusan Masjid</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">Tetapan</a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="utama.php?view=admin&action=organisasi_senaraiAJK&sideMenu=<?php echo($sideMenu); ?>">AJK Masjid</a></li>
                            <li><a href="utama.php?view=admin&action=organisasi_senaraiPEGAWAI&sideMenu=<?php echo($sideMenu); ?>">Pegawai Masjid</a></li>
                            <li><a href="utama.php?view=admin&action=organisasi_senaraiPENGURUSAN&sideMenu=<?php echo($sideMenu); ?>">Pengurusan Masjid</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">Kehadiran</a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">Laporan</a>
                                <ul aria-expanded="false" class="collapse">
<!--                                    <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">AJK Masjid</a>-->
<!--                                        <ul aria-expanded="false" class="collapse">-->
<!--                                            <li><a href="utama.php?view=admin&action=&sideMenu=--><?php //echo($sideMenu); ?><!--">Laporan Individu</a></li>-->
<!--                                            <li><a href="utama.php?view=admin&action=&sideMenu=--><?php //echo($sideMenu); ?><!--">Laporan Bulanan</a></li>-->
<!--                                        </ul>-->
<!--                                    </li>-->
                                    <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">Pegawai Masjid</a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="utama.php?view=admin&action=organisasi_laporan_senaraiPEGAWAI&sideMenu=<?php echo($sideMenu); ?>">Individu</a></li>
                                            <li><a href="utama.php?view=admin&action=organisasi_laporan_senaraiPEGAWAI_bulanan&sideMenu=<?php echo($sideMenu); ?>">Bulanan</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">Pengurusan Masjid</a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="utama.php?view=admin&action=organisasi_laporan_senaraiPENGURUSAN&sideMenu=<?php echo($sideMenu); ?>">Individu</a></li>
<!--                                            <li><a href="utama.php?view=admin&action=organisasi_laporan_senaraiPENGURUSAN_bulanan&sideMenu=--><?php //echo($sideMenu); ?><!--">Bulanan</a></li>-->
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">Tetapan</a>
                                <ul aria-expanded="false" class="collapse">
<!--                                    <li><a href="utama.php?view=admin&action=organisasi_tetapankehadiran_AJK&sideMenu=--><?php //echo($sideMenu); ?><!--">AJK Masjid</a></li>-->
                                    <li><a href="utama.php?view=admin&action=organisasi_tetapankehadiran_PEGAWAI&sideMenu=<?php echo($sideMenu); ?>">Pegawai Masjid</a></li>
                                    <li><a href="utama.php?view=admin&action=organisasi_tetapankehadiran_PENGURUSAN&sideMenu=<?php echo($sideMenu); ?>">Pengurusan Masjid</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <?php } if($_GET['sideMenu'] == "masjid" || (in_array($_GET['action'], $sideMenuMasjid) && $_GET['sideMenu'] == NULL)) { ?>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-hands-helping"></i><span class="hide-menu">Bantuan</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="utama.php?view=admin&action=bantuan&sideMenu=<?php echo($sideMenu); ?>">Daftar Bantuan</a></li>
                    <li><a href="utama.php?view=admin&action=rekod_bantuan&sideMenu=<?php echo($sideMenu); ?>">Rekod Bantuan</a></li>
                </ul>
            </li>
            <li><a href="utama.php?view=admin&action=komuniti&sideMenu=<?php echo($sideMenu); ?>"><i class="menu-icon fas fa-users"></i><span class="hide-menu">Komuniti</span></a></li>
            <li><a href="utama.php?view=admin&action=aduan&sideMenu=<?php echo($sideMenu); ?>"><i class="menu-icon fas fa-exclamation-circle"></i><span class="hide-menu">Pandangan & Cadangan</span></a></li>
            <li><a href="utama.php?view=admin&action=care&sideMenu=<?php echo($sideMenu); ?>"><i class="menu-icon fas fa-pray"></i><span class="hide-menu">Masjid Care</span></a></li>
            <!-- <li><a href="utama.php?view=admin&action=praktikal&sideMenu=<?php //echo($sideMenu); ?>"><i class="menu-icon fas fa-user-graduate"></i>&nbsp;Praktikal</a></li> -->
            <!-- <li><a href="manual/Manual_2021.pdf"><i class="menu-icon fas fa-file"></i>&nbsp;Manual Pengguna</a></li> -->
            <li><a href="utama.php?view=admin&action=aktivitiMasjid&sideMenu=<?php echo($sideMenu); ?>"><i class="menu-icon fas fa-people-carry"></i><span class="hide-menu">Aktiviti</span></a></li>
        <?php if($hideMenu == 1) { ?>
        </ul>
    </li>
     <?php } } ?>
     <?php if($_GET['sideMenu'] == "wakafinfaq" || in_array($_GET['action'], $sideMenuWakafInfaq)) { ?>
            <li><a href="utama.php?view=admin&action=infaq&sideMenu=<?php echo($sideMenu); ?>"><i class="menu-icon fas fa-hand-holding-usd"></i><span class="hide-menu">Infaq</span></a></li>
            <li><a href="utama.php?view=admin&action=wakaf&sideMenu=<?php echo($sideMenu); ?>"><i class="menu-icon fas fa-donate"></i><span class="hide-menu">Wakaf</span></a></li>
            <?php }  ?>
    <?php if($_GET['sideMenu'] == "kariah" || (in_array($_GET['action'], $sideMenuKariah) && $_GET['sideMenu'] == NULL)) { ?>
    <li>
        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
            <i class="ti-harddrives"></i><span class="hide-menu">Integrasi Data</span>
        </a>
        <ul aria-expanded="false" class="collapse">
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-hand-holding-usd"></i>&nbsp;Zakat</a>
                <ul aria-expanded="false" class="collapse">
                    <!-- <li><i class="fas fa-hand-holding-usd"></i><a href="javascript:void(0)"></b>Semakan <b>(<?php //echo $total_row_zakat; ?>)</a></li> -->
                    <li><a href="utama.php?view=admin&action=zakat&sideMenu=<?php echo($sideMenu); ?>">Senarai Penerima</a></li>
                </ul>
            </li>
        </ul>
    </li>
<?php } ?>
    </ul>
<?php if($tema_layout == 1) { ?></div><!-- /.navbar-collapse --><?php } ?>
    </nav>
<?php if($tema_layout == 2) { ?>
    </div><!-- End Sidebar scroll-->
<?php } } ?>
    </aside><!-- /#left-panel -->
<?php //}
//if($tema_layout == 2) include("theme_2_sidebar.php");
?>

