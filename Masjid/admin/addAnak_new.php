<?php
include("../connection/connection.php");
include("../fungsi.php");
$id_masjid_del = $_SESSION['id_masjid'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $id_masjid_del != NULL) {
    $ID = e($_POST['ID'], NULL, NULL);
    $id_data = e($_POST['id_data'], NULL, NULL);

    $sqlInsert = "INSERT INTO sej6x_data_anakqariah
    (email, firebase_token, id_qariah, id_masjid, gambar_profil, nama_penuh, no_ic, jenisPengenalan, password, tarikh_lahir, jantina, no_tel, bangsa, warganegara, hubungan, status_asnaf, status_ibutunggal, status_sakit, status_oku, jenis_oku, status_kahwin, status_anakyatim, status_mualaf, pekerjaan, tarikh_mualaf, tempat_mualaf, dihadapan_mualaf, last_added)
    SELECT email, firebase_token, $id_data 'id_data', $id_masjid_del 'id_masjid', gambar_profil, nama_penuh, no_ic, jenisPengenalan, password, tarikh_lahir, jantina, no_tel, bangsa, warganegara, hubungan, status_asnaf, status_ibutunggal, status_sakitkronik, status_oku, jenis_oku, status_kahwin, status_anakyatim, status_mualaf, pekerjaan, tarikh_mualaf, tempat_mualaf, dihadapan_mualaf, last_added FROM approve_anak WHERE ID = $ID
";
    mysqli_query($bd2, $sqlInsert) or die(mysqli_error($bd2));
    $last_id = mysqli_insert_id($bd2);

    if($last_id != NULL) {
        $updateSakit = "UPDATE sej6x_data_sakit SET id_anak = $last_id, id_anak_approved = NULL WHERE id_anak_approved = $ID";
        mysqli_query($bd2, $updateSakit) or die(mysqli_error($bd2));

        $sqldel = "DELETE FROM approve_anak WHERE ID = $ID";
        mysqli_query($bd2, $sqldel) or die(mysqli_error($bd2));
    }
}
header('Location: ../utama.php?view=admin&action=approve_qariah');
?>