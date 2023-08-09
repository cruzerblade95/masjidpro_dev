<?php
require_once '../../Mobile_Detect.php';
$versiStore = "3.0.1";
$detect = new Mobile_Detect;
if($_GET['keterangan'] == 1 || $_GET['keterangan'] == 2) {
    require_once '../../Mobile_Detect.php';
    $detect = new Mobile_Detect;
    $ejen = $_SERVER['HTTP_USER_AGENT'];
    $userid = $_GET['userid'];
    $jenisUser = $_GET['jenisUser'];
    $hide = $_GET['hide'];
    if($_GET['versi'] != NULL) {
        if($_GET['versi'] == $versiStore) $hide = 1;
    }
    $token = $_GET['token'];
    //if($detect->isAndroidOS()) $keterangan = 1;
    //else $keterangan = 2;
    $keterangan = $_GET['keterangan'];
    //if($detect->isAndroidOS() && $appBaru == 1) {
        //header("Location: https://masjidpro.com/Masjid/SPMD/Bantuan/bantuan_app.php?userid=$userid&jenisUser=$jenisUser&token=$token");
    //}
    if($hide == 1) header("Location: https://masjidpro.com/Masjid/SPMD/login.php?sumbang=1&keterangan=$keterangan&listBantuan=1&userid=$userid&jenisUser=$jenisUser&token=$token&hide=$hide");
    //echo($ejen);
}
//include("../../connection/connection.php");
//echo($_GET['token']);
//echo($_GET['jenisUser']);
//echo($_GET['no_ic']);
include("../../daftar_online/connection.php");
include("../../fungsi.php");
include("fungsi_tarikh.php");
if(isset($_POST['form_ic']))
{
    $id_masjid = $_POST['id_masjid'];
    $idd = $_POST['id_data'];
	$approved = $_POST['approved']; 
    $no_ic = $_POST['no_ic'];
    $jenis_bantuan = $_POST['jenis_bantuan'];
    $status_kerja = $_POST['status_kerja'];
    $tujuan_mohon = e($_POST['tujuan_mohon'], 1, NULL);
    //$tarikh_mohon = $_POST['tarikh_bantuan'];
    $tarikh_mohon = date('Y-m-d');
	
	$sql_check = "SELECT * FROM bantuan_zakat WHERE no_ic='$no_ic' AND tarikh_mohon='$tarikh_mohon'";
	$query_check = mysqli_query($bd2,$sql_check);
	$bil_check = mysqli_num_rows($query_check);
	if($bil_check==0)
	{
		if($approved==1)
		{
			$kariah_masjid = $_POST['kariah_masjid'];
			if(strpos($idd, 'A-') !== true) $sql = "INSERT INTO bantuan_zakat (kariah_masjid,status_kerja, tujuan, id_masjid,id_data,no_ic,jenis_bantuan,tarikh_mohon,status_bantuan) VALUES ('$kariah_masjid','$status_kerja', '$tujuan_mohon', '$id_masjid','$idd','$no_ic','$jenis_bantuan','$tarikh_mohon','0')";
			if(strpos($idd, 'A-') !== false) {
				$idd = str_replace('A-', '', $_POST['id_data']);
				$sql = "INSERT INTO bantuan_zakat (status_kerja,tujuan,id_masjid,ID,no_ic,jenis_bantuan,tarikh_mohon,status_bantuan) VALUES ('$status_kerja', '$tujuan_mohon', '$id_masjid','$idd','$no_ic','$jenis_bantuan','$tarikh_mohon','0')";
			}
		}
		else if($approved==0)
		{
			$kariah_masjid = $_POST['kariah_masjid']; 
			$nama_penuh = $_POST['nama_penuh'];
			$no_tel = $_POST['no_hp'];
			$status_perkahwinan = $_POST['status_perkahwinan'];
			$alamat_terkini = $_POST['alamat_terkini'];
			$id_negeri = $_POST['id_negeri'];
			$id_daerah = $_POST['id_daerah'];
			$poskod = $_POST['poskod'];
			$jumlah_tanggungan = $_POST['jumlah_tanggungan'];
			
			$sql = "INSERT INTO bantuan_zakat (kariah_masjid,nama_penuh,no_tel,status_perkahwinan,alamat_terkini,id_negeri,id_daerah,poskod,jumlah_tanggungan,status_kerja, tujuan, id_masjid,no_ic,jenis_bantuan,tarikh_mohon,status_bantuan) VALUES ('$kariah_masjid','$nama_penuh','$no_tel','$status_perkahwinan','$alamat_terkini','$id_negeri','$id_daerah','$poskod','$jumlah_tanggungan','$status_kerja', '$tujuan_mohon', '$id_masjid','$no_ic','$jenis_bantuan','$tarikh_mohon','0')";
		}
		$query = mysqli_query($bd2,$sql);
		
		if($query)
		{
			?>
			<script LANGUAGE='JavaScript'>
				window.alert('Permohonan Bantuan Berjaya Dihantar');
				//window.location.href='https://www.masjidpro.com/Masjid/SPMD/Bantuan/bantuan_app.php?no_ic=<?php echo $no_ic; ?>';
			</script>
			<?php
		}
	}
	else if($bil_check>0)
	{
		?>
			<script LANGUAGE='JavaScript'>
				window.alert('Maaf, Jumlah Permohonan Untuk Sehari Hanya Sekali\nSila Mohon Lain Pada Keesokan Hari');
				//window.location.href='https://www.masjidpro.com/Masjid/SPMD/Bantuan/bantuan_app.php?no_ic=<?php echo $no_ic; ?>';
			</script>
		<?php
	}
    
}
if(isset($_POST['form_passport']))
{
    $id_masjid = $_POST['id_masjid'];
    $nama_penuh = $_POST['nama_penuh'];
    $no_passport = $_POST['no_passport'];
    $no_tel = $_POST['no_tel'];
    $status_perkahwinan = $_POST['status_perkahwinan'];
    $alamat_terkini = $_POST['alamat_terkini'];
    $id_negeri = $_POST['id_negeri'];
    $id_daerah = $_POST['id_daerah'];
    $poskod = $_POST['poskod'];
    $jumlah_tanggungan = $_POST['jumlah_tanggungan'];
    $jenis_bantuan = $_POST['jenis_bantuan'];
	$status_kerja = $_POST['status_kerja'];
    $tujuan_mohon = e($_POST['tujuan'], 1, NULL);
    //$tarikh_bantuan = $_POST['tarikh_bantuan'];
    $tarikh_mohon = date('Y-m-d');

    $sql = "INSERT INTO bantuan_zakat (status_kerja,tujuan,id_masjid,no_passport,nama_penuh,no_tel,status_perkahwinan,alamat_terkini,id_negeri,id_daerah,poskod,jumlah_tanggungan,jenis_bantuan,tarikh_mohon,status_bantuan) VALUES ('$status_kerja', '$tujuan_mohon','$id_masjid','$no_passport','$nama_penuh','$no_tel','$status_perkahwinan','$alamat_terkini','$id_negeri','$id_daerah','$poskod','$jumlah_tanggungan','$jenis_bantuan','$tarikh_mohon','0')";
    $query = mysqli_query($bd2,$sql);

    if($query)
    {
        ?>
        <script LANGUAGE='JavaScript'>
            window.alert('Permohonan Bantuan Berjaya Dihantar');
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Masjid Pro - Permohonan Bantuan Masjid</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script>
	$(document).ready( function () {
		$('#myTable').DataTable();
	} );
	</script>
</head>
<body>


<div class="container-contact100">
    <div class="wrap-contact100">
			<span class="contact100-form-title">
				<img class="img-fluid" src="../../picture/logo_masjidpropenang.png"><br>
				Permohonan Bantuan Masjid
			</span>
        <hr>
        <?php
        if(isset($_POST['no_ic']) OR isset($_POST['no_passport']) OR isset($_GET['no_ic']) OR isset($_GET['no_passport']) OR $_SESSION['no_ic'] != NULL) {
            if(isset($_POST['no_ic']) OR isset($_GET['no_ic']) OR $_SESSION['no_ic'] != NULL) {
                if($_SESSION['no_ic'] != NULL) $no_ic = $_SESSION['no_ic'];
                else if(isset($_GET['no_ic'])) $no_ic = $_GET['no_ic'];
                else if(isset($_POST['no_ic'])) $no_ic = $_POST['no_ic'];
                $warganegara = $_POST['warganegara'];
                //$sql_ic = "SELECT id_data, id_masjid, nama_penuh, no_ic, no_hp, status_perkahwinan, umur, alamat_terkini, id_negeri, id_daerah, poskod FROM sej6x_data_peribadi WHERE no_ic LIKE '$no_ic'
                //			UNION
                //			SELECT CONCAT('A-', ID) 'id_data', id_masjid, nama_penuh, no_ic, no_tel 'no_hp', status_kahwin 'status_perkahwinan', umur, NULL 'alamat_terkini', NULL 'id_negeri', NULL 'id_daerah', NULL 'poskod' FROM sej6x_data_anakqariah WHERE no_ic LIKE '$no_ic'
                //            ";
                $sql_ic = "SELECT id_data, id_masjid, nama_penuh, no_ic, no_hp, status_perkahwinan, umur, alamat_terkini, id_negeri, id_daerah, poskod, 1 'approved' FROM sej6x_data_peribadi WHERE no_ic LIKE '$no_ic'
								UNION
								SELECT CONCAT('A-', ID) 'id_data', id_masjid, nama_penuh, no_ic, no_tel 'no_hp', status_kahwin 'status_perkahwinan', umur, NULL 'alamat_terkini', NULL 'id_negeri', NULL 'id_daerah', NULL 'poskod', 1 'approved' FROM sej6x_data_anakqariah WHERE no_ic LIKE '$no_ic'
                               UNION
                                SELECT id 'id_data', id_masjid, nama_penuh, no_ic, no_tel, status_perkahwinan, umur, no_rumah 'alamat_terkini', negeri 'id_negeri', daerah 'id_daerah', poskod, 0 'approved' FROM approve_qariah WHERE no_ic LIKE '$no_ic'
                                UNION
                                SELECT CONCAT('A-', ID) 'id_data', id_masjid, nama_penuh, no_ic, no_tel, status_kahwin 'status_perkahwinan', NULL 'umur', NULL 'alamat_terkini', NULL 'id_negeri', NULL 'id_daerah', NULL 'poskod', 0 'approved' FROM approve_anak WHERE no_ic LIKE '$no_ic'
								";
                $query_ic = mysqli_query($bd2,$sql_ic);
                $data_ic = mysqli_fetch_array($query_ic);
                $row_ic = mysqli_num_rows($query_ic);
                $detect_id = $data_ic['id_data'];

                if(strpos($detect_id, 'A-') !== false) {
                    ?>
                    <div class="row">
                        <div class="alert alert-danger col-12" role="alert">
                            <center>
                                Permohonan Hanya Untuk Ketua Keluarga Sahaja
                            </center>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>
        <?php if($_SESSION['no_ic'] == NULL) { ?>
        <div class="w-full js-show-service">
            <div class="wrap-contact100-form-radio">
                <span class="label-input100">Kewarganegaraan</span>

                <div class="contact100-form-radio m-t-15">
                    <input class="input-radio100" id="radio1" type="radio" name="warganegara" value="1" onClick="showWarganegara(this.value)">
                    <label class="label-radio100" for="radio1">
                        Warganegara
                    </label>
                </div>

                <div class="contact100-form-radio">
                    <input class="input-radio100" id="radio2" type="radio" name="warganegara" value="2" onClick="showWarganegara(this.value)">
                    <label class="label-radio100" for="radio2">
                        Bukan Warganegara
                    </label>
                </div>
            </div>
        </div>

        <form class="contact100-form validate-form" action="" method="POST">
            <div id="div_warganegara" class="wrap-input100" style="display:none">
            </div>


            <div class="container-contact100-form-btn" id="div_carian" style="display:none">
                <button class="contact100-form-btn" type="submit" name="carian" id="carian">
					<span>
						Carian
						<i class="fa fa-search m-l-7" aria-hidden="true"></i>
					</span>
                </button>
            </div>
        </form>
        <?php } ?>
        <?php
        if(isset($_POST['carian']) OR isset($_POST['no_ic']) OR isset($_POST['no_passport']) OR isset($_GET['no_ic']) OR isset($_GET['no_passport']) OR $_SESSION['no_ic'] != NULL) {

            if(isset($_POST['no_ic']) OR isset($_GET['no_ic']) OR $_SESSION['no_ic'] != NULL) {
                if($_SESSION['no_ic'] != NULL) $no_ic = $_SESSION['no_ic'];
                else if(isset($_GET['no_ic'])) $no_ic = $_GET['no_ic'];
                else if(isset($_POST['no_ic'])) $no_ic = $_POST['no_ic'];
                $warganegara = $_POST['warganegara'];
                //$sql_ic = "SELECT id_data, id_masjid, nama_penuh, no_ic, no_hp, status_perkahwinan, umur, alamat_terkini, id_negeri, id_daerah, poskod FROM sej6x_data_peribadi WHERE no_ic LIKE '$no_ic'
                //			UNION
                //			SELECT CONCAT('A-', ID) 'id_data', id_masjid, nama_penuh, no_ic, no_tel 'no_hp', status_kahwin 'status_perkahwinan', umur, NULL 'alamat_terkini', NULL 'id_negeri', NULL 'id_daerah', NULL 'poskod' FROM sej6x_data_anakqariah WHERE no_ic LIKE '$no_ic'
                //			";
                $sql_ic = "SELECT id_data, id_masjid, nama_penuh, no_ic, no_hp, status_perkahwinan, umur, alamat_terkini, id_negeri, id_daerah, poskod, 1 'approved' FROM sej6x_data_peribadi WHERE no_ic LIKE '$no_ic'
							UNION
							SELECT CONCAT('A-', ID) 'id_data', id_masjid, nama_penuh, no_ic, no_tel 'no_hp', status_kahwin 'status_perkahwinan', umur, NULL 'alamat_terkini', NULL 'id_negeri', NULL 'id_daerah', NULL 'poskod', 1 'approved' FROM sej6x_data_anakqariah WHERE no_ic LIKE '$no_ic'
                            UNION 
                            SELECT id 'id_data', id_masjid, nama_penuh, no_ic, no_tel, status_perkahwinan, umur, no_rumah 'alamat_terkini', negeri 'id_negeri', daerah 'id_daerah', poskod, 0 'approved' FROM approve_qariah WHERE no_ic LIKE '$no_ic'
                            UNION
                            SELECT CONCAT('A-', ID) 'id_data', id_masjid, nama_penuh, no_ic, no_tel, status_kahwin 'status_perkahwinan', NULL 'umur', NULL 'alamat_terkini', NULL 'id_negeri', NULL 'id_daerah', NULL 'poskod', 0 'approved' FROM approve_anak WHERE no_ic LIKE '$no_ic'
							";
                $query_ic = mysqli_query($bd2,$sql_ic);
                //echo(mysqli_error($bd2));
                $data_ic = mysqli_fetch_array($query_ic);
                $row_ic = mysqli_num_rows($query_ic);
                $detect_id = $data_ic['id_data'];
                //

                $ic = $data_ic['no_ic'];
                $kariah_masjid = $data_ic['id_masjid'];
            }
            if(isset($_POST['no_passport']) OR isset($_GET['no_passport']))
            {
                if(isset($_POST['no_passport']))
                {
                    $no_passport = $_POST['no_passport'];
                }
                else if(isset($_GET['no_passport']))
                {
                    $no_passport = $_GET['no_passport'];
                }
            }
            ?>
            <?php
            if(isset($_POST['no_ic']) OR isset($_POST['no_passport']) OR isset($_GET['no_ic']) OR isset($_GET['no_passport']) OR $_SESSION['no_ic'] != NULL) {
                if(strpos($detect_id, 'A-') !== false) {
                }
                else{
                    ?>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
									<?php
									if(isset($_POST['no_ic']) OR isset($_SESSION['no_ic']))
									{
										$sql_hide = "SELECT * FROM bantuan_zakat WHERE no_ic='$no_ic' AND status_bantuan=0";
									}
									else if(isset($_POST['no_passport']))
									{
										$sql_hide = "SELECT * FROM bantuan_zakat WHERE no_passport='$no_passport' AND status_bantuan=0";
									}
									$query_hide = mysqli_query($bd2,$sql_hide);
									$bil_hide = mysqli_num_rows($query_hide);
									?>
									<?php if($bil_hide==0) { ?>Maklumat Bantuan&nbsp;|&nbsp;<button class="btn btn-primary" <?php if(isset($_POST['no_ic']) OR isset($_GET['no_ic']) OR $_SESSION['no_ic'] != NULL) { if($row_ic==0) { ?>style="display:none"<?php } } ?>data-toggle="modal" data-target="#modalForm">Permohonan Baru</button><?php } ?><?php if(isset($_POST['no_ic']) OR isset($_GET['no_ic']) OR $_SESSION['no_ic'] != NULL) { if($row_ic==0) { ?><a href="../../daftar_online/pilih_masjid.php?redirect=bantuan&no_ic=<?php echo($no_ic); ?>" target="_blank" class="btn btn-success">Daftar Ahli Kariah</a><?php } } ?>
                                </div>
                                <div class="card-body">
                                    <div class="col-12">
                                        <?php

                                        if(isset($_POST['no_ic']) OR isset($_GET['no_ic']) OR $_SESSION['no_ic'] != NULL)
                                        {
                                            $search_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$kariah_masjid'";
                                            $query_masjid = mysqli_query($bd2,$search_masjid);
                                            $data_masjid = mysqli_fetch_array($query_masjid);

                                            $nama_masjid = $data_masjid['nama_masjid'];
                                            if($row_ic>0)
                                            {
                                                ?>
                                                <?php if($data_ic['approved'] == 1) { ?>
                                                <div class="row">
                                                    <div class="alert alert-success col-12" role="alert">
                                                        <center>
                                                            Maklumat telah berdaftar di <?php echo ucwords(strtolower($nama_masjid)); ?>
                                                        </center>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                                <?php if($data_ic['approved'] == 0) { ?>
                                                <div class="row">
                                                    <div class="alert alert-warning col-12" role="alert">
                                                        <center>
                                                            Maklumat telah berdaftar serta masih dalam proses pengesahan oleh pihak <?php echo ucwords(strtolower($nama_masjid)); ?>, namun anda juga boleh memohon bantuan
                                                        </center>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                                <?php
                                            }
                                            else if($row_ic==0)
                                            {
                                                ?>
                                                <div class="row">
                                                    <div class="alert alert-danger col-12" role="alert">
                                                        <center>
                                                            Sila klik butang 'Daftar Ahli Kariah' untuk mendaftar sebagai ahli kariah masjid anda untuk memohon bantuan
                                                        </center>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            if($row_ic>0)
                                            {
                                                ?>
                                                <div class="row">
                                                    <div class="alert alert-info col-12" role="alert">
                                                        <center>
                                                            Kariah&nbsp;:&nbsp;<?php echo $nama_masjid; ?><br>
                                                            Nama&nbsp;:&nbsp;<?php echo $data_ic['nama_penuh']; ?><br>
                                                            No K/P&nbsp;:&nbsp;<?php echo $data_ic['no_ic']; ?><br>
                                                            No Telefon&nbsp;:&nbsp;<?php echo $data_ic['no_hp']; ?>
                                                        </center>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        if(isset($_POST['no_passport']) OR isset($_GET['no_passport']))
                                        {
                                            $sql4 = "SELECT * FROM bantuan_zakat WHERE no_passport='$no_passport'";
                                            $sqlquery4 = mysqli_query($bd2,$sql4);
                                            $row4 = mysqli_num_rows($sqlquery4);
                                            $data4 = mysqli_fetch_array($sqlquery4);
                                            if($row4 == 0){
                                                ?>
                                                <div class="row">
                                                    <div class="alert alert-danger col-12" role="alert">
                                                        <center>
                                                            Belum mempunyai seberang rekod bantuan
                                                        </center>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            else if($row4>0)
                                            {
                                                ?>
                                                <div class="row">
                                                    <div class="alert alert-info col-12" role="alert">
                                                        <center>
                                                            Nama&nbsp;:&nbsp;<?php echo $data4['nama_penuh']; ?><br>
                                                            No Passport&nbsp;:&nbsp;<?php echo $data4['no_passport']; ?><br>
                                                            No Telefon&nbsp;:&nbsp;<?php echo $data4['no_tel']; ?>
                                                        </center>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <?php
                                        $j = 1;

                                        if(isset($_POST['no_ic']) OR isset($_GET['no_ic']) OR $_SESSION['no_ic'] != NULL)
                                        {
                                            $sql1 = "SELECT * FROM bantuan_zakat WHERE no_ic='$ic' ORDER BY id_bantuan DESC";
                                        }
                                        if(isset($_POST['no_passport']) OR isset($_GET['no_passport']))
                                        {
                                            $sql1 = "SELECT * FROM bantuan_zakat WHERE no_passport='$no_passport' ORDER BY id_bantuan DESC";
                                        }
                                        $sqlquery1 = mysqli_query($bd2,$sql1);
                                        $row1 = mysqli_num_rows($sqlquery1);

                                        ?>
                                        <div style="overflow-x:auto;">
                                            <table id="myTable" class="table table-bordered table-hover table-striped">
                                                <thead>
                                                <tr>
                                                    <td align="center">Bil</td>
                                                    <td align="center">Jenis Bantuan</td>
                                                    <td align="center">Tarikh Permohonan</td>
                                                    <!-- <td align="center">Tarikh Permohonan Diproses</td>
                                                    <td align="center">Tarikh Bantuan Diberi</td> -->
                                                    <!-- <td align="center">Kaedah Pembayaran</td>
                                                    <td align="center">Amaun/Item</td> -->
                                                    <td align="center">Masjid yang Dipohon</td>
                                                    <td align="center">Status</td>
                                                    <td align="center">Catatan</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                if($row1==0)
                                                {
                                                    ?>
                                                    <tr>
                                                        <td align="center" colspan="8">*Tiada Rekod Bantuan*</td>
                                                    </tr>
                                                    <?php
                                                }
                                                else if($row1>0)
                                                {
                                                    while($data1 = mysqli_fetch_array($sqlquery1))
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td align="center"><?php echo $j; ?></td>
                                                            <td align="center"><?php echo $data1['jenis_bantuan']; ?></td>
                                                            <td align="center"><?php if($data1['tarikh_mohon']!=NULL) echo fungsi_tarikh($data1['tarikh_mohon'],11,2); ?></td>
                                                            <!-- <td align="center"><?php //echo $data1['tarikh_proses']; ?></td>
											<td align="center"><?php //echo $data1['tarikh_bantuan']; ?></td> -->
                                                            <!-- <td align="center"><?php //echo $data1['kaedah_bayar']; ?></td>
											<td align="center"><?php //echo $data1['amaun_item']; ?></td> -->
                                                            <td align="center">
                                                                <?php
                                                                $bantuan_masjid = $data1['id_masjid'];

                                                                $sql3 = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$bantuan_masjid'";
                                                                $sqlquery3 = mysqli_query($bd2,$sql3);
                                                                $data3 = mysqli_fetch_array($sqlquery3);

                                                                echo $data3['nama_masjid'];
                                                                ?>
                                                            </td>
                                                            <td align="center">
                                                                <?
                                                                $status_bantuan = $data1['status_bantuan'];
                                                                if($status_bantuan==0){
                                                                    ?>
                                                                    <div class="alert alert-warning col-12" role="alert">Permohonan Sedang Diproses</div>
                                                                    <?php
                                                                }
                                                                else if($status_bantuan==1){
                                                                    ?>
                                                                    <div class="alert alert-success col-12" role="alert">Permohonan Bantuan Diluluskan</div>
                                                                    <?php
                                                                }
                                                                else if($status_bantuan==2){
                                                                    ?>
                                                                    <div class="alert alert-danger col-12" role="alert">Permohonan Bantuan Ditolak</div>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php
                                                                if($status_bantuan==1){
                                                                    ?>
                                                                    <button class="btn btn-info" title="Maklumat Pemberian Bantuan" value="<?php echo $data1['id_bantuan']; ?>" data-toggle="modal" data-target="#infoForm" onClick="showInfo(this.value)"><i class="fa fa-info"></i>&nbsp;Info</button>
                                                                    <?php
                                                                }
                                                                else if($status_bantuan==2){
                                                                    ?>
                                                                    <div class="alert alert-danger col-12" role="alert"><?php echo $data1['sebab_lain']; ?></div>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $j++;
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                <?php } } } ?>

    </div>
</div>

<div class="modal long-modal" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="longmodal">Maklumat Bantuan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="display_form">
                <?php
                if(isset($_POST['no_ic']) OR isset($_GET['no_ic']) OR $_SESSION['no_ic'] != NULL)
                {
                    if($row_ic>0)
                    {
                        $status_perkahwinan = $data_ic['status_perkahwinan'];
                        ?>
                        <form action="" class="form-horizontal form-bordered" method="POST">
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Nama Penuh</label>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_penuh" class="form-control" value="<?php echo $data_ic['nama_penuh']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">No Kad Pengenalan</label>
                                    <div class="col-md-9">
                                        <input type="text" name="no_ic" class="form-control" value="<?php echo $data_ic['no_ic']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">No Telefon</label>
                                    <div class="col-md-9">
                                        <input type="text" name="no_hp" class="form-control" value="<?php echo $data_ic['no_hp']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Status Perkahwinan</label>
                                    <div class="col-md-9">
                                        <select name="status_perkahwinan" class="form-control" readonly>
                                            <?php if($data_ic['status_perkahwinan'] == 1) { ?><option value="1">Bujang</option><? } ?>
                                            <?php if($data_ic['status_perkahwinan'] == 2) { ?><option value="2">Berkahwin</option><? } ?>
                                            <?php if($data_ic['status_perkahwinan'] == 3) { ?><option value="3">Duda</option><? } ?>
                                            <?php if($data_ic['status_perkahwinan'] == 4) { ?><option value="4">Janda</option><? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Alamat</label>
                                    <div class="col-md-9">
                                        <textarea name="alamat_terkini" class="form-control" readonly><?php echo $data_ic['alamat_terkini']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Negeri</label>
                                    <div class="col-md-9">
                                        <select name="id_negeri" class="form-control" readonly>
                                            <?php
                                            $negeri = $data_ic['id_negeri'];
                                            $sql_negeri = "SELECT * FROM negeri";
                                            $query_negeri = mysqli_query($bd2,$sql_negeri);

                                            while($data_negeri = mysqli_fetch_array($query_negeri))
                                            {
                                                ?>
                                                <?php if($data_ic['id_negeri']==$data_negeri['id_negeri']) { ?><option value="<?php echo $data_negeri['id_negeri']; ?>"><?php echo $data_negeri['name']; ?></option><?php } ?>
                                                <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Daerah</label>
                                    <div class="col-md-9">
                                        <select name="id_daerah" class="form-control" readonly>
                                            <?php
                                            $negeri = $data_ic['id_negeri'];
                                            $sql_daerah = "SELECT * FROM daerah WHERE id_negeri='$negeri'";
                                            $query_daerah = mysqli_query($bd2,$sql_daerah);
                                            echo mysqli_num_rows($query_daerah);

                                            while($data_daerah = mysqli_fetch_array($query_daerah))
                                            {
                                                ?>
                                                <?php if($data_ic['id_daerah']==$data_daerah['id_daerah']) { ?><option value="<?php echo $data_daerah['id_daerah']; ?>"><?php echo $data_daerah['nama_daerah']; ?></option><?php } ?>
                                                <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Poskod</label>
                                    <div class="col-md-9">
                                        <input type="text" name="poskod" class="form-control" readonly value="<?php echo $data_ic['poskod']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Jumlah Tanggungan</label>
                                    <div class="col-md-9">
                                        <?php
                                        $id_qariah = $data_ic['id_data'];
                                        $sql_tanggung = "SELECT * FROM sej6x_data_anakqariah WHERE id_qariah='$id_qariah'";
                                        $query_tanggung = mysqli_query($bd2,$sql_tanggung);
                                        $bil_tanggung = mysqli_num_rows($query_tanggung);
                                        ?>
                                        <input type="number" step="1" name="jumlah_tanggungan" class="form-control" value="<?php echo $bil_tanggung; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Bantuan dari Masjid yang dipohon</label>
                                    <div class="col-md-9">
                                        <select name="id_masjid" class="form-control" required>
                                            <option value="">Sila Pilih:-</option>
                                            <?php
                                            //$sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE url_masjid IS NOT NULL AND id_masjid != 6279 ORDER BY nama_masjid ASC";
                                            $sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE url_masjid IS NOT NULL ORDER BY nama_masjid ASC";
                                            $query_masjid = mysqli_query($bd2,$sql_masjid);
                                            mysqli_num_rows($query_masjid);

                                            while($data_masjid = mysqli_fetch_array($query_masjid))
                                            {
                                                ?>
                                                <option value="<?php echo $data_masjid['id_masjid']; ?>" <?php if($data_ic['id_masjid']==$data_masjid['id_masjid']) { ?>selected='selected'<?php } ?>><?php echo $data_masjid['nama_masjid']; ?></option>
                                                <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Jenis Bantuan</label>
                                    <div class="col-md-9">
                                        <select name="jenis_bantuan" class="form-control" required>
                                            <option value="">Sila Pilih:-</option>
                                            <option value="KEPERLUAN ASAS">KEPERLUAN ASAS</option>
                                            <option value="KEWANGAN">KEWANGAN</option>
                                        </select>
                                        <!-- <input type="text" name="jenis_bantuan" class="form-control" required oninput="this.value = this.value.toUpperCase()"> -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Status Pekerjaan Sekarang</label>
                                    <div class="col-md-9">
                                        <select name="status_kerja" class="form-control" required>
                                            <option value="">Sila Pilih:-</option>
                                            <option value="MASIH BEKERJA">MASIH BEKERJA</option>
                                            <option value="DIBERHENTIKAN">DIBERHENTIKAN</option>
                                            <option value="MENGGANGUR">MENGGANGUR</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Tujuan Permohonan</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="tujuan_mohon" oninput="this.value = this.value.toUpperCase()" required rows="5"></textarea>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Tarikh Bantuan</label>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_bantuan" class="form-control" required oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                </div>  -->
                                <input type="hidden" name="id_data" value="<?php echo $data_ic['id_data']; ?>">
								<input type="hidden" name="approved" value="<?php echo $data_ic['approved']; ?>">
								<input type="hidden" name="kariah_masjid" value="<?php echo $data_ic['id_masjid']; ?>">
                                <div class="form-group row">
                                    <div class="col-md-4 offset-4">
                                        <center>
                                            <button type="submit" name="form_ic" class="btn btn-success">Hantar Permohonan</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                    }
                }
                else if(isset($_POST['no_passport']) OR isset($_GET['no_passport']))
                {
                    ?>
                    <form action="" class="form-horizontal form-bordered" method="POST">
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Nama Penuh</label>
                                <div class="col-md-9">
                                    <input type="text" name="nama_penuh" class="form-control" oninput="this.value = this.value.toUpperCase()" value="<?php echo $data4['nama_penuh']; ?>" <?php if($row4==0) { ?>required<?php }else if($row4>0) { ?>readonly<?php } ?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">No Passport</label>
                                <div class="col-md-9">
                                    <input type="text" name="no_passport" class="form-control" oninput="this.value = this.value.toUpperCase()" value="<?php echo $no_passport; ?>" <?php if($row4==0) { ?>required<?php }else if($row4>0) { ?>readonly<?php } ?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">No Telefon</label>
                                <div class="col-md-9">
                                    <input type="text" name="no_tel" class="form-control" value="<?php echo $data4['no_tel']; ?>" <?php if($row4==0) { ?>required<?php }else if($row4>0) { ?>readonly<?php } ?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Status Perkahwinan</label>
                                <div class="col-md-9">
                                    <select name="status_perkahwinan" class="form-control" <?php if($row4==0) { ?>required<?php }else if($row4>0) { ?>readonly<?php } ?>>
                                        <?php if($row4==0) { ?>
                                            <option value="">Sila Pilh:-</option>
                                            <option value="1" <?php if($data4['status_perkahwinan'] == 1) { ?>selected="selected"<? } ?>>BUJANG</option>
                                            <option value="2" <?php if($data4['status_perkahwinan'] == 2) { ?>selected="selected"<? } ?>>BERKAHWIN</option>
                                            <option value="3" <?php if($data4['status_perkahwinan'] == 3) { ?>selected="selected"<? } ?>>DUDA</option>
                                            <option value="4" <?php if($data4['status_perkahwinan'] == 4) { ?>selected="selected"<? } ?>>JANDA</option>
                                        <?php }
                                        else if($row4>0) { ?>
                                            <?php if($data4['status_perkahwinan'] == 1) { ?><option value="1" selected="selected">Bujang</option><? } ?>
                                            <?php if($data4['status_perkahwinan'] == 2) { ?><option value="2" selected="selected">Berkahwin</option><? } ?>
                                            <?php if($data4['status_perkahwinan'] == 3) { ?><option value="3" selected="selected">Duda</option><? } ?>
                                            <?php if($data4['status_perkahwinan'] == 4) { ?><option value="4" selected="selected">Janda</option><? } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Alamat</label>
                                <div class="col-md-9">
                                    <textarea name="alamat_terkini" class="form-control" oninput="this.value = this.value.toUpperCase()" <?php if($row4==0) { ?>required<?php }else if($row4>0) { ?>readonly<?php } ?>><?php echo $data4['alamat_terkini']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Negeri</label>
                                <div class="col-md-9">
                                    <select name="id_negeri" class="form-control" <?php if($row4==0) { ?>required <?php }else if($row4>0) { ?>readonly<?php } ?>>
                                        <?php
                                        $negeri = $data4['id_negeri'];
                                        $sql_negeri = "SELECT * FROM negeri";
                                        $query_negeri = mysqli_query($bd2,$sql_negeri);

                                        if($row4==0) { ?>
                                            <option value="">Sila Pilh:-</option>
                                            <?php
                                            while($data_negeri = mysqli_fetch_array($query_negeri))
                                            {
                                                ?>
                                                <option value="<?php echo $data_negeri['id_negeri']; ?>" <?php if($data4['id_negeri']==$data_negeri['id_negeri']) { ?>selected="selected"<?php } ?>><?php echo $data_negeri['name']; ?></option>
                                                <?
                                            }
                                        }
                                        else if($row4>0){
                                            while($data_negeri = mysqli_fetch_array($query_negeri)){
                                                ?>
                                                <?php if($data4['id_negeri']==$data_negeri['id_negeri']) { ?><option value="<?php echo $data_negeri['id_negeri']; ?>" selected="selected"><?php echo $data_negeri['name']; ?></option><?php } ?>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="div_daerah">
                                <?php
                                if($data4['id_daerah']!=""){
                                    ?>
                                    <label class="control-label text-right col-md-3">Daerah</label>
                                    <div class="col-md-9">
                                        <select name="id_daerah" class="form-control" <?php if($row4==0) { ?>required<?php }else if($row4>0) { ?>readonly<?php } ?>>
                                            <?php
                                            $negeri = $data4['id_negeri'];
                                            $sql_daerah = "SELECT * FROM daerah WHERE id_negeri='$negeri'";
                                            $query_daerah = mysqli_query($bd2,$sql_daerah);

                                            if($row4==0) { ?>
                                                <option value="">Sila Pilh:-</option>
                                                <?php
                                                while($data_daerah = mysqli_fetch_array($query_daerah))
                                                {
                                                    ?>
                                                    <option value="<?php echo $data_daerah['id_daerah']; ?>" <?php if($data4['id_daerah']==$data_daerah['id_daerah']) { ?>selected="selected"<?php } ?>><?php echo $data_daerah['nama_daerah']; ?></option>
                                                    <?
                                                }
                                            }
                                            else if($row4>0){
                                                while($data_daerah = mysqli_fetch_array($query_daerah)){
                                                    ?>
                                                    <?php if($data4['id_daerah']==$data_daerah['id_daerah']) { ?><option value="<?php echo $data_daerah['id_daerah']; ?>" selected="selected"><?php echo $data_daerah['nama_daerah']; ?></option><?php } ?>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Poskod</label>
                                <div class="col-md-9">
                                    <input type="text" name="poskod" class="form-control" minlength="5" maxlength="5" <?php if($row4==0) { ?>required<?php }else if($row4>0) { ?>readonly<?php } ?> value="<?php echo $data4['poskod']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Jumlah Tanggungan</label>
                                <div class="col-md-9">
                                    <input type="number" step="1" name="jumlah_tanggungan" class="form-control" <?php if($row4==0) { ?>required<?php }else if($row4>0) { ?>readonly<?php } ?> value="<?php echo $data4['jumlah_tanggungan']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Bantuan dari Masjid yang dipohon</label>
                                <div class="col-md-9">
                                    <select name="id_masjid" class="form-control" required>
                                        <option value="">Sila Pilih:-</option>
                                        <?php
                                        $sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE url_masjid IS NOT NULL AND id_masjid != 6279 ORDER BY nama_masjid ASC";
                                        $query_masjid = mysqli_query($bd2,$sql_masjid);
                                        mysqli_num_rows($query_masjid);

                                        while($data_masjid = mysqli_fetch_array($query_masjid))
                                        {
                                            ?>
                                            <option value="<?php echo $data_masjid['id_masjid']; ?>"><?php echo $data_masjid['nama_masjid']; ?></option>
                                            <?
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Jenis Bantuan</label>
                                <div class="col-md-9">
                                    <select name="jenis_bantuan" class="form-control" required>
                                        <option value="">Sila Pilih:-</option>
                                        <option value="KEPERLUAN ASAS">KEPERLUAN ASAS</option>
                                        <option value="KEWANGAN">KEWANGAN</option>
                                    </select>
                                    <!-- <input type="text" name="jenis_bantuan" class="form-control" required oninput="this.value = this.value.toUpperCase()"> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Status Pekerjaan Sekarang</label>
                                <div class="col-md-9">
                                    <select name="status_kerja" class="form-control" required>
                                        <option value="">Sila Pilih:-</option>
                                        <option value="MASIH BEKERJA">MASIH BEKERJA</option>
                                        <option value="DIBERHENTIKAN">DIBERHENTIKAN</option>
                                        <option value="MENGGANGUR">MENGGANGUR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Tujuan Permohonan</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="tujuan_mohon" oninput="this.value = this.value.toUpperCase()" required rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4 offset-4">
                                    <center>
                                        <button type="submit" name="form_passport" class="btn btn-success">Simpan Maklumat</button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal long-modal" id="infoForm" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="longmodal">Info Maklumat Bantuan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="div_info">
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<script>
    $(".js-select2").each(function(){
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });


        $(".js-select2").each(function(){
            $(this).on('select2:close', function (e){
                if($(this).val() == "Please chooses") {
                    $('.js-show-service').slideUp();
                }
                else {
                    $('.js-show-service').slideUp();
                    $('.js-show-service').slideDown();
                }
            });
        });
    })
</script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="vendor/noui/nouislider.min.js"></script>
<script>
    var filterBar = document.getElementById('filter-bar');

    noUiSlider.create(filterBar, {
        start: [ 1500, 3900 ],
        connect: true,
        range: {
            'min': 1500,
            'max': 7500
        }
    });

    var skipValues = [
        document.getElementById('value-lower'),
        document.getElementById('value-upper')
    ];

    filterBar.noUiSlider.on('update', function( values, handle ) {
        skipValues[handle].innerHTML = Math.round(values[handle]);
        $('.contact100-form-range-value input[name="from-value"]').val($('#value-lower').html());
        $('.contact100-form-range-value input[name="to-value"]').val($('#value-upper').html());
    });
</script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>
<script>
function showWarganegara(str){
	if (str == "") {
		document.getElementById("div_warganegara").innerHTML = "";
		return;
	}
	else {
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		}
		else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("div_warganegara").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","getwarganegara.php?id=<?php echo($userid); ?>&warganegara="+str,true);
		xmlhttp.send();
	}

	document.getElementById('div_warganegara').style.display="block";
	document.getElementById('div_carian').style.display="block";
}
function showInfo(str){
	if (str == "") {
		document.getElementById("div_info").innerHTML = "";
		return;
	}
	else {
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		}
		else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("div_info").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","getinfo.php?id_bantuan="+str,true);
		xmlhttp.send();
	}
}
</script>
<?php //if($_GET['notifyApp'] == 1 || $detect->isiOS()) include("../../notifyApp.php"); ?>
<?php //if($_GET['notifyApp'] == 1 || ($detect->isiOS() && $_GET['keterangan'] != 1 && $_GET['keterangan'] != 2)) include("../../notifyApp.php"); ?>
</body>
</html>
