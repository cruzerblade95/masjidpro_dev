<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if($_GET['html'] != 1) header("Content-type: application/pdf");

include("../connection/connection.php");
include("../fungsi_tarikh.php");
$id_mesyuarat = $_GET['id_mesyuarat'];
if($_GET['id_masjidTest'] != NULL) $id_masjid = $_GET['id_masjidTest'];
	
$query_list_mesyuarat = "SELECT *, year(e.tarikh) 'tahun', f.nama_masjid 'nama_masjid', (SELECT CONCAT(c.nama_penuh, '<br />', b.jawatan) FROM minit_mesyuarat a, data_ajkmasjid b , sej6x_data_peribadi c WHERE a.id_disediakan = b.id_dataajk AND a.id_mesyuarat = $id_mesyuarat AND b.id_ajk = c.id_data) 'Disediakan', (SELECT CONCAT(c.nama_penuh, '<br />', b.jawatan) FROM minit_mesyuarat a, data_ajkmasjid b , sej6x_data_peribadi c WHERE a.id_disemak = b.id_dataajk AND a.id_mesyuarat = $id_mesyuarat AND b.id_ajk = c.id_data) 'Disemak', (SELECT CONCAT(c.nama_penuh, '<br />', b.jawatan) FROM minit_mesyuarat a, data_ajkmasjid b , sej6x_data_peribadi c WHERE a.id_disahkan = b.id_dataajk AND a.id_mesyuarat = $id_mesyuarat AND b.id_ajk = c.id_data) 'Disahkan' FROM minit_mesyuarat e, sej6x_data_masjid f WHERE e.id_masjid = f.id_masjid AND e.id_masjid = $id_masjid AND e.id_mesyuarat = $id_mesyuarat ORDER BY e.tarikh DESC, e.masa DESC";
$list_mesyuarat = mysqli_query($bd2, $query_list_mesyuarat) or die(mysqli_error($bd2));

$query_list_hadir = "SELECT * FROM kehadiran_mesyuarat a, data_ajkmasjid b WHERE a.id_ajk = b.id_dataajk AND a.id_masjid = $id_masjid AND a.id_mesyuarat = $id_mesyuarat AND a.jenis_kehadiran = 1 ORDER BY b.rank ASC";
$list_hadir = mysqli_query($bd2, $query_list_hadir) or die(mysqli_error($bd2));
$jum_hadir = mysqli_num_rows($list_hadir);

$query_list_absent = "SELECT * FROM kehadiran_mesyuarat a, data_ajkmasjid b WHERE a.id_ajk = b.id_dataajk AND a.id_masjid = $id_masjid AND a.id_mesyuarat = $id_mesyuarat AND a.jenis_kehadiran = 99 ORDER BY b.rank ASC";
$list_absent = mysqli_query($bd2, $query_list_absent) or die(mysqli_error($bd2));
$jum_absent = mysqli_num_rows($list_absent);

$query_list_hadir2 = "SELECT * FROM kehadiran_mesyuarat WHERE id_masjid = $id_masjid AND id_mesyuarat = $id_mesyuarat AND jenis_kehadiran = 2 ORDER BY nama ASC";
$list_hadir2 = mysqli_query($bd2, $query_list_hadir2) or die(mysqli_error($bd2));
$jum_hadir2 = mysqli_num_rows($list_hadir2);

$query_list_hadir3 = "SELECT * FROM kehadiran_mesyuarat WHERE id_masjid = $id_masjid AND id_mesyuarat = $id_mesyuarat AND jenis_kehadiran = 3 ORDER BY nama ASC";
$list_hadir3 = mysqli_query($bd2, $query_list_hadir3) or die(mysqli_error($bd2));
$jum_hadir3 = mysqli_num_rows($list_hadir3);

$query_list_perkara = "SELECT * FROM perkara_mesyuarat WHERE id_masjid = $id_masjid AND id_mesyuarat = $id_mesyuarat ORDER BY id_perkara ASC";
$list_perkara = mysqli_query($bd2, $query_list_perkara) or die(mysqli_error($bd2));
$jum_perkara = mysqli_num_rows($list_perkara);

