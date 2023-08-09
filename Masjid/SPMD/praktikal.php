<?php

include('../daftar_online/connection.php');

if(isset($_POST['submit']))
{
    
    $id_masjid = $_POST['id_masjid'];
    $nama_penuh = $_POST['nama_penuh'];
    $no_ic = $_POST['no_ic'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $tahap_pengajian = $_POST['tahap_pengajian'];
    $bidang = $_POST['bidang'];
    $pusat_pengajian = $_POST['pusat_pengajian'];
    $semester = $_POST['semester'];
	$tarikh_mula = $_POST['tarikh_mula'];
	$tarikh_tamat = $_POST['tarikh_tamat'];

    $filetype = $_FILES['surat']['type'];
    $imgData = addslashes(file_get_contents($_FILES['surat']['tmp_name']));
    $imageProperties = getimagesize($_FILES['surat']['tmp_name']);

    $sql1 = "INSERT INTO sej6x_data_praktikal (id_masjid,nama_penuh,no_ic,no_hp,alamat,tahap_pengajian,pusat_pengajian,bidang,semester,tarikh_mula,tarikh_tamat,file_surat,jenis_file,status) VALUES ('$id_masjid','$nama_penuh','$no_ic','$no_hp','$alamat','$tahap_pengajian','$pusat_pengajian','$bidang','$semester','$tarikh_mula','$tarikh_tamat','$imgData','$filetype','0')";
    $sqlquery1 = mysql_query($sql1,$bd);

    if($sqlquery1)
    {
        header("Location:praktikal.php?id_masjid=".$id_masjid."&status=1");
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
                <form method="POST" action="praktikal.php" enctype="multipart/form-data">
                    <div class="form-group" align="center">
                        <h4>
                            <?php
                            $id_masjid=$_GET['id_masjid'];
                            $sql="SELECT * FROM sej6x_data_masjid WHERE id_masjid='$id_masjid'";
                            $sqlquery=mysql_query($sql,$bd);
                            $data=mysql_fetch_array($sqlquery);

                            echo $data['nama_masjid'];
                            echo "<br>";
                            echo "Borang Permohonan Praktikal";

                            ?>
                        </h4>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>Nama Penuh</label>
                        <input type="text" name="nama_penuh" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No Kad Pengenalan</label>
                        <input type="text" class="form-control" name="no_ic" required minlength="12" maxlength="12">
                    </div>
                    <div class="form-group">
                        <label>No Telefon</label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea rows="4" class="form-control" name="alamat" required>
					    </textarea>
                    </div>
                    <div clas="form-group">
                        <label>Tahap Pengajian</label>
                        <select name="tahap_pengajian" class="form-control" required>
                            <option value="">Sila Pilih:-</option>
                            <option value="Asasi">Asasi</option>
                            <option value="Diploma">Diploma</option>
                            <option value="Degree">Degree</option>
                            <option value="Lain-Lain">Lain-Lain</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bidang Belajar</label>
                        <input type="text" name="bidang" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Pusat Pengajian</label>
                        <input type="text" name="pusat_pengajian" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <select class="form-control" name="semester" required>
                            <option value="">Sila Pilih:-</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                    </div>
					<div class="form-group">
                        <label>Tarikh Mula Praktikal</label>
                        <input type="date" name="tarikh_mula" class="form-control" required>
                    </div>
					<div class="form-group">
                        <label>Tarikh Tamat Praktikal</label>
                        <input type="date" name="tarikh_tamat" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Attach Surat Permohonan</label>
                        <input type="file" name="surat" class="form-control" required>
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
                    <hr>
                    <div align="center">MyRich Dynasty © | 2019</div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
