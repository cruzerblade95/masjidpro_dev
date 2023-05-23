<?php

    include('../connection/connection.php');

    if(isset($_GET['id_masjid']))
    {
        $id_masjid = $_GET['id_masjid'];

        if(isset($_GET['no_ic']))
        {
            $no_ic = $_GET['no_ic'];

            $sql = "SELECT * FROM sej6x_data_peribadi WHERE no_ic='$no_ic'";
            $sqlquery = mysql_query($sql,$bd);
            $data = mysql_fetch_array($sqlquery);
            $row = mysql_num_rows($sqlquery);

            if($row==0)
            {
                header("Location:temujanji.php?id_masjid=".$id_masjid."&error=1");
            }
        }
    }

    if(isset($_POST['submit']))
    {
        $id_masjid = $_POST['id_masjid'];
        $ajk_pegawai = $_POST['ajk_pegawai'];
        $no_ic = $_POST['no_ic'];
        $id_data = $_POST['id_data'];
        $tarikh = $_POST['tarikh'];
        $masa = $_POST['masa'];
        $tujuan = $_POST['tujuan'];

        echo $sql2 = "INSERT INTO sej6x_data_temujanji (id_masjid,ajk_pegawai,id_data,tarikh,masa,tujuan,status) VALUES ('$id_masjid','$ajk_pegawai','$id_data','$tarikh','$masa','$tujuan','0')";
        $sqlquery2 = mysql_query($sql2,$bd);

        if($sqlquery2)
        {
            header("Location:temujanji.php?no_ic=".$no_ic."&id_masjid=".$id_masjid."&status=1");
        }
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
        <div class="card">
            <div class="card-header" style="background-color:#32C9FF">
                <center>
                    <img src="../picture/masjidpro.png" height="100" width="250">
                </center>
            </div>
            <div class="card-body">
                <?php
                    if(!isset($_GET['no_ic']))
                    {
                ?>
                <form method="GET" action="temujanji.php">
                    <div class="form-group">
                        <label>No Kad Pengenalan</label>
                        <input type="text" name="no_ic" class="form-control" minlength="12" maxlength="12" required>
                    </div>
                    <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" type='submit'>Log Masuk</button>
                    </div>
                    <?php
                    if(isset($_GET['error']))
                    {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        Anda Belum Berdaftar Sebagai Ahli Kariah <a href="login.php" class="btn btn-primary">Daftar Kariah</a>
                    </div>
                    <?php
                    }
                    ?>
                    <hr>
                    <div align="center">MyRich Dynasty © | 2019</div>
                </form>
                <?php
                    }
                    else if(isset($_GET['no_ic']))
                    {
                ?>
                <form method="POST" action="temujanji.php" enctype="multipart/form-data">
                    <div class="form-group" align="center">
                        <h4>
                            <?php
                            $id_masjid=$_GET['id_masjid'];
                            $sql1="SELECT * FROM sej6x_data_masjid WHERE id_masjid='$id_masjid'";
                            $sqlquery1=mysql_query($sql1,$bd);
                            $data1=mysql_fetch_array($sqlquery1);

                            echo $data1['nama_masjid'];
                            echo "<br>";
                            echo "Borang Permohonan Temujanji";

                            ?>
                        </h4>
                        <br>
                        <div class="alert alert-info">
                            <center>
                                Nama : <?php echo $data['nama_penuh']; ?><br>
                                No K/P : <?php echo $data['no_ic']; ?><br>
                                No Telefon : <?php echo $data['no_hp']; ?>
                            </center>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>Temujanji Bersama</label>
                        <select name="ajk_pegawai" class="form-control" required>
                            <option value="">Sila Pilih:-</option>
                            <option value="Pengerusi">Pengerusi</option>
                            <option value="Setiausaha">Setiausaha</option>
                            <option value="Bendahari">Bendahari</option>
                            <option value="AJK">AJK</option>
                            <option value="Imam">Imam</option>
                            <option value="Bilal">Bilal</option>
                            <option value="Siak">Siak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tarikh</label>
                        <input type="date" name="tarikh" required class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>No Kad Pengenalan</label>
                        <input type="time" class="form-control" name="masa" required>
                    </div>
                    <div class="form-group">
                        <label>Tujuan</label>
                        <textarea class="form-control" name="tujuan" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" type='submit' name="submit">Hantar Permohonan</button>
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
                    <input type="hidden" name="no_ic" value="<?php echo $data['no_ic']; ?>">
                    <input type="hidden" name="id_data" value="<?php echo $data['id_data']; ?>">
                    <hr>
                    <div align="center">MyRich Dynasty © | 2019</div>
                </form>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
