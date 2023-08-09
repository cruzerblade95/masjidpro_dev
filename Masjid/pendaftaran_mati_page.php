
<!-- Page Add Kematian -->
<?php
if($_GET['data'] == 'raw' && $_GET['module'] == 'add_kematian') {
    $admin_view = 1;
    $id_masjid = $_SESSION['id_masjid'];
    $reff = $_SESSION['username'];
    include("daftar_online/daftar_kematian.php");
}
?>

<!-- Page List Kematian -->
<?php if($_GET['data'] == 'raw' && $_GET['module'] == 'list_kematian') {
    $id_masjid = $_SESSION['id_masjid'];

    if($_GET['mode'] == 'padam' && $_GET['id_kematian'] != NULL) {
        $id_kematian = $_GET['id_kematian'];
        $q_del = "DELETE FROM data_kematian WHERE id_kematian = $id_kematian AND id_masjid = $id_masjid";
        mysqli_query($bd2, $q_del) or die(mysqli_error($bd2));
        echo "<script>
	jQuery('#exampleModal').modal('show');
	jQuery('#exampleModalLabel').html('Padam Senarai Kematian');
	jQuery('#badan').html('Senarai Kematian Berjaya Dipadam');
	</script>";
    }

    $q = "SELECT a.id_kematian, b.nama_penuh, a.tarikh_kematian, a.waktu_kematian, a.no_sijil, a.tarikh_dikebumikan, a.waktu_dikebumikan, b.no_ic, CONCAT(SUBSTRING(b.no_ic, 1, 6), '-', SUBSTRING(b.no_ic, 7, 2), '-', SUBSTRING(b.no_ic, 9, 4)) 'no_kp' FROM data_kematian a, sej6x_data_peribadi b WHERE a.approved = 1 AND a.id_data = b.id_data AND a.id_masjid = $id_masjid";
    $q .= " UNION SELECT c.id_kematian, d.nama_penuh, c.tarikh_kematian, c.waktu_kematian, c.no_sijil, c.tarikh_dikebumikan, c.waktu_dikebumikan, d.no_ic, CONCAT(SUBSTRING(d.no_ic, 1, 6), '-', SUBSTRING(d.no_ic, 7, 2), '-', SUBSTRING(d.no_ic, 9, 4)) 'no_kp' FROM data_kematian c, sej6x_data_anakqariah d WHERE c.approved = 1 AND c.id_anak = d.ID AND c.id_masjid = $id_masjid";
    $qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $q_row = mysqli_fetch_assoc($qq);
    $q_tot = mysqli_num_rows($qq);
    ?>
    <script>
        eval(document.getElementById("pdf_var").innerHTML);
        nama_masjid = '<?php echo($_SESSION['nama_masjid']); ?>'
        tajuk_dokumen = 'Senarai Kematian Ahli Kariah';
        eval(document.getElementById("pdf_sekerip").innerHTML);
    </script>
    <div class="row">
        <div class="col-12 col-md-12" align="center">
            <h4><?php echo($_SESSION['nama_masjid']); ?></h4>
            <h4>Senarai Kematian Ahli Kariah</h4>
        </div>
    </div>
    <div class="row table-responsive">
        <?php if($q_tot > 0) { ?>
            <div class="col-12 col-md-12 p-3">
                <div style="font-size: medium" class="alert alert-success" role="alert" align="center">Sebanyak <strong><?php echo number_format($q_tot); ?></strong> Rekod Disenaraikan</div>
            </div>
            <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
                <thead><tr>
                    <th scope="col"><div align="center">Bil</div></th>
                    <th><div align="center">Nama</div></th>
                    <th><div align="center">No K/P</div></th>
                    <th><div align="center">Tarikh & Masa Kematian</div></th>
                    <th><div align="center">No Sijil</div></th>
                    <th><div align="center">Tarikh & Waktu Dikebumikan</div></th>
                    <th><div align="center">Tindakkan</div></th>
                </tr></thead>
                <tbody>
                <?php $i=1; do { ?>
                    <tr>
                        <td><div align="center"><?php echo($i); ?></div></td>
                        <td><?php echo($q_row['nama_penuh']); ?></td>
                        <td><?php echo($q_row['no_kp']); ?></td>
                        <td><?php fungsi_tarikh($q_row['tarikh_kematian'], 2, 4); ?>, <?php echo($q_row['waktu_kematian']); ?></td>
                        <td><?php echo($q_row['no_sijil']); ?></td>
                        <td><?php fungsi_tarikh($q_row['tarikh_dikebumikan'], 2, 4); ?>, <?php echo($q_row['waktu_dikebumikan']); ?></td>
                        <td align="center">
                            <a target="_blank" href="daftar_online/daftar_kematian.php?id_kematian=<?php echo($q_row['id_kematian']); ?>&no_ic=<?php echo($q_row['no_ic']); ?>"><button type="button" class="btn btn-primary">Lihat</button></a>
                            <button type="button" class="btn btn-danger" onclick="if(confirm('Padam Rekod Kematian <?php echo($q_row['nama_penuh']); ?>?')) page_ajax('list_kematian&id_kematian=<?php echo($q_row['id_kematian']); ?>&mode=padam', '#modul_kematian', 'tunggu2')">Padam</button>
                        </td>
                    </tr>
                    <?php $i++; } while($q_row = mysqli_fetch_assoc($qq)); ?>
                </tbody>
            </table>
        <?php } if($q_tot == 0) { ?>
            <div class="col-12 col-md-12 p-3">
                <div style="font-size: medium" class="alert alert-danger" role="alert" align="center">Tiada Rekod Disenaraikan</div>
            </div>
        <?php } ?>
    </div>
<?php } ?>
<script>
    <?php if($_GET['idInfo'] != NULL) {
        echo 'document.getElementById("borang_'.$_GET['idInfo'].'").submit();';
    }
    ?>
</script>
