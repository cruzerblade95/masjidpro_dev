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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
@CHARSET "UTF-8";  
        table {  
            font-family: arial, sans-serif;  
            border-collapse: collapse;  
            width: 100%;  
        }
		
		.tebal {
			font-weight:bold;
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
		
.panel-default>.panel-heading {
    background-color: #999999;
    border-color: #f5f5f5;
	font-weight:bold;
}
.page-break {
			page-break-before: always;
		}
		.break {
			page-break-before: always;
		}
		body{
font-size:2em;
}  
    </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   </head>
   <body>
   <?php while($row_list_mesyuarat = mysqli_fetch_assoc($list_mesyuarat)) { ?>
   <div id="html" style='position: absolute; left: 70; right: 70; top: 30; bottom: 30; overflow: auto; width: 600px; font-family:Arial, Helvetica, sans-serif; font-size:10pt'>
   <p></p>
   <div class="row">
		  <div class="col" align="center"><?php echo($row_list_mesyuarat['no_rujukan']); ?></div>
          <div class="col" align="center">MINIT</div>
          <div class="col" align="right"><?php fungsi_tarikh($row_list_mesyuarat['tarikh'], 2, 1); ?></div>
       </div>
       <div class="row">
          <div class="col" align="center"><?php echo($row_list_mesyuarat['tajuk']); ?></div>
       </div>
<p></p>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
       <div class="panel-heading" style="display:none">Tarikh, Masa & Tempat</div>
       <div class="panel-body">
       <div class="row">
       	  <div class="col-lg-2">&nbsp;</div>
		  <div class="col-lg-3">Tarikh:</div>
          <div class="col-lg-6"><?php fungsi_tarikh($row_list_mesyuarat['tarikh'], 2, 1); ?></div>
          <div class="col-lg-1">&nbsp;</div>
       </div>
       <div class="row">
       	  <div class="col-lg-2">&nbsp;</div>
		  <div class="col-lg-3">Masa:</div>
          <div class="col-lg-6"><?php fungsi_tarikh($row_list_mesyuarat['masa'], 5, 1); ?></div>
          <div class="col-lg-1">&nbsp;</div>
       </div>
       <div class="row">
       	  <div class="col-lg-2">&nbsp;</div>
		  <div class="col-lg-3">Masa Tamat:</div>
          <div class="col-lg-6"><?php fungsi_tarikh($row_list_mesyuarat['masa_tamat'], 5, 1); ?></div>
          <div class="col-lg-1">&nbsp;</div>
       </div>
       <div class="row">
       	  <div class="col-lg-2">&nbsp;</div>
		  <div class="col-lg-3">Tempat:</div>
          <div class="col-lg-6"><?php echo($row_list_mesyuarat['tempat']); ?></div>
          <div class="col-lg-1">&nbsp;</div>
       </div>
       </div>
     </div>
   </div>
</div>
<p></p>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
       <div class="panel-heading" align="center">Kehadiran AJK</div>
       <div class="panel-body">
       <div class="row" style="font-weight:bold">
       <div class="col-lg-1" align="center">&nbsp;</div>
       	  <div class="col-lg-1" align="center">Bil</div>
          <div class="col-lg-5">Nama</div>
          <div class="col-lg-5">Jawatan</div>
       </div>
       <?php $i = 1; while($row_list_hadir = mysqli_fetch_assoc($list_hadir)) { ?>
       <div class="row">
       <div class="col-lg-1" align="center">&nbsp;</div>
       	  <div class="col-lg-1" align="center"><?php echo($i); ?></div>
          <div class="col-lg-5"><?php echo($row_list_hadir['nama']); ?></div>
          <div class="col-lg-5"><?php echo($row_list_hadir['jawatan']); ?></div>
       </div>
       <?php $i++; } ?>
       </div>
     </div>
   </div>
</div>
<?php if($totalRows_list_hadir2 = mysqli_num_rows($list_hadir2)) { ?>
     <p></p>
     <div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
       <div class="panel-heading" align="center">Turut Hadir</div>
       <div class="panel-body">
       <div class="row" style="font-weight:bold">
       <div class="col-lg-1" align="center">&nbsp;</div>
       	  <div class="col-lg-1" align="center">Bil</div>
          <div class="col-lg-5">Nama</div>
          <div class="col-lg-5">Jawatan</div>
       </div>
       <?php $i = 1; while($row_list_hadir2 = mysqli_fetch_assoc($list_hadir2)) { ?>
       <div class="row">
       <div class="col-lg-1" align="center">&nbsp;</div>
       	  <div class="col-lg-1" align="center"><?php echo($i); ?></div>
          <div class="col-lg-5"><?php echo($row_list_hadir2['nama']); ?></div>
          <div class="col-lg-5"><?php echo($row_list_hadir2['jawatan']); ?></div>
       </div>
       <?php $i++; } ?>
       </div>
     </div>
   </div>
</div>
    <?php } ?>
    <?php if($totalRows_list_hadir3 = mysqli_num_rows($list_hadir3)) { ?>
     <p></p>
     <div class="page-break">
     <div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
       <div class="panel-heading" align="center">Urusetia</div>
       <div class="panel-body">
       <div class="row" style="font-weight:bold">
       <div class="col-lg-1" align="center">&nbsp;</div>
       	  <div class="col-lg-1" align="center">Bil</div>
          <div class="col-lg-5">Nama</div>
          <div class="col-lg-5">Jawatan</div>
       </div>
       <?php $i = 1; while($row_list_hadir3 = mysqli_fetch_assoc($list_hadir3)) { ?>
       <div class="row">
       <div class="col-lg-1" align="center">&nbsp;</div>
       	  <div class="col-lg-1" align="center"><?php echo($i); ?></div>
          <div class="col-lg-5"><?php echo($row_list_hadir3['nama']); ?></div>
          <div class="col-lg-5"><?php echo($row_list_hadir3['jawatan']); ?></div>
       </div>
       <?php $i++; } ?>
       </div>
     </div>
   </div>
</div>
</div>
    <?php } ?>
    
    <p class="page-break">&nbsp;</p><p class="page-break">&nbsp;</p><p class="page-break">&nbsp;</p>
    <p class="page-break">&nbsp;</p>
     <div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
       <div class="panel-heading" align="center">Agenda Mesyuarat</div>
       <div class="panel-body">
       <div class="row" style="font-weight:bold">
       <div class="col-lg-1">&nbsp;</div>
       	  <div class="col-lg-1" align="center">Bil</div>
          <div class="col-lg-4">Perkara / Isu</div>
          <div class="col-lg-3">Tanggungjawab</div>
          <div class="col-lg-3">Status Tindakan</div>
       </div>
      <?php $i = 1; while($row_list_perkara = mysqli_fetch_assoc($list_perkara)) { ?>
       <div class="row">
       <div class="col-lg-1">&nbsp;</div>
       	  <div class="col-lg-1" align="center"><?php echo($i); ?></div>
          <div class="col-lg-4"><?php echo($row_list_perkara['perkara_isu']); ?></div>
          <div class="col-lg-3"><?php echo($row_list_perkara['tanggungjawab']); ?></div>
          <div class="col-lg-3"><?php echo($row_list_perkara['status_tindakan']); ?></div>
       </div>
       <?php $i++; } ?>
       </div>
     </div>
   </div>
</div>
    <hr />
       <div class="row">
       	  <div class="col-lg-6" align="center"><p>Disediakan oleh:</p>
          <p>&nbsp;</p><br />
          <p>..............................................................</p>
          <strong><?php echo($row_list_mesyuarat['Disediakan']); ?></strong>
          </div>
          <div class="col-lg-6" align="center"><p>Disemak oleh:</p>
          <p>&nbsp;</p><br />
          <p>..............................................................</p>
          <strong><?php echo($row_list_mesyuarat['Disemak']); ?></strong>
          </div>
       </div>
      <div class="row">
       	  <div class="col-lg-12" align="center">
          <p>Disahkan oleh:</p>
          <p>&nbsp;</p><br />
          <p>..............................................................</p>
          <strong><?php echo($row_list_mesyuarat['Disahkan']); ?></strong>
          </div>
       </div>
       
       </div>
       <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
       <script src="https://cdn.rawgit.com/MrRio/jsPDF/master/dist/jspdf.debug.js"></script>
       <script src='../../jspdf/libs/html2pdf.js'></script>
   <script>
		var pdf = new jsPDF('p', 'pt', 'letter');
		pdf.html(document.getElementById('html'), {
			callback: function (pdf) {
				var iframe = document.createElement('iframe');
				iframe.setAttribute('style', 'position:absolute;right:0; top:0; bottom:0; height:100%; width:100%');
				document.body.appendChild(iframe);
				iframe.src = pdf.output('datauristring');
			}
		});
	</script>
    </body>
    <?php } ?>
    </html>