<?php
include("../connection/connection.php");
include("../../fungsi_tarikh.php");
$id_mesyuarat = $_GET['id_mesyuarat'];
	
$query_list_mesyuarat = "SELECT *, (SELECT CONCAT(b.nama_penuh, '<br />', b.jawatan_lantikan) FROM minit_mesyuarat a, sej6x_data_ajkmasjid b WHERE a.id_disediakan = b.id_ajk AND a.id_mesyuarat = $id_mesyuarat) 'Disediakan', (SELECT CONCAT(b.nama_penuh, '<br />', b.jawatan_lantikan) FROM minit_mesyuarat a, sej6x_data_ajkmasjid b WHERE a.id_disemak = b.id_ajk AND a.id_mesyuarat = $id_mesyuarat) 'Disemak', (SELECT CONCAT(b.nama_penuh, '<br />', b.jawatan_lantikan) FROM minit_mesyuarat a, sej6x_data_ajkmasjid b WHERE a.id_disahkan = b.id_ajk AND a.id_mesyuarat = $id_mesyuarat) 'Disahkan' FROM minit_mesyuarat WHERE id_masjid = 3857 AND id_mesyuarat = $id_mesyuarat ORDER BY minit_mesyuarat.tarikh DESC, masa DESC";
$list_mesyuarat = mysqli_query($bd2, $query_list_mesyuarat) or die(mysqli_error($bd2));

$query_list_hadir = "SELECT * FROM kehadiran_mesyuarat a, sej6x_data_ajkmasjid b WHERE a.id_masjid = 3857 AND a.id_mesyuarat = $id_mesyuarat AND a.jenis_kehadiran = 1 AND b.id_ajk = a.id_ajk ORDER BY a.nama ASC";
$list_hadir = mysqli_query($bd2, $query_list_hadir) or die(mysqli_error($bd2));

$query_list_hadir2 = "SELECT * FROM kehadiran_mesyuarat WHERE id_masjid = 3857 AND id_mesyuarat = $id_mesyuarat AND jenis_kehadiran = 2 ORDER BY nama ASC";
$list_hadir2 = mysqli_query($bd2, $query_list_hadir2) or die(mysqli_error($bd2));

$query_list_hadir3 = "SELECT * FROM kehadiran_mesyuarat WHERE id_masjid = 3857 AND id_mesyuarat = $id_mesyuarat AND jenis_kehadiran = 3 ORDER BY nama ASC";
$list_hadir3 = mysqli_query($bd2, $query_list_hadir3) or die(mysqli_error($bd2));

$query_list_perkara = "SELECT * FROM perkara_mesyuarat WHERE id_masjid = 3857 AND id_mesyuarat = $id_mesyuarat ORDER BY id_perkara ASC";
$list_perkara = mysqli_query($bd2, $query_list_perkara) or die(mysqli_error($bd2));
	?>
