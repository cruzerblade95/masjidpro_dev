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
                <h1>Kehadiran Pengurusan Masjid</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=kehadiran">Menu Kehadiran</a></li>
                    <li class="active">Kehadiran Pengurusan Masjid</li>
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
                                        <label>Bulan</label>
                                        <select class="form-control" name="month" id="month">
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
                        $kod_masjid_kecik = ($kod_masjid);
                        //echo($kod_masjid_kecik);
                        // if(isset($_POST['search']))
                        // {
                            if($_POST['month'] && $_POST['tahun']){
                                $id_bulan = $_POST['month'];
                                $tahun = $_POST['tahun'];
                            }else{
                                $id_bulan = date("m");
                                $tahun = date("Y");
                            }
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


                        $id = $_GET['id_pengurusan'];

                        $sql_search = "SELECT a.id_pengurusan, a.nama_penuh, a.no_ic, a.no_tel, b.jawatan FROM data_pengurusan_masjid a, jawatan_pengurusan_masjid b WHERE a.jawatan=b.id_jawatan AND a.id_pengurusan='$id'";
                        $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
                        ?>
                        <table width="400" border="0" cellspacing="0" cellpadding="5" align="center">
                            <tr>
                                <th colspan="2" align="center"><br />
                                    <div align="center">Maklumat <Pengurusan></Pengurusan> Masjid</div><br /></th>
                            </tr>
                            <?php $row = mysqli_fetch_array($result); $ic = $row['no_ic']; ?>
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
                            <?php $DIN=$row['id_fingerprint'];?>
                        </table><br />
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th rowspan="2" style="display:none"><div align="center">Bil</div></th>
                                <th rowspan="2"><div align="center">Tarikh</div></th>
                                <th colspan="5"><div align="center">Butir-butir Kehadiran</div></th>
                            </tr>
                            <tr>
                                <th><div align="center">Imbas Masuk</div></th>
                                <th><div align="center">Imbas Keluar</div></th>
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

                                $waktu_mula = $tarikh." 00:00:01";
                                $waktu_tamat = $tarikh." 23:59:59";
                                ?>

                                <?php $x=1; ?>

                                <tr>
                                    <td style="display:none"><?php echo $x; ?></td>
                                    <td align="center"><?php echo $tarikh; ?></td>
                                    <td align="center">
                                        <?php
                                        //$sql1 = "SELECT DATE_FORMAT(Clock, '%r') 'Waktu Hadir' FROM $kod_masjid_kecik WHERE DIN='$DIN' AND Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
                                        $sql_in = "SELECT DATE_FORMAT(masa, '%r') 'Waktu Hadir' FROM kehadiran_pengurusan WHERE DATE_FORMAT(masa, '%H:%i:%s') BETWEEN '06:00:00' AND '17:59:59' AND no_ic='$ic' AND masa BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(masa), month(masa), day(masa), hour(masa)";
                                        //$sql_in = "SELECT * FROM kehadiran_pengurusan WHERE id_masjid='$id_masjid' AND no_ic='$ic'";
                                        $query_in = mysqli_query($bd2,$sql_in);
                                        $row_in = mysqli_num_rows($query_in);

                                        if($row_in>0){
                                            $data_in = mysqli_fetch_array($query_in);
                                            echo $data_in['Waktu Hadir'];
                                        }
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $sql_out = "SELECT DATE_FORMAT(masa, '%r') 'Waktu Hadir' FROM kehadiran_pengurusan WHERE DATE_FORMAT(masa, '%H:%i:%s') BETWEEN '18:00:00' AND '23:59:59' AND no_ic='$ic' AND masa BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(masa), month(masa), day(masa), hour(masa)";
                                        $query_out = mysqli_query($bd2,$sql_out);
                                        $row_out = mysqli_num_rows($query_out);

                                        if($row_out>0){
                                            $data_out = mysqli_fetch_array($query_out);
                                            echo $data_out['Waktu Hadir'];
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <?php $i++; } while ($i <= $hari);


                            // }

                            ?>

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