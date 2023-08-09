<?php
include("connection/connection.php");

// Semak status bayaran dgn toyyib

$qPay = "SELECT id_payment, billcode FROM sej6x_bayar_online WHERE CHAR_LENGTH(billcode) >= 8 AND diSemak IS NULL";
selValueSQL($qPay, "semakPay");

if($num_semakPay > 0) {
    //$i = 1;
    do {
        $billcode = $row_semakPay['billcode'];
        $some_data = array(
            "billCode" => "$billcode"
        );

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/getBillTransactions');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

        $result2 = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        $result = json_decode($result2, true);
        $s = $result[0]["billpaymentStatus"];
        $amaun_toyyib = $result[0]["billpaymentAmount"];
        //$status_bayaran = $result[0]["billpaymentStatus"];
        if($s == "1" || $s == "2" || $s == "3" || $s == "4") $status_bayaran = $s;
        else $status_bayaran = 3;
        $qUpdate = "UPDATE sej6x_bayar_online SET diSemak = 1, amaun = '$amaun_toyyib', status_bayaran = $status_bayaran WHERE id_payment = ".$row_semakPay['id_payment'];
        cudSQL($qUpdate, "updatePay");
        //echo $result[0]["billpaymentStatus"];
        //$row_semakPay['id_payment'];
        //echo($qUpdate.';<br />');
        //$i++;
    } while($row_semakPay = mysqli_fetch_assoc($fetch_semakPay));
}

// End semak status bayaran

$query_date = date('Y-m-d');

// First day of the month.
$mula = date('Y-m-01', strtotime($query_date));

// Last day of the month.
$tamat =  date('Y-m-t', strtotime($query_date));

if($_GET['dari'] != NULL || $_GET['hingga']) {
    if($_GET['dari'] != NULL) {
        $mula = $_GET['dari'];
        $tamat = $_GET['dari'];
    }
    if($_GET['hingga'] != NULL) {
        $mula = $_GET['hingga'];
        $tamat = $_GET['hingga'];
    }
    if($_GET['dari'] != NULL && $_GET['hingga']) {
        $mula = $_GET['dari'];
        $tamat = $_GET['hingga'];
    }
}

if($kod_masjid == 'SPMD00000' && $_GET['id_masjid_pilih'] != "semua") {
    if($_GET['id_masjid_pilih'] != NULL) $id_masjid = $_GET['id_masjid_pilih'];
    $q_info_masjid = "SELECT * FROM sej6x_data_masjid a LEFT JOIN bank b ON a.id_bank = b.id_bank WHERE a.id_masjid = $id_masjid";
    $q_info_masjid2 = mysqli_query($bd2, $q_info_masjid) or die(mysqli_error($bd2));
    $row_q_info_masjid = mysqli_fetch_assoc($q_info_masjid2);
    if($_GET['borang'] == 'bayar_masjid') {
        $id_masjid_pilih = $_GET['id_masjid_pilih'];
        $id_transaksi = e($_GET['id_transaksi'], 1);
        $amaun = $_GET['amaun'];
        $tarikh_bayar = e($_GET['tarikh_bayar'], '');
        $q = "INSERT INTO sej6x_bayar_masjid (id_masjid, id_transaksi, amaun, tarikh_bayar) VALUES ($id_masjid_pilih, '$id_transaksi', $amaun, '$tarikh_bayar')";
        mysqli_query($bd2, $q) or die(mysqli_error($bd2));
        header('Location: utama.php?view=admin&action=dashboard_payment');
    }
}

if($_GET['form'] == "dashboard_payment" && $mula != NULL && $tamat != NULL) {
    //$extra = "AND tarikh_bayaran BETWEEN CAST('$mula' AS DATE) AND CAST('$tamat' AS DATE)";
    $extra = "SUM(IF(DATE_FORMAT(tarikh_bayaran, '%Y-%m-%d') BETWEEN CAST('$mula' AS DATE) AND CAST('$tamat' AS DATE), 1, 0)) 'trans_tarikh_pilih', SUM(IF(DATE_FORMAT(tarikh_bayaran, '%Y-%m-%d') BETWEEN CAST('$mula' AS DATE) AND CAST('$tamat' AS DATE), amaun, 0)) 'amaun_tarikh_pilih',";
}

if($_GET['id_masjid_pilih'] != "semua") {
    $extra_masjid = "AND id_masjid = $id_masjid";
    $extra_masjid2 = "WHERE id_masjid = $id_masjid";
}

