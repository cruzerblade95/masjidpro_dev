<?php
$query_date = date('Y-m-d');

// First day of the month.
$mula = date('Y-m-01', strtotime($query_date));

// Last day of the month.
$tamat =  date('Y-m-t', strtotime($query_date));

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $result = $_POST['cari'];
    $q = "SELECT a.nama_penuh, a.no_ic, a.id_data 'id_keluarga' FROM sej6x_data_peribadi a WHERE a.id_masjid = $id_masjid AND (a.no_ic LIKE '%$result%' OR a.nama_penuh LIKE '%$result%')
UNION SELECT b.nama_penuh, b.no_ic, b.id_qariah 'id_keluarga' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid = $id_masjid AND b.id_qariah = c.id_data AND (b.no_ic LIKE '%$result%' OR b.nama_penuh LIKE '%$result%')";
    $q2 = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $q_row = mysqli_fetch_assoc($q2);
    $q_num = mysqli_num_rows($q2);
}
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Masjid Care - Hasil Carian</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="utama.php?view=admin&action=dashboard&qariah=semua">Utama</a></li>
                <li class="breadcrumb-item active">Masjid Care</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive row">
                    <?php if($q_num > 0) { ?>
                        <div class="col-12 col-md-12">
                            <div style="font-size: medium" class="alert alert-success" role="alert" align="center">Sebanyak <strong><?php echo number_format($q_num); ?></strong> Carian Dijumpai</div>
                        </div>
                        <table class="table color-table dark-table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>No K/P</th>
                                <th>Tindakkan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; do { ?>
                                <tr>
                                    <td><?php echo($i); ?></td>
                                    <td><?php echo($q_row['nama_penuh']); ?></td>
                                    <td><?php echo($q_row['no_ic']); ?></td>
                                    <td><a href="utama.php?view=admin&action=caridetail&id_keluarga=<?php echo($q_row['id_keluarga']); ?>"><button class="btn btn-primary">Lihat</button></a></td>
                                </tr>
                                <?php $i++; } while($q_row = mysqli_fetch_assoc($q2)); ?>
                            </tbody>
                        </table>
                    <?php } ?>
                    <?php if($q_num < 1) { ?>
                        <div class="col-12 col-md-12">
                            <div style="font-size: medium" class="alert alert-danger" role="alert" align="center">Tiada Hasil Carian</div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>