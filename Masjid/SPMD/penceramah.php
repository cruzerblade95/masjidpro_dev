<?php

include('../daftar_online/connection.php');

if(isset($_POST['submit']))
{

    $nama=$_POST['nama'];
    $no_ic=$_POST['no_ic'];
    $jenis_aduan=$_POST['jenis_aduan'];
    $aduan=$_POST['aduan'];
    $cadangan=$_POST['cadangan'];
    $id_masjid=$_POST['id_masjid'];

    $sql1="INSERT INTO";
    //$sqlquery1=mysql_query($sql1,$bd);

    //if($sqlquery1)
    //{
       // header("Location:aduan.php?id_masjid=".$id_masjid."&status=1");
    //}
}
?>
<!DOCTYPE html>
<html lang="en">

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
    <title>Masjid Pro</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="../apple-icon.png">
    <link rel="shortcut icon" href="../favicon.ico">


    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="../assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body style="position:relative; background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
<div class="col-lg-12">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6">
        <br><br><br><br><br>

        <?php
        if(isset($_GET['no_ic']))
        {
            ?>
            <div class="card">
                <div class="card-header" style="background-color:#32C9FF">
                    <center>
                        <img src="../picture/masjidpro.png" height="100" width="250">
                    </center>
                </div>
                <div class="card-body">
                    <form method="POST" action="penceramah.php">
                        <div class="form-group" align="center">
                            <h4>
                                Maklumat Peribadi
                            </h4>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label>Nama Penuh</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label>No Kad Pengenalan</label>
                            <input type="text" class="form-control" name="no_ic" required minlength="12" maxlength="12">
                        </div>
                        <div class="form-group">
                            <label>No Telefon</label>
                            <input type="text" class="form-control" name="no_hp" required>
                        </div>
                        <div class="form-group">
                            <label>Attach Tauliah</label>
                            <input type="file" name="tauliah" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-primary btn-block" type='submit' name="submit">Hantar Maklumat</button>
                        </div>
                        <?php
                        if(isset($_GET['status']))
                        {
                            ?>
                            <div class="alert alert-success alert-dismissable">
                                <center>
                                    Permohonan Berjaya Dihantar
                                </center>
                            </div>
                            <?php
                        }
                        ?>
                        <input type="hidden" name="id_masjid" value="<?php echo $_GET['id_masjid']; ?>">
                        <hr>
                        <div align="center">MyRich Dynasty © | 2019</div>
                    </form>
                </div>
            </div>
            <?php
        }
        else
        {
            ?>
            <div class="card">
                <div class="card-header" style="background-color:#32C9FF">
                    <center>
                        <img src="../picture/masjidpro.png" height="100" width="250">
                    </center>
                </div>
                <div class="card-body">
                    <form method="GET" action="penceramah.php">
                        <div class="form-group" align="center">
                            <h4>
                                DAFTAR SEBAGAI PENCERAMAH
                            </h4>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label>No Kad Pengenalan</label>
                            <input type="text" class="form-control" name="no_ic" required minlength="12" maxlength="12">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-primary btn-block" type='submit'>Daftar</button>
                        </div>
                        <?php
                        if(isset($_GET['status']))
                        {
                            ?>
                            <div class="alert alert-success alert-dismissable">
                                <center>
                                    No Kad Pengenalan Sudah Berdaftar
                                </center>
                            </div>
                            <?php
                        }
                        ?>
                        <hr>
                        <div align="center">MyRich Dynasty © | 2019</div>
                    </form>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</body>
</html>
