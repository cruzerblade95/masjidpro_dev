<?php

//include('connection/connection.php');

$sql="SELECT * FROM sej6x_data_bantuan WHERE id_masjid=$id_masjid AND status_bantuan=0";
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
    <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu"><?php echo($_SESSION['user_name']); ?></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="utama.php?view=admin&action=profil"><i class="ti-user"></i> Profail Saya</a></li>
            <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Keluar</a></li>
        </ul>
    </li>
<?php } ?>
    <li class="menu-item-has-children dropdown">
        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="menu-icon fas fa-tachometer-alt"></i><span class="hide-menu">Statistik</span></a>
        <ul class="sub-menu children dropdown-menu">
            <li><a href="utama.php?view=admin&action=dashboard&qariah=semua">&nbsp;Ahli Kariah</a></li>
            <?php if($_SESSION['user_type_id'] != 10)  { ?>
            <li><a href="utama.php?view=admin&action=dashboard_payment">&nbsp;Bayaran</a></li>
            <li><a href="utama.php?view=admin&action=dashboard_bantuan">&nbsp;Bantuan</a></li>
            <?php } ?>
        </ul>
    </li>
	<li>
        <a href="utama.php?view=admin&action=kewangan">
            <i class="menu-icon fas fa-money-bill-alt"></i><span class="hide-menu">&nbsp;Kewangan</span>
        </a>
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