else {
    $extra_masjid = "AND id_masjid != 6279";
    $extra_masjid2 = "WHERE id_masjid != 6279";
    $id_masjid = $_GET['id_masjid_pilih'];
}

$q = "SELECT $extra SUM(IF(DATE_FORMAT(tarikh_bayaran, '%Y-%m-%d') = '$query_date', amaun, 0)) 'hari_ini', SUM(IF(DATE_FORMAT(tarikh_bayaran, '%Y-%m-%d') = '$query_date', 1, 0)) 'hari_ini_trans', SUM(IF(DATE_FORMAT(tarikh_bayaran, '%Y-%m-%d') = '$query_date', 1 * 2, 0)) 'hari_ini_sum', SUM(amaun) 'keseluruhan', SUM(1) 'keseluruhan_trans', SUM(1 * 2) 'keseluruhan_sum' FROM sej6x_bayar_online WHERE jenis_bayaran IN ('Sumbangan', 'Derma', 'Wakaf', 'Tabung Jumaat', 'Bantuan') AND diSemak = 1 AND status_bayaran = '1' $extra_masjid";
//echo($q);
$q2 = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
$row_q = mysqli_fetch_assoc($q2);


$q_terima = "SELECT SUM(IF(DATE_FORMAT(tarikh_bayar, '%Y-%m-%d') = '$query_date', amaun, 0)) 'terima_hari_ini', SUM(amaun) 'terima_semua' FROM sej6x_bayar_masjid $extra_masjid2";
$q_terima2 = mysqli_query($bd2, $q_terima) or die(mysqli_error($bd2));
$row_q_terima = mysqli_fetch_assoc($q_terima2);

$bayaran_belum_terima = $row_q['keseluruhan'] - $row_q['keseluruhan_sum'] - $row_q_terima['terima_semua'];

$result= mysqli_query($bd2, "SELECT id_masjid,kod_masjid,nama_masjid,alamat_masjid FROM sej6x_data_masjid WHERE kod_masjid='$jname'") or die("SELECT Error: ".mysqli_error($bd2));
$namamasjid = mysqli_fetch_assoc($result);
?>


