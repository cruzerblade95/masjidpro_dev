<?php

if($_SERVER['REQUEST_METHOD'] == "POST") {
    foreach ($_POST as $key => $val) ${$key} = mysqli_real_escape_string($bd2, $val);
    if($id != NULL) $q = "UPDATE sesi_pemilihan SET nama_sesi = '$nama_sesi', tarikh_dibuka = '$tarikh_dibuka', tarikh_ditutup = '$tarikh_ditutup', tarikhUndi_dibuka = '$tarikhUndi_dibuka', tarikhUndi_ditutup = '$tarikhUndi_ditutup', pilihPengerusi = $pilihPengerusi, pilihTimb = $pilihTimb, pilihSU = $pilihSU, pilihBendahari = $pilihBendahari, pilihAJK = $pilihAJK, pilihPemeriksa = $pilihPemeriksa WHERE id_masjid = ".$_SESSION['id_masjid']." AND id = $id";
    else $q = "INSERT INTO sesi_pemilihan
    (id_masjid, nama_sesi, tarikh_dibuka, tarikh_ditutup, tarikhUndi_dibuka, tarikhUndi_dibuka, pilihPengerusi, pilihTimb, pilihSU, pilihBendahari, pilihAJK, pilihPemeriksa) VALUES
    (".$_SESSION['id_masjid'].", '$nama_sesi', '$tarikh_dibuka', '$tarikh_ditutup', '$tarikhUndi_dibuka', '$tarikhUndi_ditutup', $pilihPengerusi, $pilihTimb, $pilihSU, $pilihBendahari, $pilihAJK, $pilihPemeriksa)";
}
else if($_GET['padam'] != NULL) $q = "DELETE FROM sesi_pemilihan WHERE id_masjid = ".$_SESSION['id_masjid']." AND id = ".$_GET['padam'];

if($_SERVER['REQUEST_METHOD'] == "POST" || $_GET['padam'] != NULL) {
    cudSQL($q, 'FormsesiPemilihan');
    echo '<script>document.location.href="' . str_replace('&padam='.$_GET['padam'], '', $_SERVER['REQUEST_URI']) . '"</script>';
}