use Dompdf\Dompdf;
require '../dompdf/vendor/autoload.php';
while($row_list_mesyuarat = mysqli_fetch_assoc($list_mesyuarat))
{
$html = '
	<html>
		<head>
		<title>'.$row_list_mesyuarat['nama_masjid'].' - '.$row_list_mesyuarat['tajuk'].' - BIL: '.$row_list_mesyuarat['no_rujukan'].' / '.$row_list_mesyuarat['tahun'].'</title>
		<style>
		footer {page-break-after: always;}
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: small;
        }

        .kelasthlebar {
            width: 350px;
        }

        .kelastd, .kelasth {
            border: 1px solid #dddddd;
            text-align2: left;
            padding: 8px;
			width: max-content;
        }

        .kelastr tr:nth-child(even) {
            background-color: #dddddd;
			width: max-content;
        }
        #kepala {
            width: 100%;
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

            #printPageButton, #link_back {
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
		<center>';
		
		if($_GET['html'] == 1) $html .= '<button id="printPageButton" onclick="window.print()" style="font-size: 24px; font-weight: bold">Cetak Halaman Ini</button>';
		 

		$tajuk=$row_list_mesyuarat['tajuk'];
$html.='<table id="kepala" border="0" cellspacing="0" cellpadding="5" width="100%">
            <tr>
                <th align="center"><h2>'.$row_list_mesyuarat['nama_masjid'].'</h2>
                    MINIT MESYUARAT<br />
                    '.$row_list_mesyuarat['tajuk'].'<br />
	                BIL: '.$row_list_mesyuarat['no_rujukan'].' / '.$row_list_mesyuarat['tahun'].'<br /><br />
                </th>
            </tr>
        </table>
		<p></p><table align="center" width="100%" border="5" cellspacing="0" cellpadding="5" id="table_tarikh">
            <tr>
                <td width="100">Tarikh:</td>
                <td>'.fungsi_tarikh($row_list_mesyuarat['tarikh'], 7, 99).' / '.fungsi_tarikh($row_list_mesyuarat['tarikh'], 2, 100).'</td>
            </tr>
                <tr>
                    <td>Hari:</td>
                    <td>'.fungsi_tarikh($row_list_mesyuarat['tarikh'], 6, 99).'</td>
                </tr>
            <tr>
                <td>Masa:</td>
                <td>'.fungsi_tarikh($row_list_mesyuarat['masa'], 5, 99).' - '.fungsi_tarikh($row_list_mesyuarat['masa_tamat'], 5, 99).'</td>
            </tr>
            <tr>
                <td>Tempat:</td>
                <td>'.$row_list_mesyuarat['tempat'].'</td>
            </tr>
        </table><p></p>
		<table id="hadir1" width="100%" border="0" cellspacing="0" cellpadding="5" class="kelastr">
            <tr class="kelastr">
                <th colspan="3" align="left" bgcolor="#999999">KEHADIRAN</th>
            </tr>
            <tbody>';
			$i = 1;
			while($row_list_hadir = mysqli_fetch_assoc($list_hadir)) {
            $html.='<tr>
                    <td class="kelastd" align="center" width="50">'.$i.'</td>
                    <td class="kelastd">'.$row_list_hadir["nama"].'</td>
                    <td class="kelastd" width="350">'.$row_list_hadir["jawatan"].'</td>
                </tr>';
				$i++;
			}
            $html.='</tbody>
        </table>';
		
		if($jum_hadir2 > 0) {
		$html .= '<p></p>
		<table id="hadir2" width="100%" border="0" cellspacing="0" cellpadding="5" class="kelastr">
            <tr class="kelastr">
                <th colspan="3" align="left" bgcolor="#999999">TURUT HADIR</th>
            </tr>
            <tbody>';
			$i = 1;
			while($row_list_hadir2 = mysqli_fetch_assoc($list_hadir2)) {
            $html.='<tr>
                    <td class="kelastd" align="center" width="50">'.$i.'</td>
                    <td class="kelastd">'.$row_list_hadir2["nama"].'</td>
                    <td class="kelastd" width="350">'.$row_list_hadir2["jawatan"].'</td>
                </tr>';
				$i++;
			}
            $html.='</tbody></table>';
		}
			
		if($jum_hadir3 > 0) {
		$html.='<p></p>
		<table id="hadir2" width="100%" border="0" cellspacing="0" cellpadding="5" class="kelastr">
            <tr class="kelastr">
                <th colspan="3" align="left" bgcolor="#999999">URUSETIA</th>
            </tr>
            <tbody>';
			$i = 1;
			while($row_list_hadir3 = mysqli_fetch_assoc($list_hadir3)) {
            $html.='<tr>
                    <td class="kelastd" align="center" width="50">'.$i.'</td>
                    <td class="kelastd">'.$row_list_hadir3["nama"].'</td>
                    <td class="kelastd" width="350">'.$row_list_hadir3["jawatan"].'</td>
                </tr>';
				$i++;
			}
            $html.='</tbody></table>';
		}
			
		if($jum_absent > 0) {
		$html.='
		<p></p><table id="hadir2" width="100%" border="0" cellspacing="0" cellpadding="5" class="kelastr">
            <tr class="kelastr">
                <th colspan="3" align="left" bgcolor="#999999">TIDAK HADIR</th>
            </tr>
            <tbody>';
			$i = 1;
			while($row_list_absent = mysqli_fetch_assoc($list_absent)) {
            $html.='<tr>
                    <td class="kelastd" align="center" width="50">'.$i.'</td>
                    <td class="kelastd">'.$row_list_absent["nama"].'</td>
                    <td class="kelastd" width="350">'.$row_list_absent["jawatan"].'</td>
                </tr>';
				$i++;
			}
            $html.='</tbody></table>';
		}
			
		
