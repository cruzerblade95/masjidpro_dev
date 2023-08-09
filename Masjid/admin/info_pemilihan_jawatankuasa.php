<?php

if($_GET['padam'] != NULL) {
    $q = "DELETE FROM pencalonan WHERE sesi_pemilihan_id = ".$_GET['sesi_pemilihan_id']." AND id = ".$_GET['padam'];
    cudSQL($q, 'FormsesiPemilihan');
    if($delStatus_FormsesiPemilihan == 1) {
        $namaFile = $_GET['file'];
        if ($namaFile != NULL) unlink("Uploads/$namaFile"); // Padam fail sebelum ini.
    }
    echo '<script>document.location.href="' . str_replace('&padam='.$_GET['padam'], '', $_SERVER['REQUEST_URI']) . '"</script>';
}
if(isset($_GET['sesi_pemilihan_id']) && is_numeric($_GET['sesi_pemilihan_id'])) $id = $_GET['sesi_pemilihan_id'];
$q = "SELECT *, IF(DATE(NOW()) BETWEEN tarikh_dibuka AND tarikh_ditutup, 1, IF(DATE(NOW()) < tarikh_dibuka, 2, 0)) AS status, IF(DATE(NOW()) BETWEEN tarikhUndi_dibuka AND tarikhUndi_ditutup, 1, IF(DATE(NOW()) < tarikhUndi_ditutup, 2, 0)) AS status2 FROM sesi_pemilihan WHERE id_masjid = ".$_SESSION['id_masjid']." AND id = $id";
selValueSQL($q, 'sesiPemilihan');
if($num_sesiPemilihan > 0) {
    $sub_undi = "SELECT COUNT(b.pencalonan_id) FROM pencalonan_undi b WHERE b.sesi_pemilihan_id = $id AND b.pencalonan_id = a.id";
    $q2 = "SELECT *, ($sub_undi) AS bil_undi, IF(a.jawatan = 'Pengerusi', '1', IF(a.jawatan = 'Timbalan Pengerusi', '2', IF(a.jawatan = 'AJK', '3', '4'))) AS rank FROM pencalonan a WHERE a.sesi_pemilihan_id = $id ORDER BY rank ASC";
    selValueSQL($q2, 'pencalonan');
}
?>
<div class="breadcrumbs">
    <div class="col-6" align="left">
        <div class="page-header float-left">
            <div class="page-title">
                <h1><?php echo ($row_sesiPemilihan['nama_sesi']); ?></h1>
            </div>
        </div>
    </div>
    <div class="col-6" align="right">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=pemilihan_jawatankuasa&sideMenu=organisasi">Senarai Pemilihan</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card border-info">
            <div class="card-header bg-royal">
                <h4 class="m-b-0 text-white">Senarai Pencalonan Jawatankuasa</h4>
            </div>
            <div class="card-body table-responsive">
                <div class="col-12 col-md-12 form-group" align="right">
                    <button type="button" onclick="lihatInfo(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null)" class="btn btn-info" data-toggle="modal" data-target="#verticalcenter">Tambah</button>
                </div>
                <?php if($num_pencalonan > 0) { ?>
                    <div class="col-12 col-md-12">
                        <div style="font-size: medium; font-weight: bold" class="alert alert-success" role="alert" align="center">Sebanyak <strong><?php echo number_format($num_pencalonan); ?></strong> Rekod Disenaraikan</div>
                    </div>
                    <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
                        <thead><tr>
                            <th scope="col"><div align="center">#</div></th>
                            <th><div align="center">Gambar</div></th>
                            <th><div align="center">Nama</div></th>
                            <th><div align="center">Status</div></th>
                            <th><div align="center">Jawatan</div></th>
                            <th><div align="center">Bil Undi</div></th>
                            <th><div align="center">Tindakkan</div></th>
                        </tr></thead>
                        <tbody>
                        <?php $i=1; do { ?>
                            <tr>
                                <td><div align="center"><?php echo($i); ?></div></td>
                                <td><div align="center"><img style="max-height: 96px" class="img-fluid" src="Uploads/<?php echo $row_pencalonan['gambarCalon']; ?>"></div></td>
                                <td><?php echo strtoupper($row_pencalonan['namaCalon']); ?></td>
                                <td>
                                    <div align="center">
                                        <?php
                                        if($row_pencalonan['status'] == 1) echo '<span class="badge badge-success badge-pill">DILULUSKAN</span>';
                                        else if($row_pencalonan['status'] == 0) echo '<span class="badge badge-warning badge-pill">MENUNGGU KEPUTUSAN</span>';
                                        else if($row_pencalonan['status'] == 2) echo '<span class="badge badge-danger badge-pill">DITOLAK</span>';
                                        ?>
                                    </div>
                                </td>
                                <td><?php echo strtoupper($row_pencalonan['jawatan']); ?></td>
                                <td><div align="center"><?php echo number_format($row_pencalonan['bil_undi']); ?></div></td>
                                <td>
                                    <div align="center">
                                        <a href="utama.php?view=admin&action=info_pemilihan_jawatankuasa&id=<?php echo($row_pencalonan['id']); ?>&sideMenu=organisasi"></a>
                                        <button type="button" onclick="lihatInfo(<?php echo($row_pencalonan['id']); ?>, '<?php echo($row_pencalonan['jawatan']); ?>', '<?php echo ($row_pencalonan['noIc_calon']); ?>', '<?php echo ($row_pencalonan['namaCalon']); ?>', '<?php echo ($row_pencalonan['alamatCalon']); ?>', '<?php echo ($row_pencalonan['noTel_calon']); ?>', '<?php echo ($row_pencalonan['gambarCalon']); ?>', '<?php echo ($row_pencalonan['noIc_cadang']); ?>', '<?php echo ($row_pencalonan['namaCadang']); ?>', '<?php echo ($row_pencalonan['noTel_cadang']); ?>', '<?php echo ($row_pencalonan['noIc_sokong']); ?>', '<?php echo ($row_pencalonan['namaSokong']); ?>', '<?php echo ($row_pencalonan['noTel_sokong']); ?>', '<?php echo ($row_pencalonan['status']); ?>', '<?php echo ($row_pencalonan['catatan']); ?>', '<?php echo ($row_pencalonan['catatanPengurusan']); ?>')" class="btn btn-warning" data-toggle="modal" data-target="#verticalcenter">Kemaskini</button>
                                        <a onclick="return confirm('Adakah anda pasti untuk memadam rekod <?php echo strtoupper($row_pencalonan['namaCalon']); ?> ini?')" href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>&padam=<?php echo($row_pencalonan['id']); ?>&file=<?php echo($row_pencalonan['gambarCalon']); ?>"><button type="button" class="btn btn-danger">Padam</button></a>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; } while($row_pencalonan = mysqli_fetch_assoc($fetch_pencalonan)); ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="col-12 col-md-12">
                        <div style="font-size: medium; font-weight: bold" class="alert alert-danger" role="alert" align="center">Tiada Rekod Disenaraikan</div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div id="verticalcenter" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Borang Pencalonan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <?php $tengoklah = 1; $id_masjidCalon = $row_sesiPemilihan['id_masjid']; include("borangPencalonan.php"); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
    function lihatInfo(id, jawatan, noIc_calon, namaCalon, alamatCalon, noTel_calon, gambarCalon, noIc_cadang, namaCadang, noTel_cadang, noIc_sokong, namaSokong, noTel_sokong, status, catatan, catatanPengurusan) {
        if(id > 0) {
            if (selfUpdateForm('#errMsgCalon', noIc_calon, '.dataCalon', '#gambarCalon', '#noIc_calon', '#namaCalon', '#noTel_calon|' + noTel_calon, '#alamatCalon|' + alamatCalon, '#butangCari')) {
                $('#alamatCalon').val(alamatCalon);
                $('#noTel_calon').val(noTel_calon);
            }
            if (selfUpdateForm('#errMsgCadang', noIc_cadang, '.dataCadang', null, '#noIc_cadang', '#namaCadang', '#noTel_cadang|' + noTel_cadang, '|', '#butangCari2')) {
                $('#noTel_cadang').val(noTel_cadang);
            }
            if (selfUpdateForm('#errMsgSokong', noIc_sokong, '.dataSokong', null, '#noIc_sokong', '#namaSokong', '#noTel_sokong|' + noTel_sokong, '|', '#butangCari3')) {
                $('#noTel_sokong').val(noTel_sokong);
            }
        }
        $('#jawatan').val(jawatan);
        $('#noIc_calon').val(noIc_calon);
        $('#namaCalon').val(namaCalon);
        if(gambarCalon != null && gambarCalon != 'null') {
            $('#gambarCalon_current').val(gambarCalon);
            $('#gambarCalon_preview').attr('src', 'Uploads/' + gambarCalon);
        }
        $('#noIc_cadang').val(noIc_cadang);
        $('#namaCadang').val(namaCadang);
        $('#noIc_sokong').val(noIc_sokong);
        $('#namaSokong').val(namaSokong);
        $('#status').val(status);
        $('#catatan').val(catatan);
        $('#catatanPengurusan').val(catatanPengurusan);
        $('#id').val(id);
        //if (gambarCalon != 0 || gambarCalon != null || gambarCalon != '') $('#gambarCalon').removeAttr('required');
        // else $('#gambarCalon').attr('required', true);
        $('#gambarCalon').removeAttr('required');
        $('.gambarCalon').hide();
    }
</script>