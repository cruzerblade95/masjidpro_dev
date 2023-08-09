<?php
$month = $_POST['month'];
$tahun = $_POST['tahun'];
?>
<style type="text/css">
    @media print {
        #printbtn {
            display :  none;
        }
    }
</style>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Kehadiran Pegawai Masjid</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=organisai_laporan_senaraiPEGAWAI&sideMenu=organisasi">Senarai Kehadiran</a></li>
                    <li class="active">Kehadiran Pegawai Masjid</li>
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
                    <div class="row">
                        <div class="col-lg-10">
                            Carian
                        </div>
                        <div class="col-lg-2" align="end">
                            <a href="utama.php?view=admin&action=organisasi_laporan_senaraiPEGAWAI&sideMenu=organisasi"><button class="btn btn-primary">Kembali</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="kehadiran_terperinci" name="kehadiran_terperinci" method="POST" action="<?php echo $PHP_SELF;?>">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Bulan</label>
                                        <select class="form-control" name="month" id="month" required>
                                            <option value="" selected="selected">Sila Pilih Bulan</option>
                                            <option value="01" <?php if ($month=="01"){echo "selected";}?>>Januari</option>
                                            <option value="02" <?php if ($month=="02"){echo "selected";}?>>Februari</option>
                                            <option value="03" <?php if ($month=="03"){echo "selected";}?>>Mac</option>
                                            <option value="04" <?php if ($month=="04"){echo "selected";}?>>April</option>
                                            <option value="05" <?php if ($month=="05"){echo "selected";}?>>Mei</option>
                                            <option value="06" <?php if ($month=="06"){echo "selected";}?>>Jun</option>
                                            <option value="07" <?php if ($month=="07"){echo "selected'";}?>>Julai</option>
                                            <option value="08" <?php if ($month=="08"){echo "selected";}?>>Ogos</option>
                                            <option value="09" <?php if ($month=="09"){echo "selected";}?>>September</option>
                                            <option value="10" <?php if($month=="10"){echo "selected";}?>>Oktober</option>
                                            <option value="11" <?php if($month=="11"){echo "selected";}?>>November</option>
                                            <option value="12" <?php if($month=="12"){echo "selected";}?>>Disember</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <select class="form-control" name="tahun" id="tahun" required>
                                            <option value="">Sila Pilih Tahun</option>
                                            <?php
                                            $start_year = 2018;
                                            $end_year = date('Y');
                                            for($i = $end_year; $i >= $start_year; $i--) { ?>
                                                <option value="<?php echo $i; ?>" <?php if($tahun == $i) { echo "selected"; } ?>><?php echo $i;?></option>
                                            <?php } ?>
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
                        if(isset($_POST['search']))
                        {
                        $id_bulan = $_POST['month'];
                        $tahun = $_POST['tahun'];
                        //Bulan

                        $hari = date("t", mktime(0,0,0,$id_bulan,1,$tahun));
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
                        if($id_device == NULL OR $id_device == 3) {
                            $sql_search = "SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan', b.no_ic 'id_fingerprint' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_datapegawai='$id' AND a.id_pegawai=b.id_data
                             UNION SELECT d.nama_penuh 'nama_penuh', c.jawatan 'jawatan', d.no_ic 'id_fingerprint' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_datapegawai='$id' AND c.id_pegawai2=d.ID
                             UNION SELECT e.nama_penuh 'nama_penuh', e.jawatan 'jawatan', e.no_ic 'id_fingerprint' FROM data_pegawai_masjid e WHERE e.id_datapegawai='$id'
                             UNION SELECT f.nama_penuh 'nama_penuh', f.jawatan 'jawatan', f.no_pengenalan 'id_fingerprint' FROM rekod_organisasi f WHERE f.id = '$id'";
                        }
                        else if($id_device == 1 ) {
                            $sql_search = "SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan', b.no_ic 'no_ic', a.id_fingerprint 'id_fingerprint' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_datapegawai='$id' AND a.id_pegawai=b.id_data
                             UNION SELECT d.nama_penuh 'nama_penuh', c.jawatan 'jawatan', d.no_ic 'no_ic', c.id_fingerprint 'id_fingerprint' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_datapegawai='$id' AND c.id_pegawai2=d.ID
                             UNION SELECT e.nama_penuh 'nama_penuh', e.jawatan 'jawatan', e.no_ic 'no_ic', e.id_fingerprint 'id_fingerprint' FROM data_pegawai_masjid e WHERE e.id_datapegawai='$id'
                             UNION SELECT f.nama_penuh 'nama_penuh', f.jawatan 'jawatan', f.no_pengenalan 'id_fingerprint' FROM rekod_organisasi f WHERE f.id = '$id'";
                        }
                        else if($id_device == 2 ) {
                            $sql_search = "SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan', b.no_ic 'id_fingerprint' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_datapegawai='$id' AND a.id_pegawai=b.id_data
                             UNION SELECT d.nama_penuh 'nama_penuh', c.jawatan 'jawatan', d.no_ic 'id_fingerprint' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_datapegawai='$id' AND c.id_pegawai2=d.ID
                             UNION SELECT e.nama_penuh 'nama_penuh', e.jawatan 'jawatan', e.no_ic 'id_fingerprint' FROM data_pegawai_masjid e WHERE e.id_datapegawai='$id'
                             UNION SELECT f.nama_penuh 'nama_penuh', f.jawatan 'jawatan', f.no_pengenalan 'id_fingerprint' FROM rekod_organisasi f WHERE f.id = '$id'";
                        }
                        $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
                        //echo($sql_search);
                        ?>
                        <table width="400" border="0" cellspacing="0" cellpadding="5" align="center">
                            <tr>
                                <th colspan="2" align="center"><br />
                                    <div align="center">Maklumat Pegawai Masjid</div><br /></th>
                            </tr>
                            <?php $row = mysqli_fetch_array($result); ?>
                            <tr>
                                <td align="left"><strong>Nama</strong></td>
                                <td>  <?php echo $row['nama_penuh']; ?></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Jawatan</strong></td>
                                <td>  <?php echo $row['jawatan']; ?></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Bulan</strong></td>
                                <td>  <?php echo $bulan2; ?></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Tahun</strong></td>
                                <td>  <?php echo $tahun; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
                                        <tr style="text-align: center">
                                            <th colspan="5"><strong>Jumlah Kehadiran</strong></th>
                                        </tr>
                                        <tr style="text-align: center">
                                            <th><strong>Subuh</strong></th>
                                            <th><strong>Zohor</strong></th>
                                            <th><strong>Asar</strong></th>
                                            <th><strong>Maghrib</strong></th>
                                            <th><strong>Isyak</strong></th>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td id="jumSubuh"></td>
                                            <td id="jumZohor"></td>
                                            <td id="jumAsar"></td>
                                            <td id="jumMaghrib"></td>
                                            <td id="jumIsyak"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php $DIN = $row['id_fingerprint']; ?>
                        </table><br />
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th rowspan="2" style="display:none"><div align="center">Bil</div></th>
                                <th rowspan="2"><div align="center">Tarikh</div></th>
                                <th colspan="5"><div align="center">Butir-butir Kehadiran</div></th>
                            </tr>
                            <tr>
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
                                $x=1; ?>
                                <tr>
                                    <td style="display:none"><?php echo $x; ?></td>
                                    <td align="center"><?php echo $tarikh; ?></td>
                                    <?php
                                    $sql_waktu2 = "SELECT DATE_FORMAT(a.start_time, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.end_time, '%H:%i:%s') 'Waktu Tamat' FROM waktu_rekod_kehadiran a";
                                    $resultspecial = mysqli_query($bd2, $sql_waktu2) or die ("Error :".mysqli_error($bd2));
                                    $waktu_solat=mysqli_fetch_assoc($resultspecial);
                                    $kk = 1;
                                    do {
                                        $waktu_mulaArray[$kk] = $tarikh." ".$waktu_solat['Waktu Mula'];
                                        $waktu_tamatArray[$kk] = $tarikh." ".$waktu_solat['Waktu Tamat'];
                                        $waktu_mula = $waktu_mulaArray[$kk];
                                        $waktu_tamat = $waktu_tamatArray[$kk];
                                        $sql1 = "SELECT DATE_FORMAT(masa, '%r') 'Waktu Hadir' FROM kehadiran_pegawai WHERE no_ic='$DIN' AND masa BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(masa), month(masa), day(masa), hour(masa)";
                                        $sql2 = "SELECT DATE_FORMAT(Clock, '%r') 'Waktu Hadir' FROM $kod_masjid_besaq WHERE DIN='$DIN' AND Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
                                        $sql3 = "SELECT DATE_FORMAT(auth, '%r') 'Waktu Hadir' FROM $kod_masjid_kecik WHERE nama='$DIN' AND auth BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(auth), month(auth), day(auth), hour(auth)";
                                        //echo($sql1.'<br />');
                                        $sqlquery1 = mysqli_query($bd2, $sql1);
                                        $num1 = mysqli_num_rows($sqlquery1);

                                        $sqlquery2 = mysqli_query($conn2, $sql2);
                                        $num2 = mysqli_num_rows($sqlquery2);

                                        $sqlquery3 = mysqli_query($conn2, $sql3);
                                        $num3 = mysqli_num_rows($sqlquery3);

                                        //echo($num1.' : '.$num2.' : '.$num3.'<br />');
                                        if ($num1 > 0) $data = mysqli_fetch_assoc($sqlquery1)['Waktu Hadir'];
                                        else if ($num2 > 0) $data = mysqli_fetch_assoc($sqlquery2)['Waktu Hadir'];
                                        else if ($num3 > 0) $data = mysqli_fetch_assoc($sqlquery3)['Waktu Hadir'];
                                        else $data = NULL;

                                        if ($data != NULL) {
                                            $jumlahRekodHadir[$kk] = $jumlahRekodHadir[$kk] + 1;
                                            echo "<td bgcolor='#44FF62' align='center' class='font-weight-bold'>" . $data . "</td>\r\n";
                                        }
                                        else {
                                            $jumlahRekodHadir[$kk] = $jumlahRekodHadir[$kk] + 0;
                                            echo "<td align='center'></td>\r\n";
                                        }
                                        $kk++;
                                    } while ($waktu_solat = mysqli_fetch_assoc($resultspecial));
                                    ?>
                                </tr>
                                <?php $i++; } while ($i <= $hari); } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                    <div class="well">
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
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>
<script type="text/javascript">
    document.getElementById('jumSubuh').innerHTML = '<?php echo $jumlahRekodHadir[1]; ?>';
    document.getElementById('jumZohor').innerHTML = '<?php echo $jumlahRekodHadir[2]; ?>';
    document.getElementById('jumAsar').innerHTML = '<?php echo $jumlahRekodHadir[3]; ?>';
    document.getElementById('jumMaghrib').innerHTML = '<?php echo $jumlahRekodHadir[4]; ?>';
    document.getElementById('jumIsyak').innerHTML = '<?php echo $jumlahRekodHadir[5]; ?>';
</script>