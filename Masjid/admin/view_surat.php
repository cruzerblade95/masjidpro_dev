<?php
include('../connection/connection.php');
include("../fungsi.php");
include("../fungsi_tarikh.php");
$id_surat = $_GET['id_surat'];
if(!is_numeric($id_surat)) $id_surat = NULL;

$q_data = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$id_masjid'";
$list = mysqli_query($bd2, $q_data);
$row_user = mysqli_fetch_assoc($list);
$id_masjid = $row_user['id_masjid'];

$sql_user = "SELECT a.user_name, b.user_type FROM masjid_user a, jenis_user b WHERE a.user_type_id=b.user_type_id AND a.id_masjid='$id_masjid' AND a.user_type_id='2'";
$query_user = mysqli_query($bd2,$sql_user);
$data_user = mysqli_fetch_array($query_user);

//$q_info = "SELECT UPPER(a.motto) 'Motto', UPPER(a.kampung) 'Kampung', UPPER(a.bandar_kawasan) 'Kawasan', UPPER(d.negeri) 'Negeri', logo FROM kampung a, mukim b, daerah c, negeri d WHERE a.id_mukim = b.id_mukim AND b.id_daerah = c.id_daerah AND c.id_negeri = d.id_negeri AND a.id_kampung = $id_kampung_user";
//$info = mysqli_query($bd2, $q_info) or die(mysqli_error($koneksi));
//$r_info = mysqli_fetch_assoc($info);

//$q_surat = "SELECT * FROM jenis_surat";
//$surat = mysqli_query($bd2, $q_surat) or die(mysqli_error($bd2));
//$r_surat = mysqli_fetch_assoc($surat);

$q1 = "SELECT * FROM surat_rasmi a LEFT JOIN negeri b ON a.id_negeri = b.id_negeri WHERE a.id_masjid='$id_masjid' AND a.id_surat = $id_surat";
$m1 = mysqli_query($bd2, $q1) or die(mysqli_error($bd2));
$r1 = mysqli_fetch_assoc($m1);

$isi_surat = preg_replace('/\s/', ' ', $r1['isi_surat']);
$myJSON = json_decode($isi_surat, true);


if ($r1['jenis_surat'] == "1") {
    $nama_surat = "Aduan";
    $jenis_surat = "1";
} else if ($r1['jenis_surat'] == "2") {
    $nama_surat = "Jemputan";
    $jenis_surat = "2";
} else if ($r1['jenis_surat'] == "3") {
    $nama_surat = "Pemberitahuan";
    $jenis_surat = "3";
} else if ($r1['jenis_surat'] == "4") {
    $nama_surat = "Pengesahan";
    $jenis_surat = "4";
} else if ($r1['jenis_surat'] == "5") {
    $nama_surat = "Permohonan";
    $jenis_surat = "5";
} else if ($r1['jenis_surat'] == "6") {
    $nama_surat = "Sokongan";
    $jenis_surat = "6";
}
?>
<!-- <button id="link_back" onclick="top.location.href = 'utama.php?view=admin&action=rekod_surat_rasmi'">Kembali ke Rekod</button> --><button id="printPageButton" onclick="window.print()">Cetak Halaman Ini</button>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $nama_masjid; ?> / Surat <?php echo $nama_surat; ?> - <?php echo $r1['tajuk_surat']; ?></title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
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
            width: 100%;
        }
        #table_tarikh {
            width: 100%;
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
            #printPageButton, #link_back {
                display: none;
            }
            footer {page-break-after: always;}
            .kelastd, .kelasth {
                border: none;
                width: max-content;
            }

            .kelastr tr:nth-child(even) {
                background-color: transparent;
                width: max-content;
            }
        }
    </style>
</head>
<body>

