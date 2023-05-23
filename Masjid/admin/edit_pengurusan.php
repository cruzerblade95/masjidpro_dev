<?php
include("../connection/connection.php");
mysqli_select_db($bd2, $mysql_database);
include("../fungsi.php");
// INSERT

$nama_penuh = $_POST['nama_penuh'];
$no_ic = $_POST['no_ic'];
$no_tel = $_POST['no_tel'];
$jawatan = $_POST['jawatan'];
$id_pengurusan = $_POST['id_pengurusan'];

$sql = "UPDATE data_pengurusan_masjid SET nama_penuh='$nama_penuh', no_ic='$no_ic', no_tel='$no_tel', jawatan='$jawatan' WHERE id_pengurusan='$id_pengurusan'";

$sqlquery = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));

if($sqlquery) {
    header("Location: ../utama.php?view=admin&action=senarai_pengurusan");
}

?>
