<?php
if($_GET['html'] != 1) {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header("Content-Type: application/javascript");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
}
if($_GET['json'] == 1) header("Content-Type: application/json; charset=UTF-8");
include("fungsi_tarikh.php");
//Data JSON Waktu Solat JAKIM Setahun
$zon = $_GET['zon'];
if($zon == NULL) $zon = "PNG01";
//$date = date_create(date());
$date = date_create('2021-08-01');
$tarikh_check = date_format($date,"Y-m-d");
$hari_tahun = date_format($date,"z");
$JSONdata = file_get_contents("https://www.e-solat.gov.my/index.php?r=esolatApi/takwimsolat&period=year&zone=".$zon);
//$JSONdata = str_replace('Ogos', 'Aug', $JSONdata);
$data_solat = json_decode($JSONdata, true);
//echo($JSONdata);
if ($data_solat['prayerTime'][$hari_tahun]['date'] == fungsi_tarikh($tarikh_check, 11, 99)) {
    //$hari_ini_date = date_format(date_create(date()), 'Y-m-d');
    $hari_ini_date = date_format(date_create('2021-08-02'), 'Y-m-d');
    $imsak_cd = $hari_ini_date . ' ' . $data_solat['prayerTime'][$hari_tahun]['imsak'];
    $subuh_cd = $hari_ini_date . ' ' . $data_solat['prayerTime'][$hari_tahun]['fajr'];
    $syuruk_cd = $hari_ini_date . ' ' . $data_solat['prayerTime'][$hari_tahun]['syuruk'];
    $zohor_cd = $hari_ini_date . ' ' . $data_solat['prayerTime'][$hari_tahun]['dhuhr'];
    $asar_cd = $hari_ini_date . ' ' . $data_solat['prayerTime'][$hari_tahun]['asr'];
    $maghrib_cd = $hari_ini_date . ' ' . $data_solat['prayerTime'][$hari_tahun]['maghrib'];
    $isyak_cd = $hari_ini_date . ' ' . $data_solat['prayerTime'][$hari_tahun]['isha'];


    $imsak = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['imsak']), "g:i A");
    $imsak2 = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['imsak']), "Y-m-d H:i:s");
    $subuh = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['fajr']), "g:i A");
    $subuh2 = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['fajr']), "Y-m-d H:i:s");
    $syuruk = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['syuruk']), "g:i A");
    $syuruk2 = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['syuruk']), "Y-m-d H:i:s");
    $zohor = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['dhuhr']), "g:i A");
    $zohor2 = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['dhuhr']), "Y-m-d H:i:s");
    $asar = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['asr']), "g:i A");
    $asar2 = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['asr']), "Y-m-d H:i:s");
    $maghrib = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['maghrib']), "g:i A");
    $maghrib2 = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['maghrib']), "Y-m-d H:i:s");
    $isyak = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['isha']), "g:i A");
    $isyak2 = date_format(date_create("$tarikh_check " . $data_solat['prayerTime'][$hari_tahun]['isha']), "Y-m-d H:i:s");
}
//echo count($data_solat['prayerTime']).' - '.$hari_tahun;
if($_GET['html'] == 1) {
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css" integrity="sha512-drnvWxqfgcU6sLzAJttJv7LKdjWn0nxWCSbEAtxJ/YYaZMyoNLovG7lPqZRdhgL1gAUfa+V7tbin8y+2llC1cw==" crossorigin="anonymous" />
        <title>Waktu Solat</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.js" integrity="sha512-g6uKBhbH4/FmsKhkup5OCgdNJ6hHQxcJZ7jPPF5lI7ZTeQtBqTC0B0nT1Rg15blk6pnOd5CoMUwvXSxjaYUzuA==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.js" integrity="sha512-KCgUnRzizZDFYoNEYmnqlo0PRE6rQkek9dE/oyIiCExStQ72O7GwIFfmPdkzk4OvZ/sbHKSLVeR4Gl3s7s679g==" crossorigin="anonymous"></script>
    </head>
    <body>
<?php } if ($_GET['html'] != 1 && $_GET['json'] != 1) { ?>
    var isi = (function () {/*
    <?php } if($_GET['json'] != 1) { ?>
    <div class="MPwidget">
        <div class="MPheader">
            <div class="title"><a href="#">Seluruh Pulau Pinang</a></div>
        </div>
        <table class="MPtimetable">
            <tbody>
            <tr>
                <td colspan="2" align="center">
                    <div class="daterow" align="center" style="line-height: 1.5"><?php fungsi_tarikh($tarikh_check, 2, 1)?></div>
                    <div class="daterow" align="center"><?php fungsi_tarikh($tarikh_check, 2, 5)?></div>
                </td>
            </tr>
            <tr>
                <td>Imsak</td>
                <td><?php echo($imsak); ?></td>
            </tr>
            <tr>
                <td>Subuh</td>
                <td><?php echo($subuh); ?></td>
            </tr>
            <tr>
                <td>Syuruk</td>
                <td><?php echo($syuruk); ?></td>
            </tr>
            <tr>
                <td>Zohor</td>
                <td><?php echo($zohor); ?></td>
            </tr>
            <tr>
                <td>Asar</td>
                <td><?php echo($asar); ?></td>
            </tr>
            <tr>
                <td>Maghrib</td>
                <td><?php echo($maghrib); ?></td>
            </tr>
            <tr>
                <td>Isyak</td>
                <td><?php echo($isyak); ?></td>
            </tr>
            </tbody>
        </table>
        <div class="MPfooter" align="center">
            Dijanakan oleh <a href="https://www.masjidpro.com" target="_blank">Masjid Pro</a><br/>
            Waktu Solat oleh <a href="https://www.e-solat.gov.my" target="_blank">JAKIM</a>
        </div>
    </div>
<?php } if($_GET['html'] != 1 && $_GET['json'] != 1) { ?>
    */}).toString().match(/[^]*\/\*([^]*)\*\/\}$/)[1];
    document.writeln(isi);
<?php } if($_GET['html'] == 1 && $_GET['json'] != 1) { ?>
    </body>
    </html>
<?php } if($_GET['json'] == 1) {
    $waktuSolat['masihi'] = fungsi_tarikh($tarikh_check, 2, 99);
    $waktuSolat['hijrah'] = fungsi_tarikh($tarikh_check, 2, 100);
    $waktuSolat['imsak'] = $imsak;
    $waktuSolat['subuh'] = $subuh;
    $waktuSolat['syuruk'] = $syuruk;
    $waktuSolat['zohor'] = $zohor;
    $waktuSolat['asar'] = $asar;
    $waktuSolat['maghrib'] = $maghrib;
    $waktuSolat['isyak'] = $isyak;
    $waktuSolat['imsak2'] = $imsak2;
    $waktuSolat['subuh2'] = $subuh2;
    $waktuSolat['syuruk2'] = $syuruk2;
    $waktuSolat['zohor2'] = $zohor2;
    $waktuSolat['asar2'] = $asar2;
    $waktuSolat['maghrib2'] = $maghrib2;
    $waktuSolat['isyak2'] = $isyak2;

    echo '{"waktu_solat":';
    echo(json_encode($waktuSolat));
    echo '}';
} ?>