$html.='<footer></footer><table id="hadir2" width="100%" border="0" cellspacing="0" cellpadding="5" class="kelastr">
		<tr class="kelastr">
                <th colspan="3" align="left" bgcolor="#999999">AGENDA MESYUARAT</th>
            </tr>
            <tr class="kelastr">
                <th class="kelastd" width="50">Bil</th>
                <th class="kelastd">Perkara / Isu</th>
                <th class="kelastd" width="20%">Status / Tindakan</th>
            </tr>';
			$i = 1; while($row_list_perkara = mysqli_fetch_assoc($list_perkara)) 
			{
			    $perkara_isu = str_replace('<p>', '', $row_list_perkara['perkara_isu']);
                $perkara_isu = str_replace('</p>', '<br />', $perkara_isu);
                $perkara_isu = str_replace('\r\n', '', $perkara_isu);
$html.='	<tr valign="top" bgcolor="#FFFFFF">
				<td class="kelastd" align="center">'.$i.'</td>
				<td class="kelastd">'.$perkara_isu.'</td>
				<td class="kelastd">'.str_replace('|', ', ', $row_list_perkara['status_tindakan']).'</td>
			</tr>';
			$i++;
			}
$html.='</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
			<tr>
				<td width="50%" align="center" valign="top"><p>Disediakan oleh:</p>
                    <p>&nbsp;</p><br />
                    <p>..............................................................</p>
                    <strong>'.$row_list_mesyuarat['Disediakan'].'</strong></td>
				<td width="50%" align="center" valign="top"><p>Disemak oleh:</p>
                    <p>&nbsp;</p><br />
                    <p>..............................................................</p>
                    <strong>'.$row_list_mesyuarat['Disemak'].'</strong></td>
			</tr>
		</table>
		<br>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
                <td colspan="3" align="center" valign="top">
                    <p>Disahkan oleh:</p>
                    <p>&nbsp;</p><br />
                    <p>..............................................................</p>
                    <strong>'.$row_list_mesyuarat['Disahkan'].'</strong>
                </td>
            </tr>
		</table>';
$html.='</center>
		</body>
	</html>';
		}
if($_GET['html'] != 1) { 
$codeHTML = utf8_encode($html);
$dompdf = new Dompdf();
$dompdf->loadHtml($codeHTML);
$dompdf->setPaper('A4','potrait');
$dompdf->set_option('defaultFont','Courier');

ini_set('memory_limit','128M');
$dompdf->render();
$dompdf->stream($tajuk.".pdf", array("Attachment" => false));
}

if($_GET['html'] == 1) echo($html);
?>