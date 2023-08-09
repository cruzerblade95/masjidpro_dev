<?php
$host = "localhost";
$user = "tahfizte_spmd";
$pass = "WebmasterMasjid2019";
$db = "tahfizte_masjidpro";

$conn = mysqli_connect($host, $user, $pass, $db) or die(mysqli_error($conn));
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if($_GET['html'] != 1) header("Content-Type: application/javascript");
if($_GET['json'] == 1) header("Content-Type: application/json; charset=UTF-8");

mysqli_query($conn, "SET NAMES 'utf8'");
$q = "SELECT * FROM bukhari ORDER BY RAND() LIMIT 1";
$q2 = mysqli_query($conn, $q) or die(mysqli_error($conn));
$row_q = mysqli_fetch_assoc($q2);
$kitab = $row_q['Kitab'];
$arab = $row_q['Arab'];
$terjemah = $row_q['Terjemah'];

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
        <title>Hadis</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.js" integrity="sha512-g6uKBhbH4/FmsKhkup5OCgdNJ6hHQxcJZ7jPPF5lI7ZTeQtBqTC0B0nT1Rg15blk6pnOd5CoMUwvXSxjaYUzuA==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.js" integrity="sha512-KCgUnRzizZDFYoNEYmnqlo0PRE6rQkek9dE/oyIiCExStQ72O7GwIFfmPdkzk4OvZ/sbHKSLVeR4Gl3s7s679g==" crossorigin="anonymous"></script>
    </head>
    <body>
<?php } if ($_GET['html'] != 1 && $_GET['json'] != 1) { ?>
    var isi = (function () {/*
<?php } if($_GET['json'] != 1) { ?>
<?php if($_GET['latar'] == 1) { ?>
        <?php if($_GET['style'] == NULL) { ?><div id="HadisWidget" class="MPwidget" style="background: white; opacity: 0.7; font-weight: bolder; border-radius: 25px; padding: 20px; width: auto; max-height: 390px; overflow: scroll"><?php } ?>
    <?php if($_GET['style'] == 1) { ?><div id="HadisWidget" class="MPwidget"><?php } ?>
    <h2>Hadis</h2>
    <?php } else { ?>
    <div class="MPwidget">
        <?php } ?>
        <div class="MPheader">
            <div class="title"><a href="#">Sahih Bukhari</a></div>
        </div>
        <table class="MPtimetable" align="right">
            <tbody>
            <tr style="display: none">
                <th><?php echo($arab); ?></th>
            </tr>
            <tr>
                <th><?php echo($terjemah); ?></th>
            </tr>
            <tr>
                <th>Kitab: <?php echo($kitab); ?></th>
            </tr>
            </tbody>
        </table>
    <?php if($_GET['latar'] != 1) { ?>
        <div class="MPfooter" align="center">
            Dijanakan oleh <a href="https://www.masjidpro.com" target="_blank">Masjid Pro</a>
        </div>
    <?php } ?>
    </div>
<?php } if($_GET['html'] != 1 && $_GET['json'] != 1) { ?>
    */}).toString().match(/[^]*\/\*([^]*)\*\/\}$/)[1];
    document.writeln(isi);
<?php } if($_GET['html'] == 1 && $_GET['json'] != 1) { ?>
    </body>
    </html>
<?php } if($_GET['json'] == 1) {

    $hadis['arab'] = $arab;
    $hadis['terjemah'] = $terjemah;
    $hadis['kitab'] = $kitab;

    echo '{"hadis_soheh":';
    echo(json_encode($hadis, JSON_UNESCAPED_UNICODE));
    echo '}';
}
mysqli_close($conn);
?>