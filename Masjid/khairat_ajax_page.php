<!-- Page Daftar dan List Khairat -->
<?php if($_GET['data'] == 'raw' && $_GET['module'] == 'list_khairat') {
$id_masjid = $_SESSION['id_masjid'];
$no_ic = $_POST['no_ic'];

if($_POST['add_khairat'] == 'list_khairat') {
	$nama_penuh = $_POST['nama_penuh_1'];
	for($i = 0; $i < count($_POST['id_khairat']); $i++) {
		$id_khairat = $_POST['id_khairat'][$i];
		$id_akaun = $_POST['id_akaun'][$i];
		$id_data = $_POST['id_data'][$i];
		$id_anakkariah = $_POST['id_anakkariah'][$i];
		if($id_akaun == NULL) $id_akaun = 0;
		if($id_khairat != NULL) $q_post = "UPDATE sej6x_data_khairat SET id_akaun = $id_akaun, id_data = '$id_data', id_anakkariah = '$id_anakkariah', id_masjid = $id_masjid, last_added = NOW() WHERE id_khairat = $id_khairat";
		if($id_khairat == NULL) $q_post = "INSERT INTO sej6x_data_khairat (id_akaun, id_data, id_anakkariah, id_masjid, last_added) VALUES ($id_akaun, $id_data, $id_anakkariah, $id_masjid, NOW())";
		mysqli_query($bd2, $q_post) or die(mysqli_error($bd2));
	}
	echo "<script>
	jQuery('#exampleModal').modal('show');
	jQuery('#exampleModalLabel').html('Pakej Khairat Ahli Kariah');
	jQuery('#badan').html('Pakej Khairat Ahli Kariah <strong>".$nama_penuh."</strong> Berjaya Ditambah / Dikemaskini');
	</script>";
}
$q = "SELECT a.nama_penuh, a.no_ic, a.id_data 'ketua', CONCAT('0') 'tanggung', b.id_khairat 'ID Khairat', b.id_akaun 'ID Akaun' FROM sej6x_data_peribadi a LEFT JOIN sej6x_data_khairat b ON a.id_data = b.id_data WHERE a.id_masjid = $id_masjid AND a.id_data = $no_ic UNION SELECT a.nama_penuh, a.no_ic, CONCAT('0') 'ketua', a.ID 'tanggung', b.id_khairat 'ID Khairat', b.id_akaun 'ID Akaun' FROM sej6x_data_anakqariah a LEFT JOIN sej6x_data_khairat b ON a.ID = b.id_anakkariah WHERE a.id_masjid = $id_masjid AND a.id_qariah = $no_ic";
$qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
$q_row = mysqli_fetch_assoc($qq);
$q_tot = mysqli_num_rows($qq);
	
$q2 = "SELECT id_akaun 'id', CONCAT(nama_akaun, ' - RM', kadar_harga, ' ', IF(bayaran_berkala = 1, 'Sebulan', 'Setahun')) 'val' FROM kew_jenis_akaun WHERE id_masjid = $id_masjid AND id_kategori_akaun = 19";
?>
<script>
post_ajax('list_khairat', '#khairat_info', 'tunggu');
eval(document.getElementById("form_ajax").innerHTML);
var cur_url = '<?php echo($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']); ?>';
</script>
<div class="card-header">Maklumat Khairat (Termasuk Tanggungan Jika Ada)</div>
<div class="card-body">
<form role="form" class="form-validate form-horizontal well" id="<?php echo($_GET['module']); ?>" name="<?php echo($_GET['module']); ?>" enctype="multipart/form-data">
<?php $n = 1; do { ?>
<div class="row form-group">
	<div class="col-md-5 col-12"><label>Nama</label><input class="form-control" readonly value="<?php echo($q_row['nama_penuh']); ?>"></div>
	<div class="col-md-3 col-12"><label>No K/P</label><input class="form-control" readonly value="<?php echo($q_row['no_ic']); ?>"></div>
	<div class="col-md-4 col-12"><?php pilihanBijak($q2, 'select', 'id_akaun[]', 'Pilihan Pakej', '', $q_row['ID Akaun']); ?></div>
	<input name="id_data[]" type="hidden" value="<?php echo($q_row['ketua']); ?>">
	<input name="id_anakkariah[]" type="hidden" value="<?php echo($q_row['tanggung']); ?>">
	<input name="id_khairat[]" type="hidden" value="<?php echo($q_row['ID Khairat']); ?>">
	<input type="hidden" name="nama_penuh[]" id="nama_penuh_<?php echo($n); ?>" value="<?php echo($q_row['nama_penuh']); ?>">
</div>
<?php $n++; } while($q_row = mysqli_fetch_assoc($qq)); ?>
	<div class="row form-group"><div class="col-md-4 col-6"><button type="submit" class="btn btn-primary">Kemaskini</button></div></div>
	<input name="add_khairat" id="add_khairat" type="hidden" value="<?php echo($_GET['module']); ?>">
	<input name="no_ic" id="no_ic" type="hidden" value="<?php echo($no_ic); ?>">
	<input name="id_masjid" id="id_masjid" type="hidden" value="<?php echo($id_masjid); ?>">
