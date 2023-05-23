<?php
require_once('connection/connection.php');

//include("connection/connection.php");
mysql_select_db($database_koneksi, $koneksi);
date_default_timezone_set('Asia/Kuala_Lumpur');
if(!empty($_GET['tahun'])) $tahun = $_GET['tahun'];
if(!empty($_GET['bulan'])) $bulan = $_GET['bulan'];
if($tahun == NULL || $tahun > date('Y')) $tahun = date('Y');
if($bulan == NULL || $bulan > date('m')) $bulan = date('m');
$bil_hari = date_create($tahun."-".$bulan."-01");
$bil_hari = date_format($bil_hari, "t");
//$bil_hari = $bil_hari + 1;
//echo($tahun."<br />");

include("fungsi_tarikh.php");
$period = new DatePeriod(
     new DateTime($tahun.'-'.$bulan.'-01 00:00:00'),
     new DateInterval('P1D'),
     new DateTime($tahun.'-'.$bulan.'-'.$bil_hari.' 23:59:59')
);

$sql_search="SELECT nama_penuh,no_ic,jawatan_lantikan,no_tel FROM sej6x_data_ajkmasjid"; 
$result = mysql_query($sql_search) or die ("Error :".mysql_error());

?>

testing.....
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td rowspan="2">Nama AJK</td>
    <th><?php fungsi_tarikh($tahun.'-'.$bulan.'-'.$bil_hari.' 00:00:00', 4, 1); ?></th>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
      <tr>
      <?php
		foreach ($period as $key => $value) {
		//$list_tarikh = $value->format('Y-m-d H:i:s');
		$list_tarikh = $value->format('j');
		//$query_add_tarikh = "INSERT INTO tarikh_masa (tarikh_masa) VALUES ('$list_tarikh')";
		//mysql_query($query_add_tarikh, $koneksi);
    	//echo($query_add_tarikh."<br />");
		?>
        <th><?php echo($list_tarikh); ?></th>
        <?php } ?>
      </tr>
    </table></td>
  </tr>
  <?php $i = 1; do { ?>
  <tr>
    <td>Nama AJK <?php echo($i); ?></td>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
      <tr>
      <?php
		foreach ($period as $key => $value) {
		//$list_tarikh = $value->format('Y-m-d H:i:s');
		$list_tarikh = $value->format('j');
		//$query_add_tarikh = "INSERT INTO tarikh_masa (tarikh_masa) VALUES ('$list_tarikh')";
		//mysql_query($query_add_tarikh, $koneksi);
    	//echo($query_add_tarikh."<br />");
		?>
        <td><?php echo($list_tarikh); ?></td>
        <?php } ?>
      </tr>
    </table></td>
  </tr>
  <?php $i++; } while($i <= 10); ?>
</table>