$q = "SELECT *, IF(DATE(NOW()) BETWEEN tarikh_dibuka AND tarikh_ditutup, 1, IF(DATE(NOW()) < tarikh_dibuka, 2, 0)) AS status, IF(DATE(NOW()) BETWEEN tarikhUndi_dibuka AND tarikhUndi_ditutup, 1, IF(DATE(NOW()) < tarikhUndi_ditutup, 2, 0)) AS status2 FROM sesi_pemilihan WHERE id_masjid = ".$_SESSION['id_masjid']." ORDER BY tarikh_ditutup DESC";
selValueSQL($q, 'sesiPemilihan');
?>
<div class="breadcrumbs">
    <div class="col-6" align="left">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Pemilihan Jawatankuasa</h1>
            </div>
        </div>
    </div>
    <div class="col-6" align="right">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Senarai Pemilihan Jawatankuasa</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card border-info">
            <div class="card-header bg-royal">
                <h4 class="m-b-0 text-white">Senarai Pemilihan Jawatankuasa</h4>
            </div>
            <div class="card-body table-responsive">
                <div class="col-12 col-md-12 form-group" align="right">
                    <button type="button" onclick="lihatInfo(null, null, null, null, null, null, 1, 1, 1, 1, 1, 1)" class="btn btn-info" data-toggle="modal" data-target="#verticalcenter">Tambah</button>
                </div>
                <?php if($num_sesiPemilihan > 0) { ?>
                    <div class="col-12 col-md-12">
                        <div style="font-size: medium; font-weight: bold" class="alert alert-success" role="alert" align="center">Sebanyak <strong><?php echo number_format($num_sesiPemilihan); ?></strong> Rekod Disenaraikan</div>
                    </div>
                    <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
                        <thead><tr>
                            <th scope="col"><div align="center">#</div></th>
                            <th><div align="center">Nama Sesi</div></th>
                            <th><div align="center">Status Pencalonan</div></th>
                            <th><div align="center">Status Pengundian</div></th>
                            <th><div align="center">Tindakkan</div></th>
                        </tr></thead>
                        <tbody>
                        <?php $i=1; do { ?>
                            <tr>
                                <td><div align="center"><?php echo($i); ?></div></td>
                                <td><?php echo strtoupper($row_sesiPemilihan['nama_sesi']); ?></td>
                                <td>
                                    <div align="center">
                                        <?php
                                        if($row_sesiPemilihan['status'] == 1) echo '<span class="badge badge-success badge-pill">DIBUKA</span>';
                                        else if($row_sesiPemilihan['status'] == 2) echo '<span class="badge badge-warning badge-pill">BELUM DIBUKA</span><br /><small>Dibuka: '.fungsi_tarikh($row_sesiPemilihan['tarikh_dibuka'], 7, 99).'</small>';
                                        else if($row_sesiPemilihan['status'] == 0) echo '<span class="badge badge-danger badge-pill">DITUTUP</span><br /><small>Ditutup: '.fungsi_tarikh($row_sesiPemilihan['tarikh_ditutup'], 7, 99).'</small>';
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <div align="center">
                                        <?php
                                        if($row_sesiPemilihan['status2'] == 1) echo '<span class="badge badge-success badge-pill">DIBUKA</span>';
                                        else if($row_sesiPemilihan['status2'] == 2) echo '<span class="badge badge-warning badge-pill">BELUM DIBUKA</span><br /><small>Dibuka: '.fungsi_tarikh($row_sesiPemilihan['tarikhUndi_dibuka'], 7, 99).'</small>';
                                        else if($row_sesiPemilihan['status2'] == 0) echo '<span class="badge badge-danger badge-pill">DITUTUP</span><br /><small>Ditutup: '.fungsi_tarikh($row_sesiPemilihan['tarikhUndi_ditutup'], 7, 99).'</small>';
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <div align="center">
                                        <a href="utama.php?view=admin&action=info_pemilihan_jawatankuasa&sesi_pemilihan_id=<?php echo($row_sesiPemilihan['id']); ?>&sideMenu=organisasi"><button type="button" class="btn btn-info">Info</button></a>
                                        <button type="button" onclick="lihatInfo(<?php echo($row_sesiPemilihan['id']); ?>, '<?php echo strtoupper($row_sesiPemilihan['nama_sesi']); ?>', '<?php echo ($row_sesiPemilihan['tarikh_dibuka']); ?>', '<?php echo ($row_sesiPemilihan['tarikh_ditutup']); ?>', '<?php echo ($row_sesiPemilihan['tarikhUndi_dibuka']); ?>', '<?php echo ($row_sesiPemilihan['tarikhUndi_ditutup']); ?>', <?php echo ($row_sesiPemilihan['pilihPengerusi']); ?>, <?php echo ($row_sesiPemilihan['pilihTimb']); ?>, <?php echo ($row_sesiPemilihan['pilihSU']); ?>, <?php echo ($row_sesiPemilihan['pilihBendahari']); ?>, <?php echo ($row_sesiPemilihan['pilihAJK']); ?>, <?php echo ($row_sesiPemilihan['pilihPemeriksa']); ?>)" class="btn btn-warning" data-toggle="modal" data-target="#verticalcenter">Kemaskini</button>
                                        <a onclick="return confirm('Adakah anda pasti untuk memadam rekod <?php echo strtoupper($row_sesiPemilihan['nama_sesi']); ?> ini?')" href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>&padam=<?php echo($row_sesiPemilihan['id']); ?>"><button type="button" class="btn btn-danger">Padam</button></a>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; } while($row_sesiPemilihan = mysqli_fetch_assoc($fetch_sesiPemilihan)); ?>
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
<div id="verticalcenter" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-12">
                            <label>Nama Pemilihan</label>
                            <textarea oninput="this.value = this.value.toUpperCase()" class="form-control" id="nama_sesi" name="nama_sesi" maxlength="300" required rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <label>Tarikh Pencalonan Dibuka</label>
                            <input class="form-control" id="tarikh_dibuka" name="tarikh_dibuka" type="date" />
                        </div>
                        <div class="col-6">
                            <label>Tarikh Pencalonan Ditutup</label>
                            <input class="form-control" id="tarikh_ditutup" name="tarikh_ditutup" type="date" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <label>Tarikh & Masa Pengundian Dibuka</label>
                            <input class="form-control" id="tarikhUndi_dibuka" name="tarikhUndi_dibuka" type="datetime-local" required />
                        </div>
                        <div class="col-6">
                            <label>Tarikh & Masa Pengundian Ditutup</label>
                            <input class="form-control" id="tarikhUndi_ditutup" name="tarikhUndi_ditutup" type="datetime-local" required />
                        </div>
                    </div>
                    <hr />
                    <h4>Tetapan Had Pengundian</h4>
                    <hr />
                    <div class="row form-group">
                        <div class="col-4">
                            <label>Pengerusi</label>
                            <input class="form-control" id="pilihPengerusi" name="pilihPengerusi" type="number" required min="1" />
                        </div>
                        <div class="col-4">
                            <label>Timb. Pengerusi</label>
                            <input class="form-control" id="pilihTimb" name="pilihTimb" type="number" required min="1" />
                        </div>
                        <div class="col-4">
                            <label>AJK</label>
                            <input class="form-control" id="pilihAJK" name="pilihAJK" type="number" required min="1" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-4" style="display: none">
                            <label>Setiausaha</label>
                            <input class="form-control" id="pilihSU" name="pilihSU" type="number" required min="1" value="1" />
                        </div>
                        <div class="col-4" style="display: none">
                            <label>Bendahari</label>
                            <input class="form-control" id="pilihBendahari" name="pilihBendahari" type="number" required min="1" value="1" />
                        </div>
                        <div class="col-4" style="display: none">
                            <label>Pemeriksa Kira-kira</label>
                            <input class="form-control" id="pilihPemeriksa" name="pilihPemeriksa" type="number" required min="1" value="1" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id" name="id">
                    <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Tutup</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
    function lihatInfo(id, namaPemilihan, tarikhDibuka, tarikhDitutup, tarikhUndiDibuka, tarikhUndiDitutup, pilihPengerusi, pilihTimb, pilihSU, pilihBendahari, pilihAJK, pilihPemeriksa) {
        $('#vcenter').html(namaPemilihan);
        $('#nama_sesi').val(namaPemilihan);
        $('#tarikh_dibuka').val(tarikhDibuka);
        $('#tarikh_ditutup').val(tarikhDitutup);
        $('#tarikhUndi_dibuka').val(tarikhUndiDibuka);
        $('#tarikhUndi_ditutup').val(tarikhUndiDitutup);
        $('#pilihPengerusi').val(pilihPengerusi);
        $('#pilihTimb').val(pilihTimb);
        $('#pilihSU').val(pilihSU);
        $('#pilihBendahari').val(pilihBendahari);
        $('#pilihAJK').val(pilihAJK);
        $('#pilihPemeriksa').val(pilihPemeriksa);
        $('#id').val(id);
    }
</script>