</form>
</div>
<?php } ?>

<!-- Page List Ahli Khairat -->
<?php if($_GET['data'] == 'raw' && $_GET['module'] == 'senarai_khairat') {
$id_masjid = $_SESSION['id_masjid'];
$q = "SELECT a.nama_penuh, a.no_ic, a.id_data 'ketua', CONCAT('0') 'tanggung', b.id_khairat 'ID Khairat', b.id_akaun 'ID Akaun', c.nama_akaun, c.kadar_harga, IF(c.bayaran_berkala = 1, 'Sebulan', 'Setahun') 'berkala' FROM sej6x_data_peribadi a LEFT JOIN sej6x_data_khairat b ON a.id_data = b.id_data LEFT JOIN kew_jenis_akaun c ON b.id_akaun = c.id_akaun WHERE a.id_masjid = $id_masjid AND b.id_akaun != 0 UNION SELECT a.nama_penuh, a.no_ic, CONCAT('0') 'ketua', a.ID 'tanggung', b.id_khairat 'ID Khairat', b.id_akaun 'ID Akaun', c.nama_akaun, c.kadar_harga, IF(c.bayaran_berkala = 1, 'Sebulan', 'Setahun') 'berkala' FROM sej6x_data_anakqariah a LEFT JOIN sej6x_data_khairat b ON a.ID = b.id_anakkariah LEFT JOIN kew_jenis_akaun c ON b.id_akaun = c.id_akaun WHERE a.id_masjid = $id_masjid AND b.id_akaun != 0";
$qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2).'<br>'.$q);
$q_row = mysqli_fetch_assoc($qq);
$q_tot = mysqli_num_rows($qq);
?>
<script>
	eval(document.getElementById("pdf_var").innerHTML);
	nama_masjid = '<?php echo($_SESSION['nama_masjid']); ?>'
	tajuk_dokumen = 'Senarai Khairat';
	eval(document.getElementById("pdf_sekerip").innerHTML);
</script>
<div class="card-header">Senarai Khairat <?php echo($_SESSION['nama_masjid']); ?></div>
<div class="card-body">
<div class="row table-responsive">
    <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
        <thead><tr>
            <th scope="col"><div align="center">#</div></th>
            <th><div align="center">Nama Ahli</div></th>
            <th><div align="center">Pakej Khairat</div></th>
			<th><div align="center">Harga (RM)</div></th>
        <tbody>
			<?php $i=1; do { ?>
			<tr>
            	<td><div align="center"><?php echo($i); ?></div></td>
            	<td><?php echo($q_row['nama_penuh']); ?></td>
            	<td><?php echo($q_row['nama_akaun']); ?></td>
				<td><?php echo 'RM'.number_format($q_row['kadar_harga'], 2).' '.$q_row['berkala']; ?></td>
        	</tr>
			<?php $i++; } while($q_row = mysqli_fetch_assoc($qq)); ?>
		</tbody>
    </table>
		</div></div>
<?php } ?>