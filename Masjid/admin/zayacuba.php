<!--add_inventori.php-->
<?php
require_once('../connection/connection.php');
// Connect to server and select database.

$jenis_inventori=$_POST['jenis_inventori'];
$nama_inventori=$_POST['nama_inventori'];
$tarikh_belian=$_POST['tarikh_belian'];
$kuantiti=$_POST['kuantiti'];
$peratus=$_POST['peratus'];
$bil_tahun=$_POST['bil_tahun'];
$harga_belian=$_POST['harga_belian'];
//$no_rujukan=$_POST['no_rujukan'];
$status_belian=$_POST['status_belian'];
$catatan=$_POST['catatan'];

$lokasi=$_POST['lokasi'];
$id_ajk=$_POST['id_ajk'];
$harga_sewa=$_POST['harga_sewa'];

if($jenis_inventori==1)
{
    $f=substr('PERKAKAS DAPUR', 0, 2); // pre defined function of php
}
else if($jenis_inventori==2)
{
    $f=substr('PERALATAN', 0, 2); // pre defined function of php
}
else if($jenis_inventori==3)
{
    $f=substr('ELEKTRIK', 0, 2); // pre defined function of php
}
else if($jenis_inventori==4)
{
    $f=substr('PERABOT', 0, 2); // pre defined function of php
}
else if($jenis_inventori==5)
{
    $f=substr('KENDERAAN', 0, 2); // pre defined function of php
}
else if($jenis_inventori==6)
{
    $f=substr('LAIN-LAIN', 0, 2); // pre defined function of php
}
echo '<br>';
echo $m=date('m'); // Get the month
echo '<br>';
echo $y=date('y'); // Get the dat
echo '<br>';
echo $d=date('d'); // Get the Year
echo '<br>';
echo '<br>';

// Get the rows count
$GetSidNo=mysqli_query($bd2, "SELECT * FROM sej6x_data_inventori WHERE id_masjid='$id_masjid'");
$GetSidNo1=mysqli_num_rows($GetSidNo);
$invID = str_pad($GetSidNo1, 4, '0', STR_PAD_LEFT);

$no_rujukan=$f.$y.$m.$d.$invID;

$t=time();


//date($variable, 'd-m-Y H:i:s');



echo $inventori="INSERT INTO sej6x_data_inventori
(id_masjid,jenis_inventori,nama_inventori,tarikh_belian,kuantiti,harga_belian,peratus,bil_tahun,no_rujukan,status_belian,catatan,lokasi,id_ajk,harga_sewa,susut_nilai,id_lantikkan)
VALUES ('$id_masjid','$jenis_inventori','$nama_inventori','$tarikh_belian','$kuantiti','$harga_belian','0','0','$no_rujukan','$status_belian','$catatan','$lokasi','$id_ajk','$harga_sewa','0','0')";

$sewa= "INSERT INTO status_barang (no_barang,id_masjid,status_nama_perkara,status_nama,status_lokasi,status_luas_kuantiti,status_harga_sewa,status)
VALUES('$no_rujukan','$id_masjid','$jenis_inventori','$nama_inventori','$lokasi','$kuantiti','$harga_sewa','ADA')";


$r = mysqli_query($bd2, $inventori);
$r = mysqli_query($bd2, $sewa);
if($r)
{
    header("Location: ../utama.php?view=admin&action=maklumatinventori");
}
else
{
    echo mysqli_error($bd2);
}


?>
<!--selenggara-->
<?php

include("connection/connection.php");

//untuk sql negeri
$sql_negeri="SELECT id_negeri,name FROM negeri";
$result1 = mysqli_query($bd2,$sql_negeri) or die ("Error :".mysqli_error($bd2));

$options1 = $options1."<option>Sila Pilih Negeri</option>";
while($row1=mysqli_fetch_array($result1))
{

    $options=$options."<option value='$row1[id_negeri]'>$row1[name]</option>";
}

//untuk sql daerah
$sql_daerah="SELECT id_daerah,id_negeri,nama_daerah FROM daerah WHERE id_negeri='$id_negeri'";
$result2=mysqli_query($bd2,$sql_daerah) or die ("Error :".mysqli_error($bd2));

