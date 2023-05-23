<?php
include("../connection/connection.php");
include("../fungsi.php");
$id_masjid_del = $_SESSION['id_masjid'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $id_masjid_del != NULL) {
    $ID = e($_POST['ID'], NULL, NULL);

    $sqldel = "DELETE FROM approve_anak WHERE ID = $ID";
    mysqli_query($bd2, $sqldel) or die(mysqli_error($bd2));

    $delsakit = "DELETE FROM sej6x_data_sakit WHERE id_anak_approved = $ID";
    mysqli_query($bd2, $delsakit) or die(mysqli_error($bd2));
}
header('Location: ../utama.php?view=admin&action=approve_qariah');
?>