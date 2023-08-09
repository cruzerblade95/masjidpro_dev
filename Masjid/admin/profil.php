<?php
use function Verot\Upload\uploadFile;
include($_SERVER['DOCUMENT_ROOT']."/Masjid/uploadFunctions.php");
if($_SERVER['SERVER_NAME'] == "sistem.gomasjid.my") $id_masjid = $_SESSION['id_masjidAsal'];
function buatKategoriToyyib($toiyyib_api, $catname, $catdescription) {
    $some_data = array(
        'catname' => $catname,
        'catdescription' => $catdescription,
        'userSecretKey' => $toiyyib_api
    );

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/createCategory');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

    $result = curl_exec($curl);

    $info = curl_getinfo($curl);
    curl_close($curl);

    $obj = json_decode($result);
    return $obj;
}

function semakKategoriToyyib($toiyyib_api, $categoryCode) {
    $some_data = array(
        'userSecretKey' => $toiyyib_api,
        'categoryCode' => $categoryCode
    );

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/getCategoryDetails');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

    $result = curl_exec($curl);

    $info = curl_getinfo($curl);
    curl_close($curl);

    $obj = json_decode($result);
    //foreach($obj as $key => $val) {
    //echo($key.' : '.$val .'<br>');
    //}
    return $obj;
}

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['nama_form'] == "data_masjid") {
    $nama_masjid = e($_POST['nama_masjid'], 1, NULL);
    $alamat_masjid = e($_POST['alamat_masjid'], 1, NULL);
    $no_tel = e($_POST['no_tel'], NULL, NULL);
    if($_POST['id_bank'] != NULL) $id_bank = $_POST['id_bank'];
    else $id_bank = 0;
    $no_akaun = e($_POST['no_akaun'], 1, NULL);
    $toyyibKey = $_POST['toyyibKey'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    if(isset($_POST['perlu_zon'])) $perlu_zon = 1;
    else $perlu_zon = 2;
    if(isset($_POST['wajib_pilih_zon'])) $wajib_pilih_zon = 1;
    else $wajib_pilih_zon = 2;

    // semak toyyibKey, kalau betul, create kategori untuk terima bayaran daripada aplikasi MasjidPro Penang
    $q_check = "SELECT toyyibKey, cat_api FROM sej6x_data_masjid WHERE id_masjid = $id_masjid";
    $q_check2 = mysqli_query($bd2, $q_check) or die(mysqli_error($bd2));
    $row_qcheck = mysqli_fetch_assoc($q_check2);
    if(($row_qcheck['toyyibKey'] == NULL && $toyyibKey != NULL) || ($row_qcheck['toyyibKey'] != NULL && $row_qcheck['toyyibKey'] != $toyyibKey)) {
        $cat_api = buatKategoriToyyib($toyyibKey, 'Kutipan Online ' . $_SESSION['kod_masjid'], 'Kutipan Online Daripada Aplikasi MasjidPro Penang')[0]->CategoryCode;
        if ($cat_api != NULL) {
            $infoToyyib = "toyyibKey = '$toyyibKey', cat_api = '$cat_api',";
        }
    }

    $sizeFile = $_FILES['logo']['size'];
    if($sizeFile > 0) {
        $logo = uploadFile('logo', 'file', 'logo_masjid');

        // Update nama file di database sekiranya berjaya upload
        if ($logo != "0") {
            $logo_val = ", logo='$logo'";
        }
    }

    $q_update = "UPDATE sej6x_data_masjid SET $infoToyyib koordinat_y = '$longitude', koordinat_x='$latitude', wajib_pilih_zon = $wajib_pilih_zon, id_bank = $id_bank, no_akaun = '$no_akaun', nama_masjid = '$nama_masjid', alamat_masjid = '$alamat_masjid', perlu_zon = $perlu_zon, no_tel = '$no_tel' $logo_val WHERE id_masjid = $id_masjid";
    $q_query = mysqli_query($bd2, $q_update) or die(mysqli_error($bd2));

    if($q_query){
        echo '<script>alert("Maklumat Berjaya Dikemaskini");window.location.href="utama.php?view=admin&action=profil&sideMenu=masjid";</script>';
    }
}

if(isset($_POST['insert_zon'])){
    $number = count($_POST["nama_zon"]);

    for ($i = 0; $i < $number; $i++) {
        $sql5 = "INSERT INTO sej6x_data_zonqariah (id_masjid,nama_zon,no_huruf) VALUES ('$id_masjid','" . $_POST["nama_zon"][$i] . "', '" . $_POST["no_huruf"][$i] . "')";
        $sqlquery5 = mysqli_query($bd2,$sql5);
    }

    echo '<script>alert("Maklumat Zon Berjaya Ditambah");window.location.href="utama.php?view=admin&action=profil&sideMenu=masjid";</script>';
}

if(isset($_POST['namaForm']) && strpos($_POST['namaForm'], 'padamZone_') !== false) {
    $id_zonqariah = $_POST['id_zonqariah'];
    $namaZon = $_POST['namaZon'];
    $q_deleteZon = "DELETE FROM sej6x_data_zonqariah WHERE id_zonqariah = '$id_zonqariah' AND id_masjid = '$id_masjid'";
    $sqlDeleteZon = mysqli_query($bd2, $q_deleteZon);
    if($sqlDeleteZon) {
        echo '<script>alert("'.$namaZon.' Telah berjaya dipadam");</script>';
    }
    echo '<script>document.location.href="utama.php?view=admin&action=profil&sideMenu=masjid"</script>';
}

$q = "SELECT * FROM sej6x_data_masjid WHERE id_masjid = $id_masjid";
$q2 = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
$row_masjid = mysqli_fetch_assoc($q2);

?>
<style type="text/css">

    .field-icon {
        float: right;
        margin-left: -25px;
        margin-top: -25px;
        position: relative;
        z-index: 2;
    }

    .container{
        padding-top:50px;
        margin: auto;
    }

</style>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Profil</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Profil</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php if($_SESSION['user_type_id'] != 10) { ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Tetapan Sistem
                </div>
                <div class="card-body">
                    <a href="utama.php?data=raw&action=qrcode"><button class="btn btn-success">Cetak Kod QR</button></a>
                    <a href="utama.php?data=raw&action=qrcode&mode=kehadiranPegawai"><button class="btn btn-success">Cetak Kod QR Kehadiran Pegawai</button></a>
                    <a href="utama.php?data=raw&action=qrcode&mode=kehadiranPengurusan"><button class="btn btn-success">Cetak Kod QR Kehadiran Pengurusan Masjid</button></a>
                </div>
                <div class="card-body">
                    <form id="data_masjid" name="data_masjid" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?'.$_SERVER['QUERY_STRING']; ?>">
                        <div class="col-12 col-md-12 form-group">
                            <label>Nama Masjid</label>
                            <input id="nama_masjid" name="nama_masjid" class="form-control" value="<?php echo($row_masjid['nama_masjid']); ?>" required>
                        </div>
                        <div class="col-12 col-md-12 form-group">
                            <label>Logo Masjid</label>
                            <?php showImage($row_masjid['logo'], 'logo', 'logo_masjid', 'logo_preview', NULL); ?>
                        </div>
                        <div class="col-12 col-md-12 form-group">
                            <label>Alamat Masjid</label>
                            <textarea id="alamat_masjid" name="alamat_masjid" class="form-control" required rows="3"><?php echo($row_masjid['alamat_masjid']); ?></textarea>
                        </div>
                        <div class="col-12 col-md-12 form-group">
                            <label>No Telefon Masjid</label>
                            <input id="no_tel" name="no_tel" class="form-control" value="<?php echo($row_masjid['no_tel']); ?>">
                        </div>
                        <div class="col-12 col-md-12 form-group">
                            <label>Akaun Bank Masjid</label>
                            <?php pilihVal3('masjid_modal', "SELECT id_bank 'id', bank 'val' FROM bank", 1, 'id_bank', 'id_bank', 'form-control', '', $row_masjid['id_bank'], ''); ?>
                        </div>
                        <div class="col-12 col-md-12 form-group">
                            <label>No Akaun Bank Masjid</label>
                            <input id="no_akaun" name="no_akaun" class="form-control" value="<?php echo($row_masjid['no_akaun']); ?>">
                        </div>
                        <div class="col-12 col-md-12 form-group">
                            <label>No Akaun ToyyibPay (Secret key)</label>
                            <input id="toyyibKey" name="toyyibKey" class="form-control" value="<?php echo $row_masjid['toyyibKey']; ?>">
                        </div>
                        <div class="col-6 col-md-6 form-group">
                            <label>Longitude Masjid</label>
                            <input id="longitude" name="longitude" class="form-control" value="<?php echo($row_masjid['koordinat_y']); ?>">
                        </div>
                        <div class="col-6 col-md-6 form-group">
                            <label>Latitude Masjid</label>
                            <input id="latitude" name="latitude" class="form-control" value="<?php echo($row_masjid['koordinat_x']); ?>">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label>Paparkan Zon Masjid</label>
                            <input type="checkbox" <?php if($row_masjid['perlu_zon'] != 2) echo "checked"; else echo ""; ?> id="perlu_zon" name="perlu_zon" data-color="#009efb" class="js-switch" value="1">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label>Wajibkan Pemilihan Zon</label>
                            <input type="checkbox" <?php if($row_masjid['wajib_pilih_zon'] == 1) echo "checked"; else echo ""; ?> id="wajib_pilih_zon" name="wajib_pilih_zon" data-color="#009efb" class="js-switch" value="1">
                        </div>
                        <div class="col-12 col-md-12 form-group">
                            <input type="hidden" id="nama_form" name="nama_form" value="data_masjid">
                            <button class="btn btn-primary" id="tetapan" name="tetapan" type="submit">Kemaskini</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Maklumat Zon</div>
                <div class="card-body">
                    <div class="col-12 col-md-12 form-group">
                        <label>Senarai Zon</label>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="5%">Bil</th>
                                    <th width="50%">Nama Zon</th>
                                    <th width="30%">Nombor / Huruf / Simbol Zon</th>
                                    <th width="15%">Tindakan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i=1;
                                $sql_zon = "SELECT *, (SELECT SUM(1) FROM approve_qariah b WHERE b.zon_qariah = a.id_zonqariah) AS bil_zon_approve, (SELECT SUM(1) FROM sej6x_data_peribadi c WHERE c.zon_qariah = a.id_zonqariah) AS bil_zon FROM sej6x_data_zonqariah a WHERE a.id_masjid='$id_masjid'";
                                $query_zon = mysqli_query($bd2,$sql_zon);
                                $bil_zon = mysqli_num_rows($query_zon);

                                if($bil_zon>0){
                                    while($data_zon = mysqli_fetch_array($query_zon)) {
                                        ?>
                                        <tr>
                                            <td align="center"><?php echo $i; ?></td>
                                            <td align="left"><?php echo $data_zon['nama_zon']; ?></td>
                                            <td align="center"><?php echo $data_zon['no_huruf']; ?></td>
                                            <td align="center">
                                                <form id="padamZone_<?php echo $data_zon['id_zonqariah']; ?>" name="padamZone_<?php echo $data_zon['id_zonqariah']; ?>" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data" method="post" onsubmit="return confirm('Adakah anda pasti untuk memadam <?php echo $data_zon['nama_zon']; ?>?')">
                                                    <button class="btn btn-success" title="Kemaskini" data-toggle="modal" data-target="#FormEditZon" onClick="editZon(this.value)" value="<?php echo $data_zon['id_zonqariah']; ?>"><i class="fas fa-edit"></i></button>
                                                    <?php if($data_zon['bil_zon_approve'] == NULL && $data_zon['bil_zon'] == NULL) { ?>
                                                        <input type="hidden" name="id_zonqariah" value="<?php echo $data_zon['id_zonqariah']; ?>">
                                                        <input type="hidden" name="namaZon" value="<?php echo $data_zon['nama_zon']; ?>">
                                                        <input type="hidden" name="namaForm" value="padamZone_<?php echo $data_zon['id_zonqariah']; ?>">
                                                        <button type="submit" class="btn btn-danger" title="Padam"><i class="fas fa-trash"></i></button>
                                                    <?php } else { ?>
                                                        <button type="button" class="btn btn-info" title="Info">(<?php echo($data_zon['bil_zon_approve'] + $data_zon['bil_zon']); ?>)</button>
                                                    <?php } ?>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                }
                                else if($bil_zon==0){
                                    ?>
                                    <tr>
                                        <td align="center" colspan="4">*Tiada Rekod*</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?'.$_SERVER['QUERY_STRING']; ?>" method="POST">
                        <div class="col-12 col-md-12 form-group">
                            <label>Tambah Zon Baru</label>
                            <div class="row">
                                <div class="col-sm-6 nopadding">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nama_zon" name="nama_zon[]" placeholder="Nama Zon" required>
                                    </div>
                                </div>
                                <div class="col-sm-6 nopadding">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="no_huruf" name="no_huruf[]" placeholder="Nombor / Huruf / Simbol Zon">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="button" onclick="add_zon();"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="div_zon"></div>
                        </div>
                        <div class="col-12 col-md-12 form-group">
                            <button class="btn btn-primary" type="submit" name="insert_zon">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Kod QR Aktiviti
                </div>
                <div class="card-body">
                    <form id="qr_aktiviti" name="qr_aktiviti" method="post" enctype="multipart/form-data" action="utama.php?data=raw&action=qrcode">
                        <div class="col-12 col-md-12 form-group">
                            <label>Nama Aktiviti</label>
                            <input id="tujuan" name="tujuan" class="form-control" required>
                        </div>
                        <div class="col-12 col-md-12 form-group">
                            <button class="btn btn-primary" id="tetapan" name="tetapan" type="submit">Cetak Kod QR Aktiviti</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="FormEditZon" tabindex="-1" role="dialog" aria-labelledby="longmodal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="longmodal">Kemaskini Zon</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="div_editZon">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tutup</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>
<div class="content mt-3">
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Maklumat Pengguna Sistem
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form name="tukarpassword" method="post" action="<?php echo $PHP_SELF;?>" >

                                <?php
                                include("connection/connection.php");

                                $user_id_login = $_SESSION['user_id'];
                                $id_masjid_login = $_SESSION['id_masjid'];
                                $username_login = $_SESSION['username'];

                                if(isset( $_POST['kemaskini']))
                                {

                                    $username=e($_POST['username'], NULL, NULL);
                                    $password=e($_POST['password'], NULL, NULL);
                                    $user_name=e($_POST['user_name'], NULL, NULL);
                                    $user_ic=e($_POST['user_ic'], NULL, NULL);

                                    if($password != NULL) $extra = ", password='$password'";

                                    mysqli_select_db($bd2, $mysql_database);

                                    if($username != $username_login) {
                                        $check_user = "SELECT * FROM masjid_user WHERE username = '$username' AND id_masjid = '$id_masjid_login'";
                                        $conn_user = mysqli_query($bd2, $check_user);
                                        $num_login = mysqli_num_rows($conn_user);
                                    }
                                    else $num_login = 0;

                                    if($num_login < 1) {
                                        $query = "UPDATE masjid_user SET username='$username', user_name='$user_name', user_ic='$user_ic' $extra WHERE user_id='$user_id_login'";

                                        $conn = mysqli_query($bd2, $query);

                                        $sql = "SELECT a.user_name 'user_name', a.user_ic 'user_ic', b.user_type 'user_type', a.username 'username', a.password 'password' FROM masjid_user a, jenis_user b WHERE a.user_id='$user_id' AND a.user_type_id=b.user_type_id";
                                        $sqlquery = mysqli_query($bd2, $sql);
                                        $data = mysqli_fetch_array($sqlquery);
                                        if ($sqlquery) {
                                            // header("Refresh:0;");

                                            //echo "<h5><b>Maklumat telah dikemaskini.</b></h5>"."</br>";
                                            header("location: utama.php?view=admin&action=profil");
                                        } else {
                                            echo mysqli_error($bd2);
                                        }
                                    }
                                    else {
                                        $code_error = 409;
                                    }

                                }

                                $sql="SELECT a.user_name 'user_name', a.user_ic 'user_ic', b.user_type 'user_type', a.username 'username', a.password 'password' FROM masjid_user a, jenis_user b WHERE a.user_id='$user_id_login' AND a.user_type_id=b.user_type_id";
                                $sqlquery=mysqli_query($bd2, $sql);
                                $data=mysqli_fetch_assoc($sqlquery);

                                ?>

                                <div class="form-group">
                                    <?php if($code_error == 409) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Nama pengguna yang dipilih sudah digunakan, sila cuba lagi</strong>
                                        </div>
                                    <?php } ?>
                                    <label>Nama</label>
                                    <input class="form-control" value="<?php echo $data['user_name'];?>" name="user_name">
                                </div>
                                <div class="form-group">
                                    <label>No. IC</label>
                                    <input class="form-control" value="<?php echo $data['user_ic'];?>" name="user_ic">
                                </div>
                                <div class="form-group">
                                    <label>Jawatan</label>
                                    <input class="form-control" value="<?php echo $data['user_type'];?>" disabled="">
                                </div>



                        </div>
                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
                            <h2>Log Masuk Detail</h2>

                            <fieldset >
                                <div class="form-group">
                                    <label>Nama Pengguna</label>
                                    <input class="form-control" value="<?php echo $data['username'];?>" name="username">
                                </div>
                                <div class="form-group">
                                    <label>Kata Laluan</label>
                                    <input id="password-field" type="password" class="form-control" name="password">

                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                            </fieldset>


                            <button type="submit" name="kemaskini" id="kemaskini" class="btn btn-primary" onclick="return confirm('Kemaskini?')" onClick="history.go(0)">Kemaskini</button>
                            <!-- button type="reset" class="btn btn-default"></button -->
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    </form>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>

<script type="text/javascript">
    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    $(function () {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());
        });
    });
    var zon = 1;

    function add_zon() {

        zon++;
        var objTo = document.getElementById('div_zon')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass" + zon);
        var rdiv = 'removeclass' + zon;
        divtest.innerHTML = '<div class="row"><div class="col-sm-6 nopadding"><div class="form-group"> <input type="text" class="form-control" id="nama_zon" name="nama_zon[]" placeholder="Nama Zon" required></div></div><div class="col-sm-6 nopadding"><div class="form-group"><div class="input-group"><input type="text" class="form-control" id="no_huruf" name="no_huruf[]" placeholder="Nombor / Huruf / Simbol Zon"><div class="input-group-append"><button class="btn btn-danger" type="button" onclick="remove_zon(' + zon + ');"> <i class="fa fa-minus"></i> </button></div></div></div></div><div class="clear"></div></row>';

        objTo.appendChild(divtest)
    }

    function remove_zon(rid) {
        $('.removeclass' + rid).remove();
    }
    function editZon(str){
        if (str == "") {
            document.getElementById("div_editZon").innerHTML = "";
            return;
        }
        else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("div_editZon").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/geteditzon.php?id_zon="+str,true);
            xmlhttp.send();
        }
    }
</script>