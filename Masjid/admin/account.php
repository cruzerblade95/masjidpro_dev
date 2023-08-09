<?php
include ($_SERVER['DOCUMENT_ROOT']."/Masjid/accounts/headerAccount.php");
?>
<div class="row page-titles">
    <div class="col-md-4 align-self-center">
        <h4 class="text-themecolor font-weight-bold">Kewangan (<?php echo $_GET['training'] == NULL ? "Modul Sebenar" : "Modul Latihan"; ?>)</h4>
    </div>
    <div class="col-md-4 align-self-center">
        <select style="display: none" class="form-control font-weight-bold" id="training" name="training" onchange="tukarMode(this.value)">
            <option class="font-weight-bold" value="" <?php if($_GET['training'] == NULL) echo("selected"); ?>>Modul Sebenar</option>
            <option class="font-weight-bold" value="1" <?php if($_GET['training'] == 1) echo("selected"); ?>>Modul Latihan (Demo)</option>
        </select>
    </div>
    <div class="col-md-4 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb font-weight-bold">
                <li class="breadcrumb-item"><a href="utama.php?view=admin&action=utama">Utama</a></li>
                <?php if($_GET['subModul'] == NULL) { ?><li class="breadcrumb-item active">Kewangan</li><?php } else { ?>
                    <li class="breadcrumb-item"><a href="utama.php?view=admin&action=kewangan&newModul=1<?php echo $_GET['training'] == 1 ? "&training=1" : NULL; ?>">Kewangan</a></li>
                    <li class="breadcrumb-item active"><?php echo($tajukSubModul); ?></li>
                <?php } ?>
            </ol>
        </div>
    </div>
</div>
<?php
if($_GET['subModul'] != NULL) include($_SERVER['DOCUMENT_ROOT']."/Masjid/accounts/sub_".$_GET['subModul'].".php");
else include($_SERVER['DOCUMENT_ROOT']."/Masjid/accounts/main.php");
?>