<?php
$q = "SELECT * FROM sliderMenuUtama";
selValueSQL($q, "slideNews");
?>
<style type="text/css">
    .card:hover{
        transform: scale(1.25);
        box-shadow: 0 20px 40px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
    }
    .text-white {font-size: 20pt}
    .footer {display: none}
</style>
<br />
<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel" align="center" style2="position: fixed; top: 0; left: 0; width: 100%">
    <ol class="carousel-indicators">
        <?php for($k = 0; $k < $num_slideNews; $k++) { ?>
        <li data-target="#carouselExampleIndicators2" data-slide-to="<?php echo($k); ?>" <?php if($k == 0) echo('class="active"'); ?>></li>
        <?php } ?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php $i = 0; do { ?>
        <div class="carousel-item <?php if($i == 0) echo("active"); ?>">
            <img class="img-fluid" style="max-height: 350px;" src="<?php echo($row_slideNews['image']); ?>">
            <!--div style="height: 350px; background-image: url('<?php echo($row_slideNews['image']); ?>'); background-size: cover; background-repeat: no-repeat; background-position: center"></div-->
        </div>
        <?php $i++; } while($row_slideNews = mysqli_fetch_assoc($fetch_slideNews)); ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<hr />
<div class="row" style="position: fixed; bottom: 0; left: 0; width: 100%; padding-right: 0px; padding-left: 20px">
    <div class="col-12 col-md-4" onclick="document.location.href='utama.php?view=admin&action=dashboard&sideMenu=kariah'">
        <div class="card border-info">
            <div class="card-header bg-royal" align="center">
                <h2 class="m-b-0 text-white">Pengurusan<br />Kariah</h2>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4" onclick="document.location.href='utama.php?view=admin&action=profil&sideMenu=masjid'">
        <div class="card border-info">
            <div class="card-header bg-royal" align="center">
                <h2 class="m-b-0 text-white">Pengurusan<br />Masjid</h2>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4" onclick="document.location.href='utama.php?view=admin&action=dashboard_tetapan&sideMenu=organisasi'">
        <div class="card border-info">
            <div class="card-header bg-royal" align="center">
                <h2 class="m-b-0 text-white">Pengurusan<br />Organisasi</h2>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4" onclick="document.location.href='utama.php?view=admin&action=infaq&sideMenu=wakafinfaq'">
        <div class="card border-info">
            <div class="card-header bg-royal" align="center">
                <h2 class="m-b-0 text-white">Infaq dan<br />Wakaf</h2>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4" onclick="document.location.href='utama.php?view=admin&action=gomasjidpro'">
        <div class="card border-info">
            <div class="card-header bg-royal" align="center">
                <h2 class="m-b-0 text-white">GoMasjid<br />Pro</h2>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4" onclick="document.location.href='latihan/'">
        <div class="card border-info">
            <div class="card-header bg-royal" align="center">
                <h2 class="m-b-0 text-white">Latihan<br />Bimbingan</h2>
            </div>
        </div>
    </div>
</div>