<div align="center" class="container">
    <form class="form" style="max-width: none; width: 100%;">
        <?php if($r1['jenis_surat'] != 8) { ?>
            <table id="kepala" border="0" cellspacing="0" cellpadding="5" align="left">
                <tr>
                    <th align="left" colspan="2"><?php if($row_user['logo_masjid'] != NULL || $row_user['logo_masjid'] != '') { ?><img style="float: left" width="200" height="70" src="data:image/png;base64,<?php echo(base64_encode($row_user['logo_masjid'])); ?>" /><?php } ?>
                        <?php echo $row_user['nama_masjid']; ?><br />
                        <?php echo($row_user['alamat_masjid']); ?><br />
                        <?php echo($row_user['daerah']); ?>, <?php echo($row_user['negeri']); ?>
                    </th>
                </tr>
                <tr><td colspan="2"><hr/></td></tr>
                <tr>
                    <td align="left"><?php echo strtoupper($r1['penerima'].'<br />'); ?>
                        <?php if($r1['alamat_1'] != NULL) echo strtoupper($r1['alamat_1'].'<br />'); ?>
                        <?php if($r1['alamat_2'] != NULL) echo strtoupper($r1['alamat_2'].'<br />'); ?>
                        <?php if($r1['alamat_3'] != NULL) echo strtoupper($r1['alamat_3'].'<br />'); ?>
                        <?php if($r1['poskod'] != NULL) echo($r1['poskod'].' '); ?>
                        <?php if($r1['bandar'] != NULL) echo strtoupper($r1['bandar'].'<br />'); ?>
                        <?php if($r1['name'] != NULL) echo strtoupper($r1['name']); ?>
                    </td>
                    <td valign="bottom" align="right" width="200">
                        <?php echo(fungsi_tarikh($r1['tarikh'], 2, 1)); ?>
                    </td>
                </tr>
            </table>
        <?php } ?>
        <p>&nbsp;</p>
        <table align="left" width="100%" border="0" cellspacing="0" cellpadding="5" id="table_tarikh">
            <?php if($r1['jenis_surat'] == 1) { ?>
                <tr>
                    <td><strong><u>Perkara: SURAT ADUAN</u></strong></td>
                </tr>
                <tr>
                    <td><strong><u><?php echo($r1['tajuk_surat']); ?></u></strong></td>
                </tr>
                <tr><td></td></tr>
                <tr><td>Berhubung dengan perkara di atas saya selaku Pengerusi <?php echo ucwords(strtolower($data_masjid['nama_masjid'])); ?> Ingin membuat aduan kepada pihak tuan bagi  menyiasat, memantau dan mengambil tidakan yang sewajarnya.</td></tr>
                <tr><td></td></tr>
                <tr><td>2.0 Aduan ini adalah sehubungan dengan perkara seperti berikut :<br />
                        &emsp;&nbsp;&nbsp;<?php echo($myJSON[0]['isi_surat']); ?></td></tr>
                <tr><td></td></tr>
                <tr><td>3.0 Pihak kami telah mengambil tindakan seperti berikut sebagai pendekatan pertama :<br />
                        &emsp;&nbsp;&nbsp;<?php echo($myJSON[1]['isi_surat']); ?></td></tr>
                <tr><td></td></tr>
                <tr><td>4.0 Melihat kepada situasi sekarang ini pihak kami ingin mencadangkan agar : <br />
                        &emsp;&nbsp;&nbsp;<?php echo($myJSON[2]['isi_surat']); ?></td></tr>
                <tr><td></td></tr>
                <tr><td>5.0 Pihak kami sangat berhadap agar permasaalahan ini dapat di selesaikan dengan seberapa segera.  Keperihatinan dan segala kerjasama yang di berikan amat kami hargai.</td></tr>
            <?php } ?>
            <?php if($r1['jenis_surat'] == 3) { ?>
                <tr>
                    <td><strong><u>Perkara: SURAT MEMO PEMBERITAHUAN</u></strong></td>
                </tr>
                <tr>
                    <td><strong><u><?php echo($r1['tajuk_surat']); ?></u></strong></td>
                </tr>
                <tr><td></td></tr>
                <tr><td>Berhubung dengan perkara di atas, adalah dimaklumkan kepada seluruh Ahli Kariah <?php echo ucwords(strtolower($data_masjid['nama_masjid'])); ?> bahawa, </td></tr>
                <tr><td></td></tr>
                <tr><td><?php echo($myJSON[0]['isi_surat']); ?></td></tr>
                <tr><td></td></tr>
                <tr><td><?php echo($myJSON[1]['isi_surat']); ?></td></tr>
                <tr><td></td></tr>
                <tr><td>2.0 Segala kerjasama amatlah kami hargai dan kami dahului dengan ribuan terima kasih. Sekiranya terdapat sebarang pertanyaan bolehlah menghubungi :</td></tr>
                <tr><td></td></tr>
                <tr><td><?php echo($myJSON[2]['isi_surat']); ?> - <?php echo($myJSON[3]['isi_surat']); ?></td></tr>
            <?php } ?>
            <?php if($r1['jenis_surat'] == 4) { ?>
                <tr>
                    <td><strong><u>Perkara: SURAT PENGESAHAN</u></strong></td>
                </tr>
                <tr>
                    <td><strong><u><?php echo($r1['tajuk_surat']); ?></u></strong></td>
                </tr>
                <tr><td></td></tr>
                <tr><td>Merujuk perkara di atas, saya yang bernama <?php echo ucwords(strtolower($data_user['user_name'])); ?>,
                        selaku Pengerusi <?php echo ucwords(strtolower($data_masjid['nama_masjid'])); ?>
                        dengan ini megesahkan bahawa :</td></tr>
                <tr><td></td></tr>
                <tr><td><?php echo($myJSON[0]['isi_surat']); ?></td></tr>
                <tr><td></td></tr>
                <tr><td>2.0 Pengesahan ini di buat adalah bagi tujuan :<br />
                        &emsp;&nbsp;&nbsp;<?php echo($myJSON[1]['isi_surat']); ?></td></tr>
                <tr><td></td></tr>
                <tr><td>3.0 Dengan pengesahan ini pihak saya selaku pengerusi <?php echo ucwords(strtolower($data_masjid['nama_masjid'])); ?> beserta seluruh ahli kariah tidak menangung sebarang libiliti daripada pengesahan ini.</td></tr>
                <tr><td></td></tr>
                <tr><td>4.0 Segala kejersama amatlah kami hargai dan kami dahului dengan ribuat terima kasih.</td></tr>
            <?php } ?>
            <?php if($r1['jenis_surat'] == 5) { ?>
                <tr>
                    <td><strong><u>Perkara: SURAT PERMOHONAN</u></strong></td>
                </tr>
                <tr>
                    <td><strong><u><?php echo($r1['tajuk_surat']); ?></u></strong></td>
                </tr>
                <tr><td></td></tr>
                <tr><td>Berhubung dengan perkara di atas, kami Ahli Jawatankuasa bersama Ahli Kariah <?php echo ucwords(strtolower($data_masjid['nama_masjid'])); ?> ingin membuat permohonan :</td></tr>
                <tr><td></td></tr>
                <tr><td><strong>"<?php echo($myJSON[0]['isi_surat']); ?>"</strong></td></tr>
                <tr><td></td></tr>
                <tr><td>Tujuan: <?php echo($myJSON[1]['isi_surat']); ?></td></tr>
                <tr><td></td></tr>
                <tr><td>2.0 Berikut adalah perincian mengenai permohonan kami :</td></tr>
                <tr><td>&emsp;&nbsp;&nbsp;<?php echo($myJSON[2]['isi_surat']); ?></td></tr>
                <tr><td></td></tr>
                <tr><td>3.0 Sebagai pengerusi, saya bagi pihak masjid ingin mengucapkan ribuan terima kasih di atas segala pertimbangan dan sebarang kerjasama yang di berikan.</td></tr>
            <?php } ?>
            <?php if($r1['jenis_surat'] == 6) { ?>
                <tr>
                    <td><strong><u>Perkara: SURAT SOKONGAN</u></strong></td>
                </tr>
                <tr>
                    <td><strong><u><?php echo($r1['tajuk_surat']); ?></u></strong></td>
                </tr>
                <tr><td></td></tr>
                <tr><td>Berhubung dengan perkara di atas, saya selaku <?php echo "Pengerusi"; //ucwords(strtolower($user_type)); ?> <?php echo ucwords(strtolower($data_masjid['nama_masjid'])); ?>, dengan ini suka cita memaklumkan bahawa saya menyokong cadangan / individu</td></tr>
                <tr><td></td></tr>
                <tr><td><strong>"<?php echo($myJSON[0]['isi_surat']); ?>"</strong></td></tr>
                <tr><td></td></tr>
                <tr><td><?php echo($myJSON[1]['isi_surat']); ?></td></tr>
                <tr><td></td></tr>
                <tr><td>2.0 Sebagai pengerusi masjid, saya berpendapat bahawa ,</td></tr>
                <tr><td>&emsp;&nbsp;&nbsp;<?php echo($myJSON[2]['isi_surat']); ?></td></tr>
                <tr><td></td></tr>
                <tr><td>3.0 Justeru saya berharap pihak yang berkenaan dapat mempertimbangkan cadangan atau permohonan yang telah dibuat.</td></tr>
                <tr><td></td></tr>
                <tr><td>4.0 Sekian untuk makluman dan terima kasih di atas segala kerjasama yang di berikan.</td></tr>
            <?php } ?>
            <?php if($r1['jenis_surat'] == 2) { ?>
                <?php if($r1['jenis_surat'] == 2) { ?>
                    <tr>
                        <td><strong><u>Perkara:  SURAT JEMPUTAN</u></strong></td>
                    </tr>
                <?php } ?>
                <?php if($r1['jenis_surat'] == 2) { ?>
                    <tr>
                        <td><strong><u><?php echo($r1['tajuk_surat']); ?></u></strong></td>
                    </tr>
                    <tr><td></td></tr>
                <?php } ?>
                <?php if($r1['jenis_surat'] == 2) { ?>
                    <tr><td>Berhubung dengan perkara di atas, kami Ahli Jawatankuasa dan Ahli Kariah <?php echo ucwords(strtolower($data_masjid['nama_masjid'])); ?> dengan besar hati ingin menjemput <strong class="jemput"><?php echo($r1['penerima']); ?></strong> bagi menghadiri majlis yang bakal di adakan di masjid kami seperti berikut :</td></tr>
                <?php } ?>
                <?php if($r1['jenis_surat'] == 2) { ?><tr><td>&emsp;&nbsp;&nbsp;Majlis: <?php echo($r1['tajuk_surat']); ?></td></tr><?php } ?>
                <tr><td>&emsp;&nbsp;&nbsp;Tarikh: <?php fungsi_tarikh($r1['tarikh_majlis'], 7, 1); ?> / <?php fungsi_tarikh($r1['tarikh_majlis'], 2, 5); ?></td></tr>
                <tr><td>&emsp;&nbsp;&nbsp;Hari: <?php fungsi_tarikh($r1['tarikh_majlis'], 6, 1); ?></td></tr>
                <tr><td>&emsp;&nbsp;&nbsp;Masa: <?php fungsi_tarikh($r1['masa'], 5, 1); ?></td></tr>
                <tr><td>&emsp;&nbsp;&nbsp;Tempat: <?php echo($myJSON[0]['isi_surat']); ?></td></tr>
                <?php if($r1['jenis_surat'] == 2) { ?><tr><td>&emsp;&nbsp;&nbsp;Lain-lain: <?php echo($myJSON[1]['isi_surat']); ?></td></tr><?php } ?>
                <tr><td></td></tr>
                <?php if($r1['jenis_surat'] == 2) { ?><tr><td>2.0 Berikut adalah aturcara majlis yang bakal di adakan :</td></tr><?php } ?>
                <tr><td></td></tr>
                <?php if($r1['jenis_surat'] == 2) { ?>
                    <tr><td>
                            <table border="0" cellspacing="0" cellpadding="5"><tr><th align="left">Masa</th><th align="left">Perkara</th></tr>
                                <?php for($i = 2; $i < count($myJSON); $i++) { ?>
                                    <tr><td><?php fungsi_tarikh($myJSON[$i]['id_isi'], 5, 1); ?></td><td><?php echo($myJSON[$i]['isi_surat']); ?></td></tr>
                                <?php } ?>
                            </table></td></tr>
                    <tr><td></td></tr>
                    <tr><td>3.0 Kami amat bebesar hati sekiranya <strong id="jemput"><?php echo($r1['penerima']); ?></strong> dapat bersama kami dan pasti menyerikan dan menyempurnakan lagi majlis kami.</td></tr>
                    <tr><td></td></tr>
                    <tr><td>4.0 Segala kerjasama amatlah kami hargai dan kami dahului dengan ribuan terima kasih.</td></tr>
                <?php } ?>
            <?php } ?>
        </table>
        <p>&nbsp;</p>
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr><td><strong><?php echo($r_info['Motto']); ?></strong></td></tr>
            <tr>
                <td align="left" valign="top">
                    <p>Yang Benar,</p>
                    <p>&nbsp</p>
                    <p>..............................................................</p>
                    <strong>
                        <?php
                        $sql_pengerusi = "SELECT * FROM data_ajkmasjid WHERE id_masjid='$id_masjid' AND jawatan='Pengerusi'";
                        $query_pengerusi = mysqli_query($bd2,$sql_pengerusi);
                        $data_pengerusi = mysqli_fetch_array($query_pengerusi);
                        if($data_pengerusi['id_ajk']!==""){
                            $id_data = $data_pengerusi['id_ajk'];
                            $sql = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_data'";
                            $sqlquery = mysqli_query($bd2,$sql);
                        }
                        else if($data_pengerusi['id_ajk2']!==""){
                            $ID = $data_pengerusi['id_ajk2'];
                            $sql = "SELECT * FROM sej6x_data_anakqariah WHERE ID='$ID'";
                            $sqlquery = mysqli_query($bd2,$sql);
                        }
                        $data=mysqli_fetch_array($sqlquery);
                        echo strtoupper($data['nama_penuh']);
                        ?>
                    </strong><br />
                    <strong>PENGERUSI</strong><br />
                    <strong>(<?php echo strtoupper($row_user['nama_masjid']); ?>)</strong><br />
                </td>
            </tr>
        </table>
        </form></div>
</body>
</html>