<!DOCTYPE html>
<html>
<head>
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
    </style>
   </head>
   <body>
   <div align="center" class="container">
   <form class="form" style="max-width: none; width: 100%;">
    <?php while($row_list_mesyuarat = mysqli_fetch_assoc($list_mesyuarat)) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td align="left" width="120"><?php echo($row_list_mesyuarat['no_rujukan']); ?></td>
    <th align="center">MINIT<br /><?php echo($row_list_mesyuarat['tajuk']); ?></th>
    <td align="right" width="180"><?php fungsi_tarikh($row_list_mesyuarat['tarikh'], 2, 1); ?></td>
  </tr>
  </table>
 <p></p><table align="center" width="500" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="100">Tarikh:</td>
        <td><?php fungsi_tarikh($row_list_mesyuarat['tarikh'], 2, 1); ?></td>
      </tr>
      <tr>
        <td>Masa:</td>
        <td><?php fungsi_tarikh($row_list_mesyuarat['masa'], 5, 1); ?></td>
      </tr>
      <tr>
        <td>Masa Tamat:</td>
        <td><?php fungsi_tarikh($row_list_mesyuarat['masa_tamat'], 5, 1); ?></td>
      </tr>
      <tr>
        <td>Tempat:</td>
        <td><?php echo($row_list_mesyuarat['tempat']); ?></td>
      </tr>
    </table>
    <p></p>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="kelastr">
      <tr class="kelastr">
        <th colspan="3" align="left" bgcolor="#999999">Kehadiran AJK</th>
        </tr>
      <tr class="kelastr">
        <th width="50" class="kelasth">Bil</th>
        <th class="kelasth">Nama</th>
        <th width="350" class="kelasth">Jawatan</th>
      </tr>
      <tbody>
       <?php $i = 1; while($row_list_hadir = mysqli_fetch_assoc($list_hadir)) { ?>
      <tr>
        <td class="kelastd" align="center"><?php echo($i); ?></td>
        <td class="kelastd"><?php echo($row_list_hadir['nama']); ?></td>
        <td class="kelastd"><?php echo($row_list_hadir['jawatan']); ?></td>
      </tr>
      <?php $i++; } ?>
      </tbody>
    </table>
    <?php if($totalRows_list_hadir2 = mysqli_num_rows($list_hadir2)) { ?>
     <p></p>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" class="kelastr">
      <tr class="kelastr">
        <th colspan="3" align="left" bgcolor="#999999">Turut Hadir</th>
        </tr>
      <tr class="kelastr">
        <th class="kelasth" width="50">Bil</th>
        <th class="kelasth">Nama</th>
        <th class="kelasth kelasthlebar">Jawatan</th>
      </tr>
      <tbody>
      <?php $i = 1; while($row_list_hadir2 = mysqli_fetch_assoc($list_hadir2)) { ?>
      <tr>
        <td class="kelastd" align="center"><?php echo($i); ?></td>
        <td class="kelastd"><?php echo($row_list_hadir2['nama']); ?></td>
        <td class="kelastd"><?php echo($row_list_hadir2['jawatan']); ?></td>
      </tr>
      <?php $i++; } ?>
      </tbody>
    </table>
    <?php } ?>
    <?php if($totalRows_list_hadir3 = mysqli_num_rows($list_hadir3)) { ?>
     <p></p>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" class="kelastr">
      <tr>
        <th colspan="3" align="left" bgcolor="#999999">Urusetia</th>
        </tr>
      <tr>
        <th class="kelasth" width="50">Bil</th>
        <th class="kelasth">Nama</th>
        <th class="kelasth" width="350">Jawatan</th>
      </tr>
      <tbody>
      <?php $i = 1; while($row_list_hadir3 = mysqli_fetch_assoc($list_hadir3)) { ?>
      <tr>
        <td class="kelastd" align="center"><?php echo($i); ?></td>
        <td class="kelastd"><?php echo($row_list_hadir3['nama']); ?></td>
        <td class="kelastd"><?php echo($row_list_hadir3['jawatan']); ?></td>
      </tr>
      <?php $i++; } ?>
      </tbody>
    </table>
    <?php } ?>
     <p></p>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" class="kelastr">
      <tr>
        <th colspan="4" align="left" bgcolor="#999999">Agenda Mesyuarat</th>
        </tr>
      <tr>
        <th class="kelasth" width="50">Bil</th>
        <th class="kelasth">Perkara / Isu</th>
        <th class="kelasth" width="20%">Tanggungjawab</th>
        <th class="kelasth" width="20%">Status / Tindakan</th>
      </tr>
      <?php $i = 1; while($row_list_perkara = mysqli_fetch_assoc($list_perkara)) { ?>
      <tr valign="top">
        <td class="kelastd" align="center"><?php echo($i); ?></td>
        <td class="kelastd"><?php echo($row_list_perkara['perkara_isu']); ?></td>
        <td class="kelastd"><?php echo($row_list_perkara['tanggungjawab']); ?></td>
        <td class="kelastd"><?php echo($row_list_perkara['status_tindakan']); ?></td>
      </tr>
      <?php $i++; } ?>
    </table>
    <hr />
<table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="50%" align="center" valign="top"><p>Disediakan oleh:</p>
          <p>&nbsp;</p><br />
          <p>..............................................................</p>
          <strong><?php echo($row_list_mesyuarat['Disediakan']); ?></strong>
          </td>
        <td width="50%" align="center" valign="top"><p>Disemak oleh:</p>
          <p>&nbsp;</p><br />
          <p>..............................................................</p>
          <strong><?php echo($row_list_mesyuarat['Disemak']); ?></strong>
          </td>
      </tr>
    </table>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td colspan="3" align="center" valign="top">
    <p>Disahkan oleh:</p>
          <p>&nbsp;</p><br />
          <p>..............................................................</p>
          <strong><?php echo($row_list_mesyuarat['Disahkan']); ?></strong>
    </td>
  </tr>
</table>
<?php } ?>  
    </form></div>
    </body>
    </html>