<?php
if($admin_view == NULL) $admin_view = $_POST['admin_view'];
if($admin_view == NULL) {
    $sekerip = "../";
    include('connection.php');
    include('../fungsi.php');
    $daftar_online = 1;
    $id_masjid = $_GET['id_masjid'];
    $id_masjid_dua = e($_GET['id_masjid']);

    if (isset($_GET['id_masjid']) && $_SERVER["REQUEST_METHOD"] != "POST") {
        $check_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid = $id_masjid";
        $result_masjid = mysqli_query($bd2, $check_masjid) or die(mysqli_error($bd2));
        $num_masjid = mysqli_num_rows($result_masjid);
        if ($num_masjid < 1) header('Location: ../login.php');
    }

    if (!isset($_GET['id_masjid']) && $_SERVER["REQUEST_METHOD"] != "POST") header('Location: ../login.php');
    $post_url = htmlspecialchars($_SERVER['PHP_SELF'].'?');
}
if($admin_view != NULL || $_POST['preview'] != NULL) {
    $sekerip = "";
    $post_url = htmlspecialchars($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&');
}

$sql4 = "SELECT * FROM sej6x_data_masjid WHERE id_masjid = $id_masjid";
$sqlquery4 = mysqli_query($bd2, $sql4) or die(mysqli_error($bd2));
$data4 = mysqli_fetch_array($sqlquery4);
$nama_masjid = $data4['nama_masjid'];
$semak = $_POST['semak'];
$no_ic = e($_POST['no_ic']);

function kemaskini_sakit($a, $b, $c, $d, $e, $f, $g, $h) {
    global $bd2, $id_masjid;
    //echo('<div style="display: none">'.$a.' - '.$b.' - '.$c.' - '.$d.' - '.$e.' - '.$f.' - '.$g.' - '.$h.' - '.count($_POST[$a]).'</div>');
    if(count($_POST[$a]) > 0) {
        for($i = 0; $i < count($_POST[$a]); $i++) {
            $id_sakit = $_POST[$b][$i];
            $id_penyakit = $_POST[$a][$i];
            $rawatan_terkini = e($_POST[$c][$i]);

            if($d == 1) $extra_sakit = "(id_data = $e OR id_anak = $e)";
            if($d == 2) $extra_sakit = "(id_data_approved = $e OR id_anak_approved = $e)";
            $q_semak_sakit = "SELECT * FROM sej6x_data_sakit WHERE id_penyakit = $id_penyakit AND rawatan_terkini = '$rawatan_terkini' AND $extra_sakit";
            $q_semak_sakit2 = mysqli_query($bd2, $q_semak_sakit) or die(mysqli_error($bd2));
            $num_sama = mysqli_num_rows($q_semak_sakit2);
            //echo('<div style="display: none">'. $q_semak_sakit . '</div>');

            if($num_sama == 0) {
                if ($id_sakit != NULL) {
                    if ($d == 1) $extra = ", $g = $e, $h = NULL";
                    if ($d == 2) $extra = ", $g = NULL, $h = $e";
                    $kemaskini_sakit = "UPDATE sej6x_data_sakit SET masa = NOW(), id_masjid = $id_masjid, id_penyakit = $id_penyakit, rawatan_terkini = '$rawatan_terkini' $extra WHERE id_sakit = $id_sakit";
                }
                if ($id_sakit == NULL) {
                    if ($d == 1) $extra = $g;
                    if ($d == 2) $extra = $h;
                    $kemaskini_sakit = "INSERT INTO sej6x_data_sakit (masa, id_masjid, id_penyakit, rawatan_terkini, $extra) VALUES (NOW(), $id_masjid, $id_penyakit, '$rawatan_terkini', $e)";
                }
                mysqli_query($bd2, $kemaskini_sakit) or die(mysqli_error($bd2));
            }
        }
    }

    if(count($_POST[$f]) > 0) {
        for($j = 0; $j < count($_POST[$f]); $j++) {
            $id_sakit_padam = $_POST[$f][$j];
            if($id_sakit_padam != NULL) {
                $padam_sakit = "DELETE FROM sej6x_data_sakit WHERE id_sakit = $id_sakit_padam";
                mysqli_query($bd2, $padam_sakit) or die(mysqli_error($bd2));
            }
        }
    }
}
if($_SERVER["REQUEST_METHOD"] == "POST") $id_masjid = $_POST['id_masjid'];
//echo($semak.'<br />'.$no_ic);
if (isset($_POST['simpan']) && $semak == 2) {
    $id_data = e($_POST['id_data'], '', '');
    $no_rujukan = e($_POST['no_rujukan'], 1, '');
    $nama_penuh = e($_POST['nama_penuh'], 1, '');
    $no_hp = e($_POST['no_hp']);
    $umur = $_POST['umur'];

    $tarikh_lahir = $_POST['tarikh_lahir'];
    $jantina = e($_POST['jantina']);
    $bangsa = $_POST['bangsa'];
    $warganegara = $_POST['warganegara'];
    $status_perkahwinan = $_POST['status_perkahwinan'];
    $oku = $_POST['oku'];
	$array_oku = $_POST['jenis_oku'];
	$jenis_oku = implode(',',$array_oku);

    $pekerjaan = e($_POST['pekerjaan']);
    $tempoh_tinggal = e($_POST['tempoh_tinggal']);
    $zon_qariah = $_POST['zon_qariah'];
    $alamat_terkini = e($_POST['alamat_terkini'], 1, '');

    $id_negeri = $_POST['id_negeri'];

    $id_daerah = $_POST['id_daerah'];

    $poskod = e($_POST['poskod']);
    $solat_jumaat = $_POST['solat_jumaat'];
    $warga_emas = $_POST['warga_emas'];
    $data_asnaf = $_POST['data_asnaf'];
    $data_ibutunggal = $_POST['data_ibutunggal'];
    $data_anakyatim = $_POST['data_anakyatim'];
    $data_sakit = $_POST['data_sakit'];
    $data_mualaf = $_POST['data_mualaf'];
    $data_khairat = $_POST['data_khairat'];
    $added_by = $_SESSION['user_id'];
    if($solat_jumaat == NULL) $solat_jumaat = 0;
    if($data_ibutunggal == NULL) $data_ibutunggal = 2;
    if($data_anakyatim == NULL) $data_anakyatim = 2;
    if($data_mualaf == NULL) $data_mualaf = 2;

    mysqli_select_db($bd2, $mysql_database);

    $kuiri = "SELECT * FROM sej6x_data_peribadi WHERE no_ic='$no_ic'";
    $kuirirun = mysqli_query($bd2, $kuiri) or die(mysqli_error($bd2));
    $run = mysqli_num_rows($kuirirun);
    if ($run > 0) {
        $kemaskini = "UPDATE sej6x_data_peribadi SET data_khairat = '$data_khairat', data_mualaf = '$data_mualaf', no_rujukan = '$no_rujukan', data_sakit = '$data_sakit', data_asnaf = '$data_asnaf', data_ibutunggal = '$data_ibutunggal', data_anakyatim = '$data_anakyatim', nama_penuh = '$nama_penuh', no_ic = '$no_ic', tarikh_lahir = '$tarikh_lahir', no_hp = '$no_hp', umur = '$umur', jantina = '$jantina', bangsa = $bangsa, warganegara = $warganegara, status_perkahwinan = $status_perkahwinan, pekerjaan = '$pekerjaan', tempoh_tinggal = '$tempoh_tinggal', zon_qariah = '$zon_qariah', alamat_terkini = '$alamat_terkini', id_negeri = $id_negeri, id_daerah = $id_daerah, poskod = '$poskod', solat_jumaat = $solat_jumaat, oku = $oku ,jenis_oku = '$jenis_oku' WHERE id_data = $id_data";
        mysqli_query($bd2, $kemaskini) or die(mysqli_error($bd2));
        kemaskini_sakit('id_penyakit', 'id_sakit', 'rawatan_terkini', 1, $id_data, 'id_sakit_padam', 'id_data', 'id_data_approved');
        //echo "<script>alert('Maklumat tuan/puan telah dikemaskini.');</script>";
    } else if ($run == 0) {
        $sql = "SELECT * FROM approve_qariah WHERE no_ic='$no_ic' AND id_masjid='$id_masjid'";
        $sqlquery = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
        $row = mysqli_num_rows($sqlquery);
        if ($row > 0) {
            $kemaskini = "UPDATE approve_qariah SET data_khairat = '$data_khairat', data_mualaf = '$data_mualaf', no_rujukan = '$no_rujukan', data_sakit = '$data_sakit', data_asnaf = '$data_asnaf', data_ibutunggal = '$data_ibutunggal', data_anakyatim = '$data_anakyatim', nama_penuh = '$nama_penuh', no_ic = '$no_ic', tarikh_lahir = '$tarikh_lahir', no_tel = '$no_hp', umur = '$umur', jantina = $jantina, bangsa = $bangsa, warganegara = $warganegara, status_perkahwinan = $status_perkahwinan, pekerjaan = '$pekerjaan', tempoh_tinggal = '$tempoh_tinggal', zon_qariah = '$zon_qariah', no_rumah = '$alamat_terkini', negeri = $id_negeri, daerah = $id_daerah, poskod = '$poskod', solat_jumaat = $solat_jumaat, oku = '$oku' , jenis_oku = '$jenis_oku' WHERE id = $id_data";
            mysqli_query($bd2, $kemaskini) or die(mysqli_error($bd2));
            kemaskini_sakit('id_penyakit', 'id_sakit', 'rawatan_terkini', 2, $id_data, 'id_sakit_padam', 'id_data', 'id_data_approved');
            //echo "<script>alert('Maklumat tuan/puan telah dikemaskini dan dalam proses pengesahan oleh pihak masjid.');</script>";
        } else if ($row == 0) {
            if(in_array($_SESSION['user_type_id'], $user_type_bypass)) {
                $sql1 = "INSERT IGNORE INTO sej6x_data_peribadi
				(data_khairat, data_mualaf, no_rujukan, data_sakit, data_anakyatim, data_ibutunggal, data_asnaf, id_masjid,nama_penuh,no_ic,tarikh_lahir,no_hp,umur,jantina,bangsa,warganegara,status_perkahwinan,pekerjaan,tempoh_tinggal,zon_qariah,alamat_terkini,id_negeri,id_daerah,poskod,solat_jumaat,oku,jenis_oku,added_by)
				VALUES
				('$data_khairat', '$data_mualaf', '$no_rujukan', '$data_sakit', '$data_anakyatim', '$data_ibutunggal', '$data_asnaf', '$id_masjid','$nama_penuh','$no_ic','$tarikh_lahir','$no_hp','$umur','$jantina','$bangsa','$warganegara','$status_perkahwinan','$pekerjaan','$tempoh_tinggal','$zon_qariah','$alamat_terkini','$id_negeri','$id_daerah','$poskod', '$solat_jumaat', '$oku','$jenis_oku','$added_by')
				";
            }
            else if(!in_array($_SESSION['user_type_id'], $user_type_bypass)) {
                $sql1 = "INSERT IGNORE INTO approve_qariah
				(data_khairat, data_mualaf, no_rujukan, data_sakit, data_anakyatim, data_ibutunggal, data_asnaf, id_masjid,nama_penuh,no_ic,tarikh_lahir,no_tel,umur,jantina,bangsa,warganegara,status_perkahwinan,pekerjaan,tempoh_tinggal,zon_qariah,no_rumah,negeri,daerah,poskod,solat_jumaat,oku,jenis_oku)
				VALUES
				('$data_khairat', '$data_mualaf', '$no_rujukan', '$data_sakit', '$data_anakyatim', '$data_ibutunggal', '$data_asnaf', '$id_masjid','$nama_penuh','$no_ic','$tarikh_lahir','$no_hp','$umur','$jantina','$bangsa','$warganegara','$status_perkahwinan','$pekerjaan','$tempoh_tinggal','$zon_qariah','$alamat_terkini','$id_negeri','$id_daerah','$poskod', $solat_jumaat, $oku,'$jenis_oku')
				";
            }

            mysqli_query($bd2, $sql1) or die(mysqli_error($bd2));
            $id_data = mysqli_insert_id($bd2);
            kemaskini_sakit('id_penyakit', 'id_sakit', 'rawatan_terkini', 2, $id_data, 'id_sakit_padam', 'id_data', 'id_data_approved');
        }
    }

    if($run == 0 && !in_array($_SESSION['user_type_id'], $user_type_bypass)) $sql3 = "SELECT * FROM approve_qariah WHERE no_ic = '$no_ic'";
    if($run > 0 || in_array($_SESSION['user_type_id'], $user_type_bypass)) $sql3 = "SELECT * FROM sej6x_data_peribadi WHERE no_ic = '$no_ic'";
    $sqlquery3 = mysqli_query($bd2, $sql3) or die(mysqli_error($bd2));
    $data3 = mysqli_fetch_array($sqlquery3);
    if($run == 0 && !in_array($_SESSION['user_type_id'], $user_type_bypass)) $ID = $data3['id'];
    if($run > 0 || in_array($_SESSION['user_type_id'], $user_type_bypass)) $ID = $data3['id_data'];

    $number_padam = count($_POST['id_padam']);
    if($number_padam > 0) {
        for($k = 0; $k < $number_padam; $k++) {
            $id_padam = $_POST['id_padam'][$k];
            if ($id_padam != NULL && is_numeric($id_padam)) {
                if ($run == 0 && !in_array($_SESSION['user_type_id'], $user_type_bypass)) {
                    $sql_del = "DELETE FROM approve_anak WHERE ID = $id_padam";
                    $sql_del_sakit = "DELETE FROM sej6x_data_sakit WHERE id_anak_approved = $id_padam";
                    $sql_check_anak = "SELECT * FROM approve_anak WHERE ID = $id_padam";
                    $sql_check_sakit = "SELECT * FROM sej6x_data_sakit WHERE id_anak_approved = $id_padam";
                }
                if ($run > 0 || in_array($_SESSION['user_type_id'], $user_type_bypass)) {
                    $sql_del = "DELETE FROM sej6x_data_anakqariah WHERE ID = $id_padam";
                    $sql_del_sakit = "DELETE FROM sej6x_data_sakit WHERE id_anak = $id_padam";
                    $sql_check_anak = "SELECT * FROM sej6x_data_anakqariah WHERE ID = $id_padam";
                    $sql_check_sakit = "SELECT * FROM sej6x_data_sakit WHERE id_anak = $id_padam";
                }
                mysqli_query($bd2, $sql_del) or die(mysqli_error($bd2));
                mysqli_query($bd2, $sql_del_sakit) or die(mysqli_error($bd2));
            }
        }
    }

    $number = count($_POST["nama_tanggungan"]);
    $i_form = 1;
    if ($number > 0) {

        for ($i = 0; $i < $number; $i++) {
            $id_anak = $_POST['id_anak'][$i];

            if($_POST["nama_tanggungan"][$i] != NULL) {
                if ($run == 0 && !in_array($_SESSION['user_type_id'], $user_type_bypass)) {
                    if ($id_anak == NULL) $sql2 = "INSERT INTO approve_anak(status_mualaf, id_qariah, id_masjid, nama_penuh, no_ic, tarikh_lahir, no_tel, hubungan, status_oku, status_kahwin, status_sakitkronik, status_asnaf, status_anakyatim) VALUES ('" . $_POST["tanggung_mualaf"][$i] . "', $ID, $id_masjid,'" . e($_POST["nama_tanggungan"][$i], 1) . "','" . $_POST["ic_tanggungan"][$i] . "', '" . $_POST["tarikh_lahir_tanggungan"][$i] . "','" . $_POST["tel_tanggungan"][$i] . "','" . strtoupper($_POST["hubungan_tanggungan"][$i]) . "','" . $_POST["tanggung_oku"][$i] . "','" . $_POST["tanggung_kahwin"][$i] . "','" . $_POST["tanggung_sakitkronik"][$i] . "','" . $_POST["tanggung_asnaf"][$i] . "','" . $_POST["tanggung_anakyatim"][$i] . "')";
                    if ($id_anak != NULL) $sql2 = "UPDATE approve_anak SET status_mualaf = '" . $_POST["tanggung_mualaf"][$i] . "', nama_penuh = '" . e($_POST["nama_tanggungan"][$i], 1) . "', no_ic = '" . $_POST["ic_tanggungan"][$i] . "', tarikh_lahir = '" . $_POST["tarikh_lahir_tanggungan"][$i] . "', no_tel = '" . $_POST["tel_tanggungan"][$i] . "', hubungan = '" . e($_POST["hubungan_tanggungan"][$i], 1) . "', status_oku = '" . $_POST["tanggung_oku"][$i] . "', status_kahwin = '" . $_POST["tanggung_kahwin"][$i] . "', status_sakitkronik = '" . $_POST["tanggung_sakitkronik"][$i] . "', status_asnaf = '" . $_POST["tanggung_asnaf"][$i] . "', status_anakyatim = '" . $_POST["tanggung_anakyatim"][$i] . "' WHERE ID = $id_anak";
                }

                if ($run > 0 || in_array($_SESSION['user_type_id'], $user_type_bypass)) {
                    if ($id_anak == NULL) $sql2 = "INSERT INTO sej6x_data_anakqariah(status_mualaf, id_qariah, id_masjid, nama_penuh, no_ic, tarikh_lahir, no_tel, hubungan, status_oku, status_kahwin, status_sakit, status_asnaf, status_anakyatim) VALUES ('" . $_POST["tanggung_mualaf"][$i] . "', $ID, $id_masjid,'" . e($_POST["nama_tanggungan"][$i], 1) . "','" . $_POST["ic_tanggungan"][$i] . "', '" . $_POST["tarikh_lahir_tanggungan"][$i] . "','" . $_POST["tel_tanggungan"][$i] . "','" . strtoupper($_POST["hubungan_tanggungan"][$i]) . "','" . $_POST["tanggung_oku"][$i] . "','" . $_POST["tanggung_kahwin"][$i] . "','" . $_POST["tanggung_sakitkronik"][$i] . "','" . $_POST["tanggung_asnaf"][$i] . "','" . $_POST["tanggung_anakyatim"][$i] . "')";
                    if ($id_anak != NULL) $sql2 = "UPDATE sej6x_data_anakqariah SET status_mualaf = '" . $_POST["tanggung_mualaf"][$i] . "', nama_penuh = '" . e($_POST["nama_tanggungan"][$i], 1) . "', no_ic = '" . $_POST["ic_tanggungan"][$i] . "', tarikh_lahir = '" . $_POST["tarikh_lahir_tanggungan"][$i] . "', no_tel = '" . $_POST["tel_tanggungan"][$i] . "', hubungan = '" . e($_POST["hubungan_tanggungan"][$i], 1) . "', status_oku = '" . $_POST["tanggung_oku"][$i] . "', status_kahwin = '" . $_POST["tanggung_kahwin"][$i] . "', status_sakit = '" . $_POST["tanggung_sakitkronik"][$i] . "', status_asnaf = '" . $_POST["tanggung_asnaf"][$i] . "', status_anakyatim = '" . $_POST["tanggung_anakyatim"][$i] . "' WHERE ID = $id_anak";
                }

                //mysqli_query($bd2, $sql2) or die('Error: '.$sql2.' - '.mysqli_error($bd2));
                mysqli_query($bd2, $sql2) or die(mysqli_error($bd2));
                if ($id_anak == NULL) $id_anak = mysqli_insert_id($bd2);

                if ($run == 0 && !in_array($_SESSION['user_type_id'], $user_type_bypass)) $kemas_sakit = 2;
                if ($run > 0 || in_array($_SESSION['user_type_id'], $user_type_bypass)) $kemas_sakit = 1;
                kemaskini_sakit('id_penyakit_tanggung_' . $i_form, 'id_sakit_tanggung_' . $i_form, 'rawatan_terkini_tanggung_' . $i_form, $kemas_sakit, $id_anak, 'id_sakit_padam_tanggung_' . $i_form, 'id_anak', 'id_anak_approved');
                $i_form++;
            }
        }
    }
    if($no_ic != NULL && ($run == 0 && $row == 0)) $notis = 'Pendaftaran Berjaya';
    if($no_ic != NULL && ($run > 0 || $row > 0)) $notis = 'Kemaskini Berjaya';
    echo "<script>alert('".$notis."');</script>";
}
?>
<?php if($admin_view == NULL && $_POST['preview'] == NULL) { ?>
    <!DOCTYPE html>
		
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
    <title>Masjid Pro - Pendaftaran Ahli Kariah <?php echo($nama_masjid); ?></title>
    <meta name="description" content="Masjid Pro - Pendaftaran Ahli Kariah <?php echo($nama_masjid); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="../vendors/chosen/chosen.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel='stylesheet' type='text/css'>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/b5589dbb40.js" crossorigin="anonymous"></script>
    <script id="pilih_jquery" src="../js/jquery-3.4.1.js"></script>
    <script id="pilih_ui" src="../js/jquery-ui.js"></script>
    <link rel="stylesheet" href="../js/jquery-ui.css">
<?php } ?>
<?php if($admin_view != NULL || $_POST['preview'] != NULL) { ?>
    <script id="pilih_jquery" src="js/jquery-3.4.1.js"></script>
    <script id="pilih_ui" src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="js/jquery-ui.css">
<?php } ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.js" integrity="sha256-dgFbqbQVzjkZPQxWd8PBtzGiRBhChc4I2wO/q/s+Xeo=" crossorigin="anonymous"></script>
    <script id="load_tarikh">
        function convertTarikh(a, b) {
            $(document).ready(function () {
                var date_string = moment(a, "YYYY-MM-DD").format("DD/MM/YYYY");
                $(b).val(date_string);
            });
        }

        function tarikhSediaAda(a, b) {
            $(document).ready(function () {
                $( "[id='"+a+"']" ).datepicker({
                    dateFormat: "dd/mm/yy",
                    yearRange: "1900:<?php echo date('Y'); ?>",
                    maxDate: "0",
                    altField: "[id='"+b+"']",
                    altFormat: "yy-mm-dd",
                    changeMonth: true,
                    changeYear: true
                });
            });
        }
    </script>
    <script>
        $(document).ready(function () {
            <?php if($no_ic != NULL && $semak != NULL) {
            $sql_search = "SELECT *, a.id_daerah, a.id_negeri, a.poskod, a.no_hp FROM sej6x_data_peribadi a, sej6x_data_masjid b WHERE a.id_masjid = b.id_masjid AND a.no_ic = '$no_ic'";
            $sql_search2 = "SELECT *, a.negeri, a.daerah, a.poskod, a.no_tel FROM approve_qariah a, sej6x_data_masjid b WHERE a.id_masjid = b.id_masjid AND a.no_ic = '$no_ic'";
            $sql_search3 = "SELECT c.no_ic 'no_kp' FROM sej6x_data_anakqariah a, sej6x_data_masjid b, sej6x_data_peribadi c WHERE a.id_masjid = b.id_masjid AND a.id_qariah = c.id_data AND a.no_ic = '$no_ic'";
            $sql_search4 = "SELECT c.no_ic 'no_kp' FROM approve_anak a, sej6x_data_masjid b, approve_qariah c WHERE a.id_masjid = b.id_masjid AND a.id_qariah = c.ID AND a.no_ic = '$no_ic'";
            $result = mysqli_query($bd2, $sql_search) or die("Error :" . mysqli_error($bd2));
            $result2 = mysqli_query($bd2, $sql_search2) or die("Error :" . mysqli_error($bd2));
            $result_anak = mysqli_query($bd2, $sql_search3) or die("Error :" . mysqli_error($bd2));
            $result_anak2 = mysqli_query($bd2, $sql_search4) or die("Error :" . mysqli_error($bd2));
            $jumpa = mysqli_num_rows($result);
            $jumpa2 = mysqli_num_rows($result2);
            $jumpa3 = mysqli_num_rows($result_anak);
            $jumpa4 = mysqli_num_rows($result_anak2);
            $info_ketua = mysqli_fetch_assoc($result_anak);
            $info_ketua2 = mysqli_fetch_assoc($result_anak2);
            $ic_ketua = $info_ketua['no_kp'];
            $ic_ketua2 = $info_ketua2['no_kp'];
            if($jumpa > 0 || $jumpa2 > 0 || $jumpa3 > 0 || $jumpa4 > 0) {
                $tajuk = '(Kemaskini)';
                if($_POST['preview'] == 1) $tajuk = "";
                if($jumpa > 0 || $jumpa3 > 0) {
                    if($jumpa3 > 0) $sql_search = "SELECT *, a.id_daerah, a.id_negeri, a.poskod, a.no_hp FROM sej6x_data_peribadi a, sej6x_data_masjid b WHERE a.id_masjid = b.id_masjid AND a.no_ic = '$ic_ketua'";
                    $result3 = mysqli_query($bd2, $sql_search) or die("Error :" . mysqli_error($bd2));
                    $kemas = mysqli_fetch_assoc($result3);
                    $no_hp = $kemas['no_hp'];
                    $id_qariah = $kemas['id_data'];
                    $negeri2 = $kemas['id_negeri'];
                    $daerah2 = $kemas['id_daerah'];
                    $id_masjid2 = $kemas['id_masjid'];
                    $nama_masjid2 = $kemas['nama_masjid'];
                    $alamat_terkini = $kemas['alamat_terkini'];
					$jenis_oku = explode(',',$kemas['jenis_oku']);
                    $data_mualaf_isi =  $kemas['data_mualaf'];
                    $no_ic = $kemas['no_ic'];
                    $q_sakit_p = "SELECT * FROM sej6x_data_sakit WHERE id_data = $id_qariah";
                    $r_sakit_p = mysqli_query($bd2, $q_sakit_p);
                    $jum_sakit_p = mysqli_num_rows($r_sakit_p);
                    $sakit_p = mysqli_fetch_assoc($r_sakit_p);
                    $q_anak = "SELECT * FROM sej6x_data_anakqariah WHERE id_qariah = $id_qariah";
                    $result4 = mysqli_query($bd2, $q_anak) or die("Error :" . mysqli_error($bd2));
                    $jum_anak = mysqli_num_rows($result4);
                    $kemas2 = mysqli_fetch_assoc($result4);
                }
                if($jumpa2 > 0 || $jumpa4 > 0) {
                    if($jumpa4 > 0) $sql_search2 = "SELECT *, a.negeri, a.daerah, a.poskod, a.no_tel FROM approve_qariah a, sej6x_data_masjid b WHERE a.id_masjid = b.id_masjid AND a.no_ic = '$ic_ketua2'";
                    $result3 = mysqli_query($bd2, $sql_search2) or die("Error :" . mysqli_error($bd2));
                    $kemas = mysqli_fetch_assoc($result3);
                    $id_qariah = $kemas['id'];
                    $no_hp = $kemas['no_tel'];
                    $negeri2 = $kemas['negeri'];
                    $daerah2 = $kemas['daerah'];
                    $id_masjid2 = $kemas['id_masjid'];
                    $nama_masjid2 = $kemas['nama_masjid'];
                    $alamat_terkini =  $kemas['no_rumah'];
                    $jenis_oku = explode(',',$kemas['jenis_oku']);
                    $data_mualaf_isi =  $kemas['data_mualaf'];
                    $no_ic = $kemas['no_ic'];
                    $q_sakit_p = "SELECT * FROM sej6x_data_sakit WHERE id_data_approved = $id_qariah";
                    $r_sakit_p = mysqli_query($bd2, $q_sakit_p);
                    $jum_sakit_p = mysqli_num_rows($r_sakit_p);
                    $sakit_p = mysqli_fetch_assoc($r_sakit_p);
                    $q_anak = "SELECT * FROM approve_anak WHERE id_qariah = $id_qariah";
                    $result4 = mysqli_query($bd2, $q_anak) or die("Error :" . mysqli_error($bd2));
                    $jum_anak = mysqli_num_rows($result4);
                    $kemas2 = mysqli_fetch_assoc($result4);
                }

            }
            if($jumpa == 0 && $jumpa2 == 0 && $jumpa3 == 0 && $jumpa4 == 0) $tajuk = '(Pendaftaran Baharu)';
            ?>
            convertTarikh('<?php echo($kemas['tarikh_lahir']); ?>', '#tarikh_lahir_type');
            <?php } ?>
            $( "#tarikh_lahir_type" ).datepicker({
                dateFormat: "dd/mm/yy",
                yearRange: "1900:<?php echo(date('Y')); ?>",
                maxDate: "0",
                altField: "#tarikh_lahir",
                altFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true
            });
        });
        function tukar_mualaf(a, b) {
            if(a == 1) jQuery(b).show();
            if(a != 1) jQuery(b).hide();
        }
        tukar_mualaf(<?php if($data_mualaf_isi != NULL) echo($data_mualaf_isi); else echo '0' ?>, '#extra_mualaf');
    </script>
<?php
if($admin_view == NULL && $_POST['preview'] == NULL) {
    include("../adjust1.php");
    include("../adjust2.php");
}
if($admin_view != NULL || $_POST['preview'] != NULL) {
    include("adjust1.php");
    include("adjust2.php");
}
?>
<?php if($admin_view == NULL) { ?>
</head>

<body style="background-color: #4e4e52">
    <br>
    <div class="col-lg-2"></div>
<?php } ?>
<?php if($admin_view == NULL && $_POST['preview'] == NULL) { ?><div class="col-lg-8"><?php } ?>
<?php if($admin_view != NULL || $_POST['preview'] != NULL) { ?><div class="col-12 col-md-12"><?php } ?>
    <div class="card">
        <div class="card-header" <?php if($_POST['preview'] == 1) echo 'style="display: none"'; ?>>
            <br>
            <center>
                <h2>
                    <?php if($no_ic == NULL) { $tajuk_button = 'Semak'; ?><b>Semakan Ahli Kariah</b><?php } ?>
                    <?php if($no_ic != NULL && ($jumpa > 0 || $jumpa2 > 0 || $jumpa3 > 0 || $jumpa4 > 0)) { $tajuk_button = 'Kemaskini'; ?>
                        <?php if(($jumpa > 0 || $jumpa3 > 0) && $id_masjid == $id_masjid2) { ?>
                            <div style="font-size: medium" class="alert alert-success" role="alert">
                                Maklumat telah didaftarkan, anda boleh mengemaskini maklumat dibawah sekiranya perlu.
                            </div>
                        <?php } ?>
                        <?php if(($jumpa2 > 0 || $jumpa4 > 0) && $id_masjid == $id_masjid2) { ?>
                            <div style="font-size: medium" class="alert alert-warning" role="alert">
                                Maklumat sedang diproses oleh pihak Masjid, anda boleh mengemaskini maklumat dibawah sekiranya perlu.
                            </div>
                        <?php } ?>
                        <?php if(($jumpa > 0 || $jumpa2 > 0 || $jumpa3 > 0 || $jumpa4 > 0) && ($id_masjid != $id_masjid2)) { $tajuk_button = 'Semak Semula'; ?>
                            <div style="font-size: medium" class="alert alert-danger" role="alert">
                                Maklumat telah didaftarkan di Masjid (kariah) yang lain (<?php echo($nama_masjid2); ?>). Hanya 1 (satu) Masjid sahaja dibenarkan untuk mendaftar keahlian kariah.
                            </div>
                        <?php } ?>
                        <b>Kemaskini Ahli Kariah</b>
                    <?php } ?>
                    <?php if($no_ic != NULL && $jumpa == 0 && $jumpa3 == 0 && $jumpa2 == 0 && $jumpa4 == 0) { $tajuk_button = 'Daftar'; ?>
                        <div style="font-size: medium" class="alert alert-danger" role="alert">
                            Maklumat tiada / belum didaftarkan, anda boleh mendaftar dengan mengisi maklumat yang diperlukan dibawah
                        </div>
                        <b>Pendaftaran Ahli Kariah</b>
                    <?php } ?>
                    <br>
                    <?php echo($nama_masjid); ?>
                </h2>
            </center>
        </div>
        <div class="card-body">
            <?php if($admin_view == NULL) { ?><form method="post" name="insert_form" id="insert_form" action="<?php echo($post_url); ?>id_masjid=<?php echo($id_masjid); ?>" enctype="multipart/form-data"><?php } ?>
                <?php if($admin_view != NULL) { ?><form method="post" name="insert_form" id="insert_form" action="<?php echo($post_url); ?>" enctype="multipart/form-data"><?php } ?>
                    <?php if($no_ic == NULL) { ?>
                        <div class="row form-group">
                            <div class="col-12 col-md-12 form-group" align="left">
                                <div class="alert alert-danger" role="alert">
                                    * Hanya Ketua Keluarga sahaja dibenarkan untuk mengisi
                                </div>
                                <label>No K/P / Passport Ketua Keluarga:</label>
                                <input class="form-control" name="no_ic" id="no_ic" placeholder="Contoh: 880528355036" minlength="12" maxlength="12" required value="<?php echo($no_ic); ?>">
                                <input type="hidden" id="semak" name="semak" value="1">
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($no_ic != NULL && $tajuk_button != 'Semak Semula') { ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function() {
                            tarikhSediaAda('tarikh_lahir_type', 'tarikh_lahir');
                            convertTarikh('<?php echo($kemas['tarikh_lahir']); ?>', '#tarikh_lahir_type');
                            myFunction('no_ic', 'umur', 'tarikh_lahir', 'tarikh_lahir_type');
                        });
                    </script>
                    <div class="row">
                        <input type="hidden" id="semak" name="semak" value="2">
                        <input type="hidden" id="id_data" name="id_data" value="<?php echo($id_qariah); ?>">
                        <div class="col-lg-12">
                            <h4 align="center">
                                <u>Maklumat Ahli <?php echo($tajuk); ?></u>
                            </h4>
                            <hr>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Nama Penuh (Mengikut Kad Pengenalan / Passport)</b> <input
                                                class="form-control" name="nama_penuh" id="nama_penuh" oninput="this.value = this.value.toUpperCase()"
                                                required value="<?php echo($kemas['nama_penuh']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>No. K/P / Pasport</b> <input
                                                class="form-control" name="no_ic" id="no_ic"
                                                placeholder="Contoh: 880528355036" minlength="12"
                                                maxlength="12" required onChange="myFunction('no_ic', 'umur', 'tarikh_lahir', 'tarikh_lahir_type')" value="<?php echo($no_ic); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>No Telefon</b> <input
                                                class="form-control" name="no_hp" id="no_hp"
                                                placeholder="Contoh: 0143159891" required test value="<?php echo($no_hp); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Umur</b> <input
                                                class="form-control" name="umur" id="umur" readonly value="<?php echo($kemas['umur']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Tarikh Lahir</b>
                                        <input style="display: none" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" name="tarikh_lahir" id="tarikh_lahir" type="date" value="<?php echo($kemas['tarikh_lahir']); ?>">
                                        <input readonly class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" name="tarikh_lahir_type" id="tarikh_lahir_type" placeholder="Contoh: 1992-05-30" required onChange2="myFunction('no_ic', 'umur', 'tarikh_lahir', 'tarikh_lahir_type')" value="<?php echo($no_ic); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Jantina</b> <select
                                                class="form-control" name="jantina" id="jantina" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['jantina'] == 1) echo('selected'); ?>>Lelaki</option>
                                            <option value="2" <?php if($kemas['jantina'] == 2) echo('selected'); ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Bangsa</b> <select
                                                class="form-control" name="bangsa" id="bangsa" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['bangsa'] == 1) echo('selected'); ?>>Melayu</option>
                                            <option value="2" <?php if($kemas['bangsa'] == 2) echo('selected'); ?>>Cina</option>
                                            <option value="3" <?php if($kemas['bangsa'] == 3) echo('selected'); ?>>India</option>
                                            <option value="4" <?php if($kemas['bangsa'] == 4) echo('selected'); ?>>Lain-lain</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Warganegara</b> <select
                                                class="form-control" name="warganegara" id="warganegara"
                                                required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['warganegara'] == 1) echo('selected'); else if($kemas['warganegara'] == NULL) echo 'selected'; ?>>Warganegara</option>
                                            <option value="2" <?php if($kemas['warganegara'] == 2) echo('selected'); ?>>Bukan Warganegara</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Status Perkahwinan</b> <select
                                                class="form-control" name="status_perkahwinan"
                                                id="status_perkahwinan" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['status_perkahwinan'] == 1) echo('selected'); ?>>Bujang</option>
                                            <option value="2" <?php if($kemas['status_perkahwinan'] == 2) echo('selected'); ?>>Berkahwin</option>
                                            <option value="3" <?php if($kemas['status_perkahwinan'] == 3) echo('selected'); ?>>Duda</option>
                                            <option value="4" <?php if($kemas['status_perkahwinan'] == 4) echo('selected'); ?>>Janda</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Pekerjaan</b> <input
                                                class="form-control" name="pekerjaan" id="pekerjaan" required value="<?php echo($kemas['pekerjaan']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Tempoh Tinggal di Kariah Ini</b><br/>
                                        <select id="tinggal_mastautin" name="tinggal_mastautin" class="form-control" required onchange="updateMastautin(this.value)">
                                            <option value="">Sila Pilih</option>
                                            <option value="2" <?php if(str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[2]) == 2 && str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[0]) == 0) echo 'selected'; ?>>BERMASTAUTIN KURANG DARI 3 BULAN</option>
                                            <option value="3" <?php if(str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[2]) >= 3 || str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[0]) > 0) echo 'selected'; ?>>BERMASTAUTIN LEBIH DARI 3 BULAN</option>
                                        </select>
                                        <div id="form_tempoh" style="display: none">
                                        <br />
                                        <input required class2="form-control" id="tinggal_tahun" name="tinggal_tahun" type="number" step="1" min="0" max="150" maxlength="3" value="<?php echo str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[0]); ?>">TAHUN
                                        <input required class2="form-control" id="tinggal_bulan" name="tinggal_bulan" type="number" step="1" min="0" max="12" maxlength="2" value="<?php echo str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[2]); ?>">BULAN
                                        </div>
                                        <input class="form-control" name="tempoh_tinggal" id="tempoh_tinggal" value="<?php echo($kemas['tempoh_tinggal']); ?>" readonly style="display: none">
                                        <small>* Sehingga pada tarikh anda mengisi pendaftaran ini</small>
                                    </div>
                                    <?php if($data4['perlu_zon'] != 2) { ?>
                                        <div class="form-group" id="zon">
                                            <label><b>Zon Kariah</b></label>
                                            <select
                                                    class="form-control" name="zon_qariah" id="zon_qariah">
                                                <option value="">Pilih Zon Kariah</option>
                                                <?php
                                                $sql_zon = "SELECT * FROM sej6x_data_zonqariah WHERE id_masjid='$id_masjid'";
                                                $query_zon = mysqli_query($bd2, $sql_zon);

                                                while ($zon = mysqli_fetch_array($query_zon)) {
                                                    ?>
                                                    <option value="<?php echo $zon['id_zonqariah']; ?>" <?php if($kemas['zon_qariah'] == $zon['id_zonqariah']) echo('selected'); ?>><?php echo $zon['no_huruf']." : ".$zon['nama_zon']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Alamat
                                            Terkini</b> <textarea class="form-control" oninput="this.value = this.value.toUpperCase()"
                                                               placeholder="Contoh: 1842-2 Kampung Selamat"
                                                                  name="alamat_terkini" id="alamat_terkini" required value="" rows="5"><?php echo($alamat_terkini); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Negeri</b> <select
                                                class="form-control" name="id_negeri" id="id_negeri"
                                                onChange="showDaerah(this.value, 0)" required>
                                            <option value="">Pilih Negeri</option>
                                            <?php
                                            $sql_negeri = "SELECT * FROM negeri";
                                            $query_negeri = mysqli_query($bd2, $sql_negeri);

                                            while ($negeri = mysqli_fetch_array($query_negeri)) {
                                                ?>
                                                <option value="<?php echo $negeri['id_negeri']; ?>" <?php if($negeri['id_negeri'] == $negeri2) echo('selected'); ?>><?php echo $negeri['name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" id="daerah"></div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Poskod</b> <input
                                                class="form-control" name="poskod" id="poskod" minlength="5"
                                                maxlength="5" required value="<?php echo $kemas['poskod']; ?>">
                                    </div>
                                    <br> <br> Sila isi semua maklumat yang bertanda<label
                                            style="color: red">*</label>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 align="center">
                                        <u>Catatan Masjid</u>
                                    </h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row" id="no_rujukan_form">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>No Rujukan Fail (Jika Ada)</label>
                                        <input class="form-control form-group" name="no_rujukan" id="no_rujukan" value="<?php echo($kemas['no_rujukan']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4" id="asnaf_form">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Asnaf</b> <select
                                                class="form-control form-group" name="data_asnaf" id="data_asnaf"
                                                required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['data_asnaf'] == 1) echo('selected'); ?>>Ya</option>
                                            <option value="2" <?php if($kemas['data_asnaf'] == 2) echo('selected'); ?>>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-4" id="solat_jumaat_form">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Wajib Solat Jumaat</b>
                                        <select class="form-control form-group" name="solat_jumaat" id="solat_jumaat" required oninvalid="this.setCustomValidity('Sekiranya anda kerap menunaikan solat jumaat di Masjid ini, sila pilih “Ya')">
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['solat_jumaat'] == 1) echo('selected'); ?>>Ya</option>
                                            <option value="2" <?php if($kemas['solat_jumaat'] == 2) echo('selected'); ?>>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>OKU</b> <select
                                                class="form-control form-group" name="oku" id="oku" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['oku'] == '1') echo('selected'); ?>>Ya</option>
                                            <option value="2" <?php if($kemas['oku'] == '2') echo('selected'); ?>>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-4" id="ibu_tunggal_form">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Ibu Tunggal</b> <select
                                                class="form-control form-group" name="data_ibutunggal" id="data_ibutunggal" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['data_ibutunggal'] == '1') echo('selected'); ?>>Ya</option>
                                            <option value="2" <?php if($kemas['data_ibutunggal'] == '2') echo('selected'); ?>>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-4" id="anak_yatim_form">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Anak Yatim</b> <select
                                                class="form-control form-group" name="data_anakyatim" id="data_anakyatim" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['data_anakyatim'] == '1') echo('selected'); ?>>Ya</option>
                                            <option value="2" <?php if($kemas['data_anakyatim'] == '2') echo('selected'); ?>>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Khairat Kematian</b> <select
                                                class="form-control form-group" name="data_khairat" id="data_khairat" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['data_khairat'] == '1' || $data4['auto_khairat'] == 1) echo('selected'); ?>>Ya</option>
                                            <option value="2" <?php if($kemas['data_khairat'] == '2') echo('selected'); ?>>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-4" id="data_mualaf_form">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Mualaf</b> <select
                                                class="form-control form-group" name="data_mualaf" id="data_mualaf" required onchange="tukar_mualaf(this.value, '#extra_mualaf')">
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['data_mualaf'] == '1') echo('selected'); ?>>Ya</option>
                                            <option value="2" <?php if($kemas['data_mualaf'] == '2') echo('selected'); ?>>Tidak</option>
                                        </select>
                                    </div>
                                </div>
								<div class="col-lg-12" id="extra_oku" <?php if($kemas['oku'] == '1') { ?>style="display:block"<?php }else if($kemas['oku'] == '2') { ?>style="display: none"<?php }else{ ?>style="display:none"<?php } ?>>
									<div class="form-group row">
										<div class="col-lg-12">
											<b>Jenis OKU:-</b>
										</div>
										<div class="col-lg-4">
											<input type="checkbox" name="jenis_oku[]" <?php echo (in_array("1", $jenis_oku)?'checked':''); ?> value="1">&nbsp;Kurang Upaya Pendengaran
										</div>
										<div class="col-lg-4">
											<input type="checkbox" name="jenis_oku[]" <?php echo (in_array("2", $jenis_oku)?'checked':''); ?> value="2">&nbsp;Kurang Upaya Penglihatan
										</div>
										<div class="col-lg-4">
											<input type="checkbox" name="jenis_oku[]" <?php echo (in_array("3", $jenis_oku)?'checked':''); ?> value="3">&nbsp;Kurang Upaya Pertuturan
										</div>
										<div class="col-lg-4">
											<input type="checkbox" name="jenis_oku[]" <?php echo (in_array("4", $jenis_oku)?'checked':''); ?> value="4">&nbsp;Kurang Upaya Fizikal
										</div>
										<div class="col-lg-4">
											<input type="checkbox" name="jenis_oku[]" <?php echo (in_array("5", $jenis_oku)?'checked':''); ?> value="5">&nbsp;Kurang Upaya Pembelajaran
										</div>
										<div class="col-lg-4">
											<input type="checkbox" name="jenis_oku[]" <?php echo (in_array("6", $jenis_oku)?'checked':''); ?> value="6">&nbsp;Kurang Upaya Mental
										</div>
										<div class="col-lg-4">
											<input type="checkbox" name="jenis_oku[]" <?php echo (in_array("7", $jenis_oku)?'checked':''); ?> value="7">&nbsp;Kurang Upaya Pelbagai
										</div>
										<div class="col-lg-4">
											<input type="checkbox" name="jenis_oku[]" <?php echo (in_array("8", $jenis_oku)?'checked':''); ?> value="8">&nbsp;Lain-Lain Kurang Upaya
										</div>
									</div>
                                </div>
                                <div class="col-lg-12" id="extra_mualaf" style="display: none">
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <label style="color: red">*</label><b>Tarikh Memeluk Islam</b>
                                            <input id="tarikh_mualaf" name="tarikh_mualaf" class="form-control" type="date" value="<?php echo($kemas['tarikh_mualaf']); ?>" placeholder="Tarikh Rasmi Memeluk Islam">
                                        </div>
                                        <div class="col-lg-4">
                                            <label style="color: red">*</label><b>Tempat</b>
                                            <textarea id="tempat_mualaf" name="tempat_mualaf" class="form-control" rows="3" placeholder="Tempat Memeluk Islam"><?php echo($kemas['tempat_mualaf']); ?></textarea>
                                        </div>
                                        <div class="col-lg-4">
                                            <label style="color: red">*</label><b>Dihadapan</b>
                                            <textarea id="dihadapan_mualaf" name="dihadapan_mualaf" class="form-control" rows="3" placeholder="Qadhi / Pegawai Agama Daerah / Mufti / Dan Lain-lain"><?php echo($kemas['dihadapan_mualaf']); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <script id="data_sakit_sekerip">
                                    function data_sakit(a, b, dinamik, d, e, f, g, h, i, j, k, l, m) {
                                        jQuery(document).ready(function(){
                                            var data_sakit_i = a;
                                            var data_sakit = '<?php pilihanBijak('SELECT id_penyakit \'id\', penyakit \'val\' FROM list_penyakit', 'select', '\'+dinamik+\'', 'Jenis Penyakit', 'required'); ?>';
                                            data_sakit += '<label>Rawatan Terkini</label><input class="form-control form-group" name="'+d+'" maxlength="500">';
                                            dinamik_tambah(data_sakit_i, e, f, data_sakit, g, h, i, j, k, m);
                                            if(b == "1" || b == "Y") pilih_dinamik(b, e, l, g, j);
                                        });
                                    }

                                    function data_sakit_ada(a, b, c, d, e, f, g, h) {
                                        jQuery(document).ready(function(){
                                            jQuery(a).click();
                                            setSelectedIndex(document.getElementsByName(b)[f], c);
                                            document.getElementsByName(d)[f].value = e;
                                            document.getElementsByName(g)[f].value = h;
                                        });
                                    }
                                </script>
                                <div class="col-12 col-md-12">
                                    <script>
                                        jQuery(document).ready(function(){
                                            data_sakit(0, '<?php echo($kemas['data_sakit']); ?>', 'id_penyakit[]', 'rawatan_terkini[]', 'add_sakit', 'borang_sakit', 'padam_sakit', 'baris_sakit', 'id_sakit_', 'id_sakit[]', 'id_sakit_padam[]', '', 'Padam Penyakit');
                                        });
                                    </script>
                                    <label style="color: red">*</label><b>Sakit Kronik</b> <select
                                            class="form-control form-group" name="data_sakit" id="data_sakit" required onchange="pilih_dinamik(this.value, 'add_sakit', 'id_sakit[]', 'padam_sakit', 'id_sakit_padam[]')">
                                        <option value="">Sila Pilih</option>
                                        <option value="1" <?php if($kemas['data_sakit'] == '1') echo('selected'); ?>>Ya</option>
                                        <option value="2" <?php if($kemas['data_sakit'] == '2') echo('selected'); ?>>Tidak</option>
                                    </select>
                                    <div id="borang_sakit" class="col-12 col-md-12 form-group">
                                        <?php if($jum_sakit_p > 0) { $i = 1; do { ?>
                                            <script>
                                                jQuery(document).ready(function(){
                                                    data_sakit_ada('#add_sakit', 'id_penyakit[]', '<?php echo($sakit_p['id_penyakit']); ?>', 'rawatan_terkini[]', '<?php echo($sakit_p['rawatan_terkini']); ?>', <?php echo(round($i - 1)); ?>, 'id_sakit[]', '<?php echo($sakit_p['id_sakit']); ?>');
                                                });
                                            </script>
                                            <?php $i++; } while($sakit_p = mysqli_fetch_assoc($r_sakit_p)); } ?>
                                    </div>
                                    <div id="padam_sakit"></div>
                                    <button style="display: none" id="add_sakit" type="button" class="btn btn-success">Tambah Penyakit</button>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 align="center">
                                        <u>Tanggungan Anak Kariah</u>
                                    </h4>
                                </div>
                            </div>
                            <hr>
                            <script id="isi_dinamik">

                                //mula_index = 0;
                                id_butang_add = 'add_rekod_item';
                                id_borang_dinamik = 'borang_rekod';
                                id_baris = 'baris';
                                class_remove_btn = 'btn_remove';
                                nama_padam = 'Padam Tanggungan';
                                tarikhSediaAda('tarikh_lahir_tanggungan_type_'+mula_index, 'tarikh_lahir_tanggungan_'+mula_index);
                                data_dinamik = '<div class="col-md-12 form-group"><h4>Maklumat Tanggungan/Jagaan '+mula_index+'</h4></div><div class="col-md-12 form-group"><label>Nama Tanggungan</label><input oninput="this.value = this.value.toUpperCase()" class="form-control" type="text" name="nama_tanggungan[]" placeholder="Nama Penuh" required></div><div class="col-md-4"><label>No Kad Pengenalan</label><input onchange="myFunction(\'ic_tanggungan_'+mula_index+'\', \'umur_'+mula_index+'\', \'tarikh_lahir_tanggungan_'+mula_index+'\', \'tarikh_lahir_tanggungan_type_'+mula_index+'\')" id="ic_tanggungan_'+mula_index+'" class="form-control" type="text" name="ic_tanggungan[]" placeholder="Contoh: 001223011234" minlength="12" maxlength="12"></div><div class="col-md-4"><label>Tarikh Lahir</label><input style="display: none" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" id="tarikh_lahir_tanggungan_'+mula_index+'" name="tarikh_lahir_tanggungan[]" type="date"><input pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control" type2="date" id="tarikh_lahir_tanggungan_type_'+mula_index+'" name="tarikh_lahir_tanggungan_type[]" readonly required></div><div class="col-md-4"><label style="color: red">*</label><b>Umur</b><input class="form-control" name="umur_tanggungan[]" id="umur_'+mula_index+'" readonly value=""></div><div class="col-md-4"><label>No Telefon</label><input class="form-control" type="text" name="tel_tanggungan[]"></div><div class="col-md-4"><label>Hubungan</label><input oninput="this.value = this.value.toUpperCase()" class="form-control" type="text" name="hubungan_tanggungan[]" required></div><div class="col-md-4"><label>Anak Yatim</label><select class="form-control form-group" type="text" name="tanggung_anakyatim[]" requiredX><option value="">Sila Pilih</option><option value="Y">Ya</option><option value="N">Tidak</option></select></div><div class="col-md-4"><label>OKU</label><select class="form-control form-group" type="text" name="tanggung_oku[]" requiredX><option value="">Sila Pilih</option><option value="Y">Ya</option><option value="N">Tidak</option></select></div><div class="col-md-4"><label>Status Kahwin</label><select class="form-control form-group" type="text" name="tanggung_kahwin[]" requiredX><option value="">Sila Pilih</option><option value="1">Bujang</option><option value="2">Berkahwin</option><option value="3">Duda</option><option value="4">Janda</option><option value="5">Ibu Tunggal</option></select></div><div class="col-md-4 asnaf_form_anak"><label>Asnaf</label><select class="form-control form-group" type="text" name="tanggung_asnaf[]" requiredX><option value="">Sila Pilih</option><option value="Y">Ya</option><option value="N">Tidak</option></select></div><div class="col-md-4"><label>Mualaf</label><select class="form-control form-group" type="text" name="tanggung_mualaf[]" requiredX onchange="tukar_mualaf(this.value, \'#extra_mualaf_'+mula_index+'\')"><option value="">Sila Pilih</option><option value="1">Ya</option><option value="2">Tidak</option></select></div><div class="col-lg-12" id="extra_mualaf_'+mula_index+'" style="display: none"><div class="form-group row"><div class="col-lg-4"><label style="color: red">*</label><b>Tarikh Memeluk Islam</b><input name="tanggung_tarikh_mualaf[]" class="form-control" type="date" value="" placeholder="Tarikh Rasmi Memeluk Islam"></div><div class="col-lg-4"><label style="color: red">*</label><b>Tempat</b><textarea name="tanggung_tempat_mualaf[]" class="form-control" rows="3" placeholder="Tempat Memeluk Islam"></textarea></div><div class="col-lg-4"><label style="color: red">*</label><b>Dihadapan</b><textarea name="tanggung_dihadapan_mualaf[]" class="form-control" rows="3" placeholder="Qadhi / Pegawai Agama Daerah / Mufti / Dan Lain-lain"></textarea></div></div></div><div class="col-12 col-md-12"><scr'+'ipt>data_sakit(0, "", "id_penyakit_tanggung_'+mula_index+'[]", "rawatan_terkini_tanggung_'+mula_index+'[]", "add_sakit_tanggung_'+mula_index+'", "borang_sakit_tanggung_'+mula_index+'", "padam_sakit_tanggung_'+mula_index+'", "baris_sakit_tanggung_'+mula_index+'", "id_sakit_tanggung_'+mula_index+'", "id_sakit_tanggung_'+mula_index+'[]", "id_sakit_padam_tanggung_'+mula_index+'[]", "", "Padam Penyakit")</scr'+'ipt><label>Sakit Kronik</label><select class="form-control form-group" type="text" name="tanggung_sakitkronik[]" requiredX onchange="pilih_dinamik(this.value, \'add_sakit_tanggung_'+mula_index+'\', \'id_sakit_tanggung_'+mula_index+'[]\', \'padam_sakit_tanggung_'+mula_index+'\', \'id_sakit_padam_tanggung_'+mula_index+'[]\')"><option value="">Sila Pilih</option><option value="Y">Ya</option><option value="N">Tidak</option></select><div id="borang_sakit_tanggung_'+mula_index+'" class="col-12 col-md-12 form-group"></div><div id="padam_sakit_tanggung_'+mula_index+'"></div><button style="display: none" id="add_sakit_tanggung_'+mula_index+'" type="button" class="btn btn-success">Tambah Penyakit</button></div>';
                            </script>
                            <div id="borang_rekod">
                                <?php if($jum_anak > 0) { $i = 1; do {
                                    if($jumpa > 0 || $jumpa3 > 0) {
                                        $sakit_kronik = $kemas2['status_sakit'];
                                        $q_sakit2 = "SELECT * FROM sej6x_data_sakit WHERE id_anak = ".$kemas2['ID'];
                                    }
                                    if($jumpa2 > 0 || $jumpa4 > 0) {
                                        $sakit_kronik = $kemas2['status_sakitkronik'];
                                        $q_sakit2 = "SELECT * FROM sej6x_data_sakit WHERE id_anak_approved = ".$kemas2['ID'];
                                    }
                                    $r_sakit2 = mysqli_query($bd2, $q_sakit2) or die(mysqli_error($bd2));
                                    $jum_sakit2 = mysqli_num_rows($r_sakit2);
                                    $sakit2 = mysqli_fetch_assoc($r_sakit2);
                                    ?>
                                    <div class="row form-group" id="baris<?php echo($i); ?>">
                                        <script type="text/javascript">
                                            jQuery(document).ready(function() {
                                                tarikhSediaAda('tarikh_lahir_tanggungan_type_<?php echo($i); ?>', 'tarikh_lahir_tanggungan_<?php echo($i); ?>');
                                                convertTarikh('<?php echo($kemas2['tarikh_lahir']); ?>', '#tarikh_lahir_tanggungan_type_<?php echo($i); ?>');
                                                myFunction('ic_tanggungan_<?php echo($i); ?>', 'umur_<?php echo($i); ?>', 'tarikh_lahir_tanggungan_<?php echo($i); ?>', 'tarikh_lahir_tanggungan_type_<?php echo($i); ?>');
                                            });
                                        </script>
                                        <div class="col-md-12 form-group"><h4>Maklumat Tanggungan/Jagaan <?php echo($i); ?></h4></div>
                                        <div class="col-md-12 form-group"><label>Nama Tanggungan</label><input oninput="this.value = this.value.toUpperCase()" class="form-control" type="text" name="nama_tanggungan[]" placeholder="Nama Penuh" required value="<?php echo($kemas2['nama_penuh']); ?>"></div>
                                        <div class="col-md-4"><label>No Kad Pengenalan</label><input id="ic_tanggungan_<?php echo($i); ?>" onchange="myFunction('ic_tanggungan_<?php echo($i); ?>', 'umur_<?php echo($i); ?>', 'tarikh_lahir_tanggungan_<?php echo($i); ?>', 'tarikh_lahir_tanggungan_type_<?php echo($i); ?>')" class="form-control" type="text" name="ic_tanggungan[]" placeholder="Contoh: 001223011234" minlength="12" maxlength="12" value="<?php echo($kemas2['no_ic']); ?>"></div>
                                        <div class="col-md-4">
                                            <label>Tarikh Lahir</label>
                                            <input style="display: none" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" id="tarikh_lahir_tanggungan_<?php echo($i); ?>" name="tarikh_lahir_tanggungan[]" type="date" value="<?php echo($kemas2['tarikh_lahir']); ?>">
                                            <input pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control" type2="date" id="tarikh_lahir_tanggungan_type_<?php echo($i); ?>" name="tarikh_lahir_tanggungan_type[]" readonly required>
                                        </div>
                                        <div class="col-md-4">
                                            <label style="color: red">*</label><b>Umur</b> <input
                                                    class="form-control" name="umur_tanggungan[]" id="umur_<?php echo($i); ?>" readonly value="<?php echo($kemas2['umur']); ?>">
                                        </div>
                                        <div class="col-md-4"><label>No Telefon</label><input class="form-control" type="text" name="tel_tanggungan[]" value="<?php echo($kemas2['no_tel']); ?>"></div>
                                        <div class="col-md-4"><label>Hubungan</label><input oninput="this.value = this.value.toUpperCase()" class="form-control" type="text" name="hubungan_tanggungan[]" required value="<?php echo($kemas2['hubungan']); ?>"></div>
                                        <div class="col-md-4">
                                            <label>Anak Yatim</label> <select
                                                    class="form-control form-group" name="tanggung_anakyatim[]" requiredX>
                                                <option value="">Sila Pilih</option>
                                                <option value="Y" <?php if($kemas2['status_anakyatim'] == 'Y') echo('selected'); ?>>Ya</option>
                                                <option value="N" <?php if($kemas2['status_anakyatim'] == 'N') echo('selected'); ?>>Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>OKU</label>
                                            <select class="form-control form-group" type="text" name="tanggung_oku[]" requiredX>
                                                <option value="">Sila Pilih</option>
                                                <option value="Y" <?php if($kemas2['status_oku'] == 'Y') echo('selected'); ?>>Ya</option>
                                                <option value="N" <?php if($kemas2['status_oku'] == 'N') echo('selected'); ?>>Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Status Kahwin</label>
                                            <select class="form-control form-group" type="text" name="tanggung_kahwin[]" requiredX>
                                                <option value="">Sila Pilih</option>
                                                <option value="1" <?php if($kemas2['status_kahwin'] == 1) echo('selected'); ?>>Bujang</option>
                                                <option value="2" <?php if($kemas2['status_kahwin'] == 2) echo('selected'); ?>>Berkahwin</option>
                                                <option value="3" <?php if($kemas2['status_kahwin'] == 3) echo('selected'); ?>>Duda</option>
                                                <option value="4" <?php if($kemas2['status_kahwin'] == 4) echo('selected'); ?>>Janda</option>
                                                <option value="5" <?php if($kemas2['status_kahwin'] == 5) echo('selected'); ?>>Ibu Tunggal</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 asnaf_form_anak">
                                            <label>Asnaf</label>
                                            <select class="form-control form-group" type="text" name="tanggung_asnaf[]" requiredX>
                                                <option value="">Sila Pilih</option>
                                                <option value="Y" <?php if($kemas2['status_asnaf'] == 'Y') echo('selected'); ?>>Ya</option>
                                                <option value="N" <?php if($kemas2['status_asnaf'] == 'N') echo('selected'); ?>>Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Mualaf</label>
                                            <select class="form-control form-group" type="text" name="tanggung_mualaf[]" requiredX onchange="tukar_mualaf(this.value, '#extra_mualaf_<?php echo($i); ?>')">
                                                <option value="">Sila Pilih</option>
                                                <option value="1" <?php if($kemas2['status_mualaf'] == '1') echo('selected'); ?>>Ya</option>
                                                <option value="2" <?php if($kemas2['status_mualaf'] == '2') echo('selected'); ?>>Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12" id="extra_mualaf_<?php echo($i); ?>" style="display: none">
                                            <div class="form-group row">
                                                <div class="col-lg-4">
                                                    <label style="color: red">*</label><b>Tarikh Memeluk Islam</b>
                                                    <input name="tanggung_tarikh_mualaf[]" class="form-control" type="date" value="<?php echo($kemas['tarikh_mualaf']); ?>" placeholder="Tarikh Rasmi Memeluk Islam">
                                                </div>
                                                <div class="col-lg-4">
                                                    <label style="color: red">*</label><b>Tempat</b>
                                                    <textarea name="tanggung_tempat_mualaf[]" class="form-control" rows="3" placeholder="Tempat Memeluk Islam"><?php echo($kemas['tempat_mualaf']); ?></textarea>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label style="color: red">*</label><b>Dihadapan</b>
                                                    <textarea name="tanggung_dihadapan_mualaf[]" class="form-control" rows="3" placeholder="Qadhi / Pegawai Agama Daerah / Mufti / Dan Lain-lain"><?php echo($kemas['dihadapan_mualaf']); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">tukar_mualaf(<?php if($kemas2['status_mualaf'] != NULL) echo($kemas2['status_mualaf']); else echo '0'; ?>, '#extra_mualaf_<?php echo($i); ?>')</script>
                                        <div class="col-12 col-md-12">
                                            <script>
                                                jQuery(document).ready(function(){
                                                    data_sakit(0, '<?php echo($sakit_kronik); ?>', 'id_penyakit_tanggung_<?php echo($i); ?>[]', 'rawatan_terkini_tanggung_<?php echo($i); ?>[]', 'add_sakit_tanggung_<?php echo($i); ?>', 'borang_sakit_tanggung_<?php echo($i); ?>', 'padam_sakit_tanggung_<?php echo($i); ?>', 'baris_sakit_tanggung_<?php echo($i); ?>', 'id_sakit_tanggung_<?php echo($i); ?>_', 'id_sakit_tanggung_<?php echo($i); ?>[]', 'id_sakit_padam_tanggung_<?php echo($i); ?>[]', '', 'Padam Penyakit');
                                                });
                                            </script>
                                            <label>Sakit Kronik</label>
                                            <select class="form-control form-group" type="text" name="tanggung_sakitkronik[]" requiredX onchange="pilih_dinamik(this.value, 'add_sakit_tanggung_<?php echo($i); ?>', 'id_sakit_tanggung_<?php echo($i); ?>[]', 'padam_sakit_tanggung_<?php echo($i); ?>', 'id_sakit_padam_tanggung_<?php echo($i); ?>[]')">
                                                <option value="">Sila Pilih</option>
                                                <option value="Y" <?php if($sakit_kronik == 'Y') echo('selected'); ?>>Ya</option>
                                                <option value="N" <?php if($sakit_kronik == 'N') echo('selected'); ?>>Tidak</option>
                                            </select>
                                            <div id="borang_sakit_tanggung_<?php echo($i); ?>" class="col-12 col-md-12 form-group">
                                                <?php if($jum_sakit2 > 0) { $u = 1; do { ?>
                                                    <script>
                                                        jQuery(document).ready(function(){
                                                            data_sakit_ada('#add_sakit_tanggung_<?php echo($i); ?>', 'id_penyakit_tanggung_<?php echo($i); ?>[]', '<?php echo($sakit2['id_penyakit']); ?>', 'rawatan_terkini_tanggung_<?php echo($i); ?>[]', '<?php echo($sakit2['rawatan_terkini']); ?>', <?php echo(round($u - 1)); ?>, 'id_sakit_tanggung_<?php echo($i); ?>[]', '<?php echo($sakit2['id_sakit']); ?>');
                                                        });
                                                    </script>
                                                    <?php $u++; } while($sakit2 = mysqli_fetch_assoc($r_sakit2)); } ?>
                                            </div>
                                            <div id="padam_sakit_tanggung_<?php echo($i); ?>"></div>
                                            <button style="display: none" id="add_sakit_tanggung_<?php echo($i); ?>" type="button" class="btn btn-success">Tambah Penyakit</button>
                                        </div>
                                        <input type="hidden" id="id_padam_<?php echo($i); ?>" name="id_anak[]" value="<?php echo($kemas2['ID']); ?>">
                                        <div class="col form-group" align="right"><button name="remove" id="<?php echo($i); ?>" type="button" class="btn_remove btn btn-warning form-group">Padam Tanggungan</button></div>
                                    </div>
                                    <?php $i++; } while($kemas2 = mysqli_fetch_assoc($result4)); } ?>
                            </div>
                            <div id="padam_anak"></div>
                            <div class="row form-group"><div class="col" align="right"><button id="add_rekod_item" type="button" class="btn btn-success">Tambah Tanggungan</button></div></div>
                            <?php } ?>
                            <div class="row form-group" align="left">
                                <div class="col-md-12 col-12 form-group">
                                    <?php if($admin_view != NULL) { ?><input type="hidden" name="admin_view" id="admin_view" value="1"><?php } ?>
                                    <input type="hidden" name="selection" value="<?php echo $url_masjid; ?>"> <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
                                    <?php if($tajuk_button != 'Semak Semula') { ?><input type="submit" name="simpan" id="simpan" value="<?php echo($tajuk_button); ?>" class="btn btn-success" /><?php } ?>
                                    <?php if($tajuk_button == 'Semak Semula' && $admin_view == NULL) { ?><a href="../SPMD/login.php"><input type="button" name="simpan" id="simpan" value="<?php echo($tajuk_button); ?>" class="btn btn-success" /></a><?php } ?>
                                    <?php if($tajuk_button == 'Semak Semula' && $admin_view != NULL) { ?><a href="utama.php?view=admin&action=pendaftaran&module=add_ahli&"><input type="button" name="simpan" id="simpan" value="<?php echo($tajuk_button); ?>" class="btn btn-success" /></a><?php } ?>
                                </div>
                                <div style="display: none" class="col-md-4 col-12 form-group"><a href="pendaftaran.php?id_masjid=<?php echo($id_masjid); ?>"><input
                                                type="button" name="isi_semula" id="isi_semula" value="Isi Semula"
                                                class="btn btn-warning" /></a>
                                </div>
                                <div style="display: none" class="col-md-4 col-12 form-group"><a href="../login.php">
                                        <input type="button" name="isi_semula2" id="isi_semula2" value="Halaman Utama"
                                               class="btn btn-danger" /></a>
                                </div>
                            </div>

                </form>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel pnael-info -->
    </div>
    <!-- /.col-lg-12 -->
