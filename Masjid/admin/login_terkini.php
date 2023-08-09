<?php
include("connection/connection.php");
$q = "SELECT b.kod_masjid 'Kod Masjid', a.username 'Username', c.user_type 'Jawatan', b.nama_masjid 'Masjid',
       a.lastLogin 'Login Terakhir' FROM masjid_user a, sej6x_data_masjid b, jenis_user c
WHERE a.lastLogin IS NOT NULL AND a.aktif = 1 AND a.id_masjid = b.id_masjid AND a.user_type_id = c.user_type_id AND a.id_masjid NOT IN (3682, 6279, 6284, 6285)
GROUP BY b.id_masjid
ORDER BY a.lastLogin DESC";
selValueSQL($q, 'listAdmin');
?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Senarai Admin Masjid</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard&sideMenu=<?php echo($sideMenu); ?>">Pengurusan Kariah</a></li>
                    <li class="active">Super Admin</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-auto">
                            <a href="utama.php?view=admin&action=super_admin&sideMenu=kariah"><button class="btn btn-info" type="button">Senarai Pengguna</button></a>
                        </div>
                        <div class="col-auto">
                            <a href="utama.php?view=admin&action=login_terkini&sideMenu=kariah"><button class="btn btn-info" type="button">Login Terkini</button></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="alert alert-success font-weight-bold" role="alert" align="center">Sebanyak <?php echo($num_listAdmin); ?> Rekod Dijumpai</div>
                        <table id="meja_akaun2" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
                            <thead>
                            <tr>
                                <th><div align="center">#</div></th>
                                <?php foreach ($field_listAdmin as $field) {
                                if ($field->name != "Status") { ?>
                                    <th><div align="center"><?php echo($field->name); ?></div></th>
                                <?php } } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x=1; do { ?>
                                <tr>
                                    <td><div align="center"><?php echo $x; ?></div></td>
                                    <?php foreach ($field_listAdmin as $field) {
                                        if ($field->name != "Status") {
                                            echo '<td>';
                                            if($field->name == "Login Terakhir" && $row_listAdmin[$field->name] != NULL) {
                                                echo fungsi_tarikh($row_listAdmin[$field->name], 1, 99);
                                            }
                                            else echo $row_listAdmin[$field->name];
                                            echo '</td>';
                                        }
                                    }
                                    ?>
                                </tr>
                                <?php $x++; } while($row_listAdmin = mysqli_fetch_assoc($fetch_listAdmin)); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai Login Terkini', [ 0, 1, 2, 3, 4, 5 ]);
    });
</script>
                                
                       