<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h4>Utama</h4>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard&qariah=semua">Statistik Ahli Kariah</a></li>
                    <li class="active">Statistik Bayaran</li>
                    <li><a href="utama.php?view=admin&action=dashboard_bantuan">Statistik Bantuan</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <?php if($kod_masjid == 'SPMD00000') { ?>
        <div class="row">
            <div class="col">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        <h4 class="m-b-0 text-white">Bayar Kepada Masjid</h4></div>
                    <div class="card-body">
                        <form name="pilih_masjid" id="pilih_masjid" action="utama.php" enctype="multipart/form-data" method="get">
                            <div class="row form-group">
                                <div class="col-12 col-md-12">
                                    <label>Pilih Masjid</label>
                                    <?php pilihVal3('masjid_modal', "SELECT id_masjid 'id', nama_masjid 'val' FROM sej6x_data_masjid WHERE cat_api IS NOT NULL OR cat_api_old IS NOT NULL", 1, 'id_masjid_pilih', 'id_masjid_pilih', 'form-control', 'required', $id_masjid, ''); ?>
                                </div>
                                <?php if($_GET['form'] == "dashboard_payment") { ?>
                                    <div class="col-12 col-md-12" align="center">
                                        <h4>Tarikh Bayaran Dari <?php echo $mula; ?> Sehingga <?php echo $tamat; ?></h4>
                                    </div>
                                <?php } ?>
                                <div class="col-6 col-md-6">
                                    <label class="m-t-20">Dari</label>
                                    <input name="dari" type="text" class="form-control" placeholder="Dari" id="mdate" value="<?php echo($mula); ?>">
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="m-t-20">Hingga</label>
                                    <input name="hingga" type="text" class="form-control" placeholder="Hingga" id="mdate2" value="<?php echo($tamat); ?>">
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="hidden" name="view" value="admin">
                                    <input type="hidden" name="action" value="dashboard_payment">
                                    <input type="hidden" name="form" value="dashboard_payment">
                                    <button id="pilih_tekan" type="submit" class="btn btn-primary m-t-30">Lihat</button>
                                </div>
                            </div>
                        </form>
                        <form name="bayar_masjid" id="bayar_masjid" action="utama.php" enctype="multipart/form-data" method="get">
                            <div class="row form-group">
                                <div class="col-12 col-md-12">
                                    <label>Bank</label>
                                    <input class="form-control" disabled value="<?php echo($row_q_info_masjid['bank']); ?>" readonly>
                                </div>
                                <div class="col-12 col-md-12">
                                    <label>No Akaun</label>
                                    <input class="form-control" disabled value="<?php echo($row_q_info_masjid['no_akaun']); ?>" readonly>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label>Tarikh Transaksi Bayaran</label>
                                    <input name="tarikh_bayar" type="text" class="form-control" placeholder="Tarikh Bayaran" id="mdate3" value="<?php echo($query_date); ?>" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label>Amaun (RM)</label>
                                    <input placeholder="Masukkan Amaun Bayaran" class="form-control" id="amaun" name="amaun" type="number" step="any" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label>ID Transaksi Bank / No Rujukan Transaksi</label>
                                    <input placeholder="Masukkan ID atau No Rujukan Transaksi Bank" class="form-control" id="id_transaksi" name="id_transaksi" required>
                                </div>
                                <div class="col-12 col-md-12">
                                    <input type="hidden" name="borang" value="bayar_masjid">
                                    <input type="hidden" name="view" value="admin">
                                    <input type="hidden" name="action" value="dashboard_payment">
                                    <input type="hidden" name="id_masjid_pilih" value="<?php echo($id_masjid); ?>">
                                    <button type="submit" class="btn btn-primary m-t-30">Bayar Kepada <?php echo($row_q_info_masjid['nama_masjid']); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col">
            <div class="card border-megna">
                <div class="card-header bg-megna">
                    <h4 class="m-b-0 text-white">Jumlah Transaksi</h4></div>
                <div class="card-body">
                    <?php if(($_GET['dari'] != NULL || $_GET['hingga'] != NULL) && $_GET['form'] == "dashboard_payment") { ?>
                        <div class="box bg-megna text-center">
                            <h1 class="font-light text-white"><?php echo number_format($row_q['trans_tarikh_pilih'], 0, '.', ','); ?></h1>
                            <h6 class="text-white"><?php if($mula != $tamat) echo($mula.' hingga '.$tamat); else echo($mula); ?></h6>
                        </div>
                        <br />
                    <?php } ?>
                    <div class="box bg-megna text-center">
                        <h1 class="font-light text-white"><?php echo number_format($row_q['hari_ini_trans'], 0, '.', ','); ?></h1>
                        <h6 class="text-white">Hari Ini</h6>
                    </div>
                    <br />
                    <div class="box bg-megna text-center" style="border: 5px solid #000000;">
                        <h1 class="font-light text-white"><?php echo number_format($row_q['keseluruhan_trans'], 0, '.', ','); ?></h1>
                        <h6 class="text-white">Keseluruhan</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-megna">
                <div class="card-header bg-megna">
                    <h4 class="m-b-0 text-white">Kutipan Online</h4></div>
                <div class="card-body">
                    <?php if(($_GET['dari'] != NULL || $_GET['hingga'] != NULL) && $_GET['form'] == "dashboard_payment") { ?>
                        <div class="box bg-megna text-center">
                            <h1 class="font-light text-white">RM <?php echo number_format($row_q['amaun_tarikh_pilih'], 2, '.', ','); ?></h1>
                            <h6 class="text-white"><?php if($mula != $tamat) echo($mula.' hingga '.$tamat); else echo($mula); ?></h6>
                        </div>
                        <br />
                    <?php } ?>
                    <div class="box bg-megna text-center">
                        <h1 class="font-light text-white">RM <?php echo number_format($row_q['hari_ini'], 2, '.', ','); ?></h1>
                        <h6 class="text-white">Hari Ini</h6>
                    </div>
                    <br />
                    <div class="box bg-megna text-center" style="border: 5px solid #000000;">
                        <h1 class="font-light text-white">RM <?php echo number_format($row_q['keseluruhan'], 2, '.', ','); ?></h1>
                        <h6 class="text-white">Keseluruhan</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-danger">
                <div class="card-header bg-danger">
                    <h4 class="m-b-0 text-white">* Belum Diterima</h4></div>
                <?php if(($_GET['dari'] != NULL || $_GET['hingga'] != NULL) && $_GET['form'] == "dashboard_payment") { ?>
                    <div class="card-body">
                        <div class="box bg-danger text-center" style="border: 5px solid #000000;">
                            <h1 class="font-light text-white">RM <?php echo number_format(($row_q['amaun_tarikh_pilih'] - ($row_q['trans_tarikh_pilih'] * 2)), 2, '.', ','); ?></h1>
                            <h6 class="text-white"><h6 class="text-white"><?php if($mula != $tamat) echo($mula.' hingga '.$tamat); else echo($mula); ?></h6></h6>
                        </div><br />
                        <small>Kutipan Online: RM <?php echo number_format($row_q['amaun_tarikh_pilih'], 2, '.', ','); ?><br />
                            Caj Pengurusan (RM 2 x <?php echo number_format($row_q['trans_tarikh_pilih'], 0, '.', ','); ?> Transaksi): - RM <?php echo number_format(($row_q['trans_tarikh_pilih'] * 2), 2, '.', ','); ?><br/>
                            Bayaran Diterima: - RM <?php echo number_format($row_q_terima['terima_semua'], 2, '.', ','); ?>
                        </small>
                    </div>
                <?php } ?>
                <div class="card-body">
                    <div class="box bg-danger text-center" style="border: 5px solid #000000;">
                        <h1 class="font-light text-white">RM <?php echo number_format($bayaran_belum_terima, 2, '.', ','); ?></h1>
                        <h6 class="text-white">Keseluruhan</h6>
                    </div><br />
                    <small>Kutipan Online Keseluruhan: RM <?php echo number_format($row_q['keseluruhan'], 2, '.', ','); ?><br />
                        Caj Pengurusan (RM 2 x <?php echo number_format($row_q['keseluruhan_trans'], 0, '.', ','); ?> Transaksi): - RM <?php echo number_format($row_q['keseluruhan_sum'], 2, '.', ','); ?><br/>
                        Bayaran Diterima Keseluruhan: - RM <?php echo number_format($row_q_terima['terima_semua'], 2, '.', ','); ?>
                    </small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-info">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">Diterima</h4></div>
                <div class="card-body">
                    <?php if($_GET['dari'] != NULL || $_GET['hingga']) { ?>
                        <div class="box bg-info text-center">
                            <h1 class="font-light text-white">RM X,XXX.XX</h1>
                            <h6 class="text-white"><?php if($mula != $tamat) echo($mula.' hingga '.$tamat); else echo($mula); ?></h6>
                        </div>
                        <br />
                    <?php } ?>
                    <div class="box bg-info text-center">
                        <h1 class="font-light text-white">RM <?php echo number_format($row_q_terima['terima_hari_ini'], 2, '.', ','); ?></h1>
                        <h6 class="text-white">Hari Ini</h6>
                    </div>
                    <br />
                    <div class="box bg-info text-center" style="border: 5px solid #000000;">
                        <h1 class="font-light text-white">RM <?php echo number_format($row_q_terima['terima_semua'], 2, '.', ','); ?></h1>
                        <h6 class="text-white">Keseluruhan</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div align="center"><h3>Statistik Keseluruhan</h3></div>
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Carian Tarikh
                    </button>
                    <div class="collapse" id="collapseExample">
                        <form id="rekod_bayaran" name="rekod_bayaran" action="utama.php" method="get" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 col-md-12 form-group" style="display: none"><h4>Data Kehadiran</h4></div>
                                <div class="col-6 col-md-6 form-group">
                                    <label class="m-t-20">Dari</label>
                                    <input name="dari" type="text" class="form-control" placeholder="Dari" id="mdate" value="<?php echo($mula); ?>">
                                </div>
                                <div class="col-6 col-md-6 form-group">
                                    <label class="m-t-20">Hingga</label>
                                    <input name="hingga" type="text" class="form-control" placeholder="Hingga" id="mdate2" value="<?php echo($tamat); ?>">
                                </div>
                                <input type="hidden" name="view" value="admin">
                                <input type="hidden" name="action" value="dashboard_payment">
                                <?php if($kod_masjid == 'SPMD00000') { ?><input type="hidden" name="id_masjid_pilih" value="<?php echo($id_masjid); ?>"><?php } ?>
                                <div class="col-12 col-md-12 form-group"><button type="submit" class="btn btn-primary">Lihat</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    //$tarikh_awal = "".$_GET['dari']."";
    $tarikh_awal = $_GET['dari'];
    $tarikh_awal=str_replace("'","",$tarikh_awal);
    $tarikh_awal=str_replace("/","-",$tarikh_awal);
    $year_awal=substr($tarikh_awal, 0, 4);
    $month_awal=substr($tarikh_awal, 5, 2);
    $day_awal=substr($tarikh_awal, 8,2);
    $tarikh_awal=$year_awal."-".$month_awal."-".$day_awal;

    //$tarikh_akhir = "".$_GET['hingga']."";
    $tarikh_akhir = $_GET['hingga'];
    $tarikh_akhir=str_replace("'","",$tarikh_akhir);
    $tarikh_akhir=str_replace("/","-",$tarikh_akhir);
    $year_akhir=substr($tarikh_akhir, 0, 4);
    $month_akhir=substr($tarikh_akhir, 5, 2);
    $day_akhir=substr($tarikh_akhir, 8,2);
    $tarikh_akhir=$year_akhir."-".$month_akhir."-".$day_akhir;

    $q_main = "SELECT SUM(amaun) 'amaun' FROM sej6x_bayar_online WHERE id_masjid = $id_masjid AND jenis_bayaran IN ('Sumbangan', 'Derma', 'Wakaf', 'Tabung Jumaat', 'Bantuan') AND diSemak = 1 AND status_bayaran = '1'";
    $sql_main = "SELECT * FROM sej6x_bayar_online WHERE id_masjid='$id_masjid' AND jenis_bayaran IN ('Sumbangan', 'Derma', 'Wakaf', 'Tabung Jumaat', 'Bantuan') AND diSemak = 1 AND status_bayaran='1'";

    if($_GET['dari'] != NULL && $_GET['hingga'] != NULL) $q_main .= " AND tarikh_bayaran BETWEEN CAST('$tarikh_awal 00:00:00' AS DATETIME) AND CAST('$tarikh_akhir 23:59:59' AS DATETIME)";
    if($_GET['dari'] != NULL && $_GET['hingga'] != NULL) $sql_main .= " AND tarikh_bayaran BETWEEN CAST('$tarikh_awal 00:00:00' AS DATETIME) AND CAST('$tarikh_akhir 23:59:59' AS DATETIME)";

    //Sumbangan
    $sql = "$sql_main AND jenis_bayaran = 'Sumbangan'";
    $sqlquery = mysqli_query($bd2, $sql);
    $row5 = mysqli_num_rows($sqlquery);
    if(mysqli_num_rows($sqlquery)==0)
    {
        $amaun_sumbangan = 0;
    }
    else if(mysqli_num_rows($sqlquery)>0)
    {
        $sql = "$q_main AND jenis_bayaran = 'Sumbangan'";
        $sqlquery = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
        $data = mysqli_fetch_array($sqlquery);
        $amaun_sumbangan = $data['amaun'];
    }

    //Derma
    $sql1 = "$sql_main AND jenis_bayaran = 'Derma'";
    $sqlquery1 = mysqli_query($bd2, $sql1);
    $row6 = mysqli_num_rows($sqlquery1);
    if(mysqli_num_rows($sqlquery1)==0)
    {
        $amaun_derma = 0;
    }
    else if(mysqli_num_rows($sqlquery1)>0)
    {
        $sql1 = "$q_main AND jenis_bayaran = 'Derma'";
        $sqlquery1 = mysqli_query($bd2, $sql1) or die(mysqli_error($bd2));
        $data1 = mysqli_fetch_array($sqlquery1);
        $amaun_derma = $data1['amaun'];
    }

    //Bantuan
    $sql2 = "$sql_main AND jenis_bayaran = 'Bantuan'";
    $sqlquery2 = mysqli_query($bd2, $sql2);
    $row7 = mysqli_num_rows($sqlquery2);
    if(mysqli_num_rows($sqlquery2)==0)
    {
        $amaun_bantuan = 0;
    }
    else if(mysqli_num_rows($sqlquery2)>0)
    {
        $sql2 = "$q_main AND jenis_bayaran = 'Bantuan'";
        $sqlquery2 = mysqli_query($bd2, $sql2) or die(mysqli_error($bd2));
        $data2 = mysqli_fetch_array($sqlquery2);
        $amaun_bantuan = $data2['amaun'];
    }

    //Wakaf
    $sql3 = "$sql_main AND jenis_bayaran = 'Wakaf'";
    $sqlquery3 = mysqli_query($bd2, $sql3);
    $row8 = mysqli_num_rows($sqlquery3);
    if(mysqli_num_rows($sqlquery3)==0)
    {
        $amaun_wakaf = 0;
    }
    else if(mysqli_num_rows($sqlquery3)>0)
    {
        $sql3 = "$q_main AND jenis_bayaran ='Wakaf'";
        $sqlquery3 = mysqli_query($bd2, $sql3) or die(mysqli_error($bd2));
        $data3 = mysqli_fetch_array($sqlquery3);
        $amaun_wakaf=$data3['amaun'];
    }

    //Tabung Jumaat
    $sql4 = "$sql_main AND jenis_bayaran = 'Tabung Jumaat'";
    $sqlquery4 = mysqli_query($bd2, $sql4);
    $row9 = mysqli_num_rows($sqlquery4);
    if(mysqli_num_rows($sqlquery4)==0)
    {
        $amaun_jumaat = 0;
    }
    else if(mysqli_num_rows($sqlquery4)>0)
    {
        $sql4 = "$q_main AND jenis_bayaran = 'Tabung Jumaat'";
        $sqlquery4 = mysqli_query($bd2, $sql4) or die(mysqli_error($bd2));
        $data4 = mysqli_fetch_array($sqlquery4);
        $amaun_jumaat = $data4['amaun'];
    }
    ?>
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script>
        $(function() {

            new Chart(document.getElementById("chart"),
                {
                    "type":"bar",
                    "data":{"labels":["Sumbangan","Derma","Bantuan","Wakaf","Tabung Jumaat"],
                        "datasets":[{
                            "label":"Ringgit Malaysia(RM)",
                            "data":[<?php echo $amaun_sumbangan; ?>,<?php echo $amaun_derma; ?>,<?php echo $amaun_bantuan; ?>,<?php echo $amaun_wakaf; ?>,<?php echo $amaun_jumaat; ?>],
                            "fill":false,
                            "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)"],
                            "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)"],
                            "borderWidth":1}
                        ]},
                    "options":{
                        "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}
                    }
                });
        });
    </script>
    <?php
    if(isset($_GET['dari']) AND isset($_GET['hingga']))
    {
        ?>
        <div class="row">
            <div class="col-lg-12" align="center">
                <h4>Carian Tarikh Dari <?php echo $tarikh_awal; ?> Sehingga <?php echo $tarikh_akhir; ?></h4>
            </div>
        </div>
        <br>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Statistik Bayaran</h4>
                    <div>
                        <canvas id="chart" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th><div align="center">#</div></th>
                                <th><div align="center">Jenis Bayaran</div></th>
                                <th><div align="center">Bilangan Bayaran</div></th>
                                <th><div align="center">Jumlah Amaun Bayaran</div></th>
                                <th><div align="center">Caj Pengurusan</div></th>
                                <th><div align="center">Jumlah Amaun Bersih</div></th>
                                <th><div align="center">Senarai Nama</div></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td align="center">1</td>
                                <td align="center">Sumbangan</td>
                                <td align="center">
                                    <?php
                                    $sql5="SELECT * FROM sej6x_bayar_online WHERE id_masjid='$id_masjid' AND diSemak = 1 AND status_bayaran='1' AND jenis_bayaran='Sumbangan'";
                                    $sqlquery5=mysqli_query($bd2, $sql5);
                                    echo $row5;
                                    ?>
                                </td>
                                <td align="center"><?php echo "RM ".number_format($amaun_sumbangan,2); ?></td>
                                <td align="center">
                                    <?php
                                    if($row5>0)
                                    {
                                        $amaun_sumbangan = floatval($amaun_sumbangan);
                                        //$caj_sumbangan = $amaun_sumbangan * 0.02 + 1;
                                        $caj_sumbangan = 2 * $row5;
                                        echo "RM ".$caj_sumbangan = number_format($caj_sumbangan,2);
                                    }
                                    else if($row5==0)
                                    {
                                        echo "RM 0.00";
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <?php
                                    if($row5>0)
                                    {
                                        $bersih_sumbangan = $amaun_sumbangan - $caj_sumbangan;
                                        echo "RM ".number_format($bersih_sumbangan,2);
                                    }
                                    else if($row5==0)
                                    {
                                        echo "RM 0.00";
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <form action="utama.php" method="GET" target="_blank">
                                        <input type="hidden" name="view" value="admin">
                                        <input type="hidden" name="action" value="senarai_bayaran">
                                        <input type="hidden" name="jenis_bayaran" value="Sumbangan">
                                        <?php
                                        if(isset($_GET['dari']) AND isset($_GET['hingga']))
                                        {
                                            ?>
                                            <input type="hidden" name="dari" value="<?php echo $tarikh_awal; ?>">
                                            <input type="hidden" name="hingga" value="<?php echo $tarikh_akhir; ?>">
                                            <?php
                                        }
                                        ?>
                                        <button type="submit" class="form-control"  title="Lihat Maklumat Bayaran"><i class="fas fa-search"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">2</td>
                                <td align="center">Derma</td>
                                <td align="center">
                                    <?php
                                    $sql6="SELECT * FROM sej6x_bayar_online WHERE id_masjid='$id_masjid' AND diSemak = 1 AND status_bayaran='1' AND jenis_bayaran='Derma'";
                                    $sqlquery6=mysqli_query($bd2, $sql6);
                                    echo $row6;
                                    ?>
                                </td>
                                <td align="center"><?php echo "RM ".number_format($amaun_derma,2); ?></td>
                                <td align="center">
                                    <?php
                                    if($row6>0)
                                    {
                                        $amaun_derma = floatval($amaun_derma);
                                        //$caj_derma = $amaun_derma * 0.02 + 1;
                                        $caj_derma = 2 * $row6;
                                        echo "RM ".$caj_derma = number_format($caj_derma,2);
                                    }
                                    else if($row6==0)
                                    {
                                        echo "RM 0.00";
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <?php
                                    if($row6>0)
                                    {
                                        $bersih_derma = $amaun_derma - $caj_derma;
                                        echo "RM ".number_format($bersih_derma,2);
                                    }
                                    else if($row6==0)
                                    {
                                        echo "RM 0.00";
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <form action="utama.php" method="GET" target="_blank">
                                        <input type="hidden" name="view" value="admin">
                                        <input type="hidden" name="action" value="senarai_bayaran">
                                        <input type="hidden" name="jenis_bayaran" value="Derma">
                                        <?php
                                        if(isset($_GET['dari']) AND isset($_GET['hingga']))
                                        {
                                            ?>
                                            <input type="hidden" name="dari" value="<?php echo $tarikh_awal; ?>">
                                            <input type="hidden" name="hingga" value="<?php echo $tarikh_akhir; ?>">
                                            <?php
                                        }
                                        ?>
                                        <button type="submit" class="form-control"  title="Lihat Maklumat Bayaran"><i class="fas fa-search"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">3</td>
                                <td align="center">Bantuan</td>
                                <td align="center">
                                    <?php
                                    $sql7="SELECT * FROM sej6x_bayar_online WHERE id_masjid='$id_masjid' AND diSemak = 1 AND status_bayaran='1' AND jenis_bayaran='Bantuan'";
                                    $sqlquery7=mysqli_query($bd2, $sql7);
                                    echo $row7;
                                    ?>
                                </td>
                                <td align="center"><?php echo "RM ".number_format($amaun_bantuan,2); ?></td>
                                <td align="center">
                                    <?php
                                    if($row7>0)
                                    {
                                        $amaun_bantuan = floatval($amaun_bantuan);
                                        //$caj_bantuan = $amaun_bantuan * 0.02 + 1;
                                        $caj_bantuan = 2 * $row7;
                                        echo "RM ".$caj_bantuan = number_format($caj_bantuan,2);
                                    }
                                    else if($row7==0)
                                    {
                                        echo "RM 0.00";
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <?php
                                    if($row7>0)
                                    {
                                        $bersih_bantuan = $amaun_bantuan - $caj_bantuan;
                                        echo "RM ".number_format($bersih_bantuan,2);
                                    }
                                    else if($row7==0)
                                    {
                                        echo "RM 0.00";
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <form action="utama.php" method="GET" target="_blank">
                                        <input type="hidden" name="view" value="admin">
                                        <input type="hidden" name="action" value="senarai_bayaran">
                                        <input type="hidden" name="jenis_bayaran" value="Bantuan">
                                        <?php
                                        if(isset($_GET['dari']) AND isset($_GET['hingga']))
                                        {
                                            ?>
                                            <input type="hidden" name="dari" value="<?php echo $tarikh_awal; ?>">
                                            <input type="hidden" name="hingga" value="<?php echo $tarikh_akhir; ?>">
                                            <?php
                                        }
                                        ?>
                                        <button type="submit" class="form-control"  title="Lihat Maklumat Bayaran"><i class="fas fa-search"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">4</td>
                                <td align="center">Wakaf</td>
                                <td align="center">
                                    <?php
                                    $sql8="SELECT * FROM sej6x_bayar_online WHERE id_masjid='$id_masjid' AND diSemak = 1 AND status_bayaran='1' AND jenis_bayaran='Wakaf'";
                                    $sqlquery8=mysqli_query($bd2, $sql8);
                                    echo $row8;
                                    ?>
                                </td>
                                <td align="center"><?php echo "RM ".number_format($amaun_wakaf,2); ?></td>
                                <td align="center">
                                    <?php
                                    if($row8>0)
                                    {
                                        $amaun_wakaf = floatval($amaun_wakaf);
                                        //$caj_wakaf = $amaun_wakaf * 0.02 + 1;
                                        $caj_wakaf = 2 * $row8;
                                        echo "RM ".$caj_wakaf = number_format($caj_wakaf,2);
                                    }
                                    else if($row8==0)
                                    {
                                        echo "RM 0.00";
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <?php
                                    if($row8>0)
                                    {
                                        $bersih_wakaf = $amaun_wakaf - $caj_wakaf;
                                        echo "RM ".number_format($bersih_wakaf,2);
                                    }
                                    else if($row8==0)
                                    {
                                        echo "RM 0.00";
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <form action="utama.php" method="GET" target="_blank">
                                        <input type="hidden" name="view" value="admin">
                                        <input type="hidden" name="action" value="senarai_bayaran">
                                        <input type="hidden" name="jenis_bayaran" value="Wakaf">
                                        <?php
                                        if(isset($_GET['dari']) AND isset($_GET['hingga']))
                                        {
                                            ?>
                                            <input type="hidden" name="dari" value="<?php echo $tarikh_awal; ?>">
                                            <input type="hidden" name="hingga" value="<?php echo $tarikh_akhir; ?>">
                                            <?php
                                        }
                                        ?>
                                        <button type="submit" class="form-control"  title="Lihat Maklumat Bayaran"><i class="fas fa-search"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">5</td>
                                <td align="center">Tabung Jumaat</td>
                                <td align="center">
                                    <?php
                                    $sql9="SELECT * FROM sej6x_bayar_online WHERE id_masjid='$id_masjid' AND diSemak = 1 AND status_bayaran='1' AND jenis_bayaran='Tabung Jumaat'";
                                    $sqlquery9=mysqli_query($bd2, $sql9);
                                    echo $row9;
                                    ?>
                                </td>
                                <td align="center"><?php echo "RM ".number_format($amaun_jumaat,2); ?></td>
                                <td align="center">
                                    <?php
                                    if($row9>0)
                                    {
                                        $amaun_jumaat = floatval($amaun_jumaat);
                                        //$caj_jumaat = $amaun_jumaat * 0.02 + 1;
                                        $caj_jumaat = 2 * $row9;
                                        echo "RM ".$caj_jumaat = number_format($caj_jumaat,2);
                                    }
                                    else if($row9==0)
                                    {
                                        echo "RM 0.00";
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <?php
                                    if($row9>0)
                                    {
                                        $bersih_jumaat = $amaun_jumaat - $caj_jumaat;
                                        echo "RM ".number_format($bersih_jumaat,2);
                                    }
                                    else if($row9==0)
                                    {
                                        echo "RM 0.00";
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <form action="utama.php" method="GET" target="_blank">
                                        <input type="hidden" name="view" value="admin">
                                        <input type="hidden" name="action" value="senarai_bayaran">
                                        <input type="hidden" name="jenis_bayaran" value="Tabung Jumaat">
                                        <?php
                                        if(isset($_GET['dari']) AND isset($_GET['hingga']))
                                        {
                                            ?>
                                            <input type="hidden" name="dari" value="<?php echo $tarikh_awal; ?>">
                                            <input type="hidden" name="hingga" value="<?php echo $tarikh_akhir; ?>">
                                            <?php
                                        }
                                        ?>
                                        <button type="submit" class="form-control"  title="Lihat Maklumat Bayaran"><i class="fas fa-search"></i></button>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    //$('#pilih_masjid').on('change', function() {
    //$('#pilih_tekan').click();
    //});
    //var data_ada = $('#id_masjid_pilih').html();
    //$('#id_masjid_pilih').html('');
    $('#id_masjid_pilih').append('<option value="semua" <?php if($id_masjid == "semua") echo('selected'); ?>>SEMUA MASJID</option>');
    //$('#id_masjid_pilih').append(data_ada);
</script>