$options3 = $options3."<option>Sila Pilih Daerah</option>";
while($row2=mysqli_fetch_array($result2))
{
    $options4=$options4."<option value='$row2[id_daerah]'>$row2[nama_daerah]</option>";
}
?>
<?php
if($_GET['action']=="selenggara")
{
    ?>
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Borang Selenggara</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
                        <li class="active">Borang Selenggara</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Maklumat Penyelenggaraan
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <center><h4>P.I.C (PERSON IN CHARGE)</h4></center>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>P.I.C (Person-In-Charge)</label>
                                <select class="form-control" name="pic" required onChange="showSelenggara(this.value)">
                                    <option value="">Sila Pilih:-</option>
                                    <option value="1">Vendor</option>
                                    <option value="2">Masjid</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <form method="POST" action="admin/add_selenggara.php" name="selenggara">
                        <div id="show_selenggara">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showSelenggara(str) {
        if (str == "") {
            document.getElementById("show_selenggara").innerHTML = "";
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
                    document.getElementById("show_selenggara").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/getselenggara.php?id_pic="+str,true);
            xmlhttp.send();
        }
    }
</script>
<!--KEROSAKAN-->
<?php
if($_GET['action']=="kerosakan")
{
    ?>
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Borang Kerosakan</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
                        <li class="active">Borang Kerosakan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Maklumat Kerosakan
                </div>
                <div class="card-body">
                    <div class="panel-body">
                        <form method="POST" action="admin/add_kerosakan.php" name="kerosakan">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tarikh Kerosakan</label>
                                        <input class="form-control" type="date" name="tarikh_kerosakan" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Masa Kerosakan</label>
                                        <input class="form-control" type="time" name="masa_kerosakan" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kerosakan</label>
                                        <input class="form-control" name="jenis_kerosakan"required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Catatan Kerosakan</label>
                                        <textarea class="form-control" rows="2" name="catatan_kerosakan"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Catatan Tindakan</label>
                                        <textarea class="form-control" rows="2" name="catatan_tindakan"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12" align="center">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-primary">Padam</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--add_kerosakan-->
<?php
require_once('../connection/connection.php');
// Connect to server and select database.

$tarikh_kerosakan=$_POST['tarikh_kerosakan'];
//$hari_kerosakan=$_POST['hari_kerosakan'];
$masa_kerosakan=$_POST['masa_kerosakan'];
$jenis_kerosakan=$_POST['jenis_kerosakan'];
$catatan_kerosakan=$_POST['catatan_kerosakan'];
$catatan_tindakan=$_POST['catatan_tindakan'];

$q ="INSERT INTO sej6x_data_kerosakkan (id_masjid, tarikh_kerosakkan, hari_kerosakan, masa_kerosakan, jenis_kerosakan, catatan_kerosakkan, catatan_tindakkan, id_lantikkan) VALUES('$id_masjid','$tarikh_kerosakan', '0', '$masa_kerosakan','$jenis_kerosakan','$catatan_kerosakan','$catatan_tindakan','0')";

$r = mysqli_query($bd2, $q);
if($r)
{
    header("Location: ../utama.php?view=admin&action=maklumatkerosakan");
}
else
{
    echo mysqli_error($bd2);
}

?>
<!--laporan_inventori-->
<?php
include("connection/connection.php");

if(isset($_POST['search']))
{
    $daripada = $_POST['daripada'];
    $hingga = $_POST['hingga'];

}
?>
<?php
if($_GET['action']=="maklumatinventori")
{
    ?>
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Laporan Inventori</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
                        <li class="active">Laporan Inventori</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<!-- div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Carian &nbsp;&nbsp;
                            <button  class="btn btn-info" onclick="history.go(-1);">Kembali </button></div>

                        <div class="panel-body">
                        <div class="row">
                            <form id="form1" name="form1" method="POST" action="<?php //echo $PHP_SELF;?>">

                            <div class="col-lg-3">
                              <div class="form-group">
                                <label>Daripada</label>
                                        <input class="form-control" name="daripada" id="daripada" type="date" required>
                              </div>
                                </div>

                              <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Hingga</label>
                                            <input class="form-control" name="hingga" id="hingga" type="date" required>
                                        </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                            <br>
                                            <input type="submit" name="search" value="Carian" class="btn btn-primary"></input>

                                    </div>
                                     <input type="hidden" name="carisearch" value="1" />
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div -->
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Maklumat Inventori
                    <?php
                    if($_GET['action']=="maklumatinventori")
                    {
                        ?>
                        &nbsp;&nbsp;<a href="utama.php?view=admin&action=inventori" class="btn btn-primary">Tambah Inventori</a>
                        <?php
                    }
                    ?>
                    <!-- <button onclick="myFunction()" class="btn btn-primary">Cetak</button>
                    <script>
                    function myFunction() {
                    window.print();
                    }
                    </script> -->
                </div>
                <div class="card-body">
                    <?php

                    include("connection/connection.php");

                    $sql_search="SELECT id_inventori, id_masjid, nama_peralatan, kod_peralatan, jenis_peralatan, tarikh_belian, id_pegawai, id_penyelenggara, kuantiti_belian, kuantiti_unit, kuantiti_semasa, harga_belian, lokasi, id_pembekal, catatan FROM sej6x_data_inventori WHERE id_masjid = $id_masjid";
                    $result = mysqli_query($bd2,$sql_search) or die ("Error :".mysqli_error($bd2));

                    ?>
                    <div class="table-responsive">
                        <table id="meja_akaun3" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
                            <thead>
                            <tr>
                                <th colspan="7"><div align="center">Harga Sebelum Susust Nilai</div></th>
                                <th rowspan="2" width="20%"><div align="center">Semak</div></th>
                            </tr>
                            <tr>
                                <th width="5%"><div align="center">Bil</div></th>
                                <th width="25%"><div align="center">Nama Peralatan</div></th>
                                <th width="10"><div align="center">Kod Peralatan</div></th>
                                <th width="15%"><div align="center">Tarikh Belian</div></th>
                                <th width="5%"><div align="center">Kuantiti Semasa & Unit</div></th>
                                <th width="10%"><div align="center">Tempat / Lokasi (Simpan)</div></th>
                                <th width="10%"><div align="center">Status Peralatan</div></th>
                                <th width="10%"><div align="center"></div></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $x=1;
                            while($row = mysqli_fetch_assoc($result))
                            {
                                ?>
                                <tr>
                                    <td><div align="center"><?php echo $x; ?></div></td>
                                    <td><div align="center"><?php echo $row['nama_peralatan']; ?></div></td>
                                    <td><div align="center"><?php echo $row['kod_peralatan']; ?></div></td>
                                    <td><div align="center"><?php echo $row['tarikh_belian']; ?></div></td>
                                    <td><div align="center"><?php echo $row['kuantiti_semasa']; ?>&nbsp;<?php echo $row['kuantiti_unit']; ?></div></td>
                                    <td><div align="center"><?php echo $row['lokasi']; ?></div></td>
                                    <td><div align="center"><?php echo $row['id_masjid'] ?></div></td>
                                    <td>
                                        <div align="center">
                                            <form action="admin/del_inventori.php" method="POST">
                                                <a href="utama.php?view=admin&action=susut_nilai&id_inventori=<?php echo $row['id_inventori'];?>&tarikh_belian=<?php echo $row['tahun'];?>">
                                                    <button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="right" title="Lihat">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </a>
                                                <a href="utama.php?view=admin&action=edit_inventori&id_inventori=<?php echo $row['id_inventori'];?>&tarikh_belian=<?php echo $row['tahun'];?>">
                                                    <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Kemaskini">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a>
                                                <!-- <form name="delete" method="POST" action="admin/del_inventori.php"> -->
                                                <input type="hidden" name="id_inventori" value="<?php echo $row['id_inventori']; ?>">
                                                <input type="hidden" name="no_rujukan" value="<?php echo $row['kod_peralatan']; ?>">
                                                <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
                                                <button type="submit" name="delete" id="delete" class="btn btn-danger" title="Padam"><i class="far fa-trash-alt" onclick="return confirm('Padam Rekod?');"></i></button>
                                                <!-- </form> -->
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $x++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun3', 'Senarai Inventori', [ 0, 1, 2, 3, 4, 5, 6 ]);
    });
</script>
<!--edit iventori-->
<?php

//include("connection/connection.php");

$idd = $_GET['id_inventori'];
$tahun = $_GET['tarikh_belian'];
$bil_tahun = $_GET['bil_tahun'];

$sql_search="SELECT 
	id_inventori,jenis_inventori,nama_inventori,kuantiti,harga_belian, 			
	peratus,tarikh_belian,id_ajk,bil_tahun,kuantiti,harga_belian,status_belian,lokasi,harga_sewa,catatan,no_rujukan,(kuantiti*harga_belian) as 
	'amaun' FROM sej6x_data_inventori WHERE id_masjid = $id_masjid AND id_inventori='".$idd."'";
$result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
$row = mysqli_fetch_assoc($result);

$sql1 = "SELECT a.id_dataajk 'id_dataajk', a.jawatan 'jawatan', b.nama_penuh 'nama_penuh' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_ajk=b.id_data AND a.id_masjid='$id_masjid' ORDER BY (CASE a.jawatan WHEN 'Pengerusi' THEN 1 WHEN 'Timbalan Pengerusi' THEN 2 WHEN 'Setiausaha' THEN 3 WHEN 'Bendahari' THEN 4 WHEN 'AJK' THEN 5 ELSE 'Pemeriksa Kira-Kira' END), b.nama_penuh ASC";
$sqlquery1 = mysqli_query($bd2, $sql1) or die ("Error :".mysqli_error($bd2));;
?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Kemaskini Inventori</h1>
                <!-- <h1>Laporan Susut Nilai</h1> -->
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=maklumatinventori">Laporan Inventori</a></li>
                    <li class="active">Kemaskini Inventori</li>
                    <!-- <li class="active">Laporan Susut Nilai</li> -->
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Maklumat Inventori
                </div>
                <div class="card-body">
                    <form method="POST" action="admin/update_inventori.php">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Jenis Peralatan</label>
                                    <select class="form-control" name="jenis_inventori">
                                        <option>Sila Pilih Peralatan</option>
                                        <option value="1" <?php if($row['jenis_inventori']==1) { echo "selected"; } ?>>Perkakas Dapur</option>
                                        <option value="2" <?php if($row['jenis_inventori']==2) { echo "selected"; } ?>>Peralatan</option>
                                        <option value="3" <?php if($row['jenis_inventori']==3) { echo "selected"; } ?>>Elektrik</option>
                                        <option value="4" <?php if($row['jenis_inventori']==4) { echo "selected"; } ?>>Perabot</option>
                                        <option value="5" <?php if($row['jenis_inventori']==5) { echo "selected"; } ?>>Kenderaan</option>
                                        <option value="6" <?php if($row['jenis_inventori']==6) { echo "selected"; } ?>>Lain-Lain</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama AJK Yang Bertanggunjawab</label>
                                    <select class="form-control" name="id_ajk">
                                        <option>Sila Pilih AJK</option>
                                        <?php
                                        $id_ajk=$row['id_ajk'];
                                        while($row_list_ajk = mysqli_fetch_array($sqlquery1))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_ajk['id_dataajk']); ?>" <?php if($id_ajk==$row_list_ajk['id_dataajk']) { echo "selected"; } ?>><?php echo($row_list_ajk['nama_penuh']); ?> - <?php echo $row_list_ajk['jawatan']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Peralatan</label>
                                    <input class="form-control" name="nama_inventori" value="<?php echo $row['nama_inventori']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Tarikh Belian/Terima</label>
                                    <input class="form-control" name="tarikh_belian" value="<?php echo $row['tarikh_belian']; ?>" type="date">
                                </div>
                                <div class="form-group">
                                    <label>Kuantiti/Luas</label>
                                    <input type="text" class="form-control" name="kuantiti" value="<?php echo $row['kuantiti']; ?>" required>
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tempat/Lokasi(Simpan)</label>
                                    <input class="form-control" name="lokasi" value="<?php echo $row['lokasi']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Harga Belian/Anggaran(RM)</label>
                                    <input class="form-control" placeholder="Contoh: 150.00" name="harga_belian" value="<?php echo $row['harga_belian']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Bayaran Sewaan Sehari (RM)</label>
                                    <input class="form-control" name="harga_sewa" required value="<?php echo $row['harga_sewa']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Status Peralatan</label>
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="status_belian" id="optionsRadiosInline1" value="Beli" <?php if($row['status_belian']=="Beli") { echo "checked"; } ?>>Beli
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status_belian" id="optionsRadiosInline2" value="Sumbangan" <?php if($row['status_belian']=="Sumbangan") { echo "checked"; } ?>>Sumbangan
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <textarea class="form-control" rows="2" name="catatan"><?php echo $row['catatan']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12" align="center">
                                <div class="form-group">
                                    <input type="hidden" value="<?php echo $row['no_rujukan']; ?>" name="no_rujukan">
                                    <input type="hidden" value="<?php echo $id_masjid; ?>" name="id_masjid">
                                    <input type="hidden" value="<?php echo $row['id_inventori']; ?>" name="id_inventori">
                                    <input type="submit" value="Kemaskini" class="btn btn-success">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
//laporan penyelenggaraan
<?php

include("connection/connection.php");

if(isset($_POST['search']))
{
    $daripada = $_POST['daripada'];
    $hingga = $_POST['hingga'];
}

?>
<?php
if($_GET['action']=="maklumatselenggara")
{
    ?>
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Laporan Penyelenggaraan</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
                        <li class="active">Laporan Penyelenggaraan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<div class="content mt-3">
    <!-- <div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Carian
				</div>
				<div class="panel-body">
					<form id="form1" name="form1" method="POST" action="<?php echo $PHP_SELF;?>">
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-3">
								<div class="form-group">
									<label>Daripada</label>
									<input class="form-control" name="daripada" id="daripada" type="date" required>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label>Hingga</label>
									<input class="form-control" name="hingga" id="hingga" type="date" required>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<br>
									<input type="submit" name="search" value="Carian" class="btn btn-primary"></input>
								</div>
								<input type="hidden" name="carisearch" value="1" />
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div> -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Maklumat Penyelenggaraan&nbsp;
                    <?php
                    if($_GET['action']=="maklumatselenggara")
                    {
                        ?>
                        <a href="utama.php?view=admin&action=selenggara" class="btn btn-primary">Borang Penyelenggaraan</a>
                        <?php
                    }
                    ?>
                    <!-- <button onclick="myFunction()" class="btn btn-primary">Cetak</button>
                    <script>
                    function myFunction() {
                    window.print();
                    }
                    </script> -->
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <center><h4>LAPORAN PENYELENGGARAAN <!-- <br> DARIPADA <?php echo $daripada; ?> HINGGA <?php echo $hingga; ?></</h4></center> -->
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="table-responsive">
                            <?php

                            include("connection/connection.php");

                            if(isset($_POST['search']))
                            {
                                $daripada = $_POST['daripada'];
                                $hingga = $_POST['hingga'];
                                $statuss = $_POST['carisearch'];
                            }
                            //if($statuss == '1')
                            //{
                            //$sql_search="SELECT id_selenggara,pilihan_selenggara,id_vendor,tarikh_selenggara FROM sej6x_data_selenggara WHERE id_masjid='$id_masjid' AND tarikh_selenggara BETWEEN '$daripada' AND '$hingga' ";
                            $sql_search="SELECT * FROM sej6x_data_selenggara WHERE id_masjid='$id_masjid'";
                            $result = mysqli_query($bd2,$sql_search) or die ("Error :".mysqli_error($bd2));
                            ?>
                            <table id="meja_selenggara" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
                                <thead>
                                <tr>
                                    <th><div align="center">Bil</div></th>
                                    <th><div align="center">Jenis Selenggara</div></th>
                                    <th><div align="center">P.I.C (Person-In-Charge)</div></th>
                                    <th><div align="center">Nama P.I.C</div></th>
                                    <th><div align="center">Tindakan</div></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $x=1;
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    ?>
                                    <tr>
                                        <td><div align="center"><?php echo $x; ?></div></td>
                                        <td>
                                            <div align="center">
                                                <?php
                                                if($row["pilihan_selenggara"]=='1')
                                                {
                                                    echo "Fasiliti";
                                                }
                                                else if($row["pilihan_selenggara"]=='2')
                                                {
                                                    echo "Elektrik";
                                                }
                                                else if($row["pilihan_selenggara"]=='3')
                                                {
                                                    echo "Air";
                                                }
                                                else if($row["pilihan_selenggara"]=='4')
                                                {
                                                    echo "Komunikasi";
                                                }
                                                else if($row["pilihan_selenggara"]=='5')
                                                {
                                                    echo "Perkakasan";
                                                }
                                                ?>
                                            </div>
                                        </td>
                                        <td align="center">
                                            <?php
                                            if($row['id_vendor']!="")
                                            {
                                                echo "Vendor";
                                            }
                                            else if($row['id_dataajk']!="")
                                            {
                                                echo "Masjid";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <div align="center">
                                                <?php
                                                if($row['id_vendor']!="")
                                                {
                                                    $id_vendor=$row['id_vendor'];

                                                    $sql="SELECT * FROM kew_vendor WHERE id_vendor='$id_vendor'";
                                                    $sqlquery=mysqli_query($bd2,$sql);
                                                    $data=mysqli_fetch_array($sqlquery);
                                                    ?>
                                                    <button class="form-control" type="button" data-toggle="modal" data-target="#myVendor<?php echo $id_vendor; ?>">
                                                        <?php echo $data['nama_vendor']; ?>&nbsp;<i class="fas fa-id-card"></i>
                                                    </button>
                                                    <?php
                                                }
                                                else if($row['id_dataajk']!="")
                                                {
                                                    $id_dataajk=$row['id_dataajk'];

                                                    $sql="SELECT a.nama_penuh, a.no_ic, a.no_hp, a.alamat_terkini, a.id_data FROM sej6x_data_peribadi a, data_ajkmasjid b WHERE b.id_dataajk='$id_dataajk' AND a.id_data=b.id_ajk";
                                                    $sqlquery=mysqli_query($bd2,$sql);
                                                    $data=mysqli_fetch_array($sqlquery);
                                                    ?>
                                                    <button class="form-control" type="button" data-toggle="modal" data-target="#myAJK<?php echo $id_dataajk; ?>">
                                                        <?php echo $data['nama_penuh']; ?>&nbsp;<i class="fas fa-id-card"></i>
                                                    </button>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </td>
                                        <td align="center">
                                            <form name="delete" method="POST" action="admin/del_selenggara.php">
                                                <a href="utama.php?view=admin&action=semak_selenggara&id_selenggara=<?php echo $row['id_selenggara'];?>">
                                                    <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </a>
                                                <input type="hidden" name="del" id="del" value="<?php echo $row['id_selenggara']; ?>">
                                                <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam" onclick="return confirm('Padam rekod?')">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                    $x++;
                                }
                                //}
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<?php
$sql1="SELECT * FROM sej6x_data_selenggara WHERE id_masjid='$id_masjid'";
$sqlquery1=mysqli_query($bd2,$sql1);
while($data1=mysqli_fetch_array($sqlquery1))
{
    $id_vendor=$data1['id_vendor'];

    $sql2="SELECT * FROM kew_vendor WHERE id_vendor='$id_vendor'";
    $sqlquery2=mysqli_query($bd2,$sql2);
    $data2=mysqli_fetch_array($sqlquery2);
    ?>
    <div class="modal fade" id="myVendor<?php echo $id_vendor; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">MAKLUMAT VENDOR</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <center>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <center><h4><u>Maklumat Vendor</u></h4></center>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Vendor</label><br>
                                            <input type="text" class="form-control" disabled value="<?php echo $data2['nama_vendor']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>No Kad Pengenalan / No Syarikat</label><br>
                                            <input type="text" class="form-control" disabled value="<?php echo $data2['ic_id']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>No Telefon</label>
                                            <input type="text" class="form-control" disabled value="<?php echo $data2['no_phone']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea rows="5" class="form-control" disabled><?php echo $data2['alamat']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </center>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                            </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.modal-body -->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- modal-dialog modal-lg -->
    </div>
    <!-- modal fade -->
    <?php
}
?>
<?php
$sql3="SELECT * FROM sej6x_data_selenggara WHERE id_masjid='$id_masjid'";
$sqlquery3=mysqli_query($bd2,$sql3);
while($data3=mysqli_fetch_array($sqlquery3))
{
    $id_dataajk=$data3['id_dataajk'];

    $sql4="SELECT a.nama_penuh, a.no_ic, a.no_hp, a.alamat_terkini, a.id_data FROM sej6x_data_peribadi a, data_ajkmasjid b WHERE b.id_dataajk='$id_dataajk' AND a.id_data=b.id_ajk";
    $sqlquery4=mysqli_query($bd2,$sql4);
    $data4=mysqli_fetch_array($sqlquery4);
    ?>
    <div class="modal fade" id="myAJK<?php echo $id_dataajk; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">MAKLUMAT VENDOR</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <center>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <center><h4><u>Maklumat Vendor</u></h4></center>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Vendor</label><br>
                                            <input type="text" class="form-control" disabled value="<?php echo $data4['nama_penuh']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>No Kad Pengenalan / No Syarikat</label><br>
                                            <input type="text" class="form-control" disabled value="<?php echo $data4['no_ic']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>No Telefon</label>
                                            <input type="text" class="form-control" disabled value="<?php echo $data4['no_hp']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea rows="5" class="form-control" disabled><?php echo $data4['alamat_terkini']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </center>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                            </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.modal-body -->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- modal-dialog modal-lg -->
    </div>
    <!-- modal fade -->
    <?php
}
?>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_selenggara', 'Senarai Penyelenggaraan', [ 0, 1, 2, 3 ]);
    });
</script>
<!--daftar kerosakan(baru)-->
<?php
$sql = "SELECT id_inventori, kod_peralatan, nama_peralatan, jenis_peralatan FROM sej6x_data_inventori WHERE id_masjid = $id_masjid";
$list_kod = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
?>
<?php
$sqll = "SELECT id_penyelenggara, nama_penyelenggara, kat_penyelenggara FROM penyelenggara WHERE id_masjid = $id_masjid GROUP BY nama_penyelenggara";
$list_penyelenggara = mysqli_query($bd2, $sqll) or die(mysqli_error($bd2));
?>
<?php
$sqlll = "SELECT a.id_dataajk 'id_dataajk', a.jawatan 'jawatan', b.nama_penuh 'nama_penuh' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_ajk=b.id_data AND a.id_masjid='$id_masjid' ORDER BY (CASE a.jawatan WHEN 'Pengerusi' THEN 1 WHEN 'Timbalan Pengerusi' THEN 2 WHEN 'Setiausaha' THEN 3 WHEN 'Bendahari' THEN 4 WHEN 'AJK' THEN 5 ELSE 'Pemeriksa Kira-Kira' END), b.nama_penuh ASC";
$list_ajk = mysqli_query($bd2, $sqlll) or die(mysqli_error($bd2));
?>
<?php
if($_GET['action']=="kerosakan")
{
    ?>
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Borang Kerosakan</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
                        <li class="active">Borang Kerosakan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Maklumat Kerosakan
                </div>
                <div class="card-body">
                    <div class="panel-body">
                        <form method="POST" action="admin/add_kerosakan.php" name="kerosakan" id="kerosakan">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!--KOD PERALATAN-->
                                    <div class="form-group">
                                        <label>Maklumat Peralatan</label>
                                        <select class="form-control" name="id_peralatan" id="id_peralatan" required>
                                            <option value="">Sila Pilih Peralatan</option>
                                            <?php
                                            while($row_list_kod = mysqli_fetch_assoc($list_kod))
                                            {
                                                ?>
                                                <option value="<?php echo($row_list_kod['id_inventori']); ?>"><?php echo($row_list_kod['kod_peralatan']); ?> - <?php echo $row_list_kod['nama_peralatan']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!--NAMA PERALATAN (DISPLAY)-->
                                    <!--                                <div class="form-group">-->
                                    <!--                                    <label>Nama Peralatan</label>-->
                                    <!--                                    <input class="form-control" name="nama_peralatan" id="nama_peralatan" readonly>-->
                                    <!--                                </div>-->
                                    <!--KATEGORI PERALATAN (DISPLAY)-->
                                    <!--                                <div class="form-group">-->
                                    <!--                                    <label>Kategori Peralatan</label>-->
                                    <!--                                    <input class="form-control" name="jenis_peralatan" id="jenis_peralatan" readonly>-->
                                    <!--                                </div>-->
                                    <!--PENYELENGGARA-->
                                    <!--KUANTITI & UNIT KUANTITI-->
                                    <div class="form-group">
                                        <label>Kuantiti & Unit Kuantiti</label>
                                        <br>
                                        <input type="text" class="form-control" name="kuantiti" id="kuantiti" placeholder="Kuantiti" style="width:237px" required>
                                        &nbsp;
                                        <select class="form-control" name="kuantiti_unit" id="kuantiti_unit" style="width:237px" required>
                                            <option>Unit Kuantiti</option>
                                            <option value="Batang">Batang</option>
                                            <option value="Berkas">Berkas</option>
                                            <option value="Bidang">Bidang</option>
                                            <option value="Biji">Biji</option>
                                            <option value="Bilah">Bilah</option>
                                            <option value="Buah">Buah</option>
                                            <option value="Buku">Buku</option>
                                            <option value="Ekor">Ekor</option>
                                            <option value="Gelung">Gelung</option>
                                            <option value="Gulung">Gulung</option>
                                            <option value="Helai">Helai</option>
                                            <option value="Ikat">Ikat</option>
                                            <option value="Kampit">Kampit</option>
                                            <option value="Keping">Keping</option>
                                            <option value="Kotak">Kotak</option>
                                            <option value="Papan">Papan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Penyelenggara Yang Bertanggunjawab</label>
                                        <select class="form-control" name="id_penyelenggara" id="id_penyelenggara" required>
                                            <option value="">Sila Pilih</option>
                                            <?php
                                            while($row_list_penyelenggara = mysqli_fetch_assoc($list_penyelenggara))
                                            {
                                                ?>
                                                <option value="<?php echo($row_list_penyelenggara['id_penyelenggara']); ?>"><?php echo($row_list_penyelenggara['nama_penyelenggara']); ?> - <?php echo strtoupper(($row_list_penyelenggara['kat_penyelenggara'])); ?> </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!--TAHAP KEROSAKAN-->
                                    <div class="form-group">
                                        <label>Tahap Kerosakan</label>
                                        <select class="form-control" name="tahap_kerosakan" id="tahap_kerosakan" required>
                                            <option>Sila Pilih Tahap Kerosakan</option>
                                            <option value="Segera">Perlu Perhatian Segera</option>
                                            <option value="Biasa">Kerosakan Biasa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!--TARIKH KEROSAKAN & MASA-->
                                    <div class="form-group">
                                        <label>Tarikh & Masa Kerosakan</label>
                                        <br>
                                        <input class="form-control" type="date" name="tarikh_kerosakan" style="width:237px" required>
                                        &nbsp;
                                        <input class="form-control" type="time" name="masa_kerosakan" style="width:237px" required>
                                    </div>
                                    <!--LOKASI PERALATAN-->
                                    <div class="form-group">
                                        <label>Lokasi Peralatan</label>
                                        <input class="form-control" name="lokasi_kerosakan" id="lokasi_kerosakan" oninput="this.value = this.value.toUpperCase()" required>
                                    </div>
                                    <!--PENGESAHAN KEROSAKAN-->
                                    <div class="form-group">
                                        <label>Pengesahan Kerosakan Oleh</label>
                                        <select class="form-control" name="id_pengesah" id="id_pengesah" required>
                                            <option value="">Sila Pilih Pegawai</option>
                                            <?php
                                            while($row_list_ajk = mysqli_fetch_assoc($list_ajk))
                                            {
                                                ?>
                                                <option value="<?php echo($row_list_ajk['id_dataajk']); ?>"><?php echo($row_list_ajk['nama_penuh']); ?> - <?php echo $row_list_ajk['jawatan']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!--CATATAN-->
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <textarea class="form-control" rows="2" name="catatan"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12" align="center">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-primary">Padam</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--semak_maklumatinventori-->
<?php
require_once('../connection/connection.php');
// Connect to server and select database.

$itemValue = $_GET['itemValue'];
getItemDetails($itemValue);
function getItemDetails($itemValue) {

    // Prepare and execute a query to retrieve item details
    $q = "SELECT a.nama_peralatan, b.jenis_inventori as jenis_peralatan FROM sej6x_data_inventori a LEFT JOIN sej6x_data_jenisinventori b ON a.jenis_peralatan = b.id_jenisinventori WHERE a.id_inventori = '$itemValue'";
    $stmt = mysqli_query($bd2, $q);
    $result = mysqli_fetch_array($stmt);
    foreach($result as $key){
        $arrayDetails = array(
            "name" => $key['nama_peralatan'],
            "type" => $key['jenis_peralatan']
        );
    }
//    mysqli_stmt_bind_param($stmt,"i", $itemValue);
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $nama_peralatan, $jenis_peralatan);

    // Create a new XML document
    $xml = new DOMDocument('1.0', 'UTF-8');


    // Create the root element
    $itemDetails = $xml->createElement('itemDetails');
    $xml->appendChild($itemDetails);


    /// Fetch the result
    if (mysqli_stmt_fetch($stmt)) {
        // Create XML elements for the item details
        //echo $nama_peralatan;

        $nameElement = $xml->createElement('name', $nama_peralatan);
        $typeElement = $xml->createElement('type', $jenis_peralatan);

        // Append the elements to the root element
        $itemDetails->appendChild($nameElement);
        $itemDetails->appendChild($typeElement);

    }

    $arrayTest = array(
        "Query" => $q
    );

    // Set the response header to indicate XML content
    //header('Content-Type: application/xml');

    // Output the XML
    // echo $xml->saveXML();
    $json_encodes = json_encode($arrayDetails);
    echo $json_encodes;

    // Close the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($bd2);

}
?>
<script>
    function displayItemDetails() {
        var itemSelect = document.getElementById("id_peralatan");
        var itemDetails = document.getElementById("itemDetails");


        if (itemSelect.value === "") {
            itemDetails.style.display = "none";
        } else {
            console.log("selectedItem");
            // Retrieve the item details based on the selected value
            var selectedItem = getItemDetails(itemSelect.value);

            if (itemDetails) {
                var itemName = document.getElementById("nama_peralatan");
                var itemType = document.getElementById("jenis_peralatan");

                itemName.textContent = selectedItem.name;
                itemType.textContent = selectedItem.type;

                itemDetails.style.display = "block";
            }

        }
    }

    function getItemDetails(itemValue) {
        // AJAX request to fetch item details from the server-side script
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "admin/semak_maklumatinventori.php?itemValue=" + itemValue, false);
        xhr.send();

        if (xhr.status === 200) {
            var xmlDoc = xhr.responseXML;
            var nameElement = xmlDoc.getElementsByTagName("name")[0];
            var typeElement = xmlDoc.getElementsByTagName("type")[0];

            var itemDetails = {};

            if (nameElement && typeElement) {
                itemDetails.name = nameElement.textContent;
                itemDetails.type = typeElement.textContent;
            }

            return itemDetails;
        } else {
            console.log("Error retrieving item details");
            return null;
        }
    }


</script>
<!--daftarorganisasi-->
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Borang Daftar Organisasi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=">Menu Organisasi</a></li>
                    <li><a href="utama.php?view=admin&action=">Daftar Rekod Organisasi Masjid</a></li>
                    <li class="active">Butiran Rekod Organisasi Masjid</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Daftar Ahli Organisasi
                </div>
                <?php

                include("connection/connection.php");

                if(isset($_GET['idrekod'])){
                    $id_rekod = $_GET['idrekod']; //tukar bagi pakai ic

                    $sql_search = "SELECT data_ajkmasjid.id_dataajk 'idrekod', sej6x_data_peribadi.nama_penuh, sej6x_data_peribadi.no_ic, sej6x_data_peribadi.no_hp 'no_tel', data_ajkmasjid.jawatan 
                       FROM data_ajkmasjid LEFT JOIN sej6x_data_peribadi ON data_ajkmasjid.id_ajk = sej6x_data_peribadi.id_data WHERE data_ajkmasjid.id_dataajk = '$id_rekod' AND sej6x_data_peribadi.id_masjid = $id_masjid
                       UNION
                       SELECT data_pegawai_masjid.id_datapegawai 'idrekod', sej6x_data_peribadi.nama_penuh, sej6x_data_peribadi.no_ic, sej6x_data_peribadi.no_hp 'no_tel', data_pegawai_masjid.jawatan 
                       FROM data_pegawai_masjid LEFT JOIN sej6x_data_peribadi ON data_pegawai_masjid.id_pegawai = sej6x_data_peribadi.id_data WHERE data_pegawai_masjid.id_datapegawai = '$id_rekod' AND sej6x_data_peribadi.id_masjid = $id_masjid
                       UNION
                       SELECT data_pengurusan_masjid.id_pengurusan 'idrekod', data_pengurusan_masjid.nama_penuh, data_pengurusan_masjid.no_ic, data_pengurusan_masjid.no_tel, jawatan_pengurusan_masjid.jawatan 
                       FROM data_pengurusan_masjid LEFT JOIN jawatan_pengurusan_masjid ON data_pengurusan_masjid.jawatan = jawatan_pengurusan_masjid.id_jawatan WHERE data_pengurusan_masjid.id_pengurusan = '$id_rekod' AND data_pengurusan_masjid.id_masjid = $id_masjid
                       UNION
                       SELECT data_ajkmasjid.id_dataajk 'idrekod', sej6x_data_anakqariah.nama_penuh, sej6x_data_anakqariah.no_ic, sej6x_data_anakqariah.no_tel, data_ajkmasjid.jawatan 
                       FROM data_ajkmasjid LEFT JOIN sej6x_data_anakqariah ON data_ajkmasjid.id_ajk2 = sej6x_data_anakqariah.ID WHERE data_ajkmasjid.id_dataajk = '$id_rekod' AND sej6x_data_anakqariah.id_masjid = $id_masjid
                       UNION
                       SELECT data_pegawai_masjid.id_datapegawai 'idrekod', sej6x_data_anakqariah.nama_penuh, sej6x_data_anakqariah.no_ic, sej6x_data_anakqariah.no_tel, data_pegawai_masjid.jawatan 
                       FROM data_pegawai_masjid LEFT JOIN sej6x_data_anakqariah ON data_pegawai_masjid.id_pegawai2 = sej6x_data_anakqariah.ID WHERE data_pegawai_masjid.id_datapegawai = '$id_rekod' AND sej6x_data_anakqariah.id_masjid = $id_masjid
                       UNION
                       SELECT data_pengurusan_masjid.id_pengurusan 'idrekod', data_pengurusan_masjid.nama_penuh, data_pengurusan_masjid.no_ic, data_pengurusan_masjid.no_tel, jawatan_pengurusan_masjid.jawatan 
                       FROM data_pengurusan_masjid LEFT JOIN jawatan_pengurusan_masjid ON data_pengurusan_masjid.jawatan = jawatan_pengurusan_masjid.id_jawatan WHERE data_pengurusan_masjid.id_pengurusan = '$id_rekod' AND data_pengurusan_masjid.id_masjid = $id_masjid";


                    $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));

                    ?>
                    <!--ada rekod-->
                    <div class="card-body">
                        <form action="admin/add_organisasi.php" method='post' enctype="multipart/form-data">
                            <div class="row">
                                <?php if($row = mysqli_fetch_assoc($result)) { ?>
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label>No Pengenalan</label>
                                                <input type="text" name="no_ic" minlength="12" maxlength="12" value="<?php echo $row['no_ic']; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <form id="myForm" method="GET">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Kategori Jawatankuasa</label>
                                                    <select class="form-control" name="kat_jawatan" id="kat_jawatan" onchange="updateSecondTextBox()" required>
                                                        <option value =""></option>
                                                        <option value ="ajk">Ahli Jawatankuasa Masjid</option>
                                                        <option value ="pegawai">Pegawai Masjid</option>
                                                        <option value ="pengurusan">Pengurusan Masjid</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="col-lg-6">
                                            <!--select-->
                                            <div class="form-group">
                                                <label>Jawatan</label>
                                                <select class="form-control" name="id_jawatankuasa" id="id_jawatankuasa" required>
                                                    <?php
                                                    $kat_jawatankuasa = $_GET['kat_jawatankuasa'];
                                                    $sqll = "SELECT id_jawatankuasa, jawatan, ajk_biro FROM jawatankuasa_organisasi WHERE kat_jawatankuasa = '$kat_jawatankuasa' AND id_masjid = '0' OR kat_jawatankuasa = '$kat_jawatankuasa' AND id_masjid='$id_masjid'";
                                                    $list_jawatankuasa = mysqli_query($bd2, $sqll) or die(mysqli_error($bd2));
                                                    ?>
                                                    <option value=""></option>
                                                    <?php
                                                    while($row_list_jawatankuasa = mysqli_fetch_assoc($list_jawatankuasa))
                                                    {
                                                        ?>
                                                        <option value="<?php echo($row_list_jawatankuasa['id_jawatankuasa']); ?>"><?php if($row_list_jawatankuasa['id_jawatankuasa']==='ajk') { echo($row_list_jawatankuasa['id_jawatankuasa']); ?> - <?php echo($row_list_jawatankuasa['ajk_biro']); } else { echo($row_list_jawatankuasa['id_jawatankuasa']);} ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Alamat e-mel</label>
                                                <input class="form-control" type="email" name="emel" id="emel" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Tarikh Lantikan</label>
                                                <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Muat-Naik Gambar</label>
                                                <input id="gambar" name="gambar" class="form-control" type="file" accept=".jpg,.gif,.png,.jpeg" onchange="preview_image(event, 'output1')">
                                                <img class="img-fluid p-3" id="output1" src="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <center>
                                                <div class="form-group">
                                                    <br>
                                                    <input type="hidden" name="id_rekod" value="<?php echo $row['idrekod']; ?>">
                                                    <input type="hidden" name="ada_rekod" value="1">
                                                    <input type="submit"  value="Simpan" class="btn btn-primary">
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                    <?php
                                }
                                else if(!isset($_GET['idrekod'])){
                                    ?>
                                    <!--tak ada rekod-->
                                    <div class="card-body">
                                        <form action="admin/add_organisasi.php" method='post' enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <div class="form-group">
                                                        <label>No Pengenalan</label>
                                                        <input type="text" name="no_ic" minlength="12" maxlength="12" value="<?php echo $_GET['no_ic']; ?>" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <form id="myForm" method="GET">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Kategori Jawatankuasa</label>
                                                            <select class="form-control" name="kat_jawatan" id="kat_jawatan" onchange="updateSecondTextBox()" required>
                                                                <option value =""></option>
                                                                <option value ="ajk">Ahli Jawatankuasa Masjid</option>
                                                                <option value ="pegawai">Pegawai Masjid</option>
                                                                <option value ="pengurusan">Pengurusan Masjid</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="col-lg-6">
                                                    <!--select-->
                                                    <div class="form-group">
                                                        <label>Jawatan</label>
                                                        <select class="form-control" name="id_jawatankuasa" id="id_jawatankuasa" required>
                                                            <?php
                                                            $kat_jawatankuasa = $_GET['kat_jawatankuasa'];
                                                            $sqll = "SELECT id_jawatankuasa, jawatan, ajk_biro FROM jawatankuasa_organisasi WHERE kat_jawatankuasa = '$kat_jawatankuasa' AND id_masjid = '0' OR kat_jawatankuasa = '$kat_jawatankuasa' AND id_masjid='$id_masjid'";
                                                            $list_jawatankuasa = mysqli_query($bd2, $sqll) or die(mysqli_error($bd2));
                                                            ?>
                                                            <option value=""></option>
                                                            <?php
                                                            while($row_list_jawatankuasa = mysqli_fetch_assoc($list_jawatankuasa))
                                                            {
                                                                ?>
                                                                <option value="<?php echo($row_list_jawatankuasa['id_jawatankuasa']); ?>"><?php if($row_list_jawatankuasa['id_jawatankuasa']==='ajk') { echo($row_list_jawatankuasa['id_jawatankuasa']); ?> - <?php echo($row_list_jawatankuasa['ajk_biro']); } else { echo($row_list_jawatankuasa['id_jawatankuasa']);} ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Alamat e-mel</label>
                                                        <input class="form-control" type="email" name="emel" id="emel" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Tarikh Lantikan</label>
                                                        <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Muat-Naik Gambar</label>
                                                        <input id="gambar" name="gambar" class="form-control" type="file" accept=".jpg,.gif,.png,.jpeg" onchange="preview_image(event, 'output1')">
                                                        <img class="img-fluid p-3" id="output1" src="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <center>
                                                        <div class="form-group">
                                                            <br>
                                                            <input type="hidden" name="id_rekod" value="<?php echo $row['idrekod']; ?>">
                                                            <input type="hidden" name="ada_rekod" value="0">
                                                            <input type="submit"  value="Simpan" class="btn btn-primary">
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script>
    function submitForm() {
        document.getElementById("myForm").submit();
    }
</script>
<!--addrekodorganisasi-->
<?php
include("../connection/connection.php");
include("../fungsi.php");
// INSERT

if (isset($_POST['id_rekod'])) {

    if(isset($_POST['nama_penuh']) AND isset($_POST['no_ic']) AND isset($_POST['no_tel']) AND isset($_POST['jawatan']) AND isset($_POST['id_rekod'])){

        $id_rekod = $_POST['id_rekod'];
        $nama_penuh = e($_POST['nama_penuh'], 1, NULL);
        $nama_penuh = str_replace("'","''",$nama_penuh);
        $no_ic = e($_POST['no_ic'], NULL, NULL);
        $no_tel = e($_POST['no_tel'], NULL, NULL);
        $jawatan = e($_POST['jawatan'], 1, NULL);
        $tarikh_lantikan = e($_POST['tarikh_lantikan'], NULL, NULL);
        $tarikh_perletakan = e($_POST['tarikh_perletakan'], NULL, NULL);
        $sebab_perletakan = e($_POST['sebab_perletakan'], NULL, NULL);

        $sql1 = "INSERT INTO rekod_organisasi ( id_rekod, id_masjid, nama_penuh, no_pengenalan, no_telefon, jawatan, tarikh_lantikan, tarikh_perletakan, sebab_perletakan, time_added) 
                     VALUES ('$id_rekod', $id_masjid, '$nama_penuh', '$no_ic', '$no_tel', '$jawatan', '$tarikh_lantikan', '$tarikh_perletakan', '$sebab_perletakan', NOW() ) ";
    }
    else {

        $id_rekod = $_POST['idrekod'];
        $nama_penuh = e($_POST['nama_penuh'], 1, NULL);
        $nama_penuh = str_replace("'","''",$nama_penuh);
        $no_ic = e($_POST['no_ic'], NULL, NULL);
        $no_tel = e($_POST['no_tel'], NULL, NULL);
        $jawatan = e($_POST['jawatan'], 1, NULL);
        $tarikh_lantikan = e($_POST['tarikh_lantikan'], NULL, NULL);
        $tarikh_letakan = e($_POST['tarikh_letakan'], NULL, NULL);
        $sebab_letakan = e($_POST['sebab_letakan'], NULL, NULL);

        $sql1 = "INSERT INTO rekod_organisasi ( id_rekod, id_masjid, nama_penuh, no_pengenalan, no_telefon, jawatan, tarikh_lantikan, tarikh_perletakan, sebab_perletakan, time_added) 
                     VALUES ('$id_rekod', $id_masjid, '$nama_penuh', '$no_ic', '$no_tel', '$jawatan', '$tarikh_lantikan', '$tarikh_letakan', '$sebab_letakan', NOW() ) ";
    }
    mysqli_query($bd2, $sql1) or die(mysqli_error($bd2));

    header("Location: ../utama.php?view=admin&action=");

}
?>
<!--daftar organisasi upload file nabil-->
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Daftar Organisasi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=semakorganisasi&sideMenu=organisasi">Semak Organisasi</a></li>
                    <li class="active">Daftar Organisasi</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Daftar Maklumat
                </div>
                <?php

                include("connection/connection.php");

                if(isset($_GET['idrekod'])){
                    $id_rekod = $_GET['idrekod'];

                    $sql_search = "SELECT data_ajkmasjid.id_dataajk 'idrekod', sej6x_data_peribadi.nama_penuh, sej6x_data_peribadi.jenisPengenalan, sej6x_data_peribadi.no_ic, sej6x_data_peribadi.no_hp 'no_tel', data_ajkmasjid.jawatan 
                       FROM data_ajkmasjid LEFT JOIN sej6x_data_peribadi ON data_ajkmasjid.id_ajk = sej6x_data_peribadi.id_data WHERE data_ajkmasjid.id_dataajk = '$id_rekod' AND sej6x_data_peribadi.id_masjid = $id_masjid
                       UNION
                       SELECT data_pegawai_masjid.id_datapegawai 'idrekod', sej6x_data_peribadi.nama_penuh, sej6x_data_peribadi.jenisPengenalan, sej6x_data_peribadi.no_ic, sej6x_data_peribadi.no_hp 'no_tel', data_pegawai_masjid.jawatan 
                       FROM data_pegawai_masjid LEFT JOIN sej6x_data_peribadi ON data_pegawai_masjid.id_pegawai = sej6x_data_peribadi.id_data WHERE data_pegawai_masjid.id_datapegawai = '$id_rekod' AND sej6x_data_peribadi.id_masjid = $id_masjid
                       UNION
                       SELECT data_pengurusan_masjid.id_pengurusan 'idrekod', data_pengurusan_masjid.nama_penuh, data_pengurusan_masjid.jenisPengenalan, data_pengurusan_masjid.no_ic, data_pengurusan_masjid.no_tel, jawatan_pengurusan_masjid.jawatan 
                       FROM data_pengurusan_masjid LEFT JOIN jawatan_pengurusan_masjid ON data_pengurusan_masjid.jawatan = jawatan_pengurusan_masjid.id_jawatan WHERE data_pengurusan_masjid.id_pengurusan = '$id_rekod' AND data_pengurusan_masjid.id_masjid = $id_masjid
                       UNION
                       SELECT data_ajkmasjid.id_dataajk 'idrekod', sej6x_data_anakqariah.nama_penuh, sej6x_data_anakqariah.jenisPengenalan, sej6x_data_anakqariah.no_ic, sej6x_data_anakqariah.no_tel, data_ajkmasjid.jawatan 
                       FROM data_ajkmasjid LEFT JOIN sej6x_data_anakqariah ON data_ajkmasjid.id_ajk2 = sej6x_data_anakqariah.ID WHERE data_ajkmasjid.id_dataajk = '$id_rekod' AND sej6x_data_anakqariah.id_masjid = $id_masjid
                       UNION
                       SELECT data_pegawai_masjid.id_datapegawai 'idrekod', sej6x_data_anakqariah.nama_penuh, sej6x_data_anakqariah.jenisPengenalan, sej6x_data_anakqariah.no_ic, sej6x_data_anakqariah.no_tel, data_pegawai_masjid.jawatan 
                       FROM data_pegawai_masjid LEFT JOIN sej6x_data_anakqariah ON data_pegawai_masjid.id_pegawai2 = sej6x_data_anakqariah.ID WHERE data_pegawai_masjid.id_datapegawai = '$id_rekod' AND sej6x_data_anakqariah.id_masjid = $id_masjid
                       UNION
                       SELECT data_pengurusan_masjid.id_pengurusan 'idrekod', data_pengurusan_masjid.nama_penuh, data_pengurusan_masjid.jenisPengenalan, data_pengurusan_masjid.no_ic, data_pengurusan_masjid.no_tel, jawatan_pengurusan_masjid.jawatan 
                       FROM data_pengurusan_masjid LEFT JOIN jawatan_pengurusan_masjid ON data_pengurusan_masjid.jawatan = jawatan_pengurusan_masjid.id_jawatan WHERE data_pengurusan_masjid.id_pengurusan = '$id_rekod' AND data_pengurusan_masjid.id_masjid = $id_masjid";

                    $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));

                    ?>
                    <div class="card-body">
                        <form action="admin/add_organisasi.php" method='post' enctype="multipart/form-data">
                            <?php while($row = mysqli_fetch_assoc($result)) {?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Penuh</label>
                                            <input type="text" name="nama_penuh" id="nama_penuh" value="<?php echo $row['nama_penuh']; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>No Pengenalan</label>
                                            <input type="text" name="no_pengenalan" id="no_pengenalan" minlength="12" maxlength="12" value="<?php echo $row['no_ic']; ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>No. Telefon</label>
                                            <input class="form-control" type="text" name="no_telefon" id="no_telefon" value="<?php echo $row['no_tel']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Alamat e-mel</label>
                                            <input class="form-control" type="email" name="emel" id="emel" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Kategori Jawatankuasa</label>
                                            <select class="form-control" name="kat_jawatan" id="kat_jawatan" required>
                                                <option value =""></option>
                                                <option value ="ajk">Ahli Jawatankuasa Masjid</option>
                                                <option value ="pegawai">Pegawai Masjid</option>
                                                <option value ="pengurusan">Pengurusan Masjid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!--select-->
                                        <div class="form-group" id="id_jawatankuasaDiv">
                                            <label>Jawatan</label>
                                            <select class="form-control" name="id_jawatankuasa" id="id_jawatankuasa" required>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Tarikh Lantikan</label>
                                            <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Muatnaik Dokumen</label>
                                            <input type="file" class="form-control" name="file" id="file" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <center>
                                            <div class="form-group">
                                                <input type="hidden" name="jenisPengenalan" value="<?php echo $row['jenisPengenalan']; ?>">
                                                <input type="hidden" name="id_rekod" value="<?php echo $row['idrekod']; ?>">
                                                <input type="submit"  value="Daftar" class="btn btn-primary">
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            <?php }?>
                        </form>
                    </div>
                    <?php
                }
                else if(!isset($_GET['idrekod'])){
                    ?>
                    <div class="card-body">
                        <form action="admin/add_organisasi.php" method='post' enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nama Penuh</label>
                                        <input type="text" name="nama_penuh" id="nama_penuh" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>No Pengenalan</label>
                                        <input type="text" name="no_ic" id="no_ic" minlength="12" maxlength="12" value="<?php echo $_GET['no_ic']; ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>No. Telefon</label>
                                        <input class="form-control" type="text" name="no_tel" id="no_tel" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Alamat e-mel</label>
                                        <input class="form-control" type="email" name="emel" id="emel" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Kategori Jawatankuasa</label>
                                        <select class="form-control" name="kat_jawatan" id="kat_jawatan" required>
                                            <option value =""></option>
                                            <option value ="ajk">Ahli Jawatankuasa Masjid</option>
                                            <option value ="pegawai">Pegawai Masjid</option>
                                            <option value ="pengurusan">Pengurusan Masjid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!--select-->
                                    <div class="form-group" id="id_jawatankuasaDiv">
                                        <label>Jawatan</label>
                                        <select class="form-control" name="id_jawatankuasa" id="id_jawatankuasa" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tarikh Lantikan</label>
                                        <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Muatnaik Dokumen</label>
                                        <input type="file" class="form-control" name="file" id="file" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <center>
                                        <div class="form-group">
                                            <input type="hidden" name="id_rekod" value="<?php echo $_GET['jenisPengenalan']; ?>">
                                            <input type="hidden" name="id_rekod" value="<?php echo $row['idrekod']; ?>">
                                            <input type="submit"  value="Daftar" class="btn btn-primary">
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
        $('#kat_jawatan').change(function() {
            var selectedOption = $(this).val();
            if (selectedOption !== '') {
                // Make an AJAX request to retrieve the options for the dynamic select box
                $.ajax({
                    url: './admin/ajax_daftarorganisasi.php',
                    type: 'POST',
                    data: { "option": selectedOption },
                    // contentType: "application/json;charset=utf-8",
                    // dataType: "json",
                    success: function(response) {
                        // Assuming the response is an array of options
                        console.log(response);
                        var options = JSON.parse(response);

                        // Clear the dynamic select box
                        $('#id_jawatankuasa').empty();

                        // Add the new options
                        $('#id_jawatankuasa').append('<option value=""></option>'); // Empty option

                        for (var i = 0; i < options.length; i++) {
                            var optionValue = options[i].value;
                            var optionLabel = options[i].label;
                            var optionLabel2 = options[i].label2;

                            var displayLabel = '';

                            if (optionLabel2 && optionLabel2 !== 'null') {
                                displayLabel = optionLabel.toUpperCase() + ' - ' + optionLabel2.toUpperCase();
                            } else {
                                displayLabel = optionLabel.toUpperCase();
                            }

                            $('#id_jawatankuasa').append('<option value="' + optionValue + '">' + displayLabel + '</option>');
                        }

                        // Show the dynamic select box
                        $('#id_jawatankuasaDiv').show();
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Handle the error appropriately
                    }
                });
            } else {
                // Hide the dynamic select box if no option is selected
                $('#id_jawatankuasaDiv').hide();
            }
        });
    });
</script>
<!--add organisasi upload file nabil-->
<?php
include("../connection/connection.php");
include("../fungsi.php");
// INSERT

if (isset($_POST['id_rekod'])) {

    $id_rekod = $_POST['id_rekod'];
    $nama_penuh = e($_POST['nama_penuh'], 1, NULL);
    $nama_penuh = str_replace("'","''",$nama_penuh);
    $jenisPengenalan = e($_POST['jenisPengenalan'], NULL, NULL);
    $no_pengenalan = e($_POST['no_pengenalan'], NULL, NULL);
    $no_telefon = e($_POST['no_telefon'], NULL, NULL);
    $emel = e($_POST['emel'], NULL, NULL);
    $kat_jawatan = e($_POST['kat_jawatan'], NULL, NULL);
    $id_jawatankuasa = e($_POST['id_jawatankuasa'], NULL, NULL);
    $tarikh_lantikan = e($_POST['tarikh_lantikan'], NULL, NULL);

    $sqljawatan = "SELECT jawatan, ajk_biro FROM jawatankuasa_organisasi WHERE id_jawatankuasa = '$id_jawatankuasa'";
    $result = mysqli_query($bd2,$sqljawatan) or die(mysqli_error($bd2));
    $row = mysqli_fetch_assoc($result);
    $jawatan = $row['jawatan'];
    $ajk_biro = $row['ajk_biro'];

//        $ada_dokumen = 0;
//        if($_FILES['dokumen']['error'] != 4) {
//            $dokumen = e(base64_encode(file_get_contents(addslashes($_FILES['dokumen']['tmp_name']))), NULL, NULL);
//            $image = getimagesize(e($_FILES['dokumen']['tmp_name']));//to know about image type etc
//            $jenis_dokumen = $image['mime'];
//            $ada_dokumen = 1;
//        }

//        if (isset($name)) {
//
//            $path= 'https://masjidpro.com/Masjid/Uploads/rekod_organisasi/';
//
//            if (!empty($name)){
//
//                $movefile = move_uploaded_file($tmp_name, $path.$newname);
////                echo $movefile;
////                exit;
//                if ($movefile) {
//                    echo 'Berjaya!';
//
//                }
//            }
//        }
    $name= $_FILES['file']['name'];
    $info = pathinfo($_FILES['file']['name']);
    $newname = "file1.".$info['extension'];

    $tmp_name= $_FILES['file']['tmp_name'];

    $submitbutton= $_POST['submit'];

    $position= strpos($name, ".");

    $fileextension= substr($name, $position + 1);

    $fileextension= strtolower($fileextension);

    $target_dir = "../Uploads/rekod_organisasi/";
    $target_file = $target_dir . basename($_FILES['file']['name']);

    if (move_uploaded_file($tmp_name, $target_file)) {
        echo "The file " . basename($_FILES["file"]["$name"]) . " has been uploaded.";

    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $sql1 = "INSERT INTO rekod_organisasi ( id_rekod, id_masjid, nama_penuh, no_pengenalan, no_telefon, emel, kategori_jawatankuasa, jawatan, ajk_biro, tarikh_lantikan, dokumen) 
                    VALUES ('$id_rekod', '$id_masjid', '$nama_penuh', '$no_pengenalan', '$no_telefon', '$emel', '$kat_jawatan', '$jawatan', '$ajk_biro', '$tarikh_lantikan', '$name')";
    mysqli_query($bd2, $sql1) or die(mysqli_error($bd2));

    header("Location: ../utama.php?view=admin&action=semakorganisasi&sideMenu=organisasi");

} else {

    $id_rekod = 0;
    $nama_penuh = e($_POST['nama_penuh'], 1, NULL);
    $nama_penuh = str_replace("'","''",$nama_penuh);
    $jenisPengenalan = e($_POST['jenisPengenalan'], NULL, NULL);
    $no_pengenalan = e($_POST['no_pengenalan'], NULL, NULL);
    $no_telefon = e($_POST['no_telefon'], NULL, NULL);
    $emel = e($_POST['emel'], NULL, NULL);
    $kat_jawatan = e($_POST['kat_jawatan'], NULL, NULL);
    $id_jawatankuasa = e($_POST['id_jawatankuasa'], NULL, NULL);
    $tarikh_lantikan = e($_POST['tarikh_lantikan'], NULL, NULL);

    $sqljawatan = "SELECT jawatan, ajk_biro FROM jawatankuasa_organisasi WHERE id_jawatankuasa = '$id_jawatankuasa'";
    $result = mysqli_query($bd2,$sqljawatan) or die(mysqli_error($bd2));
    $row = mysqli_fetch_assoc($result);
    $jawatan = $row['jawatan'];
    $ajk_biro = $row['ajk_biro'];

//        $ada_dokumen = 0;
//        if($_FILES['dokumen']['error'] != 4) {
//            $dokumen = e(base64_encode(file_get_contents(addslashes($_FILES['dokumen']['tmp_name']))), NULL, NULL);
//            $image = getimagesize(e($_FILES['dokumen']['tmp_name']));//to know about image type etc
//            $jenis_dokumen = $image['mime'];
//            $ada_dokumen = 1;
//        }

    $name= $_FILES['file']['name'];
    $info = pathinfo($_FILES['file']['name']);
    $newname = "file1.".$info['extension'];

    $tmp_name= $_FILES['file']['tmp_name'];

    $submitbutton= $_POST['submit'];

    $position= strpos($name, ".");

    $fileextension= substr($name, $position + 1);

    $fileextension= strtolower($fileextension);

    $target_dir = "../Uploads/rekod_organisasi/";
    $target_file = $target_dir . basename($_FILES['file']['name']);

    if (move_uploaded_file($tmp_name, $target_file)) {
        echo "The file " . basename($_FILES["file"]["$name"]) . " has been uploaded.";

    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $sql2 = "INSERT INTO rekod_organisasi ( id_rekod, id_masjid, nama_penuh, no_pengenalan, no_telefon, emel, kategori_jawatankuasa, jawatan, ajk_biro, tarikh_lantikan, dokumen) 
                    VALUES ('$id_rekod', '$id_masjid', '$nama_penuh', '$no_pengenalan', '$no_telefon', '$emel', '$kat_jawatan', '$jawatan', '$ajk_biro', '$tarikh_lantikan', '$name')";
    mysqli_query($bd2, $sql2) or die(mysqli_error($bd2));

    header("Location: ../utama.php?view=admin&action=semakorganisasi&sideMenu=organisasi");

}

?>
<!--edit_jawatankuasa-->
<?php

include("connection/connection.php");

if(isset($_GET['id_organisasi'])){
$id_organisasi = $_GET['id_organisasi'];
$nokuasa=$_GET['nokuasa'];

$sql_search = "SELECT id, id_rekod, id_masjid, nama_penuh, jenisPengenalan, no_pengenalan, no_telefon, emel, id_jawatankuasa, kategori_jawatankuasa, jawatan, ajk_biro, tarikh_lantikan, tarikh_perletakan, sebab_perletakan, gambar, jenis_gambar FROM rekod_organisasi WHERE id_masjid = '$id_masjid' AND id = '$id_organisasi'";

$result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));

?>
<div class="breadcrumbs">
    <div class="col-sm-8">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Kemaskini Organisasi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Kemaskini Organisasi</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10">
                            Kemaskini Maklumat Ahli
                        </div>
                        <div class="col-lg-2" align="end">
                            <?php if($nokuasa == '1'){?>
                                <a href="utama.php?view=admin&action=senaraiJawatankuasa_AJK&sideMenu=organisasi"><button class="btn btn-danger">Batal</button></a>
                            <?php } else if($nokuasa == '2') { ?>
                                <a href="utama.php?view=admin&action=senaraiJawatankuasa_PEGAWAI&sideMenu=organisasi"><button class="btn btn-danger">Batal</button></a>
                            <?php } else {?>
                                <a href="utama.php?view=admin&action=senaraiJawatankuasa_PENGURUSAN&sideMenu=organisasi"><button class="btn btn-danger">Batal</button></a>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="admin/update_jawatankuasa.php" method='post' enctype="multipart/form-data">
                        <?php while($row = mysqli_fetch_assoc($result)) {?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nama Penuh</label>
                                        <input type="text" name="nama_penuh" id="nama_penuh" value="<?php echo $row['nama_penuh']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>No Pengenalan</label>
                                        <input type="text" name="no_pengenalan" id="no_pengenalan" minlength="12" maxlength="12" value="<?php echo $row['no_pengenalan']; ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>No. Telefon</label>
                                        <input class="form-control" type="text" name="no_telefon" id="no_telefon" value="<?php echo $row['no_telefon']; ?>" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Alamat e-mel</label>
                                        <input class="form-control" type="email" name="emel" id="emel" value="<?php echo $row['emel']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Kategori Jawatankuasa</label>
                                        <select class="form-control" name="kategori_jawatankuasa" id="kategori_jawatankuasa" required>
                                            <option value =""></option>
                                            <option value ="ajk" <?php if($row['kategori_jawatankuasa']=='ajk') { echo "selected"; } ?>>Ahli Jawatankuasa Masjid</option>
                                            <option value ="pegawai" <?php if($row['kategori_jawatankuasa']=='pegawai') { echo "selected"; } ?>>Pegawai Masjid</option>
                                            <option value ="pengurusan" <?php if($row['kategori_jawatankuasa']=='pengurusan') { echo "selected"; } ?>>Pengurusan Masjid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!--select-->
                                    <div class="form-group" id="id_jawatankuasaDiv">
                                        <label>Jawatan</label>
                                        <select class="form-control" name="id_jawatankuasa" id="id_jawatankuasa" >
                                            <option value=""></option>
                                            <?php
                                            $kat_jawatankuasa =$row['kategori_jawatankuasa'];
                                            $sql = "SELECT id_jawatankuasa, id_masjid, kat_jawatankuasa, jawatan, ajk_biro FROM jawatankuasa_organisasi WHERE kat_jawatankuasa = '$kat_jawatankuasa' AND id_masjid = '$id_masjid'";
                                            $list_jawatan = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
                                            ?>
                                            <?php
                                            $id_jawatankuasa =$row['id_jawatankuasa'];
                                            while($row_list_jawatan = mysqli_fetch_assoc($list_jawatan))
                                            {
                                                ?>
                                                <option value="<?php echo($row_list_jawatan['id_jawatankuasa']); ?>" <?php if($id_jawatankuasa==$row_list_jawatan['id_jawatankuasa']) { echo "selected"; } ?>><?php if($row_list_jawatan['ajk_biro'] != NULL) { echo(strtoupper($row_list_jawatan['jawatan'])). ' ' .strtoupper($row_list_jawatan['ajk_biro']);} else { echo strtoupper($row_list_jawatan['jawatan']);} ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tarikh Lantikan</label>
                                        <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" value="<?php echo $row['tarikh_lantikan']; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <?php

                                                $id = $row['id'];

                                                $s = "SELECT gambar, jenis_gambar FROM rekod_organisasi WHERE id = '$id'";
                                                $res = mysqli_query($bd2,$s);
                                                if($res)
                                                {
                                                    $row1 = mysqli_fetch_array($res);
                                                    $type = "Content-type: ".$row1['jenis_gambar'];
                                                    //header($type);
                                                    $image = $row1['gambar'];
                                                    $jenis_gambar = $row1['jenis_gambar'];
                                                }
                                                else
                                                {
                                                    echo mysqli_error($bd2);
                                                }
                                                ?>
                                                <label>
                                                    <input id="gambar" name="gambar" class="form-control" type="file" accept=".jpg,.gif,.png,.jpeg" onchange="preview_image(event, 'output1')">
                                                    <?php echo '<img class="img-fluid p-3" id="output1" src="data:'.$jenis_gambar.';base64,'.$image .'" />'; ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <center>
                                        <div class="form-group">
                                            <input type="hidden" name="id_organisasi" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="nokuasa" value="<?php echo $nokuasa; ?>">
                                            <input type="submit"  value="Kemaskini" class="btn btn-success">
                                        </div>
                                    </center>
                                </div>
                            </div>
                        <?php }?>
                    </form>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!--update_jawatankuasa-->
<?php

include('../connection/connection.php');
include("../fungsi.php");
if (isset($_POST['id_organisasi'])) {

    $nokuasa = $_POST['nokuasa'];
    $id_organisasi = $_POST['id_organisasi'];
    $nama_penuh = e($_POST['nama_penuh'], 1, NULL);
    $nama_penuh = str_replace("'","''",$nama_penuh);
    $no_pengenalan = e($_POST['no_pengenalan'], NULL, NULL);
    $no_telefon = e($_POST['no_telefon'], NULL, NULL);
    $emel = e($_POST['emel'], NULL, NULL);
    $kategori_jawatankuasa = e($_POST['kategori_jawatankuasa'], NULL, NULL);
    $id_jawatankuasa = e($_POST['id_jawatankuasa'], NULL, NULL);
    $tarikh_lantikan = e($_POST['tarikh_lantikan'], NULL, NULL);

    $sqljawatan = "SELECT jawatan, ajk_biro FROM jawatankuasa_organisasi WHERE id_jawatankuasa = '$id_jawatankuasa'";
    $result = mysqli_query($bd2,$sqljawatan) or die(mysqli_error($bd2));
    $row = mysqli_fetch_assoc($result);
    $jawatan = $row['jawatan'];
    $ajk_biro = $row['ajk_biro'];

    $ada_dokumen = 0;
    if($_FILES['dokumen']['error'] != 4) {
        $dokumen = e(base64_encode(file_get_contents(addslashes($_FILES['dokumen']['tmp_name']))), NULL, NULL);
        $image = getimagesize(e($_FILES['dokumen']['tmp_name']));//to know about image type etc
        $jenis_dokumen = $image['mime'];
        $ada_dokumen = 1;
    }

    $sql = "UPDATE rekod_organisasi SET nama_penuh ='$nama_penuh',no_pengenalan='$no_pengenalan',no_telefon='$no_telefon',
            emel='$emel',id_jawatankuasa='$id_jawatankuasa',kategori_jawatankuasa='$kategori_jawatankuasa',jawatan='$jawatan', ajk_biro = '$ajk_biro',
            tarikh_lantikan='$tarikh_lantikan', gambar = '$gambar', jenis_gambar = '$jenis_gambar' WHERE id = '$id_organisasi'";
    mysqli_query($bd2, $sql) or die(mysqli_error($bd2));

    if($nokuasa == '1'){
        header("Location: ../utama.php?view=admin&action=view_jawatankuasa&id_organisasi=$id_organisasi&nokuasa=$nokuasa&sideMenu=organisasi");
    }
    else if($nokuasa == '2'){
        header("Location: ../utama.php?view=admin&action=view_jawatankuasa&id_organisasi=$id_organisasi&nokuasa=$nokuasa&sideMenu=organisasi");
    }
    else {
        header("Location: ../utama.php?view=admin&action=view_jawatankuasa&id_organisasi=$id_organisasi&nokuasa=$nokuasa&sideMenu=organisasi");
    }


}
?>
<!--kerosakan(current)-->

<?php
$sql = "SELECT id_inventori, kod_peralatan, nama_peralatan, jenis_peralatan FROM sej6x_data_inventori WHERE id_masjid = $id_masjid";
$list_kod = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
?>
<?php
$sqll = "SELECT id_penyelenggara, nama_penyelenggara, kat_penyelenggara FROM penyelenggara WHERE id_masjid = $id_masjid GROUP BY nama_penyelenggara";
$list_penyelenggara = mysqli_query($bd2, $sqll) or die(mysqli_error($bd2));
?>
<?php
$sqlll = "SELECT a.id_dataajk 'id_dataajk', a.jawatan 'jawatan', b.nama_penuh 'nama_penuh' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_ajk=b.id_data AND a.id_masjid='$id_masjid' ORDER BY (CASE a.jawatan WHEN 'Pengerusi' THEN 1 WHEN 'Timbalan Pengerusi' THEN 2 WHEN 'Setiausaha' THEN 3 WHEN 'Bendahari' THEN 4 WHEN 'AJK' THEN 5 ELSE 'Pemeriksa Kira-Kira' END), b.nama_penuh ASC";
$list_ajk = mysqli_query($bd2, $sqlll) or die(mysqli_error($bd2));
?>
<?php
if($_GET['action']=="kerosakan")
{
    ?>
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Borang Kerosakan</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
                        <li class="active">Borang Kerosakan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Maklumat Kerosakan
                </div>
                <div class="card-body">
                    <div class="panel-body">
                        <form method="POST" action="admin/add_kerosakan.php" name="kerosakan" id="kerosakan">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!--KOD PERALATAN-->
                                    <div class="form-group">
                                        <label>Maklumat Peralatan</label>
                                        <select class="form-control" name="id_peralatan" id="id_peralatan" required>
                                            <option value="">Sila Pilih Peralatan</option>
                                            <?php
                                            while($row_list_kod = mysqli_fetch_assoc($list_kod))
                                            {
                                                ?>
                                                <option value="<?php echo($row_list_kod['id_inventori']); ?>"><?php echo($row_list_kod['kod_peralatan']); ?> - <?php echo $row_list_kod['nama_peralatan']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!--                                <div id="itemDetails" style="display: none;">-->
                                    <!--NAMA PERALATAN (DISPLAY)-->
                                    <!--                                    <div class="form-group">-->
                                    <!--                                        <label>Nama Peralatan</label>-->
                                    <!--                                        <input class="form-control" name="nama_peralatan" id="nama_peralatan" readonly>-->
                                    <!--                                    </div>-->
                                    <!--KATEGORI PERALATAN (DISPLAY)-->
                                    <!--                                    <div class="form-group">-->
                                    <!--                                        <label>Kategori Peralatan</label>-->
                                    <!--                                        <input class="form-control" name="jenis_peralatan" id="jenis_peralatan" readonly>-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->
                                    <!--KUANTITI & UNIT KUANTITI-->
                                    <div class="form-group">
                                        <label>Kuantiti & Unit Kuantiti</label>
                                        <br>
                                        <input type="text" class="form-control" name="kuantiti" id="kuantiti" placeholder="Kuantiti" style="width:237px" required>
                                        &nbsp;
                                        <select class="form-control" name="kuantiti_unit" id="kuantiti_unit" style="width:237px" required>
                                            <option>Unit Kuantiti</option>
                                            <option value="Batang">Batang</option>
                                            <option value="Berkas">Berkas</option>
                                            <option value="Bidang">Bidang</option>
                                            <option value="Biji">Biji</option>
                                            <option value="Bilah">Bilah</option>
                                            <option value="Buah">Buah</option>
                                            <option value="Buku">Buku</option>
                                            <option value="Ekor">Ekor</option>
                                            <option value="Gelung">Gelung</option>
                                            <option value="Gulung">Gulung</option>
                                            <option value="Helai">Helai</option>
                                            <option value="Ikat">Ikat</option>
                                            <option value="Kampit">Kampit</option>
                                            <option value="Keping">Keping</option>
                                            <option value="Kotak">Kotak</option>
                                            <option value="Papan">Papan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Penyelenggara Yang Bertanggunjawab</label>
                                        <select class="form-control" name="id_penyelenggara" id="id_penyelenggara" required>
                                            <option value="">Sila Pilih</option>
                                            <?php
                                            while($row_list_penyelenggara = mysqli_fetch_assoc($list_penyelenggara))
                                            {
                                                ?>
                                                <option value="<?php echo($row_list_penyelenggara['id_penyelenggara']); ?>"><?php echo($row_list_penyelenggara['nama_penyelenggara']); ?> - <?php echo strtoupper(($row_list_penyelenggara['kat_penyelenggara'])); ?> </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!--TAHAP KEROSAKAN-->
                                    <div class="form-group">
                                        <label>Tahap Kerosakan</label>
                                        <select class="form-control" name="tahap_kerosakan" id="tahap_kerosakan" required>
                                            <option>Sila Pilih Tahap Kerosakan</option>
                                            <option value="Segera">Perlu Perhatian Segera</option>
                                            <option value="Biasa">Kerosakan Biasa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!--TARIKH KEROSAKAN & MASA-->
                                    <div class="form-group">
                                        <label>Tarikh & Masa Kerosakan</label>
                                        <br>
                                        <input class="form-control" type="date" name="tarikh_kerosakan" style="width:237px" required>
                                        &nbsp;
                                        <input class="form-control" type="time" name="masa_kerosakan" style="width:237px" required>
                                    </div>
                                    <!--LOKASI PERALATAN-->
                                    <div class="form-group">
                                        <label>Lokasi Peralatan</label>
                                        <input class="form-control" name="lokasi_kerosakan" id="lokasi_kerosakan" oninput="this.value = this.value.toUpperCase()" required>
                                    </div>
                                    <!--PENGESAHAN KEROSAKAN-->
                                    <div class="form-group">
                                        <label>Pengesahan Kerosakan Oleh</label>
                                        <select class="form-control" name="id_pengesah" id="id_pengesah" required>
                                            <option value="">Sila Pilih Pegawai</option>
                                            <?php
                                            while($row_list_ajk = mysqli_fetch_assoc($list_ajk))
                                            {
                                                ?>
                                                <option value="<?php echo($row_list_ajk['id_dataajk']); ?>"><?php echo($row_list_ajk['nama_penuh']); ?> - <?php echo $row_list_ajk['jawatan']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!--CATATAN-->
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <textarea class="form-control" rows="2" name="catatan"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12" align="center">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <button type="reset" class="btn btn-danger">Set Semula</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
