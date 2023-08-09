<?php

include('connection/connection.php');

$sql="SELECT * FROM bantuan_zakat WHERE id_masjid=$id_masjid AND status=0";
$sqlquery=mysqli_query($bd2, $sql);
$row=mysqli_num_rows($sqlquery);

$sql1="SELECT * FROM sej6x_data_praktikal WHERE id_masjid=$id_masjid AND status=0";
$sqlquery1=mysqli_query($bd2, $sql1);
$row1=mysqli_num_rows($sqlquery1);

$sql2="SELECT * FROM sej6x_data_temujanji WHERE id_masjid=$id_masjid AND status=0";
$sqlquery2=mysqli_query($bd2, $sql2);
$row2=mysqli_num_rows($sqlquery2);

$sql3="SELECT * FROM approve_qariah WHERE id_masjid=$id_masjid";
$sqlquery3=mysqli_query($bd2, $sql3);
$row3=mysqli_num_rows($sqlquery3);

$total_row=$row+$row2+$row3;

?>
<?php if($tema_layout == 2) { ?>
    <aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
    <ul id="sidebarnav">
    <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">&nbsp;<?php echo($_SESSION['user_name']); ?></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="utama.php?view=admin&action=profil"><i class="ti-user"></i>&nbsp;Profail Saya</a></li>
            <li><a href="logout.php"><i class="fa fa-power-off"></i>&nbsp;Log Keluar</a></li>
        </ul>
    </li>
<?php } ?>
    <li class="menu-item-has-children dropdown">
        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fas fa-tachometer-alt"></i><span class="hide-menu">&nbsp;Statistik</span></a>
        <ul class="sub-menu children dropdown-menu">
            <li><a href="utama.php?view=admin&action=dashboard&qariah=semua">&nbsp;Ahli Kariah</a></li>
            <?php if($_SESSION['user_type_id'] != 10)  { ?>
            <li><a href="utama.php?view=admin&action=dashboard_payment">&nbsp;Bayaran</a></li>
            <li><a href="utama.php?view=admin&action=dashboard_bantuan">&nbsp;Bantuan</a></li>
            <?php } ?>
        </ul>
    </li>
	<li>
        <a href="utama.php?view=admin&action=pendaftaran">
            <i class="menu-icon fas fa-edit"></i><span class="hide-menu">&nbsp;Pendaftaran</span>
        </a>
    </li>
	<li> 
		<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
			<i class="ti-align-left"></i><span class="hide-menu">&nbsp;Dokumentasi</span>
		</a>
		<ul aria-expanded="false" class="collapse">
			<li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-envelope"></i>&nbsp;Minit Mesyuarat</a>
				<ul aria-expanded="false" class="collapse">
					<li><a href="utama.php?view=admin&action=minitmesyuarat">&nbsp;Borang Minit Mesyuarat</a></li>
					<li><a href="utama.php?view=admin&action=suratnotis">&nbsp;Laporan Minit Mesyuarat</a></li>
					<li><a href="utama.php?view=admin&action=laporanaktiviti">&nbsp;Muat Naik Minit Mesyuarat</a></li>
				</ul>
			</li>
			<li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-mail-bulk fa fa-users"></i>&nbsp;Surat Rasmi</a>
				<ul aria-expanded="false" class="collapse">
					<li><a href="utama.php?view=admin&action=surat_rasmi">&nbsp;Surat Rasmi</a></li>
					<li><a href="utama.php?view=admin&action=rekod_surat_rasmi">&nbsp;Rekod Surat Rasmi</a></li>
				</ul>
			</li>
		</ul>
	</li>
	<li class="menu-item-has-children dropdown">
        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fas fa-exclamation-circle"></i><span class="hide-menu">&nbsp;Kelulusan <b>(<?php echo $total_row; ?>)</b></span></a>
			<ul class="sub-menu children dropdown-menu">
				<li><a href="utama.php?view=admin&action=approve_qariah">&nbsp;Kariah <b>(<?php echo $row3; ?>)</b></a></li>
				<li><a href="utama.php?view=admin&action=approve_bantuan">&nbsp;Bantuan&nbsp;<b>(<?php echo $row; ?>)</b></a></li>
				<!-- <li><i class="fas fa-exclamation-circle"></i><a href="utama.php?view=admin&action=approve_praktikal">Praktikal&nbsp;<b>(<?php //echo $row1; ?>)</b></a></li> -->
				<li><a href="utama.php?view=admin&action=approve_temujanji">&nbsp;Temujanji&nbsp;<b>(<?php echo $row2; ?>)</b></a></li>
			</ul>
    </li>
	<li>
		<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
			<i class="fas fa-warehouse"></i><span class="hide-menu">&nbsp;Fasiliti</span>
		</a>
		<ul aria-expanded="false" class="collapse">
			<li><a href="utama.php?view=admin&action=dashboard_selenggara"><i class="menu-icon fas fa-wrench"></i>&nbsp;Selenggara</a></li>
		</ul>
	</li>
	<li> 
		<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
			<i class="ti-menu-alt"></i><span class="hide-menu">&nbsp;Pengurusan</span>
		</a>
		<ul aria-expanded="false" class="collapse">
			<li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-calendar"></i>&nbsp;Kehadiran</a>
				<ul aria-expanded="false" class="collapse">
					<li><a href="utama.php?view=admin&action=jadualkehadiran">&nbsp;Jadual Pegawai Masjid</a></li>
					<li><a href="utama.php?view=admin&action=kehadiran">&nbsp;Kehadiran Pegawai Masjid</a></li>
				</ul>
			</li>
			<li><a href="utama.php?view=admin&action=dashboard_tetapan"><i class="menu-icon fas fa-sitemap"></i>&nbsp;Organisasi</a></li>
			<li><a href="utama.php?view=admin&action=komuniti"><i class="menu-icon fas fa-users"></i>&nbsp;Komuniti</a></li>
			<li><a href="utama.php?view=admin&action=aduan"><i class="menu-icon fas fa-exclamation-circle"></i>&nbsp;Aduan</a></li>
			<li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-donate"></i>&nbsp;Bantuan</a>
				<ul aria-expanded="false" class="collapse">
					<li><a href="utama.php?view=admin&action=bantuan">Daftar Bantuan</a></li>
					<li><a href="utama.php?view=admin&action=rekod_bantuan">Rekod Bantuan</a></li>
				</ul>
			</li>
			<li><a href="utama.php?view=admin&action=care"><i class="menu-icon fas fa-pray"></i>&nbsp;Masjid Care</a></li>
			<li><a href="utama.php?view=admin&action=praktikal"><i class="menu-icon fas fa-user-graduate"></i>&nbsp;Praktikal</a></li>
			<li><a href="utama.php?view=admin&action=penarafan_masjid"><i class="menu-icon fas fa-clipboard"></i>&nbsp;Penarafan Masjid</a></li>
			<li><a href="utama.php?view=admin&action=aktiviti"><i class="menu-icon fas fa-file-signature"></i>&nbsp;Aktiviti</a></li>
			<li><a href="manual/Manual.pdf"><i class="menu-icon fas fa-file"></i>&nbsp;Manual Pengguna</a></li>
		</ul>
	</li>
	<li> 
		<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
			<i class="ti-harddrives"></i><span class="hide-menu">&nbsp;Integrasi Data</span>
		</a>
		<ul aria-expanded="false" class="collapse">
			<li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="menu-icon fas fa-hand-holding-usd"></i>&nbsp;Zakat</a>
				<ul aria-expanded="false" class="collapse">
					<!-- <li><i class="fas fa-hand-holding-usd"></i><a href="javascript:void(0)"></b>&nbsp;Semakan <b>(<?php //echo $total_row_zakat; ?>)</a></li -->
					<li><a href="utama.php?view=admin&action=zakat">&nbsp;Senarai Penerima</a></li>
				</ul>
			</li>
		</ul>
	</li>
    </ul>
		<?php if($tema_layout == 1) { ?></div><!-- /.navbar-collapse --><?php } ?>
	</nav>
<?php if($tema_layout == 2) { ?>
    </div><!-- End Sidebar scroll-->
<?php } ?>
</aside><!-- /#left-panel -->
<?php //}
//if($tema_layout == 2) include("theme_2_sidebar.php");
?>