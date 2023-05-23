<?php
session_start();
if($admin_view == NULL) $admin_view = $_POST['admin_view'];
if($admin_view == NULL) $admin_view = $_GET['admin_view'];
if($admin_view == NULL) {
    $approved = 0;
    $sekerip = "../";
    include('../connection/connection.php');
    include('../fungsi.php');
    $daftar_online = 1;
    if($id_masjid == NULL) {
        $id_masjid = $_GET['id_masjid'];
        $id_masjid_dua = e($_GET['id_masjid']);
    }

    if (isset($_GET['id_masjid']) && $_SERVER["REQUEST_METHOD"] != "POST") {
        $check_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid = $id_masjid";
        $result_masjid = mysqli_query($bd2, $check_masjid);
        $num_masjid = mysqli_num_rows($result_masjid);
        //if ($num_masjid < 1) header('Location: ../login.php');
    }

    //if (!isset($_GET['id_masjid']) && $_SERVER["REQUEST_METHOD"] != "POST") header('Location: ../login.php');
    $post_url = htmlspecialchars($_SERVER['PHP_SELF'].'?');
}
if($admin_view != NULL || $_POST['preview'] != NULL) {
    $sekerip = "";
    $approved = 1;
    $post_url = htmlspecialchars($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&');
}
$sql4 = "SELECT * FROM sej6x_data_masjid WHERE id_masjid = $id_masjid";
$sqlquery4 = mysqli_query($bd2, $sql4);
$data4 = mysqli_fetch_array($sqlquery4);
$nama_masjid = $data4['nama_masjid'];

if($_SERVER["REQUEST_METHOD"] == "POST") $id_masjid = $_POST['id_masjid'];
//echo($semak.'<br />'.$no_ic);
if (isset($_POST['simpan']) || $_GET['id_kematian'] != NULL) {
    $semak = $_POST['semak'];
    $no_ic = e($_POST['no_ic']);
    if($_GET['id_kematian'] != NULL) $no_ic = $_GET['no_ic'];
    if($semak == 1 || $_GET['id_kematian'] != NULL) {
        if($id_masjid != NULL) {
            $extra = "AND a.id_masjid = $id_masjid";
            $extra2 = "AND c.id_masjid = $id_masjid";
        }

        $q = "SELECT a.nama_penuh, a.no_ic, a.id_data, b.nama_masjid, a.id_masjid FROM sej6x_data_peribadi a, sej6x_data_masjid b WHERE a.id_masjid = b.id_masjid AND a.no_ic = '$no_ic' $extra 
            UNION SELECT c.nama_penuh, c.no_ic, CONCAT('A-', c.ID) 'id_data', d.nama_masjid, c.id_masjid FROM sej6x_data_anakqariah c, sej6x_data_masjid d WHERE c.id_masjid = d.id_masjid AND c.no_ic = '$no_ic' $extra2";
        $q_query = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
        $row_q = mysqli_fetch_assoc($q_query);
        $jumpa = mysqli_num_rows($q_query);
        $id_masjid_user = $row_q['id_masjid'];

        if(strpos($row_q['id_data'], 'A-') !== false) $id_anak = str_replace('A-', '', $row_q['id_data']);
        if(strpos($row_q['id_data'], 'A-') !== true) $id_data = $row_q['id_data'];

            if($jumpa > 0) {
            $q2 = "SELECT a.* FROM data_kematian a, sej6x_data_peribadi b WHERE a.id_data = b.id_data AND b.no_ic = '$no_ic'
            UNION SELECT c.* FROM data_kematian c, sej6x_data_anakqariah d WHERE c.id_anak = d.ID AND d.no_ic = '$no_ic'";
            $q2_query = mysqli_query($bd2, $q2) or die(mysqli_error($bd2));
            $row_q2 = mysqli_fetch_assoc($q2_query);
            $jumpa2 = mysqli_num_rows($q2_query);

            if($jumpa2 > 0) {
                $id_kematian = $row_q2['id_kematian'];
                $id_masjid = $row_q2['id_masjid'];
                $approved = $row_q2['approved'];
                $id_data = $row_q2['id_data'];
                $id_anak = $row_q2['id_anak'];
                $no_sijil = $row_q2['no_sijil'];
                $tarikh_kematian = $row_q2['tarikh_kematian'];
                $waktu_kematian = $row_q2['waktu_kematian'];
                $sebab_kematian = $row_q2['sebab_kematian'];
                $lokasi = $row_q2['lokasi'];
                $tarikh_dikebumikan = $row_q2['tarikh_dikebumikan'];
                $waktu_dikebumikan = $row_q2['waktu_dikebumikan'];
                $no_kubur = $row_q2['no_kubur'];
                $nama_fail = $row_q2['nama_fail'];
                $nama_fail2 = $row_q2['nama_fail2'];
            }
        }
    }

    if($semak == 2) {
        $myObj = array();
        $id_kematian = e($_POST['id_kematian']);
        $id_data = e($_POST['id_data']);
        $id_anak = e($_POST['id_anak']);
        $no_sijil = e($_POST['no_sijil']);
        $tarikh_kematian = $_POST['tarikh_kematian'];
        $waktu_kematian = $_POST['waktu_kematian'];
        $sebab_kematian = e($_POST['sebab_kematian']);
        $lokasi = e($_POST['lokasi']);
        $tarikh_dikebumikan = $_POST['tarikh_dikebumikan'];
        $waktu_dikebumikan = $_POST['waktu_dikebumikan'];
        $no_kubur = e($_POST['no_kubur']);

        //if($tarikh_kematian == NULL || $tarikh_kematian = '') $tarikh_kematian = '0000-00-00';
        //if($waktu_kematian == NULL || $waktu_kematian = '') $waktu_kematian = '00:00:00';
        //if($tarikh_dikebumikan == NULL || $tarikh_dikebumikan = '') $tarikh_dikebumikan = '0000-00-00';
        //if($waktu_dikebumikan == NULL || $waktu_dikebumikan = '') $waktu_dikebumikan = '00:00:00';

        //var_dump($tarikh_kematian, $waktu_kematian, $tarikh_dikebumikan, $waktu_dikebumikan);

        if($_SESSION['id_masjid'] != NULL) $approved = 1;
        if($_SESSION['id_masjid'] == NULL) {
            $approved = 0;
            $id_masjid = e($_POST['id_masjid_user']);
        }
        /*
        $bb = 0;
        for ($b = 0; $b < count($_FILES['nama_fail']); $b++) {
            if ($_FILES['nama_fail'][$b] != NULL) {
                $NamaFile = muat_naik('nama_fail', "Uploads/$id_masjid/kematian/", 0, 5242880, 1, $b);
                if ($NamaFile != NULL && $NamaFile != "") {
                    $myObj[$bb]->NamaFile = "$NamaFile";
                    $bb++;
                }
            }
        }
        $nama_fail = json_encode($myObj);
        */

        $nama_fail = e($_POST['nama_fail_64']);
        $nama_fail2 = e($_POST['nama_fail_64_2']);

        if ($id_data != NULL) {
            $id_update = $id_data;
            $column = "id_data";
        }
        if ($id_anak != NULL) {
            $id_update = $id_anak;
            $column = "id_anak";
        }
        if ($id_kematian != NULL) $q = "UPDATE data_kematian SET id_masjid = $id_masjid, approved = $approved, $column = $id_update, no_sijil = '$no_sijil', tarikh_kematian = '$tarikh_kematian', waktu_kematian = '$waktu_kematian', sebab_kematian = '$sebab_kematian', lokasi = '$lokasi', tarikh_dikebumikan = '$tarikh_dikebumikan', waktu_dikebumikan = '$waktu_dikebumikan', no_kubur = '$no_kubur', nama_fail = '$nama_fail', nama_fail2 = '$nama_fail2', time = NOW() WHERE id_kematian = $id_kematian";
        if ($id_kematian == NULL) $q = "INSERT INTO data_kematian (id_masjid, approved, $column, no_sijil, tarikh_kematian, waktu_kematian, sebab_kematian, lokasi, tarikh_dikebumikan, waktu_dikebumikan, no_kubur, nama_fail, nama_fail2, time) VALUES ($id_masjid, $approved, $id_update, '$no_sijil', '$tarikh_kematian', '$waktu_kematian', '$sebab_kematian', '$lokasi', '$tarikh_dikebumikan', '$waktu_dikebumikan', '$no_kubur', '$nama_fail', '$nama_fail2', NOW())";
        mysqli_query($bd2, $q) or die($q.' - '.mysqli_error($bd2));
        $notis = "Maklumat Kematian BERJAYA Disimpan / Dikemaskini";

        //mysqli_select_db($bd2, $mysql_database);

        echo "<script>alert('" . $notis . "');</script>";
    }
}
?>
<?php if($admin_view == NULL) { ?>
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
        <title>Masjid Pro - Daftar Kematian <?php echo($nama_masjid); ?></title>
        <meta name="description" content="Masjid Pro - Daftar Kematian Ahli Kariah <?php echo($nama_masjid); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-icon.png">
        <link rel="shortcut icon" href="favicon.ico">
        <!--link rel="stylesheet" href="../bootstrap_latest/css/bootstrap.css" integrity2="sha256-1hm7xPFY4HL/GPfWz595kcNLVmuMC43nPagoQhWTb58=" crossorigin2="anonymous" /-->
        <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel='stylesheet' type='text/css'>
        <script id="pilih_jquery" src="../js/jquery-3.4.1.js"></script>
        <script id="pilih_ui" src="../js/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.js" integrity="sha256-dgFbqbQVzjkZPQxWd8PBtzGiRBhChc4I2wO/q/s+Xeo=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../js/jquery-ui.css">
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
            convertTarikh('<?php echo($tarikh_kematian); ?>', '#tarikh_kematian_type');
            $( "#tarikh_kematian_type" ).datepicker({
                dateFormat: "dd/mm/yy",
                yearRange: "1900:<?php echo(date('Y')); ?>",
                maxDate: "0",
                altField: "#tarikh_kematian",
                altFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true
            });
        </script>
    </head>

    <body style="background-color: #4e4e52">
    <br>
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
<?php } ?>
<?php if($admin_view != NULL || $_POST['preview'] != NULL) { ?><div class="col-12 col-md-12"><?php } ?>
    <div class="card">
        <div class="card-header" <?php if($_POST['preview'] == 1) echo 'style="display: none"'; ?>><br />
            <center><h2>
                    <?php if($no_ic == NULL || $jumpa2 == 0) { $tajuk_button = 'Semak'; ?><b>Daftar Kematian Ahli Kariah</b><?php } ?>
                    <br>
                    <?php if($id_masjid != NULL) echo($nama_masjid); ?>
                </h2>
                    <?php if($no_ic != NULL && ($jumpa > 0 || $jumpa2 > 0)) { $tajuk_button = 'Kemaskini'; ?>
                        <?php if($jumpa2 > 0 && $approved != 1) { ?>
                            <div style="font-size: medium" class="alert alert-warning" role="alert">
                                Maklumat kematian sedang diproses oleh pihak Masjid, anda boleh mengemaskini maklumat dibawah sekiranya perlu.
                            </div>
                            <b>Lihat / Kemaskini Maklumat Kematian Ahli Kariah</b>
                        <?php } ?>
                        <?php if($jumpa2 > 0 && $approved == 1) { ?>
                            <div style="font-size: medium" class="alert alert-success" role="alert">
                                Maklumat kematian telah disahkan oleh pihak Masjid.
                            </div>
                            <b>Maklumat Kematian Ahli Kariah</b>
                        <?php } ?>
                        <?php if($jumpa > 0 && $jumpa2 == 0) { $tajuk_button = 'Daftar Kematian'; ?>
                            <div style="font-size: medium" class="alert alert-success" role="alert">
                                Maklumat Ahli Kariah Dijumpai.
                            </div>
                            <b>Daftar Kematian Ahli Kariah</b>
                        <?php } ?>
                    <?php } ?>
                    <?php if($no_ic != NULL && $jumpa == 0) { $tajuk_button = 'Semak Semula'; ?>
                        <div class="alert alert-danger" role="alert">
                            No K/P belum didaftarkan sebagai ahli kariah, anda perlu mendaftarkan maklumat si mati sebagai ahli kariah terlebih dahulu.
                        </div>
                    <?php } ?>
                </center>
        </div>
        <div class="card-body">
            <?php if($admin_view == NULL) { ?><form method="post" name="add_kematian" id="add_kematian" action="<?php echo($post_url); ?>" enctype="multipart/form-data"><?php } ?>
                <?php if($admin_view != NULL) { ?><form role="form" class="form-validate form-horizontal well" name="<?php echo($_GET['module']); ?>" id="<?php echo($_GET['module']); ?>" enctype="multipart/form-data"><?php } ?>
                    <?php if($no_ic == NULL) { ?>
                        <div class="row form-group">
                            <div class="col-12 col-md-6 form-group" align="left">
                                <label>No K/P:</label>
                                <input class="form-control" name="no_ic" id="no_ic" placeholder="Contoh: 880528355036" minlength="12" maxlength="12" required value="<?php echo($no_ic); ?>">
                                <input type="hidden" id="semak" name="semak" value="1">
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($no_ic != NULL && $jumpa > 0) { ?>
                    <div class="row">
                        <input type="hidden" id="semak" name="semak" value="2">
                        <?php //do { ?>
                        <div class="col-md-6 col-12 form-group">
                            <div class="card">
                                <input id="id_kematian" name="id_kematian" type="hidden" value="<?php echo($id_kematian); ?>">
                                <input id="id_data" name="id_data" type="hidden" value="<?php echo($id_data); ?>">
                                <input id="id_anak" name="id_anak" type="hidden" value="<?php echo($id_anak); ?>">
                                <input id="id_masjid_user" name="id_masjid_user" type="hidden" value="<?php echo($id_masjid_user); ?>">
                                <input id="approved" name="approved" type="hidden" value="<?php echo($approved); ?>">
                                <h5 class="card-header"><?php echo($row_q['nama_penuh']); ?></h5>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo($row_q['no_ic']); ?></h5>
                                    <h5 class="card-title"><?php echo($row_q['nama_masjid']); ?></h5>
                                    <div class="card-title">
                                        <label>No Sijil Kematian</label>
                                        <input id="no_sijil" name="no_sijil" class="form-control" value="<?php echo($no_sijil); ?>" maxlength="20">
                                    </div>
                                    <div class="card-title">
                                        <label>Tarikh Kematian</label>
                                        <input class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" name="tarikh_kematian" id="tarikh_kematian" type="date" value="<?php if($id_kematian == NULL) echo('0000-00-00'); else echo($tarikh_kematian); ?>">
                                        <input style="display: none" readonly class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" name="tarikh_kematian_type" id="tarikh_kematian_type" placeholder="Contoh: 1992-05-30">
                                    </div>
                                    <div class="card-title">
                                        <label>Waktu Kematian</label>
                                        <input type="time" id="waktu_kematian" name="waktu_kematian" class="form-control" value="<?php if($id_kematian == NULL) echo('00:00:00'); else echo($waktu_kematian); ?>">
                                    </div>
                                    <div class="card-title">
                                        <label>Lokasi Kematian</label>
                                        <textarea id="lokasi" name="lokasi" class="form-control" maxlength="50" rows="3"><?php echo($lokasi); ?></textarea>
                                    </div>
                                    <div class="card-title">
                                        <label>Sebab Kematian</label>
                                        <textarea id="sebab_kematian" name="sebab_kematian" class="form-control" maxlength="60" rows="3"><?php echo($sebab_kematian); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($kod_masjid != NULL || $approved == 1) { ?>
                        <div class="col-md-6 col-12 form-group">
                            <div class="card">
                                <h5 class="card-header">Maklumat Pengkebumian</h5>
                                <div class="card-body">
                                    <div class="card-title">
                                        <label>Tarikh Dikebumikan</label>
                                        <input type="date" id="tarikh_dikebumikan" name="tarikh_dikebumikan" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php if($id_kematian == NULL) echo('0000-00-00'); else echo($tarikh_dikebumikan); ?>">
                                    </div>
                                    <div class="card-title">
                                        <label>Waktu Dikebumikan</label>
                                        <input type="time" id="waktu_dikebumikan" name="waktu_dikebumikan" class="form-control" value="<?php if($id_kematian == NULL) echo('00:00:00'); else echo($waktu_dikebumikan); ?>">
                                    </div>
                                    <div class="card-title">
                                        <label>No Kubur (Jika Berkenaan)</label>
                                        <input id="no_kubur" name="no_kubur" class="form-control" value="<?php echo($no_kubur); ?>" maxlength="20">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-md-6 col-12 form-group">
                            <div class="card">
                                <h5 class="card-header">Muat-Naik Dokumen</h5>
                                <div class="card-body">
                                    <div class="alert alert-primary">* Format Fail Diterima: JPG, JPEG, GIF, PNG & PDF. Saiz fail TIDAK MELEBIHI 5MB.</div>
                                    <div class="card-title">
                                        <label>Sijil Kematian</label>
                                        <input id="nama_fail" name="nama_fail" class="form-control" type="file" accept=".jpg,.gif,.png,.jpeg,.pdf" onchange="preview_image(event, 'output1')">
                                        <img class="img-fluid p-3" id="output1" src="<?php echo($nama_fail); ?>"><input type="hidden" id="output1_base64" name="nama_fail_64" value="<?php echo($nama_fail); ?>">
                                    </div>
                                    <div class="card-title">
                                        <label>Lain-lain Dokumen</label>
                                        <input id="nama_fail2" name="nama_fail2" class="form-control" type="file" accept=".jpg,.gif,.png,.jpeg,.pdf" onchange="preview_image(event, 'output2')">
                                        <img class="img-fluid p-3" id="output2" src="<?php echo($nama_fail2); ?>"><input type="hidden" id="output2_base64" name="nama_fail_64_2" value="<?php echo($nama_fail2); ?>">
                                    </div>
                                </div>
                                <?php if($approved != 1 || $_SESSION['id_masjid'] != NULL) { ?>
                                <div class="card-body"><input class="btn btn-primary btn-block" type="submit" name="simpan" id="simpan" value="<?php echo($tajuk_button); ?>" /></div>
                            <?php } ?>
                            </div>
                        </div>
                        <input type="hidden" id="id_data" name="id_data" value="<?php echo($row_q['id_data']); ?>">
                        <?php //} while ($row_q = mysqli_fetch_assoc($q_query)); ?>
                        <?php } ?>
                        <div class="row form-group">
                            <div class="col-md-12 col-12 form-group">
                                <?php if($admin_view != NULL) { ?><input type="hidden" name="admin_view" id="admin_view" value="1">
                                <?php } ?>
                                <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
                                <?php if($no_ic == NULL) { ?><input class="btn btn-primary" type="submit" name="simpan" id="simpan" value="<?php echo($tajuk_button); ?>" /><?php } ?>
                                <?php if($tajuk_button == 'Semak Semula' && $admin_view == NULL) { ?><a href="daftar_kematian.php"><input type="button" name="simpan" id="simpan" value="<?php echo($tajuk_button); ?>" class="btn btn-success" /></a><?php } ?>
                                <?php if($tajuk_button == 'Semak Semula' && $admin_view != NULL) { ?><a href="utama.php?view=admin&action=pendaftaran&module=add_kematian&"><input type="button" name="simpan" id="simpan" value="<?php echo($tajuk_button); ?>" class="btn btn-success" /></a><?php } ?>
                            </div>
                        </div>
                    </div>

                </form>
        </div>
    </div>

<?php if($_SESSION['id_masjid'] == NULL && $no_ic != NULL) { ?>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div id="badan" class="modal-body">Maklumat anda dilindungi oleh Akta 709(Akta Perlindungan Data Peribadi 2010). Pihak <strong><?php echo($row_q['nama_masjid']); ?></strong> bertanggungjawab & memberi jaminan atas setiap data maklumat yang anda berikan adalah selamat</div>
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
    <script>
        <?php if($admin_view == NULL && $_POST['preview'] == NULL) { ?>jQuery('#exampleModal').modal('show');<?php } ?>
    </script>
<?php if($admin_view == NULL && $_POST['preview'] == NULL) { include("../ajax_functions.php"); ?>
    </body>
    </html>
<?php } ?>