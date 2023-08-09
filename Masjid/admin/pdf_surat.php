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

use Dompdf\Dompdf;
require '../dompdf/vendor/autoload.php';

$tajuk = $nama_masjid.' / Surat '.$nama_surat.' - '.$r1['tajuk_surat'];
$html = '<html>
<head>
    <title>'.$nama_masjid.' / Surat '.$nama_surat.' - '.$r1['tajuk_surat'].'</title>
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
    <form class="form" style="max-width: none; width: 100%;">';
if($r1['jenis_surat'] != 8) {
    $html .= '<table id="kepala" border="0" cellspacing="0" cellpadding="5" align="left">
                <tr>
                    <th align="left" colspan="2">';
    if($row_user['logo_masjid'] != NULL || $row_user['logo_masjid'] != '') {
        $html .= '<img style="float: left" width="200" height="100" src="data:image/png;base64,'.base64_encode($row_user["logo_masjid"]).'" />'; }
    $html .= $row_user['nama_masjid'].'<br />'.$row_user['alamat_masjid'].'<br />'.$row_user['daerah'].','.$row_user['negeri'].'
                    </th>
                </tr>
                <tr><td colspan="2"><hr/></td></tr>
                <tr>
                    <td align="left">'.strtoupper($r1['penerima']).'<br />';
    if($r1['alamat_1'] != NULL) { $html .= strtoupper($r1['alamat_1']).'<br />'; }
    if($r1['alamat_2'] != NULL) { $html .= strtoupper($r1['alamat_2']).'<br />'; }
    if($r1['alamat_3'] != NULL) { $html .= strtoupper($r1['alamat_3']).'<br />'; }
    if($r1['poskod'] != NULL) { $html .= $r1['poskod'].'<br>'; }
    if($r1['bandar'] != NULL) { $html .= strtoupper($r1['bandar']).'<br />'; }
    if($r1['name'] != NULL) { $html .= strtoupper($r1['name']); }
    $html .= '</td>
                    <td valign="bottom" align="right" width="150"><small>'.fungsi_tarikh($r1["tarikh"], 2, 99).'</small></td>
                </tr>
            ';
}
$html .= '<p>&nbsp;</p>
        ';
