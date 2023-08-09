<?php
//$secret = md5($_POST['kod_masjid']);
//$binn = bin2hex($_POST['kod_masjid']."-".$secret);
//# 74686174277320616c6c20796f75206e656564

//$hexx = hex2bin('362e3139333132322d6337633764373436363134616332656161616566393838646166626236643062');
# that's all you need

//$hexx = substr($hexx, 0, strpos($hexx, "-"));
//echo($binn.' :: '.$hexx);
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $kod_masjid = $_POST['kod_masjid'];
    $k1 = md5($kod_masjid);
    $k2 = hash('sha512', $kod_masjid);
    $kod_lokasi = $k1 . '-' . $k2;
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.css" integrity="sha512-Mg1KlCCytTmTBaDGnima6U63W48qG1y/PnRdYNj3nPQh3H6PVumcrKViACYJy58uQexRUrBqoADGz2p4CdmvYQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Masjid Pro :: Janaan Kod Lokasi</title>
</head>
<body>
<div class="jumbotron jumbotron-fluid">
    <h1 class="display-4">Janaan Kod Lokasi Masjid Pro</h1>
    <?php if($_SERVER['REQUEST_METHOD'] == "POST") { ?>
        <div class="alert alert-success font-weight-bold" role="alert">
            Kod lokasi masjid: <?php echo($kod_lokasi); ?>
        </div>
    <?php } ?>
    <form name="jana_kod" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="col-12 col-md-6">
                <label>Kod Masjid</label>
                <input name="kod_masjid" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <button class="btn btn-primary" type="submit">Jana Kod</button>
            </div>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.1/umd/popper.js" integrity="sha512-XQoeBcMhSbY8p1wDZWtaQZMOgqIb7QuGmh/8/EwA/xTzoREW+tcOvm5wPU4WnbAEX19LFkMXQh8YKzrIJfg9zQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.js" integrity="sha512-nw7zwODD4UD9u/C/CO+03s7jXvOZDomBNFX3oOq7Xv0stAyxsxhJzVlxsRTgH3AxK3sK2ijMQou2aSIaorp19g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>