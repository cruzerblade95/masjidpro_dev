<?php require_once('Connections/koneksi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$col_id_negeri_view_daerah = "-1";
if (isset($_GET['id_negeri'])) {
  $col_id_negeri_view_daerah = $_GET['id_negeri'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_view_daerah = sprintf("SELECT * FROM daerah WHERE daerah.id_negeri = %s ORDER BY daerah.nama_daerah ASC", GetSQLValueString($col_id_negeri_view_daerah, "int"));
$view_daerah = mysql_query($query_view_daerah, $koneksi) or die(mysql_error());
$row_view_daerah = mysql_fetch_assoc($view_daerah);
$totalRows_view_daerah = mysql_num_rows($view_daerah);

?>
<script src="https://<?php echo($_SERVER["SERVER_NAME"]); ?>/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="https://<?php echo($_SERVER["SERVER_NAME"]); ?>/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="https://<?php echo($_SERVER["SERVER_NAME"]); ?>/SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="https://<?php echo($_SERVER["SERVER_NAME"]); ?>/SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="https://<?php echo($_SERVER["SERVER_NAME"]); ?>/SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="https://<?php echo($_SERVER["SERVER_NAME"]); ?>/SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<label>Daerah:
<span id="spryselect6">
<select name="id_daerah<?php echo($_GET['prefix_borang']); ?>" id="id_daerah<?php echo($_GET['prefix_borang']); ?>" onchange="document.getElementById('id_daerah2').value = this.value">
  <option value="-1" <?php if (!(strcmp("", $_GET['id_daerah']))) {echo "selected=\"selected\"";} ?>>Pilih Daerah:-</option>
  <?php
do {  
?>
  <option value="<?php echo $row_view_daerah['id_daerah']?>"<?php if (!(strcmp($row_view_daerah['id_daerah'], $_GET['id_daerah']))) {echo "selected=\"selected\"";} ?>><?php echo $row_view_daerah['nama_daerah']?></option>
  <?php
} while ($row_view_daerah = mysql_fetch_assoc($view_daerah));
  $rows = mysql_num_rows($view_daerah);
  if($rows > 0) {
      mysql_data_seek($view_daerah, 0);
	  $row_view_daerah = mysql_fetch_assoc($view_daerah);
  }
?>
</select>
</span>
</label>
<script type="text/javascript">
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6", {isRequired:false, validateOn:["change"]});
</script>
<?php
mysql_free_result($view_daerah);
?>