if($r1['jenis_surat'] == 1) {
    $html .= '<tr>
                    <td colspan="2"><strong><u>Perkara: SURAT ADUAN</u></strong></td>
                </tr>
                <tr>
                    <td colspan="2"><strong><u>'.$r1['tajuk_surat'].'</u></strong></td>
                </tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">Berhubung dengan perkara di atas saya selaku Pengerusi '.ucwords(strtolower($data_masjid['nama_masjid'])).' Ingin membuat aduan kepada pihak tuan bagi  menyiasat, memantau dan mengambil tidakan yang sewajarnya.</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">2.0 Aduan ini adalah sehubungan dengan perkara seperti berikut :<br />'.($myJSON[0]['isi_surat']).'</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">3.0 Pihak kami telah mengambil tindakan seperti berikut sebagai pendekatan pertama :<br />'.($myJSON[1]['isi_surat']).'</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">4.0 Melihat kepada situasi sekarang ini pihak kami ingin mencadangkan agar : <br />'.($myJSON[2]['isi_surat']).'</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">5.0 Pihak kami sangat berhadap agar permasaalahan ini dapat di selesaikan dengan seberapa segera.  Keperihatinan dan segala kerjasama yang di berikan amat kami hargai.</td></tr>';
}
if($r1['jenis_surat'] == 3) {
    $html .= '<tr>
                    <td colspan="2"><strong><u>Perkara: SURAT MEMO PEMBERITAHUAN</u></strong></td>
                </tr>
                <tr>
                    <td colspan="2"><strong><u>'.$r1['tajuk_surat'].'</u></strong></td>
                </tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">Berhubung dengan perkara di atas, adalah dimaklumkan kepada seluruh Ahli Kariah '.ucwords(strtolower($data_masjid['nama_masjid'])).' bahawa, </td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">'.($myJSON[0]['isi_surat']).'</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">'.($myJSON[1]['isi_surat']).'</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">2.0 Segala kerjasama amatlah kami hargai dan kami dahului dengan ribuan terima kasih. Sekiranya terdapat sebarang pertanyaan bolehlah menghubungi :</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">'.($myJSON[2]['isi_surat']).' - '.($myJSON[3]['isi_surat']).'</td></tr>';
}
if($r1['jenis_surat'] == 4) {
    $html .= '<tr>
                    <td colspan="2"><strong><u>Perkara: SURAT PENGESAHAN</u></strong></td>
                </tr>
                <tr>
                    <td colspan="2"><strong><u>'.$r1['tajuk_surat'].'</u></strong></td>
                </tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">Merujuk perkara di atas, saya yang bernama '.ucwords(strtolower($data_user['user_name'])).',
                        selaku Pengerusi '.ucwords(strtolower($data_masjid['nama_masjid'])).'
                        dengan ini megesahkan bahawa :</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">'.($myJSON[0]['isi_surat']).'</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">2.0 Pengesahan ini di buat adalah bagi tujuan :<br />'.($myJSON[1]['isi_surat']).'></td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">3.0 Dengan pengesahan ini pihak saya selaku pengerusi '.ucwords(strtolower($data_masjid['nama_masjid'])).' beserta seluruh ahli kariah tidak menangung sebarang libiliti daripada pengesahan ini.</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">4.0 Segala kejersama amatlah kami hargai dan kami dahului dengan ribuat terima kasih.</td></tr>';
}
if($r1['jenis_surat'] == 5) {
    $html ='<tr>
                    <td colspan="2"><strong><u>Perkara: SURAT PERMOHONAN</u></strong></td>
                </tr>
                <tr>
                    <td colspan="2"><strong><u>'.$r1['tajuk_surat'].'</u></strong></td>
                </tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">Berhubung dengan perkara di atas, kami Ahli Jawatankuasa bersama Ahli Kariah '.ucwords(strtolower($data_masjid['nama_masjid'])).' ingin membuat permohonan :</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2"><strong>'.($myJSON[0]['isi_surat']).'</strong></td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">Tujuan: '.($myJSON[1]['isi_surat']).'</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">2.0 Berikut adalah perincian mengenai permohonan kami :</td></tr>
                <tr><td colspan="2">'.($myJSON[2]['isi_surat']).'</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">3.0 Sebagai pengerusi, saya bagi pihak masjid ingin mengucapkan ribuan terima kasih di atas segala pertimbangan dan sebarang kerjasama yang di berikan.</td></tr>';
}
if($r1['jenis_surat'] == 6) {
    $html .= '<tr>
                    <td colspan="2"><strong><u>Perkara: SURAT SOKONGAN</u></strong></td>
                </tr>
                <tr>
                    <td colspan="2"><strong><u>'.$r1['tajuk_surat'].'</u></strong></td>
                </tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">Berhubung dengan perkara di atas, saya selaku pengerusi '.ucwords(strtolower($data_masjid['nama_masjid'])).', dengan ini suka cita memaklumkan bahawa saya menyokong cadangan / individu</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2"><strong>'.($myJSON[0]['isi_surat']).'</strong></td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">'.($myJSON[1]['isi_surat']).'</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">2.0 Sebagai pengerusi masjid, saya berpendapat bahawa ,</td></tr>
                <tr><td colspan="2">'.($myJSON[2]['isi_surat']).'</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">3.0 Justeru saya berharap pihak yang berkenaan dapat mempertimbangkan cadangan atau permohonan yang telah dibuat.</td></tr>
                <tr><td colspan="2"></td></tr>
                <tr><td colspan="2">4.0 Sekian untuk makluman dan terima kasih di atas segala kerjasama yang di berikan.</td></tr>';
}
if($r1['jenis_surat'] == 2) {
    $html .= '<tr>
                    <td colspan="2"><strong><u>Perkara:  SURAT JEMPUTAN</u></strong></td>
                </tr>';
}
if($r1['jenis_surat'] == 2) {
    $html .= '<tr>
                        <td colspan="2"><strong><u>'.$r1['tajuk_surat'].'</u></strong></td>
                    </tr>
                    <tr><td colspan="2"></td></tr>';
}
if($r1['jenis_surat'] == 2) {
    $html .= '<tr><td colspan="2">Berhubung dengan perkara di atas, kami Ahli Jawatankuasa dan Ahli Kariah '.ucwords(strtolower($data_masjid['nama_masjid'])).' dengan besar hati ingin menjemput <strong class="jemput">'.$r1['penerima'].'</strong> bagi menghadiri majlis yang bakal di adakan di masjid kami seperti berikut :</td></tr>';
}
if($r1['jenis_surat'] == 2) {
    $html .= '<tr><td colspan="2">Majlis: '.$r1['tajuk_surat'].'</td></tr>';
}
$html .= '<tr><td colspan="2">Tarikh: '.fungsi_tarikh($r1["tarikh_majlis"], 7, 99).' / '.fungsi_tarikh($r1['tarikh_majlis'], 2, 100).'</td></tr>
                <tr><td colspan="2">Hari: '.fungsi_tarikh($r1["tarikh_majlis"], 6, 99).'</td></tr>
                <tr><td colspan="2">Masa: '.fungsi_tarikh($r1['masa'], 5, 99).' </td></tr>
                <tr><td colspan="2">Tempat: '.($myJSON[0]['isi_surat']).'</td></tr>';
