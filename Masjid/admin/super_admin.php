<?php
include("connection/connection.php");
if($_GET['lulus'] == 1 && is_numeric($_GET['setAktif']) && is_numeric($_GET['user_id'])) {
    $aktif = $_GET['setAktif'];
    $user_id = $_GET['user_id'];
    $q = "UPDATE masjid_user SET aktif = $aktif WHERE user_id = $user_id";
    mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $_SESSION['msgUpdate'] = "Rekod Telah Berjaya Dikemaskini";
    echo '<script>document.location.href="utama.php?view=admin&action=super_admin&sideMenu='.$sideMenu.'&aktif='.$_GET['aktif'].'"</script>';
    exit;
}
if($_GET['aktif'] == "1") $extra = "AND a.aktif = 1";
else if($_GET['aktif'] == "0") $extra = "AND a.aktif = 0";
$q = "SELECT b.kod_masjid 'Kod Masjid', a.username 'Username', a.password 'Kata Laluan', c.user_type 'Jawatan', b.nama_masjid 'Masjid',
       CONCAT(b.toyyibKey, '<br />', b.cat_api) 'Toyyib Key & Kod Kategori', a.aktif 'Status' FROM masjid_user a, sej6x_data_masjid b, jenis_user c
WHERE a.id_masjid = b.id_masjid AND a.user_type_id = c.user_type_id AND a.id_masjid NOT IN (3682, 6279, 6284, 6285) $extra
ORDER BY a.id_masjid";
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
                    <div class="row form-group">
                        <div class="col-auto">
                            <label>Status Admin Masjid</label>
                            <select class="form-control" name="jenisAdmin" onchange="document.location.href='utama.php?view=admin&action=super_admin&sideMenu=kariah&aktif='+this.value">
                                <option value="" <?php echo $_GET['aktif'] == NULL ? 'selected' : NULL; ?>>Semua</option>
                                <option value="1" <?php echo $_GET['aktif'] == "1" ? 'selected' : NULL; ?>>Diluluskan</option>
                                <option value="0" <?php echo $_GET['aktif'] == "0" ? 'selected' : NULL; ?>>Menunggu Kelulusan</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <?php if($_SESSION['msgUpdate'] != NULL) { ?>
                            <div class="alert alert-success font-weight-bold" role="alert" align="center"><?php echo($_SESSION['msgUpdate']); ?></div>
                        <?php unset($_SESSION['msgUpdate']); } ?>
                        <div class="alert alert-success font-weight-bold" role="alert" align="center">Sebanyak <?php echo($num_listAdmin); ?> Rekod Dijumpai</div>
                        <table id="meja_akaun2" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
                            <thead>
                            <tr>
                                <th><div align="center">#</div></th>
                                <?php foreach ($field_listAdmin as $field) {
                                if ($field->name != "Status") { ?>
                                    <th><div align="center"><?php echo($field->name); ?></div></th>
                                <?php } } ?>
                                <th><div align="center">Tindakkan</div></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x=1; do { ?>
                                <tr>
                                    <td><div align="center"><?php echo $x; ?></div></td>
                                    <?php foreach ($field_listAdmin as $field) {
                                        if ($field->name != "Status") {
                                            echo '<td>';
                                            echo $row_listAdmin[$field->name];
                                            echo '</td>';
                                        }
//                                        echo '<div align="center">';
//                                        if($row_listAdmin[$field->name] == 1) echo '<span class="badge badge-success">Diluluskan</span>';
//                                        else if($row_listAdmin[$field->name] == 2) echo '<span class="badge badge-danger">Ditolak</span>';
//                                        else echo '<span class="badge badge-warning">Menunggu Kelulusan</span>';
//                                        echo '</div>';
                                    }
                                    ?>
                                    <td>
                                        <select style="width: fit-content" class="form-control" onchange="document.location.href='utama.php?view=admin&action=super_admin&sideMenu=kariah&lulus=1&user_id=<?php echo($row_listAdmin['User ID']); ?>&setAktif='+this.value">
                                            <option value="1" <?php echo $row_listAdmin['Status'] == "1" ? 'selected' : NULL; ?>>Diluluskan</option>
                                            <option value="0" <?php echo $row_listAdmin['Status'] == "0" ? 'selected' : NULL; ?>>Menunggu Kelulusan</option>
                                        </select>
                                    </td>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">DAFTAR KAFA BARU</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-body">
                                <form method="post" id="insert_form" action="admin/add_kafa.php">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 align="center"><u>Maklumat Kafa</u></h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nama KAFA</label>
                                                <input class="form-control" name="nama_kafa" id="nama_kafa" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Pengurus</label>
                                                <input class="form-control" name="nama_pengurus" id="nama_pengurus" required />
                                            </div>
                                            <div class="form-group">
                                                <label>No Telefon Pengurus</label>
                                                <input class="form-control" name="no_tel" id="no_tel" placeholder="Contoh: 0122345678" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Bilangan Pelajar</label>
                                                <input class="form-control" name="bil_pelajar" id="bil_pelajar" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Alamat KAFA</label>
                                                <input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat" name="alamat" id="alamat" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Negeri</label>
                                                <select class="form-control" name="negeri" id="negeri" onChange="showDaerah(this.value)" required>
                                                    <?php echo $options1;?> <?php echo $options;?>
                                                </select>
                                            </div>
                                            <div class="form-group" id="daerah">
                                            </div>
                                            <div class="form-group">
                                                <label>Poskod</label>
                                                <input class="form-control" id="poskod" name="poskod" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <center>
                                                <div class="form-group">
                                                    <input type="hidden" name="id_masjid" id="id_masjid" value="<?php echo $id_masjid;?>" />
                                                    <input type="submit" name="insert" id="insert" value="Simpan" class="btn btn-success" />
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showDaerah(str) {
        if (str == "") {
            document.getElementById("daerah").innerHTML = "";
            return;
        } else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("daerah").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/getdaerah.php?negeri="+str,true);
            xmlhttp.send();
        }
    }

    $(document).ready(function(){

        $('#insert').on("click", function(event){
            if($('#nama_pengurus').val() == "")
            {
                alert("Nama Pengurus tidak dimasukan");
            }
            if($('#no_tel').val() == "")
            {
                alert("No.Telefon tidak dimasukan");
            }
            if($('#bil_pelajar').val() == "")
            {
                alert("Bilangan Pelajar tidak dimasukan");
            }
            if($('#nama_kafa').val() == "")
            {
                alert("Nama Kafa tidak dimasukan");
            }
            if($('#alamat').val() == "")
            {
                alert("Alamat tidak dimasukan");
            }
            if($('#negeri').val() == "")
            {
                alert("Negeri tidak dimasukan");
            }
            if($('#id_daerah').val() == "")
            {
                alert("Daerah tidak dimasukan");
            }
            if($('#poskod').val() == "")
            {
                alert("Poskod tidak dimasukan");
            }

            else
            {
                $.ajax({
                    url:"admin/add_kafa.php",
                    method:"POST",
                    data:$('#insert_form').serialize(),
                    beforeSend:function(){
                        $('#insert').val("Masuk");
                    },
                    success:function(data){
                        $('#insert_form')[0].reset();
                        $('#myModal').modal('hide');

                    }
                });
            }
        });


    });
</script>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai KAFA', [ 0, 1, 2, 3, 4 ]);
    });
</script>
                                
                       