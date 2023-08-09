<?php
if($_SERVER["REQUEST_METHOD"] == "GET" && $_GET['data'] == 'raw' && $_GET['module'] == 'carilah') {
	$id_masjid = $_SESSION['id_masjid'];
	$term = $_GET['term'];
	$q_cari = "SELECT nama_penuh, no_ic, id_data FROM sej6x_data_peribadi WHERE id_masjid = $id_masjid AND (no_ic LIKE '%$term%' OR nama_penuh LIKE '%$term%')";
	$qq_cari = mysqli_query($bd2, $q_cari) or die(mysqli_error($bd2));
	$qq_cari_row = mysqli_fetch_assoc($qq_cari);
	$qq_cari_tot = mysqli_num_rows($qq_cari);
	$json_array = array();
	$n = 0;
	do {
		$json_array[$n]->id_data = $qq_cari_row['id_data'];
		$json_array[$n]->value = $qq_cari_row['nama_penuh'];
		$json_array[$n]->id = $qq_cari_row['no_ic'];
		$n++;
	} while($qq_cari_row = mysqli_fetch_assoc($qq_cari));
	echo json_encode($json_array);
}
?>