if($r1['jenis_surat'] == 2) {
    $html .= '<tr><td colspan="2">Lain-lain: '.($myJSON[1]['isi_surat']).'</td></tr>';
}
$html .= '<tr><td colspan="2"></td></tr>';
if($r1['jenis_surat'] == 2) {
    $html .= '<tr><td colspan="2">2.0 Berikut adalah aturcara majlis yang bakal di adakan :</td></tr>';
}
$html .= '<tr><td colspan="2"></td></tr>';
if($r1['jenis_surat'] == 2) {
    $html .= '<tr><td colspan="2">
                            <table border="0" cellspacing="0" cellpadding="5"><tr><th align="left">Masa</th><th align="left">Perkara</th></tr>';
    for($i = 2; $i < count($myJSON); $i++) {
        $html .= '<tr><td>'.fungsi_tarikh($myJSON[$i]["id_isi"], 5, 99).'</td><td>'.($myJSON[$i]['isi_surat']).'</td></tr>';
    }
    $html .= '</table></td></tr>
                    <tr><td colspan="2"></td></tr>
                    <tr><td colspan="2">3.0 Kami amat bebesar hati sekiranya <strong id="jemput">'.$r1['penerima'].'</strong> dapat bersama kami dan pasti menyerikan dan menyempurnakan lagi majlis kami.</td></tr>
                    <tr><td colspan="2"></td></tr>
                    <tr><td colspan="2">4.0 Segala kerjasama amatlah kami hargai dan kami dahului dengan ribuan terima kasih.</td></tr>';
}
$html .= '
        <p>&nbsp;</p>
            <tr><td colspan="2"><strong>'.$r_info['Motto'].'</strong></td></tr>
            <tr>
                <td align="left" valign="top" colspan="2">
                    <p>Yang Benar,</p>
                    <br>
                    <p>..............................................................</p>
                    <strong>';

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
$html .= strtoupper($data['nama_penuh']).'
                        
                    </strong><br />
                    <strong>PENGERUSI</strong><br />
                    <strong>'.strtoupper($row_user['nama_masjid']).'</strong><br />
                </td>
            </tr>
        </table>
    </form></div>
</body>
</html>';
$codeHTML = utf8_encode($html);
$dompdf = new Dompdf();
$dompdf->loadHtml($codeHTML);
$dompdf->setPaper('A4','potrait');

ini_set('memory_limit','512M');
$dompdf->render();
$dompdf->stream($tajuk.".pdf", array("Attachment" => false));
?>