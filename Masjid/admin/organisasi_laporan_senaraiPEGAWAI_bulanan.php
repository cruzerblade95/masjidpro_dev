<?php
if(isset($_POST['month'])){
    $month = $_POST['month'];
}
if(isset($_POST['tahun'])){
    $tahun = $_POST['tahun'];
}
if(isset($_POST['jawatan'])){
    $jawatan = $_POST['jawatan'];
}
?>

<style type="text/css">
    @media print {
        #printbtn {
            display :  none;
        }
    }
</style>
<div class="breadcrumbs">
    <div class="col-sm-7">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Kehadiran Pegawai Masjid</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">>
                    <li class="active">Laporan Bulanan Pegawai Masjid</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="printbtn">
                <div class="card-header">
                    Carian
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="kehadiran_terperinci" name="kehadiran_terperinci" method="POST" action="<?php echo $PHP_SELF;?>">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Jawatan</label>
                                        <select class="form-control" name="jawatan" id="jawatan" required>
                                            <option value="">Sila Pilih Jawatan</option>
                                            <option value="Imam" <?php if ($jawatan=="Imam"){echo "selected='SELECTED'";}?>>Imam</option>
                                            <option value="Bilal" <?php if ($jawatan=="Bilal"){echo "selected='SELECTED'";}?>>Bilal</option>
                                            <option value="Siak" <?php if ($jawatan=="Siak"){echo "selected='SELECTED'";}?>>Siak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Bulan</label>
                                        <select class="form-control" name="month" id="month" required>
                                            <option value="" selected="selected">Sila Pilih Bulan</option>
                                            <option value="01" <?php if ($month=="01"){echo "selected='SELECTED'";}?>>Januari</option>
                                            <option value="02" <?php if ($month=="02"){echo "selected='SELECTED'";}?>>Februari</option>
                                            <option value="03" <?php if ($month=="03"){echo "selected='SELECTED'";}?>>Mac</option>
                                            <option value="04" <?php if ($month=="04"){echo "selected='SELECTED'";}?>>April</option>
                                            <option value="05" <?php if ($month=="05"){echo "selected='SELECTED'";}?>>Mei</option>
                                            <option value="06" <?php if ($month=="06"){echo "selected='SELECTED'";}?>>Jun</option>
                                            <option value="07" <?php if ($month=="07"){echo "selected='SELECTED'";}?>>Julai</option>
                                            <option value="08" <?php if ($month=="08"){echo "selected='SELECTED'";}?>>Ogos</option>
                                            <option value="09" <?php if ($month=="09"){echo "selected='SELECTED'";}?>>September</option>
                                            <option value="10" <?php if($month=="10"){echo "selected='SELECTED'";}?>>Oktober</option>
                                            <option value="11" <?php if($month=="11"){echo "selected='SELECTED'";}?>>November</option>
                                            <option value="12" <?php if($month=="12"){echo "selected='SELECTED'";}?>>Disember</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <select class="form-control" name="tahun" id="tahun" required>
                                            <?php
                                            $start_year = 2018;
                                            $end_year = date('Y');
                                            for($i=$end_year;$i>=$start_year;$i--)
                                            {
                                                ?>
                                                <option value="<?php echo $i; ?>" <?php if($tahun==$i) { echo "selected='SELECTED'"; } ?>><?php echo $i;?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
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
        </div>
    </div>
    <?php if(isset($_POST['tahun']) OR isset($_POST['bulan'])){ ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Rekod Kehadiran
                    <button id="printbtn" onclick="myFunction()" class="btn btn-info">Cetak</button>
                    <!-- <script>
                    function myFunction() {
                    window.print();
                    }
                    </script> -->
                    <script type="text/javascript">
                        function myFunction() {
                            var printContents = document.getElementById('div_print').innerHTML;
                            var originalContents = document.body.innerHTML;
                            document.body.innerHTML = printContents;
                            window.print();
                            document.body.innerHTML = originalContents;
                        }
                    </script>
                </div>
                <!-- /.panel-heading -->
                <div class="card-body" id="div_print">
                    <div class="table-responsive">

                        <?php
                        include("connection/connection.php");
                        include("connection/connection_kehadiran.php");
                        $kod_masjid_kecik = strtolower($kod_masjid);
                        $kod_masjid_besaq = $kod_masjid;
                        //echo($kod_masjid_kecik);
                        if(isset($_POST['search']))
                        {
                        $id_bulan = $_POST['month'];
                        $tahun = $_POST['tahun'];
                        //Bulan

                        //$hari = date("t", mktime(0,0,0,$id_bulan,1,$tahun));
                        $hari = cal_days_in_month(CAL_GREGORIAN,$id_bulan,$tahun);
                        $bulan3 = date("m", mktime(0,0,0,$id_bulan,1,$tahun));
                        $bulan2 = date("F", mktime(0,0,0,$id_bulan,1,$tahun));

                        $j = 1;
                        $bil_cuti = 0;
                        do {
                            $z=mktime(00, 00, 00, $bulan3, $j, $tahun);
                            $namahari = date("w", $z);
                            $j++;
                        } while ($j <= $hari);

                        $sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$id_masjid'";
                        $query_masjid = mysqli_query($bd2,$sql_masjid);
                        $data_masjid = mysqli_fetch_array($query_masjid);

                        $id_device = $data_masjid['id_device'];


                        $id = $_GET['id_pegawai'];
                        if($id_device == 1 ) {
                            $sql_search = "SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan', b.no_ic 'no_ic', a.id_fingerprint 'id_fingerprint' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_datapegawai='$id' AND a.id_pegawai=b.id_data
                             UNION SELECT d.nama_penuh 'nama_penuh', c.jawatan 'jawatan', d.no_ic 'no_ic', c.id_fingerprint 'id_fingerprint' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_datapegawai='$id' AND c.id_pegawai2=d.ID";
                        }
                        if($id_device == 2 ) {
                            $sql_search = "SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan', b.no_ic 'id_fingerprint' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_datapegawai='$id' AND a.id_pegawai=b.id_data
                             UNION SELECT d.nama_penuh 'nama_penuh', c.jawatan 'jawatan', d.no_ic 'id_fingerprint' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_datapegawai='$id' AND c.id_pegawai2=d.ID";
                        }
                        if($id_device == NULL OR $id_device ==3) {
                            $sql_search = "SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan', b.no_ic 'id_fingerprint' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_datapegawai='$id' AND a.id_pegawai=b.id_data
                             UNION SELECT d.nama_penuh 'nama_penuh', c.jawatan 'jawatan', d.no_ic 'id_fingerprint' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_datapegawai='$id' AND c.id_pegawai2=d.ID";
                        }
                        $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
                        ?>
                        <!-- <table width="400" border="0" cellspacing="0" cellpadding="5" align="center">
                            <tr>
                                <th colspan="2" align="center"><br />
                                    <div align="center">Maklumat Pegawai Masjid</div><br /></th>
                            </tr>
                            <?php //$row = mysqli_fetch_array($result); ?>
                            <tr>
                                <td align="left"><strong>Nama</strong></td>
                                <td>  <?php //echo $row['nama_penuh']; ?></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Jawatan</strong></td>
                                <td>  <?php //echo $row['jawatan']; ?></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Bulan</strong></td>
                                <td>  <?php //echo $bulan2; //Tukaq Jadi Melayu Pakai Fungi_Tarikh.php?></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Tahun</strong></td>
                                <td>  <?php //echo $tahun; ?></td>
                            </tr>
                            <?php //$DIN=$row['id_fingerprint'];?>
                        </table><br /> -->
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12" align="left">
                                    NAMA KARIAH : <?php echo $nama_masjid; ?>
                                </div>
                                <div class="col-lg-3">
                                    BULAN : <?php echo $bulan2; ?>,&nbsp;TAHUN : <?php echo $tahun; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-bordered" align="center">
                                        <thead>
                                            <tr>
                                                <th>NO <?php echo strtoupper($jawatan); ?></th>
                                                <th>NAMA <?php echo strtoupper($jawatan); ?></th>
                                                <th>NO <?php echo strtoupper($jawatan); ?></th>
                                                <th>NAMA <?php echo strtoupper($jawatan); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                        <?php
                                        $k = 1;
                                        $kira_row = 0;
                                        //$jawatan = "Bilal";
                                        $sql_imam = "SELECT * FROM data_pegawai_masjid WHERE id_masjid='$id_masjid' AND jawatan='$jawatan'";
                                        $query_imam = mysqli_query($bd2,$sql_imam);
                                        while($data_imam = mysqli_fetch_array($query_imam))
                                        {
                                            $id_datapegawai = $data_imam['id_datapegawai'];
                                            if ($data_imam['nama_penuh'] != NULL) {
                                                $nama_penuh = $data_imam['nama_penuh'];
                                                $id[$id_datapegawai] = $k;
                                            } else if ($data_imam['id_pegawai'] != NULL) {
                                                $id_pegawai = $data_imam['id_pegawai'];
                                                $sql_pegawai = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_pegawai'";
                                                $query_pegawai = mysqli_query($bd2, $sql_pegawai);
                                                $row_pegawai = mysqli_num_rows($query_pegawai);
                                                if($row_pegawai>0) {
                                                    $data_pegawai = mysqli_fetch_array($query_pegawai);
                                                    $nama_penuh = $data_pegawai['nama_penuh'];
                                                    $id[$id_datapegawai] = $k;
                                                }
                                            } else if ($data_imam['id_pegawai2'] != NULL) {
                                                $id_pegawai2 = $data_imam['id_pegawai2'];
                                                $sql_pegawai2 = "SELECT * FROM sej6x_data_anakqariah WHERE ID='$id_pegawai2'";
                                                $query_pegawai2 = mysqli_query($bd2, $sql_pegawai2);
                                                $row_pegawai2 = mysqli_num_rows($query_pegawai2);
                                                if($row_pegawai2>0) {
                                                    $data_pegawai2 = mysqli_fetch_array($query_pegawai2);
                                                    $nama_penuh = $data_pegawai2['nama_penuh'];
                                                    $id[$id_datapegawai] = $k;
                                                }
                                            }
                                            $kehadiran[$id_datapegawai] = 0;
                                            if($nama_penuh!=NULL){
                                                $kira_row++;
                                            ?>
                                            <td align="center"><?php echo $k; ?></td>
                                            <td align="left">
                                               <?php echo $nama_penuh; ?>
                                            </td>
                                        <?php
                                            if($kira_row==2){
                                                $kira_row=0;
                                                echo "</tr></tr>";

                                            } $k++;}



                                            $nama_penuh = "";
                                        }
                                        ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <!-- <th rowspan="2" style="display:none"><div align="center">Bil</div></th> -->
                                <th><div align="center">Tarikh</div></th>
                                <?php
                                $sql_waktu = "SELECT a.perkara 'Perkara' FROM sej6x_data_perkarakehadiran a";
                                $result2 = mysqli_query($bd2, $sql_waktu) or die ("Error :".mysqli_error($bd2));
                                ?>
                                <?php while($row = mysqli_fetch_assoc($result2)){ ?>
                                    <th><div align="center"><?php echo $row['Perkara']; ?></div></th>
                                <?php } ?>
                            </tr>
                            </thead>

                            <tbody>
                            <?php



                            $i = 1;
                            do {
                                $z=mktime(00, 00, 00, $bulan3, $i, $tahun);
                                $namahari = date("w", $z);
                                $namahari2 = date("D", $z);
                                $tarikh = date("Y-m-d",$z);

                                ?>

                                <?php $x=1; ?>

                                <tr>
                                    <td style="display:none"><?php echo $x; ?></td>
                                    <td align="center"><?php echo $tarikh; ?></td>
                                    <?php
                                        $sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a WHERE perkara='Solat Subuh'";
                                        $resultspecial = mysqli_query($bd2, $sql_waktu2) or die ("Error :".mysqli_error($bd2));
                                        $waktu_solat=mysqli_fetch_array($resultspecial);
                                        $waktu_mula=$tarikh." ".$waktu_solat['Waktu Mula'];
                                        $waktu_tamat=$tarikh." ".$waktu_solat['Waktu Tamat'];

                                        if($id_device==1) {
                                            $sql1 = "SELECT DIN 'DIN', DATE_FORMAT(clock,'%H:%i') 'time' FROM $kod_masjid_besaq WHERE Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
                                            $sqlquery1=mysqli_query($conn2, $sql1);
                                        }
                                        else if($id_device==2) {
                                            $sql1 = "SELECT nama 'DIN', DATE_FORMAT(auth,'%H:%i') 'time' FROM $kod_masjid_kecik WHERE auth BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(auth), month(auth), day(auth), hour(auth)";
                                            $sqlquery1=mysqli_query($conn2, $sql1);
                                        }
                                        else if($id_device==NULL OR $id_device==3){
                                            $sql1 = "SELECT no_ic 'DIN', DATE_FORMAT(masa,'%H:%i') 'time' FROM kehadiran_pegawai WHERE masa BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(masa), month(masa), day(masa), hour(masa)";
                                            $sqlquery1=mysqli_query($bd2, $sql1);
                                        }

                                        $row1=mysqli_num_rows($sqlquery1);
                                        $data1=mysqli_fetch_array($sqlquery1);
                                    ?>
                                    <td align='center'>
                                        <?php
                                        $DIN = $data1['DIN'];
                                        //echo "<br>";
                                        $time = $data1['time'];

                                        if($id_device==1) {
                                            $sql2 = "SELECT * FROM data_pegawai_masjid WHERE id_fingerprint='$DIN' AND id_masjid='$id_masjid'";
                                        }
                                        else if($id_device!=1){
                                            $sql2 = "SELECT b.id_datapegawai FROM sej6x_data_peribadi a, data_pegawai_masjid b WHERE a.no_ic='$DIN' AND a.id_data=b.id_pegawai AND a.id_masjid = $id_masjid
                                                UNION SELECT d.id_datapegawai FROM sej6x_data_anakqariah c, data_pegawai_masjid d WHERE c.no_Ic='$DIN' AND c.ID = d.id_pegawai2 AND c.id_masjid = $id_masjid
                                                UNION SELECT e.id_datapegawai 'id_datapegawai' FROM data_pegawai_masjid e WHERE e.no_ic='$DIN' AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL AND e.id_masjid='$id_masjid'";
                                        }
                                        $sqlquery2 = mysqli_query($bd2,$sql2);
                                        $data2 = mysqli_fetch_array($sqlquery2);
                                        $data2['id_datapegawai'];
                                        $row2 = mysqli_num_rows($sqlquery2);
                                        $kehadiran[$data2['id_datapegawai']] = $kehadiran[$data2['id_datapegawai']] + 1;
                                        if($row2>0) {
                                            echo $id[$data2['id_datapegawai']] . "($time)";
                                        }
                                        ?>
                                    </td>
                                    <?php
                                    $sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a WHERE perkara='Solat Zohor'";
                                    $resultspecial = mysqli_query($bd2, $sql_waktu2) or die ("Error :".mysqli_error($bd2));
                                    $waktu_solat=mysqli_fetch_array($resultspecial);
                                    $waktu_mula=$tarikh." ".$waktu_solat['Waktu Mula'];
                                    $waktu_tamat=$tarikh." ".$waktu_solat['Waktu Tamat'];

                                    if($id_device==1) {
                                        $sql1 = "SELECT DIN 'DIN', DATE_FORMAT(clock,'%H:%i') 'time' FROM $kod_masjid_besaq WHERE Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
                                        $sqlquery1=mysqli_query($conn2, $sql1);
                                    }
                                    else if($id_device==2) {
                                        $sql1 = "SELECT nama 'DIN', DATE_FORMAT(auth,'%H:%i') 'time' FROM $kod_masjid_kecik WHERE auth BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(auth), month(auth), day(auth), hour(auth)";
                                        $sqlquery1=mysqli_query($conn2, $sql1);
                                    }
                                    else if($id_device==NULL OR $id_device==3){
                                        $sql1 = "SELECT no_ic 'DIN', DATE_FORMAT(masa,'%H:%i') 'time' FROM kehadiran_pegawai WHERE masa BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(masa), month(masa), day(masa), hour(masa)";
                                        $sqlquery1=mysqli_query($bd2, $sql1);
                                    }

                                    $row1=mysqli_num_rows($sqlquery1);
                                    $data1=mysqli_fetch_array($sqlquery1);
                                    ?>
                                    <td align='center'>
                                        <?php
                                        $DIN = $data1['DIN'];
                                        //echo "<br>";
                                        $time = $data1['time'];

                                        if($id_device==1) {
                                            $sql2 = "SELECT * FROM data_pegawai_masjid WHERE id_fingerprint='$DIN' AND id_masjid='$id_masjid'";
                                        }
                                        else if($id_device!=1){
                                            $sql2 = "SELECT b.id_datapegawai FROM sej6x_data_peribadi a, data_pegawai_masjid b WHERE a.no_ic='$DIN' AND a.id_data=b.id_pegawai AND a.id_masjid = $id_masjid
                                                UNION SELECT d.id_datapegawai FROM sej6x_data_anakqariah c, data_pegawai_masjid d WHERE c.no_Ic='$DIN' AND c.ID = d.id_pegawai2 AND c.id_masjid = $id_masjid
                                                UNION SELECT e.id_datapegawai 'id_datapegawai' FROM data_pegawai_masjid e WHERE e.no_ic='$DIN' AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL AND e.id_masjid='$id_masjid'";
                                        }
                                        $sqlquery2 = mysqli_query($bd2,$sql2);
                                        $data2 = mysqli_fetch_array($sqlquery2);
                                        $data2['id_datapegawai'];
                                        $row2 = mysqli_num_rows($sqlquery2);
                                        $kehadiran[$data2['id_datapegawai']] = $kehadiran[$data2['id_datapegawai']] + 1;
                                        if($row2>0) {
                                            echo $id[$data2['id_datapegawai']] . "($time)";
                                        }
                                        ?>
                                    </td>
                                    <?php
                                    $sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a WHERE perkara='Solat Asar'";
                                    $resultspecial = mysqli_query($bd2, $sql_waktu2) or die ("Error :".mysqli_error($bd2));
                                    $waktu_solat=mysqli_fetch_array($resultspecial);
                                    $waktu_mula=$tarikh." ".$waktu_solat['Waktu Mula'];
                                    $waktu_tamat=$tarikh." ".$waktu_solat['Waktu Tamat'];

                                    if($id_device==1) {
                                        $sql1 = "SELECT DIN 'DIN', DATE_FORMAT(clock,'%H:%i') 'time' FROM $kod_masjid_besaq WHERE Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
                                        $sqlquery1=mysqli_query($conn2, $sql1);
                                    }
                                    else if($id_device==2) {
                                        $sql1 = "SELECT nama 'DIN', DATE_FORMAT(auth,'%H:%i') 'time' FROM $kod_masjid_kecik WHERE auth BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(auth), month(auth), day(auth), hour(auth)";
                                        $sqlquery1=mysqli_query($conn2, $sql1);
                                    }
                                    else if($id_device==NULL OR $id_device==3){
                                        $sql1 = "SELECT no_ic 'DIN', DATE_FORMAT(masa,'%H:%i') 'time' FROM kehadiran_pegawai WHERE masa BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(masa), month(masa), day(masa), hour(masa)";
                                        $sqlquery1=mysqli_query($bd2, $sql1);
                                    }

                                    $row1=mysqli_num_rows($sqlquery1);
                                    $data1=mysqli_fetch_array($sqlquery1);
                                    ?>
                                    <td align='center'>
                                        <?php
                                        $DIN = $data1['DIN'];
                                        //echo "<br>";
                                        $time = $data1['time'];

                                        if($id_device==1) {
                                            $sql2 = "SELECT * FROM data_pegawai_masjid WHERE id_fingerprint='$DIN' AND id_masjid='$id_masjid'";
                                        }
                                        else if($id_device!=1){
                                            $sql2 = "SELECT b.id_datapegawai FROM sej6x_data_peribadi a, data_pegawai_masjid b WHERE a.no_ic='$DIN' AND a.id_data=b.id_pegawai AND a.id_masjid = $id_masjid
                                                UNION SELECT d.id_datapegawai FROM sej6x_data_anakqariah c, data_pegawai_masjid d WHERE c.no_Ic='$DIN' AND c.ID = d.id_pegawai2 AND c.id_masjid = $id_masjid
                                                UNION SELECT e.id_datapegawai 'id_datapegawai' FROM data_pegawai_masjid e WHERE e.no_ic='$DIN' AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL AND e.id_masjid='$id_masjid'";
                                        }
                                        $sqlquery2 = mysqli_query($bd2,$sql2);
                                        $data2 = mysqli_fetch_array($sqlquery2);
                                        $data2['id_datapegawai'];
                                        $row2 = mysqli_num_rows($sqlquery2);
                                        $kehadiran[$data2['id_datapegawai']] = $kehadiran[$data2['id_datapegawai']] + 1;
                                        if($row2>0) {
                                            echo $id[$data2['id_datapegawai']] . "($time)";
                                        }
                                        ?>
                                    </td>
                                    <?php
                                    $sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a WHERE perkara='Solat Maghrib'";
                                    $resultspecial = mysqli_query($bd2, $sql_waktu2) or die ("Error :".mysqli_error($bd2));
                                    $waktu_solat=mysqli_fetch_array($resultspecial);
                                    $waktu_mula=$tarikh." ".$waktu_solat['Waktu Mula'];
                                    $waktu_tamat=$tarikh." ".$waktu_solat['Waktu Tamat'];

                                    if($id_device==1) {
                                        $sql1 = "SELECT DIN 'DIN', DATE_FORMAT(clock,'%H:%i') 'time' FROM $kod_masjid_besaq WHERE Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
                                        $sqlquery1=mysqli_query($conn2, $sql1);
                                    }
                                    else if($id_device==2) {
                                        $sql1 = "SELECT nama 'DIN', DATE_FORMAT(auth,'%H:%i') 'time' FROM $kod_masjid_kecik WHERE auth BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(auth), month(auth), day(auth), hour(auth)";
                                        $sqlquery1=mysqli_query($conn2, $sql1);
                                    }
                                    else if($id_device==NULL OR $id_device==3){
                                        $sql1 = "SELECT no_ic 'DIN', DATE_FORMAT(masa,'%H:%i') 'time' FROM kehadiran_pegawai WHERE masa BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(masa), month(masa), day(masa), hour(masa)";
                                        $sqlquery1=mysqli_query($bd2, $sql1);
                                    }

                                    $row1=mysqli_num_rows($sqlquery1);
                                    $data1=mysqli_fetch_array($sqlquery1);
                                    ?>
                                    <td align='center'>
                                        <?php
                                        $DIN = $data1['DIN'];
                                        //echo "<br>";
                                        $time = $data1['time'];

                                        if($id_device==1) {
                                            $sql2 = "SELECT * FROM data_pegawai_masjid WHERE id_fingerprint='$DIN' AND id_masjid='$id_masjid'";
                                        }
                                        else if($id_device!=1){
                                            $sql2 = "SELECT b.id_datapegawai FROM sej6x_data_peribadi a, data_pegawai_masjid b WHERE a.no_ic='$DIN' AND a.id_data=b.id_pegawai AND a.id_masjid = $id_masjid
                                                UNION SELECT d.id_datapegawai FROM sej6x_data_anakqariah c, data_pegawai_masjid d WHERE c.no_Ic='$DIN' AND c.ID = d.id_pegawai2 AND c.id_masjid = $id_masjid
                                                UNION SELECT e.id_datapegawai 'id_datapegawai' FROM data_pegawai_masjid e WHERE e.no_ic='$DIN' AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL AND e.id_masjid='$id_masjid'";
                                        }
                                        $sqlquery2 = mysqli_query($bd2,$sql2);
                                        $data2 = mysqli_fetch_array($sqlquery2);
                                        $data2['id_datapegawai'];
                                        $row2 = mysqli_num_rows($sqlquery2);
                                        $kehadiran[$data2['id_datapegawai']] = $kehadiran[$data2['id_datapegawai']] + 1;
                                        if($row2>0) {
                                            echo $id[$data2['id_datapegawai']] . "($time)";
                                        }
                                        ?>
                                    </td>
                                    <?php
                                    $sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a WHERE perkara='Solat Isyak'";
                                    $resultspecial = mysqli_query($bd2, $sql_waktu2) or die ("Error :".mysqli_error($bd2));
                                    $waktu_solat=mysqli_fetch_array($resultspecial);
                                    $waktu_mula=$tarikh." ".$waktu_solat['Waktu Mula'];
                                    $waktu_tamat=$tarikh." ".$waktu_solat['Waktu Tamat'];

                                    if($id_device==1) {
                                        $sql1 = "SELECT DIN 'DIN', DATE_FORMAT(clock,'%H:%i') 'time' FROM $kod_masjid_besaq WHERE Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
                                        $sqlquery1=mysqli_query($conn2, $sql1);
                                    }
                                    else if($id_device==2) {
                                        $sql1 = "SELECT nama 'DIN', DATE_FORMAT(auth,'%H:%i') 'time' FROM $kod_masjid_kecik WHERE auth BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(auth), month(auth), day(auth), hour(auth)";
                                        $sqlquery1=mysqli_query($conn2, $sql1);
                                    }
                                    else if($id_device==NULL OR $id_device==3){
                                        $sql1 = "SELECT no_ic 'DIN', DATE_FORMAT(masa,'%H:%i') 'time' FROM kehadiran_pegawai WHERE masa BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(masa), month(masa), day(masa), hour(masa)";
                                        $sqlquery1=mysqli_query($bd2, $sql1);
                                    }

                                    $row1=mysqli_num_rows($sqlquery1);
                                    $data1=mysqli_fetch_array($sqlquery1);
                                    ?>
                                    <td align='center'>
                                        <?php
                                        $DIN = $data1['DIN'];
                                        //echo "<br>";
                                        $time = $data1['time'];

                                        if($id_device==1) {
                                            $sql2 = "SELECT * FROM data_pegawai_masjid WHERE id_fingerprint='$DIN' AND id_masjid='$id_masjid'";
                                        }
                                        else if($id_device!=1){
                                            $sql2 = "SELECT b.id_datapegawai FROM sej6x_data_peribadi a, data_pegawai_masjid b WHERE a.no_ic='$DIN' AND a.id_data=b.id_pegawai AND a.id_masjid = $id_masjid
                                                UNION SELECT d.id_datapegawai FROM sej6x_data_anakqariah c, data_pegawai_masjid d WHERE c.no_Ic='$DIN' AND c.ID = d.id_pegawai2 AND c.id_masjid = $id_masjid
                                                UNION SELECT e.id_datapegawai 'id_datapegawai' FROM data_pegawai_masjid e WHERE e.no_ic='$DIN' AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL AND e.id_masjid='$id_masjid'";
                                        }
                                        $sqlquery2 = mysqli_query($bd2,$sql2);
                                        $data2 = mysqli_fetch_array($sqlquery2);
                                        $data2['id_datapegawai'];
                                        $row2 = mysqli_num_rows($sqlquery2);
                                        $kehadiran[$data2['id_datapegawai']] = $kehadiran[$data2['id_datapegawai']] + 1;
                                        if($row2>0) {
                                            echo $id[$data2['id_datapegawai']] . "($time)";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <?php $i++; } while ($i <= $hari);


                            }

                            ?>

                            </tbody>

                        </table>

                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6" align="left">
                                <table class="table-bordered">
                                    <thead>
                                    <tr>
                                        <th>NO <?php echo strtoupper($jawatan); ?></th>
                                        <th>JUMLAH TUGASAN</th>
                                        <th>NO <?php echo strtoupper($jawatan); ?></th>
                                        <th>JUMLAH TUGASAN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <?php
                                        $k = 1;
                                        $kira_row = 0;
                                        //$jawatan = "Imam";
                                        $sql_imam = "SELECT * FROM data_pegawai_masjid WHERE id_masjid='$id_masjid' AND jawatan='$jawatan'";
                                        $query_imam = mysqli_query($bd2,$sql_imam);
                                        while($data_imam = mysqli_fetch_array($query_imam))
                                        {
                                            $id_datapegawai = $data_imam['id_datapegawai'];
                                            if ($data_imam['nama_penuh'] != NULL) {
                                                $nama_penuh = $data_imam['nama_penuh'];
                                            } else if ($data_imam['id_pegawai'] != NULL) {
                                                $id_pegawai = $data_imam['id_pegawai'];
                                                $sql_pegawai = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_pegawai'";
                                                $query_pegawai = mysqli_query($bd2, $sql_pegawai);
                                                $row_pegawai = mysqli_num_rows($query_pegawai);
                                                if($row_pegawai>0) {
                                                    $data_pegawai = mysqli_fetch_array($query_pegawai);
                                                    $nama_penuh = $data_pegawai['nama_penuh'];
                                                }
                                            } else if ($data_imam['id_pegawai2'] != NULL) {
                                                $id_pegawai2 = $data_imam['id_pegawai2'];
                                                $sql_pegawai2 = "SELECT * FROM sej6x_data_anakqariah WHERE ID='$id_pegawai2'";
                                                $query_pegawai2 = mysqli_query($bd2, $sql_pegawai2);
                                                $row_pegawai2 = mysqli_num_rows($query_pegawai2);
                                                if($row_pegawai2>0) {
                                                    $data_pegawai2 = mysqli_fetch_array($query_pegawai2);
                                                    $nama_penuh = $data_pegawai2['nama_penuh'];
                                                }
                                            }
                                            if($nama_penuh!=NULL){
                                                $kira_row++;
                                                ?>
                                                <td align="center"><?php echo $k; ?></td>
                                                <td align="center">
                                                    <?php echo $kehadiran[$id_datapegawai]; ?>
                                                </td>
                                                <?php
                                                if($kira_row==2){
                                                    $kira_row=0;
                                                    echo "</tr></tr>";

                                                } $k++;}

                                            $nama_penuh = "";
                                        }
                                        ?>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">

                                    <strong>Pengesahan Pengerusi Masjid,</strong>

                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>

                                    <strong>---------------------------------------------</strong>
                                    <br>
                            </div>
                        </div>
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <?php
    }
    ?>
</div>