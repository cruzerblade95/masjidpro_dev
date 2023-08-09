<?php
include("db.php");
include("frameworks.php");

$kira_result = "SELECT COUNT(*) 'jumlah', SUM(amaun) 'diperlukan' FROM sej6x_data_bantuan WHERE status_bantuan = 1";
$q_kira = mysqli_query($conn, $kira_result) or die(mysqli_error($conn));
$q_kira2 = mysqli_fetch_assoc($q_kira);
$jum_result = $q_kira2['jumlah'];
$diperlukan = $q_kira2['diperlukan'];

$q_donor = "SELECT COUNT(*) 'jumlah', SUM(amaun) 'diperolehi' FROM sej6x_bayar_online WHERE status_bayaran = '1' AND id_bayaran IS NOT NULL";
$q_donor2 = mysqli_query($conn, $q_donor);
$q_result2 = mysqli_fetch_assoc($q_donor2);
$jum_donor = $q_result2['jumlah'];
$jum_dapat = $q_result2['diperolehi'];
$percent = round(($jum_dapat / $diperlukan) * 100);
if($percent > 100) $percent = 100;

$muka = $_GET['p'];
if($muka == NULL) $muka = 1;
$per_muka = 9;
$mula = ($muka * $per_muka) - $per_muka;
if($jum_result > 9) $muka_surat = "LIMIT $mula, $per_muka";

$q = "SELECT * FROM sej6x_data_bantuan a, sej6x_data_peribadi b, sej6x_data_masjid c WHERE a.id_data = b.id_data AND a.id_masjid = c.id_masjid AND a.status_bantuan = 1 ORDER BY tarikh_mohon DESC $muka_surat";
$q_result = mysqli_query($conn, $q);
$q_num = mysqli_num_rows($q_result);
$q_list = mysqli_fetch_assoc($q_result);

include("header.php");
?>
    <body class="home">
    <div class="preloading">
        <div class="preloader loading">
            <span class="slice"></span>
            <span class="slice"></span>
            <span class="slice"></span>
            <span class="slice"></span>
            <span class="slice"></span>
            <span class="slice"></span>
        </div>
    </div>
<div id="wrapper">
<?php include("header-menu.php"); ?>
    <main id="main" class="site-main">
        <div class="sideshow">
            <div class="container">
                <div class="sideshow-content">
                    <h1 class="wow fadeInUp" data-wow-delay=".2s">Membantu anda menyumbang kepada yang memerlukan dimana saja</h1>
                    <div class="sideshow-description wow fadeInUp" data-wow-delay=".1s">Data yang terkumpul setakat ini.</div>
                    <div class="process wow fadeInUp" data-scroll-nav="1">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo($percent); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo($percent); ?>%"></div>
                        </div>
                        <div class="process-info">
                            <div class="process-funded"><span>RM<?php echo($jum_dapat); ?></span>diperolehi</div>
                            <div class="process-pledged"><span>RM<?php echo($diperlukan); ?></span>diperlukan</div>
                            <div class="process-backers"><span><?php echo($jum_result); ?></span>kempen</div>
                            <div class="process-backers"><span><?php echo($jum_donor); ?></span>penderma</div>
                        </div>
                    </div>
                </div><!-- .sideshow-content -->
            </div>
        </div><!-- .sideshow -->
        <div class="latest campaign">
            <div class="container">
                <h2 class="title">Senarai Kempen Bantuan Terkini</h2>
                <div class="description">Anda boleh membantu menderma bagi yang memerlukan serendah RM10</div>
                <div class="campaign-content">
                    <div class="row">
                        <?php if($jum_result > 0) {
                            $jum_result2 = 0;
                            do {
                                $q_individu = "SELECT COUNT(*) 'jumlah', SUM(amaun) 'diperolehi' FROM sej6x_bayar_online WHERE status_bayaran = '1' AND id_bayaran = ".$q_list['id_bantuan'];
                                $q_individu2 = mysqli_query($conn, $q_individu);
                                $q_result3 = mysqli_fetch_assoc($q_individu2);
                                $jum_donor2 = $q_result3['jumlah'];
                                $jum_dapat2 = $q_result3['diperolehi'];
                                $percent2 = round(($jum_dapat2 / $q_list['amaun']) * 100);
                                if($percent2 > 100) $percent2 = 100;
                                if($q_list['nama_penuh'] != NULL) {
                                    $jum_result2 = $jum_result2 + 1;
                                    ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="campaign-item">
                                            <?php if($q_list['gambar'] != NULL) { ?>
                                                <a class="overlay" href="#">
                                                    <img src="gambar/<?php echo($q_list['id_masjid']); ?>/<?php echo($q_list['id_bantuan']); ?>/<?php echo($q_list['gambar']); ?>">
                                                    <span class="ion-ios-search-strong"></span>
                                                </a>
                                            <?php } ?>
                                            <div class="campaign-box">
                                                <a href="#" class="category"><?php echo($q_list['jenis_bantuan']); ?></a>
                                                <h3><a href="#"><?php echo($q_list['tujuan']); ?></a></h3>
                                                <div class="campaign-description"><?php echo($q_list['jenis_bantuan']); ?> - <?php echo($q_list['tujuan']); ?></div>
                                                <div class="campaign-author">oleh <a class="author-name" href="#"><?php echo($q_list['nama_penuh']); ?></a><br />Ahli Kariah <?php echo($q_list['nama_masjid']); ?></div>
                                                <div class="process">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo($percent2); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo($percent2); ?>%"></div>
                                                    </div>
                                                    <div class="process-info">
                                                        <div class="process-pledged"><span>RM<?php echo($q_list['amaun']); ?></span>diperlukan</div>
                                                        <div class="process-funded"><span>RM<?php echo($jum_dapat2); ?></span>diperoleh</div>
                                                        <div class="process-backers"><span><?php echo($jum_donor2); ?></span>penderma</div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <a href="../SPMD/detail_bantuan.php?id_bantuan=<?php echo($q_list['id_bantuan']); ?>"><button class="btn btn-primary">Derma</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } } while($q_list = mysqli_fetch_assoc($q_result)); } if($jum_result == 0 || $jum_result2 == 0) { ?>
                            <div class="col-md-12 col-12">
                                <div class="alert alert-danger">Tiada kempen bantuan oleh ahli kariah buat masa ini.</div>
                                <div class="alert alert-primary">Namun anda boleh membuat sumbangan yang lain dengan klik menu dibawah</div>
                                <a href="../SPMD/login.php?sumbang=1"><button class="btn btn-primary">Sumbangan</button></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php if($jum_result > $per_muka) { ?>
                    <div align="center"><nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav></div>
                <?php } ?>
            </div>
        </div><!-- .latest -->
        <div class="partners" style="display: none">
            <div class="container">
                <div class="partners-slider owl-carousel">
                    <div><a href="#"><img src="images/partner-01.png" alt=""></a></div>
                    <div><a href="#"><img src="images/partner-02.png" alt=""></a></div>
                    <div><a href="#"><img src="images/partner-03.png" alt=""></a></div>
                    <div><a href="#"><img src="images/partner-04.png" alt=""></a></div>
                    <div><a href="#"><img src="images/partner-05.png" alt=""></a></div>
                    <div><a href="#"><img src="images/partner-06.png" alt=""></a></div>
                </div>
            </div>
        </div><!-- .partners -->
    </main><!-- .site-main -->
<?php include("footer.php"); ?>