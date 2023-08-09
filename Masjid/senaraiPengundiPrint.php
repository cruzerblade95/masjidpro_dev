<?php
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();

$host = "localhost";
$user = "tahfizte_spmd";
$password = "WebmasterMasjid2019";
$db = "tahfizte_masjidpro";

$bd2 = mysqli_connect($host, $user, $password, $db) or die(mysqli_error($bd2));

include("fungsi_tarikh.php");

function selValueSQL($query, $key_name) {
    global $bd2, ${'meja_'.$key_name}, ${'row_'.$key_name}, ${'fetch_'.$key_name}, ${'num_'.$key_name}, ${'field_'.$key_name};

    ${'fetch_'.$key_name} = mysqli_query($bd2, $query) or die(mysqli_error($bd2));
    ${'field_'.$key_name} = mysqli_fetch_fields(${'fetch_'.$key_name});
    ${'num_'.$key_name} = mysqli_num_rows(${'fetch_'.$key_name});
    ${'row_'.$key_name} = mysqli_fetch_assoc(${'fetch_'.$key_name});
    ${'meja_'.$key_name} = mysqli_fetch_field(${'fetch_'.$key_name});
}

if($_SERVER['REQUEST_METHOD'] == "POST" && $_SESSION['id_masjid'] != NULL) {
    $id_masjid = $_SESSION['id_masjid'];
    if($_POST['jantina'] != 0) {
        $jantina = $_POST['jantina'];
        $extraJantina = "AND aa.jantina = $jantina";
        $extraJantina2 = "AND a.jantina = $jantina";
    }
    $q = "SELECT aa.tarikh_lahir, (YEAR(NOW()) - YEAR(aa.tarikh_lahir)) AS umur, UPPER(aa.nama_penuh) 'nama_penuh', CONCAT(SUBSTRING(aa.no_ic, 1, 8), 'XXXX') AS no_ic, UPPER(aa.alamat_terkini) 'alamat_terkini', aa.id_data AS id_keluarga, 1 AS ketua FROM sej6x_data_peribadi aa WHERE aa.id_masjid = $id_masjid AND aa.tarikh_lahir IS NOT NULL AND aa.tarikh_lahir != '0000-00-00' AND aa.tarikh_lahir != '' AND (YEAR(NOW()) - YEAR(aa.tarikh_lahir)) >= 18 AND (((SELECT COUNT(*) FROM data_pindah aaa WHERE aaa.id_data = aa.id_data) < 1) AND ((SELECT COUNT(*) FROM data_kematian aaaa WHERE aaaa.id_data = aa.id_data) < 1)) $extraJantina UNION ";
    $q .= "SELECT a.tarikh_lahir, (YEAR(NOW()) - YEAR(a.tarikh_lahir)) AS umur, UPPER(a.nama_penuh) 'nama_penuh', CONCAT(SUBSTRING(a.no_ic, 1, 8), 'XXXX') AS no_ic, UPPER(b.alamat_terkini) 'alamat_terkini', b.id_data AS id_keluarga, 2 AS ketua FROM sej6x_data_anakqariah a, sej6x_data_peribadi b WHERE b.id_masjid = $id_masjid AND (a.id_qariah = b.id_data OR a.no_ic_ketua = b.no_ic) AND a.tarikh_lahir IS NOT NULL AND a.tarikh_lahir != '0000-00-00' AND a.tarikh_lahir != '' AND (YEAR(NOW()) - YEAR(a.tarikh_lahir)) >= 18 AND (((SELECT COUNT(*) FROM data_pindah z WHERE z.id_anak = a.ID) < 1) AND  ((SELECT COUNT(*) FROM data_kematian zz WHERE zz.id_anak = a.ID) < 1)) $extraJantina2";
    $q .= " ORDER BY nama_penuh ASC";
    selValueSQL($q, 'senaraiLayak');
    //echo("<!--div>$q</div-->");
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
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MasjidPro Penang - Senarai Layak Mengundi">
    <meta name="author" content="Senarai Layak Mengundi menerusi aplikasi MasjidPro Penang">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="images/logo2.png">
    <title>MasjidPro Penang - Senarai Layak Mengundi</title>

    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.css" integrity="sha512-Ty5JVU2Gi9x9IdqyHN0ykhPakXQuXgGY5ZzmhgZJapf3CpmQgbuhGxmI4tsc8YaXM+kibfrZ+CNX4fur14XNRg==" crossorigin="anonymous" referrerpolicy="no-referrer" /-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.css" integrity="sha512-4wfcoXlib1Aq0mUtsLLM74SZtmB73VHTafZAvxIp/Wk9u1PpIsrfmTvK0+yKetghCL8SHlZbMyEcV8Z21v42UQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style type="text/css">
        body {font-family: arial, sans-serif;}
        table {
            border-collapse: collapse;
            width: 100%;
        }

        input[type='checkbox'] {
            width: 36px;
            height: 36px;
        }

        input[type='text'] {
            width: 250px;
            height: 36px;
        }

        .kelasthlebar {
            width: 350px;
        }

        .kelastd, .kelasth {
            border: 1px solid #dddddd;
            text-align2: left;
            padding: 8px;
        }

        .kelastr tr:nth-child(even) {
            background-color: #dddddd;
        }
        #kepala {
            width: 600px;
        }
        #table_tarikh {
            width: 600px;
        }
        #table_tarikh tr {
            border: none;
        }
        #table_tarikh th {
            border: none;
        }
        #table_tarikh td {
            border: none;
        }
        @media print {

            table {
                font-size: small;
            }

            .printPageButton, #link_back {
                display: none;
            }
            footer {page-break-after: always;}
            .kelastd, .kelasth {
                border: 1px solid #dddddd;
                text-align2: left;
                padding: 8px;
            }
            .kelastd2, .kelasth2 {
                border: none;
                width: max-content;
            }

            .kelastr tr:nth-child(even) {
                background-color: #dddddd;
                width: max-content;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row table-responsive">
        <div class="printPageButton" align="center" style="margin-top: 20px; margin-bottom: 20px">
            <button id="butang_pering" style="text-align: center; font-size: 20pt; font-weight: bold" onclick="window.print()">Cetak</button>
        </div>
        <?php if($num_senaraiLayak > 0) { ?>
            <div class="col-12" align="center">
                <h2><?php echo($_SESSION['nama_masjid']); ?></h2>
                <h3>Senarai Layak Mengundi (<?php echo($num_senaraiLayak); ?> Orang)<br />sehingga Tarikh: <?php fungsi_tarikh(date("Y-m-d H:i:s"), 2, 2); ?></h3>
                <h3>Tarikh akhir bantahan: <?php fungsi_tarikh($_POST['tarikh_akhir'], 2, 2); ?></h3>
                <?php if($_POST['jantina'] == 1) { ?><h3>LELAKI</h3><?php } ?>
                <?php if($_POST['jantina'] == 2) { ?><h3>PEREMPUAN</h3><?php } ?>
            </div>
            <hr />
            <table class="table table-striped table-bordered kelastr" width="100%">
                <thead>
                <tr>
                    <th scope="col" class="kelasth">#</th>
                    <th class="kelasth">Nama</th>
                    <th class="kelasth">No K/P</th>
                    <th class="kelasth">Alamat Terkini</th>
                    <th class="kelasth">Umur</th>
                    <th class="kelasth">Semakan</th>
                    <th class="kelasth">Catatan</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; do { ?>
                    <tr>
                        <td class="kelastd"><div align="center"><?php echo($i); ?></div></td>
                        <td class="kelastd"><?php echo($row_senaraiLayak['nama_penuh']); ?></td>
                        <td class="kelastd"><div align="center"><?php echo($row_senaraiLayak['no_ic']); ?></div></td>
                        <td class="kelastd"><?php echo($row_senaraiLayak['alamat_terkini']); ?></td>
                        <td class="kelastd"><div align="center"><?php echo($row_senaraiLayak['umur']); ?></div></td>
                        <td class="kelastd"><div align="center"><input type="checkbox"></div></td>
                        <td class="kelastd"><div align="center"><input type="text"></div></td>
                    </tr>
                    <?php $i++; } while($row_senaraiLayak = mysqli_fetch_assoc($fetch_senaraiLayak)); ?>
                </tbody>
            </table>
            <?php $i++; } else { ?>
            <div class="col-12">
                <?php if($_SESSION['id_masjid'] != NULL) { ?>
                    <div class="alert alert-danger" role="alert"><h4>Rekod Tidak Dijumpai</h4></div>
                <?php } else { ?>
                    <div class="alert alert-danger" role="alert"><h4>Sesi telah tamat, sila log masuk semula</h4></div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.5/umd/popper.js" integrity="sha512-1iNcoHkM8vq9d3M2XG+/JZbzAyIh9U9Z6ioUJcNDNh1NQiri9i4Ydl5HTgUpMLLwRCoGLWFvKCy/dAwu+Nzh9w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.js" integrity="sha512-0agUJrbt+sO/RcBuV4fyg3MGYU4ajwq2UJNEx6bX8LJW6/keJfuX+LVarFKfWSMx0m77ZyA0NtDAkHfFMcnPpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>

<?php mysqli_close($bd2); ?>