<?php if($admin_view == NULL) { ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div id="badan" class="modal-body">Maklumat anda dilindungi oleh Akta 709(Akta Perlindungan Data Peribadi 2010). Pihak <strong><?php echo($nama_masjid); ?></strong> bertanggungjawab & memberi jaminan atas setiap data maklumat yang anda berikan adalah selamat</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if($admin_view == NULL) { ?>
    <script src="<?php echo($sekerip); ?>vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo($sekerip); ?>assets/js/main.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/chosen/chosen.jquery.min.js"></script>
    <!--script src="../vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/widgets.js"></script-->
<?php } ?>
<?php if($_POST['preview'] == NULL) { ?>
    <script src="<?php echo($sekerip); ?>vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/pdfmake/build/vfs_fonts.js"></script>
<?php } ?>
<?php if($_POST['preview'] == NULL) { ?>
    <script src="<?php echo($sekerip); ?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?php echo($sekerip); ?>assets/js/init-scripts/data-table/datatables-init.js"></script>
<?php } ?>
    <script type="text/javascript">
        <?php if($admin_view == NULL && $_POST['preview'] == NULL) { ?>jQuery('#exampleModal').modal('show');<?php } ?>

        function showDaerah(str, str2) {
            if (str == "" && str2 == "") {
                document.getElementById("daerah").innerHTML = "";
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
                        document.getElementById("daerah").innerHTML = this.responseText;
                        <?php if($_POST['preview'] == 1) { ?>disableSemua();<?php } ?>
                    }
                };
                <?php if($admin_view == NULL && $_POST['preview'] == NULL) { ?>xmlhttp.open("GET","getdaerah.php?negeri="+str+"&daerah="+str2,true);<?php } ?>
                <?php if($admin_view != NULL || $_POST['preview'] != NULL) { ?>xmlhttp.open("GET","daftar_online/getdaerah.php?negeri="+str+"&daerah="+str2,true);<?php } ?>
                xmlhttp.send();
            }
        }

        function myFunction(a, b, c, d){
            jQuery(document).ready(function () {
                var tl = document.getElementById(a).value;
                var date = tl.substr(0,6);
                var year = tl.substr(0,2);
                var month = tl.substr(2,2);
                var day = tl.substr(4,2);

                if(year >= (<?php echo(date('y')); ?> + 1))
                {
                    year = 19+year;
                }
                else if(year <= <?php echo(date('y')); ?>)
                {
                    year = 20+year;
                }

                var today = new Date();
                var dd = String(today.getDate()).padStart(2,'0');
                var mm = String(today.getMonth()+1).padStart(2,'0');
                var yyyy = today.getFullYear();

                today = yyyy+'-'+mm+'-'+dd;

                var umur = parseInt(yyyy) - parseInt(year);
                var umur_bulan = parseInt(mm) - parseInt(month);
                if(umur_bulan < 0 )
                {
                    umur = parseInt(umur) - 1;
                }
                else if(umur_bulan == 0 )
                {
                    var umur_hari = parseInt(dd) - parseInt(day);

                    if(umur_hari < 0 )
                    {
                        umur = parseInt(umur) - 1;
                    }
                }

                document.getElementById(b).value = umur;

                //var tarikh = day+'-'+month+'-'+year;
                var tarikh = year+'-'+month+'-'+day;
                var tarikh2 = tarikh;
                convertTarikh(tarikh2, '#'+d);
                jQuery('#'+c).val(tarikh);
                //document.getElementById(c).value = tarikh;

                if(umur > 59)
                {
                    //document.getElementById('warga_emas').selectedIndex = "1";
                    //document.getElementById('warga_emas').value = "Ya";
                }
                else if(umur < 60)
                {
                    //document.getElementById('warga_emas').selectedIndex = "2";
                    //document.getElementById('warga_emas').value = "Tidak";
                }
                ubah_yatim(umur, '#anak_yatim_form', '#data_anakyatim');
            });
        }
        <?php if($negeri2 != NULL && $daerah2 != NULL) { ?>
        showDaerah(<?php echo($negeri2); ?>, <?php echo($daerah2); ?>);
        <?php } ?>
        <?php if($_POST['preview'] == 1) { ?>
        function disableSemua() {
            jQuery(document).ready(function () {
                jQuery("#insert_form input").prop("disabled", true);
                jQuery("#insert_form select").prop("disabled", true);
                jQuery("#insert_form button").prop("disabled", true);
            });
        }
        disableSemua();
        <?php } ?>
		var inputEl = document.getElementById('no_ic');
		var goodKey = '0123456789';

		var checkInputIC = function(e) {
		  var key = (typeof e.which == "number") ? e.which : e.keyCode;
		  var start = this.selectionStart,
			end = this.selectionEnd;

		  var filtered = this.value.split('').filter(filterInput);
		  this.value = filtered.join("");

		  /* Prevents moving the pointer for a bad character */
		  var move = (filterInput(String.fromCharCode(key)) || (key == 0 || key == 8)) ? 0 : 1;
		  this.setSelectionRange(start - move, end - move);
		}

		var filterInput = function(val) {
		  return (goodKey.indexOf(val) > -1);
		}

		inputEl.addEventListener('input', checkInputIC);
    </script>
<?php if($admin_view == NULL && $_POST['preview'] == NULL) { include("../ajax_functions.php"); ?>
    </body>
    </html>
<?php } ?>